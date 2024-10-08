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
                    // Log the successful update
                    $logDetail = "AU ID: $auId, Name: $auName, Type: $auType, Price: $auPrice, Company: $auCompany";
                    $this->logAction('AU Updated', $logDetail);

                    echo json_encode(['success' => true, 'message' => 'AU updated successfully.']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Failed to update AU.']);
                }
            } catch (PDOException $e) {
                // Log the error
                $this->logAction('AU Update Error', $e->getMessage());

                echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
        }
    }

    public function deleteAu()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auId = $_POST['au_id'];
            $auName = $_POST['au_name'];

            try {
                $sql = "DELETE FROM au_all WHERE au_id = :au_id";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':au_id', $auId, PDO::PARAM_INT);

                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    // Log the successful deletion
                    $logDetail = "ID: $auId AU: $auName ";
                    $this->logAction('AU Deleted', $logDetail);

                    $this->successResponse();
                } else {
                    echo json_encode(['success' => false, 'message' => 'Failed to delete AU. AU not found.']);
                }
            } catch (PDOException $e) {
                // Check if the error is due to a foreign key constraint
                if ($e->getCode() == '23000') {
                    echo json_encode(['success' => false, 'message' => 'มีการเรียกใช้ AU นี้อยู่ ไม่สามารถลบได้']);
                } else {
                    // Log the error
                    $this->logAction('AU Delete Error', $e->getMessage());
                    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
                }
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
        }
    }
}
