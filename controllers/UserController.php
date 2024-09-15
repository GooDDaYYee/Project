<?php
require_once __DIR__ . '/BaseController.php';

class UserController extends BaseController
{
    public function index()
    {
        if ($_SESSION["lv"] != 0) {
            header("Location: index.php?page=home");
            exit();
        }

        $users = $this->fetchUsers();

        $data = [
            'users' => $users,
        ];

        $pageTitle = 'จัดการผู้ใช้ - PSNK TELECOM';
        $this->render('user/index', ['pageTitle' => $pageTitle, 'data' => $data]);
    }

    public function create()
    {
        if ($_SESSION["lv"] != 0) {
            header("Location: index.php?page=home");
            exit();
        }

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
            $this->db->beginTransaction();

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

            $this->db->commit();

            $logDetail = "Username: {$username}, Employee Name: {$name} {$lastname}, Position: {$type}";
            $this->logAction('User Created', $logDetail);

            return $this->successResponse('User created successfully');
        } catch (PDOException $e) {
            $this->db->rollBack();
            return $this->errorResponse('Error creating user. Please try again later.', null, 500);
        }
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->errorResponse('Invalid request method', null, 405);
        }

        $user_id = $_POST['user_id'];
        $username = $_POST['username'];
        $lv = $_POST['lv'];
        $status = $_POST['status'];

        $sql = "UPDATE users SET username = :username, lv = :lv, status = :status WHERE user_id = :user_id";

        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':username' => $username,
                ':lv' => $lv,
                ':status' => $status,
                ':user_id' => $user_id
            ]);

            $logDetail = "User ID: {$user_id}, Username: {$username}, Lv: {$lv}, Status: {$status}";
            $this->logAction('User Updated', $logDetail);

            return $this->successResponse('User updated successfully');
        } catch (PDOException $e) {
            return $this->errorResponse('Error updating user. Please try again later.', null, 500);
        }
    }

    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->errorResponse('Invalid request method', null, 405);
        }

        if (!isset($_POST['user_id']) || empty($_POST['user_id'])) {
            return $this->errorResponse('User ID is required', null, 400);
        }

        $user_id = $_POST['user_id'];
        try {
            $this->db->beginTransaction();

            $stmt = $this->db->prepare("SELECT employee_id FROM users WHERE user_id = :user_id");
            $stmt->execute([':user_id' => $user_id]);
            $employee = $stmt->fetch();

            if ($employee) {
                $employee_id = $employee['employee_id'];
                $stmt = $this->db->prepare("DELETE FROM employee WHERE employee_id = :employee_id");
                $stmt->execute([':employee_id' => $employee_id]);
            }

            $stmt = $this->db->prepare("DELETE FROM users WHERE user_id = :user_id");
            $stmt->execute([':user_id' => $user_id]);

            $this->db->commit();

            $logDetail = "User ID: {$user_id}, Employee ID: " . ($employee_id ?? 'N/A');
            $this->logAction('User Deleted', $logDetail);

            return $this->successResponse('User deleted successfully');
        } catch (PDOException $e) {
            $this->db->rollBack();
            return $this->errorResponse('Error deleting user. Please try again later.', null, 500);
        }
    }

    private function fetchUsers()
    {
        $strsql = "SELECT * FROM users ORDER BY users_date ASC";
        try {
            $stmt = $this->db->prepare($strsql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
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
