<?php
include('../connect.php');

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    try {
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $con->beginTransaction();

        $stmtFindUser = $con->prepare("SELECT employee_id FROM users WHERE user_id = :user_id");
        $stmtFindUser->bindParam(':user_id', $user_id);
        $stmtFindUser->execute();
        $employee_id = $stmtFindUser->fetchColumn();

        $stmtDeleteUser = $con->prepare("DELETE FROM users WHERE user_id = :user_id");
        $stmtDeleteUser->bindParam(':user_id', $user_id);
        $stmtDeleteUser->execute();

        if ($employee_id) {
            $stmtDeleteEmployee = $con->prepare("DELETE FROM employee WHERE employee_id = :employee_id");
            $stmtDeleteEmployee->bindParam(':employee_id', $employee_id);
            $stmtDeleteEmployee->execute();
        }

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
