<?php
// switch_auth.php: Password prompt and verification for switching dashboards
session_start();
require_once 'config.php';

$type = isset($_GET['type']) ? $_GET['type'] : '';
$target = ($type === 'admin') ? 'admin_dashboard.php' : 'dashboard.php';
$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'] ?? '';
    if ($type === 'admin') {
        // Admin username and password check
        $admin_username = $_POST['admin_username'] ?? '';
        if (!$admin_username) {
            $msg = 'Please enter your admin username.';
        } else {
            $stmt = $conn->prepare('SELECT username, name, password FROM admin WHERE username=?');
            if (!$stmt) {
                $msg = 'Server error: Unable to prepare admin statement.';
                error_log('MySQL prepare error (admin): ' . $conn->error);
                $result = $conn->query("SHOW TABLES LIKE 'admin'");
                if (!$result || $result->num_rows == 0) {
                    $msg .= ' (Admin table not found. Please ensure it exists.)';
                }
            } else {
                $stmt->bind_param('s', $admin_username);
                $stmt->execute();
                $stmt->bind_result($db_username, $db_name, $hash);
                if ($stmt->fetch()) {
                    error_log('Admin login: username=' . $admin_username . ' hash=' . $hash . ' password=' . $password);
                    if (!empty($hash) && $password === $hash) {
                        $_SESSION['admin_loggedin'] = true;
                        $_SESSION['admin_username'] = $db_username;
                        $_SESSION['admin_display_name'] = $db_name;
                        header('Location: admin_dashboard.php');
                        exit;
                    } else {
                        $msg = 'Incorrect admin username or password.';
                    }
                } else {
                    $msg = 'Incorrect admin username or password.';
                }
                $stmt->close();
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
    <title>Switch Authentication</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold mb-4 text-center">
            <?php if ($type === 'admin'): ?>
                Switch to Admin Dashboard
            <?php else: ?>
                Switch to User Dashboard
            <?php endif; ?>
        </h2>
        <?php if ($msg): ?>
            <div class="bg-red-100 text-red-700 p-2 rounded mb-4 text-center"><?php echo htmlspecialchars($msg); ?></div>
        <?php endif; ?>
        <?php if ($type === 'admin'): ?>
        <form method="POST" class="flex flex-col gap-4">
            <input type="text" name="admin_username" required placeholder="Admin Username" class="border px-3 py-2 rounded" value="<?php echo htmlspecialchars($_SESSION['admin_username'] ?? ''); ?>" autofocus>
            <input type="password" name="password" required placeholder="Password" class="border px-3 py-2 rounded" autofocus>
            <button type="submit" class="bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-800">Continue</button>
        </form>
        <?php else: ?>
        <div class="text-red-700 text-center font-semibold">Switching from admin to user dashboard is disabled.</div>
        <?php endif; ?>
        <div class="mt-4 text-center">
            <a href="<?php echo $type === 'admin' ? 'dashboard.php' : 'admin_dashboard.php'; ?>" class="text-blue-600 hover:underline">Cancel</a>
        </div>
    </div>
</body>
</html>
