<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: var(--dark-brown);">
    <div class="container">
        <a class="navbar-brand" href="index.php"><i class="fas fa-coffee me-2"></i>BrewMaster</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php#menu">Menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php#products">Coffee</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>
            </ul>
            <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: var(--dark-brown);">
                <div class="container">
                    <a class="navbar-brand" href="#"><i class="fas fa-coffee me-2"></i>BrewMaster</a>
                    <div class="d-flex align-items-center">
                        <a href="index.php#products" class="btn btn-outline-light me-3" onclick="goBack()">
                            <i class="fas fa-arrow-left me-1"></i>Continue Shopping
                        </a>
                    </div>
                </div>
            </nav>
            <div class="d-flex align-items-center">
                <div class="position-relative me-3">
                    <button class="btn btn-outline-light" id="cartBtn">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="cart-badge" id="cartCount">0</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</nav>