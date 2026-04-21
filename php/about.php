<?php
require_once 'session.php';
$loggedIn = !empty($_SESSION['user_id']);
include '../html/about.html';
