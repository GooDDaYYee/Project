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
            // Implement update logic here
            // Use $_POST data to update the cable in the database
            // Return JSON response
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