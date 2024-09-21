<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="PSNK Telecom Control Panel">
    <meta name="author" content="PSNK Telecom">

    <title><?= $pageTitle ?? 'PSNK TELECOM' ?></title>

    <!-- CSS Imports -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Mitr' rel='stylesheet'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link href="assets/css/sweetalert2.min.css" rel="stylesheet">
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- Custom CSS import via Controller -->
    <?php
    if (isset($customCSS) && is_array($customCSS)) {
        foreach ($customCSS as $css) {
            echo "<link rel='stylesheet' href=\"$css\">\n";
        }
    }
    ?>

    <!-- Javascript Import -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery.easing.min.js"></script>
    <script src="assets/js/sb-admin-2.min.js"></script>
    <script src="assets/js/sweetalert2.all.min.js"></script>

    <!-- Custom javascript import via Controller -->
    <?php
    if (isset($customJS) && is_array($customJS)) {
        foreach ($customJS as $js) {
            echo "<script src=\"$js\"></script>\n";
        }
    }
    ?>

</head>

<body id="page-top">
    <div id="wrapper">
        <?php
        if ($content !== '404.php') {
            include 'sidebar.php';
        }
        ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <?php
            if ($content !== '404.php') {

                include 'header.php';
            }
            ?>
            <div id="content">
                <?php include $content; ?>
            </div>
        </div>
    </div>
</body>

</html>