<?php
include('../connect.php');
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $employee_id = $_POST['employee_id'];
    $salary = $_POST['salary'];
    $ot = $_POST['ot'];
    $social_security = $_POST['social_security'];
    $other = $_POST['other'];
    $month = $_POST['month'];
    $year = $_POST['year'];

    // ตรวจสอบค่าว่าง ของเดือน และ ค่าที่ส่งมาเป็น 0
    if ($month == '0' || $year == '0' || $month == ' ' || $year == ' ') {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'กรุณาเลือกเดือนและปี']);
        exit();
    }

    $salary_date = $year . '-' . sprintf('%02d', array_search($month, ["มกราคม ", "กุมภาพันธ์ ", "มีนาคม ", "เมษายน ", "พฤษภาคม ", "มิถุนายน ", "กรกฎาคม ", "สิงหาคม ", "กันยายน ", "ตุลาคม ", "พฤศจิกายน ", "ธันวาคม "]) + 1) . '-01';

    try {
        $con->beginTransaction();

        $stmt_employee = $con->prepare("SELECT employee_id FROM employee WHERE employee_id = :employee_id AND employee_status = 1");
        $stmt_employee->bindParam(':employee_id', $employee_id);
        $stmt_employee->execute();
        $employee = $stmt_employee->fetch(PDO::FETCH_ASSOC);

        if ($employee) {
            $stmt_check = $con->prepare("SELECT salary_id FROM salary WHERE employee_id = :employee_id AND salary_date = :salary_date");
            $stmt_check->bindParam(':employee_id', $employee_id);
            $stmt_check->bindParam(':salary_date', $salary_date);
            $stmt_check->execute();
            $existing_salary = $stmt_check->fetch(PDO::FETCH_ASSOC);

            if ($existing_salary) {
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => 'มีข้อมูลเงินเดือนของพนักงานมีอยู่แล้ว']);
                exit();
            } else {

                $total_salary = $salary + $ot + $social_security + $other;

                $stmt_salary = $con->prepare("INSERT INTO salary (salary, ot, social_security, other, salary_date, employee_id, total_salary) VALUES (:salary, :ot, :social_security, :other, :salary_date, :employee_id, :total_salary)");
                $stmt_salary->bindParam(':salary', $salary);
                $stmt_salary->bindParam(':ot', $ot);
                $stmt_salary->bindParam(':social_security', $social_security);
                $stmt_salary->bindParam(':other', $other);
                $stmt_salary->bindParam(':total_salary', $total_salary);
                $stmt_salary->bindParam(':salary_date', $salary_date);
                $stmt_salary->bindParam(':employee_id', $employee['employee_id']);
                $stmt_salary->execute();

                $salary_id = $con->lastInsertId();

                $stmtLog = $con->prepare("INSERT INTO log (log_status, log_detail, user_id) VALUES (:log_status, :log_detail, :user_id)");
                $logStatus = 'Salary Created';
                $logDetail = 'Salary ID: ' . $salary_id;
                $admin_user_id = $_SESSION['user_id'];
                $stmtLog->bindParam(':log_status', $logStatus);
                $stmtLog->bindParam(':log_detail', $logDetail);
                $stmtLog->bindParam(':user_id', $admin_user_id);
                $stmtLog->execute();
            }
            $con->commit();
            echo json_encode(['success' => true]);
            exit();
        } else {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'เพิ่มข้อมูลไม่ทำเสร็จ']);
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
