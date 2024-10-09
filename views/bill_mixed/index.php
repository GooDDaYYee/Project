<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- List table -->
  <div class="card shadow mb-4">
    <div class="card-header d-flex align-items-center py-3">
      <i class="fa fa-list-ul" aria-hidden="true"></i>&nbsp;จัดการบิลบริษัท Mixed
      <button type="button" class="btn btn-warning bg-gradient-purple ml-auto" onclick="window.open('index.php?page=bill-mixed&action=create', '_parent')">เพิ่มบิล</button>
    </div>

    <div class="card-body  table-responsive">
      <table class="table table-bordered table-striped" id="myTable">
        <thead>
          <tr>
            <th class="center">เลขที่</th>
            <th class="center">วันที่ออกบิล</th>
            <th class="center">Site</th>
            <th class="center">Final BOQ 100%</th>
            <th class="center">VAT 7%</th>
            <th class="center">GRAND Total</th>
            <th class="center">การดำเนินการ</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($data['bills'] as $bill): ?>
            <tr>
              <td class="center"><?= htmlspecialchars($bill['bill_name']) ?></td>
              <td class="center"><?= $this->formatThaiDate($bill['bill_date']) ?></td>
              <td class="center"><?= htmlspecialchars($bill['bill_site']) ?></td>
              <td class="right"><?= number_format($bill['total_amount'], 2) ?></td>
              <td class="right"><?= number_format($bill['vat'], 2) ?></td>
              <td class="right"><?= number_format($bill['grand_total'], 2) ?></td>
              <td>
                <button type="button" class="btn btn-sm btn-outline-primary edit-btn" data-id="<?= $bill['bill_id'] ?>">แก้ไข</button>
                <button type="button" class="btn btn-sm btn-outline-warning pdf-btn" data-id="<?= $bill['bill_id'] ?>" data-company="<?= $bill['bill_company'] ?>">PDF</button>
                <button type="button" class="btn btn-sm btn-outline-danger delete-btn" data-id="<?= $bill['bill_id'] ?>" data-name="<?= $bill['bill_name'] ?>">ลบ</button>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Modal for Document Options -->
<div class="modal fade" id="documentModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-custom-size" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="editModalLabel">ออกเอกสารเป็น PDF</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="documentForm" action="index.php?page=bill-mixed&action=exportPDF" target="_blank" method="post">
          <input type="hidden" id="billId" name="billId" value="">
          <input type="hidden" id="company" name="company" value="">
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
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-custom-size" role="document">
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
            <input type="hidden" id="bill_Id" name="bill_Id">
            <div class="row mt-md-3">
              <div class="col">
                <h5>เลขที่</h5>
                <input type="text" id="bill_name" name="bill_name" class="form-control form-control-user" value="" readonly>
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
                <input type="number" id="numAU" name="numAU" class="form-control form-control-user" placeholder="จำนวนAU" step="0.01" min="0" value="0" required>
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
                <input type="number" id="auCount" name="auCount" class="form-control form-control-user" value="0" step="0.01" min="0" readonly>
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
</div>

