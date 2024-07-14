<?php
include('../connect.php');

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    try {
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $con->beginTransaction();

        $stmtDetail = $con->prepare("DELETE FROM users WHERE user_id = :user_id");
        $stmtDetail->bindParam(':user_id', $user_id);
        $stmtDetail->execute();

        $con->commit();

        header("Location: ../index.php?page=users/list_user");
        exit();
    } catch (PDOException $e) {
        $con->rollBack();
        echo "Error: " . $e->getMessage();
    }

    $con = null;
} else {
    echo "Invalid request.";
}
