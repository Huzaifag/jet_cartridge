<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - GlobalTradeHub</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
        :root {
            --primary: #3a77ff;
            --secondary: #ff6b01;
            --light-bg: #f8f9fa;
            --dark-text: #2d333a;
            --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            --gradient-primary: linear-gradient(135deg, #3a77ff 0%, #2a5dff 100%);
        }

        body {
            background-color: #f8f9fa;
            color: var(--dark-text);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar {
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: 700;
            color: var(--primary);
            font-size: 1.5rem;
        }

        .cart-container {
            max-width: 1200px;
            margin: 2rem auto;
        }

        .page-title {
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: var(--dark-text);
        }

        .card {
            background: #ffffff;
            border: none;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            margin-bottom: 1.5rem;
        }

        .card-header {
            background: white;
            border-bottom: 1px solid #e9ecef;
            padding: 1rem 1.5rem;
            font-weight: 600;
            color: var(--dark-text);
        }

        .card-body {
            padding: 1.5rem;
        }

        .cart-item {
            display: flex;
            padding: 1.5rem;
            border-bottom: 1px solid #f1f3f5;
        }

        .cart-item:last-child {
            border-bottom: none;
        }

        .item-image {
            width: 120px;
            height: 120px;
            object-fit: contain;
            border-radius: 8px;
            background: #f8f9fa;
            padding: 10px;
        }

        .item-details {
            flex: 1;
            padding: 0 1.5rem;
        }

        .item-title {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--dark-text);
        }

        .item-seller {
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .item-price {
            font-weight: 600;
            color: var(--secondary);
            font-size: 1.1rem;
        }

        .item-actions {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: flex-end;
        }

        .quantity-control {
            display: flex;
            align-items: center;
            border: 1px solid #dee2e6;
            border-radius: 6px;
            overflow: hidden;
        }

        .quantity-btn {
            background: #f8f9fa;
            border: none;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .quantity-input {
            width: 40px;
            height: 32px;
            border: none;
            text-align: center;
            background: white;
        }

        .remove-btn {
            color: #dc3545;
            background: none;
            border: none;
            font-size: 0.9rem;
            cursor: pointer;
        }

        .remove-btn:hover {
            text-decoration: underline;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.8rem;
        }

        .summary-total {
            display: flex;
            justify-content: space-between;
            font-weight: 600;
            font-size: 1.2rem;
            border-top: 1px solid #e9ecef;
            padding-top: 1rem;
            margin-top: 1rem;
        }

        .btn-checkout {
            background: var(--secondary);
            border: none;
            color: white;
            padding: 12px;
            font-weight: 600;
            border-radius: 8px;
            width: 100%;
            margin-top: 1.5rem;
        }

        .btn-checkout:hover {
            background: #e65c00;
        }

        .btn-continue {
            background: white;
            border: 1px solid var(--primary);
            color: var(--primary);
            padding: 12px;
            font-weight: 600;
            border-radius: 8px;
            width: 100%;
            margin-top: 0.5rem;
        }

        .btn-continue:hover {
            background: #f0f5ff;
        }

        .empty-cart {
            text-align: center;
            padding: 3rem;
        }

        .empty-cart-icon {
            font-size: 4rem;
            color: #dee2e6;
            margin-bottom: 1.5rem;
        }

        .saved-for-later {
            margin-top: 2rem;
        }

        .promo-code {
            display: flex;
            margin-top: 1rem;
        }

        .promo-input {
            flex: 1;
            border: 1px solid #dee2e6;
            border-right: none;
            border-radius: 6px 0 0 6px;
            padding: 0.5rem 1rem;
        }

        .btn-apply {
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 0 6px 6px 0;
            padding: 0.5rem 1rem;
        }

        @media (max-width: 768px) {
            .cart-item {
                flex-direction: column;
            }

            .item-image {
                width: 100%;
                height: auto;
                margin-bottom: 1rem;
            }

            .item-details {
                padding: 0;
                margin-bottom: 1rem;
            }

            .item-actions {
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    @include('components.header')
    @include('components.message')

    <!-- Main Content -->
    <div class="container cart-container">
        <h1 class="page-title">Shopping Cart</h1>

        <div class="row">
            <!-- Cart Items -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="selectAll" checked>
                            <label class="form-check-label" for="selectAll">
                                Select all items (3)
                            </label>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        @if ($cart && $cart->items->count() > 0)
                            @foreach ($cart->items as $item)
                                <div class="cart-item">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" checked>
                                    </div>
                                    <img src="{{ asset('storage/' . ($item->product->images[0] ?? 'placeholder.png')) }}"
                                        alt="{{ $item->product->name }}" class="item-image">
                                    <div class="item-details">
                                        <h5 class="item-title">{{ $item->product->name }}</h5>
                                        <p class="item-seller">Sold by:
                                            {{ $item->product->seller->company_name ?? 'N/A' }}</p>
                                        <p class="item-price">${{ $item->price }}</p>
                                        <div class="form-check mt-2">
                                            <input class="form-check-input" type="checkbox"
                                                id="gift{{ $loop->index }}">
                                            <label class="form-check-label" for="gift{{ $loop->index }}">
                                                This is a gift
                                            </label>
                                        </div>
                                    </div>
                                    <div class="item-actions">
                                        <div class="quantity-control">
                                            <button class="quantity-btn"
                                                onclick="updateQuantity('item{{ $loop->index }}', -1)">-</button>
                                            <input type="text" class="quantity-input" value="{{ $item->quantity }}"
                                                id="item{{ $loop->index }}-quantity">
                                            <button class="quantity-btn"
                                                onclick="updateQuantity('item{{ $loop->index }}', 1)">+</button>
                                        </div>
                                        <a href="{{ route('cart.remove', $item) }}" class="remove-btn">
                                            <i class="fas fa-trash-alt me-1"></i> Remove
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-center mt-5">Your cart is empty.</p>
                        @endif



                    </div>
                </div>

                <!-- Saved for Later -->
                <div class="card saved-for-later">
                    <div class="card-header">
                        Saved for later (1 item)
                    </div>
                    <div class="card-body p-0">
                        <div class="cart-item">
                            <img src="https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80"
                                alt="Car Parts" class="item-image">
                            <div class="item-details">
                                <h5 class="item-title">Automotive Spare Parts Kit</h5>
                                <p class="item-seller">Sold by: AutoParts Direct</p>
                                <p class="item-price">$1,250.00</p>
                            </div>
                            <div class="item-actions">
                                <button class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-cart-plus me-1"></i> Move to Cart
                                </button>
                                <button class="remove-btn mt-2">
                                    <i class="fas fa-trash-alt me-1"></i> Remove
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        Order Summary
                    </div>
                    <div class="card-body">
                        <div class="summary-item">
                            @if ($cart && $cart->items)
                                <span>Subtotal ( {{ count($cart->items) }} )</span>
                                <span>${{ $subtotal }}</span>
                            @endif
                        </div>
                        <div class="summary-item">
                            <span>Shipping</span>
                            <span>${{ $shipping }}</span>
                        </div>
                        <div class="summary-item">
                            <span>Tax</span>
                            <span>${{ $tax }}</span>
                        </div>
                        <div class="promo-code">
                            <input type="text" class="promo-input" placeholder="Promo code">
                            <button class="btn-apply">Apply</button>
                        </div>
                        <div class="summary-total">
                            <span>Total</span>
                            <span>${{ $total }}</span>
                        </div>
                        @if($cart)
                        <form action="{{ route('order', $cart) }}" method="POST">
                            @csrf
                            @method('POST')
                            <button type="submit" class="btn-checkout">
                                <i class="fas fa-lock me-2"></i> Proceed to Checkout
                            </button>
                        </form>
                        @endif
                        {{-- <a href="/" class="btn-continue">
                            <i class="fas fa-arrow-left me-2"></i> Continue Shopping
                        </a> --}}
                    </div>
                </div>

                <!-- Security Badge -->
                <div class="card mt-4">
                    <div class="card-body text-center">
                        <i class="fas fa-shield-alt fa-2x text-primary mb-2"></i>
                        <h6>Secure Checkout</h6>
                        <p class="small text-muted">Your transaction is secured with SSL encryption</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('components.footer')
    <!-- Bootstrap & jQuery JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Update quantity function
        function updateQuantity(itemId, change) {
            const quantityInput = document.getElementById(`${itemId}-quantity`);
            let quantity = parseInt(quantityInput.value);
            quantity += change;

            if (quantity < 1) quantity = 1;
            if (quantity > 99) quantity = 99;

            quantityInput.value = quantity;
            updateCartTotals();
        }

        // Remove item from cart
        function removeItem(itemId) {
            if (confirm('Are you sure you want to remove this item from your cart?')) {
                // In a real application, this would make an API call to remove the item
                // For this demo, we'll just show an alert
                alert('Item removed from cart');
                updateCartTotals();
            }
        }

        // Update cart totals (simplified version)
        function updateCartTotals() {
            // In a real application, this would recalculate all the totals
            console.log('Cart totals updated');
        }

        // Select all items
        document.getElementById('selectAll').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.form-check-input');
            checkboxes.forEach(checkbox => {
                if (checkbox.id !== 'selectAll') {
                    checkbox.checked = this.checked;
                }
            });
        });
    </script>
</body>

</html>
