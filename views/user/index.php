<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between align-items-center py-3">
            <i class="fa fa-list-ul" aria-hidden="true"></i>&nbsp;จัดการผู้ใช้
            <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                <div class="input-group">
                    <input type="text" class="form-control" id="search" aria-label="Small" aria-describedby="inputGroup-sizing-sm" placeholder="ค้นหาข้อมูล">
                </div>
            </form>
            <button type="button" class="btn btn-warning bg-gradient-purple ml-auto" onclick="window.open('index.php?page=user&action=create', '_parent')">เพิ่มผู้ใช้</button>
        </div>

        <div class="card-body">
            <div class="card border h-100">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ลำดับ</th>
                            <th scope="col">ชื่อผู้ใช้</th>
                            <th scope="col">ประเภทผู้ใช้</th>
                            <th scope="col">สถานะ</th>
                            <th scope="col">การดำเนินการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['users'] as $i => $user): ?>
                            <tr>
                                <td scope="row"><span class="to_file"><?= $i + 1 ?></span></td>
                                <td><span class="to_file"><?= htmlspecialchars($user['username']) ?></span></td>
                                <td><span class="to_file"><?= $this->getLevelName($user['lv']) ?></span></td>
                                <td><span class="to_file"><?= $this->getStatusName($user['status']) ?></span></td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-outline-primary edit-user" data-id="<?= $user['user_id'] ?>" data-username="<?= htmlspecialchars($user['username']) ?>" data-lv="<?= $user['lv'] ?>" data-status="<?= $user['status'] ?>">แก้ไข</button>
                                    <button type="button" class="btn btn-sm btn-outline-danger delete-user" data-id="<?= $user['user_id'] ?>" data-username="<?= htmlspecialchars($user['username']) ?>">ลบ</button>
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
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-custom-size" role="document">
        <div class="modal-content">
            <form id="editForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">แก้ไขข้อมูลผู้ใช้</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="edit-user-id" name="user_id">
                    <div class="form-group">
                        <label for="edit-username">ชื่อผู้ใช้</label>
                        <input type="text" class="form-control" id="edit-username" name="username">
                    </div>
                    <div class="form-group">
                        <label for="edit-lv">ประเภทผู้ใช้</label>
                        <select class="form-control" id="edit-lv" name="lv">
                            <option value="0">แอดมิน</option>
                            <option value="1">เจ้าของ</option>
                            <option value="2">พนักงานเอกสาร</option>
                            <option value="3">พนักงานปฏิบัติ</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit-status">สถานะ</label>
                        <select class="form-control" id="edit-status" name="status">
                            <option value="0">แบน</option>
                            <option value="1">ปกติ</option>
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

        $('.edit-user').click(function() {
            var userId = $(this).data('id');
            var username = $(this).data('username');
            var lv = $(this).data('lv');
            var status = $(this).data('status');

            $('#edit-user-id').val(userId);
            $('#edit-username').val(username);
            $('#edit-lv').val(lv);
            $('#edit-status').val(status);

            $('#editModal').modal('show');
        });

        $('#editForm').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: 'index.php?page=user&action=update',
                method: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'สำเร็จ',
                            text: 'แก้ไขข้อมูลผู้ใช้สำเร็จ',
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

        $('.delete-user').click(function() {
            var userId = $(this).data('id');
            var username = $(this).data('username');

            Swal.fire({
                title: 'คุณแน่ใจหรือไม่?',
                html: "คุณต้องการลบผู้ใช้ " + username + " หรือไม่? <br>!! คำเตือนหากลบข้อมูลผู้ใช้ ข้อมูลพนักงานจะหายไปด้วย !!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'ใช่',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'index.php?page=user&action=delete',
                        method: 'POST',
                        data: {
                            user_id: userId
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'ลบสำเร็จ',
                                    text: 'ลบผู้ใช้ ' + username + ' เรียบร้อยแล้ว!',
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

        // Initial page load
        showPage(1);
    });
</script>