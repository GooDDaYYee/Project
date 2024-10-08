<?php
include("../connect.php");
session_start();

try {
    $drum_no = $_POST['drum_no'];
    $drum_to = $_POST['drum_to'];
    $drum_description = $_POST['drum_description'];
    $drum_full = $_POST['drum_full'];
    $drum_company = $_POST['drum_company'];
    $drum_cable_company = $_POST['drum_cable_company'];
    $employee_id = $_SESSION['employee_id'];

    $strsql = "SELECT * FROM drum WHERE drum_no=:drum_no";
    $stmt = $con->prepare($strsql);
    $stmt->bindParam(':drum_no', $drum_no);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result && ($drum_company == $result['drum_company'] && $drum_cable_company == $result['drum_cable_company'])) {
        $con->rollBack();
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'มีข้อมูล drum อยู่แล้วกรุณาเลือกใหม่']);
        exit();
    }

    $con->beginTransaction();

    $stmt = $con->prepare("INSERT INTO drum (drum_no, drum_to, drum_description, drum_full, drum_remaining, drum_company, drum_cable_company, employee_id)
    VALUES (:drum_no, :drum_to, :drum_description, :drum_full, :drum_remaining, :drum_company, :drum_cable_company, :employee_id)");

    $stmt->bindParam(':drum_no', $drum_no);
    $stmt->bindParam(':drum_to', $drum_to);
    $stmt->bindParam(':drum_description', $drum_description);
    $stmt->bindParam(':drum_full', $drum_full);
    $stmt->bindParam(':drum_remaining', $drum_full);
    $stmt->bindParam(':drum_company', $drum_company);
    $stmt->bindParam(':drum_cable_company', $drum_cable_company);
    $stmt->bindParam(':employee_id', $employee_id);

    $result = $stmt->execute();
    $drum_id = $con->lastInsertId();

    if ($result) {
        $stmtLog = $con->prepare("INSERT INTO log (log_status, log_detail, user_id) VALUES (:log_status, :log_detail, :user_id)");
        $logStatus = 'Drum Inserted';
        $logDetail = 'Drum ID: ' . $drum_id . ', Drum No: ' . $drum_no . ', Company: ' . $drum_company . ', Cable Company: ' . $drum_cable_company;
        $user_id = $_SESSION['user_id'];
        $stmtLog->bindParam(':log_status', $logStatus);
        $stmtLog->bindParam(':log_detail', $logDetail);
        $stmtLog->bindParam(':user_id', $user_id);
        $stmtLog->execute();
    } else {
        $con->rollBack();
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'เพิ่มข้อมูล Drum ไม่สำเร็จ!']);
        exit();
    }

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
