<?php
include dirname(__FILE__) . '/../connect.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die('Invalid file ID');
}

$stmt = $con->prepare("SELECT * FROM files WHERE files_id = :id");
$stmt->execute([':id' => $_GET['id']]);
$file_info = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$file_info) {
    die('File not found');
}

$file_path = "uploads/" . $file_info['file_path'];

if (!file_exists($file_path)) {
    die('File does not exist on the server');
}

$file_size = filesize($file_path);
$file_type = mime_content_type($file_path);

header("Content-Type: $file_type");
header("Content-Length: $file_size");
header("Content-Disposition: attachment; filename=" . $file_info['name'] . '.' . $file_info['file_type']);

// Disable output buffering
if (ob_get_level()) {
    ob_end_clean();
}

// Output file in chunks to handle large files
$chunk_size = 1024 * 1024; // 1 MB chunks
$handle = fopen($file_path, 'rb');

while (!feof($handle)) {
    echo fread($handle, $chunk_size);
    flush();
}

fclose($handle);
exit;
