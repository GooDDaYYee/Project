<?php
include('../connect.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $salary_id = $_POST['salary_id'];
    $salary = $_POST['salary'];
    $ot = $_POST['ot'];
    $social_security = $_POST['social_security'];
    $other = $_POST['other'];

    try {
        $con->beginTransaction();

        $total_salary = $salary + $ot + $social_security + $other;

        $stmt_check_employee = $con->prepare("SELECT * FROM salary WHERE salary_id = :salary_id");
        $stmt_check_employee->bindParam(':salary_id', $salary_id);
        $stmt_check_employee->execute();
        $existing_salary = $stmt_check_employee->fetch(PDO::FETCH_ASSOC);

        if ($existing_salary) {

            $stmt_update_salary = $con->prepare("UPDATE salary SET salary = :salary, ot = :ot, social_security = :social_security, other = :other, total_salary = :total_salary WHERE salary_id = :salary_id");
            $stmt_update_salary->bindParam(':salary', $salary);
            $stmt_update_salary->bindParam(':ot', $ot);
            $stmt_update_salary->bindParam(':social_security', $social_security);
            $stmt_update_salary->bindParam(':other', $other);
            $stmt_update_salary->bindParam(':total_salary', $total_salary);
            $stmt_update_salary->bindParam(':salary_id', $salary_id);
            $stmt_update_salary->execute();

            $logStatus = 'Salary Updated';

            $stmtLog = $con->prepare("INSERT INTO log (log_status, log_detail, user_id) VALUES (:log_status, :log_detail, :user_id)");
            $logDetail = 'Salary ID: ' . $salary_id . ', User ID: ' . $existing_salary['employee_id'];
            $admin_user_id = $_SESSION['user_id'];
            $stmtLog->bindParam(':log_status', $logStatus);
            $stmtLog->bindParam(':log_detail', $logDetail);
            $stmtLog->bindParam(':user_id', $admin_user_id);
            $stmtLog->execute();

            $con->commit();
            echo json_encode(['success' => true]);
            exit();
        } else {
            $con->rollBack();
            http_response_code(400);
            echo json_encode(['success' => false]);
            exit();
        }
    } catch (PDOException $e) {
        $con->rollBack();
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'เชื่อมต่อฐานข้อมูลล้มเหลว']);
        exit();
    }
}

$con = null;
