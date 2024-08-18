<?php
include('../connect.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employee_id = $_POST['employee_id'];
    $employee_name = $_POST['employee_name'];
    $employee_lastname = $_POST['employee_lastname'];
    $employee_age = $_POST['employee_age'];
    $employee_phone = $_POST['employee_phone'];
    $employee_email = $_POST['employee_email'];
    $employee_position = $_POST['employee_position'];

    $sql = "UPDATE employee 
            SET employee_name = :employee_name, 
                employee_lastname = :employee_lastname, 
                employee_age = :employee_age, 
                employee_phone = :employee_phone, 
                employee_email = :employee_email, 
                employee_position = :employee_position 
            WHERE employee_id = :employee_id";

    $stmt = $con->prepare($sql);

    $stmt->bindParam(':employee_name', $employee_name);
    $stmt->bindParam(':employee_lastname', $employee_lastname);
    $stmt->bindParam(':employee_age', $employee_age);
    $stmt->bindParam(':employee_phone', $employee_phone);
    $stmt->bindParam(':employee_email', $employee_email);
    $stmt->bindParam(':employee_position', $employee_position);
    $stmt->bindParam(':employee_id', $employee_id);

    try {
        $stmt->execute();

        $stmtLog = $con->prepare("INSERT INTO log (log_status, log_detail, user_id) VALUES (:log_status, :log_detail, :user_id)");
        $logStatus = 'Employee Updated';
        $logDetail = "Updated employee ID: $employee_id, Name: $employee_name $employee_lastname";
        $user_id = $_SESSION['user_id']; // Get user ID from session
        $stmtLog->bindParam(':log_status', $logStatus);
        $stmtLog->bindParam(':log_detail', $logDetail);
        $stmtLog->bindParam(':user_id', $user_id);
        $stmtLog->execute();

        echo "ข้อมูลพนักงานถูกอัปเดตเรียบร้อยแล้ว";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $con = null;

    header("Location: ../index.php?page=" . base64_encode('employee/list_employee'));
    exit();
}
