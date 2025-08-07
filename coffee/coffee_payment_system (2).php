<?php
// config.php - Database configuration
class Database {
    private $host = 'localhost';
    private $db_name = 'coffee_shop';
    private $username = 'root';
    private $password = '';
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, 
                                $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}

// database_setup.sql - Run this to create the database structure
/*
CREATE DATABASE coffee_shop;
USE coffee_shop;

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    image_url VARCHAR(255),
    category VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(100) NOT NULL,
    customer_email VARCHAR(100) NOT NULL,
    customer_phone VARCHAR(20),
    shipping_address TEXT NOT NULL,
    total_amount DECIMAL(10,2) NOT NULL,
    payment_method VARCHAR(50) NOT NULL,
    payment_status VARCHAR(20) DEFAULT 'pending',
    order_status VARCHAR(20) DEFAULT 'processing',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);

-- Insert sample products
INSERT INTO products (name, description, price, category) VALUES
('Ethiopian Blend', 'Rich and aromatic coffee from Ethiopian highlands', 24.99, 'beans'),
('Colombian Supreme', 'Smooth medium roast with chocolate notes', 22.99, 'beans'),
('French Roast', 'Dark roast with bold, smoky flavor', 21.99, 'beans'),
('Espresso Blend', 'Perfect for espresso machines', 26.99, 'beans'),
('Coffee Mug - Classic', 'Traditional ceramic coffee mug', 12.99, 'accessories'),
('French Press', 'Premium glass French press', 34.99, 'accessories');
*/

session_start();

// Initialize cart if not exists
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Handle cart operations
if ($_POST['action'] ?? '' === 'add_to_cart') {
    $product_id = (int)$_POST['product_id'];
    $quantity = (int)$_POST['quantity'];
    
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id] += $quantity;
    } else {
        $_SESSION['cart'][$product_id] = $quantity;
    }
    header('Location: payment.php');
    exit;
}

// Handle order processing
if ($_POST['action'] ?? '' === 'process_payment') {
    $database = new Database();
    $db = $database->getConnection();
    
    try {
        $db->beginTransaction();
        
        // Insert order
        $stmt = $db->prepare("INSERT INTO orders (customer_name, customer_email, customer_phone, shipping_address, total_amount, payment_method) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $_POST['customer_name'],
            $_POST['customer_email'], 
            $_POST['customer_phone'],
            $_POST['shipping_address'],
            $_POST['total_amount'],
            $_POST['payment_method']
        ]);
        
        $order_id = $db->lastInsertId();
        
        // Insert order items
        $stmt = $db->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
        
        foreach ($_SESSION['cart'] as $product_id => $quantity) {
            $product_stmt = $db->prepare("SELECT price FROM products WHERE id = ?");
            $product_stmt->execute([$product_id]);
            $product = $product_stmt->fetch(PDO::FETCH_ASSOC);
            
            $stmt->execute([$order_id, $product_id, $quantity, $product['price']]);
        }
        
        $db->commit();
        $_SESSION['cart'] = []; // Clear cart
        $success_message = "Order placed successfully! Order ID: " . $order_id;
        
    } catch (Exception $e) {
        $db->rollback();
        $error_message = "Error processing order: " . $e->getMessage();
    }
}

