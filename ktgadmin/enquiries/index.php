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
    $where[] = '(name LIKE ? OR phone LIKE ? OR email LIKE ?)';
    $params[] = '%' . $q . '%';
    $params[] = '%' . $q . '%';
    $params[] = '%' . $q . '%';
    $types .= 'sss';
}
if (in_array($statusFilter, ['new', 'contacted', 'closed'], true)) {
    $where[] = 'status = ?';
    $params[] = $statusFilter;
    $types .= 's';
}
$whereSql = $where ? ('WHERE ' . implode(' AND ', $where)) : '';

$stmt = mysqli_prepare($conn, "SELECT * FROM tbl_enquiries $whereSql ORDER BY id DESC");
if ($types) {
    mysqli_stmt_bind_param($stmt, $types, ...$params);
}
mysqli_stmt_execute($stmt);
$rows = mysqli_stmt_get_result($stmt);

$statusColors = ['new' => 'danger', 'contacted' => 'warning', 'closed' => 'success'];

$pageTitle = 'Contact Enquiries';
$activeModule = 'enquiries';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/sidebar.php';
?>
<div class="page-header">
    <h1>Contact Enquiries</h1>
</div>

<div class="admin-card">
    <form method="get" class="row g-2 mb-3">
        <div class="col-md-4"><input type="text" name="q" class="form-control filter-search" placeholder="Search by name, phone or email..." value="<?php echo clean($q); ?>"></div>
        <div class="col-md-3">
            <select name="status" class="form-select filter-select">
                <option value="">All Status</option>
                <option value="new" <?php echo $statusFilter === 'new' ? 'selected' : ''; ?>>New</option>
                <option value="contacted" <?php echo $statusFilter === 'contacted' ? 'selected' : ''; ?>>Contacted</option>
                <option value="closed" <?php echo $statusFilter === 'closed' ? 'selected' : ''; ?>>Closed</option>
            </select>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table align-middle">
            <thead><tr><th>#</th><th>Name</th><th>Phone</th><th>Email</th><th>Subject</th><th>Source</th><th>Status</th><th>Received</th><th>Actions</th></tr></thead>
            <tbody>
                <?php if (mysqli_num_rows($rows) === 0): ?>
                <tr><td colspan="9" class="text-center text-muted py-4">No enquiries yet.</td></tr>
                <?php else: $i = 1; while ($row = mysqli_fetch_assoc($rows)): ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo clean($row['name']); ?></td>
                    <td><?php echo clean($row['phone']); ?></td>
                    <td><?php echo clean($row['email']); ?></td>
                    <td><?php echo clean(mb_strimwidth((string) $row['subject'], 0, 30, '...')); ?></td>
                    <td><span class="badge bg-secondary"><?php echo clean($row['source']); ?></span></td>
                    <td class="status-badge-cell" data-status="<?php echo clean($row['status']); ?>">
                        <select class="form-select form-select-sm enquiry-status-select" data-id="<?php echo $row['id']; ?>">
                            <option value="new" <?php echo $row['status'] === 'new' ? 'selected' : ''; ?>>New</option>
                            <option value="contacted" <?php echo $row['status'] === 'contacted' ? 'selected' : ''; ?>>Contacted</option>
                            <option value="closed" <?php echo $row['status'] === 'closed' ? 'selected' : ''; ?>>Closed</option>
                        </select>
                    </td>
                    <td><?php echo date('d M Y, h:i A', strtotime($row['created_at'])); ?></td>
                    <td>
                        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#viewModal<?php echo $row['id']; ?>"><i class="fa-light fa-eye"></i></button>
                        <button type="button" class="btn btn-sm btn-outline-danger btn-delete-ajax" data-url="../ajax/enquiries.php" data-id="<?php echo $row['id']; ?>"><i class="fa-light fa-trash"></i></button>

                        <div class="modal fade" id="viewModal<?php echo $row['id']; ?>" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Enquiry from <?php echo clean($row['name']); ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Phone:</strong> <?php echo clean($row['phone']); ?></p>
                                        <p><strong>Email:</strong> <?php echo clean($row['email']); ?></p>
                                        <p><strong>Subject:</strong> <?php echo clean($row['subject']); ?></p>
                                        <p><strong>Message:</strong><br><?php echo nl2br(clean($row['message'])); ?></p>
                                        <p class="text-muted mb-0"><small>Received on <?php echo date('d M Y, h:i A', strtotime($row['created_at'])); ?> via <?php echo clean($row['source']); ?></small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php endwhile; endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
