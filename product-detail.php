<?php
require_once __DIR__ . '/inc-frontend.php';

$slug = isset($_GET['product']) ? $_GET['product'] : '';
$product = $slug !== '' ? fe_find_by_slug($conn, 'tbl_products', $slug) : null;

if (!$product) {
    $fallback = fe_active_rows($conn, 'tbl_products', 'display_order ASC, id ASC', 1);
    if (!$fallback) {
        header('Location: products.php');
        exit;
    }
    $product = $fallback[0];
}

$points = decode_list($product['points']);

$pageTitle = $product['meta_title'] ?: ($product['title'] . ' Supplier - Industrial Products | DENA');
$metaDescription = $product['meta_description'] ?: $product['description'];
$metaKeywords = $product['meta_keywords'] ?: strtolower($product['title']);
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
                                    <h2><?php echo htmlspecialchars($product['title']); ?></h2>
                                    <div class="breadcrumb-wrap">
                                        <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                                <li class="breadcrumb-item"><a href="products.php">Products</a></li>
                                                <li class="breadcrumb-item active" aria-current="page"><?php echo htmlspecialchars($product['title']); ?></li>
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

        <!-- product-detail-area -->
        <section class="product-simple-detail p-relative pt-120 pb-90">
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
        <!-- product-detail-area-end -->


    </main>
    <!-- main-area-end -->
    <!-- footer -->
<?php include('footer.php'); ?>
