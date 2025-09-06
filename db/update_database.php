<?php
// Database Update Script
// Run this once to update your existing database

require __DIR__ . "/../config.php";

try {
    // Add order_type column if it doesn't exist
    $pdo->exec("ALTER TABLE orders ADD COLUMN IF NOT EXISTS order_type ENUM('dine-in', 'takeaway', 'delivery') NOT NULL DEFAULT 'dine-in'");
    echo "✅ Added order_type column<br>";
    
    // Add status column if it doesn't exist
    $pdo->exec("ALTER TABLE orders ADD COLUMN IF NOT EXISTS status ENUM('pending', 'preparing', 'ready', 'completed') DEFAULT 'pending'");
    echo "✅ Added status column<br>";
    
    // Create menu_items table if it doesn't exist
    $pdo->exec("CREATE TABLE IF NOT EXISTS menu_items (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        description TEXT,
        price DECIMAL(10,2) NOT NULL,
        category VARCHAR(50) NOT NULL,
        is_available BOOLEAN DEFAULT TRUE,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
    echo "✅ Created menu_items table<br>";
    
    // Create favorites table if it doesn't exist
    $pdo->exec("CREATE TABLE IF NOT EXISTS favorites (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        menu_item_id INT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
        FOREIGN KEY (menu_item_id) REFERENCES menu_items(id) ON DELETE CASCADE,
        UNIQUE KEY unique_favorite (user_id, menu_item_id)
    )");
    echo "✅ Created favorites table<br>";
    
    // Create reviews table if it doesn't exist
    $pdo->exec("CREATE TABLE IF NOT EXISTS reviews (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        order_id INT,
        rating INT NOT NULL CHECK (rating >= 1 AND rating <= 5),
        comment TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
        FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE SET NULL
    )");
    echo "✅ Created reviews table<br>";
    
    echo "<br><strong>🎉 Database updated successfully!</strong><br>";
    echo "<a href='../index.php'>Go to Homepage</a>";
    
} catch (PDOException $e) {
    echo "❌ Error updating database: " . $e->getMessage();
}
?>
