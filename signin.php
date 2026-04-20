<?php
session_start();
require 'db.php';

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

$errors = [];

if (strlen($username) < 3) $errors[] = 'Username must be at least 3 characters.';
if (strlen($password) < 6) $errors[] = 'Password must be at least 6 characters.';

if (empty($errors)) {
    $stmt = $pdo->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id']  = $user['id'];
        $_SESSION['username'] = $user['username'];
        header('Location: main.html');
        exit;
    }

    $errors[] = 'Invalid username or password.';
}

$_SESSION['signin_errors'] = $errors;
header('Location: signin.html?error=1');
exit;
