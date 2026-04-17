<?php
/* ── Gallery / Services Overview Page (Student 2) ────── */
require_once 'session.php';
requireLogin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gallery — SparkleWash</title>
  <link rel="stylesheet" href="../css/gallery.css">
</head>
<body>

  <nav class="navbar">
    <div class="nav-brand">&#9992; SparkleWash</div>
    <ul class="nav-links">
      <li><a href="carwashes.php">Car Washes</a></li>
      <li><a href="../html/booking.html">Book Now</a></li>
      <li><a href="my-bookings.php">My Bookings</a></li>
      <li><a href="gallery.php" class="active">Gallery</a></li>
      <li><a href="logout.php" class="btn-logout">Logout</a></li>
    </ul>
  </nav>

  <main class="container">
    <div class="page-header">
      <h1>Our Services Gallery</h1>
      <p>See what each service includes</p>
    </div>

    <div class="gallery-grid">

      <div class="gallery-card">
        <div class="gallery-icon basic">&#127760;</div>
        <h3>Basic Wash</h3>
        <ul>
          <li>&#10003; Exterior rinse</li>
          <li>&#10003; Foam wash</li>
          <li>&#10003; Final rinse</li>
          <li>&#10003; Air dry</li>
        </ul>
        <span class="gallery-price">From $5.99</span>
      </div>

      <div class="gallery-card">
        <div class="gallery-icon premium">&#11088;</div>
        <h3>Premium Wash</h3>
        <ul>
          <li>&#10003; All Basic features</li>
          <li>&#10003; Window cleaning</li>
          <li>&#10003; Wheel scrub</li>
          <li>&#10003; Hand dry</li>
        </ul>
        <span class="gallery-price">From $18.99</span>
      </div>

      <div class="gallery-card">
        <div class="gallery-icon full">&#127775;</div>
        <h3>Full Service</h3>
        <ul>
          <li>&#10003; All Premium features</li>
          <li>&#10003; Interior vacuum</li>
          <li>&#10003; Dashboard wipe</li>
          <li>&#10003; Air freshener</li>
          <li>&#10003; Wax coating</li>
        </ul>
        <span class="gallery-price">From $34.99</span>
      </div>

    </div>

    <div class="cta-section">
      <h2>Ready to book?</h2>
      <p>Pick a location and reserve your spot in seconds.</p>
      <a href="carwashes.php" class="btn-cta">Browse Car Washes</a>
    </div>
  </main>

  <footer class="footer">
    <p>&copy; 2026 SparkleWash. All rights reserved.</p>
  </footer>

</body>
</html>
