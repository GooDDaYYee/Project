<?php
require_once __DIR__ . '/BaseController.php';

class EmployeeController extends BaseController
{
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
        $strsql = "SELECT * FROM employee ORDER BY employee_date ASC";
        try {
            $stmt = $this->db->prepare($strsql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error fetching employees: " . $e->getMessage());
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
                echo json_encode(['success' => true, 'message' => 'Employee updated successfully']);
            } catch (PDOException $e) {
                echo json_encode(['success' => false, 'message' => 'Error updating employee: ' . $e->getMessage()]);
            }
        }
    }

    public function deleteEmployee()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $employee_id = $_POST['employee_id'];

            try {
                $this->db->beginTransaction();

                // Delete related user account if exists
                $stmt = $this->db->prepare("DELETE FROM users WHERE employee_id = :employee_id");
                $stmt->execute([':employee_id' => $employee_id]);

                // Delete employee
                $stmt = $this->db->prepare("DELETE FROM employee WHERE employee_id = :employee_id");
                $stmt->execute([':employee_id' => $employee_id]);

                $this->db->commit();
                echo json_encode(['success' => true, 'message' => 'Employee deleted successfully']);
            } catch (PDOException $e) {
                $this->db->rollBack();
                echo json_encode(['success' => false, 'message' => 'Error deleting employee: ' . $e->getMessage()]);
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
                echo json_encode(['success' => false, 'message' => 'Error fetching employee details: ' . $e->getMessage()]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid request']);
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