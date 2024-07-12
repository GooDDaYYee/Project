<form action="stock/insert_drum_process.php" id="insert_cable" method="post">
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
                                        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                                            <option value="<?php echo $row['drum_company']; ?>"><?php echo $row['drum_company']; ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label for="manufacturer">
                                        <h4>บริษัทผลิตสาย</h4>
                                    </label>
                                    <select class="form-control" id="manufacturer" name="manufacturer">
                                        <option value="">ไม่มีข้อมูล</option>
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <label for="drum">
                                        <h4>Drum</h4>
                                    </label>
                                    <select class="form-control" id="drum" name="drum">
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
                        <button class="btn btn-warning bg-gradient-purple btn-user btn-block col-sm-3 container" id="insert_cable" type="submit">
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
        $('#company').change(function() {
            var company = $(this).val();
            if (company) {
                $.ajax({
                    type: 'POST',
                    url: 'stock/ajaxData.php',
                    data: {
                        'company': company,
                        'request_type': 'company'
                    },
                    success: function(html) {
                        $('#manufacturer').html(html);
                        $('#drum').html('<option value="">ไม่มีข้อมูล</option>');
                    }
                });
            } else {
                $('#manufacturer').html('<option value="">ไม่มีข้อมูล</option>');
                $('#drum').html('<option value="">ไม่มีข้อมูล</option>');
            }
        });

        $('#manufacturer').change(function() {
            var manufacturer = $(this).val();
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
                        $('#drum').html(html);
                    }
                });
            } else {
                $('#drum').html('<option value="">ไม่มีข้อมูล</option>');
            }
        });
    });
</script>