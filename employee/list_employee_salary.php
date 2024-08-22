<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- List table -->
    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between align-items-center py-3">
            <i class="fa fa-list-ul" aria-hidden="true"></i>&nbsp;จัดการเงินเดือน
            <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" method="GET" action="">
                <div class="input-group">
                    <input type="text" class="form-control" id="search" name="search" aria-label="Small" aria-describedby="inputGroup-sizing-sm" placeholder="ค้นหาข้อมูล">
                </div>
            </form>
            <div class="row-sm-2">
                <select name="month" class="form-control" id="month" onchange="filterResults()">
                    <option value="">เดือน</option>
                    <?php
                    $month = array("มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
                    for ($i = 0; $i < sizeof($month); $i++) {
                    ?>
                        <option value="<?php echo $month[$i] ?>" <?php if (isset($_GET['month']) && base64_decode($_GET['month']) == $month[$i]) echo 'selected'; ?>>
                            <?php echo $month[$i] ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            &nbsp;
            <div class="row-sm-2">
                <select name="year" class="form-control" id="year" onchange="filterResults()">
                    <option value="">ปี</option>
                    <?php for ($i = 0; $i <= 50; $i++) { ?>
                        <option value="<?php echo date("Y") - $i + 543 ?>" <?php if (isset($_GET['year']) && base64_decode($_GET['year']) == date("Y") - $i + 543) echo 'selected'; ?>>
                            <?php echo date("Y") - $i + 543 ?>
                        </option>
                    <?php } ?>
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
                            <th scope="col">เดือน</th>
                            <th scope="col">ปี</th>
                            <th scope="col">เงินเดือน</th>
                            <th scope="col">OT</th>
                            <th scope="col">อื่นๆ</th>
                            <th scope="col"> </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include('connect.php');

                        $sql_filter = "";
                        if (isset($_GET['month']) && $_GET['month'] != "" && isset($_GET['year']) && $_GET['year'] != "") {
                            $month = $_GET['month'];
                            $year = $_GET['year'];
                            $sql_filter = " WHERE salary.salary_date LIKE '$year-%" . sprintf('%02d', array_search($month, ["มกราคม ", "กุมภาพันธ์ ", "มีนาคม ", "เมษายน ", "พฤษภาคม ", "มิถุนายน ", "กรกฎาคม ", "สิงหาคม ", "กันยายน ", "ตุลาคม ", "พฤศจิกายน ", "ธันวาคม "]) + 1) . "-%'";
                        }
                        $strsql = "SELECT sd.*, s.salary, s.ot, s.other, e.employee_id, e.employee_status, 
                        DATE_FORMAT(s.salary_date, '%M') AS salary_month, 
                        DATE_FORMAT(s.salary_date, '%Y') AS salary_year 
                        FROM salary_detail sd
                        INNER JOIN salary s ON sd.salary_id = s.salary_id
                        INNER JOIN employee e ON sd.employee_id = e.employee_id"
                            . $sql_filter .
                            " ORDER BY sd.salary_detail_id ASC";

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
                                        <td><i class="to_file"><?php echo $rs['employee_status'] == 0 ? "ลาออก" : "ทำงานอยู่"; ?></i></td>
                                        <td><i class="to_file"><?php echo $rs['salary_month']; ?></i></td>
                                        <td><i class="to_file"><?php echo $rs['salary_year']; ?></i></td>
                                        <td><i class="to_file"><?php echo $rs['salary']; ?></i></td>
                                        <td><i class="to_file"><?php echo $rs['ot']; ?></i></td>
                                        <td><i class="to_file"><?php echo $rs['other']; ?></i></td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#editModal"
                                                    data-id="<?php echo $rs['salary_detail_id']; ?>"
                                                    data-salary="<?php echo $rs['salary']; ?>"
                                                    data-ot="<?php echo $rs['ot']; ?>"
                                                    data-other="<?php echo $rs['other']; ?>">แก้ไข</button>
                                                <button type="button" class="btn btn-outline-danger" onclick="confirmDelete('<?php echo $i; ?>','<?php echo $rs['employee_id']; ?>')">ลบ</button>
                                            </div>
                                        </td>
                                    </tr>
                        <?php
                                    $i++;
                                }
                            } else {
                                echo "<tr><td colspan='10'>ไม่พบข้อมูล</td></tr>";
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
        <form id="editForm" action="employee/update_salary.php" method="POST">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">แก้ไขข้อมูลเงินเดือน</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="edit-salary-id" name="salary_detail_id">
                <div class="form-group">
                    <label for="edit-salary">เงินเดือน</label>
                    <input type="number" class="form-control" id="edit-salary" name="salary">
                </div>
                <div class="form-group">
                    <label for="edit-ot">OT</label>
                    <input type="number" class="form-control" id="edit-ot" name="ot">
                </div>
                <div class="form-group">
                    <label for="edit-other">อื่นๆ</label>
                    <input type="number" class="form-control" id="edit-other" name="other">
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

    function filterResults() {
        var month = btoa($('#month').val()); // btoa() encodes to Base64
        var year = btoa($('#year').val()); // btoa() encodes to Base64
        window.location.href = "index.php?month=" + month + "&year=" + year;
    }


    $(document).ready(function() {
        var rowsPerPage = 10;
        var totalRows = $('tbody tr').length;
        var totalPages = Math.ceil(totalRows / rowsPerPage);
        var currentPage = 1;

        // Hide rows that should not be displayed
        $('tbody tr').hide();
        $('tbody tr').slice(0, rowsPerPage).show();

        // Generate pagination items
        for (var i = 1; i <= totalPages; i++) {
            $('.pagination').append('<li class="page-item"><a class="page-link" href="#">' + i + '</a></li>');
        }

        // Highlight the first page
        $('.pagination li:first').addClass('active');

        // Handle pagination click
        $('.pagination a').click(function(e) {
            e.preventDefault();
            $('.pagination li').removeClass('active');
            $(this).parent().addClass('active');
            currentPage = $(this).text();

            // Hide and show the correct rows
            $('tbody tr').hide();
            var start = (currentPage - 1) * rowsPerPage;
            var end = start + rowsPerPage;
            $('tbody tr').slice(start, end).show();
        });

        // Handle modal open with data
        $('#editModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var salary = button.data('salary');
            var ot = button.data('ot');
            var other = button.data('other');

            var modal = $(this);
            modal.find('#edit-salary-id').val(id);
            modal.find('#edit-salary').val(salary);
            modal.find('#edit-ot').val(ot);
            modal.find('#edit-other').val(other);
        });
    });
</script>