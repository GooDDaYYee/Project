<style>
    .scrollable-list {
        max-height: calc(5 * 58px);
        overflow-y: auto;
    }

    .list-group-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .close-btn {
        cursor: pointer;
        padding: 0 5px;
        font-weight: bold;
        color: #777;
    }

    .close-btn:hover {
        color: #000;
    }
</style>
<div class="container-xl">
    <div class="text-center">
        <h1 class="h2 text-gray-900 mb-3">แก้ไขข้อมูลเชิงลึก</h1>
    </div>
    <div class="row">
        <div class="col-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h4>เพิ่ม รับจากบริษัท</h4>
                    <div class="row">
                        <div class="col">
                            <input type="text" id="drum-company-input" class="form-control" placeholder="รับจากบริษัท" required>
                        </div>
                        <div class="col">
                            <button id="update-drum-company" class="btn btn-warning bg-gradient-purple">ตกลง</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-4">
                            <div class="scrollable-list">
                                <ul class="list-group drum-company">
                                    <?php foreach ($data['drum_company'] as $row): ?>
                                        <li class="list-group-item">
                                            <?php echo htmlspecialchars($row['drum_company_detail']); ?>
                                            <button class="btn btn-sm btn-danger delete-item" data-id="<?= $row['drum_company_id'] ?>">ลบ</button>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h4>เพิ่ม บริษัทผลิตสาย</h4>
                    <div class="row">
                        <div class="col">
                            <input type="text" id="cable-company-input" class="form-control" placeholder="บริษัทผลิตสาย" required>
                        </div>
                        <div class="col">
                            <button id="update-cable-company" class="btn btn-warning bg-gradient-purple">ตกลง</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-4">
                            <div class="scrollable-list">
                                <ul class="list-group cable-company">
                                    <?php foreach ($data['drum_cable_company'] as $row): ?>
                                        <li class="list-group-item">
                                            <?php echo htmlspecialchars($row['drum_cable_company_detail']); ?>
                                            <button class="btn btn-sm btn-danger delete-item" data-id="<?= $row['drum_cable_company_id'] ?>">ลบ</button>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h4>เพิ่ม บริษัทที่ทำงาน</h4>
                    <div class="row">
                        <div class="col">
                            <input type="text" id="work-company-input" class="form-control" placeholder="บริษัทที่ทำงาน" required>
                        </div>
                        <div class="col">
                            <button id="update-work-company" class="btn btn-warning bg-gradient-purple">ตกลง</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-4">
                            <div class="scrollable-list">
                                <ul class="list-group work-company">
                                    <?php foreach ($data['cable_work'] as $row): ?>
                                        <li class="list-group-item">
                                            <?php echo htmlspecialchars($row['cable_work_name']); ?>
                                            <button class="btn btn-sm btn-danger delete-item" data-id="<?= $row['cable_work_id'] ?>">ลบ</button>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        $stmt = $this->db->query("SELECT COUNT(*) as total FROM au_all");
        $totalCount = $stmt->fetchColumn();

        $stmt = $this->db->query("SELECT COUNT(*) as Mixed FROM au_all WHERE au_company = 'Mixed'");
        $mixedCount = $stmt->fetchColumn();

        $stmt = $this->db->query("SELECT COUNT(*) as FBH FROM au_all WHERE au_company = 'FBH'");
        $fbhCount = $stmt->fetchColumn();
        ?>

        <div class="col-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h4>เพิ่ม AU ทั้งหมด</h4>
                    <p style="color: red; font-size: 14px;">*ข้อมูลเก่าจะถูกลบ และแทนที่ใหม่ทั้งหมด โปรดอัปโหลดไฟล์ Excel (.xls หรือ .xlsx) และข้อมูลทั้งหมดต้องไม่ถูกเรียกใช้*</p>
                    <div class="row">
                        <form id="auUploadForm" action="index.php?page=edit-back&action=importAU" method="post" enctype="multipart/form-data">
                            <div class="col">
                                <input type="file" name="excelFile" class="btn btn-warning bg-gradient-purple" accept=".xlsx, .xls" required>
                            </div>
                            <div class="col mt-2">
                                <input type="submit" value="อัปโหลด" class="btn btn-warning bg-gradient-purple">
                            </div>
                        </form>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-4">
                            <h4>รายละเอียด</h4>
                            <p id="auDetails">AU : ทั้งหมด <?php echo $totalCount; ?> รายการ | Mixed : <?php echo $mixedCount; ?> รายการ | FBH : <?php echo $fbhCount; ?> รายการ</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h4>แก้ไขข้อมูลธนาคารภายใน Bill</h4>
                    <div class="row">
                        <div class="col">
                            <textarea id="bill-bank-textarea" class="form-control" rows="6"><?php echo htmlspecialchars($data['bill_bank'][0]['bank_detail']); ?></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mt-3 text-center">
                            <button id="update-bill-bank" class="btn btn-warning bg-gradient-purple">ตกลง</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h4>แก้ไขข้อมูลที่อยู่บริษัท PSNK</h4>
                    <div class="row">
                        <div class="col">
                            <textarea id="company-address-psnk-textarea" class="form-control" rows="6"><?php echo htmlspecialchars($data['company_address_psnk'][0]['company_address_detaill']); ?></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mt-3 text-center">
                            <button id="update-company-address-psnk" class="btn btn-warning bg-gradient-purple">ตกลง</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h4>แก้ไขข้อมูลที่อยู่บริษัท Mixed</h4>
                    <div class="row">
                        <div class="col">
                            <textarea id="company-address-mixed-textarea" class="form-control" rows="6"><?php echo htmlspecialchars($data['company_address_mixed'][0]['company_address_detaill']); ?></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mt-3 text-center">
                            <button id="update-company-address-mixed" class="btn btn-warning bg-gradient-purple">ตกลง</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h4>แก้ไขข้อมูลที่อยู่บริษัท FBH</h4>
                    <div class="row">
                        <div class="col">
                            <textarea id="company-address-fbh-textarea" class="form-control" rows="6"><?php echo htmlspecialchars($data['company_address_fbh'][0]['company_address_detaill']); ?></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mt-3 text-center">
                            <button id="update-company-address-fbh" class="btn btn-warning bg-gradient-purple">ตกลง</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h4>แก้ไขข้อมูลผู้ติดต่อ Mixed</h4>
                    <div class="row">
                        <div class="col">
                            <textarea id="contact-info-mixed-textarea" class="form-control" rows="6"><?php echo htmlspecialchars($data['company_address_mixed_contact'][0]['company_address_name']); ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col mt-3 text-center">
                        <button id="update-contact-info-mixed" class="btn btn-warning bg-gradient-purple">ตกลง</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h4>แก้ไขข้อมูลผู้ติดต่อ FBH</h4>
                    <div class="row">
                        <div class="col">
                            <textarea id="contact-info-fbh-textarea" class="form-control" rows="6"><?php echo htmlspecialchars($data['company_address_fbh_contact'][0]['company_address_name']); ?></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mt-3 text-center">
                            <button id="update-contact-info-fbh" class="btn btn-warning bg-gradient-purple">ตกลง</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            // Insert data for drum company
            $('#update-drum-company').click(function() {
                insertData('drum-company-input', 'drum_company');
            });

            // Insert data for cable company
            $('#update-cable-company').click(function() {
                insertData('cable-company-input', 'drum_cable_company');
            });

            // Insert data for work company
            $('#update-work-company').click(function() {
                insertData('work-company-input', 'cable_work');
            });

            function insertData(inputId, table) {
                var value = $('#' + inputId).val();
                if (value) {
                    $.ajax({
                        url: 'index.php?page=edit-back&action=insertData',
                        method: 'POST',
                        data: {
                            table: table,
                            value: value
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 'success') {
                                Swal.fire({
                                    title: 'สำเร็จ!',
                                    text: response.message,
                                    icon: 'success'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        location.reload(); // Reload the page when OK is clicked
                                    }
                                });
                            } else {
                                Swal.fire(response.message);
                            }
                        },
                        error: function() {
                            Swal.fire('ไม่สำเร็จ', 'เกิดข้อผิดพลาดขณะประมวลผลคำขอของคุณ', 'error');
                        }
                    });
                } else {
                    Swal.fire('คำเตือน', 'กรุณากรอกข้อมูล', 'warning');
                }
            }

            // Delete data
            $(document).on('click', '.delete-item', function() {
                var $button = $(this);
                var id = $button.data('id');
                var table;
                if ($button.closest('ul').hasClass('drum-company')) {
                    table = 'drum_company';
                } else if ($button.closest('ul').hasClass('cable-company')) {
                    table = 'drum_cable_company';
                } else {
                    table = 'cable_work';
                }

                Swal.fire({
                    title: 'คุณแน่ใจ?',
                    text: "คุณจะไม่สามารถย้อนกลับสิ่งนี้ได้!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'ใช่ ลบเลย!',
                    cancelButtonText: 'ยกเลิก',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'index.php?page=edit-back&action=deleteData',
                            method: 'POST',
                            data: {
                                table: table,
                                id: id
                            },
                            dataType: 'json',
                            success: function(response) {
                                if (response.status === 'success') {
                                    Swal.fire({
                                        title: 'สำเร็จ!',
                                        text: response.message,
                                        icon: 'success'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            location.reload(); // Reload the page when OK is clicked
                                        }
                                    });
                                } else {
                                    Swal.fire('Error', response.message, 'error');
                                }
                            },
                            error: function() {
                                Swal.fire('Error', 'เกิดข้อผิดพลาดขณะประมวลผลคำขอของคุณ.', 'error');
                            }
                        });
                    }
                });
            });

            // Update bill bank data
            $('#update-bill-bank').click(function() {
                updateData('bill-bank-textarea', 'bill_bank');
            });

            $('#update-company-address-psnk').click(function() {
                updateData('company-address-psnk-textarea', 'company_address_psnk');
            });

            // Update company address Mixed data
            $('#update-company-address-mixed').click(function() {
                updateData('company-address-mixed-textarea', 'company_address_mixed');
            });

            // Update company address FBH data
            $('#update-company-address-fbh').click(function() {
                updateData('company-address-fbh-textarea', 'company_address_fbh');
            });

            // Update contact info Mixed data
            $('#update-contact-info-mixed').click(function() {
                updateData('contact-info-mixed-textarea', 'company_address_mixed_contact');
            });

            // Update contact info FBH data
            $('#update-contact-info-fbh').click(function() {
                updateData('contact-info-fbh-textarea', 'company_address_fbh_contact');
            });

            function updateData(textareaId, table) {
                var value = $('#' + textareaId).val();
                $.ajax({
                    url: 'index.php?page=edit-back&action=updateData',
                    method: 'POST',
                    data: {
                        table: table,
                        value: value
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            Swal.fire({
                                title: 'สำเร็จ!',
                                text: response.message,
                                icon: 'success'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload(); // Reload the page when OK is clicked
                                }
                            });
                        } else {
                            Swal.fire('Error', response.message, 'error');
                        }
                    },
                    error: function() {
                        Swal.fire('Error', 'เกิดข้อผิดพลาดขณะประมวลผลคำขอของคุณ.', 'error');
                    }
                });
            }

            $('#auUploadForm').on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        var result = JSON.parse(response);
                        if (result.status === 'success') {
                            Swal.fire({
                                title: 'สำเร็จ!',
                                text: result.message,
                                icon: 'success'
                            })
                        } else {
                            Swal.fire('Error', result.message, 'error');
                        }
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            });
        });
    </script>