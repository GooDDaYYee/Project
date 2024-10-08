<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header d-flex align-items-center py-3">
            <i class="fa fa-list-ul" aria-hidden="true"></i>&nbsp; รายการปฏิบัติงาน
        </div>

        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped" id="myTable">
                <thead>
                    <tr>
                        <th class="center">ลำดับ</th>
                        <th class="left">ชื่อโฟรเดอร์</th>
                        <th class="center">จำนวนไฟล์</th>
                        <th class="center">วันที่รายงาน</th>
                        <th class="center">ดูรายงาน</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['folders'] as $i => $folder): ?>
                        <tr>
                            <td class="center"><?= $i + 1 ?></span></td>
                            <td class="center"><?= htmlspecialchars($folder['name']) ?></td>
                            <td class="center"><?= htmlspecialchars($folder['fileCount']) ?></td>
                            <td class="center"><?= htmlspecialchars($folder['created']) ?></td>
                            <td>
                                <a href="<?= "index.php?page=work-list&action=view&folder=" . urlencode($folder['name']) ?>" class="btn btn-sm btn-outline-primary">ดูรายงาน</a>
                                <a href="<?= "index.php?page=work-list&action=delete&folder=" . urlencode($folder['name']) ?>" class="btn btn-sm btn-outline-danger delete-folder">ลบ</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
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
                addEventListener();
            }
        });

        function addEventListener() {
            document.querySelectorAll('.delete-folder').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const folderName = this.getAttribute('href').split('folder=')[1];
                    const deleteUrl = this.getAttribute('href');

                    Swal.fire({
                        title: 'คุณแน่ใจหรือไม่?',
                        html: `คุณต้องการลบโฟลเดอร์ "${decodeURIComponent(folderName)}" หรือไม่?<br>การดำเนินการนี้ไม่สามารถย้อนกลับได้!`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'ใช่, ลบเลย',
                        cancelButtonText: 'ยกเลิก'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Perform the deletion using AJAX
                            $.ajax({
                                url: deleteUrl,
                                method: 'GET',
                                success: function(response) {
                                    // Assuming the server returns a success status
                                    Swal.fire({
                                        title: 'ลบสำเร็จ!',
                                        text: `โฟลเดอร์ "${decodeURIComponent(folderName)}" ถูกลบเรียบร้อยแล้ว`,
                                        icon: 'success',
                                        confirmButtonText: 'ตกลง'
                                    }).then(() => {
                                        // Reload the page or update the table
                                        location.reload();
                                    });
                                },
                                error: function() {
                                    Swal.fire({
                                        title: 'เกิดข้อผิดพลาด!',
                                        text: 'ไม่สามารถลบโฟลเดอร์ได้ กรุณาลองใหม่อีกครั้ง',
                                        icon: 'error',
                                        confirmButtonText: 'ตกลง'
                                    });
                                }
                            });
                        }
                    });
                });
            });
        }
    });
</script>