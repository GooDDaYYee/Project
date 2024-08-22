<?php
if ($_SESSION["lv"] == 0) {
?>
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header d-flex justify-content-between align-items-center py-3">
                <i class="fa fa-list-ul" aria-hidden="true"></i>&nbsp;Log
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
                                <th scope="col">สถานะ</th>
                                <th scope="col">รายละเอียด</th>
                                <th scope="col">ผู้ใช้</th>
                                <th scope="col">วันที่</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include('connect.php');
                            $strsql = "SELECT log.log_status, log.log_detail, log.user_id, log.log_date, employee.employee_name 
                                   FROM log 
                                   LEFT JOIN users ON log.user_id = users.user_id
                                   LEFT JOIN employee ON users.employee_id = employee.employee_id 
                                   ORDER BY log.log_date DESC";

                            try {
                                $stmt = $con->prepare($strsql);
                                $stmt->execute();
                                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                $rowcount = count($result);

                                if ($rowcount > 0) {
                                    $i = 1;
                                    foreach ($result as $rs) {
                                        $employee_name = $rs['employee_name'] ? $rs['employee_name'] : 'ไม่พบข้อมูลพนักงาน';
                            ?>
                                        <tr>
                                            <th scope="row"><i class="to_file"><?php echo $i; ?></i></th>
                                            <td><i class="to_file"><?php echo $rs['log_status']; ?></i></td>
                                            <td><i class="to_file"><?php echo $rs['log_detail']; ?></i></td>
                                            <td><i class="to_file"><?php echo $employee_name; ?></i></td>
                                            <td><i class="to_file"><?php echo $rs['log_date']; ?></i></td>
                                        </tr>
                            <?php
                                        $i++;
                                    }
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
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
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
        });
    </script>

<?php
} else {
    echo '<script>
    window.location.href = "index.php?page=' . base64_encode('home') . '";
    </script>';
}
?>