<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header d-flex align-items-center py-3">
            <i class="fa fa-list-ul" aria-hidden="true"></i>&nbsp;Log
        </div>

        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped" id="myTable">
                <thead>
                    <tr>
                        <th>ลำดับ</th>
                        <th>สถานะ</th>
                        <th>รายละเอียด</th>
                        <th>ผู้ใช้</th>
                        <th scope="col" class="sortable" data-sort="date">วันที่</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['logs'] as $i => $log): ?>
                        <tr>
                            <td scope="row"><span><?= $i + 1 ?></span></td>
                            <td><?= htmlspecialchars($log['log_status']) ?></td>
                            <td><?= htmlspecialchars($log['log_detail']) ?></td>
                            <td><?= htmlspecialchars($log['employee_name'] ?? 'ไม่พบข้อมูลพนักงาน') ?></td>
                            <td><?= htmlspecialchars($log['log_date']) ?></td>
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
            emptyTable: "กรุณาเลือก เดือน และปี ก่อนดูข้อมูลเงินเดือน",
            lengthMenu: "แสดง _MENU_ แถวต่อหน้า",
            info: "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
            infoEmpty: "แสดง 0 ถึง 0 จาก 0 แถว",
            infoFiltered: "(กรองข้อมูล _MAX_ ทุกแถว)",
            search: "ค้นหา:",
        }
    });
</script>