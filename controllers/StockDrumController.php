<?php
require_once __DIR__ . '/BaseController.php';

class StockDrumController extends BaseController
{
    public function index()
    {
        $data = $this->fetchDrums();

        $pageTitle = 'สต๊อกดั้ม - PSNK TELECOM';
        $this->render('stock_drum/index', ['pageTitle' => $pageTitle, 'data' => $data]);
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->createDrum();
        } else {
            $this->showCreateForm();
        }
    }

    private function fetchDrums()
    {
        $query = "SELECT d.*, 
                     dcc.drum_cable_company_detail,
                     dc.drum_company_detail
              FROM drum d
              LEFT JOIN drum_cable_company dcc ON d.drum_cable_company_id = dcc.drum_cable_company_id
              LEFT JOIN drum_company dc ON d.drum_company_id = dc.drum_company_id
              ORDER BY d.drum_date ASC";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $this->logAction('Fetch Drums Failed', $e->getMessage());
            return [];
        }
    }

    public function showCreateForm()
    {
        $drum_companies = $this->fetchDrumCompanies();
        $drum_cable_companies = $this->fetchDrumCableCompanies();

        $pageTitle = 'เพิ่มงานสต๊อกเคเบิ้ล - PSNK TELECOM';
        $this->render('stock_drum/create', [
            'pageTitle' => $pageTitle,
            'drum_companies' => $drum_companies,
            'drum_cable_companies' => $drum_cable_companies
        ]);
    }

    private function fetchDrumCompanies()
    {
        $query = "SELECT drum_company_id, drum_company_detail FROM drum_company ORDER BY drum_company_detail ASC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private function fetchDrumCableCompanies()
    {
        $query = "SELECT drum_cable_company_id, drum_cable_company_detail FROM drum_cable_company ORDER BY drum_cable_company_detail ASC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createDrum()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $transactionStarted = false;
            try {
                $drum_no = $_POST['drum_no'];
                $drum_to = $_POST['drum_to'];
                $drum_description = $_POST['drum_description'];
                $drum_full = $_POST['drum_full'];
                $drum_company_id = $_POST['drum_company'];
                $drum_cable_company_id = $_POST['drum_cable_company'];
                $employee_id = $_SESSION['employee_id'];

                // Validation
                if (empty($drum_no) || empty($drum_to) || empty($drum_description) || empty($drum_full) || empty($drum_company_id) || empty($drum_cable_company_id)) {
                    throw new Exception("กรุณากรอกข้อมูลให้ครบทุกช่อง");
                }

                $strsql = "SELECT * FROM drum WHERE drum_no = :drum_no AND drum_company_id = :drum_company_id AND drum_cable_company_id = :drum_cable_company_id";
                $checkDupStmt = $this->db->prepare($strsql);
                $checkDupStmt->bindParam(':drum_no', $drum_no);
                $checkDupStmt->bindParam(':drum_company_id', $drum_company_id);
                $checkDupStmt->bindParam(':drum_cable_company_id', $drum_cable_company_id);
                $checkDupStmt->execute();
                $dupResult = $checkDupStmt->fetch(PDO::FETCH_ASSOC);

                if ($drum_full > 4000 && $dupResult) {
                    throw new Exception('จำนวน Drum มีมากกว่า 4000 เมตร และมีข้อมูล Drum อยู่แล้วกรุณาตรวจสอบข้อมูลใหม่');
                }

                if ($drum_full > 4000) {
                    throw new Exception('จำนวน Drum มีมากกว่า 4000 เมตร');
                }

                if ($dupResult) {
                    throw new Exception('มีข้อมูล Drum อยู่แล้วกรุณาตรวจสอบข้อมูลใหม่');
                }

                $this->db->beginTransaction();
                $transactionStarted = true;

                $stmt = $this->db->prepare("INSERT INTO drum (drum_no, drum_to, drum_description, drum_full, drum_remaining, drum_company_id, drum_cable_company_id, employee_id) VALUES (:drum_no, :drum_to, :drum_description, :drum_full, :drum_remaining, :drum_company_id, :drum_cable_company_id, :employee_id)");

                $stmt->bindParam(':drum_no', $drum_no);
                $stmt->bindParam(':drum_to', $drum_to);
                $stmt->bindParam(':drum_description', $drum_description);
                $stmt->bindParam(':drum_full', $drum_full);
                $stmt->bindParam(':drum_remaining', $drum_full);
                $stmt->bindParam(':drum_company_id', $drum_company_id);
                $stmt->bindParam(':drum_cable_company_id', $drum_cable_company_id);
                $stmt->bindParam(':employee_id', $employee_id);

                $result = $stmt->execute();
                $drum_id = $this->db->lastInsertId();

                if ($result) {
                    $logDetail = "Drum ID: $drum_id, Drum No: $drum_no, Company: $drum_company_id, Cable Company: $drum_cable_company_id";
                    $this->logAction('Drum Created', $logDetail);

                    $this->db->commit();
                    $this->jsonResponse(true, 'เพิ่มข้อมูล Drum สำเร็จ');
                } else {
                    throw new Exception('เพิ่มข้อมูล Drum ไม่สำเร็จ!');
                }
            } catch (Exception $e) {
                if ($transactionStarted) {
                    $this->db->rollBack();
                }
                $this->logAction('Drum Creation Failed', $e->getMessage());
                $this->jsonResponse(false, $e->getMessage());
            }
        } else {
            $this->jsonResponse(false, 'Invalid request method');
        }
    }

    public function updateDrum()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $drum_id = $_POST['edit_drum_id'];
            $drum_no = $_POST['edit_drum_no'];
            $drum_to = $_POST['edit_drum_to'];
            $drum_description = $_POST['edit_drum_description'];
            $drum_company_id = $_POST['edit_drum_company'];
            $drum_cable_company_id = $_POST['edit_drum_cable_company'];
            $drum_full = $_POST['edit_drum_full'];

            $checkDupSQL = "SELECT * FROM drum WHERE drum_no = :drum_no AND drum_company_id = :drum_company_id AND drum_cable_company_id = :drum_cable_company_id AND drum_id != :drum_id";
            $checkDupStmt = $this->db->prepare($checkDupSQL);
            $checkDupStmt->bindParam(':drum_id', $drum_id);
            $checkDupStmt->bindParam(':drum_no', $drum_no);
            $checkDupStmt->bindParam(':drum_company_id', $drum_company_id);
            $checkDupStmt->bindParam(':drum_cable_company_id', $drum_cable_company_id);
            $checkDupStmt->execute();
            $dupResult = $checkDupStmt->fetch(PDO::FETCH_ASSOC);

            if ($dupResult) {
                $this->logAction('Drum Update Failed', "มีข้อมูล drum อยู่แล้ว");
                $this->jsonResponse(false, 'มีข้อมูล drum อยู่แล้วกรุณาเลือกใหม่');
                return;
            }

            try {
                $stmt = $this->db->prepare("SELECT drum_used, drum_full FROM drum WHERE drum_id = :drum_id");
                $stmt->execute([':drum_id' => $drum_id]);
                $currentDrum = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($currentDrum['drum_used'] > 0) {
                    // Drum is in use, don't update drum_full and drum_remaining
                    $stmt = $this->db->prepare("UPDATE drum SET 
                        drum_no = :drum_no, 
                        drum_to = :drum_to, 
                        drum_description = :drum_description, 
                        drum_company_id = :drum_company_id, 
                        drum_cable_company_id = :drum_cable_company_id
                        WHERE drum_id = :drum_id");

                    $params = [
                        ':drum_no' => $drum_no,
                        ':drum_to' => $drum_to,
                        ':drum_description' => $drum_description,
                        ':drum_company_id' => $drum_company_id,
                        ':drum_cable_company_id' => $drum_cable_company_id,
                        ':drum_id' => $drum_id
                    ];
                } else {
                    // Drum is not in use, update all fields including drum_full and drum_remaining
                    if (empty($drum_full) || $drum_full > 4000) {
                        $this->logAction('Drum Update Failed', "Invalid drum_full value: $drum_full");
                        $this->jsonResponse(false, "จำนวน Drum ไม่ถูกต้อง กรุณาระบุค่าระหว่าง 1 ถึง 4000 เมตร");
                        return;
                    }

                    $stmt = $this->db->prepare("UPDATE drum SET 
                        drum_no = :drum_no, 
                        drum_to = :drum_to, 
                        drum_description = :drum_description, 
                        drum_company_id = :drum_company_id, 
                        drum_cable_company_id = :drum_cable_company_id, 
                        drum_full = :drum_full,
                        drum_remaining = :drum_remaining
                        WHERE drum_id = :drum_id");

                    $params = [
                        ':drum_no' => $drum_no,
                        ':drum_to' => $drum_to,
                        ':drum_description' => $drum_description,
                        ':drum_company_id' => $drum_company_id,
                        ':drum_cable_company_id' => $drum_cable_company_id,
                        ':drum_full' => $drum_full,
                        ':drum_remaining' => $drum_full,
                        ':drum_id' => $drum_id
                    ];
                }

                $stmt->execute($params);

                $logDetail = "Drum ID: $drum_id, Drum No: $drum_no, Company: $drum_company_id, Cable Company: $drum_cable_company_id";
                $this->logAction('Drum Updated', $logDetail);

                $this->jsonResponse(true, 'อัปเดตข้อมูล Drum สำเร็จ');
            } catch (PDOException $e) {
                $this->logAction('Drum Update Failed', $e->getMessage());
                $this->jsonResponse(false, 'เกิดข้อผิดพลาดในการอัปเดตข้อมูล: ' . $e->getMessage());
            }
        } else {
            $this->jsonResponse(false, "ข้อมูลไม่ถูกส่งไป");
        }
    }
    public function deleteDrum()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $drum_id = $_POST['drum_id'];
            try {
                $stmtCheck = $this->db->prepare("SELECT * FROM drum WHERE drum_id = :drum_id");
                $stmtCheck->bindParam(':drum_id', $drum_id);
                $stmtCheck->execute();
                $result = $stmtCheck->fetch(PDO::FETCH_ASSOC);
                if ($result && $result['drum_used'] == 0) {
                    $stmt = $this->db->prepare("DELETE FROM drum WHERE drum_id = :drum_id");
                    $stmt->execute([':drum_id' => $drum_id]);
                    $this->logAction('Drum Deleted', "Drum ID: $drum_id, Drum No: " . $result['drum_no'] . ", Company: " . $result['drum_company_id'] . ", Cable Company: " . $result['drum_cable_company_id']);
                    $this->successResponse();
                } else {
                    $this->logAction('Drum Deletion Failed', "Drum ID: $drum_id - มีการเรียกใช้เคเบิลอยู่");
                    $this->jsonResponse(false, 'ไม่สามารถลบข้อมูล Drum ได้ มีการเรียกใช้เคเบิลอยู่!');
                }
            } catch (PDOException $e) {
                $this->logAction('Drum Deletion Failed', $e->getMessage());
                $this->errorResponse();
            }
        } else {
            $this->jsonResponse(false, "ข้อมูลไม่ถูกส่งไป");
        }
    }

    public function getDrumDetails()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['drum_id'])) {
            $drum_id = $_GET['drum_id'];
            try {
                $stmt = $this->db->prepare("SELECT d.*, 
                    dcc.drum_cable_company_detail,
                    dc.drum_company_detail
                    FROM drum d
                    LEFT JOIN drum_cable_company dcc ON d.drum_cable_company_id = dcc.drum_cable_company_id
                    LEFT JOIN drum_company dc ON d.drum_company_id = dc.drum_company_id
                    WHERE d.drum_id = :drum_id");
                $stmt->execute([':drum_id' => $drum_id]);
                $drum = $stmt->fetch(PDO::FETCH_ASSOC);

                $stmt_companies = $this->db->prepare("SELECT * FROM drum_company ORDER BY drum_company_detail ASC");
                $stmt_companies->execute();
                $all_companies = $stmt_companies->fetchAll(PDO::FETCH_ASSOC);

                $stmt_cable_companies = $this->db->prepare("SELECT * FROM drum_cable_company ORDER BY drum_cable_company_detail ASC");
                $stmt_cable_companies->execute();
                $all_cable_companies = $stmt_cable_companies->fetchAll(PDO::FETCH_ASSOC);

                if ($drum) {
                    $this->successResponse('Ok', [
                        'drum' => $drum,
                        'all_companies' => $all_companies,
                        'all_cable_companies' => $all_cable_companies
                    ]);
                } else {
                    $this->jsonResponse(false, "ไม่พบ Drum");
                }
            } catch (PDOException $e) {
                $this->errorResponse($e->getMessage());
            }
        } else {
            $this->jsonResponse(false, "ข้อมูลไม่ถูกส่งไป");
        }
    }
}
