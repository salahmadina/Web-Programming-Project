<?php
/* ── Handle Login Form ───────────────────────────────── */
require_once 'db.php';
require_once 'session.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../html/login.html');
    exit;
}

$email    = trim($_POST['email']    ?? '');
$password =      $_POST['password'] ?? '';

/* ── Basic validation ── */
if (empty($email) || empty($password)) {
    header('Location: ../html/login.html?error=' . urlencode('Please fill in all fields.'));
    exit;
}

/* ── Fetch user and compare plain text password ── */
$stmt = $conn->prepare('SELECT id, name, password FROM users WHERE email = ?');
$stmt->bind_param('s', $email);
$stmt->execute();
$stmt->bind_result($id, $name, $storedPassword);
$stmt->fetch();
$stmt->close();
$conn->close();

if ($id && $password === $storedPassword) {
    $_SESSION['user_id']   = $id;
    $_SESSION['user_name'] = $name;
    header('Location: ../php/carwashes.php');
    exit;
} else {
    header('Location: ../html/login.html?error=' . urlencode('Invalid email or password.'));
    exit;
}
?>
