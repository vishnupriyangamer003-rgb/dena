<?php
if (!defined('KTGADMIN')) {
    http_response_code(403);
    exit('Direct access not permitted');
}

// Suppress fatal mysqli errors so fallback can execute gracefully
mysqli_report(MYSQLI_REPORT_OFF);

// Attempt primary database connection
$conn = @mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// If primary connection fails, attempt fallback database connection
if (!$conn && defined('DB_FALLBACK_NAME') && DB_FALLBACK_NAME !== '') {
    $conn = @mysqli_connect(DB_FALLBACK_HOST, DB_FALLBACK_USER, DB_FALLBACK_PASS, DB_FALLBACK_NAME);
}

if (!$conn) {
    error_log('DB connection failed: ' . mysqli_connect_error());
    die('Database connection failed. Please try again later.');
}

mysqli_set_charset($conn, 'utf8mb4');
