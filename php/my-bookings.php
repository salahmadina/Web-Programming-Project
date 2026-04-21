<?php
/* ── My Bookings Page ────────────────────────────────── */
require_once 'db.php';
require_once 'session.php';
requireLogin();

$userId = currentUserId();

$stmt = $conn->prepare(
    'SELECT b.id, b.date, b.time_slot, b.status, b.created_at,
            p.name  AS place_name,
            s.type  AS service_type,
            s.price
       FROM bookings b
       JOIN wash_services s   ON b.service_id = s.id
       JOIN car_wash_places p ON s.place_id   = p.id
      WHERE b.user_id = ?
      ORDER BY b.date DESC, b.time_slot DESC'
);
$stmt->bind_param('i', $userId);
$stmt->execute();
$bookings = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();
$conn->close();

$statusColor = [
    'pending'   => '#F59E0B',
    'confirmed' => '#10B981',
    'cancelled' => '#EF4444',
];

$cancelMsg = $_GET['cancelled'] ?? '';
$userName  = currentUserName();

include '../html/my-bookings.html';
