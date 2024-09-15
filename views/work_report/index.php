<div class="container-fluid">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <div class="row">
                <div class="col-xl-6 mx-auto">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h2 text-gray-900 mb-4">รายงานการปฏิบัติงาน</h1>
                        </div>
                        <?php if (isset($_SESSION['success_message'])): ?>
                            <div class="alert alert-success"><?= $_SESSION['success_message']; unset($_SESSION['success_message']); ?></div>
                        <?php endif; ?>
                        <?php if (isset($_SESSION['error_message'])): ?>
                            <div class="alert alert-danger"><?= $_SESSION['error_message']; unset($_SESSION['error_message']); ?></div>
                        <?php endif; ?>
                        <form action="index.php?action=submitReport" method="post" enctype="multipart/form-data">
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label for="name" class="form-label">ชื่อ:</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="col-sm-6">
                                    <label for="jobname" class="form-label">ชื่องาน:</label>
                                    <input type="text" class="form-control" id="jobname" name="jobname" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="images" class="form-label">รูปภาพ:</label>
                                <input type="file" class="form-control" id="images" name="images[]" multiple accept="image/*">
                            </div>
                            <button class="btn btn-warning bg-gradient-purple btn-user btn-block" type="submit">
                                <h5>เพิ่มข้อมูล</h5>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('form').on('submit', function(e) {
        var fileInput = $('#images');
        var maxSize = 5 * 1024 * 1024; // 5MB

        if (fileInput[0].files.length > 0) {
            for (var i = 0; i < fileInput[0].files.length; i++) {
                if (fileInput[0].files[i].size > maxSize) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'error',
                        title: 'ไฟล์ขนาดใหญ่เกินไป',
                        text: 'กรุณาอัปโหลดไฟล์ขนาดไม่เกิน 5MB',
                        confirmButtonText: 'ตกลง'
                    });
                    return false;
                }
            }
        }
    });
});
</script>