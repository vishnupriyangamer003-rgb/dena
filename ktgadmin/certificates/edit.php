<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/functions.php';

$id = (int) ($_GET['id'] ?? 0);
$stmt = mysqli_prepare($conn, 'SELECT * FROM tbl_certificates WHERE id = ?');
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$item = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

if (!$item) {
    flash_set('error', 'Certificate not found.');
    header('Location: index.php');
    exit;
}

$pageTitle = 'Edit Certificate';
$activeModule = 'certificates';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/sidebar.php';
?>
<div class="page-header">
    <h1>Edit Certificate</h1>
    <a href="index.php" class="btn btn-outline-secondary"><i class="fa-light fa-arrow-left"></i> Back to List</a>
</div>

<div class="admin-card">
    <form class="ajax-form" action="../ajax/certificates.php" method="post" enctype="multipart/form-data" data-redirect="index.php">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="action" value="edit">
        <input type="hidden" name="id" value="<?php echo $item['id']; ?>">

        <div class="row">
            <div class="col-md-6">
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
