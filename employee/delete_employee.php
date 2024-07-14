<?php
include('connect.php');

if (isset($_GET['employee_id'])) {
    $employee_id = $_GET['employee_id'];

    try {
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $con->beginTransaction();

        $stmtDetail = $con->prepare("DELETE FROM employee WHERE employee_id = :employee_id");
        $stmtDetail->bindParam(':employee_id', $employee_id);
        $stmtDetail->execute();

        $con->commit();

        header("Location: ../index.php?page=employee/list_employee");
        exit();
    } catch (PDOException $e) {
        $con->rollBack();
        echo "Error: " . $e->getMessage();
    }

    $con = null;
} else {
    echo "Invalid request.";
}
