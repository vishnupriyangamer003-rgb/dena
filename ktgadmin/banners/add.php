<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/functions.php';

$pageTitle = 'Add Banner';
$activeModule = 'banners';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/sidebar.php';
?>
<div class="page-header">
    <h1>Add Banner</h1>
    <a href="index.php" class="btn btn-outline-secondary"><i class="fa-light fa-arrow-left"></i> Back to List</a>
</div>

<div class="admin-card">
    <form class="ajax-form" action="../ajax/banners.php" method="post" enctype="multipart/form-data" data-redirect="index.php">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="action" value="add">

        <div class="row">
            <div class="col-md-7">
                <div class="mb-3">
                    <label class="form-label required">Heading</label>
                    <input type="text" name="heading" class="form-control" required placeholder="e.g. Powering Industries Driving Automation.">
                </div>
                <div class="mb-3">
                    <label class="form-label">Subheading / Paragraph</label>
                    <textarea name="subheading" class="form-control" rows="2"></textarea>
                </div>
                <div class="form-check form-switch mb-3">
                    <input type="checkbox" class="form-check-input" id="statusCheck" name="status" value="1" checked>
                    <label class="form-check-label" for="statusCheck">Active</label>
                </div>
            </div>
            <div class="col-md-5">
                <div class="mb-3">
                    <label class="form-label required">Banner Image</label>
                    <input type="file" name="image" class="form-control" accept=".jpg,.jpeg,.png,.webp,.gif" required>
                    <small class="text-muted">Recommended: wide landscape image. Max 2MB.</small>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-admin-primary"><i class="fa-light fa-floppy-disk"></i> Save</button>
        <a href="index.php" class="btn btn-outline-secondary">Cancel</a>
    </form>
</div>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
