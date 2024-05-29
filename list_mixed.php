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

    <!-- Begin Page Content -->
    <div class="container-fluid">
      <!-- List table -->
      <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between align-items-center py-3">
          <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-ui-checks" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M7 2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-1z" />
            <path fill-rule="evenodd" d="M2 1a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2H2zm0 8a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2v-2a2 2 0 0 0-2-2H2zm.854-3.646l2-2a.5.5 0 1 0-.708-.708L2.5 4.293l-.646-.647a.5.5 0 1 0-.708.708l1 1a.5.5 0 0 0 .708 0zm0 8l2-2a.5.5 0 0 0-.708-.708L2.5 12.293l-.646-.647a.5.5 0 0 0-.708.708l1 1a.5.5 0 0 0 .708 0z" />
            <path d="M7 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-1z" />
            <path fill-rule="evenodd" d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 8a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z" />
          </svg>&nbsp;จัดการบิลบริษัท Mixed
          <button type="button" class="btn btn-warning bg-gradient-purple ml-auto" onclick="window.open('index.php?page=mixed_report', '_parent')">เพิ่มบิล</button>
        </div>

        <div class="card-body">
          <div class="card border h-100">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">เลขที่</th>
                  <th scope="col">วันที่ออกบิล</th>
                  <th scope="col">Site</th>
                  <th scope="col">Final BOQ 100%</th>
                  <th scope="col">VAT 7%</th>
                  <th scope="col">GRAND Total</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <?php
              include('connect.php');
              $strsql = "SELECT * FROM bill ORDER BY bill_id DESC";
              try {
                $stmt = $con->prepare($strsql);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if (count($result) > 0) {
                  foreach ($result as $rs) {
              ?>
                    <tbody>
                      <tr>
                        <th scope="row"><?php echo $rs['bill_id']; ?></th>
                        <td>
                          <?php
                          $timestamp = strtotime($rs['bill_date']);
                          $thai_month = array(
                            1 => "มกราคม", 2 => "กุมภาพันธ์", 3 => "มีนาคม",
                            4 => "เมษายน", 5 => "พฤษภาคม", 6 => "มิถุนายน",
                            7 => "กรกฎาคม", 8 => "สิงหาคม", 9 => "กันยายน",
                            10 => "ตุลาคม", 11 => "พฤศจิกายน", 12 => "ธันวาคม"
                          );
                          $thai_month_num = date('n', $timestamp);
                          echo date('d', $timestamp) . ' ' . $thai_month[$thai_month_num] . ' ' . date('Y', $timestamp);
                          ?>
                        </td>
                        <td><?php echo $rs['bill_site']; ?></td>
                        <td><?php echo number_format($rs['total_amount'], 2); ?></td>
                        <td><?php echo number_format($rs['vat'], 2); ?></td>
                        <td><?php echo number_format($rs['grand_total'], 2); ?></td>
                        <td>
                          <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-outline-success" onclick="openEditModal('<?php echo $rs['bill_id']; ?>')">แก้ไข</button>
                            <button type="button" class="btn btn-outline-warning" onclick="openDocumentModal('<?php echo $rs['bill_id']; ?>')">PDF</button>
                            <button type="button" class="btn btn-outline-danger" onclick="confirmDelete('<?php echo $rs['bill_id']; ?>')">ลบ</button>
                          </div>
                        </td>
                      </tr>
                    </tbody>
              <?php
                  }
                } else {
                  echo "<tr><td colspan='8'>ไม่พบข้อมูล</td></tr>";
                }
              } catch (PDOException $e) {
                echo "Error in SQL query: " . $e->getMessage();
              }
              ?>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal for Document Options -->
