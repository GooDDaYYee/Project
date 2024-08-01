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

    <title>Login</title>

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

        <!-- Outer Row -->
        <form class="form-signin container" name="form_login" id="form_login" method="post" action="forgetpass.php">
            <div>
                <h1>PSNK Telecom<sup class="warning">CP</sup></h1>
            </div>
            <div class="row justify-content-center">
                <div class="col-xl-10 col-lg-12 col-md-9">
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h2 class="h4 text-gray-900 mb-4">ลืมรหัสผ่าน</h2>
                                        </div>
                                        <form class="user">
                                            <div class="form-group">
                                                <input type="text" id="input_username" name="input_username" class="form-control form-control-user" placeholder="บัญชีผู้ใช้" required="" autofocus="">
                                            </div>
                                            <div class="form-group">
                                                <input type="phone" id="phone" name="phone" class="form-control form-control-user" placeholder="เบอร์โทรศัพท์" required="">
                                            </div>
                                            <div class="row justify-content-center align-items-center">
                                                <div class="col-4">
                                                    <button href="index.php?page=home" class="btn btn-warning bg-gradient-purple col" type="submit">
                                                        <h5>รีเซ็ตรหัสผ่าน</h5>
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
</body>

</html>