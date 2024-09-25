<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Login page for PSNK Telecom">
    <meta name="author" content="PSNK Telecom">

    <title>เข้าสู่ระบบ - PSNK Telecom</title>

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
        <h1>PSNK Telecom<sup class="warning">CP</sup></h1>
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg">
                                <div class="p-5">
                                    <div class="text-center mb-4">
                                        <h2 class="h4 text-gray-900">เข้าสู่ระบบ</h2>
                                    </div>
                                    <form id="loginForm">
                                        <div class="form-group">
                                            <input type="text" id="username" name="username" class="form-control form-control-user" placeholder="Username" required autofocus>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" id="password" name="password" class="form-control form-control-user" placeholder="Password" required>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small d-flex justify-content-between align-items-center">
                                                <div>
                                                </div>
                                                <a href="index.php?page=auth&action=forgotPassword">ลืมรหัสผ่าน</a>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center">
                                            <div class="col-4">
                                                <button type="submit" class="btn btn-warning bg-gradient-purple btn-user btn-block">
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
            $('#loginForm').on('submit', function(e) {
                e.preventDefault();
                var $submitButton = $(this).find('button[type="submit"]');

                // Disable the submit button to prevent multiple submissions
                $submitButton.prop('disabled', true);

                $.ajax({
                    type: "POST",
                    url: "index.php?page=auth&action=login",
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'สำเร็จ',
                                text: 'เข้าสู่ระบบสำเร็จ',
                            }).then(function() {
                                // Check if there's a redirect parameter in the URL
                                var urlParams = new URLSearchParams(window.location.search);
                                var redirectUrl = urlParams.get('redirect');

                                if (redirectUrl) {
                                    // If redirect parameter exists, use it
                                    window.location.href = decodeURIComponent(redirectUrl);
                                } else {
                                    // If no redirect parameter, use the default
                                    window.location.href = "index.php?page=manage-file";
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'ไม่สำเร็จ',
                                text: response.message || 'เข้าสู่ระบบไม่สำเร็จ โปรดตรวจสอบ Username และ Password',
                            });
                            // Re-enable the submit button on error
                            $submitButton.prop('disabled', false);
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'ข้อผิดพลาด',
                            text: 'เกิดข้อผิดพลาดในการเชื่อมต่อกับเซิร์ฟเวอร์',
                        });
                        // Re-enable the submit button on error
                        $submitButton.prop('disabled', false);
                    }
                });
            });
        });
    </script>
</body>

</html>