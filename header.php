<?php
require_once __DIR__ . '/inc-frontend.php';
$headerEmail = fe_setting($conn, 'site_email', 'info@dena.co.in');
$headerPhone = fe_setting($conn, 'site_phone1', '+91 97877 74321');

if (!isset($pageTitle)) {
    $pageTitle = 'Digitech Electrical & Automations - Electrical, Control Panel & Industrial Automation Solutions';
}
if (!isset($metaDescription)) {
    $metaDescription = 'Digitech Electrical & Automations delivers reliable electrical, control panel and industrial automation solutions - PLC, HMI, SCADA, drives and panel manufacturing for modern industries.';
}
if (!isset($metaKeywords)) {
    $metaKeywords = 'electrical control panels, industrial automation, PLC programming, SCADA, HMI, VFD drives, panel manufacturing, Digitech, Digitech Electrical Automations, Karur';
}
$canonicalBase = 'https://dena.co.in/new/';
$canonicalPath = isset($_SERVER['REQUEST_URI']) ? ltrim($_SERVER['REQUEST_URI'], '/') : 'index.php';
$canonicalUrl = isset($canonicalUrl) ? $canonicalUrl : $canonicalBase . $canonicalPath;
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo htmlspecialchars($pageTitle); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($metaDescription); ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars($metaKeywords); ?>">
    <meta name="robots" content="index, follow">
    <meta name="author" content="Digitech Electrical & Automations">
    <link rel="canonical" href="<?php echo htmlspecialchars($canonicalUrl); ?>">

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php echo htmlspecialchars($pageTitle); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($metaDescription); ?>">
    <meta property="og:url" content="<?php echo htmlspecialchars($canonicalUrl); ?>">
    <meta property="og:image" content="<?php echo htmlspecialchars($canonicalBase); ?>img/logo/dena-favicon.png">
    <meta property="og:site_name" content="Digitech Electrical & Automations">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo htmlspecialchars($pageTitle); ?>">
    <meta name="twitter:description" content="<?php echo htmlspecialchars($metaDescription); ?>">
    <meta name="twitter:image" content="<?php echo htmlspecialchars($canonicalBase); ?>img/logo/dena-favicon.png">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="img/logo/dena-favicon.png">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="fontawesome-pro/css/all.min.css">
    <link rel="stylesheet" href="css/dripicons.css">
    <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" href="css/meanmenu.css">
    <link rel="stylesheet" href="css/default.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/swiper.min.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/mystyle.css">
</head>

