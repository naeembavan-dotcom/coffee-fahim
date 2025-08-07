<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BrewMaster Coffee - Premium Coffee Online</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <?php include("css/style.css"); ?>
</head>

<body>
    <?php include("navigation.php"); ?>
      <div class="container">
        <div class="checkout-container">
            <!-- Checkout Header -->
            <div class="checkout-header">
                <h1><i class="fas fa-shopping-bag me-2"></i>Secure Checkout</h1>
                <div class="checkout-progress">
                    <div class="progress-step active">
                        <i class="fas fa-shopping-cart"></i>
                        Cart Review
                    </div>
                    <div class="progress-divider"></div>
                    <div class="progress-step">
                        <i class="fas fa-user"></i>
                        Information
                    </div>
                    <div class="progress-divider"></div>
                    <div class="progress-step">
                        <i class="fas fa-credit-card"></i>
                        Payment
                    </div>
                </div>
            </div>

            <!-- Order Success (Hidden initially) -->
            <div class="order-success" id="orderSuccess">
                <div class="success-animation">
                    <i class="fas fa-check fa-3x text-white"></i>
                </div>
                <h2 class="text-success mb-3">Order Placed Successfully!</h2>
                <p class="lead mb-4">Thank you for choosing BrewMaster Coffee. Your premium coffee is on its way!</p>
                <div class="mb-4">
                    <strong>Order #: </strong><span id="orderNumber">BM-2025-001234</span><br>
                    <strong>Estimated Delivery: </strong>3-5 business days
                </div>
                <div class="coffee-animation mb-4">
                    <i class="fas fa-coffee fa-3x" style="color: var(--primary-brown);"></i>
                </div>
                <button class="btn btn-coffee text-white" onclick="goBack()">
                    Continue Shopping
                </button>
            </div>

            <!-- Checkout Form -->
            <div class="checkout-form" id="checkoutForm">
                <div class="row p-4">
                    <!-- Left Column - Forms -->
                    <div class="col-lg-8">
                        <!-- Order Review -->
                        <div class="section-card">
                            <h3 class="section-title">
                                <i class="fas fa-list"></i>
                                Order Review
                            </h3>
                            <div id="orderItems">
                                <!-- Order items will be populated here -->
                            </div>
                        </div>

                        <!-- Customer Information -->
                        <div class="section-card">
                            <h3 class="section-title">
                                <i class="fas fa-user"></i>
                                Customer Information
                            </h3>
                            <form id="customerForm">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">First Name *</label>
                                        <input type="text" class="form-control" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Last Name *</label>
                                        <input type="text" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8 mb-3">
                                        <label class="form-label">Email Address *</label>
                                        <input type="email" class="form-control" required>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Phone Number *</label>
                                        <input type="tel" class="form-control" required>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Shipping Address -->
                        <div class="section-card">
                            <h3 class="section-title">
                                <i class="fas fa-shipping-fast"></i>
                                Shipping Address
                            </h3>
                            <form id="shippingForm">
                                <div class="mb-3">
                                    <label class="form-label">Street Address *</label>
                                    <input type="text" class="form-control" required>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">City *</label>
                                        <input type="text" class="form-control" required>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">State *</label>
                                        <select class="form-select" required>
                                            <option value="">Select State</option>
                                            <option value="AL">Alabama</option>
                                            <option value="CA">California</option>
                                            <option value="FL">Florida</option>
                                            <option value="NY">New York</option>
                                            <option value="TX">Texas</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">ZIP Code *</label>
                                        <input type="text" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="saveAddress">
                                    <label class="form-check-label" for="saveAddress">
                                        Save this address for future orders
                                    </label>
                                </div>
                            </form>
                        </div>

                        <!-- Payment Method -->
                        <div class="section-card">
                            <h3 class="section-title">
                                <i class="fas fa-credit-card"></i>
                                Payment Method
                            </h3>
                            
                            <!-- Credit Card Option -->
                            <div class="payment-method selected" data-method="card">
                                <input type="radio" name="payment" id="creditCard" value="card" checked>
                                <label for="creditCard" class="d-flex align-items-center w-100">
                                    <div class="payment-icon">
                                        <i class="fas fa-credit-card"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">Credit/Debit Card</h6>
                                        <small class="text-muted">Secure payment with SSL encryption</small>
                                    </div>
                                </label>
                            </div>

                            <!-- PayPal Option -->
                            <div class="payment-method" data-method="paypal">
                                <input type="radio" name="payment" id="paypal" value="paypal">
                                <label for="paypal" class="d-flex align-items-center w-100">
                                    <div class="payment-icon">
                                        <i class="fab fa-paypal"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">PayPal</h6>
                                        <small class="text-muted">Pay securely with your PayPal account</small>
                                    </div>
                                </label>
                            </div>

                            <!-- Apple Pay Option -->
                            <div class="payment-method" data-method="applepay">
                                <input type="radio" name="payment" id="applePay" value="applepay">
                                <label for="applePay" class="d-flex align-items-center w-100">
                                    <div class="payment-icon">
                                        <i class="fab fa-apple-pay"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">Apple Pay</h6>
                                        <small class="text-muted">Touch ID or Face ID required</small>
                                    </div>
                                </label>
                            </div>

                            <!-- Card Details Form -->
                            <div class="card-details mt-4" id="cardDetails">
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label class="form-label">Card Number *</label>
                                        <input type="text" class="form-control" placeholder="1234 5678 9012 3456" maxlength="19">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Expiry Date *</label>
                                        <input type="text" class="form-control" placeholder="MM/YY" maxlength="5">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">CVV *</label>
                                        <input type="text" class="form-control" placeholder="123" maxlength="4">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">ZIP Code *</label>
                                        <input type="text" class="form-control" placeholder="12345">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column - Order Summary -->
                    <div class="col-lg-4">
                        <div class="total-summary">
                            <h4 class="mb-3" style="color: var(--dark-brown);">
                                <i class="fas fa-receipt me-2"></i>Order Summary
                            </h4>
                            
                            <div class="total-row">
                                <span>Subtotal:</span>
                                <span id="subtotal">$0.00</span>
                            </div>
                            
                            <div class="total-row">
                                <span>Shipping:</span>
                                <span id="shipping">$5.99</span>
                            </div>
                            
                            <div class="total-row">
                                <span>Tax:</span>
                                <span id="tax">$0.00</span>
                            </div>

                            <!-- Promo Code Section -->
                            <div class="promo-code-section">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Enter promo code" id="promoCode">
                                    <button class="btn btn-outline-secondary" type="button" onclick="applyPromo()">
                                        Apply
                                    </button>
                                </div>
                                <div class="mt-2" id="promoMessage" style="display: none;">
                                    <small class="text-success">
                                        <i class="fas fa-check me-1"></i>
                                        Promo code applied! You saved $5.00
                                    </small>
                                </div>
                            </div>
                            
                            <div class="total-row final">
                                <span>Total:</span>
                                <span id="finalTotal">$0.00</span>
                            </div>
                            
                            <button class="btn btn-coffee text-white w-100 mt-3" onclick="placeOrder()">
                                <i class="fas fa-lock me-2"></i>
                                Place Secure Order
                            </button>

                            <div class="security-badges">
                                <div class="security-badge">
                                    <i class="fas fa-shield-alt me-1"></i>SSL
                                </div>
                                <div class="security-badge">
                                    <i class="fas fa-lock me-1"></i>256-bit
                                </div>
                                <div class="security-badge">
                                    <i class="fas fa-award me-1"></i>Secure
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("footer.php"); ?>
</body>

</html>