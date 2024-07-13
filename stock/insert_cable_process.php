<?php
include("../connect.php");

try {
    $con->beginTransaction();

    $cable_used = $_POST['cable_form'] - $_POST['cable_to'];

    $drum_id = $_POST['drum_id'];
    $strsql = 'SELECT SUM(cable_used) as total_cable FROM cable WHERE drum_id = :drum_id';
    $stmt = $con->prepare($strsql);
    $stmt->bindParam(':drum_id', $drum_id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $total_cable = $result['total_cable'] + $cable_used;

    if ($total_cable > 4000) {
        echo '<script>
            alert("ไม่สามารถเพิ่มข้อมูลได้: ปริมาณสายเคเบิลทั้งหมดเกิน 4000");
            history.back();
            </script>
        ';
        exit();
    }

    $stmt = $con->prepare("INSERT INTO cable (route_name, installed_section, placing_team, cable_form, cable_to, cable_used, drum_id, cable_work)
    VALUES (:route_name, :installed_section, :placing_team, :cable_form, :cable_to, :cable_used, :drum_id, :cable_work)");

    $stmt->bindParam(':route_name', $_POST['route']);
    $stmt->bindParam(':installed_section', $_POST['section']);
    $stmt->bindParam(':placing_team', $_POST['team']);
    $stmt->bindParam(':cable_form', $_POST['cable_form']);
    $stmt->bindParam(':cable_to', $_POST['cable_to']);
    $stmt->bindParam(':cable_used', $cable_used);
    $stmt->bindParam(':drum_id', $_POST['drum_id']);
    $stmt->bindParam(':cable_work', $_POST['cable_work']);

    $stmt->execute();
    $con->commit();

    $sql = "UPDATE drum SET drum_used=:total_cable, drum_remaining=drum_full-:total_cable WHERE drum_id=:drum_id";
    $stmt2 = $con->prepare($sql);
    $stmt2->bindParam(':total_cable', $total_cable, PDO::PARAM_INT);
    $stmt2->bindParam(':drum_id', $drum_id, PDO::PARAM_INT);
    $stmt2->execute();

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

try {
    $drum_id = $_POST['drum_id'];
    $strsql = 'SELECT * FROM cable c JOIN durm d WHERE drum_id = :drum_id';
    $stmt = $con->prepare($strsql);
    $stmt->bindParam(':drum_id', $drum_id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $total_cable = 0;
    foreach ($result as $row) {
        $total_cable += $row['cable_used'];
    }

    $sql = "UPDATE drum SET drum_used=:total_cable, drum_remaining=drum_full-:total_cable WHERE drum_id=:drum_id";
    $stmt2 = $con->prepare($sql);
    $stmt2->bindParam(':total_cable', $total_cable, PDO::PARAM_INT);
    $stmt2->bindParam(':drum_id', $drum_id, PDO::PARAM_INT);
    $stmt2->execute();

    header("Location: ../index.php?page=stock/list_stock_cable");
    exit();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
