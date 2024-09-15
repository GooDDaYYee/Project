<?php
session_start();

$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

// Allow access to auth page without being logged in
if ($page !== 'auth' && (!isset($_SESSION['login']) || $_SESSION['login'] !== true)) {
    header("Location: index.php?page=auth");
    exit();
}

// Redirect logged-in users trying to access the login page
if ($page === 'auth' && $action === 'index' && isset($_SESSION['login']) && $_SESSION['login'] === true) {
    header("Location: index.php?page=home");
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
