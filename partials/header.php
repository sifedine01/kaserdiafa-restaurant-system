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
        <button class="nav-toggle" aria-label="Toggle menu" aria-expanded="false">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <ul class="nav-menu">
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
    <script>
    (function(){
        var nav = document.querySelector('header nav');
        var toggle = nav ? nav.querySelector('.nav-toggle') : null;
        var menu = nav ? nav.querySelector('.nav-menu') : null;
        if (!nav || !toggle || !menu) return;

        function closeMenu(){
            nav.classList.remove('open');
            document.body.classList.remove('no-scroll');
            toggle.setAttribute('aria-expanded', 'false');
        }

        toggle.addEventListener('click', function(e){
            e.stopPropagation();
            var isOpen = nav.classList.toggle('open');
            toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            document.body.classList.toggle('no-scroll', isOpen);
        });

        // Close when clicking a link (use event delegation)
        menu.addEventListener('click', function(e){
            var target = e.target;
            if (target && target.tagName === 'A') {
                closeMenu();
            }
        });

        // Close when clicking outside menu on mobile
        document.addEventListener('click', function(e){
            if (!nav.classList.contains('open')) return;
            if (!nav.contains(e.target)) {
                closeMenu();
            }
        });

        // Close on Escape key
        document.addEventListener('keydown', function(e){
            if (e.key === 'Escape') {
                closeMenu();
            }
        });
    })();
    </script>
</header>
