<?php
/* ── Car Wash Detail Page (Student 2) ───────────────── */
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($wash['name']) ?> — SparkleWash</title>
  <link rel="stylesheet" href="../css/carwash-detail.css">
</head>
<body>

  <nav class="navbar">
    <div class="nav-brand">&#128663;&#128166; SparkleWash</div>
    <ul class="nav-links">
      <li><a href="index.php">Home</a></li>
      <li><a href="about.php">About</a></li>
      <li><a href="contact.php">Contact</a></li>
      <li><a href="carwashes.php" class="active">Car Washes</a></li>
      <li><a href="my-bookings.php">My Bookings</a></li>
      <li><a href="profile.php">Profile</a></li>
      <li><a href="logout.php" class="btn-logout">Logout</a></li>
    </ul>
  </nav>

  <main class="container">
    <a href="carwashes.php" class="back-link">&#8592; Back to Listings</a>

    <div class="detail-card">
      <div class="detail-icon">&#9961;</div>
      <div class="detail-content">
        <span class="badge" style="background:<?= $badge[$wash['type']] ?>">
          <?= htmlspecialchars($wash['type']) ?>
        </span>
        <h1><?= htmlspecialchars($wash['name']) ?></h1>
        <p class="detail-desc"><?= htmlspecialchars($wash['description']) ?></p>

        <div class="detail-meta">
          <div class="meta-item">
            <span class="meta-label">Service Type</span>
            <span class="meta-value"><?= htmlspecialchars($wash['type']) ?></span>
          </div>
          <div class="meta-item">
            <span class="meta-label">Price</span>
            <span class="meta-value price">$<?= number_format($wash['price'],2) ?></span>
          </div>
        </div>

        <div class="notice-box">
          &#9888; Please note: If you do not arrive within 10 minutes of your booking time,
          your booking will be automatically cancelled.
        </div>

        <a href="../html/booking.html?wash_id=<?= $wash['id'] ?>&wash_name=<?= urlencode($wash['name']) ?>&price=<?= $wash['price'] ?>"
           class="btn-book">Book This Service</a>
      </div>
    </div>
  </main>

  <footer class="footer">
    <p>&copy; 2026 SparkleWash. All rights reserved.</p>
  </footer>

</body>
</html>
