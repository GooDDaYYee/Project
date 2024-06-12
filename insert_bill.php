<?php
include("connect.php");

function checkDuplicates($array)
{
    return count($array) !== count(array_unique($array));
}

try {
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $con->beginTransaction();

    $stmtInvoice = $con->prepare("INSERT INTO bill (bill_id, bill_date, bill_date_product, bill_payment, bill_due_date, bill_refer, bill_site, bill_pr, bill_work_no, bill_project, list_num, total_amount, vat, withholding, grand_total, bill_company) 
                                    VALUES (:bill_id, :bill_date, :bill_date_product, :bill_payment, :bill_due_date, :bill_refer, :bill_site, :bill_pr, :bill_work_no, :bill_project, :list_num, :total_amount, :vat, :withholding, :grand_total, :bill_company)");

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
    $stmtInvoice->bindParam(':bill_company', $_POST['company']);

    // คำนวณ total_amount, vat, และ withholding
    $total = 0;
    $vat = 0.07; // 7% VAT
    $withholding = 0.03; // 3% withholding

    $stmtInvoiceItem = $con->prepare("INSERT INTO bill_detail (bill_id, au_id, unit, price) VALUES (:bill_id, :au_id, :unit, :price)");

    $auCount = count($_POST['inputField']);
    for ($i = 0; $i < $auCount; $i++) {
        $auId = $_POST['inputField'][$i];

        // ดึงราคา au_price จากตาราง au_all
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

    $stmtInvoice->bindParam(':total_amount', $total);
    $stmtInvoice->bindParam(':vat', $totalVat);
    $stmtInvoice->bindParam(':withholding', $totalWithholding);
    $stmtInvoice->bindParam(':grand_total', $grand_total);

    $stmtInvoice->execute();

    $con->commit();

    // Redirect to list_mixed.php
    if ($_POST['company'] == "mixed") {
        header("Location: index.php?page=list_mixed");
    } elseif (($_POST['company'] == "FBH")) {
        header("Location: index.php?page=list_fbh");
    }

    exit();
} catch (PDOException $e) {
    $con->rollBack();
    echo "Error: " . $e->getMessage();
}

$con = null;
