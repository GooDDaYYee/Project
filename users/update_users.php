<?php
include('../connect.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $username = $_POST['username'];
    $lv = $_POST['lv'];
    $status = $_POST['status'];

    $sql = "UPDATE users 
            SET username = :username, 
                lv = :lv, 
                status = :status
            WHERE user_id = :user_id";

    $stmt = $con->prepare($sql);

    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':lv', $lv);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':user_id', $user_id);

    try {
        $stmt->execute();

        $stmtLog = $con->prepare("INSERT INTO log (log_status, log_detail, user_id) VALUES (:log_status, :log_detail, :user_id)");
        $logStatus = 'User Updated';
        $logDetail = 'User ID: ' . $user_id . ', Username: ' . $username . ', Level: ' . $lv . ', Status: ' . $status;
        $admin_user_id = $_SESSION['user_id'];
        $stmtLog->bindParam(':log_status', $logStatus);
        $stmtLog->bindParam(':log_detail', $logDetail);
        $stmtLog->bindParam(':user_id', $admin_user_id);
        $stmtLog->execute();

        echo "ข้อมูลผู้ใช้ถูกอัปเดตเรียบร้อยแล้ว";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

$con = null;

header("Location: index.php?page=" . base64_encode('users/list_user'));
exit();
