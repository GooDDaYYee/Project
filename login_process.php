<?php
session_start();

$users = $_POST['input_username'];
$pass = $_POST['input_password'];

$servername = "localhost";
$serverusername = "root";
$serverpassword = "";
$dbname = "psnktelecom";

$con = mysqli_connect($servername, $serverusername, $serverpassword, $dbname);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM users WHERE status='1' AND username=?";

$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, "s", $users);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $stored_password = $row["passW"];

    if (password_verify($pass, $stored_password)) {
        $_SESSION['login'] = 'yes';
        $_SESSION['user_id'] = $row["user_id"];
        $_SESSION['name'] = $row["name"];
        $_SESSION["lastname"] = $row["lastname"];
        $_SESSION["lv"] = $row["lv"];
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

mysqli_close($con);
