<?php
define('ROOT_DIR', __DIR__);
require_once __DIR__ . '/../config/Database.php';

abstract class BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    protected function render($view, $data = [], $layout = true)
    {
        extract($data);
        $content = "views/{$view}.php";
        if ($layout) {
            include 'layouts/layout.php';
        } else {
            include $content;
        }
    }

    protected function jsonResponse($success, $message, $code = 200) {
        http_response_code($code);
        echo json_encode(['success' => $success, 'message' => $message]);
        exit();
    }

    protected function getFileIcon($fileType)
    {
        $fileType = strtolower($fileType);
        $iconMap = [
            'image' => ['png', 'jpg', 'jpeg', 'gif', 'psd', 'tif'],
            'word' => ['doc', 'docx'],
            'pdf' => ['pdf', 'ps', 'eps', 'prn'],
            'excel' => ['xlsx', 'xls', 'xlsm', 'xlsb', 'xltm', 'xlt', 'xla', 'xlr'],
            'archive' => ['zip', 'rar', 'tar'],
            'globe' => ['kmz'],
            'cube' => ['dwg'],
            'scissors' => ['psd']
        ];

        foreach ($iconMap as $icon => $extensions) {
            if (in_array($fileType, $extensions)) {
                return "fa-file-{$icon}";
            }
        }

        return 'fa-file';
    }

    protected function formatDate($date)
    {
        $timestamp = strtotime($date);
        $year_buddhist = date('Y', $timestamp) + 543;
        return date('d/m/', $timestamp) . $year_buddhist . date(' h:i A', $timestamp);
    }

    protected function logAction($status, $detail)
    {
        $stmt = $this->db->prepare("INSERT INTO log (log_status, log_detail, user_id) VALUES (:log_status, :log_detail, :user_id)");
        $stmt->execute([
            ':log_status' => $status,
            ':log_detail' => $detail,
            ':user_id' => $_SESSION['user_id']
        ]);
    }

    protected function formatThaiDate($date)
    {
        $timestamp = strtotime($date);
        $thai_month = array(
            1 => "มกราคม", 2 => "กุมภาพันธ์", 3 => "มีนาคม",
            4 => "เมษายน", 5 => "พฤษภาคม", 6 => "มิถุนายน",
            7 => "กรกฎาคม", 8 => "สิงหาคม", 9 => "กันยายน",
            10 => "ตุลาคม", 11 => "พฤศจิกายน", 12 => "ธันวาคม"
        );
        $thai_month_num = date('n', $timestamp);
        return date('d', $timestamp) . ' ' . $thai_month[$thai_month_num] . ' ' . (date('Y', $timestamp) + 543);
    }
}