<?php
require_once __DIR__ . '/inc-frontend.php';
$jobs = fe_active_rows($conn, 'tbl_careers');
$careersCvEmail = fe_setting($conn, 'careers_cv_email', 'sales.dea@outlook.com');

$pageTitle = 'Careers - Job Openings at Digitech Electrical & Automations (DENA)';
$metaDescription = 'Explore current job openings at DENA including Electrical Design Engineer, PLC/SCADA Programmer, Panel Wiring Technician and more. Send your CV to sales.dea@outlook.com.';
$metaKeywords = 'DENA careers, electrical engineer jobs Karur, PLC programmer jobs, panel wiring technician jobs, automation engineer jobs Tamil Nadu, electrical company jobs';
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
                                    <h2>Careers</h2>
                                    <div class="breadcrumb-wrap">
                                        <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                                <li class="breadcrumb-item active" aria-current="page">Careers</li>
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

        <!-- careers-intro-area -->
        <section class="p-relative pt-50 pb-0">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7 col-md-12">
                        <div class="section-title text-center wow fadeInDown animated" data-animation="fadeInDown" data-delay=".4s">
                            <div class="sub-title"> <i class="fa-light fa-bolt"></i> Careers at DENA <i class="fa-light fa-bolt"></i></div>
                            <h2 class="text-anime-style-3">Current <span>Openings</span></h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- careers-intro-area-end -->

        <!-- careers-list-area -->
        <section class="careers-list-area p-relative pt-30 pb-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12">
                        <div class="careers-list">
                            <?php foreach ($jobs as $job): ?>
                            <div class="job-item">
                                <div class="job-item-main">
                                    <h3><?php echo htmlspecialchars($job['title']); ?></h3>
                                    <div class="job-meta">
                                        <span><i class="fa-light fa-location-dot"></i> <?php echo htmlspecialchars($job['location']); ?></span>
                                        <span><i class="fa-light fa-briefcase"></i> <?php echo htmlspecialchars($job['experience']); ?></span>
                                    </div>
                                    <p><?php echo htmlspecialchars($job['description']); ?></p>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="careers-cv-box">
                            <div class="careers-cv-icon"><i class="fa-light fa-paper-plane"></i></div>
                            <h3>Interested in Any of the Mentioned Roles?</h3>
                            <p>Send your updated CV to</p>
                            <a href="mailto:<?php echo htmlspecialchars($careersCvEmail); ?>" class="careers-cv-email"><?php echo htmlspecialchars($careersCvEmail); ?></a>
                            <p class="careers-cv-note">and we'll get in touch with you.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- careers-list-area-end -->


    </main>
    <!-- main-area-end -->
    <!-- footer -->
<?php include('footer.php'); ?>
