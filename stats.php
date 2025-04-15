<?php
require_once 'includes/auth_check.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistics - National Accounts</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .profile-dropdown { display: none; }
        .profile-container:hover .profile-dropdown { display: block; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">
    <!-- Navbar -->
    <nav class="bg-blue-800 text-white shadow-lg">
        <div class="container mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <i class="fas fa-landmark text-2xl"></i>
                    <span class="text-xl font-bold">National Accounts</span>
                </div>
                <div class="hidden md:flex items-center space-x-6">
                    <a href="dashboard.php" class="font-semibold hover:text-blue-200 transition">Dashboard</a>
                    <a href="news.php" class="hover:text-blue-200 transition">News</a>
                    <a href="report.php" class="hover:text-blue-200 transition">Reports</a>
                    <a href="stats.php" class="border-b-2 border-white font-semibold">Statistics</a>
                    <!-- Profile Icon -->
                    <div class="profile-container relative">
                        <button class="flex items-center space-x-2 hover:text-blue-200">
                            <div class="w-8 h-8 rounded-full bg-blue-300 flex items-center justify-center">
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
                <a href="stats.php" class="block py-2 hover:bg-blue-700 px-2 rounded font-semibold">Statistics</a>
                <a href="auth/logout.php" class="block py-2 hover:bg-blue-700 px-2 rounded">Sign Out</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="flex-1 p-8 overflow-y-auto">
        <!-- Header -->
        <header class="flex justify-between items-center mb-8 animate-fadeIn">
            <h1 class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-300">Statistics Overview</h1>
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <input type="text" id="searchInput" placeholder="Search..." class="pl-10 pr-4 py-2 rounded-full bg-white border-none text-gray-800 focus:ring-2 focus:ring-blue-500" onkeyup="searchDashboard()">
                    <svg class="w-5 h-5 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"></path></svg>
                </div>
            </div>
        </header>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 rounded-xl shadow-lg hover-scale animate-fadeIn ">
                <h3 class="text-gray-300 text-sm font-medium">Total Revenue</h3>
                <p class="text-3xl font-bold text-blue-400">$1,234,567</p>
                <p class="text-green-400 text-sm">+12% from last month</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-lg hover-scale animate-fadeIn ">
                <h3 class="text-gray-300 text-sm font-medium">Active Accounts</h3>
                <p class="text-3xl font-bold text-purple-400">1,482</p>
                <p class="text-green-400 text-sm">+8% from last month</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-lg hover-scale animate-fadeIn ">
                <h3 class="text-gray-300 text-sm font-medium">Pending Actions</h3>
                <p class="text-3xl font-bold text-yellow-400">23</p>
                <p class="text-red-400 text-sm">+3 from yesterday</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-lg hover-scale animate-fadeIn ">
                <h3 class="text-gray-300 text-sm font-medium">Overdue Payments</h3>
                <p class="text-3xl font-bold text-red-400">$45,000</p>
                <p class="text-red-400 text-sm">+5% from last week</p>
            </div>
        </div>

        <!-- Quick Actions, KPIs, and Top Accounts -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-xl shadow-lg animate-fadeIn ">
                <h3 class="text-xl font-semibold mb-4 text-blue-300">Quick Actions</h3>
                <div class="space-y-3">
                    <button class="w-full bg-blue-300 text-gray-800 py-2 rounded-lg hover:bg-blue-700 hover-scale">New Account</button>
                    <button class="w-full bg-green-300 text-gray-800 py-2 rounded-lg hover:bg-green-700 hover-scale">Process Payment</button>
                    <button class="w-full bg-purple-300 text-gray-800 py-2 rounded-lg hover:bg-purple-700 hover-scale">Generate Report</button>
                    <button class="w-full bg-yellow-300 text-gray-800 py-2 rounded-lg hover:bg-yellow-700 hover-scale">Send Reminder</button>
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-lg animate-fadeIn ">
                <h3 class="text-xl font-semibold mb-4 text-purple-300">Key Performance Indicators</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-300 text-sm">Customer Satisfaction</p>
                        <p class="text-2xl font-bold text-green-400">92%</p>
                    </div>
                    <div>
                        <p class="text-gray-300 text-sm">Retention Rate</p>
                        <p class="text-2xl font-bold text-green-400">87%</p>
                    </div>
                    <div>
                        <p class="text-gray-300 text-sm">Avg. Response Time</p>
                        <p class="text-2xl font-bold text-yellow-400">2.3h</p>
                    </div>
                    <div>
                        <p class="text-gray-300 text-sm">Compliance Rate</p>
                        <p class="text-2xl font-bold text-green-400">98%</p>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-lg animate-fadeIn ">
                <h3 class="text-xl font-semibold mb-4 text-yellow-300">Top Accounts</h3>
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-gray-400">
                            <th class="text-left">Account</th>
                            <th class="text-right">Revenue</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="hover:text-blue-400">
                            <td>Acme Corp</td>
                            <td class="text-right">$250,000</td>
                        </tr>
                        <tr class="hover:text-blue-400">
                            <td>Globex Inc</td>
                            <td class="text-right">$180,000</td>
                        </tr>
                        <tr class="hover:text-blue-400">
                            <td>Soylent Co</td>
                            <td class="text-right">$150,000</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Charts and Task Manager -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <div class="bg-white p-6 rounded-xl shadow-lg animate-fadeIn ">
                <h3 class="text-xl font-semibold mb-4 text-blue-300">Revenue Trend</h3>
                <canvas id="revenueChart"></canvas>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-lg animate-fadeIn ">
                <h3 class="text-xl font-semibold mb-4 text-purple-300">Task Manager</h3>
                <ul class="space-y-4">
                    <li class="flex items-center hover:text-blue-400">
                        <input type="checkbox" class="mr-2 accent-blue-500">
                        <span>Follow up with Acme Corp</span>
                        <span class="ml-auto text-gray-400 text-sm">Due: Mar 27</span>
                    </li>
                    <li class="flex items-center hover:text-blue-400">
                        <input type="checkbox" class="mr-2 accent-blue-500">
                        <span>Review contract #789</span>
                        <span class="ml-auto text-gray-400 text-sm">Due: Mar 30</span>
                    </li>
                    <li class="flex items-center hover:text-blue-400">
                        <input type="checkbox" class="mr-2 accent-blue-500">
                        <span>Update payment terms</span>
                        <span class="ml-auto text-gray-400 text-sm">Due: Apr 1</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Alerts, Calendar, and Team Performance -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-xl shadow-lg animate-fadeIn " id="alertsSection">
                <h3 class="text-xl font-semibold mb-4 text-red-300">Alerts</h3>
                <ul class="space-y-4" id="alertsList">
                    <li class="flex items-center text-red-400 alert-item" data-text="Overdue payment - Account #45678">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v4a1 1 0 002 0V7zm-1 8a1 1 0 100-2 1 1 0 000 2z"></path></svg>
                        <span>Overdue payment - Account #45678</span>
                    </li>
                    <li class="flex items-center text-yellow-400 alert-item" data-text="Review required - Account #12345">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v4a1 1 0 002 0V7zm-1 8a1 1 0 100-2 1 1 0 000 2z"></path></svg>
                        <span>Review required - Account #12345</span>
                    </li>
                </ul>
                <p id="noAlerts" class="text-gray-400 hidden">No alerts found.</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-lg animate-fadeIn ">
                <h3 class="text-xl font-semibold mb-4 text-blue-300">Upcoming Events</h3>
                <ul class="space-y-4">
                    <li class="flex items-center hover:text-blue-400">
                        <div class="w-2 h-2 bg-blue-500 rounded-full mr-2"></div>
                        <span>Quarterly Review - Mar 28</span>
                    </li>
                    <li class="flex items-center hover:text-blue-400">
                        <div class="w-2 h-2 bg-blue-500 rounded-full mr-2"></div>
                        <span>Tax Filing Deadline - Apr 15</span>
                    </li>
                    <li class="flex items-center hover:text-blue-400">
                        <div class="w-2 h-2 bg-blue-500 rounded-full mr-2"></div>
                        <span>Team Meeting - Apr 3</span>
                    </li>
                </ul>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-lg animate-fadeIn ">
                <h3 class="text-xl font-semibold mb-4 text-green-300">Team Performance</h3>
                <ul class="space-y-4">
                    <li class="flex items-center">
                        <span class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center mr-2">JD</span>
                        <span>John Doe - 95%</span>
                    </li>
                    <li class="flex items-center">
                        <span class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center mr-2">AS</span>
                        <span>Alice Smith - 88%</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white p-6 rounded-xl shadow-lg mt-8 animate-fadeIn " id="activitySection">
            <h3 class="text-xl font-semibold mb-4 text-yellow-300">Recent Activity</h3>
            <ul class="space-y-4" id="activityList">
                <li class="flex items-center activity-item hover:text-blue-400" data-text="New account created - Account #12345">
                    <div class="w-2 h-2 bg-blue-500 rounded-full mr-2"></div>
                    <span>New account created - Account #12345</span>
                    <span class="ml-auto text-gray-400 text-sm">2h ago</span>
                </li>
                <li class="flex items-center activity-item hover:text-blue-400" data-text="Payment received - $45,000">
                    <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                    <span>Payment received - $45,000</span>
                    <span class="ml-auto text-gray-400 text-sm">4h ago</span>
                </li>
                <li class="flex items-center activity-item hover:text-blue-400" data-text="Action required - Account #67890">
                    <div class="w-2 h-2 bg-yellow-500 rounded-full mr-2"></div>
                    <span>Action required - Account #67890</span>
                    <span class="ml-auto text-gray-400 text-sm">1d ago</span>
                </li>
            </ul>
            <p id="noActivity" class="text-gray-400 hidden">No activity found.</p>
        </div>
    </div>

    <script>
        // Mobile menu toggle
        document.getElementById('menu-toggle').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });

        // Revenue Chart
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        new Chart(revenueCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Revenue',
                    data: [120000, 190000, 150000, 230000, 200000, 250000],
                    borderColor: 'rgb(59, 130, 246)',
                    backgroundColor: 'rgba(59, 130, 246, 0.2)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { color: '#374151', callback: value => '$' + value.toLocaleString() },
                        grid: { color: 'rgba(55, 65, 81, 0.1)' }
                    },
                    x: { ticks: { color: '#374151' }, grid: { color: 'rgba(55, 65, 81, 0.1)' } }
                },
                plugins: { legend: { labels: { color: '#374151' } } }
            }
        });

        // Search Functionality
        function searchDashboard() {
            const input = document.getElementById('searchInput').value.toLowerCase();
            const activityItems = document.querySelectorAll('.activity-item');
            const alertItems = document.querySelectorAll('.alert-item');
            const noActivityMsg = document.getElementById('noActivity');
            const noAlertsMsg = document.getElementById('noAlerts');

            let activityVisible = 0;
            let alertsVisible = 0;

            activityItems.forEach(item => {
                const text = item.getAttribute('data-text').toLowerCase();
                if (text.includes(input)) {
                    item.style.display = 'flex';
                    activityVisible++;
                } else {
                    item.style.display = 'none';
                }
            });

            alertItems.forEach(item => {
                const text = item.getAttribute('data-text').toLowerCase();
                if (text.includes(input)) {
                    item.style.display = 'flex';
                    alertsVisible++;
                } else {
                    item.style.display = 'none';
                }
            });

            noActivityMsg.style.display = activityVisible === 0 && input !== '' ? 'block' : 'none';
            noAlertsMsg.style.display = alertsVisible === 0 && input !== '' ? 'block' : 'none';
        }
    </script>
</body>
</html>