<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>เข้าสู่ระบบ</title>

    <!-- Custom fonts for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link href='https://fonts.googleapis.com/css?family=Mitr' rel='stylesheet'>
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-mGkxnLkTdHU8zntjw9pCiNQRlPXEYGwk/TPpC9enTHZ9xE2eKGqBRGLjtvq5mcyVX" crossorigin="anonymous"></script>
    <link href="css\css_login.css" rel="stylesheet">
</head>

<style>
    body {
        font-family: "Mitr";
        font-size: 22px;
        background-image: url("img/background-login.jpg");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }
</style>

<body>
    <div class="container">
        <form class="form-signin container" name="form_login" id="form_login" method="post" action="login_process.php">
            <div>
                <h1>PSNK Telecom<sup class="warning">CP</sup></h1>
            </div>
            <div class="row justify-content-center">
                <div class="col-xl-10 col-lg-12 col-md-9">
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <div class="row">
                                <div class="col-lg">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h2 class="h4 text-gray-900 mb-4">เข้าสู่ระบบ</h2>
                                        </div>
                                        <form class="user">
                                            <div class="form-group">
                                                <input type="username" id="input_username" name="input_username" class="form-control form-control-user" placeholder="Username" required="" autofocus="" <?php if (isset($_COOKIE['username'])) echo "value='" . $_COOKIE['username'] . "'"; ?>>
                                            </div>
                                            <div class="form-group">
                                                <input type="password" id="input_password" name="input_password" class="form-control form-control-user" placeholder="Password" required="" <?php if (isset($_COOKIE['password'])) echo "value='" . $_COOKIE['password'] . "'"; ?>>
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox small d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <input type="checkbox" class="custom-control-input" id="customCheck" name="customCheck" <?php if (isset($_COOKIE['username'])) echo "checked"; ?>> <!-- เพิ่มโค้ดเพื่อให้ถูกติ้กถ้ามีการตรวจสอบ cookie ชื่อ username -->
                                                        <label class="custom-control-label" for="customCheck">จำรหัสผ่าน</label>
                                                    </div>
                                                    <a href="forget_pass.php">ลืมรหัสผ่าน</a>
                                                </div>
                                            </div>
                                            <div class="row justify-content-center align-items-center">
                                                <div class="col-4">
                                                    <button href="index.php?page=home" class="btn btn-warning bg-gradient-purple col" type="submit">
                                                        <h5>เข้าสู่ระบบ</h5>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
        <script src="js/sb-admin-2.min.js"></script>

        <script>
            // ตรวจสอบว่ามีการเลือก checkbox Remember หรือไม่
            if (document.getElementById("customCheck").checked) {
                // เก็บค่า username และ password ใน localStorage
                localStorage.setItem("username", document.getElementById("input_username").value);
                localStorage.setItem("password", document.getElementById("input_password").value);
            }

            // เมื่อมีการส่งแบบฟอร์ม
            document.getElementById("form_login").addEventListener("submit", function() {
                // ตรวจสอบว่ามีการเลือก checkbox Remember หรือไม่
                if (document.getElementById("customCheck").checked) {
                    // เก็บค่า username และ password ใน cookie และกำหนดอายุของ cookie เป็น 30 วัน
                    document.cookie = "username=" + document.getElementById("input_username").value + "; expires=Fri, 31 Dec 9999 23:59:59 GMT";
                    document.cookie = "password=" + document.getElementById("input_password").value + "; expires=Fri, 31 Dec 9999 23:59:59 GMT";
                } else {
                    // ลบ cookie ชื่อ username และ password ถ้า checkbox Remember ไม่ถูกติ้ก
                    document.cookie = "username=; expires=Thu, 01 Jan 1970 00:00:00 GMT";
                    document.cookie = "password=; expires=Thu, 01 Jan 1970 00:00:00 GMT";
                }
            });
        </script>
</body>

</html>