<?php
session_start();
include dirname(__FILE__) . '/../../connect.php';

if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access");
}

if (!isset($_GET['id'])) {
    die("No file specified");
}

$file_id = $_GET['id'];

// Fetch file information
$stmt = $con->prepare("SELECT * FROM files WHERE files_id = :file_id");
$stmt->execute([':file_id' => $file_id]);
$file = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$file) {
    die("File not found");
}

// Check if the user has permission to view this file
if ($file['user_id'] != $_SESSION['user_id'] && !$file['is_public']) {
    die("You don't have permission to view this file");
}

// Construct the file path using the file_path from the database
$file_path = 'uploads/' . $file['file_path'];

// Check if the file exists
if (!file_exists($file_path)) {
    die("File not found on server");
}

$file_extension = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));
$allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];

if (!in_array($file_extension, $allowed_extensions)) {
    die("Invalid file type");
}

// Set the appropriate content type header
$mime_type = mime_content_type($file_path);
header("Content-Type: $mime_type");

// Output the file contents
readfile($file_path);
