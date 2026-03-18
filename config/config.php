<?php
// config/config.php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'college_db');

// Base URL (adjust if needed)
define('BASE_URL', 'http://localhost/studentErpFin');

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

/**
 * Log activity to the audit_logs table
 */
function logActivity($pdo, string $action, string $module = '', string $details = '') {
    $uid = $_SESSION['user_id'] ?? null;
    $ip  = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    try {
        $stmt = $pdo->prepare("INSERT INTO audit_logs (user_id, action, module, details, ip_address) VALUES (?,?,?,?,?)");
        $stmt->execute([$uid, $action, $module, $details, $ip]);
    } catch (Exception $e) { /* ignore log errors */ }
}
?>