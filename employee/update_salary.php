<?php
include('../connect.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employee_id = $_POST['salary_detail_id'];
    $salary = $_POST['salary'];
    $ot = $_POST['ot'];
    $social_security = $_POST['social_security'];
    $other = $_POST['other'];

    try {
        $con->beginTransaction();

        $total_salary = $salary + $ot + $social_security + $other;

        if ($employee) {
            // ตรวจสอบว่ามีการบันทึก salary ในเดือนและปีนี้สำหรับ employee นี้หรือยัง
            $stmt_check_salary = $con->prepare("SELECT employee_id FROM salary WHERE employee_id = :employee_id");
            $stmt_check_salary->bindParam(':employee_id', $employee['employee_id']);
            $stmt_check_salary->execute();
            $existing_salary = $stmt_check_salary->fetch(PDO::FETCH_ASSOC);

            if ($existing_salary) {
                // ถ้ามีการบันทึกอยู่แล้ว ทำการอัพเดต
                $stmt_update_salary = $con->prepare("UPDATE salary SET salary = :salary, ot = :ot, social_security = :social_security, other = :other, total_salary = :total_salary WHERE salary_id = :salary_id");
                $stmt_update_salary->bindParam(':salary', $salary);
                $stmt_update_salary->bindParam(':ot', $ot);
                $stmt_update_salary->bindParam(':social_security', $social_security);
                $stmt_update_salary->bindParam(':other', $other);
                $stmt_update_salary->bindParam(':total_salary', $total_salary);
                $stmt_update_salary->bindParam(':salary_id', $existing_salary['salary_id']);
                $stmt_update_salary->execute();

                $logStatus = 'Salary Updated';
            }

            // บันทึกการกระทำลงใน log
            $stmtLog = $con->prepare("INSERT INTO log (log_status, log_detail, user_id) VALUES (:log_status, :log_detail, :user_id)");
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
