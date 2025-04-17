<?php
require_once '../config.php';

// Redirect if already logged in
if (isset($_SESSION['loggedin'])) {
    header('Location: ../dashboard.php');
    exit;
}

// Process login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    
    if (isset($_GET['admin'])) {
        // Admin login: check admin table
        $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $admin = $result->fetch_assoc();
        if ($admin && $password === $admin['password']) {
            $_SESSION['admin_loggedin'] = true;
            $_SESSION['admin_username'] = $admin['username'];
            $_SESSION['admin_display_name'] = $admin['name'];
            header('Location: ../admin_dashboard.php');
            exit;
        } else {
            $error = "Invalid admin username or password";
        }
    } else {
        // Regular user login
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        if ($user && $password === $user['password']) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['user_display_name'] = $user['name'];
            $_SESSION['is_admin'] = isset($user['is_admin']) ? $user['is_admin'] : 0;
            if ($_SESSION['is_admin']) {
                header('Location: ../admin_dashboard.php');
            } else {
                header('Location: ../dashboard.php');
            }
            exit;
        } else {
            $error = "Invalid username or password";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - National Accounts</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
            <div class="text-center mb-8">
                <i class="fas fa-landmark text-4xl text-blue-600 mb-4"></i>
                <h1 class="text-2xl font-bold text-gray-800">
                    <?php if (isset($_GET['admin'])): ?>
                        <span class="text-red-600">Admin Login</span>
                    <?php else: ?>
                        National Accounts
                    <?php endif; ?>
                </h1>
                <p class="text-gray-600">
                    <?php if (isset($_GET['admin'])): ?>
                        Please sign in as an administrator
                    <?php else: ?>
                        Sign in to access your dashboard
                    <?php endif; ?>
                </p>
                <?php if (isset($error)): ?>
                    <div class="mt-4 text-red-500"><?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>
            </div>
            
            <form method="POST" class="space-y-6">
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                    <input type="text" id="username" name="username" required
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" id="password" name="password" required
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                  
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input type="checkbox" id="remember" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-700">Remember me</label>
                    </div>
                    
                    <a href="forgot_password.php" class="text-sm text-blue-600 hover:underline">Forgot password?</a>
                </div>
                <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition">
                    Sign In
                </button>
            </form>
            <p class="mt-4 text-center text-sm">
                Don't have an account? <a href="register.php" class="text-blue-600 underline">Create one</a>
            </p>
            <div class="mt-6 text-center">
                <?php if (!isset($_GET['admin'])): ?>
                    <a href="?admin=1" class="inline-block bg-red-100 text-red-700 px-4 py-2 rounded-lg font-semibold border border-red-300 hover:bg-red-200 transition">
                        <i class="fas fa-user-shield mr-2"></i>Admin Login
                    </a>
                <?php else: ?>
                    <a href="login.php" class="inline-block bg-gray-100 text-gray-700 px-4 py-2 rounded-lg font-semibold border border-gray-300 hover:bg-gray-200 transition">
                        <i class="fas fa-arrow-left mr-2"></i>Back to User Login
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>