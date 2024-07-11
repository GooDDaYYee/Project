<?php
include("../connect.php");

try {
    $con->beginTransaction();

    $stmt = $con->prepare("INSERT INTO cable (route_name, installed_section, , cable_form, cable_to, cable_used, employee_id , drum_no, cable_work)
    VALUES (:route_name, :installed_section, :placing_team, :cable_form, :cable_to, :cable_used, :employee_id , :drum_no, :cable_work)");

    $stmt->bindParam(':route_name', $_POST['route']);
    $stmt->bindParam(':installed_section', $_POST['section']);
    $stmt->bindParam(':placing_team', $_POST['team']);
    $stmt->bindParam(':cable_form', $_POST['cable_form']);
    $stmt->bindParam(':cable_to', $_POST['cable_to']);
    $cable_used = $_POST['cable_form'] - $_POST['cable_to'];
    $stmt->bindParam(':cable_used', $cable_used);
    $stmt->bindParam(':employee_id', $employee_id);
    $stmt->bindParam(':drum_no', $_POST['drum_no']);
    $stmt->bindParam(':cable_work', $_POST['cable_work']);

    $result = $stmt->execute();
    if ($result) {
        echo '<script>
            alert("เพิ่มข้อมูลสำเร็จ");
            history.back();
            </script>
        ';
    } else {
        echo '<script>
            alert("เพิ่มข้อมูลไม่สำเร็จ");
            history.back();
            </script>
        ';
    }
    $con->commit();
    header("Location: ../index.php?page=stock/list_stock_drum");
    exit();
} catch (PDOException $e) {
    $con->rollBack();
    echo '<script>
        alert("เกิดข้อผิดพลาด: ' . $e->getMessage() . '");
        history.back();
        </script>
    ';
}
