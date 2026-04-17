<?php
/* ── Session helper (Student 1) ──────────────────────
   Include this at the top of any page that needs
   to know who is logged in.                           */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/* Redirect to login if not authenticated */
function requireLogin() {
    if (empty($_SESSION['user_id'])) {
        header('Location: ../html/login.html');
        exit;
    }
}

/* Return logged-in user id (or null) */
function currentUserId() {
    return $_SESSION['user_id'] ?? null;
}

/* Return logged-in user name (or Guest) */
function currentUserName() {
    return $_SESSION['user_name'] ?? 'Guest';
}
?>
