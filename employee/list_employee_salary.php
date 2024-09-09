<?php
include('connect.php');
?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- List table -->
    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between align-items-center py-3">
            <i class="fa fa-list-ul" aria-hidden="true"></i>&nbsp;จัดการเงินเดือน
            <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                <div class="input-group">
                    <input type="text" class="form-control" id="search" name="search" aria-label="Small" aria-describedby="inputGroup-sizing-sm" placeholder="ค้นหาข้อมูล">
                </div>
            </form>
            <form method="GET" action="" id="filterForm">
                <input type="hidden" name="page" value="<?php echo isset($_GET['page']) ? $_GET['page'] : base64_encode('home'); ?>" />
                <div class="row">
                    <div class="col-sm-6">
                        <select name="month" class="form-control" id="month" onchange="document.getElementById('filterForm').submit()">
                            <option value="1">เดือน</option>
                            <?php
                            $months = array("มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
                            for ($i = 0; $i < sizeof($months); $i++) {
                            ?>
                                <option value="<?php echo $i + 1 ?>" <?php echo isset($_GET['month']) && $_GET['month'] == $i + 1 ? 'selected' : '' ?>>
                                    <?php echo $months[$i] ?>
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
            &nbsp;
            &nbsp;
            <div class="row">
                <div class="col">
                    <button type="button" class="btn btn-warning bg-gradient-purple ml-auto" onclick="window.open('index.php?page=<?= base64_encode('employee\add_salary') ?>', '_parent')">เพิ่มเงินเดือน</button>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="card border h-100">
                <div id="table-container">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">ลำดับ</th>
                                <th scope="col">ชื่อ</th>
                                <th scope="col">นามสกุล</th>
                                <th scope="col">เงินเดือน</th>
                                <th scope="col">OT</th>
                                <th scope="col">ประกันสังคม</th>
                                <th scope="col">อื่นๆ</th>
                                <th scope="col">รวม</th>
                                <th scope="col"> </th>
                            </tr>
                        </thead>
                        <tbody>
                </div>
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
                <h5 class="modal-title" id="editModalLabel">แก้ไขข้อมูลเงินเดือน</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="edit-salary-id" name="salary_id">
                <div class="form-group">
                    <label for="edit-salary">เงินเดือน</label>
                    <input type="number" class="form-control" id="edit-salary" name="salary">
                </div>
                <div class="form-group">
                    <label for="edit-ot">OT</label>
                    <input type="number" class="form-control" id="edit-ot" name="ot">
                </div>
                <div class="form-group">
                    <label for="edit-social_security">ประกันสังคม</label>
                    <input type="number" class="form-control" id="edit-social_security" name="social_security">
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
    // sweetalert delete salary
    function confirmDelete(i, salary_id) {
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่?',
            text: "คุณต้องการลบเงินเดือนลำดับที่ " + i + " หรือไม่?",
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
                    url: "employee/delete_employee_salary.php?salary_id=" + salary_id,
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'ลบสำเร็จ',
                            text: 'ลบเงินเดือนลำดับที่ ' + i + ' เรียบร้อยแล้ว!',
                        }).then(function() {
                            window.location.href = "index.php?page=" + btoa('employee/list_employee_salary');
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

    function filterResults() {
        var month = $('#month').val();
        var year = $('#year').val();

        $.ajax({
            url: 'list_employee_salary.php',
            type: 'GET',
            data: {
                month: month,
                year: year
            },
            success: function(response) {
                $('#table-container').html(response); // โหลดข้อมูลใน table-container
            },
            error: function(xhr, status, error) {
                console.error('Error:', error); // ตรวจสอบว่ามีข้อผิดพลาดหรือไม่
            }
        });
    }

    $(document).ready(function() {
        filterResults();

        $('#search').on('keyup', function() {
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
                url: 'employee/update_salary.php',
                data: form.serialize(),
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'สำเร็จ',
                        text: 'แก้ไขข้อมูลเงินเดือนสำเร็จสำเร็จ',
                    }).then(function() {
                        window.location.href = "index.php?page=" + btoa('employee/list_employee_salary');
                    });
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'ไม่สำเร็จ',
                        text: 'การแก้ไขข้อมูลเงินเดือนไม่สำเร็จสำเร็จ!',
                    });
                }
            });
        });

        $('#editModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var salary_id = button.data('salary_id');
            var salary = button.data('salary');
            var ot = button.data('ot');
            var social_security = button.data('social_security');
            var other = button.data('other');

            var modal = $(this);
            modal.find('#edit-salary-id').val(salary_id);
            modal.find('#edit-salary').val(salary);
            modal.find('#edit-ot').val(ot);
            modal.find('#edit-social_security').val(social_security);
            modal.find('#edit-other').val(other);
        });
    });
</script>

<?php
// edit salary
if (isset($_GET['month']) && isset($_GET['year'])) {
    $month = $_GET['month'];
    $year = $_GET['year'];

    $gregorian_year = $year + 543;

    $sql_filter = " WHERE MONTH(s.salary_date) = :month AND YEAR(s.salary_date) = :year AND DAY(s.salary_date) = 1";
    $strsql = "SELECT s.*, 
               DATE_FORMAT(s.salary_date, '%M') AS salary_month,
               DATE_FORMAT(s.salary_date, '%Y') AS salary_year,
               e.employee_name, 
               e.employee_lastname 
               FROM salary s
               INNER JOIN employee e ON s.employee_id = e.employee_id"
        . $sql_filter . " ORDER BY s.salary_id ASC";

    $stmt = $con->prepare($strsql);
    $stmt->bindParam(':month', $month, PDO::PARAM_INT);
    $stmt->bindParam(':year', $gregorian_year, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $rowcount = count($result);

    if ($rowcount > 0) {
        $i = 1;
        foreach ($result as $rs) {
            echo '<tr>
                    <th scope="row">' . $i . '</th>
                    <td>' . $rs['employee_name'] . '</td>
                    <td>' . $rs['employee_lastname'] . '</td>
                    <td>' . $rs['salary'] . '</td>
                    <td>' . $rs['ot'] . '</td>
                    <td>' . $rs['social_security'] . '</td>
                    <td>' . $rs['other'] . '</td>
                    <td>' . $rs['total_salary'] . '</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#editModal"
                                data-salary_id="' . $rs['salary_id'] . '"
                                data-salary="' . $rs['salary'] . '"
                                data-ot="' . $rs['ot'] . '"
                                data-social_security="' . $rs['social_security'] . '"
                                data-other="' . $rs['other'] . '">แก้ไข</button>
                            <button type="button" class="btn btn-outline-danger"
                                onclick="confirmDelete(' . $i . ',' . $rs['salary_id'] . ')">ลบ</button>
                        </div>
                    </td>
                  </tr>';
            $i++;
        }
        echo '</tbody>
            </table>';
    } else {
        echo "<tr><td colspan='9'>ไม่พบข้อมูล</td></tr>";
    }
} else {
    echo "<tr><td colspan='9'>กรุณาเลือกเดือนและปี</td></tr>";
}
?>