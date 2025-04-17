<?php
require_once 'config.php';

// Check if the accounts table exists
$dbname = $conn->query('SELECT DATABASE()')->fetch_row()[0];
$tableExists = $conn->query("SELECT 1 FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA='".$dbname."' AND TABLE_NAME='accounts'")->num_rows > 0;

if ($tableExists) {
    echo "<div style='color:orange;font-weight:bold;'>Accounts table already exists.</div>";
} else {
    $sql = "CREATE TABLE accounts (
        id INT AUTO_INCREMENT PRIMARY KEY,
        account_name VARCHAR(100) NOT NULL,
        account_type VARCHAR(50),
        balance DECIMAL(15,2) DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB;";
    if ($conn->query($sql) === TRUE) {
        echo "<div style='color:green;font-weight:bold;'>Accounts table created successfully.</div>";
    } else {
        echo "<div style='color:red;font-weight:bold;'>Error creating accounts table: " . htmlspecialchars($conn->error) . "</div>";
    }
}
?>
