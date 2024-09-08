<form id="insert_cable" method="post">
    <!-- Begin Page Content -->
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h2 text-gray-900 mb-2">เพิ่มงาน</h1>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <h4>Route</h4>
                                <input type="text" id="route" name="route" class="form-control form-control-user" placeholder="Route" required="" autofocus="">
                            </div>
                            <div class="col-sm-4">
                                <h4>Section</h4>
                                <input type="text" id="section" name="section" class="form-control form-control-user" placeholder="Section" required="">
                            </div>
                            <div class="col-sm-4">
                                <h4>Team</h4>
                                <input type="text" id="team" name="team" class="form-control form-control-user" placeholder="Team" required="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <h4>Cable Form</h4>
                                <input type="number" id="cable_form" name="cable_form" class="form-control form-control-user" placeholder="Cable Form" required="" autofocus="">
                            </div>
                            <div class="col-sm-2">
                                <h4>Cable To</h4>
                                <input type="number" id="cable_to" name="cable_to" class="form-control form-control-user" placeholder="Cable To" required="">
                            </div>
                            <div class="col-sm-3">
                                <h4>ใช้กับบริษัท</h4>
                                <select class="form-control" id="cable_work" name="cable_work">
                                    <option value="Mixed">Mixed</option>
                                    <option value="FHB">FHB</option>
                                </select>
                            </div>
                        </div>
                        <div class="text-center">
                            <h1 class="h2 text-gray-900 mb-2">เลือก Drum</h1>
                        </div>
                        <?php
                        include("connect.php");

                        $strsql = "SELECT * FROM drum";
                        try {
                            $stmt = $con->prepare($strsql);
                            $stmt->execute();
                        ?>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="company">
                                        <h4>รับจากบริษัท</h4>
                                    </label>
                                    <select class="form-control" id="company" name="company">
                                        <option value="">เลือกบริษัท</option>
                                        <option value="Mixed">Mixed</option>
                                        <option value="FIBERHOME">FIBERHOME</option>
                                        <option value="FBH">FBH</option>
                                        <option value="CCS">CCS</option>
                                        <option value="W&W">W&W</option>
                                        <option value="TKI">TKI</option>
                                        <option value="MTE">MTE</option>
                                        <option value="Poonsub">Poonsub</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label for="manufacturer">
                                        <h4>บริษัทผลิตสาย</h4>
                                    </label>
                                    <select class="form-control" id="manufacturer" name="manufacturer">
                                        <option value="">เลือกบริษัท</option>
                                        <option value="FUTONG">FUTONG</option>
                                        <option value="FIBERHOME">FIBERHOME</option>
                                        <option value="TICC">TICC</option>
                                        <option value="TUC">TUC</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label for="drum_id">
                                        <h4>Drum No</h4>
                                    </label>
                                    <select class="form-control" id="drum_id" name="drum_id">
                                        <option value="">ไม่มีข้อมูล</option>
                                    </select>
                                </div>
                            </div>
                        <?php
                        } catch (PDOException $e) {
                            echo "Error: " . $e->getMessage();
                        }
                        $con = null;
                        ?>
                        <button class="btn btn-warning bg-gradient-purple btn-user btn-block col-sm-3 container" type="submit">
                            <h5>เพิ่มข้อมูล</h5>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    $(document).ready(function() {
        $('#manufacturer, #company').change(function() {
            var manufacturer = $('#manufacturer').val();
            var company = $('#company').val();
            if (manufacturer && company) {
                $.ajax({
                    type: 'POST',
                    url: 'stock/ajaxData.php',
                    data: {
                        'manufacturer': manufacturer,
                        'company': company,
                        'request_type': 'manufacturer'
                    },
                    success: function(html) {
                        $('#drum_id').html(html);
                    }
                });
            } else {
                $('#drum_id').html('<option value="">ไม่มีข้อมูล</option>');
            }
        });
    });

    // sweetalert insert_cable
    $(function() {
        $('#insert_cable').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "stock/insert_cable_process.php",
                data: $(this).serialize(),
                success: function(response) {
                    const data = JSON.parse(response);
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'สำเร็จ',
                            text: 'เพิ่มข้อมูล Drum สำเร็จ',
                        }).then(function() {
                            window.location.href = "index.php?page=" + btoa('stock/list_stock_cable');
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
                        icon: 'warning',
                        title: 'ไม่สำเร็จ',
                        text: data.message || 'เกิดข้อผิดพลาดบางอย่าง',
                    });
                }
            });
        });
    });
</script>