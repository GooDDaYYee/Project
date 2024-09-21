<?php
require_once __DIR__ . '/BaseController.php';
class elFinderController extends BaseController
{
    public function index()
    {
        echo "yes";
        die();
        $pageTitle = 'จัดการไฟล์ - PSNK TELECOM';
        $this->render('elFinder/index', ['pageTitle' => $pageTitle]);
    }
}
