<?php
/**
 * Shared bootstrap for public-facing pages: gives them the same DB connection
 * and helper functions (upload_url, clean, decode_list, etc.) as the admin panel,
 * without duplicating that code.
 */

require_once __DIR__ . '/ktgadmin/includes/config.php';
require_once __DIR__ . '/ktgadmin/includes/db.php';
require_once __DIR__ . '/ktgadmin/includes/functions.php';

/**
 * Fetch all active rows from a table, ordered for display.
 */
function fe_active_rows($conn, $table, $orderBy = 'display_order ASC, id ASC', $limit = null)
{
    $sql = "SELECT * FROM `$table` WHERE status = 1 ORDER BY $orderBy";
    if ($limit !== null) {
        $sql .= ' LIMIT ' . (int) $limit;
    }
    $result = mysqli_query($conn, $sql);
    $rows = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
    }
    return $rows;
}

/**
 * Fetch a single active row by slug, or null if not found / inactive.
 */
function fe_find_by_slug($conn, $table, $slug)
{
    $stmt = mysqli_prepare($conn, "SELECT * FROM `$table` WHERE slug = ? AND status = 1 LIMIT 1");
    mysqli_stmt_bind_param($stmt, 's', $slug);
    mysqli_stmt_execute($stmt);
    $row = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    mysqli_stmt_close($stmt);
    return $row ?: null;
}

/**
 * Read a single value from tbl_settings.
 */
function fe_setting($conn, $key, $default = '')
{
    $stmt = mysqli_prepare($conn, 'SELECT setting_value FROM tbl_settings WHERE setting_key = ? LIMIT 1');
    mysqli_stmt_bind_param($stmt, 's', $key);
    mysqli_stmt_execute($stmt);
    $row = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    mysqli_stmt_close($stmt);
    return $row ? $row['setting_value'] : $default;
}
