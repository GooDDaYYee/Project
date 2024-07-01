<?php
include('connect.php');

function fetchDetails($con, $auId, $auCompany)
{
    $query = "SELECT * FROM au_all WHERE au_id = :au_id AND au_company = :au_company";
    try {
        $stmt = $con->prepare($query);
        $stmt->bindParam(':au_id', $auId, PDO::PARAM_STR);
        $stmt->bindParam(':au_company', $auCompany, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return array(
                'au_detail' => $row['au_detail'],
                'au_type' => $row['au_type'],
                'au_price' => $row['au_price']
            );
        } else {
            return array(
                'au_detail' => 'undefined',
                'au_type' => 'undefined',
                'au_price' => 'undefined'
            );
        }
    } catch (PDOException $e) {
        return array(
            'error' => $e->getMessage()
        );
    }
}

if (isset($_GET['bill_id'])) {
    $bill_id = $_GET['bill_id'];

    $strsql = "SELECT * FROM bill WHERE bill_id = :bill_id";
    $stmt = $con->prepare($strsql);
    $stmt->bindParam(':bill_id', $bill_id);
    $stmt->execute();
    $bill = $stmt->fetch(PDO::FETCH_ASSOC);
    $auCompany = $bill['bill_company'];

    $details_sql = "SELECT * FROM bill_detail WHERE bill_id = :bill_id";
    $details_stmt = $con->prepare($details_sql);
    $details_stmt->bindParam(':bill_id', $bill_id);
    $details_stmt->execute();
    $details = $details_stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($details as &$detail) {
        $auId = $detail['au_id'];
        $auDetails = fetchDetails($con, $auId, $auCompany);
        $detail['au_detail'] = $auDetails['au_detail'];
        $detail['au_type'] = $auDetails['au_type'];
        $detail['au_price'] = $auDetails['au_price'];
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
}

if (isset($_GET['au_id'])) {
    $auId = $_GET['au_id'];
    $strsql2 = "SELECT * FROM au_all WHERE au_id = :au_id";
    $strsql3 = $con->prepare($strsql2);
    $strsql3->bindParam(':au_id', $auId);
    $strsql3->execute();
    $strsql4 = $strsql3->fetch(PDO::FETCH_ASSOC);

    $auCompany = $strsql4['au_company'];
    $auDetails = fetchDetails($con, $auId, $auCompany);
    echo json_encode($auDetails);
}

$con = null;
