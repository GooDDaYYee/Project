<?php
include("../connect.php");
session_start();

try {
    $con->beginTransaction();

    $cable_id = $_POST['cable_id'];
    $route = $_POST['route'];
    $section = $_POST['section'];
    $team = $_POST['team'];
    $cable_form = $_POST['cable_form'];
    $cable_to = $_POST['cable_to'];
    $cable_work = $_POST['cable_work'];
    $drum_id = $_POST['drum_id'];
    $new_cable_used = $cable_form - $cable_to;

    $strsql2 = 'SELECT cable_used FROM cable WHERE cable_id = :cable_id';
    $stmt = $con->prepare($strsql2);
    $stmt->bindParam(':cable_id', $cable_id, PDO::PARAM_INT);
    $stmt->execute();
    $result2 = $stmt->fetch(PDO::FETCH_ASSOC);
    $old_cable_used = $result2['cable_used'];

    $strsql = 'SELECT SUM(cable_used) as total_cable FROM cable WHERE drum_id = :drum_id';
    $stmt = $con->prepare($strsql);
    $stmt->bindParam(':drum_id', $drum_id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $total_cable = ($result['total_cable'] - $old_cable_used) + $new_cable_used;

    if ($total_cable > 4000) {
        echo '<script>
            alert("ไม่สามารถเพิ่มข้อมูลได้: ปริมาณสายเคเบิลทั้งหมดเกิน 4000");
            history.back();
            </script>';
        exit();
    }

    $stmt = $con->prepare("UPDATE cable SET 
        route_name = :route_name, 
        installed_section = :installed_section, 
        placing_team = :placing_team, 
        cable_form = :cable_form, 
        cable_to = :cable_to, 
        cable_used = :cable_used, 
        drum_id = :drum_id, 
        cable_work = :cable_work 
        WHERE cable_id = :cable_id");

    $stmt->bindParam(':route_name', $route);
    $stmt->bindParam(':installed_section', $section);
    $stmt->bindParam(':placing_team', $team);
    $stmt->bindParam(':cable_form', $cable_form);
    $stmt->bindParam(':cable_to', $cable_to);
    $stmt->bindParam(':cable_used', $new_cable_used);
    $stmt->bindParam(':drum_id', $drum_id);
    $stmt->bindParam(':cable_work', $cable_work);
    $stmt->bindParam(':cable_id', $cable_id);

    $stmt->execute();

    $sql = "UPDATE drum SET drum_used=:total_cable, drum_remaining=drum_full-:total_cable WHERE drum_id=:drum_id";
    $stmt2 = $con->prepare($sql);
    $stmt2->bindParam(':total_cable', $total_cable, PDO::PARAM_INT);
    $stmt2->bindParam(':drum_id', $drum_id, PDO::PARAM_INT);
    $stmt2->execute();

    $stmtLog = $con->prepare("INSERT INTO log (log_status, log_detail, user_id) VALUES (:log_status, :log_detail, :user_id)");
    $logStatus = 'Cable Updated';
    $logDetail = 'Cable ID: ' . $cable_id . ', Route: ' . $route . ', Section: ' . $section . ', Used: ' . $new_cable_used;
    $user_id = $_SESSION['user_id'];
    $stmtLog->bindParam(':log_status', $logStatus);
    $stmtLog->bindParam(':log_detail', $logDetail);
    $stmtLog->bindParam(':user_id', $user_id);
    $stmtLog->execute();

    $con->commit();

    header("Location: ../index.php?page=" . base64_encode('stock/list_stock_cable'));
    exit();
} catch (PDOException $e) {
    $con->rollBack();
    echo '<script>
        alert("เกิดข้อผิดพลาด: ' . $e->getMessage() . '");
        history.back();
        </script>';
}

$con = null;
