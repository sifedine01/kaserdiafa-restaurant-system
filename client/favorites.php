<?php
require "../config.php";
require "../auth/auth_check.php";

// Handle add/remove favorite
if(isset($_POST['action']) && isset($_POST['item_name'])) {
    $item_name = $_POST['item_name'];
    $user_id = $_SESSION['user_id'];
    
    if($_POST['action'] == 'add') {
        // Simple favorites storage in session or you can create a favorites table
        if(!isset($_SESSION['favorites'])) {
            $_SESSION['favorites'] = [];
        }
        if(!in_array($item_name, $_SESSION['favorites'])) {
            $_SESSION['favorites'][] = $item_name;
        }
    } elseif($_POST['action'] == 'remove') {
        if(isset($_SESSION['favorites'])) {
            $_SESSION['favorites'] = array_diff($_SESSION['favorites'], [$item_name]);
        }
    }
}

$favorites = $_SESSION['favorites'] ?? [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>My Favorites - Kaser Diafa</title>
<link rel="stylesheet" href="../style/main.css">
<script src="https://kit.fontawesome.com/4f5f087331.js" crossorigin="anonymous"></script>
</head>
<body>

<?php include "../partials/header.php"; ?>

<main style="min-height: 80vh; padding: 2rem;">
    <div style="max-width: 800px; margin: 0 auto;">
        <h2 style="color: #e5e5e5; font-size: 2rem; margin-bottom: 2rem; display: flex; align-items: center; gap: 0.5rem;"><i class="fas fa-heart"></i> My Favorite Items</h2>
        
        <?php if(empty($favorites)): ?>
            <div style="text-align: center; padding: 4rem 2rem; background: #1a1a1a; border-radius: 12px; border: 1px solid #333;">
                <i class="fas fa-heart-broken" style="font-size: 4rem; color: #d97706; margin-bottom: 1rem;"></i>
                <h3 style="color: #e5e5e5; margin-bottom: 1rem;">No favorites yet</h3>
                <p style="color: #9ca3af; margin-bottom: 2rem;">Start adding items to your favorites while browsing the menu!</p>
                <a href="../order.php" style="background: #d97706; color: #fff; padding: 1rem 2rem; border-radius: 8px; text-decoration: none; font-weight: 600;">Browse Menu</a>
            </div>
        <?php else: ?>
            <div style="display: grid; gap: 1rem; margin-top: 2rem;">
                <?php foreach($favorites as $item): ?>
                    <div style="background: #1a1a1a; padding: 1.5rem; border-radius: 12px; border: 1px solid #333; display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <h3 style="color: #e5e5e5; margin-bottom: 0.5rem;"><?= htmlspecialchars($item) ?></h3>
                            <p style="color: #9ca3af; margin: 0;">Added to favorites</p>
                        </div>
                        <div style="display: flex; gap: 1rem;">
                            <a href="../order.php" style="background: #d97706; color: #fff; padding: 0.5rem 1rem; border-radius: 6px; text-decoration: none; font-size: 0.875rem;">Order Again</a>
                            <form method="POST" style="display: inline;">
                                <input type="hidden" name="action" value="remove">
                                <input type="hidden" name="item_name" value="<?= htmlspecialchars($item) ?>">
                                <button type="submit" style="background: #ef4444; color: #fff; border: none; padding: 0.5rem 1rem; border-radius: 6px; cursor: pointer; font-size: 0.875rem;">Remove</button>
                            </form>
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