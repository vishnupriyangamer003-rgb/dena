<?php
require_once __DIR__ . '/inc-frontend.php';
$programs = fe_active_rows($conn, 'tbl_programming');

$pageTitle = 'Automation Programming Services - SCADA, PLC/HMI, VFD & Servo Drive | DENA';
$metaDescription = 'DENA offers automation programming and commissioning services - SCADA systems, PLC/HMI programming, VFD drive configuration and servo drive motion control.';
$metaKeywords = 'SCADA programming, PLC programming, HMI programming, VFD drive configuration, servo drive programming, automation commissioning, DENA programming services';
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
                                    <h2>Programming</h2>
                                    <div class="breadcrumb-wrap">
                                        <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                                <li class="breadcrumb-item active" aria-current="page">Programming</li>
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

        <!-- programming-intro-area -->
        <!-- <section class="p-relative pt-120 pb-30">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-12">
                        <div class="section-title text-center wow fadeInDown animated" data-animation="fadeInDown" data-delay=".4s">
                            <div class="sub-title"> <i class="fa-light fa-bolt"></i> Programming Services <i class="fa-light fa-bolt"></i></div>
                            <h2 class="text-anime-style-3">Automation Programming <span>& Commissioning</span></h2>
                        </div>
                    </div>
                </div>
                <p class="text-center" style="max-width: 700px; margin: 0 auto;">From process visualization to precision motion control, our programming team configures and commissions the systems that keep your automation running smoothly.</p>
            </div>
        </section> -->
        <!-- programming-intro-area-end -->

        <!-- programming-list-area -->
        <section class="products-list-area p-relative pt-30 pb-90">
            <div class="container">
                <?php foreach ($programs as $i => $prog): $progPoints = decode_list($prog['points']); ?>
                <div id="<?php echo htmlspecialchars($prog['slug']); ?>" class="product-row row align-items-center <?php echo $i % 2 === 1 ? 'flex-row-reverse' : ''; ?>">
                    <div class="col-lg-5 col-md-12">
                        <div class="product-row-thumb">
                            <span class="product-row-num"><i class="fa-light <?php echo htmlspecialchars($prog['icon']); ?>"></i></span>
                            <img src="<?php echo htmlspecialchars(upload_url($prog['image'])); ?>" alt="<?php echo htmlspecialchars($prog['title']); ?>">
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-12">
                        <div class="product-row-content">
                            <h1 style="font-size: 27px;"><?php echo htmlspecialchars($prog['title']); ?></h1>
                            <p><?php echo htmlspecialchars($prog['description']); ?></p>
                            <?php if ($progPoints): ?>
                            <ul class="program-points">
                                <?php foreach ($progPoints as $point): ?>
                                <li><i class="fa-light fa-circle-check"></i> <?php echo htmlspecialchars($point); ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
        <!-- programming-list-area-end -->


    </main>
    <!-- main-area-end -->
    <!-- footer -->
<?php include('footer.php'); ?>
