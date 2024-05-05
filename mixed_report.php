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
                     <h1 class="h4 text-gray-900 mb-2" style="font-size: 1.5rem;">เอกสารใบเสนอราคา/ใบแจ้งหนี้/ใบเสร็จรับเงิน บริษัท Mixed</h1>
                   </div>
                   <hr class="user">
                   <div class="row mt-md-3">
                     <div class="col">
                       <h4>เลขที่</h4>
                       <input type="text" id="number" name="number" class="form-control form-control-user" placeholder="เลขที่" required="">
                     </div>
                     <div class="col">
                       <h4>วันที่</h4>
                       <li class="form-control">
                         <?php
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
                     <div class="col">
                       <h4>วันที่</h4>
                       <input type="date" id="thai_date_product" name="thai_date_product" class="form-control form-control-user">
                     </div>
                   </div>
                   <div class=" row mt-md-3">
                     <div class="col-md-6">
                       <h4>เงื่อนไขการชำระเงิน</h4>
                       <input type="text" id="payment" name="payment" class="form-control form-control-user" value="N/A">
                     </div>
                     <div class="col-md-3">
                       <h4>เงื่อนไขการชำระเงิน</h4>
                       <input type="date" id="thai_due_date" name="thai_due_date" class="form-control">
                     </div>
                     <div class="col-md-3">
                       <h4>เลขที่ใบแจ้งหนี้/อ้างถึง</h4>
                       <input type="text" id="refer" name="refer" class="form-control form-control-user" value="-">
                     </div>
                   </div>
                   <div class="row mt-md-3">
                     <div class="col-md-3">
                       <h4>Site</h4>
                       <input type="text" id="refer" name="refer" class="form-control form-control-user" placeholder="Site">
                     </div>
                     <div class="col-md-3">
                       <h4>จำนวนAU</h4>
                       <input type="number" id="numAU" name="numAU" class="form-control form-control-user" placeholder="จำนวนAU">
                     </div>

                     <div class="col-md-1">
                       <h4>&nbsp;</h4>
                       <button type="button" id="addInputFrame" name="addInputFrame" class="btn btn-warning bg-gradient-purple btn-user btn-block">เพิ่ม AU</button>
                     </div>
                   </div>
                   <?php
                    include('connect.php');
                    $strsql = "SELECT * FROM au_detail"; //คำสั่งให้เลือกข้อมูลจาก TABLE ชื่อ au_detail
                    $result = mysqli_query($con, $strsql);
                    $rowcount = mysqli_num_rows($result);
                    ?>

                   <script>
                     // เพิ่มกรอบกรอกข้อมูลเมื่อกดปุ่ม
                     document.getElementById("addInputFrame").addEventListener("click", function() {
                       var numAU = parseInt(document.getElementById("numAU").value);

                       if (numAU > 0) {
                         var inputFields = document.querySelector(".row-md-auto");
                         var existingInputFrames = document.querySelectorAll(".inputFrame").length;

                         for (var i = 0; i < numAU; i++) { // แก้ไขตรงนี้
                           var newInputFrame = document.createElement("div");
                           newInputFrame.classList.add("inputFrame");
                           newInputFrame.innerHTML = `
                              <div class="row mt-md-3" style="margin-bottom: 1rem;">
                                  <div class="col-md-3">
                                      <h4>AU ลำดับที่ ${existingInputFrames + i + 1}</h4> <!-- แก้ไขตรงนี้ -->
                                      <input class="form-control" list="browsers" name="browser" id="browser">
                                          <datalist id="browsers">
                                          <?php
                                          if ($rowcount > 0) {
                                            while ($rs = mysqli_fetch_array($result)) { //สร้างตัวแปร $rs มารับค่าจากการ fetch array
                                          ?>
                                              <option value="<?php echo $rs['au_id']; ?>">
                                              <?php
                                            }
                                          } else {
                                            echo  "<tr><td colspan='6'>ไม่พบข้อมูล</td></tr>";
                                          }
                                              ?>
                                          </datalist>
                                  </div>
                                  <div class="col-md-3">
                                  <h4>รายละเอียดAU</h4>
                                  <div class="form-control form-control-user">
                                      <?php
                                      if ($rowcount > 0) {
                                        mysqli_data_seek($result, 0); // นำเคอเซอร์ข้อมูลกลับไปที่แถวแรก
                                        $rs = mysqli_fetch_array($result);
                                        echo $rs['au_detail']; // แสดงค่าของ au_id
                                      } else {
                                        echo  "ไม่พบข้อมูล";
                                      }
                                      ?>
                                  </div>
                              </div>
                                  <div class="col-md-3">
                                      <h4>จำนวน</h4>
                                      <input type="number" id="unit" name="unit[]" class="form-control form-control-user">
                                  </div>
                              </div>

                          `;
                           inputFields.insertBefore(newInputFrame, inputFields.firstChild);
                         }
                       }
                     });
                   </script>
                   <div class="row-md-auto mt-md-3">
                     <button class="btn btn-warning bg-gradient-purple btn-user btn-block" type="submit">
                       <h5>ทำเอกสาร</h5>
                     </button>
                   </div>
                 </div>
               </div>
             </div>
           </div>
         </div>
       </form>
     </div>
     <?php
      mysqli_close($con);
      ?>