<?php
// ============================================
// Database Connection File
// ============================================
// This file establishes a connection to MySQL
// using mysqli. Include this file in any page
// that needs database access.
// ============================================

$host = "localhost";      // Database host
$username = "root";       // Default XAMPP/WAMP username
$password = "";           // Default XAMPP/WAMP password (empty)
$database = "local_job_finder"; // Our database name

// Create connection using mysqli
$conn = mysqli_connect($host, $username, $password, $database);

// Check if connection was successful
if (!$conn) {
    // If connection fails, show error and stop
    die("Connection failed: " . mysqli_connect_error());
}

// Set character encoding to UTF-8
mysqli_set_charset($conn, "utf8mb4");
?>
