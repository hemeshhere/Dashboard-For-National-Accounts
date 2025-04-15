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
                    <span class="text-xl font-bold">Indian National Accounts</span>
                </div>
                
                <div class="hidden md:flex items-center space-x-6">
                    <a href="dashboard.php" class="hover:text-blue-200 transition">Dashboard</a>
                    <a href="news.php" class="font-semibold border-b-2 border-white">News</a>
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
                <a href="dashboard.php" class="block py-2 hover:bg-blue-700 px-2 rounded">Dashboard</a>
                <a href="news.php" class="block py-2 hover:bg-blue-700 px-2 rounded font-semibold">News</a>
                <a href="report.php" class="block py-2 hover:bg-blue-700 px-2 rounded">Reports</a>
                <a href="stats.php" class="block py-2 hover:bg-blue-700 px-2 rounded">Statistics</a>
                <a href="auth/logout.php" class="block py-2 hover:bg-blue-700 px-2 rounded">Sign Out</a>
            </div>
        </div>
    </nav>

    <main class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Latest News & Updates from MoSPI</h1>
        
        <!-- Trending News Section with Slider -->
        <section class="mb-12">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-semibold text-gray-800">Trending Indian Economic News</h2>
                <a href="https://economictimes.indiatimes.com/news/economy?from=mdr" class="text-blue-600 hover:underline">View All</a>
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
                    <!-- Trending News 1: Indian GDP -->
<div class="flex-shrink-0 w-full md:w-2/3 lg:w-1/2 xl:w-1/3 snap-start">
    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition mx-2 h-full">
        <img src="https://akm-img-a-in.tosshub.com/businesstoday/images/story/202408/66d1b6d45ddaa-india-q1-gdp-growth-preview-304215469-16x9.jpg?size=948:533" alt="India GDP" class="w-full h-48 object-cover">
        <div class="p-6">
            <h3 class="text-xl font-semibold mb-2">India's GDP Growth at 7.8% in Q1 2024-25</h3>
            <p class="text-gray-600 mb-4">MoSPI releases provisional estimates showing robust GDP growth driven by services and manufacturing sectors.</p>
            <div class="flex items-center justify-between">
                <span class="text-sm text-gray-500">May 31, 2025</span>
                <a href="https://www.businesstoday.in/latest/economy/story/india-gdp-growth-economy-grew-at-at-67-in-the-april-june-quarter-in-fy25-lower-than-78-in-fy24-443724-2024-08-30" target="_blank" class="text-blue-600 hover:text-blue-800 font-medium">Read More</a>
            </div>
        </div>
    </div>
</div>
                    
                    <!-- Trending News 2: CPI Inflation -->
<div class="flex-shrink-0 w-full md:w-2/3 lg:w-1/2 xl:w-1/3 snap-start">
    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition mx-2 h-full">
        <img src="https://www.hindustantimes.com/ht-img/img/2024/03/12/550x309/Retail-prices-in-pulses-increased-5-28--in-April--_1685733970454_1710274750496.jpg" alt="CPI Inflation" class="w-full h-48 object-cover">
        <div class="p-6">
            <h3 class="text-xl font-semibold mb-2">CPI Inflation Remains Stable at 5.1% (Mar 2025)</h3>
            <p class="text-gray-600 mb-4">Consumer Price Index data released by MoSPI shows inflation is within RBI's target range for the third consecutive month.</p>
            <div class="flex items-center justify-between">
                <span class="text-sm text-gray-500">Apr 12, 2025</span>
                <a href="https://www.hindustantimes.com/india-news/inflation-stays-flat-at-5-09-in-february-101710271772579.html" target="_blank" class="text-blue-600 hover:text-blue-800 font-medium">Read More</a>
            </div>
        </div>
    </div>
</div>
                    
                    <!-- Trending News 3: Fiscal Deficit -->
<div class="flex-shrink-0 w-full md:w-2/3 lg:w-1/2 xl:w-1/3 snap-start">
    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition mx-2 h-full">
        <img src="https://www.livemint.com/lm-img/img/2024/03/28/600x338/g0ee171de9e07326816b4ab86404a5c06bfc360e3459e5f2daae9a8216473f716823174ece05ec1616b9f95cffb5fae2ba04a0be7a358a3490dde5afa226486ed_1280_1711627390249_1711627402462.jpg" alt="Fiscal Deficit" class="w-full h-48 object-cover">
        <div class="p-6">
            <h3 class="text-xl font-semibold mb-2">Fiscal Deficit at 82.8% of BE (Apr-Feb FY25)</h3>
            <p class="text-gray-600 mb-4">The Controller General of Accounts reports fiscal deficit at 82.8% of Budget Estimate for the current fiscal year.</p>
            <div class="flex items-center justify-between">
                <span class="text-sm text-gray-500">Mar 31, 2025</span>
                <a href="https://www.livemint.com/economy/aprfeb-fiscal-deficit-at-15-trillion-86-5-of-fy24-target-11711626884147.html" target="_blank" class="text-blue-600 hover:text-blue-800 font-medium">Read More</a>
            </div>
        </div>
    </div>
</div>
                    
                    <!-- Trending News 4: Unemployment Rate -->
