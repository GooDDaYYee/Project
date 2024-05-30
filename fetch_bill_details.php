<?php
include('connect.php');

$bill_id = $_GET['bill_id'];

$strsql = "SELECT * FROM bill WHERE bill_id = :bill_id";
$stmt = $con->prepare($strsql);
$stmt->bindParam(':bill_id', $bill_id);
$stmt->execute();
$bill = $stmt->fetch(PDO::FETCH_ASSOC);

$details_sql = "SELECT * FROM bill_detail WHERE bill_id = :bill_id";
$details_stmt = $con->prepare($details_sql);
$details_stmt->bindParam(':bill_id', $bill_id);
$details_stmt->execute();
$details = $details_stmt->fetchAll(PDO::FETCH_ASSOC);

$response = [
    'bill_id' => $bill['bill_id'],
    'bill_date' => $bill['bill_date'],
    'bill_date_product' => $bill['bill_date_product'],
    'bill_payment' => $bill['bill_payment'],
    'bill_due_date' => $bill['bill_due_date'],
    'bill_refer' => $bill['bill_refer'],
    'bill_site' => $bill['bill_site'],
    'bill_pr' => $bill['bill_pr'],
    'bill_work_no' => $bill['bill_work_no'],
    'bill_project' => $bill['bill_project'],
    'list_num' => $bill['list_num'],
    'details' => $details
];

echo json_encode($response);
