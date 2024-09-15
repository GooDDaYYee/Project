<?php
require_once __DIR__ . '/BaseController.php';

class WorkListController extends BaseController
{
    public function index()
    {
        $folder_parent = isset($_GET['fid']) ? base64_decode($_GET['fid']) : 0;
        if (!is_numeric($folder_parent)) {
            $folder_parent = 0;
        }

        $folders = $this->getFolders($folder_parent);
        $files = $this->getFiles($folder_parent);
        $breadcrumbs = $this->getBreadcrumbs($folder_parent);

        $data = [
            'folders' => $folders,
            'files' => $files,
            'breadcrumbs' => $breadcrumbs,
            'folder_parent' => $folder_parent
        ];

        $pageTitle = 'รายการปฏิบัติงาน - PSNK TELECOM';
        $this->render('work_list/index', ['pageTitle' => $pageTitle, 'data' => $data]);
    }

    private function getFolders($parent_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM folders WHERE parent_id = :parent_id AND user_id = :user_id ORDER BY folder_date ASC");
        $stmt->execute([':parent_id' => $parent_id, ':user_id' => $_SESSION['user_id']]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private function getFiles($folder_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM files WHERE folder_id = :folder_id AND user_id = :user_id ORDER BY files_date ASC");
        $stmt->execute([':folder_id' => $folder_id, ':user_id' => $_SESSION['user_id']]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private function getBreadcrumbs($folder_id)
    {
        $breadcrumbs = [];
        while ($folder_id > 0) {
            $stmt = $this->db->prepare("SELECT * FROM folders WHERE folders_id = :folders_id");
            $stmt->execute([':folders_id' => $folder_id]);
            $folder = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($folder) {
                array_unshift($breadcrumbs, $folder);
                $folder_id = $folder['parent_id'];
            } else {
                break;
            }
        }
        return $breadcrumbs;
    }

    public function newFolder()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $folder_name = $_POST['folder_name'];
            $parent_id = $_POST['parent_id'];
            $user_id = $_SESSION['user_id'];

            $stmt = $this->db->prepare("INSERT INTO folders (name, parent_id, user_id) VALUES (:name, :parent_id, :user_id)");
            $result = $stmt->execute([':name' => $folder_name, ':parent_id' => $parent_id, ':user_id' => $user_id]);

            echo json_encode(['success' => $result]);
        }
    }

    public function newFile()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Handle file upload
            // You'll need to implement file upload logic here
        }
    }

    public function renameFolder()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $folder_id = $_POST['folder_id'];
            $new_name = $_POST['new_name'];

            $stmt = $this->db->prepare("UPDATE folders SET name = :name WHERE folders_id = :folder_id AND user_id = :user_id");
            $result = $stmt->execute([':name' => $new_name, ':folder_id' => $folder_id, ':user_id' => $_SESSION['user_id']]);

            echo json_encode(['success' => $result]);
        }
    }

    public function deleteFolder()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $folder_id = $_POST['folder_id'];

            $stmt = $this->db->prepare("DELETE FROM folders WHERE folders_id = :folder_id AND user_id = :user_id");
            $result = $stmt->execute([':folder_id' => $folder_id, ':user_id' => $_SESSION['user_id']]);

            echo json_encode(['success' => $result]);
        }
    }

    public function renameFile()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $file_id = $_POST['file_id'];
            $new_name = $_POST['new_name'];

            $stmt = $this->db->prepare("UPDATE files SET name = :name WHERE files_id = :file_id AND user_id = :user_id");
            $result = $stmt->execute([':name' => $new_name, ':file_id' => $file_id, ':user_id' => $_SESSION['user_id']]);

            echo json_encode(['success' => $result]);
        }
    }

    public function deleteFile()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $file_id = $_POST['file_id'];

            $stmt = $this->db->prepare("DELETE FROM files WHERE files_id = :file_id AND user_id = :user_id");
            $result = $stmt->execute([':file_id' => $file_id, ':user_id' => $_SESSION['user_id']]);

            echo json_encode(['success' => $result]);
        }
    }

    public function downloadFile()
    {
        if (isset($_GET['id'])) {
            $file_id = $_GET['id'];
            $stmt = $this->db->prepare("SELECT * FROM files WHERE files_id = :file_id AND user_id = :user_id");
            $stmt->execute([':file_id' => $file_id, ':user_id' => $_SESSION['user_id']]);
            $file = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($file) {
                $file_path = 'path/to/your/files/' . $file['file_path'];
                if (file_exists($file_path)) {
                    header('Content-Type: application/octet-stream');
                    header('Content-Disposition: attachment; filename="' . $file['name'] . '"');
                    header('Content-Length: ' . filesize($file_path));
                    readfile($file_path);
                    exit;
                }
            }
        }
        echo "File not found.";
    }

    public function getFileIcon($file_type)
    {
        $file_type = strtolower($file_type);
        $icon_map = [
            'image' => ['png', 'jpg', 'jpeg', 'gif', 'psd', 'tif'],
            'word' => ['doc', 'docx'],
            'pdf' => ['pdf', 'ps', 'eps', 'prn'],
            'excel' => ['xlsx', 'xls', 'xlsm', 'xlsb', 'xltm', 'xlt', 'xla', 'xlr'],
            'archive' => ['zip', 'rar', 'tar'],
            'globe' => ['kmz'],
            'cube' => ['dwg'],
            'scissors' => ['psd']
        ];

        foreach ($icon_map as $icon => $extensions) {
            if (in_array($file_type, $extensions)) {
                return "fa-file-{$icon}";
            }
        }

        return 'fa-file';
    }

    public function formatDate($date)
    {
        $timestamp = strtotime($date);
        $year_buddhist = date('Y', $timestamp) + 543;
        return date('d/m/', $timestamp) . $year_buddhist . date(' h:i A', $timestamp);
    }
}