<?php
require_once __DIR__ . '/BaseController.php';
require 'libs/phpspreadsheet/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

class EditBackController extends BaseController
{
    public function __construct()
    {
        parent::__construct();

        if ($_SESSION["lv"] != 0) {
            header("Location: index.php?page=home");
            exit();
        }
    }

    public function index()
    {
        $pageTitle = 'แก้ไขข้อมูลเชิงลึก - PSNK TELECOM';
        $data = $this->QryDb();
        $this->render('edit_back/index', ['pageTitle' => $pageTitle, 'data' => $data]);
    }

    public function QryDb()
    {
        $results = [];

        $queries = [
            'bill_bank' => "SELECT * FROM bill_bank",
            'cable_work' => "SELECT * FROM cable_work",
            'company_address_psnk' => "SELECT * FROM company_address WHERE company_address_type = 0",
            'company_address_mixed' => "SELECT * FROM company_address WHERE company_address_type = 1",
            'company_address_fbh' => "SELECT * FROM company_address WHERE company_address_type = 2",
            'company_address_mixed_contact' => "SELECT * FROM company_address WHERE company_address_type = 1",
            'company_address_fbh_contact' => "SELECT * FROM company_address WHERE company_address_type = 2",
            'drum_cable_company' => "SELECT * FROM drum_cable_company",
            'drum_company' => "SELECT * FROM drum_company"
        ];

        foreach ($queries as $key => $query) {
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $results[$key] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        return $results;
    }

    public function insertData()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $table = $_POST['table'];
            $value = $_POST['value'];

            $columnMap = [
                'drum_company' => 'drum_company_detail',
                'drum_cable_company' => 'drum_cable_company_detail',
                'cable_work' => 'cable_work_name'
            ];

            if (!isset($columnMap[$table])) {
                echo json_encode(['status' => 'error', 'message' => 'ตารางไม่ถูกต้อง']);
                return;
            }

            $column = $columnMap[$table];

            $query = "INSERT INTO $table ($column) VALUES (:value)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':value', $value);

            if ($stmt->execute()) {
                $id = $this->db->lastInsertId();
                $this->logAction('Data Inserted', "Table: $table, Column: $column, Value: $value, ID: $id");
                echo json_encode(['status' => 'success', 'message' => 'เพิ่มข้อมูลสำเร็จ', 'id' => $id]);
            } else {
                $this->logAction('Data Insertion Failed', "Table: $table, Column: $column, Value: $value");
                echo json_encode(['status' => 'error', 'message' => 'ไม่สามารถแทรกข้อมูลได้']);
            }
        }
    }

    public function deleteData()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $table = $_POST['table'];
            $id = $_POST['id'];

            $columnMap = [
                'drum_company' => 'drum_company_id',
                'drum_cable_company' => 'drum_cable_company_id',
                'cable_work' => 'cable_work_id'
            ];

            if (!isset($columnMap[$table])) {
                echo json_encode(['status' => 'error', 'message' => 'ตารางไม่ถูกต้อง']);
                return;
            }

            $column = $columnMap[$table];

            $query = "DELETE FROM $table WHERE $column = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id);

            if ($stmt->execute()) {
                $this->logAction('Data Deleted', "Table: $table, Column: $column, ID: $id");
                echo json_encode(['status' => 'success', 'message' => 'ลบข้อมูลสำเร็จ']);
            } else {
                $this->logAction('Data Deletion Failed', "Table: $table, Column: $column, ID: $id");
                echo json_encode(['status' => 'error', 'message' => 'ไม่สามารถลบข้อมูลได้']);
            }
        }
    }

    public function updateData()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $table = $_POST['table'];
            $value = $_POST['value'];

            $tableMap = [
                'bill_bank' => ['table' => 'bill_bank', 'column' => 'bank_detail', 'where' => ''],
                'company_address_psnk' => ['table' => 'company_address', 'column' => 'company_address_detaill', 'where' => 'WHERE company_address_type = 0'],
                'company_address_mixed' => ['table' => 'company_address', 'column' => 'company_address_detaill', 'where' => 'WHERE company_address_type = 1'],
                'company_address_fbh' => ['table' => 'company_address', 'column' => 'company_address_detaill', 'where' => 'WHERE company_address_type = 2'],
                'company_address_mixed_contact' => ['table' => 'company_address', 'column' => 'company_address_name', 'where' => 'WHERE company_address_type = 1'],
                'company_address_fbh_contact' => ['table' => 'company_address', 'column' => 'company_address_name', 'where' => 'WHERE company_address_type = 2']
            ];

            if (!isset($tableMap[$table])) {
                echo json_encode(['status' => 'error', 'message' => 'ตารางไม่ถูกต้อง']);
                return;
            }

            $tableData = $tableMap[$table];
            $actualTable = $tableData['table'];
            $column = $tableData['column'];
            $where = $tableData['where'];

            $query = "UPDATE $actualTable SET $column = :value $where";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':value', $value);

            try {
                if ($stmt->execute()) {
                    $this->logAction('Data Updated', "Table: $actualTable, Column: $column, Value: $value, Where: $where");
                    echo json_encode(['status' => 'success', 'message' => 'อัพเดตข้อมูลสำเร็จ']);
                } else {
                    $this->logAction('Data Update Failed', "Table: $actualTable, Column: $column, Value: $value, Where: $where");
                    echo json_encode(['status' => 'error', 'message' => 'ไม่สามารถอัพเดตข้อมูลได้']);
                }
            } catch (PDOException $e) {
                $this->logAction('Data Update Error', "Table: $actualTable, Column: $column, Value: $value, Where: $where, Error: " . $e->getMessage());
                echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
            }
        }
    }


    public function importExcelToMysql($excelFile, $tableName)
    {
        $spreadsheet = IOFactory::load($excelFile);
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray();

        $headers = array_shift($rows);

        $headers = array_map(function ($header, $index) {
            return $header ?: "column_" . $index;
        }, $headers, array_keys($headers));

        $data = array_map(function ($row) use ($headers) {
            return (object) array_combine($headers, $row);
        }, $rows);

        $this->db->beginTransaction();

        try {
            $stmt = $this->db->prepare("UPDATE $tableName SET 
                                    au_detail = :au_detail,
                                    au_type = :au_type,
                                    au_price = :au_price,
                                    au_company = :au_company
                                    WHERE au_name = :au_name");

            foreach ($data as $row) {
                if (!empty($row->au_name)) {
                    try {
                        $stmt->execute([
                            ':au_detail' => $row->au_detail,
                            ':au_type' => $row->au_type,
                            ':au_price' => $row->au_price,
                            ':au_company' => $row->au_company,
                            ':au_name' => $row->au_name
                        ]);

                        if ($stmt->rowCount() == 0) {
                            $insertStmt = $this->db->prepare("INSERT INTO $tableName 
                                                         (au_name, au_detail, au_type, au_price, au_company) 
                                                         VALUES (:au_name, :au_detail, :au_type, :au_price, :au_company)");
                            $insertStmt->execute([
                                ':au_name' => $row->au_name,
                                ':au_detail' => $row->au_detail,
                                ':au_type' => $row->au_type,
                                ':au_price' => $row->au_price,
                                ':au_company' => $row->au_company
                            ]);
                        }
                    } catch (PDOException $e) {
                        error_log("Error updating/inserting row: " . json_encode($row));
                        error_log("Error message: " . $e->getMessage());
                    }
                }
            }

            $this->db->commit();

            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    public function importAU()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_FILES['excelFile']) || $_FILES['excelFile']['error'] !== UPLOAD_ERR_OK) {
                $error = isset($_FILES['excelFile']) ? $this->getFileUploadErrorMessage($_FILES['excelFile']['error']) : 'No file uploaded';
                error_log("File upload error: " . $error);
                echo json_encode(['status' => 'error', 'message' => 'File upload error: ' . $error]);
                return;
            }

            $file = $_FILES['excelFile'];
            $allowedExtensions = ['xls', 'xlsx'];
            $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

            if (!in_array($fileExtension, $allowedExtensions)) {
                $this->logAction('AU Data Import Invalid File', "File: " . $file['name']);
                echo json_encode(['status' => 'error', 'message' => 'ประเภทไฟล์ไม่ถูกต้อง โปรดอัปโหลดไฟล์ Excel (.xls หรือ .xlsx)']);
                return;
            }

            $uploadDir = '/tmp/'; // Use a writable directory in your Docker container
            $uploadFile = $uploadDir . basename($file['name']);

            if (!move_uploaded_file($file['tmp_name'], $uploadFile)) {
                error_log("Failed to move uploaded file to: " . $uploadFile);
                echo json_encode(['status' => 'error', 'message' => 'ไม่สามารถย้ายไฟล์ที่อัปโหลด']);
                return;
            }

            try {
                $importResult = $this->importExcelToMysql($uploadFile, 'au_all');

                if ($importResult) {
                    $this->logAction('AU Data Imported', "File: " . $file['name']);
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'นำเข้าข้อมูล AU เรียบร้อยแล้ว ข้อมูลที่มีอยู่ถูกแทนที่'
                    ]);
                } else {
                    $this->logAction('AU Data Import Failed', "File: " . $file['name']);
                    echo json_encode(['status' => 'error', 'message' => 'ไม่สามารถนำเข้าข้อมูล AU']);
                }
            } catch (Exception $e) {
                error_log("Error during AU import: " . $e->getMessage());
                $this->logAction('AU Data Import Error', "File: " . $file['name'] . ", Error: " . $e->getMessage());
                echo json_encode(['status' => 'error', 'message' => 'เกิดข้อผิดพลาดระหว่างการนำเข้า: ' . $e->getMessage()]);
            } finally {
                // Clean up the temporary file
                if (file_exists($uploadFile)) {
                    unlink($uploadFile);
                }
            }
        } else {
            $this->logAction('AU Data Import Invalid Request', "Invalid request method");
            echo json_encode(['status' => 'error', 'message' => 'คำขอไม่ถูกต้อง']);
        }
    }

    private function getFileUploadErrorMessage($errorCode)
    {
        switch ($errorCode) {
            case UPLOAD_ERR_INI_SIZE:
                return "The uploaded file exceeds the upload_max_filesize directive in php.ini";
            case UPLOAD_ERR_FORM_SIZE:
                return "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form";
            case UPLOAD_ERR_PARTIAL:
                return "The uploaded file was only partially uploaded";
            case UPLOAD_ERR_NO_FILE:
                return "No file was uploaded";
            case UPLOAD_ERR_NO_TMP_DIR:
                return "Missing a temporary folder";
            case UPLOAD_ERR_CANT_WRITE:
                return "Failed to write file to disk";
            case UPLOAD_ERR_EXTENSION:
                return "File upload stopped by extension";
            default:
                return "Unknown upload error";
        }
    }
}
