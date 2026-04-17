<?php
/* ── Car Wash Places Listing ─────────────────────────── */
require_once 'db.php';
require_once 'session.php';
requireLogin();

/* Fetch all places with their services */
$sql = '
    SELECT
        p.id           AS place_id,
        p.name         AS place_name,
        p.description,
        p.image_path,
        p.location_url,
        s.id           AS service_id,
        s.type         AS service_type,
        s.price
    FROM car_wash_places p
    LEFT JOIN wash_services s ON s.place_id = p.id
    ORDER BY p.id ASC, s.price ASC
';

$result = $conn->query($sql);
$rows   = $result->fetch_all(MYSQLI_ASSOC);
$conn->close();

/* Group services under each place */
$places = [];
foreach ($rows as $row) {
    $pid = $row['place_id'];
    if (!isset($places[$pid])) {
        $places[$pid] = [
            'id'           => $pid,
            'name'         => $row['place_name'],
            'description'  => $row['description'],
            'image_path'   => $row['image_path'],
            'location_url' => $row['location_url'],
            'services'     => [],
        ];
    }
    if ($row['service_id']) {
        $places[$pid]['services'][] = [
            'id'    => $row['service_id'],
            'type'  => $row['service_type'],
            'price' => $row['price'],
        ];
    }
}

$badge = ['Basic' => '#10B981', 'Premium' => '#2563EB', 'Full Service' => '#7C3AED'];
$userName = currentUserName();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Car Wash Places — SparkleWash</title>
  <link rel="stylesheet" href="../css/carwashes.css">
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar">
    <div class="nav-brand">&#9992; SparkleWash</div>
    <ul class="nav-links">
      <li><a href="carwashes.php" class="active">Home</a></li>
      <li><a href="my-bookings.php">My Bookings</a></li>
      <li><a href="logout.php" class="btn-logout">Logout</a></li>
    </ul>
  </nav>

  <main class="container">
    <div class="page-header">
      <h1>Car Wash Places</h1>
      <p>Hello, <?= htmlspecialchars($userName) ?>! Pick a place and choose your wash type.</p>
    </div>

    <?php if (empty($places)): ?>
      <p class="empty-msg">No car wash places found.</p>
    <?php else: ?>
    <div class="places-grid">
      <?php foreach ($places as $place): ?>
      <div class="place-card">

        <!-- Photo area — add image file path in database.sql location_url column
             when you have the photo, set image_path in the DB to e.g. ../images/sparklewash.jpg -->
        <div class="place-photo">
          <?php if ($place['image_path']): ?>
            <img src="<?= htmlspecialchars($place['image_path']) ?>"
                 alt="<?= htmlspecialchars($place['name']) ?>">
          <?php else: ?>
            <div class="photo-placeholder">
              <span>&#128663;</span>
              <small>Photo coming soon</small>
            </div>
          <?php endif; ?>
        </div>

        <div class="place-body">
          <h2 class="place-name"><?= htmlspecialchars($place['name']) ?></h2>
          <p class="place-desc"><?= htmlspecialchars($place['description']) ?></p>

          <!-- Services list -->
          <div class="services-list">
            <?php foreach ($place['services'] as $svc): ?>
            <div class="service-row">
              <span class="svc-badge" style="background:<?= $badge[$svc['type']] ?>">
                <?= htmlspecialchars($svc['type']) ?>
              </span>
              <span class="svc-price">$<?= number_format($svc['price'], 2) ?></span>
              <a href="../html/booking.html?service_id=<?= $svc['id'] ?>&place=<?= urlencode($place['name']) ?>&type=<?= urlencode($svc['type']) ?>&price=<?= $svc['price'] ?>"
                 class="btn-book">Book</a>
            </div>
            <?php endforeach; ?>
          </div>

          <!-- Location button -->
          <!-- TODO: Set the location_url in the database for each place to a real Google Maps link -->
          <?php if ($place['location_url']): ?>
          <a href="<?= htmlspecialchars($place['location_url']) ?>"
             target="_blank" rel="noopener" class="btn-location">
            &#128205; Get Directions
          </a>
          <?php else: ?>
          <span class="btn-location btn-location-placeholder">
            &#128205; Location coming soon
          </span>
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
