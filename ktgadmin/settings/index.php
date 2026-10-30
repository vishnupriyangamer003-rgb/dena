<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/functions.php';

$stmt = mysqli_prepare($conn, 'SELECT username, password_plain FROM tbl_admin WHERE id = ?');
mysqli_stmt_bind_param($stmt, 'i', $_SESSION['admin_id']);
mysqli_stmt_execute($stmt);
$admin = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

$settingKeys = [
    'whatsapp_number', 'site_email', 'careers_cv_email', 'experience_years',
    'site_phone1', 'site_phone2', 'site_phone3',
    'head_office_address', 'branch_madurai_address', 'branch_coimbatore_address',
    'working_hours_weekday', 'working_hours_sunday', 'map_embed_url',
    'facebook_url', 'instagram_url', 'twitter_url', 'linkedin_url',
];
$inList = "'" . implode("','", $settingKeys) . "'";
$settingsResult = mysqli_query($conn, "SELECT setting_key, setting_value FROM tbl_settings WHERE setting_key IN ($inList)");
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

function setting_val($settings, $key, $default = '')
{
    $value = isset($settings[$key]) ? trim($settings[$key]) : '';
    return $value !== '' ? $value : $default;
}
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
                <button type="submit" class="btn btn-admin-primary"><i class="fa-light fa-floppy-disk"></i> Save Account</button>
            </form>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="admin-card">
            <h5 class="mb-3"><i class="fa-light fa-phone-volume"></i> Contact Settings</h5>
            <form class="ajax-form-simple" action="../ajax/settings.php" method="post">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="action" value="update_general">
                <div class="mb-3">
                    <label class="form-label required">WhatsApp Enquiry Number</label>
                    <div class="input-group">
                        <span class="input-group-text">+91</span>
                        <input type="text" name="whatsapp_suffix" class="form-control" required placeholder="9787774321" maxlength="10" inputmode="numeric" pattern="[0-9]*" value="<?php echo clean($whatsappSuffix); ?>">
                    </div>
                    <small class="text-muted">Used for the floating WhatsApp button, the Enquire Now popup and the contact/careers page forms. Country code +91 is fixed; enter the 10-digit number only, no spaces.</small>
                </div>
                <div class="mb-3">
                    <label class="form-label required">Site Email</label>
                    <input type="email" name="site_email" class="form-control" required placeholder="e.g. info@dena.co.in" value="<?php echo clean(setting_val($settings, 'site_email', 'info@dena.co.in')); ?>">
                    <small class="text-muted">The main email address shown on the Contact page (Email Us card).</small>
                </div>
                <div class="mb-3">
                    <label class="form-label required">Careers CV Email</label>
                    <input type="email" name="careers_cv_email" class="form-control" required placeholder="e.g. info@dena.co.in" value="<?php echo clean(setting_val($settings, 'careers_cv_email', 'info@dena.co.in')); ?>">
                    <small class="text-muted">The email address shown on the Careers page for CV submissions.</small>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label required">Phone 1</label>
                        <input type="text" name="site_phone1" class="form-control" required placeholder="+91 97877 74321" value="<?php echo clean(setting_val($settings, 'site_phone1', '+91 97877 74321')); ?>">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Phone 2</label>
                        <input type="text" name="site_phone2" class="form-control" placeholder="+91 96773 77488" value="<?php echo clean(setting_val($settings, 'site_phone2', '+91 96773 77488')); ?>">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Phone 3</label>
                        <input type="text" name="site_phone3" class="form-control" placeholder="+91 96773 81565" value="<?php echo clean(setting_val($settings, 'site_phone3', '+91 96773 81565')); ?>">
                    </div>
                </div>
                <small class="text-muted d-block mb-3">Shown in the "Call Us" card on the Contact page. Leave Phone 2 / Phone 3 blank to hide them.</small>
                <button type="submit" class="btn btn-admin-primary"><i class="fa-light fa-floppy-disk"></i> Save Contact Settings</button>
            </form>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="admin-card">
            <h5 class="mb-3"><i class="fa-light fa-building"></i> Office & General Settings</h5>
            <form class="ajax-form-simple" action="../ajax/settings.php" method="post">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="action" value="update_general">
                <div class="mb-3">
                    <label class="form-label required">Years of Experience</label>
                    <input type="text" name="experience_years" class="form-control" required placeholder="e.g. 11" maxlength="2" inputmode="numeric" pattern="[0-9]*" value="<?php echo clean(setting_val($settings, 'experience_years', '11')); ?>">
                    <small class="text-muted">Shown as "X+ Years" across the site (Home page badges, About page stats and meta description). Enter the number only, the "+" is added automatically.</small>
                </div>
                <div class="mb-3">
                    <label class="form-label required">Head Office Address</label>
                    <textarea name="head_office_address" class="form-control" rows="2" required><?php echo clean(setting_val($settings, 'head_office_address')); ?></textarea>
                    <small class="text-muted">Shown in the "Head Office" card and the office list on the Contact page.</small>
                </div>
                <div class="mb-3">
                    <label class="form-label">Madurai Branch Address</label>
                    <textarea name="branch_madurai_address" class="form-control" rows="2"><?php echo clean(setting_val($settings, 'branch_madurai_address')); ?></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Coimbatore Branch Address</label>
                    <textarea name="branch_coimbatore_address" class="form-control" rows="2"><?php echo clean(setting_val($settings, 'branch_coimbatore_address')); ?></textarea>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label required">Working Hours (Mon - Sat)</label>
                        <input type="text" name="working_hours_weekday" class="form-control" required placeholder="Mon - Sat: 9:00 AM - 6:30 PM" value="<?php echo clean(setting_val($settings, 'working_hours_weekday', 'Mon - Sat: 9:00 AM - 6:30 PM')); ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label required">Working Hours (Sunday)</label>
                        <input type="text" name="working_hours_sunday" class="form-control" required placeholder="Sunday: Closed" value="<?php echo clean(setting_val($settings, 'working_hours_sunday', 'Sunday: Closed')); ?>">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label required">Google Map Embed URL</label>
                    <input type="url" name="map_embed_url" class="form-control" required placeholder="https://www.google.com/maps?q=...&amp;output=embed" value="<?php echo clean(setting_val($settings, 'map_embed_url')); ?>">
                    <small class="text-muted">Open Google Maps &rarr; Share &rarr; Embed a map, then paste the src URL of the iframe. Shown on the Contact page.</small>
                </div>
                <button type="submit" class="btn btn-admin-primary"><i class="fa-light fa-floppy-disk"></i> Save Office Settings</button>
            </form>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="admin-card">
            <h5 class="mb-3"><i class="fa-light fa-share-nodes"></i> Social Links</h5>
            <form class="ajax-form-simple" action="../ajax/settings.php" method="post">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="action" value="update_social">
                <div class="mb-3">
                    <label class="form-label">Facebook URL</label>
                    <input type="text" name="facebook_url" class="form-control" placeholder="https://www.facebook.com/yourpage" value="<?php echo clean(setting_val($settings, 'facebook_url', '#')); ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Instagram URL</label>
                    <input type="text" name="instagram_url" class="form-control" placeholder="https://www.instagram.com/yourhandle" value="<?php echo clean(setting_val($settings, 'instagram_url', '#')); ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">X (Twitter) URL</label>
                    <input type="text" name="twitter_url" class="form-control" placeholder="https://x.com/yourhandle" value="<?php echo clean(setting_val($settings, 'twitter_url', '#')); ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">LinkedIn URL</label>
                    <input type="text" name="linkedin_url" class="form-control" placeholder="https://www.linkedin.com/company/yourcompany" value="<?php echo clean(setting_val($settings, 'linkedin_url', '#')); ?>">
                    <small class="text-muted">Shown in the footer social icons and the floating LinkedIn button. Leave blank (or #) to keep the icon non-clickable.</small>
                </div>
                <button type="submit" class="btn btn-admin-primary"><i class="fa-light fa-floppy-disk"></i> Save Social Links</button>
            </form>
        </div>
    </div>
</div>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