<div class="flex-shrink-0 w-full md:w-2/3 lg:w-1/2 xl:w-1/3 snap-start">
    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition mx-2 h-full">
        <img src="https://bsmedia.business-standard.com/_media/bs/img/article/2022-07/03/full/1656867405-8526.jpg?im=FeatureCrop,size=(826,465)" alt="Employment India" class="w-full h-48 object-cover">
        <div class="p-6">
            <h3 class="text-xl font-semibold mb-2">Unemployment Rate Falls to 6.8% (Mar 2025)</h3>
            <p class="text-gray-600 mb-4">CMIE data shows India's unemployment rate declined in March, with job gains in rural and urban sectors.</p>
            <div class="flex items-center justify-between">
                <span class="text-sm text-gray-500">Mar 31, 2025</span>
                <a href="https://www.business-standard.com/economy/news/india-s-urban-jobless-rate-declined-further-to-6-8-in-q4-nso-survey-123052900991_1.html" target="_blank" class="text-blue-600 hover:text-blue-800 font-medium">Read More</a>
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
                <h2 class="text-2xl font-semibold text-gray-800">Recent Policy Announcements</h2>
                <a href="https://dge.gov.in/dge/schemes_programmes" class="text-blue-600 hover:underline">View All</a>
            </div>
            
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="divide-y divide-gray-200">
                    <!-- Policy News 1 -->
                    <div class="p-4 hover:bg-gray-50 transition">
                        <div class="flex flex-col md:flex-row md:items-center gap-4">
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold mb-1">PM Gati Shakti Master Plan Launched</h3>
<p class="text-gray-600 text-sm">The Government of India launches the PM Gati Shakti National Master Plan to boost multi-modal connectivity and infrastructure development.</p>
                            </div>
                            <div class="text-right">
                                <span class="text-sm text-gray-500 block mb-2">Dec 14, 2024</span>
                                <a href="https://ne.pmgatishakti.gov.in/DoNER/about_pmgati" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Read More</a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Policy News 2 -->
                    <div class="p-4 hover:bg-gray-50 transition">
                        <div class="flex flex-col md:flex-row md:items-center gap-4">
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold mb-1">Union Budget 2025-26 Presented</h3>
<p class="text-gray-600 text-sm">The Finance Minister presents the Union Budget, focusing on capital expenditure, rural development, and digital economy initiatives.</p>
                            </div>
                            <div class="text-right">
                                <span class="text-sm text-gray-500 block mb-2">Jan 1, 2025</span>
                                <a href="https://www.india.gov.in/spotlight/union-budget-2025-2026#:~:text=%2D%20the%20Finance%20Minister%20presented%20the,cent%20good%20quality%20school%20education" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Read More</a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Policy News 3 -->
                    <div class="p-4 hover:bg-gray-50 transition">
                        <div class="flex flex-col md:flex-row md:items-center gap-4">
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold mb-1">PLI Scheme Extended to New Sectors</h3>
<p class="text-gray-600 text-sm">The Production-Linked Incentive (PLI) scheme is extended to additional sectors to boost manufacturing and exports.</p>
                            </div>
                            <div class="text-right">
                                <span class="text-sm text-gray-500 block mb-2">Oct 7, 2024</span>
                                <a href="https://pib.gov.in/PressReleasePage.aspx?PRID=2114011" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Read More</a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Policy News 4 -->
                    <div class="p-4 hover:bg-gray-50 transition">
                        <div class="flex flex-col md:flex-row md:items-center gap-4">
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold mb-1">National Education Policy (NEP) Implementation Update</h3>
<p class="text-gray-600 text-sm">MoE provides an update on NEP 2020 implementation, with focus on digital learning and skill development.</p>
                            </div>
                            <div class="text-right">
                                <span class="text-sm text-gray-500 block mb-2">Mar 5, 2025</span>
                                <a href="https://www.education.gov.in/nep/about-nep" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Read More</a>
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
                <a href="https://www.cnbc.com/world/" class="text-blue-600 hover:underline">View All</a>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Global News 1 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-2">European Central Bank Raises Interest Rates</h3>
                        <p class="text-gray-600 mb-4 text-sm">The ECB has increased rates by 0.5% to combat inflation, causing mixed reactions in financial markets across the continent.</p>
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-gray-500">Feb 13, 2025</span>
                            <a href="https://www.ecb.europa.eu/press/pr/date/2025/html/ecb.mp250306~d4340800b3.en.html" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Read More</a>
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
                            <a href="https://timesofindia.indiatimes.com/business/international-business/asian-markets-rally-as-they-adjust-to-temporary-us-tariff-relief-by-donald-trump/articleshow/120301768.cms" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Read More</a>
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
                            <a href="https://unctad.org/es/isar/news/africas-free-trade-area-can-deliver-considerable-inclusive-economic-growth-continent" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Read More</a>
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
                            <a href="https://credendo.com/en/knowledge-hub/brazil-largest-latin-american-economy-displays-remarkable-resilience-amid-headwinds#:~:text=Largest%20Latin%20American%20economy%20displays%20resilience%20amid%20headwinds,surpassing%20its%20own%20historical%20performance." class="text-blue-600 hover:text-blue-800 text-sm font-medium">Read More</a>
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
                    <h3 class="text-xl font-bold mb-4">Indian National Accounts</h3>
<p class="text-gray-400">Official economic data and news portal by the Ministry of Statistics and Programme Implementation (MoSPI), Government of India.</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Quick Links</h4>
<ul class="space-y-2">
    <li><a href="dashboard.php" class="text-gray-400 hover:text-white transition">Dashboard</a></li>
    <li><a href="news.php" class="text-gray-400 hover:text-white transition">News</a></li>
    <li><a href="report.php" class="text-gray-400 hover:text-white transition">Reports</a></li>
    <li><a href="https://mospi.gov.in/" target="_blank" class="text-gray-400 hover:text-white transition">MoSPI Official Site</a></li>
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