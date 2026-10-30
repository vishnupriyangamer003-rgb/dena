<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/functions.php';

$action = $_POST['action'] ?? '';

if (!csrf_verify($_POST['csrf_token'] ?? '')) {
    json_response(false, ['message' => 'Session expired. Please refresh the page and try again.']);
}

if ($action === 'update_account') {
    $adminId = (int) $_SESSION['admin_id'];
    $username = trim($_POST['username'] ?? '');
    $password = (string) ($_POST['password'] ?? '');

    if ($username === '' || $password === '') {
        json_response(false, ['message' => 'Username and password are required.']);
    }
    if (strlen($password) < 6) {
        json_response(false, ['message' => 'Password must be at least 6 characters.']);
    }

    $stmt = mysqli_prepare($conn, 'SELECT id FROM tbl_admin WHERE username = ? AND id != ?');
    mysqli_stmt_bind_param($stmt, 'si', $username, $adminId);
    mysqli_stmt_execute($stmt);
    if (mysqli_num_rows(mysqli_stmt_get_result($stmt)) > 0) {
        mysqli_stmt_close($stmt);
        json_response(false, ['message' => 'This username is already taken.']);
    }
    mysqli_stmt_close($stmt);

    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = mysqli_prepare($conn, 'UPDATE tbl_admin SET username = ?, password = ?, password_plain = ?, updated_at = NOW() WHERE id = ?');
    mysqli_stmt_bind_param($stmt, 'sssi', $username, $hash, $password, $adminId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    $_SESSION['admin_username'] = $username;

    json_response(true, ['message' => 'Account settings updated successfully.']);
} elseif ($action === 'update_general') {
    $whatsappSuffix = preg_replace('/\D/', '', $_POST['whatsapp_suffix'] ?? '');
    $siteEmail = trim($_POST['site_email'] ?? '');
    $careersCvEmail = trim($_POST['careers_cv_email'] ?? '');
    $experienceYears = preg_replace('/\D/', '', $_POST['experience_years'] ?? '');
    $phone1 = trim($_POST['site_phone1'] ?? '');
    $phone2 = trim($_POST['site_phone2'] ?? '');
    $phone3 = trim($_POST['site_phone3'] ?? '');
    $headOffice = trim($_POST['head_office_address'] ?? '');
    $maduraiBranch = trim($_POST['branch_madurai_address'] ?? '');
    $coimbatoreBranch = trim($_POST['branch_coimbatore_address'] ?? '');
    $hoursWeekday = trim($_POST['working_hours_weekday'] ?? '');
    $hoursSunday = trim($_POST['working_hours_sunday'] ?? '');
    $mapEmbedUrl = trim($_POST['map_embed_url'] ?? '');

    if ($whatsappSuffix === '' || strlen($whatsappSuffix) !== 10) {
        json_response(false, ['message' => 'WhatsApp number must be exactly 10 digits (excluding the +91 country code).']);
    }
    if ($siteEmail === '' || !filter_var($siteEmail, FILTER_VALIDATE_EMAIL)) {
        json_response(false, ['message' => 'Site Email must be a valid email address.']);
    }
    if ($careersCvEmail === '' || !filter_var($careersCvEmail, FILTER_VALIDATE_EMAIL)) {
        json_response(false, ['message' => 'Careers CV Email must be a valid email address.']);
    }
    $experienceYearsInt = (int) $experienceYears;
    if ($experienceYears === '' || $experienceYearsInt < 1 || $experienceYearsInt > 99) {
        json_response(false, ['message' => 'Years of Experience must be a number between 1 and 99.']);
    }
    if ($phone1 === '' || $headOffice === '' || $hoursWeekday === '' || $hoursSunday === '') {
        json_response(false, ['message' => 'Phone 1, Head Office address and Working Hours are required.']);
    }
    if ($mapEmbedUrl === '' || !filter_var($mapEmbedUrl, FILTER_VALIDATE_URL) || strpos($mapEmbedUrl, 'http') !== 0) {
        json_response(false, ['message' => 'Google Map Embed URL must be a valid URL starting with http:// or https://.']);
    }

    $values = [
        'whatsapp_number' => '91' . $whatsappSuffix,
        'site_email' => $siteEmail,
        'careers_cv_email' => $careersCvEmail,
        'experience_years' => (string) $experienceYearsInt,
        'site_phone1' => $phone1,
        'site_phone2' => $phone2,
        'site_phone3' => $phone3,
        'head_office_address' => $headOffice,
        'branch_madurai_address' => $maduraiBranch,
        'branch_coimbatore_address' => $coimbatoreBranch,
        'working_hours_weekday' => $hoursWeekday,
        'working_hours_sunday' => $hoursSunday,
        'map_embed_url' => $mapEmbedUrl,
    ];
    foreach ($values as $key => $value) {
        $stmt = mysqli_prepare($conn, 'INSERT INTO tbl_settings (setting_key, setting_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE setting_value = ?');
        mysqli_stmt_bind_param($stmt, 'sss', $key, $value, $value);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    json_response(true, ['message' => 'Contact & general settings updated successfully.']);
} elseif ($action === 'update_social') {
    $socialKeys = ['facebook_url', 'instagram_url', 'twitter_url', 'linkedin_url'];
    $values = [];
    foreach ($socialKeys as $key) {
        $value = trim($_POST[$key] ?? '');
        if ($value === '') {
            $value = '#';
        } elseif ($value !== '#' && !filter_var($value, FILTER_VALIDATE_URL)) {
            json_response(false, ['message' => 'All social links must be valid URLs (or leave blank / #).']);
        }
        $values[$key] = $value;
    }
    foreach ($values as $key => $value) {
        $stmt = mysqli_prepare($conn, 'INSERT INTO tbl_settings (setting_key, setting_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE setting_value = ?');
        mysqli_stmt_bind_param($stmt, 'sss', $key, $value, $value);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    json_response(true, ['message' => 'Social links updated successfully.']);
} else {
    json_response(false, ['message' => 'Unknown action.']);
}
