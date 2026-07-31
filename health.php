<?php
// health.php — deployment diagnostic (delete after fixing)
header('Content-Type: text/plain');
error_reporting(E_ALL);
ini_set('display_errors', '1');

echo "PHP: " . PHP_VERSION . "\n";
echo "SCRIPT_DIR: " . __DIR__ . "\n";
echo "Env file expected at: " . __DIR__ . '/.env' . "\n";
echo "Env file exists: " . (file_exists(__DIR__ . '/.env') ? 'YES' : 'NO') . "\n";
echo "putenv allowed: " . (function_exists('putenv') ? 'yes' : 'no') . "\n\n";

require __DIR__ . '/config/config.php';

$mask = function ($v) { return $v === '' || $v === null ? '(EMPTY/null)' : substr($v, 0, 3) . '***'; };

echo "DB_HOST = " . var_export(DB_HOST, true) . "\n";
echo "DB_USER = " . var_export(DB_USER, true) . "\n";
echo "DB_PASS = " . (DB_PASS === '' || DB_PASS === null ? '(EMPTY/null)' : '(SET, len ' . strlen(DB_PASS) . ')') . "\n";
echo "DB_NAME = " . var_export(DB_NAME, true) . "\n";
echo "BASE_URL = " . var_export(BASE_URL, true) . "\n";
echo "MASTER_EMAIL = " . var_export(env('MASTER_EMAIL'), true) . "\n\n";

echo "--- DB connection test ---\n";
try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4", DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    echo "DB CONNECT: OK\n";
    echo "Tables: " . implode(', ', $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN)) . "\n";
} catch (Throwable $e) {
    echo "DB CONNECT: FAILED\n";
    echo "Error: " . $e->getMessage() . "\n";
}
