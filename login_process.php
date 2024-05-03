<?php
    session_start();
    
    $user=$_POST['input_username'];
    $pass=$_POST['input_password'];

    $servername = "localhost";
    $serverusername = "root";
    $serverpassword = "";
    
    // Create connection
    $con = mysqli_connect($servername, $serverusername, $serverpassword);

    // Check connection
    if (!$con) {
    
        die("Connection failed: " . mysqli_connect_error());
    }
    
    //echo "Connected successfully";
    $sql="select * FROM repair.user where status='1' and username='$user';";

    //echo $sql;
    
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $_SESSION['login']='yes';
            $_SESSION['name']=$row["name"];
            $_SESSION["lastname"]=$row["lastname"];
            $_SESSION["id"]=$row["Id"];
            $_SESSION["lv"]=$row["lv"];
        }
        header( "location: index.php?page=home" );
    } else {
        echo '<script>alert("รหัสผิด");window.location="login.php";</script>';

        //header( "location: login.php" );
        exit(0);
    }
        
    mysqli_close($con);
?>