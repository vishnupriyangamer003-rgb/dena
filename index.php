<?php
$pageTitle = 'Digitech Electrical & Automations (DENA) - Electrical, Control Panel & Industrial Automation Solutions';
$metaDescription = 'DENA delivers reliable electrical control panels (PLC, MCC, PCC, VFD), industrial automation, SCADA/PLC/HMI programming and electrical products for industries across Tamil Nadu.';
$metaKeywords = 'electrical control panels Karur, industrial automation Tamil Nadu, PLC panel manufacturer, control panel manufacturer, SCADA PLC HMI programming, DENA Digitech Electrical Automations';
include('header.php');
?>
<style>
    .section-title h2.text-anime-style-3 {
    font-size: clamp(16px, 4vw, 40px) !important;
    line-height: 1.2;
}
</style>
    <!-- main-area -->
    <main>
        <!-- slider-area -->
        <section id="home" class="slider-area fix p-relative">

            <div class="slider-active pl-50 pr-50">
                <?php foreach (fe_active_rows($conn, 'tbl_banners') as $banner): ?>
                <div class="single-slider slider-bg d-flex align-items-center img" style="background-image: url(<?php echo htmlspecialchars(upload_url($banner['image'])); ?>); background-size: cover; background-position: center;">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-7 col-md-12">
                                <div class="slider-content s-slider-content mt-50">
                                    <h2 class="text-anime-style-3"><?php echo htmlspecialchars($banner['heading']); ?></h2>
                                    <p data-animation="fadeInUp" data-delay=".4s"><?php echo htmlspecialchars($banner['subheading']); ?></p>
                                    <div class="slider-btn mt-50" data-animation="fadeInUp" data-delay=".4s">
                                        <a href="<?php echo htmlspecialchars($banner['btn1_link']); ?>" class="btn mr-15"><?php echo htmlspecialchars($banner['btn1_text']); ?> <i class="fa-light fa-bolt"></i></a>
                                        <a href="<?php echo htmlspecialchars($banner['btn2_link']); ?>" class="btn btn-border"><?php echo htmlspecialchars($banner['btn2_text']); ?> <i class="fa-light fa-bolt"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
        <!-- slider-area-end -->

        <!-- about-area -->
