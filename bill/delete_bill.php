<?php
include('../connect.php');
session_start(); // Start session to get user information

if (isset($_GET['bill_id'])) {
    $billId = $_GET['bill_id'];

    try {
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $con->beginTransaction();

        // Check if the bill exists and get the company name
        $stmtchk = $con->prepare("SELECT bill_company FROM bill WHERE bill_id = :bill_id");
        $stmtchk->bindParam(':bill_id', $billId);
        $stmtchk->execute();
        $result = $stmtchk->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            // Delete the bill details
            $stmtDetail = $con->prepare("DELETE FROM bill_detail WHERE bill_id = :bill_id");
            $stmtDetail->bindParam(':bill_id', $billId);
            $stmtDetail->execute();

            // Delete the bill
            $stmtBill = $con->prepare("DELETE FROM bill WHERE bill_id = :bill_id");
            $stmtBill->bindParam(':bill_id', $billId);
            $stmtBill->execute();

            // Log the deletion
            $stmtLog = $con->prepare("INSERT INTO log (log_status, log_detail, user_id) VALUES (:log_status, :log_detail, :user_id)");
            $logStatus = 'Bill Deleted';
            $logDetail = 'Bill ID: ' . $billId . ', Company: ' . $result['bill_company'];
            $user_id = $_SESSION['user_id']; // Get user ID from session
            $stmtLog->bindParam(':log_status', $logStatus);
            $stmtLog->bindParam(':log_detail', $logDetail);
            $stmtLog->bindParam(':user_id', $user_id);
            $stmtLog->execute();

            $con->commit();

            // Redirect based on company name
            if ($result['bill_company'] == 'mixed') {
                header("Location: ../index.php?page=bill/list_mixed");
            } elseif ($result['bill_company'] == 'FBH') {
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
