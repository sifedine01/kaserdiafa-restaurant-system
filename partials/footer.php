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
<footer>
    <div style="max-width: 1200px; margin: 0 auto; padding: 2rem; text-align: center;">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem; margin-bottom: 2rem;">
            <div>
                <h4 style="color: #d97706; margin-bottom: 1rem; font-size: 1.25rem;">Kaser Diafa</h4>
                <p style="color: #9ca3af; line-height: 1.6;">Bringing authentic Moroccan flavors to your table since 2010. Experience the warmth of Moroccan hospitality.</p>
            </div>
            <div>
                <h4 style="color: #d97706; margin-bottom: 1rem; font-size: 1.25rem;">Quick Links</h4>
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <a href="<?php echo $base_path; ?>index.php" style="color: #9ca3af; text-decoration: none; transition: color 0.2s;">Home</a>
                    <a href="<?php echo $base_path; ?>index.php#about" style="color: #9ca3af; text-decoration: none; transition: color 0.2s;">About</a>
                    <a href="<?php echo $base_path; ?>order.php" style="color: #9ca3af; text-decoration: none; transition: color 0.2s;">Order</a>
                    <a href="<?php echo $base_path; ?>index.php#contact" style="color: #9ca3af; text-decoration: none; transition: color 0.2s;">Contact</a>
                </div>
            </div>
            <div>
                <h4 style="color: #d97706; margin-bottom: 1rem; font-size: 1.25rem;">Contact Info</h4>
                <div style="color: #9ca3af; line-height: 1.6;">
                    <p><i class="fas fa-map-marker-alt" style="margin-right: 0.5rem;"></i>123 Restaurant Street, Casablanca</p>
                    <p><i class="fas fa-phone" style="margin-right: 0.5rem;"></i>+212 5 22 123 456</p>
                    <p><i class="fas fa-envelope" style="margin-right: 0.5rem;"></i>info@kaserdiafa.com</p>
                </div>
            </div>
            <div>
                <h4 style="color: #d97706; margin-bottom: 1rem; font-size: 1.25rem;">Follow Us</h4>
                <div style="display: flex; gap: 1rem; justify-content: center;">
                    <a href="#" style="color: #9ca3af; font-size: 1.5rem; transition: color 0.2s;"><i class="fab fa-facebook"></i></a>
                    <a href="#" style="color: #9ca3af; font-size: 1.5rem; transition: color 0.2s;"><i class="fab fa-instagram"></i></a>
                    <a href="#" style="color: #9ca3af; font-size: 1.5rem; transition: color 0.2s;"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
        </div>
        <div style="border-top: 1px solid #374151; padding-top: 1rem; color: #6b7280;">
            <p>&copy; 2024 Kaser Diafa. All rights reserved.</p>
        </div>
    </div>
</footer>

<style>
footer a:hover {
    color: #d97706 !important;
}
</style>
