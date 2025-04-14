<?php
require_once '../config.php';

// Check if user came through proper flow
if (!isset($_SESSION['reset_user']) || !isset($_SESSION['reset_token'])) {
    header("Location: forgot_password.php");
    exit;
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    
    if (empty($new_password) || strlen($new_password) < 6) {
        $error = "Password must be at least 6 characters";
    } elseif ($new_password !== $confirm_password) {
        $error = "Passwords don't match";
    } else {
        // Update the password (in plain text)
        if (update_user_password($_SESSION['reset_user'], $new_password)) {
            // Clear reset session
            unset($_SESSION['reset_user']);
            unset($_SESSION['reset_token']);
            unset($_SESSION['reset_token_time']);
            
            $success = "Password updated successfully!";
        } else {
            $error = "Failed to update password";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - National Accounts</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
            <div class="text-center mb-8">
                <i class="fas fa-landmark text-4xl text-blue-600 mb-4"></i>
                <h1 class="text-2xl font-bold text-gray-800">Reset Your Password</h1>
                
                <?php if ($error): ?>
                    <div class="mt-4 p-3 bg-red-100 text-red-700 rounded">
                        <?= htmlspecialchars($error) ?>
                    </div>
                <?php endif; ?>
                
                <?php if ($success): ?>
                    <div class="mt-4 p-4 bg-green-100 text-green-700 rounded">
                        <?= htmlspecialchars($success) ?>
                        <p class="mt-2">
                            <a href="login.php" class="text-blue-600 hover:underline">
                                Click here to login
                            </a>
                        </p>
                    </div>
                <?php endif; ?>
            </div>

            <?php if (!$success): ?>
            <form method="POST">
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                        New Password (min 6 characters)
                    </label>
                    <input type="password" id="password" name="password" required minlength="6"
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                
                <div class="mb-6">
                    <label for="confirm_password" class="block text-sm font-medium text-gray-700 mb-1">
                        Confirm Password
                    </label>
                    <input type="password" id="confirm_password" name="confirm_password" required minlength="6"
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                
                <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition">
                    Reset Password
                </button>
            </form>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>