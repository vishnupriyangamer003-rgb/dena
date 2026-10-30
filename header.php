<?php
require_once __DIR__ . '/inc-frontend.php';

if (!isset($pageTitle)) {
    $pageTitle = 'Digitech Electrical & Automations (DENA) - Electrical, Control Panel & Industrial Automation Solutions';
}
if (!isset($metaDescription)) {
    $metaDescription = 'DENA (Digitech Electrical & Automations) delivers reliable electrical, control panel and industrial automation solutions - PLC, HMI, SCADA, drives and panel manufacturing for modern industries.';
}
if (!isset($metaKeywords)) {
    $metaKeywords = 'electrical control panels, industrial automation, PLC programming, SCADA, HMI, VFD drives, panel manufacturing, DENA, Digitech Electrical Automations, Karur';
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
                                            <!-- <li class="has-sub">
                                                <a href="services.html">Solutions</a>
                                                <ul>
                                                    <li><a href="services.html#control-panels">Control Panels</a></li>
                                                    <li><a href="services.html#automation">Industrial Automation</a></li>
                                                    <li><a href="services.html#products">Industrial Products</a></li>
                                                    <li><a href="services.html#programming">Programming</a></li>
                                                </ul>
                                            </li> -->
                                            <li class="has-sub">
                                                <a href="panels.php">Panels</a>
                                                <ul>
                                                    <li><a href="panels.php" class="panel-link">All Panels</a></li>
                                                    <?php foreach (fe_active_rows($conn, 'tbl_panels') as $navPanel): ?>
                                                    <li><a href="panel-detail.php?panel=<?php echo urlencode($navPanel['slug']); ?>" class="panel-link"><?php echo clean($navPanel['title']); ?></a></li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </li>
                                            <li class="has-sub">
                                                <a href="products.php">Products</a>
                                                <ul>
                                                    <li><a href="products.php" class="panel-link">All Products</a></li>
                                                    <?php foreach (fe_active_rows($conn, 'tbl_products') as $navProduct): ?>
                                                    <li><a href="product-detail.php?product=<?php echo urlencode($navProduct['slug']); ?>" class="panel-link"><?php echo clean($navProduct['title']); ?></a></li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </li>
                                            <li><a href="programming.php">Programming</a></li>
                                            <li><a href="training.php">Training</a></li>
                                            <li><a href="careers.php">Career</a></li>
                                            <li><a href="contact.php" class="desktophide">Contact</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-5 d-none d-xl-block text-right">
                                <a href="contact.php" class="btn mr-15" style="padding: 10px 25px;">Contact <i class="fa-light fa-bolt"></i></a>
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
    <!-- offcanvas-area -->
    <!-- <div class="offcanvas-menu">
        <span class="menu-close"><i class="fas fa-times"></i></span>
        <form role="search" method="get" id="searchform" class="searchform" action="#">
            <input type="text" name="s" id="search" placeholder="Search" />
            <button><i class="fa fa-search"></i></button>
        </form>
        <div id="cssmenu2" class="menu-one-page-menu-container">
            <ul id="menu-one-page-menu-12" class="menu">
                <li class="menu-item menu-item-type-custom menu-item-object-custom"><a href="tel:+919787774321"><span>+91 97877 74321</span></a></li>
                <li class="menu-item menu-item-type-custom menu-item-object-custom"><a href="mailto:sales.dea@outlook.com"><span>sales.dea@outlook.com</span></a></li>
            </ul>
        </div>
    </div> -->
    <div class="offcanvas-overly"></div>
    <!-- offcanvas-end -->