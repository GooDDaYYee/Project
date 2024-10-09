<?php
$strsql = "SELECT * FROM employee WHERE employee_status=1";

try {
    $stmt = $this->db->prepare($strsql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $rowcount = count($result);
?>
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header d-flex justify-content-between align-items-center py-3">
                <div>
                    <i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;เพิ่มเงินเดือน
                </div>
            </div>
            <form id="add_salary" method="post">
                <div class="row">
                    <div class="col-lg">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h2 text-gray-900 mb-4">เพิ่มเงินเดือน</h1>
                            </div>
                            <hr>
                            <div class="form-group">
                                <h4>เลือกพนักงาน</h4>
                                <select class="form-control col-3" id="employee_id" name="employee_id">
                                    <?php
                                    if ($rowcount > 0) {
                                        foreach ($result as $rs) {
                                    ?>
                                            <option value="<?php echo $rs['employee_id']; ?>"><?php echo $rs['employee_name']; ?> <?php echo $rs['employee_lastname']; ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <h4>เงินเดือน</h4>
                                    <input type="number" id="salary" name="salary" class="form-control form-control-user" placeholder="เงินเดือน" step="0.01" min="0" required="">
                                </div>
                                <div class="col-sm-3">
                                    <h4>OT</h4>
                                    <input type="number" id="ot" name="ot" class="form-control form-control-user" placeholder="OT" step="0.01" min="0" required="">
                                </div>
                                <div class="col-sm-3">
                                    <h4>ประกันสังคม(หักในเงินเดือน)</h4>
                                    <input type="number" id="social_security" name="social_security" class="form-control form-control-user" placeholder="ประกันสังคม" step="0.01" min="0" required="">
                                </div>
                                <div class="col-sm-3">
                                    <h4>อื่นๆ</h4>
                                    <input type="number" id="other" name="other" class="form-control form-control-user" placeholder="อื่นๆ" step="0.01" min="0" required="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2">
                                    <h4>เดือน</h4>
                                    <select name="month" class="form-control" id="month">
                                        <option value="0">เดือน</option>
                                        <?PHP $month = array("มกราคม ", "กุมภาพันธ์ ", "มีนาคม ", "เมษายน ", "พฤษภาคม ", "มิถุนายน ", "กรกฎาคม ", "สิงหาคม ", "กันยายน ", "ตุลาคม ", "พฤศจิกายน ", "ธันวาคม "); ?>
                                        <?PHP for ($i = 0; $i < sizeof($month); $i++) { ?>
                                            <option value="<?PHP echo $month[$i] ?>">
                                                <?PHP echo $month[$i] ?></option>
                                        <?PHP } ?>
                                    </select>
                                </div>
                                &nbsp;
                                <div class="col-sm-2">
                                    <h4>ปี</h4>
                                    <select name="year" class="form-control" id="year">
                                        <option value="0">ปี</option>
                                        <?PHP for ($i = 0; $i <= 50; $i++) { ?>
                                            <option value="<?PHP echo date("Y") - $i + 543 ?>"><?PHP echo date("Y") - $i + 543 ?></option>
                                        <?PHP } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row-md-auto mt-md-3">
                                <button class='btn btn-warning bg-gradient-purple btn-user btn-block col-sm-3 container' type='submit' id="submitButton">
                                    <i class="fa fa-save"></i> เพิ่มข้อมูล
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(function() {
            $('#add_salary').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "index.php?page=employee-salary&action=create",
                    data: $(this).serialize(),
                    success: function(response) {
                        const data = JSON.parse(response);
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'สำเร็จ',
                                text: 'เพิ่มข้อมูลเงินเดือนสำเร็จ',
                            }).then(function() {
                                window.location.href = "index.php?page=employee-salary";
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'ไม่สำเร็จ',
                                text: data.message,
                            });
                        }
                    },
                    error: function(xhr) {
                        const data = JSON.parse(xhr.responseText);
                        Swal.fire({
                            icon: 'error',
                            title: 'ไม่สำเร็จ',
                            text: data.message || 'เกิดข้อผิดพลาดบางอย่าง',
                        });
                    }
                });
            });
        });
    </script>
<?php

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$con = null;
?>