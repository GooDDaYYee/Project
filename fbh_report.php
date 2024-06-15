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

     <?php
      include("connect.php");

      try {
        $stmt = $con->prepare("SELECT bill_id FROM bill WHERE bill_company = 'FBH' ORDER BY bill_id DESC LIMIT 1");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
          $lastBillId = $result['bill_id'];
          preg_match('/(\d{4})\/(\d+)$/', $lastBillId, $matches);
          $lastYear = $matches[1];
          $lastNumber = intval($matches[2]);
        } else {
          $lastYear = date('Y') + 543;
          $lastNumber = 0;
        }

        $currentYear = date('Y') + 543;
        if ($currentYear != $lastYear) {
          $newNumber = 1;
        } else {
          $newNumber = $lastNumber + 1;
        }
        $newBillId = sprintf("PS%04d/%03d", $currentYear, $newNumber);
      } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
      }
      ?>

     <!-- Form HTML -->
     <form id="myForm" action="insert_bill.php" method="post">
       <div class="card o-hidden border-0 shadow-lg my-5">
         <div class="card-body p-0">
           <div class="row">
             <div class="col-lg">
               <div class="p-5">
                 <div class="text-center">
                   <h1 class="h4 text-gray-900 mb-2" style="font-size: 1.5rem;">เอกสารใบเสนอราคา/ใบแจ้งหนี้/ใบเสร็จรับเงิน บริษัท FBH</h1>
                 </div>
                 <hr class="user">
                 <div class="row mt-md-3">
                   <div class="col">
                     <h4>เลขที่</h4>
                     <input type="text" id="number" name="number" class="form-control form-control-user" value="<?php echo $newBillId; ?>" readonly>
                   </div>
                   <div class="col">
                     <h4>วันที่ออกบิล</h4>
                     <?php
                      date_default_timezone_set('Asia/Bangkok');
                      $thai_date = date('d/m/') . (date('Y') + 543);
                      $thaiDate = date("Y-m-d", strtotime("+543 year", strtotime(date("Y-m-d"))));
                      ?>
                     <input type="text" class="form-control" value="<?php echo $thai_date; ?>" readonly>
                     <input type="hidden" name="thai_date" value="<?php echo $thaiDate; ?>">
                     <input type="hidden" name="company" value="FBH">
                   </div>
                   <div class="col">
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
                     <h4>PR No</h4>
                     <input type="text" id="pr" name="pr" class="form-control form-control-user" placeholder="PR No (เฉพาะใบแจ้งหนี้/ใบเสร็จรับเงิน)">
                   </div>
                   <div class="col-md-3">
                     <h4>Work No</h4>
                     <input type="text" id="work_no" name="work_no" class="form-control form-control-user" placeholder="Work No (เฉพาะใบแจ้งหนี้/ใบเสร็จรับเงิน)">
                   </div>
                   <div class="col-md-3">
                     <h4>Project</h4>
                     <input type="text" id="project" name="project" class="form-control form-control-user" placeholder="Project (เฉพาะใบแจ้งหนี้/ใบเสร็จรับเงิน)">
                   </div>
                 </div>
                 <div class="row mt-md-3">
                   <div class="col-md-3">
                     <h4>จำนวนAU</h4>
                     <input type="number" id="numAU" name="numAU" class="form-control form-control-user" placeholder="จำนวนAU" required=" ">
                   </div>
                   <div class="col-md-2">
                     <h4>&nbsp;</h4>
                     <button type="button" id="addInputFrame" name="addInputFrame" class="btn btn-warning bg-gradient-purple btn-user btn-block">เพิ่ม AU</button>
                   </div>
                   <div class="col-md-2">
                     <h4>&nbsp;</h4>
                     <button type="button" id="removeInputFrame" name="removeInputFrame" class="btn btn-danger bg-gradient-red btn-user btn-block">ลบ AU</button>
                   </div>
                   <div class="col-md-2">
                     <h4>จำนวน AU ที่เพิ่ม</h4>
                     <input type="number" id="auCount" name="auCount" class="form-control form-control-user" value="0" readonly>
                   </div>
                 </div>
                 <div class="row-md-auto mt-md-3">
                   <button class='btn btn-warning bg-gradient-purple btn-user btn-block' type='submit' id="submitButton">
                     <h5>เพิ่มข้อมูล</h5>
                   </button>
                 </div>
               </div>
               <?php
                $strsql = "SELECT * FROM au_all WHERE au_company = 'FBH'";
                try {
                  $stmt = $con->prepare($strsql);
                  $stmt->execute();
                  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                } catch (PDOException $e) {
                  echo "Error: " . $e->getMessage();
                }
                ?>
               <script>
                 document.getElementById("addInputFrame").addEventListener("click", function() {
                   var numAU = parseInt(document.getElementById("numAU").value);
                   if (numAU > 0) {
                     var inputFields = document.querySelector(".row-md-auto");
                     var documentButton = document.querySelector(".row-md-auto button");
                     var auCounter = document.getElementById("auCount");

                     for (var i = 0; i < numAU; i++) {
                       var existingInputFrames = document.querySelectorAll(".inputFrame").length;
                       var newIndex = existingInputFrames + 1;

                       var newInputFrame = document.createElement("div");
                       newInputFrame.classList.add("inputFrame");
                       newInputFrame.innerHTML = `
                        <div class="row mt-md-3" style="margin-bottom: 1rem;">
                          <div class="col-md-3">
                            <h4>AU ลำดับที่ ${newIndex}</h4>
                            <input list="dataList" id="inputField_${newIndex}" name="inputField[]" class="form-control" required="">
                            <datalist id="dataList">
                              <?php foreach ($result as $row) { ?>
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
                       auCounter.value = parseInt(auCounter.value) + 1;

                       document.getElementById(`inputField_${newIndex}`).addEventListener('input', function(event) {
                         var selectedOption = event.target.value;
                         var dataList = document.getElementById('dataList');
                         var options = dataList.getElementsByTagName('option');
                         for (var j = 0; j < options.length; j++) {
                           if (options[j].value === selectedOption) {
                             var auId = options[j].value;
                             var index = parseInt(event.target.id.split('_')[1]);
                             fetchDetails(auId, index);
                             break;
                           }
                         }
                       });
                     }
                   }
                 });

                 document.getElementById("removeInputFrame").addEventListener("click", function() {
                   var inputFrames = document.querySelectorAll(".inputFrame");
                   if (inputFrames.length > 0) {
                     var lastInputFrame = inputFrames[inputFrames.length - 1];
                     lastInputFrame.parentNode.removeChild(lastInputFrame);
                     var auCounter = document.getElementById("auCount");
                     auCounter.value = parseInt(auCounter.value) - 1;
                   }
                 });

                 function fetchDetails(auId, index) {
                   fetch('fetch_bill_details.php?au_id=' + auId)
                     .then(response => response.json())
                     .then(data => {
                       document.getElementById(`selectedData_${index}`).innerText = data.au_detail;
                       document.getElementById(`selectedDataDetail_${index}`).value = data.au_detail;
                       document.getElementById(`selectedDataType_${index}`).value = data.au_type;
                       document.getElementById(`selectedDataPrice_${index}`).value = data.au_price;
                       document.getElementById(`unit_${index}`).value = data.unit;
                     });
                 }

                 function checkDuplicates() {
                   var auIds = document.querySelectorAll('input[name="inputField[]"]');
                   var auIdValues = Array.from(auIds).map(input => input.value);
                   var duplicates = auIdValues.filter((item, index) => auIdValues.indexOf(item) !== index);
                   var duplicateIndices = [];

                   if (duplicates.length > 0) {
                     duplicates.forEach(duplicate => {
                       auIdValues.forEach((id, index) => {
                         if (id === duplicate) {
                           duplicateIndices.push(index + 1);
                         }
                       });
                     });
                     alert("มี AU ID ชื่อ " + duplicates.join(', ') + ' ซ้ำกันที่ลำดับ: ' + duplicateIndices.join(', ') + " กรุณาตรวจสอบและแก้ไข");
                     return true;
                   }
                   return false;
                 }

                 document.getElementById("myForm").addEventListener("submit", function(event) {
                   if (checkDuplicates()) {
                     event.preventDefault();
                   }
                 });
               </script>

             </div>
           </div>
         </div>
       </div>
     </form>
     <?php $con = null; ?>
   </div>
 </div>
 <!-- End of Main Content -->

 </div>
 <!-- End of Content Wrapper -->