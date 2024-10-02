<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header d-flex align-items-center py-3 justify-content-between">
            <div>
                <i class="fa fa-list-ul" aria-hidden="true"></i>&nbsp;จัดการเงินเดือน
            </div>
            <div class="row">
                <form method="GET" id="filterForm">
                    <input type="hidden" name="page" value="<?php echo isset($_GET['page']) ? $_GET['page'] : base64_encode('home'); ?>" />
                    <div class="row">
                        <div class="col-sm-6">
                            <select name="month" class="form-control" id="month" onchange="document.getElementById('filterForm').submit()">
                                <option value="1">เดือน</option>
                                <?php
                                for ($i = 0; $i < sizeof($data['months']); $i++) {
                                ?>
                                    <option value="<?php echo $i + 1 ?>" <?php echo isset($_GET['month']) && $_GET['month'] == $i + 1 ? 'selected' : '' ?>>
                                        <?php echo $data['months'][$i] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <select name="year" class="form-control" id="year" onchange="document.getElementById('filterForm').submit()">
                                <option value="1">ปี</option>
                                <?php for ($i = 0; $i <= 50; $i++) { ?>
                                    <option value="<?php echo date("Y") - $i ?>" <?php echo isset($_GET['year']) && $_GET['year'] == date("Y") - $i ? 'selected' : '' ?>>
                                        <?php echo date("Y") - $i + 543 ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </form>
                <button type="button" class="btn btn-warning bg-gradient-purple ml-2" onclick="window.open('index.php?page=employee-salary&action=create', '_parent')">เพิ่มเงินเดือน</button>
            </div>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped" id="myTable">
                <thead>
                    <tr>
                        <th>ลำดับ</th>
                        <th>ชื่อ</th>
                        <th>นามสกุล</th>
                        <th>เงินเดือน</th>
                        <th>OT</th>
                        <th style="width: 14%;">ประกันสังคม (หักในเงินเดือน)</th>
                        <th>อื่นๆ</th>
                        <th>รวม</th>
                        <th>การดำเนินการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($data['salaries'] as $index => $salary): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= htmlspecialchars($salary['employee_name']) ?></td>
                            <td><?= htmlspecialchars($salary['employee_lastname']) ?></td>
                            <td style="text-align: right;"><?= number_format($salary['salary'], 2) ?></td>
                            <td style="text-align: right;"><?= number_format($salary['ot'], 2) ?></td>
                            <td style="text-align: right;"><?= number_format($salary['social_security'], 2) ?></td>
                            <td style="text-align: right;"><?= number_format($salary['other'], 2) ?></td>
                            <td style="text-align: right;"><?= number_format($salary['total_salary'], 2) ?></td>
                            <td>
                                <button type="button" class="btn btn-sm btn-outline-primary edit-salary"
                                    data-salary_id="<?= $salary['salary_id'] ?>"
                                    data-salary="<?= $salary['salary'] ?>"
                                    data-ot="<?= $salary['ot'] ?>"
                                    data-social_security="<?= $salary['social_security'] ?>"
                                    data-other="<?= $salary['other'] ?>">
                                    แก้ไข
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-danger delete-salary"
                                    data-salary_id="<?= $salary['salary_id'] ?>"
                                    data-index="<?= $index + 1 ?>">
                                    ลบ
                                </button>
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
    <div class="modal-dialog modal-custom-size" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">แก้ไขข้อมูลเงินเดือน</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editForm">
                <div class="modal-body">
                    <input type="hidden" id="edit-salary-id" name="salary_id">
                    <div class="form-group">
                        <label for="edit-salary">เงินเดือน</label>
                        <input type="number" class="form-control" id="edit-salary" name="salary" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-ot">OT</label>
                        <input type="number" class="form-control" id="edit-ot" name="ot" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-social_security">ประกันสังคม</label>
                        <input type="number" class="form-control" id="edit-social_security" name="social_security" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-other">อื่นๆ</label>
                        <input type="number" class="form-control" id="edit-other" name="other" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                    <button type="submit" class="btn btn-primary">บันทึกการแก้ไข</button>
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
                emptyTable: "กรุณาเลือก เดือน และปี ก่อนดูข้อมูลเงินเดือน",
                lengthMenu: "แสดง _MENU_ แถวต่อหน้า",
                info: "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
                infoEmpty: "แสดง 0 ถึง 0 จาก 0 แถว",
                infoFiltered: "(กรองข้อมูล _MAX_ ทุกแถว)",
                search: "ค้นหา:",
                zeroRecords: "ไม่พบข้อมูลที่ตรงกัน"
            },
            drawCallback: function() {
                // เรียกใช้ฟังก์ชันนี้ทุกครั้งที่ DataTables วาดตารางใหม่
                addEventListener();
            }
        });

        function addEventListener() {
            $('.edit-salary').off('click').on('click', function() {
                var salaryId = $(this).data('salary_id');
                var salary = $(this).data('salary');
                var ot = $(this).data('ot');
                var socialSecurity = $(this).data('social_security');
                var other = $(this).data('other');

                $('#edit-salary-id').val(salaryId);
                $('#edit-salary').val(salary);
                $('#edit-ot').val(ot);
                $('#edit-social_security').val(socialSecurity);
                $('#edit-other').val(other);

                $('#editModal').modal('show');
            });

            $('.delete-salary').off('click').on('click', function() {
                var salaryId = $(this).data('salary_id');
                var index = $(this).data('index');

                Swal.fire({
                    title: 'คุณแน่ใจหรือไม่?',
                    text: "คุณต้องการลบเงินเดือนลำดับที่ " + index + " หรือไม่?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'ใช่',
                    cancelButtonText: 'ยกเลิก'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'index.php?page=employee-salary&action=deleteSalary',
                            method: 'POST',
                            data: {
                                salary_id: salaryId
                            },
                            dataType: 'json',
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'ลบสำเร็จ',
                                        text: 'ลบเงินเดือนลำดับที่ ' + index + ' เรียบร้อยแล้ว!',
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
                url: 'index.php?page=employee-salary&action=updateSalary',
                method: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'สำเร็จ',
                            text: 'แก้ไขข้อมูลเงินเดือนสำเร็จ',
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