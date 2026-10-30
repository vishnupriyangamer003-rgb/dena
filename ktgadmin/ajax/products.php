<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/functions.php';

$action = $_POST['action'] ?? '';

if (!csrf_verify($_POST['csrf_token'] ?? '')) {
    json_response(false, ['message' => 'Session expired. Please refresh the page and try again.']);
}

function product_meta($title, $description)
{
    return [
        'title' => $title . ' Supplier - Industrial Products | DENA',
        'description' => $title . ' supplied by Digitech Electrical & Automations (DENA). ' . $description,
        'keywords' => strtolower($title) . ', ' . strtolower($title) . ' supplier, industrial ' . strtolower($title) . ', DENA products Karur',
    ];
}

if ($action === 'add' || $action === 'edit') {
    $id = (int) ($_POST['id'] ?? 0);
    $title = trim($_POST['title'] ?? '');
    $slugInput = trim($_POST['slug'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $pointsJson = $_POST['points_json'] ?? '[]';
    $status = isset($_POST['status']) ? 1 : 0;

    if ($title === '' || $description === '') {
        json_response(false, ['message' => 'Title and description are required.']);
    }

    $meta = product_meta($title, $description);
    $metaTitle = $meta['title'];
    $metaDescription = $meta['description'];
    $metaKeywords = $meta['keywords'];

    $pointsDecoded = json_decode($pointsJson, true);
    $points = json_encode(is_array($pointsDecoded) ? array_values($pointsDecoded) : []);

    try {
        $imagePath = upload_image('image', 'products');
    } catch (RuntimeException $e) {
        json_response(false, ['message' => $e->getMessage()]);
    }

    $baseSlug = $slugInput !== '' ? $slugInput : $title;

    if ($action === 'add') {
        if (!$imagePath) {
            json_response(false, ['message' => 'Please select an image.']);
        }
        $slug = unique_slug($conn, 'tbl_products', $baseSlug);
        $nextOrderResult = mysqli_query($conn, 'SELECT COALESCE(MAX(display_order), 0) + 1 AS n FROM tbl_products');
        $displayOrder = (int) mysqli_fetch_assoc($nextOrderResult)['n'];
        $stmt = mysqli_prepare($conn, 'INSERT INTO tbl_products (slug, title, image, description, points, meta_title, meta_description, meta_keywords, display_order, status, created_at, updated_at) VALUES (?,?,?,?,?,?,?,?,?,?,NOW(),NOW())');
        mysqli_stmt_bind_param($stmt, 'ssssssssii', $slug, $title, $imagePath, $description, $points, $metaTitle, $metaDescription, $metaKeywords, $displayOrder, $status);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        json_response(true, ['message' => 'Product added successfully.']);
    } else {
        if (!$id) {
            json_response(false, ['message' => 'Invalid product.']);
        }
        $slug = unique_slug($conn, 'tbl_products', $baseSlug, $id);
        if ($imagePath) {
            $old = mysqli_fetch_assoc(mysqli_query($conn, 'SELECT image FROM tbl_products WHERE id = ' . $id));
            $stmt = mysqli_prepare($conn, 'UPDATE tbl_products SET slug=?, title=?, image=?, description=?, points=?, meta_title=?, meta_description=?, meta_keywords=?, status=?, updated_at=NOW() WHERE id=?');
            mysqli_stmt_bind_param($stmt, 'ssssssssii', $slug, $title, $imagePath, $description, $points, $metaTitle, $metaDescription, $metaKeywords, $status, $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            if ($old) {
                delete_upload($old['image']);
            }
        } else {
            $stmt = mysqli_prepare($conn, 'UPDATE tbl_products SET slug=?, title=?, description=?, points=?, meta_title=?, meta_description=?, meta_keywords=?, status=?, updated_at=NOW() WHERE id=?');
            mysqli_stmt_bind_param($stmt, 'sssssssii', $slug, $title, $description, $points, $metaTitle, $metaDescription, $metaKeywords, $status, $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
        json_response(true, ['message' => 'Product updated successfully.']);
    }
} elseif ($action === 'delete') {
    $id = (int) ($_POST['id'] ?? 0);
    if (!$id) {
        json_response(false, ['message' => 'Invalid product.']);
    }
    $row = mysqli_fetch_assoc(mysqli_query($conn, 'SELECT image FROM tbl_products WHERE id = ' . $id));
    $stmt = mysqli_prepare($conn, 'DELETE FROM tbl_products WHERE id = ?');
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
        json_response(false, ['message' => 'Invalid product.']);
    }
    mysqli_query($conn, 'UPDATE tbl_products SET status = 1 - status WHERE id = ' . $id);
    json_response(true, ['message' => 'Status updated.']);
} else {
    json_response(false, ['message' => 'Unknown action.']);
}
