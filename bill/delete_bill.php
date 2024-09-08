<?php
include('../connect.php');
session_start();

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

            $stmtLog = $con->prepare("INSERT INTO log (log_status, log_detail, user_id) VALUES (:log_status, :log_detail, :user_id)");
            $logStatus = 'Bill Deleted';
            $logDetail = 'Bill ID: ' . $billId . ', Company: ' . $result['bill_company'];
            $user_id = $_SESSION['user_id'];
            $stmtLog->bindParam(':log_status', $logStatus);
            $stmtLog->bindParam(':log_detail', $logDetail);
            $stmtLog->bindParam(':user_id', $user_id);
            $stmtLog->execute();

            $con->commit();
            echo json_encode(['success' => true]);
            exit();
        } else {
            $con->rollBack();
            http_response_code(404);
            echo json_encode(['success' => false, 'message' => 'ไม่มีข้อมูลบิลนี้']);
            exit();
        }
    } catch (PDOException $e) {
        $con->rollBack();
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'เชื่อมต่อฐานข้อมูลล้มเหลว']);
        exit();
    }

    $con = null;
} else {
    $con->rollBack();
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'ไม่สามารถส่งข้อมูลเพื่อลบได้']);
    exit();
}
