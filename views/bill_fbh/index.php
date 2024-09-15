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
      <button type="button" class="btn btn-warning bg-gradient-purple ml-auto" onclick="window.open('index.php?page=bill-fbh&action=create', '_parent')">เพิ่มบิล</button>
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
            <?php foreach ($data['bills'] as $bill): ?>
              <tr>
                <th scope="row"><i class="to_file"><?= htmlspecialchars($bill['bill_id']) ?></i></th>
                <td><i class="to_file"><?= $this->formatThaiDate($bill['bill_date']) ?></i></td>
                <td><i class="to_file"><?= htmlspecialchars($bill['bill_site']) ?></i></td>
                <td><i class="to_file"><?= number_format($bill['total_amount'], 2) ?></td>
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
      <form id="editForm">
        <!-- Form fields here -->
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
    var rowsPerPage = 10;
    var $rows = $('tbody tr');
    var totalPages = Math.ceil($rows.length / rowsPerPage);
    var currentPage = 1;

    function showPage(page) {
        var start = (page - 1) * rowsPerPage;
        var end = start + rowsPerPage;

        $rows.hide().slice(start, end).show();
        updatePagination(page);
    }

    function updatePagination(currentPage) {
        var $pagination = $('.pagination');
        $pagination.empty();

        var maxVisiblePages = 5;
        var startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
        var endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);

        if (startPage > 1) {
            $pagination.append('<li class="page-item"><a class="page-link" href="#" data-page="1">&laquo; หน้าแรก</a></li>');
        }

        for (var i = startPage; i <= endPage; i++) {
            $pagination.append('<li class="page-item ' + (i === currentPage ? 'active' : '') + '"><a class="page-link" href="#" data-page="' + i + '">' + i + '</a></li>');
        }

        if (endPage < totalPages) {
            $pagination.append('<li class="page-item"><a class="page-link" href="#" data-page="' + totalPages + '">หน้าสุดท้าย &raquo;</a></li>');
        }
    }

    $('.pagination').on('click', 'a', function(e) {
        e.preventDefault();
        currentPage = parseInt($(this).data('page'));
        showPage(currentPage);
    });

    $('#search').on('keyup', function() {
        var searchTerm = $(this).val().toLowerCase();
        $rows.each(function() {
            var rowText = $(this).text().toLowerCase();
            $(this).toggle(rowText.indexOf(searchTerm) > -1);
        });
    });

    $('.edit-btn').click(function() {
        var billId = $(this).data('id');
        $.ajax({
            url: 'index.php?action=fetchBillDetails',
            method: 'GET',
            data: { bill_id: billId },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    populateEditForm(response.bill, response.details);
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
        // Populate form fields
        $('#editForm').html(`
            <input type="hidden" name="bill_Id" value="${bill.bill_id}">
            <div class="form-group">
                <label for="thai_date">วันที่ออกบิล</label>
                <input type="date" class="form-control" id="thai_