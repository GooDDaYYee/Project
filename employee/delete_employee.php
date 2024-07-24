<?php
include('../connect.php');

if (isset($_GET['employee_id'])) {
    $employee_id = $_GET['employee_id'];

    try {

        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        $con->beginTransaction();

        $stmtFindUser = $con->prepare("SELECT user_id FROM employee WHERE employee_id = :employee_id");
        $stmtFindUser->bindParam(':employee_id', $employee_id);
        $stmtFindUser->execute();
        $user_id = $stmtFindUser->fetchColumn();

        $stmtDeleteEmployee = $con->prepare("DELETE FROM employee WHERE employee_id = :employee_id");
        $stmtDeleteEmployee->bindParam(':employee_id', $employee_id);
        $stmtDeleteEmployee->execute();

        if ($user_id) {
            $stmtDeleteUser = $con->prepare("DELETE FROM users WHERE user_id = :user_id");
            $stmtDeleteUser->bindParam(':user_id', $user_id);
            $stmtDeleteUser->execute();
        }

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
