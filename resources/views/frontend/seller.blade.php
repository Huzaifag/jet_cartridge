<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bulk Purchase from Seller</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
        :root {
            --primary-color: #1a3353;
            --secondary: #2c4c7c;
            --accent-color: #4CAF50;
            --primary-dark: #3a0ca3;
            --primary-light: #eef2ff;
            --success: #4cc9f0;
            --warning: #f9c74f;
            --danger: #f94144;
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #6c757d;
            --light-gray: #e9ecef;
            --border-radius: 12px;
            --shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f5f7fb;
            color: var(--dark);
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .seller-header {
            display: flex;
            align-items: center;
            background: white;
            border-radius: var(--border-radius);
            padding: 20px;
            box-shadow: var(--shadow);
            margin-bottom: 25px;
        }

        .seller-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(45deg, var(--primary), var(--secondary));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 32px;
            margin-right: 20px;
        }

        .seller-info h2 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 5px;
            color: var(--primary-dark);
        }

        .seller-info p {
            color: var(--gray);
            margin-bottom: 10px;
        }

        .seller-rating {
            display: flex;
            align-items: center;
            gap: 5px;
            color: #ffc107;
        }

        .bulk-purchase-container {
            display: grid;
            grid-template-columns: 1fr 350px;
            gap: 25px;
        }

        .products-section {
            background: white;
            border-radius: var(--border-radius);
            padding: 25px;
            box-shadow: var(--shadow);
        }

        .section-title {
            font-size: 20px;
            font-weight: 600;
            color: var(--primary-dark);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title i {
            color: var(--primary);
        }

        .search-box {
            position: relative;
            margin-bottom: 20px;
        }

        .search-box input {
            width: 100%;
            padding: 12px 15px 12px 40px;
            border: 1px solid var(--light-gray);
            border-radius: 30px;
            font-size: 15px;
            transition: var(--transition);
        }

        .search-box input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
        }

        .search-box i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray);
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .product-card {
            background: white;
            border: 1px solid var(--light-gray);
            border-radius: var(--border-radius);
            overflow: hidden;
            transition: var(--transition);
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            border-color: var(--primary);
        }

        .product-image {
            height: 180px;
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 50px;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-details {
            padding: 15px;
        }

        .product-title {
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--dark);
        }

        .product-price {
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 10px;
            font-size: 18px;
        }

        .product-meta {
            display: flex;
            justify-content: space-between;
            color: var(--gray);
            font-size: 14px;
            margin-bottom: 15px;
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .quantity-buttons {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .quantity-btn {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--primary-light);
            color: var(--primary);
            border: none;
            cursor: pointer;
            transition: var(--transition);
        }

        .quantity-btn:hover {
            background: var(--primary);
            color: white;
        }

        .quantity-input {
            width: 50px;
            text-align: center;
            border: 1px solid var(--light-gray);
            border-radius: 5px;
            padding: 5px;
            font-weight: 600;
        }

        .add-to-cart-btn {
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 5px;
            padding: 8px 15px;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .add-to-cart-btn:hover {
            background: var(--primary-dark);
        }

        .order-summary {
            background: white;
            border-radius: var(--border-radius);
            padding: 25px;
            box-shadow: var(--shadow);
            align-self: start;
            position: sticky;
            top: 20px;
        }

        .summary-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--primary-dark);
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--light-gray);
        }

        .summary-items {
            max-height: 300px;
            overflow-y: auto;
            margin-bottom: 20px;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--light-gray);
        }

        .item-details h4 {
            font-weight: 600;
            margin-bottom: 5px;
        }

        .item-details p {
            color: var(--gray);
            font-size: 14px;
        }

        .item-price {
            font-weight: 600;
            color: var(--primary);
        }

        .summary-total {
            border-top: 2px solid var(--light-gray);
            padding-top: 15px;
            margin-bottom: 20px;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .total-label {
            color: var(--gray);
        }

        .total-value {
            font-weight: 600;
        }

        .grand-total {
            font-size: 18px;
            font-weight: 700;
            color: var(--primary-dark);
        }

        .checkout-btn {
            width: 100%;
            padding: 15px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 30px;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .checkout-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }

        .bulk-discount-notice {
            background: var(--primary-light);
            border-radius: var(--border-radius);
            padding: 15px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .bulk-discount-notice i {
            color: var(--primary);
            font-size: 20px;
        }

        .discount-tiers {
            background: white;
            border-radius: var(--border-radius);
            padding: 20px;
            box-shadow: var(--shadow);
            margin-top: 25px;
        }

        .tiers-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--primary-dark);
            margin-bottom: 15px;
        }

        .tier-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid var(--light-gray);
        }

        .tier-item:last-child {
            border-bottom: none;
        }

        .tier-range {
            font-weight: 500;
        }

        .tier-discount {
            color: var(--primary);
            font-weight: 600;
        }

        .empty-cart {
            text-align: center;
            padding: 40px;
            color: var(--gray);
        }

        .empty-cart i {
            font-size: 50px;
            margin-bottom: 15px;
            color: var(--light-gray);
        }

        @media (max-width: 992px) {
            .bulk-purchase-container {
                grid-template-columns: 1fr;
            }

            .order-summary {
                position: static;
            }
        }

        @media (max-width: 576px) {
            .products-grid {
                grid-template-columns: 1fr;
            }

            .seller-header {
                flex-direction: column;
                text-align: center;
            }

            .seller-avatar {
                margin-right: 0;
                margin-bottom: 15px;
            }
        }
    </style>
