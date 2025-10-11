<?php
session_start();

// can only enter if logged in
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}
?>