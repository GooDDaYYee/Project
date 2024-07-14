<?php
include("../connect.php");

if (isset($_POST['request_type']) && $_POST['request_type'] == 'manufacturer' && isset($_POST["manufacturer"]) && isset($_POST["company"])) {
    $manufacturer = $_POST["manufacturer"];
    $company = $_POST["company"];
    $strsql = "SELECT * FROM drum WHERE drum_cable_company = :manufacturer AND drum_company = :company AND drum_remaining > 0";
    $stmt = $con->prepare($strsql);
    $stmt->bindParam(':manufacturer', $manufacturer, PDO::PARAM_STR);
    $stmt->bindParam(':company', $company, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo '<option value="">เลือกรหัส Drum</option>';
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<option value="' . ($row['drum_id']) . '">' . ($row['drum_no']) . '</option>';
        }
    } else {
        echo '<option value="">ไม่มีข้อมูล</option>';
    }
}
