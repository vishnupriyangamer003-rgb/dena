<?php
/**
 * Public endpoint that saves a contact-form enquiry to the database and
 * returns a ready-to-open WhatsApp link built from the admin-configured
 * WhatsApp number (Settings > Site Information).
 *
 * NOT YET WIRED to any existing frontend page (contact.php still has
 * action="#"). This file is groundwork for the frontend-integration phase.
 *
 * Expected POST fields: name, phone, email (optional), subject (optional),
 * message (optional), source (optional, defaults to "contact_form").
 * Returns JSON: { success, message, whatsapp_url }
 */

require_once __DIR__ . '/ktgadmin/includes/config.php';
require_once __DIR__ . '/ktgadmin/includes/db.php';
require_once __DIR__ . '/ktgadmin/includes/functions.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    json_response(false, ['message' => 'Invalid request method.']);
}

$name = trim($_POST['name'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$email = trim($_POST['email'] ?? '');
$subject = trim($_POST['subject'] ?? '');
$message = trim($_POST['message'] ?? '');
$source = trim($_POST['source'] ?? 'contact_form');
if (!in_array($source, ['contact_form', 'enquire_modal'], true)) {
    $source = 'contact_form';
}

if ($name === '' || $phone === '') {
    json_response(false, ['message' => 'Name and phone number are required.']);
}

$stmt = mysqli_prepare($conn, 'INSERT INTO tbl_enquiries (name, phone, email, subject, message, source, status, created_at) VALUES (?, ?, ?, ?, ?, ?, \'new\', NOW())');
mysqli_stmt_bind_param($stmt, 'ssssss', $name, $phone, $email, $subject, $message, $source);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

$settingResult = mysqli_query($conn, "SELECT setting_value FROM tbl_settings WHERE setting_key = 'whatsapp_number' LIMIT 1");
$settingRow = mysqli_fetch_assoc($settingResult);
$whatsappNumber = $settingRow['setting_value'] ?? '919787774321';

$lines = ['New Enquiry from DENA Website', 'Name: ' . $name, 'Phone: ' . $phone];
if ($email !== '') {
    $lines[] = 'Email: ' . $email;
}
if ($subject !== '') {
    $lines[] = 'Subject: ' . $subject;
}
if ($message !== '') {
    $lines[] = 'Message: ' . $message;
}

$whatsappUrl = 'https://wa.me/' . $whatsappNumber . '?text=' . rawurlencode(implode("\n", $lines));

json_response(true, [
    'message' => 'Thank you! Your enquiry has been received.',
    'whatsapp_url' => $whatsappUrl,
]);
