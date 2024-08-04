<?php
include('../connect.php');
session_start();

if (isset($_GET['drum_id'])) {
    $drum_id = $_GET['drum_id'];

    try {
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $con->beginTransaction();

        $stmtCheck = $con->prepare("SELECT drum_used FROM drum WHERE drum_id = :drum_id");
        $stmtCheck->bindParam(':drum_id', $drum_id);
        $stmtCheck->execute();
        $result = $stmtCheck->fetch(PDO::FETCH_ASSOC);

        if ($result && $result['drum_used'] == 0) {

            $stmtDetail = $con->prepare("DELETE FROM drum WHERE drum_id = :drum_id");
            $stmtDetail->bindParam(':drum_id', $drum_id);
            $stmtDetail->execute();

            $stmtLog = $con->prepare("INSERT INTO log (log_status, log_detail, user_id) VALUES (:log_status, :log_detail, :user_id)");
            $logStatus = 'Drum Deleted';
            $logDetail = 'Drum ID: ' . $drum_id . ' was successfully deleted.';
            $user_id = $_SESSION['user_id'];
            $stmtLog->bindParam(':log_status', $logStatus);
            $stmtLog->bindParam(':log_detail', $logDetail);
            $stmtLog->bindParam(':user_id', $user_id);
            $stmtLog->execute();

            $con->commit();

            header("Location: ../index.php?page=stock/list_stock_drum");
            exit();
        } else {
            $stmtLog = $con->prepare("INSERT INTO log (log_status, log_detail, user_id) VALUES (:log_status, :log_detail, :user_id)");
            $logStatus = 'Drum Deletion Failed';
            $logDetail = 'Attempted to delete Drum ID: ' . $drum_id . ' but it is currently in use.';
            $user_id = $_SESSION['user_id'];
            $stmtLog->bindParam(':log_status', $logStatus);
            $stmtLog->bindParam(':log_detail', $logDetail);
            $stmtLog->bindParam(':user_id', $user_id);
            $stmtLog->execute();

            $con->rollBack();
            echo "<script type='text/javascript'>alert('ไม่สามารถลบข้อมูลได้ยังมีงานที่ใช้ drum นี้อยู่');window.location.href='../index.php?page=stock/list_stock_drum';</script>";
        }
    } catch (PDOException $e) {
        if ($con->inTransaction()) {
            $con->rollBack();
        }
        echo "Error: " . $e->getMessage();
    }

    $con = null;
} else {
    echo "Invalid request.";
}
