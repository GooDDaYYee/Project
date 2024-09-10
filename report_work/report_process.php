<?php
session_start();
header('Content-Type: application/json');

class ReportWork
{
    private $db;

    public function __construct()
    {
        include dirname(__FILE__) . '/../connect.php';
        $this->db = $con;
    }

    function __destruct()
    {
        $this->db = null;
    }

    private function add_log($log_status, $log_detail, $user_id)
    {
        $stmt = $this->db->prepare("INSERT INTO log (log_status, log_detail, user_id) VALUES (:log_status, :log_detail, :user_id)");
        $stmt->execute([':log_status' => $log_status, ':log_detail' => $log_detail, ':user_id' => $user_id]);
    }

    public function save_folder($name, $parent_id = 0)
    {
        $folders_type = 2;  // เปลี่ยนเป็น 2 ตามที่ต้องการ
        $data = ["name" => $name, "parent_id" => $parent_id, "folders_type" => $folders_type, "user_id" => $_SESSION['user_id']];

        // ตรวจสอบชื่อโฟลเดอร์ซ้ำ
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM folders WHERE user_id = :user_id AND name = :name AND parent_id = :parent_id");
        $stmt->execute([':user_id' => $_SESSION['user_id'], ':name' => $name, ':parent_id' => $parent_id]);
        $check = $stmt->fetchColumn();

        if ($check > 0) {
            return json_encode(['status' => 2, 'msg' => 'ชื่อโฟลเดอร์ซ้ำในระดับเดียวกัน']);
        }

        $stmt = $this->db->prepare("INSERT INTO folders (name, parent_id, folders_type, user_id) VALUES (:name, :parent_id, :folders_type, :user_id)");
        $stmt->execute($data);
        $new_folder_id = $this->db->lastInsertId();

        $folder_path = $this->get_folder_path($parent_id) . '/' . $name;
        $full_path = 'uploads/' . $folder_path;

        if (!file_exists($full_path) && mkdir($full_path, 0755, true)) {
            $this->add_log('Folder Created', 'Folder name: ' . $name, $_SESSION['user_id']);
            return ['status' => 1, 'msg' => 'Folder created successfully', 'folder_id' => $new_folder_id, 'folder_path' => $folder_path];
        } else {
            $this->db->prepare("DELETE FROM folders WHERE folders_id = ?")->execute([$new_folder_id]);
            return json_encode(['status' => 2, 'msg' => 'ไม่สามารถสร้างโฟลเดอร์ได้']);
        }
    }

    private function get_folder_path($folder_id)
    {
        $path = '';
        while ($folder_id != 0) {
            $folder_query = $this->db->prepare("SELECT name, parent_id FROM folders WHERE folders_id = :folder_id");
            $folder_query->bindParam(':folder_id', $folder_id);
            $folder_query->execute();
            $folder = $folder_query->fetch(PDO::FETCH_ASSOC);
            $path = $folder['name'] . '/' . $path;
            $folder_id = $folder['parent_id'];
        }
        return rtrim($path, '/');
    }

