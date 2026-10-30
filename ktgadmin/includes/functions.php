<?php
if (!defined('KTGADMIN')) {
    http_response_code(403);
    exit('Direct access not permitted');
}

function clean($str)
{
    return htmlspecialchars(trim((string) $str), ENT_QUOTES, 'UTF-8');
}

function slugify($text)
{
    $text = strtolower(trim((string) $text));
    $text = preg_replace('/[^a-z0-9]+/', '-', $text);
    $text = trim($text, '-');
    $text = preg_replace('/-+/', '-', $text);
    return $text === '' ? 'item' : $text;
}

/**
 * Generate a unique slug for a table, appending -2, -3, ... on collision.
 * $ignoreId excludes a row (used when editing so a record doesn't collide with itself).
 */
function unique_slug($conn, $table, $baseSlug, $ignoreId = null)
{
    $baseSlug = slugify($baseSlug);
    $slug = $baseSlug;
    $i = 2;
    while (true) {
        if ($ignoreId !== null) {
            $stmt = mysqli_prepare($conn, "SELECT id FROM `$table` WHERE slug = ? AND id != ? LIMIT 1");
            mysqli_stmt_bind_param($stmt, 'si', $slug, $ignoreId);
        } else {
            $stmt = mysqli_prepare($conn, "SELECT id FROM `$table` WHERE slug = ? LIMIT 1");
            mysqli_stmt_bind_param($stmt, 's', $slug);
        }
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($res) === 0) {
            mysqli_stmt_close($stmt);
            return $slug;
        }
        mysqli_stmt_close($stmt);
        $slug = $baseSlug . '-' . $i;
        $i++;
    }
}

function csrf_token()
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function csrf_field()
{
    return '<input type="hidden" name="csrf_token" value="' . csrf_token() . '">';
}

function csrf_verify($token)
{
    return !empty($_SESSION['csrf_token']) && !empty($token) && hash_equals($_SESSION['csrf_token'], $token);
}

function flash_set($type, $message)
{
    $_SESSION['flash'] = ['type' => $type, 'message' => $message];
}

function flash_get()
{
    if (empty($_SESSION['flash'])) {
        return null;
    }
    $flash = $_SESSION['flash'];
    unset($_SESSION['flash']);
    return $flash;
}

/**
 * Handle an image upload from $_FILES[$field]. Returns relative path (e.g. "panels/xyz.jpg")
 * on success, or null if no file was uploaded, or throws RuntimeException on validation failure.
 */
function upload_image($field, $subfolder)
{
    if (empty($_FILES[$field]) || $_FILES[$field]['error'] === UPLOAD_ERR_NO_FILE) {
        return null;
    }

    $file = $_FILES[$field];

    if ($file['error'] !== UPLOAD_ERR_OK) {
        throw new RuntimeException('File upload failed (error code ' . $file['error'] . ').');
    }

    if ($file['size'] > MAX_UPLOAD_SIZE) {
        throw new RuntimeException('Image is too large. Maximum size is 2MB.');
    }

    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, ALLOWED_IMAGE_EXT, true)) {
        throw new RuntimeException('Invalid image type. Allowed: ' . implode(', ', ALLOWED_IMAGE_EXT) . '.');
    }

    if (@getimagesize($file['tmp_name']) === false) {
        throw new RuntimeException('The uploaded file is not a valid image.');
    }

    $targetDir = UPLOAD_ROOT . '/' . $subfolder;
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true);
    }

    $filename = uniqid($subfolder . '_', true) . '.' . $ext;
    $filename = preg_replace('/[^a-zA-Z0-9._-]/', '', $filename);
    $destination = $targetDir . '/' . $filename;

    if (!move_uploaded_file($file['tmp_name'], $destination)) {
        throw new RuntimeException('Could not save the uploaded image.');
    }

    return $subfolder . '/' . $filename;
}

function delete_upload($relativePath)
{
    if (empty($relativePath)) {
        return;
    }
    $full = UPLOAD_ROOT . '/' . ltrim($relativePath, '/');
    if (is_file($full)) {
        @unlink($full);
    }
}

function upload_url($relativePath)
{
    if (empty($relativePath)) {
        return '';
    }
    return UPLOAD_URL . '/' . ltrim($relativePath, '/');
}

function json_response($success, $data = [])
{
    header('Content-Type: application/json');
    echo json_encode(array_merge(['success' => $success], $data));
    exit;
}

function status_badge($status)
{
    return $status
        ? '<span class="badge bg-success">Active</span>'
        : '<span class="badge bg-secondary">Inactive</span>';
}

function decode_list($json)
{
    $data = json_decode((string) $json, true);
    return is_array($data) ? $data : [];
}
