<?php
/* ── Cancel a Booking (Student 3) ───────────────────── */
require_once 'db.php';
require_once 'session.php';
requireLogin();

$id     = intval($_GET['id'] ?? 0);
$userId = currentUserId();

if (!$id) {
    header('Location: my-bookings.php');
    exit;
}

/* Only cancel own pending bookings */
$stmt = $conn->prepare(
    'UPDATE bookings SET status = "cancelled"
      WHERE id = ? AND user_id = ? AND status = "pending"'
);
$stmt->bind_param('ii', $id, $userId);
$stmt->execute();
$affected = $stmt->affected_rows;
$stmt->close();
$conn->close();

if ($affected > 0) {
    header('Location: my-bookings.php?cancelled=' . $id);
} else {
    header('Location: my-bookings.php?error=' . urlencode('Could not cancel that booking.'));
}
exit;
?>
