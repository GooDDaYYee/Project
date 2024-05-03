<?php
    include "connect_register.php";

    $name = $_POST["name"];
    $lastname = $_POST["lastname"];
    $username = $_POST["username"];
    $password = $_POST["passW"];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "insert into user(name,lastname,username,passW)
    VALUES ('$name','$lastname','$username','$hashed_password');";

    $result=mysqli_query($conn, $sql);
    
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
    mysqli_close($conn);
?>