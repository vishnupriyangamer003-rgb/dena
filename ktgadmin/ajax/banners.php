<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/functions.php';

$action = $_POST['action'] ?? '';

if (!csrf_verify($_POST['csrf_token'] ?? '')) {
    json_response(false, ['message' => 'Session expired. Please refresh the page and try again.']);
}

// Buttons are static site-wide (not per-banner) - fixed defaults used for every slide.
const STATIC_BTN1_TEXT = 'Explore Panels';
const STATIC_BTN1_LINK = 'panels.php';
const STATIC_BTN2_TEXT = 'Get a Quote';
const STATIC_BTN2_LINK = 'contact.php';

if ($action === 'add' || $action === 'edit') {
    $id = (int) ($_POST['id'] ?? 0);
    $heading = trim($_POST['heading'] ?? '');
    $subheading = trim($_POST['subheading'] ?? '');
    $status = isset($_POST['status']) ? 1 : 0;

    if ($heading === '') {
        json_response(false, ['message' => 'Heading is required.']);
    }

    try {
        $imagePath = upload_image('image', 'banners');
    } catch (RuntimeException $e) {
        json_response(false, ['message' => $e->getMessage()]);
    }

    if ($action === 'add') {
        if (!$imagePath) {
            json_response(false, ['message' => 'Please select a banner image.']);
        }
        $nextOrderResult = mysqli_query($conn, 'SELECT COALESCE(MAX(display_order), 0) + 1 AS n FROM tbl_banners');
        $displayOrder = (int) mysqli_fetch_assoc($nextOrderResult)['n'];
        $btn1Text = STATIC_BTN1_TEXT;
        $btn1Link = STATIC_BTN1_LINK;
        $btn2Text = STATIC_BTN2_TEXT;
        $btn2Link = STATIC_BTN2_LINK;
        $stmt = mysqli_prepare($conn, 'INSERT INTO tbl_banners (image, heading, subheading, btn1_text, btn1_link, btn2_text, btn2_link, display_order, status, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())');
        mysqli_stmt_bind_param($stmt, 'sssssssii', $imagePath, $heading, $subheading, $btn1Text, $btn1Link, $btn2Text, $btn2Link, $displayOrder, $status);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        json_response(true, ['message' => 'Banner added successfully.']);
    } else {
        if (!$id) {
            json_response(false, ['message' => 'Invalid banner.']);
        }
        if ($imagePath) {
            $old = mysqli_fetch_assoc(mysqli_query($conn, 'SELECT image FROM tbl_banners WHERE id = ' . $id));
            $stmt = mysqli_prepare($conn, 'UPDATE tbl_banners SET image=?, heading=?, subheading=?, status=?, updated_at=NOW() WHERE id=?');
            mysqli_stmt_bind_param($stmt, 'sssii', $imagePath, $heading, $subheading, $status, $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            if ($old) {
                delete_upload($old['image']);
            }
        } else {
            $stmt = mysqli_prepare($conn, 'UPDATE tbl_banners SET heading=?, subheading=?, status=?, updated_at=NOW() WHERE id=?');
            mysqli_stmt_bind_param($stmt, 'ssii', $heading, $subheading, $status, $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
        json_response(true, ['message' => 'Banner updated successfully.']);
    }
} elseif ($action === 'delete') {
    $id = (int) ($_POST['id'] ?? 0);
    if (!$id) {
        json_response(false, ['message' => 'Invalid banner.']);
    }
    $row = mysqli_fetch_assoc(mysqli_query($conn, 'SELECT image FROM tbl_banners WHERE id = ' . $id));
    $stmt = mysqli_prepare($conn, 'DELETE FROM tbl_banners WHERE id = ?');
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
        json_response(false, ['message' => 'Invalid banner.']);
    }
    mysqli_query($conn, 'UPDATE tbl_banners SET status = 1 - status WHERE id = ' . $id);
    json_response(true, ['message' => 'Status updated.']);
} else {
    json_response(false, ['message' => 'Unknown action.']);
}
