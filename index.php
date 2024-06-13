<?php
session_start();
if (!$_SESSION['login']) {
    header("location: login.php");
    exit(0);
}

include_once("header.php");

$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$pageFile = $page . '.php';

// ตรวจสอบว่าไฟล์มีอยู่หรือไม่ หากไม่มีให้ใช้หน้า home
if (!file_exists($pageFile)) {
    $pageFile = 'home.php';
}

include $pageFile;

include_once("footer.php");