<script>
  $(document).ready(function() {
    let table = new DataTable('#myTable', {
      pageLength: 10,
      language: {
        url: "assets/js/Thai.json"
      },
      drawCallback: function() {
        // เรียกใช้ฟังก์ชันนี้ทุกครั้งที่ DataTables วาดตารางใหม่
        addEventListener();
      }
    });

    const auOptions = <?php echo json_encode($data['auOptions']); ?>;

    function addEventListener() {

      $('.edit-btn').off('click').on('click', function() {
        const billId = $(this).data('id');
        var loadingOverlay = new LoadingOverlay();
        loadingOverlay.show();
        $.ajax({
          url: 'index.php?page=bill-mixed&action=fetchBillDetails',
          method: 'POST',
          data: {
            bill_id: billId
          },
          dataType: 'json',
          success: function(response) {
            loadingOverlay.hide();
            if (response.success) {
              populateEditForm(response.data.bill, response.data.details);
              $('#editModal').modal('show');
            } else {
              alert('Error fetching bill details: ' + response.message);
            }
          },
          error: function() {
            loadingOverlay.hide();
            alert('Error fetching bill details');
          }
        });
      });

      $('#addInputFrame').off('click').on('click', function() {
        const numAU = parseInt($('#numAU').val());
        if (numAU > 0) {
          const currentCount = parseInt($('#auCount').val());
          for (let i = 0; i < numAU; i++) {
            addAUInput(null, currentCount + i + 1);
          }
          $('#auCount').val(currentCount + numAU);
        }
      });

      $('#removeInputFrame').off('click').on('click', function() {
        const $inputFrames = $('.inputFrame');
        if ($inputFrames.length > 0) {
          $inputFrames.last().remove();
          const currentCount = parseInt($('#auCount').val());
          $('#auCount').val(currentCount - 1);
        }
      });

      $('#saveChanges').off('click').on('click', function() {
        // ตรวจสอบว่ามีการเพิ่ม AU หรือไม่
        if ($('.inputFrame').length === 0) {
          Swal.fire({
            icon: 'warning',
            title: 'ไม่พบข้อมูล AU',
            text: 'กรุณาเพิ่ม AU อย่างน้อย 1 รายการก่อนบันทึกข้อมูล',
            confirmButtonText: 'เข้าใจแล้ว'
          });
          return;
        }

        const duplicateCheck = checkDuplicates();
        if (duplicateCheck.hasDuplicates) {
          const duplicateMessages = Object.entries(duplicateCheck.duplicates).map(([id, indices]) =>
            `AU ID ชื่อ <strong>${id}</strong> ซ้ำกันที่ลำดับ: <strong>${indices.join(', ')}</strong>`
          );
          Swal.fire({
            icon: 'warning',
            title: 'พบ AU ID ซ้ำ',
            html: duplicateMessages.join('<br>') + '<br>กรุณาตรวจสอบและแก้ไข',
            confirmButtonText: 'เข้าใจแล้ว'
          });
          return;
        }

        // ตรวจสอบว่าทุก AU มีการกรอกข้อมูลครบถ้วนหรือไม่
        let isValid = true;
        $('.inputFrame').each(function(index) {
          const auName = $(this).find('input[name="inputField[]"]').val();
          const auUnit = $(this).find('input[name="unit[]"]').val();
          if (!auName || !auUnit) {
            isValid = false;
            Swal.fire({
              icon: 'warning',
              title: 'ข้อมูลไม่ครบถ้วน',
              text: `กรุณากรอกข้อมูล AU และจำนวนให้ครบถ้วนที่ลำดับที่ ${index + 1}`,
              confirmButtonText: 'เข้าใจแล้ว'
            });
            return false; // break the loop
          }
        });

        if (!isValid) {
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

      // sweetalert delete bill
      $('.delete-btn').off('click').on('click', function() {
        var bill_id = $(this).data('id');
        var bill_name = $(this).data('name');

        Swal.fire({
          title: 'คุณแน่ใจหรือไม่?',
          text: "คุณต้องการลบ Bill " + bill_name + " หรือไม่?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          confirmButtonText: 'ใช่',
          cancelButtonText: 'ยกเลิก'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: 'index.php?page=bill-mixed&action=deleteBill',
              method: 'POST',
              data: {
                bill_id: bill_id
              },
              dataType: 'json',
              success: function(response) {
                if (response.success) {
                  Swal.fire('ลบสำเร็จ', 'ลบข้อมูล Bill ' + bill_name + ' เรียบร้อยแล้ว!', 'success')
                    .then(() => {
                      location.reload();
                    });
                } else {
                  Swal.fire('ไม่สำเร็จ', response.message, 'error');
                }
              },
              error: function() {
                Swal.fire('ไม่สำเร็จ', 'เกิดข้อผิดพลาดในการเชื่อมต่อกับเซิร์ฟเวอร์', 'error');
              }
            });
          }
        });
      });

      $('.pdf-btn').off('click').on('click', function() {
        const billId = $(this).data('id');
        const company = $(this).data('company');
        $('#billId').val(billId);
        $('#company').val(company);

        $('#documentModal').modal('show');
      });
    }
    //////// end addEventListener()

    function populateEditForm(bill, details) {
      $('#bill_Id').val(bill.bill_id);
      $('#bill_name').val(bill.bill_name);
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
        // เพิ่มบรรทัดนี้เพื่อให้แน่ใจว่า au_id ถูกตั้งค่าเมื่อโหลดข้อมูล
        $(`#selectedAuId_${index + 1}`).val(detail.au_id);
      });
    }


    function addAUInput(detail, index) {
      const newInputFrame = $(`
        <div class="inputFrame">
          <div class="row mt-md-3" style="margin-bottom: 1rem;">
            <div class="col-md-3">
              <h5>AU ลำดับที่ ${index}</h5>
              <input list="dataList_${index}" id="inputField_${index}" name="inputField[]" class="form-control" required value="${detail && detail.au_name ? detail.au_name : ''}">
              <datalist id="dataList_${index}">
                ${auOptions.map(option => `<option value="${option.au_name}" data-au-id="${option.au_id}">${option.au_name} - ${option.au_detail}</option>`).join('')}
              </datalist>
              <input type="hidden" id="selectedAuId_${index}" name="selectedAuId[]" value="${detail && detail.au_id ? detail.au_id : ''}">
            </div>
              <div class="col-md-3">
                <h5>รายละเอียด AU</h5>
                <p id="selectedData_${index}">${detail && detail.au_detail ? detail.au_detail : ''}</p>
              </div>
              <input type="hidden" id="selectedDataDetail_${index}" name="selectedDataDetail[]" value="${detail && detail.au_detail ? detail.au_detail : ''}">
              <input type="hidden" id="selectedDataType_${index}" name="selectedDataType[]" value="${detail && detail.au_type ? detail.au_type : ''}">
              <input type="hidden" id="selectedDataPrice_${index}" name="selectedDataPrice[]" value="${detail && detail.au_price ? detail.au_price : ''}">
              <div class="col-md-3">
                <h5>จำนวน</h5>
                <input type="number" id="unit_${index}" name="unit[]" class="form-control form-control-user" required step="0.01" min="0" value="${detail && detail.unit ? detail.unit : ''}">
              </div>
            </div>
          </div>
        `);

      $('#auContainer').append(newInputFrame);

      $(`#inputField_${index}`).on('input', function() {
        const selectedOption = $(`#dataList_${index} option[value="${this.value}"]`);
        const auId = selectedOption.data('au-id');
        $(`#selectedAuId_${index}`).val(auId);
        fetchAUDetails(auId, index);
      });
    }

    function fetchAUDetails(auId, index) {
      $.ajax({
        url: 'index.php?page=bill-fbh&action=fetchAUDetails2',
        method: 'GET',
        data: {
          au_id: auId
        },
        dataType: 'json',
        success: function(resp) {
          if (resp.success) {
            const data = resp.data;
            $(`#selectedData_${index}`).text(data.au_detail);
            $(`#selectedDataDetail_${index}`).val(data.au_detail);
            $(`#selectedDataType_${index}`).val(data.au_type);
            $(`#selectedDataPrice_${index}`).val(data.au_price);
          } else {
            console.log('Error fetching AU details:', resp.message);
          }
        },
        error: function() {
          console.log('Error fetching AU details');
        }
      });
    }

    function checkDuplicates() {
      const auIds = $('input[name="inputField[]"]').map(function() {
        return $(this).val();
      }).get();
      const duplicates = {};
      auIds.forEach((id, index) => {
        if (auIds.indexOf(id) !== index) {
          if (!duplicates[id]) {
            duplicates[id] = [auIds.indexOf(id) + 1];
          }
          duplicates[id].push(index + 1);
        }
      });

      if (Object.keys(duplicates).length > 0) {
        return {
          hasDuplicates: true,
          duplicates: duplicates
        };
      }
      return {
        hasDuplicates: false
      };
    }
  });
</script>