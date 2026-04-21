<?php
/* ── Booking Confirmation Page ───────────────────────── */
require_once 'db.php';
require_once 'session.php';
requireLogin();

$id = intval($_GET['id'] ?? 0);
if (!$id) {
    header('Location: my-bookings.php');
    exit;
}

$userId = currentUserId();

$stmt = $conn->prepare(
    'SELECT b.id, b.date, b.time_slot, b.status,
            p.name  AS place_name,
            s.type  AS service_type,
            s.price
       FROM bookings b
       JOIN wash_services s    ON b.service_id = s.id
       JOIN car_wash_places p  ON s.place_id   = p.id
      WHERE b.id = ? AND b.user_id = ?'
);
$stmt->bind_param('ii', $id, $userId);
$stmt->execute();
$booking = $stmt->get_result()->fetch_assoc();
$stmt->close();
$conn->close();

if (!$booking) {
    echo '<p>Booking not found.</p>';
    exit;
}

include '../html/booking-confirm.html';
