<?php
require "../config.php";
require "../auth/auth_check.php";

// Check if user is admin
if(!$_SESSION['is_admin']){
    die("Access denied");
}

$page = $_GET['page'] ?? 'orders';

// Handle form submissions
if(isset($_POST['action'])) {
    if($_POST['action'] == 'add_menu_item') {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category = $_POST['category'];
        
        $stmt = $pdo->prepare("INSERT INTO menu_items (name, description, price, category) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $description, $price, $category]);
    } elseif($_POST['action'] == 'update_menu_item') {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category = $_POST['category'];
        $is_available = isset($_POST['is_available']) ? 1 : 0;
        
        $stmt = $pdo->prepare("UPDATE menu_items SET name=?, description=?, price=?, category=?, is_available=? WHERE id=?");
        $stmt->execute([$name, $description, $price, $category, $is_available, $id]);
    } elseif($_POST['action'] == 'delete_menu_item') {
        $id = $_POST['id'];
        $stmt = $pdo->prepare("DELETE FROM menu_items WHERE id=?");
        $stmt->execute([$id]);
    } elseif($_POST['action'] == 'update_order_status') {
        $order_id = $_POST['order_id'];
        $status = $_POST['status'];
        
        $stmt = $pdo->prepare("UPDATE orders SET status = ? WHERE id = ?");
        $stmt->execute([$status, $order_id]);
    } elseif($_POST['action'] == 'delete_order') {
        $id = $_POST['id'];
        $stmt = $pdo->prepare("DELETE FROM orders WHERE id=?");
        $stmt->execute([$id]);
    }
}

// Get data based on page
switch($page) {
    case 'orders':
        $stmt = $pdo->query("SELECT o.*, u.username FROM orders o JOIN users u ON o.user_id=u.id ORDER BY o.created_at DESC");
        $orders = $stmt->fetchAll();
        break;
    case 'menu':
        $stmt = $pdo->query("SELECT * FROM menu_items ORDER BY category, name");
        $menu_items = $stmt->fetchAll();
        break;
    case 'analytics':
        // Get analytics data
        $stats = [];
        $stmt = $pdo->query("SELECT COUNT(*) as total FROM orders");
        $stats['total_orders'] = $stmt->fetch()['total'];
        
        $stmt = $pdo->query("SELECT order_type, COUNT(*) as count FROM orders GROUP BY order_type");
        $stats['orders_by_type'] = $stmt->fetchAll();
        
        $stmt = $pdo->query("SELECT status, COUNT(*) as count FROM orders GROUP BY status");
        $stats['orders_by_status'] = $stmt->fetchAll();
        
        $stmt = $pdo->query("SELECT o.*, u.username FROM orders o JOIN users u ON o.user_id=u.id ORDER BY o.created_at DESC LIMIT 10");
        $stats['recent_orders'] = $stmt->fetchAll();
        break;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard - Kaser Diafa</title>
<link rel="stylesheet" href="../style/main.css">
<script src="https://kit.fontawesome.com/4f5f087331.js" crossorigin="anonymous"></script>
<style>
.admin-dashboard {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
}

.admin-nav {
    display: flex;
    gap: 1rem;
    margin-bottom: 2rem;
    background: #1a1a1a;
    padding: 1rem;
    border-radius: 8px;
    border: 1px solid #333;
}

.admin-nav a {
    padding: 0.75rem 1.5rem;
    background: #2a2a2a;
    color: #9ca3af;
    text-decoration: none;
    border-radius: 6px;
    font-weight: 500;
    transition: all 0.2s;
}

.admin-nav a:hover,
.admin-nav a.active {
    background: #d97706;
    color: #fff;
}

.admin-content {
    background: #1a1a1a;
    border-radius: 8px;
    padding: 2rem;
    border: 1px solid #333;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
    margin-bottom: 2rem;
}

.stat-card {
    background: #2a2a2a;
    padding: 1.5rem;
    border-radius: 8px;
    text-align: center;
    border: 1px solid #333;
}

.stat-card h3 {
    font-size: 2rem;
    color: #d97706;
    margin-bottom: 0.5rem;
}

.stat-card p {
    color: #9ca3af;
    margin: 0;
}

.orders-table,
.menu-grid {
    display: grid;
    gap: 1rem;
}

.order-card,
.menu-item-card {
    background: #2a2a2a;
    padding: 1rem;
    border-radius: 8px;
    border: 1px solid #333;
}

.order-header,
.menu-item-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 0.5rem;
}

.order-actions,
.menu-item-actions {
    display: flex;
    gap: 0.5rem;
}

.btn {
    padding: 0.5rem 1rem;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 0.875rem;
    font-weight: 500;
    transition: all 0.2s;
}

.btn-primary {
    background: #d97706;
    color: #fff;
}

.btn-danger {
    background: #ef4444;
    color: #fff;
}

.btn-secondary {
    background: #6b7280;
    color: #fff;
}

.btn:hover {
    opacity: 0.9;
}

.form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
    margin-bottom: 1rem;
}

