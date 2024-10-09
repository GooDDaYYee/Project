<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between align-items-center py-3">
            <div>
                <i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;เพิ่ม AU
            </div>
        </div>
        <div class="card-body">
            <form id="addAuForm">
                <div class="form-group">
                    <label for="au_name">AU Name</label>
                    <input type="text" class="form-control" id="au_name" name="au_name" required>
                </div>
                <div class="form-group">
                    <label for="au_detail">AU Detail</label>
                    <textarea class="form-control" id="au_detail" name="au_detail" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label for="au_type">AU Type</label>
                    <input type="text" class="form-control" id="au_type" name="au_type" required>
                </div>
                <div class="form-group">
                    <label for="au_price">AU Price</label>
                    <input type="number" class="form-control" id="au_price" name="au_price" step="0.01" min="0" required>
                </div>
                <div class="form-group">
                    <label for="au_company">AU Company</label>
                    <input type="text" class="form-control" id="au_company" name="au_company" required>
                </div>
                <div class="row-md-auto mt-md-3">
                    <button class='btn btn-warning bg-gradient-purple btn-user btn-block col-sm-3 container' type='submit' id="submitButton">
                        <i class="fa fa-save"></i> เพิ่มข้อมูล
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#addAuForm').submit(function(e) {
            e.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                url: 'index.php?page=au-page&action=addAu',
                method: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'สำเร็จ',
                            text: 'เพิ่ม AU สำเร็จ',
                        }).then(() => {
                            window.location.href = "index.php?page=au-page";
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'ไม่สำเร็จ',
                            text: response.message,
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'ไม่สำเร็จ',
                        text: 'เกิดข้อผิดพลาดในการเชื่อมต่อกับเซิร์ฟเวอร์',
                    });
                }
            });
        });

        // Form validation
        $('#addAuForm').validate({
            rules: {
                au_name: {
                    required: true,
                    minlength: 3
                },
                au_detail: {
                    required: true,
                    minlength: 10
                },
                au_type: {
                    required: true
                },
                au_price: {
                    required: true,
                    number: true,
                    min: 0
                },
                au_company: {
                    required: true
                }
            },
            messages: {
                au_name: {
                    required: "กรุณากรอกชื่อ AU",
                    minlength: "ชื่อ AU ต้องมีความยาวอย่างน้อย 3 ตัวอักษร"
                },
                au_detail: {
                    required: "กรุณากรอกรายละเอียด AU",
                    minlength: "รายละเอียด AU ต้องมีความยาวอย่างน้อย 10 ตัวอักษร"
                },
                au_type: {
                    required: "กรุณากรอกประเภท AU"
                },
                au_price: {
                    required: "กรุณากรอกราคา AU",
                    number: "กรุณากรอกราคาเป็นตัวเลข",
                    min: "ราคาต้องไม่ต่ำกว่า 0"
                },
                au_company: {
                    required: "กรุณาเลือกบริษัท"
                }
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>