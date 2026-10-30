<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/functions.php';

$pageTitle = 'Add Training';
$activeModule = 'training';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/sidebar.php';
?>
<div class="page-header">
    <h1>Add Training</h1>
    <a href="index.php" class="btn btn-outline-secondary"><i class="fa-light fa-arrow-left"></i> Back to List</a>
</div>

<div class="admin-card">
    <form class="ajax-form" action="../ajax/training.php" method="post" enctype="multipart/form-data" data-redirect="index.php">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="action" value="add">

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label required">Title</label>
                    <input type="text" name="title" id="titleInput" class="form-control" required placeholder="e.g. PLC Programming Training">
                </div>
                <div class="mb-3">
                    <label class="form-label">Slug (URL)</label>
                    <input type="text" name="slug" id="slugInput" class="form-control" placeholder="auto-generated from title">
                </div>
                <div class="mb-3">
                    <label class="form-label required">Short Description</label>
                    <textarea name="description" class="form-control" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label required">Image</label>
                    <input type="file" name="image" class="form-control" accept=".jpg,.jpeg,.png,.webp,.gif" required>
                    <small class="text-muted">Max 2MB.</small>
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
