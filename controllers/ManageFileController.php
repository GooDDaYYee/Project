<?php
require_once __DIR__ . '/BaseController.php';
class ManageFileController extends BaseController
{

    public function __construct()
    {
        parent::__construct();

        // Allow just admin to access this controller
        if ($_SESSION["lv"] != 0 || $_SESSION["lv"] != 1 || $_SESSION["lv"] != 2) {
            header("Location: index.php?page=work-report");
            exit();
        }
    }

    public function index()
    {
        $pageTitle = 'จัดการไฟล์ - PSNK TELECOM';
        $customCSS = [
            'assets/css/jquery-ui.css',
            'libs/elFinder/css/elfinder.min.css',
            'libs/elFinder/css/theme.css'
        ];

        $customJS = [
            'assets/js/jquery-ui.min.js',
            'libs/elFinder/js/elfinder.min.js',
            'libs/elFinder/js/extras/editors.default.min.js'
        ];

        $this->render('manage_file/index', ['pageTitle' => $pageTitle, 'customCSS' => $customCSS, 'customJS' =>  $customJS]);
    }
}
