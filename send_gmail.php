<?php
include('connect.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

try {


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);

        // ตรวจสอบความถูกต้องของอีเมลและเบอร์โทรศัพท์
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "อีเมลไม่ถูกต้อง";
            exit;
        }

        if (!preg_match('/^[0-9]{10,15}$/', $phone)) {
            echo "เบอร์โทรศัพท์ไม่ถูกต้อง";
            exit;
        }

        // ตรวจสอบว่า email อยู่ในตาราง employees หรือไม่
        $stmt = $con->prepare("SELECT employee_id FROM employee WHERE employee_email = :email");
        $stmt->execute(['email' => $email]);
        $employee = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$employee) {
            echo "ไม่พบอีเมลนี้ในระบบพนักงาน";
            exit;
        }

        $employee_id = $employee['employee_id'];

        // ตรวจสอบว่า employee_id นี้มีในตาราง users หรือไม่
        $stmt = $con->prepare("SELECT * FROM users WHERE employee_id = :employee_id");
        $stmt->execute(['employee_id' => $employee_id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            echo "ไม่พบพนักงานนี้ในระบบผู้ใช้";
            exit;
        }

        $username = $user['username'];

        // สร้างรหัสผ่านใหม่แบบสุ่ม
        $newPassword = bin2hex(random_bytes(8)); // รหัสผ่านใหม่จะมีความยาว 16 ตัวอักษร
        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT); // เข้ารหัสรหัสผ่านใหม่ด้วย bcrypt

        // แทนที่รหัสผ่านเดิมในฐานข้อมูล
        $stmt = $con->prepare("UPDATE users SET passW = :passW WHERE employee_id = :employee_id");
        $stmt->execute(['passW' => $hashedPassword, 'employee_id' => $employee_id]);

        $mail = new PHPMailer(true);

        try {
            // ตั้งค่าการเชื่อมต่อ SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';  // ตั้งค่า SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'gooddayyee@gmail.com'; // Gmail username
            $mail->Password = 'rurq vzxi ubnr kqes'; // Gmail password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // ตั้งค่าผู้ส่งและผู้รับ
            $mail->setFrom('yourgmail@gmail.com', 'PSNKTelecom');
            $mail->addAddress($email);

            // ตั้งค่าหัวเรื่องและเนื้อหาอีเมล
            $mail->isHTML(true);
            $mail->Subject = 'New Password';
            $mail->Body    = "Hello,<br><br>Your new login details:<br>Password: $newPassword<br><br>Best regards,<br>PSNKTelecom";
            // $mail->Body    = "Hello,<br><br>Your new login details:<br>Username: $username<br>Password: $newPassword<br><br>Best regards,<br>PSNKTelecom";

            // ส่งอีเมล
            $mail->send();
            echo "ส่งอีเมลเรียบร้อยแล้ว";
        } catch (Exception $e) {
            echo "การส่งอีเมลล้มเหลว: {$mail->ErrorInfo}";
        }
    } else {
        echo "มีบางอย่างผิดพลาด กรุณาลองอีกครั้ง.";
    }
} catch (PDOException $e) {
    echo "การเชื่อมต่อฐานข้อมูลล้มเหลว: " . $e->getMessage();
}
