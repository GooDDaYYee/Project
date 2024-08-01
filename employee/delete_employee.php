<?php
include('../connect.php');

if (isset($_GET['employee_id'])) {
    $employee_id = $_GET['employee_id'];

    try {

        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        $con->beginTransaction();

        $stmtEmployee = $con->prepare("DELETE FROM employee WHERE employee_id = :employee_id");
        $stmtEmployee->bindParam(':employee_id', $employee_id);
        $stmtEmployee->execute();

        $stmtUser = $con->prepare("DELETE FROM users WHERE employee_id = :employee_id");
        $stmtUser->bindParam(':employee_id', $employee_id);
        $stmtUser->execute();

        $con->commit();

        header("Location: ../index.php?page=employee\list_employee");
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
