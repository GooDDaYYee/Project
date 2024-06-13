<?php
include 'connect.php';
$qry = $con->query("SELECT * FROM files where id=" . $_GET['id'])->fetch(PDO::FETCH_ASSOC);

$fname = $qry['file_path'];
$file = ("uploads/" . $fname);

header("Content-Type: " . filetype($file));
header("Content-Length: " . filesize($file));
header("Content-Disposition: attachment; filename=" . $qry['name'] . '.' . $qry['file_type']);

readfile($file);
