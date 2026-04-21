<?php
/* ── User Profile Page (Student 3) ─────────────────── */
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Profile — SparkleWash</title>
  <link rel="stylesheet" href="../css/profile.css">
</head>
<body>

  <nav class="navbar">
    <div class="nav-brand">&#128663;&#128166; SparkleWash</div>
    <ul class="nav-links">
      <li><a href="index.php">Home</a></li>
      <li><a href="about.php">About</a></li>
      <li><a href="contact.php">Contact</a></li>
      <li><a href="carwashes.php">Car Washes</a></li>
      <li><a href="my-bookings.php">My Bookings</a></li>
      <li><a href="profile.php" class="active">Profile</a></li>
      <li><a href="logout.php" class="btn-logout">Logout</a></li>
    </ul>
  </nav>

  <main class="container">

    <?php if ($success): ?>
      <div class="alert alert-success">&#10003; <?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <div class="profile-card">
      <div class="profile-avatar">
        <?= strtoupper(substr($user['name'], 0, 1)) ?>
      </div>
      <h1><?= htmlspecialchars($user['name']) ?></h1>
      <p class="profile-email">&#9993; <?= htmlspecialchars($user['email']) ?></p>
      <p class="profile-since">Member since <?= date('F Y', strtotime($user['created_at'])) ?></p>
    </div>

    <!-- Booking Stats -->
    <div class="stats-grid">
      <div class="stat-card">
        <span class="stat-number"><?= $stats['total'] ?></span>
        <span class="stat-label">Total Bookings</span>
      </div>
      <div class="stat-card pending">
        <span class="stat-number"><?= $stats['pending'] ?></span>
        <span class="stat-label">Pending</span>
      </div>
      <div class="stat-card confirmed">
        <span class="stat-number"><?= $stats['confirmed'] ?></span>
        <span class="stat-label">Confirmed</span>
      </div>
      <div class="stat-card cancelled">
        <span class="stat-number"><?= $stats['cancelled'] ?></span>
        <span class="stat-label">Cancelled</span>
      </div>
    </div>

    <div class="profile-actions">
      <a href="my-bookings.php" class="btn-primary">View My Bookings</a>
      <a href="carwashes.php"   class="btn-secondary">Book a Car Wash</a>
      <a href="logout.php"      class="btn-logout-lg">Logout</a>
    </div>

  </main>

  <footer class="footer">
    <p>&copy; 2026 SparkleWash. All rights reserved.</p>
  </footer>

</body>
</html>
