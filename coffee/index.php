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
    <!-- Hero Section -->
    <section id="home" class="hero-section">
        <div class="container text-center">
            <h1 class="display-4 fw-bold mb-4">Premium Coffee Experience</h1>
            <p class="lead mb-4">Discover the world's finest coffee beans, roasted to perfection</p>
            <a href="#products" class="btn btn-coffee btn-lg text-white">Shop Now</a>
        </div>
    </section>   

    <?php include("menu.php"); ?>
    <?php include("slider.php"); ?>

    <!-- Products Section -->
    <section id="products" class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold">Our Premium Coffee</h2>
                <p class="lead">Handpicked from the finest coffee regions around the world</p>
            </div>
            
            <!-- Category Filter -->
            <div class="category-filter text-center">
                <button class="btn btn-outline-secondary category-btn active" data-filter="all">All Coffee</button>
                <button class="btn btn-outline-secondary category-btn" data-filter="arabica">Arabica</button>
                <button class="btn btn-outline-secondary category-btn" data-filter="robusta">Robusta</button>
                <button class="btn btn-outline-secondary category-btn" data-filter="blend">Blends</button>
            </div>

            <div class="row" id="coffeeGrid">
                <!-- Coffee products will be populated by JavaScript -->
            </div>
        </div>
    </section>
  

    <!-- Cart Modal -->
    <div class="modal fade" id="cartModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-shopping-cart me-2"></i>Shopping Cart</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div id="cartItems">
                        <p class="text-center text-muted">Your cart is empty</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="w-100">
                        <div class="d-flex justify-content-between mb-3">
                            <h5>Total: <span id="cartTotal">$0.00</span></h5>
                        </div>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Continue Shopping</button>
                        <button type="button" class="btn btn-coffee text-white" id="checkoutBtn1"><a href="checkout.php">Checkout</a></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

   
    <?php include("footer.php"); ?>
</body>
</html>