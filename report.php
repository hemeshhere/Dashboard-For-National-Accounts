<?php
session_start();
require_once 'includes/auth_check.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $category = htmlspecialchars(trim($_POST['category']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['status'] = "Invalid email format";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }

    $to = "aayushshah12311@gmail.com"; 
    $subject = "📊 New Custom Report Request from $name";
    $body = "You have received a new report request.\n\n" .
            "Name: $name\n" .
            "Email: $email\n" .
            "Category: $category\n\n" .
            "Message:\n$message";

    $headers = "From: noreply@yourdomain.com\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    if (mail($to, $subject, $body, $headers)) {
        $_SESSION['status'] = "Your request has been submitted successfully! Our team will get back to you shortly.";
    } else {
        $_SESSION['status'] = "Failed to send email. Please try again later.";
        error_log("Failed to send email to: $to");
    }

    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Report - National Accounts</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <script>
    tailwind.config = {
      darkMode: 'class'
    }
  </script>
</head>
<body class="min-h-screen bg-gray-100 text-gray-900 dark:bg-gray-900 dark:text-white transition-colors duration-300">

  <nav class="bg-blue-800 text-white shadow-lg">
        <div class="container mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <i class="fas fa-landmark text-2xl"></i>
                    <span class="text-xl font-bold">National Accounts</span>
                </div>
                
                <div class="hidden md:flex items-center space-x-6">
                    <a href="dashboard.php" class="hover:text-blue-200 transition">Dashboard</a>
                    <a href="news.php" class="hover:text-blue-200 transition">News</a>
                    <a href="report.php" class="font-semibold border-b-2 border-white">Reports</a>
                    <a href="#" class="hover:text-blue-200 transition">Statistics</a>
                    
                    <!-- Profile Icon -->
                    <div class="profile-container relative">
                        <button id="profile-toggle" class="flex items-center space-x-2 hover:text-blue-200">
                            <div class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center">
                                <i class="fas fa-user text-white"></i>
                            </div>
                            <span class="hidden lg:inline"><?php echo htmlspecialchars($_SESSION['user_display_name']); ?></span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div id="profile-dropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10">
                            <div class="px-4 py-2 text-sm text-gray-700 border-b">
                                <p class="font-medium">Signed in as</p>
                                <p class="truncate"><?php echo htmlspecialchars($_SESSION['username']); ?></p>
                            </div>
                            <a href="account.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-user-circle mr-2"></i> Profile
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
                <a href="#" class="block py-2 hover:bg-blue-700 px-2 rounded">Statistics</a>
                <a href="auth/logout.php" class="block py-2 hover:bg-blue-700 px-2 rounded">Sign Out</a>
            </div>
        </div>
    </nav>

  <div class="max-w-6xl mx-auto p-6">

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-4 mb-6">
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
        <select id="categoryFilter" class="p-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600">
          <option value="all">All Categories</option>
          <option value="economy">Economy</option>
          <option value="population">Population</option>
          <option value="health">Health</option>
          <option value="education">Education</option>
          <option value="infrastructure">Infrastructure</option>
        </select>
        <select id="yearFilter" class="p-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600">
          <option value="all">All Years</option>
          <option value="2025">2025</option>
          <option value="2024">2024</option>
          <option value="2023">2023</option>
          <option value="2022">2022</option>
        </select>
        <input type="text" id="searchInput" placeholder="Search report..." class="p-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600">
      </div>
    </div>

    <div id="reportContainer" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <!-- Reports will be dynamically inserted here -->
    </div>

    <div class="max-w-7xl mx-auto mt-12 bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-xl border dark:border-gray-700">
      <h2 class="text-3xl font-bold mb-3 text-gray-900 dark:text-white">📩 Request a Custom Report</h2>
      <p class="text-sm text-gray-600 dark:text-gray-300 mb-6">
        Submit your request and we will review and prepare the report if available.
      </p> 
      
      <form id="requestForm" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Full Name</label>
          <input type="text" name="name" required class="mt-1 p-3 w-full border rounded-xl dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="e.g. Arjun Mehta" />
        </div>
        
        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Email Address</label>
          <input type="email" name="email" required class="mt-1 p-3 w-full border rounded-xl dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="e.g. arjun@data.gov.in" />
        </div>
        
        <div class="md:col-span-2">
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Select Report Category</label>
          <select name="category" required class="mt-1 p-3 w-full border rounded-xl dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            <option value="" disabled selected>Choose a category</option>
            <option>Economy & GDP</option>
            <option>Healthcare Services</option>
            <option>Education Statistics</option>
            <option>Infrastructure Projects</option>
            <option>Employment & Labour</option>
            <option>Environment & Climate</option>
            <option>Others</option>
          </select>
        </div>
    
        <div class="md:col-span-2">
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Report Description</label>
          <textarea name="message" rows="5" required class="mt-1 p-3 w-full border rounded-xl dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="Please describe the specific data, time period, or topic you're interested in..."></textarea>
        </div>
        
        <div class="md:col-span-2 flex justify-end">
          <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-3 rounded-xl transition">
            Submit Request
          </button>
        </div>
        
        <?php if (isset($_SESSION['status'])): ?>
            <p class="text-green-600 dark:text-green-400 md:col-span-2 mt-2">
              <?= htmlspecialchars($_SESSION['status']); unset($_SESSION['status']); ?>
            </p>
        <?php endif; ?>
      </form>
    </div>
  </div>

  <script>
    // Mobile menu toggle
    document.getElementById('menu-toggle').addEventListener('click', function() {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    });

    // Profile dropdown toggle
    document.getElementById('profile-toggle').addEventListener('click', function(e) {
        e.stopPropagation();
        document.getElementById('profile-dropdown').classList.toggle('hidden');
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function() {
        document.getElementById('profile-dropdown').classList.add('hidden');
    });

    const reports = [
        { title: "Union Budget 2025 Summary", category: "economy", year: 2025, link: "https://www.india.gov.in/spotlight/union-budget-2025-2026" },
        { title: "Indian Population Growth Trends", category: "population", year: 2024, link: "https://www.worldometers.info/world-population/india-population/" },
        { title: "National Health Report - AIIMS Analysis", category: "health", year: 2023, link: "https://aiimsbhubaneswar.nic.in/" },
        { title: "Digital Education Impact 2022", category: "education", year: 2022, link: "https://www.idreameducation.org/blog/digital-education-in-india-the-current-state/" },
        { title: "Smart Cities Infrastructure Report", category: "infrastructure", year: 2025, link: "https://smartcities.gov.in/" },
        { title: "State-wise GDP Growth", category: "economy", year: 2024, link: "https://statisticstimes.com/economy/india/indian-states-gdp-growth.php" },
        { title: "Health Facilities Access Index", category: "health", year: 2022, link: "https://www.healthdata.org/sites/default/files/files/county_profiles/HAQ/2018/India_HAQ_GBD2016.pdf" },
        { title: "School Dropout Rate Decline", category: "education", year: 2023, link: "https://www.indiatoday.in/diu/story/fewer-dropouts-but-lower-enrolment-ministry-of-education-udise-2658797-2025-01-02l" },
        { title: "Population Age Distribution", category: "population", year: 2025, link: "https://www.statista.com/statistics/271315/age-distribution-in-india/" },
        { title: "Metro Rail Development Review", category: "infrastructure", year: 2023, link: "https://prsindia.org/policy/report-summaries/implementation-of-metro-rail-projects-an-appraisal" }
    ];

    const reportContainer = document.getElementById("reportContainer");

    function renderReports(filteredReports) {
        reportContainer.innerHTML = "";
        
        if (filteredReports.length === 0) {
            reportContainer.innerHTML = `
                <div class="md:col-span-3 text-center py-8">
                    <p class="text-gray-500 dark:text-gray-400">No reports found matching your criteria</p>
                </div>
            `;
            return;
        }

        filteredReports.forEach(report => {
            const card = document.createElement("a");
            card.href = report.link;
            card.target = "_blank";
            card.className = "bg-white dark:bg-gray-800 p-4 rounded-xl shadow hover:shadow-lg transition block hover:ring-2 hover:ring-gray-500";
            card.innerHTML = `
                <h3 class="text-lg font-semibold mb-2">${report.title}</h3>
                <p class="text-sm text-gray-600 dark:text-gray-300">Category: ${report.category}</p>
                <p class="text-sm text-gray-600 dark:text-gray-300">Year: ${report.year}</p>
            `;
            reportContainer.appendChild(card);
        });
    }

    function filterReports() {
        const selectedCategory = document.getElementById("categoryFilter").value;
        const selectedYear = document.getElementById("yearFilter").value;
        const searchTerm = document.getElementById("searchInput").value.toLowerCase();

        const filtered = reports.filter(report => {
            return (selectedCategory === "all" || report.category === selectedCategory) &&
                   (selectedYear === "all" || report.year.toString() === selectedYear) &&
                   (report.title.toLowerCase().includes(searchTerm));
        });

        renderReports(filtered);
    }

    // Initialize filters
    document.getElementById("categoryFilter").addEventListener("change", filterReports);
    document.getElementById("yearFilter").addEventListener("change", filterReports);
    document.getElementById("searchInput").addEventListener("input", filterReports);

    // Initial render
    renderReports(reports);
  </script>
</body>
</html>