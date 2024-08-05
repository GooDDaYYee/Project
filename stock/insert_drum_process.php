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
        echo '<script>
        alert("มีข้อมูล drum อยู่แล้วกรุณาเลือกใหม่");
        history.back();
        </script>';
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

        $con->commit();

        echo '<script>
            alert("เพิ่มข้อมูลสำเร็จ");
            history.back();
            </script>';
    } else {
        echo '<script>
            alert("เพิ่มข้อมูลไม่สำเร็จ");
            history.back();
            </script>';
    }

    header("Location: index.php?page=" . base64_encode('stock/list_stock_drum'));
    exit();
} catch (PDOException $e) {
    $con->rollBack();
    echo '<script>
        alert("เกิดข้อผิดพลาด: ' . $e->getMessage() . '");
        history.back();
        </script>';
}

$con = null;
