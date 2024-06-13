<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

  <!-- Main Content -->
  <div id="content">

    <!-- Topbar -->
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

      <!-- Sidebar Toggle (Topbar) -->
      <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
      </button>

      <!-- Topbar Search -->
      <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <div class="input-group">
          <input type="text" class="form-control bg-light border-0 small" placeholder="ค้นหา" aria-label="Search" aria-describedby="basic-addon2">
          <div class="input-group-append">
            <button class="btn btn-warning bg-gradient-purple" type="button">
              <i class="fas fa-search fa-sm"></i>
            </button>
          </div>
        </div>
      </form>

      <!-- Topbar Navbar -->
      <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
          <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-search fa-fw"></i>
          </a>
        </li>
        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small "><?php echo $_SESSION['name'] . ' ' . $_SESSION['lastname']; ?></span>
            <img class="img-profile rounded-circle" src="img/picture.png">
          </a>
          <!-- Dropdown - User Information -->
          <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
              <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
              Logout
            </a>
          </div>
        </li>
      </ul>
    </nav>
    <!-- End of Topbar -->
    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- List table -->
      <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between align-items-center py-3">
          <i class="fa fa-list-ul" aria-hidden="true"></i>&nbsp;จัดการผู้ใช้
          <button type="button" class="btn btn-warning bg-gradient-purple ml-auto" onclick="window.open('index.php?page=register', '_parent')">เพิ่มผู้ใช้</button>
        </div>

        <div class="card-body">
          <div class="card border h-100">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">ลำดับ</th>
                  <th scope="col">ชื่อผู้ใช้</th>
                  <th scope="col">ชื่อ</th>
                  <th scope="col">นามสกุล</th>
                  <th scope="col">ประเภทผู้ใช้</th>
                  <th scope="col">สถานะ</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <?php
              include('connect.php');
              $strsql = "SELECT * FROM users ORDER BY user_id ASC"; //คำสั่งให้เลือกข้อมูลจาก TABLE ชื่อ user เรียงลำดับจากมากไปน้อย

              try {
                $stmt = $con->prepare($strsql);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $rowcount = count($result);

                if ($rowcount > 0) {
                  $i = 1;
                  foreach ($result as $rs) { //สร้างตัวแปร $rs มารับค่าจากการ fetch array
              ?>
                    <tbody>
                      <tr>
                        <th scope="row"><?php echo $i; ?></th>
                        <td><?php echo $rs['username']; ?></td>
                        <td><?php echo $rs['name']; ?></td>
                        <td><?php echo $rs['lastname']; ?></td>
                        <td><?php
                            if ($rs['lv'] == 0) {
                              echo "แอดมิน";
                            } elseif ($rs['lv'] == 1) {
                              echo "ผู้ใช้";
                            }
                            ?></td>
                        <td><?php
                            if ($rs['status'] == 0) {
                              echo "แบน";
                            } elseif ($rs['status'] == 1) {
                              echo "ปกติ";
                            }
                            ?></td>
                        <td>
                          <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-outline-success">แก้ไข</button>
                            <button type="button" class="btn btn-outline-danger" onclick="confirmDelete('<?php echo $rs['username']; ?>')">ลบ</button>
                          </div>
                        </td>
                      </tr>
                    </tbody>
              <?php
                    $i++;
                  }
                } else {
                  echo "<tr><td colspan='8'>ไม่พบข้อมูล</td></tr>";
                }
              } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
              }

              // ปิดการเชื่อมต่อฐานข้อมูล
              $con = null;
              ?>
            </table>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
<!-- End of Main Content -->
</div>
<!-- End of Content Wrapper -->
<script>
  function confirmDelete(username) {
    if (confirm("คุณแน่ใจหรือไม่ที่ต้องการลบข้อมูลชื่อผู้ใช้ " + username + " นี้?")) {
      window.location.href = 'delete_users.php?username=' + username;
    }
  }
</script>