
<!-- Footer -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
<script>
    // Coffee products data
    const coffeeProducts = [
        {
            id: 1,
            name: "Ethiopian Yirgacheffe",
            price: 24.99,
            category: "arabica",
            rating: 4.8,
            description: "Bright, floral notes with citrus undertones",
            image: "☕"
        },
        {
            id: 2,
            name: "Colombian Supreme",
            price: 22.99,
            category: "arabica",
            rating: 4.7,
            description: "Rich, full-bodied with chocolate notes",
            image: "☕"
        },
        {
            id: 3,
            name: "Brazilian Santos",
            price: 19.99,
            category: "arabica",
            rating: 4.6,
            description: "Smooth, nutty flavor with low acidity",
            image: "☕"
        },
        {
            id: 4,
            name: "Guatemalan Antigua",
            price: 26.99,
            category: "arabica",
            rating: 4.9,
            description: "Complex, smoky with spice undertones",
            image: "☕"
        },
        {
            id: 5,
            name: "Vietnamese Robusta",
            price: 18.99,
            category: "robusta",
            rating: 4.4,
            description: "Strong, bold flavor with high caffeine",
            image: "☕"
        },
        {
            id: 6,
            name: "Uganda Robusta",
            price: 17.99,
            category: "robusta",
            rating: 4.3,
            description: "Earthy, woody with intense flavor",
            image: "☕"
        },
        {
            id: 7,
            name: "House Blend Special",
            price: 21.99,
            category: "blend",
            rating: 4.7,
            description: "Perfect balance of arabica and robusta",
            image: "☕"
        },
        {
            id: 8,
            name: "Morning Kick Blend",
            price: 20.99,
            category: "blend",
            rating: 4.5,
            description: "High caffeine blend for early risers",
            image: "☕"
        },
        {
            id: 9,
            name: "Jamaican Blue Mountain",
            price: 49.99,
            category: "arabica",
            rating: 5.0,
            description: "The world's most sought-after coffee",
            image: "☕"
        },
        {
            id: 10,
            name: "Italian Dark Roast",
            price: 23.99,
            category: "blend",
            rating: 4.6,
            description: "Bold, intense flavor with smoky finish",
            image: "☕"
        }
    ];

    let cart = [];

    // Initialize the page
    document.addEventListener('DOMContentLoaded', function () {
        renderCoffeeGrid(coffeeProducts);
        setupEventListeners();
    });

    function renderCoffeeGrid(products) {
        const grid = document.getElementById('coffeeGrid');
        grid.innerHTML = '';

        products.forEach(coffee => {
            const coffeeCard = `
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card coffee-card h-100">
                            <div class="coffee-img">
                                ${coffee.image}
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">${coffee.name}</h5>
                                <p class="card-text">${coffee.description}</p>
                                <div class="d-flex align-items-center mb-2">
                                    <div class="rating me-2">
                                        ${generateStars(coffee.rating)}
                                    </div>
                                    <small class="text-muted">${coffee.rating}/5</small>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="price">$${coffee.price.toFixed(2)}</span>
                                    <button class="btn btn-coffee text-white" onclick="addToCart(${coffee.id})">
                                        <i class="fas fa-cart-plus me-1"></i>Add to Cart
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            grid.innerHTML += coffeeCard;
        });
    }

    function generateStars(rating) {
        let stars = '';
        for (let i = 1; i <= 5; i++) {
            if (i <= Math.floor(rating)) {
                stars += '<i class="fas fa-star"></i>';
            } else if (i - rating < 1) {
                stars += '<i class="fas fa-star-half-alt"></i>';
            } else {
                stars += '<i class="far fa-star"></i>';
            }
        }
        return stars;
    }

    function setupEventListeners() {
        // Category filter buttons
        const categoryBtns = document.querySelectorAll('.category-btn');
        categoryBtns.forEach(btn => {
            btn.addEventListener('click', function () {
                categoryBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');

                const filter = this.getAttribute('data-filter');
                const filtered = filter === 'all' ? coffeeProducts :
                    coffeeProducts.filter(coffee => coffee.category === filter);
                renderCoffeeGrid(filtered);
            });
        });

        // Cart button
        document.getElementById('cartBtn').addEventListener('click', function () {
            const cartModal = new bootstrap.Modal(document.getElementById('cartModal'));
            cartModal.show();
        });

        // Checkout button
        document.getElementById('checkoutBtn').addEventListener('click', function () {
            if (cart.length === 0) {
                alert('Your cart is empty!');
                return;
            }
            alert('Checkout functionality would be implemented here!');
        });
    }

    function addToCart(productId) {
        const product = coffeeProducts.find(p => p.id === productId);
        const existingItem = cart.find(item => item.id === productId);

        if (existingItem) {
            existingItem.quantity += 1;
        } else {
            cart.push({
                ...product,
                quantity: 1
            });
        }

        updateCartDisplay();
        showAddToCartAnimation();
    }

    function updateCartDisplay() {
        const cartCount = document.getElementById('cartCount');
        const cartItems = document.getElementById('cartItems');
        const cartTotal = document.getElementById('cartTotal');

        // Update cart count
        const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
        cartCount.textContent = totalItems;

        // Update cart items
        if (cart.length === 0) {
            cartItems.innerHTML = '<p class="text-center text-muted">Your cart is empty</p>';
        } else {
            cartItems.innerHTML = cart.map(item => `
                    <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                        <div>
                            <h6 class="mb-0">${item.name}</h6>
                            <small class="text-muted">$${item.price.toFixed(2)} each</small>
                        </div>
                        <div class="d-flex align-items-center">
                            <button class="btn btn-sm btn-outline-secondary" onclick="changeQuantity(${item.id}, -1)">-</button>
                            <span class="mx-2">${item.quantity}</span>
                            <button class="btn btn-sm btn-outline-secondary" onclick="changeQuantity(${item.id}, 1)">+</button>
                            <button class="btn btn-sm btn-danger ms-2" onclick="removeFromCart(${item.id})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                `).join('');
        }

        // Update total
        const total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
        cartTotal.textContent = `$${total.toFixed(2)}`;
    }

    function changeQuantity(productId, change) {
        const item = cart.find(item => item.id === productId);
        if (item) {
            item.quantity += change;
            if (item.quantity <= 0) {
                removeFromCart(productId);
            } else {
                updateCartDisplay();
            }
        }
    }

    function removeFromCart(productId) {
        cart = cart.filter(item => item.id !== productId);
        updateCartDisplay();
    }

    function showAddToCartAnimation() {
        const cartBtn = document.getElementById('cartBtn');
        cartBtn.classList.add('btn-success');
        setTimeout(() => {
            cartBtn.classList.remove('btn-success');
        }, 300);
    }

    // Smooth scrolling for navigation links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
</script>
<footer class="py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h5><i class="fas fa-coffee me-2"></i>BrewMaster Coffee</h5>
                <p>Premium coffee experience since 2003</p>
            </div>
            <div class="col-md-6 text-md-end">
                <div class="social-links">
                    <a href="#" class="text-white me-3"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="text-white me-3"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
        </div>
        <hr class="my-3">
        <div class="text-center">
            <p>&copy; 2025 BrewMaster Coffee. All rights reserved.</p>
        </div>
    </div>
</footer>