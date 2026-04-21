<?php require_once 'session.php'; $loggedIn = !empty($_SESSION['user_id']); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact — SparkleWash</title>
  <link rel="stylesheet" href="../css/contact.css">
</head>
<body>

  <nav class="navbar">
    <div class="nav-brand">&#128663;&#128166; SparkleWash</div>
    <ul class="nav-links">
      <li><a href="index.php">Home</a></li>
      <li><a href="about.php">About</a></li>
      <li><a href="contact.php" class="active">Contact</a></li>
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

  <main class="container">

    <div class="page-header">
      <h1>Contact Us</h1>
      <p>We'd love to hear from you</p>
    </div>

    <div class="contact-grid">

      <!-- Contact Info -->
      <div class="contact-info">
        <div class="info-item">
          <span class="info-icon">&#128231;</span>
          <div>
            <h3>Email</h3>
            <p>support@sparklewash.com</p>
          </div>
        </div>
        <div class="info-item">
          <span class="info-icon">&#128222;</span>
          <div>
            <h3>Phone</h3>
            <p>+1 (555) 123-4567</p>
          </div>
        </div>
        <div class="info-item">
          <span class="info-icon">&#128205;</span>
          <div>
            <h3>Address</h3>
            <p>123 Clean Street, Cartown, CA 90210</p>
          </div>
        </div>
        <div class="info-item">
          <span class="info-icon">&#128336;</span>
          <div>
            <h3>Hours</h3>
            <p>Mon–Sat: 8 AM – 8 PM<br>Sunday: 9 AM – 6 PM</p>
          </div>
        </div>
      </div>

      <!-- Contact Form -->
      <div class="contact-form-wrap">
        <form class="contact-form" onsubmit="handleContact(event)">
          <div class="form-group">
            <label for="cname">Your Name</label>
            <input type="text" id="cname" placeholder="John Smith" required>
          </div>
          <div class="form-group">
            <label for="cemail">Email</label>
            <input type="email" id="cemail" placeholder="you@example.com" required>
          </div>
          <div class="form-group">
            <label for="cmsg">Message</label>
            <textarea id="cmsg" rows="5" placeholder="How can we help?" required></textarea>
          </div>
          <button type="submit" class="btn-submit">Send Message</button>
          <div id="contactSuccess" class="success-msg" style="display:none;">
            &#10003; Message sent! We'll get back to you soon.
          </div>
        </form>
      </div>

    </div>
  </main>

  <footer class="footer">
    <p>&copy; 2026 SparkleWash. All rights reserved.</p>
  </footer>

  <script>
    function handleContact(e) {
      e.preventDefault();
      document.getElementById('contactSuccess').style.display = 'block';
      e.target.reset();
    }
  </script>

</body>
</html>
