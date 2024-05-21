<?php
include('connect.php');

if (isset($_GET['au_id'])) {
    $auId = $_GET['au_id'];
    $query = "SELECT * FROM au_all WHERE au_id = :au_id AND au_company = 'mixed'";

    try {
        $stmt = $con->prepare($query);
        $stmt->bindParam(':au_id', $auId, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            // ส่งข้อมูลเป็น JSON ที่มี au_detail, au_type และ au_price
            $response = array(
                'au_detail' => $row['au_detail'],
                'au_type' => $row['au_type'],
                'au_price' => $row['au_price']
            );

            // ส่งผลลัพธ์กลับเป็น JSON
            echo json_encode($response);
        } else {
            // ส่งผลลัพธ์กลับเป็น JSON ว่าง ถ้าไม่พบข้อมูล
            echo json_encode([]);
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// ปิดการเชื่อมต่อฐานข้อมูล
$con = null;
