<?php
/* ── Handle Signup Form ──────────────────────────────── */
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../html/signup.html');
    exit;
}

$name     = trim($_POST['name']     ?? '');
$email    = trim($_POST['email']    ?? '');
$password =      $_POST['password'] ?? '';
$confirm  =      $_POST['confirm']  ?? '';

/* ── Validation ── */
$errors = [];

if (strlen($name) < 2)                         $errors[] = 'Name must be at least 2 characters.';
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Enter a valid email address.';
if (strlen($password) < 4)                     $errors[] = 'Password must be at least 4 characters.';
if ($password !== $confirm)                    $errors[] = 'Passwords do not match.';

if ($errors) {
    $msg = urlencode(implode(' | ', $errors));
    header("Location: ../html/signup.html?error=$msg");
    exit;
}

/* ── Check duplicate email ── */
$stmt = $conn->prepare('SELECT id FROM users WHERE email = ?');
$stmt->bind_param('s', $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    header('Location: ../html/signup.html?error=' . urlencode('Email already registered.'));
    exit;
}
$stmt->close();

/* ── Insert user (plain text password) ── */
$stmt = $conn->prepare('INSERT INTO users (name, email, password) VALUES (?, ?, ?)');
$stmt->bind_param('sss', $name, $email, $password);

if ($stmt->execute()) {
    header('Location: ../html/login.html?success=' . urlencode('Account created! Please log in.'));
} else {
    header('Location: ../html/signup.html?error=' . urlencode('Registration failed. Try again.'));
}
$stmt->close();
$conn->close();
?>
