<?php
session_start();
include('connect.php');
$users = $_POST['input_username'];
$pass = $_POST['input_password'];

try {
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM users WHERE status='1' AND username=:username";
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':username', $users);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $stored_password = $row["passW"];

        if (password_verify($pass, $stored_password)) {
            $_SESSION['login'] = 'yes';
            $_SESSION['user_id'] = $row["user_id"];
            $_SESSION["lv"] = $row["lv"];
            $_SESSION["employee_id"] = $row["employee_id"];

            echo json_encode(['success' => true]);
            exit();
        } else {
            http_response_code(400);
            echo json_encode(['success' => false]);
            exit();
        }
    } else {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'ไม่พบผู้ใช้']);
        exit();
    }
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
