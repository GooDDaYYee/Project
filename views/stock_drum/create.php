    <form id="insert_drum" method="post">
        <!-- Begin Page Content -->
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h2 text-gray-900 mb-2">เพิ่ม Drum</h1>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <h4>Drum Number</h4>
                                    <input type="text" id="drum_no" name="drum_no" class="form-control form-control-user" placeholder="Drum Number" required="" autofocus="">
                                </div>
                                <div class="col-sm-4">
                                    <h4>Drum To</h4>
                                    <input type="text" id="drum_to" name="drum_to" class="form-control form-control-user" placeholder="Drum To" required="">
                                </div>
                                <div class="col-sm-4">
                                    <h4>Description</h4>
                                    <input type="text" id="drum_description" name="drum_description" class="form-control form-control-user" placeholder="Description" required="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <h4>รับจากบริษัท</h4>
                                    <select class="form-control" id="drum_company" name="drum_company">
                                        <option value="">เลือกบริษัท</option>
                                        <?php foreach ($drum_companies as $company): ?>
                                            <option value="<?= htmlspecialchars($company['drum_company_id']) ?>"><?= htmlspecialchars($company['drum_company_detail']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <h4>บริษัทผลิตสาย</h4>
                                    <select class="form-control" id="drum_cable_company" name="drum_cable_company">
                                        <option value="">เลือกบริษัท</option>
                                        <?php foreach ($drum_cable_companies as $company): ?>
                                            <option value="<?= htmlspecialchars($company['drum_cable_company_id']) ?>"><?= htmlspecialchars($company['drum_cable_company_detail']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <h4>Drum เต็ม</h4>
                                    <input type="number" id="drum_full" name="drum_full" class="form-control form-control-user" placeholder="Drum เต็ม" required="">
                                </div>
                            </div>
                            <button class="btn btn-warning bg-gradient-purple btn-user btn-block col-sm-3 container" id="insert_drum" type="submit">
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
            $('#insert_drum').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "index.php?page=stock-drum&action=create",
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'สำเร็จ',
                                text: 'เพิ่มข้อมูล Drum สำเร็จ',
                            }).then(function() {
                                window.location.href = "index.php?page=stock-drum";
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'ไม่สำเร็จ',
                                text: response.message || 'เกิดข้อผิดพลาดในการเพิ่มข้อมูล',
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr, status, error);
                        Swal.fire({
                            icon: 'error',
                            title: 'ไม่สำเร็จ',
                            text: 'เกิดข้อผิดพลาดในการเชื่อมต่อกับเซิร์ฟเวอร์: ' + error,
                        });
                    }
                });
            });
        });
    </script>