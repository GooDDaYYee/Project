<?php
function isActive($page)
{
    $currentPage = isset($_GET['page']) ? $_GET['page'] : 'home';
    echo $currentPage === $page ? 'active' : '';
}
?>

<ul class="navbar-nav bg-gradient-purple sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php?page=home">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="warning">P</i>
        </div>
        <div class="sidebar-brand-text mx-1">snktelecom<sup class="warning">CP</sup></div>
    </a>

    <hr class="sidebar-divider">

    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-align-justify"></i>
            <span>Menu</span>
        </a>
        <div id="collapseTwo" class="collapse show bg-gradient-purple2" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header collapseTwo"><i class="fa-solid fa-file-zipper"></i> ไฟล์</h6>
                <a class="collapse-item <?php isActive('home') ?>" href="index.php?page=home">&nbsp; แชร์ไฟล์</a>
                <?php if (in_array($_SESSION["lv"], [0, 1, 2])): ?>
                    <a class="collapse-item <?php isActive('manage-file') ?>" href="index.php?page=manage-file">&nbsp; จัดการไฟล์</a>
                <?php endif; ?>
            </div>

            <?php if (in_array($_SESSION["lv"], [0, 1, 2])): ?>
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header"><i class="fa-solid fa-file"></i> เอกสารบิล</h6>
                    <a class="collapse-item <?php isActive('bill-mixed') ?>" href="index.php?page=bill-mixed">&nbsp; บริษัท Mixed</a>
                    <a class="collapse-item <?php isActive('bill-fbh') ?>" href="index.php?page=bill-fbh">&nbsp; บริษัท FBH</a>
                </div>
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header"><i class="fa-solid fa-layer-group"></i> สต๊อก</h6>
                    <a class="collapse-item <?php isActive('stock-cable') ?>" href="index.php?page=stock-cable">&nbsp; จัดการ Cable</a>
                    <a class="collapse-item <?php isActive('stock-drum') ?>" href="index.php?page=stock-drum">&nbsp; จัดการ Drum</a>
                </div>
            <?php endif; ?>

            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header"><i class="fa-solid fa-layer-group"></i> รายงาน</h6>
                <a class="collapse-item <?php isActive('work-list') ?>" href="index.php?page=work-list">&nbsp; รายการปฏิบัติงาน</a>
                <a class="collapse-item <?php isActive('work-report') ?>" href="index.php?page=work-report">&nbsp; รายงานปฏิบัติงาน</a>
            </div>

            <?php if (in_array($_SESSION["lv"], [0, 1])): ?>
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header"><i class="fa-solid fa-user"></i> พนักงาน</h6>
                    <a class="collapse-item <?php isActive('employee') ?>" href="index.php?page=employee">&nbsp; จัดการข้อมูลพนักงาน</a>
                    <a class="collapse-item <?php isActive('employee-salary') ?>" href="index.php?page=employee-salary">&nbsp; จัดการเงินเดือน</a>
                </div>
            <?php endif; ?>

            <?php if ($_SESSION["lv"] == 0): ?>
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header"><i class="fa-solid fa-users"></i> ผู้ใช้</h6>
                    <a class="collapse-item <?php isActive('user') ?>" href="index.php?page=user">&nbsp; จัดการผู้ใช้</a>
                    <a class="collapse-item <?php isActive('log') ?>" href="index.php?page=log">&nbsp; ประวัติการใช้งาน</a>
                </div>
            <?php endif; ?>
        </div>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>