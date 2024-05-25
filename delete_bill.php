<?php
include('connect.php');

if (isset($_GET['bill_id'])) {
    $billId = $_GET['bill_id'];

    try {
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $con->beginTransaction();

        $stmtDetail = $con->prepare("DELETE FROM bill_detail WHERE bill_id = :bill_id");
        $stmtDetail->bindParam(':bill_id', $billId);
        $stmtDetail->execute();
        $stmtBill = $con->prepare("DELETE FROM bill WHERE bill_id = :bill_id");
        $stmtBill->bindParam(':bill_id', $billId);
        $stmtBill->execute();

        $con->commit();

        header("Location: index.php?page=list_mixed");
        exit();
    } catch (PDOException $e) {
        $con->rollBack();
        echo "Error: " . $e->getMessage();
    }

    $con = null;
} else {
    echo "Invalid request.";
}
