<?php
include('../connect.php');
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $employee_id = $_POST['name'];
    $salary = $_POST['salary'];
    $ot = $_POST['ot'];
    $social_security = $_POST['social_security'];
    $other = $_POST['other'];
    $month = $_POST['month'];
    $year = $_POST['year'];

    $salary_date = $year . '-' . sprintf('%02d', array_search($month, ["มกราคม ", "กุมภาพันธ์ ", "มีนาคม ", "เมษายน ", "พฤษภาคม ", "มิถุนายน ", "กรกฎาคม ", "สิงหาคม ", "กันยายน ", "ตุลาคม ", "พฤศจิกายน ", "ธันวาคม "]) + 1) . '-01';

    try {
        $con->beginTransaction();

        $stmt_employee = $con->prepare("SELECT employee_id FROM employee WHERE employee_id = :employee_id AND employee_status = 1");
        $stmt_employee->bindParam(':employee_id', $employee_id);
        $stmt_employee->execute();
        $employee = $stmt_employee->fetch(PDO::FETCH_ASSOC);

        $total_salary = $salary + $ot + $social_security + $other;

        if ($employee) {
            $stmt_salary = $con->prepare("INSERT INTO salary (salary, ot, social_security, other, salary_date, employee_id, total_salary) VALUES (:salary, :ot, :social_security, :other, :salary_date, :employee_id, :total_salary)");
            $stmt_salary->bindParam(':salary', $salary);
            $stmt_salary->bindParam(':ot', $ot);
            $stmt_salary->bindParam(':social_security', $social_security);
            $stmt_salary->bindParam(':other', $other);
            $stmt_salary->bindParam(':total_salary', $total_salary);
            $stmt_salary->bindParam(':salary_date', $salary_date);
            $stmt_salary->bindParam(':employee_id', $employee['employee_id']);
            $stmt_salary->execute();

            $stmtLog = $con->prepare("INSERT INTO log (log_status, log_detail, user_id) VALUES (:log_status, :log_detail, :user_id)");
            $logStatus = 'Salary Created';
            $logDetail = 'User ID: ' . $user_id . ', Employee ID: ' . $employee_id;
            $admin_user_id = $_SESSION['user_id'];
            $stmtLog->bindParam(':log_status', $logStatus);
            $stmtLog->bindParam(':log_detail', $logDetail);
            $stmtLog->bindParam(':user_id', $admin_user_id);
            $stmtLog->execute();
        }
        $con->commit();

        header("Location: ../index.php?page=" . base64_encode('employee/list_employee_salary'));
        exit();
    } catch (PDOException $e) {
        $con->rollBack();
        echo "Error: " . $e->getMessage();
    }
}
$con = null;