    public function save_files($files, $folder_id, $description)
    {
        $upload_errors = array();
        $folder_path = $this->get_folder_path($folder_id);
        $uploaded_count = 0;

        if (!empty($files['tmp_name'][0])) {
            foreach ($files['tmp_name'] as $key => $tmp_name) {
                // File validation
                $file_name = $files['name'][$key];
                $file_size = $files['size'][$key];
                $file_tmp = $files['tmp_name'][$key];
                $file_type = $files['type'][$key];
                $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

                $extensions = array("jpeg", "jpg", "png", "gif", "pdf", "doc", "docx", "xls", "xlsx", "txt");

                if (!in_array($file_ext, $extensions)) {
                    $upload_errors[] = "ไม่อนุญาตให้ขยายเวลา $file_name";
                    continue;
                }

                $fname = strtotime(date("y-m-d H:i")) . '_' . $file_name;
                $file_path = 'uploads/' . ($folder_path ? $folder_path . '/' : '') . $fname;

                if (move_uploaded_file($file_tmp, $file_path)) {
                    $uploaded_count++;
                    $file = explode('.', $file_name);
                    $data = "name = '" . $file[0] . "' ";
                    $data .= ", folders_id = " . ($folder_id !== NULL ? "'" . $folder_id . "'" : "NULL") . " ";
                    $data .= ", description = '" . $description . "' ";
                    $data .= ", user_id = '" . $_SESSION['user_id'] . "' ";
                    $data .= ", file_type = '" . $file[1] . "' ";
                    $data .= ", file_path = '" . $fname . "' ";
                    $data .= ", is_public = 0";

                    $save = $this->db->query("INSERT INTO files SET " . $data);
                    if ($save) {
                        $this->add_log('File Uploaded', 'File name: ' . $file[0], $_SESSION['user_id']);
                    }
                } else {
                    $upload_errors[] = "ไม่สามารถอัปโหลดไฟล์ $file_name";
                }
            }

            if (empty($upload_errors)) {
                return json_encode([
                    'status' => 1,
                    'msg' => 'อัปโหลดไฟล์เรียบร้อยแล้ว',
                    'uploaded_count' => $uploaded_count
                ]);
            } else {
                return json_encode(['status' => 2, 'msg' => implode("<br>", $upload_errors)]);
            }
        }
    }

    public function sendLineNotify($jobname, $group, $image_count, $report_time)
    {
        $tokens = [
            1 => "ZttPwN3qU9h2cl2HUAipy2MPFMCfTGxXb37Qbf4IKt2", // PSNK Group 1
            2 => "I9A20aBNYwcqavN0tbvR5B4uwDxBCIeWMXhQ2LRA0Gr"  // PSNK Group 2
        ];

        $token = $tokens[$group] ?? null;

        if (!$token) {
            return json_encode(['status' => 'error', 'message' => 'Invalid group selected']);
        }

        $message = "\nรายงานงานใหม่: " . $jobname;
        $message .= "\nจำนวนรูปภาพ: " . $image_count;
        $message .= "\nเวลารายงาน: " . $report_time;

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
            $response = ['status' => 'error', 'message' => curl_error($ch)];
        } else {
            $res = json_decode($result, true);
            $response = ['status' => $res['status'], 'message' => $res['message']];
        }
        curl_close($ch);

        return json_encode($response);
    }
}

$report = new ReportWork();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['jobname'])) {
        echo json_encode(['status' => 0, 'msg' => 'กรุณากรอกชื่องาน']);
        exit;
    }

    $jobname = $_POST['jobname'];
    $description = "Job: " . $jobname;
    $group = $_POST['group'] ?? 1;
    $report_time = date('Y-m-d H:i:s');

    try {
        $folder_result = $report->save_folder($jobname);
        $folder_id = $folder_result['folder_id'];

        $file_result = ['status' => 0, 'msg' => 'ไม่มีไฟล์ถูกอัปโหลด', 'uploaded_count' => 0];
        if (isset($_FILES['images']) && !empty($_FILES['images']['name'][0])) {
            $file_result = json_decode($report->save_files($_FILES['images'], $folder_id, $description), true);
        }

        $notify_result = $report->sendLineNotify($jobname, $group, $file_result['uploaded_count'], $report_time);

        $response = [
            'status' => 1,
            'msg' => 'บันทึกข้อมูลสำเร็จ',
            'folder_result' => $folder_result,
            'file_result' => $file_result,
            'notify_result' => json_decode($notify_result, true)
        ];

        echo json_encode($response);
    } catch (Exception $e) {
        echo json_encode(['status' => 0, 'msg' => 'เกิดข้อผิดพลาด: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 0, 'msg' => 'วิธีการร้องขอไม่ถูกต้อง']);
}
