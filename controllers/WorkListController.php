<?php
require_once __DIR__ . '/BaseController.php';

class WorkListController extends BaseController
{
    public function index()
    {
        $path = 'assets/files/LINE';
        $folders = $this->getFolderDetails($path);

        $data = [
            'folders' => $folders,
        ];

        $pageTitle = 'รายการปฏิบัติงาน - PSNK TELECOM';
        $this->render('work_list/index', ['pageTitle' => $pageTitle, 'data' => $data]);
    }

    private function getFolderDetails($path)
    {
        // Check if the directory exists
        if (!is_dir($path)) {
            return [];
        }

        // Get all items in the directory
        $items = scandir($path);

        // Remove . and .. from the list
        $items = array_diff($items, array('.', '..'));

        $folderDetails = [];

        // Loop through each item
        foreach ($items as $item) {
            $fullPath = $path . '/' . $item;

            if (is_dir($fullPath)) {
                $stats = stat($fullPath);

                $fileCount = count(array_filter(scandir($fullPath), function ($file) use ($fullPath) {
                    return is_file($fullPath . '/' . $file);
                }));

                $folderDetails[] = [
                    "name" => $item,
                    "created" => date('Y-m-d H:i:s', $stats['ctime']),
                    "ctime" => $stats['ctime'],
                    "modified" => date('Y-m-d H:i:s', $stats['mtime']),
                    "size" => $stats['size'],
                    "permissions" => substr(sprintf('%o', fileperms($fullPath)), -4),
                    "fileCount" => $fileCount
                ];
            }
        }

        usort($folderDetails, function ($a, $b) {
            return $b['ctime'] - $a['ctime'];
        });


        return $folderDetails;
    }

    public function view()
    {
        $folderName = $_GET['folder'] ?? null;

        if ($folderName) {
            $path = 'assets/files/LINE/' . $folderName;

            if (is_dir($path)) {
                $images = $this->getImagesFromFolder($path);

                $data = [
                    'folderName' => $folderName,
                    'images' => $images
                ];

                $pageTitle = $folderName . ' - PSNK TELECOM';
                $customCSS = [
                    'assets/css/lightbox.min.css'
                ];

                $customJS = [
                    'assets/js/lightbox.min.js'
                ];
                $this->render('work_list/view', ['pageTitle' => $pageTitle, 'data' => $data, 'customCSS' => $customCSS, 'customJS' =>  $customJS]);
            } else {
                // จัดการกรณีที่โฟลเดอร์ไม่มีอยู่จริง
                header("Location: index.php?page=work-list");
            }
        } else {
            // จัดการกรณีที่ไม่ได้ระบุชื่อโฟลเดอร์
            header("Location: index.php?page=work-list");
        }
    }

    private function getImagesFromFolder($path)
    {
        $images = [];
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif']; // รายการนามสกุลไฟล์รูปภาพที่อนุญาต

        if ($handle = opendir($path)) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") {
                    $ext = strtolower(pathinfo($entry, PATHINFO_EXTENSION));
                    if (in_array($ext, $allowedExtensions)) {
                        $images[] = [
                            'name' => $entry,
                            'path' => $path . '/' . $entry
                        ];
                    }
                }
            }
            closedir($handle);
        }

        return $images;
    }

    public function handleDeleteImages()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $imagesToDelete = $data['images'] ?? [];
        $result = $this->deleteImg($imagesToDelete);

        header('Content-Type: application/json');
        echo json_encode(['success' => $result]);
        exit;
    }

    private function deleteImg($imagePaths)
    {
        $success = true;
        foreach ($imagePaths as $imagePath) {
            if (file_exists($imagePath)) {
                if (!unlink($imagePath)) {
                    $success = false;
                    break;
                }
            }
        }
        return $success;
    }

    public function delete()
    {
        $folderName = $_GET['folder'] ?? null;

        if ($folderName) {
            $path = 'assets/files/LINE/' . $folderName;

            if (is_dir($path)) {
                if ($this->deleteFolder($path)) {
                    // Folder deleted successfully
                    $_SESSION['success_message'] = "โฟลเดอร์ถูกลบเรียบร้อยแล้ว";
                } else {
                    // Failed to delete folder
                    $_SESSION['error_message'] = "ไม่สามารถลบโฟลเดอร์ได้";
                }
            } else {
                // Folder doesn't exist
                $_SESSION['error_message'] = "ไม่พบโฟลเดอร์ที่ระบุ";
            }
        } else {
            // No folder specified
            $_SESSION['error_message'] = "ไม่ได้ระบุชื่อโฟลเดอร์";
        }

        // Redirect back to the work list page
        header("Location: index.php?page=work-list");
        exit;
    }

    private function deleteFolder($path)
    {
        if (is_dir($path)) {
            $files = array_diff(scandir($path), array('.', '..'));
            foreach ($files as $file) {
                $fullPath = $path . DIRECTORY_SEPARATOR . $file;
                (is_dir($fullPath)) ? $this->deleteFolder($fullPath) : unlink($fullPath);
            }
            return rmdir($path);
        }
        return false;
    }
}
