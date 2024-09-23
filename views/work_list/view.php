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
</style>

<!-- เนื้อหาหลักของหน้า -->
<div class="container-fluid py-4">
    <div class="card shadow mb-4">
        <div class="card-header d-flex align-items-center py-3">
            <i class="fa fa-folder-open fa-fw me-2"></i>&nbsp;
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
                'alwaysShowNavOnTouchDevices': true
            })
        } else {
            console.error('Lightbox is not defined. Make sure it is properly loaded.');
        }
    });
</script>