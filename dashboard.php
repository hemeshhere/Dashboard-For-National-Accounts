<?php
require_once 'includes/auth_check.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Indian National Accounts</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .profile-dropdown { display: none; }
        .profile-container:hover .profile-dropdown { display: block; }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-blue-800 text-white shadow-lg">
        <div class="container mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <i class="fas fa-landmark text-2xl"></i>
                    <span class="text-xl font-bold">Indian National Accounts</span>
                </div>
                <div class="hidden md:flex items-center space-x-6">
                    <a href="dashboard.php" class="font-semibold border-b-2 border-white">Dashboard</a>
                    <a href="news.php" class="hover:text-blue-200 transition">News</a>
                    <a href="report.php" class="hover:text-blue-200 transition">Reports</a>
                    <a href="stats.php" class="hover:text-blue-200 transition">Statistics</a>
                    <!-- Profile Icon -->
                    <div class="profile-container relative">
                        <button class="flex items-center space-x-2 hover:text-blue-200">
                            <div class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center">
                                <i class="fas fa-user text-white"></i>
                            </div>
                            <span class="hidden lg:inline"><?php echo htmlspecialchars($_SESSION['user_display_name']); ?></span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </button>
                        <!-- Dropdown Menu -->
                        <div class="profile-dropdown absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10">
                            <div class="px-4 py-2 text-sm text-gray-700 border-b">
                                <p class="font-medium">Signed in as</p>
                                <p class="truncate"><?php echo htmlspecialchars($_SESSION['username']); ?></p>
                            </div>
                            <a href="account.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-user-circle mr-2"></i> Profile: <?php echo htmlspecialchars($_SESSION['username']); ?>
                            </a>
                            <a href="auth/logout.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-sign-out-alt mr-2"></i> Sign Out
                            </a>
                        </div>
                    </div>
                </div>
                <div class="md:hidden">
                    <button id="menu-toggle" class="text-white focus:outline-none">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>
            </div>
            <!-- Mobile menu -->
            <div id="mobile-menu" class="hidden md:hidden mt-4 pb-4">
                <a href="dashboard.php" class="block py-2 hover:bg-blue-700 px-2 rounded font-semibold">Dashboard</a>
                <a href="news.php" class="block py-2 hover:bg-blue-700 px-2 rounded">News</a>
                <a href="report.php" class="block py-2 hover:bg-blue-700 px-2 rounded">Reports</a>
                <a href="stats.php" class="block py-2 hover:bg-blue-700 px-2 rounded">Statistics</a>
                <a href="auth/logout.php" class="block py-2 hover:bg-blue-700 px-2 rounded">Sign Out</a>
            </div>
        </div>
    </nav>

    <!-- Dashboard Content -->
    <main class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Welcome back, <?php echo htmlspecialchars($_SESSION['user_display_name']); ?>!</h1>
        </div>
        
        <!-- Dashboard Widgets -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <!-- Widget 1: Recent Activity -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-semibold">Recent Activity</h2>
                    <i class="fas fa-chart-line text-blue-600 text-xl"></i>
                </div>
                <div class="space-y-3">
                    <div class="flex items-start">
                        <div class="bg-blue-100 p-2 rounded-full mr-3">
                            <i class="fas fa-file-alt text-blue-600"></i>
                        </div>
                        <div>
                            <p class="font-medium">Provisional Estimates Released</p>
                            <p class="text-sm text-gray-500">2 hours ago</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="bg-green-100 p-2 rounded-full mr-3">
                            <i class="fas fa-check-circle text-green-600"></i>
                        </div>
                        <div>
                            <p class="font-medium">Quarterly GDP Data Updated</p>
                            <p class="text-sm text-gray-500">Yesterday</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Widget 2: Quick Actions -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-semibold">Quick Actions</h2>
                    <i class="fas fa-bolt text-yellow-500 text-xl"></i>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <a href="news.php" class="bg-blue-50 hover:bg-blue-100 p-3 rounded-lg text-center transition">
                        <i class="fas fa-newspaper text-blue-600 text-xl mb-2"></i>
                        <p class="text-sm font-medium">View News</p>
                    </a>
                    <a href="report.php" class="bg-green-50 hover:bg-green-100 p-3 rounded-lg text-center transition">
                        <i class="fas fa-file-export text-green-600 text-xl mb-2"></i>
                        <p class="text-sm font-medium">Download Reports</p>
                    </a>
                    <a href="stats.php" class="bg-purple-50 hover:bg-purple-100 p-3 rounded-lg text-center transition">
                        <i class="fas fa-chart-pie text-purple-600 text-xl mb-2"></i>
                        <p class="text-sm font-medium">View Statistics</p>
                    </a>
                    <a href="https://mospi.gov.in/" target="_blank" class="bg-red-50 hover:bg-red-100 p-3 rounded-lg text-center transition">
                        <i class="fas fa-globe-asia text-red-600 text-xl mb-2"></i>
                        <p class="text-sm font-medium">MoSPI Portal</p>
                    </a>
                </div>
            </div>
            
            <!-- Widget 3: Key Metrics -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-semibold">Key Metrics</h2>
                    <i class="fas fa-chart-bar text-indigo-600 text-xl"></i>
                </div>
                <div class="space-y-4">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">GDP Growth (2024-25 Q1, YoY)</p>
                        <div class="flex items-center">
                            <span class="text-lg font-bold mr-2">7.8%</span>
                            <span class="text-green-500 text-sm flex items-center">
                                <i class="fas fa-arrow-up mr-1"></i> +0.6%
                            </span>
                        </div>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">CPI Inflation (Mar 2025)</p>
                        <div class="flex items-center">
                            <span class="text-lg font-bold mr-2">5.1%</span>
                            <span class="text-red-500 text-sm flex items-center">
                                <i class="fas fa-arrow-up mr-1"></i> +0.2%
                            </span>
                        </div>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Fiscal Deficit (FY25, Apr-Feb)</p>
                        <div class="flex items-center">
                            <span class="text-lg font-bold mr-2">82.8% of BE</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Recent Reports Section -->
        <section class="mb-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-semibold text-gray-800">Recent Reports</h2>
                <a href="report.php" class="text-blue-600 hover:underline">View All</a>
            </div>
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="divide-y divide-gray-200">
                    <!-- Report 1 -->
                    <div class="p-4 hover:bg-gray-50 transition">
                        <div class="flex flex-col md:flex-row md:items-center gap-4">
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold mb-1">Provisional Estimates of National Income 2024-25</h3>
                                <p class="text-gray-600 text-sm">Released by MoSPI, Government of India</p>
                            </div>
                            <div class="text-right">
                                <span class="text-sm text-gray-500 block mb-2">May 31, 2025</span>
                                <a href="https://www.mospi.gov.in/sites/default/files/press_release/PressNoteGDP31052024.pdf" target="_blank" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Download</a>
                            </div>
                        </div>
                    </div>
                    <!-- Report 2 -->
                    <div class="p-4 hover:bg-gray-50 transition">
                        <div class="flex flex-col md:flex-row md:items-center gap-4">
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold mb-1">Quarterly GDP Release (Q1 2024-25)</h3>
                                <p class="text-gray-600 text-sm">Sector-wise GVA and Expenditure Components</p>
                            </div>
                            <div class="text-right">
                                <span class="text-sm text-gray-500 block mb-2">May 15, 2025</span>
                                <a href="https://www.mospi.gov.in/sites/default/files/press_release/PRESS-NOTE-ON-SAE-2024-25-Q3-2024-25-FRE-2023-24-and-FE-2022-23-M1.pdf" target="_blank" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Download</a>
                            </div>
                        </div>
                    </div>
                    <!-- Report 3 -->
                    <div class="p-4 hover:bg-gray-50 transition">
                        <div class="flex flex-col md:flex-row md:items-center gap-4">
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold mb-1">Monthly CPI Inflation Release (Mar 2025)</h3>
                                <p class="text-gray-600 text-sm">Consumer Price Index (CPI) for Urban & Rural</p>
                            </div>
                            <div class="text-right">
                                <span class="text-sm text-gray-500 block mb-2">Apr 12, 2025</span>
                                <a href="https://www.mospi.gov.in/sites/default/files/press_release/CPI_PR_15Apr25.pdf"target="_blank" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Download</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">Indian National Accounts</h3>
                    <p class="text-gray-400">Official economic data portal by the Ministry of Statistics and Programme Implementation (MoSPI), Government of India.</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="dashboard.php" class="text-gray-400 hover:text-white transition">Dashboard</a></li>
                        <li><a href="news.php" class="text-gray-400 hover:text-white transition">News</a></li>
                        <li><a href="report.php" class="text-gray-400 hover:text-white transition">Reports</a></li>
                        <li><a href="https://mospi.gov.in/"target="_blank" class="text-gray-400 hover:text-white transition">MoSPI Official Site</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Contact</h4>
                    <ul class="space-y-2">
                        <li class="text-gray-400"><i class="fas fa-envelope mr-2"></i> info@mospi.gov.in</li>
                        <li class="text-gray-400"><i class="fas fa-phone mr-2"></i> +91-11-2336 0889</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-6 text-center text-gray-400">
                <p>&copy; 2025 Indian National Accounts Dashboard. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        document.getElementById('menu-toggle').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>
</body>
</html>