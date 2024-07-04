<?php
include('../connect.php');

if (isset($_GET['bill_id'])) {
    $billId = $_GET['bill_id'];

    try {
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $con->beginTransaction();

        $stmtchk = $con->prepare("SELECT bill_company FROM bill WHERE bill_id = :bill_id");
        $stmtchk->bindParam(':bill_id', $billId);
        $stmtchk->execute();
        $result = $stmtchk->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $stmtDetail = $con->prepare("DELETE FROM bill_detail WHERE bill_id = :bill_id");
            $stmtDetail->bindParam(':bill_id', $billId);
            $stmtDetail->execute();

            $stmtBill = $con->prepare("DELETE FROM bill WHERE bill_id = :bill_id");
            $stmtBill->bindParam(':bill_id', $billId);
            $stmtBill->execute();

            $con->commit();

            if ($result['bill_company'] == 'mixed') {
                header("Location: ../index.php?page=bill/list_mixed");
            } elseif (($result['bill_company'] == 'FBH')) {
                header("Location: ../index.php?page=bill/list_fbh");
            } else {
                header("Location: ../index.php?page=home");
            }
            exit();
        } else {
            $con->rollBack();
            echo "Error: Bill not found.";
        }
    } catch (PDOException $e) {
        if ($con->inTransaction()) {
            $con->rollBack();
        }
        echo "Error: " . $e->getMessage();
    }

    $con = null;
} else {
    echo "Invalid request.";
}
