<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between align-items-center py-3">
            <i class="fa fa-list-ul" aria-hidden="true"></i>&nbsp;สต๊อกดั้ม
            <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                <div class="input-group">
                    <input type="text" class="form-control" id="search" aria-label="Small" aria-describedby="inputGroup-sizing-sm" placeholder="ค้นหาข้อมูล">
                </div>
            </form>
            <button type="button" class="btn btn-warning bg-gradient-purple ml-auto" onclick="window.open('index.php?page=stock-drum&action=create', '_parent')">เพิ่มDrum</button>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped" id="myTable">
                <thead>
                    <tr>
                        <th>ลำดับ</th>
                        <th>บริษัทผลิตสาย</th>
                        <th>Drum Number</th>
                        <th>Drum To</th>
                        <th>Description</th>
                        <th>รับจากบริษัท</th>
                        <th>Drum เต็ม</th>
                        <th>Drum ใช้ไป</th>
                        <th>Drum เหลือ</th>
                        <th>การดำเนินการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $index => $drum): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= htmlspecialchars($drum['drum_cable_company_detail'] ?? 'ไม่ระบุ') ?></td>
                            <td><?= htmlspecialchars($drum['drum_no']) ?></td>
                            <td><?= htmlspecialchars($drum['drum_to']) ?></td>
                            <td><?= htmlspecialchars($drum['drum_description']) ?></td>
                            <td><?= htmlspecialchars($drum['drum_company_detail'] ?? 'ไม่ระบุ') ?></td>
                            <td><?= htmlspecialchars($drum['drum_full']) ?> เมตร</td>
                            <td><?= htmlspecialchars($drum['drum_used']) ?> เมตร</td>
                            <td><?= htmlspecialchars($drum['drum_remaining']) ?> เมตร</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-outline-primary edit-drum" data-id="<?= $drum['drum_id'] ?>">แก้ไข</button>
                                <button type="button" class="btn btn-sm btn-outline-danger delete-drum" data-id="<?= $drum['drum_id'] ?>" data-index="<?= $index + 1 ?>">ลบ</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Edit Drum Modal -->
