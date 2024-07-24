<?php
include('../connect.php');

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
        echo "ข้อมูลผู้ใช้ถูกอัปเดตเรียบร้อยแล้ว";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

$con = null;

header("Location: ../index.php?page=users/list_user");
exit();
