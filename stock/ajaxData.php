<?php
include("../connect.php");

if (isset($_POST['request_type']) && $_POST['request_type'] == 'company' && isset($_POST["company"])) {
    $company = $_POST["company"];
    $strsql = "SELECT * FROM drum WHERE drum_company = :company";
    $stmt = $con->prepare($strsql);
    $stmt->bindParam(':company', $company, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo '<option value="">เลือกบริษัท</option>';
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<option value="' . ($row['drum_cable_company']) . '">' . ($row['drum_cable_company']) . '</option>';
        }
    } else {
        echo '<option value="">ไม่มีข้อมูล</option>';
    }
}

if (isset($_POST['request_type']) && $_POST['request_type'] == 'manufacturer' && isset($_POST["manufacturer"]) && isset($_POST["company"])) {
    $manufacturer = $_POST["manufacturer"];
    $company = $_POST["company"];
    $strsql = "SELECT * FROM drum WHERE drum_cable_company = :manufacturer AND drum_company = :company";
    $stmt = $con->prepare($strsql);
    $stmt->bindParam(':manufacturer', $manufacturer, PDO::PARAM_STR);
    $stmt->bindParam(':company', $company, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo '<option value="">เลือกรหัส Drum</option>';
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<option value="' . ($row['drum_no']) . '">' . ($row['drum_no']) . '</option>';
        }
    } else {
        echo '<option value="">ไม่มีข้อมูล</option>';
    }
}
