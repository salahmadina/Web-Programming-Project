<?php
/* ── Logout (Student 1) ─────────────────────────────── */
require_once 'session.php';

$_SESSION = [];
session_destroy();

header('Location: ../html/login.html?success=' . urlencode('You have been logged out.'));
exit;
?>
