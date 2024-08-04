<?php
session_start();
include('connect.php');
$users = $_POST['input_username'];
$pass = $_POST['input_password'];

try {
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM users WHERE status='1' AND username=:username";
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':username', $users);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $stored_password = $row["passW"];

        if (password_verify($pass, $stored_password)) {
            $_SESSION['login'] = 'yes';
            $_SESSION['user_id'] = $row["user_id"];
            $_SESSION["lv"] = $row["lv"];
            $_SESSION["employee_id"] = $row["employee_id"];
            header("location: index.php?page=home");
            exit();
        } else {
            echo '<script>alert("รหัสผิด");window.location="login.php";</script>';
            exit();
        }
    } else {
        echo '<script>alert("ไม่พบผู้ใช้");window.location="login.php";</script>';
        exit();
    }
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
