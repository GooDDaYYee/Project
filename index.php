<?php
session_start();
if (!$_SESSION['login']) {
    header("location: login.php");
    exit(0);
}

include_once("header.php");

$page = $_GET['page'];

if ($page == 'home') {
    include_once("home.php");
} elseif ($page == 'files') {
    include_once("files.php");
} elseif ($page == 'manage_user') {
    include_once("manage_user.php");
} elseif ($page == 'register') {
    include_once("register.php");
} elseif ($page == 'list_mixed') {
    include_once("list_mixed.php");
} elseif ($page == 'mixed_report') {
    include_once("mixed_report.php");
} elseif ($page == 'list_fbh') {
    include_once("list_fbh.php");
} elseif ($page == 'fbh_report') {
    include_once("fbh_report.php");
} else {
    include_once("home.php");
}
include_once("footer.php");
