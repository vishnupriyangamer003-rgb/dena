<?php
if (!defined('KTGADMIN')) {
    http_response_code(403);
    exit('Direct access not permitted');
}

$currentModule = isset($activeModule) ? $activeModule : '';

$navItems = [
    'dashboard' => ['label' => 'Dashboard', 'icon' => 'fa-gauge-high', 'href' => ADMIN_URL . '/dashboard.php'],
    'banners' => ['label' => 'Homepage Banner', 'icon' => 'fa-images', 'href' => ADMIN_URL . '/banners/index.php'],
    'network' => ['label' => 'Our Network', 'icon' => 'fa-diagram-project', 'href' => ADMIN_URL . '/network/index.php'],
    'certificates' => ['label' => 'Certificates', 'icon' => 'fa-certificate', 'href' => ADMIN_URL . '/certificates/index.php'],
    'panels' => ['label' => 'Panels', 'icon' => 'fa-server', 'href' => ADMIN_URL . '/panels/index.php'],
    'products' => ['label' => 'Products', 'icon' => 'fa-boxes-stacked', 'href' => ADMIN_URL . '/products/index.php'],
    'programming' => ['label' => 'Programming', 'icon' => 'fa-code', 'href' => ADMIN_URL . '/programming/index.php'],
    'training' => ['label' => 'Training', 'icon' => 'fa-chalkboard-user', 'href' => ADMIN_URL . '/training/index.php'],
    'careers' => ['label' => 'Careers', 'icon' => 'fa-briefcase', 'href' => ADMIN_URL . '/careers/index.php'],
    'enquiries' => ['label' => 'Contact Enquiries', 'icon' => 'fa-envelope', 'href' => ADMIN_URL . '/enquiries/index.php'],
    'settings' => ['label' => 'Settings', 'icon' => 'fa-gear', 'href' => ADMIN_URL . '/settings/index.php'],
];
?>
<aside class="admin-sidebar" id="adminSidebar">
    <nav class="admin-nav">
        <ul>
            <?php foreach ($navItems as $key => $navItem): ?>
            <li class="<?php echo $currentModule === $key ? 'active' : ''; ?>">
                <a href="<?php echo $navItem['href']; ?>">
                    <i class="fa-light <?php echo $navItem['icon']; ?>"></i>
                    <span><?php echo clean($navItem['label']); ?></span>
                </a>
            </li>
            <?php endforeach; ?>
            <li>
                <a href="<?php echo ADMIN_URL; ?>/logout.php" class="text-danger">
                    <i class="fa-light fa-right-from-bracket"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </nav>
</aside>
<div class="admin-sidebar-overlay" id="sidebarOverlay"></div>
<main class="admin-content">
    <?php $flash = flash_get(); ?>
    <?php if ($flash): ?>
    <div class="alert alert-<?php echo $flash['type'] === 'error' ? 'danger' : 'success'; ?> alert-dismissible fade show" role="alert">
        <?php echo clean($flash['message']); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>
