<?php
    session_start();
    
    $user = $_POST['input_username'];
    $pass = $_POST['input_password'];

    $servername = "localhost";
    $serverusername = "root";
    $serverpassword = "";
    $dbname = "psnktelecom";
    
    // Create connection
    $con = mysqli_connect($servername, $serverusername, $serverpassword, $dbname);

    // Check connection
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    // Prepare SQL statement
    $sql = "SELECT * FROM user WHERE status='1' AND username=?";

    // Prepare and bind
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "s", $user);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            // Verify password
            if ($row['passW'] == $pass) {
                $_SESSION['login'] = 'yes';
                $_SESSION['name'] = $row["name"];
                $_SESSION["lastname"] = $row["lastname"];
                $_SESSION["id"] = $row["Id_user"];
                $_SESSION["lv"] = $row["lv"];
                header("location: index.php?page=home");
                exit();
            } else {
                echo '<script>alert("รหัสผิด");window.location="login.php";</script>';
                exit();
            }
        }
    } else {
        echo '<script>alert("ไม่พบผู้ใช้");window.location="login.php";</script>';
        exit();
    }
        
    mysqli_close($con);
?>
