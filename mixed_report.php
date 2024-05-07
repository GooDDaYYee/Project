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
                         <input type="hidden" name="inputField" value="&nbsp;">
                         <input type="hidden" name="selectedDataDetail" value="&nbsp;">
                         <input type="hidden" name="selectedDataType" value="&nbsp;">
                         <input type="hidden" name="selectedDataPrice" value="&nbsp;">
                         <input type="hidden" name="unit" value="&nbsp;">
                       </div>
                       <div class="col">
                         <?php
                          // รับวันที่ปัจจุบันเป็นรูปแบบปีไทย
                          function getThaiDate()
                          {
                            // ดึงวันที่ปัจจุบัน
                            $currentDate = date("Y-m-d");
                            // แปลงวันที่ปัจจุบันเป็นรูปแบบปีไทย
                            $thaiDate = date("Y-m-d", strtotime("+543 year", strtotime($currentDate)));
                            return $thaiDate;
                          }

                          // แสดงวันที่ปีไทย
                          $thaiDate = getThaiDate();
                          ?>
                         <h4>วันที่ส่งสินค้า</h4>
                         <input type="date" id="thai_date_product" name="thai_date_product" class="form-control" value="<?php echo $thaiDate; ?>">
                       </div>
                     </div>
                     <div class=" row mt-md-3">
                       <div class="col-md-6">
                         <h4>เงื่อนไขการชำระเงิน</h4>
                         <input type="text" id="payment" name="payment" class="form-control form-control-user" value="N/A">
                       </div>
                       <div class="col-md-3">
                         <h4>วันครบกำหนด</h4>
                         <input type="date" id="thai_due_date" name="thai_due_date" class="form-control" value="<?php echo $thaiDate; ?>">
                       </div>
                       <div class="col-md-3">
                         <h4>เลขที่ใบแจ้งหนี้/อ้างถึง</h4>
                         <input type="text" id="refer" name="refer" class="form-control form-control-user" value="-">
                       </div>
                     </div>
                     <div class="row mt-md-3">
                       <div class="col-md-3">
                         <h4>Site</h4>
                         <input type="text" id="Site" name="Site" class="form-control form-control-user" placeholder="Site">
                       </div>
                       <div class="col-md-3">
                         <h4>จำนวนAU</h4>
                         <input type="number" id="numAU" name="numAU" class="form-control form-control-user" placeholder="จำนวนAU" required="">
                       </div>

                       <div class="col-md-2">
                         <h4>&nbsp;</h4>
                         <button type="button" id="addInputFrame" name="addInputFrame" class="btn btn-warning bg-gradient-purple btn-user btn-block">เพิ่ม AU</button>
                       </div>
                     </div>

                     <?php
                      include('connect.php');
                      $strsql = "SELECT * FROM au_all"; //คำสั่งให้เลือกข้อมูลจาก TABLE ชื่อ au_detail
                      $result = mysqli_query($con, $strsql);
                      $rowcount = mysqli_num_rows($result);
                      ?>
                     <script>
                       // เพิ่มกรอบกรอกข้อมูลเมื่อกดปุ่ม
                       document.getElementById("addInputFrame").addEventListener("click", function() {
                         var numAU = parseInt(document.getElementById("numAU").value);

                         if (numAU > 0) {
                           var inputFields = document.querySelector(".row-md-auto");
                           var documentButton = document.querySelector(".row-md-auto button");

                           for (var i = 0; i < numAU; i++) {
                             var existingInputFrames = document.querySelectorAll(".inputFrame").length;
                             var newIndex = existingInputFrames + i;

                             var newInputFrame = document.createElement("div");
                             newInputFrame.classList.add("inputFrame");
                             newInputFrame.innerHTML = `
                              <div class="row mt-md-3" style="margin-bottom: 1rem;">
                                <div class="col-md-3">
                                  <h4>AU ลำดับที่ ${existingInputFrames+1}</h4>
                                  <input list="dataList" id="inputField_${newIndex}" name="inputField[]" class="form-control" required="">
                                  <datalist id="dataList">
                                    <?php mysqli_data_seek($result, 0); ?>
                                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                      <option value="<?php echo $row['au_id']; ?>"><?php echo $row['au_id']; ?></option>
                                    <?php } ?>
                                  </datalist>
                                </div>
                                <div class="col-md-3">
                                  <h4>รายละเอียด AU</h4>
                                  <p id="selectedData_${newIndex}"></p>
                                </div>
                                <input type="hidden" id="selectedDataDetail_${newIndex}" name="selectedDataDetail[]">
                                <input type="hidden" id="selectedDataType_${newIndex}" name="selectedDataType[]">
                                <input type="hidden" id="selectedDataPrice_${newIndex}" name="selectedDataPrice[]">
                                <div class="col-md-3">
                                  <h4>จำนวน</h4>
                                  <input type="number" id="unit_${newIndex}" name="unit[]" class="form-control form-control-user" required="">
                                </div>
                              </div>
                            `;
                             inputFields.insertBefore(newInputFrame, documentButton);

                             // เพิ่ม Event Listener สำหรับฟิลด์ input ของ AU ลำดับที่ i
                             document.getElementById(`inputField_${newIndex}`).addEventListener('input', function(event) {
                               var selectedOption = event.target.value;
                               var dataList = document.getElementById('dataList');
                               var options = dataList.getElementsByTagName('option');
                               for (var j = 0; j < options.length; j++) {
                                 if (options[j].value === selectedOption) {
                                   var auId = options[j].value;
                                   var index = parseInt(event.target.id.split('_')[1]); // ดึงหมายเลขลำดับ AU ออกจาก ID
                                   fetchDetails(auId, index); // เรียกใช้ฟังก์ชัน fetchDetails พร้อมส่งค่า index เป็นอาร์กิวเมนต์
                                   break;
                                 }
                               }
                             });
                           }
                         }
                       });

                       function fetchDetails(auId, index) {
                         fetch('fetch_details.php?au_id=' + auId)
                           .then(response => response.json()) // รับข้อมูลเป็น JSON
                           .then(data => {
                             document.getElementById(`selectedData_${index}`).innerText = data.au_detail;
                             document.getElementById(`selectedDataDetail_${index}`).value = data.au_detail;
                             document.getElementById(`selectedDataType_${index}`).value = data.au_type; // เข้าถึงข้อมูล au_type
                             document.getElementById(`selectedDataPrice_${index}`).value = data.au_price; // เข้าถึงข้อมูล au_price
                             document.getElementById(`unit_${index}`).value = data.unit;
                           });
                       }
                     </script>
                     <div class="row-md-auto mt-md-3">
                       <button class='btn btn-warning bg-gradient-purple btn-user btn-block' type='submit'>
                         <h5>ทำเอกสาร</h5>
                       </button>
                     </div>
                   </div>
                 </div>
               </div>
             </div>
           </div>
         </form>
         <?php
          mysqli_close($con);
          ?>
       </div>