<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header d-flex align-items-center py-3">
            <i class="fa fa-list-ul" aria-hidden="true"></i>&nbsp;จัดการผู้ใช้
            <button type="button" class="btn btn-warning bg-gradient-purple ml-auto" onclick="window.open('index.php?page=user&action=create', '_parent')">เพิ่มผู้ใช้</button>
        </div>

        <div class="card-body">
            <div class="card border h-100">
                <table class="table table-bordered table-striped table-responsive" id="myTable">
                    <thead>
                        <tr>
                            <th>ลำดับ</th>
                            <th>ชื่อผู้ใช้</th>
                            <th>ประเภทผู้ใช้</th>
                            <th>สถานะ</th>
                            <th>การดำเนินการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['users'] as $i => $user): ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td><?= htmlspecialchars($user['username']) ?></span></td>
                                <td><?= $this->getLevelName($user['lv']) ?></td>
                                <td><?= $this->getStatusName($user['status']) ?></td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-outline-primary edit-user" data-id="<?= $user['user_id'] ?>" data-username="<?= htmlspecialchars($user['username']) ?>" data-lv="<?= $user['lv'] ?>" data-status="<?= $user['status'] ?>">แก้ไข</button>
                                    <button type="button" class="btn btn-sm btn-outline-danger delete-user" data-id="<?= $user['user_id'] ?>" data-username="<?= htmlspecialchars($user['username']) ?>">ลบ</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
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

        let table = new DataTable('#myTable');

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
    });
</script>