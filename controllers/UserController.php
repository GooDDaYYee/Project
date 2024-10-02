<?php
require_once __DIR__ . '/BaseController.php';

class UserController extends BaseController
{
    public function __construct()
    {
        parent::__construct();

        // Allow just admin to access this controller
        if ($_SESSION["lv"] != 0) {
            header("Location: index.php?page=home");
            exit();
        }
    }

    public function index()
    {
        $data = [
            'users' => $this->fetchUsers(),
        ];

        $pageTitle = 'จัดการผู้ใช้ - PSNK TELECOM';
        $this->render('user/index', ['pageTitle' => $pageTitle, 'data' => $data]);
    }

    private function fetchUsers()
    {
        $strsql = "SELECT * FROM users WHERE delete_at IS NULL ORDER BY users_date ASC";
        try {
            $stmt = $this->db->prepare($strsql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException) {
            return [];
        }
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->create_post();
        } else {
            $this->create_get();
        }
    }

    private function create_get()
    {
        $pageTitle = 'เพิ่มผู้ใช้ - PSNK TELECOM';
        $this->render('user/create', ['pageTitle' => $pageTitle]);
    }

    private function create_post()
    {
        $username = $_POST['username'];
        $password = password_hash($_POST['passW'], PASSWORD_DEFAULT);
        $name = $_POST['name'];
        $lastname = $_POST['lastname'];
        $age = $_POST['age'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $type = $_POST['type'];
        $status = $_POST['status'];

        try {
            // ต้องเพิ่มการเช็ค user ซ้ำ
            $stmt = $this->db->prepare("INSERT INTO employee (employee_name, employee_lastname, employee_age, employee_phone, employee_email, employee_position, employee_status, employee_date) 
                                        VALUES (:name, :lastname, :age, :phone, :email, :position, :status, NOW())");
            $stmt->execute([
                ':name' => $name,
                ':lastname' => $lastname,
                ':age' => $age,
                ':phone' => $phone,
                ':email' => $email,
                ':position' => $type,
                ':status' => $status
            ]);

            $employee_id = $this->db->lastInsertId();

            $stmt = $this->db->prepare("INSERT INTO users (username, passW, lv, status, users_date, employee_id) 
                                        VALUES (:username, :passW, :lv, :status, NOW(), :employee_id)");
            $stmt->execute([
                ':username' => $username,
                ':passW' => $password,
                ':lv' => $type,
                ':status' => $status,
                ':employee_id' => $employee_id
            ]);

            $logDetail = "Username: {$username}, Employee Name: {$name} {$lastname}, Position: {$type}";
            $this->logAction('User Created', $logDetail);

            return $this->successResponse();
        } catch (PDOException $e) {
            return $this->errorResponse();
        }
    }

    public function update()
    {
        if (!isset($_POST['user_id']) || empty($_POST['user_id'])) {
            return $this->errorResponse();
        }

        $user_id = $_POST['user_id'];
        $username = $_POST['username'];
        $lv = $_POST['lv'];
        $status = $_POST['status'];

        try {
            $sql = "UPDATE users SET username = :username, lv = :lv, status = :status WHERE user_id = :user_id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':username' => $username,
                ':lv' => $lv,
                ':status' => $status,
                ':user_id' => $user_id
            ]);

            $logDetail = "User ID: {$user_id}, Username: {$username}, Lv: {$lv}, Status: {$status}";
            $this->logAction('User Updated', $logDetail);

            return $this->successResponse();
        } catch (PDOException $e) {
            return $this->errorResponse();
        }
    }

    public function deleteUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user_id = $_POST['user_id'];

            try {
                $this->db->beginTransaction();

                // Update log table instead of deleting
                // $stmt = $this->db->prepare("UPDATE log SET delete_at = CURRENT_TIMESTAMP WHERE user_id = :user_id");
                // $stmt->execute([':user_id' => $user_id]);

                // Check for associated employee record
                $stmt = $this->db->prepare("SELECT employee_id FROM users WHERE user_id = :user_id");
                $stmt->execute([':user_id' => $user_id]);
                $employee = $stmt->fetch();

                if ($employee) {
                    $employee_id = $employee['employee_id'];
                    // Update employee table
                    $stmt = $this->db->prepare("UPDATE employee SET delete_at = CURRENT_TIMESTAMP WHERE employee_id = :employee_id");
                    $stmt->execute([':employee_id' => $employee_id]);
                }

                // Update users table
                $stmt = $this->db->prepare("UPDATE users SET delete_at = CURRENT_TIMESTAMP, status = 0 WHERE user_id = :user_id");
                $stmt->execute([':user_id' => $user_id]);

                $this->db->commit();

                $logDetail = "User ID: {$user_id}, Employee ID: " . ($employee_id ?? 'N/A');
                $this->logAction('User Soft Deleted', $logDetail);

                $this->successResponse();
            } catch (PDOException $e) {
                $this->logAction('Error Soft Deleting User', $e->getMessage());
                $this->errorResponse($e->getMessage());
            }
        }
    }

    public function getLevelName($level)
    {
        switch ($level) {
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
        return $status == 1 ? "ปกติ" : "แบน";
    }
}
