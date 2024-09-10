<?php
if ($_SESSION["lv"] == 0 || $_SESSION["lv"] == 1) {
    include('connect.php');
    $strsql = "SELECT * FROM employee WHERE employee_status=1";

    try {
        $stmt = $con->prepare($strsql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $rowcount = count($result);
?>

        <form id="add_salary" method="post">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h2 text-gray-900 mb-2">เพิ่มเงินเดือน</h1>
                                </div>
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
                                        <input type="number" id="salary" name="salary" class="form-control form-control-user" placeholder="เงินเดือน" required="">
                                    </div>
                                    <div class="col-sm-3">
                                        <h4>OT</h4>
                                        <input type="number" id="ot" name="ot" class="form-control form-control-user" placeholder="OT" required="">
                                    </div>
                                    <div class="col-sm-3">
                                        <h4>ประกันสังคม</h4>
                                        <input type="number" id="social_security" name="social_security" class="form-control form-control-user" placeholder="ประกันสังคม" required="">
                                    </div>
                                    <div class="col-sm-3">
                                        <h4>อื่นๆ</h4>
                                        <input type="number" id="other" name="other" class="form-control form-control-user" placeholder="อื่นๆ" required="">
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
                                <button class="btn btn-warning bg-gradient-purple btn-user btn-block col-sm-3 container" type="submit">
                                    <h5>เพิ่มข้อมูล</h5>
                                </button>

                            </div>
                        </div>
                    </div>
                </div>
        </form>

        <script>
            $(function() {
                $('#add_salary').on('submit', function(e) {
                    e.preventDefault();
                    $.ajax({
                        type: "POST",
                        url: "employee/add_salary_process.php",
                        data: $(this).serialize(),
                        success: function(response) {
                            const data = JSON.parse(response);
                            if (data.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'สำเร็จ',
                                    text: 'เพิ่มข้อมูลเงินเดือนสำเร็จ',
                                }).then(function() {
                                    window.location.href = "index.php?page=" + btoa('employee/list_employee_salary');
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
} else {
    echo '<script>
    window.location.href = "index.php?page=' . base64_encode('home') . '";
    </script>';
}
?>