<div id="documentModal" class="modal">
  <span class="close">&times;</span>
  <div class="modal-content">
    <form id="documentForm" action="export_pdf/pdf_mixed.php" target="_blank" method="post">
      <h2>เลือกประเภทเอกสาร</h2>
      <input type="hidden" id="billId" name="billId" value="<?php echo $rs['bill_id']; ?>">
      <div class="form-group">
        <label for="documentType">ประเภทเอกสาร:</label>
        <select id="documentType" name="documentType" class="form-control">
          <option value="quotation">ใบเสนอราคา</option>
          <option value="invoice">ใบแจ้งหนี้</option>
          <option value="receipt">ใบเสร็จรับเงิน</option>
        </select>
      </div>
      <button type="submit" class="btn btn-warning bg-gradient-purple ml-auto">สร้างเอกสาร</button>
    </form>
  </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="modal">
  <span class="close">&times;</span>
  <form id="myForm" action="insert_mixed.php" method="POST">
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
                  <input type="text" id="bill_Id" name="bill_Id" class="form-control form-control-user" value="<?php echo $rs['bill_id']; ?>" readonly>
                </div>
                <div class="col">
                  <h4>วันที่ออกบิล</h4>
                  <input type="date" class="form-control" id="thai_date" value="<?php echo $rs['bill_date']; ?>">
                  <input type="hidden" name="thai_date" id="hidden_thai_date">
                </div>
                <div class="col">
                  <h4>วันที่ส่งสินค้า</h4>
                  <input type="date" id="thai_date_product" name="thai_date_product" class="form-control" value="<?php echo $rs['bill_date_product']; ?>">
                </div>
              </div>
              <div class=" row mt-md-3">
                <div class="col-md-6">
                  <h4>เงื่อนไขการชำระเงิน</h4>
                  <input type="text" id="payment" name="payment" class="form-control form-control-user" value="<?php echo $rs['bill_payment']; ?>">
                </div>
                <div class="col-md-3">
                  <h4>วันครบกำหนด</h4>
                  <input type="date" id="thai_due_date" name="thai_due_date" class="form-control" value="<?php echo $rs['bill_due_date']; ?>">
                </div>
                <div class="col-md-3">
                  <h4>เลขที่ใบแจ้งหนี้/อ้างถึง</h4>
                  <input type="text" id="refer" name="refer" class="form-control form-control-user">
                </div>
              </div>
              <div class="row mt-md-3">
                <div class="col-md-3">
                  <h4>Site</h4>
                  <input type="text" id="Site" name="Site" class="form-control form-control-user">
                </div>
                <div class="col-md-3">
                  <h4>PR No</h4>
                  <input type="text" id="pr" name="pr" class="form-control form-control-user">
                </div>
                <div class="col-md-3">
                  <h4>Work No</h4>
                  <input type="text" id="work_no" name="work_no" class="form-control form-control-user">
                </div>
                <div class="col-md-3">
                  <h4>Project</h4>
                  <input type="text" id="project" name="project" class="form-control form-control-user">
                </div>
              </div>
              <div class="row mt-md-3">
                <div class="col-md-3">
                  <h4>จำนวนAU</h4>
                  <input type="number" id="numAU" name="numAU" class="form-control form-control-user" required="">
                </div>
                <div class="col-md-2">
                  <h4>&nbsp;</h4>
                  <button type="button" id="addInputFrame" name="addInputFrame" class="btn btn-warning bg-gradient-purple btn-user btn-block">เพิ่ม AU</button>
                </div>
                <div class="col-md-2">
                  <h4>จำนวน AU ที่เพิ่ม</h4>
                  <input type="number" id="auCount" name="auCount" class="form-control form-control-user" value="0" readonly>
                </div>
              </div>
              <div class="row-md-auto mt-md-3">
                <button class='btn btn-warning bg-gradient-purple btn-user btn-block' type='submit' id="submitButton">
                  <h5>แก้ไขบิล</h5>
                </button>
              </div>
            </div>
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

              function fetchDetails(auId, index) {
                fetch('fetch_details_mixed.php?au_id=' + auId)
                  .then(response => response.json())
                  .then(data => {
                    document.getElementById(`selectedData_${index}`).innerText = data.au_detail;
                    document.getElementById(`selectedDataDetail_${index}`).value = data.au_detail;
                    document.getElementById(`selectedDataType_${index}`).value = data.au_type;
                    document.getElementById(`selectedDataPrice_${index}`).value = data.au_price;
                    document.getElementById(`unit_${index}`).value = data.unit;
                  });
              }

              document.getElementById("submitButton").addEventListener("click", function() {
                var auCount = parseInt(document.getElementById("auCount").value);
                if (auCount > 0) {
                  document.getElementById("myForm").submit();
                } else {
                  alert("เพิ่ม AU Count");
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

<script>
  function confirmDelete(billId) {
    if (confirm("คุณแน่ใจหรือไม่ที่ต้องการลบข้อมูลบิล " + billId + " นี้?")) {
      window.location.href = 'delete_bill.php?bill_id=' + billId;
    }
  }

  var documentModal = document.getElementById("documentModal");
  var editModal = document.getElementById("editModal");
  var spanDocument = documentModal.getElementsByClassName("close")[0];
  var spanEdit = editModal.getElementsByClassName("close")[0];

  function openDocumentModal(billId) {
    document.getElementById("billId").value = billId;
    documentModal.style.display = "block";
  }

  spanDocument.onclick = function() {
    documentModal.style.display = "none";
  }

  spanEdit.onclick = function() {
    editModal.style.display = "none";
  }

  window.onclick = function(event) {
    if (event.target == documentModal) {
      documentModal.style.display = "none";
    } else if (event.target == editModal) {
      editModal.style.display = "none";
    }
  }

  function openEditModal(bill_Id) {
    document.getElementById("bill_Id").value = bill_Id;
    editModal.style.display = "block";
  }

  function submitDocumentForm() {
    var form = document.getElementById('documentForm');
    form.submit();
  }
</script>