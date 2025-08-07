<!-- Coffee Slider Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-6 fw-bold">Featured Coffee Collection</h2>
            <p class="lead">Discover our most popular premium coffee selections</p>
        </div>

        <div id="coffeeSlider" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#coffeeSlider" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#coffeeSlider" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#coffeeSlider" data-bs-slide-to="2"></button>
                <button type="button" data-bs-target="#coffeeSlider" data-bs-slide-to="3"></button>
            </div>

            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="slider-image-container">
                                <div class="slider-coffee-img">
                                    <div class="coffee-beans-bg">
                                        <div class="bean"></div>
                                        <div class="bean"></div>
                                        <div class="bean"></div>
                                        <div class="bean"></div>
                                        <div class="bean"></div>
                                    </div>
                                    <div class="coffee-cup">☕</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="slider-content">
                                <h3 class="display-6 fw-bold text-primary mb-3">Ethiopian Yirgacheffe</h3>
                                <p class="lead mb-4">Experience the bright, floral notes with citrus undertones from the
                                    birthplace of coffee. This premium arabica offers a complex flavor profile that
                                    coffee connoisseurs adore.</p>
                                <div class="mb-3">
                                    <span class="badge bg-primary me-2">Arabica</span>
                                    <span class="badge bg-success me-2">Fair Trade</span>
                                    <span class="badge bg-warning text-dark">Premium</span>
                                </div>
                                <div class="d-flex align-items-center mb-4">
                                    <div class="rating me-3">
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                    </div>
                                    <span class="price fs-4">$24.99</span>
                                </div>
                                <button class="btn btn-coffee text-white btn-lg" onclick="addToCart(1)">
                                    <i class="fas fa-cart-plus me-2"></i>Add to Cart
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="slider-image-container">
                                <div class="slider-coffee-img colombian">
                                    <div class="coffee-beans-bg">
                                        <div class="bean"></div>
                                        <div class="bean"></div>
                                        <div class="bean"></div>
                                        <div class="bean"></div>
                                        <div class="bean"></div>
                                    </div>
                                    <div class="coffee-cup">☕</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="slider-content">
                                <h3 class="display-6 fw-bold text-primary mb-3">Colombian Supreme</h3>
                                <p class="lead mb-4">Rich, full-bodied coffee with chocolate notes from the Colombian
                                    highlands. This supreme grade arabica delivers a perfectly balanced cup with
                                    exceptional smoothness.</p>
                                <div class="mb-3">
                                    <span class="badge bg-primary me-2">Arabica</span>
                                    <span class="badge bg-success me-2">Organic</span>
                                    <span class="badge bg-info text-dark">Medium Roast</span>
                                </div>
                                <div class="d-flex align-items-center mb-4">
                                    <div class="rating me-3">
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star-half-alt text-warning"></i>
                                    </div>
                                    <span class="price fs-4">$22.99</span>
                                </div>
                                <button class="btn btn-coffee text-white btn-lg" onclick="addToCart(2)">
                                    <i class="fas fa-cart-plus me-2"></i>Add to Cart
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="slider-image-container">
                                <div class="slider-coffee-img jamaican">
                                    <div class="coffee-beans-bg">
                                        <div class="bean"></div>
                                        <div class="bean"></div>
                                        <div class="bean"></div>
                                        <div class="bean"></div>
                                        <div class="bean"></div>
                                    </div>
                                    <div class="coffee-cup">☕</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="slider-content">
                                <h3 class="display-6 fw-bold text-primary mb-3">Jamaican Blue Mountain</h3>
                                <p class="lead mb-4">The world's most sought-after coffee, grown in the misty peaks of
                                    Jamaica's Blue Mountains. Known for its exceptional mild flavor and complete lack of
                                    bitterness.</p>
                                <div class="mb-3">
                                    <span class="badge bg-primary me-2">Arabica</span>
                                    <span class="badge bg-danger me-2">Luxury</span>
                                    <span class="badge bg-warning text-dark">Limited Edition</span>
                                </div>
                                <div class="d-flex align-items-center mb-4">
                                    <div class="rating me-3">
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                    </div>
                                    <span class="price fs-4">$49.99</span>
                                </div>
                                <button class="btn btn-coffee text-white btn-lg" onclick="addToCart(9)">
                                    <i class="fas fa-cart-plus me-2"></i>Add to Cart
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="slider-image-container">
                                <div class="slider-coffee-img blend">
                                    <div class="coffee-beans-bg">
                                        <div class="bean"></div>
                                        <div class="bean"></div>
                                        <div class="bean"></div>
                                        <div class="bean"></div>
                                        <div class="bean"></div>
                                    </div>
                                    <div class="coffee-cup">☕</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="slider-content">
                                <h3 class="display-6 fw-bold text-primary mb-3">House Blend Special</h3>
                                <p class="lead mb-4">Our signature blend combining the best of arabica and robusta
                                    beans. Perfectly balanced for everyday enjoyment with rich flavor and satisfying
                                    body.</p>
                                <div class="mb-3">
                                    <span class="badge bg-secondary me-2">Blend</span>
                                    <span class="badge bg-success me-2">House Special</span>
                                    <span class="badge bg-primary text-white">Best Seller</span>
                                </div>
                                <div class="d-flex align-items-center mb-4">
                                    <div class="rating me-3">
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star-half-alt text-warning"></i>
                                    </div>
                                    <span class="price fs-4">$21.99</span>
                                </div>
                                <button class="btn btn-coffee text-white btn-lg" onclick="addToCart(7)">
                                    <i class="fas fa-cart-plus me-2"></i>Add to Cart
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#coffeeSlider" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#coffeeSlider" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</section>