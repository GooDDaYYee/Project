<?php
include('../connect.php');
session_start();

if (isset($_GET['drum_id'])) {
    $drum_id = $_GET['drum_id'];

    try {
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $con->beginTransaction();

        $stmtCheck = $con->prepare("SELECT drum_used, drum_no, drum_company, drum_cable_company FROM drum WHERE drum_id = :drum_id");
        $stmtCheck->bindParam(':drum_id', $drum_id);
        $stmtCheck->execute();
        $result = $stmtCheck->fetch(PDO::FETCH_ASSOC);

        if ($result && $result['drum_used'] == 0) {

            $stmtDetail = $con->prepare("DELETE FROM drum WHERE drum_id = :drum_id");
            $stmtDetail->bindParam(':drum_id', $drum_id);
            $stmtDetail->execute();

            $stmtLog = $con->prepare("INSERT INTO log (log_status, log_detail, user_id) VALUES (:log_status, :log_detail, :user_id)");
            $logStatus = 'Drum Deleted';
            $logDetail = 'Drum ID: ' . $drum_id . ', Drum No: ' . $result['drum_no'] . ', Company: ' . $result['drum_company'] . ', Cable Company: ' . $result['drum_cable_company'];
            $user_id = $_SESSION['user_id'];
            $stmtLog->bindParam(':log_status', $logStatus);
            $stmtLog->bindParam(':log_detail', $logDetail);
            $stmtLog->bindParam(':user_id', $user_id);
            $stmtLog->execute();

            $con->commit();
            echo json_encode(['success' => true]);
            exit();
        } else {
            $con->rollBack();
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'ไม่สามารถลยข้อมูล Drumได้ มีการเรียกใช้จำนวนเคเบิลอยู่!']);
            exit();
        }
    } catch (PDOException $e) {
        $con->rollBack();
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'เกิดข้อผิดพลาด!']);
        exit();
    }

    $con = null;
} else {
    $con->rollBack();
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'ไม่สามารถส่งข้อมูลได้!']);
    exit();
}
