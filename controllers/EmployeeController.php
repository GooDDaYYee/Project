<?php
require_once __DIR__ . '/BaseController.php';

class EmployeeController extends BaseController
{

    public function __construct()
    {
        parent::__construct();

        if ($_SESSION["lv"] != 0 && $_SESSION["lv"] != 1) {
            header("Location: index.php?page=home");
            exit();
        }
    }

    public function index()
    {
        $employees = $this->fetchEmployees();

        $data = [
            'employees' => $employees,
        ];

        $pageTitle = 'จัดการข้อมูลพนักงาน - PSNK TELECOM';
        $this->render('employee/index', ['pageTitle' => $pageTitle, 'data' => $data]);
    }

    private function fetchEmployees()
    {
        $strsql = "SELECT * FROM employee WHERE delete_at IS NULL ORDER BY employee_date ASC";
        try {
            $stmt = $this->db->prepare($strsql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $this->logAction('Fetch Employees Error', $e->getMessage());
            return [];
        }
    }

    public function updateEmployee()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $employee_id = $_POST['employee_id'];
            $name = $_POST['employee_name'];
            $lastname = $_POST['employee_lastname'];
            $age = $_POST['employee_age'];
            $phone = $_POST['employee_phone'];
            $email = $_POST['employee_email'];
            $position = $_POST['employee_position'];
            $status = $_POST['employee_status'];

            $sql = "UPDATE employee SET 
                    employee_name = :name, 
                    employee_lastname = :lastname, 
                    employee_age = :age, 
                    employee_phone = :phone, 
                    employee_email = :email, 
                    employee_position = :position, 
                    employee_status = :status 
                    WHERE employee_id = :employee_id";

            try {
                $stmt = $this->db->prepare($sql);
                $stmt->execute([
                    ':name' => $name,
                    ':lastname' => $lastname,
                    ':age' => $age,
                    ':phone' => $phone,
                    ':email' => $email,
                    ':position' => $position,
                    ':status' => $status,
                    ':employee_id' => $employee_id
                ]);
                $this->logAction('Employee Updated', "Employee ID: $employee_id, Employee Name: $name, Employee Lastname: $lastname, Employee Age: $age, Employee Phone: $phone, Employee Email: $email, Employee Position: $position, Employee Status: $status");
                echo json_encode(['success' => true, 'message' => 'อัปเดตพนักงานเรียบร้อยแล้ว']);
            } catch (PDOException $e) {
                $this->logAction('Employee Update Error', $e->getMessage());
                echo json_encode(['success' => false, 'message' => 'เกิดข้อผิดพลาดในการอัปเดตพนักงาน: ' . $e->getMessage()]);
            }
        }
    }

    public function deleteEmployee()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $employee_id = $_POST['employeeid'];

            try {
                $this->db->beginTransaction();

                $stmt_user = $this->db->prepare("SELECT user_id FROM users WHERE employee_id = :employee_id");
                $stmt_user->execute([':employee_id' => $employee_id]);
                $user_result = $stmt_user->fetch(PDO::FETCH_ASSOC);

                if (!$user_result) {
                    throw new Exception("ไม่พบข้อมูลผู้ใช้สำหรับพนักงานนี้");
                }

                $userid = $user_result['user_id'];

                $stmt2 = $this->db->prepare("UPDATE users SET delete_at = CURRENT_TIMESTAMP, status = 0 WHERE employee_id = :employee_id");
                $stmt2->execute([':employee_id' => $employee_id]);

                $stmt = $this->db->prepare("UPDATE employee SET delete_at = CURRENT_TIMESTAMP, employee_status = 0 WHERE employee_id = :employee_id");
                $stmt->execute([':employee_id' => $employee_id]);

                $this->db->commit();

                $this->logAction('Employee Soft Deleted', "Employee ID: $employee_id, User ID: $userid");
                echo json_encode(['success' => true, 'message' => 'ลบพนักงานเรียบร้อยแล้ว']);
            } catch (PDOException $e) {
                $this->db->rollBack();
                echo json_encode(['success' => false, 'message' => 'เกิดข้อผิดพลาดในการลบพนักงาน: ' . $e->getMessage()]);
            } catch (Exception $e) {
                $this->db->rollBack();
                echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            }
        }
    }

    public function getEmployeeDetails()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['employee_id'])) {
            $employee_id = $_GET['employee_id'];
            try {
                $stmt = $this->db->prepare("SELECT * FROM employee WHERE employee_id = :employee_id");
                $stmt->execute([':employee_id' => $employee_id]);
                $employee = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($employee) {
                    echo json_encode(['success' => true, 'employee' => $employee]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Employee not found']);
                }
            } catch (PDOException $e) {
                echo json_encode(['success' => false, 'message' => 'เกิดข้อผิดพลาดในการเรียกรายละเอียดพนักงาน: ' . $e->getMessage()]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'คำขอไม่ถูกต้อง']);
        }
    }

    public function getPositionName($position)
    {
        switch ($position) {
            case 0:
                return "แอดมิน";
            case 1:
                return "เจ้าของ";
            case 2:
                return "พนักงานเอกสาร";
            case 3:
                return "พนักงานปฏิบัติ";
            default:
                return "ไม่มีข้อมูล";
        }
    }

    public function getStatusName($status)
    {
        switch ($status) {
            case 0:
                return "ลาออก";
            case 1:
                return "ทำงานอยู่";
            default:
                return "ไม่มีข้อมูล";
        }
    }
}
