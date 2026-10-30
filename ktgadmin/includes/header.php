<?php
if (!defined('KTGADMIN')) {
    http_response_code(403);
    exit('Direct access not permitted');
}
$adminUsername = $_SESSION['admin_username'] ?? 'Admin';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo isset($pageTitle) ? clean($pageTitle) . ' - ' : ''; ?>Digitech Admin</title>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo SITE_URL; ?>/img/logo/dena-favicon.png">
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>/fontawesome-pro/css/all.min.css">
    <link rel="stylesheet" href="<?php echo ADMIN_URL; ?>/css/admin.css">
</head>
<body>
<div class="admin-wrapper">
    <header class="admin-topbar">
        <button type="button" class="sidebar-toggle-btn" id="sidebarToggleBtn" aria-label="Toggle sidebar">
            <i class="fa-light fa-bars"></i>
        </button>
        <div class="admin-topbar-brand">
            <img src="<?php echo SITE_URL; ?>/img/logo/dena-logo-png.png" alt="Digitech">
        </div>
        <div class="admin-topbar-profile dropdown">
            <button class="btn dropdown-toggle admin-profile-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-light fa-circle-user"></i> <?php echo clean($adminUsername); ?>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="<?php echo ADMIN_URL; ?>/settings/index.php"><i class="fa-light fa-gear"></i> Settings</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-danger" href="<?php echo ADMIN_URL; ?>/logout.php"><i class="fa-light fa-right-from-bracket"></i> Logout</a></li>
            </ul>
        </div>
    </header>
    <div class="admin-body">
