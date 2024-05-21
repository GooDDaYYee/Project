<?php
include("connect.php");
try {
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $con->beginTransaction();

    $stmtInvoice = $con->prepare("INSERT INTO bill (bill_id, bill_date, bill_date_product, bill_payment, bill_due_date, bill_refer, bill_site, bill_pr, bill_work_no, bill_project, list_num) 
                                   VALUES (:bill_id, :bill_date, :bill_date_product, :bill_payment, :bill_due_date, :bill_refer, :bill_site, :bill_pr, :bill_work_no, :bill_project, :list_num)");

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

    $stmtInvoice->execute();
    $invoiceId = $con->lastInsertId();

    $stmtInvoiceItem = $con->prepare("INSERT INTO bill_detail (bill_id, au_id) 
                                       VALUES (:bill_id, :au_id)");

    $auCount = count($_POST['inputField']);
    for ($i = 0; $i < $auCount; $i++) {
        $stmtInvoiceItem->bindParam(':bill_id', $_POST['number']);
        $stmtInvoiceItem->bindParam(':au_id', $_POST['inputField'][$i]);
        $stmtInvoiceItem->execute();
    }
    $con->commit();

    // Redirect to list_mixed.php
    header("Location: index.php?page=list_mixed");
    exit();
} catch (PDOException $e) {

    $con->rollBack();
    echo "Error: " . $e->getMessage();
}

$con = null;
