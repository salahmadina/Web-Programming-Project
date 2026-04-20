<?php
session_start();
require 'db.php';

$fullname = trim($_POST['fullname'] ?? '');
$age      = (int)($_POST['age'] ?? 0);
$phone    = trim($_POST['phone'] ?? '');
$email    = trim($_POST['email'] ?? '');
$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

$errors = [];

if (strlen($fullname) < 2)                          $errors[] = 'Full name is too short.';
if ($age < 18 || $age > 100)                        $errors[] = 'Age must be between 18 and 100.';
if (!filter_var($email, FILTER_VALIDATE_EMAIL))     $errors[] = 'Invalid email address.';
if (strlen($username) < 3)                          $errors[] = 'Username must be at least 3 characters.';
if (strlen($password) < 6)                          $errors[] = 'Password must be at least 6 characters.';

if (empty($errors)) {
    // Check for duplicate username / email
    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
    $stmt->execute([$username, $email]);
    if ($stmt->fetch()) {
        $errors[] = 'Username or email is already taken.';
    }
}

if (!empty($errors)) {
    $_SESSION['signup_errors'] = $errors;
    header('Location: signup.html?error=1');
    exit;
}

$hashed = password_hash($password, PASSWORD_DEFAULT);
$stmt = $pdo->prepare("
    INSERT INTO users (fullname, age, phone, email, username, password)
    VALUES (?, ?, ?, ?, ?, ?)
");
$stmt->execute([$fullname, $age, $phone, $email, $username, $hashed]);

$_SESSION['signup_success'] = 'Account created! Please sign in.';
header('Location: signin.html?registered=1');
exit;
