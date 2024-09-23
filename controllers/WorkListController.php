<?php
require_once __DIR__ . '/BaseController.php';

class WorkListController extends BaseController
{
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
                    "modified" => date('Y-m-d H:i:s', $stats['mtime']),
                    "size" => $stats['size'],
                    "permissions" => substr(sprintf('%o', fileperms($fullPath)), -4),
                    "fileCount" => $fileCount
                ];
            }
        }

        return $folderDetails;
    }
}
