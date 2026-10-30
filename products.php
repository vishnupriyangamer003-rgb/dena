<?php
require_once __DIR__ . '/inc-frontend.php';
$products = fe_active_rows($conn, 'tbl_products');

$pageTitle = 'Industrial Products - Sensors, Motors, Encoders, Switchgear & More | DENA';
$metaDescription = 'Genuine industrial products from DENA - Gear Box, Sensor, Servo Drive & Motor, SwitchGear, AC Motor, Encoder, ThermoCouple, Wires & Cables and Temperature Controller.';
$metaKeywords = 'industrial products supplier, gear box, sensor, servo motor, switchgear, AC motor, encoder, thermocouple, wires and cables, temperature controller, DENA products';
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
                                    <h2>Products</h2>
                                    <div class="breadcrumb-wrap">
                                        <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                                <li class="breadcrumb-item active" aria-current="page">Products</li>
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

        <!-- products-area -->
        <section class="p-relative pt-120 pb-120">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-12">
                        <div class="section-title text-center wow fadeInDown animated" data-animation="fadeInDown" data-delay=".4s">
                            <div class="sub-title"> <i class="fa-light fa-bolt"></i> Our Products <i class="fa-light fa-bolt"></i></div>
                            <h2 class="text-anime-style-3">Industrial Products <span>We Supply</span></h2>
                        </div>
                    </div>
                </div>
                <p class="text-center" style="max-width: 700px; margin: 0 auto 45px;">Genuine, reliable components sourced from trusted manufacturers to keep your electrical and automation systems running at their best.</p>
                <div class="panels-grid">
                    <?php foreach ($products as $prod): ?>
                    <div class="panel-card">
                        <a href="product-detail.php?product=<?php echo urlencode($prod['slug']); ?>">
                            <div class="panel-card-thumb">
                                <img src="<?php echo htmlspecialchars(upload_url($prod['image'])); ?>" alt="<?php echo htmlspecialchars($prod['title']); ?>">
                            </div>
                        </a>
                        <div class="panel-card-body">
                            <h3><a href="product-detail.php?product=<?php echo urlencode($prod['slug']); ?>"><?php echo htmlspecialchars($prod['title']); ?></a></h3>
                            <p><?php echo htmlspecialchars($prod['description']); ?></p>
                            <a href="product-detail.php?product=<?php echo urlencode($prod['slug']); ?>" class="chevron-button">View Details <i class="fa-light fa-bolt"></i></a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <!-- products-area-end -->


    </main>
    <!-- main-area-end -->
    <!-- footer -->
<?php include('footer.php'); ?>
