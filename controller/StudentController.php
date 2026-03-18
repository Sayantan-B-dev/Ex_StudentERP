<?php
// controller/StudentController.php
require_once __DIR__ . '/../config/config.php';
$pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4", DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

$action = $_GET['action'] ?? '';
switch ($action) {
    case 'delete':
        if (($_SESSION['user_role'] ?? 'student') === 'student') {
            $_SESSION['flash'] = 'Access denied: Students cannot delete records.';
            header('Location: '.BASE_URL.'/index.php?page=student-information'); exit;
        }
        $id = (int)($_GET['id'] ?? 0);
        if ($id > 0) {
            $pdo->prepare("DELETE FROM students WHERE id=?")->execute([$id]);
            logActivity($pdo, 'Delete Student', 'Students', "Deleted student with record ID: $id");
            $_SESSION['flash'] = 'Student record deleted.';
        }
        header('Location: '.BASE_URL.'/index.php?page=student-information');
        exit;
    default:
        header('Location: '.BASE_URL.'/index.php?page=student-information');
        exit;
}
