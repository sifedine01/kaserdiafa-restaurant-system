<?php
require "../config.php";
require "../auth/auth_check.php";

// Check if user is admin
if(!$_SESSION['is_admin']){
    die("Access denied");
}

if(isset($_GET['id'])) {
    $order_id = $_GET['id'];
    
    // Delete the order
    $stmt = $pdo->prepare("DELETE FROM orders WHERE id = ?");
    $stmt->execute([$order_id]);
    
    // Redirect back to admin orders
    header("Location: admin_orders.php?deleted=1");
    exit;
} else {
    header("Location: admin_orders.php");
    exit;
}
?>
