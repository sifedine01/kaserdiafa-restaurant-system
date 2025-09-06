<?php 
require "config.php"; 
require "auth/auth_check.php"; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Kaser Diafa - Orders</title>
<link rel="stylesheet" href="style/main.css">
<script src="https://kit.fontawesome.com/4f5f087331.js" crossorigin="anonymous"></script>
</head>
<body>

<?php include "partials/header.php"; ?>

<main class="order-main">
    <!-- Order Type Selection -->
    <div class="order-type-selection">
        <h2>How would you like to order?</h2>
        <div class="order-types">
            <button class="order-type-btn active" data-type="dine-in">
                <i class="fas fa-chair"></i>
                <span>Dine In</span>
            </button>
            <button class="order-type-btn" data-type="takeaway">
                <i class="fas fa-shopping-bag"></i>
                <span>Takeaway</span>
            </button>
            <button class="order-type-btn" data-type="delivery">
                <i class="fas fa-motorcycle"></i>
                <span>Delivery</span>
            </button>
        </div>
    </div>

    <!-- Menu & Order Section -->
    <div class="menu-order-container">
        <!-- Menu Section -->
        <div class="menu-section">
            <div class="categories">
                <button class="category-btn active" data-category="appetizers">Appetizers</button>
                <button class="category-btn" data-category="main-courses">Main Courses</button>
                <button class="category-btn" data-category="tagines">Tajines</button>
                <button class="category-btn" data-category="grilled">Grilled</button>
                <button class="category-btn" data-category="desserts">Desserts</button>
                <button class="category-btn" data-category="beverages">Beverages</button>
            </div>
            <div class="menu-items" id="menu-items">
                <!-- Menu items will be loaded here by JavaScript -->
            </div>
</div>

        <!-- Order Section -->
        <div class="order-section">
            <div class="order-header">
                <h3>Your Order</h3>
                <span class="order-type-display" id="order-type-display">Dine In</span>
</div>

            <div class="order-items" id="orders-container">
                <div class="empty-order">
                    <i class="fas fa-shopping-cart"></i>
                    <p>Your cart is empty</p>
        </div>
    </div>

            <div class="order-summary">
                <div class="summary-row">
                    <span>Subtotal:</span>
                    <span id="subtotal">0.00 MAD</span>
            </div>
                <div class="summary-row total">
                    <span>Total:</span>
                    <span id="total">0.00 MAD</span>
        </div>
    </div>

            <div class="payment-section">
                <h4>Payment Method</h4>
        <div class="payment-methods">
                    <button class="pay-btn" data-method="cash">
                        <i class="fas fa-money-bill"></i>
                        <span>Cash</span>
                    </button>
                    <button class="pay-btn" data-method="card">
                        <i class="fas fa-credit-card"></i>
                        <span>Card</span>
                    </button>
                </div>
            </div>
            
            <button class="confirm-order-btn" id="valider-btn" disabled>
                <i class="fas fa-check"></i>
                <span>Place Order</span>
            </button>
        </div>
    </div>
</main>

<?php include "partials/footer.php"; ?>
<script src="js/order.js"></script>
</body>
</html>
