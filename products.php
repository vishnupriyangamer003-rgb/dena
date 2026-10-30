<?php
require_once __DIR__ . '/inc-frontend.php';

$tree = catalogue_get_tree();
$brands = catalogue_get_brands();

// Read active URL parameters
$activeBrandParam = isset($_GET['brand']) ? strtolower(trim($_GET['brand'])) : 'delta';
$activeSubcatParam = isset($_GET['subcat']) ? trim($_GET['subcat']) : '';
$activeCatParam = isset($_GET['cat']) ? trim($_GET['cat']) : '';

// Find active brand node (strictly DELTA, INVT, MULTISPAN, LEUZE)
$activeBrand = catalogue_find_brand($activeBrandParam) ?: ($brands[0] ?? null);
$isDetailBrand = ($activeBrand && !empty($activeBrand['children']));

// Page Metadata
$pageTitle = 'Industrial Automation Product Catalogue - DELTA, INVT, MULTISPAN, LEUZE | Digitech';
if ($activeBrand) {
    $pageTitle = htmlspecialchars($activeBrand['name']) . ' - Product Catalogue | Digitech';
}
$metaDescription = 'Browse Digitech\'s comprehensive industrial automation product catalogue including DELTA PLCs, HMIs, VFDs, Servos, INVT Drives, Multispan Instruments, and Leuze Sensors.';
$metaKeywords = 'Delta automation, INVT, Multispan, Leuze, PLC, HMI, VFD, Servo, industrial products, Digitech Karur';

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
                                    <h2>Product Catalogue</h2>
                                    <div class="breadcrumb-wrap">
                                        <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                                <li class="breadcrumb-item"><a href="products.php">Products</a></li>
                                                <li class="breadcrumb-item active" id="breadcrumbActiveBrand" aria-current="page"><?php echo htmlspecialchars($activeBrand['name']); ?></li>
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

        <!-- catalogue-main-area -->
        <section class="catalogue-area p-relative pt-60 pb-90">
            <div class="container">

                <!-- Level 1: Clean 4 Brand Navigation Bar (DELTA, INVT, MULTISPAN, LEUZE) -->
                <div class="brand-nav-container mb-40">
                    <div class="brand-nav-pills" id="brandNavPills">
                        <?php foreach ($brands as $b): 
                            $bSlug = strtolower(str_replace('brand_', '', $b['id']));
                            $isActiveBrand = ($activeBrand && $activeBrand['id'] === $b['id']);
                        ?>
                        <button type="button" class="brand-pill-btn <?php echo $isActiveBrand ? 'active' : ''; ?>" data-brand-id="<?php echo htmlspecialchars($b['id']); ?>" data-brand-slug="<?php echo htmlspecialchars($bSlug); ?>" onclick="switchBrand('<?php echo htmlspecialchars($bSlug); ?>')">
                            <?php if ($b['name'] === 'DELTA'): ?>
                            <span class="badge-partner"><i class="fa-solid fa-award"></i> Channel Partner</span>
                            <?php endif; ?>
                            <span class="brand-name-text"><?php echo htmlspecialchars($b['name']); ?></span>
                        </button>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Catalogue Interactive Container -->
                <div id="catalogueInteractiveContainer">

                    <!-- Brand with Products (DELTA, INVT) -->
                    <div id="brandDetailView" class="brand-view-block" style="<?php echo $isDetailBrand ? 'display: block;' : 'display: none;'; ?>">

                        <div class="row g-4">
                            <!-- Left Column: Side Tab Category Navigation -->
                            <div class="col-xl-3 col-lg-4 col-md-12">
                                <aside class="catalogue-sidebar">
                                    <div class="catalogue-sidebar-title">
                                        <span><i class="fa-light fa-layer-group text-primary"></i> Categories</span>
                                        <span class="badge bg-light text-dark border" id="sidebarBrandBadge"><?php echo htmlspecialchars($activeBrand['name']); ?></span>
                                    </div>
                                    <div class="catalogue-side-tabs-list" id="categorySideTabs">
                                        <!-- Rendered dynamically by JS -->
                                    </div>
                                </aside>
                            </div>

                            <!-- Right Column: Header, Filter Bar, Product Cards -->
                            <div class="col-xl-9 col-lg-8 col-md-12">

                                <!-- Active Subcategory Header & Live Counter -->
                                <div class="catalogue-content-header d-flex flex-wrap align-items-center justify-content-between mb-25 pb-15 border-bottom">
                                    <div>
                                        <h3 class="active-subcat-title mb-1" id="activeSubcatTitle">
                                            <i class="fa-light fa-boxes-stacked text-primary"></i> <span id="brandTitleText"><?php echo htmlspecialchars($activeBrand['name']); ?></span> Catalogue
                                        </h3>
                                        <p class="text-muted small mb-0" id="activeSubcatSubtitle">Select a category from the left to filter models</p>
                                    </div>
                                    <div class="live-product-counter" id="productCounterBadge">
                                        <!-- Dynamic count -->
                                    </div>
                                </div>

                                <!-- Product Filtering & Search Bar -->
                                <div class="product-filter-bar mb-30 p-3 rounded bg-light border">
                                    <div class="row g-3 align-items-center">
                                        <div class="col-lg-5 col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-text bg-white"><i class="fa-light fa-magnifying-glass"></i></span>
                                                <input type="text" id="catalogueSearchInput" class="form-control" placeholder="Search product or model (e.g. SV3, MS300, GD200A)..." oninput="applyFilters()">
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <select id="seriesDropdownFilter" class="form-select" onchange="onSeriesDropdownChange(this.value)">
                                                <option value="">All Series / Models</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-2 col-md-6">
                                            <select id="sortDropdownFilter" class="form-select" onchange="applyFilters()">
                                                <option value="name_asc">Sort: A to Z</option>
                                                <option value="name_desc">Sort: Z to A</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-2 col-md-6 text-md-end">
                                            <button type="button" class="btn btn-sm btn-outline-secondary w-100" onclick="resetFilters()">
                                                <i class="fa-light fa-rotate-left"></i> Reset
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Products Grid Container -->
                                <div class="product-grid-wrapper">
                                    <div class="row g-3" id="catalogueProductGrid">
                                        <!-- Dynamic Product Cards injected here -->
                                    </div>
                                    
                                    <!-- Empty state when filters return 0 -->
                                    <div id="noProductsFoundState" class="text-center py-5 d-none">
                                        <div class="empty-icon mb-3 text-muted"><i class="fa-light fa-box-open fa-3x"></i></div>
                                        <h4>No matching products found</h4>
                                        <p class="text-muted">Try adjusting your search terms or clearing the selected series filter.</p>
                                        <button type="button" class="btn btn-sm btn-primary mt-2" onclick="resetFilters()">View All Products</button>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                    <!-- Brand Showcase (MULTISPAN, LEUZE - no subcategories in JSON) -->
                    <div id="brandShowcaseView" class="brand-showcase-box p-5 rounded border bg-white shadow-sm text-center" style="<?php echo !$isDetailBrand ? 'display: block;' : 'display: none;'; ?>">
                        <div class="empty-icon mb-3 text-muted">
                            <i class="fa-light fa-box-open fa-3x"></i>
                        </div>
                        <div class="brand-logo-badge mb-3">
                            <span class="badge bg-secondary text-uppercase px-3 py-1" id="showcaseBadge" style="font-size: 13px; letter-spacing: 1px;">
                                <?php echo htmlspecialchars($activeBrand['name']); ?>
                            </span>
                        </div>
                        <h3 class="mb-3" id="showcaseTitle">No Content Available</h3>
                        <p class="text-muted mx-auto mb-30" id="showcaseDescription" style="max-width: 580px;">
                            Products and categories for <?php echo htmlspecialchars($activeBrand['name']); ?> are currently not listed in this catalogue. For inquiries regarding <?php echo htmlspecialchars($activeBrand['name']); ?> models and solutions, please contact our team.
                        </p>

                        <div class="pt-10">
                            <button type="button" class="btn btn-primary px-4 py-2" id="showcaseEnquireBtn" data-bs-toggle="modal" data-bs-target="#enquireModal" data-product="<?php echo htmlspecialchars($activeBrand['name']); ?>">
                                Enquire for <?php echo htmlspecialchars($activeBrand['name']); ?> <i class="fa-light fa-bolt"></i>
                            </button>
                            <a href="contact.php" class="btn btn-border ml-15">Contact Us</a>
                        </div>
                    </div>

                </div>

            </div>
        </section>
        <!-- catalogue-main-area-end -->

        <!-- CTA Strip -->
        <section class="cta-strip p-relative">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-8 col-md-12">
                        <h2>Need Technical Selection or Availability for Any Model?</h2>
                        <p>Speak directly with our automation and drive application engineers to match the right series and part number.</p>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="cta-buttons">
                            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#enquireModal">Enquire Now <i class="fa-light fa-bolt"></i></button>
                            <a href="contact.php" class="btn btn-border">Contact Us <i class="fa-light fa-bolt"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
    <!-- main-area-end -->

    <!-- Export complete JSON tree & image map to client-side JS for 0ms instant reactivity -->
    <script>
        window.CATALOGUE_TREE = <?php echo json_encode($tree, JSON_UNESCAPED_SLASHES); ?>;
        window.IMAGE_MAP = <?php echo json_encode(catalogue_get_image_map(), JSON_UNESCAPED_SLASHES); ?>;
        window.INITIAL_BRAND = <?php echo json_encode($activeBrandParam); ?>;
        window.INITIAL_SUBCAT = <?php echo json_encode($activeSubcatParam); ?>;
        window.INITIAL_CAT = <?php echo json_encode($activeCatParam); ?>;
    </script>
    <script src="js/catalogue.js"></script>

    <!-- footer -->
<?php include('footer.php'); ?>