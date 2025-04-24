<?php
require_once '../config.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password']);
    $name = trim($_POST['name'] ?? '');
    $security_question = trim($_POST['security_question'] ?? '');
    $security_answer = trim($_POST['security_answer'] ?? '');

    if ($username === '' || $password === '' || $name === '' || $security_question === '' || $security_answer === '') {
        $error = "All fields are required.";
    } elseif (preg_match('/\s/', $username)) {
        $error = "Username must not contain spaces.";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters long.";
    } elseif (!preg_match('/^[a-zA-Z ]+$/', $name)) {
        $error = "Full Name must contain only alphabets and spaces.";
    } else {
        if (get_user($username)) {
            $error = "Username already exists.";
        } else {
            // For production, hash the password!
            if (create_user($username, $password, $name, $security_question, $security_answer)) {
                $success = "Registration successful! You can now <a href='login.php' class='text-blue-600 underline'>login</a>.";
            } else {
                $error = "Error during registration. Please try again.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - National Accounts</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
            <h1 class="text-2xl font-bold mb-6 text-center">Create Account</h1>
            <?php if ($error): ?>
                <div class="mb-4 text-red-500"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <?php if ($success): ?>
                <div class="mb-4 text-green-600"><?= $success ?></div>
            <?php endif; ?>
            <form method="POST" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Username</label>
                    <input type="text" name="username" required class="w-full px-3 py-2 border rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Password</label>
                    <input type="password" name="password" required class="w-full px-3 py-2 border rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Full Name</label>
                    <input type="text" name="name" required class="w-full px-3 py-2 border rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Security Question</label>
                    <select name="security_question" required class="w-full px-3 py-2 border rounded">
                        <option value="">Select a question</option>
                        <option value="What city were you born in?">What city were you born in?</option>
                        <option value="What is your mother's maiden name?">What is your mother's maiden name?</option>
                        <option value="What was the name of your first pet?">What was the name of your first pet?</option>
                        <option value="What is your favorite food?">What is your favorite food?</option>
                        <option value="What is the name of your elementary school?">What is the name of your elementary school?</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Security Answer</label>
                    <input type="text" name="security_answer" required class="w-full px-3 py-2 border rounded">
                </div>
                <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Register</button>
            </form>
            <p class="mt-4 text-center text-sm">Already have an account? <a href="login.php" class="text-blue-600 underline">Login</a></p>
        </div>
    </div>
</body>
</html>
