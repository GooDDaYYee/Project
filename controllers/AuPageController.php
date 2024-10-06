<?php
require_once __DIR__ . '/BaseController.php';

class AuPageController extends BaseController
{

    public function __construct()
    {
        parent::__construct();

        if ($_SESSION["lv"] != 0) {
            header("Location: index.php?page=home");
            exit();
        }
    }

    public function index()
    {
        $data = [
            'au_all' => $this->fetchAu(),
        ];

        $pageTitle = 'แก้ไข AU - PSNK TELECOM';
        $this->render('au_page/index', ['pageTitle' => $pageTitle, 'data' => $data]);
    }

    private function fetchAu()
    {
        $strsql = "SELECT * FROM au_all ORDER BY au_company ASC";
        try {
            $stmt = $this->db->prepare($strsql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    public function updateAu()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auId = $_POST['original-au-id'];
            $auName = $_POST['edit-au'];
            $auDetail = $_POST['edit-detail'];
            $auType = $_POST['edit-type'];
            $auPrice = $_POST['edit-price'];
            $auCompany = $_POST['edit-company'];


            // Validate price
            if (!is_numeric($auPrice) || $auPrice < 0) {
                echo json_encode(['success' => false, 'message' => 'Invalid price.']);
                return;
            }

            try {
                $sql = "UPDATE au_all SET au_name = :au_name, au_detail = :au_detail, au_type = :au_type, 
                    au_price = :au_price, au_company = :au_company WHERE au_id = :au_id";

                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':au_id', $auId, PDO::PARAM_INT);
                $stmt->bindParam(':au_name', $auName, PDO::PARAM_STR);
                $stmt->bindParam(':au_detail', $auDetail, PDO::PARAM_STR);
                $stmt->bindParam(':au_type', $auType, PDO::PARAM_STR);
                $stmt->bindParam(':au_price', $auPrice, PDO::PARAM_STR);
                $stmt->bindParam(':au_company', $auCompany, PDO::PARAM_STR);

                if ($stmt->execute()) {
                    echo json_encode(['success' => true, 'message' => 'AU updated successfully.']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Failed to update AU.']);
                }
            } catch (PDOException $e) {
                echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
        }
    }
}
