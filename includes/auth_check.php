<?php
require_once __DIR__ . '/../config.php';

if (!isset($_SESSION['loggedin'])) {
    header('Location: ../auth/login.php');
    exit;
}
?>