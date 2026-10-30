<?php
require_once __DIR__ . '/inc-frontend.php';
$siteEmail = fe_setting($conn, 'site_email', 'info@dena.co.in');
$sitePhones = [];
foreach (['site_phone1', 'site_phone2', 'site_phone3'] as $phoneKey) {
    $phoneValue = trim(fe_setting($conn, $phoneKey, ''));
    if ($phoneValue !== '') {
        $sitePhones[] = $phoneValue;
    }
}
$headOfficeAddress = fe_setting($conn, 'head_office_address', 'No.116/1, II Floor, IOB Upstairs, Thanthonimalai, Karur - 639 005. Tamil Nadu, India.');
$maduraiBranchAddress = fe_setting($conn, 'branch_madurai_address', 'No.4/46-12, Dindigul NH Road, Near Manna Food Pvt Ltd, Nagari, Madurai - 625 221');
$coimbatoreBranchAddress = fe_setting($conn, 'branch_coimbatore_address', 'No.390/7, Vinayagar Garden, Malumichampatti, Coimbatore - 641 050');
$workingHoursWeekday = fe_setting($conn, 'working_hours_weekday', 'Mon - Sat: 9:00 AM - 6:30 PM');
$workingHoursSunday = fe_setting($conn, 'working_hours_sunday', 'Sunday: Closed');
$mapEmbedUrl = fe_setting($conn, 'map_embed_url', 'https://www.google.com/maps?q=No.116/1,+IOB+Upstairs,+Thanthonimalai,+Karur+639005&output=embed');
$pageTitle = 'Contact Us - Digitech Electrical & Automations';
$metaDescription = 'Get in touch with Digitech for electrical control panels and industrial automation requirements. Head office in Karur, with branches in Madurai and Coimbatore, Tamil Nadu.';
$metaKeywords = 'contact Digitech, electrical panel manufacturer contact, Karur electrical company, Madurai automation company, Coimbatore electrical panels, Digitech phone email address';
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
                                    <h2>Contact Us</h2>
                                    <div class="breadcrumb-wrap">
                                        <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                                <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
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

        <!-- contact-info-area -->
        <section class="contact-info-area p-relative pt-120 pb-60">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="contact-info-card mb-30">
                            <div class="icon"><i class="fa-light fa-phone"></i></div>
                            <h3>Call Us</h3>
                            <div class="contact-phone-list">
                                <?php foreach ($sitePhones as $sitePhone): ?>
                                <a href="tel:<?php echo clean(preg_replace('/[^0-9+]/', '', $sitePhone)); ?>" class="contact-phone-chip">
                                    <i class="fa-light fa-phone"></i>
                                    <span><?php echo clean($sitePhone); ?></span>
                                    <i class="fa-light fa-arrow-right"></i>
                                </a>
                                <?php endforeach; ?>
                            </div>
                            <p class="contact-phone-hint">Tap any number to call</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="contact-info-card mb-30">
                            <div class="icon"><i class="fa-light fa-envelope"></i></div>
                            <h3>Email Us</h3>
                            <p><a href="mailto:<?php echo clean($siteEmail); ?>"><?php echo clean($siteEmail); ?></a></p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="contact-info-card mb-30">
                            <div class="icon"><i class="fa-light fa-map-marker-check"></i></div>
                            <h3>Head Office</h3>
                            <p><?php echo clean($headOfficeAddress); ?></p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="contact-info-card mb-30">
                            <div class="icon"><i class="fa-light fa-clock"></i></div>
                            <h3>Working Hours</h3>
                            <p><?php echo clean($workingHoursWeekday); ?></p>
                            <p><?php echo clean($workingHoursSunday); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- contact-info-area-end -->

        <!-- contact-form-area -->
        <section class="contact-form-area p-relative pb-90">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-12 mb-30">
                        <div class="contact-form-wrap">
                            <div class="section-title mb-30">
                                <div class="sub-title"> <i class="fa-light fa-bolt"></i> Get In Touch <i class="fa-light fa-bolt"></i></div>
                                <h2 class="text-anime-style-3">Send Us a <span>Message</span></h2>
                            </div>
                            <form action="#" method="post" class="contact-page-form" id="contactPageForm">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-20">
                                            <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-20">
                                            <input type="tel" name="phone" class="form-control" placeholder="Phone Number" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-20">
                                            <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-20">
                                            <input type="text" name="subject" class="form-control" placeholder="Subject">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-20">
                                            <textarea name="message" class="form-control" rows="5" placeholder="Your Message" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div id="contactFormStatus" class="mb-20" style="display:none;"></div>
                                        <button type="submit" class="btn">Send Message <i class="fa-light fa-bolt"></i></button>
                                    </div>
                                </div>
                            </form>
                            <script>
                                (function () {
                                    var contactForm = document.getElementById('contactPageForm');
                                    if (!contactForm) return;
                                    var statusBox = document.getElementById('contactFormStatus');
                                    contactForm.addEventListener('submit', function (e) {
                                        e.preventDefault();
                                        if (!contactForm.checkValidity()) {
                                            contactForm.reportValidity();
                                            return;
                                        }

                                        var submitBtn = contactForm.querySelector('button[type="submit"]');
                                        var originalBtnHtml = submitBtn ? submitBtn.innerHTML : '';
                                        if (submitBtn) {
                                            submitBtn.disabled = true;
                                            submitBtn.innerHTML = 'Sending...';
                                        }

                                        var formData = new FormData(contactForm);
                                        formData.append('source', 'contact_form');

                                        fetch('process-enquiry.php', {
                                            method: 'POST',
                                            body: formData
                                        })
                                            .then(function (response) { return response.json(); })
                                            .then(function (data) {
                                                if (statusBox) {
                                                    statusBox.style.display = 'block';
                                                    statusBox.className = data.success ? 'mb-20 text-success' : 'mb-20 text-danger';
                                                    statusBox.textContent = data.message || (data.success ? 'Thank you! Your enquiry has been received.' : 'Something went wrong. Please try again.');
                                                }
                                                if (data.success) {
                                                    if (data.whatsapp_url) {
                                                        window.open(data.whatsapp_url, '_blank');
                                                    }
                                                    contactForm.reset();
                                                }
                                            })
                                            .catch(function () {
                                                if (statusBox) {
                                                    statusBox.style.display = 'block';
                                                    statusBox.className = 'mb-20 text-danger';
                                                    statusBox.textContent = 'Something went wrong. Please try again.';
                                                }
                                            })
                                            .finally(function () {
                                                if (submitBtn) {
                                                    submitBtn.disabled = false;
                                                    submitBtn.innerHTML = originalBtnHtml;
                                                }
                                            });
                                    });
                                })();
                            </script>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 mb-30">
                        <div class="contact-map-wrap">
                            <iframe src="<?php echo clean($mapEmbedUrl); ?>" width="100%" height="280" style="border:0; border-radius: 10px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Digitech Head Office Map"></iframe>
                            <div class="office-list mt-20">
                                <div class="office-item">
                                    <h4><i class="fa-light fa-location-dot"></i> Head Office - Karur</h4>
                                    <p><?php echo clean($headOfficeAddress); ?></p>
                                </div>
                                <?php if ($maduraiBranchAddress !== ''): ?>
                                <div class="office-item">
                                    <h4><i class="fa-light fa-location-dot"></i> Branch - Madurai</h4>
                                    <p><?php echo clean($maduraiBranchAddress); ?></p>
                                </div>
                                <?php endif; ?>
                                <?php if ($coimbatoreBranchAddress !== ''): ?>
                                <div class="office-item">
                                    <h4><i class="fa-light fa-location-dot"></i> Branch - Coimbatore</h4>
                                    <p><?php echo clean($coimbatoreBranchAddress); ?></p>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- contact-form-area-end -->

    </main>
    <!-- main-area-end -->
    <!-- footer -->
<?php include('footer.php'); ?>
