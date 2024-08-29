<?php
include("../connect.php");
session_start();

try {
    $con->beginTransaction();

    $route = $_POST['route'];
    $section = $_POST['section'];
    $team = $_POST['team'];
    $cable_form = $_POST['cable_form'];
    $cable_to = $_POST['cable_to'];
    $cable_work = $_POST['cable_work'];
    $drum_id = $_POST['drum_id'];
    $cable_used = $cable_form - $cable_to;
    $employee_id = $_SESSION['employee_id'];

    $strsql = 'SELECT SUM(cable_used) as total_cable FROM cable WHERE drum_id = :drum_id';
    $stmt = $con->prepare($strsql);
    $stmt->bindParam(':drum_id', $drum_id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $total_cable = $result['total_cable'] + $cable_used;

    if ($total_cable > 4000) {
        $con->rollBack();
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'ไม่สามารถเพิ่มข้อมูลได้ จำนวนเคลเบิลเกิน 4000 เมตร']);
        exit();
    }

    $stmt = $con->prepare("INSERT INTO cable (route_name, installed_section, placing_team, cable_form, cable_to, cable_used, drum_id, cable_work, employee_id)
    VALUES (:route_name, :installed_section, :placing_team, :cable_form, :cable_to, :cable_used, :drum_id, :cable_work, :employee_id)");

    $stmt->bindParam(':route_name', $route);
    $stmt->bindParam(':installed_section', $section);
    $stmt->bindParam(':placing_team', $team);
    $stmt->bindParam(':cable_form', $cable_form);
    $stmt->bindParam(':cable_to', $cable_to);
    $stmt->bindParam(':cable_used', $cable_used);
    $stmt->bindParam(':drum_id', $drum_id);
    $stmt->bindParam(':cable_work', $cable_work);
    $stmt->bindParam(':employee_id', $employee_id);
    $stmt->execute();

    $cable_id = $con->lastInsertId();

    $sql = "UPDATE drum SET drum_used=:total_cable, drum_remaining=drum_full-:total_cable WHERE drum_id=:drum_id";
    $stmt2 = $con->prepare($sql);
    $stmt2->bindParam(':total_cable', $total_cable, PDO::PARAM_INT);
    $stmt2->bindParam(':drum_id', $drum_id, PDO::PARAM_INT);
    $stmt2->execute();

    $stmtLog = $con->prepare("INSERT INTO log (log_status, log_detail, user_id) VALUES (:log_status, :log_detail, :user_id)");
    $logStatus = 'Cable Inserted';
    $logDetail = 'Cable ID: ' . $cable_id . ', Route: ' . $route . ', Section: ' . $section . ', Used: ' . $cable_used;
    $user_id = $_SESSION['user_id'];
    $stmtLog->bindParam(':log_status', $logStatus);
    $stmtLog->bindParam(':log_detail', $logDetail);
    $stmtLog->bindParam(':user_id', $user_id);
    $stmtLog->execute();

    $con->commit();
    echo json_encode(['success' => true]);
    exit();
} catch (PDOException $e) {
    $con->rollBack();
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'เกิดข้อผิดพลาด']);
    exit();
}

$con = null;
