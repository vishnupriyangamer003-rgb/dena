<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/functions.php';

$stmt = mysqli_prepare($conn, 'SELECT username, password_plain FROM tbl_admin WHERE id = ?');
mysqli_stmt_bind_param($stmt, 'i', $_SESSION['admin_id']);
mysqli_stmt_execute($stmt);
$admin = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

$settingsResult = mysqli_query($conn, "SELECT setting_key, setting_value FROM tbl_settings WHERE setting_key IN ('whatsapp_number', 'careers_cv_email')");
$settings = [];
while ($row = mysqli_fetch_assoc($settingsResult)) {
    $settings[$row['setting_key']] = $row['setting_value'];
}
$whatsappFull = $settings['whatsapp_number'] ?? '91';
$whatsappSuffix = strpos($whatsappFull, '91') === 0 ? substr($whatsappFull, 2) : $whatsappFull;

$pageTitle = 'Settings';
$activeModule = 'settings';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/sidebar.php';
?>
<div class="page-header">
    <h1>Settings</h1>
</div>

<div class="row g-3">
    <div class="col-lg-6">
        <div class="admin-card">
            <h5 class="mb-3"><i class="fa-light fa-user-shield"></i> Account Settings</h5>
            <form class="ajax-form-simple" action="../ajax/settings.php" method="post">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="action" value="update_account">
                <div class="mb-3">
                    <label class="form-label required">Username</label>
                    <input type="text" name="username" class="form-control" required value="<?php echo clean($admin['username']); ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label required">Password</label>
                    <input type="text" name="password" class="form-control" required value="<?php echo clean($admin['password_plain']); ?>" autocomplete="new-password">
                </div>
                <hr>
                <div class="mb-3">
                    <label class="form-label required">WhatsApp Enquiry Number</label>
                    <div class="input-group">
                        <span class="input-group-text">+91</span>
                        <input type="text" name="whatsapp_suffix" id="whatsappSuffixInput" class="form-control" required placeholder="9787774321" maxlength="10" inputmode="numeric" pattern="[0-9]*" value="<?php echo clean($whatsappSuffix); ?>">
                    </div>
                    <small class="text-muted">Used for the floating WhatsApp button, the Enquire Now popup and the contact page form. Country code +91 is fixed; enter the 10-digit number only, no spaces.</small>
                </div>
                <div class="mb-3">
                    <label class="form-label required">Careers CV Email</label>
                    <input type="text" name="careers_cv_email" class="form-control" required placeholder="e.g. sales.dea@outlook.com" value="<?php echo clean($settings['careers_cv_email'] ?? ''); ?>">
                    <small class="text-muted">The email address shown on the Careers page for CV submissions.</small>
                </div>
                <button type="submit" class="btn btn-admin-primary"><i class="fa-light fa-floppy-disk"></i> Save Settings</button>
            </form>
        </div>
    </div>
</div>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
