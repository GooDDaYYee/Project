<?php
    // insertStudent.php ใช้เพิ่มข้อมูลเข้าตาราง student
    /* */
    // 1. เปิดการเชื่อมต่อฐานข้อมูล
    include "connect_register.php";

    // 2. รับข้อมูลจากไฟล์ studentForm
    $name = $_POST["name"];
    $lastname = $_POST["lastname"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $password = sha1($password);


    // 3. insert ข้อมูลเข้าตาราง
    $sql = "insert into user(name,lastname,username,password)
    VALUES ('$name','$lastname','$username','$password');";

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