<?php require_once 'session.php'; $loggedIn = !empty($_SESSION['user_id']); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About — SparkleWash</title>
  <link rel="stylesheet" href="../css/about.css">
</head>
<body>

  <nav class="navbar">
    <div class="nav-brand">&#128663;&#128166; SparkleWash</div>
    <ul class="nav-links">
      <li><a href="index.php">Home</a></li>
      <li><a href="about.php" class="active">About</a></li>
      <li><a href="contact.php">Contact</a></li>
      <?php if ($loggedIn): ?>
        <li><a href="carwashes.php">Car Washes</a></li>
        <li><a href="my-bookings.php">My Bookings</a></li>
        <li><a href="profile.php">Profile</a></li>
        <li><a href="logout.php" class="btn-logout">Logout</a></li>
      <?php else: ?>
        <li><a href="../html/login.html" class="btn-nav">Login</a></li>
        <li><a href="../html/signup.html" class="btn-nav btn-outline">Sign Up</a></li>
      <?php endif; ?>
    </ul>
  </nav>

  <!-- Hero Banner -->
  <section class="about-hero">
    <div class="hero-inner">
      <p class="hero-eyebrow">Who We Are</p>
      <h1>Built for Clean Cars<br>and Happy Drivers</h1>
      <p class="hero-sub">SparkleWash connects car owners with quality local car wash services through a fast, easy-to-use booking platform.</p>
    </div>
  </section>

  <!-- Stats Strip -->
  <section class="stats-strip">
    <div class="stat-item">
      <span class="stat-num">6+</span>
      <span class="stat-lbl">Car Wash Locations</span>
    </div>
    <div class="stat-item">
      <span class="stat-num">3</span>
      <span class="stat-lbl">Service Tiers</span>
    </div>
    <div class="stat-item">
      <span class="stat-num">5 Years</span>
      <span class="stat-lbl">And Counting</span>
    </div>
    <div class="stat-item">
      <span class="stat-num">500K+</span>
      <span class="stat-lbl">Members</span>
    </div>
    <div class="stat-item">
      <span class="stat-num">50M+</span>
      <span class="stat-lbl">Cars Washed</span>
    </div>
  </section>

  <main class="container">

    <!-- Mission -->
    <section class="mission-section">
      <div class="mission-label">Our Mission</div>
      <h2>Making Car Care Effortless</h2>
      <p>No waiting in line — choose your service, pick a time, and arrive ready. Our system handles the scheduling so you can focus on your day. We believe getting your car cleaned should be as simple as a few taps.</p>
    </section>

    <!-- What We Offer -->
    <section class="offer-section">
      <h2 class="section-title">What We Offer</h2>
      <div class="offer-grid">
        <div class="offer-card">
          <div class="offer-icon">&#128197;</div>
          <h3>Flexible Booking</h3>
          <p>Same-day and next-day slots available. Reserve your spot in under a minute.</p>
        </div>
        <div class="offer-card">
          <div class="offer-icon">&#11088;</div>
          <h3>Three Service Tiers</h3>
          <p>Basic, Premium, and Full Service — from a quick exterior rinse to a deep interior detail.</p>
        </div>
        <div class="offer-card">
          <div class="offer-icon">&#128200;</div>
          <h3>Real-Time Availability</h3>
          <p>Live slot availability so you always know exactly when you can come in.</p>
        </div>
        <div class="offer-card">
          <div class="offer-icon">&#128203;</div>
          <h3>Booking Dashboard</h3>
          <p>Track your full booking history, check status, and manage cancellations in one place.</p>
        </div>
        <div class="offer-card">
          <div class="offer-icon">&#128272;</div>
          <h3>Secure Accounts</h3>
          <p>Your personal data and booking history are protected with secure account management.</p>
        </div>
        <div class="offer-card">
          <div class="offer-icon">&#128205;</div>
          <h3>Multiple Locations</h3>
          <p>Choose from 6+ partner car wash locations, each with directions built right in.</p>
        </div>
      </div>
    </section>

    <!-- Built By -->
    <section class="built-section">
      <div class="built-icon">&#128187;</div>
      <h3>Built By Students</h3>
      <p>SparkleWash is a web programming project built with PHP, MySQL, and pure CSS — no frameworks, no shortcuts.</p>
    </section>

  </main>

  <footer class="footer">
    <p>&copy; 2026 SparkleWash. All rights reserved.</p>
  </footer>

</body>
</html>
