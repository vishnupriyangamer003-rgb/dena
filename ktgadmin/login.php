<?php
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';

if (is_logged_in()) {
    header('Location: ' . ADMIN_URL . '/dashboard.php');
    exit;
}

function is_logged_in()
{
    return !empty($_SESSION['admin_id']);
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_verify($_POST['csrf_token'] ?? '')) {
        $error = 'Session expired. Please try again.';
    } else {
        $username = trim($_POST['username'] ?? '');
        $password = (string) ($_POST['password'] ?? '');

        if ($username === '' || $password === '') {
            $error = 'Please enter both username and password.';
        } else {
            $stmt = mysqli_prepare($conn, 'SELECT id, username, password FROM tbl_admin WHERE username = ? LIMIT 1');
            mysqli_stmt_bind_param($stmt, 's', $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $admin = mysqli_fetch_assoc($result);
            mysqli_stmt_close($stmt);

            if ($admin && password_verify($password, $admin['password'])) {
                session_regenerate_id(true);
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['admin_username'] = $admin['username'];
                header('Location: ' . ADMIN_URL . '/dashboard.php');
                exit;
            } else {
                $error = 'Invalid username or password.';
            }
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login - DENA</title>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo SITE_URL; ?>/img/logo/dena-favicon.png">
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>/fontawesome-pro/css/all.min.css">
    <link rel="stylesheet" href="<?php echo ADMIN_URL; ?>/css/admin.css">
</head>
<body>
<div class="login-page">
    <div class="login-card">
        <div class="logo">
            <img src="<?php echo SITE_URL; ?>/img/logo/dena-logo-png.png" alt="DENA">
        </div>
        <h2>Admin Login</h2>
        <?php if ($error): ?>
        <div class="alert alert-danger"><?php echo clean($error); ?></div>
        <?php endif; ?>
        <form method="post" action="">
            <?php echo csrf_field(); ?>
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" required autofocus value="<?php echo isset($_POST['username']) ? clean($_POST['username']) : ''; ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-admin-primary w-100">Login <i class="fa-light fa-arrow-right-to-bracket"></i></button>
        </form>
    </div>
</div>
</body>
</html>
