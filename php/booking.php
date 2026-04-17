<?php
/* ── Handle Booking Form Submission ─────────────────── */
require_once 'db.php';
require_once 'session.php';
requireLogin();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../html/booking.html');
    exit;
}

$userId    = currentUserId();
$serviceId = intval($_POST['service_id'] ?? 0);
$date      = trim($_POST['date']         ?? '');
$timeSlot  = trim($_POST['time_slot']    ?? '');

/* ── Validation ── */
$errors = [];

if (!$serviceId) $errors[] = 'Invalid service selection.';
if (!$date)      $errors[] = 'Please select a date.';
if (!$timeSlot)  $errors[] = 'Please select a time slot.';

/* Date must be today or tomorrow */
if ($date) {
    $today    = date('Y-m-d');
    $tomorrow = date('Y-m-d', strtotime('+1 day'));
    if ($date !== $today && $date !== $tomorrow) {
        $errors[] = 'Date must be today or tomorrow.';
    }
}

/* Verify service exists */
if ($serviceId) {
    $check = $conn->prepare('SELECT id FROM wash_services WHERE id = ?');
    $check->bind_param('i', $serviceId);
    $check->execute();
    $check->store_result();
    if ($check->num_rows === 0) $errors[] = 'Service not found.';
    $check->close();
}

if ($errors) {
    $msg = urlencode(implode(' | ', $errors));
    header("Location: ../html/booking.html?service_id=$serviceId&error=$msg");
    exit;
}

/* ── One active booking per user ── */
$active = $conn->prepare(
    'SELECT id FROM bookings WHERE user_id = ? AND status != "cancelled"'
);
$active->bind_param('i', $userId);
$active->execute();
$active->store_result();
$hasActive = $active->num_rows > 0;
$active->close();

if ($hasActive) {
    $msg = urlencode('You already have an active booking. Please cancel it first before making a new one.');
    header("Location: ../html/booking.html?service_id=$serviceId&error=$msg");
    exit;
}

/* ── Check for duplicate slot at this service ── */
$dup = $conn->prepare(
    'SELECT id FROM bookings
      WHERE service_id = ? AND date = ? AND time_slot = ? AND status != "cancelled"'
);
$dup->bind_param('iss', $serviceId, $date, $timeSlot);
$dup->execute();
$dup->store_result();
if ($dup->num_rows > 0) {
    $msg = urlencode('That time slot is already taken. Please choose another.');
    header("Location: ../html/booking.html?service_id=$serviceId&error=$msg");
    exit;
}
$dup->close();

/* ── Insert booking ── */
$stmt = $conn->prepare(
    'INSERT INTO bookings (user_id, service_id, date, time_slot) VALUES (?, ?, ?, ?)'
);
$stmt->bind_param('iiss', $userId, $serviceId, $date, $timeSlot);

if ($stmt->execute()) {
    $bookingId = $stmt->insert_id;
    $stmt->close();
    $conn->close();
    header('Location: booking-confirm.php?id=' . $bookingId);
} else {
    $stmt->close();
    $conn->close();
    header('Location: ../html/booking.html?service_id=' . $serviceId .
           '&error=' . urlencode('Booking failed. Please try again.'));
}
exit;
?>
