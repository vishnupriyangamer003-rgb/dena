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
    $description = trim($_POST['description'] ?? '');
    $status = isset($_POST['status']) ? 1 : 0;

    if ($title === '' || $description === '') {
        json_response(false, ['message' => 'Title and description are required.']);
    }

    try {
        $imagePath = upload_image('image', 'training');
    } catch (RuntimeException $e) {
        json_response(false, ['message' => $e->getMessage()]);
    }

    $baseSlug = $slugInput !== '' ? $slugInput : $title;

    if ($action === 'add') {
        if (!$imagePath) {
            json_response(false, ['message' => 'Please select an image.']);
        }
        $slug = unique_slug($conn, 'tbl_training', $baseSlug);
        $nextOrderResult = mysqli_query($conn, 'SELECT COALESCE(MAX(display_order), 0) + 1 AS n FROM tbl_training');
        $displayOrder = (int) mysqli_fetch_assoc($nextOrderResult)['n'];
        $stmt = mysqli_prepare($conn, 'INSERT INTO tbl_training (slug, title, image, description, display_order, status, created_at, updated_at) VALUES (?,?,?,?,?,?,NOW(),NOW())');
        mysqli_stmt_bind_param($stmt, 'ssssii', $slug, $title, $imagePath, $description, $displayOrder, $status);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        json_response(true, ['message' => 'Training item added successfully.']);
    } else {
        if (!$id) {
            json_response(false, ['message' => 'Invalid item.']);
        }
        $slug = unique_slug($conn, 'tbl_training', $baseSlug, $id);
        if ($imagePath) {
            $old = mysqli_fetch_assoc(mysqli_query($conn, 'SELECT image FROM tbl_training WHERE id = ' . $id));
            $stmt = mysqli_prepare($conn, 'UPDATE tbl_training SET slug=?, title=?, image=?, description=?, status=?, updated_at=NOW() WHERE id=?');
            mysqli_stmt_bind_param($stmt, 'ssssii', $slug, $title, $imagePath, $description, $status, $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            if ($old) {
                delete_upload($old['image']);
            }
        } else {
            $stmt = mysqli_prepare($conn, 'UPDATE tbl_training SET slug=?, title=?, description=?, status=?, updated_at=NOW() WHERE id=?');
            mysqli_stmt_bind_param($stmt, 'sssii', $slug, $title, $description, $status, $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
        json_response(true, ['message' => 'Training item updated successfully.']);
    }
} elseif ($action === 'delete') {
    $id = (int) ($_POST['id'] ?? 0);
    if (!$id) {
        json_response(false, ['message' => 'Invalid item.']);
    }
    $row = mysqli_fetch_assoc(mysqli_query($conn, 'SELECT image FROM tbl_training WHERE id = ' . $id));
    $stmt = mysqli_prepare($conn, 'DELETE FROM tbl_training WHERE id = ?');
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    if ($row) {
        delete_upload($row['image']);
    }
    json_response(true, ['message' => 'Deleted successfully.']);
} elseif ($action === 'toggle_status') {
    $id = (int) ($_POST['id'] ?? 0);
    if (!$id) {
        json_response(false, ['message' => 'Invalid item.']);
    }
    mysqli_query($conn, 'UPDATE tbl_training SET status = 1 - status WHERE id = ' . $id);
    json_response(true, ['message' => 'Status updated.']);
} else {
    json_response(false, ['message' => 'Unknown action.']);
}
