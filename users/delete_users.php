<?php
include('../connect.php');

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    try {

        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        $con->beginTransaction();

        $stmtEmployee = $con->prepare("DELETE FROM employee WHERE user_id = :user_id");
        $stmtEmployee->bindParam(':user_id', $user_id);
        $stmtEmployee->execute();

        $stmtUser = $con->prepare("DELETE FROM users WHERE user_id = :user_id");
        $stmtUser->bindParam(':user_id', $user_id);
        $stmtUser->execute();

        $con->commit();

        header("Location: ../index.php?page=users/list_user");
        exit();
    } catch (PDOException $e) {
        $con->rollBack();
        echo '<script>
        alert("เกิดข้อผิดพลาด: ' . $e->getMessage() . '");
        history.back();
        </script>';
    }

    $con = null;
} else {
    echo "Invalid request.";
}
