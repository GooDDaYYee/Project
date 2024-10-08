<?php
require_once __DIR__ . '/BaseController.php';

class WorkReportController extends BaseController
{

    public function __construct()
    {
        parent::__construct();

        if ($_SESSION["lv"] != 0 && $_SESSION["lv"] != 1 && $_SESSION["lv"] != 2 && $_SESSION["lv"] != 3) {
            header("Location: index.php?page=home");
            exit();
        }
    }

    public function index()
    {
        $pageTitle = 'รายงานการปฏิบัติงาน - PSNK TELECOM';
        $this->render('work_report/index', ['pageTitle' => $pageTitle]);
    }

    public function submitReport()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_SESSION['employee_name'] ?? null;
            $jobname = $_POST['jobname'] ?? '';
            $group = $_POST['group'] ?? 1;
            $user_id = $_SESSION['user_id'] ?? null;

            if (empty($name) || empty($jobname) || empty($user_id)) {
                $_SESSION['error_message'] = "กรุณากรอกข้อมูลให้ครบถ้วน";
                $this->logAction('Work Report Submission Failed', "Incomplete data: name={$name}, jobname={$jobname}, user_id={$user_id}");
                header("Location: index.php?page=work-report");
                exit();
            }

            // Handle file uploads
            $uploadedFiles = [];
            if (isset($_FILES['images']) && !empty($_FILES['images']['name'][0])) {
                // Create a folder if not exist and folder name is slug name-jobname-YmdHis
                $folderName = $this->createSlug($jobname) . '-' . $this->createSlug($name) . '-' . date('YmdHis');
                $uploadDir = 'assets/files/LINE/' . $folderName . '/';

                if (!file_exists($uploadDir)) {
                    if (!mkdir($uploadDir, 0777, true)) {
                        $_SESSION['error_message'] = "ไม่สามารถสร้างโฟลเดอร์สำหรับอัปโหลดไฟล์ได้";
                        $this->logAction('Folder Creation Failed', "Failed to create folder: {$uploadDir}");
                        header("Location: index.php?page=work-report");
                        exit();
                    }
                }

                $maxFileSize = 5 * 1024 * 1024; // 5MB

                foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
                    $file_name = $_FILES['images']['name'][$key];
                    $file_tmp = $_FILES['images']['tmp_name'][$key];
                    $file_size = $_FILES['images']['size'][$key];
                    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

                    // Check file size
                    if ($file_size > $maxFileSize) {
                        $_SESSION['error_message'] = "ไฟล์ {$file_name} มีขนาดใหญ่เกินไป (ไม่เกิน 5MB)";
                        $this->logAction('File Upload Failed', "File size exceeded: {$file_name}, size={$file_size}");
                        header("Location: index.php?page=work-report");
                        exit();
                    }

                    // Check file extension
                    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
                    if (!in_array($file_ext, $allowed_extensions)) {
                        $_SESSION['error_message'] = "ไฟล์ {$file_name} ไม่ใช่รูปภาพที่รองรับ (jpg, jpeg, png, gif เท่านั้น)";
                        $this->logAction('File Upload Failed', "Invalid file type: {$file_name}, type={$file_ext}");
                        header("Location: index.php?page=work-report");
                        exit();
                    }

                    $new_file_name = uniqid() . '.' . $file_ext;
                    if (move_uploaded_file($file_tmp, $uploadDir . $new_file_name)) {
                        $uploadedFiles[] = $folderName . '/' . $new_file_name;
                        $this->logAction('File Uploaded', "File uploaded successfully: {$new_file_name}");
                    } else {
                        $_SESSION['error_message'] = "เกิดข้อผิดพลาดในการอัปโหลดไฟล์ {$file_name}";
                        $this->logAction('File Upload Failed', "Failed to move uploaded file: {$file_name}");
                        header("Location: index.php?page=work-report");
                        exit();
                    }
                }
            }

            $currentUrl = "https://$_SERVER[HTTP_HOST]/index.php";
            $params = http_build_query([
                'folder' => $folderName
            ]);
            $fullPath = $currentUrl . '?' . $params;

            $imageCount = count($uploadedFiles);
            $notify_result = $this->sendLineNotify($name, $jobname, $group, $fullPath, $imageCount);

            if (!$notify_result) {
                $_SESSION['error_message'] = "เพิ่มรายงานใหม่แล้ว แต่ไม่สามารถส่งการแจ้งเตือน LINE Notify ได้";
                $this->logAction('LINE Notify Failed', "Failed to send LINE notification for user: {$name}, job: {$jobname}");
            } else {
                $this->logAction('LINE Notify Sent', "LINE notification sent for user: {$name}, job: {$jobname}");
            }

            $_SESSION['success_message'] = "รายงานถูกบันทึกและส่งการแจ้งเตือนเรียบร้อยแล้ว";
            $this->logAction('Work Report Submitted', "Report submitted by {$name} for job: {$jobname}, images: {$imageCount}");
            header("Location: $fullPath");
            exit();
        }
    }

    public function sendLineNotify($name, $jobname, $group, $link, $imageCount)
    {
        $tokens = [
            1 => "ZttPwN3qU9h2cl2HUAipy2MPFMCfTGxXb37Qbf4IKt2", // PSNK Group 1
            2 => "I9A20aBNYwcqavN0tbvR5B4uwDxBCIeWMXhQ2LRA0Gr"  // PSNK Group 2
        ];

        $token = $tokens[$group] ?? null;

        if (!$token) {
            $this->logAction('LINE Notify Failed', "Invalid group token for group: {$group}");
            return false;
        }

        $message = "\nชื่อผู้รายงาน: " . $name;
        $message .= "\nรายงานงานใหม่: " . $jobname;
        $message .= "\nจำนวนรูปที่รายงาน: " . $imageCount;
        $message .= "\nลิ้ง: " . $link;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://notify-api.line.me/api/notify");
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "message=" . $message);
        $headers = array('Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer ' . $token . '',);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);

        if (curl_error($ch)) {
            $this->logAction('LINE Notify Failed', "cURL error: " . curl_error($ch));
            curl_close($ch);
            return false;
        }
        curl_close($ch);

        $this->logAction('LINE Notify Sent', "Notification sent to group: {$group}, user: {$name}, job: {$jobname}");
        return true;
    }

    private function createSlug($string)
    {
        $string = str_replace(' ', '-', $string);
        $string = preg_replace('/[^\p{Thai}a-zA-Z0-9-]/u', '', $string);
        $string = mb_strtolower($string, 'UTF-8');
        $string = preg_replace('/-+/', '-', $string);
        $string = trim($string, '-');

        return $string;
    }
}
