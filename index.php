<?php
session_start();
if(!$_SESSION['login']){
    header( "location: login.php" );
    exit(0);
}

include_once("header.php");

$page=$_GET['page'];

if($page=='home'){
    include_once("home.php");
}elseif($page=='report'){
    include_once("report.php");
}elseif($page=='manage_user'){
    include_once("manage_user.php");
}elseif($page=='register'){
    include_once("register.php");
}

include_once("footer.php");

?>