    <footer class="footer-bg footer-p mb-0">
        <div class="footer-top pt-40" style="background-image: url(img/bg/footer-bg.png); background-repeat: no-repeat; background-size: cover;">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="footer-widget mb-10">
                            <div class="f-widget-title mb-30">
                                <img src="img/logo/dena-logo-png.png" alt="Digitech Electrical & Automations" class="headerlogo">
                            </div>
                            <p class="pr-90">Digitech Electrical & Automations (DENA) delivers reliable electrical, control panel and industrial automation solutions for modern industries.</p>
                            <div class="footer-social mt-30">
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                                <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-sm-6">
                        <div class="footer-widget mb-10">
                            <div class="f-widget-title">
                                <h2>Quick Links</h2>
                            </div>
                            <div class="footer-link">
                                <ul>
                                    <li><a href="index.php">Home</a></li>
                                    <li><a href="about.php">About Us</a></li>
                                    <li><a href="panels.php">Panels</a></li>
                                    <li><a href="products.php">Products</a></li>
                                    <li><a href="programming.php">Programming</a></li>
                                    <li><a href="training.php">Training</a></li>
                                    <li><a href="careers.php">Careers</a></li>
                                    <li><a href="contact.php">Contact Us</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-sm-6">
                        <div class="footer-widget mb-10">
                            <div class="f-widget-title">
                                <h2>Panels</h2>
                            </div>
                            <div class="footer-link">
                                <ul>
                                    <?php foreach (fe_active_rows($conn, 'tbl_panels') as $footerPanel): ?>
                                    <li><a href="panel-detail.php?panel=<?php echo urlencode($footerPanel['slug']); ?>"><?php echo htmlspecialchars($footerPanel['title']); ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-sm-6">
                        <div class="footer-widget mb-10">
                            <div class="f-widget-title">
                                <h2>Products</h2>
                            </div>
                            <div class="footer-link">
                                <ul>
                                    <?php foreach (fe_active_rows($conn, 'tbl_products') as $footerProduct): ?>
                                    <li><a href="product-detail.php?product=<?php echo urlencode($footerProduct['slug']); ?>"><?php echo htmlspecialchars($footerProduct['title']); ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-sm-6">
                        <div class="footer-widget mb-10">
                            <div class="f-widget-title">
                                <h2>Programming</h2>
                            </div>
                            <div class="footer-link">
                                <ul>
                                    <?php foreach (fe_active_rows($conn, 'tbl_programming') as $footerProgram): ?>
                                    <li><a href="programming.php#<?php echo urlencode($footerProgram['slug']); ?>"><?php echo htmlspecialchars($footerProgram['title']); ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="copyright-wrap">
                <div class="container">
                    <div class="row align-items-center text-center">
                        <div class="col-lg-6 col-md-12">
                            Copyright &copy; <?php echo date('Y'); ?> <a href="index.php">Digitech Electrical & Automations.</a> All rights reserved.
                        </div>
                        <div class="col-lg-6 col-md-12">
                            Designed by : <a href="http://knocktheglobe.com/" target="_blank" rel="noopener">KTG</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer-end -->

    <?php $whatsappNumber = fe_setting($conn, 'whatsapp_number', '919787774321'); ?>
    <!-- whatsapp-float -->
    <a href="https://wa.me/<?php echo htmlspecialchars($whatsappNumber); ?>?text=Hello%20DENA%2C%20I%20would%20like%20to%20know%20more%20about%20your%20products." target="_blank" rel="noopener" class="whatsapp-float" aria-label="Chat on WhatsApp">
        <span class="whatsapp-ping"></span>
        <i class="fab fa-whatsapp"></i>
        <span class="whatsapp-tooltip">Chat with us</span>
    </a>
    <!-- whatsapp-float-end -->

    <!-- enquire-float -->
    <button type="button" class="enquire-float" data-bs-toggle="modal" data-bs-target="#enquireModal">
        Enquire Now
    </button>
    <!-- enquire-float-end -->

    <!-- enquire-modal -->
    <div class="modal fade" id="enquireModal" tabindex="-1" aria-labelledby="enquireModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content enquire-modal-content">
                <button type="button" class="btn-close enquire-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="enquire-modal-header">
                    <div class="enquire-modal-icon"><i class="fa-light fa-bolt"></i></div>
                    <h5 class="modal-title" id="enquireModalLabel">Let's Build Your Solution</h5>
                    <p>Share your requirement — we'll get back to you shortly on WhatsApp.</p>
                </div>
                <div class="modal-body">
                    <form action="#" method="post" class="enquire-form" id="enquireForm">
                        <div class="row gx-3">
                            <div class="col-sm-6">
                                <div class="form-field mb-15">
                                    <i class="fa-light fa-user"></i>
                                    <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-field mb-15">
                                    <i class="fa-light fa-phone"></i>
                                    <input type="tel" name="phone" class="form-control" placeholder="Phone Number" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-field mb-15">
                            <i class="fa-light fa-envelope"></i>
                            <input type="email" name="email" class="form-control" placeholder="Email Address">
                        </div>
                        <div class="form-field mb-15">
                            <i class="fa-light fa-list-check"></i>
                            <select name="interest" class="form-control" required>
                                <option value="" selected disabled>I'm interested in...</option>
                                <option value="Control Panels">Control Panels</option>
                                <option value="Industrial Automation">Industrial Automation</option>
                                <option value="Industrial Products">Industrial Products</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="form-field mb-20 align-textarea">
                            <i class="fa-light fa-message-lines"></i>
                            <textarea name="message" class="form-control" rows="2" placeholder="Your Requirement"></textarea>
                        </div>
                        <button type="submit" class="btn w-100 enquire-submit-btn"><i class="fab fa-whatsapp"></i> Send via WhatsApp</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- enquire-modal-end -->

    <!-- JS here -->
    <script src="js/vendor/modernizr-3.5.0.min.js"></script>
    <script src="js/vendor/jquery-3.6.0.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/js_isotope.pkgd.min.js"></script>
    <script src="js/imagesloaded.min.js"></script>
    <script src="js/parallax.min.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.counterup.min.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
    <script src="js/swiper.min.js"></script>
    <script src="js/jquery.meanmenu.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <!--gsap js file -->
    <script src="js/gsap.min.js"></script>
    <!-- Text Effect js file -->
    <script src="js/SplitText.js"></script>
    <script src="js/ScrollTrigger.min.js"></script>
    <script src="js/main.js"></script>
    <script>
        (function () {
            var enquireForm = document.getElementById('enquireForm');
            if (!enquireForm) return;
            enquireForm.addEventListener('submit', function (e) {
                e.preventDefault();
                if (!enquireForm.checkValidity()) {
                    enquireForm.reportValidity();
                    return;
                }

                var submitBtn = enquireForm.querySelector('.enquire-submit-btn');
                var originalBtnHtml = submitBtn ? submitBtn.innerHTML : '';
                if (submitBtn) {
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = 'Sending...';
                }

                var name = enquireForm.querySelector('[name="name"]').value.trim();
                var phone = enquireForm.querySelector('[name="phone"]').value.trim();
                var email = enquireForm.querySelector('[name="email"]').value.trim();
                var interest = enquireForm.querySelector('[name="interest"]').value.trim();
                var message = enquireForm.querySelector('[name="message"]').value.trim();

                var formData = new FormData();
                formData.append('name', name);
                formData.append('phone', phone);
                formData.append('email', email);
                formData.append('subject', interest);
                formData.append('message', message);
                formData.append('source', 'enquire_modal');

                fetch('process-enquiry.php', {
                    method: 'POST',
                    body: formData
                })
                    .then(function (response) { return response.json(); })
                    .then(function (data) {
                        if (data.success) {
                            if (data.whatsapp_url) {
                                window.open(data.whatsapp_url, '_blank');
                            }
                            enquireForm.reset();
                            var modalEl = document.getElementById('enquireModal');
                            var modalInstance = bootstrap.Modal.getInstance(modalEl);
                            if (modalInstance) modalInstance.hide();
                        } else {
                            alert(data.message || 'Something went wrong. Please try again.');
                        }
                    })
                    .catch(function () {
                        alert('Something went wrong. Please try again.');
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
</body>

</html>
