<?php
require_once '../config.php';

$error = '';
$show_question = false;
$username = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username'])) {
        // First step - username submission
        $username = trim($_POST['username'] ?? '');
        
        if (isset($valid_users[$username])) {
            $_SESSION['reset_user'] = $username;
            $show_question = true;
        } else {
            $error = "Username not found";
        }
    } elseif (isset($_POST['security_answer'])) {
        // Second step - security answer verification
        $username = $_SESSION['reset_user'] ?? '';
        $answer = strtolower(trim($_POST['security_answer'] ?? ''));
        
        if (isset($valid_users[$username]) && 
            strtolower($valid_users[$username]['security_answer']) === $answer) {
            
            // Generate simple token (insecure for production)
            $token = md5(uniqid());
            $_SESSION['reset_token'] = $token;
            $_SESSION['reset_token_time'] = time();
            
            // Redirect to reset page
            header("Location: reset_password.php");
            exit;
        } else {
            $error = "Incorrect security answer";
            $show_question = true;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Recovery - National Accounts</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
            <div class="text-center mb-8">
                <i class="fas fa-landmark text-4xl text-blue-600 mb-4"></i>
                <h1 class="text-2xl font-bold text-gray-800">
                    <?= $show_question ? 'Security Verification' : 'Password Recovery' ?>
                </h1>
                
                <?php if ($error): ?>
                    <div class="mt-4 p-3 bg-red-100 text-red-700 rounded">
                        <?= htmlspecialchars($error) ?>
                    </div>
                <?php endif; ?>
            </div>

            <form method="POST">
                <?php if (!$show_question): ?>
                    <!-- Username Input Step -->
                    <div class="mb-4">
                        <label for="username" class="block text-sm font-medium text-gray-700 mb-1">
                            Enter your username
                        </label>
                        <input type="text" id="username" name="username" required
                               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                               value="<?= htmlspecialchars($username) ?>">
                    </div>
                    <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition">
                        Continue
                    </button>
                <?php else: ?>
                    <!-- Security Question Step -->
                    <div class="mb-4">
                        <p class="text-sm text-gray-600 mb-2">Security Question:</p>
                        <p class="font-medium mb-4 p-3 bg-gray-100 rounded-lg">
                            <?= htmlspecialchars($valid_users[$_SESSION['reset_user']]['security_question']) ?>
                        </p>
                        <label for="security_answer" class="block text-sm font-medium text-gray-700 mb-1">
                            Your Answer
                        </label>
                        <input type="text" id="security_answer" name="security_answer" required
                               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="Enter your answer">
                    </div>
                    <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition">
                        Verify Answer
                    </button>
                <?php endif; ?>
            </form>

            <div class="mt-4 text-center">
                <a href="login.php" class="text-sm text-blue-600 hover:underline">
                    <i class="fas fa-arrow-left mr-1"></i> Back to Login
                </a>
            </div>
        </div>
    </div>
</body>
</html>