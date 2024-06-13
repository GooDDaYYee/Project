<?php
$dsn = 'mysql:host=localhost;dbname=psnktelecom;charset=utf8';
$username = 'root';
$password = '';

try {
    $con = new PDO($dsn, $username, $password);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
