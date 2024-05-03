<?php 
$serverName = "localhost"; 
$userName = "root";
$userPassword = ""; //รหัสผ่านฐานข้อมูล
$dbName = "psnktelecom"; //ชื่อฐานข้อมูล

$conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}else{
	//echo "connected successfuly";
}
?>