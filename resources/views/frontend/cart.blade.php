<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - Alibaba.com</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="styles.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- Top Bar -->
    <div class="top-bar py-1 px-3 d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-3">
            <span class="fw-bold">Deliver to:</span>
            <span class="badge bg-success">PK</span>
            <span class="ms-2">English-USD</span>
        </div>
        <div class="d-flex align-items-center gap-3">
            <a href="#" class="text-white text-decoration-none"><i class="far fa-comment"></i></a>
            <a href="#" class="text-white text-decoration-none"><i class="far fa-clipboard"></i></a>
            <a href="cart.html" class="text-white text-decoration-none"><i class="fas fa-shopping-cart"></i></a>
            <a href="#" class="text-white text-decoration-none"><i class="far fa-user"></i></a>
        </div>
    </div>
    <!-- Main Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark alibaba-navbar">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="index.html">
                <img src="https://upload.wikimedia.org/wikipedia/commons/6/6a/Alibaba_Logo.png" alt="Logo" height="32" class="me-2">
                Alibaba.com
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link" href="index.html">All categories</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Featured selections</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Order protections</a></li>
                    <li class="nav-item"><a class="nav-link active fw-bold" href="#">Products</a></li>
                    <li class="nav-item"><a class="nav-link fw-bold" href="#">Manufacturers</a></li>
                    <li class="nav-item"><a class="nav-link fw-bold" href="#">Regional supplies</a></li>
                </ul>
                <div class="d-none d-lg-flex align-items-center gap-3">
                    <a href="#" class="nav-link">AI Sourcing Agent</a>
                    <a href="#" class="nav-link">Buyer Central</a>
                    <a href="#" class="nav-link">Help Center</a>
                    <a href="#" class="nav-link">Get the app</a>
                    <a href="#" class="nav-link">Become a supplier</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Cart Content -->
    <div class="container mt-5 mb-5">
        <h1 class="mb-4">Shopping Cart</h1>
        
        <div class="row">
            <!-- Cart Items -->
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-header bg-white">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h5 class="mb-0">Your Items (3)</h5>
                            </div>
                            <div class="col-md-6 text-md-end">
                                <button class="btn btn-sm btn-outline-secondary">
                                    <i class="fas fa-times me-2"></i>Clear Cart
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Cart Item 1 -->
                        <div class="row cart-item mb-4 pb-3 border-bottom align-items-center">
                            <div class="col-md-2 col-3">
                                <img src="https://cdn.pixabay.com/photo/2020/10/21/18/07/laptop-5673901_1280.jpg" alt="Laptop" class="img-fluid rounded">
                            </div>
                            <div class="col-md-5 col-9">
                                <h6 class="mb-0">Premium i9 Laptop Computer</h6>
                                <p class="text-muted small mb-0">RAM: 16GB | Storage: 512GB</p>
                                <div class="d-flex align-items-center gap-3 mt-2">
                                    <a href="#" class="text-secondary small"><i class="far fa-heart me-1"></i>Save for later</a>
                                    <a href="#" class="text-danger small"><i class="far fa-trash-alt me-1"></i>Remove</a>
                                </div>
                            </div>
                            <div class="col-md-2 col-4 mt-3 mt-md-0">
                                <div class="input-group input-group-sm">
                                    <button class="btn btn-outline-secondary" type="button">-</button>
                                    <input type="text" class="form-control text-center" value="1">
                                    <button class="btn btn-outline-secondary" type="button">+</button>
                                </div>
                            </div>
                            <div class="col-md-3 col-8 mt-3 mt-md-0 text-end">
                                <p class="fw-bold mb-0">$1,299.99</p>
                                <p class="text-muted text-decoration-line-through small">$1,499.99</p>
                            </div>
                        </div>
                        
                        <!-- Cart Item 2 -->
                        <div class="row cart-item mb-4 pb-3 border-bottom align-items-center">
                            <div class="col-md-2 col-3">
                                <img src="https://cdn.pixabay.com/photo/2016/06/28/05/27/laptop-1483974_1280.jpg" alt="Gaming Laptop" class="img-fluid rounded">
                            </div>
                            <div class="col-md-5 col-9">
                                <h6 class="mb-0">Gaming Laptop 17"</h6>
                                <p class="text-muted small mb-0">RAM: 32GB | Storage: 1TB</p>
                                <div class="d-flex align-items-center gap-3 mt-2">
                                    <a href="#" class="text-secondary small"><i class="far fa-heart me-1"></i>Save for later</a>
                                    <a href="#" class="text-danger small"><i class="far fa-trash-alt me-1"></i>Remove</a>
                                </div>
                            </div>
                            <div class="col-md-2 col-4 mt-3 mt-md-0">
                                <div class="input-group input-group-sm">
                                    <button class="btn btn-outline-secondary" type="button">-</button>
                                    <input type="text" class="form-control text-center" value="1">
                                    <button class="btn btn-outline-secondary" type="button">+</button>
                                </div>
                            </div>
                            <div class="col-md-3 col-8 mt-3 mt-md-0 text-end">
                                <p class="fw-bold mb-0">$1,499.00</p>
                            </div>
                        </div>
                        
                        <!-- Cart Item 3 -->
                        <div class="row cart-item align-items-center">
                            <div class="col-md-2 col-3">
                                <img src="https://cdn.pixabay.com/photo/2016/11/29/08/41/apple-1868496_1280.jpg" alt="Laptop Accessories" class="img-fluid rounded">
                            </div>
                            <div class="col-md-5 col-9">
                                <h6 class="mb-0">Wireless Mouse</h6>
                                <p class="text-muted small mb-0">Color: Black</p>
                                <div class="d-flex align-items-center gap-3 mt-2">
                                    <a href="#" class="text-secondary small"><i class="far fa-heart me-1"></i>Save for later</a>
                                    <a href="#" class="text-danger small"><i class="far fa-trash-alt me-1"></i>Remove</a>
                                </div>
                            </div>
                            <div class="col-md-2 col-4 mt-3 mt-md-0">
                                <div class="input-group input-group-sm">
                                    <button class="btn btn-outline-secondary" type="button">-</button>
                                    <input type="text" class="form-control text-center" value="2">
                                    <button class="btn btn-outline-secondary" type="button">+</button>
                                </div>
                            </div>
                            <div class="col-md-3 col-8 mt-3 mt-md-0 text-end">
                                <p class="fw-bold mb-0">$49.98</p>
                                <p class="text-muted small">($24.99 each)</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="d-flex justify-content-between">
                    <a href="index.html" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Continue Shopping
                    </a>
                    <button class="btn btn-primary" id="update-cart-btn">
                        <i class="fas fa-sync-alt me-2"></i>Update Cart
                    </button>
                </div>
            </div>
            
            <!-- Order Summary -->
            <div class="col-lg-4 mt-4 mt-lg-0">
                <div class="card">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Order Summary</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <span>Subtotal (3 items)</span>
                            <span>$2,848.97</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Shipping</span>
                            <span class="text-success">Free</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Tax</span>
                            <span>$199.43</span>
                        </div>
                        <div class="d-flex justify-content-between border-top pt-3 mt-3">
                            <span class="fw-bold">Total</span>
                            <span class="fw-bold">$3,048.40</span>
                        </div>
                        
                        <button class="btn btn-primary w-100 mt-4" id="checkout-btn">
                            Proceed to Checkout
                        </button>
                        
                        <div class="payment-methods mt-4">
                            <p class="text-muted small mb-2">Secure Payment Methods</p>
                            <div class="d-flex gap-2">
                                <img src="https://cdn.pixabay.com/photo/2015/05/26/09/37/paypal-784404_1280.png" alt="PayPal" height="25">
                                <img src="https://cdn.pixabay.com/photo/2017/08/10/14/02/visa-2623015_1280.png" alt="Visa" height="25">
                                <img src="https://cdn.pixabay.com/photo/2013/01/29/22/53/mastercard-76659_1280.png" alt="Mastercard" height="25">
                                <img src="https://cdn.pixabay.com/photo/2021/12/06/13/48/american-express-6850402_1280.png" alt="American Express" height="25">
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Discount Coupon -->
                <div class="card mt-3">
                    <div class="card-body">
                        <h6 class="mb-3">Apply Discount Code</h6>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Enter coupon code">
                            <button class="btn btn-outline-secondary" type="button">Apply</button>
                        </div>
                    </div>
                </div>
                
                <!-- Need Help -->
                <div class="card mt-3">
                    <div class="card-body">
                        <h6 class="mb-3">Need Help?</h6>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2"><a href="#" class="text-decoration-none"><i class="far fa-question-circle me-2"></i>Shopping FAQs</a></li>
                            <li class="mb-2"><a href="#" class="text-decoration-none"><i class="fas fa-truck me-2"></i>Shipping Information</a></li>
                            <li><a href="#" class="text-decoration-none"><i class="fas fa-undo me-2"></i>Returns & Exchanges</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer-alibaba py-5 mt-5 bg-white border-top">
        <div class="container">
            <div class="row row-cols-2 row-cols-md-5 g-4">
                <div class="col">
                    <h6 class="fw-bold mb-3">Get support</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="footer-link">Help Center</a></li>
                        <li><a href="#" class="footer-link">Live chat</a></li>
                        <li><a href="#" class="footer-link">Check order status</a></li>
                        <li><a href="#" class="footer-link">Refunds</a></li>
                        <li><a href="#" class="footer-link">Report abuse</a></li>
                    </ul>
                </div>
                <div class="col">
                    <h6 class="fw-bold mb-3">Payments and protections</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="footer-link">Safe and easy payments</a></li>
                        <li><a href="#" class="footer-link">Money-back policy</a></li>
                        <li><a href="#" class="footer-link">On-time shipping</a></li>
                        <li><a href="#" class="footer-link">After-sales protections</a></li>
                        <li><a href="#" class="footer-link">Product monitoring services</a></li>
                    </ul>
                </div>
                <div class="col">
                    <h6 class="fw-bold mb-3">Source on Alibaba.com</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="footer-link">Request for Quotation</a></li>
                        <li><a href="#" class="footer-link">Membership program</a></li>
                        <li><a href="#" class="footer-link">Alibaba.com Logistics</a></li>
                        <li><a href="#" class="footer-link">Sales tax and VAT</a></li>
                        <li><a href="#" class="footer-link">Alibaba.com Reads</a></li>
                    </ul>
                </div>
                <div class="col">
                    <h6 class="fw-bold mb-3">Sell on Alibaba.com</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="footer-link">Start selling</a></li>
                        <li><a href="#" class="footer-link">Seller Central</a></li>
                        <li><a href="#" class="footer-link">Become a Verified Supplier</a></li>
                        <li><a href="#" class="footer-link">Partnerships</a></li>
                        <li><a href="#" class="footer-link">Download the app for suppliers</a></li>
                    </ul>
                </div>
                <div class="col">
                    <h6 class="fw-bold mb-3">Get to know us</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="footer-link">About Alibaba.com</a></li>
                        <li><a href="#" class="footer-link">Corporate responsibility</a></li>
                        <li><a href="#" class="footer-link">News center</a></li>
                        <li><a href="#" class="footer-link">Careers</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script>
        document.getElementById('update-cart-btn').addEventListener('click', function() {
            alert('Cart updated successfully!');
        });
        
        document.getElementById('checkout-btn').addEventListener('click', function() {
            alert('Redirecting to checkout...');
            // In a real app, this would redirect to checkout.html or a checkout process
        });
    </script>
</body>
</html> 