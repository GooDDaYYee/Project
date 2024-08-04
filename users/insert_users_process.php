<?php
include "../connect.php";
session_start(); // Start session to access session variables

$name = $_POST["name"];
$lastname = $_POST["lastname"];
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
    $employee_salary = $_POST["salary"];
    $employee_email = $_POST["email"];
    $employee_position = $_POST["type"];

    // Insert new employee record
    $sql = "INSERT INTO employee(employee_name, employee_lastname, employee_age, employee_phone, employee_salary, employee_email, employee_position) 
            VALUES (:employee_name, :employee_lastname, :employee_age, :employee_phone, :employee_salary, :employee_email, :employee_position)";
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':employee_name', $employee_name);
    $stmt->bindParam(':employee_lastname', $employee_lastname);
    $stmt->bindParam(':employee_age', $employee_age);
    $stmt->bindParam(':employee_phone', $employee_phone);
    $stmt->bindParam(':employee_salary', $employee_salary);
    $stmt->bindParam(':employee_email', $employee_email);
    $stmt->bindParam(':employee_position', $employee_position);
    $stmt->execute();

    $employee_id = $con->lastInsertId(); // Get the last inserted ID for employee

    // Insert new user record
    $sql = "INSERT INTO users(username, passW, name, lastname, lv, employee_id) 
            VALUES (:username, :passW, :name, :lastname, :lv, :employee_id)";
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':passW', $hashed_password);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':lv', $lv);
    $stmt->bindParam(':employee_id', $employee_id);
    $stmt->execute();

    // Log the new user and employee creation
    $stmtLog = $con->prepare("INSERT INTO log (log_status, log_detail, user_id) VALUES (:log_status, :log_detail, :user_id)");
    $logStatus = 'User Created';
    $logDetail = 'Username: ' . $username . ', Employee Name: ' . $employee_name . ' ' . $employee_lastname . ', Position: ' . $employee_position;
    $admin_user_id = $_SESSION['user_id']; // Use user_id from session to log who performed the action
    $stmtLog->bindParam(':log_status', $logStatus);
    $stmtLog->bindParam(':log_detail', $logDetail);
    $stmtLog->bindParam(':user_id', $admin_user_id);
    $stmtLog->execute();

    $con->commit();

    header("Location: ../index.php?page=users/list_user");
    exit();
} catch (PDOException $e) {
    if ($con->inTransaction()) {
        $con->rollBack();
    }
    echo '<script>
        alert("เกิดข้อผิดพลาด: ' . $e->getMessage() . '");
        history.back();
        </script>';
}

$con = null;
