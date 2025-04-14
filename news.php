<?php
require_once 'includes/auth_check.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News - National Accounts</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .news-slider {
            scroll-behavior: smooth;
        }
        .news-slider::-webkit-scrollbar {
            display: none;
        }
        .profile-dropdown {
            display: none;
        }
        .profile-container:hover .profile-dropdown {
            display: block;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-blue-800 text-white shadow-lg">
        <div class="container mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <i class="fas fa-landmark text-2xl"></i>
                    <span class="text-xl font-bold">National Accounts</span>
                </div>
                
                <div class="hidden md:flex items-center space-x-6">
                    <a href="dashboard.php" class="hover:text-blue-200 transition">Dashboard</a>
                    <a href="news.php" class="font-semibold border-b-2 border-white">News</a>
                    <a href="report.php" class="hover:text-blue-200 transition">Reports</a>
                    <a href="#" class="hover:text-blue-200 transition">Statistics</a>
                    
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
                <a href="dashboard.php" class="block py-2 hover:bg-blue-700 px-2 rounded">Dashboard</a>
                <a href="news.php" class="block py-2 hover:bg-blue-700 px-2 rounded font-semibold">News</a>
                <a href="#" class="block py-2 hover:bg-blue-700 px-2 rounded">Reports</a>
                <a href="#" class="block py-2 hover:bg-blue-700 px-2 rounded">Statistics</a>
                <a href="auth/logout.php" class="block py-2 hover:bg-blue-700 px-2 rounded">Sign Out</a>
            </div>
        </div>
    </nav>

    <main class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Latest News & Updates</h1>
        
        <!-- Trending News Section with Slider -->
        <section class="mb-12">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-semibold text-gray-800">Trending News</h2>
                <a href="#" class="text-blue-600 hover:underline">View All</a>
            </div>
            
            <div class="relative">
                <!-- Slider arrows -->
                <button id="prev-slide" class="absolute left-0 top-1/2 -translate-y-1/2 z-10 bg-white rounded-full p-2 shadow-md hover:bg-gray-100 transition -ml-4">
                    <i class="fas fa-chevron-left text-gray-700"></i>
                </button>
                <button id="next-slide" class="absolute right-0 top-1/2 -translate-y-1/2 z-10 bg-white rounded-full p-2 shadow-md hover:bg-gray-100 transition -mr-4">
                    <i class="fas fa-chevron-right text-gray-700"></i>
                </button>
                
                <!-- News slider container with pre-filled content -->
                <div id="news-slider" class="news-slider flex overflow-x-auto snap-x snap-mandatory gap-6 pb-4 scrollbar-hide">
                    <!-- Trending News 1 -->
                    <div class="flex-shrink-0 w-full md:w-2/3 lg:w-1/2 xl:w-1/3 snap-start">
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition mx-2 h-full">
                            <img src="https://images.unsplash.com/photo-1450101499163-c8848c66ca85?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Economy growth" class="w-full h-48 object-cover">
                            <div class="p-6">
                                <h3 class="text-xl font-semibold mb-2">National GDP Growth Exceeds Expectations</h3>
                                <p class="text-gray-600 mb-4">The latest economic reports show GDP growth of 3.2% this quarter, surpassing analyst predictions and indicating strong economic recovery.</p>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500">Jan 15, 2025</span>
                                    <a href="#" class="text-blue-600 hover:text-blue-800 font-medium">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Trending News 2 -->
                    <div class="flex-shrink-0 w-full md:w-2/3 lg:w-1/2 xl:w-1/3 snap-start">
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition mx-2 h-full">
                            <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Tax reform" class="w-full h-48 object-cover">
                            <div class="p-6">
                                <h3 class="text-xl font-semibold mb-2">New Tax Reform Bill Proposed</h3>
                                <p class="text-gray-600 mb-4">The finance minister has introduced a comprehensive tax reform package aimed at simplifying the system and reducing burdens on middle-class families.</p>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500">Feb 12, 2025</span>
                                    <a href="#" class="text-blue-600 hover:text-blue-800 font-medium">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Trending News 3 -->
                    <div class="flex-shrink-0 w-full md:w-2/3 lg:w-1/2 xl:w-1/3 snap-start">
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition mx-2 h-full">
                            <img src="https://images.unsplash.com/photo-1604594849809-dfedbc827105?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Stock market" class="w-full h-48 object-cover">
                            <div class="p-6">
                                <h3 class="text-xl font-semibold mb-2">Stock Market Hits Record High</h3>
                                <p class="text-gray-600 mb-4">The national stock index reached an all-time high today, driven by strong performances in the technology and manufacturing sectors.</p>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500">Dec 10, 2024</span>
                                    <a href="#" class="text-blue-600 hover:text-blue-800 font-medium">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Trending News 4 -->
                    <div class="flex-shrink-0 w-full md:w-2/3 lg:w-1/2 xl:w-1/3 snap-start">
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition mx-2 h-full">
                            <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Employment" class="w-full h-48 object-cover">
                            <div class="p-6">
                                <h3 class="text-xl font-semibold mb-2">Unemployment Rate Drops to 4.2%</h3>
                                <p class="text-gray-600 mb-4">The latest employment figures show unemployment has fallen to its lowest level in a decade, with significant gains in the service sector.</p>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500">Mar 8, 2025</span>
                                    <a href="#" class="text-blue-600 hover:text-blue-800 font-medium">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Government Policies Section -->
        <section class="mb-12">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-semibold text-gray-800">Government Policies</h2>
                <a href="#" class="text-blue-600 hover:underline">View All</a>
            </div>
            
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="divide-y divide-gray-200">
                    <!-- Policy News 1 -->
                    <div class="p-4 hover:bg-gray-50 transition">
                        <div class="flex flex-col md:flex-row md:items-center gap-4">
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold mb-1">New Infrastructure Investment Plan</h3>
                                <p class="text-gray-600 text-sm">The government has announced a $1.2 trillion infrastructure plan focusing on roads, bridges, and broadband expansion across rural areas.</p>
                            </div>
                            <div class="text-right">
                                <span class="text-sm text-gray-500 block mb-2">Dec 14, 2024</span>
                                <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Read More</a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Policy News 2 -->
                    <div class="p-4 hover:bg-gray-50 transition">
                        <div class="flex flex-col md:flex-row md:items-center gap-4">
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold mb-1">Climate Change Action Bill Passed</h3>
                                <p class="text-gray-600 text-sm">Parliament has approved sweeping legislation to reduce carbon emissions by 50% by 2030, with incentives for renewable energy adoption.</p>
                            </div>
                            <div class="text-right">
                                <span class="text-sm text-gray-500 block mb-2">Jan 1, 2025</span>
                                <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Read More</a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Policy News 3 -->
                    <div class="p-4 hover:bg-gray-50 transition">
                        <div class="flex flex-col md:flex-row md:items-center gap-4">
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold mb-1">Healthcare Reform Package Introduced</h3>
                                <p class="text-gray-600 text-sm">A new healthcare proposal aims to lower prescription drug costs and expand coverage to an additional 5 million citizens.</p>
                            </div>
                            <div class="text-right">
                                <span class="text-sm text-gray-500 block mb-2">Oct 7, 2024</span>
                                <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Read More</a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Policy News 4 -->
                    <div class="p-4 hover:bg-gray-50 transition">
                        <div class="flex flex-col md:flex-row md:items-center gap-4">
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold mb-1">Education Funding Increase Approved</h3>
                                <p class="text-gray-600 text-sm">The education budget will increase by 15% next year, with focus on teacher salaries and STEM programs in underserved communities.</p>
                            </div>
                            <div class="text-right">
                                <span class="text-sm text-gray-500 block mb-2">Mar 5, 2025</span>
                                <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Global Business News Section -->
        <section>
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-semibold text-gray-800">Global Business News</h2>
                <a href="#" class="text-blue-600 hover:underline">View All</a>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Global News 1 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-2">European Central Bank Raises Interest Rates</h3>
                        <p class="text-gray-600 mb-4 text-sm">The ECB has increased rates by 0.5% to combat inflation, causing mixed reactions in financial markets across the continent.</p>
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-gray-500">Feb 13, 2025</span>
                            <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Read More</a>
                        </div>
                    </div>
                </div>
                
                <!-- Global News 2 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-2">Asian Markets Rally on Trade Deal News</h3>
                        <p class="text-gray-600 mb-4 text-sm">Major Asian indices gained 2-3% after reports of progress in regional trade negotiations between several Pacific nations.</p>
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-gray-500">Feb 19, 2025</span>
                            <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Read More</a>
                        </div>
                    </div>
                </div>
                
                <!-- Global News 3 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-2">African Free Trade Zone Sees Record Growth</h3>
                        <p class="text-gray-600 mb-4 text-sm">The African Continental Free Trade Area reports 34% increase in intra-African trade volumes in Q1 2025.</p>
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-gray-500">Mar 13, 2025</span>
                            <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Read More</a>
                        </div>
                    </div>
                </div>
                
                <!-- Global News 4 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-2">Latin American Economies Show Resilience</h3>
                        <p class="text-gray-600 mb-4 text-sm">Despite global challenges, several Latin American countries are reporting stronger-than-expected economic performance this quarter.</p>
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-gray-500">Mar 24, 2025</span>
                            <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- Footer remains the same -->
    <footer class="bg-gray-800 text-white py-8">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">National Accounts</h3>
                    <p class="text-gray-400">Official economic data and news portal.</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="dashboard.php" class="text-gray-400 hover:text-white transition">Dashboard</a></li>
                        <li><a href="news.php" class="text-gray-400 hover:text-white transition">News</a></li>
                        <li><a href="report.php" class="text-gray-400 hover:text-white transition">Reports</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Contact</h4>
                    <ul class="space-y-2">
                        <li class="text-gray-400"><i class="fas fa-envelope mr-2"></i> contact@nationalaccounts.gov</li>
                        <li class="text-gray-400"><i class="fas fa-phone mr-2"></i> +91 9890000011</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-6 text-center text-gray-400">
                <p>&copy; 2025 National Accounts Dashboard. All rights reserved.</p>
            </div>
        </div>
    </footer>
    <script>
        // Mobile menu toggle
        document.getElementById('menu-toggle').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });

        // News slider functionality (same as before)
        const slider = document.getElementById('news-slider');
        const prevBtn = document.getElementById('prev-slide');
        const nextBtn = document.getElementById('next-slide');
        const newsCards = document.querySelectorAll('#news-slider > div');
        let currentIndex = 0;
        let cardWidth = newsCards[0]?.offsetWidth + 24;

        function updateSliderPosition() {
            slider.scrollTo({
                left: currentIndex * cardWidth,
                behavior: 'smooth'
            });
        }

        nextBtn.addEventListener('click', () => {
            if (currentIndex < newsCards.length - 1) {
                currentIndex++;
                updateSliderPosition();
            }
        });

        prevBtn.addEventListener('click', () => {
            if (currentIndex > 0) {
                currentIndex--;
                updateSliderPosition();
            }
        });

        window.addEventListener('resize', () => {
            cardWidth = newsCards[0]?.offsetWidth + 24;
            updateSliderPosition();
        });
    </script>
</body>
</html>