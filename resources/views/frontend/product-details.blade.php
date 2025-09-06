<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details - Alibaba.com</title>
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
    <!-- Search Bar -->
    <div class="search-bar-wrapper py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="input-group search-bar">
                        <input type="text" class="form-control" placeholder="What are you looking for?">
                        <button class="btn btn-dark px-4" type="button">Search</button>
                        <button class="btn btn-outline-secondary ms-2" type="button"><i class="fas fa-camera"></i> Image Search</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Details -->
    <div class="container mt-4">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Electronics</a></li>
                <li class="breadcrumb-item active" aria-current="page">Laptop Computer i9</li>
            </ol>
        </nav>

        <div class="row">
            <!-- Product Images -->
            <div class="col-md-5">
                <div class="product-images">
                    <div class="main-image mb-3">
                        <img src="https://cdn.pixabay.com/photo/2020/10/21/18/07/laptop-5673901_1280.jpg" alt="Laptop" class="img-fluid rounded">
                    </div>
                    <div class="image-thumbnails d-flex gap-2">
                        <img src="https://cdn.pixabay.com/photo/2020/10/21/18/07/laptop-5673901_1280.jpg" alt="Thumbnail 1" class="img-thumbnail active">
                        <img src="https://cdn.pixabay.com/photo/2016/03/27/07/12/apple-1282241_1280.jpg" alt="Thumbnail 2" class="img-thumbnail">
                        <img src="https://cdn.pixabay.com/photo/2015/07/17/22/43/student-849825_1280.jpg" alt="Thumbnail 3" class="img-thumbnail">
                        <img src="https://cdn.pixabay.com/photo/2016/11/29/08/41/apple-1868496_1280.jpg" alt="Thumbnail 4" class="img-thumbnail">
                    </div>
                </div>
            </div>
            <!-- Product Info -->
            <div class="col-md-7">
                <h2 class="mb-3">{{ $product->name }}</h2>
                
                <div class="price-container mb-3">
                    <span class="current-price">US ${{ number_format($product->price, 2) }}</span>
                    @if($product->original_price)
                        <span class="original-price text-decoration-line-through text-muted ms-2">US ${{ number_format($product->original_price, 2) }}</span>
                        <span class="discount-badge ms-2">{{ round((($product->original_price - $product->price) / $product->original_price) * 100) }}% OFF</span>
                    @endif
                </div>
                
                <div class="product-rating mb-3">
                    <div class="stars">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= floor($product->rating))
                        <i class="fas fa-star"></i>
                            @elseif($i - 0.5 <= $product->rating)
                        <i class="fas fa-star-half-alt"></i>
                            @else
                                <i class="far fa-star"></i>
                            @endif
                        @endfor
                    </div>
                    <span class="rating-count">({{ $product->reviews_count ?? 0 }} reviews)</span>
                </div>

                <!-- Added by Employee Section -->
                <div class="added-by mb-3">
                    <p class="mb-2">Added by:</p>
                    <div class="d-flex align-items-center">
                        <img src="{{ $product->creator->profile_picture ? asset('storage/' . $product->creator->profile_picture) : asset('images/default-avatar.png') }}" 
                             alt="{{ $product->creator->name }}" 
                             class="rounded-circle me-2" 
                             style="width: 40px; height: 40px; object-fit: cover;">
                        <a href="{{ route('employees.profile', $product->creator) }}" 
                           class="text-decoration-none">
                            <strong>{{ $product->creator->name }}</strong>
                            <br>
                            <small class="text-muted">{{ $product->creator->position }}</small>
                        </a>
                    </div>
                </div>

                <div class="shipping-info mb-3">
                    <p><i class="fas fa-truck me-2"></i> Free shipping worldwide</p>
                    <p><i class="fas fa-shield-alt me-2"></i> 1 year warranty</p>
                </div>

                <hr>
                
                <div class="product-options mb-3">
                    <h5>Available Options</h5>
                    <div class="ram-options mb-3">
                        <label>RAM:</label>
                        <div class="btn-group" role="group">
                            <input type="radio" class="btn-check" name="ram" id="ram8" autocomplete="off" checked>
                            <label class="btn btn-outline-secondary" for="ram8">8GB</label>
                            
                            <input type="radio" class="btn-check" name="ram" id="ram16" autocomplete="off">
                            <label class="btn btn-outline-secondary" for="ram16">16GB</label>
                            
                            <input type="radio" class="btn-check" name="ram" id="ram32" autocomplete="off">
                            <label class="btn btn-outline-secondary" for="ram32">32GB</label>
                        </div>
                    </div>
                    <div class="storage-options mb-3">
                        <label>Storage:</label>
                        <div class="btn-group" role="group">
                            <input type="radio" class="btn-check" name="storage" id="storage256" autocomplete="off" checked>
                            <label class="btn btn-outline-secondary" for="storage256">256GB</label>
                            
                            <input type="radio" class="btn-check" name="storage" id="storage512" autocomplete="off">
                            <label class="btn btn-outline-secondary" for="storage512">512GB</label>
                            
                            <input type="radio" class="btn-check" name="storage" id="storage1tb" autocomplete="off">
                            <label class="btn btn-outline-secondary" for="storage1tb">1TB</label>
                        </div>
                    </div>
                </div>

                <div class="quantity-selector mb-4">
                    <label>Quantity:</label>
                    <div class="input-group" style="width: 140px;">
                        <button class="btn btn-outline-secondary" type="button" id="decrease-quantity">-</button>
                        <input type="text" class="form-control text-center" value="1" id="quantity-input">
                        <button class="btn btn-outline-secondary" type="button" id="increase-quantity">+</button>
                    </div>
                    <small class="text-muted ms-2">20 units available</small>
                </div>

                <div class="cta-buttons">
                    <button class="btn btn-primary btn-lg me-2" id="add-to-cart">
                        <i class="fas fa-cart-plus me-2"></i> Add to Cart
                    </button>
                    <button class="btn btn-outline-secondary btn-lg">
                        <i class="far fa-heart me-2"></i> Add to Wishlist
                    </button>
                </div>
            </div>
        </div>

        <!-- Product Details Tabs -->
        <div class="product-details-tabs mt-5">
            <ul class="nav nav-tabs" id="productTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab">Description</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="specifications-tab" data-bs-toggle="tab" data-bs-target="#specifications" type="button" role="tab">Specifications</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab">Reviews</button>
                </li>
            </ul>
            <div class="tab-content p-4 border border-top-0 rounded-bottom" id="productTabsContent">
                <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                    <h4>Product Description</h4>
                    <p>Experience unparalleled performance with our Premium i9 Laptop Computer. Designed for professionals and power users who demand the best, this ultra-slim business notebook combines cutting-edge technology with elegant design.</p>
                    
                    <h5>Key Features:</h5>
                    <ul>
                        <li>Powerful Intel i9 processor for exceptional performance</li>
                        <li>Ultra-slim aluminum body weighing just 3.1 pounds</li>
                        <li>Brilliant 15.6" 4K display with anti-glare coating</li>
                        <li>Up to 12 hours battery life with fast charging technology</li>
                        <li>Thunderbolt 4 ports for lightning-fast data transfer</li>
                        <li>Enhanced cooling system for sustained peak performance</li>
                        <li>Backlit keyboard with adjustable brightness</li>
                        <li>Windows 11 Pro pre-installed</li>
                    </ul>
                </div>
                <div class="tab-pane fade" id="specifications" role="tabpanel" aria-labelledby="specifications-tab">
                    <h4>Technical Specifications</h4>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td width="30%"><strong>Processor</strong></td>
                                <td>Intel Core i9-12900H (14 cores, up to 5.0GHz)</td>
                            </tr>
                            <tr>
                                <td><strong>Graphics</strong></td>
                                <td>NVIDIA GeForce RTX 3060 6GB GDDR6</td>
                            </tr>
                            <tr>
                                <td><strong>Display</strong></td>
                                <td>15.6" 4K UHD (3840 x 2160) Anti-Glare IPS</td>
                            </tr>
                            <tr>
                                <td><strong>Memory</strong></td>
                                <td>8GB / 16GB / 32GB DDR5-4800MHz (Upgradable)</td>
                            </tr>
                            <tr>
                                <td><strong>Storage</strong></td>
                                <td>256GB / 512GB / 1TB PCIe NVMe SSD</td>
                            </tr>
                            <tr>
                                <td><strong>Battery</strong></td>
                                <td>86Wh, up to 12 hours</td>
                            </tr>
                            <tr>
                                <td><strong>Weight</strong></td>
                                <td>3.1 lbs (1.4 kg)</td>
                            </tr>
                            <tr>
                                <td><strong>Dimensions</strong></td>
                                <td>13.3" x 8.9" x 0.6" (339 x 226 x 15mm)</td>
                            </tr>
                            <tr>
                                <td><strong>Operating System</strong></td>
                                <td>Windows 11 Pro</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                    <h4>Customer Reviews</h4>
                    <div class="reviews-summary mb-4">
                        <div class="overall-rating">
                            <h2>4.5</h2>
                            <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <p>Based on 245 reviews</p>
                        </div>
                    </div>
                    
                    <div class="review-list">
                        <!-- Review 1 -->
                        <div class="review-item p-3 mb-3 border-bottom">
                            <div class="d-flex justify-content-between">
                                <div class="user-info">
                                    <h6>Michael T.</h6>
                                    <div class="stars">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                </div>
                                <div class="review-date text-muted">Nov 15, 2023</div>
                            </div>
                            <p class="review-text mt-2">Absolutely fantastic laptop! The i9 processor handles everything I throw at it with ease. I'm a video editor and this machine cuts through 4K footage like butter. The display is gorgeous with accurate colors.</p>
                        </div>
                        
                        <!-- Review 2 -->
                        <div class="review-item p-3 mb-3 border-bottom">
                            <div class="d-flex justify-content-between">
                                <div class="user-info">
                                    <h6>Sarah K.</h6>
                                    <div class="stars">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="far fa-star"></i>
                                    </div>
                                </div>
                                <div class="review-date text-muted">Oct 28, 2023</div>
                            </div>
                            <p class="review-text mt-2">Great performance and beautiful design. The only downside is that the battery doesn't quite last the full 12 hours as advertised when doing intensive work. Still, I'm very happy with my purchase.</p>
                        </div>
                        
                        <!-- Review 3 -->
                        <div class="review-item p-3 mb-3">
                            <div class="d-flex justify-content-between">
                                <div class="user-info">
                                    <h6>David R.</h6>
                                    <div class="stars">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                </div>
                                <div class="review-date text-muted">Sep 12, 2023</div>
                            </div>
                            <p class="review-text mt-2">As a software developer, this laptop has transformed my workflow. Compiling large projects is significantly faster than my previous laptop. The keyboard is very comfortable for long coding sessions, and the cooling system keeps it from getting too hot.</p>
                        </div>
                    </div>
                    
                    <a href="#" class="btn btn-outline-primary mt-3">See All Reviews</a>
                </div>
            </div>
        </div>

        <!-- Similar Products -->
        <div class="similar-products mt-5">
            <h3 class="mb-4">You May Also Like</h3>
            <div class="row">
                <!-- Similar Product 1 -->
                <div class="col-md-3 mb-4">
                    <div class="card product-card h-100">
                        <img src="https://cdn.pixabay.com/photo/2016/06/28/05/27/laptop-1483974_1280.jpg" class="card-img-top" alt="Similar Product 1">
                        <div class="card-body">
                            <h5 class="card-title">Gaming Laptop 17"</h5>
                            <p class="card-text fw-bold">$1,499.00</p>
                            <button class="btn btn-sm btn-primary">View Details</button>
                        </div>
                    </div>
                </div>
                <!-- Similar Product 2 -->
                <div class="col-md-3 mb-4">
                    <div class="card product-card h-100">
                        <img src="https://cdn.pixabay.com/photo/2017/08/10/07/32/dell-2619501_1280.jpg" class="card-img-top" alt="Similar Product 2">
                        <div class="card-body">
                            <h5 class="card-title">Business Ultrabook</h5>
                            <p class="card-text fw-bold">$1,199.00</p>
                            <button class="btn btn-sm btn-primary">View Details</button>
                        </div>
                    </div>
                </div>
                <!-- Similar Product 3 -->
                <div class="col-md-3 mb-4">
                    <div class="card product-card h-100">
                        <img src="https://cdn.pixabay.com/photo/2015/07/17/22/42/startup-849804_1280.jpg" class="card-img-top" alt="Similar Product 3">
                        <div class="card-body">
                            <h5 class="card-title">Convertible Touchscreen</h5>
                            <p class="card-text fw-bold">$999.00</p>
                            <button class="btn btn-sm btn-primary">View Details</button>
                        </div>
                    </div>
                </div>
                <!-- Similar Product 4 -->
                <div class="col-md-3 mb-4">
                    <div class="card product-card h-100">
                        <img src="https://cdn.pixabay.com/photo/2020/04/08/15/50/workspace-5017751_1280.jpg" class="card-img-top" alt="Similar Product 4">
                        <div class="card-body">
                            <h5 class="card-title">Student Chromebook</h5>
                            <p class="card-text fw-bold">$699.00</p>
                            <button class="btn btn-sm btn-primary">View Details</button>
                        </div>
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
        // Image thumbnail click
        document.querySelectorAll('.image-thumbnails img').forEach(img => {
            img.addEventListener('click', function() {
                // Update main image
                document.querySelector('.main-image img').src = this.src;
                
                // Update active thumbnail
                document.querySelectorAll('.image-thumbnails img').forEach(thumb => {
                    thumb.classList.remove('active');
                });
                this.classList.add('active');
            });
        });
        
        // Quantity selector
        document.getElementById('increase-quantity').addEventListener('click', function() {
            let input = document.getElementById('quantity-input');
            let value = parseInt(input.value);
            if (value < 20) {
                input.value = value + 1;
            }
        });
        
        document.getElementById('decrease-quantity').addEventListener('click', function() {
            let input = document.getElementById('quantity-input');
            let value = parseInt(input.value);
            if (value > 1) {
                input.value = value - 1;
            }
        });
        
        // Add to cart button
        document.getElementById('add-to-cart').addEventListener('click', function() {
            const quantity = document.getElementById('quantity-input').value;
            const ram = document.querySelector('input[name="ram"]:checked').id.replace('ram', '');
            const storage = document.querySelector('input[name="storage"]:checked').id.replace('storage', '');
            
            alert(`Added to cart: Premium i9 Laptop\nRAM: ${ram}GB\nStorage: ${storage}\nQuantity: ${quantity}`);
            
            // In a real app, you would add to cart via AJAX or update local storage
        });
    </script>
</body>
</html> 