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
        $requiredFields = ['edit-au', 'edit-detail', 'edit-type', 'edit-price', 'edit-company', 'original-au-id'];
        foreach ($requiredFields as $field) {
            if (!isset($_POST[$field]) || empty($_POST[$field])) {
                $this->jsonResponse(false, "ไม่มีข้อมูล {$field}");
                return;
            }
        }

        $newAuId = $_POST['edit-au'];
        $originalAuId = $_POST['original-au-id'];
        $detail = $_POST['edit-detail'];
        $type = $_POST['edit-type'];
        $price = $_POST['edit-price'];
        $company = $_POST['edit-company'];

        try {
            $this->db->beginTransaction();

            // Check if the original AU ID exists
            $checkSql = "SELECT * FROM au_all WHERE au_id = :original_au_id";
            $checkStmt = $this->db->prepare($checkSql);
            $checkStmt->execute([':original_au_id' => $originalAuId]);

            if ($checkStmt->rowCount() === 0) {
                throw new Exception("ไม่พบ AU ID: {$originalAuId} ในระบบ");
            }

            $currentData = $checkStmt->fetch(PDO::FETCH_ASSOC);

            // Check if there are any changes
            if (
                $currentData['au_id'] === $newAuId &&
                $currentData['au_detail'] === $detail &&
                $currentData['au_type'] === $type &&
                $currentData['au_price'] == $price &&  // Using == for loose comparison (string vs float)
                $currentData['au_company'] === $company
            ) {
                $this->jsonResponse(true, 'ไม่มีการเปลี่ยนแปลงข้อมูล');
                return;
            }

            $sql = "UPDATE au_all SET au_id = :new_au_id, au_detail = :au_detail, au_type = :au_type, au_price = :au_price, au_company = :au_company WHERE au_id = :original_au_id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':new_au_id' => $newAuId,
                ':au_detail' => $detail,
                ':au_type' => $type,
                ':au_price' => $price,
                ':au_company' => $company,
                ':original_au_id' => $originalAuId
            ]);

            $this->db->commit();

            $logDetail = "Updated AU: {$originalAuId} to {$newAuId}, Detail: {$detail}, Type: {$type}, Price: {$price}, Company: {$company}";
            $this->logAction('AU Updated', $logDetail);

            $this->jsonResponse(true, 'อัปเดตข้อมูลสำเร็จ');
        } catch (PDOException $e) {
            $this->jsonResponse(false, 'เกิดข้อผิดพลาดในการอัปเดตข้อมูล: ' . $e->getMessage());
        } catch (Exception $e) {
            $this->jsonResponse(false, 'เกิดข้อผิดพลาด: ' . $e->getMessage());
        }
    }
}
