<?php
require_once 'config/Database.php';

$db = Database::getInstance();
$users_id = $_SESSION['user_id'];

try {
    $sql = "SELECT users.*, employee.employee_name, employee.employee_lastname 
            FROM users 
            INNER JOIN employee ON users.employee_id = employee.employee_id 
            WHERE users.user_id = :user_id";

    $stmt = $db->getConnection()->prepare($sql);
    $stmt->bindParam(':user_id', $users_id, PDO::PARAM_INT);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Database error: " . $e->getMessage());
    $row = ['employee_name' => 'Unknown', 'employee_lastname' => 'User'];
}
?>

<style>
    .modal-dialog.modal-custom-size {
        max-width: 100%;
        width: 100%;
    }

    .sortable {
        cursor: pointer;
    }

    .sortable::after {
        content: '\f0dc';
        font-family: 'Font Awesome 5 Free';
        font-weight: 900;
        margin-left: 5px;
        color: #ccc;
    }

    .sortable.sorted-asc::after {
        content: '\f0de';
        color: #007bff;
    }

    .sortable.sorted-desc::after {
        content: '\f0dd';
        color: #007bff;
    }
</style>

<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= htmlspecialchars($row['employee_name'] . ' ' . $row['employee_lastname']) ?></span>
                <img class="img-profile rounded-circle" src="images/picture.png" alt="Profile Picture">
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>
    </ul>
</nav>

<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ต้องการออกจากระบบหรือไม่?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">ยกเลิก</button>
                <a class="btn btn-warning bg-gradient-purple" href="index.php?page=auth&action=logout">ออกจากระบบ</a>
            </div>
        </div>
    </div>
</div>