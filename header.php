<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>PSNK TELECOM</title>

  <!-- Custom fonts for this template-->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Mitr' rel='stylesheet'>
  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <!-- Bootstrap CSS -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-mGkxnLkTdHU8zntjw9pCiNQRlPXEYGwk/TPpC9enTHZ9xE2eKGqBRGLjtvq5mcyVX" crossorigin="anonymous"></script>

  <style>
    .btn-warning {
      border: 1px solid #8A2BE2;
    }

    .bg-gradient-purple {
      background-color: #8A2BE2;
    }

    .bg-gradient-purple2 {
      background-color: #8A2BE2;
      padding: 10px;
      border: 1px solid #8A2BE2;
      border-radius: 10px;
    }

    body {
      font-family: 'Mitr';
      font-size: 16px;
      background-color: #8A2BE2;
    }

    table {
      text-align: center;
    }

    .warning {
      color: #ffc404;
    }

    .modal {
      display: none;
      position: fixed;
      padding-top: 60px;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgb(0, 0, 0);
      background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
      background-color: #fefefe;
      margin: 5% auto;
      padding: 20px;
      border: 1px solid #888;
      width: 80%;
    }

    .close {
      color: #aaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
    }

    .close:hover,
    .close:focus {
      color: black;
      text-decoration: none;
      cursor: pointer;
    }
  </style>
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-purple sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php?page=home">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="warning">P</i>
        </div>
        <div class="sidebar-brand-text mx-3">psnktelecom<sup class="warning">CP</sup></div>
      </a>
      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-align-justify"></i>
          <span>Menu</span>
        </a>
        <div id="collapseTwo" class="collapse show bg-gradient-purple2" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header collapseTwo"><i class="fa-solid fa-file-zipper"></i> ไฟล์</h6>
            <a class="collapse-item " href="index.php?page=home">&nbsp; จัดการไฟล์</a>
          </div>
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header"><i class="fa-solid fa-file"></i> ออกเอกสาร</h6>
            <a class="collapse-item " href="index.php?page=list_mixed">&nbsp; บริษัท Mixed</a>
            <a class="collapse-item " href="index.php?page=list_mixed">&nbsp; บริษัท FBH</a>
          </div>
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header"><i class="fa-solid fa-layer-group"></i> สต๊อก</h6>
            <a class="collapse-item " href="index.php?page=home">&nbsp; จัดการสต๊อก</a>
          </div>
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header"><i class="fa-solid fa-layer-group"></i> รายงาน</h6>
            <a class="collapse-item " href="index.php?page=home">&nbsp; รายงานปฏิบัติงาน</a>
          </div>
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header"><i class="fa-solid fa-user"></i> พนักงาน</h6>
            <a class="collapse-item " href="index.php?page=home">&nbsp; จัดการเงินเดือน</a>
          </div>
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header"><i class="fa-solid fa-users"></i> ผู้ใช้</h6>
            <a class="collapse-item " href="index.php?page=manage_user">&nbsp; จัดการผู้ใช้</a>
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->
</body>

</html>