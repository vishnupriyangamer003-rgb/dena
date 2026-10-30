<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/functions.php';

$id = (int) ($_GET['id'] ?? 0);
$stmt = mysqli_prepare($conn, 'SELECT * FROM tbl_panels WHERE id = ?');
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$item = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

if (!$item) {
    flash_set('error', 'Panel not found.');
    header('Location: index.php');
    exit;
}

$specs = decode_list($item['specs']);
if (!$specs) {
    $specs = ['' => ''];
}
$applications = decode_list($item['applications']);
if (!$applications) {
    $applications = [''];
}
$features = decode_list($item['features']);
if (!$features) {
    $features = [''];
}

$pageTitle = 'Edit Panel';
$activeModule = 'panels';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/sidebar.php';
?>
<div class="page-header">
    <h1>Edit Panel</h1>
    <a href="index.php" class="btn btn-outline-secondary"><i class="fa-light fa-arrow-left"></i> Back to List</a>
</div>

<div class="admin-card">
    <form class="ajax-form" action="../ajax/panels.php" method="post" enctype="multipart/form-data" data-redirect="index.php">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="action" value="edit">
        <input type="hidden" name="id" value="<?php echo $item['id']; ?>">

        <div class="row">
            <div class="col-md-8">
                <div class="mb-3">
                    <label class="form-label required">Title</label>
                    <input type="text" name="title" id="titleInput" class="form-control" required value="<?php echo clean($item['title']); ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Slug (URL)</label>
                    <input type="text" name="slug" id="slugInput" class="form-control" value="<?php echo clean($item['slug']); ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label required">Category</label>
                    <select name="category" class="form-select" required>
                        <option value="power-solutions" <?php echo ($item['category'] ?? '') === 'power-solutions' ? 'selected' : ''; ?>>Power Solutions</option>
                        <option value="control-engineering" <?php echo ($item['category'] ?? '') === 'control-engineering' ? 'selected' : ''; ?>>Control Engineering</option>
                    </select>
                    <small class="text-muted">Used for the menu groups and the filter on the Panels page.</small>
                </div>
                <div class="mb-3">
                    <label class="form-label required">Short Description</label>
                    <textarea name="short_description" class="form-control" rows="2" required><?php echo clean($item['short_description']); ?></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Overview</label>
                    <textarea name="overview" class="form-control" rows="4"><?php echo clean($item['overview']); ?></textarea>
                </div>

                <div class="mb-4">
                    <label class="form-label">Specifications</label>
                    <div class="repeat-group" id="specsGroup" data-mode="kv" data-field="specs_json">
                        <?php foreach ($specs as $k => $v): ?>
                        <div class="repeat-row">
                            <input type="text" class="form-control repeat-key" placeholder="Key" style="flex:1;" value="<?php echo clean($k); ?>">
                            <input type="text" class="form-control repeat-val" placeholder="Value" style="flex:2;" value="<?php echo clean($v); ?>">
                            <button type="button" class="btn btn-outline-danger remove-row-btn"><i class="fa-light fa-xmark"></i></button>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-secondary add-row-btn" data-target="#specsGroup"><i class="fa-light fa-plus"></i> Add Row</button>
                    <input type="hidden" name="specs_json" value="{}">
                </div>

                <div class="mb-4">
                    <label class="form-label">Applications</label>
                    <div class="repeat-group" id="applicationsGroup" data-mode="list" data-field="applications_json">
                        <?php foreach ($applications as $v): ?>
                        <div class="repeat-row">
                            <input type="text" class="form-control repeat-val" placeholder="e.g. Water treatment plants" value="<?php echo clean($v); ?>">
                            <button type="button" class="btn btn-outline-danger remove-row-btn"><i class="fa-light fa-xmark"></i></button>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-secondary add-row-btn" data-target="#applicationsGroup"><i class="fa-light fa-plus"></i> Add Row</button>
                    <input type="hidden" name="applications_json" value="[]">
                </div>

                <div class="mb-4">
                    <label class="form-label">Features</label>
                    <div class="repeat-group" id="featuresGroup" data-mode="list" data-field="features_json">
                        <?php foreach ($features as $v): ?>
                        <div class="repeat-row">
                            <input type="text" class="form-control repeat-val" placeholder="e.g. Factory tested before dispatch" value="<?php echo clean($v); ?>">
                            <button type="button" class="btn btn-outline-danger remove-row-btn"><i class="fa-light fa-xmark"></i></button>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-secondary add-row-btn" data-target="#featuresGroup"><i class="fa-light fa-plus"></i> Add Row</button>
                    <input type="hidden" name="features_json" value="[]">
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label">Image</label>
                    <input type="file" name="image" class="form-control" accept=".jpg,.jpeg,.png,.webp,.gif">
                    <small class="text-muted">Leave empty to keep the current image.</small><br>
                    <img src="<?php echo upload_url($item['image']); ?>" class="current-image-preview">
                </div>
                <div class="form-check form-switch mb-3">
                    <input type="checkbox" class="form-check-input" id="statusCheck" name="status" value="1" <?php echo $item['status'] ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="statusCheck">Active</label>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-admin-primary"><i class="fa-light fa-floppy-disk"></i> Update</button>
        <a href="index.php" class="btn btn-outline-secondary">Cancel</a>
    </form>
</div>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
