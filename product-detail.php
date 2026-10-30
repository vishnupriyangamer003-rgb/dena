<?php
require_once __DIR__ . '/inc-frontend.php';

$productId = isset($_GET['id']) ? trim($_GET['id']) : (isset($_GET['product']) ? trim($_GET['product']) : '');
$catalogueItem = $productId !== '' ? catalogue_find_product($productId) : null;

// Fallback to legacy database table tbl_products if not in JSON catalogue
$dbProduct = null;
if (!$catalogueItem) {
    $dbProduct = $productId !== '' ? fe_find_by_slug($conn, 'tbl_products', $productId) : null;
}

if (!$catalogueItem && !$dbProduct) {
    // If neither, fallback to first catalogue product
    $delta = catalogue_find_brand('brand_delta');
    $firstSub = $delta['children'][0] ?? null;
    $firstCat = $firstSub['children'][0] ?? null;
    $firstProd = $firstCat['products'][0] ?? null;
    if ($firstProd) {
        $catalogueItem = catalogue_find_product($firstProd['id']);
    }
}

if ($catalogueItem) {
    $prod = $catalogueItem['product'];
    $cat = $catalogueItem['category'];
    $sub = $catalogueItem['subcategory'];
    $brand = $catalogueItem['brand'];
    $imgUrl = $catalogueItem['image'];
    $related = $catalogueItem['related'];

    $pageTitle = htmlspecialchars($prod['name']) . ' - ' . htmlspecialchars($brand['name']) . ' ' . htmlspecialchars($sub['name']) . ' | Digitech';
    $metaDescription = 'Explore specifications and availability for ' . htmlspecialchars($prod['name']) . ' (' . htmlspecialchars($cat['name']) . '), genuine industrial automation hardware from Digitech Electrical & Automations.';
    $metaKeywords = htmlspecialchars($prod['name']) . ', ' . htmlspecialchars($brand['name']) . ', ' . htmlspecialchars($sub['name']) . ', industrial automation, Digitech';
} else {
    $product = $dbProduct;
    $points = decode_list($product['points'] ?? '[]');
    $pageTitle = $product['meta_title'] ?: ($product['title'] . ' Supplier - Industrial Products | Digitech');
    $metaDescription = $product['meta_description'] ?: $product['description'];
    $metaKeywords = $product['meta_keywords'] ?: strtolower($product['title']);
}

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
                                    <h2><?php echo htmlspecialchars($catalogueItem ? $prod['name'] : $product['title']); ?></h2>
                                    <div class="breadcrumb-wrap">
                                        <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                                <li class="breadcrumb-item"><a href="products.php">Products</a></li>
                                                <?php if ($catalogueItem): ?>
                                                <li class="breadcrumb-item"><a href="products.php?brand=<?php echo urlencode(strtolower(str_replace('brand_', '', $brand['id']))); ?>"><?php echo htmlspecialchars($brand['name']); ?></a></li>
                                                <li class="breadcrumb-item"><a href="products.php?brand=<?php echo urlencode(strtolower(str_replace('brand_', '', $brand['id']))); ?>&amp;subcat=<?php echo urlencode($sub['id']); ?>"><?php echo htmlspecialchars($sub['name']); ?></a></li>
                                                <li class="breadcrumb-item active" aria-current="page"><?php echo htmlspecialchars($prod['name']); ?></li>
                                                <?php else: ?>
                                                <li class="breadcrumb-item active" aria-current="page"><?php echo htmlspecialchars($product['title']); ?></li>
                                                <?php endif; ?>
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

        <?php if ($catalogueItem): ?>
        <!-- JSON Catalogue Product Detail Area -->
        <section class="product-simple-detail p-relative pt-90 pb-90">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12 mb-40 mb-lg-0">
                        <div class="product-detail-visual-card">
                            <img src="<?php echo htmlspecialchars($imgUrl); ?>" alt="<?php echo htmlspecialchars($prod['name']); ?>" class="img-fluid">
                            <div class="product-badge-overlay">
                                <span class="badge-brand"><?php echo htmlspecialchars($brand['name']); ?></span>
                                <span class="badge-sub"><?php echo htmlspecialchars($sub['name']); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="product-simple-content pl-20">
                            <div class="product-hierarchy-chips mb-15">
                                <span class="chip-item"><i class="fa-light fa-tag"></i> Brand: <strong><?php echo htmlspecialchars($brand['name']); ?></strong></span>
                                <span class="chip-item"><i class="fa-light fa-layer-group"></i> Subcategory: <strong><?php echo htmlspecialchars($sub['name']); ?></strong></span>
                                <span class="chip-item"><i class="fa-light fa-diagram-project"></i> Series: <strong><?php echo htmlspecialchars($cat['name']); ?></strong></span>
                            </div>

                            <h1 class="product-title-detail mb-10"><?php echo htmlspecialchars($prod['name']); ?></h1>
                            <p class="product-base-name mb-20 text-muted"><strong>Base Model / Family:</strong> <?php echo htmlspecialchars($prod['base_name']); ?></p>

                            <div class="product-meta-specs-box mb-30">
                                <h5><i class="fa-light fa-circle-info"></i> Product Hierarchy &amp; Classification</h5>
                                <table class="table table-sm table-bordered mt-15 mb-0">
                                    <tbody>
                                        <tr>
                                            <th scope="row" style="width: 35%;">Product Name</th>
                                            <td><strong><?php echo htmlspecialchars($prod['name']); ?></strong></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Base Name</th>
                                            <td><?php echo htmlspecialchars($prod['base_name']); ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Brand</th>
                                            <td><?php echo htmlspecialchars($brand['name']); ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Subcategory</th>
                                            <td><?php echo htmlspecialchars($sub['name']); ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Category / Series</th>
                                            <td><?php echo htmlspecialchars($cat['name']); ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Source Reference</th>
                                            <td>WEBSITE.pdf (Page <?php echo htmlspecialchars(implode(', ', $prod['source_pages'] ?? [])); ?>)</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="product-actions-bar">
                                <button type="button" class="btn enquire-trigger-btn" data-bs-toggle="modal" data-bs-target="#enquireModal" data-product="<?php echo htmlspecialchars($prod['name']); ?>">
                                    Enquire for <?php echo htmlspecialchars($prod['name']); ?> <i class="fa-light fa-bolt"></i>
                                </button>
                                <a href="products.php?brand=<?php echo urlencode(strtolower(str_replace('brand_', '', $brand['id']))); ?>&amp;subcat=<?php echo urlencode($sub['id']); ?>" class="btn btn-border ml-15">
                                    <i class="fa-light fa-arrow-left"></i> Back to <?php echo htmlspecialchars($sub['name']); ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if (!empty($related)): ?>
                <!-- Related Products Section -->
                <div class="related-products-section mt-80">
                    <div class="section-title text-left mb-30">
                        <div class="sub-title"><i class="fa-light fa-bolt"></i> Same Family</div>
                        <h3>Related Models in <span><?php echo htmlspecialchars($cat['name']); ?></span></h3>
                    </div>
                    <div class="row g-4">
                        <?php foreach (array_slice($related, 0, 4) as $rel): ?>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                            <div class="catalogue-product-card h-100">
                                <a href="product-detail.php?id=<?php echo urlencode($rel['id']); ?>" class="card-thumb">
                                    <img src="<?php echo htmlspecialchars($rel['image']); ?>" alt="<?php echo htmlspecialchars($rel['name']); ?>">
                                    <span class="card-brand-badge"><?php echo htmlspecialchars($brand['name']); ?></span>
                                </a>
                                <div class="card-body">
                                    <span class="card-cat-label"><?php echo htmlspecialchars($cat['name']); ?></span>
                                    <h4 class="card-title">
                                        <a href="product-detail.php?id=<?php echo urlencode($rel['id']); ?>"><?php echo htmlspecialchars($rel['name']); ?></a>
                                    </h4>
                                    <div class="card-footer-action">
                                        <a href="product-detail.php?id=<?php echo urlencode($rel['id']); ?>" class="btn-view-detail">View Details <i class="fa-light fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

            </div>
        </section>
        <?php else: ?>
        <!-- Legacy Product Detail Area (tbl_products) -->
        <section class="product-simple-detail p-relative pt-90 pb-90">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12">
                        <div class="product-simple-thumb">
                            <img src="<?php echo htmlspecialchars(upload_url($product['image'])); ?>" alt="<?php echo htmlspecialchars($product['title']); ?>">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="product-simple-content">
                            <h2><?php echo htmlspecialchars($product['title']); ?></h2>
                            <p><?php echo htmlspecialchars($product['description']); ?></p>
                            <?php if (!empty($points)): ?>
                            <ul class="program-points">
                                <?php foreach ($points as $point): ?>
                                <li><i class="fa-light fa-circle-check"></i> <?php echo htmlspecialchars($point); ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <?php endif; ?>
                            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#enquireModal">Enquire Now <i class="fa-light fa-bolt"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php endif; ?>

    </main>
    <!-- main-area-end -->
    <!-- footer -->
<?php include('footer.php'); ?>