<body>
    <!--  Preloader  -->
    <div id="preloader" class="loader-wrapper">
        <div id="loading" class="loader"> </div>
    </div>
    <!--  Preloader end  -->
    <!-- header -->
    <header class="header-area header-two">
        <div id="header-sticky3" class="menu-area">
            <div class="container-fluid pl-50 pr-50">

                <div class="container">
                    <div class="second-menu">
                        <div class="row align-items-center">
                            <div class="col-xl-2 col-lg-2 col-md-5">
                                <div class="logo">
                                    <a href="index.php"><img src="img/logo/dena-logo-png.png" alt="Digitech Electrical & Automations" class="headerlogo"></a>
                                </div>
                            </div>
                            <div class="col-xl-8 col-lg-10">
                                <div class="main-menu text-center">
                                    <nav id="mobile-menu">
                                        <ul>
                                            <li><a href="index.php">Home</a></li>
                                            <li><a href="about.php">About</a></li>
                                            <li class="has-sub">
                                                <a href="panels.php">Panels</a>
                                                <ul>
                                                    <li><a href="panels.php" class="panel-link">All Panels</a></li>
                                                    <li class="has-sub">
                                                        <a href="panels.php">Power Solutions</a>
                                                        <ul>
                                                            <li><a href="panels.php">VCB Panel</a></li>
                                                            <li><a href="panels.php">MV Panel</a></li>
                                                            <li><a href="panel-detail.php?panel=pcc-panel" class="panel-link">PCC</a></li>
                                                            <li><a href="panel-detail.php?panel=mcc-panel" class="panel-link">MCC</a></li>
                                                            <li><a href="panels.php">SSB</a></li>
                                                            <li><a href="panel-detail.php?panel=db-panel" class="panel-link">DB</a></li>
                                                            <li><a href="panel-detail.php?panel=apfc-panel" class="panel-link">APFC</a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="has-sub">
                                                        <a href="panels.php">Control Engineering</a>
                                                        <ul>
                                                            <li><a href="panel-detail.php?panel=plc-panel" class="panel-link">PLC</a></li>
                                                            <li><a href="panel-detail.php?panel=vfd-panel" class="panel-link">VFD</a></li>
                                                            <li><a href="panel-detail.php?panel=servo-drive-panel" class="panel-link">Servo</a></li>
                                                            <li><a href="panel-detail.php?panel=dol-star-delta-panel" class="panel-link">Starter</a></li>
                                                            <li><a href="panels.php">AMF</a></li>
                                                            <li><a href="panels.php">Pneumatic &amp; Hydraulic Based</a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="has-sub">
                                                <a href="products.php">Products</a>
                                                <ul>
                                                    <li><a href="products.php" class="panel-link">All Products</a></li>
                                                    <li class="has-sub">
                                                        <a href="products.php?brand=delta" class="panel-link">DELTA</a>
                                                        <ul>
                                                            <li><a href="products.php?brand=delta&amp;subcat=delta_plc" class="panel-link">Programmable Logic Controller (PLC)</a></li>
                                                            <li><a href="products.php?brand=delta&amp;subcat=delta_hmi" class="panel-link">Human Machine Interface (HMI)</a></li>
                                                            <li><a href="products.php?brand=delta&amp;subcat=delta_text_panel_hmi" class="panel-link">Text Panel HMI</a></li>
                                                            <li><a href="products.php?brand=delta&amp;subcat=delta_vfd" class="panel-link">Variable Frequency Drives (VFD)</a></li>
                                                            <li><a href="products.php?brand=delta&amp;subcat=delta_servo" class="panel-link">Servo Systems</a></li>
                                                            <li><a href="products.php?brand=delta&amp;subcat=delta_scada" class="panel-link">SCADA System</a></li>
                                                            <li><a href="products.php?brand=delta&amp;subcat=delta_motion" class="panel-link">Motion Controller</a></li>
                                                            <li><a href="products.php?brand=delta&amp;subcat=delta_robot" class="panel-link">Robot</a></li>
                                                            <li><a href="products.php?brand=delta&amp;subcat=delta_electric_servo_press" class="panel-link">Electric Servo Press</a></li>
                                                            <li><a href="products.php?brand=delta&amp;subcat=delta_industrial_pc" class="panel-link">Industrial PC</a></li>
                                                            <li><a href="products.php?brand=delta&amp;subcat=delta_mv_drives" class="panel-link">MV Drives</a></li>
                                                            <li><a href="products.php?brand=delta&amp;subcat=delta_temperature" class="panel-link">Temperature Controller</a></li>
                                                            <li><a href="products.php?brand=delta&amp;subcat=delta_smps" class="panel-link">SMPS</a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="has-sub">
                                                        <a href="products.php?brand=invt" class="panel-link">INVT</a>
                                                        <ul>
                                                            <li><a href="products.php?brand=invt&amp;subcat=invt_vfd" class="panel-link">Variable Frequency Drives (VFD)</a></li>
                                                            <li><a href="products.php?brand=invt&amp;subcat=invt_plc" class="panel-link">Programmable Logic Controllers (PLC)</a></li>
                                                            <li><a href="products.php?brand=invt&amp;subcat=invt_hmi" class="panel-link">Human Machine Interface (HMI)</a></li>
                                                            <li><a href="products.php?brand=invt&amp;subcat=invt_servo" class="panel-link">Servo System</a></li>
                                                            <li><a href="products.php?brand=invt&amp;subcat=invt_solar" class="panel-link">Solar Drives</a></li>
                                                            <li><a href="products.php?brand=invt&amp;subcat=invt_mv_drives" class="panel-link">MV Drives</a></li>
                                                            <li><a href="products.php?brand=invt&amp;subcat=invt_motion" class="panel-link">Motion Controller</a></li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <a href="products.php?brand=multispan" class="panel-link">MULTISPAN</a>
                                                    </li>
                                                    <li>
                                                        <a href="products.php?brand=leuze" class="panel-link">LEUZE</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li><a href="programming.php">Programming</a></li>
                                            <li><a href="training.php">Training</a></li>
                                            <li><a href="careers.php">Career</a></li>
                                            <li><a href="contact.php">Contact</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-5 d-none d-xl-block text-right">
                                <img src="img/logo/delta-partner-badge.png" alt="Delta Authorized Channel Partner" class="deltabadge">
                            </div>

                            <div class="col-12">
                                <div class="mobile-menu"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </header>
    <!-- header-end -->
    <div class="offcanvas-overly"></div>
    <!-- offcanvas-end -->
