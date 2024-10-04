<!-- เนื้อหาหลักของหน้า -->
<div class="container-fluid py-4">
    <div class="card shadow mb-4">
        <div class="card-header d-flex align-items-center justify-content-between py-3">
            <div>
                <i class="fa fa-folder-open fa-fw me-2"></i>
                <h5 class="m-0 font-weight-bold d-inline"><?= htmlspecialchars($data['folderName']) ?></h5>
            </div>
            <div>
                <button class="btn btn-primary me-2" id="uploadButton">เพิ่มรูป</button>
                <button id="selectAllButton" class="btn btn-secondary me-2">เลือกทั้งหมด</button>
                <button id="deselectAllButton" class="btn btn-secondary me-2" style="display: none;">ยกเลิกเลือกทั้งหมด</button>
                <button id="deleteSelected" class="btn btn-danger" style="display: none;">ลบรูปภาพที่เลือก</button>
            </div>
        </div>
        <div class="card-body">
            <div class="row g-4" id="imageGallery">
                <?php foreach ($data['images'] as $index => $image): ?>
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="card h-100 image-card">
                            <div class="image-container">
                                <input type="checkbox" class="image-checkbox" data-image-path="<?= htmlspecialchars($image['path']) ?>">
                                <a href="<?= htmlspecialchars($image['path']) ?>" data-lightbox="image-gallery" data-title="<?= htmlspecialchars($image['name']) ?>">
                                    <img src="<?= htmlspecialchars($image['path']) ?>" class="card-img-top" alt="<?= htmlspecialchars($image['name']) ?>">
                                </a>
                            </div>
                            <div class="card-body">
                                <p class="card-text small text-muted text-truncate"><?= htmlspecialchars($image['name']) ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<form id="uploadForm" style="display: none;">
    <input type="file" id="fileInput" name="images[]" multiple accept="image/*" style="display: none;">
</form>

<!-- เพิ่ม JavaScript เฉพาะสำหรับหน้านี้ -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const imageGallery = document.getElementById('imageGallery');
        const deleteButton = document.getElementById('deleteSelected');
        const selectAllButton = document.getElementById('selectAllButton');
        const deselectAllButton = document.getElementById('deselectAllButton');
        const uploadButton = document.getElementById('uploadButton');
        const fileInput = document.getElementById('fileInput');
        const uploadForm = document.getElementById('uploadForm');
        let selectedImages = [];

        function updateButtonVisibility() {
            const hasSelectedImages = selectedImages.length > 0;
            deleteButton.style.display = hasSelectedImages ? 'inline-block' : 'none';
            selectAllButton.style.display = hasSelectedImages ? 'none' : 'inline-block';
            deselectAllButton.style.display = hasSelectedImages ? 'inline-block' : 'none';
        }

        imageGallery.addEventListener('change', function(e) {
            if (e.target.classList.contains('image-checkbox')) {
                const imagePath = e.target.dataset.imagePath;
                const imageCard = e.target.closest('.image-card');

                if (e.target.checked) {
                    selectedImages.push(imagePath);
                    imageCard.classList.add('selected');
                } else {
                    selectedImages = selectedImages.filter(path => path !== imagePath);
                    imageCard.classList.remove('selected');
                }

                updateButtonVisibility();
            }
        });

        selectAllButton.addEventListener('click', function() {
            const checkboxes = document.querySelectorAll('.image-checkbox:not(:checked)');
            checkboxes.forEach(checkbox => {
                checkbox.checked = true;
                const imagePath = checkbox.dataset.imagePath;
                if (!selectedImages.includes(imagePath)) {
                    selectedImages.push(imagePath);
                }
                checkbox.closest('.image-card').classList.add('selected');
            });
            updateButtonVisibility();
        });

        deselectAllButton.addEventListener('click', function() {
            const checkboxes = document.querySelectorAll('.image-checkbox:checked');
            checkboxes.forEach(checkbox => {
                checkbox.checked = false;
                checkbox.closest('.image-card').classList.remove('selected');
            });
            selectedImages = [];
            updateButtonVisibility();
        });

        deleteButton.addEventListener('click', function() {
            Swal.fire({
                title: 'คุณแน่ใจหรือไม่?',
                text: 'คุณต้องการลบรูปภาพที่เลือกหรือไม่?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'ใช่, ลบเลย',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('index.php?page=work-list&action=handleDeleteImages', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({
                                images: selectedImages
                            }),
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                selectedImages.forEach(path => {
                                    const imageCard = document.querySelector(`.image-checkbox[data-image-path="${path}"]`).closest('.col-6');
                                    imageCard.remove();
                                });
                                selectedImages = [];
                                updateButtonVisibility();
                                Swal.fire(
                                    'ลบแล้ว!',
                                    'รูปภาพที่เลือกถูกลบเรียบร้อยแล้ว',
                                    'success'
                                );
                            } else {
                                Swal.fire(
                                    'เกิดข้อผิดพลาด!',
                                    'เกิดข้อผิดพลาดในการลบรูปภาพ',
                                    'error'
                                );
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire(
                                'เกิดข้อผิดพลาด!',
                                'เกิดข้อผิดพลาดในการลบรูปภาพ',
                                'error'
                            );
                        });
                }
            });
        });

        uploadButton.addEventListener('click', function() {
            fileInput.click();
        });

        fileInput.addEventListener('change', function() {
            if (fileInput.files.length > 0) {
                const formData = new FormData(uploadForm);
                formData.append('folder', '<?= htmlspecialchars($data['folderName']) ?>');

                Swal.fire({
                    title: 'กำลังอัพโหลด...',
                    text: 'โปรดรอสักครู่',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                fetch('index.php?page=work-list&action=handleUploadImages', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'สำเร็จ!',
                                text: 'อัพโหลดรูปภาพเรียบร้อยแล้ว',
                                confirmButtonText: 'ตกลง'
                            }).then(() => {
                                location.reload(); // รีโหลดหน้าเพื่อแสดงรูปภาพใหม่
                            });
                        } else {
                            Swal.fire(
                                'เกิดข้อผิดพลาด!',
                                'เกิดข้อผิดพลาดในการอัพโหลดรูปภาพ',
                                'error'
                            );
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire(
                            'เกิดข้อผิดพลาด!',
                            'เกิดข้อผิดพลาดในการอัพโหลดรูปภาพ',
                            'error'
                        );
                    });
            }
        });

        if (typeof lightbox !== 'undefined') {
            lightbox.option({
                'resizeDuration': 200,
                'wrapAround': true,
                'alwaysShowNavOnTouchDevices': true
            });
        } else {
            console.error('Lightbox is not defined. Make sure it is properly loaded.');
        }
    });
</script>