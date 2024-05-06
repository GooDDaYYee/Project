<?php
include('connect.php');

if (isset($_GET['au_id'])) {
    $auId = $_GET['au_id'];
    $query = "SELECT au_detail FROM au_all WHERE au_id = '$auId'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    echo $row['au_detail'];
}

mysqli_close($con);
