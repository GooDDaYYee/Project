<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between align-items-center py-3">
            <i class="fa fa-list-ul" aria-hidden="true"></i>&nbsp;จัดการข้อมูลพนักงาน
            <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                <div class="input-group">
                    <input type="text" class="form-control" id="search" aria-label="Small" aria-describedby="inputGroup-sizing-sm" placeholder="ค้นหาข้อมูล">
                </div>
            </form>
        </div>

        <div class="card-body">
            <div class="card border h-100">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ลำดับ</th>
                            <th scope="col">ชื่อ</th>
                            <th scope="col">นามสกุล</th>
                            <th scope="col">อายุ</th>
                            <th scope="col">เบอร์โทร</th>
                            <th scope="col">อีเมล</th>
                            <th scope="col">ตำแหน่ง</th>
                            <th scope="col">สถานะ</th>
                            <th scope="col">การดำเนินการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['employees'] as $i => $employee): ?>
                            <tr>
                                <td scope="row"><span class="to_file"><?= $i + 1 ?></span></td>
                                <td><span class="to_file"><?= htmlspecialchars($employee['employee_name']) ?></span></td>
                                <td><span class="to_file"><?= htmlspecialchars($employee['employee_lastname']) ?></span></td>
                                <td><span class="to_file"><?= htmlspecialchars($employee['employee_age']) ?></span></td>
                                <td><span class="to_file"><?= htmlspecialchars($employee['employee_phone']) ?></span></td>
                                <td><span class="to_file"><?= htmlspecialchars($employee['employee_email']) ?></span></td>
                                <td><span class="to_file"><?= $this->getPositionName($employee['employee_position']) ?></span></td>
                                <td><span class="to_file"><?= $this->getStatusName($employee['employee_status']) ?></span></td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-outline-primary edit-employee" data-id="<?= $employee['employee_id'] ?>">แก้ไข</button>
                                    <button type="button" class="btn btn-sm btn-outline-danger delete-employee" data-id="<?= $employee['employee_id'] ?>" data-index="<?= $i + 1 ?>">ลบ</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="pagination-container">
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                            <!-- Pagination items will be dynamically generated here -->
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal" id="editModal">
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
                    <input type="text" class="form-control" id="edit-employee-phone" name="employee_phone" required>
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

<script>
    $(document).ready(function() {
        var rowsPerPage = 10;
        var $rows = $('tbody tr');
        var totalPages = Math.ceil($rows.length / rowsPerPage);

        function showPage(page) {
            var start = (page - 1) * rowsPerPage;
            var end = start + rowsPerPage;

            $rows.hide().slice(start, end).show();

            var $pagination = $('.pagination');
            $pagination.empty();

            var maxVisiblePages = 5;
            var startPage = Math.max(1, page - Math.floor(maxVisiblePages / 2));
            var endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);

            if (startPage > 1) {
                $pagination.append('<li class="page-item"><a class="page-link" href="#" data-page="1">&laquo; หน้าแรก</a></li>');
            }

            for (var i = startPage; i <= endPage; i++) {
                $pagination.append('<li class="page-item ' + (i === page ? 'active' : '') + '"><a class="page-link" href="#" data-page="' + i + '">' + i + '</a></li>');
            }

            if (endPage < totalPages) {
                $pagination.append('<li class="page-item"><a class="page-link" href="#" data-page="' + totalPages + '">หน้าสุดท้าย &raquo;</a></li>');
            }
        }

        $('.pagination').on('click', 'a', function(e) {
            e.preventDefault();
            showPage(parseInt($(this).data('page')));
        });

        $('#search').on('keyup', function() {
            var searchTerm = $(this).val().toLowerCase();
            $rows.each(function() {
                var rowText = $(this).text().toLowerCase();
                $(this).toggle(rowText.indexOf(searchTerm) > -1);
            });
        });

        $('.edit-employee').click(function() {
            var employeeId = $(this).data('id');
            // Fetch employee details and populate the form
            // You'll need to implement this AJAX call
        });

        $('#editForm').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: 'index.php?action=updateEmployee',
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

        $('.delete-employee').click(function() {
            var employeeId = $(this).data('id');
            var index = $(this).data('index');

            Swal.fire({
                title: 'คุณแน่ใจหรือไม่?',
                html: "คุณต้องการลบข้อมูลพนักงานลำดับที่ " + index + " หรือไม่? <br>!! คำเตือนหากลบข้อมูลพนักงานจะลบทั้งข้อมูลผู้ใช้ด้วย !!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'ใช่',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'index.php?action=deleteEmployee',
                        method: 'POST',
                        data: {
                            employee_id: employeeId
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'ลบสำเร็จ',
                                    text: 'ลบข้อมูลพนักงานลำดับที่ ' + index + ' เรียบร้อยแล้ว!',
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

        $('.edit-employee').click(function() {
            var employeeId = $(this).data('id');
            $.ajax({
                url: 'index.php?action=getEmployeeDetails',
                method: 'GET',
                data: {
                    employee_id: employeeId
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        var employee = response.employee;
                        $('#edit-employee-id').val(employee.employee_id);
                        $('#edit-employee-name').val(employee.employee_name);
                        $('#edit-employee-lastname').val(employee.employee_lastname);
                        $('#edit-employee-age').val(employee.employee_age);
                        $('#edit-employee-phone').val(employee.employee_phone);
                        $('#edit-employee-email').val(employee.employee_email);
                        $('#edit-employee-position').val(employee.employee_position);
                        $('#edit-employee-status').val(employee.employee_status);
                        $('#editModal').modal('show');
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'ไม่สำเร็จ',
                            text: 'ไม่สามารถดึงข้อมูลพนักงานได้',
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

        // Initial page load
        showPage(1);
    });
</script>