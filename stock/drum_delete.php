<?php
include('../connect.php');

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

            $con->commit();

            header("Location: ../index.php?page=stock/list_stock_drum");
            exit();
        } else {
            $con->rollBack();
            $drum_id = $_GET['drum_id'];
            echo "<script type='text/javascript'>alert('ไม่สามารถลบข้อมูลได้ยังมีงานที่ใช้ drum นี้อยู่');window.location.href='../index.php?page=stock/list_stock_drum';</script>";
        }
    } catch (PDOException $e) {
        $con->rollBack();
        echo "Error: " . $e->getMessage();
    }

    $con = null;
}
