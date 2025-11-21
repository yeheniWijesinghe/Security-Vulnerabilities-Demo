<?php
$db_host = '127.0.0.1';
$db_name = 'security_demo';
$db_user = 'root';
$db_pass = ''; 
$dsn = "mysql:host=$db_host;dbname=$db_name;charset=utf8mb4";

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $db_user, $db_pass, $options);
} catch (PDOException $e) {
    // In production, don't leak details.
    echo "DB connection failed: " . htmlspecialchars($e->getMessage());
    exit;
}
