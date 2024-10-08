<?php
if ($_SESSION["lv"] == 0 || $_SESSION["lv"] == 1) {
?>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- List table -->
        <div class="card shadow mb-4">
            <div class="card-header d-flex justify-content-between align-items-center py-3">
                <i class="fa fa-list-ul" aria-hidden="true"></i>&nbsp;จัดการเงินเดือน
                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control" id="search" aria-label="Small" aria-describedby="inputGroup-sizing-sm" placeholder="ค้นหาข้อมูล">
                    </div>
                </form>
            </div>

            <div class="card-body">
                <div class="card border h-100">
                    <table class="table table-striped">
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
                                <th scope="col"> </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include('connect.php');
                            $strsql = "SELECT * FROM employee ORDER BY employee_date ASC";

                            try {
                                $stmt = $con->prepare($strsql);
                                $stmt->execute();
                                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                $rowcount = count($result);

                                if ($rowcount > 0) {
                                    $i = 1;
                                    foreach ($result as $rs) {
                            ?>
                                        <tr>
                                            <th scope="row"><i class="to_file"><?php echo $i; ?></i></th>
                                            <td><i class="to_file"><?php echo $rs['employee_name']; ?></i></td>
                                            <td><i class="to_file"><?php echo $rs['employee_lastname']; ?></i></td>
                                            <td><i class="to_file"><?php echo $rs['employee_age']; ?></i></td>
                                            <td><i class="to_file"><?php echo $rs['employee_phone']; ?></i></td>
                                            <td><i class="to_file"><?php echo $rs['employee_email']; ?></i></td>
                                            <td><i class="to_file"><?php
                                                                    if ($rs['employee_position'] == 0) {
                                                                        echo "แอดมิน";
                                                                    } elseif ($rs['employee_position'] == 1) {
                                                                        echo "เจ้าของ";
                                                                    } elseif ($rs['employee_position'] == 2) {
                                                                        echo "พนักงานเอกสาร";
                                                                    } elseif ($rs['employee_position'] == 3) {
                                                                        echo "พนักงานปฏิบัติ";
                                                                    } else {
                                                                        echo "ไม่มีข้อมูล";
                                                                    }
                                                                    ?></i></td>
                                            <td><i class="to_file"><?php
                                                                    if ($rs['employee_status'] == 0) {
                                                                        echo "ลาออก";
                                                                    } elseif ($rs['employee_status'] == 1) {
                                                                        echo "ทำงานอยู่";
                                                                    } else {
                                                                        echo "ไม่มีข้อมูล";
                                                                    }
                                                                    ?></i></td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#editModal" data-id="<?php echo $rs['employee_id']; ?>" data-name="<?php echo $rs['employee_name']; ?>"
                                                        data-lastname="<?php echo $rs['employee_lastname']; ?>" data-age="<?php echo $rs['employee_age']; ?>" data-phone="<?php echo $rs['employee_phone']; ?>" data-email="<?php echo $rs['employee_email']; ?>"
                                                        data-position="<?php echo $rs['employee_position']; ?>" data-status="<?php echo $rs['employee_status']; ?>">แก้ไข</button>
                                                    <button type="button" class="btn btn-outline-danger" onclick="confirmDelete('<?php echo $i; ?>','<?php echo $rs['employee_id']; ?>')">ลบ</button>
                                                </div>
                                            </td>
                                        </tr>
                            <?php
                                        $i++;
                                    }
                                } else {
                                    echo "<tr><td colspan='9'>ไม่พบข้อมูล</td></tr>";
                                }
                            } catch (PDOException $e) {
                                echo "Error: " . $e->getMessage();
                            }

                            $con = null;
                            ?>
                        </tbody>
                    </table>
                    &nbsp;
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
            <form id="editForm" method="POST">
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
                        <input type="text" class="form-control" id="edit-employee-name" name="employee_name">
                    </div>
                    <div class="form-group">
                        <label for="edit-employee-lastname">นามสกุล</label>
                        <input type="text" class="form-control" id="edit-employee-lastname" name="employee_lastname">
                    </div>
                    <div class="form-group">
                        <label for="edit-employee-age">อายุ</label>
                        <input type="number" class="form-control" id="edit-employee-age" name="employee_age">
                    </div>
                    <div class="form-group">
                        <label for="edit-employee-phone">เบอร์โทร</label>
                        <input type="text" class="form-control" id="edit-employee-phone" name="employee_phone">
                    </div>
                    <div class="form-group">
                        <label for="edit-employee-email">อีเมล</label>
                        <input type="email" class="form-control" id="edit-employee-email" name="employee_email">
                    </div>
                    <div class="form-group">
                        <label for="edit-employee-position">ตำแหน่ง</label>
                        <select class="form-control" id="edit-employee-position" name="employee_position">
                            <option value="0">แอดมิน</option>
                            <option value="1">เจ้าของ</option>
                            <option value="2">พนักงานเอกสาร</option>
                            <option value="3">พนักงานปฏิบัติ</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit-employee-status">สถานะการทำงาน</label>
                        <select class="form-control" id="edit-employee-status" name="employee_status">
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
        // sweetalert delete salary
        function confirmDelete(i, employee_id) {
            Swal.fire({
                title: 'คุณแน่ใจหรือไม่?',
                html: "คุณต้องการลบข้อมูลพนักงานลำดับที่ " + i + " หรือไม่? <br>!! คำเตือนหากลบข้อมูลพนักงานจะลบทั้งข้อมูลผู้ใช้ด้วย !!",
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
                        url: "employee/delete_employee.php?employee_id=" + employee_id,
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'ลบสำเร็จ',
                                text: 'ลบเงินเดือนลำดับที่ ' + i + ' เรียบร้อยแล้ว!',
                            }).then(function() {
                                window.location.href = "index.php?page=" + btoa('employee/list_employee');
                            });
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'ไม่สำเร็จ',
                                text: 'ลบเงินเดือนลำดับที่ ' + i + ' ไม่สำเร็จ!',
                            });
                        }
                    });
                }
            });
        }

        $(document).ready(function() {
            var rowsPerPage = 10;
            var totalRows = $('tbody tr').length;
            var totalPages = Math.ceil(totalRows / rowsPerPage);
            var maxVisiblePages = 5;

            function renderPagination(currentPage) {
                var startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
                var endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);

                if (endPage - startPage < maxVisiblePages - 1) {
                    startPage = Math.max(1, endPage - maxVisiblePages + 1);
                }

                $('.pagination').empty();
                if (startPage > 1) {
                    $('.pagination').append('<li class="page-item"><a class="page-link" href="#" data-page="1">&laquo; หน้าแรก</a></li>');
                    $('.pagination').append('<li class="page-item"><a class="page-link" href="#" data-page="' + (startPage - 1) + '">&lsaquo;</a></li>');
                }
                for (var i = startPage; i <= endPage; i++) {
                    $('.pagination').append('<li class="page-item ' + (i === currentPage ? 'active' : '') + '"><a class="page-link" href="#" data-page="' + i + '">' + i + '</a></li>');
                }
                if (endPage < totalPages) {
                    $('.pagination').append('<li class="page-item"><a class="page-link" href="#" data-page="' + (endPage + 1) + '">&rsaquo;</a></li>');
                    $('.pagination').append('<li class="page-item"><a class="page-link" href="#" data-page="' + totalPages + '">หน้าสุดท้าย &raquo;</a></li>');
                }
            }

            function showPage(pageNumber) {
                var startRow = (pageNumber - 1) * rowsPerPage;
                var endRow = startRow + rowsPerPage;

                $('tbody tr').hide();
                $('tbody tr').slice(startRow, endRow).show();
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

            // sweetalert editForm
            $('#editForm').on('submit', function(e) {
                e.preventDefault();
                var form = $(this);

                $.ajax({
                    type: "POST",
                    url: 'employee/update_employee.php', // ตรวจสอบ URL ว่าถูกต้อง
                    data: form.serialize(),
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'สำเร็จ',
                            text: 'แก้ไขข้อมูลพนักงานสำเร็จ',
                        }).then(function() {
                            window.location.href = "index.php?page=" + btoa('employee/list_employee');
                        });
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'ไม่สำเร็จ',
                            text: 'แก้ไขข้อมูลพนักงานไม่สำเร็จ!',
                        });
                    }
                });
            });



            $('#editModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var name = button.data('name');
                var lastname = button.data('lastname');
                var age = button.data('age');
                var phone = button.data('phone');
                var email = button.data('email');
                var position = button.data('position');
                var status = button.data('status');

                var modal = $(this);
                modal.find('#edit-employee-id').val(id);
                modal.find('#edit-employee-name').val(name);
                modal.find('#edit-employee-lastname').val(lastname);
                modal.find('#edit-employee-age').val(age);
                modal.find('#edit-employee-phone').val(phone);
                modal.find('#edit-employee-email').val(email);
                modal.find('#edit-employee-position').val(position);
                modal.find('#edit-employee-status').val(status);
            });
        });
    </script>

<?php
} else {
    echo '<script>
    window.location.href = "index.php?page=' . base64_encode('home') . '";
    </script>';
}
?>