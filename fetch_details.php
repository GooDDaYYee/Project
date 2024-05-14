<?php
include('connect.php');

if (isset($_GET['au_id'])) {
    $auId = $_GET['au_id'];
    $query = "SELECT * FROM au_mixed WHERE au_id = '$auId'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);

    // ส่งข้อมูลเป็น JSON ที่มี au_detail, au_type และ au_price
    $response = array(
        'au_detail' => $row['au_detail'],
        'au_type' => $row['au_type'],
        'au_price' => $row['au_price']
    );

    // ส่งผลลัพธ์กลับเป็น JSON
    echo json_encode($response);
}

mysqli_close($con);
