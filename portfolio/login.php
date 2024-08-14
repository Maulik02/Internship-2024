<?php
session_start();
$pageTitle = "Login";
require_once 'config/funtion.php';

if (isset($_SESSION['auth'])) {
    redirect('index.php', 'You are already logged in');
}

include 'includes/header.php';
?>

<div class="py-4 bg-secondary text-center">
    <h4 class="text-white">Login</h4>
</div>

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h4>Login</h4>
                    </div>
                    <div class="card-body">
                        <?= alertMessage() ?>
                        <form action="login-code.php" method="post">
                            <div class="mb-3">
                                <label for="username" class="form-label">Email Address</label>
                                <input type="text" class="form-control" id="username" name="email">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <button type="submit" class="btn btn-primary" style="width:100%;" name="loginBtn">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

