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
    $altText = trim($_POST['alt_text'] ?? '');
    $status = isset($_POST['status']) ? 1 : 0;

    if ($altText === '') {
        json_response(false, ['message' => 'Title / alt text is required.']);
    }

    try {
        $imagePath = upload_image('image', 'network');
    } catch (RuntimeException $e) {
        json_response(false, ['message' => $e->getMessage()]);
    }

    if ($action === 'add') {
        if (!$imagePath) {
            json_response(false, ['message' => 'Please select an image.']);
        }
        $nextOrderResult = mysqli_query($conn, 'SELECT COALESCE(MAX(display_order), 0) + 1 AS n FROM tbl_network');
        $displayOrder = (int) mysqli_fetch_assoc($nextOrderResult)['n'];
        $stmt = mysqli_prepare($conn, 'INSERT INTO tbl_network (image, alt_text, display_order, status, created_at) VALUES (?, ?, ?, ?, NOW())');
        mysqli_stmt_bind_param($stmt, 'ssii', $imagePath, $altText, $displayOrder, $status);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        json_response(true, ['message' => 'Network item added successfully.']);
    } else {
        if (!$id) {
            json_response(false, ['message' => 'Invalid item.']);
        }
        if ($imagePath) {
            $old = mysqli_fetch_assoc(mysqli_query($conn, 'SELECT image FROM tbl_network WHERE id = ' . $id));
            $stmt = mysqli_prepare($conn, 'UPDATE tbl_network SET image = ?, alt_text = ?, status = ? WHERE id = ?');
            mysqli_stmt_bind_param($stmt, 'ssii', $imagePath, $altText, $status, $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            if ($old) {
                delete_upload($old['image']);
            }
        } else {
            $stmt = mysqli_prepare($conn, 'UPDATE tbl_network SET alt_text = ?, status = ? WHERE id = ?');
            mysqli_stmt_bind_param($stmt, 'sii', $altText, $status, $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
        json_response(true, ['message' => 'Network item updated successfully.']);
    }
} elseif ($action === 'delete') {
    $id = (int) ($_POST['id'] ?? 0);
    if (!$id) {
        json_response(false, ['message' => 'Invalid item.']);
    }
    $row = mysqli_fetch_assoc(mysqli_query($conn, 'SELECT image FROM tbl_network WHERE id = ' . $id));
    $stmt = mysqli_prepare($conn, 'DELETE FROM tbl_network WHERE id = ?');
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
    mysqli_query($conn, 'UPDATE tbl_network SET status = 1 - status WHERE id = ' . $id);
    json_response(true, ['message' => 'Status updated.']);
} else {
    json_response(false, ['message' => 'Unknown action.']);
}
