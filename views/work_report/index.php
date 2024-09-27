<div class="container-fluid">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h2 text-gray-900 mb-4">รายงานการปฏิบัติงาน</h1>
                        </div>
                        <?php if (isset($_SESSION['success_message'])): ?>
                            <div class="alert alert-success"><?= $_SESSION['success_message'];
                                                                unset($_SESSION['success_message']); ?></div>
                        <?php endif; ?>
                        <?php if (isset($_SESSION['error_message'])): ?>
                            <div class="alert alert-danger"><?= $_SESSION['error_message'];
                                                            unset($_SESSION['error_message']); ?></div>
                        <?php endif; ?>
                        <form action="index.php?page=work-report&action=submitReport" method="post" enctype="multipart/form-data">
                            <div class="form-group row mb-3">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label for="name" class="form-label">ชื่อ:</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="col-sm-6">
                                    <label for="jobname" class="form-label">ชื่องาน:</label>
                                    <input type="text" class="form-control" id="jobname" name="jobname" required>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="images" class="form-label">รูปภาพ:</label>
                                <input type="file" id="images" name="images[]" multiple accept="image/*">
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
                            <div id="imagePreviewGrid" class="row mb-3">
                                <!-- Image previews will be inserted here -->
                            </div>
                            <button class="btn bg-gradient-purple btn-user btn-block" type="submit">
                                เพิ่มข้อมูล
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
        $('#images').on('change', function(e) {
            $('#imagePreviewGrid').empty();
            var files = e.target.files;
            var maxSize = 5 * 1024 * 1024; // 5MB

            for (var i = 0; i < files.length; i++) {
                if (files[i].size > maxSize) {
                    Swal.fire({
                        icon: 'error',
                        title: 'ไฟล์ขนาดใหญ่เกินไป',
                        text: 'กรุณาอัปโหลดไฟล์ขนาดไม่เกิน 5MB',
                        confirmButtonText: 'ตกลง'
                    });
                    $(this).val('');
                    return false;
                }

                var reader = new FileReader();
                reader.onload = (function(file) {
                    return function(e) {
                        $('#imagePreviewGrid').append(`
                            <div class="col-md-3 col-sm-6 mb-3 preview-container">
                                <div class="img-preview" style="background-image: url('${e.target.result}');"></div>
                                <span class="remove-img" data-file="${file.name}"><i class="fas fa-times"></i></span>
                            </div>
                        `);
                    };
                })(files[i]);
                reader.readAsDataURL(files[i]);
            }
        });

        $(document).on('click', '.remove-img', function() {
            var fileName = $(this).data('file');
            var fileInput = $('#images')[0];
            var files = Array.from(fileInput.files);

            files = files.filter(function(file) {
                return file.name !== fileName;
            });

            var dataTransfer = new DataTransfer();
            files.forEach(function(file) {
                dataTransfer.items.add(file);
            });

            fileInput.files = dataTransfer.files;
            $(this).closest('.preview-container').remove();
        });

        $('form').on('submit', function(e) {
            var loadingOverlay = new LoadingOverlay();
            loadingOverlay.show();
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
</body>

</html>