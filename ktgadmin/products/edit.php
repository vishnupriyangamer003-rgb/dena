<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/functions.php';

$id = (int) ($_GET['id'] ?? 0);
$stmt = mysqli_prepare($conn, 'SELECT * FROM tbl_products WHERE id = ?');
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$item = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

if (!$item) {
    flash_set('error', 'Product not found.');
    header('Location: index.php');
    exit;
}

$points = decode_list($item['points']);
if (!$points) {
    $points = [''];
}

$pageTitle = 'Edit Product';
$activeModule = 'products';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/sidebar.php';
?>
<div class="page-header">
    <h1>Edit Product</h1>
    <a href="index.php" class="btn btn-outline-secondary"><i class="fa-light fa-arrow-left"></i> Back to List</a>
</div>

<div class="admin-card">
    <form class="ajax-form" action="../ajax/products.php" method="post" enctype="multipart/form-data" data-redirect="index.php">
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
                    <label class="form-label required">Description</label>
                    <textarea name="description" class="form-control" rows="4" required><?php echo clean($item['description']); ?></textarea>
                </div>

                <div class="mb-4">
                    <label class="form-label">Key Points</label>
                    <div class="repeat-group" id="pointsGroup" data-mode="list" data-field="points_json">
                        <?php foreach ($points as $v): ?>
                        <div class="repeat-row">
                            <input type="text" class="form-control repeat-val" value="<?php echo clean($v); ?>">
                            <button type="button" class="btn btn-outline-danger remove-row-btn"><i class="fa-light fa-xmark"></i></button>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-secondary add-row-btn" data-target="#pointsGroup"><i class="fa-light fa-plus"></i> Add Row</button>
                    <input type="hidden" name="points_json" value="[]">
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
