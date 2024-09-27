<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header d-flex align-items-center py-3">
            <i class="fa fa-list-ul" aria-hidden="true"></i>&nbsp; รายการปฏิบัติงาน
        </div>

        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped" id="myTable">
                <thead>
                    <tr>
                        <th>ลำดับ</th>
                        <th>ชื่อโฟรเดอร์</th>
                        <th>จำนวนไฟล์</th>
                        <th>วันที่รายงาน</th>
                        <th>ดูรายงาน</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['folders'] as $i => $folder): ?>
                        <tr>
                            <td><?= $i + 1 ?></span></td>
                            <td><?= htmlspecialchars($folder['name']) ?></td>
                            <td><?= htmlspecialchars($folder['fileCount']) ?></td>
                            <td><?= htmlspecialchars($folder['created']) ?></td>
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
    let table = new DataTable('#myTable', {
        language: {
            emptyTable: "ไม่มีข้อมูล",
            lengthMenu: "แสดง _MENU_ แถวต่อหน้า",
            info: "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
            infoEmpty: "แสดง 0 ถึง 0 จาก 0 แถว",
            infoFiltered: "(กรองข้อมูล _MAX_ ทุกแถว)",
            search: "ค้นหา:",
            zeroRecords: "ไม่พบข้อมูลที่ตรงกัน"
        }
    });

    // Add confirmation for folder deletion
    document.querySelectorAll('.delete-folder').forEach(button => {
        button.addEventListener('click', function(e) {
            if (!confirm('คุณแน่ใจหรือไม่ว่าต้องการลบโฟลเดอร์นี้?')) {
                e.preventDefault();
            }
        });
    });
</script>