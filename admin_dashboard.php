<?php
require_once 'config.php';
if (!isset($_SESSION['admin_loggedin']) || !$_SESSION['admin_loggedin']) {
    header('Location: auth/login.php?admin=1');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - National Accounts</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-blue-100 via-blue-50 to-white min-h-screen">
    <nav class="bg-red-800 text-white px-6 py-4 flex items-center justify-between shadow-lg">
        <div class="flex items-center space-x-3">
            <i class="fas fa-user-shield text-2xl"></i>
            <span class="font-bold text-xl">Admin Dashboard</span>
        </div>
        <div class="flex items-center space-x-6">
            <span class="hidden md:inline">Welcome, <?php echo htmlspecialchars($_SESSION['admin_display_name']); ?></span>
            <a href="auth/logout.php" class="hover:underline">Logout</a>
        </div>
    </nav>
    <div class="min-h-[80vh]">
    <main class="p-8 bg-white">
        <!-- User Management Section -->
            <section id="users" class="mb-12">
<?php if (isset($_GET['msg'])): ?>
    <div class="bg-green-100 text-green-700 p-3 rounded mb-4"><?php echo htmlspecialchars($_GET['msg']); ?></div>
<?php endif; ?>
<!-- Add User Form -->
<div class="flex items-center justify-between mb-4">
    <h2 class="text-2xl font-bold"><i class="fas fa-users mr-2"></i>User Management</h2>
    <div class="flex gap-3">
        <button id="show-create-admin" type="button" class="inline-flex items-center px-4 py-2 bg-red-700 text-white rounded-lg font-semibold hover:bg-blue-800 transition"><i class="fas fa-user-shield mr-2"></i>Create Admin</button>
        <button id="show-add-user" type="button" class="inline-flex items-center px-4 py-2 bg-red-700 text-white rounded-lg font-semibold hover:bg-blue-800 transition"><i class="fas fa-user-plus mr-1"></i>Add User</button>
    </div>
</div>
<!-- Add User Form (collapsible) -->
<div id="add-user-form-wrapper" class="overflow-hidden transition-all duration-300 max-h-0 mb-6">
    <form id="add-user-form" method="POST" action="user_actions.php" class="flex flex-row gap-4 bg-blue-50 p-4 rounded-lg max-w-3xl w-full mx-auto items-center justify-center flex-wrap">
        <input type="hidden" name="action" value="add">
        <div class="flex flex-col items-center">
            <label class="block text-xs font-semibold mb-1 text-center">Username</label>
            <input type="text" name="username" required class="border px-2 py-1 rounded w-32">
        </div>
        <div class="flex flex-col items-center">
            <label class="block text-xs font-semibold mb-1 text-center">Name</label>
            <input type="text" name="name" required pattern="[A-Za-z ]+" title="Name should only contain letters and spaces." class="border px-2 py-1 rounded w-32">
        </div>
        <div class="flex flex-col items-center">
            <label class="block text-xs font-semibold mb-1 text-center">Password</label>
            <input type="password" name="password" required minlength="6" class="border px-2 py-1 rounded w-32">
        </div>
        <div class="flex flex-col items-center">
            <label class="block text-xs font-semibold mb-1 text-center">Security Question</label>
            <select name="security_question" required class="border px-2 py-1 rounded w-40">
                <option value="">Select a question</option>
                <option value="What city were you born in?">What city were you born in?</option>
                <option value="What is your mother's maiden name?">What is your mother's maiden name?</option>
                <option value="What was the name of your first pet?">What was the name of your first pet?</option>
                <option value="What is your favorite food?">What is your favorite food?</option>
                <option value="What is the name of your elementary school?">What is the name of your elementary school?</option>
            </select>
        </div>
        <div class="flex flex-col items-center">
            <label class="block text-xs font-semibold mb-1 text-center">Security Answer</label>
            <input type="text" name="security_answer" required class="border px-2 py-1 rounded w-40" placeholder="Answer">
        </div>
        <div class="flex flex-col justify-end">
            <label class="block text-xs font-semibold mb-1 opacity-0">&nbsp;</label>
            <button type="submit" class="bg-red-700 text-white px-4 py-2 rounded hover:bg-blue-800 flex items-center"><i class="fas fa-user-plus mr-1"></i>Add User</button>
        </div>
    </form>
</div>
<!-- Create Admin Form (collapsible) -->
<div id="create-admin-form-wrapper" class="overflow-hidden transition-all duration-300 max-h-0 mb-6">
    <form id="create-admin-form" method="POST" action="create_admin_form.php" class="flex flex-row gap-4 bg-blue-50 p-4 rounded-lg max-w-4xl w-full mx-auto items-center justify-center flex-wrap">
        <div class="flex flex-col items-center">
            <label class="block text-xs font-semibold mb-1 text-center">Username</label>
            <input type="text" name="username" required class="border px-2 py-1 rounded w-32">
        </div>
        <div class="flex flex-col items-center">
            <label class="block text-xs font-semibold mb-1 text-center">Name</label>
            <input type="text" name="name" required pattern="[A-Za-z ]+" title="Name should only contain letters and spaces." class="border px-2 py-1 rounded w-32">
        </div>
        <div class="flex flex-col items-center">
            <label class="block text-xs font-semibold mb-1 text-center">Email</label>
            <input type="email" name="email" required class="border px-2 py-1 rounded w-32">
        </div>
        <div class="flex flex-col items-center">
            <label class="block text-xs font-semibold mb-1 text-center">Password</label>
            <input type="password" name="password" required minlength="6" class="border px-2 py-1 rounded w-32">
        </div>
        <div class="flex flex-col justify-end">
            <label class="block text-xs font-semibold mb-1 opacity-0">&nbsp;</label>
            <button type="submit" class="bg-red-700 text-white px-4 py-2 rounded hover:bg-blue-800 flex items-center"><i class="fas fa-user-shield mr-1"></i>Create Admin</button>
        </div>
    </form>
</div>
<script>
// JS for toggling forms
const addUserBtn = document.getElementById('show-add-user');
const createAdminBtn = document.getElementById('show-create-admin');
const addUserFormWrapper = document.getElementById('add-user-form-wrapper');
const createAdminFormWrapper = document.getElementById('create-admin-form-wrapper');

addUserBtn.addEventListener('click', () => {
    if (addUserFormWrapper.style.maxHeight && addUserFormWrapper.style.maxHeight !== '0px') {
        addUserFormWrapper.style.maxHeight = '0px';
    } else {
        addUserFormWrapper.style.maxHeight = addUserFormWrapper.scrollHeight + 'px';
        createAdminFormWrapper.style.maxHeight = '0px';
    }
});
createAdminBtn.addEventListener('click', () => {
    if (createAdminFormWrapper.style.maxHeight && createAdminFormWrapper.style.maxHeight !== '0px') {
        createAdminFormWrapper.style.maxHeight = '0px';
    } else {
        createAdminFormWrapper.style.maxHeight = createAdminFormWrapper.scrollHeight + 'px';
        addUserFormWrapper.style.maxHeight = '0px';
    }
});
</script>

                <p class="mb-4 text-gray-600">View, add, edit, or remove users.</p>
                
                <?php
                require_once 'config.php';
                $users_result = $conn->query("SELECT id, username, name FROM users ORDER BY id DESC");
                if (!$users_result) {
                    echo '<div class="bg-blue-50 text-red-700 p-3 rounded mb-4">User table query failed: ' . htmlspecialchars($conn->error) . '</div>';
                } else {
                ?>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                        <thead class="bg-blue-100">
                            <tr>
                                <th class="py-2 px-4 border-b text-center">ID</th>
                                <th class="py-2 px-4 border-b text-center">Username</th>
                                <th class="py-2 px-4 border-b text-center">Name</th>
                                <th class="py-2 px-4 border-b text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
<?php while ($user = $users_result->fetch_assoc()): ?>
                            <tr>
                                <?php if (isset($_GET['edit_user']) && $_GET['edit_user'] == $user['id']): ?>
    <!-- Edit Row -->
    <form method="POST" action="user_actions.php">
        <input type="hidden" name="action" value="edit">
        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
        <td class="py-2 px-4 border-b text-center"><?php echo htmlspecialchars($user['id']); ?></td>
        <td class="py-2 px-4 border-b"><input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required class="border px-2 py-1 rounded w-28"></td>
        <td class="py-2 px-4 border-b"><input type="text" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required class="border px-2 py-1 rounded w-28"></td>
        <td class="py-2 px-4 border-b text-center">
            <input type="password" name="password" placeholder="New Password (optional)" class="border px-2 py-1 rounded w-32">
            <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700 mr-2"><i class="fas fa-save"></i></button>
            <a href="admin_dashboard.php" class="bg-gray-400 text-white px-3 py-1 rounded hover:bg-gray-600"><i class="fas fa-times"></i></a>
        </td>
    </form>
<?php else: ?>
    <td class="py-2 px-4 border-b text-center"><?php echo htmlspecialchars($user['id']); ?></td>
    <td class="py-2 px-4 border-b text-center"><?php echo htmlspecialchars($user['username']); ?></td>
    <td class="py-2 px-4 border-b text-center"><?php echo htmlspecialchars($user['name']); ?></td>
    <td class="py-2 px-4 border-b text-center">
        <a href="admin_dashboard.php?edit_user=<?php echo $user['id']; ?>" class="text-blue-600 hover:text-blue-900 mr-3"><i class="fas fa-edit"></i></a>
        <a href="user_actions.php?delete_user=<?php echo $user['id']; ?>" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this user?');"><i class="fas fa-trash"></i></a>
    </td>
<?php endif; ?>
                            </tr>
                        <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
                <?php } // end users_result check ?>
            </section>
        <!-- Account Data Section -->
        <section id="accounts" class="mb-12">
            <h2 class="text-2xl font-bold mb-4"><i class="fas fa-database mr-2"></i>Account Data</h2>
            <p class="mb-4 text-gray-600">Manage all national account data records.</p>
            <?php
            // Check and create accounts table if not exists
            $dbname = $conn->query('SELECT DATABASE()')->fetch_row()[0];
            $tableExists = $conn->query("SELECT 1 FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA='$dbname' AND TABLE_NAME='accounts'")->num_rows > 0;
            if (!$tableExists) {
                $sql = "CREATE TABLE accounts (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    account_name VARCHAR(100) NOT NULL,
                    account_type VARCHAR(50),
                    balance DECIMAL(15,2) DEFAULT 0,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                ) ENGINE=InnoDB;";
                if ($conn->query($sql) === TRUE) {
                    echo "<div class='bg-green-100 text-green-700 p-2 rounded mb-4 text-center'>Accounts table created successfully.</div>";
                } else {
                    echo "<div class='bg-blue-50 text-red-700 p-2 rounded mb-4 text-center'>Error creating accounts table: " . htmlspecialchars($conn->error) . "</div>";
                }
            }
            // Handle insert
            $account_msg = '';
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['insert_account'])) {
                $aname = trim($_POST['account_name'] ?? '');
                $atype = trim($_POST['account_type'] ?? '');
                $balance = trim($_POST['balance'] ?? '');
                if ($aname === '' || $balance === '') {
                    $account_msg = "<span class='text-red-600'>Account name and balance are required.</span>";
                } else {
                    $stmt = $conn->prepare('INSERT INTO accounts (account_name, account_type, balance) VALUES (?, ?, ?)');
                    $stmt->bind_param('ssd', $aname, $atype, $balance);
                    if ($stmt->execute()) {
                        $account_msg = "<span class='text-green-700'>Account record added successfully!</span>";
                    } else {
                        $account_msg = "<span class='text-red-600'>Error: " . htmlspecialchars($stmt->error) . "</span>";
                    }
                }
            }
            ?>
            <div class="flex flex-col items-center mb-6">
                <form method="POST" class="flex flex-row gap-4 bg-blue-50 p-4 rounded-lg max-w-3xl w-full mx-auto items-center justify-center flex-wrap">
                    <input type="hidden" name="insert_account" value="1">
                    <div class="flex flex-col items-center">
                        <label class="block text-xs font-semibold mb-1 text-center">Account Name</label>
                        <input type="text" name="account_name" required class="border px-2 py-1 rounded w-40">
                    </div>
                    <div class="flex flex-col items-center">
                        <label class="block text-xs font-semibold mb-1 text-center">Account Type</label>
                        <input type="text" name="account_type" class="border px-2 py-1 rounded w-40">
                    </div>
                    <div class="flex flex-col items-center">
                        <label class="block text-xs font-semibold mb-1 text-center">Balance</label>
                        <input type="number" name="balance" step="0.01" min="0" required class="border px-2 py-1 rounded w-40">
                    </div>
                    <div class="flex flex-col justify-end">
                        <label class="block text-xs font-semibold mb-1 opacity-0">&nbsp;</label>
                        <button type="submit" class="bg-red-700 text-white px-4 py-2 rounded hover:bg-blue-800 flex items-center"><i class="fas fa-plus mr-1"></i>Add Account</button>
                    </div>
                    <?php if (!empty($account_msg)) echo '<div class="mt-2 text-center w-full">' . $account_msg . '</div>'; ?>
                </form>
            </div>
            <?php
            $accounts_result = $conn->query("SELECT id, account_name, account_type, balance, created_at FROM accounts ORDER BY id DESC");
            ?>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                        <thead class="bg-blue-100">
                            <tr>
                                <th class="py-2 px-4 border-b text-center">ID</th>
                                <th class="py-2 px-4 border-b text-center">Account Name</th>
                                <th class="py-2 px-4 border-b text-center">Type</th>
                                <th class="py-2 px-4 border-b text-center">Balance</th>
                                <th class="py-2 px-4 border-b text-center">Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php while ($acc = $accounts_result->fetch_assoc()): ?>
                            <tr>
                                <td class="py-2 px-4 border-b text-center"><?php echo htmlspecialchars($acc['id']); ?></td>
                                <td class="py-2 px-4 border-b text-center"><?php echo htmlspecialchars($acc['account_name']); ?></td>
                                <td class="py-2 px-4 border-b text-center"><?php echo htmlspecialchars($acc['account_type']); ?></td>
                                <td class="py-2 px-4 border-b text-center"><?php echo htmlspecialchars($acc['balance']); ?></td>
                                <td class="py-2 px-4 border-b text-center"><?php echo htmlspecialchars($acc['created_at']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </section>

            </section>
        </main>
    </div>
</body>
</html>
