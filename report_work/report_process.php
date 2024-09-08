<?php
session_start();

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
                    $upload_errors[] = "Extension not allowed: $file_name";
                    continue;
                }

                if ($file_size > 5242880) { // 5 MB file size limit
                    $upload_errors[] = "File size must be less than 5 MB: $file_name";
                    continue;
                }

                $fname = strtotime(date("y-m-d H:i")) . '_' . $file_name;
                $file_path = 'uploads/' . ($folder_path ? $folder_path . '/' : '') . $fname;

                if (move_uploaded_file($file_tmp, $file_path)) {
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
                    $upload_errors[] = "Failed to upload file: $file_name";
                }
            }

            if (empty($upload_errors)) {
                return json_encode(['status' => 1, 'msg' => 'Files uploaded successfully']);
            } else {
                return json_encode(['status' => 2, 'msg' => implode("<br>", $upload_errors)]);
            }
        }
    }
}

$report = new ReportWork();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jobname = $_POST['jobname'];
    $description = "Job: " . $jobname;

    // Save folder
    $folder_result = $report->save_folder($jobname);
    $folder_id = $folder_result['folder_id'];

    // Save files
    if (isset($_FILES['images'])) {
        echo $report->save_files($_FILES['images'], $folder_id, $description);
    }
}
