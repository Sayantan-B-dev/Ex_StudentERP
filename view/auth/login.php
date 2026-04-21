<?php
// view/auth/login.php
require_once '../../config/config.php';

// If already logged in, redirect to dashboard
if (isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_URL . '/index.php?page=dashboard');
    exit;
}

// Handle login form submission (dummy for now)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once '../../controller/AuthController.php';
    $auth = new AuthController();
    $auth->login($_POST['email'], $_POST['password']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="icon" href="assets/images/favicon.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/custom.css">
</head>
<body class="bg-light-grey d-flex align-items-center" style="min-height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow-lg border-0 rounded-4 p-4" style="background-color: #f5f5dc;"> <!-- Beige -->
                    <h2 class="text-center mb-4" style="color: #4a3c31;">Admin Login</h2>
                    <form method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label" style="color: #5c4e3d;">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" required style="border-color: #b8a99a;">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label" style="color: #5c4e3d;">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required style="border-color: #b8a99a;">
                        </div>
                        <button type="submit" class="btn w-100 py-2 fw-bold" style="background-color: #800000; color: white;">Login</button>
                    </form>
                    <div class="text-center mt-3">
                        <a href="../../index.php" style="color: #4a7c59;">Back to Home</a> <!-- Olive Green -->
                    </div>
                    <div class="text-center mt-3">
                        <a href="#" class="text-decoration-none" style="color: #4a7c59;">Forgot Password?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>