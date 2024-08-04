<?php
include('../connect.php');
session_start(); // Start session to access session variables

if (isset($_GET['employee_id'])) {
    $employee_id = $_GET['employee_id'];

    try {
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $con->beginTransaction();

        // Delete the employee record
        $stmtEmployee = $con->prepare("DELETE FROM employee WHERE employee_id = :employee_id");
        $stmtEmployee->bindParam(':employee_id', $employee_id);
        $stmtEmployee->execute();

        // Delete the associated user record
        $stmtUser = $con->prepare("DELETE FROM users WHERE employee_id = :employee_id");
        $stmtUser->bindParam(':employee_id', $employee_id);
        $stmtUser->execute();

        // Log the deletion
        $stmtLog = $con->prepare("INSERT INTO log (log_status, log_detail, user_id) VALUES (:log_status, :log_detail, :user_id)");
        $logStatus = 'Employee Deleted';
        $logDetail = 'Employee ID: ' . $employee_id;
        $user_id = $_SESSION['user_id']; // Get user ID from session
        $stmtLog->bindParam(':log_status', $logStatus);
        $stmtLog->bindParam(':log_detail', $logDetail);
        $stmtLog->bindParam(':user_id', $user_id);
        $stmtLog->execute();

        $con->commit();

        header("Location: ../index.php?page=employee/list_employee");
        exit();
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
