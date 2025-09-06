<?php
// Simple path calculation that works reliably
$current_path = $_SERVER['REQUEST_URI'];
$base_path = '';

// Determine base path based on current location
if (strpos($current_path, '/auth/') !== false) {
    $base_path = '../';
} elseif (strpos($current_path, '/orders/') !== false) {
    $base_path = '../';
} elseif (strpos($current_path, '/admin/') !== false) {
    $base_path = '../';
} elseif (strpos($current_path, '/client/') !== false) {
    $base_path = '../';
} else {
    $base_path = '';
}
?>
<header>
    <nav>
        <span><a href="<?php echo $base_path; ?>index.php" style="text-decoration: none; color: inherit;">Kaser Diafa</a></span>
        <ul>
            <li><a href="<?php echo $base_path; ?>index.php">Home</a></li>
            <li><a href="<?php echo $base_path; ?>index.php#about">About</a></li>
            <li><a href="<?php echo $base_path; ?>order.php">Order</a></li>
            <li><a href="<?php echo $base_path; ?>index.php#services">Services</a></li>
            <li><a href="<?php echo $base_path; ?>index.php#contact">Contact</a></li>
            <?php if(isset($_SESSION['user_id'])): ?>
                <li><a href="<?php echo $base_path; ?>orders/my_orders.php">My Orders</a></li>
                <li><a href="<?php echo $base_path; ?>client/favorites.php">Favorites</a></li>
                <?php if($_SESSION['is_admin']): ?>
                    <li><a href="<?php echo $base_path; ?>admin/dashboard.php">Admin</a></li>
                <?php endif; ?>
                <li><a href="<?php echo $base_path; ?>auth/logout.php">Logout</a></li>
            <?php else: ?>
                <li><a href="<?php echo $base_path; ?>auth/login.php">Login</a></li>
                <li><a href="<?php echo $base_path; ?>auth/register.php">Register</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
