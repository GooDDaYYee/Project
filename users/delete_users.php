<?php
include('../connect.php');
session_start(); // Start session to access session variables

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    try {
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $con->beginTransaction();

        // Find the associated employee_id
        $stmtFindUser = $con->prepare("SELECT employee_id FROM users WHERE user_id = :user_id");
        $stmtFindUser->bindParam(':user_id', $user_id);
        $stmtFindUser->execute();
        $employee_id = $stmtFindUser->fetchColumn();

        // Delete the user
        $stmtDeleteUser = $con->prepare("DELETE FROM users WHERE user_id = :user_id");
        $stmtDeleteUser->bindParam(':user_id', $user_id);
        $stmtDeleteUser->execute();

        // Delete the associated employee record if it exists
        if ($employee_id) {
            $stmtDeleteEmployee = $con->prepare("DELETE FROM employee WHERE employee_id = :employee_id");
            $stmtDeleteEmployee->bindParam(':employee_id', $employee_id);
            $stmtDeleteEmployee->execute();
        }

        // Log the user deletion
        $stmtLog = $con->prepare("INSERT INTO log (log_status, log_detail, user_id) VALUES (:log_status, :log_detail, :user_id)");
        $logStatus = 'User Deleted';
        $logDetail = 'User ID: ' . $user_id . ', Employee ID: ' . $employee_id;
        $admin_user_id = $_SESSION['user_id']; // Use user_id from session to log who performed the action
        $stmtLog->bindParam(':log_status', $logStatus);
        $stmtLog->bindParam(':log_detail', $logDetail);
        $stmtLog->bindParam(':user_id', $admin_user_id);
        $stmtLog->execute();

        $con->commit();

        header("Location: ../index.php?page=users/list_user");
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
