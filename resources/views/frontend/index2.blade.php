<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alibaba.com - Leading B2B Marketplace</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- Top Bar -->
    <div class="top-bar">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <span class="fw-bold me-2">Deliver to:</span>
                    <span class="badge bg-success me-3">PK</span>
                    <span>English-USD</span>
                </div>
                <div class="d-flex align-items-center">
                    <a href="#" class="text-decoration-none"><i class="far fa-comment"></i></a>
                    <a href="#" class="text-decoration-none"><i class="far fa-clipboard"></i></a>
                    <a href="cart.html" class="text-decoration-none"><i class="fas fa-shopping-cart"></i></a>
                    @guest
                        <a href="{{ route('login') }}" class="text-decoration-none"><i class="far fa-user"></i></a>
                    @else
                        <div class="dropdown">
                            <a href="#" class="text-decoration-none dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown">
                                <i class="far fa-user"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="{{ route('profile') }}">Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </div>
    <!-- Main Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark alibaba-navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.html">
                <img src="images/logo.png" alt="Logo" height="32" class="me-2">
                Jet Cartridge
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item categories-dropdown">
                        <a class="nav-link active" href="#">
                            <i class="fas fa-bars me-2"></i>All categories
                        </a>
                        <div class="categories-menu">
                            <div class="categories-list">
                                <h6>Top categories</h6>
                                <ul>
                                    <li>
                                        <a href="#">
                                            <i class="fas fa-tshirt"></i>
                                            Apparel & Accessories
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fas fa-laptop"></i>
                                            Consumer Electronics
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fas fa-home"></i>
                                            Home & Garden
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fas fa-dumbbell"></i>
                                            Sports & Entertainment
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fas fa-gem"></i>
                                            Beauty
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fas fa-industry"></i>
                                            Commercial Equipment
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="subcategories">
                                <div class="subcategories-grid">
                                    <a href="#" class="subcategory-item">
                                        <img src="https://cdn.pixabay.com/photo/2016/03/27/19/31/fashion-1283863_1280.jpg" alt="Bridal">
                                        <span>Bridal Headwear</span>
                                    </a>
                                    <a href="#" class="subcategory-item">
                                        <img src="https://cdn.pixabay.com/photo/2016/11/22/19/08/hangers-1850082_1280.jpg" alt="Used Clothes">
                                        <span>Used Clothes</span>
                                    </a>
                                    <a href="#" class="subcategory-item">
                                        <img src="https://cdn.pixabay.com/photo/2017/08/01/11/48/blue-2564660_1280.jpg" alt="Men's Polo">
                                        <span>Men's Polo Shirts</span>
                                    </a>
                                    <a href="#" class="subcategory-item">
                                        <img src="https://cdn.pixabay.com/photo/2016/03/27/19/31/fashion-1283863_1280.jpg" alt="Traditional">
                                        <span>Traditional Wear</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item position-relative">
                        <a class="nav-link" href="#">Featured selections</a>
                        <div class="feature-menu">
                            <div class="featured-content">
                                <h5 class="mb-4">Featured Categories</h5>
                                <div class="row">
                                    <div class="col-md-3">
                                        <h6>Consumer Electronics</h6>
                                        <ul class="list-unstyled">
                                            <li><a href="#">Mobile Phones</a></li>
                                            <li><a href="#">Laptops</a></li>
                                            <li><a href="#">Smart Watches</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-3">
                                        <h6>Apparel</h6>
                                        <ul class="list-unstyled">
                                            <li><a href="#">Men's Clothing</a></li>
                                            <li><a href="#">Women's Clothing</a></li>
                                            <li><a href="#">Accessories</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-3">
                                        <h6>Home & Garden</h6>
                                        <ul class="list-unstyled">
                                            <li><a href="#">Furniture</a></li>
                                            <li><a href="#">Kitchen</a></li>
                                            <li><a href="#">Decor</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item position-relative">
                        <a class="nav-link" href="#">Order protections</a>
                        <div class="protection-menu">
                            <div class="trade-assurance">
                                <div class="trade-assurance-left">
                                    <img src="images/trade-assurance.png" alt="Trade Assurance" class="mb-3" style="height: 40px;">
                                    <h4>Trade Assurance</h4>
                                    <p>Enjoy protection from payment to delivery</p>
                                    <button class="btn btn-primary">Learn more</button>
                                </div>
                                <div class="trade-assurance-right">
                                    <div class="protection-card">
                                        <div class="protection-icon">
                                            <i class="fas fa-shield-alt"></i>
                                        </div>
                                        <div class="protection-content">
                                            <h6>Safe & easy payments</h6>
                                            <p>Multiple payment options</p>
                                        </div>
                                    </div>
                                    <div class="protection-card">
                                        <div class="protection-icon">
                                            <i class="fas fa-undo"></i>
                                        </div>
                                        <div class="protection-content">
                                            <h6>Money-back policy</h6>
                                            <p>Refund guarantee</p>
                                        </div>
                                    </div>
                                    <div class="protection-card">
                                        <div class="protection-icon">
                                            <i class="fas fa-ship"></i>
                                        </div>
                                        <div class="protection-content">
                                            <h6>Shipping & logistics</h6>
                                            <p>Fast & reliable delivery</p>
                                        </div>
                                    </div>
                                    <div class="protection-card">
                                        <div class="protection-icon">
                                            <i class="fas fa-tools"></i>
                                        </div>
                                        <div class="protection-content">
                                            <h6>After-sales protection</h6>
                                            <p>Quality guarantee</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                <div class="d-none d-lg-flex align-items-center gap-3">
                    <div class="nav-item position-relative">
                        <a href="#" class="nav-link">AI Sourcing Agent</a>
                        <div class="ai-sourcing-menu">
                            <div class="ai-sourcing">
                                <div class="ai-sourcing-left">
                                    <h3>Source smarter with Accio</h3>
                                    <p class="mb-4">Leverage AI to find the perfect product match in seconds</p>
                                    
                                    <div class="ai-features">
                                        <div class="ai-feature-card">
                                            <i class="fas fa-box"></i>
                                            <h6>Matches from over 100 million products</h6>
                                            <p>with precision</p>
                                        </div>
                                        <div class="ai-feature-card">
                                            <i class="fas fa-bolt"></i>
                                            <h6>Handles queries 3 times as complex</h6>
                                            <p>in half the time</p>
                                        </div>
                                        <div class="ai-feature-card">
                                            <i class="fas fa-check-circle"></i>
                                            <h6>Verifies and cross-validates</h6>
                                            <p>product information</p>
                                        </div>
                                    </div>
                                    
                                    <p class="mb-3">Partnered with Alibaba.com</p>
                                    <button class="source-now-btn">Source now</button>
                                </div>
                                <div class="ai-sourcing-right">
                                    <img src="https://s.alicdn.com/@img/imgextra/i2/O1CN01OkWDXc1H2YMlPjjd0_!!6000000000697-0-tps-1456-1018.jpg" alt="AI Sourcing Demo">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="nav-item position-relative">
                        <a href="#" class="nav-link">Buyer Central</a>
                        <div class="buyer-central-menu">
                            <div class="menu-columns">
                                <div class="menu-column">
                                    <h5>Get started</h5>
                                    <ul>
                                        <li><a href="#">What is Alibaba.com</a></li>
                                    </ul>
                                </div>
                                <div class="menu-column">
                                    <h5>Why Alibaba.com</h5>
                                    <ul>
                                        <li><a href="#">How sourcing works</a></li>
                                        <li><a href="#">Membership program</a></li>
                                    </ul>
                                </div>
                                <div class="menu-column">
                                    <h5>Trade services</h5>
                                    <ul>
                                        <li><a href="#">Order protections</a></li>
                                        <li><a href="#">Logistics Services</a></li>
                                        <li><a href="#">Letter of Credit</a></li>
                                        <li><a href="#">Production monitoring & inspection services</a></li>
                                    </ul>
                                </div>
                                <div class="menu-column">
                                    <h5>Resources</h5>
                                    <ul>
                                        <li><a href="#">Success stories</a></li>
                                        <li><a href="#">Blogs</a></li>
                                        <li><a href="#">Industry reports</a></li>
                                        <li><a href="#">Help Center</a></li>
                                    </ul>
                                </div>
                                <div class="menu-column">
                                    <h5>Webinars</h5>
                                    <ul>
                                        <li><a href="#">Overview</a></li>
                                        <li><a href="#">Meet the peers</a></li>
                                        <li><a href="#">Ecommerce Academy</a></li>
                                        <li><a href="#">How to source on Alibaba.com</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="nav-item position-relative">
                        <a href="#" class="nav-link">Help Center</a>
                        <div class="help-center-menu">
                            <div class="help-options">
                                <div class="help-card">
                                    <i class="fas fa-user"></i>
                                    <h6>For buyers</h6>
                                </div>
                                <div class="help-card">
                                    <i class="fas fa-building"></i>
                                    <h6>For suppliers</h6>
                                </div>
                                <div class="help-links">
                                    <a href="#">Open a dispute</a>
                                    <a href="#">Report IPR infringement</a>
                                    <a href="#">Report abuse</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <a href="#" class="nav-link">Get the app</a>
                    <a href="{{ route('login') }}" class="nav-link">Sign in</a>
                </div>
            </div>
        </div>
    </nav>
    <!-- Search Bar -->
    <div class="search-bar-wrapper py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="input-group search-bar">
                        <input type="text" class="form-control" placeholder="What are you looking for?">
                        <button class="btn btn-dark px-4" type="button">Search</button>
                    </div>
                    <!-- Navigation Options -->
                    <div class="nav-options mt-3 d-flex justify-content-center">
                        <a href="{{ route('home') }}" class="nav-link mx-4 {{ request()->routeIs('home') ? 'active' : '' }}">Products</a>
                        <a href="{{ route('manufacturers') }}" class="nav-link mx-4 {{ request()->routeIs('manufacturers') ? 'active' : '' }}">Manufacturers</a>
                        <a href="{{ route('regional-supplies') }}" class="nav-link mx-4 {{ request()->routeIs('regional-supplies') ? 'active' : '' }}">Regional supplies</a>
                    </div>
                    <!-- Frequently searched -->
                    <div class="frequently-searched mt-2">
                        <small class="text-muted me-2">Frequently searched:</small>
                        <a href="#" class="text-decoration-none text-muted small me-2">drone camera 4k</a>
                        <a href="#" class="text-decoration-none text-muted small me-2">drone 8k professional</a>
                        <a href="#" class="text-decoration-none text-muted small me-2">cheap shipping pakistan</a>
                        <a href="#" class="text-decoration-none text-muted small">ddp pakistan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main Content Layout -->
    <div class="container-fluid main-content-layout">
        <div class="row">
            <!-- Sidebar -->
            <aside class="col-md-2 sidebar-categories">
                <div class="list-group list-group-flush">
                    <span class="list-group-item fw-bold bg-transparent border-0">Categories for you</span>
                    <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-industry me-2"></i>Industrial Machinery</a>
                    <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-tv me-2"></i>Consumer Electronics</a>
                    <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-gem me-2"></i>Jewelry, Eyewear & Watches</a>
                    <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-tshirt me-2"></i>Apparel & Accessories</a>
                    <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-home me-2"></i>Home & Garden</a>
                </div>
            </aside>
            <!-- Main Section -->
            <main class="col-md-10 py-4">
                <div class="welcome-msg mb-3">
                    <h5>Welcome to Alibaba.com, Sakhawat</h5>
                </div>
                <div class="row g-3">
                    <div class="col-md-3">
                        <div class="card p-3 h-100">
                            <h6>Browsing history</h6>
                            <img src="https://upload.wikimedia.org/wikipedia/commons/3/32/Flag-map_of_Pakistan.svg" alt="Pakistan" class="img-fluid my-2" style="max-height:80px;">
                            <div>US$5.99</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card p-3 h-100">
                            <h6>Frequently searched</h6>
                            <small>Digital Cameras</small>
                            <img src="https://cdn.pixabay.com/photo/2016/03/27/19/40/camera-1284082_1280.jpg" alt="Camera" class="img-fluid my-2" style="max-height:80px;">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card p-3 h-100">
                            <h6>Frequently searched</h6>
                            <small>Containers</small>
                            <img src="https://cdn.pixabay.com/photo/2016/11/29/09/32/container-1866349_1280.jpg" alt="Container" class="img-fluid my-2" style="max-height:80px;">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <a href="product-details.html" class="card p-3 h-100 bg-light-purple text-decoration-none">
                            <h6>i9 laptop</h6>
                            <img src="https://cdn.pixabay.com/photo/2014/05/02/21/50/home-office-336377_1280.jpg" alt="Laptop" class="img-fluid my-2" style="max-height:80px;">
                            <div class="btn btn-primary btn-sm mt-2">Explore now</div>
                        </a>
                    </div>
                </div>
                
                <!-- Featured Products Section -->
                <div class="mt-5">
                    <h3 class="mb-3">Featured Products</h3>
                    <div class="row">
                        <div class="col-md-3 mb-4">
                            <a href="product-details.html" class="card product-card h-100 text-decoration-none">
                                <img src="https://cdn.pixabay.com/photo/2020/10/21/18/07/laptop-5673901_1280.jpg" class="card-img-top" alt="Premium Laptop">
                                <div class="card-body">
                                    <h5 class="card-title text-dark">Premium i9 Laptop</h5>
                                    <p class="card-text fw-bold text-orange">$1,299.99</p>
                                    <p class="card-text text-muted small">Free shipping</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 mb-4">
                            <a href="product-details.html" class="card product-card h-100 text-decoration-none">
                                <img src="https://cdn.pixabay.com/photo/2016/06/28/05/27/laptop-1483974_1280.jpg" class="card-img-top" alt="Gaming Laptop">
                                <div class="card-body">
                                    <h5 class="card-title text-dark">Gaming Laptop 17"</h5>
                                    <p class="card-text fw-bold text-orange">$1,499.00</p>
                                    <p class="card-text text-muted small">Free shipping</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 mb-4">
                            <a href="product-details.html" class="card product-card h-100 text-decoration-none">
                                <img src="https://cdn.pixabay.com/photo/2015/07/17/22/42/startup-849804_1280.jpg" class="card-img-top" alt="Convertible Touchscreen">
                                <div class="card-body">
                                    <h5 class="card-title text-dark">Convertible Touchscreen</h5>
                                    <p class="card-text fw-bold text-orange">$999.00</p>
                                    <p class="card-text text-muted small">Free shipping</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 mb-4">
                            <a href="product-details.html" class="card product-card h-100 text-decoration-none">
                                <img src="https://cdn.pixabay.com/photo/2020/04/08/15/50/workspace-5017751_1280.jpg" class="card-img-top" alt="Student Chromebook">
                                <div class="card-body">
                                    <h5 class="card-title text-dark">Student Chromebook</h5>
                                    <p class="card-text fw-bold text-orange">$699.00</p>
                                    <p class="card-text text-muted small">Free shipping</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Featured Products -->
    <section id="products" class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Featured Products</h2>
            <div class="row">
                <!-- Product Card 1 -->
                <div class="col-md-4 mb-4">
                    <div class="card product-card">
                        <img src="https://via.placeholder.com/300" class="card-img-top" alt="Product 1">
                        <div class="card-body">
                            <h5 class="card-title">Product 1</h5>
                            <p class="card-text">$99.99</p>
                            <button class="btn btn-primary">Add to Cart</button>
                        </div>
                    </div>
                </div>
                <!-- Product Card 2 -->
                <div class="col-md-4 mb-4">
                    <div class="card product-card">
                        <img src="https://via.placeholder.com/300" class="card-img-top" alt="Product 2">
                        <div class="card-body">
                            <h5 class="card-title">Product 2</h5>
                            <p class="card-text">$149.99</p>
                            <button class="btn btn-primary">Add to Cart</button>
                        </div>
                    </div>
                </div>
                <!-- Product Card 3 -->
                <div class="col-md-4 mb-4">
                    <div class="card product-card">
                        <img src="https://via.placeholder.com/300" class="card-img-top" alt="Product 3">
                        <div class="card-body">
                            <h5 class="card-title">Product 3</h5>
                            <p class="card-text">$199.99</p>
                            <button class="btn btn-primary">Add to Cart</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section id="categories" class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5">Shop by Category</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="category-card">
                        <img src="https://via.placeholder.com/400x300" alt="Category 1" class="img-fluid">
                        <h3 class="mt-3">Electronics</h3>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="category-card">
                        <img src="https://via.placeholder.com/400x300" alt="Category 2" class="img-fluid">
                        <h3 class="mt-3">Fashion</h3>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="category-card">
                        <img src="https://via.placeholder.com/400x300" alt="Category 3" class="img-fluid">
                        <h3 class="mt-3">Home & Living</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Contact Us</h2>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <form>
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Your Name">
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" placeholder="Your Email">
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" rows="5" placeholder="Your Message"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var logoutForm = document.querySelector('form[action="{{ route('logout') }}"]');
            var logoutButton = logoutForm.querySelector('button[type="submit"]');
 
            logoutButton.addEventListener('click', function(event) {
                event.preventDefault();
                logoutForm.submit();
            });
        });
    </script>
</body>
</html>
    <!-- Custom JS -->
    <script src="js/script.js"></script>
</body>
</html>
