<?php
require_once __DIR__ . '/BaseController.php';

class StockDrumController extends BaseController
{
    public function index()
    {
        $drums = $this->fetchDrums();
        $data = [
            'drums' => $drums
        ];

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

    public function showCreateForm()
    {
        $pageTitle = 'เพิ่มงานสต๊อกเคเบิ้ล - PSNK TELECOM';
        $this->render('stock_drum/create', ['pageTitle' => $pageTitle]);
    }

    public function createDrum()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            try {
                $drum_no = $_POST['drum_no'];
                $drum_to = $_POST['drum_to'];
                $drum_description = $_POST['drum_description'];
                $drum_full = $_POST['drum_full'];
                $drum_company = $_POST['drum_company'];
                $drum_cable_company = $_POST['drum_cable_company'];
                $employee_id = $_SESSION['employee_id'];

                $strsql = "SELECT * FROM drum WHERE drum_no = :drum_no AND drum_company = :drum_company AND drum_cable_company = :drum_cable_company";
                $checkDupStmt = $this->db->prepare($strsql);
                $checkDupStmt->bindParam(':drum_no', $drum_no);
                $checkDupStmt->bindParam(':drum_company', $drum_company);
                $checkDupStmt->bindParam(':drum_cable_company', $drum_cable_company);
                $checkDupStmt->execute();
                $dupResult = $checkDupStmt->fetch(PDO::FETCH_ASSOC);

                if ($drum_full > 4000 && $dupResult) {
                    $this->jsonResponse(false, 'จำนวน Drum มีมากกว่า 4000 เมตร และมีข้อมูล Drum อยู่แล้วกรุณาตรวจสอบข้อมูลใหม่');
                }

                if ($drum_full > 4000) {
                    $this->jsonResponse(false, 'จำนวน Drum มีมากกว่า 4000 เมตร');
                }

                if ($dupResult) {
                    $this->jsonResponse(false, 'มีข้อมูล Drum อยู่แล้วกรุณาตรวจสอบข้อมูลใหม่');
                }

                $this->db->beginTransaction();

                $stmt = $this->db->prepare("INSERT INTO drum (drum_no, drum_to, drum_description, drum_full, drum_remaining, drum_company, drum_cable_company, employee_id)
            VALUES (:drum_no, :drum_to, :drum_description, :drum_full, :drum_remaining, :drum_company, :drum_cable_company, :employee_id)");

                $stmt->bindParam(':drum_no', $drum_no);
                $stmt->bindParam(':drum_to', $drum_to);
                $stmt->bindParam(':drum_description', $drum_description);
                $stmt->bindParam(':drum_full', $drum_full);
                $stmt->bindParam(':drum_remaining', $drum_full);
                $stmt->bindParam(':drum_company', $drum_company);
                $stmt->bindParam(':drum_cable_company', $drum_cable_company);
                $stmt->bindParam(':employee_id', $employee_id);

                $result = $stmt->execute();
                $drum_id = $this->db->lastInsertId();

                if ($result) {
                    $stmtLog = $this->db->prepare("INSERT INTO log (log_status, log_detail, user_id) VALUES (:log_status, :log_detail, :user_id)");
                    $logStatus = 'Drum Inserted';
                    $logDetail = 'Drum ID: ' . $drum_id . ', Drum No: ' . $drum_no . ', Company: ' . $drum_company . ', Cable Company: ' . $drum_cable_company;
                    $user_id = $_SESSION['user_id'];
                    $stmtLog->bindParam(':log_status', $logStatus);
                    $stmtLog->bindParam(':log_detail', $logDetail);
                    $stmtLog->bindParam(':user_id', $user_id);
                    $stmtLog->execute();

                    $this->db->commit();
                    $this->successResponse();
                } else {
                    $this->jsonResponse(false, 'เพิ่มข้อมูล Drum ไม่สำเร็จ!');
                }
            } catch (PDOException) {
                $this->errorResponse();
            }
        }
    }

