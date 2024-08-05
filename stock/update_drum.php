<?php
include("../connect.php");
session_start();

try {
    $drum_id = $_POST['edit_drum_id'];
    $drum_no = $_POST['edit_drum_no'];
    $drum_to = $_POST['edit_drum_to'];
    $drum_description = $_POST['edit_drum_description'];
    $drum_full = $_POST['edit_drum_full'];
    $drum_company = $_POST['edit_drum_company'];
    $drum_cable_company = $_POST['edit_drum_cable_company'];

    $con->beginTransaction();

    // ตรวจสอบข้อมูลที่มีอยู่แล้ว
    $strsql = "SELECT * FROM drum WHERE drum_id = :drum_id";
    $stmt = $con->prepare($strsql);
    $stmt->bindParam(':drum_id', $drum_id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        // ตรวจสอบข้อมูลซ้ำกันในการอัปเดต
        $checkDupSQL = "SELECT * FROM drum WHERE drum_no = :drum_no AND drum_company = :drum_company AND drum_cable_company = :drum_cable_company AND drum_id != :drum_id";
        $checkDupStmt = $con->prepare($checkDupSQL);
        $checkDupStmt->bindParam(':drum_no', $drum_no);
        $checkDupStmt->bindParam(':drum_company', $drum_company);
        $checkDupStmt->bindParam(':drum_cable_company', $drum_cable_company);
        $checkDupStmt->bindParam(':drum_id', $drum_id);
        $checkDupStmt->execute();
        $dupResult = $checkDupStmt->fetch(PDO::FETCH_ASSOC);

        if ($dupResult) {
            echo '<script>
            alert("มีข้อมูล drum อยู่แล้วกรุณาเลือกใหม่");
            history.back();
            </script>';
            exit();
        }

        // อัปเดตข้อมูล
        $updateSQL = "UPDATE drum 
                      SET drum_no = :drum_no, drum_to = :drum_to, drum_description = :drum_description, 
                          drum_full = :drum_full, drum_remaining = :drum_full, 
                          drum_company = :drum_company, drum_cable_company = :drum_cable_company 
                      WHERE drum_id = :drum_id";

        $updateStmt = $con->prepare($updateSQL);
        $updateStmt->bindParam(':drum_no', $drum_no);
        $updateStmt->bindParam(':drum_to', $drum_to);
        $updateStmt->bindParam(':drum_description', $drum_description);
        $updateStmt->bindParam(':drum_full', $drum_full);
        $updateStmt->bindParam(':drum_company', $drum_company);
        $updateStmt->bindParam(':drum_cable_company', $drum_cable_company);
        $updateStmt->bindParam(':drum_id', $drum_id);

        $updateResult = $updateStmt->execute();

        if ($updateResult) {
            $stmtLog = $con->prepare("INSERT INTO log (log_status, log_detail, user_id) VALUES (:log_status, :log_detail, :user_id)");
            $logStatus = 'Drum Updated';
            $logDetail = 'Drum ID: ' . $drum_id . ', Drum No: ' . $drum_no . ', Company: ' . $drum_company . ', Cable Company: ' . $drum_cable_company;
            $user_id = $_SESSION['user_id'];
            $stmtLog->bindParam(':log_status', $logStatus);
            $stmtLog->bindParam(':log_detail', $logDetail);
            $stmtLog->bindParam(':user_id', $user_id);
            $stmtLog->execute();

            $con->commit();

            header("Location: ../index.php?page=" . base64_encode('stock/list_stock_drum'));
            exit();
        } else {
            echo '<script>
            alert("อัปเดตข้อมูลไม่สำเร็จ");
            history.back();
            </script>';
        }
    } else {
        echo '<script>
        alert("ไม่พบข้อมูล drum ที่ระบุ");
        history.back();
        </script>';
    }
} catch (Exception $e) {
    $con->rollBack();
    echo '<script>
        alert("เกิดข้อผิดพลาด: ' . $e->getMessage() . '");
        history.back();
        </script>';
}

$con = null;
