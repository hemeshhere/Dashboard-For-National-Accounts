<?php
require_once 'config.php';

// ADD USER
if (isset($_POST['action']) && $_POST['action'] === 'add') {
    $username = trim($_POST['username']);
    $name = trim($_POST['name']);
    $password = trim($_POST['password']);
    $security_question = trim($_POST['security_question']);
    $security_answer = trim($_POST['security_answer']);
    if ($username && $name && $_POST['password'] && $security_question && $security_answer) {
        $stmt = $conn->prepare("INSERT INTO users (username, name, password, security_question, security_answer) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $username, $name, $password, $security_question, $security_answer);
        if ($stmt->execute()) {
            header('Location: admin_dashboard.php?msg=User+added+successfully');
            exit;
        } else {
            error_log('Add user error: ' . $conn->error);
            header('Location: admin_dashboard.php?msg=Error+adding+user:+' . urlencode($conn->error));
            exit;
        }
    } else {
        header('Location: admin_dashboard.php?msg=All+fields+are+required');
        exit;
    }
}

// EDIT USER
if (isset($_POST['action']) && $_POST['action'] === 'edit') {
    $id = intval($_POST['id']);
    $username = trim($_POST['username']);
    $name = trim($_POST['name']);
    if (!empty($_POST['password'])) {
        $password = trim($_POST['password']);
        $stmt = $conn->prepare("UPDATE users SET username=?, name=?, password=? WHERE id=?");
        $stmt->bind_param("sssi", $username, $name, $password, $id);
    } else {
        $stmt = $conn->prepare("UPDATE users SET username=?, name=? WHERE id=?");
        $stmt->bind_param("ssi", $username, $name, $id);
    }
    if ($stmt->execute()) {
        header('Location: admin_dashboard.php?msg=User+updated+successfully');
        exit;
    } else {
        header('Location: admin_dashboard.php?msg=Error+updating+user');
        exit;
    }
}

// DELETE USER
if (isset($_GET['delete_user'])) {
    $id = intval($_GET['delete_user']);
    $stmt = $conn->prepare("DELETE FROM users WHERE id=?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        header('Location: admin_dashboard.php?msg=User+deleted+successfully');
        exit;
    } else {
        header('Location: admin_dashboard.php?msg=Error+deleting+user');
        exit;
    }
}
?>
