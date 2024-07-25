    <?php
    session_start();
    if (!$_SESSION['login']) {
        header("location: login.php");
        exit(0);
    }

    include_once("header.php");
    include_once("footer.php");

    $page = isset($_GET['page']) ? $_GET['page'] : 'home';
    $pageFile = $page . '.php';

    if (!file_exists($pageFile)) {
        $pageFile = 'home.php';
    }

    include $pageFile;

    ?>
    <!-- ปิก tag จากไฟล์ footer.php -->
    </div>
    </div>