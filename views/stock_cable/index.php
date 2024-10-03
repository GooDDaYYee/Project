<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- List table -->
    <div class="card shadow mb-4">
        <div class="card-header d-flex align-items-center py-3">
            <i class="fa fa-list-ul" aria-hidden="true"></i>&nbsp;สต๊อกเคเบิ้ล
            <button type="button" class="btn btn-warning bg-gradient-purple ml-auto" onclick="window.open('index.php?page=stock-cable&action=create', '_parent')">เพิ่ม Cable</button>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped" id="myTable">
                <thead>
                    <tr>
                        <th>ลำดับ</th>
                        <th>Route</th>
                        <th>Section</th>
                        <th>Team</th>
                        <th>Cable จาก</th>
                        <th>Cable ถึง</th>
                        <th>Cable ใช้ไป</th>
                        <th>Drum</th>
                        <th>ใช้กับบริษัท</th>
                        <th>การดำเนินการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['cables'] as $i => $cable): ?>
                        <tr>
                            <td scope="row"><?= $i + 1 ?></td>
                            <td><?= htmlspecialchars($cable['route_name']) ?></td>
                            <td><?= htmlspecialchars($cable['installed_section']) ?></td>
                            <td><?= htmlspecialchars($cable['placing_team']) ?></td>
                            <td>ML <?= htmlspecialchars($cable['cable_form']) ?></td>
                            <td>ML <?= htmlspecialchars($cable['cable_to']) ?></td>
                            <td><?= htmlspecialchars($cable['cable_used']) ?> เมตร</td>
                            <td><?= htmlspecialchars($cable['drum_no']) ?></td>
                            <td><?= htmlspecialchars($cable['cable_work_name']) ?></td>
                            <td>
                                <button type="button" class="btn btn-sm btn-outline-primary edit-btn" data-id="<?= $cable['cable_id'] ?>">แก้ไข</button>
                                <button type="button" class="btn btn-sm btn-outline-danger delete-btn" data-id="<?= $cable['cable_id'] ?>">ลบ</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">แก้ไข Cable</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    <input type="hidden" id="editCableId" name="cable_id">
                    <div class="form-group">
                        <label for="editRoute">Route</label>
                        <input type="text" class="form-control" id="editRoute" name="route" required>
                    </div>
                    <div class="form-group">
                        <label for="editSection">Section</label>
                        <input type="text" class="form-control" id="editSection" name="section" required>
                    </div>
                    <div class="form-group">
                        <label for="editTeam">Team</label>
                        <input type="text" class="form-control" id="editTeam" name="team" required>
                    </div>
                    <div class="form-group">
                        <label for="editCableFrom">Cable From</label>
                        <input type="number" class="form-control" id="editCableFrom" name="cable_form" required>
                    </div>
                    <div class="form-group">
                        <label for="editCableTo">Cable To</label>
                        <input type="number" class="form-control" id="editCableTo" name="cable_to" required>
                    </div>
                    <div class="form-group">
                        <label for="editCableWork">ใช้กับบริษัท</label>
                        <select class="form-control" id="editCableWork" name="cable_work_id">
                            <?php foreach ($data['cableWorks'] as $cableWork): ?>
                                <option value="<?= htmlspecialchars($cableWork['cable_work_id']) ?>">
                                    <?= htmlspecialchars($cableWork['cable_work_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <input type="hidden" id="editDrumId" name="drum_id">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                <button type="button" class="btn btn-primary" id="saveChanges">บันทึกการแก้ไข</button>
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

        function addEventListener() {
            $('.edit-btn').off('click').on('click', function() {
                const cableId = $(this).data('id');
                $.ajax({
                    url: 'index.php?page=stock-cable&action=fetchCableDetails',
                    method: 'POST',
                    data: {
                        cable_id: cableId
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            $('#editCableId').val(response.data.cable_id);
                            $('#editRoute').val(response.data.route_name);
                            $('#editSection').val(response.data.installed_section);
                            $('#editTeam').val(response.data.placing_team);
                            $('#editCableFrom').val(response.data.cable_form);
                            $('#editCableTo').val(response.data.cable_to);
                            $('#editCableWork').val(response.data.cable_work_id);
                            $('#editDrumId').val(response.data.drum_id);
                            $('#editModal').modal('show');
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'ไม่สำเร็จ',
                                text: response.message
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'ไม่สำเร็จ',
                            text: 'เกิดข้อผิดพลาดในการเชื่อมต่อกับเซิร์ฟเวอร์'
                        });
                    }
                });
            });

            $('#saveChanges').off('click').on('click', function() {
                $.ajax({
                    url: 'index.php?page=stock-cable&action=update',
                    method: 'POST',
                    data: $('#editForm').serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            $('#editModal').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'สำเร็จ',
                                text: 'อัปเดตข้อมูล Cable สำเร็จ',
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'ไม่สำเร็จ',
                                text: response.message
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'ไม่สำเร็จ',
                            text: 'เกิดข้อผิดพลาดในการเชื่อมต่อกับเซิร์ฟเวอร์'
                        });
                    }
                });
            });

            $('.delete-btn').off('click').on('click', function() {
                const cableId = $(this).data('id');
                const id = $(this).data('id');
                Swal.fire({
                    title: 'คุณแน่ใจหรือไม่?',
                    text: "คุณต้องการลบข้อมูล" + id + "นี้หรือไม่?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'ใช่, ลบเลย!',
                    cancelButtonText: 'ยกเลิก'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'index.php?page=stock-cable&action=delete',
                            method: 'POST',
                            data: {
                                cable_id: cableId
                            },
                            dataType: 'json',
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire(
                                        'ลบสำเร็จ!',
                                        'ข้อมูล Cable ถูกลบเรียบร้อยแล้ว',
                                        'success'
                                    ).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'ไม่สำเร็จ',
                                        text: response.message
                                    });
                                }
                            },
                            error: function() {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'ไม่สำเร็จ',
                                    text: 'เกิดข้อผิดพลาดในการเชื่อมต่อกับเซิร์ฟเวอร์'
                                });
                            }
                        });
                    }
                });
            });
        }
    });
</script>