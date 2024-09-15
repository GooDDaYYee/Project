<?php
require_once __DIR__ . '/BaseController.php';

class BillMixedController extends BaseController
{
    public function index()
    {
        $bills = $this->fetchMixedBills();
        $auOptions = $this->fetchAUOptions();

        $data = [
            'bills' => $bills,
            'auOptions' => $auOptions
        ];

        $pageTitle = 'จัดการบิลบริษัท Mixed - PSNK TELECOM';
        $this->render('bill_mixed/index', ['pageTitle' => $pageTitle, 'data' => $data]);
    }

    private function fetchMixedBills()
    {
        $strsql = "SELECT * FROM bill WHERE bill_company = 'Mixed' ORDER BY bill_id DESC";
        try {
            $stmt = $this->db->prepare($strsql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error fetching mixed bills: " . $e->getMessage());
            return [];
        }
    }

    private function fetchAUOptions()
    {
        $strsql = "SELECT * FROM au_all WHERE au_company = 'Mixed'";
        try {
            $stmt = $this->db->prepare($strsql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error fetching AU options: " . $e->getMessage());
            return [];
        }
    }

    public function fetchBillDetails()
    {
        if (!isset($_GET['bill_id'])) {
            echo json_encode(['success' => false, 'message' => 'Bill ID not provided']);
            return;
        }

        $billId = $_GET['bill_id'];
        $strsql = "SELECT * FROM bill WHERE bill_id = :bill_id";
        try {
            $stmt = $this->db->prepare($strsql);
            $stmt->bindParam(':bill_id', $billId);
            $stmt->execute();
            $bill = $stmt->fetch(PDO::FETCH_ASSOC);

            $details_sql = "SELECT * FROM bill_detail WHERE bill_id = :bill_id";
            $details_stmt = $this->db->prepare($details_sql);
            $details_stmt->bindParam(':bill_id', $billId);
            $details_stmt->execute();
            $details = $details_stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($details as &$detail) {
                $auDetails = $this->fetchAUDetails($detail['au_id'], $bill['bill_company']);
                $detail = array_merge($detail, $auDetails);
            }

            echo json_encode([
                'success' => true,
                'bill' => $bill,
                'details' => $details
            ]);
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    private function fetchAUDetails($auId, $auCompany)
    {
        $query = "SELECT * FROM au_all WHERE au_id = :au_id AND au_company = :au_company";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':au_id', $auId, PDO::PARAM_STR);
            $stmt->bindParam(':au_company', $auCompany, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                return [
                    'au_detail' => $row['au_detail'],
                    'au_type' => $row['au_type'],
                    'au_price' => $row['au_price']
                ];
            } else {
                return [
                    'au_detail' => 'undefined',
                    'au_type' => 'undefined',
                    'au_price' => 'undefined'
                ];
            }
        } catch (PDOException $e) {
            error_log("Error fetching AU details: " . $e->getMessage());
            return [
                'au_detail' => 'error',
                'au_type' => 'error',
                'au_price' => 'error'
            ];
        }
    }

    public function createBill()
    {
        // Implement bill creation logic here
        // This method should handle POST data for creating a new bill
    }

    public function updateBill()
    {
        if (!isset($_POST['bill_Id'])) {
            echo json_encode(['success' => false, 'message' => 'Invalid request.']);
            return;
        }

        try {
            $this->db->beginTransaction();

            $billId = $_POST['bill_Id'];
            $total = 0;
            $vat = 0.07;
            $withholding = 0.03;

            $stmtUpdateBill = $this->db->prepare("UPDATE bill SET
                bill_date = :bill_date, bill_date_product = :bill_date_product,
                bill_payment = :bill_payment, bill_due_date = :bill_due_date,
                bill_refer = :bill_refer, bill_site = :bill_site,
                bill_pr = :bill_pr, bill_work_no = :bill_work_no,
                bill_project = :bill_project, list_num = :list_num,
                total_amount = :total_amount, vat = :vat,
                withholding = :withholding, grand_total = :grand_total
                WHERE bill_id = :bill_id");

            $stmtUpdateBill->bindParam(':bill_id', $billId);
            $stmtUpdateBill->bindParam(':bill_date', $_POST['thai_date']);
            $stmtUpdateBill->bindParam(':bill_date_product', $_POST['thai_date_product']);
            $stmtUpdateBill->bindParam(':bill_payment', $_POST['payment']);
            $stmtUpdateBill->bindParam(':bill_due_date', $_POST['thai_due_date']);
            $stmtUpdateBill->bindParam(':bill_refer', $_POST['refer']);
            $stmtUpdateBill->bindParam(':bill_site', $_POST['Site']);
            $stmtUpdateBill->bindParam(':bill_pr', $_POST['pr']);
            $stmtUpdateBill->bindParam(':bill_work_no', $_POST['work_no']);
            $stmtUpdateBill->bindParam(':bill_project', $_POST['project']);
            $stmtUpdateBill->bindParam(':list_num', $_POST['auCount']);

            $this->db->prepare("DELETE FROM bill_detail WHERE bill_id = :bill_id")->execute([':bill_id' => $billId]);

            $stmtInvoiceItem = $this->db->prepare("INSERT INTO bill_detail (bill_id, au_id, unit, price) VALUES (:bill_id, :au_id, :unit, :price)");

            foreach ($_POST['inputField'] as $i => $auId) {
                $stmtPrice = $this->db->prepare("SELECT au_price FROM au_all WHERE au_id = :au_id");
                $stmtPrice->execute([':au_id' => $auId]);
                $auPrice = $stmtPrice->fetchColumn();

                $unit = $_POST['unit'][$i];
                $price = $unit * $auPrice;

                $stmtInvoiceItem->execute([
                    ':bill_id' => $billId,
                    ':au_id' => $auId,
                    ':unit' => $unit,
                    ':price' => $price
                ]);

                $total += $price;
            }

            $totalVat = $total * $vat;
            $totalWithholding = $total * $withholding;
            $grand_total = $total - $totalVat;

            $stmtUpdateBill->bindParam(':total_amount', $total);
            $stmtUpdateBill->bindParam(':vat', $totalVat);
            $stmtUpdateBill->bindParam(':withholding', $totalWithholding);
            $stmtUpdateBill->bindParam(':grand_total', $grand_total);

            $stmtUpdateBill->execute();

            $this->logAction('Bill Updated', "Bill ID: $billId, Total Amount: $total");

            $this->db->commit();
            echo json_encode(['success' => true, 'message' => 'Bill updated successfully.']);
        } catch (Exception $e) {
            $this->db->rollBack();
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function deleteBill()
    {
        if (!isset($_POST['bill_id'])) {
            echo json_encode(['success' => false, 'message' => 'Invalid request.']);
            return;
        }

        $billId = $_POST['bill_id'];

        try {
            $this->db->beginTransaction();

            $stmt = $this->db->prepare("SELECT bill_company FROM bill WHERE bill_id = :bill_id");
            $stmt->execute([':bill_id' => $billId]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$result) {
                throw new Exception("Bill not found.");
            }

            $this->db->prepare("DELETE FROM bill_detail WHERE bill_id = :bill_id")->execute([':bill_id' => $billId]);
            $this->db->prepare("DELETE FROM bill WHERE bill_id = :bill_id")->execute([':bill_id' => $billId]);

            $this->logAction('Bill Deleted', "Bill ID: $billId, Company: {$result['bill_company']}");

            $this->db->commit();
            echo json_encode(['success' => true, 'message' => 'Bill deleted successfully.']);
        } catch (Exception $e) {
            $this->db->rollBack();
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}