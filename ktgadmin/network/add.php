<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/functions.php';

$pageTitle = 'Add Network Item';
$activeModule = 'network';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/sidebar.php';
?>
<div class="page-header">
    <h1>Add Network Item</h1>
    <a href="index.php" class="btn btn-outline-secondary"><i class="fa-light fa-arrow-left"></i> Back to List</a>
</div>

<div class="admin-card">
    <form class="ajax-form" action="../ajax/network.php" method="post" enctype="multipart/form-data" data-redirect="index.php">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="action" value="add">

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label required">Title / Alt Text</label>
                    <input type="text" name="alt_text" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label required">Image</label>
                    <input type="file" name="image" class="form-control" accept=".jpg,.jpeg,.png,.webp,.gif" required>
                    <small class="text-muted">Max 2MB. JPG, PNG, WEBP or GIF.</small>
                </div>
                <div class="form-check form-switch mb-3">
                    <input type="checkbox" class="form-check-input" id="statusCheck" name="status" value="1" checked>
                    <label class="form-check-label" for="statusCheck">Active</label>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-admin-primary"><i class="fa-light fa-floppy-disk"></i> Save</button>
        <a href="index.php" class="btn btn-outline-secondary">Cancel</a>
    </form>
</div>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
