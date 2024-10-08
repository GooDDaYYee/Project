<style>
    input[type=number] {
        box-shadow: 0 0 4px rgba(60, 179, 113);
    }
</style>
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
                            <div class="col-sm-4 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" id="section" name="section" placeholder="Section" required>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control-user" id="team" name="team" placeholder="Team" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4 mb-3 mb-sm-0">
                                <input type="number" class="form-control form-control-user" id="cable_form" name="cable_form" placeholder="Cable From" required maxlength="4">
                            </div>
                            <div class="col-sm-4 mb-3 mb-sm-0">
                                <input type="number" class="form-control form-control-user" id="cable_to" name="cable_to" placeholder="Cable To" required maxlength="4">
                            </div>
                            <div class="col-sm-4">
                                <select class="form-control" id="cable_work_id" name="cable_work_id" required>
                                    <option value="">เลือกงานที่ทำ</option>
                                    <?php foreach ($data['cableWorks'] as $id => $name): ?>
                                        <option value="<?= htmlspecialchars($id) ?>"><?= htmlspecialchars($name) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4 mb-3 mb-sm-0">
                                <select class="form-control" id="company" name="company">
                                    <option value="">เลือกบริษัท</option>
                                    <?php foreach ($data['companies'] as $id => $name): ?>
                                        <option value="<?= htmlspecialchars($id) ?>"><?= htmlspecialchars($name) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-sm-4 mb-3 mb-sm-0">
                                <select class="form-control" id="manufacturer" name="manufacturer">
                                    <option value="">เลือกบริษัทผลิตสาย</option>
                                    <?php foreach ($data['manufacturers'] as $id => $name): ?>
                                        <option value="<?= htmlspecialchars($id) ?>"><?= htmlspecialchars($name) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-sm-4 mb-3">
                                <select class="form-control" id="drum_id" name="drum_id">
                                    <option value="">เลือก Drum</option>
                                </select>
                            </div>
                        </div>
                        <button class="btn btn-warning bg-gradient-purple btn-user btn-block col-sm-3 container" type="submit">
                            <h5>เพิ่มข้อมูล</h5>
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
                    success: function(response) {
                        console.log("AJAX response:", response);
                        if (response.success) {
                            $('#drum_id').html(response.data.options);
                            console.log("Drum options updated");
                            if (response.message === 'ไม่พบข้อมูล Drum สำหรับ manufacturer และ company ที่เลือก') {
                                // อาจจะแสดง alert หรือข้อความแจ้งเตือนเพิ่มเติมที่นี่
                                console.log("No drums found for the selected manufacturer and company");
                            }
                        } else {
                            console.error("Error in AJAX response:", response.message);
                        }
                    }
                });
            } else {
                $('#drum_id').html('<option value="">ไม่มีข้อมูล</option>');
            }
        });

        $('#addCableForm').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                type: "POST",
                url: "index.php?page=stock-cable&action=create",
                data: formData,
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
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
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