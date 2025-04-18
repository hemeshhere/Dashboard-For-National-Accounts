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
<body class="bg-white min-h-screen font-sans">
    <div class="min-h-screen flex flex-col md:flex-row">
        <!-- Left: Login Form -->
        <div class="w-full md:w-1/2 flex flex-col justify-center px-8 py-10 bg-white">
            <!-- Heading at the top -->
            <div class="w-full flex flex-col items-center mb-12">
                <div class="flex items-center mb-2">
                    <img src="https://cdn-icons-png.flaticon.com/512/1995/1995574.png" alt="National Accounts Logo" class="w-10 h-10 mr-2">
                    <span class="text-3xl font-bold tracking-wide text-[#0c2340]">National Accounts</span>
                </div>
                <div class="w-24 border-b-2 border-[#bfa046] mt-1"></div>
            </div>
            <div class="max-w-md w-full mx-auto">
                <h2 class="text-xl md:text-2xl font-semibold mb-2 text-[#0c2340]">Welcome</h2>
                <p class="mb-8 text-[#4b5563]">Sign in to access your national finance and statistics dashboard.</p>
                <?php if (isset($error)): ?>
                    <div class="mb-4 text-red-500 font-semibold animate-pulse"><?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>
                <form method="POST" class="space-y-5">
                    <div>
                        <label for="username" class="block text-sm font-medium text-[#0c2340] mb-1">Username</label>
                        <input type="text" id="username" name="username" required placeholder="Enter your username"
                            class="w-full px-4 py-2 bg-[#f5fbfc] border border-[#d1d5db] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#bfa046] placeholder-gray-400 transition">
                    </div>
                    <div>
    <label for="password" class="block text-sm font-medium text-[#0c2340] mb-1">Password</label>
    <input type="password" id="password" name="password" required placeholder="Enter your password"
        class="w-full px-4 py-2 bg-[#f5fbfc] border border-[#d1d5db] rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 placeholder-gray-400 transition">
</div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input type="checkbox" id="remember" checked class="h-4 w-4 text-[#0e3c47] focus:ring-[#0e3c47] border-gray-300 rounded">
                            <label for="remember" class="ml-2 block text-sm text-gray-700">Remember me</label>
                        </div>
                        <?php if (!isset($_GET['admin'])): ?>
                        <a href="forgot_password.php" class="text-sm text-[#0e3c47] hover:underline">Forgot password?</a>
                        <?php endif; ?>
                    </div>
                    <button type="submit" class="w-full bg-gradient-to-r from-blue-700 to-blue-400 text-white py-2 px-4 rounded-lg font-semibold text-lg shadow hover:from-blue-800 hover:to-blue-500 transition-all duration-200">
    Sign In
</button>
<?php if (!isset($_GET['admin'])): ?>
    <a href="login.php?admin=1" class="w-full block mt-3 text-center border-2 border-blue-500 text-blue-700 py-2 px-4 rounded-lg font-semibold text-lg hover:bg-blue-50 transition-all duration-200">
        Sign In as Admin
    </a>
<?php endif; ?>

                </form>
                <?php if (!isset($_GET['admin'])): ?>
                <p class="mt-8 text-center text-sm text-[#4b5563]">
                    Don't have an account? <a href="register.php" class="text-blue-600 underline font-medium hover:text-blue-800">Sign Up</a>
                </p>
                <?php endif; ?>
            </div>
        </div>
        <!-- Right: Illustration & Welcome -->
        <div class="hidden md:flex w-1/2 bg-[#0c2340] items-center justify-center relative overflow-hidden">
            <div class="max-w-lg mx-auto text-left px-12">
                <h2 class="text-3xl md:text-4xl font-extrabold mb-2 mt-10 text-center bg-gradient-to-r from-blue-400 via-blue-600 to-blue-800 bg-clip-text text-transparent drop-shadow-lg tracking-wide">
    National Accounts Portal
</h2>
<div class="flex justify-center mb-4">
    <span class="block w-20 h-1 rounded-full bg-gradient-to-r from-blue-400 via-blue-600 to-blue-800 opacity-80"></span>
</div>
<p class="text-blue-100 text-base md:text-lg text-center max-w-lg mb-8 mx-auto px-3 py-2 rounded-xl bg-white/10 backdrop-blur-sm shadow-lg border border-blue-200/20 animate-fade-in">
    <span class="font-medium text-blue-200">Access</span> government finance, statistics, and economic dashboards.<br>
    <span class="font-medium text-blue-100">Secure</span>, centralized, and up to date.
</p>
                <img src="https://cdn.dribbble.com/userupload/18415615/file/original-d881fd064d90adfc18f6cb20fd3ee16e.webp?resize=2048x1536&vertical=center" alt="National Accounts Dashboard" class="mx-auto mb-2 rounded-xl shadow-lg w-full max-w-2xl">
            </div>
            <!-- Decorative squares -->
            <div class="absolute bottom-6 right-8 flex space-x-2 opacity-30">
                <div class="w-4 h-4 bg-blue-200 rounded-lg"></div>
                <div class="w-6 h-6 bg-blue-300 rounded-lg"></div>
                <div class="w-3 h-3 bg-blue-400 rounded-lg"></div>
                <div class="w-6 h-6 bg-yellow-300 rounded-lg"></div>
                <div class="w-3 h-3 bg-yellow-400 rounded-lg"></div>
            </div>
        </div>
    </div>
    <script>
    // Password visibility toggle icon
    document.querySelectorAll('input[type="password"] + span').forEach(function(span) {
        span.addEventListener('click', function() {
            const input = this.previousElementSibling;
            if (input.type === 'password') {
                input.type = 'text';
                this.innerHTML = '<i class="fa fa-eye-slash"></i>';
            } else {
                input.type = 'password';
                this.innerHTML = '<i class="fa fa-eye"></i>';
            }
        });
    });
    </script>
</body>
</html>