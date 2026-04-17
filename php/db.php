<?php
/* ── Database connection (Student 1) ─────────────────
   Edit DB_PASS if you set a MySQL password in XAMPP.   */

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'carwash_db');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    die('<p style="color:red;text-align:center;">
         Database connection failed: ' . $conn->connect_error . '
         </p>');
}

$conn->set_charset('utf8mb4');
?>
