<?php
include("../connect.php");

try {
    $con->beginTransaction();

    $stmt = $con->prepare("INSERT INTO cable (route_name, installed_section, placing_team, cable_form, cable_to, cable_used, drum_id, cable_work)
    VALUES (:route_name, :installed_section, :placing_team, :cable_form, :cable_to, :cable_used, :drum_id, :cable_work)");

    $stmt->bindParam(':route_name', $_POST['route']);
    $stmt->bindParam(':installed_section', $_POST['section']);
    $stmt->bindParam(':placing_team', $_POST['team']);
    $stmt->bindParam(':cable_form', $_POST['cable_form']);
    $stmt->bindParam(':cable_to', $_POST['cable_to']);
    $cable_used = $_POST['cable_form'] - $_POST['cable_to'];
    $stmt->bindParam(':cable_used', $cable_used);
    $stmt->bindParam(':drum_id', $_POST['drum_id']);
    $stmt->bindParam(':cable_work', $_POST['cable_work']);




    $stmt->execute();
    $con->commit();
    header("Location: ../index.php?page=stock/list_stock_cable");
    exit();
} catch (PDOException $e) {
    $con->rollBack();
    echo '<script>
        alert("เกิดข้อผิดพลาด: ' . $e->getMessage() . '");
        history.back();
        </script>
    ';
}
