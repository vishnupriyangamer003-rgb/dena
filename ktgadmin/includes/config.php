<?php
/**
 * Core configuration for the DENA admin panel (ktgadmin).
 * This file must be the first include on every entry-point page.
 */

define('KTGADMIN', true);

error_reporting(E_ALL);
ini_set('display_errors', '0');

// Paths root
define('ADMIN_ROOT', dirname(__DIR__));
define('UPLOAD_ROOT', ADMIN_ROOT . '/uploads');

// Detect environment: Local vs Live
$http_host   = $_SERVER['HTTP_HOST'] ?? '';
$server_name = $_SERVER['SERVER_NAME'] ?? '';
$remote_addr = $_SERVER['REMOTE_ADDR'] ?? '';

if ($http_host !== '') {
    $host_domain = strtolower(explode(':', $http_host)[0]);
    $is_local = in_array($host_domain, ['localhost', '127.0.0.1', '::1'], true)
        || str_ends_with($host_domain, '.local')
        || str_ends_with($host_domain, '.test');
} else {
    // CLI / Cron without HTTP_HOST
    $is_local = in_array($server_name, ['localhost', '127.0.0.1', '::1'], true)
        || DIRECTORY_SEPARATOR === '\\'
        || (isset($_SERVER['DOCUMENT_ROOT']) && stripos($_SERVER['DOCUMENT_ROOT'], 'xampp') !== false);
}

if ($is_local) {
    // Local Database (XAMPP)
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_NAME', 'dena_db');

    // Live Database as fallback
    define('DB_FALLBACK_HOST', 'localhost');
    define('DB_FALLBACK_USER', 'dena');
    define('DB_FALLBACK_PASS', 'lS@1d5ftb-78.QQz');
    define('DB_FALLBACK_NAME', 'dena');

    // Local URLs (auto-detect subdirectory or default to /vichu/dena)
    $localBase = '/vichu/dena';
    if (!empty($_SERVER['DOCUMENT_ROOT'])) {
        $docRoot = str_replace('\\', '/', realpath($_SERVER['DOCUMENT_ROOT']) ?: $_SERVER['DOCUMENT_ROOT']);
        $siteRoot = str_replace('\\', '/', dirname(ADMIN_ROOT));
        if ($docRoot !== '' && str_starts_with($siteRoot, $docRoot)) {
            $localBase = rtrim(substr($siteRoot, strlen($docRoot)), '/');
        }
    } elseif (!empty($_SERVER['SCRIPT_NAME'])) {
        $pos = strpos($_SERVER['SCRIPT_NAME'], '/ktgadmin');
        if ($pos !== false) {
            $localBase = rtrim(substr($_SERVER['SCRIPT_NAME'], 0, $pos), '/');
        }
    }
    define('SITE_URL', $localBase);
    define('ADMIN_URL', $localBase . '/ktgadmin');
} else {
    // Live Database
    define('DB_HOST', 'localhost');
    define('DB_USER', 'dena');
    define('DB_PASS', 'lS@1d5ftb-78.QQz');
    define('DB_NAME', 'dena');

    // Local Database as fallback
    define('DB_FALLBACK_HOST', 'localhost');
    define('DB_FALLBACK_USER', 'root');
    define('DB_FALLBACK_PASS', '');
    define('DB_FALLBACK_NAME', 'dena_db');

    // Live URLs (default /new or auto-detected if moved)
    $liveBase = '/new';
    if (!empty($_SERVER['SCRIPT_NAME'])) {
        $pos = strpos($_SERVER['SCRIPT_NAME'], '/ktgadmin');
        if ($pos !== false) {
            $liveBase = rtrim(substr($_SERVER['SCRIPT_NAME'], 0, $pos), '/');
        }
    }
    define('SITE_URL', $liveBase);
    define('ADMIN_URL', $liveBase . '/ktgadmin');
}

define('UPLOAD_URL', ADMIN_URL . '/uploads');

// Upload constraints
define('MAX_UPLOAD_SIZE', 2 * 1024 * 1024); // 2MB
define('ALLOWED_IMAGE_EXT', ['jpg', 'jpeg', 'png', 'webp', 'gif']);

if (session_status() === PHP_SESSION_NONE && !headers_sent()) {
    session_start();
}
