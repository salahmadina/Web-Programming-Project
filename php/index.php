<?php require_once 'session.php'; $loggedIn = !empty($_SESSION['user_id']); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SparkleWash — Car Wash Booking</title>
  <link rel="stylesheet" href="../css/index.css">
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar">
    <div class="nav-brand">&#128663;&#128166; SparkleWash</div>
    <ul class="nav-links">
      <li><a href="index.php" class="active">Home</a></li>
      <li><a href="about.php">About</a></li>
      <li><a href="contact.php">Contact</a></li>
      <?php if ($loggedIn): ?>
        <li><a href="carwashes.php">Car Washes</a></li>
        <li><a href="my-bookings.php">My Bookings</a></li>
        <li><a href="profile.php">Profile</a></li>
        <li><a href="logout.php" class="btn-nav btn-logout-nav">Logout</a></li>
      <?php else: ?>
        <li><a href="../html/login.html" class="btn-nav">Login</a></li>
        <li><a href="../html/signup.html" class="btn-nav btn-outline">Sign Up</a></li>
      <?php endif; ?>
    </ul>
  </nav>

  <!-- Hero -->
  <section class="hero">
    <div class="hero-content">
      <h1>Your Car Deserves<br><span>the Best Clean</span></h1>
      <p>Book a car wash in seconds. Choose your service, pick a time, and we'll handle the rest.</p>
      <div class="hero-btns">
        <?php if ($loggedIn): ?>
          <a href="carwashes.php" class="btn-primary">Book Now</a>
          <a href="about.php" class="btn-ghost">Learn More</a>
        <?php else: ?>
          <a href="../html/signup.html" class="btn-primary">Get Started</a>
          <a href="about.php" class="btn-ghost">Learn More</a>
        <?php endif; ?>
      </div>
    </div>
    <div class="hero-visual">
      <div class="hero-icon">&#128663;</div>
      <div class="sparkle s1">&#10024;</div>
      <div class="sparkle s2">&#10024;</div>
      <div class="sparkle s3">&#10024;</div>
    </div>
  </section>

  <!-- Features -->
  <section class="features">
    <h2>Why Choose SparkleWash?</h2>
    <div class="features-grid">
      <div class="feature-card">
        <div class="f-icon">&#128197;</div>
        <h3>Easy Booking</h3>
        <p>Reserve your spot online in under a minute. Choose date and time that works for you.</p>
      </div>
      <div class="feature-card">
        <div class="f-icon">&#11088;</div>
        <h3>Quality Service</h3>
        <p>From quick Basic washes to thorough Full Service details — we've got every level covered.</p>
      </div>
      <div class="feature-card">
        <div class="f-icon">&#128272;</div>
        <h3>Secure Account</h3>
        <p>Your data is safe. Track your booking history anytime from your personal dashboard.</p>
      </div>
    </div>
  </section>

  <!-- Services Preview -->
  <section class="services-preview">
    <h2>Our Services</h2>
    <div class="services-grid">
      <div class="service-item basic">
        <h3>Basic</h3>
        <p>Exterior wash &amp; rinse</p>
        <strong>From $5.99</strong>
      </div>
      <div class="service-item premium">
        <h3>Premium</h3>
        <p>Exterior + windows + wheels</p>
        <strong>From $18.99</strong>
      </div>
      <div class="service-item full">
        <h3>Full Service</h3>
        <p>Complete wash + interior</p>
        <strong>From $34.99</strong>
      </div>
    </div>
    <?php if ($loggedIn): ?>
      <a href="carwashes.php" class="btn-cta">Book Now</a>
    <?php else: ?>
      <a href="../html/signup.html" class="btn-cta">Book Now</a>
    <?php endif; ?>
  </section>

  <footer class="footer">
    <p>&copy; 2026 SparkleWash &nbsp;|&nbsp; <a href="about.php">About</a> &nbsp;|&nbsp; <a href="contact.php">Contact</a></p>
  </footer>

</body>
</html>