    private function fetchDrums()
    {
        $strsql = "SELECT * FROM drum ORDER BY drum_date ASC";
        try {
            $stmt = $this->db->prepare($strsql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("เกิดข้อผิดพลาดในการดึงข้อมูล Drum: " . $e->getMessage());
            return [];
        }
    }

    public function updateDrum()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $drum_id = $_POST['edit_drum_id'];
            $drum_no = $_POST['edit_drum_no'];
            $drum_to = $_POST['edit_drum_to'];
            $drum_description = $_POST['edit_drum_description'];
            $drum_company = $_POST['edit_drum_company'];
            $drum_cable_company = $_POST['edit_drum_cable_company'];
            $drum_full = $_POST['edit_drum_full'];

            $checkDupSQL = "SELECT * FROM drum WHERE drum_no = :drum_no AND drum_company = :drum_company AND drum_cable_company = :drum_cable_company AND drum_id != :drum_id";
            $checkDupStmt = $this->db->prepare($checkDupSQL);
            $checkDupStmt->bindParam(':drum_no', $drum_no);
            $checkDupStmt->bindParam(':drum_company', $drum_company);
            $checkDupStmt->bindParam(':drum_cable_company', $drum_cable_company);
            $checkDupStmt->execute();
            $dupResult = $checkDupStmt->fetch(PDO::FETCH_ASSOC);

            if ($drum_full > 4000 && $dupResult) {
                $this->jsonResponse(false, 'จำนวน Drum มีมากกว่า 4000 เมตร และมีข้อมูล Drum อยู่แล้วกรุณาตรวจสอบข้อมูลใหม่');
            }

            if ($dupResult) {
                $this->jsonResponse(false, 'มีข้อมูล drum อยู่แล้วกรุณาเลือกใหม่');
            }

            if ($drum_full > 4000) {
                $this->jsonResponse(false, "จำนวน Drum มีมากกว่า 4000 เมตร");
            }

            try {
                $stmt = $this->db->prepare("UPDATE drum SET drum_no = :drum_no, drum_to = :drum_to, drum_description = :drum_description, drum_company = :drum_company, drum_cable_company = :drum_cable_company, drum_full = :drum_full WHERE drum_id = :drum_id");
                $stmt->execute([
                    ':drum_no' => $drum_no,
                    ':drum_to' => $drum_to,
                    ':drum_description' => $drum_description,
                    ':drum_company' => $drum_company,
                    ':drum_cable_company' => $drum_cable_company,
                    ':drum_full' => $drum_full,
                    ':drum_id' => $drum_id
                ]);
                $this->successResponse();
            } catch (PDOException) {
                $this->errorResponse();
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
                $stmtCheck = $this->db->prepare("SELECT drum_used, drum_no, drum_company, drum_cable_company FROM drum WHERE drum_id = :drum_id");
                $stmtCheck->bindParam(':drum_id', $drum_id);
                $stmtCheck->execute();
                $result = $stmtCheck->fetch(PDO::FETCH_ASSOC);
                if ($result && $result['drum_used'] == 0) {
                    $stmt = $this->db->prepare("DELETE FROM drum WHERE drum_id = :drum_id");
                    $stmt->execute([':drum_id' => $drum_id]);
                    $this->successResponse();
                } else {
                    $this->jsonResponse(false, 'ไม่สามารถลบข้อมูล Drum ได้ มีการเรียกใช้เคเบิลอยู่!');
                }
            } catch (PDOException) {
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
                $stmt = $this->db->prepare("SELECT * FROM drum WHERE drum_id = :drum_id");
                $stmt->execute([':drum_id' => $drum_id]);
                $drum = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($drum) {
                    $this->successResponse('Ok', $drum);
                } else {
                    $this->jsonResponse(false, "ไม่พบ Drum");
                }
            } catch (PDOException) {
                $this->errorResponse();
            }
        } else {
            $this->jsonResponse(false, "ข้อมูลไม่ถูกส่งไป");
        }
    }
}
