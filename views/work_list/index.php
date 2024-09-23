<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header d-flex align-items-center py-3">
            <i class="fa fa-list-ul" aria-hidden="true"></i>&nbsp; รายการปฏิบัติงาน
            <button type="button" class="btn btn-warning bg-gradient-purple ml-auto" onclick="window.open('index.php?page=user&action=create', '_parent')">เพิ่มผู้ใช้</button>
        </div>

        <div class="card-body">
            <div class="card border h-100">
                <table class="table table-bordered table-striped" id="myTable">
                    <thead>
                        <tr>
                            <th scope="col">ลำดับ</th>
                            <th scope="col">ชื่อโฟรเดอร์</th>
                            <th scope="col">จำนวนไฟล์</th>
                            <th scope="col">วันที่รายงาน</th>
                            <th scope="col">ดูรายงาน</th>
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
                                    <a href="<?= "index.php?page=work-list&action=view&folder=" . $folder['name'] ?>" class="btn btn-sm btn-outline-primary">ดูรายงาน</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    let table = new DataTable('#myTable');
</script>