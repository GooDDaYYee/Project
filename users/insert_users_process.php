<?php
include "../connect.php";
$username = $_POST["username"];
$password = $_POST["passW"];
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
$lv = $_POST['type'];

try {
    $con->beginTransaction();

    $employee_name = $_POST["name"];
    $employee_lastname = $_POST["lastname"];
    $employee_age = $_POST["age"];
    $employee_phone = $_POST["phone"];
    $employee_email = $_POST["email"];
    $employee_position = $_POST["type"];
    $employee_status = $_POST["status"];

    $sql = "INSERT INTO employee(employee_name, employee_lastname, employee_age, employee_phone, employee_email, employee_position,employee_status) 
            VALUES (:employee_name, :employee_lastname, :employee_age, :employee_phone, :employee_email, :employee_position, :employee_status)";
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':employee_name', $employee_name);
    $stmt->bindParam(':employee_lastname', $employee_lastname);
    $stmt->bindParam(':employee_age', $employee_age);
    $stmt->bindParam(':employee_phone', $employee_phone);
    $stmt->bindParam(':employee_email', $employee_email);
    $stmt->bindParam(':employee_position', $employee_position);
    $stmt->bindParam(':employee_status', $employee_status);
    $stmt->execute();

    $employee_id = $con->lastInsertId();

    $sql = "INSERT INTO users(username, passW, lv, status, employee_id) 
            VALUES (:username, :passW, :lv,  :status, :employee_id)";
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':passW', $hashed_password);
    $stmt->bindParam(':lv', $lv);
    $stmt->bindParam(':status', $employee_status);
    $stmt->bindParam(':employee_id', $employee_id);
    $stmt->execute();

    $stmtLog = $con->prepare("INSERT INTO log (log_status, log_detail, user_id) VALUES (:log_status, :log_detail, :user_id)");
    $logStatus = 'User Created';
    $logDetail = 'Username: ' . $username . ', Employee Name: ' . $employee_name . ' ' . $employee_lastname . ', Position: ' . $employee_position;
    $admin_user_id = $_SESSION['user_id'];
    $stmtLog->bindParam(':log_status', $logStatus);
    $stmtLog->bindParam(':log_detail', $logDetail);
    $stmtLog->bindParam(':user_id', $admin_user_id);
    $stmtLog->execute();

    $con->commit();

    echo json_encode(['success' => true]);
    exit();
} catch (PDOException $e) {
    $con->rollBack();
    http_response_code(400);
    echo json_encode(['success' => false]);
    exit();
}
$con = null;
