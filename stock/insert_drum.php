<?php
include("connect.php");

try {
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $con->beginTransaction();

    $stmt->$con->prepar("INSERT INTO drum(drum_no, drum_to, drum_description, drum_full, drum_used, drum_amount, drum_company, drum_cable_company)
    VALUES (:drum_no, :drum_to, :drum_description, :drum_full, :drum_used, :drum_amount, :drum_company, :drum_cable_company)");

    $stmt->bindParam(':drum_no,', $_POST['']);
} catch (PDOException $e) {
}
