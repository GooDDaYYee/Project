<?php
session_start();
if (!$_SESSION['login']) {
    header("location: login.php");
    exit(0);
}

include_once("header.php");
?>
<style>
    /* กำหนดความสูงของ content-container และทำให้เนื้อหาภายในสามารถเลื่อนได้ */
    .content-container {
        max-height: calc(90vh);
        overflow-y: auto;
        padding-bottom: 20px;
        /* ถ้ามี */
    }
</style>
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <?php
        include_once("footer.php");
        ?>
        <div class="content-container">
            <?php
            $page = isset($_GET['page']) ? $_GET['page'] : 'home';
            $pageFile = $page . '.php';

            if (!file_exists($pageFile)) {
                $pageFile = 'home.php';
            }

            include $pageFile;
            ?>
        </div>
    </div>
</div>