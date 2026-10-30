<?php
if (!defined('KTGADMIN')) {
    http_response_code(403);
    exit('Direct access not permitted');
}

function require_login()
{
    if (empty($_SESSION['admin_id'])) {
        header('Location: ' . ADMIN_URL . '/login.php');
        exit;
    }
}

function is_logged_in()
{
    return !empty($_SESSION['admin_id']);
}

require_login();
