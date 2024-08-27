<?php
include('../connect.php');
session_start();

if (isset($_GET['employee_id'])) {
    $employee_id = $_GET['employee_id'];

    try {
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $con->beginTransaction();

        $stmtEmployee = $con->prepare("DELETE FROM employee WHERE employee_id = :employee_id");
        $stmtEmployee->bindParam(':employee_id', $employee_id);
        $stmtEmployee->execute();

        $stmtUser = $con->prepare("DELETE FROM users WHERE employee_id = :employee_id");
        $stmtUser->bindParam(':employee_id', $employee_id);
        $stmtUser->execute();

        $stmtLog = $con->prepare("INSERT INTO log (log_status, log_detail, user_id) VALUES (:log_status, :log_detail, :user_id)");
        $logStatus = 'Employee Deleted';
        $logDetail = 'Employee ID: ' . $employee_id;
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
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'เชื่อมต่อฐานข้อมูลล้มเหลว']);
        exit();
    }
    $con = null;
} else {
    echo "Invalid request.";
}
