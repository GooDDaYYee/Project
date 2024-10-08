<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header d-flex align-items-center py-3">
            <i class="fa fa-list-ul" aria-hidden="true"></i>&nbsp;จัดการข้อมูลพนักงาน
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped" id="myTable">
                <thead>
                    <tr>
                        <th class="center">ลำดับ</th>
                        <th class="center">ชื่อ</th>
                        <th class="center">นามสกุล</th>
                        <th class="center">อายุ</th>
                        <th class="center">เบอร์โทร</th>
                        <th class="center">อีเมล</th>
                        <th class="center">ตำแหน่ง</th>
                        <th class="center">สถานะ</th>
                        <th class="center">การดำเนินการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (count($data['employees']) > 0) {
                        foreach ($data['employees'] as $i => $employee): ?>
                            <tr>
                                <td class="center"><?= $i + 1 ?></td>
                                <td class="center"><?= htmlspecialchars($employee['employee_name']) ?></td>
                                <td class="center"><?= htmlspecialchars($employee['employee_lastname']) ?></td>
                                <td class="center"><?= htmlspecialchars($employee['employee_age']) ?></td>
                                <td class="center"><?= htmlspecialchars($employee['employee_phone']) ?></td>
                                <td class="center"><?= htmlspecialchars($employee['employee_email']) ?></td>
                                <td class="center"><?= $this->getPositionName($employee['employee_position']) ?></td>
                                <td class="center"><?= $this->getStatusName($employee['employee_status']) ?></td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-outline-primary edit-employee"
                                        data-id="<?= $employee['employee_id'] ?>"
                                        data-name="<?= $employee['employee_name'] ?>"
                                        data-lastname="<?= $employee['employee_lastname'] ?>"
                                        data-age="<?= $employee['employee_age'] ?>"
                                        data-phone="<?= $employee['employee_phone'] ?>"
                                        data-email="<?= $employee['employee_email'] ?>"
                                        data-position="<?= $employee['employee_position'] ?>"
                                        data-status="<?= $employee['employee_status'] ?>">แก้ไข</button>
                                    <button type="button" class="btn btn-sm btn-outline-danger delete-employee" data-id="<?= $employee['employee_id'] ?>" data-index="<?= $i + 1 ?>">ลบ</button>
                                </td>
                            </tr>
                    <?php endforeach;
                    } ?>

                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-custom-size" role="document">
        <div class="modal-content">
            <form id="editForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">แก้ไขข้อมูลพนักงาน</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="edit-employee-id" name="employee_id">
                    <div class="form-group">
                        <label for="edit-employee-name">ชื่อ</label>
                        <input type="text" class="form-control" id="edit-employee-name" name="employee_name" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-employee-lastname">นามสกุล</label>
                        <input type="text" class="form-control" id="edit-employee-lastname" name="employee_lastname" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-employee-age">อายุ</label>
                        <input type="number" class="form-control" id="edit-employee-age" name="employee_age" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-employee-phone">เบอร์โทร</label>
                        <input type="text" class="form-control" id="edit-employee-phone" name="employee_phone" required maxlength="10">
                    </div>
                    <div class="form-group">
                        <label for="edit-employee-email">อีเมล</label>
                        <input type="email" class="form-control" id="edit-employee-email" name="employee_email" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-employee-position">ตำแหน่ง</label>
                        <select class="form-control" id="edit-employee-position" name="employee_position" required>
                            <option value="0">แอดมิน</option>
                            <option value="1">เจ้าของ</option>
                            <option value="2">พนักงานเอกสาร</option>
                            <option value="3">พนักงานปฏิบัติ</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit-employee-status">สถานะการทำงาน</label>
                        <select class="form-control" id="edit-employee-status" name="employee_status" required>
                            <option value="1">ทำงานอยู่</option>
                            <option value="0">ลาออก</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                    <button type="submit" class="btn btn-warning bg-gradient-purple">บันทึกการแก้ไข</button>
                </div>
            </form>
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
            $('.edit-employee').off('click').on('click', function() {
                var EmployeeId = $(this).data('id');
                var EmployeeName = $(this).data('name');
                var EmployeeLastname = $(this).data('lastname');
                var EmployeeAge = $(this).data('age');
                var EmployeePhone = $(this).data('phone');
                var EmployeeEmail = $(this).data('email');
                var EmployeePosition = $(this).data('position');
                var EmployeeStatus = $(this).data('status');

                $('#edit-employee-id').val(EmployeeId);
                $('#edit-employee-name').val(EmployeeName);
                $('#edit-employee-lastname').val(EmployeeLastname);
                $('#edit-employee-age').val(EmployeeAge);
                $('#edit-employee-phone').val(EmployeePhone);
                $('#edit-employee-email').val(EmployeeEmail);
                $('#edit-employee-position').val(EmployeePosition);
                $('#edit-employee-status').val(EmployeeStatus);

                $('#editModal').modal('show');
            });

            $('.delete-employee').off('click').on('click', function() {
                var employeeid = $(this).data('id');
                var index = $(this).data('index');

                Swal.fire({
                    title: 'คุณแน่ใจหรือไม่?',
                    html: "คุณต้องการลบข้อมูลพนักงาน " + index + " หรือไม่? <br>!! คำเตือนหากลบข้อมูลพนักงาน ข้อมูลผู้ใช้จะหายไปด้วย !!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'ใช่',
                    cancelButtonText: 'ยกเลิก'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'index.php?page=employee&action=deleteEmployee',
                            method: 'POST',
                            data: {
                                employeeid: employeeid
                            },
                            dataType: 'json',
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'ลบสำเร็จ',
                                        text: 'ลบพนักงาน ' + index + ' เรียบร้อยแล้ว!',
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
            });
        }
        $('#editForm').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: 'index.php?page=employee&action=updateEmployee',
                method: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'สำเร็จ',
                            text: 'แก้ไขข้อมูลพนักงานสำเร็จ',
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
    });
</script>