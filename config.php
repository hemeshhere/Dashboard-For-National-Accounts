<?php
session_start();

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

mysqli_report(MYSQLI_REPORT_OFF);
$host = 'localhost';
$db   = 'national_accounts';
$user = 'root'; 
$pass = '';    

$conn = new mysqli($host, $user, $pass);
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

if (!$conn->select_db($db)) {
    if (!$conn->query("CREATE DATABASE `$db`")) {
        die("Failed to create database: " . $conn->error);
    }
    $conn->close();
    $conn = new mysqli($host, $user, $pass, $db);
    if ($conn->connect_error) {
        die("Database connection failed after creating DB: " . $conn->connect_error);
    }
}

$createTableSQL = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    name VARCHAR(100) NOT NULL,
    security_question VARCHAR(255) NOT NULL,
    security_answer VARCHAR(255) NOT NULL,
    is_admin TINYINT(1) DEFAULT 0
)";
if (!$conn->query($createTableSQL)) {
    die("Failed to create users table: " . $conn->error);
}

// Create admin table if not exists
$createAdminTableSQL = "CREATE TABLE IF NOT EXISTS admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
if (!$conn->query($createAdminTableSQL)) {
    die('Failed to create admin table: ' . $conn->error);
}


function get_user($username) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

function create_user($username, $password, $name, $security_question, $security_answer) {
    global $conn;
    // Store password as plain text (no hashing)
    $stmt = $conn->prepare(
        "INSERT INTO users (username, password, name, security_question, security_answer) VALUES (?, ?, ?, ?, ?)"
    );
    $stmt->bind_param("sssss", $username, $password, $name, $security_question, $security_answer);
    return $stmt->execute();
}

function update_user_password($username, $new_password) {
    global $conn;
    $stmt = $conn->prepare("UPDATE users SET password = ? WHERE username = ?");
    $stmt->bind_param("ss", $new_password, $username);
    return $stmt->execute();
}

function verify_login($username, $password) {
    $user = get_user($username);
    // Compare plain text password
    return $user && $user['password'] === $password;
}

?>