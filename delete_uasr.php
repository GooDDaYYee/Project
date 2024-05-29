<?php
include('connect.php');

if (isset($_GET['username'])) {
    $username = $_GET['username'];

    try {
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $con->beginTransaction();

        $stmtDetail = $con->prepare("DELETE FROM user WHERE username = :username");
        $stmtDetail->bindParam(':username', $username);
        $stmtDetail->execute();

        $con->commit();

        header("Location: index.php?page=manage_user");
        exit();
    } catch (PDOException $e) {
        $con->rollBack();
        echo "Error: " . $e->getMessage();
    }

    $con = null;
} else {
    echo "Invalid request.";
}
