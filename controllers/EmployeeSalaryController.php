<?php
require_once __DIR__ . '/BaseController.php';

class EmployeeSalaryController extends BaseController
{
    public function index()
    {
        $month = isset($_GET['month']) ? $_GET['month'] : date('m');
        $year = isset($_GET['year']) ? $_GET['year'] : date('Y');
        
        $salaries = $this->fetchSalaries($month, $year);
        $months = $this->getMonths();
        
        $data = [
            'salaries' => $salaries,
            'months' => $months,
            'selectedMonth' => $month,
            'selectedYear' => $year
        ];

        $pageTitle = 'จัดการเงินเดือน - PSNK TELECOM';
        $this->render('employee_salary/index', ['pageTitle' => $pageTitle, 'data' => $data]);
    }

    private function fetchSalaries($month, $year)
    {
        $gregorian_year = $year + 543;
        $sql = "SELECT s.*, 
                DATE_FORMAT(s.salary_date, '%M') AS salary_month,
                DATE_FORMAT(s.salary_date, '%Y') AS salary_year,
                e.employee_name, 
                e.employee_lastname 
                FROM salary s
                INNER JOIN employee e ON s.employee_id = e.employee_id
                WHERE MONTH(s.salary_date) = :month AND YEAR(s.salary_date) = :year AND DAY(s.salary_date) = 1
                ORDER BY s.salary_id ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':month', $month, PDO::PARAM_INT);
        $stmt->bindParam(':year', $gregorian_year, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private function getMonths()
    {
        return [
            "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", 
            "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"
        ];
    }

    public function updateSalary()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $salary_id = $_POST['salary_id'];
            $salary = $_POST['salary'];
            $ot = $_POST['ot'];
            $social_security = $_POST['social_security'];
            $other = $_POST['other'];
            $total_salary = $salary + $ot - $social_security + $other;

            $sql = "UPDATE salary SET 
                    salary = :salary, 
                    ot = :ot, 
                    social_security = :social_security, 
                    other = :other,
                    total_salary = :total_salary
                    WHERE salary_id = :salary_id";

            try {
                $stmt = $this->db->prepare($sql);
                $stmt->execute([
                    ':salary' => $salary,
                    ':ot' => $ot,
                    ':social_security' => $social_security,
                    ':other' => $other,
                    ':total_salary' => $total_salary,
                    ':salary_id' => $salary_id
                ]);
                echo json_encode(['success' => true, 'message' => 'Salary updated successfully']);
            } catch (PDOException $e) {
                echo json_encode(['success' => false, 'message' => 'Error updating salary: ' . $e->getMessage()]);
            }
        }
    }

    public function deleteSalary()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $salary_id = $_POST['salary_id'];

            try {
                $stmt = $this->db->prepare("DELETE FROM salary WHERE salary_id = :salary_id");
                $stmt->execute([':salary_id' => $salary_id]);
                echo json_encode(['success' => true, 'message' => 'Salary deleted successfully']);
            } catch (PDOException $e) {
                echo json_encode(['success' => false, 'message' => 'Error deleting salary: ' . $e->getMessage()]);
            }
        }
    }
}