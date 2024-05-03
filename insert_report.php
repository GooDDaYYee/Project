<?php
    // insertStudent.php ใช้เพิ่มข้อมูลเข้าตาราง student
    /* */
    // 1. เปิดการเชื่อมต่อฐานข้อมูล
    include "connect_report.php";

    // 2. รับข้อมูลจากไฟล์ studentForm
    $machine = $_POST["machine"];
    $category = $_POST["category"];
    $type = $_POST["type"];
    $cause = $_POST["cause"];
    $numberphone = $_POST["numberphone"];

    // 3. insert ข้อมูลเข้าตาราง
    $sql = "insert into detail(machine,category,type,cause,numberphone)
    VALUES ('$machine','$category','$type','$cause','$numberphone');";

    $result=mysqli_query($conn, $sql);
    
    // 4. ตรวจสอบว่าบันทึกเข้าตารางหรือไม่
    if($result==True){
        echo '<script>
		alert("เพิ่มข้อมูลสำเร็จ");
		history.back();
		</script>
		';
    }else{
        echo '<script>
		alert("เพิ่มข้อมูลไม่สำเร็จ");
		history.back();
		</script>
		';
    }
    // 5. ปิดการเชื่อมต่อ
    mysqli_close($conn);
?>