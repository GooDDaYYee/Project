<?php
session_start();
if (!$_SESSION['login']) {
    header("location: login.php");
    exit(0);
}

include_once("header.php");
?>
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <?php
        include_once("footer.php");
        ?>
        <?php
        $page = isset($_GET['page']) ? base64_decode($_GET['page']) : 'home';
        $pageFile = $page . '.php';

        if (!file_exists($pageFile)) {
            $pageFile = 'home.php';
        }
        include $pageFile;
        ?>
    </div>
</div>