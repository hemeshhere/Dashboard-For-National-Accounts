<?php
$userData = [
    'fullName' => "USER USER",
    'email' => "aayushshah.505@gmail.com",
    'role' => "Citizen",
    'region' => "Punjab",
    'language' => "en",
    'notifications' => "enable",
    'reports' => [
        "Report on National Budget",
        "Population Demographics",
        "Health Services Analysis"
    ]
];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $userData['fullName'] = $_POST['fullName'] ?? $userData['fullName'];
    $userData['email'] = $_POST['email'] ?? $userData['email'];
    $userData['language'] = $_POST['language'] ?? $userData['language'];
    $userData['notifications'] = $_POST['notifications'] ?? $userData['notifications'];
    
    if ($userData['notifications'] === "disable") {
        $to = $userData['email'];
        $subject = "Notifications Disabled ";
        $message = "Hello ".$userData['fullName'].",You have disabled email notifications.";
        $headers = "From: no-reply@nationaldashboard.com";
        
        if (mail($to, $subject, $message, $headers)) {
            echo "<script>alert('Notifications disabled. Email sent!');</script>";
        } else {
            echo "<script>alert('Failed to send email');</script>";
        }
    } else {
        echo "<script>alert('Settings saved successfully!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Account</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    .card {
      transition: transform 0.2s, box-shadow 0.2s;
    }
    .card:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
  </style>
</head>
<body class="bg-gray-50">

<nav class="bg-blue-800 text-white shadow-lg">
  <div class="container mx-auto px-4 py-3">
    <div class="flex justify-between items-center">
      <div class="flex items-center space-x-4">
        <i class="fas fa-landmark text-2xl"></i>
        <span class="text-xl font-bold">National Dashboard</span>
      </div>
      <div class="hidden md:flex space-x-6">
        <a href="dashboard.php" class="hover:text-blue-200 transition">Dashboard</a>
        <a href="news.php" class="hover:text-blue-200 transition">News</a>
        <a href="report.php" class="hover:text-blue-200 transition">Reports</a>
        <a href="#" class="hover:text-blue-200 transition">Statistics</a>
        <a href="account.php" class="hover:text-blue-200 border-b-2 border-white transition font-semibold">Account</a>
      </div>
      <div class="md:hidden">
        <button id="menu-toggle" class="text-white focus:outline-none">
          <i class="fas fa-bars text-2xl"></i>
        </button>
      </div>
    </div>
    <div id="mobile-menu" class="hidden md:hidden mt-4 pb-4">
      <a href="dashboard.php" class="block py-2 hover:bg-blue-700 px-2 rounded">Dashboard</a>
      <a href="news.php" class="block py-2 hover:bg-blue-700 px-2 rounded">News</a>
      <a href="report.php" class="block py-2 hover:bg-blue-700 px-2 rounded">Reports</a>
      <a href="#" class="block py-2 hover:bg-blue-700 px-2 rounded">Statistics</a>
      <a href="account.php" class="block py-2 hover:bg-blue-700 px-2 rounded font-semibold">Account</a>
    </div>
  </div>
</nav>

<div class="container mx-auto px-4 py-8 max-w-6xl">
  <div class="flex flex-col md:flex-row gap-8">

  <div class="md:w-1/3">
      <div class="bg-white rounded-xl shadow-md overflow-hidden card">
        <div class="bg-blue-700 p-6 text-white">
          <div class="flex items-center space-x-4">
            <div class="bg-white text-blue-700 rounded-full w-16 h-16 flex items-center justify-center">
              <i class="fas fa-user text-3xl"></i>
            </div>
            <div>
              <h2 class="text-xl font-bold"><?= ($userData['fullName']) ?></h2>
              <p class="text-blue-100"><?= ($userData['role']) ?></p>
            </div>
          </div>
        </div>
        <div class="p-6">
          <div class="space-y-4">
            <div>
              <p class="text-gray-500 text-sm">Email</p>
              <p class="font-medium"><?= ($userData['email']) ?></p>
            </div>
            <div>
              <p class="text-gray-500 text-sm">Region</p>
              <p class="font-medium"><?= ($userData['region']) ?></p>
            </div>
            
          </div>
        </div>
      </div>
    </div>

    <!-- Settings Form -->
    <div class="md:w-2/3">
      <div class="bg-white rounded-xl shadow-md overflow-hidden card p-6">
        <h2 class="text-2xl font-bold text-blue-800 mb-6">Account Settings</h2>
        
        <form method="POST">
          <div class="space-y-6">
            <div>
              <h3 class="text-lg font-semibold mb-3 text-blue-700 border-b pb-2">Personal Information</h3>
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                  <input type="text" name="fullName" value="<?= ($userData['fullName']) ?>" 
                         class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                  <input type="email" name="email" value="<?= ($userData['email']) ?>" 
                         class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
              </div>
            </div>

            <div>
              <h3 class="text-lg font-semibold mb-3 text-blue-700 border-b pb-2">Preferences</h3>
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">Language</label>
                  <select name="language" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="en" <?= $userData['language'] == 'en' ? 'selected' : '' ?>>English</option>
                    <option value="hi" <?= $userData['language'] == 'hi' ? 'selected' : '' ?>>Hindi</option>
                  </select>
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">Notifications</label>
                  <select name="notifications" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="enable" <?= $userData['notifications'] == 'enable' ? 'selected' : '' ?>>Enable</option>
                    <option value="disable" <?= $userData['notifications'] == 'disable' ? 'selected' : '' ?>>Disable</option>
                  </select>
                </div>
              </div>
            </div>

            

            <div class="flex justify-between pt-4">
              <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg shadow">
                Save Changes
              </button>
              <button type="button" onclick="logout()" class="text-red-600 hover:text-red-800 px-4 py-2">
                <i class="fas fa-sign-out-alt mr-2"></i>Logout
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  document.getElementById('menu-toggle').addEventListener('click', function() {
    document.getElementById('mobile-menu').classList.toggle('hidden');
  });

  function logout() {
    if (confirm("Are you sure you want to logout?")) {
      window.location.href = "login.php"; 
    }
  }
</script>

</body>
</html>