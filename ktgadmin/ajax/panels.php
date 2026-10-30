<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/functions.php';

$action = $_POST['action'] ?? '';

if (!csrf_verify($_POST['csrf_token'] ?? '')) {
    json_response(false, ['message' => 'Session expired. Please refresh the page and try again.']);
}

function panel_meta($title, $shortDescription)
{
    return [
        'title' => $title . ' - Electrical Control Panel Manufacturer | DENA',
        'description' => $shortDescription . ' Engineered and manufactured by Digitech Electrical & Automations (DENA).',
        'keywords' => strtolower($title) . ', ' . strtolower($title) . ' manufacturer, electrical control panel, DENA panel manufacturer, industrial control panel Karur',
    ];
}

if ($action === 'add' || $action === 'edit') {
    $id = (int) ($_POST['id'] ?? 0);
    $title = trim($_POST['title'] ?? '');
    $slugInput = trim($_POST['slug'] ?? '');
    $shortDescription = trim($_POST['short_description'] ?? '');
    $overview = trim($_POST['overview'] ?? '');
    $specsJson = $_POST['specs_json'] ?? '{}';
    $applicationsJson = $_POST['applications_json'] ?? '[]';
    $featuresJson = $_POST['features_json'] ?? '[]';

    if ($title === '' || $shortDescription === '') {
        json_response(false, ['message' => 'Title and short description are required.']);
    }

    $meta = panel_meta($title, $shortDescription);
    $metaTitle = $meta['title'];
    $metaDescription = $meta['description'];
    $metaKeywords = $meta['keywords'];

    $specsDecoded = json_decode($specsJson, true);
    $applicationsDecoded = json_decode($applicationsJson, true);
    $featuresDecoded = json_decode($featuresJson, true);
    $specs = json_encode(is_array($specsDecoded) ? $specsDecoded : []);
    $applications = json_encode(is_array($applicationsDecoded) ? array_values($applicationsDecoded) : []);
    $features = json_encode(is_array($featuresDecoded) ? array_values($featuresDecoded) : []);

    try {
        $imagePath = upload_image('image', 'panels');
    } catch (RuntimeException $e) {
        json_response(false, ['message' => $e->getMessage()]);
    }

    $baseSlug = $slugInput !== '' ? $slugInput : $title;

    if ($action === 'add') {
        if (!$imagePath) {
            json_response(false, ['message' => 'Please select an image.']);
        }
        $slug = unique_slug($conn, 'tbl_panels', $baseSlug);
        $nextOrderResult = mysqli_query($conn, 'SELECT COALESCE(MAX(display_order), 0) + 1 AS n FROM tbl_panels');
        $displayOrder = (int) mysqli_fetch_assoc($nextOrderResult)['n'];
        $status = isset($_POST['status']) ? 1 : 0;
        $stmt = mysqli_prepare($conn, 'INSERT INTO tbl_panels (slug, title, short_description, image, overview, specs, applications, features, meta_title, meta_description, meta_keywords, display_order, status, created_at, updated_at) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,NOW(),NOW())');
        mysqli_stmt_bind_param($stmt, 'sssssssssssii', $slug, $title, $shortDescription, $imagePath, $overview, $specs, $applications, $features, $metaTitle, $metaDescription, $metaKeywords, $displayOrder, $status);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        json_response(true, ['message' => 'Panel added successfully.']);
    } else {
        if (!$id) {
            json_response(false, ['message' => 'Invalid panel.']);
        }
        $slug = unique_slug($conn, 'tbl_panels', $baseSlug, $id);
        $status = isset($_POST['status']) ? 1 : 0;
        if ($imagePath) {
            $old = mysqli_fetch_assoc(mysqli_query($conn, 'SELECT image FROM tbl_panels WHERE id = ' . $id));
            $stmt = mysqli_prepare($conn, 'UPDATE tbl_panels SET slug=?, title=?, short_description=?, image=?, overview=?, specs=?, applications=?, features=?, meta_title=?, meta_description=?, meta_keywords=?, status=?, updated_at=NOW() WHERE id=?');
            mysqli_stmt_bind_param($stmt, 'sssssssssssii', $slug, $title, $shortDescription, $imagePath, $overview, $specs, $applications, $features, $metaTitle, $metaDescription, $metaKeywords, $status, $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            if ($old) {
                delete_upload($old['image']);
            }
        } else {
            $stmt = mysqli_prepare($conn, 'UPDATE tbl_panels SET slug=?, title=?, short_description=?, overview=?, specs=?, applications=?, features=?, meta_title=?, meta_description=?, meta_keywords=?, status=?, updated_at=NOW() WHERE id=?');
            mysqli_stmt_bind_param($stmt, 'ssssssssssii', $slug, $title, $shortDescription, $overview, $specs, $applications, $features, $metaTitle, $metaDescription, $metaKeywords, $status, $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
        json_response(true, ['message' => 'Panel updated successfully.']);
    }
} elseif ($action === 'delete') {
    $id = (int) ($_POST['id'] ?? 0);
    if (!$id) {
        json_response(false, ['message' => 'Invalid panel.']);
    }
    $row = mysqli_fetch_assoc(mysqli_query($conn, 'SELECT image FROM tbl_panels WHERE id = ' . $id));
    $stmt = mysqli_prepare($conn, 'DELETE FROM tbl_panels WHERE id = ?');
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
        json_response(false, ['message' => 'Invalid panel.']);
    }
    mysqli_query($conn, 'UPDATE tbl_panels SET status = 1 - status WHERE id = ' . $id);
    json_response(true, ['message' => 'Status updated.']);
} else {
    json_response(false, ['message' => 'Unknown action.']);
}
