    <!-- Begin Page Content -->
    <div class="container-fluid">
      <!-- List table -->
      <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between align-items-center py-3">
          <i class="fa fa-list-ul" aria-hidden="true"></i>&nbsp;จัดการบิลบริษัท Mixed
          <!-- Topbar Search -->
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control" id="search" aria-label="Small" aria-describedby="inputGroup-sizing-sm" placeholder="ค้นหาข้อมูล">
            </div>
          </form>
          <button type="button" class="btn btn-warning bg-gradient-purple ml-auto" onclick="window.open('index.php?page=bill/mixed_report', '_parent')">เพิ่มบิล</button>
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
                  <th scope="col"> </th>
                </tr>
              </thead>
              <tbody>
                <?php
                include('connect.php');
                $strsql = "SELECT * FROM bill WHERE bill_company = 'Mixed' ORDER BY bill_id DESC";
                try {
                  $stmt = $con->prepare($strsql);
                  $stmt->execute();
                  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                  if (count($result) > 0) {
                    foreach ($result as $rs) {
                ?>
                      <tr>
                        <th scope="row"><i class="to_file"><?php echo $rs['bill_id']; ?></i></th>
                        <td><i class="to_file">
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
                            ?></i>
                        </td>
                        <td><i class="to_file"><?php echo $rs['bill_site']; ?></i></td>
                        <td><i class="to_file"><?php echo number_format($rs['total_amount'], 2); ?></td>
                        <td><i class="to_file"><?php echo number_format($rs['vat'], 2); ?></i></td>
                        <td><i class="to_file"><?php echo number_format($rs['grand_total'], 2); ?></i></td>
                        <td>
                          <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-outline-success" onclick="openEditModal('<?php echo $rs['bill_id']; ?>')">แก้ไข</button>
                            <button type="button" class="btn btn-outline-warning" onclick="openDocumentModal('<?php echo $rs['bill_id']; ?>')">PDF</button>
                            <button type="button" class="btn btn-outline-danger" onclick="confirmDelete('<?php echo $rs['bill_id']; ?>')">ลบ</button>
                          </div>
                        </td>
                      </tr>
                <?php
                    }
                  } else {
                    echo "<tr><td colspan='7'>ไม่พบข้อมูล</td></tr>";
                  }
                } catch (PDOException $e) {
                  echo "Error in SQL query: " . $e->getMessage();
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal for Document Options -->
    <div id="documentModal" class="modal">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="editModalLabel">ออกเอกสารเป็น PDF</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="documentForm" action="export_pdf/bill_pdf.php" target="_blank" method="post">
            <input type="hidden" id="billId" name="billId" value="">
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
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="modal">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">แก้ไขบิล</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="editForm" action="bill/update_bill.php" method="POST">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h5 text-gray-900 mb-2" style="font-size: 1.5rem;">แก้ไข เอกสารใบเสนอราคา/ใบแจ้งหนี้/ใบเสร็จรับเงิน บริษัท Mixed</h1>
              </div>
              <hr class="user">
              <div class="row mt-md-3">
                <div class="col">
                  <h5>เลขที่</h5>
                  <input type="text" id="bill_Id" name="bill_Id" class="form-control form-control-user" value="" readonly>
                </div>
                <div class="col">
                  <h5>วันที่ออกบิล</h5>
                  <input type="date" class="form-control" id="thai_date" name="thai_date" value="">
                </div>
                <div class="col">
                  <h5>วันที่ส่งสินค้า</h5>
                  <input type="date" id="thai_date_product" name="thai_date_product" class="form-control" value="">
                </div>
              </div>
              <div class="row mt-md-3">
                <div class="col-md-5">
                  <h5>เงื่อนไขการชำระเงิน</h5>
                  <input type="text" id="payment" name="payment" class="form-control form-control-user" value="">
                </div>
                <div class="col-md-3">
                  <h5>วันครบกำหนด</h5>
                  <input type="date" id="thai_due_date" name="thai_due_date" class="form-control" value="">
                </div>
                <div class="col-md-4">
                  <h5>เลขที่ใบแจ้งหนี้/อ้างถึง</h5>
                  <input type="text" id="refer" name="refer" class="form-control form-control-user" value="">
                </div>
              </div>
              <div class="row mt-md-3">
                <div class="col-md-3">
                  <h5>Site</h5>
                  <input type="text" id="Site" name="Site" class="form-control form-control-user" value="">
                </div>
                <div class="col-md-3">
                  <h5>PR No</h5>
                  <input type="text" id="pr" name="pr" class="form-control form-control-user" placeholder="เฉพาะใบแจ้งหนี้/ใบเสร็จรับเงิน" value="">
                </div>
                <div class="col-md-3">
                  <h5>Work No</h5>
                  <input type="text" id="work_no" name="work_no" class="form-control form-control-user" placeholder="เฉพาะใบแจ้งหนี้/ใบเสร็จรับเงิน" value="">
                </div>
                <div class="col-md-3">
                  <h5>Project</h5>
                  <input type="text" id="project" name="project" class="form-control form-control-user" placeholder="เฉพาะใบแจ้งหนี้/ใบเสร็จรับเงิน" value="">
                </div>
              </div>
              <div class="row mt-md-3">
                <div class="col-md-3">
                  <h5>จำนวนAU</h5>
                  <input type="number" id="numAU" name="numAU" class="form-control form-control-user" placeholder="จำนวนAU" value="0" required>
                </div>
                <div class="col-md-2">
                  <h5>&nbsp;</h5>
                  <button type="button" id="addInputFrame" name="addInputFrame" class="btn btn-success btn-user btn-block">เพิ่ม AU</button>
                </div>
                <div class="col-md-2">
                  <h5>&nbsp;</h5>
                  <button type="button" id="removeInputFrame" name="removeInputFrame" class="btn btn-danger btn-user btn-block">ลบ AU</button>
                </div>
                <div class="col-md-3">
                  <h5>จำนวน AU ที่เพิ่ม</h5>
                  <input type="number" id="auCount" name="auCount" class="form-control form-control-user" value="0" readonly>
                  <input type="hidden" name="company" value="Mixed">
                </div>
              </div>
              <div class="row-md-auto mt-md-3">
                <button class='btn btn-warning bg-gradient-purple btn-user btn-block' type='submit' id="submitButton">
                  <h5>เพิ่มข้อมูล</h5>
                </button>
              </div>
            </div>
            <?php
            $strsql = "SELECT * FROM au_all WHERE au_company = 'Mixed'";
            try {
              $stmt = $con->prepare($strsql);
              $stmt->execute();
              $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
              echo "Error: " . $e->getMessage();
            }
            ?>
            <script>
              function addAUFields(numAU) {
                const inputFields = document.querySelector(".row-md-auto");
                const documentButton = document.querySelector(".row-md-auto button");
                const auCounter = document.getElementById("auCount");

                for (let i = 0; i < numAU; i++) {
                  const existingInputFrames = document.querySelectorAll(".inputFrame").length;
                  const newIndex = existingInputFrames + 1;

                  const newInputFrame = document.createElement("div");
                  newInputFrame.classList.add("inputFrame");
                  newInputFrame.innerHTML = `
                          <div class="row mt-md-3" style="margin-bottom: 1rem;">
                            <div class="col-md-3">
                              <h5>AU ลำดับที่ ${newIndex}</h5>
                              <input list="dataList" id="inputField_${newIndex}" name="inputField[]" class="form-control" required="">
                              <datalist id="dataList">
                                <?php foreach ($result as $row) { ?>
                                  <option value="<?php echo $row['au_id']; ?>"><?php echo $row['au_id']; ?></option>
                                <?php } ?>
                              </datalist>
                            </div>
                            <div class="col-md-3">
                              <h5>รายละเอียด AU</h5>
                              <p id="selectedData_${newIndex}"></p>
                            </div>
                            <input type="hidden" id="selectedDataDetail_${newIndex}" name="selectedDataDetail[]">
                            <input type="hidden" id="selectedDataType_${newIndex}" name="selectedDataType[]">
                            <input type="hidden" id="selectedDataPrice_${newIndex}" name="selectedDataPrice[]">
                            <div class="col-md-3">
                              <h5>จำนวน</h5>
                              <input type="number" id="unit_${newIndex}" name="unit[]" class="form-control form-control-user" required="">
                            </div>
                          </div>
                        `;
                  inputFields.insertBefore(newInputFrame, documentButton);
                  auCounter.value = parseInt(auCounter.value);

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

              document.getElementById("addInputFrame").addEventListener("click", function() {
                var numAU = parseInt(document.getElementById("numAU").value);
                if (numAU > 0) {
                  addAUFields(numAU);
                  var auCount = document.getElementById("auCount");
                  auCount.value = parseInt(auCount.value) + numAU;
                }
              });

              document.getElementById("removeInputFrame").addEventListener("click", function() {
                var inputFrames = document.querySelectorAll(".inputFrame");
                if (inputFrames.length > 0) {
                  var lastInputFrame = inputFrames[inputFrames.length - 1];
                  lastInputFrame.parentNode.removeChild(lastInputFrame);
                  var auCount = document.getElementById("auCount");
                  auCount.value = parseInt(auCount.value) - 1;
                }
              });

              function fetchDetails(auId, index, company) {
                fetch('bill/fetch_bill_details.php?au_id=' + auId)
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

              document.getElementById("editForm").addEventListener("submit", function(event) {
                if (checkDuplicates()) {
                  event.preventDefault();
                }
              });

              function openEditModal(bill_Id) {
                fetch('bill/fetch_bill_details.php?bill_id=' + bill_Id)
                  .then(response => response.json())
                  .then(data => {
                    document.getElementById('bill_Id').value = data.bill_id;
                    document.getElementById('thai_date').value = data.bill_date;
                    document.getElementById('thai_date_product').value = data.bill_date_product;
                    document.getElementById('payment').value = data.bill_payment;
                    document.getElementById('thai_due_date').value = data.bill_due_date;
                    document.getElementById('refer').value = data.bill_refer;
                    document.getElementById('Site').value = data.bill_site;
                    document.getElementById('pr').value = data.bill_pr;
                    document.getElementById('work_no').value = data.bill_work_no;
                    document.getElementById('project').value = data.bill_project;
                    document.getElementById('auCount').value = data.list_num;

                    const inputFields = document.querySelector('.row-md-auto');
                    while (inputFields.firstChild) {
                      inputFields.removeChild(inputFields.firstChild);
                    }

                    addAUFields(data.list_num);

                    data.details.forEach(function(detail, index) {
                      document.getElementById(`inputField_${index + 1}`).value = detail.au_id;
                      document.getElementById(`selectedData_${index + 1}`).innerText = detail.au_detail;
                      document.getElementById(`selectedDataDetail_${index + 1}`).value = detail.au_detail;
                      document.getElementById(`selectedDataType_${index + 1}`).value = detail.au_type;
                      document.getElementById(`selectedDataPrice_${index + 1}`).value = detail.au_price;
                      document.getElementById(`unit_${index + 1}`).value = detail.unit;
                    });

                    $('#editModal').modal('show');
                  });
              }

              function confirmDelete(billId) {
                if (confirm("คุณแน่ใจหรือไม่ที่ต้องการลบข้อมูลบิล " + billId + " นี้?")) {
                  window.location.href = 'bill/delete_bill.php?bill_id=' + billId;
                }
              }

              var documentModal = document.getElementById("documentModal");
              var spanDocument = documentModal.getElementsByClassName("close")[0];

              function openDocumentModal(billId) {
                document.getElementById("billId").value = billId;
                documentModal.style.display = "block";
              }

              spanDocument.onclick = function() {
                documentModal.style.display = "none";
              }

              window.onclick = function(event) {
                if (event.target == documentModal) {
                  documentModal.style.display = "none";
                }
              }
            </script>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
          <button type="submit" class="btn btn-warning bg-gradient-purple" form="editForm">บันทึกการแก้ไข</button>
        </div>
      </div>
    </div>

    <script>
      $(document).ready(function() {
        $('#search').keyup(function() {
          var _f = $(this).val().toLowerCase();
          $('tbody tr').each(function() {
            var found = false;
            $(this).find('.to_folder, .to_file').each(function() {
              var val = $(this).text().toLowerCase();
              if (val.includes(_f)) {
                found = true;
                return false; // Exit .find() loop
              }
            });
            if (found) {
              $(this).show();
            } else {
              $(this).hide();
            }
          });
        });
      });
    </script>