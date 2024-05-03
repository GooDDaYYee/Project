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
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet" type="text/css"><link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

  <link href='https://fonts.googleapis.com/css?family=Mitr' rel='stylesheet'>

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Bootstrap CSS -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-mGkxnLkTdHU8zntjw9pCiNQRlPXEYGwk/TPpC9enTHZ9xE2eKGqBRGLjtvq5mcyVX" crossorigin="anonymous"></script>
  
  <style>
    .bg-gradient-purple {
    background-color: #8A2BE2;
    }
    body {
      font-family: 'Mitr';
      font-size: 22px;
    }
    table {
      text-align: center;
    }
  </style>

</head>

<body class="bg-gradient-purple">

  <div class="container">

  <!-- Outer Row -->
  <form class="form-signin" name="form_login" id="form_login" method="post" action="login_process.php">
      <div class="row justify-content-center">
          <div class="col-xl-10 col-lg-12 col-md-9">
              <div class="card o-hidden border-0 shadow-lg my-5">
                  <div class="card-body p-0">
                      <!-- Nested Row within Card Body -->
                      <div class="row">
                          <div class="col-lg">
                              <div class="p-5">
                                  <div class="text-center">
                                      <h1 class="h4 text-gray-900 mb-4">Welcome</h1>
                                  </div>
                                  <form class="user">
                                      <div class="form-group">
                                          <!-- เพิ่ม id เพื่อใช้ในการเรียกใช้งานใน JavaScript -->
                                          <input type="username" id="input_username" name="input_username"
                                              class="form-control form-control-user" placeholder="Username" required=""
                                              autofocus="" 
                                              <?php if(isset($_COOKIE['username'])) echo "value='".$_COOKIE['username']."'"; ?>
                                          >
                                      </div>
                                      <div class="form-group">
                                          <!-- เพิ่ม id เพื่อใช้ในการเรียกใช้งานใน JavaScript -->
                                          <input type="password" id="input_password" name="input_password"
                                              class="form-control form-control-user" placeholder="Password" required=""
                                              <?php if(isset($_COOKIE['password'])) echo "value='".$_COOKIE['password']."'"; ?>
                                          >
                                      </div>
                                      <div class="form-group">
                                          <div class="custom-control custom-checkbox small">
                                              <input type="checkbox" class="custom-control-input" id="customCheck" name="customCheck"
                                              <?php if(isset($_COOKIE['username'])) echo "checked"; ?>> <!-- เพิ่มโค้ดเพื่อให้ถูกติ้กถ้ามีการตรวจสอบ cookie ชื่อ username -->
                                              <label class="custom-control-label" for="customCheck">Remember</label>
                                          </div>
                                      </div>
                                      <button href="index.php?page=home" class="btn btn-warning bg-gradient-purple btn-user btn-block" type="submit">
                                          <h5>Sign in</h5>
                                      </button>
                                  </form>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </form>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <script>
    // ตรวจสอบว่ามีการเลือก checkbox Remember หรือไม่
    if(document.getElementById("customCheck").checked) {
        // เก็บค่า username และ password ใน localStorage
        localStorage.setItem("username", document.getElementById("input_username").value);
        localStorage.setItem("password", document.getElementById("input_password").value);
    }

    // เมื่อมีการส่งแบบฟอร์ม
    document.getElementById("form_login").addEventListener("submit", function() {
        // ตรวจสอบว่ามีการเลือก checkbox Remember หรือไม่
        if(document.getElementById("customCheck").checked) {
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