<?php
require "../config.php";
require "../auth/auth_check.php";

$stmt = $pdo->prepare("SELECT * FROM orders WHERE user_id=? ORDER BY created_at DESC");
$stmt->execute([$_SESSION['user_id']]);
$orders = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>My Orders - Kaser Diafa</title>
<link rel="stylesheet" href="../style/main.css">
<script src="https://kit.fontawesome.com/4f5f087331.js" crossorigin="anonymous"></script>
</head>
<body>

<?php include "../partials/header.php"; ?>

<main style="min-height: 80vh; padding: 20px;">
    <div class="orders-container">
        <h2><i class="fas fa-receipt"></i> My Orders</h2>
        <a href="../order.php" class="back-link"><i class="fas fa-arrow-left"></i> Back to Order</a>
        
        <?php if(empty($orders)): ?>
            <div class="no-orders">
                <i class="fas fa-shopping-cart"></i>
                <h3>No orders yet</h3>
                <p>Start ordering to see your order history here.</p>
                <a href="../order.php" class="order-btn">Start Ordering</a>
            </div>
        <?php else: ?>
            <div class="orders-list">
                <?php foreach($orders as $order): 
                      $items = json_decode($order['items'], true); ?>
                    <div class="order-card">
                        <div class="order-header">
                            <h3><i class="fas fa-<?= $order['order_type'] == 'dine-in' ? 'chair' : ($order['order_type'] == 'takeaway' ? 'shopping-bag' : 'motorcycle') ?>"></i> <?= ucfirst(str_replace('-', ' ', $order['order_type'])) ?> Order</h3>
                            <div class="order-meta">
                                <span class="order-status status-<?= $order['status'] ?? 'pending' ?>"><?= ucfirst($order['status'] ?? 'pending') ?></span>
                                <span class="order-date"><?= date('M d, Y H:i', strtotime($order['created_at'])) ?></span>
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

</body>
</html>
