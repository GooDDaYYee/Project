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
        transform: scale(1.05);
    }

    .lb-nav a.lb-prev,
    .lb-nav a.lb-next {
        opacity: 0.7;
    }

    .lb-nav a.lb-prev:hover,
    .lb-nav a.lb-next:hover {
        opacity: 1;
    }

    .lb-nav a.lb-prev::before,
    .lb-nav a.lb-next::before {
        font-family: "Font Awesome 6 Free";
        font-weight: 900;
        font-size: 30px;
        color: #fff;
        text-shadow: 0 0 3px rgba(0, 0, 0, 0.5);
    }

    .lb-nav a.lb-prev::before {
        content: '\f104';
        /* fa-angle-left */
    }

    .lb-nav a.lb-next::before {
        content: '\f105';
        /* fa-angle-right */
    }

    .lb-loader {
        border: 3px solid #f3f3f3;
        border-top: 3px solid #3498db;
        border-radius: 50%;
        width: 30px;
        height: 30px;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>

<!-- เนื้อหาหลักของหน้า -->
<div class="container-fluid py-4">
    <div class="card shadow mb-4">
        <div class="card-header d-flex align-items-center py-3">
            <i class="fa fa-folder-open fa-fw me-2"></i>
            <h5 class="m-0 font-weight-bold"><?= htmlspecialchars($data['folderName']) ?></h5>
        </div>

        <div class="card-body">
            <div class="row g-4">
                <?php foreach ($data['images'] as $image): ?>
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="card h-100">
                            <div class="image-container">
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
                'showImageNumberLabel': false,
                'positionFromTop': 50,
                'fadeDuration': 300,
                'alwaysShowNavOnTouchDevices': true,
                'disableScrolling': true,
                'imageFadeDuration': 300
            });

            // ฟังก์ชันสำหรับเปลี่ยนไอคอน
            function changeIcons() {
                var lightboxElement = document.getElementById('lightbox');
                if (lightboxElement) {
                    var closeButton = lightboxElement.querySelector('.lb-close');
                    if (closeButton) closeButton.innerHTML = '<i class="fas fa-times"></i>';

                    var prevButton = lightboxElement.querySelector('.lb-prev');
                    if (prevButton) {
                        prevButton.innerHTML = '<i class="fas fa-chevron-left"></i>';
                        prevButton.classList.add('fas');
                    }

                    var nextButton = lightboxElement.querySelector('.lb-next');
                    if (nextButton) {
                        nextButton.innerHTML = '<i class="fas fa-chevron-right"></i>';
                        nextButton.classList.add('fas');
                    }

                    var loader = lightboxElement.querySelector('.lb-loader');
                    if (loader) loader.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
                }
            }

            // เรียกใช้ฟังก์ชันเปลี่ยนไอคอนทุกครั้งที่ Lightbox เปิด
            document.addEventListener('shown.lightbox', changeIcons);

            // เรียกใช้ฟังก์ชันเปลี่ยนไอคอนหลังจาก Lightbox ถูกเริ่มต้น
            if (typeof lightbox.start === 'function') {
                var originalStart = lightbox.start;
                lightbox.start = function() {
                    originalStart.apply(this, arguments);
                    changeIcons();
                };
            }
        } else {
            console.error('Lightbox is not defined. Make sure it is properly loaded.');
        }
    });
</script>