<section class="about-area about-p p-relative pt-120 pb-120">
    <div class="animations-02">
        <img src="img/bg/an-img-01.png" alt="contact-bg-an-01">
    </div>

    <div class="container">
        <div class="row">

            <div class="col-xl-6 col-md-12 col-sm-12">
                <div class="s-about-img p-relative wow fadeInLeft animated"
                     data-animation="fadeInLeft" data-delay=".4s">

                    <div class="ani-1 img-custom-anim-left wow fadeInLeft"
                         data-delay=".2s">
                        <div class="icon">
                            <i class="fa-thin fa-crown"></i>
                        </div>

                        <h3 style="font-size: 16px;">10+ Years Of Experience</h3>

                        <p style="padding-left: 0px;">
                            Trusted electrical and automation experts with
                            <br>10+ years of industry experience.
                        </p>
                    </div>

                    <div class="badge">
                        <img src="img/features/badge.png" alt="icon01">
                    </div>

                    <div class="img-custom-anim-left wow fadeInLeft"
                         data-delay=".1s">
                        <img src="img/features/about_img_01.png"
                             alt="Digitech Electrical & Automations">
                    </div>

                </div>
            </div>

            <div class="col-xl-6 col-md-12 col-sm-12">
                <div class="about-content pl-10 s-about-content wow fadeInLeft animated"
                     data-delay=".4s">

                    <div class="section-title">
                        <div class="sub-title">
                            <i class="fa-light fa-bolt"></i>
                            About DENA
                            <i class="fa-light fa-bolt"></i>
                        </div>

                        <h2 class="text-anime-style-3">
                            Powering&nbsp;Industry&nbsp;Through
                            <span>Engineering & Automation</span>
                        </h2>
                    </div>

                    <p>
                        Digitech Electrical & Automations (DENA) is a leading
                        provider of manufacturing automation solutions with
                        10+ years of industry experience. We deliver reliable
                        electrical, instrumentation and industrial automation
                        solutions designed to improve efficiency, save energy
                        and enhance overall plant performance.
                    </p>

                    <div class="about-count">
                        <div class="row">

                            <div class="col-lg-6">
                                <div class="about-outer">
                                    <div class="icon">
                                        <img src="img/features/ab-icon-01.svg"
                                             alt="Quality Engineering">
                                    </div>

                                    <div class="text">
                                        <h3>Quality Engineering</h3>
                                        <p>
                                            Proven engineering solutions with
                                            reliable standards and quality.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="about-outer">
                                    <div class="icon">
                                        <img src="img/features/ab-icon-02.svg"
                                             alt="Customized Solutions">
                                    </div>

                                    <div class="text">
                                        <h3>Customized Solutions</h3>
                                        <p>
                                            Tailored solutions based on
                                            specific process requirements.
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>        <!-- about-area-end -->


        <section class="services-area p-relative fix">
            <div class="container-box pt-50 pb-50" style="background-color: #004250;">
                <div class="animations-01"><img src="img/bg/an-img-02.png" alt="contact-bg-an-01"></div>
                <div class="container">
                    <div class="row justify-content-center mb-55">
                        <div class="col-lg-6 col-md-12">
                            <div class="section-title text-center wow fadeInDown animated" data-animation="fadeInDown" data-delay=".4s">
                                <div class="sub-title"> <i class="fa-light fa-bolt"></i> Our Solutions <i class="fa-light fa-bolt"></i></div>
                                <h2 class="text-anime-style-3">Complete Electrical  <span>& Automation Solutions</span></h2>
                            </div>

                        </div>
                    </div>
                    <div class="row services-active">
                        
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="services-box wow fadeInUp animated" data-animation="fadeInUp" data-delay=".4s">
                                <div class="services-content">
                                    <div class="img-custom-anim-left wow fadeInLeft services-icon">
                                        <img src="img/gallery/control-panel.jpg" alt="DENA Control Panel" class="homeserv-img">
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="icon-box">
                                                <div class="icon">
                                                    <div> <img src="img/icon/sr-icon-01.png" alt="icon01"></div>
                                                </div>
                                                <div class="heading">
                                                    <h3><a href="panels.php">Control Panels</a></h3>
                                                </div>
                                            </div>
                                            <p>Built for reliable power distribution, motor control and industrial automation.</p>
                                            <div class="sbtn mt-20">
                                                <a href="panels.php" class="chevron-button">Explore Panels <i class="fa-light fa-bolt"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="services-box wow fadeInUp animated" data-animation="fadeInUp" data-delay=".4s">
                                <div class="services-content">
                                    <div class="img-custom-anim-left wow fadeInLeft services-icon">
                                        <img src="img/gallery/industrial-products.jpg" alt="DENA Industrial Products" class="homeserv-img">
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="icon-box">
                                                <div class="icon">
                                                    <div> <img src="img/icon/sr-icon-01.png" alt="icon01"></div>
                                                </div>
                                                <div class="heading">
                                                    <h3><a href="products.php">Industrial Products</a></h3>
                                                </div>
                                            </div>
                                            <p>Quality electrical & automation from trusted technologies and brands.</p>
                                            <div class="sbtn mt-20">
                                                <a href="products.php" class="chevron-button">Explore Products <i class="fa-light fa-bolt"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="services-box wow fadeInUp animated" data-animation="fadeInUp" data-delay=".4s">
                                <div class="services-content">
                                    <div class="img-custom-anim-left wow fadeInLeft services-icon">
                                        <img src="img/gallery/programming.webp" alt="DENA Engineering & Programming" class="homeserv-img">
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="icon-box">
                                                <div class="icon">
                                                    <div> <img src="img/icon/sr-icon-01.png" alt="icon01"></div>
                                                </div>
                                                <div class="heading">
                                                    <h3><a href="programming.php"> Automation <br>&nbsp;Engineering</a></h3>
                                                </div>
                                            </div>
                                            <p>Customized programming, integration and control solutions for your process.</p>
                                            <div class="sbtn mt-20">
                                                <a href="programming.php" class="chevron-button">Our Expertise <i class="fa-light fa-bolt"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </section>

        <!-- why-hoose-us-area -->
        <section class="pt-120 pb-90 p-relative">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="section-title mb-30 wow fadeInDown animated" data-delay=".4s">
                            <div class="sub-title">
                                <i class="fa-light fa-bolt"></i> Why Choose DENA <i class="fa-light fa-bolt"></i>
                            </div>
                            <h2 class="text-anime-style-3">
                                Reliable Engineering & <span>Lasting Performance </span>
                            </h2>
                        </div>
                        <div class="why-choose-text">
                            <div class="img-custom-anim-left wow fadeInLeft img mb-30">
                                <img src="img/bg/why_choose_img.png" alt="an-img-01">
                            </div>
                            <div class="row">
                                <div class="col-lg-8">
                                    <p style="text-align: justify;">At DENA, we focus on delivering dependable electrical and industrial automation solutions that meet the specific requirements of every project. Our approach combines technical expertise, quality engineering and customer-focused service.</p>
                                </div>
                                <div class="col-lg-4"> <a href="contact.php" class="btn">Contact Us <i class="fa-light fa-bolt"></i></a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row timeline">
                            <div class="col-lg-12 col-md-12">
                                <div class="services-02-item mb-20 wow fadeInDown animated" data-delay=".4s">
                                    <div class="services-02-thumb">
                                        <span>01</span>
                                    </div>
                                    <div class="services-02-content">
                                        <h3>Industry Experience</h3>
                                        <p>Our experts understands the challenges of industrial electrical and automation applications and delivers solutions suited to real-world operating conditions.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="services-02-item mb-20 wow fadeInDown animated" data-delay=".4s">
                                    <div class="services-02-thumb">
                                        <span>02</span>
                                    </div>
                                    <div class="services-02-content">
                                        <h3>Customized Solutions</h3>
                                        <p>Every industry and application has different needs. We develop and configure solutions based on your equipment, process and specific project requirements.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="services-02-item mb-20  wow fadeInDown animated" data-delay=".4s">
                                    <div class="services-02-thumb">
                                        <span>03</span>
                                    </div>
                                    <div class="services-02-content">
                                        <h3>Quality Engineering</h3>
                                        <p>From panel design and manufacturing to automation systems and industrial components, we focus on quality, precision and dependable performance.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="services-02-item mb-20  wow fadeInDown animated" data-delay=".4s">
                                    <div class="services-02-thumb">
                                        <span>04</span>
                                    </div>
                                    <div class="services-02-content">
                                        <h3>Over 25 Years of Experience</h3>
                                        <p>With over a decade of experience, we deliver trusted electrical services. Our expertise ensures quality workmanship on every project.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="services-02-item mb-20 wow fadeInDown animated" data-delay=".4s">
                                    <div class="services-02-thumb">
                                        <span>05</span>
                                    </div>
                                    <div class="services-02-content">
                                        <h3>Technical Support</h3>
                                        <p>We are committed to exceeding customer expectations every time. Your satisfaction is guaranteed with our professional service.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>


        <!-- gallery-area -->
        <section class="gallery-area p-relative fix" data-aos="fade-up" data-aos-duration="1000">
            <div class="container-box pt-50 pb-50" style="background-color: #ddeff3;">
                <div class="animations-02"><img src="img/bg/an-img-03.png" alt="contact-bg-an-01"></div>
                <div class="container">
                    <div class="row justify-content-center mb-55">
                        <div class="col-lg-5 col-md-12">
                            <div class="section-title text-center wow fadeInDown animated" data-animation="fadeInDown" data-delay=".4s">
                                <div class="sub-title"> <i class="fa-light fa-bolt"></i>Control Panels <i class="fa-light fa-bolt"></i></div>
                                <h2 class="text-anime-style-3">Control Panels Built   <br>
                                    <span>Around Your Process</span>
                                </h2>
                            </div>

                        </div>
                    </div>
                    <div class="row">

                        <?php foreach (fe_active_rows($conn, 'tbl_panels', 'display_order ASC, id ASC', 6) as $homePanel): ?>
                        <div class="col-lg-4 col-md-12 mb-30">
                            <a href="panel-detail.php?panel=<?php echo urlencode($homePanel['slug']); ?>">
                                <figure class="gallery-image img-custom-anim-left wow fadeInLeft" data-delay=".1s">
                                    <img src="<?php echo htmlspecialchars(upload_url($homePanel['image'])); ?>" alt="DENA <?php echo htmlspecialchars($homePanel['title']); ?>" class="panelimg img">
                                    <figcaption>
                                        <div class="text-outer"> <div class="text"> <h3> <?php echo htmlspecialchars($homePanel['title']); ?> </h3> </div>
                                            <div class="icon"> <img src="img/gallery/crown.png" alt="img"> </div>
                                        </div>
                                    </figcaption>
                                </figure>
                            </a>
                        </div>
                        <?php endforeach; ?>
                        <div class="col-lg-12 text-center">
                            <a href="panels.php" class="btn">View More <i class="fa-light fa-bolt"></i></a>
                        </div>


                    </div>
                </div>
            </div>
        </section>
        <!-- gallery-area-end -->




        <!-- industries-area -->
        <style>
            .industries-area .section-title { margin-bottom: 45px; }
            .industries-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; }
            .industry-card {
                display: flex; align-items: center; gap: 14px;
                background: #0000000d; border: 1px solid #e7edf0; border-radius: 8px;
                padding: 22px 20px; transition: all .25s ease;
            }
            .industry-card:hover { border-color: #004250; box-shadow: 0 8px 20px rgba(0,66,80,.08); transform: translateY(-3px); }
            .industry-card .icon {
                flex: 0 0 46px; width: 46px; height: 46px; border-radius: 50%;
                background: #004250; color: #fff; display: flex; align-items: center; justify-content: center;
                font-size: 18px; transition: all .25s ease;
            }
            .industry-card:hover .icon {
                background: #ffffff;
                color: #004250;
            }
            .industry-card h3 { font-size: 16px; margin: 0; font-weight: 600; color: #17252b; }
            @media (max-width: 991px) { .industries-grid { grid-template-columns: repeat(2, 1fr); } }
            @media (max-width: 575px) { .industries-grid { grid-template-columns: 1fr; } }
        </style>
        <section class="industries-area p-relative pt-60 pb-60">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-12">
                        <div class="section-title text-center wow fadeInDown animated" data-animation="fadeInDown" data-delay=".4s">
                            <div class="sub-title"> <i class="fa-light fa-bolt"></i> Industries We Serve <i class="fa-light fa-bolt"></i></div>
                            <h2 class="text-anime-style-3">Solutions Across <span>Diverse Industries</span></h2>
                        </div>
                    </div>
                </div>
                <p class="text-center" style="max-width: 700px; margin: -20px auto 40px;">Our electrical and automation expertise supports a wide range of industrial applications.</p>
                <div class="industries-grid">
                    <div class="industry-card"><div class="icon"><i class="fa-light fa-shirt"></i></div><h3>Textile</h3></div>
                    <div class="industry-card"><div class="icon"><i class="fa-light fa-flask"></i></div><h3>Chemical</h3></div>
                    <div class="industry-card"><div class="icon"><i class="fa-light fa-pills"></i></div><h3>Pharmaceutical</h3></div>
                    <div class="industry-card"><div class="icon"><i class="fa-light fa-utensils"></i></div><h3>Food Processing</h3></div>
                    <div class="industry-card"><div class="icon"><i class="fa-light fa-droplet"></i></div><h3>Water Treatment</h3></div>
                    <div class="industry-card"><div class="icon"><i class="fa-light fa-oil-well"></i></div><h3>Oil & Gas</h3></div>
                    <div class="industry-card"><div class="icon"><i class="fa-light fa-industry"></i></div><h3>Iron & Steel</h3></div>
                    <div class="industry-card"><div class="icon"><i class="fa-light fa-bolt"></i></div><h3>Power & Utilities</h3></div>
                    <div class="industry-card"><div class="icon"><i class="fa-light fa-city"></i></div><h3>Cement</h3></div>
                    <div class="industry-card"><div class="icon"><i class="fa-light fa-gauge-high"></i></div><h3>Pump Houses</h3></div>
                    <div class="industry-card"><div class="icon"><i class="fa-light fa-water"></i></div><h3>Sewage Treatment</h3></div>
                    <div class="industry-card"><div class="icon"><i class="fa-light fa-fire-flame-simple"></i></div><h3>Refineries</h3></div>
                </div>
            </div>
        </section>
        <!-- industries-area-end -->


        <!-- products-area -->
        <style>
            .products-area .section-title { margin-bottom: 10px; }
            .products-area .products-active { margin: 0 -12px; }
            .products-area .product-item { margin: 0 12px; }
            .products-area .product-thumb { border-radius: 8px; overflow: hidden; height: 220px; }
            .products-area .product-thumb img { width: 100%; height: 100%; object-fit: cover; transition: transform .4s ease; }
            .products-area .product-item:hover .product-thumb img { transform: scale(1.08); }
            .products-area .product-item h3 {
                text-align: center; font-size: 17px; font-weight: 600; color: #17252b;
                margin: 18px 0 0; transition: color .25s ease;
            }
            .products-area .product-item:hover h3 { color: #004250; }
            .products-area .products-active .slick-arrow {
                position: absolute; top: 40%; left: -22px; border: none; background: var(--primary-color);
                padding: 0; font-size: 18px; color: #17252b; z-index: 9; cursor: pointer; transition: .3s;
                width: 46px; height: 46px; border-radius: 50%; text-align: center; line-height: 46px;
            }
            .products-area .products-active .slick-arrow:hover { background: #004250; color: #fff; }
            .products-area .products-active .slick-next { left: inherit; right: -22px; }
        </style>
        <section class="products-area p-relative pt-60 pb-100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-12">
                        <div class="section-title text-center wow fadeInDown animated" data-animation="fadeInDown" data-delay=".4s">
                            <div class="sub-title"> <i class="fa-light fa-bolt"></i> Our Products <i class="fa-light fa-bolt"></i></div>
                            <h2 class="text-anime-style-3">Industrial Products <span>& Components</span></h2>
                        </div>
                    </div>
                </div>
                <p class="text-center" style="max-width: 700px; margin: 0 auto 45px;">Reliable components for electrical control, automation and industrial applications.</p>
                <div class="products-active">
                    <?php foreach (fe_active_rows($conn, 'tbl_products') as $homeProduct): ?>
                    <div class="product-item">
                        <a href="product-detail.php?product=<?php echo urlencode($homeProduct['slug']); ?>">
                            <div class="product-thumb"><img src="<?php echo htmlspecialchars(upload_url($homeProduct['image'])); ?>" alt="<?php echo htmlspecialchars($homeProduct['title']); ?>"></div>
                            <h3><?php echo htmlspecialchars($homeProduct['title']); ?></h3>
                        </a>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <!-- products-area-end -->


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
                            <a href="contact.php" class="btn" style="color: #ffffff">Request a Quote <i class="fa-light fa-bolt"></i></a>
                            <a href="contact.php" class="btn btn-border">Talk to Our Experts <i class="fa-light fa-bolt"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- cta-area-end -->



        <!-- brand-strip-area -->
        <section class="brand-strip-area p-relative pt-60 pb-90">
            <div class="container">
                <div class="row justify-content-center pb-50">
                    <div class="col-lg-6 col-md-12">
                        <div class="section-title text-center wow fadeInDown animated" data-animation="fadeInDown" data-delay=".4s">
                            <div class="sub-title"> <i class="fa-light fa-bolt"></i> Our Network <i class="fa-light fa-bolt"></i></div>
                            <h2 class="text-anime-style-3">Our Service <span style="color: #000">Associated With</span></h2>
                        </div>
                    </div>
                </div>
                <div class="brand-strip-grid">
                    <?php foreach (fe_active_rows($conn, 'tbl_network') as $networkItem): ?>
                    <div class="brand-strip-item"><img src="<?php echo htmlspecialchars(upload_url($networkItem['image'])); ?>" alt="<?php echo htmlspecialchars($networkItem['alt_text']); ?>"></div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <!-- brand-strip-area-end -->

    </main>
    <!-- main-area-end -->
    <!-- footer -->
<?php include('footer.php'); ?>
