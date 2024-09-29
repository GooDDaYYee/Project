<?php
session_start();

$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

// Allow access to auth page without being logged in
// http://localhost/project/index.php?page=work-list&action=view&folder=test-20240922154206
if ($page !== 'auth' && (!isset($_SESSION['login']) || $_SESSION['login'] !== true)) {
    $redirect = '';
    if ($page === 'work-list' && isset($_GET['action']) && $_GET['action'] === 'view') {
        $redirect = '&redirect=' . urlencode($_SERVER['REQUEST_URI']);
    }
    header("Location: index.php?page=auth" . $redirect);
    exit();
}

// Redirect logged-in users trying to access the login page
if ($page === 'auth' && $action === 'index' && isset($_SESSION['login']) && $_SESSION['login'] === true) {
    header("Location: index.php?page=manage-file");
    exit();
}

if (isset($_GET['folder']) && !isset($_GET['page']) && !isset($_GET['action'])) {
    header("Location: index.php?page=work-list&action=view&folder=" . $_GET['folder']);
    exit();
}

switch ($page) {
    case 'auth':
        require_once 'controllers/AuthController.php';
        $controller = new AuthController();
        break;
    case 'home':
        require_once 'controllers/HomeController.php';
        $controller = new HomeController();
        break;
    case 'manage-file':
        require_once 'controllers/ManageFileController.php';
        $controller = new ManageFileController();
        break;
    case 'bill-mixed':
        require_once 'controllers/BillMixedController.php';
        $controller = new BillMixedController();
        break;
    case 'bill-fbh':
        require_once 'controllers/BillFbhController.php';
        $controller = new BillFbhController();
        break;
    case 'stock-cable':
        require_once 'controllers/StockCableController.php';
        $controller = new StockCableController();
        break;
    case 'stock-drum':
        require_once 'controllers/StockDrumController.php';
        $controller = new StockDrumController();
        break;
    case 'work-list':
        require_once 'controllers/WorkListController.php';
        $controller = new WorkListController();
        break;
    case 'work-report':
        require_once 'controllers/WorkReportController.php';
        $controller = new WorkReportController();
        break;
    case 'employee':
        require_once 'controllers/EmployeeController.php';
        $controller = new EmployeeController();
        break;
    case 'employee-salary':
        require_once 'controllers/EmployeeSalaryController.php';
        $controller = new EmployeeSalaryController();
        break;
    case 'user':
        require_once 'controllers/UserController.php';
        $controller = new UserController();
        break;
    case 'log':
        require_once 'controllers/LogController.php';
        $controller = new LogController();
        break;
    case 'edit-back':
        require_once 'controllers/EditBackController.php';
        $controller = new EditBackController();
        break;
    case 'au-page':
        require_once 'controllers/AuPageController.php';
        $controller = new AuPageController();
        break;
    default:
        $pageTitle = '404 - Page Not Found';
        $content = '404.php';
        include 'layouts/layout.php';
        break;
}

if (method_exists($controller, $action)) {
    $controller->$action();
} else {
    // 404 handling
    $pageTitle = '404 - Page Not Found';
    $content = '404.php';
    include 'layouts/layout.php';
}
