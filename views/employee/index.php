<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header d-flex align-items-center py-3">
            <i class="fa fa-list-ul" aria-hidden="true"></i>&nbsp;จัดการข้อมูลพนักงาน
        </div>

        <div class="card-body">
            <div class="card border h-100">
                <table class="table table-bordered table-striped" id="myTable">
                    <thead>
                        <tr>
                            <th>ลำดับ</th>
                            <th>ชื่อ</th>
                            <th>นามสกุล</th>
                            <th>อายุ</th>
                            <th>เบอร์โทร</th>
                            <th>อีเมล</th>
                            <th>ตำแหน่ง</th>
                            <th>สถานะ</th>
                            <th>การดำเนินการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($data['employees']) > 0) {
                            foreach ($data['employees'] as $i => $employee): ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td><?= htmlspecialchars($employee['employee_name']) ?></td>
                                    <td><?= htmlspecialchars($employee['employee_lastname']) ?></td>
                                    <td><?= htmlspecialchars($employee['employee_age']) ?></td>
                                    <td><?= htmlspecialchars($employee['employee_phone']) ?></td>
                                    <td><?= htmlspecialchars($employee['employee_email']) ?></td>
                                    <td><?= $this->getPositionName($employee['employee_position']) ?></td>
                                    <td><?= $this->getStatusName($employee['employee_status']) ?></td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-outline-primary edit-employee" data-id="<?= $employee['employee_id'] ?>">แก้ไข</button>
                                        <button type="button" class="btn btn-sm btn-outline-danger delete-employee" data-id="<?= $employee['employee_id'] ?>" data-index="<?= $i + 1 ?>">ลบ</button>
                                    </td>
                                </tr>
                        <?php endforeach;
                        } else {
                            echo "<tr><td colspan='8'>test</td></tr>";
                        } ?>

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
                    <h5 class="modal-title" id="editModalLabel">แก้ไขข้อมูลพนักงาน</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="edit-employee-id" name="employee_id">
                    <div class="form-group">
                        <label for="edit-employee-name">ชื่อ</label>
                        <input type="text" class="form-control" id="edit-employee-name" name="employee_name" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-employee-lastname">นามสกุล</label>
                        <input type="text" class="form-control" id="edit-employee-lastname" name="employee_lastname" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-employee-age">อายุ</label>
                        <input type="number" class="form-control" id="edit-employee-age" name="employee_age" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-employee-phone">เบอร์โทร</label>
                        <input type="text" class="form-control" id="edit-employee-phone" name="employee_phone" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-employee-email">อีเมล</label>
                        <input type="email" class="form-control" id="edit-employee-email" name="employee_email" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-employee-position">ตำแหน่ง</label>
                        <select class="form-control" id="edit-employee-position" name="employee_position" required>
                            <option value="0">แอดมิน</option>
                            <option value="1">เจ้าของ</option>
                            <option value="2">พนักงานเอกสาร</option>
                            <option value="3">พนักงานปฏิบัติ</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit-employee-status">สถานะการทำงาน</label>
                        <select class="form-control" id="edit-employee-status" name="employee_status" required>
                            <option value="1">ทำงานอยู่</option>
                            <option value="0">ลาออก</option>
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
    let table = new DataTable('#myTable');
</script>