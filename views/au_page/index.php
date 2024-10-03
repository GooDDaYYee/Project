<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header d-flex align-items-center py-3">
            <i class="fa fa-list-ul" aria-hidden="true"></i>&nbsp;แก้ไข AU
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped" id="myTable">
                <thead>
                    <tr>
                        <th>AU</th>
                        <th>Detail</th>
                        <th>Type</th>
                        <th>Price</th>
                        <th>Company</th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody style="font-size: 12;">
                    <?php foreach ($data['au_all'] as $au_all): ?>
                        <tr>
                            <td style="width: 10%;"><?= htmlspecialchars($au_all['au_id']) ?></td>
                            <td style="text-align: left; width: 60%;"><?= htmlspecialchars($au_all['au_detail']) ?></td>
                            <td><?= htmlspecialchars($au_all['au_type']) ?></td>
                            <td><?= htmlspecialchars($au_all['au_price']) ?></td>
                            <td><?= htmlspecialchars($au_all['au_company']) ?></td>
                            <td>
                                <button type="button" class="btn btn-sm btn-outline-primary edit-au_all"
                                    data-id="<?= $au_all['au_id'] ?>"
                                    data-detail="<?= $au_all['au_detail'] ?>"
                                    data-type="<?= $au_all['au_type'] ?>"
                                    data-price="<?= $au_all['au_price'] ?>"
                                    data-company="<?= $au_all['au_company'] ?>">แก้ไข</button>
                                <button type="button" class="btn btn-sm btn-outline-danger delete-user" data-id="<?= $au_all['au_id'] ?>">ลบ</button>
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
            <form id="editForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">แก้ไข AU</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label for="edit-au">AU</label>
                                <input type="text" class="form-control" id="edit-au" name="edit-au" placeholder="AU">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="edit-detail">Detail</label>
                                <textarea id="edit-detail" name="edit-detail" class="form-control" rows="6"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="edit-type">Type</label>
                                <input type="text" class="form-control" id="edit-type" name="edit-type" placeholder="Type">
                            </div>
                            <div class="col">
                                <label for="edit-price">Price</label>
                                <input type="number" class="form-control" id="edit-price" name="edit-price" placeholder="Price" step="any">
                            </div>
                            <div class="col">
                                <label for="edit-company">Company</label>
                                <input type="text" class="form-control" id="edit-company" name="edit-company" placeholder="Company">
                            </div>
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
        let table = new DataTable('#myTable', {
            pageLength: 10,
            language: {
                url: "assets/js/Thai.json"
            },
            drawCallback: function() {
                // เรียกใช้ฟังก์ชันนี้ทุกครั้งที่ DataTables วาดตารางใหม่
                addEventListener();
            }
        });

        function addEventListener() {
            $('.edit-au_all').off('click').on('click', function() {
                var EditId = $(this).data('id');
                var EditDetail = $(this).data('detail');
                var EditType = $(this).data('type');
                var EditPrice = $(this).data('price');
                var EditCompany = $(this).data('company');

                $('#edit-au').val(EditId);
                $('#edit-detail').val(EditDetail);
                $('#edit-type').val(EditType);
                $('#edit-price').val(EditPrice);
                $('#edit-company').val(EditCompany);

                $('#editModal').modal('show');
            });
            $('.delete-user').off('click').on('click', function() {
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
                            url: 'index.php?page=user&action=deleteUser',
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
        }



        $('#editForm').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: 'index.php?page=au-page&action=updateAu',
                method: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'สำเร็จ',
                            text: 'แก้ไขข้อมูล AU สำเร็จ',
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