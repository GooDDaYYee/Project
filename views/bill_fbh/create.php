<div class="card o-hidden border-0 shadow-lg my-3">
    <div class="card-body p-0">
        <div class="row">
            <div class="col-lg">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-2" style="font-size: 1.5rem;">เอกสารใบเสนอราคา/ใบแจ้งหนี้/ใบเสร็จรับเงิน บริษัท FBH</h1>
                    </div>
                    <form id="FBHBillForm" method="post">
                        <div class="row mt-md-3">
                            <div class="col">
                                <h4>เลขที่</h4>
                                <input type="text" id="number" name="number" class="form-control form-control-user" value="<?php echo $newBillId; ?>" readonly>
                            </div>
                            <div class="col">
                                <h4>วันที่ออกบิล</h4>
                                <input type="text" class="form-control" value="<?php echo date('d/m/Y', strtotime($thaiDate)); ?>" readonly>
                                <input type="hidden" name="thai_date" value="<?php echo $thaiDate; ?>">
                                <input type="hidden" name="company" value="FBH">
                            </div>
                            <div class="col">
                                <h4>วันที่ส่งสินค้า</h4>
                                <input type="date" id="thai_date_product" name="thai_date_product" class="form-control" value="<?php echo $thaiDate; ?>">
                            </div>
                        </div>
                        <div class="row mt-md-3">
                            <div class="col-md-6">
                                <h4>เงื่อนไขการชำระเงิน</h4>
                                <input type="text" id="payment" name="payment" class="form-control form-control-user" value="N/A">
                            </div>
                            <div class="col-md-3">
                                <h4>วันครบกำหนด</h4>
                                <input type="date" id="thai_due_date" name="thai_due_date" class="form-control" value="<?php echo $thaiDate; ?>">
                            </div>
                            <div class="col-md-3">
                                <h4>เลขที่ใบแจ้งหนี้/อ้างถึง</h4>
                                <input type="text" id="refer" name="refer" class="form-control form-control-user" value="-">
                            </div>
                        </div>
                        <div class="row mt-md-3">
                            <div class="col-md-3">
                                <h4>Site</h4>
                                <input type="text" id="Site" name="Site" class="form-control form-control-user" placeholder="Site">
                            </div>
                            <div class="col-md-3">
                                <h4>PR No</h4>
                                <input type="text" id="pr" name="pr" class="form-control form-control-user" placeholder="PR No (เฉพาะใบแจ้งหนี้/ใบเสร็จรับเงิน)">
                            </div>
                            <div class="col-md-3">
                                <h4>Work No</h4>
                                <input type="text" id="work_no" name="work_no" class="form-control form-control-user" placeholder="Work No (เฉพาะใบแจ้งหนี้/ใบเสร็จรับเงิน)">
                            </div>
                            <div class="col-md-3">
                                <h4>Project</h4>
                                <input type="text" id="project" name="project" class="form-control form-control-user" placeholder="Project (เฉพาะใบแจ้งหนี้/ใบเสร็จรับเงิน)">
                            </div>
                        </div>
                        <div class="row mt-md-3">
                            <div class="col-md-3">
                                <h4>จำนวนAU</h4>
                                <input type="number" id="numAU" name="numAU" class="form-control form-control-user" placeholder="จำนวนAU" required>
                            </div>
                            <div class="col-md-2">
                                <h4>&nbsp;</h4>
                                <button type="button" id="addInputFrame" class="btn btn-success btn-user btn-block">เพิ่ม AU</button>
                            </div>
                            <div class="col-md-2">
                                <h4>&nbsp;</h4>
                                <button type="button" id="removeInputFrame" class="btn btn-danger btn-user btn-block">ลบ AU</button>
                            </div>
                            <div class="col-md-2">
                                <h4>จำนวน AU ที่เพิ่ม</h4>
                                <input type="number" id="auCount" name="auCount" class="form-control form-control-user" value="0" readonly>
                            </div>
                        </div>
                        <div id="auInputs" class="mt-md-3">
                            <!-- AU inputs will be added here dynamically -->
                        </div>
                        <div class="row-md-auto mt-md-3">
                            <button class='btn btn-warning bg-gradient-purple btn-user btn-block col-sm-3 container' type='submit' id="submitButton">
                                <h5>เพิ่มข้อมูล</h5>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        const auOptions = <?php echo json_encode($auOptions); ?>;

        function addAuInput(index) {
            const auInput = `
            <div class="row mt-md-3 au-input">
                <div class="col-md-3">
                    <h4>AU ลำดับที่ ${index}</h4>
                    <input list="dataList" id="inputField_${index}" name="inputField[]" class="form-control" required>
                    <datalist id="dataList">
                        ${auOptions.map(option => `<option value="${option.au_id}">${option.au_id}</option>`).join('')}
                    </datalist>
                </div>
                <div class="col-md-3">
                    <h4>รายละเอียด AU</h4>
                    <p id="selectedData_${index}"></p>
                </div>
                <input type="hidden" id="selectedDataDetail_${index}" name="selectedDataDetail[]">
                <input type="hidden" id="selectedDataType_${index}" name="selectedDataType[]">
                <input type="hidden" id="selectedDataPrice_${index}" name="selectedDataPrice[]">
                <div class="col-md-3">
                    <h4>จำนวน</h4>
                    <input type="number" id="unit_${index}" name="unit[]" class="form-control form-control-user" required>
                </div>
            </div>
        `;
            $('#auInputs').append(auInput);
            $(`#inputField_${index}`).on('input', function() {
                fetchAuDetails(this.value, index);
            });
        }

        function fetchAuDetails(auId, index) {
            const auDetail = auOptions.find(option => option.au_id === auId);
            if (auDetail) {
                $(`#selectedData_${index}`).text(auDetail.au_detail);
                $(`#selectedDataDetail_${index}`).val(auDetail.au_detail);
                $(`#selectedDataType_${index}`).val(auDetail.au_type);
                $(`#selectedDataPrice_${index}`).val(auDetail.au_price);
            }
        }

        $('#addInputFrame').click(function() {
            const numAU = parseInt($('#numAU').val());
            if (numAU > 0) {
                const currentCount = $('.au-input').length;
                for (let i = 0; i < numAU; i++) {
                    addAuInput(currentCount + i + 1);
                }
                $('#auCount').val($('.au-input').length);
            }
        });

        $('#removeInputFrame').click(function() {
            $('.au-input:last').remove();
            $('#auCount').val($('.au-input').length);
        });

        function checkDuplicates() {
            const auIds = $('input[name="inputField[]"]').map(function() {
                return $(this).val();
            }).get();
            const duplicates = auIds.filter((item, index) => auIds.indexOf(item) !== index);
            if (duplicates.length > 0) {
                const duplicateIndices = [];
                duplicates.forEach(duplicate => {
                    auIds.forEach((id, index) => {
                        if (id === duplicate) {
                            duplicateIndices.push(index + 1);
                        }
                    });
                });
                alert("มี AU ID ชื่อ " + duplicates.join(', ') + ' ซ้ำกันที่ลำดับ: ' + duplicateIndices.join(', ') + " กรุณาตรวจสอบและแก้ไข");
                return true;
            }
            return false;
        }

        $('#FBHBillForm').submit(function(e) {
            e.preventDefault();
            if (checkDuplicates()) {
                return;
            }
            $.ajax({
                type: "POST",
                url: "index.php?page=bill-fbh&action=create",
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'สำเร็จ',
                            text: 'เพิ่มข้อมูล Bill สำเร็จ',
                        }).then(function() {
                            window.location.href = "index.php?page=bill-fbh";
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