<?php
include "../connect.php";

$name = $_POST["name"];
$lastname = $_POST["lastname"];
$username = $_POST["username"];
$password = $_POST["passW"];
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
$lv = $_POST['type'];

try {
    $sql = "INSERT INTO users(username, passW, name, lastname, lv) VALUES (:username, :passW, :name, :lastname, :lv)";
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':passW', $hashed_password);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':lv', $lv);
    $result = $stmt->execute();
} catch (PDOException $e) {
    echo '<script>
        alert("เกิดข้อผิดพลาด: ' . $e->getMessage() . '");
        history.back();
        </script>
    ';
}

$employee_name = $_POST["name"];
$employee_lastname = $_POST["lastname"];
$employee_age = $_POST["age"];
$employee_phone = $_POST["phone"];
$employee_salary = $_POST["salary"];
$employee_email = $_POST["email"];
$employee_position = $_POST["type"];

try {
    $sql = "INSERT INTO employee(employee_name, employee_lastname, employee_age, employee_phone, employee_salary, employee_email, employee_position) VALUES (:employee_name, :employee_lastname, :employee_age, :employee_phone, :employee_salary, :employee_email, :employee_position)";
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':employee_name', $employee_name);
    $stmt->bindParam(':employee_lastname', $employee_lastname);
    $stmt->bindParam(':employee_age', $employee_age);
    $stmt->bindParam(':employee_phone', $employee_phone);
    $stmt->bindParam(':employee_salary', $employee_salary);
    $stmt->bindParam(':employee_email', $employee_email);
    $stmt->bindParam(':employee_position', $employee_position);
    $result = $stmt->execute();
    header("Location: ../index.php?page=users/list_user");
    exit();
} catch (PDOException $e) {
    echo '<script>
        alert("เกิดข้อผิดพลาด: ' . $e->getMessage() . '");
        history.back();
        </script>
    ';
}

$con = null;
