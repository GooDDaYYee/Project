<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between align-items-center py-3">
            <i class="fa fa-list-ul" aria-hidden="true"></i>&nbsp; รายการปฏิบัติงาน
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
                            <th scope="col">ชื่อโฟรเดอร์</th>
                            <th scope="col">จำนวนไฟล์</th>
                            <th scope="col">วันที่รายงาน</th>
                            <th scope="col">ดูรายงาน</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['folders'] as $i => $folder): ?>
                            <tr>
                                <td scope="row"><span class="to_file"><?= $i + 1 ?></span></td>
                                <td><span class="to_file"><?= htmlspecialchars($folder['name']) ?></span></td>
                                <td><span class="to_file"><?= htmlspecialchars($folder['fileCount']) ?></span></td>
                                <td><span class="to_file"><?= htmlspecialchars($folder['created']) ?></span></td>
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