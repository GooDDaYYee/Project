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

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['name'] . ' ' . $_SESSION['lastname']; ?></span>
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

        <form action="export_pdf/pdf_mixed.php" method="post">
          <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
              <div class="row">
                <div class="col-lg">
                  <div class="p-5">
                    <div class="text-center">
                      <h1 class="h2 text-gray-900 mb-2">เอกสารใบเสนอราคา/ใบแจ้งหนี้/ใบเสร็จรับเงิน บริษัทmixed</h1>
                    </div>
                    <hr class="user">
                    <div class="form-group row">
                      <div class="col-sm-2 mb-3 mb-sm-0">
                        <input type="text" id="number" name="number" class="form-control form-control-user" placeholder="เลขที่" required="">
                      </div>
                      <div class="col-sm-2 mb-4 mb-sm-10">
                        <li class="form-control">
                          วันที่ &nbsp;<?php
                                        date_default_timezone_set('Asia/Bangkok');
                                        setlocale(LC_TIME, 'th_TH.UTF-8', 'th_TH');

                                        $thai_month = array(
                                          1 => "มกราคม",
                                          2 => "กุมภาพันธ์",
                                          3 => "มีนาคม",
                                          4 => "เมษายน",
                                          5 => "พฤษภาคม",
                                          6 => "มิถุนายน",
                                          7 => "กรกฎาคม",
                                          8 => "สิงหาคม",
                                          9 => "กันยายน",
                                          10 => "ตุลาคม",
                                          11 => "พฤศจิกายน",
                                          12 => "ธันวาคม"
                                        );
                                        $thai_month_num = (int)strftime("%m");
                                        $thai_date = strftime("%d $thai_month[$thai_month_num] %Y", strtotime("+543 years", strtotime(date('Y-m-d'))));
                                        echo $thai_date;
                                        ?>
                        </li>
                        <input type="hidden" name="thai_date" value="<?php echo $thai_date; ?>">
                      </div>
                      <button class="btn btn-warning bg-gradient-purple btn-user btn-block" type="submit">
                        <h5>ทำเอกสาร</h5>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </form>

      </div>