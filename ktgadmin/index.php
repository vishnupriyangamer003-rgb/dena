<?php
require_once __DIR__ . '/includes/config.php';

if (!empty($_SESSION['admin_id'])) {
    header('Location: ' . ADMIN_URL . '/dashboard.php');
} else {
    header('Location: ' . ADMIN_URL . '/login.php');
}
exit;
