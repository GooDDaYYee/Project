<?php
require_once __DIR__ . '/BaseController.php';
require __DIR__ . '/../libs/PHPMailer/src/Exception.php';
require __DIR__ . '/../libs/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/../libs/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class AuthController extends BaseController
{
    public function index()
    {
        if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
            header("Location: index.php?page=manage-file");
            exit();
        }

        $pageTitle = 'เข้าสู่ระบบ - PSNK Telecom';
        $this->render('auth/login', ['pageTitle' => $pageTitle], false);
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->errorResponse('Invalid request method', null, 405);
        }

        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        $rememberMe = isset($_POST['rememberMe']) ? filter_var($_POST['rememberMe'], FILTER_VALIDATE_BOOLEAN) : false;

        if (empty($username) || empty($password)) {
            return $this->errorResponse('ข้อมูลไม่ครบถ้วน', null, 200);
        }

        try {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE status='1' AND username = :username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                if (password_verify($password, $user['passW'])) {
                    $this->setSession($user, $rememberMe);
                    $this->logAction($user['user_id'], 'Login', 'User logged in');
                    return $this->successResponse('Login successful');
                }
            }
            return $this->errorResponse('ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง', null, 200);
        } catch (PDOException $e) {
            return $this->errorResponse('เกิดข้อผิดพลาดในการเข้าสู่ระบบ', null, 500);
        }
    }

    public function logout()
    {
        try {
            if (isset($_SESSION['user_id'])) {
                $this->logAction($_SESSION['user_id'], 'Logout', 'User logged out');
            }
            session_unset();
            session_destroy();
            header("Location: index.php?page=auth");
            exit();
        } catch (Exception $e) {
            error_log("Logout error: " . $e->getMessage());
            // แสดงข้อความแจ้งเตือนแก่ผู้ใช้
            echo "เกิดข้อผิดพลาดในการออกจากระบบ กรุณาลองใหม่อีกครั้ง";
        }
    }
    public function forgotPassword()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            return $this->processForgotPassword();
        } else {
            $pageTitle = 'ลืมรหัสผ่าน - PSNK Telecom';
            $this->render('auth/forgot_password', ['pageTitle' => $pageTitle], false);
        }
    }

    private function processForgotPassword()
    {
        $email = $_POST['email'] ?? '';
        $phone = $_POST['phone'] ?? '';

        if (empty($email) || empty($phone)) {
            return $this->errorResponse('ข้อมูลไม่ครบถ้วน', null, 400);
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->errorResponse('อีเมลไม่ถูกต้อง', null, 400);
        }

        if (!preg_match('/^[0-9]{10,15}$/', $phone)) {
            return $this->errorResponse('เบอร์โทรศัพท์ไม่ถูกต้อง', null, 400);
        }

        try {
            $employee = $this->getEmployeeByEmail($email);
            if (!$employee) {
                return $this->errorResponse('ไม่พบอีเมลนี้ในระบบพนักงาน', null, 404);
            }

            $user = $this->getUserByEmployeeId($employee['employee_id']);
            if (!$user) {
                return $this->errorResponse('ไม่พบพนักงานนี้ในระบบผู้ใช้', null, 404);
            }

            $newPassword = $this->generateRandomPassword();
            $this->updateUserPassword($user['employee_id'], $newPassword);

            $this->sendPasswordResetEmail($email, $newPassword);

            $logDetail = "Password reset for User: {$user['username']}, Email: {$email}";
            $this->logAction($user['user_id'], 'Reset Password', $logDetail);

            return $this->successResponse('รหัสผ่านใหม่ถูกส่งไปยังอีเมลของคุณแล้ว');
        } catch (Exception $e) {
            return $this->errorResponse('เกิดข้อผิดพลาดในการรีเซ็ตรหัสผ่าน', null, 500);
        }
    }

    private function setSession($user, $rememberMe)
    {
        $_SESSION['login'] = true;
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['lv'] = $user['lv'];
        $_SESSION['employee_id'] = $user['employee_id'];

        // Fetch employee name from the employee table
        $employeeName = $this->getEmployeeName($user['employee_id']);
        $_SESSION['employee_name'] = $employeeName;

        if ($rememberMe) {
            $_SESSION['remember_username'] = $user['username'];
        } else {
            unset($_SESSION['remember_username']);
        }
    }

    private function getEmployeeName($employeeId)
    {
        try {
            $stmt = $this->db->prepare("SELECT employee_name FROM employee WHERE employee_id = :employee_id");
            $stmt->bindParam(':employee_id', $employeeId);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result['employee_name'];
            }
            return null;
        } catch (PDOException $e) {
            // Handle the error appropriately
            error_log("Error fetching employee name: " . $e->getMessage());
            return null;
        }
    }

    private function getEmployeeByEmail($email)
    {
        $stmt = $this->db->prepare("SELECT employee_id FROM employee WHERE employee_email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    private function getUserByEmployeeId($employeeId)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE employee_id = :employee_id");
        $stmt->execute(['employee_id' => $employeeId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    private function generateRandomPassword()
    {
        return bin2hex(random_bytes(8));
    }

    private function updateUserPassword($employeeId, $newPassword)
    {
        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
        $stmt = $this->db->prepare("UPDATE users SET passW = :passW WHERE employee_id = :employee_id");
        $stmt->execute(['passW' => $hashedPassword, 'employee_id' => $employeeId]);
    }

    private function sendPasswordResetEmail($email, $newPassword)
    {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'psnktelecom@gmail.com';
            $mail->Password = 'jkps zqdm hljb zyzc';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('psnktelecom@gmail.com', 'PSNK TELECOM CO., LTD.');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'New Password';
            $mail->Body = "Hello,<br><br>Your new login details:<br>Password: $newPassword<br><br>Best regards,<br>PSNK TELECOM CO., LTD.";

            $mail->send();
        } catch (Exception $e) {
            throw new Exception('Unable to send password reset email');
        }
    }
}
