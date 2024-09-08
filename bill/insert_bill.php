<?php
include("../connect.php");
session_start();
$user_id = $_SESSION['user_id'];

try {
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $con->beginTransaction();

    // Step 1: Retrieve employee_id
    $stmtEmployee = $con->prepare("SELECT employee_id FROM users WHERE user_id = :user_id");
    $stmtEmployee->bindParam(':user_id', $user_id);
    $stmtEmployee->execute();
    $employee_id = $stmtEmployee->fetchColumn();

    // Step 2: Insert into bill
    $stmtInvoice = $con->prepare("INSERT INTO bill (bill_id, bill_date, bill_date_product, bill_payment, bill_due_date, bill_refer, bill_site, bill_pr, bill_work_no, bill_project, list_num, total_amount, vat, withholding, grand_total, bill_company, employee_id) 
    VALUES (:bill_id, :bill_date, :bill_date_product, :bill_payment, :bill_due_date, :bill_refer, :bill_site, :bill_pr, :bill_work_no, :bill_project, :list_num, :total_amount, :vat, :withholding, :grand_total, :bill_company, :employee_id)");

    $stmtInvoice->bindParam(':bill_id', $_POST['number']);
    $stmtInvoice->bindParam(':bill_date', $_POST['thai_date']);
    $stmtInvoice->bindParam(':bill_date_product', $_POST['thai_date_product']);
    $stmtInvoice->bindParam(':bill_payment', $_POST['payment']);
    $stmtInvoice->bindParam(':bill_due_date', $_POST['thai_due_date']);
    $stmtInvoice->bindParam(':bill_refer', $_POST['refer']);
    $stmtInvoice->bindParam(':bill_site', $_POST['Site']);
    $stmtInvoice->bindParam(':bill_pr', $_POST['pr']);
    $stmtInvoice->bindParam(':bill_work_no', $_POST['work_no']);
    $stmtInvoice->bindParam(':bill_project', $_POST['project']);
    $stmtInvoice->bindParam(':list_num', $_POST['auCount']);
    $stmtInvoice->bindValue(':total_amount', 0); // ค่าตัวยึดตำแหน่งจะอัปเดตในภายหลัง
    $stmtInvoice->bindValue(':vat', 0);          // ค่าตัวยึดตำแหน่งจะอัปเดตในภายหลัง
    $stmtInvoice->bindValue(':withholding', 0);  // ค่าตัวยึดตำแหน่งจะอัปเดตในภายหลัง
    $stmtInvoice->bindValue(':grand_total', 0);  // ค่าตัวยึดตำแหน่งจะอัปเดตในภายหลัง
    $stmtInvoice->bindParam(':bill_company', $_POST['company']);
    $stmtInvoice->bindParam(':employee_id', $employee_id);

    $stmtInvoice->execute();

    $total = 0;
    $vat = 0.07;
    $withholding = 0.03;

    // Step 3: Insert into bill_detail
    $stmtInvoiceItem = $con->prepare("INSERT INTO bill_detail (bill_id, au_id, unit, price) VALUES (:bill_id, :au_id, :unit, :price)");

    $auCount = count($_POST['inputField']);
    for ($i = 0; $i < $auCount; $i++) {
        $auId = $_POST['inputField'][$i];

        // Retrieve price for au_id
        $stmtPrice = $con->prepare("SELECT au_price FROM au_all WHERE au_id = :au_id");
        $stmtPrice->bindParam(':au_id', $auId);
        $stmtPrice->execute();
        $auPrice = $stmtPrice->fetchColumn();

        $unit = $_POST['unit'][$i];
        $price = $unit * $auPrice;

        $stmtInvoiceItem->bindParam(':bill_id', $_POST['number']);
        $stmtInvoiceItem->bindParam(':au_id', $auId);
        $stmtInvoiceItem->bindParam(':unit', $unit);
        $stmtInvoiceItem->bindParam(':price', $price);
        $stmtInvoiceItem->execute();

        $total += $price;
    }

    $totalVat = $total * $vat;
    $totalWithholding = $total * $withholding;
    $grand_total = $total - $totalVat;

    // Update invoice with totals
    $stmtInvoiceUpdate = $con->prepare("UPDATE bill SET total_amount = :total_amount, vat = :vat, withholding = :withholding, grand_total = :grand_total WHERE bill_id = :bill_id");
    $stmtInvoiceUpdate->bindParam(':total_amount', $total);
    $stmtInvoiceUpdate->bindParam(':vat', $totalVat);
    $stmtInvoiceUpdate->bindParam(':withholding', $totalWithholding);
    $stmtInvoiceUpdate->bindParam(':grand_total', $grand_total);
    $stmtInvoiceUpdate->bindParam(':bill_id', $_POST['number']);
    $stmtInvoiceUpdate->execute();

    // Log the operation
    $stmtLog = $con->prepare("INSERT INTO log (log_status, log_detail, user_id) VALUES (:log_status, :log_detail, :user_id)");
    $logStatus = 'Bill Created';
    $logDetail = 'Bill ID: ' . $_POST['number'] . ', Total Amount: ' . $total;
    $stmtLog->bindParam(':log_status', $logStatus);
    $stmtLog->bindParam(':log_detail', $logDetail);
    $stmtLog->bindParam(':user_id', $user_id);
    $stmtLog->execute();

    $con->commit();
    echo json_encode(['success' => true]);
    exit();
} catch (PDOException $e) {
    $con->rollBack();
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'ไม่สามารถเพิ่ม Bill ได้กรุณาตรวจสอบข้อมูลให้ถูกต้อง']);
    exit();
}

$con = null;
