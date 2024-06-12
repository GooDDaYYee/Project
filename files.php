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
        <div class="card-header py-3">
          <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-ui-checks" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M7 2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-1z" />
            <path fill-rule="evenodd" d="M2 1a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2H2zm0 8a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2v-2a2 2 0 0 0-2-2H2zm.854-3.646l2-2a.5.5 0 1 0-.708-.708L2.5 4.293l-.646-.647a.5.5 0 1 0-.708.708l1 1a.5.5 0 0 0 .708 0zm0 8l2-2a.5.5 0 0 0-.708-.708L2.5 12.293l-.646-.647a.5.5 0 0 0-.708.708l1 1a.5.5 0 0 0 .708 0z" />
            <path d="M7 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-1z" />
            <path fill-rule="evenodd" d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 8a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z" />
          </svg>&nbsp;จัดการไฟล์
        </div>

        <div class="card-body">
          <div class="card border h-100">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">ลำดับ</th>
                  <th scope="col">ชื่อ</th>
                  <th scope="col">ประเภท</th>
                  <th scope="col">ชนิดอุปกรณ์</th>
                  <th scope="col">จำนวน</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <?php
              include('connect.php');
              $strsql = "SELECT * FROM detail ORDER BY Id DESC"; //คำสั่งให้เลือกข้อมูลจาก TABLE ชื่อ user เรียงลำดับจากมากไปน้อย

              try {
                $stmt = $con->prepare($strsql);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $rowcount = count($result);

                if ($rowcount > 0) {
                  foreach ($result as $rs) { //สร้างตัวแปร $rs มารับค่าจากการ fetch array
              ?>
                    <tbody>
                      <tr>
                        <th scope="row"><?php echo $rs['Id']; ?></th>
                        <td><?php echo $rs['machine']; ?></td>
                        <td><?php echo $rs['category']; ?></td>
                        <td><?php echo $rs['type']; ?></td>
                        <td><?php echo $rs['create_date']; ?></td>
                        <td><?php echo $rs['']; ?></td>
                        <td>
                          <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-outline-success">แก้ไข</button>
                            <button type="button" class="btn btn-outline-warning">รายละเอียด</button>
                            <button type="button" class="btn btn-outline-danger">ลบ</button>
                          </div>
                        </td>
                      </tr>
                    </tbody>
              <?php
                  }
                } else {
                  echo "<tr><td colspan='6'>ไม่พบข้อมูล</td></tr>";
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