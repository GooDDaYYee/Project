<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
            <div class="col-lg">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">เพิ่มสต๊อกเคเบิ้ล</h1>
                    </div>
                    <form id="addCableForm">
                        <div class="form-group row">
                            <div class="col-sm-4 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" id="route" name="route" placeholder="Route" required>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control-user" id="section" name="section" placeholder="Section" required>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control-user" id="team" name="team" placeholder="Team" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4 mb-3 mb-sm-0">
                                <input type="number" class="form-control form-control-user" id="cable_form" name="cable_form" placeholder="Cable From" required>
                            </div>
                            <div class="col-sm-4">
                                <input type="number" class="form-control form-control-user" id="cable_to" name="cable_to" placeholder="Cable To" required>
                            </div>
                            <div class="col-sm-4">
                                <select class="form-control" id="cable_work" name="cable_work">
                                    <option value="">เลือกบริษัท</option>
                                    <option value="Mixed">Mixed</option>
                                    <option value="FHB">FHB</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4 mb-3 mb-sm-0">
                                <select class="form-control" id="company" name="company">
                                    <option value="">เลือกบริษัท</option>
                                    <?php foreach ($data['companies'] as $value => $label): ?>
                                        <option value="<?= $value ?>"><?= $label ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <select class="form-control" id="manufacturer" name="manufacturer">
                                    <option value="">เลือกบริษัทผลิตสาย</option>
                                    <?php foreach ($data['manufacturers'] as $value => $label): ?>
                                        <option value="<?= $value ?>"><?= $label ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <select class="form-control" id="drum_id" name="drum_id">
                                    <option value="">เลือก Drum</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            เพิ่มข้อมูล
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#manufacturer, #company').change(function() {
            var manufacturer = $('#manufacturer').val();
            var company = $('#company').val();
            if (manufacturer && company) {
                $.ajax({
                    type: 'POST',
                    url: 'index.php?page=stock-cable&action=fetchDrums',
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

        $('#addCableForm').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "index.php?page=stock-cable&action=create",
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'สำเร็จ',
                            text: 'เพิ่มข้อมูล Cable สำเร็จ',
                        }).then(function() {
                            window.location.href = "index.php?page=stock-cable";
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'ไม่สำเร็จ',
                            text: response.message,
                        });
                    }
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'ไม่สำเร็จ',
                        text: 'เกิดข้อผิดพลาดในการเชื่อมต่อกับเซิร์ฟเวอร์',
                    });
                }
            });
        });
    });
</script>