<?php
include("../connect.php");
session_start();

function checkDuplicates($array)
{
    return count($array) !== count(array_unique($array));
}

try {
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $con->beginTransaction();

    $stmtUpdateBill = $con->prepare("UPDATE bill SET
        bill_date = :bill_date,
        bill_date_product = :bill_date_product,
        bill_payment = :bill_payment,
        bill_due_date = :bill_due_date,
        bill_refer = :bill_refer,
        bill_site = :bill_site,
        bill_pr = :bill_pr,
        bill_work_no = :bill_work_no,
        bill_project = :bill_project,
        list_num = :list_num,
        total_amount = :total_amount,
        vat = :vat,
        withholding = :withholding,
        grand_total = :grand_total
        WHERE bill_id = :bill_id");

    $stmtUpdateBill->bindParam(':bill_id', $_POST['bill_Id']);
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

    $total = 0;
    $vat = 0.07;
    $withholding = 0.03;

    $stmtDeleteDetails = $con->prepare("DELETE FROM bill_detail WHERE bill_id = :bill_id");
    $stmtDeleteDetails->bindParam(':bill_id', $_POST['bill_Id']);
    $stmtDeleteDetails->execute();

    $stmtInvoiceItem = $con->prepare("INSERT INTO bill_detail (bill_id, au_id, unit, price) VALUES (:bill_id, :au_id, :unit, :price)");

    $auCount = count($_POST['inputField']);
    for ($i = 0; $i < $auCount; $i++) {
        $auId = $_POST['inputField'][$i];

        $stmtPrice = $con->prepare("SELECT au_price FROM au_all WHERE au_id = :au_id");
        $stmtPrice->bindParam(':au_id', $auId);
        $stmtPrice->execute();
        $auPrice = $stmtPrice->fetchColumn();

        $unit = $_POST['unit'][$i];
        $price = $unit * $auPrice;

        $stmtInvoiceItem->bindParam(':bill_id', $_POST['bill_Id']);
        $stmtInvoiceItem->bindParam(':au_id', $auId);
        $stmtInvoiceItem->bindParam(':unit', $unit);
        $stmtInvoiceItem->bindParam(':price', $price);
        $stmtInvoiceItem->execute();

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

    $stmtLog = $con->prepare("INSERT INTO log (log_status, log_detail, user_id) VALUES (:log_status, :log_detail, :user_id)");
    $logStatus = 'Bill Updated';
    $logDetail = 'Bill ID: ' . $_POST['bill_Id'] . ', Total Amount: ' . $total;
    $user_id = $_SESSION['user_id'];
    $stmtLog->bindParam(':log_status', $logStatus);
    $stmtLog->bindParam(':log_detail', $logDetail);
    $stmtLog->bindParam(':user_id', $user_id);
    $stmtLog->execute();

    $con->commit();
    echo json_encode(['success' => true]);
    exit();
} catch (PDOException $e) {
    $con->rollBack();
    http_response_code(401);
    echo json_encode(['success' => false]);
    exit();
}

$con = null;
