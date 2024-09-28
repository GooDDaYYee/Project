<?php
require_once __DIR__ . '/BaseController.php';

class EditBackController extends BaseController
{

    public function __construct()
    {
        parent::__construct();

        // Allow just admin to access this controller
        if ($_SESSION["lv"] != 0) {
            header("Location: index.php?page=home");
            exit();
        }
    }

    public function index()
    {

        $pageTitle = 'ข้อมูลเชิงลึก - PSNK TELECOM';
        $this->render('edit_back/index', ['pageTitle' => $pageTitle]);
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
}
