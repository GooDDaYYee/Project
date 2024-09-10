<form id="report_work" method="post" enctype="multipart/form-data">
    <!-- Begin Page Content -->
    <div class="card o-hidden border-0 shadow-lg my-5 align-items-center">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h2 text-gray-900 mb-2">รายงานการปฏิบัติงาน</h1>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <label for="jobname" class="form-label">ชื่องาน:</label>
                                <input type="text" class="form-control" id="jobname" name="jobname">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <label for="images" class="form-label">รูปภาพ:</label>
                                <input type="file" class="form-control" id="images" name="images[]" multiple accept="image/*">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <label for="images" class="form-label">เลือกกลุ่มไลน์:</label>
                                <select class="form-control" id="group" name="group">
                                    <option value="1">PSNK กลุ่ม 1</option>
                                    <option value="2">PSNK กลุ่ม 2</option>
                                </select>
                            </div>
                        </div>
                        <button class="btn btn-warning bg-gradient-purple btn-user btn-block col-sm-4 container" id="insert_users" type="submit">
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
        $('#report_work').submit(function(e) {
            e.preventDefault();

            // ตรวจสอบข้อมูลก่อนส่ง
            var jobname = $('#jobname').val().trim();
            if (jobname === '') {
                Swal.fire({
                    title: 'ข้อผิดพลาด!',
                    text: 'กรุณากรอกชื่องาน',
                    icon: 'warning',
                    confirmButtonText: 'ตกลง'
                });
                return;
            }

            var formData = new FormData(this);

            $.ajax({
                url: 'report_work/report_process.php',
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(resp) {
                    console.log('Response:', resp);
                    if (resp && resp.status) {
                        if (resp.status == 1) {
                            Swal.fire({
                                title: 'สำเร็จ!',
                                text: resp.msg,
                                icon: 'success',
                                confirmButtonText: 'ตกลง'
                            }).then(function() {
                                window.location.href = "index.php?page=" + btoa('report_work/list_report');
                            });
                        } else {
                            Swal.fire({
                                title: 'ข้อผิดพลาด!',
                                text: resp.msg,
                                icon: 'error',
                                confirmButtonText: 'ตกลง'
                            });
                        }
                    } else {
                        console.error('การตอบสนองไม่ถูกต้อง:', resp);
                        Swal.fire({
                            title: 'ข้อผิดพลาด!',
                            text: 'เกิดข้อผิดพลาดที่ไม่รู้จัก: ' + JSON.stringify(resp),
                            icon: 'error',
                            confirmButtonText: 'ตกลง'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('ข้อผิดพลาด Ajax:', status, error);
                    console.error('ข้อความตอบกลับ:', xhr.responseText);
                    Swal.fire({
                        title: 'ข้อผิดพลาด!',
                        text: 'เกิดข้อผิดพลาดในการส่งข้อมูล: ' + error,
                        icon: 'error',
                        confirmButtonText: 'ตกลง'
                    });
                }
            });
        });
    });
</script>