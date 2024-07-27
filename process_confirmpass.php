<?php
session_start();

$users = $_POST['input_username'];
$phone = $_POST['phone'];

$servername = "localhost";
$serverusername = "root";
$serverpassword = "";
$dbname = "psnktelecom";

$username = $_POST['input_username'];
$phone = $_POST['phone'];

try {
    $con = new PDO("mysql:host=$servername;dbname=$dbname", $serverusername, $serverpassword);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM users u inner join employee e WHERE e.employee_phone=:employee_phone AND u.username=:username";
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':employee_phone', $phone);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);


    if ($result && ($username == $result['username'] && $phone == $result['employee_phone'])) {
        header("location: chpss.php");
        exit();
    } else {
        echo '<script>alert("ชื่อผู้ใช้ หรือเบอร์โทรพ์ชผิด");window.location="confirmpass.php";</script>';
        exit();
    }


    // if ($stmt->rowCount() == 1) {
    //     $stmt = $pdo->prepare("UPDATE users u inner join employee e SET u.passW = :passW WHERE u.username = :username AND e.employee_phone = :phone");
    //     $stmt->bindParam(':passW', $new_password);
    //     $stmt->bindParam(':username', $username);
    //     $stmt->bindParam(':phone', $phone);
    //     $stmt->execute();
    // } else {
    //     echo '<script>alert("ไม่พบผู้ใช้");window.location="login.php";</script>';
    //     exit();
    // }
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
