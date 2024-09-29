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
        // if (!isset($_POST['au_id']) || empty($_POST['au_id'])) {
        //     $this->errorResponse();
        // }

        $au = $_POST['edit-au'];
        $detail = $_POST['edit-detail'];
        $type = $_POST['edit-type'];
        $price = $_POST['edit-price'];
        $company = $_POST['edit-company'];

        try {
            $sql = "UPDATE au_all SET au_id = :au_id, au_detail = :au_detail, au_type = :au_type, au_price = :au_price, au_company = :au_company WHERE au_id = :au_id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':au_id' => $au,
                ':au_detail' => $detail,
                ':au_type' => $type,
                ':au_price' => $price,
                ':au_company' => $company
            ]);

            // $logDetail = "User ID: {$user_id}, Username: {$username}, Lv: {$lv}, Status: {$status}";
            // $this->logAction('User Updated', $logDetail);

            $this->successResponse();
        } catch (PDOException $e) {
            $this->errorResponse($e);
        }
    }
}
