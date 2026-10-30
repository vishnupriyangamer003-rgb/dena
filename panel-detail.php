<?php
require_once __DIR__ . '/inc-frontend.php';

$slug = isset($_GET['panel']) ? $_GET['panel'] : '';
$panelRow = $slug !== '' ? fe_find_by_slug($conn, 'tbl_panels', $slug) : null;

if (!$panelRow) {
    $fallback = fe_active_rows($conn, 'tbl_panels', 'display_order ASC, id ASC', 1);
    if (!$fallback) {
        header('Location: panels.php');
        exit;
    }
    $panelRow = $fallback[0];
    $slug = $panelRow['slug'];
}

$allPanels = fe_active_rows($conn, 'tbl_panels');
$specs = decode_list($panelRow['specs']);
$applications = decode_list($panelRow['applications']);
$features = decode_list($panelRow['features']);
$overview = $panelRow['overview'];

$pageTitle = $panelRow['meta_title'] ?: ($panelRow['title'] . ' - Electrical Control Panel Manufacturer | DENA');
$metaDescription = $panelRow['meta_description'] ?: $panelRow['short_description'];
$metaKeywords = $panelRow['meta_keywords'] ?: strtolower($panelRow['title']);
include('header.php');
?>
    <!-- main-area -->
    <main>
        <!-- breadcrumb-area -->
        <section class="pl-50 pr-50 ">
            <div class="breadcrumb-area d-flex justify-content-center align-items-center" style="background-image:url(img/bg/bdrc-bg.png)">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-12 col-lg-12">
                            <div class="breadcrumb-wrap text-center">
                                <div class="breadcrumb-title">
                                    <h2><?php echo htmlspecialchars($panelRow['title']); ?></h2>
                                    <div class="breadcrumb-wrap">
                                        <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                                <li class="breadcrumb-item"><a href="panels.php">Panels</a></li>
                                                <li class="breadcrumb-item active" aria-current="page"><?php echo htmlspecialchars($panelRow['title']); ?></li>
                                            </ol>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- breadcrumb-area-end -->

        <!-- panel-detail-area -->
        <div class="about-area5 about-p p-relative">
            <div class="container pt-120 pb-120">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-4 order-1">
                        <aside class="sidebar services-sidebar">
                            <div class="sidebar-widget categories">
                                <div class="widget-content">
                                    <h2 class="widget-title">Panels List</h2>
                                    <ul class="services-categories">
                                        <?php foreach ($allPanels as $p): ?>
                                        <li class="<?php echo $p['slug'] === $slug ? 'active' : ''; ?>">
                                            <a href="panel-detail.php?panel=<?php echo urlencode($p['slug']); ?>"><?php echo htmlspecialchars($p['title']); ?></a>
                                        </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </aside>
                    </div>

                    <div class="col-lg-8 col-md-12 col-sm-12 order-2">
                        <div class="service-detail panel-detail">
                            <div class="content-box">
                                <h2><?php echo htmlspecialchars($panelRow['title']); ?></h2>
                                <?php foreach (explode("\n\n", $overview) as $para): ?>
                                <?php if (trim($para) !== ''): ?>
                                <p><?php echo htmlspecialchars($para); ?></p>
                                <?php endif; ?>
                                <?php endforeach; ?>

                                <div class="panel-main-thumb mb-30">
                                    <img src="<?php echo htmlspecialchars(upload_url($panelRow['image'])); ?>" alt="<?php echo htmlspecialchars($panelRow['title']); ?>">
                                </div>

                                <!-- panel-tabs -->
                                <ul class="nav panel-tabs" id="panelTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="tab-specs-btn" data-bs-toggle="tab" data-bs-target="#tab-specs" type="button" role="tab" aria-controls="tab-specs" aria-selected="true">Specifications</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="tab-applications-btn" data-bs-toggle="tab" data-bs-target="#tab-applications" type="button" role="tab" aria-controls="tab-applications" aria-selected="false">Applications</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="tab-features-btn" data-bs-toggle="tab" data-bs-target="#tab-features" type="button" role="tab" aria-controls="tab-features" aria-selected="false">Features</button>
                                    </li>
                                </ul>
                                <div class="tab-content panel-tab-content" id="panelTabContent">
                                    <div class="tab-pane fade show active" id="tab-specs" role="tabpanel" aria-labelledby="tab-specs-btn">
                                        <?php if ($specs): ?>
                                        <table class="panel-specs-table">
                                            <tbody>
                                                <?php foreach ($specs as $key => $val): ?>
                                                <tr>
                                                    <th><?php echo htmlspecialchars($key); ?></th>
                                                    <td><?php echo htmlspecialchars($val); ?></td>
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                        <?php else: ?>
                                        <p class="text-muted mb-0">Specifications for this panel will be added shortly. Please <a href="contact.php">contact us</a> for details.</p>
                                        <?php endif; ?>
                                    </div>
                                    <div class="tab-pane fade" id="tab-applications" role="tabpanel" aria-labelledby="tab-applications-btn">
                                        <?php if ($applications): ?>
                                        <ul class="panel-list-ul">
                                            <?php foreach ($applications as $app): ?>
                                            <li><i class="fa-light fa-circle-check"></i> <?php echo htmlspecialchars($app); ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                        <?php else: ?>
                                        <p class="text-muted mb-0">Application details for this panel will be added shortly. Please <a href="contact.php">contact us</a> for details.</p>
                                        <?php endif; ?>
                                    </div>
                                    <div class="tab-pane fade" id="tab-features" role="tabpanel" aria-labelledby="tab-features-btn">
                                        <?php if ($features): ?>
                                        <ul class="panel-list-ul">
                                            <?php foreach ($features as $feat): ?>
                                            <li><i class="fa-light fa-circle-check"></i> <?php echo htmlspecialchars($feat); ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                        <?php else: ?>
                                        <p class="text-muted mb-0">Feature details for this panel will be added shortly. Please <a href="contact.php">contact us</a> for details.</p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- panel-detail-area-end -->


    </main>
    <!-- main-area-end -->
    <!-- footer -->
<?php include('footer.php'); ?>
