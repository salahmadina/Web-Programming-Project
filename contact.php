<?php
session_start();
require 'db.php';

$name    = trim($_POST['name'] ?? '');
$email   = trim($_POST['email'] ?? '');
$subject = trim($_POST['subject'] ?? '');
$message = trim($_POST['message'] ?? '');

$errors = [];

if (strlen($name) < 2)                              $errors[] = 'Name is too short.';
if (!filter_var($email, FILTER_VALIDATE_EMAIL))     $errors[] = 'Invalid email address.';
if (strlen($subject) < 2)                           $errors[] = 'Subject is too short.';
if (strlen($message) < 10)                          $errors[] = 'Message must be at least 10 characters.';

if (!empty($errors)) {
    $_SESSION['contact_errors'] = $errors;
    header('Location: contact.html?error=1');
    exit;
}

$stmt = $pdo->prepare("
    INSERT INTO contacts (name, email, subject, message)
    VALUES (?, ?, ?, ?)
");
$stmt->execute([$name, $email, $subject, $message]);

header('Location: contact.html?sent=1');
exit;
