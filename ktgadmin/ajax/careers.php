<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/functions.php';

$action = $_POST['action'] ?? '';

if (!csrf_verify($_POST['csrf_token'] ?? '')) {
    json_response(false, ['message' => 'Session expired. Please refresh the page and try again.']);
}

if ($action === 'add' || $action === 'edit') {
    $id = (int) ($_POST['id'] ?? 0);
    $title = trim($_POST['title'] ?? '');
    $slugInput = trim($_POST['slug'] ?? '');
    $location = trim($_POST['location'] ?? '');
    $experience = trim($_POST['experience'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $status = isset($_POST['status']) ? 1 : 0;

    if ($title === '' || $description === '') {
        json_response(false, ['message' => 'Title and description are required.']);
    }

    $baseSlug = $slugInput !== '' ? $slugInput : $title;

    if ($action === 'add') {
        $slug = unique_slug($conn, 'tbl_careers', $baseSlug);
        $nextOrderResult = mysqli_query($conn, 'SELECT COALESCE(MAX(display_order), 0) + 1 AS n FROM tbl_careers');
        $displayOrder = (int) mysqli_fetch_assoc($nextOrderResult)['n'];
        $stmt = mysqli_prepare($conn, 'INSERT INTO tbl_careers (slug, title, location, experience, description, display_order, status, created_at, updated_at) VALUES (?,?,?,?,?,?,?,NOW(),NOW())');
        mysqli_stmt_bind_param($stmt, 'sssssii', $slug, $title, $location, $experience, $description, $displayOrder, $status);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        json_response(true, ['message' => 'Vacancy added successfully.']);
    } else {
        if (!$id) {
            json_response(false, ['message' => 'Invalid vacancy.']);
        }
        $slug = unique_slug($conn, 'tbl_careers', $baseSlug, $id);
        $stmt = mysqli_prepare($conn, 'UPDATE tbl_careers SET slug=?, title=?, location=?, experience=?, description=?, status=?, updated_at=NOW() WHERE id=?');
        mysqli_stmt_bind_param($stmt, 'sssssii', $slug, $title, $location, $experience, $description, $status, $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        json_response(true, ['message' => 'Vacancy updated successfully.']);
    }
} elseif ($action === 'delete') {
    $id = (int) ($_POST['id'] ?? 0);
    if (!$id) {
        json_response(false, ['message' => 'Invalid vacancy.']);
    }
    $stmt = mysqli_prepare($conn, 'DELETE FROM tbl_careers WHERE id = ?');
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    json_response(true, ['message' => 'Deleted successfully.']);
} elseif ($action === 'toggle_status') {
    $id = (int) ($_POST['id'] ?? 0);
    if (!$id) {
        json_response(false, ['message' => 'Invalid vacancy.']);
    }
    mysqli_query($conn, 'UPDATE tbl_careers SET status = 1 - status WHERE id = ' . $id);
    json_response(true, ['message' => 'Status updated.']);
} else {
    json_response(false, ['message' => 'Unknown action.']);
}
