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

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->create_post();
        } else {
            $this->create_get();
        }
    }

    public function create_get()
    {
        $pageTitle = 'เพิ่มเงินเดือน - PSNK TELECOM';
        $this->render('employee_salary/create', ['pageTitle' => $pageTitle]);
    }

    public function create_post()
    {
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
                $this->db->beginTransaction();

                $stmt_employee = $this->db->prepare("SELECT employee_id FROM employee WHERE employee_id = :employee_id AND employee_status = 1");
                $stmt_employee->bindParam(':employee_id', $employee_id);
                $stmt_employee->execute();
                $employee = $stmt_employee->fetch(PDO::FETCH_ASSOC);

                if ($employee) {
                    $stmt_check = $this->db->prepare("SELECT salary_id FROM salary WHERE employee_id = :employee_id AND salary_date = :salary_date");
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

                        $stmt_salary = $this->db->prepare("INSERT INTO salary (salary, ot, social_security, other, salary_date, employee_id, total_salary) VALUES (:salary, :ot, :social_security, :other, :salary_date, :employee_id, :total_salary)");
                        $stmt_salary->bindParam(':salary', $salary);
                        $stmt_salary->bindParam(':ot', $ot);
                        $stmt_salary->bindParam(':social_security', $social_security);
                        $stmt_salary->bindParam(':other', $other);
                        $stmt_salary->bindParam(':total_salary', $total_salary);
                        $stmt_salary->bindParam(':salary_date', $salary_date);
                        $stmt_salary->bindParam(':employee_id', $employee['employee_id']);
                        $stmt_salary->execute();

                        $salary_id = $this->db->lastInsertId();

                        $stmtLog = $this->db->prepare("INSERT INTO log (log_status, log_detail, user_id) VALUES (:log_status, :log_detail, :user_id)");
                        $logStatus = 'Salary Created';
                        $logDetail = 'Salary ID: ' . $salary_id;
                        $admin_user_id = $_SESSION['user_id'];
                        $stmtLog->bindParam(':log_status', $logStatus);
                        $stmtLog->bindParam(':log_detail', $logDetail);
                        $stmtLog->bindParam(':user_id', $admin_user_id);
                        $stmtLog->execute();
                    }
                    $this->db->commit();
                    echo json_encode(['success' => true]);
                    exit();
                } else {
                    http_response_code(400);
                    echo json_encode(['success' => false, 'message' => 'เพิ่มข้อมูลไม่ทำเสร็จ']);
                    exit();
                }
            } catch (PDOException $e) {
                $this->db->rollBack();
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => 'เชื่อมต่อฐานข้อมูลล้มเหลว']);
                exit();
            }
        }
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
            "มกราคม",
            "กุมภาพันธ์",
            "มีนาคม",
            "เมษายน",
            "พฤษภาคม",
            "มิถุนายน",
            "กรกฎาคม",
            "สิงหาคม",
            "กันยายน",
            "ตุลาคม",
            "พฤศจิกายน",
            "ธันวาคม"
        ];
    }

    public function updateSalary()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $salary_id = $_POST['salary_id'];
            $salary = floatval($_POST['salary']);
            $ot = floatval($_POST['ot']);
            $social_security = floatval($_POST['social_security']);
            $other = floatval($_POST['other']);

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
                echo json_encode(['success' => true, 'message' => 'Salary updated successfully', 'total_salary' => $total_salary]);
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
