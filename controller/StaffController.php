<?php
// controller/StaffController.php
require_once __DIR__ . '/../config/config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: '.BASE_URL.'/login.php');
    exit;
}

$pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4", DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
$action = $_GET['action'] ?? '';

if ($action === 'add_activity') {
    $stmt = $pdo->prepare("INSERT INTO staff_activities (staff_id, activity_title, activity_description, activity_date, category, status, created_by) VALUES (?,?,?,?,?,?,?)");
    $stmt->execute([
        $_POST['staff_id'],
        $_POST['activity_title'],
        $_POST['activity_description'],
        $_POST['activity_date'],
        $_POST['category'],
        $_POST['status'],
        $_SESSION['user_id']
    ]);
    $_SESSION['flash'] = 'Activity recorded successfully.';
    header('Location: '.BASE_URL.'/index.php?page=staff-view&id='.$_POST['staff_id']);
    exit;
}

if ($action === 'add_salary') {
    $stmt = $pdo->prepare("INSERT INTO staff_salaries (staff_id, amount_paid, bonus, deductions, month_year, payment_date, payment_method, receipt_no, remarks, created_by) VALUES (?,?,?,?,?,?,?,?,?,?)");
    $stmt->execute([
        $_POST['staff_id'],
        $_POST['amount_paid'],
        $_POST['bonus'] ?? 0,
        $_POST['deductions'] ?? 0,
        $_POST['month_year'],
        $_POST['payment_date'],
        $_POST['payment_method'],
        $_POST['receipt_no'],
        $_POST['remarks'],
        $_SESSION['user_id']
    ]);
    $_SESSION['flash'] = 'Salary payment recorded successfully.';
    header('Location: '.BASE_URL.'/index.php?page=staff-view&id='.$_POST['staff_id']);
    exit;
}

header('Location: '.BASE_URL.'/index.php?page=faculty');
exit;
