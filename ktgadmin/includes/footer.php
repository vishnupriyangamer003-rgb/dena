<?php
if (!defined('KTGADMIN')) {
    http_response_code(403);
    exit('Direct access not permitted');
}
?>
    </main>
    </div>
</div>
<script src="<?php echo SITE_URL; ?>/js/vendor/jquery-3.6.0.min.js"></script>
<script src="<?php echo SITE_URL; ?>/js/popper.min.js"></script>
<script src="<?php echo SITE_URL; ?>/js/bootstrap.min.js"></script>
<script>window.csrfToken = '<?php echo csrf_token(); ?>';</script>
<script src="<?php echo ADMIN_URL; ?>/js/admin.js"></script>
</body>
</html>
