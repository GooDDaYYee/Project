<?php
require_once __DIR__ . '/BaseController.php';
class ManageFileController extends BaseController
{
    public function index()
    {
        $pageTitle = 'จัดการไฟล์ - PSNK TELECOM';
        $customCSS = [
            '//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css',
            'libs/elFinder/css/elfinder.min.css',
            'libs/elFinder/css/theme.css'
        ];

        $customJS = [
            '//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js',
            'libs/elFinder/js/elfinder.min.js',
            'libs/elFinder/js/extras/editors.default.min.js'
        ];

        $this->render('manage_file/index', ['pageTitle' => $pageTitle, 'customCSS' => $customCSS, 'customJS' =>  $customJS]);
    }
}
