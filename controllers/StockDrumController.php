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
                echo json_encode(['success' => true, 'message' => 'อัปเดตเรียบร้อยแล้ว Drum']);
            } catch (PDOException $e) {
                echo json_encode(['success' => false, 'message' => 'เกิดข้อผิดพลาดในการอัปเดต Drum: ' . $e->getMessage()]);
            }
        }
    }

    public function deleteDrum()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $drum_id = $_POST['drum_id'];
            try {
                $stmt = $this->db->prepare("DELETE FROM drum WHERE drum_id = :drum_id");
                $stmt->execute([':drum_id' => $drum_id]);
                echo json_encode(['success' => true, 'message' => 'ลบ Drum สำเร็จแล้ว']);
            } catch (PDOException $e) {
                echo json_encode(['success' => false, 'message' => 'เกิดข้อผิดพลาดในการลบ Drum: ' . $e->getMessage()]);
            }
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
                    echo json_encode(['success' => true, 'drum' => $drum]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'ไม่พบ Drum']);
                }
            } catch (PDOException $e) {
                echo json_encode(['success' => false, 'message' => 'เกิดข้อผิดพลาดในการเรียกรายละเอียด Drum: ' . $e->getMessage()]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'คำขอไม่ถูกต้อง']);
        }
    }
}