// Get products for display
$database = new Database();
$db = $database->getConnection();
$stmt = $db->prepare("SELECT * FROM products ORDER BY category, name");
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Calculate cart total
$cart_total = 0;
$cart_items = [];
if (!empty($_SESSION['cart'])) {
    $product_ids = implode(',', array_keys($_SESSION['cart']));
    $stmt = $db->prepare("SELECT * FROM products WHERE id IN ($product_ids)");
    $stmt->execute();
    $cart_products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($cart_products as $product) {
        $quantity = $_SESSION['cart'][$product['id']];
        $subtotal = $product['price'] * $quantity;
        $cart_total += $subtotal;
        $cart_items[] = [
            'product' => $product,
            'quantity' => $quantity,
            'subtotal' => $subtotal
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brew & Bean - Coffee Shop</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);
            min-height: 100vh;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            text-align: center;
            color: white;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 3em;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .header p {
            font-size: 1.2em;
            opacity: 0.9;
        }

        .main-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 30px;
        }

        .products-section, .cart-section {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }

        .section-title {
            font-size: 1.8em;
            margin-bottom: 20px;
            color: #8B4513;
            border-bottom: 3px solid #D2691E;
            padding-bottom: 10px;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .product-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .product-card h3 {
            color: #8B4513;
            margin-bottom: 8px;
        }

        .product-card p {
            color: #666;
            margin-bottom: 10px;
            font-size: 0.9em;
        }

        .product-price {
            font-size: 1.3em;
            font-weight: bold;
            color: #D2691E;
            margin-bottom: 15px;
        }

        .add-to-cart-form {
            display: flex;
            gap: 10px;
            align-items: center;
            justify-content: center;
        }

        .quantity-input {
            width: 60px;
            padding: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
            text-align: center;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: #8B4513;
            color: white;
        }

        .btn-primary:hover {
            background: #654321;
        }

        .btn-success {
            background: #28a745;
            color: white;
        }

        .btn-success:hover {
            background: #218838;
        }

        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            border-bottom: 1px solid #eee;
        }

        .cart-item:last-child {
            border-bottom: none;
        }

        .cart-total {
            font-size: 1.5em;
            font-weight: bold;
            text-align: right;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 2px solid #D2691E;
            color: #8B4513;
        }

        .payment-form {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            margin-top: 20px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #8B4513;
        }

        .form-group input, .form-group select, .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus, .form-group select:focus, .form-group textarea:focus {
            outline: none;
            border-color: #D2691E;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
            font-weight: bold;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        @media (max-width: 768px) {
            .main-content {
                grid-template-columns: 1fr;
            }
            
            .form-row {
                grid-template-columns: 1fr;
            }
            
            .header h1 {
                font-size: 2em;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>☕ Brew & Bean</h1>
            <p>Premium Coffee & Accessories</p>
        </div>

        <?php if (isset($success_message)): ?>
            <div class="alert alert-success"><?= htmlspecialchars($success_message) ?></div>
        <?php endif; ?>

        <?php if (isset($error_message)): ?>
            <div class="alert alert-error"><?= htmlspecialchars($error_message) ?></div>
        <?php endif; ?>

        <div class="main-content">
            <!-- Products Section -->
            <div class="products-section">
                <h2 class="section-title">Our Products</h2>
                <div class="product-grid">
                    <?php foreach ($products as $product): ?>
                        <div class="product-card">
                            <h3><?= htmlspecialchars($product['name']) ?></h3>
                            <p><?= htmlspecialchars($product['description']) ?></p>
                            <div class="product-price">$<?= number_format($product['price'], 2) ?></div>
                            <form method="POST" class="add-to-cart-form">
                                <input type="hidden" name="action" value="add_to_cart">
                                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                <input type="number" name="quantity" value="1" min="1" max="10" class="quantity-input">
                                <button type="submit" class="btn btn-primary">Add to Cart</button>
                            </form>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Cart Section -->
            <div class="cart-section">
                <h2 class="section-title">Shopping Cart</h2>
                <?php if (empty($cart_items)): ?>
                    <p>Your cart is empty. Add some products to get started!</p>
                <?php else: ?>
                    <?php foreach ($cart_items as $item): ?>
                        <div class="cart-item">
                            <div>
                                <strong><?= htmlspecialchars($item['product']['name']) ?></strong><br>
                                <small>Quantity: <?= $item['quantity'] ?> × $<?= number_format($item['product']['price'], 2) ?></small>
                            </div>
                            <div>$<?= number_format($item['subtotal'], 2) ?></div>
                        </div>
                    <?php endforeach; ?>
                    <div class="cart-total">
                        Total: $<?= number_format($cart_total, 2) ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Payment Form -->
        <?php if (!empty($cart_items)): ?>
        <div class="payment-form">
            <h2 class="section-title">Checkout</h2>
            <form method="POST">
                <input type="hidden" name="action" value="process_payment">
                <input type="hidden" name="total_amount" value="<?= $cart_total ?>">
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="customer_name">Full Name *</label>
                        <input type="text" id="customer_name" name="customer_name" required>
                    </div>
                    <div class="form-group">
                        <label for="customer_email">Email Address *</label>
                        <input type="email" id="customer_email" name="customer_email" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="customer_phone">Phone Number</label>
                        <input type="tel" id="customer_phone" name="customer_phone">
                    </div>
                    <div class="form-group">
                        <label for="payment_method">Payment Method *</label>
                        <select id="payment_method" name="payment_method" required>
                            <option value="">Select Payment Method</option>
                            <option value="credit_card">Credit Card</option>
                            <option value="debit_card">Debit Card</option>
                            <option value="paypal">PayPal</option>
                            <option value="cash_on_delivery">Cash on Delivery</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="shipping_address">Shipping Address *</label>
                    <textarea id="shipping_address" name="shipping_address" rows="3" required 
                              placeholder="Enter your complete shipping address"></textarea>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success" style="width: 100%; padding: 15px; font-size: 18px;">
                        Place Order - $<?= number_format($cart_total, 2) ?>
                    </button>
                </div>
            </form>
        </div>
        <?php endif; ?>
    </div>

    <script>
        // Add some interactivity
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-focus first form field
            const firstInput = document.querySelector('input[required]');
            if (firstInput) {
                firstInput.focus();
            }

            // Form validation
            const form = document.querySelector('form[method="POST"]');
            if (form && form.querySelector('input[name="action"][value="process_payment"]')) {
                form.addEventListener('submit', function(e) {
                    const name = document.getElementById('customer_name').value.trim();
                    const email = document.getElementById('customer_email').value.trim();
                    const address = document.getElementById('shipping_address').value.trim();
                    const payment = document.getElementById('payment_method').value;

                    if (!name || !email || !address || !payment) {
                        e.preventDefault();
                        alert('Please fill in all required fields.');
                        return false;
                    }

                    if (!confirm('Are you sure you want to place this order for $<?= number_format($cart_total, 2) ?>?')) {
                        e.preventDefault();
                        return false;
                    }
                });
            }
        });
    </script>
</body>
</html>