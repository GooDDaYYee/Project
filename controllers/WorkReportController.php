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
            $name = $_POST['name'];
            $jobname = $_POST['jobname'];
            $user_id = $_SESSION['user_id'];

            // Handle file uploads
            $uploadedFiles = [];
            if (isset($_FILES['images'])) {
                $uploadDir = 'uploads/';
                foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
                    $file_name = $_FILES['images']['name'][$key];
                    $file_tmp = $_FILES['images']['tmp_name'][$key];
                    $file_type = $_FILES['images']['type'][$key];
                    $file_size = $_FILES['images']['size'][$key];
                    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

                    $new_file_name = uniqid() . '.' . $file_ext;
                    if (move_uploaded_file($file_tmp, $uploadDir . $new_file_name)) {
                        $uploadedFiles[] = $new_file_name;
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

            header("Location: index.php?page=" . base64_encode('work_report'));
            exit();
        }
    }
}