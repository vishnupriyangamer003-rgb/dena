<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/functions.php';

$action = $_POST['action'] ?? '';

if (!csrf_verify($_POST['csrf_token'] ?? '')) {
    json_response(false, ['message' => 'Session expired. Please refresh the page and try again.']);
}

$validStatuses = ['new', 'contacted', 'closed'];

if ($action === 'update_status') {
    $id = (int) ($_POST['id'] ?? 0);
    $status = $_POST['status'] ?? '';
    if (!$id || !in_array($status, $validStatuses, true)) {
        json_response(false, ['message' => 'Invalid request.']);
    }
    $stmt = mysqli_prepare($conn, 'UPDATE tbl_enquiries SET status = ? WHERE id = ?');
    mysqli_stmt_bind_param($stmt, 'si', $status, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    json_response(true, ['message' => 'Status updated.']);
} elseif ($action === 'delete') {
    $id = (int) ($_POST['id'] ?? 0);
    if (!$id) {
        json_response(false, ['message' => 'Invalid enquiry.']);
    }
    $stmt = mysqli_prepare($conn, 'DELETE FROM tbl_enquiries WHERE id = ?');
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    json_response(true, ['message' => 'Deleted successfully.']);
} else {
    json_response(false, ['message' => 'Unknown action.']);
}