<div class="modal fade" id="editDrumModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-custom-size" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDrumModalLabel">แก้ไขงาน</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editDrumForm">
                    <input type="hidden" id="edit_drum_id" name="edit_drum_id">
                    <div class="form-group">
                        <label for="edit_drum_no">Drum Number</label>
                        <input type="text" id="edit_drum_no" name="edit_drum_no" class="form-control" required>
                        <p id="edit_drum_no_notice" style="display: none; color: red;"></p>
                    </div>
                    <div class="form-group">
                        <label for="edit_drum_to">Drum To</label>
                        <input type="text" id="edit_drum_to" name="edit_drum_to" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_drum_description">Description</label>
                        <input type="text" id="edit_drum_description" name="edit_drum_description" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_drum_company">รับจากบริษัท</label>
                        <select class="form-control" id="edit_drum_company" name="edit_drum_company">
                        </select>
                        <p id="edit_drum_company_notice" style="display: none; color: red;"></p>
                    </div>
                    <div class="form-group">
                        <label for="edit_drum_cable_company">บริษัทผลิตสาย</label>
                        <select class="form-control" id="edit_drum_cable_company" name="edit_drum_cable_company">
                        </select>
                        <p id="edit_drum_cable_company_notice" style="display: none; color: red;"></p>
                    </div>
                    <div class="form-group">
                        <label for="edit_drum_full">Drum เต็ม</label>
                        <input type="number" id="edit_drum_full" name="edit_drum_full" class="form-control" required>
                        <p id="edit_drum_full_notice" style="display: none; color: red;"></p>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                <button type="button" class="btn btn-warning bg-gradient-purple" id="saveEditDrum">บันทึกการแก้ไข</button>
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
                addEventListener();
            }
        });

        function addEventListener() {
            $('#saveEditDrum').off('click').on('click', function() {
                var formData = $('#editDrumForm').serialize();
                $.ajax({
                    url: 'index.php?page=stock-drum&action=updateDrum',
                    method: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            Swal.fire('สำเร็จ', 'แก้ไขข้อมูล Drum สำเร็จ', 'success').then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire('ไม่สำเร็จ', response.message, 'error');
                        }
                    },
                    error: function() {
                        Swal.fire('ไม่สำเร็จ', 'เกิดข้อผิดพลาดในการเชื่อมต่อกับเซิร์ฟเวอร์');
                    }
                });
            });

            $('.delete-drum').off('click').on('click', function() {
                var drum_id = $(this).data('id');
                var index = $(this).data('index');

                Swal.fire({
                    title: 'คุณแน่ใจหรือไม่?',
                    text: "คุณต้องการลบข้อมูล Drum ลำดับที่ " + index + " หรือไม่?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'ใช่',
                    cancelButtonText: 'ยกเลิก'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'index.php?page=stock-drum&action=deleteDrum',
                            method: 'POST',
                            data: {
                                drum_id: drum_id
                            },
                            dataType: 'json',
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire('ลบสำเร็จ', 'ลบข้อมูล Drum ลำดับที่ ' + index + ' เรียบร้อยแล้ว!', 'success')
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

            // Fetch drum details when edit button is clicked
            $('.edit-drum').off('click').on('click', function() {
                var drumId = $(this).data('id');
                $.ajax({
                    url: 'index.php?page=stock-drum&action=getDrumDetails',
                    method: 'GET',
                    data: {
                        drum_id: drumId
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            editDrum(
                                response.data.drum,
                                response.data.all_companies,
                                response.data.all_cable_companies
                            );
                        } else {
                            Swal.fire('ไม่สำเร็จ', 'ไม่สามารถดึงข้อมูล Drum ได้', 'error');
                        }
                    },
                    error: function() {
                        Swal.fire('ไม่สำเร็จ', 'เกิดข้อผิดพลาดในการเชื่อมต่อกับเซิร์ฟเวอร์', 'error');
                    }
                });
            });
        }

        function editDrum(drum, allCompanies, allCableCompanies) {
            $('#edit_drum_id').val(drum.drum_id);
            $('#edit_drum_no').val(drum.drum_no);
            $('#edit_drum_to').val(drum.drum_to);
            $('#edit_drum_description').val(drum.drum_description);
            $('#edit_drum_full').val(drum.drum_full);

            // Populate drum company select
            $('#edit_drum_company').empty();
            $.each(allCompanies, function(i, company) {
                $('<option>')
                    .val(company.drum_company_id)
                    .text(company.drum_company_detail)
                    .appendTo('#edit_drum_company');
            });
            $('#edit_drum_company').val(drum.drum_company_id);

            // Populate drum cable company select
            $('#edit_drum_cable_company').empty();
            $.each(allCableCompanies, function(i, cableCompany) {
                $('<option>')
                    .val(cableCompany.drum_cable_company_id)
                    .text(cableCompany.drum_cable_company_detail)
                    .appendTo('#edit_drum_cable_company');
            });
            $('#edit_drum_cable_company').val(drum.drum_cable_company_id);

            if (parseInt(drum.drum_used) > 0) {
                $('#edit_drum_no').prop('readonly', true);
                $('#edit_drum_company').css({
                    'pointer-events': 'none',
                    'background-color': '#eaecf4'
                });
                $('#edit_drum_cable_company').css({
                    'pointer-events': 'none',
                    'background-color': '#eaecf4'
                });
                $('#edit_drum_full').prop('readonly', true);

                $('#edit_drum_no_notice').text('มีการเรียกใช้ดั้มอยู่').show();
                $('#edit_drum_company_notice').text('มีการเรียกใช้ดั้มอยู่').show();
                $('#edit_drum_cable_company_notice').text('มีการเรียกใช้ดั้มอยู่').show();
                $('#edit_drum_full_notice').text('มีการเรียกใช้ดั้มอยู่').show();
            } else {
                $('#edit_drum_no').prop('readonly', false);
                $('#edit_drum_full').prop('readonly', false);
                $('#edit_drum_company').css({
                    'pointer-events': '',
                    'background-color': ''
                });
                $('#edit_drum_cable_company').css({
                    'pointer-events': '',
                    'background-color': ''
                });

                $('#edit_drum_no_notice').hide();
                $('#edit_drum_company_notice').hide();
                $('#edit_drum_cable_company_notice').hide();
                $('#edit_drum_full_notice').hide();
            }

            $('#editDrumModal').modal('show');
        }
        $('#editDrumForm').on('submit', function() {
            $('#edit_drum_no, #edit_drum_company, #edit_drum_cable_company, #edit_drum_full').prop('disabled', false);
        });
    });
</script>