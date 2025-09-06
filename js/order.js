// Kaser Diafa - Order System
// Clean, functional JavaScript

const Menu = {
    appetizers: [
        { name: 'Harira Soup', price: 25.00, description: 'Traditional Moroccan soup with lentils and chickpeas' },
        { name: 'Zaalouk', price: 20.00, description: 'Grilled eggplant salad with tomatoes and spices' },
        { name: 'Briouats', price: 30.00, description: 'Crispy pastries filled with meat or cheese' },
        { name: 'Moroccan Salad', price: 22.00, description: 'Fresh mixed vegetables with olive oil dressing' }
    ],
    'main-courses': [
        { name: 'Couscous Royal', price: 85.00, description: 'Traditional couscous with lamb, chicken, and vegetables' },
        { name: 'Pastilla', price: 75.00, description: 'Sweet and savory pie with pigeon meat and almonds' },
        { name: 'Mechoui', price: 95.00, description: 'Slow-roasted lamb shoulder with herbs' },
        { name: 'Chicken Tagine', price: 65.00, description: 'Chicken cooked with preserved lemons and olives' }
    ],
    tagines: [
        { name: 'Lamb Tagine with Prunes', price: 80.00, description: 'Tender lamb with sweet prunes and almonds' },
        { name: 'Fish Tagine', price: 70.00, description: 'Fresh fish with tomatoes, peppers, and herbs' },
        { name: 'Vegetable Tagine', price: 55.00, description: 'Seasonal vegetables in aromatic broth' },
        { name: 'Beef Tagine with Apricots', price: 75.00, description: 'Beef with dried apricots and honey' }
    ],
    grilled: [
        { name: 'Grilled Lamb Chops', price: 90.00, description: 'Marinated lamb chops with Moroccan spices' },
        { name: 'Grilled Fish', price: 75.00, description: 'Fresh fish grilled with herbs and lemon' },
        { name: 'Mixed Grill Platter', price: 95.00, description: 'Selection of grilled meats and vegetables' },
        { name: 'Grilled Chicken', price: 60.00, description: 'Marinated chicken with garlic and herbs' }
    ],
    desserts: [
        { name: 'Baklava', price: 25.00, description: 'Layered pastry with nuts and honey' },
        { name: 'Chebakia', price: 20.00, description: 'Traditional Moroccan sesame cookies' },
        { name: 'Fresh Fruit Salad', price: 18.00, description: 'Seasonal fruits with mint syrup' },
        { name: 'Moroccan Tea', price: 15.00, description: 'Traditional mint tea with pastries' }
    ],
    beverages: [
        { name: 'Fresh Orange Juice', price: 20.00, description: 'Freshly squeezed orange juice' },
        { name: 'Mint Tea', price: 15.00, description: 'Traditional Moroccan mint tea' },
        { name: 'Moroccan Coffee', price: 18.00, description: 'Traditional spiced coffee' },
        { name: 'Fresh Lemonade', price: 16.00, description: 'Homemade lemonade with mint' }
    ]
};

class OrderSystem {
    constructor() {
        this.selectedOrderType = 'dine-in';
        this.selectedPaymentMethod = '';
        this.orderItems = [];
        this.init();
    }

    init() {
        this.setupEventListeners();
        this.showMenuItems('appetizers');
        this.updateOrderTypeDisplay();
    }

