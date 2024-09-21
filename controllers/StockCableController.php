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
            error_log("Error fetching cables: " . $e->getMessage());
            return [];
        }
    }

    public function updateCable()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $this->db->beginTransaction();

                $cable_id = $_POST['cable_id'];
                $route = $_POST['route'];
                $section = $_POST['section'];
                $team = $_POST['team'];
                $cable_form = $_POST['cable_form'];
                $cable_to = $_POST['cable_to'];
                $cable_work = $_POST['cable_work'];
                $drum_id = $_POST['drum_id'];
                $new_cable_used = $cable_form - $cable_to;

                $strsql2 = 'SELECT cable_used FROM cable WHERE cable_id = :cable_id';
                $stmt = $this->db->prepare($strsql2);
                $stmt->bindParam(':cable_id', $cable_id, PDO::PARAM_INT);
                $stmt->execute();
                $result2 = $stmt->fetch(PDO::FETCH_ASSOC);
                $old_cable_used = $result2['cable_used'];

                $strsql = 'SELECT SUM(cable_used) as total_cable FROM cable WHERE drum_id = :drum_id';
                $stmt = $this->db->prepare($strsql);
                $stmt->bindParam(':drum_id', $drum_id, PDO::PARAM_INT);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                $total_cable = ($result['total_cable'] - $old_cable_used) + $new_cable_used;

                if ($total_cable > 4000) {
                    $this->db->rollBack();
                    http_response_code(400);
                    echo json_encode(['success' => false, 'message' => 'จำนวนสายเคเบิลทั้งหมดเกิน 4000']);
                    exit();
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

                $stmt->bindParam(':route_name', $route);
                $stmt->bindParam(':installed_section', $section);
                $stmt->bindParam(':placing_team', $team);
                $stmt->bindParam(':cable_form', $cable_form);
                $stmt->bindParam(':cable_to', $cable_to);
                $stmt->bindParam(':cable_used', $new_cable_used);
                $stmt->bindParam(':drum_id', $drum_id);
                $stmt->bindParam(':cable_work', $cable_work);
                $stmt->bindParam(':cable_id', $cable_id);

                $stmt->execute();

                $sql = "UPDATE drum SET drum_used=:total_cable, drum_remaining=drum_full-:total_cable WHERE drum_id=:drum_id";
                $stmt2 = $this->db->prepare($sql);
                $stmt2->bindParam(':total_cable', $total_cable, PDO::PARAM_INT);
                $stmt2->bindParam(':drum_id', $drum_id, PDO::PARAM_INT);
                $stmt2->execute();

                $stmtLog = $this->db->prepare("INSERT INTO log (log_status, log_detail, user_id) VALUES (:log_status, :log_detail, :user_id)");
                $logStatus = 'Cable Updated';
                $logDetail = 'Cable ID: ' . $cable_id . ', Route: ' . $route . ', Section: ' . $section . ', Used: ' . $new_cable_used;
                $user_id = $_SESSION['user_id'];
                $stmtLog->bindParam(':log_status', $logStatus);
                $stmtLog->bindParam(':log_detail', $logDetail);
                $stmtLog->bindParam(':user_id', $user_id);
                $stmtLog->execute();

                $this->db->commit();
                echo json_encode(['success' => true]);
                exit();
            } catch (PDOException $e) {
                $this->db->rollBack();
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => 'อัปเดตข้อมูลไม่สำเร็จ']);
                exit();
            }
        }
    }

    public function deleteCable()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cable_id = $_POST['cable_id'];
            try {
                $stmt = $this->db->prepare("DELETE FROM cable WHERE cable_id = :cable_id");
                $stmt->bindParam(':cable_id', $cable_id);
                $stmt->execute();
                echo json_encode(['success' => true, 'message' => 'Cable deleted successfully']);
            } catch (PDOException $e) {
                error_log("Error deleting cable: " . $e->getMessage());
                echo json_encode(['success' => false, 'message' => 'Error deleting cable']);
            }
        }
    }

    public function fetchDrums()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $manufacturer = $_POST['manufacturer'];
            $company = $_POST['company'];
            // Implement logic to fetch drums based on manufacturer and company
            // Return HTML options for the select element
        }
    }
}
