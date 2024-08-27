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
    $employee_status = $_POST['employee_status'];

    try {
        $sql = "UPDATE employee 
            SET employee_name = :employee_name, 
                employee_lastname = :employee_lastname, 
                employee_age = :employee_age, 
                employee_phone = :employee_phone, 
                employee_email = :employee_email, 
                employee_position = :employee_position,
                employee_status = :employee_status
            WHERE employee_id = :employee_id";

        $stmt = $con->prepare($sql);
        $stmt->bindParam(':employee_id', $employee_id);
        $stmt->bindParam(':employee_name', $employee_name);
        $stmt->bindParam(':employee_lastname', $employee_lastname);
        $stmt->bindParam(':employee_age', $employee_age);
        $stmt->bindParam(':employee_phone', $employee_phone);
        $stmt->bindParam(':employee_email', $employee_email);
        $stmt->bindParam(':employee_position', $employee_position);
        $stmt->bindParam(':employee_status', $employee_status);
        $stmt->execute();


        $stmtLog = $con->prepare("INSERT INTO log (log_status, log_detail, user_id) VALUES (:log_status, :log_detail, :user_id)");
        $logStatus = 'Employee Updated';
        $logDetail = "Updated employee ID: $employee_id, Name: $employee_name $employee_lastname";
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

    header("Location: ../index.php?page=" . base64_encode('employee/list_employee'));
    exit();
}
