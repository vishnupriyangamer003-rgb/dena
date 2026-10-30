<?php
require_once __DIR__ . '/inc-frontend.php';
$trainings = fe_active_rows($conn, 'tbl_training');

$pageTitle = 'Training Programs - Electrical & Automation Skill Development | DENA';
$metaDescription = 'Practical, industry-focused training programs at DENA covering PLC programming, industrial automation, panel wiring, SCADA/HMI and motor & drives maintenance.';
$metaKeywords = 'electrical training Karur, PLC training, industrial automation training, panel wiring training, SCADA HMI training, apprenticeship program, DENA training';
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
                                    <h2>Training</h2>
                                    <div class="breadcrumb-wrap">
                                        <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                                <li class="breadcrumb-item active" aria-current="page">Training</li>
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

        <!-- training-intro-area -->
        <section class="p-relative pt-50 pb-30">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-12">
                        <div class="section-title text-center wow fadeInDown animated" data-animation="fadeInDown" data-delay=".4s">
                            <div class="sub-title"> <i class="fa-light fa-bolt"></i> Training Programs <i class="fa-light fa-bolt"></i></div>
                            <h2 class="text-anime-style-3">Build Your Skills <span>With Us</span></h2>
                        </div>
                    </div>
                </div>
                <p class="text-center" style="max-width: 700px; margin: 0 auto;">Practical, industry-focused training programs designed to prepare engineers and technicians for real-world electrical and automation work.</p>
            </div>
        </section>
        <!-- training-intro-area-end -->

        <!-- training-grid-area -->
        <section class="training-grid-area p-relative pt-30 pb-90">
            <div class="container">
                <div class="row">
                    <?php foreach ($trainings as $t): ?>
                    <div class="col-lg-4 col-md-6 mb-30">
                        <div class="training-card">
                            <div class="training-card-thumb">
                                <img src="<?php echo htmlspecialchars(upload_url($t['image'])); ?>" alt="<?php echo htmlspecialchars($t['title']); ?>">
                            </div>
                            <div class="training-card-body">
                                <h3><?php echo htmlspecialchars($t['title']); ?></h3>
                                <p><?php echo htmlspecialchars($t['description']); ?></p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <!-- training-grid-area-end -->


    </main>
    <!-- main-area-end -->
    <!-- footer -->
<?php include('footer.php'); ?>
