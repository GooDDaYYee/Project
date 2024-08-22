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
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link href="css/styles.css" rel="stylesheet">
</head>

<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-purple sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php?page=<?= base64_encode('home') ?>">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="warning">P</i>
        </div>
        <div class="sidebar-brand-text mx-1">snktelecom<sup class="warning">CP</sup></div>
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
            <a class="collapse-item " href="index.php?page=<?= base64_encode('home') ?>">&nbsp; แชร์ไฟล์</a>
            <?php
            if ($_SESSION["lv"] == 0 || $_SESSION["lv"] == 1 || $_SESSION["lv"] == 2) {
            ?>
              <a class="collapse-item " href="index.php?page=<?= base64_encode('files/files') ?>">&nbsp; จัดการไฟล์</a>
            <?php
            }
            ?>
          </div>
          <?php
          if ($_SESSION["lv"] == 0 || $_SESSION["lv"] == 1 || $_SESSION["lv"] == 2) {
          ?>
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header"><i class="fa-solid fa-file"></i> เอกสารบิล</h6>
              <a class="collapse-item " href="index.php?page=<?= base64_encode('bill/list_mixed') ?>">&nbsp; บริษัท Mixed</a>
              <a class="collapse-item " href="index.php?page=<?= base64_encode('bill/list_fbh') ?>">&nbsp; บริษัท FBH</a>
            </div>
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header"><i class="fa-solid fa-layer-group"></i> สต๊อก</h6>
              <a class="collapse-item " href="index.php?page=<?= base64_encode('stock/list_stock_cable') ?>">&nbsp; จัดการ Cable</a>
              <a class="collapse-item " href="index.php?page=<?= base64_encode('stock/list_stock_drum') ?>">&nbsp; จัดการ Drum</a>
            </div>
          <?php
          }
          ?>
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header"><i class="fa-solid fa-layer-group"></i> รายงาน</h6>
            <a class="collapse-item " href="index.php?page=<?= base64_encode('report_work/list_report') ?>">&nbsp; รายการปฏิบัติงาน</a>
            <a class="collapse-item " href="index.php?page=<?= base64_encode('report_work/report_work') ?>">&nbsp; รายงานปฏิบัติงาน</a>
          </div>
          <?php
          if ($_SESSION["lv"] == 0 || $_SESSION["lv"] == 1) {
          ?>
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header"><i class="fa-solid fa-user"></i> พนักงาน</h6>
              <a class="collapse-item " href="index.php?page=<?= base64_encode('employee/list_employee') ?>">&nbsp; จัดการข้อมูลพนักงาน</a>
              <a class="collapse-item " href="index.php?page=<?= base64_encode('employee/list_employee_salary') ?>">&nbsp; จัดการเงินเดือน</a>
            </div>
          <?php
          }
          if ($_SESSION["lv"] == 0) {
          ?>
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header"><i class="fa-solid fa-users"></i> ผู้ใช้</h6>
              <a class="collapse-item " href="index.php?page=<?= base64_encode('users/list_user') ?>">&nbsp; จัดการผู้ใช้</a>
              <a class="collapse-item " href="index.php?page=<?= base64_encode('log/log') ?>">&nbsp; Log</a>
            </div>
          <?php
          }
          ?>
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