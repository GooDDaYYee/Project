<?php
include('../connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $employee_name = $_POST['name'];
    $salary = $_POST['salary'];
    $ot = $_POST['ot'];
    $social_security = $_POST['social_security'];
    $other = $_POST['other'];
    $month = $_POST['month'];
    $year = $_POST['year'];

    $salary_date = $year . '-' . sprintf('%02d', array_search($month, ["มกราคม ", "กุมภาพันธ์ ", "มีนาคม ", "เมษายน ", "พฤษภาคม ", "มิถุนายน ", "กรกฎาคม ", "สิงหาคม ", "กันยายน ", "ตุลาคม ", "พฤศจิกายน ", "ธันวาคม "]) + 1) . '-01';

    try {
        $con->beginTransaction();

        $stmt_salary = $con->prepare("INSERT INTO salary (salary, ot, social_security, other, salary_date) VALUES (:salary, :ot, :social_security, :other, :salary_date)");
        $stmt_salary->bindParam(':salary', $salary);
        $stmt_salary->bindParam(':ot', $ot);
        $stmt_salary->bindParam(':social_security', $social_security);
        $stmt_salary->bindParam(':other', $other);
        $stmt_salary->bindParam(':salary_date', $salary_date);
        $stmt_salary->execute();

        $salary_id = $con->lastInsertId();

        $stmt_employee = $con->prepare("SELECT employee_id, employee_name, employee_lastname FROM employee WHERE employee_name = :employee_name AND employee_status = 1");
        $stmt_employee->bindParam(':employee_name', $employee_name);
        $stmt_employee->execute();
        $employee = $stmt_employee->fetch(PDO::FETCH_ASSOC);

        if ($employee) {
            $stmt_salary_detail = $con->prepare("INSERT INTO salary_detail (employee_name, employee_lastname, employee_id, salary_id) VALUES (:employee_name, :employee_lastname, :employee_id, :salary_id)");
            $stmt_salary_detail->bindParam(':employee_name', $employee['employee_name']);
            $stmt_salary_detail->bindParam(':employee_lastname', $employee['employee_lastname']);
            $stmt_salary_detail->bindParam(':employee_id', $employee['employee_id']);
            $stmt_salary_detail->bindParam(':salary_id', $salary_id);
            $stmt_salary_detail->execute();
        }

        $con->commit();

        echo "Salary details added successfully!";
    } catch (PDOException $e) {

        $con->rollBack();
        echo "Error: " . $e->getMessage();
    }
}

$con = null;
