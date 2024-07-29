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

    $sql = "SELECT * FROM users u 
            INNER JOIN employee e ON u.user_id  = e.user_id 
            WHERE e.employee_phone = :employee_phone AND u.username = :username";

    $stmt = $con->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':employee_phone', $phone);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result && ($username == $result['username'] && $phone == $result['employee_phone'])) {
        header("location: cfpss.php");
        exit();
    } else {
        header("location: otp_send.php");
        exit();
    }
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