.form-group {
    margin-bottom: 1rem;
}

.form-group label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 500;
    color: #e5e5e5;
}

.form-group input,
.form-group select,
.form-group textarea {
    width: 100%;
    padding: 0.75rem;
    border: 1px solid #333;
    border-radius: 6px;
    font-size: 1rem;
    background: #2a2a2a;
    color: #e5e5e5;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    outline: none;
    border-color: #d97706;
}

.checkbox-group {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.checkbox-group input[type="checkbox"] {
    width: auto;
}
</style>
</head>
<body>

<?php include "../partials/header.php"; ?>

<div class="admin-dashboard">
    <h1 style="color: #e5e5e5; font-size: 2.5rem; margin-bottom: 2rem;">Admin Dashboard</h1>
    
    <nav class="admin-nav">
        <a href="?page=orders" class="<?= $page == 'orders' ? 'active' : '' ?>">
            <i class="fas fa-receipt"></i> Orders
        </a>
        <a href="?page=menu" class="<?= $page == 'menu' ? 'active' : '' ?>">
            <i class="fas fa-utensils"></i> Menu
        </a>
        <a href="?page=analytics" class="<?= $page == 'analytics' ? 'active' : '' ?>">
            <i class="fas fa-chart-bar"></i> Analytics
        </a>
    </nav>

    <div class="admin-content">
        <?php if($page == 'orders'): ?>
            <h2 style="color: #e5e5e5; font-size: 1.5rem; margin-bottom: 1.5rem;">Order Management</h2>
            <div class="orders-table">
                <?php foreach($orders as $order): 
                      $items = json_decode($order['items'], true); ?>
                    <div class="order-card">
                        <div class="order-header">
                            <div>
                                <strong style="color: #e5e5e5;"><?= htmlspecialchars($order['username']) ?></strong>
                                <span style="color: #9ca3af;">- <?= ucfirst(str_replace('-', ' ', $order['order_type'])) ?></span>
                            </div>
                            <div class="order-actions">
                                <form method="POST" style="display: inline;">
                                    <input type="hidden" name="action" value="update_order_status">
                                    <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                                    <select name="status" onchange="this.form.submit()">
                                        <option value="pending" <?= ($order['status'] ?? 'pending') == 'pending' ? 'selected' : '' ?>>Pending</option>
                                        <option value="preparing" <?= ($order['status'] ?? 'pending') == 'preparing' ? 'selected' : '' ?>>Preparing</option>
                                        <option value="ready" <?= ($order['status'] ?? 'pending') == 'ready' ? 'selected' : '' ?>>Ready</option>
                                        <option value="completed" <?= ($order['status'] ?? 'pending') == 'completed' ? 'selected' : '' ?>>Completed</option>
                                    </select>
                                </form>
                                <form method="POST" style="display: inline;" onsubmit="return confirm('Delete this order?')">
                                    <input type="hidden" name="action" value="delete_order">
                                    <input type="hidden" name="id" value="<?= $order['id'] ?>">
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                        <div style="margin-bottom: 0.5rem;">
                            <strong style="color: #e5e5e5;">Items:</strong>
                            <?php foreach($items as $item): ?>
                                <span style="background: #333; color: #e5e5e5; padding: 0.25rem 0.5rem; border-radius: 4px; margin-right: 0.5rem; font-size: 0.875rem;">
                                    <?= htmlspecialchars($item['name']) ?>
                                </span>
                            <?php endforeach; ?>
                        </div>
                        <div style="color: #9ca3af; font-size: 0.875rem;">
                            Payment: <?= htmlspecialchars($order['payment_method']) ?> | 
                            Date: <?= date('M d, Y H:i', strtotime($order['created_at'])) ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        <?php elseif($page == 'menu'): ?>
            <h2 style="color: #e5e5e5; font-size: 1.5rem; margin-bottom: 1.5rem;">Menu Management</h2>
            
            <div style="background: #2a2a2a; padding: 1.5rem; border-radius: 8px; margin-bottom: 2rem; border: 1px solid #333;">
                <h3 style="color: #e5e5e5; margin-bottom: 1rem;">Add New Menu Item</h3>
                <form method="POST">
                    <input type="hidden" name="action" value="add_menu_item">
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" required>
                        </div>
                        <div class="form-group">
                            <label>Price (MAD)</label>
                            <input type="number" name="price" step="0.01" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <select name="category" required>
                            <option value="">Select Category</option>
                            <option value="appetizers">Appetizers</option>
                            <option value="main-courses">Main Courses</option>
                            <option value="tagines">Tajines</option>
                            <option value="grilled">Grilled</option>
                            <option value="desserts">Desserts</option>
                            <option value="beverages">Beverages</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Item</button>
                </form>
            </div>

            <div class="menu-grid">
                <?php foreach($menu_items as $item): ?>
                    <div class="menu-item-card">
                        <div class="menu-item-header">
                            <div>
                                <strong style="color: #e5e5e5;"><?= htmlspecialchars($item['name']) ?></strong>
                                <span style="color: #d97706; font-weight: 600;"><?= $item['price'] ?> MAD</span>
                            </div>
                            <div class="menu-item-actions">
                                <button class="btn btn-secondary" onclick="editMenuItem(<?= htmlspecialchars(json_encode($item)) ?>)">Edit</button>
                                <form method="POST" style="display: inline;" onsubmit="return confirm('Delete this item?')">
                                    <input type="hidden" name="action" value="delete_menu_item">
                                    <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                        <div style="color: #9ca3af; font-size: 0.875rem; margin-bottom: 0.5rem;">
                            <?= ucfirst(str_replace('-', ' ', $item['category'])) ?>
                        </div>
                        <div style="color: #9ca3af; font-size: 0.875rem;">
                            <?= htmlspecialchars($item['description']) ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        <?php elseif($page == 'analytics'): ?>
            <h2 style="color: #e5e5e5; font-size: 1.5rem; margin-bottom: 1.5rem;">Analytics</h2>
            
            <div class="stats-grid">
                <div class="stat-card">
                    <h3><?= $stats['total_orders'] ?></h3>
                    <p>Total Orders</p>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                <div>
                    <h3 style="color: #e5e5e5; margin-bottom: 1rem;">Orders by Type</h3>
                    <?php foreach($stats['orders_by_type'] as $type): ?>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                            <span style="color: #9ca3af;"><?= ucfirst(str_replace('-', ' ', $type['order_type'])) ?></span>
                            <span style="color: #d97706; font-weight: 600;"><?= $type['count'] ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <div>
                    <h3 style="color: #e5e5e5; margin-bottom: 1rem;">Orders by Status</h3>
                    <?php foreach($stats['orders_by_status'] as $status): ?>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                            <span style="color: #9ca3af;"><?= ucfirst($status['status']) ?></span>
                            <span style="color: #d97706; font-weight: 600;"><?= $status['count'] ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div style="margin-top: 2rem;">
                <h3 style="color: #e5e5e5; margin-bottom: 1rem;">Recent Orders</h3>
                <div class="orders-table">
                    <?php foreach($stats['recent_orders'] as $order): ?>
                        <div class="order-card">
                            <div style="display: flex; justify-content: space-between;">
                                <div>
                                    <strong style="color: #e5e5e5;"><?= htmlspecialchars($order['username']) ?></strong>
                                    <span style="color: #9ca3af;">- <?= ucfirst(str_replace('-', ' ', $order['order_type'])) ?></span>
                                </div>
                                <div style="color: #9ca3af; font-size: 0.875rem;">
                                    <?= date('M d, H:i', strtotime($order['created_at'])) ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
function editMenuItem(item) {
    // Simple edit functionality - you can enhance this
    const newName = prompt('Edit name:', item.name);
    if (newName && newName !== item.name) {
        // Here you would typically make an AJAX call to update the item
        alert('Edit functionality can be enhanced with AJAX calls');
    }
}
</script>

<?php include "../partials/footer.php"; ?>

</body>
</html>
