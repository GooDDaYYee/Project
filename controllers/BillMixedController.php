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
            return [];
        }
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->create_post();
        } else {
            $this->create_get();
        }
    }

    private function create_get()
    {
        $newBillId = $this->generateNewBillId();
        $thaiDate = $this->getCurrentThaiDate();
        $auOptions = $this->getAuOptions();

        $data = [
            'pageTitle' => 'เพิ่มบิล Mixed - PSNK TELECOM',
            'newBillId' => $newBillId,
            'thaiDate' => $thaiDate,
            'auOptions' => $auOptions
        ];

        $this->render('bill_mixed/create', $data);
    }

    private function create_post()
    {
        try {
            if (!isset($_POST['inputField'])) {
                $this->jsonResponse(false, 'จำเป็นต้องเพิ่ม AU ก่อน');
            }
            $this->db->beginTransaction();

            $employeeId = $this->getEmployeeId($_SESSION['user_id']);
            $billId = $this->insertBill($employeeId);
            $this->insertBillDetails($billId);
            $this->updateBillTotals($billId);

            $this->db->commit();
            $this->jsonResponse(true, 'สร้างบิลสำเร็จแล้ว');
        } catch (PDOException $e) {
            $this->db->rollBack();
            $this->jsonResponse(false, 'ไม่สามารถสร้างบิลได้ กรุณาตรวจสอบข้อมูลของคุณ', null, 400);
        }
    }

    private function generateNewBillId()
    {
        $stmt = $this->db->prepare("SELECT bill_id FROM bill WHERE bill_company = 'mixed' ORDER BY bill_id DESC LIMIT 1");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $currentYear = (date('Y') + 543) % 100;
        $newNumber = 1;

        if ($result) {
            preg_match('/(\d{2})\/(\d+)$/', $result['bill_id'], $matches);
            $lastYear = $matches[1];
            $lastNumber = intval($matches[2]);

            if ($currentYear == $lastYear) {
                $newNumber = $lastNumber + 1;
            }
        }

        return sprintf("PSNK/MIXED/%02d/%03d", $currentYear, $newNumber);
    }

    private function getCurrentThaiDate()
    {
        date_default_timezone_set('Asia/Bangkok');
        return date("Y-m-d", strtotime("+543 year"));
    }

    private function getAuOptions()
    {
        $stmt = $this->db->prepare("SELECT * FROM au_all WHERE au_company = 'mixed'");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private function getEmployeeId($userId)
    {
        $stmt = $this->db->prepare("SELECT employee_id FROM users WHERE user_id = :user_id");
        $stmt->execute([':user_id' => $userId]);
        return $stmt->fetchColumn();
    }

    private function insertBill($employeeId)
    {
        $stmt = $this->db->prepare("INSERT INTO bill (bill_id, bill_date, bill_date_product, bill_payment, bill_due_date, bill_refer, bill_site, bill_pr, bill_work_no, bill_project, list_num, total_amount, vat, withholding, grand_total, bill_company, employee_id) 
        VALUES (:bill_id, :bill_date, :bill_date_product, :bill_payment, :bill_due_date, :bill_refer, :bill_site, :bill_pr, :bill_work_no, :bill_project, :list_num, :total_amount, :vat, :withholding, :grand_total, :bill_company, :employee_id)");

        $stmt->execute([
            ':bill_id' => $_POST['number'],
            ':bill_date' => $_POST['thai_date'],
            ':bill_date_product' => $_POST['thai_date_product'],
            ':bill_payment' => $_POST['payment'],
            ':bill_due_date' => $_POST['thai_due_date'],
            ':bill_refer' => $_POST['refer'],
            ':bill_site' => $_POST['Site'],
            ':bill_pr' => $_POST['pr'],
            ':bill_work_no' => $_POST['work_no'],
            ':bill_project' => $_POST['project'],
            ':list_num' => $_POST['auCount'],
            ':total_amount' => 0,
            ':vat' => 0,
            ':withholding' => 0,
            ':grand_total' => 0,
            ':bill_company' => $_POST['company'],
            ':employee_id' => $employeeId
        ]);

        return $_POST['number'];
    }

    private function insertBillDetails($billId)
    {
        $stmt = $this->db->prepare("INSERT INTO bill_detail (bill_id, au_id, unit, price) VALUES (:bill_id, :au_id, :unit, :price)");

        foreach ($_POST['inputField'] as $i => $auId) {
            $unit = $_POST['unit'][$i];
            $price = $this->calculateItemPrice($auId, $unit);

            $stmt->execute([
                ':bill_id' => $billId,
                ':au_id' => $auId,
                ':unit' => $unit,
                ':price' => $price
            ]);
        }
    }

    private function calculateItemPrice($auId, $unit)
    {
        $stmt = $this->db->prepare("SELECT au_price FROM au_all WHERE au_id = :au_id");
        $stmt->execute([':au_id' => $auId]);
        $auPrice = $stmt->fetchColumn();
        return $unit * $auPrice;
    }

    private function updateBillTotals($billId)
    {
        $total = $this->calculateBillTotal($billId);
        $vat = $total * 0.07;
        $withholding = $total * 0.03;
        $grandTotal = $total - $vat;

        $stmt = $this->db->prepare("UPDATE bill SET
            total_amount = :total_amount,
            vat = :vat,
            withholding = :withholding,
            grand_total = :grand_total
            WHERE bill_id = :bill_id");

        $stmt->execute([
            ':bill_id' => $billId,
            ':total_amount' => $total,
            ':vat' => $vat,
            ':withholding' => $withholding,
            ':grand_total' => $grandTotal
        ]);
        $this->logAction('Bill Created', "Bill ID: $billId, Total Amount: $total");
    }

    private function calculateBillTotal($billId)
    {
        $stmt = $this->db->prepare("SELECT SUM(price) FROM bill_detail WHERE bill_id = :bill_id");
        $stmt->execute([':bill_id' => $billId]);
        return $stmt->fetchColumn();
    }

    public function fetchBillDetails()
    {
        if (!isset($_POST['bill_id'])) {
            return $this->errorResponse('Bill ID not provided');
        }

        $billId = $_POST['bill_id'];
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

            $data = [
                'bill' => $bill,
                'details' => $details
            ];
            return $this->successResponse('OK', $data);
        } catch (PDOException $e) {
            return $this->errorResponse('Error ' . $e->getMessage(), null, 500);
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
        } catch (PDOException) {
            return [
                'au_detail' => 'error',
                'au_type' => 'error',
                'au_price' => 'error'
            ];
        }
    }

    public function fetchAUDetails2()
    {
        $auid = $_GET['au_id'];
        $query = "SELECT * FROM au_all WHERE au_id = :au_id";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':au_id', $auid, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                return $this->successResponse('OK', $row);
            } else {
                return $this->errorResponse('ไม่สามารถแสดง Detail ของ AU ได้');
            }
        } catch (PDOException $e) {
            return $this->errorResponse('ไม่สามารถแสดง Detail ของ AU ได้');
        }
    }

    public function updateBill()
    {
        if (!isset($_POST['bill_Id'])) {
            return $this->errorResponse('ไม่ได้ระบุรหัส Bill');
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
            return $this->successResponse();
        } catch (Exception $e) {
            $this->db->rollBack();
            return $this->errorResponse('Error ' . $e->getMessage(), null, 500);
        }
    }

    public function deleteBill()
    {
        if (!isset($_POST['bill_id'])) {
            return $this->errorResponse('ไม่ได้ระบุรหัส Bill');
        }

        $billId = $_POST['bill_id'];

        try {
            $this->db->beginTransaction();

            $stmt = $this->db->prepare("SELECT bill_company FROM bill WHERE bill_id = :bill_id");
            $stmt->execute([':bill_id' => $billId]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$result) {
                return $this->errorResponse('Bill not found', null, 500);
            }

            $this->db->prepare("DELETE FROM bill_detail WHERE bill_id = :bill_id")->execute([':bill_id' => $billId]);
            $this->db->prepare("DELETE FROM bill WHERE bill_id = :bill_id")->execute([':bill_id' => $billId]);

            $this->logAction('Bill Deleted', "Bill ID: $billId, Company: {$result['bill_company']}");

            $this->db->commit();
            return $this->successResponse();
        } catch (Exception $e) {
            $this->db->rollBack();
            return $this->errorResponse('Error ' . $e->getMessage(), null, 500);
        }
    }

    public function exportPDF()
    {
        $this->exPDF();
    }
}
