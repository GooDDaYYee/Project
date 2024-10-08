<?php
include('../connect.php');
session_start();

if (isset($_GET['cable_id'])) {
    $cable_id = $_GET['cable_id'];

    try {
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $con->beginTransaction();

        $stmtDetail = $con->prepare('SELECT * FROM cable WHERE cable_id = :cable_id');
        $stmtDetail->bindParam(':cable_id', $cable_id);
        $stmtDetail->execute();
        $result = $stmtDetail->fetch(PDO::FETCH_ASSOC);

        $stmtLog = $con->prepare("INSERT INTO log (log_status, log_detail, user_id) VALUES (:log_status, :log_detail, :user_id)");
        $logStatus = 'Cable Deleted';
        $logDetail = 'Cable ID: ' . $cable_id . ', Route: ' . $result['route_name'] . ', Section: ' . $result['installed_section'] . ', Used: ' . $result['cable_used'];
        $user_id = $_SESSION['user_id'];
        $stmtLog->bindParam(':log_status', $logStatus);
        $stmtLog->bindParam(':log_detail', $logDetail);
        $stmtLog->bindParam(':user_id', $user_id);
        $stmtLog->execute();

        $stmtDetail = $con->prepare("DELETE FROM cable WHERE cable_id = :cable_id");
        $stmtDetail->bindParam(':cable_id', $cable_id);
        $stmtDetail->execute();

        $con->commit();
    } catch (PDOException $e) {
        $con->rollBack();
        http_response_code(400);
        echo json_encode(['success' => false]);
        exit();
    }

    try {

        $strsql = 'SELECT d.drum_id, COALESCE(SUM(c.cable_used), 0) as total_cable 
                   FROM drum d 
                   LEFT JOIN cable c ON d.drum_id = c.drum_id 
                   GROUP BY d.drum_id';
        $stmt = $con->prepare($strsql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $row) {
            $total_cable = $row['total_cable'];
            $drum_id = $row['drum_id'];

            $sql = "UPDATE drum SET drum_used=:total_cable, drum_remaining=drum_full-:total_cable WHERE drum_id=:drum_id";
            $stmt2 = $con->prepare($sql);
            $stmt2->bindParam(':total_cable', $total_cable, PDO::PARAM_INT);
            $stmt2->bindParam(':drum_id', $drum_id, PDO::PARAM_INT);
            $stmt2->execute();
        }

        $con->commit();
        echo json_encode(['success' => true]);
        exit();
    } catch (PDOException $e) {
        $con->rollBack();
        http_response_code(400);
        echo json_encode(['success' => false]);
        exit();
    }

    $con = null;
} else {
    echo "Invalid request.";
}
