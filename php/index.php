<?php
require_once 'session.php';
$loggedIn = !empty($_SESSION['user_id']);
include '../html/index.html';
