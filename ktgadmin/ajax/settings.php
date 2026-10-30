<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/functions.php';

$action = $_POST['action'] ?? '';

if (!csrf_verify($_POST['csrf_token'] ?? '')) {
    json_response(false, ['message' => 'Session expired. Please refresh the page and try again.']);
}

if ($action === 'update_account') {
    $adminId = (int) $_SESSION['admin_id'];
    $username = trim($_POST['username'] ?? '');
    $password = (string) ($_POST['password'] ?? '');
    $whatsappSuffix = preg_replace('/\D/', '', $_POST['whatsapp_suffix'] ?? '');
    $careersCvEmail = trim($_POST['careers_cv_email'] ?? '');

    if ($username === '' || $password === '') {
        json_response(false, ['message' => 'Username and password are required.']);
    }
    if (strlen($password) < 6) {
        json_response(false, ['message' => 'Password must be at least 6 characters.']);
    }
    if ($whatsappSuffix === '' || $careersCvEmail === '') {
        json_response(false, ['message' => 'WhatsApp number and Careers CV email are required.']);
    }
    if (strlen($whatsappSuffix) !== 10) {
        json_response(false, ['message' => 'WhatsApp number must be exactly 10 digits (excluding the +91 country code).']);
    }

    $whatsappNumber = '91' . $whatsappSuffix;

    $stmt = mysqli_prepare($conn, 'SELECT id FROM tbl_admin WHERE username = ? AND id != ?');
    mysqli_stmt_bind_param($stmt, 'si', $username, $adminId);
    mysqli_stmt_execute($stmt);
    if (mysqli_num_rows(mysqli_stmt_get_result($stmt)) > 0) {
        mysqli_stmt_close($stmt);
        json_response(false, ['message' => 'This username is already taken.']);
    }
    mysqli_stmt_close($stmt);

    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = mysqli_prepare($conn, 'UPDATE tbl_admin SET username = ?, password = ?, password_plain = ?, updated_at = NOW() WHERE id = ?');
    mysqli_stmt_bind_param($stmt, 'sssi', $username, $hash, $password, $adminId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    $_SESSION['admin_username'] = $username;

    foreach (['whatsapp_number' => $whatsappNumber, 'careers_cv_email' => $careersCvEmail] as $key => $value) {
        $stmt = mysqli_prepare($conn, 'INSERT INTO tbl_settings (setting_key, setting_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE setting_value = ?');
        mysqli_stmt_bind_param($stmt, 'sss', $key, $value, $value);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    json_response(true, ['message' => 'Settings updated successfully.']);
} else {
    json_response(false, ['message' => 'Unknown action.']);
}
