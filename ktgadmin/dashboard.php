<?php
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/functions.php';

function count_rows($conn, $table)
{
    $result = mysqli_query($conn, "SELECT COUNT(*) AS c FROM `$table`");
    $row = mysqli_fetch_assoc($result);
    return (int) $row['c'];
}

$cards = [
    ['label' => 'Homepage Banners', 'icon' => 'fa-images', 'count' => count_rows($conn, 'tbl_banners'), 'href' => 'banners/index.php'],
    ['label' => 'Our Network Items', 'icon' => 'fa-diagram-project', 'count' => count_rows($conn, 'tbl_network'), 'href' => 'network/index.php'],
    ['label' => 'Certificates', 'icon' => 'fa-certificate', 'count' => count_rows($conn, 'tbl_certificates'), 'href' => 'certificates/index.php'],
    ['label' => 'Panels', 'icon' => 'fa-server', 'count' => count_rows($conn, 'tbl_panels'), 'href' => 'panels/index.php'],
    ['label' => 'Products', 'icon' => 'fa-boxes-stacked', 'count' => count_rows($conn, 'tbl_products'), 'href' => 'products/index.php'],
    ['label' => 'Programming Items', 'icon' => 'fa-code', 'count' => count_rows($conn, 'tbl_programming'), 'href' => 'programming/index.php'],
    ['label' => 'Training Items', 'icon' => 'fa-chalkboard-user', 'count' => count_rows($conn, 'tbl_training'), 'href' => 'training/index.php'],
    ['label' => 'Careers', 'icon' => 'fa-briefcase', 'count' => count_rows($conn, 'tbl_careers'), 'href' => 'careers/index.php'],
];

$totalEnquiries = count_rows($conn, 'tbl_enquiries');
$newEnquiriesResult = mysqli_query($conn, "SELECT COUNT(*) AS c FROM tbl_enquiries WHERE status = 'new'");
$newEnquiries = (int) mysqli_fetch_assoc($newEnquiriesResult)['c'];

$pageTitle = 'Dashboard';
$activeModule = 'dashboard';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/sidebar.php';
?>
<div class="page-header">
    <h1>Dashboard</h1>
    <div class="text-muted">Welcome back, <strong><?php echo clean($_SESSION['admin_username']); ?></strong></div>
</div>

<div class="row g-3">
    <?php foreach ($cards as $card): ?>
    <div class="col-lg-3 col-md-4 col-sm-6">
        <a href="<?php echo $card['href']; ?>" class="dash-card text-decoration-none">
            <div class="dash-icon"><i class="fa-light <?php echo $card['icon']; ?>"></i></div>
            <div>
                <div class="dash-count"><?php echo $card['count']; ?></div>
                <div class="dash-label"><?php echo clean($card['label']); ?></div>
            </div>
        </a>
    </div>
    <?php endforeach; ?>

    <div class="col-lg-3 col-md-4 col-sm-6">
        <a href="enquiries/index.php" class="dash-card text-decoration-none <?php echo $newEnquiries > 0 ? 'highlight' : ''; ?>">
            <div class="dash-icon"><i class="fa-light fa-envelope"></i></div>
            <div>
                <div class="dash-count"><?php echo $totalEnquiries; ?></div>
                <div class="dash-label">Contact Enquiries <?php echo $newEnquiries > 0 ? '<span class="badge bg-danger">' . $newEnquiries . ' new</span>' : ''; ?></div>
            </div>
        </a>
    </div>
</div>

<div class="admin-card mt-4">
    <h5 class="mb-3">Quick Links</h5>
    <div class="d-flex flex-wrap gap-2">
        <a href="banners/add.php" class="btn btn-sm btn-outline-secondary"><i class="fa-light fa-plus"></i> Add Banner</a>
        <a href="network/add.php" class="btn btn-sm btn-outline-secondary"><i class="fa-light fa-plus"></i> Add Network Item</a>
        <a href="certificates/add.php" class="btn btn-sm btn-outline-secondary"><i class="fa-light fa-plus"></i> Add Certificate</a>
        <a href="panels/add.php" class="btn btn-sm btn-outline-secondary"><i class="fa-light fa-plus"></i> Add Panel</a>
        <a href="products/add.php" class="btn btn-sm btn-outline-secondary"><i class="fa-light fa-plus"></i> Add Product</a>
        <a href="programming/add.php" class="btn btn-sm btn-outline-secondary"><i class="fa-light fa-plus"></i> Add Programming Item</a>
        <a href="training/add.php" class="btn btn-sm btn-outline-secondary"><i class="fa-light fa-plus"></i> Add Training</a>
        <a href="careers/add.php" class="btn btn-sm btn-outline-secondary"><i class="fa-light fa-plus"></i> Add Vacancy</a>
        <a href="settings/index.php" class="btn btn-sm btn-outline-secondary"><i class="fa-light fa-gear"></i> Settings</a>
    </div>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