</head>
<body>
    @include('components.header')

    <div class="container">
        <!-- Seller Header -->
        <div class="seller-header">
            <div class="seller-avatar">EC</div>
            <div class="seller-info">
                <h2>{{ $seller->company_name }}</h2>
                <p>{{ Str::title($seller->business_type) }}</p>
                <div class="seller-rating">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                    <span style="color: var(--gray); margin-left: 5px;">4.5 (128 reviews)</span>
                </div>
            </div>
        </div>

        <!-- Bulk Discount Notice -->
        <div class="bulk-discount-notice">
            <i class="fas fa-tag"></i>
            <div>
                <strong>Bulk Discounts Available!</strong> Save up to 25% when you order in larger quantities. Discounts are automatically applied at checkout.
            </div>
        </div>

        <div class="bulk-purchase-container">
            <!-- Products Section -->
            <div class="products-section">
                <h2 class="section-title"><i class="fas fa-box-open"></i> Available Products</h2>

                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="product-search" placeholder="Search products...">
                </div>

                <div class="products-grid" id="products-grid">
                    @foreach ($products as $product)
                    <div class="product-card" data-product-id="{{ $product->id }}" data-product-name="{{ $product->name }}" data-product-price="{{ $product->price }}" data-product-stock="{{ $product->stock_quantity }}">
                        <div class="product-image">
                            @php
                                $imagePath = str_replace('product-images/', '', $product->images[0]);
                            @endphp
                            <img class="img-fluid" src="{{ asset('storage/product-images/' . $imagePath) }}" alt="{{ $product->name }}">
                        </div>
                        <div class="product-details">
                            <h3 class="product-title">{{ $product->name }}</h3>
                            <div class="product-price">${{ number_format($product->price, 2) }}</div>
                            <div class="product-meta">
                                <span>In stock: <span class="stock-quantity">{{ $product->stock_quantity }}</span></span>
                            </div>
                            <div class="quantity-controls">
                                <div class="quantity-buttons">
                                    <button class="quantity-btn decrease">-</button>
                                    <input type="number" class="quantity-input" value="0" min="0" max="{{ $product->stock_quantity }}">
                                    <button class="quantity-btn increase">+</button>
                                </div>
                                <button class="add-to-cart-btn">
                                    <i class="fas fa-cart-plus"></i> Add
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Discount Tiers -->
                <div class="discount-tiers">
                    <h3 class="tiers-title"><i class="fas fa-percentage"></i> Bulk Discount Tiers</h3>
                    <div class="tier-item">
                        <span class="tier-range">10-24 units</span>
                        <span class="tier-discount">5% discount</span>
                    </div>
                    <div class="tier-item">
                        <span class="tier-range">25-49 units</span>
                        <span class="tier-discount">10% discount</span>
                    </div>
                    <div class="tier-item">
                        <span class="tier-range">50-99 units</span>
                        <span class="tier-discount">15% discount</span>
                    </div>
                    <div class="tier-item">
                        <span class="tier-range">100+ units</span>
                        <span class="tier-discount">25% discount</span>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="order-summary">
                <h3 class="summary-title"><i class="fas fa-shopping-cart"></i> Order Summary</h3>
                <div class="summary-items" id="summary-items">
                    <div class="empty-cart" id="empty-cart">
                        <i class="fas fa-shopping-cart"></i>
                        <p>Your cart is empty</p>
                    </div>
                </div>
                <div class="summary-total" id="summary-total">
                    <div class="total-row">
                        <span class="total-label">Subtotal</span>
                        <span class="total-value" id="subtotal">$0.00</span>
                    </div>
                    <div class="total-row">
                        <span class="total-label">Bulk Discount</span>
                        <span class="total-value" id="discount">$0.00</span>
                    </div>
                    <div class="total-row">
                        <span class="total-label">Shipping</span>
                        <span class="total-value" id="shipping">$0.00</span>
                    </div>
                    <div class="total-row grand-total">
                        <span class="total-label">Total</span>
                        <span class="total-value" id="total">$0.00</span>
                    </div>
                </div>
                <button class="checkout-btn" id="checkout-btn" disabled>
                    <i class="fas fa-lock"></i> Proceed to Checkout
                </button>
            </div>
        </div>
    </div>
    @include('components.footer')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Cart state
            let cart = [];

            // Discount tiers
            const discountTiers = [
                { min: 10, max: 24, discount: 0.05 },
                { min: 25, max: 49, discount: 0.10 },
                { min: 50, max: 99, discount: 0.15 },
                { min: 100, max: Infinity, discount: 0.25 }
            ];

            // Helper function to calculate discount
            function calculateDiscount(totalQuantity) {
                for (const tier of discountTiers) {
                    if (totalQuantity >= tier.min && totalQuantity <= tier.max) {
                        return tier.discount;
                    }
                }
                return 0;
            }

            // Helper function to format currency
            function formatCurrency(amount) {
                return `$${parseFloat(amount).toFixed(2)}`;
            }

            // Update order summary
            function updateOrderSummary() {
                const summaryItems = document.getElementById('summary-items');
                const emptyCart = document.getElementById('empty-cart');
                const subtotalElement = document.getElementById('subtotal');
                const discountElement = document.getElementById('discount');
                const shippingElement = document.getElementById('shipping');
                const totalElement = document.getElementById('total');
                const checkoutBtn = document.getElementById('checkout-btn');

                // Clear current items
                summaryItems.innerHTML = '';

                if (cart.length === 0) {
                    emptyCart.style.display = 'block';
                    checkoutBtn.disabled = true;
                    subtotalElement.textContent = formatCurrency(0);
                    discountElement.textContent = formatCurrency(0);
                    shippingElement.textContent = formatCurrency(0);
                    totalElement.textContent = formatCurrency(0);
                    return;
                }

                emptyCart.style.display = 'none';
                checkoutBtn.disabled = false;

                let subtotal = 0;
                let totalQuantity = 0;

                // Render cart items
                cart.forEach(item => {
                    const itemTotal = item.quantity * item.price;
                    subtotal += itemTotal;
                    totalQuantity += item.quantity;

                    const itemElement = document.createElement('div');
                    itemElement.className = 'summary-item';
                    itemElement.innerHTML = `
                        <div class="item-details">
                            <h4>${item.name}</h4>
                            <p>Qty: ${item.quantity} × ${formatCurrency(item.price)}</p>
                        </div>
                        <div class="item-price">${formatCurrency(itemTotal)}</div>
                    `;
                    summaryItems.appendChild(itemElement);
                });

                // Calculate discount
                const discountRate = calculateDiscount(totalQuantity);
                const discount = subtotal * discountRate;
                const shipping = totalQuantity > 0 ? 45 : 0; // Flat shipping rate
                const total = subtotal - discount + shipping;

                // Update summary
                subtotalElement.textContent = formatCurrency(subtotal);
                discountElement.textContent = `-${formatCurrency(discount)}`;
                shippingElement.textContent = formatCurrency(shipping);
                totalElement.textContent = formatCurrency(total);
            }

            // Quantity controls
            document.querySelectorAll('.quantity-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const input = this.parentElement.querySelector('.quantity-input');
                    const card = this.closest('.product-card');
                    const stock = parseInt(card.dataset.productStock);
                    let value = parseInt(input.value);

                    if (this.classList.contains('decrease')) {
                        if (value > 0) {
                            input.value = value - 1;
                        }
                    } else if (this.classList.contains('increase')) {
                        if (value < stock) {
                            input.value = value + 1;
                        } else {
                            alert(`Maximum stock available: ${stock}`);
                        }
                    }
                });
            });

            // Input validation
            document.querySelectorAll('.quantity-input').forEach(input => {
                input.addEventListener('change', function() {
                    const card = this.closest('.product-card');
                    const stock = parseInt(card.dataset.productStock);
                    let value = parseInt(this.value);

                    if (isNaN(value) || value < 0) {
                        this.value = 0;
                    } else if (value > stock) {
                        this.value = stock;
                        alert(`Maximum stock available: ${stock}`);
                    }
                });
            });

            // Add to cart
            document.querySelectorAll('.add-to-cart-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const card = this.closest('.product-card');
                    const productId = card.dataset.productId;
                    const productName = card.dataset.productName;
                    const productPrice = parseFloat(card.dataset.productPrice);
                    const quantity = parseInt(card.querySelector('.quantity-input').value);
                    const stock = parseInt(card.dataset.productStock);

                    if (quantity <= 0) {
                        alert('Please select at least 1 item');
                        return;
                    }

                    if (quantity > stock) {
                        alert(`Only ${stock} items available in stock`);
                        return;
                    }

                    // Update cart
                    const existingItem = cart.find(item => item.id === productId);
                    if (existingItem) {
                        existingItem.quantity = quantity;
                    } else {
                        cart.push({
                            id: productId,
                            name: productName,
                            price: productPrice,
                            quantity: quantity
                        });
                    }

                    // Update stock display (simulated)
                    card.querySelector('.stock-quantity').textContent = stock - quantity;

                    alert(`Added ${quantity} of ${productName} to your cart!`);
                    card.querySelector('.quantity-input').value = 0; // Reset input
                    updateOrderSummary();
                });
            });

            // Search functionality
            document.getElementById('product-search').addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                const productCards = document.querySelectorAll('.product-card');

                productCards.forEach(card => {
                    const productName = card.dataset.productName.toLowerCase();
                    card.style.display = productName.includes(searchTerm) ? 'block' : 'none';
                });
            });

            // Checkout button
            document.getElementById('checkout-btn').addEventListener('click', function() {
                if (cart.length === 0) {
                    alert('Your cart is empty!');
                    return;
                }
                alert('Proceeding to checkout...');
                // In a real app, redirect to checkout page with cart data
                // Example: window.location.href = '/checkout?cart=' + encodeURIComponent(JSON.stringify(cart));
            });

            // Initialize order summary
            updateOrderSummary();
        });
    </script>
</body>
</html>
