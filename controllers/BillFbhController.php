<?php
require_once __DIR__ . '/BaseController.php';

class BillFbhController extends BaseController
{
    public function index()
    {
        $bills = $this->fetchFbhBills();
        $auOptions = $this->fetchAUOptions();

        $data = [
            'bills' => $bills,
            'auOptions' => $auOptions
        ];

        $pageTitle = 'จัดการบิลบริษัท FBH - PSNK TELECOM';
        $this->render('bill_fbh/index', ['pageTitle' => $pageTitle, 'data' => $data]);
    }

    private function fetchFbhBills()
    {
        $strsql = "SELECT * FROM bill WHERE bill_company = 'FBH' ORDER BY bill_id DESC";
        try {
            $stmt = $this->db->prepare($strsql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error fetching FBH bills: " . $e->getMessage());
            return [];
        }
    }

    private function fetchAUOptions()
    {
        $strsql = "SELECT * FROM au_all WHERE au_company = 'FBH'";
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

    public function updateBill()
    {
        // Implement update bill logic here
    }

    public function deleteBill()
    {
        // Implement delete bill logic here
    }

    // Helper method to format Thai date
    public function formatThaiDate($date)
    {
        $timestamp = strtotime($date);
        $thai_month = array(
            1 => "มกราคม", 2 => "กุมภาพันธ์", 3 => "มีนาคม",
            4 => "เมษายน", 5 => "พฤษภาคม", 6 => "มิถุนายน",
            7 => "กรกฎาคม", 8 => "สิงหาคม", 9 => "กันยายน",
            10 => "ตุลาคม", 11 => "พฤศจิกายน", 12 => "ธันวาคม"
        );
        $thai_month_num = date('n', $timestamp);
        return date('d', $timestamp) . ' ' . $thai_month[$thai_month_num] . ' ' . (date('Y', $timestamp) + 543);
    }
}