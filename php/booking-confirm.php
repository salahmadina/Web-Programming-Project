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
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Booking Confirmed — SparkleWash</title>
  <link rel="stylesheet" href="../css/booking-confirm.css">
</head>
<body>

  <nav class="navbar">
    <div class="nav-brand">&#128663;&#128166; SparkleWash</div>
    <ul class="nav-links">
      <li><a href="index.php">Home</a></li>
      <li><a href="about.php">About</a></li>
      <li><a href="contact.php">Contact</a></li>
      <li><a href="carwashes.php">Car Washes</a></li>
      <li><a href="my-bookings.php" class="active">My Bookings</a></li>
      <li><a href="profile.php">Profile</a></li>
      <li><a href="logout.php" class="btn-logout">Logout</a></li>
    </ul>
  </nav>

  <main class="container">
    <div class="confirm-card">
      <div class="confirm-icon">&#10003;</div>
      <h1>Booking Confirmed!</h1>
      <p class="confirm-sub">Your car wash is scheduled. See you soon!</p>

      <div class="confirm-details">
        <div class="detail-row">
          <span class="label">Booking ID</span>
          <span class="value">#<?= $booking['id'] ?></span>
        </div>
        <div class="detail-row">
          <span class="label">Place</span>
          <span class="value"><?= htmlspecialchars($booking['place_name']) ?></span>
        </div>
        <div class="detail-row">
          <span class="label">Service</span>
          <span class="value"><?= htmlspecialchars($booking['service_type']) ?></span>
        </div>
        <div class="detail-row">
          <span class="label">Date</span>
          <span class="value"><?= date('F j, Y', strtotime($booking['date'])) ?></span>
        </div>
        <div class="detail-row">
          <span class="label">Time</span>
          <span class="value"><?= date('g:i A', strtotime($booking['time_slot'])) ?></span>
        </div>
        <div class="detail-row">
          <span class="label">Price</span>
          <span class="value price">$<?= number_format($booking['price'], 2) ?></span>
        </div>
        <div class="detail-row">
          <span class="label">Status</span>
          <span class="value status-badge"><?= ucfirst($booking['status']) ?></span>
        </div>
      </div>

      <div class="notice-box">
        &#9888; Please arrive on time. Bookings are cancelled if you do not arrive
        within <strong>10 minutes</strong> of your scheduled time.
      </div>

      <div class="confirm-actions">
        <a href="my-bookings.php" class="btn-primary">View All Bookings</a>
        <a href="carwashes.php"   class="btn-secondary">Back to Places</a>
      </div>
    </div>
  </main>

  <footer class="footer">
    <p>&copy; 2026 SparkleWash. All rights reserved.</p>
  </footer>

</body>
</html>
