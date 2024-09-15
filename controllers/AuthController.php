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
            header("Location: index.php?page=home");
            exit();
        }
        
        $pageTitle = 'เข้าสู่ระบบ - PSNK Telecom';
        $this->render('auth/login', ['pageTitle' => $pageTitle], false);
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->jsonResponse(false, 'Invalid request method', 405);
        }

        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        $rememberMe = isset($_POST['rememberMe']) ? filter_var($_POST['rememberMe'], FILTER_VALIDATE_BOOLEAN) : false;

        if (empty($username) || empty($password)) {
            return $this->jsonResponse(false, 'ข้อมูลไม่ครบถ้วน');
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
                    $this->jsonResponse(true, 'OK');
                }
            }
            return $this->jsonResponse(false, 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง');
        } catch (PDOException $e) {
            return $this->jsonResponse(false, 'Error login: ' . $e->getMessage());
        }
    }

    public function logout()
    {
        $this->logAction($_SESSION['user_id'] ?? null, 'Logout', 'User logged out');
        session_unset();
        session_destroy();
        header("Location: index.php?page=auth");
        exit();
    }

    public function forgotPassword()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->processForgotPassword();
        } else {
            $pageTitle = 'ลืมรหัสผ่าน - PSNK Telecom';
            $this->render('auth/forgot_password', ['pageTitle' => $pageTitle], false);
        }
    }

    private function processForgotPassword()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $phone = $_POST['phone'] ?? '';

            if (empty($email) || empty($phone)) {
                return $this->jsonResponse(false, 'ข้อมูลไม่ครบถ้วน');
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return $this->jsonResponse(false, 'อีเมลไม่ถูกต้อง');
            }

            if (!preg_match('/^[0-9]{10,15}$/', $phone)) {
                return $this->jsonResponse(false, 'เบอร์โทรศัพท์ไม่ถูกต้อง');
            }

            try {
                $employee = $this->getEmployeeByEmail($email);
                if (!$employee) {
                    return $this->jsonResponse(false, 'ไม่พบอีเมลนี้ในระบบพนักงาน');
                }

                $user = $this->getUserByEmployeeId($employee['employee_id']);
                if (!$user) {
                    return $this->jsonResponse(false, 'ไม่พบพนักงานนี้ในระบบผู้ใช้');
                }

                $newPassword = $this->generateRandomPassword();
                $this->updateUserPassword($user['employee_id'], $newPassword);

                $this->sendPasswordResetEmail($email, $newPassword);

                $logDetail = "Password reset for User: {$user['username']}, Email: {$email}";
                $this->logAction($user['user_id'], 'Reset Password', $logDetail);

                return $this->jsonResponse(true, 'รหัสผ่านใหม่ถูกส่งไปยังอีเมลของคุณแล้ว');
            } catch (Exception $e) {
                $this->logError('Error during password reset: ' . $e->getMessage());
                return $this->jsonResponse(false, 'เกิดข้อผิดพลาดในการรีเซ็ตรหัสผ่าน');
            }
        }

        return $this->jsonResponse(false, 'Invalid request method');
    }


    private function setSession($user, $rememberMe)
    {
        $_SESSION['login'] = true;
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['lv'] = $user['lv'];
        $_SESSION['employee_id'] = $user['employee_id'];

        if ($rememberMe) {
            $_SESSION['remember_username'] = $user['username'];
        } else {
            unset($_SESSION['remember_username']);
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
            $this->logError('Error sending password reset email: ' . $e->getMessage());
            throw new Exception('Unable to send password reset email');
        }
    }

    private function logError($message)
    {
        error_log($message);
    }
}