<?php
/* ── User Profile Page ─────────────────────────────── */
require_once 'db.php';
require_once 'session.php';
requireLogin();

$userId = currentUserId();

/* Fetch user info */
$stmt = $conn->prepare('SELECT name, email, created_at FROM users WHERE id = ?');
$stmt->bind_param('i', $userId);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
$stmt->close();

/* Count bookings */
$stmt2 = $conn->prepare(
    'SELECT
       COUNT(*) AS total,
       SUM(status="pending")   AS pending,
       SUM(status="confirmed") AS confirmed,
       SUM(status="cancelled") AS cancelled
     FROM bookings WHERE user_id = ?'
);
$stmt2->bind_param('i', $userId);
$stmt2->execute();
$stats = $stmt2->get_result()->fetch_assoc();
$stmt2->close();
$conn->close();

$success = $_GET['success'] ?? '';

include '../html/profile.html';
