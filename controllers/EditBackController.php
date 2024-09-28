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

        $pageTitle = 'จัดการผู้ใช้ - PSNK TELECOM';
        $this->render('edit_back/index', ['pageTitle' => $pageTitle]);
    }
}
