<?php
require_once 'config.php';
// Only allow access if already logged in as admin
if (!isset($_SESSION['admin_loggedin']) || !$_SESSION['admin_loggedin']) {
    header('Location: auth/login.php?admin=1');
    exit;
}

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');

    // Basic validation
    if (!$username || !$password || !$name || !$email) {
        $message = '<span class="text-red-600">All fields are required.</span>';
    } elseif (strlen($password) < 6) {
        $message = '<span class="text-red-600">Password must be at least 6 characters.</span>';
    } else {
        // Check for unique username
        $stmt = $conn->prepare('SELECT id FROM admin WHERE username = ?');
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $message = '<span class="text-red-600">Username already exists.</span>';
        } else {
            $stmt = $conn->prepare('INSERT INTO admin (username, password, name, email) VALUES (?, ?, ?, ?)');
            $stmt->bind_param('ssss', $username, $password, $name, $email);
            if ($stmt->execute()) {
                $message = '<span class="text-green-700">Admin user created successfully!</span>';
            } else {
                $message = '<span class="text-red-600">Error: ' . htmlspecialchars($stmt->error) . '</span>';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Admin User</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h1 class="text-2xl font-bold mb-6 text-blue-800 flex items-center"><i class="fas fa-user-shield mr-2"></i>Create Admin User</h1>
        <?php if ($message) echo '<div class="mb-4">' . $message . '</div>'; ?>
        <form method="POST" class="space-y-5">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1" for="username">Username</label>
                <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" type="text" id="username" name="username" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1" for="password">Password</label>
                <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" type="password" id="password" name="password" required minlength="6">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1" for="name">Full Name</label>
                <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" type="text" id="name" name="name" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1" for="email">Email</label>
                <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" type="email" id="email" name="email" required>
            </div>
            <button type="submit" class="w-full bg-blue-700 text-white py-2 px-4 rounded-lg hover:bg-blue-800 transition font-semibold">
                <i class="fas fa-plus mr-2"></i>Create Admin
            </button>
        </form>
        <div class="mt-6 text-center">
            <a href="admin_dashboard.php" class="text-blue-600 hover:underline"><i class="fas fa-arrow-left mr-1"></i>Back to Admin Dashboard</a>
        </div>
    </div>
</body>
</html>
