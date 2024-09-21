<?php
require_once __DIR__ . '/BaseController.php';

class StockCableController extends BaseController
{
    public function index()
    {
        $cables = $this->fetchCables();
        $data = [
            'cables' => $cables
        ];

        $pageTitle = 'สต๊อกเคเบิ้ล - PSNK TELECOM';
        $this->render('stock_cable/index', ['pageTitle' => $pageTitle, 'data' => $data]);
    }

    private function fetchCables()
    {
        $strsql = "SELECT c.*, d.drum_no FROM cable c JOIN drum d ON d.drum_id = c.drum_id ORDER BY cable_date ASC";
        try {
            $stmt = $this->db->prepare($strsql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    public function fetchCableDetails()
    {
        if (!isset($_POST['cable_id'])) {
            $this->jsonResponse(false, 'Cable ID not provided');
            return;
        }

        $cable_id = $_POST['cable_id'];

        try {
            $stmt = $this->db->prepare("SELECT c.*, d.drum_no FROM cable c 
                                        JOIN drum d ON c.drum_id = d.drum_id 
                                        WHERE c.cable_id = :cable_id");
            $stmt->execute([':cable_id' => $cable_id]);
            $cable = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($cable) {
                $this->jsonResponse(true, 'Cable details fetched successfully', $cable);
            } else {
                $this->jsonResponse(false, 'Cable not found');
            }
        } catch (PDOException $e) {
            $this->logError($e);
            $this->jsonResponse(false, 'Error fetching cable details', null, 500);
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

        $data = [
            'companies' => $companies,
            'manufacturers' => $manufacturers
        ];

        $pageTitle = 'เพิ่มงานสต๊อกเคเบิ้ล - PSNK TELECOM';
        $this->render('stock_cable/create', ['pageTitle' => $pageTitle, 'data' => $data]);
    }

    private function createCable()
    {
        try {
            $this->db->beginTransaction();

            $cableData = $this->validateCableData($_POST);
            $cable_used = $cableData['cable_form'] - $cableData['cable_to'];

            $this->checkTotalCable($cableData['drum_id'], $cable_used);

            $stmt = $this->db->prepare("INSERT INTO cable (route_name, installed_section, placing_team, cable_form, cable_to, cable_used, drum_id, cable_work, employee_id)
                VALUES (:route_name, :installed_section, :placing_team, :cable_form, :cable_to, :cable_used, :drum_id, :cable_work, :employee_id)");

            $stmt->execute([
                ':route_name' => $cableData['route'],
                ':installed_section' => $cableData['section'],
                ':placing_team' => $cableData['team'],
                ':cable_form' => $cableData['cable_form'],
                ':cable_to' => $cableData['cable_to'],
                ':cable_used' => $cable_used,
                ':drum_id' => $cableData['drum_id'],
                ':cable_work' => $cableData['cable_work'],
                ':employee_id' => $_SESSION['employee_id']
            ]);

            $cable_id = $this->db->lastInsertId();

            $this->updateDrumUsage($cableData['drum_id']);

            $this->logAction('Cable Inserted', "Cable ID: $cable_id, Route: {$cableData['route']}, Section: {$cableData['section']}, Used: $cable_used");

            $this->db->commit();
            $this->jsonResponse(true, 'เพิ่มข้อมูล Cable สำเร็จ');
        } catch (Exception $e) {
            $this->db->rollBack();
            $this->jsonResponse(false, 'เกิดข้อผิดพลาด: ' . $e->getMessage(), null, 400);
        }
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->updateCable();
        } else {
            $this->jsonResponse(false, 'Invalid request method');
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
                throw new Exception('จำนวนสายเคเบิลทั้งหมดเกิน 4000');
            }

            $stmt = $this->db->prepare("UPDATE cable SET 
                route_name = :route_name, 
                installed_section = :installed_section, 
                placing_team = :placing_team, 
                cable_form = :cable_form, 
                cable_to = :cable_to, 
                cable_used = :cable_used, 
                drum_id = :drum_id, 
                cable_work = :cable_work 
                WHERE cable_id = :cable_id");

            $stmt->execute([
                ':route_name' => $cableData['route'],
                ':installed_section' => $cableData['section'],
                ':placing_team' => $cableData['team'],
                ':cable_form' => $cableData['cable_form'],
                ':cable_to' => $cableData['cable_to'],
                ':cable_used' => $new_cable_used,
                ':drum_id' => $cableData['drum_id'],
                ':cable_work' => $cableData['cable_work'],
                ':cable_id' => $cable_id
            ]);

            $this->updateDrumUsage($cableData['drum_id']);

            $this->logAction('Cable Updated', "Cable ID: $cable_id, Route: {$cableData['route']}, Section: {$cableData['section']}, Used: $new_cable_used");

            $this->db->commit();
            $this->jsonResponse(true, 'อัปเดตข้อมูล Cable สำเร็จ');
        } catch (Exception $e) {
            $this->db->rollBack();
            $this->jsonResponse(false, 'อัปเดตข้อมูลไม่สำเร็จ: ' . $e->getMessage(), null, 400);
        }
    }

    public function delete()
    {
        if (!isset($_POST['cable_id'])) {
            $this->jsonResponse(false, 'Cable ID not provided');
            return;
        }

        $cable_id = $_POST['cable_id'];

        try {
            $this->db->beginTransaction();

            $cableData = $this->fetchCableData($cable_id);

            $this->logAction('Cable Deleted', "Cable ID: $cable_id, Route: {$cableData['route_name']}, Section: {$cableData['installed_section']}, Used: {$cableData['cable_used']}");

            $stmt = $this->db->prepare("DELETE FROM cable WHERE cable_id = :cable_id");
            $stmt->execute([':cable_id' => $cable_id]);

            $this->updateAllDrumUsages();

            $this->db->commit();
            $this->jsonResponse(true, 'ลบข้อมูล Cable สำเร็จ');
        } catch (Exception $e) {
            $this->db->rollBack();
            $this->jsonResponse(false, 'ลบข้อมูลไม่สำเร็จ', null, 400);
        }
    }

    private function validateCableData($data)
    {
        // Implement validation logic here
        // This is a basic example, you should add more comprehensive validation
        $required = ['route', 'section', 'team', 'cable_form', 'cable_to', 'cable_work', 'drum_id'];
        foreach ($required as $field) {
            if (!isset($data[$field]) || empty($data[$field])) {
                throw new Exception("Field $field is required");
            }
        }

        if ($data['cable_form'] <= $data['cable_to']) {
            throw new Exception("Cable From must be greater than Cable To");
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
            throw new Exception('จำนวนสายเคเบิลทั้งหมดเกิน 4000 เมตร');
        }
    }

    private function updateDrumUsage($drum_id)
    {
        $stmt = $this->db->prepare('SELECT SUM(cable_used) as total_cable FROM cable WHERE drum_id = :drum_id');
        $stmt->execute([':drum_id' => $drum_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $total_cable = $result['total_cable'];

        $sql = "UPDATE drum SET drum_used = :total_cable, drum_remaining = drum_full - :total_cable WHERE drum_id = :drum_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':total_cable' => $total_cable,
            ':drum_id' => $drum_id
        ]);
    }

    private function fetchCableData($cable_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM cable WHERE cable_id = :cable_id");
        $stmt->execute([':cable_id' => $cable_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    private function calculateTotalCable($drum_id, $old_cable_used, $new_cable_used)
    {
        $stmt = $this->db->prepare('SELECT SUM(cable_used) as total_cable FROM cable WHERE drum_id = :drum_id');
        $stmt->execute([':drum_id' => $drum_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return ($result['total_cable'] - $old_cable_used) + $new_cable_used;
    }

    private function updateAllDrumUsages()
    {
        $strsql = 'SELECT d.drum_id, COALESCE(SUM(c.cable_used), 0) as total_cable 
                   FROM drum d 
                   LEFT JOIN cable c ON d.drum_id = c.drum_id 
                   GROUP BY d.drum_id';
        $stmt = $this->db->prepare($strsql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $row) {
            $this->updateDrumUsage($row['drum_id']);
        }
    }

    private function getCompanies()
    {
        return [
            'Mixed' => 'Mixed',
            'FIBERHOME' => 'FIBERHOME',
            'FBH' => 'FBH',
            'CCS' => 'CCS',
            'W&W' => 'W&W',
            'TKI' => 'TKI',
            'MTE' => 'MTE',
            'Poonsub' => 'Poonsub'
        ];
    }

    private function getManufacturers()
    {
        return [
            'FUTONG' => 'FUTONG',
            'FIBERHOME' => 'FIBERHOME',
            'TICC' => 'TICC',
            'TUC' => 'TUC'
        ];
    }

    public function fetchDrums()
    {
        if (!isset($_POST['manufacturer']) || !isset($_POST['company'])) {
            $this->jsonResponse(false, 'Manufacturer and company are required');
            return;
        }

        $manufacturer = $_POST['manufacturer'];
        $company = $_POST['company'];

        try {
            $stmt = $this->db->prepare("SELECT * FROM drum WHERE drum_cable_company = :manufacturer AND drum_company = :company AND drum_remaining > 0");
            $stmt->execute([':manufacturer' => $manufacturer, ':company' => $company]);
            $drums = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $options = '<option value="">เลือก Drum</option>';
            foreach ($drums as $drum) {
                $options .= "<option value='{$drum['drum_id']}'>{$drum['drum_no']}</option>";
            }

            $this->jsonResponse(true, 'Drums fetched successfully', ['options' => $options]);
        } catch (PDOException $e) {
            $this->jsonResponse(false, 'Error fetching drums', null, 500);
        }
    }
}
