<?php
$dsn = 'mysql:host=localhost;dbname=psnktelecom;charset=utf8';
$username = 'root';
$password = '';

try {
    $con = new PDO($dsn, $username, $password);
    // ตั้งค่า PDO ให้โยนข้อผิดพลาดเป็นข้อยกเว้น
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
