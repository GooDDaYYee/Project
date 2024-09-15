<?php
require_once __DIR__ . '/BaseController.php';

class LogController extends BaseController
{
    public function index()
    {
        if ($_SESSION["lv"] != 0) {
            header("Location: index.php?page=home");
            exit();
        }

        $logs = $this->fetchLogs();
        
        $data = [
            'logs' => $logs,
        ];

        $pageTitle = 'ประวัติการใช้งาน - PSNK TELECOM';
        $this->render('log/index', ['pageTitle' => $pageTitle, 'data' => $data]);
    }

    private function fetchLogs()
    {
        $strsql = "SELECT log.log_status, log.log_detail, log.user_id, log.log_date, employee.employee_name 
                   FROM log 
                   LEFT JOIN users ON log.user_id = users.user_id
                   LEFT JOIN employee ON users.employee_id = employee.employee_id 
                   ORDER BY log.log_date DESC";
        try {
            $stmt = $this->db->prepare($strsql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error fetching logs: " . $e->getMessage());
            return [];
        }
    }
}