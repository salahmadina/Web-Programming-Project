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
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Bookings — SparkleWash</title>
  <link rel="stylesheet" href="../css/my-bookings.css">
</head>
<body>

  <nav class="navbar">
    <div class="nav-brand">&#9992; SparkleWash</div>
    <ul class="nav-links">
      <li><a href="carwashes.php">Home</a></li>
      <li><a href="my-bookings.php" class="active">My Bookings</a></li>
      <li><a href="logout.php" class="btn-logout">Logout</a></li>
    </ul>
  </nav>

  <main class="container">
    <div class="page-header">
      <h1>My Bookings</h1>
      <p>Hello, <?= htmlspecialchars($userName) ?>! Here are your reservations.</p>
    </div>

    <?php if ($cancelMsg): ?>
      <div class="alert alert-success">&#10003; Booking #<?= intval($cancelMsg) ?> has been cancelled.</div>
    <?php endif; ?>

    <?php if (isset($_GET['error'])): ?>
      <div class="alert alert-error"><?= htmlspecialchars($_GET['error']) ?></div>
    <?php endif; ?>

    <?php if (empty($bookings)): ?>
      <div class="empty-state">
        <div class="empty-icon">&#128663;</div>
        <h2>No bookings yet</h2>
        <p>You haven't made any bookings. Find a car wash place and reserve your spot!</p>
        <a href="carwashes.php" class="btn-primary">Browse Places</a>
      </div>
    <?php else: ?>
    <div class="bookings-list">
      <?php foreach ($bookings as $b): ?>
      <div class="booking-card <?= $b['status'] === 'cancelled' ? 'cancelled' : '' ?>">
        <div class="booking-left">
          <div class="booking-icon">&#9961;</div>
        </div>
        <div class="booking-body">
          <div class="booking-top">
            <h3><?= htmlspecialchars($b['place_name']) ?></h3>
            <span class="status-badge" style="background:<?= $statusColor[$b['status']] ?>">
              <?= ucfirst($b['status']) ?>
            </span>
          </div>
          <div class="booking-meta">
            <span>&#128197; <?= date('F j, Y', strtotime($b['date'])) ?></span>
            <span>&#128336; <?= date('g:i A', strtotime($b['time_slot'])) ?></span>
            <span>&#127776; <?= htmlspecialchars($b['service_type']) ?></span>
            <span>&#128178; $<?= number_format($b['price'], 2) ?></span>
          </div>
        </div>
        <div class="booking-actions">
          <a href="booking-confirm.php?id=<?= $b['id'] ?>" class="btn-view">Details</a>
          <?php if ($b['status'] === 'pending'): ?>
          <a href="booking-cancel.php?id=<?= $b['id'] ?>" class="btn-cancel"
             onclick="return confirm('Cancel this booking?')">Cancel</a>
          <?php endif; ?>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>
  </main>

  <footer class="footer">
    <p>&copy; 2026 SparkleWash. All rights reserved.</p>
  </footer>

</body>
</html>
