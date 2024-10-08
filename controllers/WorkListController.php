<?php
require_once __DIR__ . '/BaseController.php';

class WorkListController extends BaseController
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
                $this->logAction('Folder Not Found', "Attempted to view non-existent folder: $folderName");
                header("Location: index.php?page=work-list");
            }
        } else {
            $this->logAction('Invalid Folder Request', "Attempted to view folder without specifying folder name");
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

        $logDetail = $result ? "deleted " . count($imagesToDelete) . " images" : "Failed to delete images";
        $this->logAction('Delete Images', $logDetail);

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
                    $_SESSION['success_message'] = "โฟลเดอร์ถูกลบเรียบร้อยแล้ว";
                    $this->logAction('Delete Folder', "deleted folder: $folderName");
                } else {
                    $_SESSION['error_message'] = "ไม่สามารถลบโฟลเดอร์ได้";
                    $this->logAction('Delete Folder Failed', "Failed to delete folder: $folderName");
                }
            } else {
                $_SESSION['error_message'] = "ไม่พบโฟลเดอร์ที่ระบุ";
                $this->logAction('Folder Not Found', "Attempted to delete non-existent folder: $folderName");
            }
        } else {
            $_SESSION['error_message'] = "ไม่ได้ระบุชื่อโฟลเดอร์";
            $this->logAction('Invalid Delete Request', "Attempted to delete folder without specifying folder name");
        }
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

    public function handleUploadImages()
    {
        $folderName = $_POST['folder'] ?? null;
        $uploadPath = 'assets/files/LINE/' . $folderName . '/';

        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        $uploadedFiles = [];
        $errors = [];

        foreach ($_FILES['images']['name'] as $key => $name) {
            $tmpName = $_FILES['images']['tmp_name'][$key];
            $error = $_FILES['images']['error'][$key];

            if ($error === UPLOAD_ERR_OK) {
                $extension = pathinfo($name, PATHINFO_EXTENSION);
                $newName = uniqid() . '.' . $extension;
                $destination = $uploadPath . $newName;

                if (move_uploaded_file($tmpName, $destination)) {
                    $uploadedFiles[] = $destination;
                } else {
                    $errors[] = "ไม่สามารถอัพโหลดไฟล์ $name ได้";
                }
            } else {
                $errors[] = "เกิดข้อผิดพลาดในการอัพโหลดไฟล์ $name";
            }
        }

        $logDetail = empty($errors)
            ? "uploaded " . count($uploadedFiles) . " images to folder: $folderName"
            : "Failed to upload some images to folder: $folderName. Errors: " . implode(", ", $errors);
        $this->logAction('Upload Images', $logDetail);

        header('Content-Type: application/json');
        if (empty($errors)) {
            echo json_encode(['success' => true, 'files' => $uploadedFiles]);
        } else {
            echo json_encode(['success' => false, 'errors' => $errors]);
        }
        exit;
    }
}
