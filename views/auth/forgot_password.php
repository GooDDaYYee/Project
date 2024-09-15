<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Login page for PSNK Telecom">
    <meta name="author" content="PSNK Telecom">

    <title>ลืมรหัสผ่าน - PSNK Telecom</title>

    <!-- CSS Import -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Mitr' rel='stylesheet'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link href="assets/css/sweetalert2.min.css" rel="stylesheet">
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body id="login-page">
    <div class="container">
        <form class="form-signin container" name="forgotPasswordForm" method="post" id="forgotPasswordForm">
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
                                            <h2 class="h4 text-gray-900 mb-4">ลืมรหัสผ่าน</h2>
                                        </div>
                                        <form class="user" id="forgetPassForm">
                                            <div class="form-group">
                                                <input type="email" id="email" name="email" class="form-control form-control-user" placeholder="Email" required="" autofocus="">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" id="phone" name="phone" class="form-control form-control-user" placeholder="เบอร์โทรศัพท์" required="">
                                            </div>
                                            <div class="form-group">
                                            <div class="custom-control custom-checkbox small d-flex justify-content-end align-items-center">
                                                <a href="index.php?page=auth">เข้าสู่ระบบ</a>
                                            </div>
                                        </div>
                                            <div class="row justify-content-center align-items-center">
                                                <div class="col-4">
                                                    <button class="btn btn-warning bg-gradient-purple col" type="submit">
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
    </div>

    <!-- Javascript Import -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery.easing.min.js"></script>
    <script src="assets/js/sb-admin-2.min.js"></script>
    <script src="assets/js/sweetalert2.all.min.js"></script>

    <!-- Custom Script -->
    <script>
        $(document).ready(function() {
            $(function() {
                $('#forgotPasswordForm').on('submit', function(e) {
                    e.preventDefault();

                    let email = $('#email').val();
                    let phone = $('#phone').val();

                    $.ajax({
                        type: "POST",
                        url: "controllers/AuthController.php",
                        data: {
                            action: 'forgot_password',
                            email: email,
                            phone: phone,
                        },
                        dataType: 'json',
                        success: function(response) {
                            console.log("Success:", response);
                            Swal.fire({
                                icon: 'success',
                                title: 'สำเร็จ',
                                text: 'ได้ทำการส่งรหัสผ่านใหม่ไปที่ Gmail ของคุณแล้ว',
                            }).then(function() {
                                window.location.href = "login.php";
                            });
                        },
                        error: function() {
                            console.log("Error occurred");
                            Swal.fire({
                                icon: 'error',
                                title: 'ไม่สำเร็จ',
                                text: 'ทำการส่งรหัสผ่านใหม่ไปที่ Gmail ของคุณไม่ได้',
                            });
                        }
                    });
                });
            });
        });
    </script>
</body>

</html>