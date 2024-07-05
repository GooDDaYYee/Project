<?php
include('../connect.php');

if (isset($_GET['drum_id'])) {
    $drum_id = $_GET['drum_id'];

    try {
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $con->beginTransaction();

        $stmtDetail = $con->prepare("DELETE FROM drum WHERE drum_id = :drum_id");
        $stmtDetail->bindParam(':drum_id', $drum_id);
        $stmtDetail->execute();

        $con->commit();

        header("Location: ../index.php?page=stock/list_stock_drum");
        exit();
    } catch (PDOException $e) {
        $con->rollBack();
        echo "Error: " . $e->getMessage();
    }

    $con = null;
} else {
    echo "Invalid request.";
}