    setupEventListeners() {
        // Order type selection
        document.querySelectorAll('.order-type-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                document.querySelectorAll('.order-type-btn').forEach(b => b.classList.remove('active'));
                e.currentTarget.classList.add('active');
                this.selectedOrderType = e.currentTarget.dataset.type;
                this.updateOrderTypeDisplay();
            });
        });

        // Category selection
        document.querySelectorAll('.category-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                document.querySelectorAll('.category-btn').forEach(b => b.classList.remove('active'));
                e.currentTarget.classList.add('active');
                this.showMenuItems(e.currentTarget.dataset.category);
            });
        });

        // Payment method selection
        document.querySelectorAll('.pay-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                document.querySelectorAll('.pay-btn').forEach(b => b.classList.remove('active'));
                e.currentTarget.classList.add('active');
                this.selectedPaymentMethod = e.currentTarget.dataset.method;
                this.updateConfirmButton();
            });
        });

        // Confirm order
        document.getElementById('valider-btn').addEventListener('click', () => {
            this.confirmOrder();
        });
    }

    showMenuItems(category) {
        const menuContainer = document.getElementById('menu-items');
        const items = Menu[category];
        
        menuContainer.innerHTML = '';
        
        items.forEach(item => {
            const itemElement = document.createElement('div');
            itemElement.className = 'menu-item';
            itemElement.innerHTML = `
                <div class="item-info">
                    <div class="item-name">${item.name}</div>
                    <div class="item-description">${item.description}</div>
                </div>
                <div class="item-price">${item.price} MAD</div>
                <div style="display: flex; gap: 0.5rem;">
                    <button class="add-btn" onclick="orderSystem.addToOrder('${item.name}', ${item.price})">
                        Add
                    </button>
                    <button style="background: #ef4444; color: #fff; border: none; border-radius: 6px; padding: 0.5rem; cursor: pointer;" onclick="orderSystem.addToFavorites('${item.name}')" title="Add to Favorites">
                        <i class="fas fa-heart"></i>
                    </button>
                </div>
            `;
            menuContainer.appendChild(itemElement);
        });
    }

    addToOrder(name, price) {
        const existingItem = this.orderItems.find(item => item.name === name);
        
        if (existingItem) {
            existingItem.quantity += 1;
        } else {
            this.orderItems.push({
                name: name,
                price: price,
                quantity: 1
            });
        }
        
        this.updateOrderDisplay();
    }

    removeFromOrder(name) {
        this.orderItems = this.orderItems.filter(item => item.name !== name);
        this.updateOrderDisplay();
    }

    updateQuantity(name, change) {
        const item = this.orderItems.find(item => item.name === name);
        if (item) {
            item.quantity += change;
            if (item.quantity <= 0) {
                this.removeFromOrder(name);
            } else {
                this.updateOrderDisplay();
            }
        }
    }

    updateOrderDisplay() {
        const container = document.getElementById('orders-container');
        
        if (this.orderItems.length === 0) {
            container.innerHTML = `
                <div class="empty-order">
                    <i class="fas fa-shopping-cart"></i>
                    <p>Your cart is empty</p>
                </div>
            `;
        } else {
            container.innerHTML = this.orderItems.map(item => `
                <div class="order-item">
                    <div class="order-item-info">
                        <div class="order-item-name">${item.name}</div>
                        <div class="order-item-price">${item.price} MAD each</div>
                    </div>
                    <div class="order-item-controls">
                        <button class="quantity-btn" onclick="orderSystem.updateQuantity('${item.name}', -1)">-</button>
                        <span class="quantity">${item.quantity}</span>
                        <button class="quantity-btn" onclick="orderSystem.updateQuantity('${item.name}', 1)">+</button>
                        <button class="remove-btn" onclick="orderSystem.removeFromOrder('${item.name}')">×</button>
                    </div>
                </div>
            `).join('');
        }
        
        this.updateTotals();
        this.updateConfirmButton();
    }

    updateTotals() {
        const subtotal = this.orderItems.reduce((sum, item) => sum + (item.price * item.quantity), 0);
        
        document.getElementById('subtotal').textContent = `${subtotal.toFixed(2)} MAD`;
        document.getElementById('total').textContent = `${subtotal.toFixed(2)} MAD`;
    }

    updateOrderTypeDisplay() {
        const display = document.getElementById('order-type-display');
        const typeNames = {
            'dine-in': 'Dine In',
            'takeaway': 'Takeaway',
            'delivery': 'Delivery'
        };
        display.textContent = typeNames[this.selectedOrderType];
    }

    updateConfirmButton() {
        const button = document.getElementById('valider-btn');
        const canConfirm = this.orderItems.length > 0 && this.selectedPaymentMethod;
        
        button.disabled = !canConfirm;
    }

    addToFavorites(name) {
        // Simple favorites using fetch
        fetch('client/favorites.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `action=add&item_name=${encodeURIComponent(name)}`
        })
        .then(() => {
            alert(`${name} added to favorites!`);
        })
        .catch(() => {
            alert('Error adding to favorites');
        });
    }

    async confirmOrder() {
        if (!this.selectedOrderType) {
            alert('Please select an order type');
            return;
        }
        
        if (this.orderItems.length === 0) {
            alert('Please add items to your order');
            return;
        }
        
        if (!this.selectedPaymentMethod) {
            alert('Please select a payment method');
            return;
        }

        const orderData = {
            order_type: this.selectedOrderType,
            items: this.orderItems,
            payment: this.selectedPaymentMethod
        };

        try {
            const response = await fetch('orders/save_order.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(orderData)
            });

            const result = await response.json();
            
            if (result.success) {
                alert('Order placed successfully! Thank you for choosing Kaser Diafa.');
                location.reload();
            } else {
                alert('Failed to place order: ' + result.error);
            }
        } catch (error) {
            alert('Error placing order. Please try again.');
            console.error('Error:', error);
        }
    }
}

// Initialize the order system when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    window.orderSystem = new OrderSystem();
});
