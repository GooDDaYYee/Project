<?php
include('../connect.php');
session_start();

if (isset($_GET['salary_id'])) {
    $salary_id = $_GET['salary_id'];

    try {
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $con->beginTransaction();

        $stmtEmployee = $con->prepare("DELETE FROM salary WHERE salary_id = :salary_id");
        $stmtEmployee->bindParam(':salary_id', $salary_id);
        $stmtEmployee->execute();

        $stmtLog = $con->prepare("INSERT INTO log (log_status, log_detail, user_id) VALUES (:log_status, :log_detail, :user_id)");
        $logStatus = 'Salary Deleted';
        $logDetail = 'Salary ID: ' . $salary_id;
        $user_id = $_SESSION['user_id'];
        $stmtLog->bindParam(':log_status', $logStatus);
        $stmtLog->bindParam(':log_detail', $logDetail);
        $stmtLog->bindParam(':user_id', $user_id);
        $stmtLog->execute();

        $con->commit();
    } catch (PDOException $e) {
        $con->rollBack();
        echo '<script>
        alert("เกิดข้อผิดพลาด: ' . $e->getMessage() . '");
        history.back();
        </script>';
    }
    $con = null;
} else {
    echo "Invalid request.";
}
