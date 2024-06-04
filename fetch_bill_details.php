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

foreach ($details as &$detail) {
    $auId = $detail['au_id'];
    $query = "SELECT * FROM au_all WHERE au_id = :au_id AND au_company = 'mixed'";

    $stmt = $con->prepare($query);
    $stmt->bindParam(':au_id', $auId, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $detail['au_detail'] = $row['au_detail'];
        $detail['au_type'] = $row['au_type'];
        $detail['au_price'] = $row['au_price'];
    } else {
        $detail['au_detail'] = 'undefined';
        $detail['au_type'] = 'undefined';
        $detail['au_price'] = 'undefined';
    }
}

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
