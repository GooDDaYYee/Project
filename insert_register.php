<?php
include "connect.php";

$name = $_POST["name"];
$lastname = $_POST["lastname"];
$username = $_POST["username"];
$password = $_POST["passW"];
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO user(name, lastname, username, passW) VALUES (:name, :lastname, :username, :passW)";

try {
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':passW', $hashed_password);

    $result = $stmt->execute();

    if ($result) {
        echo '<script>
            alert("เพิ่มข้อมูลสำเร็จ");
            history.back();
            </script>
        ';
    } else {
        echo '<script>
            alert("เพิ่มข้อมูลไม่สำเร็จ");
            history.back();
            </script>
        ';
    }
} catch (PDOException $e) {
    echo '<script>
        alert("เกิดข้อผิดพลาด: ' . $e->getMessage() . '");
        history.back();
        </script>
    ';
}

// ปิดการเชื่อมต่อฐานข้อมูล
$con = null;
