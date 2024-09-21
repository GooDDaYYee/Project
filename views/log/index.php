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
                <table class="table table-bordered table-striped">
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
                        <?php foreach ($data['logs'] as $i => $log): ?>
                            <tr>
                                <td scope="row"><span class="to_file"><?= $i + 1 ?></span></td>
                                <td><span class="to_file"><?= htmlspecialchars($log['log_status']) ?></span></td>
                                <td><span class="to_file"><?= htmlspecialchars($log['log_detail']) ?></span></td>
                                <td><span class="to_file"><?= htmlspecialchars($log['employee_name'] ?? 'ไม่พบข้อมูลพนักงาน') ?></span></td>
                                <td><span class="to_file"><?= htmlspecialchars($log['log_date']) ?></span></td>
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

        // Initial page load
        showPage(1);
    });
</script>