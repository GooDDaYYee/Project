<?php
require_once __DIR__ . '/BaseController.php';

class HomeController extends BaseController
{
    public function index()
    {
        $data = [
            'users_count' => $this->getUsersCount(),
            'document_employees_count' => $this->getEmployeesCount('พนักงานเอกสาร'),
            'operational_employees_count' => $this->getEmployeesCount('พนักงานปฏิบัติงาน'),
            'files_count' => $this->getFilesCount(),
            // 'shared_files' => $this->getSharedFiles()
        ];

        // Set the page title and content
        $pageTitle = 'Home - PSNK TELECOM';
        $this->render('home/index', ['pageTitle' => $pageTitle, 'data' => $data]);
    }

    private function getUsersCount()
    {
        $stmt = $this->db->query('SELECT COUNT(*) FROM users');
        return $stmt->fetchColumn();
    }

    private function getEmployeesCount($position)
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM employee WHERE employee_position = ?");
        $stmt->execute([$position]);
        return $stmt->fetchColumn();
    }

    private function getFilesCount()
    {
        return 0;
        $stmt = $this->db->query('SELECT COUNT(*) FROM files');
        return $stmt->fetchColumn();
    }

    private function getSharedFiles()
    {
        $stmt = $this->db->query("SELECT f.*, e.employee_name as uname 
                                  FROM files f 
                                  INNER JOIN users u ON u.user_id = f.user_id 
                                  INNER JOIN employee e ON e.employee_id = u.employee_id 
                                  WHERE f.is_public = 1 
                                  ORDER BY DATE(f.files_date) DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
