<!-- เพิ่ม CSS เฉพาะสำหรับหน้านี้ -->
<style>
    .image-container {
        position: relative;
        overflow: hidden;
        padding-bottom: 100%;
    }

    .image-container img {
        position: absolute;
        object-fit: cover;
        width: 100%;
        height: 100%;
        transition: transform 0.3s ease;
    }

    .image-container:hover img {
        transform: scale(2);
    }

    .image-checkbox {
        position: absolute;
        top: 10px;
        left: 10px;
        z-index: 20;
    }

    .selected {
        border: 6px solid #007bff;
    }
</style>

<!-- เนื้อหาหลักของหน้า -->
<div class="container-fluid py-4">
    <div class="card shadow mb-4">
        <div class="card-header d-flex align-items-center justify-content-between py-3">
            <div>
                <i class="fa fa-folder-open fa-fw me-2"></i>
                <h5 class="m-0 font-weight-bold d-inline"><?= htmlspecialchars($data['folderName']) ?></h5>
            </div>
            <button id="deleteSelected" class="btn btn-danger" style="display: none;">ลบรูปภาพที่เลือก</button>
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

<!-- เพิ่ม JavaScript เฉพาะสำหรับหน้านี้ -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof lightbox !== 'undefined') {
            lightbox.option({
                'resizeDuration': 200,
                'wrapAround': true,
                'alwaysShowNavOnTouchDevices': true
            });
        } else {
            console.error('Lightbox is not defined. Make sure it is properly loaded.');
        }

        const imageGallery = document.getElementById('imageGallery');
        const deleteButton = document.getElementById('deleteSelected');
        let selectedImages = [];

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

                deleteButton.style.display = selectedImages.length > 0 ? 'block' : 'none';
            }
        });

        deleteButton.addEventListener('click', function() {
            if (confirm('คุณแน่ใจหรือไม่ที่จะลบรูปภาพที่เลือก?')) {
                // ปรับปรุง URL ของ endpoint
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
                            // ลบรูปภาพออกจาก DOM
                            selectedImages.forEach(path => {
                                const imageCard = document.querySelector(`.image-checkbox[data-image-path="${path}"]`).closest('.col-6');
                                imageCard.remove();
                            });
                            selectedImages = [];
                            deleteButton.style.display = 'none';
                            alert('ลบรูปภาพเรียบร้อยแล้ว');
                        } else {
                            alert('เกิดข้อผิดพลาดในการลบรูปภาพ');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('เกิดข้อผิดพลาดในการลบรูปภาพ');
                    });
            }
        });
    });
</script>