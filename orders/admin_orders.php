<?php
require "../config.php";
require "../auth/auth_check.php";

if(!$_SESSION['is_admin']){
    die("Access denied");
}

$stmt = $pdo->query("SELECT o.*, u.username FROM orders o JOIN users u ON o.user_id=u.id ORDER BY o.created_at DESC");
$orders = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>All Orders - Admin - Kaser Diafa</title>
<link rel="stylesheet" href="../style/main.css">
<script src="https://kit.fontawesome.com/4f5f087331.js" crossorigin="anonymous"></script>
</head>
<body>

<?php include "../partials/header.php"; ?>

<main style="min-height: 80vh; padding: 20px;">
    <div class="orders-container">
        <h2><i class="fas fa-users-cog"></i> All Orders - Admin Panel</h2>
        <a href="../order.php" class="back-link"><i class="fas fa-arrow-left"></i> Back to Order</a>
        
        <?php if(empty($orders)): ?>
            <div class="no-orders">
                <i class="fas fa-clipboard-list"></i>
                <h3>No orders found</h3>
                <p>No orders have been placed yet.</p>
            </div>
        <?php else: ?>
            <div class="orders-list">
                <?php foreach($orders as $order): 
                      $items = json_decode($order['items'], true); ?>
                    <div class="order-card admin-card">
                        <div class="order-header">
                            <h3><i class="fas fa-user"></i> <?= htmlspecialchars($order['username']) ?> - <?= ucfirst(str_replace('-', ' ', $order['order_type'])) ?></h3>
                            <div class="order-actions">
                                <span class="order-status status-<?= $order['status'] ?? 'pending' ?>"><?= ucfirst($order['status'] ?? 'pending') ?></span>
                                <span class="order-date"><?= date('M d, Y H:i', strtotime($order['created_at'])) ?></span>
                                <select class="status-select" onchange="updateOrderStatus(<?= $order['id'] ?>, this.value)">
                                    <option value="pending" <?= ($order['status'] ?? 'pending') == 'pending' ? 'selected' : '' ?>>Pending</option>
                                    <option value="preparing" <?= ($order['status'] ?? 'pending') == 'preparing' ? 'selected' : '' ?>>Preparing</option>
                                    <option value="ready" <?= ($order['status'] ?? 'pending') == 'ready' ? 'selected' : '' ?>>Ready</option>
                                    <option value="completed" <?= ($order['status'] ?? 'pending') == 'completed' ? 'selected' : '' ?>>Completed</option>
                                </select>
                                <a href="delete_order.php?id=<?= $order['id'] ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this order?')">
                                    <i class="fas fa-trash"></i> Delete
                                </a>
                            </div>
                        </div>
                        <div class="order-details">
                            <div class="payment-method">
                                <i class="fas fa-credit-card"></i>
                                <span><?= htmlspecialchars($order['payment_method']) ?></span>
                            </div>
                            <div class="order-items">
                                <h4><i class="fas fa-utensils"></i> Items:</h4>
                                <ul>
                                <?php foreach($items as $i): ?>
                                    <li><?= htmlspecialchars($i['name']) ?> - <?= $i['price'] ?></li>
                                <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php include "../partials/footer.php"; ?>
<script src="../admin/update_status.js"></script>

</body>
</html>
