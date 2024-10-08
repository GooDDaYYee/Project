<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header d-flex align-items-center py-3">
            <i class="fa fa-list-ul" aria-hidden="true"></i>&nbsp;Log
        </div>

        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped" id="myTable">
                <thead>
                    <tr>
                        <th class="center">ลำดับ</th>
                        <th class="center">สถานะ</th>
                        <th class="center">รายละเอียด</th>
                        <th class="center">ผู้ใช้</th>
                        <th scope="col" class="sortable" data-sort="date" class="center">วันที่</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['logs'] as $i => $log): ?>
                        <tr>
                            <td scope="row" class="center"><span><?= $i + 1 ?></span></td>
                            <td class="center"><?= htmlspecialchars($log['log_status']) ?></td>
                            <td style="width: 60%;" class="left"><?= htmlspecialchars($log['log_detail']) ?></td>
                            <td class="center"><?= htmlspecialchars($log['employee_name'] ?? 'ไม่พบข้อมูลพนักงาน') ?></td>
                            <td class="center"><?= htmlspecialchars($log['log_date']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    let table = new DataTable('#myTable', {
        pageLength: 10,
        language: {
            url: "assets/js/Thai.json"
        },
    });
</script>