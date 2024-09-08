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
            var formData = new FormData(this); // ใช้ FormData เพื่อรองรับไฟล์

            $.ajax({
                url: 'report_work/report_process.php',
                method: 'POST',
                data: formData,
                contentType: false, // ต้องระบุ false เพื่อป้องกันการแปลงค่า FormData
                processData: false,
                success: function(resp) {
                    if (typeof resp != undefined) {
                        resp = JSON.parse(resp);
                        if (resp.status == 1) {
                            Swal.fire({
                                title: 'สำเร็จ!',
                                text: resp.msg,
                                icon: 'success',
                                confirmButtonText: 'ตกลง'
                            });
                        } else {
                            Swal.fire({
                                title: 'ข้อผิดพลาด!',
                                text: resp.msg,
                                icon: 'error',
                                confirmButtonText: 'ตกลง'
                            });
                        }
                    }
                },
                complete: function() {
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                }
            });
        });
    });
</script>