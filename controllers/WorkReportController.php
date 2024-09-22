<?php
require_once __DIR__ . '/BaseController.php';

class WorkReportController extends BaseController
{
    public function index()
    {
        $pageTitle = 'รายงานการปฏิบัติงาน - PSNK TELECOM';
        $this->render('work_report/index', ['pageTitle' => $pageTitle]);
    }

    public function submitReport()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $jobname = $_POST['jobname'] ?? '';
            $user_id = $_SESSION['user_id'] ?? null;

            if (empty($name) || empty($jobname) || empty($user_id)) {
                $_SESSION['error_message'] = "กรุณากรอกข้อมูลให้ครบถ้วน";
                header("Location: index.php?page=work-report");
                exit();
            }

            // Handle file uploads
            $uploadedFiles = [];
            if (isset($_FILES['images']) && !empty($_FILES['images']['name'][0])) {
                // Create a folder if not exist and folder name is slug jobname-YmdHis
                $folderName = $this->createSlug($jobname) . '-' . date('YmdHis');
                $uploadDir = 'assets/files/LINE/' . $folderName . '/';

                if (!file_exists($uploadDir)) {
                    if (!mkdir($uploadDir, 0777, true)) {
                        $_SESSION['error_message'] = "ไม่สามารถสร้างโฟลเดอร์สำหรับอัปโหลดไฟล์ได้";
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
                        header("Location: index.php?page=work-report");
                        exit();
                    }

                    // Check file extension
                    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
                    if (!in_array($file_ext, $allowed_extensions)) {
                        $_SESSION['error_message'] = "ไฟล์ {$file_name} ไม่ใช่รูปภาพที่รองรับ (jpg, jpeg, png, gif เท่านั้น)";
                        header("Location: index.php?page=work-report");
                        exit();
                    }

                    $new_file_name = uniqid() . '.' . $file_ext;
                    if (move_uploaded_file($file_tmp, $uploadDir . $new_file_name)) {
                        $uploadedFiles[] = $folderName . '/' . $new_file_name;
                    } else {
                        $_SESSION['error_message'] = "เกิดข้อผิดพลาดในการอัปโหลดไฟล์ {$file_name}";
                        header("Location: index.php?page=work-report");
                        exit();
                    }
                }
            }

            // Save report to database
            try {
                $this->db->beginTransaction();

                $stmt = $this->db->prepare("INSERT INTO work_reports (user_id, name, job_name) VALUES (:user_id, :name, :job_name)");
                $stmt->execute([':user_id' => $user_id, ':name' => $name, ':job_name' => $jobname]);
                $report_id = $this->db->lastInsertId();

                foreach ($uploadedFiles as $file) {
                    $stmt = $this->db->prepare("INSERT INTO report_images (report_id, image_path) VALUES (:report_id, :image_path)");
                    $stmt->execute([':report_id' => $report_id, ':image_path' => $file]);
                }

                $this->db->commit();
                $_SESSION['success_message'] = "รายงานถูกบันทึกเรียบร้อยแล้ว";
            } catch (PDOException $e) {
                $this->db->rollBack();
                $_SESSION['error_message'] = "เกิดข้อผิดพลาดในการบันทึกรายงาน: " . $e->getMessage();
            }

            header("Location: index.php?page=work-report");
            exit();
        }
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
