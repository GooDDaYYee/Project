<?php
include('connect.php');
?>
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- List table -->
  <div class="card shadow mb-4">
    <div class="card-header d-flex justify-content-between align-items-center py-3">
      <i class="fa fa-list-ul" aria-hidden="true"></i>&nbsp;จัดการบิลบริษัท FBH

      <!-- Topbar Search -->
      <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <div class="input-group">
          <input type="text" class="form-control" id="search" aria-label="Small" aria-describedby="inputGroup-sizing-sm" placeholder="ค้นหาข้อมูล">
        </div>
      </form>
      <form method="GET" action="" id="filterForm">
        <input type="hidden" name="page" value="<?php echo isset($_GET['page']) ? $_GET['page'] : base64_encode('home'); ?>" />
        <div class="row">
          <div class="col-sm-6">
            <select name="month" class="form-control" id="month" onchange="document.getElementById('filterForm').submit()">
              <option value="">เดือน</option>
              <?php
              $months = array("มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
              for ($i = 0; $i < sizeof($months); $i++) {
              ?>
                <option value="<?php echo $i + 1 ?>" <?php echo isset($_GET['month']) && $_GET['month'] == $i + 1 ? 'selected' : '' ?>>
                  <?php echo $months[$i] ?>
                </option>
              <?php } ?>
            </select>
          </div>
          <div class="col-sm-6">
            <select name="year" class="form-control" id="year" onchange="document.getElementById('filterForm').submit()">
              <option value="">ปี</option>
              <?php for ($i = 0; $i <= 50; $i++) { ?>
                <option value="<?php echo date("Y") - $i ?>" <?php echo isset($_GET['year']) && $_GET['year'] == date("Y") - $i ? 'selected' : '' ?>>
                  <?php echo date("Y") - $i + 543 ?>
                </option>
              <?php } ?>
            </select>
          </div>
        </div>
      </form>
      &nbsp;
      &nbsp;
      <div class="row">
        <div class="col">
          <button type="button" class="btn btn-warning bg-gradient-purple ml-auto" onclick="window.open('index.php?page=<?= base64_encode('bill/fbh_report') ?>', '_parent')">เพิ่มบิล</button>
        </div>
      </div>
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
            if (isset($_GET['month']) && isset($_GET['year']) && $_GET['month'] !== '' && $_GET['year'] !== '') {
              $month = $_GET['month'];
              $year = $_GET['year'];

              $gregorian_year = $year - 543; // Convert Thai year to Gregorian year

              $sql_filter = " AND MONTH(bill_date) = :month AND YEAR(bill_date) = :year";
              $strsql = "SELECT * FROM bill WHERE bill_company = 'FBH'" . $sql_filter . " ORDER BY bill_id DESC";

              $stmt = $con->prepare($strsql);
              $stmt->bindParam(':month', $month, PDO::PARAM_INT);
              $stmt->bindParam(':year', $gregorian_year, PDO::PARAM_INT);
            } else {
              $strsql = "SELECT * FROM bill WHERE bill_company = 'FBH' ORDER BY bill_id DESC";
              $stmt = $con->prepare($strsql);
            }

            try {
              $stmt->execute();
              $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
              $rowcount = count($result);

              if ($rowcount > 0) {
                foreach ($result as $rs) {
            ?>
                  <tr>
                    <th scope="row"><i class="to_file"><?php echo $rs['bill_id']; ?></i></th>
                    <td><i class="to_file">
                        <?php
                        $timestamp = strtotime($rs['bill_date']);
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
                        $thai_month_num = date('n', $timestamp);
                        echo date('d', $timestamp) . ' ' . $thai_month[$thai_month_num] . ' ' . (date('Y', $timestamp));
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
        &nbsp;
        <div class="pagination-container">
          <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal for Document Options -->
<div id="documentModal" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">ออกเอกสารเป็น PDF</h4>
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
        <!-- Form content here (same as before) -->
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
    var rowsPerPage = 10;
    var totalRows = $('tbody tr').length;
    var totalPages = Math.ceil(totalRows / rowsPerPage);
    var maxVisiblePages = 5;

    function renderPagination(currentPage) {
      // Pagination rendering logic (same as before)
    }

    function showPage(pageNumber) {
      // Page display logic (same as before)
    }

    if (totalRows > rowsPerPage) {
      renderPagination(1);
      showPage(1);
    } else {
      $('tbody tr').show();
    }

    $('.pagination').on('click', 'li a', function(e) {
      e.preventDefault();
      var currentPage = parseInt($(this).attr('data-page'));
      renderPagination(currentPage);
      showPage(currentPage);
    });

    $('#search').keyup(function() {
      var searchTerm = $(this).val().toLowerCase();
      $('tbody tr').hide();
      $('tbody tr').each(function() {
        var rowText = $(this).text().toLowerCase();
        if (rowText.includes(searchTerm)) {
          $(this).show();
        }
      });
    });
  });

  function confirmDelete(billId) {
    Swal.fire({
      title: 'คุณแน่ใจหรือไม่?',
      html: "คุณต้องการลบข้อมูลบิล " + billId,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'ใช่',
      cancelButtonText: 'ยกเลิก'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          type: "POST",
          url: "bill/delete_bill.php?bill_id=" + billId,
          success: function(response) {
            Swal.fire({
              icon: 'success',
              title: 'ลบสำเร็จ',
              text: 'ลบบิลเลขที่ ' + billId + ' เรียบร้อยแล้ว!',
            }).then(function() {
              var month = $('#month').val();
              var year = $('#year').val();
              window.location.href = "index.php?page=" + btoa('bill/list_fbh') + "&month=" + month + "&year=" + year;
            });
          },
          error: function() {
            Swal.fire({
              icon: 'error',
              title: 'ไม่สำเร็จ',
              text: 'ลบบิลเลขที่ ' + billId + ' ไม่สำเร็จ!',
            });
          }
        });
      }
    });
  }

  function openEditModal(bill_Id) {
    // Edit modal opening logic (same as before)
  }

  $('#editForm').on('submit', function(e) {
    e.preventDefault();
    var form = $(this);
    $.ajax({
      type: "POST",
      url: form.attr('action'),
      data: form.serialize(),
      success: function(response) {
        Swal.fire({
          icon: 'success',
          title: 'สำเร็จ',
          text: 'แก้ไขข้อมูล Bill สำเร็จ',
        }).then(function() {
          var month = $('#month').val();
          var year = $('#year').val();
          window.location.href = "index.php?page=" + btoa('bill/list_fbh') + "&month=" + month + "&year=" + year;
        });
      },
      error: function() {
        Swal.fire({
          icon: 'error',
          title: 'ไม่สำเร็จ',
          text: 'แก้ไขข้อมูล Bill ไม่สำเร็จ!',
        });
      }
    });
  });

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

  // Function to add AU fields dynamically
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

  // Event listener for adding AU fields
  document.getElementById("addInputFrame").addEventListener("click", function() {
    var numAU = parseInt(document.getElementById("numAU").value);
    if (numAU > 0) {
      addAUFields(numAU);
      var auCount = document.getElementById("auCount");
      auCount.value = parseInt(auCount.value) + numAU;
    }
  });

  // Event listener for removing AU fields
  document.getElementById("removeInputFrame").addEventListener("click", function() {
    var inputFrames = document.querySelectorAll(".inputFrame");
    if (inputFrames.length > 0) {
      var lastInputFrame = inputFrames[inputFrames.length - 1];
      lastInputFrame.parentNode.removeChild(lastInputFrame);
      var auCount = document.getElementById("auCount");
      auCount.value = parseInt(auCount.value) - 1;
    }
  });

  // Function to fetch AU details
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

  // Function to check for duplicate AU IDs
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

  // Event listener for form submission
  document.getElementById("editForm").addEventListener("submit", function(event) {
    if (checkDuplicates()) {
      event.preventDefault();
    }
  });
</script>