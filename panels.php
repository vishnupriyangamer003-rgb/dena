<?php
require_once __DIR__ . '/inc-frontend.php';
$panels = fe_active_rows($conn, 'tbl_panels');

$pageTitle = 'Electrical Control Panels - PLC, MCC, PCC, VFD, APFC & More | DENA';
$metaDescription = 'Explore DENA\'s complete range of electrical control panels - PLC, MCC, PCC, APFC, VFD, DB, Servo Drive, MCB, Relay Logic, Street Light Control and Starter panels.';
$metaKeywords = 'PLC panel, MCC panel, PCC panel, APFC panel, VFD panel, DB panel, servo drive panel, MCB panel, relay logic panel, street light control panel, control panel manufacturer';
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
                                    <h2>Panels</h2>
                                    <div class="breadcrumb-wrap">
                                        <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                                <li class="breadcrumb-item active" aria-current="page">Panels</li>
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

        <!-- panels-area -->
        <section class="p-relative pt-60 pb-60">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-12">
                        <div class="section-title text-center wow fadeInDown animated" data-animation="fadeInDown" data-delay=".4s">
                            <div class="sub-title"> <i class="fa-light fa-bolt"></i> Our Panels <i class="fa-light fa-bolt"></i></div>
                            <h2 class="text-anime-style-3">Control Panels Built <span>for Every Application</span></h2>
                        </div>
                    </div>
                </div>
                <p class="text-center" style="max-width: 700px; margin: 0 auto 45px;">Explore our complete range of electrical and automation control panels, engineered and manufactured in-house.</p>
                <div class="panels-grid">
                    <?php foreach ($panels as $p): ?>
                    <div class="panel-card">
                        <a href="panel-detail.php?panel=<?php echo urlencode($p['slug']); ?>">
                            <div class="panel-card-thumb">
                                <img src="<?php echo htmlspecialchars(upload_url($p['image'])); ?>" alt="<?php echo htmlspecialchars($p['title']); ?>">
                            </div>
                        </a>
                        <div class="panel-card-body">
                            <h3><a href="panel-detail.php?panel=<?php echo urlencode($p['slug']); ?>"><?php echo htmlspecialchars($p['title']); ?></a></h3>
                            <p><?php echo htmlspecialchars($p['short_description']); ?></p>
                            <a href="panel-detail.php?panel=<?php echo urlencode($p['slug']); ?>" class="chevron-button">View Details <i class="fa-light fa-bolt"></i></a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <!-- panels-area-end -->

        <!-- cta-area -->
        <section class="cta-strip p-relative">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-8 col-md-12">
                        <h2>Have an Industrial Automation Requirement?</h2>
                        <p>Let's discuss your requirement and build the right solution for your process.</p>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="cta-buttons">
                            <a href="contact.php" class="btn">Request a Quote <i class="fa-light fa-bolt"></i></a>
                            <a href="contact.php" class="btn btn-border">Talk to Our Experts <i class="fa-light fa-bolt"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- cta-area-end -->

    </main>
    <!-- main-area-end -->
    <!-- footer -->
<?php include('footer.php'); ?>
