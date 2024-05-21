<?php
include("connect.php");
try {
    // ตั้งค่า PDO error mode ให้เป็น exception
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // เริ่มต้นการ transaction
    $con->beginTransaction();

    // เตรียมคำสั่ง SQL สำหรับ insert ในตารางแรก (เช่น invoices)
    $stmtInvoice = $con->prepare("INSERT INTO bill (bill_id, bill_date, bill_payment, bill_date_product, bill_refer) 
                                   VALUES (:number, :date, :payment_terms, :due_date, :reference)");

    // ผูกค่าเข้ากับพารามิเตอร์
    $stmtInvoice->bindParam(':number', $_POST['number']);
    $stmtInvoice->bindParam(':date', $_POST['thai_date']);
    $stmtInvoice->bindParam(':payment_terms', $_POST['payment']);
    $stmtInvoice->bindParam(':due_date', $_POST['thai_due_date']);
    $stmtInvoice->bindParam(':reference', $_POST['refer']);

    // Execute คำสั่ง SQL สำหรับ insert ในตารางแรก
    $stmtInvoice->execute();
    $invoiceId = $con->lastInsertId(); // เก็บ ID ของใบแจ้งหนี้ที่เพิ่ง insert

    // เตรียมคำสั่ง SQL สำหรับ insert ในตารางที่สอง (เช่น invoice_items)
    $stmtInvoiceItem = $con->prepare("INSERT INTO invoice_items (invoice_id, au_id, au_detail, au_type, au_price, quantity) 
                                       VALUES (:invoice_id, :au_id, :au_detail, :au_type, :au_price, :quantity)");

    // Loop ผ่านแต่ละ AU และ insert ข้อมูลในตาราง invoice_items
    $auCount = count($_POST['inputField']);
    for ($i = 0; $i < $auCount; $i++) {
        $stmtInvoiceItem->bindParam(':invoice_id', $invoiceId);
        $stmtInvoiceItem->bindParam(':au_id', $_POST['inputField'][$i]);
        $stmtInvoiceItem->bindParam(':au_detail', $_POST['selectedDataDetail'][$i]);
        $stmtInvoiceItem->bindParam(':au_type', $_POST['selectedDataType'][$i]);
        $stmtInvoiceItem->bindParam(':au_price', $_POST['selectedDataPrice'][$i]);
        $stmtInvoiceItem->bindParam(':quantity', $_POST['unit'][$i]);
        $stmtInvoiceItem->execute();
    }

    // คอมมิต transaction
    $con->commit();

    echo "New records created successfully in both tables";
} catch (PDOException $e) {
    // ในกรณีเกิดข้อผิดพลาด ให้ทำการ rollback
    $con->rollBack();
    echo "Error: " . $e->getMessage();
}

// ปิดการเชื่อมต่อ
$con = null;
