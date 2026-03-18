<?php
// controller/AuthController.php
require_once __DIR__ . '/../config/config.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($action === 'logout') {
    $pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4", DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    logActivity($pdo, 'User Logout', 'Auth');
    session_unset();
    session_destroy();
    header('Location: ' . BASE_URL . '/index.php');
    exit;
}

if ($action === 'login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4", DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email=? AND status='active' LIMIT 1");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id']   = $user['id'];
        $_SESSION['user_name'] = $user['name'] ?? $user['full_name'];
        $_SESSION['user_role'] = $user['role'];
        $_SESSION['user_email'] = $user['email'];
        
        logActivity($pdo, 'User Login', 'Auth', 'User logged in via email: '.$email);

        // Find link to professional/student ID
        if ($user['role'] === 'student') {
            $s = $pdo->prepare("SELECT id, admission_number FROM students WHERE user_id=? OR email=? LIMIT 1");
            $s->execute([$user['id'], $user['email']]);
            $stu = $s->fetch();
            $_SESSION['student_id'] = $stu['id'] ?? null;
            $_SESSION['admission_no'] = $stu['admission_number'] ?? null;
        } elseif ($user['role'] === 'faculty') {
            $f = $pdo->prepare("SELECT id, staff_id FROM staff WHERE user_id=? OR email=? LIMIT 1");
            $f->execute([$user['id'], $user['email']]);
            $fac = $f->fetch();
            $_SESSION['staff_db_id'] = $fac['id'] ?? null;
            $_SESSION['staff_id'] = $fac['staff_id'] ?? null;
        }

        header('Location: ' . BASE_URL . '/index.php?page=dashboard');
        exit;
    } else {
        $_SESSION['login_error'] = 'Invalid email or password.';
        header('Location: ' . BASE_URL . '/index.php');
        exit;
    }
}

if ($action === 'register' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4", DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $role = $_POST['role'];
    $pass = $_POST['password'];
    $conf = $_POST['confirm_password'];

    if ($pass !== $conf) {
        $_SESSION['reg_error'] = "Passwords do not match.";
        header('Location: '.BASE_URL.'/view/auth/register.php'); exit;
    }

    $c = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email=?");
    $c->execute([$email]);
    if ($c->fetchColumn() > 0) {
        $_SESSION['reg_error'] = "Email already registered.";
        header('Location: '.BASE_URL.'/view/auth/register.php'); exit;
    }

    $hashed = password_hash($pass, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO users (name, email, password, role, status) VALUES (?,?,?,?,?)");
    $stmt->execute([$name, $email, $hashed, $role, 'active']);
    $user_id = $pdo->lastInsertId();

    logActivity($pdo, 'User Registration', 'Auth', "New $role registered: $email");

    // Create shell profile for faculty
    if ($role === 'faculty') {
        $staff_id = 'TCH'.date('Y').str_pad(mt_rand(100, 999), 3, '0', STR_PAD_LEFT);
        $pdo->prepare("INSERT INTO staff (user_id, staff_id, first_name, last_name, category_id, designation_id, email, phone, status) VALUES (?,?,?,?,?,?,?,?,?)")
            ->execute([$user_id, $staff_id, $name, '', 1, 1, $email, $phone, 'active']);
    }

    $_SESSION['flash'] = "Account created. Please login.";
    header('Location: '.BASE_URL.'/index.php'); exit;
}

header('Location: ' . BASE_URL . '/index.php');
exit;