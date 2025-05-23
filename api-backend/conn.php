<?php
// Database connection settings
define('DB_HOST', 'localhost'); // Database host
define('DB_USER', 'root'); // Database user
define('DB_PASS', ''); // Database password
define('DB_NAME', 'db_backend'); // Database name

try {
    // Create connection
    $conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    // Handle connection error
    echo "Connection failed: " . $e->getMessage();
    exit;
}

