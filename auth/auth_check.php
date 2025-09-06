<?php
// Determine the correct path to login.php based on where auth_check.php is called from
$current_path = $_SERVER['REQUEST_URI'];
$login_path = '';

// If we're in a subdirectory, we need to go up one level to reach auth/login.php
if (strpos($current_path, '/orders/') !== false || 
    strpos($current_path, '/admin/') !== false || 
    strpos($current_path, '/client/') !== false) {
    $login_path = '../auth/login.php';
} else {
    // If we're in root or auth directory, login.php is in auth/
    $login_path = 'auth/login.php';
}

if(!isset($_SESSION['user_id'])) {
    header("Location: " . $login_path);
    exit;
}
