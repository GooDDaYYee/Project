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
            <div class="row-sm-2">
                <select name="month" class="form-control" id="month">
                    <option value=" ">เดือน</option>
                    <?PHP $month = array("มกราคม ", "กุมภาพันธ์ ", "มีนาคม ", "เมษายน ", "พฤษภาคม ", "มิถุนายน ", "กรกฎาคม ", "สิงหาคม ", "กันยายน ", "ตุลาคม ", "พฤศจิกายน ", "ธันวาคม "); ?>
                    <?PHP for ($i = 0; $i < sizeof($month); $i++) { ?>
                        <option value="<?PHP echo $month[$i] ?>">
                            <?PHP echo $month[$i] ?></option>
                    <?PHP } ?>
                </select>
            </div>
            &nbsp;
            <div class="row-sm-2">
                <select name="year" class="form-control" id="year">
                    <option value=" ">ปี</option>
                    <?PHP for ($i = 0; $i <= 50; $i++) { ?>
                        <option value="1"><?PHP echo date("Y") - $i + 543 ?></option>
                    <?PHP } ?>
                </select>
            </div>
            &nbsp;
            <div class="row-sm-2">
                <button type="button" class="btn btn-warning bg-gradient-purple ml-auto" onclick="window.open('index.php?page=<?= base64_encode('employee\add_salary') ?>', '_parent')">เพิ่มเงินเดือน</button>
            </div>
        </div>

        <div class="card-body">
            <div class="card border h-100">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ลำดับ</th>
                            <th scope="col">ชื่อ</th>
                            <th scope="col">นามสกุล</th>
                            <th scope="col">สถานะ</th>
                            <th scope="col">เงินเดือน</th>
                            <th scope="col">OT</th>
                            <th scope="col">อื่นๆ</th>
                            <th scope="col"> </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include('connect.php');
                        $strsql = "SELECT * FROM salary_detail ORDER BY salary_detail_id ASC";

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
                                        <td><i class="to_file"><?php
                                                                if ($rs['employee_id'] == 0) {
                                                                    echo "ลาออก";
                                                                } else {
                                                                    echo "ทำงานอยู่";
                                                                }
                                                                ?></i></td>
                                        <td>
                                        <td><i class="to_file"><?php echo $rs['employee_lastname']; ?></i></td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#editModal">แก้ไข</button>
                                            <button type="button" class="btn btn-outline-danger" onclick="confirmDelete('<?php echo $i; ?>','<?php echo $rs['employee_id']; ?>')">ลบ</button>
                                        </div>
                                        </td>
                                    </tr>
                        <?php
                                    $i++;
                                }
                            } else {
                                echo "<tr><td colspan='8'>ไม่พบข้อมูล</td></tr>";
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
        <form id="editForm" action="employee/update_employee.php" method="POST">
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
                    <label for="edit-employee-salary">เงินเดือน</label>
                    <input type="number" class="form-control" id="edit-employee-salary" name="employee_salary">
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
    function confirmDelete(i, employee_id) {
        if (confirm("คุณแน่ใจหรือไม่ที่ต้องการลบข้อมูลพนักงานลำดับที่ " + i + " นี้?")) {
            window.location.href = 'employee/delete_employee.php?employee_id=' + employee_id;
        }
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

        $('#editModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var name = button.data('name');
            var lastname = button.data('lastname');
            var age = button.data('age');
            var phone = button.data('phone');
            var email = button.data('email');
            var position = button.data('position');
            var salary = button.data('salary');

            var modal = $(this);
            modal.find('#edit-employee-id').val(id);
            modal.find('#edit-employee-name').val(name);
            modal.find('#edit-employee-lastname').val(lastname);
            modal.find('#edit-employee-age').val(age);
            modal.find('#edit-employee-phone').val(phone);
            modal.find('#edit-employee-email').val(email);
            modal.find('#edit-employee-position').val(position);
            modal.find('#edit-employee-salary').val(salary);
        });
    });
</script>