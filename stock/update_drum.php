<?php
include("../connect.php");
session_start(); // Start session to access session variables

try {
    $drum_id = $_POST['edit_drum_id'];
    $drum_no = $_POST['edit_drum_no'];
    $drum_to = $_POST['edit_drum_to'];
    $drum_description = $_POST['edit_drum_description'];
    $drum_full = $_POST['edit_drum_full'];
    $drum_company = $_POST['edit_drum_company'];
    $drum_cable_company = $_POST['edit_drum_cable_company'];

    $con->beginTransaction();

    // Check if the drum already exists
    $strsql = "SELECT * FROM drum WHERE drum_no = :drum_no";
    $stmt = $con->prepare($strsql);
    $stmt->bindParam(':drum_no', $drum_no);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result && ($drum_company == $result['drum_company'] && $drum_cable_company == $result['drum_cable_company'])) {
        echo '<script>
        alert("มีข้อมูล drum อยู่แล้วกรุณาเลือกใหม่");
        history.back();
        </script>';
        exit();
    }

    if ($result) {
        // Update the drum record
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
            // Log the drum update
            $stmtLog = $con->prepare("INSERT INTO log (log_status, log_detail, user_id) VALUES (:log_status, :log_detail, :user_id)");
            $logStatus = 'Drum Updated';
            $logDetail = 'Drum ID: ' . $drum_id . ', Drum No: ' . $drum_no . ', Company: ' . $drum_company . ', Cable Company: ' . $drum_cable_company;
            $user_id = $_SESSION['user_id']; // Use user_id from session
            $stmtLog->bindParam(':log_status', $logStatus);
            $stmtLog->bindParam(':log_detail', $logDetail);
            $stmtLog->bindParam(':user_id', $user_id);
            $stmtLog->execute();

            $con->commit();
            header("Location: ../index.php?page=stock/list_stock_drum");
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