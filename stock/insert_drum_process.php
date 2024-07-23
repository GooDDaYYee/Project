<?php
include("../connect.php");

try {
    $drum_no = $_POST['drum_no'];
    $drum_company = $_POST['drum_company'];
    $drum_cable_company = $_POST['drum_cable_company'];
    $strsql = "SELECT * FROM drum WHERE drum_no=:drum_no";
    $stmt = $con->prepare($strsql);
    $stmt->bindParam(':drum_no', $drum_no);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result && ($drum_company == $result['drum_company'] && $drum_cable_company == $result['drum_cable_company'])) {
        echo '<script>
        alert("มีข้อมูล drum อยู่แล้วกรุณาเลือกใหม่");
        history.back();
        </script>';
        exit();
    }
} catch (PDOException $e) {
    echo '<script>
        alert("เกิดข้อผิดพลาด: ' . $e->getMessage() . '");
        history.back();
        </script>';
    exit();
}


try {
    $con->beginTransaction();

    $stmt = $con->prepare("INSERT INTO drum (drum_no, drum_to, drum_description, drum_full, drum_remaining, drum_company, drum_cable_company)
    VALUES (:drum_no, :drum_to, :drum_description, :drum_full, :drum_remaining, :drum_company, :drum_cable_company)");

    $stmt->bindParam(':drum_no', $_POST['drum_no']);
    $stmt->bindParam(':drum_to', $_POST['drum_to']);
    $stmt->bindParam(':drum_description', $_POST['drum_description']);
    $stmt->bindParam(':drum_full', $_POST['drum_full']);
    $stmt->bindParam(':drum_remaining', $_POST['drum_full']);
    $stmt->bindParam(':drum_company', $_POST['drum_company']);
    $stmt->bindParam(':drum_cable_company', $_POST['drum_cable_company']);

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
    $con->commit();
    header("Location: ../index.php?page=stock/list_stock_drum");
    exit();
} catch (PDOException $e) {
    $con->rollBack();
    echo '<script>
        alert("เกิดข้อผิดพลาด: ' . $e->getMessage() . '");
        history.back();
        </script>
    ';
}
