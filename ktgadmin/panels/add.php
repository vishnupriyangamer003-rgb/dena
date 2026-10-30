<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/functions.php';

$pageTitle = 'Add Panel';
$activeModule = 'panels';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/sidebar.php';
?>
<div class="page-header">
    <h1>Add Panel</h1>
    <a href="index.php" class="btn btn-outline-secondary"><i class="fa-light fa-arrow-left"></i> Back to List</a>
</div>

<div class="admin-card">
    <form class="ajax-form" action="../ajax/panels.php" method="post" enctype="multipart/form-data" data-redirect="index.php">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="action" value="add">

        <div class="row">
            <div class="col-md-8">
                <div class="mb-3">
                    <label class="form-label required">Title</label>
                    <input type="text" name="title" id="titleInput" class="form-control" required placeholder="e.g. PLC Panel">
                </div>
                <div class="mb-3">
                    <label class="form-label">Slug (URL)</label>
                    <input type="text" name="slug" id="slugInput" class="form-control" placeholder="auto-generated from title">
                    <small class="text-muted">Leave blank to auto-generate from title.</small>
                </div>
                <div class="mb-3">
                    <label class="form-label required">Short Description</label>
                    <textarea name="short_description" class="form-control" rows="2" required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Overview</label>
                    <textarea name="overview" class="form-control" rows="4" placeholder="Detailed overview shown on the panel's page"></textarea>
                </div>

                <div class="mb-4">
                    <label class="form-label">Specifications</label>
                    <div class="repeat-group" id="specsGroup" data-mode="kv" data-field="specs_json">
                        <div class="repeat-row">
                            <input type="text" class="form-control repeat-key" placeholder="Key, e.g. PLC Make" style="flex:1;">
                            <input type="text" class="form-control repeat-val" placeholder="Value" style="flex:2;">
                            <button type="button" class="btn btn-outline-danger remove-row-btn"><i class="fa-light fa-xmark"></i></button>
                        </div>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-secondary add-row-btn" data-target="#specsGroup"><i class="fa-light fa-plus"></i> Add Row</button>
                    <input type="hidden" name="specs_json" value="{}">
                </div>

                <div class="mb-4">
                    <label class="form-label">Applications</label>
                    <div class="repeat-group" id="applicationsGroup" data-mode="list" data-field="applications_json">
                        <div class="repeat-row">
                            <input type="text" class="form-control repeat-val" placeholder="e.g. Water treatment plants">
                            <button type="button" class="btn btn-outline-danger remove-row-btn"><i class="fa-light fa-xmark"></i></button>
                        </div>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-secondary add-row-btn" data-target="#applicationsGroup"><i class="fa-light fa-plus"></i> Add Row</button>
                    <input type="hidden" name="applications_json" value="[]">
                </div>

                <div class="mb-4">
                    <label class="form-label">Features</label>
                    <div class="repeat-group" id="featuresGroup" data-mode="list" data-field="features_json">
                        <div class="repeat-row">
                            <input type="text" class="form-control repeat-val" placeholder="e.g. Factory tested before dispatch">
                            <button type="button" class="btn btn-outline-danger remove-row-btn"><i class="fa-light fa-xmark"></i></button>
                        </div>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-secondary add-row-btn" data-target="#featuresGroup"><i class="fa-light fa-plus"></i> Add Row</button>
                    <input type="hidden" name="features_json" value="[]">
                </div>
            </div>
            <div class="col-md-4">
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
