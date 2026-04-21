<?php
/* ── Search Results Page ────────────────────────────── */
require_once 'db.php';
require_once 'session.php';
requireLogin();

$q = trim($_GET['q'] ?? '');

$washes = [];
if ($q) {
    $like = "%$q%";
    $stmt = $conn->prepare(
        'SELECT id, name, description, type, price
           FROM car_washes
          WHERE name LIKE ? OR description LIKE ? OR type LIKE ?
          ORDER BY price ASC'
    );
    $stmt->bind_param('sss', $like, $like, $like);
    $stmt->execute();
    $washes = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
}
$conn->close();

$badge = ['Basic' => '#10B981', 'Premium' => '#2563EB', 'Full Service' => '#7C3AED'];

include '../html/search.html';
