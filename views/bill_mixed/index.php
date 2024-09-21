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
      <button type="button" class="btn btn-warning bg-gradient-purple ml-auto" onclick="window.open('index.php?page=bill-mixed&action=create', '_parent')">เพิ่มบิล</button>
    </div>

    <div class="card-body">
      <div class="card border h-100">
        <table class="table table-striped" id="billTable">
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
            <?php foreach ($data['bills'] as $bill): ?>
              <tr>
                <th scope="row"><i class="to_file"><?= htmlspecialchars($bill['bill_id']) ?></i></th>
                <td><i class="to_file"><?= $this->formatThaiDate($bill['bill_date']) ?></i></td>
                <td><i class="to_file"><?= htmlspecialchars($bill['bill_site']) ?></i></td>
                <td><i class="to_file"><?= number_format($bill['total_amount'], 2) ?></i></td>
                <td><i class="to_file"><?= number_format($bill['vat'], 2) ?></i></td>
                <td><i class="to_file"><?= number_format($bill['grand_total'], 2) ?></i></td>
                <td>
                  <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-outline-success edit-btn" data-id="<?= $bill['bill_id'] ?>">แก้ไข</button>
                    <button type="button" class="btn btn-outline-warning pdf-btn" data-id="<?= $bill['bill_id'] ?>">PDF</button>
                    <button type="button" class="btn btn-outline-danger delete-btn" data-id="<?= $bill['bill_id'] ?>">ลบ</button>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
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
      <form id="editForm">
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
              <button type="button" id="addInputFrame" class="btn btn-success btn-user btn-block">เพิ่ม AU</button>
            </div>
            <div class="col-md-2">
              <h5>&nbsp;</h5>
              <button type="button" id="removeInputFrame" class="btn btn-danger btn-user btn-block">ลบ AU</button>
            </div>
            <div class="col-md-3">
              <h5>จำนวน AU ที่เพิ่ม</h5>
              <input type="number" id="auCount" name="auCount" class="form-control form-control-user" value="0" readonly>
              <input type="hidden" name="company" value="Mixed">
            </div>
          </div>
          <div id="auContainer">
            <!-- AU inputs will be dynamically added here -->
          </div>
        </div>
      </form>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
      <button type="button" class="btn btn-warning bg-gradient-purple" id="saveChanges">บันทึกการแก้ไข</button>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    let currentPage = 1;
    const rowsPerPage = 10;
    const $rows = $('#billTable tbody tr');
    const totalPages = Math.ceil($rows.length / rowsPerPage);

    function showPage(page) {
      const start = (page - 1) * rowsPerPage;
      const end = start + rowsPerPage;

      $rows.hide().slice(start, end).show();

      updatePagination(page);
    }

    function updatePagination(currentPage) {
      const $pagination = $('.pagination');
      $pagination.empty();

      const startPage = Math.max(1, currentPage - 2);
      const endPage = Math.min(totalPages, startPage + 4);

      if (startPage > 1) {
        $pagination.append(`<li class="page-item"><a class="page-link" href="#" data-page="1">&laquo; หน้าแรก</a></li>`);
      }

      for (let i = startPage; i <= endPage; i++) {
        $pagination.append(`<li class="page-item ${i === currentPage ? 'active' : ''}"><a class="page-link" href="#" data-page="${i}">${i}</a></li>`);
      }

      if (endPage < totalPages) {
        $pagination.append(`<li class="page-item"><a class="page-link" href="#" data-page="${totalPages}">หน้าสุดท้าย &raquo;</a></li>`);
      }
    }

    $('.pagination').on('click', 'a', function(e) {
      e.preventDefault();
      currentPage = parseInt($(this).data('page'));
      showPage(currentPage);
    });

    $('#search').on('keyup', function() {
      const value = $(this).val().toLowerCase();
      $rows.filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
      });
      currentPage = 1;
      showPage(currentPage);
    });

    $('.edit-btn').click(function() {
      const billId = $(this).data('id');
      $.ajax({
        url: 'index.php?page=bill-mixed&action=fetchBillDetails',
        method: 'POST',
        data: {
          bill_id: billId
        },
        dataType: 'json',
        success: function(response) {
          if (response.success) {
            populateEditForm(response.data.bill, response.data.details);
            $('#editModal').modal('show');
          } else {
            alert('Error fetching bill details: ' + response.message);
          }
        },
        error: function() {
          alert('Error fetching bill details');
        }
      });
    });

    function populateEditForm(bill, details) {
      $('#bill_Id').val(bill.bill_id);
      $('#thai_date').val(bill.bill_date);
      $('#thai_date_product').val(bill.bill_date_product);
      $('#payment').val(bill.bill_payment);
      $('#thai_due_date').val(bill.bill_due_date);
      $('#refer').val(bill.bill_refer);
      $('#Site').val(bill.bill_site);
      $('#pr').val(bill.bill_pr);
      $('#work_no').val(bill.bill_work_no);
      $('#project').val(bill.bill_project);
      $('#auCount').val(details.length);

      $('#auContainer').empty();
      details.forEach((detail, index) => {
        addAUInput(detail, index + 1);
      });
    }

    function addAUInput(detail, index) {
      const newInputFrame = $(`
      <div class="inputFrame">
        <div class="row mt-md-3" style="margin-bottom: 1rem;">
          <div class="col-md-3">
            <h5>AU ลำดับที่ ${index}</h5>
            <input list="dataList" id="inputField_${index}" name="inputField[]" class="form-control" required value="${detail ? detail.au_id : ''}">
          </div>
          <div class="col-md-3">
            <h5>รายละเอียด AU</h5>
            <p id="selectedData_${index}">${detail ? detail.au_detail : ''}</p>
          </div>
          <input type="hidden" id="selectedDataDetail_${index}" name="selectedDataDetail[]"
          value="${detail ? detail.au_detail : ''}">
          <input type="hidden" id="selectedDataType_${index}" name="selectedDataType[]" value="${detail ? detail.au_type : ''}">
          <input type="hidden" id="selectedDataPrice_${index}" name="selectedDataPrice[]" value="${detail ? detail.au_price : ''}">
          <div class="col-md-3">
            <h5>จำนวน</h5>
            <input type="number" id="unit_${index}" name="unit[]" class="form-control form-control-user" required value="${detail ? detail.unit : ''}">
          </div>
        </div>
      </div>
    `);
      $('#auContainer').append(newInputFrame);

      $(`#inputField_${index}`).on('input', function() {
        const selectedOption = $(this).val();
        fetchAUDetails(selectedOption, index);
      });
    }

    function fetchAUDetails(auId, index) {
      $.ajax({
        url: 'index.php?page=bill-mixed&action=fetchAUDetails',
        method: 'GET',
        data: {
          au_id: auId
        },
        dataType: 'json',
        success: function(data) {
          $(`#selectedData_${index}`).text(data.au_detail);
          $(`#selectedDataDetail_${index}`).val(data.au_detail);
          $(`#selectedDataType_${index}`).val(data.au_type);
          $(`#selectedDataPrice_${index}`).val(data.au_price);
        },
        error: function() {
          console.log('Error fetching AU details');
        }
      });
    }

    $('#addInputFrame').click(function() {
      const numAU = parseInt($('#numAU').val());
      if (numAU > 0) {
        const currentCount = parseInt($('#auCount').val());
        for (let i = 0; i < numAU; i++) {
          addAUInput(null, currentCount + i + 1);
        }
        $('#auCount').val(currentCount + numAU);
      }
    });

    $('#removeInputFrame').click(function() {
      const $inputFrames = $('.inputFrame');
      if ($inputFrames.length > 0) {
        $inputFrames.last().remove();
        const currentCount = parseInt($('#auCount').val());
        $('#auCount').val(currentCount - 1);
      }
    });

    $('#saveChanges').click(function() {
      if (checkDuplicates()) {
        Swal.fire({
          icon: 'error',
          title: 'ไม่สำเร็จ',
          text: 'มี AU ID ซ้ำกัน กรุณาตรวจสอบและแก้ไข',
        });
        return;
      }

      const formData = $('#editForm').serialize();
      $.ajax({
        url: 'index.php?page=bill-mixed&action=updateBill',
        method: 'POST',
        data: formData,
        dataType: 'json',
        success: function(response) {
          if (response.success) {
            Swal.fire({
              icon: 'success',
              title: 'สำเร็จ',
              text: 'แก้ไขข้อมูลบิลสำเร็จ',
            }).then(() => {
              location.reload();
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'ไม่สำเร็จ',
              text: response.message,
            });
          }
        },
        error: function() {
          Swal.fire({
            icon: 'error',
            title: 'ไม่สำเร็จ',
            text: 'เกิดข้อผิดพลาดในการเชื่อมต่อกับเซิร์ฟเวอร์',
          });
        }
      });
    });

    function checkDuplicates() {
      const auIds = $('input[name="inputField[]"]').map(function() {
        return $(this).val();
      }).get();
      const uniqueAuIds = [...new Set(auIds)];
      return auIds.length !== uniqueAuIds.length;
    }

    $('.delete-btn').click(function() {
      const billId = $(this).data('id');
      if (confirm("คุณแน่ใจหรือไม่ที่ต้องการลบข้อมูลบิล " + billId + " นี้?")) {
        $.ajax({
          url: 'index.php?page=bill-mixed&action=deleteBill',
          method: 'POST',
          data: {
            bill_id: billId
          },
          dataType: 'json',
          success: function(response) {
            if (response.success) {
              Swal.fire({
                icon: 'success',
                title: 'ลบสำเร็จ',
                text: 'ลบผู้ใช้ ' + username + ' เรียบร้อยแล้ว!',
              }).then(() => {
                location.reload();
              });
            } else {
              Swal.fire({
                icon: 'error',
                title: 'ไม่สำเร็จ',
                text: response.message,
              });
            }
          },
          error: function() {
            Swal.fire({
              icon: 'error',
              title: 'ไม่สำเร็จ',
              text: 'เกิดข้อผิดพลาดในการเชื่อมต่อกับเซิร์ฟเวอร์',
            });
          }
        });
      }
    });

    $('.pdf-btn').click(function() {
      const billId = $(this).data('id');
      $('#billId').val(billId);
      $('#documentModal').modal('show');
    });

    // Initial page load
    showPage(currentPage);
  });
</script>