<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/functions.php';

$q = trim($_GET['q'] ?? '');
$statusFilter = $_GET['status'] ?? '';

$where = [];
$params = [];
$types = '';
if ($q !== '') {
    $where[] = '(title LIKE ? OR slug LIKE ?)';
    $params[] = '%' . $q . '%';
    $params[] = '%' . $q . '%';
    $types .= 'ss';
}
if ($statusFilter === '0' || $statusFilter === '1') {
    $where[] = 'status = ?';
    $params[] = (int) $statusFilter;
    $types .= 'i';
}
$whereSql = $where ? ('WHERE ' . implode(' AND ', $where)) : '';

$stmt = mysqli_prepare($conn, "SELECT * FROM tbl_panels $whereSql ORDER BY display_order ASC, id DESC");
if ($types) {
    mysqli_stmt_bind_param($stmt, $types, ...$params);
}
mysqli_stmt_execute($stmt);
$rows = mysqli_stmt_get_result($stmt);

$pageTitle = 'Panels';
$activeModule = 'panels';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/sidebar.php';
?>
<div class="page-header">
    <h1>Panels</h1>
    <a href="add.php" class="btn btn-admin-primary"><i class="fa-light fa-plus"></i> Add New</a>
</div>

<div class="admin-card">
    <form method="get" class="row g-2 mb-3">
        <div class="col-md-4"><input type="text" name="q" class="form-control filter-search" placeholder="Search by title or slug..." value="<?php echo clean($q); ?>"></div>
        <div class="col-md-3">
            <select name="status" class="form-select filter-select">
                <option value="">All Status</option>
                <option value="1" <?php echo $statusFilter === '1' ? 'selected' : ''; ?>>Active</option>
                <option value="0" <?php echo $statusFilter === '0' ? 'selected' : ''; ?>>Inactive</option>
            </select>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table align-middle">
            <thead><tr><th>#</th><th>Image</th><th>Title</th><th>Slug</th><th>Status</th><th>Created</th><th>Actions</th></tr></thead>
            <tbody>
                <?php if (mysqli_num_rows($rows) === 0): ?>
                <tr><td colspan="7" class="text-center text-muted py-4">No panels found.</td></tr>
                <?php else: $i = 1; while ($row = mysqli_fetch_assoc($rows)): ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><img src="<?php echo upload_url($row['image']); ?>" class="table-thumb" alt="<?php echo clean($row['title']); ?>"></td>
                    <td><?php echo clean($row['title']); ?></td>
                    <td><code><?php echo clean($row['slug']); ?></code></td>
                    <td>
                        <div class="form-check form-switch">
                            <input type="checkbox" class="form-check-input status-toggle" data-url="../ajax/panels.php" data-id="<?php echo $row['id']; ?>" <?php echo $row['status'] ? 'checked' : ''; ?>>
                        </div>
                    </td>
                    <td><?php echo date('d M Y', strtotime($row['created_at'])); ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-primary"><i class="fa-light fa-pen"></i></a>
                        <button type="button" class="btn btn-sm btn-outline-danger btn-delete-ajax" data-url="../ajax/panels.php" data-id="<?php echo $row['id']; ?>"><i class="fa-light fa-trash"></i></button>
                    </td>
                </tr>
                <?php endwhile; endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
