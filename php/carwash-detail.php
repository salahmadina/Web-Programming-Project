<?php
/* ── Car Wash Detail Page ───────────────────────────── */
require_once 'db.php';
require_once 'session.php';
requireLogin();

$id = intval($_GET['id'] ?? 0);
if (!$id) {
    header('Location: carwashes.php');
    exit;
}

$stmt = $conn->prepare('SELECT * FROM car_washes WHERE id = ?');
$stmt->bind_param('i', $id);
$stmt->execute();
$wash = $stmt->get_result()->fetch_assoc();
$stmt->close();
$conn->close();

if (!$wash) {
    echo '<p>Car wash not found.</p>';
    exit;
}

$badge = ['Basic' => '#10B981', 'Premium' => '#2563EB', 'Full Service' => '#7C3AED'];

include '../html/carwash-detail.html';
