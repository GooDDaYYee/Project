<?php
require_once __DIR__ . '/BaseController.php';

class StockCableController extends BaseController
{

    public function __construct()
    {
        parent::__construct();

        if ($_SESSION["lv"] != 0 && $_SESSION["lv"] != 1 && $_SESSION["lv"] != 2) {
            header("Location: index.php?page=home");
            exit();
        }
    }

    public function index()
    {
        $cables = $this->fetchCables();
        $cableWorks = $this->getCableWorks_update();
        $data = [
            'cables' => $cables,
            'cableWorks' => $cableWorks
        ];

        $pageTitle = 'สต๊อกเคเบิ้ล - PSNK TELECOM';
        $this->render('stock_cable/index', ['pageTitle' => $pageTitle, 'data' => $data]);
    }

    private function fetchCables()
    {
        $strsql = "SELECT c.*, d.drum_no, cw.cable_work_name 
               FROM cable c 
               JOIN drum d ON d.drum_id = c.drum_id 
               JOIN cable_work cw ON c.cable_work_id = cw.cable_work_id 
               ORDER BY c.cable_date DESC";
        try {
            $stmt = $this->db->prepare($strsql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $this->logAction('Fetch Cables Failed', $e->getMessage());
            return [];
        }
    }

    public function fetchCableDetails()
    {
        if (!isset($_POST['cable_id'])) {
            $this->logAction('Fetch Cable Details Failed', 'Cable ID not provided');
            $this->jsonResponse(false, 'ไม่ได้ระบุรหัส Cable');
            return;
        }

        $cable_id = $_POST['cable_id'];

        try {
            $stmt = $this->db->prepare("SELECT c.*, d.drum_no, cw.cable_work_name 
                                    FROM cable c 
                                    JOIN drum d ON c.drum_id = d.drum_id 
                                    JOIN cable_work cw ON c.cable_work_id = cw.cable_work_id
                                    WHERE c.cable_id = :cable_id");
            $stmt->execute([':cable_id' => $cable_id]);
            $cable = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($cable) {
                $this->successResponse('ดึงรายละเอียด Cable เรียบร้อยแล้ว', $cable);
            } else {
                $this->jsonResponse(false, 'ไม่พบ Cable');
            }
        } catch (PDOException $e) {
            $this->errorResponse('เกิดข้อผิดพลาดในการเรียกรายละเอียด Cable: ' . $e->getMessage());
        }
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->createCable();
        } else {
            $this->showCreateForm();
        }
    }

    private function showCreateForm()
    {
        $companies = $this->getCompanies();
        $manufacturers = $this->getManufacturers();
        $cableWorks = $this->getCableWorks();

        $data = [
            'companies' => $companies,
            'manufacturers' => $manufacturers,
            'cableWorks' => $cableWorks
        ];

        $pageTitle = 'เพิ่มงานสต๊อกเคเบิ้ล - PSNK TELECOM';
        $this->render('stock_cable/create', ['pageTitle' => $pageTitle, 'data' => $data]);
    }

    private function getCableWorks()
    {
        try {
            $stmt = $this->db->prepare("SELECT cable_work_id, cable_work_name FROM cable_work ORDER BY cable_work_name");
            $stmt->execute();
            $cableWorks = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
            return $cableWorks;
        } catch (PDOException $e) {
            $this->logAction('Fetch Cable Works Failed', $e->getMessage());
            return [];
        }
    }

    private function getCableWorks_update()
    {
        try {
            $stmt = $this->db->prepare("SELECT cable_work_id, cable_work_name FROM cable_work ORDER BY cable_work_name");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $this->logAction('Fetch Cable Works Update Failed', $e->getMessage());
            return [];
        }
    }

    private function createCable()
    {
        try {
            $this->db->beginTransaction();

            $cableData = $this->validateCableData($_POST);
            if (!isset($cableData['cable_work_id']) || !is_numeric($cableData['cable_work_id'])) {
                $this->logAction('Cable Creation Failed', 'Invalid cable_work_id');
                $this->jsonResponse(false, 'กรุณาเลือกงานที่ทำ');
            }

            $cable_used = $cableData['cable_form'] - $cableData['cable_to'];

            $this->checkTotalCable($cableData['drum_id'], $cable_used);

            $stmt = $this->db->prepare("INSERT INTO cable (route_name, installed_section, placing_team, cable_form, cable_to, cable_used, drum_id, cable_work_id, employee_id)
            VALUES (:route_name, :installed_section, :placing_team, :cable_form, :cable_to, :cable_used, :drum_id, :cable_work_id, :employee_id)");

            $stmt->execute([
                ':route_name' => $cableData['route'],
                ':installed_section' => $cableData['section'],
                ':placing_team' => $cableData['team'],
                ':cable_form' => $cableData['cable_form'],
                ':cable_to' => $cableData['cable_to'],
                ':cable_used' => $cable_used,
                ':drum_id' => $cableData['drum_id'],
                ':cable_work_id' => $cableData['cable_work_id'],
                ':employee_id' => $_SESSION['employee_id']
            ]);

            $cable_id = $this->db->lastInsertId();

            $this->updateAllDrumUsages();

            $this->logAction('Cable Created', "Cable ID: $cable_id, Route: {$cableData['route']}, Section: {$cableData['section']}, Used: $cable_used, Drum ID: {$cableData['drum_id']}");

            $this->db->commit();
            $this->successResponse();
        } catch (Exception $e) {
            $this->db->rollBack();
            $this->logAction('Cable Creation Failed', $e->getMessage());
            $this->errorResponse('เกิดข้อผิดพลาดในการสร้าง Cable: ' . $e->getMessage());
        }
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->updateCable();
        } else {
            $this->logAction('Cable Update Failed', 'Invalid request method');
            $this->jsonResponse(false, 'วิธีการร้องขอไม่ถูกต้อง');
        }
    }

    private function updateCable()
    {
        try {
            $this->db->beginTransaction();

            $cableData = $this->validateCableData($_POST);
            $cable_id = $cableData['cable_id'];
            $new_cable_used = $cableData['cable_form'] - $cableData['cable_to'];

            $oldCableData = $this->fetchCableData($cable_id);
            $total_cable = $this->calculateTotalCable($cableData['drum_id'], $oldCableData['cable_used'], $new_cable_used);

            if ($total_cable > 4000) {
                $this->logAction('Cable Update Failed', "Cable ID: $cable_id, Total cable exceeded 4000m");
                $this->jsonResponse(false, 'จำนวนสายเคเบิลทั้งหมดเกิน 4000 เมตร');
            }

            $stmt = $this->db->prepare("UPDATE cable SET 
            route_name = :route_name, 
            installed_section = :installed_section, 
            placing_team = :placing_team, 
            cable_form = :cable_form, 
            cable_to = :cable_to, 
            cable_used = :cable_used, 
            drum_id = :drum_id, 
            cable_work_id = :cable_work_id 
            WHERE cable_id = :cable_id");

            $stmt->execute([
                ':route_name' => $cableData['route'],
                ':installed_section' => $cableData['section'],
                ':placing_team' => $cableData['team'],
                ':cable_form' => $cableData['cable_form'],
                ':cable_to' => $cableData['cable_to'],
                ':cable_used' => $new_cable_used,
                ':drum_id' => $cableData['drum_id'],
                ':cable_work_id' => $cableData['cable_work_id'],
                ':cable_id' => $cable_id
            ]);

            $this->updateAllDrumUsages();

            $this->logAction('Cable Updated', "Cable ID: $cable_id, Route: {$cableData['route']}, Section: {$cableData['section']}, Used: $new_cable_used, Drum ID: {$cableData['drum_id']}");

            $this->db->commit();
            $this->successResponse();
        } catch (Exception $e) {
            $this->db->rollBack();
            $this->logAction('Cable Update Failed', "Cable ID: {$cableData['cable_id']}, Error: " . $e->getMessage());
            $this->errorResponse("เกิดข้อผิดพลาดในการอัพเดตข้อมูล Cable: " . $e->getMessage());
        }
    }

    public function delete()
    {
        if (!isset($_POST['cable_id'])) {
            $this->logAction('Cable Deletion Failed', 'Cable ID not provided');
            $this->jsonResponse(false, 'ไม่ได้ระบุรหัส Cable');
        }

        $cable_id = $_POST['cable_id'];

        try {
            $this->db->beginTransaction();

            $cableData = $this->fetchCableData($cable_id);

            $stmt = $this->db->prepare("DELETE FROM cable WHERE cable_id = :cable_id");
            $stmt->execute([':cable_id' => $cable_id]);

            $this->updateAllDrumUsages();

            $this->logAction('Cable Deleted', "Cable ID: $cable_id, Route: {$cableData['route_name']}, Section: {$cableData['installed_section']}, Used: {$cableData['cable_used']}, Drum ID: {$cableData['drum_id']}");

            $this->db->commit();
            $this->successResponse();
        } catch (Exception $e) {
            $this->db->rollBack();
            $this->logAction('Cable Deletion Failed', "Cable ID: $cable_id, Error: " . $e->getMessage());
            $this->errorResponse('การลบข้อมูลผิดพลาด: ' . $e->getMessage());
        }
    }

    private function validateCableData($data)
    {
        $required = [
            'route' => 'Route',
            'section' => 'Section',
            'team' => 'Team',
            'cable_form' => 'Cable Form',
            'cable_to' => 'Cable To',
            'cable_work_id' => 'งานที่ทำ',
            'drum_id' => 'รหัส Drum'
        ];

        foreach ($required as $field => $fieldName) {
            if (!isset($data[$field]) || $data[$field] === '') {
                $this->logAction('Cable Data Validation Failed', "Missing field: $fieldName");
                $this->jsonResponse(false, "กรุณากรอกข้อมูล $fieldName");
            }
        }

        if ($data['cable_form'] <= $data['cable_to']) {
            $this->logAction('Cable Data Validation Failed', "Invalid cable form/to values");
            $this->jsonResponse(false, 'สายเคเบิลจำนวนเท่ากัน หรือน้อยกว่าปลายสาย');
        }

        return $data;
    }

    private function checkTotalCable($drum_id, $new_cable_used)
    {
        $stmt = $this->db->prepare('SELECT SUM(cable_used) as total_cable FROM cable WHERE drum_id = :drum_id');
        $stmt->execute([':drum_id' => $drum_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $total_cable = $result['total_cable'] + $new_cable_used;

        if ($total_cable > 4000) {
            $this->logAction('Total Cable Check Failed', "Drum ID: $drum_id, Total cable: $total_cable");
            $this->jsonResponse(false, 'จำนวนสายเคเบิลทั้งหมดเกิน 4000 เมตร');
        }
    }

    private function updateDrumUsage($drum_id)
    {
        $stmt = $this->db->prepare('SELECT SUM(cable_used) as total_cable FROM cable WHERE drum_id = :drum_id');
        $stmt->execute([':drum_id' => $drum_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $total_cable = $result['total_cable'] ?? 0;

        if ($total_cable == 0) {
            $sql = "UPDATE drum SET drum_used = 0, drum_remaining = 4000 WHERE drum_id = :drum_id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':drum_id' => $drum_id]);
        } else {
            $sql = "UPDATE drum SET drum_used = :total_cable, drum_remaining = CASE WHEN (drum_full - :total_cable) = 0 THEN 4000 ELSE (drum_full - :total_cable) END WHERE drum_id = :drum_id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':total_cable' => $total_cable,
                ':drum_id' => $drum_id
            ]);
        }

        $this->logAction('Drum Usage Updated', "Drum ID: $drum_id, Total Cable Used: $total_cable");
    }

    private function fetchCableData($cable_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM cable WHERE cable_id = :cable_id");
        $stmt->execute([':cable_id' => $cable_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
            $this->logAction('Fetch Cable Data Failed', "Cable ID: $cable_id - No data found");
        }
        return $result;
    }

    private function calculateTotalCable($drum_id, $old_cable_used, $new_cable_used)
    {
        $stmt = $this->db->prepare('SELECT SUM(cable_used) as total_cable FROM cable WHERE drum_id = :drum_id');
        $stmt->execute([':drum_id' => $drum_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $total_cable = ($result['total_cable'] - $old_cable_used) + $new_cable_used;
        return $total_cable;
    }

    private function updateAllDrumUsages()
    {
        $strsql = 'SELECT d.drum_id, d.drum_full, COALESCE(SUM(c.cable_used), 0) as total_cable 
           FROM drum d 
           LEFT JOIN cable c ON d.drum_id = c.drum_id 
           GROUP BY d.drum_id, d.drum_full';
        $stmt = $this->db->prepare($strsql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $row) {
            $drum_id = $row['drum_id'];
            $total_cable = $row['total_cable'];
            $drum_full = $row['drum_full'];

            if ($total_cable == 0) {
                $sql = "UPDATE drum SET drum_used = 0, drum_remaining = :drum_full WHERE drum_id = :drum_id";
                $stmt = $this->db->prepare($sql);
                $stmt->execute([':drum_full' => $drum_full, ':drum_id' => $drum_id]);
            } else {
                $drum_remaining = $drum_full - $total_cable;
                if ($drum_remaining <= 0) {
                    $drum_remaining = 0;  // เมื่อใช้หมดแล้ว ให้ set เป็น 0
                }
                $sql = "UPDATE drum SET drum_used = :total_cable, drum_remaining = :drum_remaining WHERE drum_id = :drum_id";
                $stmt = $this->db->prepare($sql);
                $stmt->execute([
                    ':total_cable' => $total_cable,
                    ':drum_remaining' => $drum_remaining,
                    ':drum_id' => $drum_id
                ]);
            }
        }
    }

    private function getCompanies()
    {
        try {
            $stmt = $this->db->prepare("SELECT drum_company_id, drum_company_detail FROM drum_company ORDER BY drum_company_detail");
            $stmt->execute();
            $companies = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
            return $companies;
        } catch (PDOException $e) {
            $this->logAction('Fetch Companies Failed', $e->getMessage());
            return [];
        }
    }

    private function getManufacturers()
    {
        try {
            $stmt = $this->db->prepare("SELECT drum_cable_company_id, drum_cable_company_detail FROM drum_cable_company ORDER BY drum_cable_company_detail");
            $stmt->execute();
            $manufacturers = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
            return $manufacturers;
        } catch (PDOException $e) {
            $this->logAction('Fetch Manufacturers Failed', $e->getMessage());
            return [];
        }
    }

    public function fetchDrums()
    {
        if (!isset($_POST['company']) || !isset($_POST['manufacturer'])) {
            $this->jsonResponse(false, 'Company and manufacturer are required');
            return;
        }

        $company = $_POST['company'];
        $manufacturer = $_POST['manufacturer'];
        $minRemaining = isset($_POST['min_remaining']) ? intval($_POST['min_remaining']) : 0;

        try {
            $sql = "SELECT drum_id, drum_no, drum_remaining FROM drum 
                WHERE drum_company_id = :company 
                AND drum_cable_company_id = :manufacturer
                AND drum_remaining > 0";  // เพิ่มเงื่อนไขนี้

            if ($minRemaining > 0) {
                $sql .= " AND drum_remaining <= :min_remaining";
            }

            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':company', $company);
            $stmt->bindParam(':manufacturer', $manufacturer);

            if ($minRemaining > 0) {
                $stmt->bindParam(':min_remaining', $minRemaining);
            }

            $stmt->execute();
            $drums = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (empty($drums)) {
                $options = '<option value="">ไม่มี Drum ที่เหลือ</option>';
                $message = 'ไม่พบ Drum ที่มีสายเคเบิลเหลือ';
            } else {
                $options = '<option value="">เลือก Drum</option>';
                foreach ($drums as $drum) {
                    $options .= "<option value='{$drum['drum_id']}'>{$drum['drum_no']} (คงเหลือ: {$drum['drum_remaining']})</option>";
                }
                $message = 'ดึงข้อมูล Drums สำเร็จ';
            }

            $this->successResponse($message, ['options' => $options]);
        } catch (PDOException $e) {
            $this->errorResponse('เกิดข้อผิดพลาดในการดึงข้อมูล Drums: ' . $e->getMessage());
        }
    }
}
