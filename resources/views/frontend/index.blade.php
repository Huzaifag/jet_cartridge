<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jet Cartridge - Leading B2B Marketplace</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    {{--
    <link rel="stylesheet" href="styles.css"> --}}
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body>
@include('components.header')

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">Global B2B Marketplace</h1>
                    <p class="lead mb-4">Connect with verified suppliers and buyers worldwide. Get the best deals on
                        bulk orders.</p>
                    <div class="search-bar mb-4">
                        <div class="input-group">
                            <input type="text" class="form-control form-control-lg"
                                placeholder="What are you looking for?">
                            <button class="btn btn-light px-4"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                    <div class="popular-searches">
                        <span class="text-light-50">Popular:</span>
                        <a href="#" class="btn btn-sm btn-outline-light ms-2">Electronics</a>
                        <a href="#" class="btn btn-sm btn-outline-light ms-2">Machinery</a>
                        <a href="#" class="btn btn-sm btn-outline-light ms-2">Textiles</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="https://img.freepik.com/free-vector/global-business-connection-illustration_53876-17394.jpg"
                        alt="Hero Image" class="img-fluid">
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="container my-5">
        <h2 class="text-center mb-4">Top Categories</h2>
        <div class="row g-4">
            <div class="col-md-3">
                <div class="category-card card">
                    <img src="https://img.freepik.com/free-photo/electronic-devices_144627-41317.jpg"
                        class="category-img" alt="Electronics">
                    <div class="card-body">
                        <h5 class="card-title">Electronics</h5>
                        <p class="card-text text-muted">20,000+ products</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="category-card card">
                    <img src="https://img.freepik.com/free-photo/industrial-machines_1127-3426.jpg" class="category-img"
                        alt="Machinery">
                    <div class="card-body">
                        <h5 class="card-title">Machinery</h5>
                        <p class="card-text text-muted">15,000+ products</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="category-card card">
                    <img src="https://img.freepik.com/free-photo/fabric-samples-textile-swatches_93675-130843.jpg"
                        class="category-img" alt="Textiles">
                    <div class="card-body">
                        <h5 class="card-title">Textiles</h5>
                        <p class="card-text text-muted">25,000+ products</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="category-card card">
                    <img src="https://img.freepik.com/free-photo/construction-equipment_1127-3294.jpg"
                        class="category-img" alt="Construction">
                    <div class="card-body">
                        <h5 class="card-title">Construction</h5>
                        <p class="card-text text-muted">18,000+ products</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="display-5 fw-bold mb-3">Featured Products</h2>
                    <p class="text-muted lead">Discover our handpicked selection of premium products</p>
                </div>
            </div>
            <div class="row g-4">
                @foreach($featuredProducts as $product)
                    <div class="col-md-4">
                        <div class="product-card card h-100 border-0 shadow-sm">
                            <div class="product-image-wrapper position-relative">
                                <img src="{{ asset('storage/' . ($product->images[0] ?? 'products/default.jpg')) }}"
                                    class="card-img-top" alt="{{ $product->name }}"
                                    style="height: 300px; object-fit: cover;">
                                @if($product->is_featured)
                                    <span class="position-absolute top-0 start-0 m-3 badge bg-warning">Featured</span>
                                @endif
                                @if($product->stock_quantity > 0)
                                    <span class="position-absolute top-0 end-0 m-3 badge bg-success">In Stock</span>
                                @endif
                            </div>
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h5 class="card-title mb-0 text-truncate">{{ $product->name }}</h5>
                                    <span class="text-primary fw-bold">${{ number_format($product->price, 2) }}</span>
                                </div>
                                <p class="card-text text-muted mb-3" style="height: 48px; overflow: hidden;">
                                    {{ Str::limit($product->description, 100) }}
                                </p>
                                <div class="product-meta border-top pt-3">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <small class="text-muted">Added by</small>
                                            <a href="#"
                                                class="text-decoration-none d-block text-primary">
                                                {{ $product->creator->name ?? '' }}
                                            </a>
                                        </div>
                                        <div class="col text-end">
                                            @if($product->rating)
                                                <div class="rating">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        @if($i <= $product->rating)
                                                            <i class="fas fa-star text-warning"></i>
                                                        @else
                                                            <i class="far fa-star text-warning"></i>
                                                        @endif
                                                    @endfor
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-white border-0 p-4 pt-0">
                                <div class="d-grid gap-2">
                                    <a href="{{ route('product.show', $product) }}" class="btn btn-primary">
                                        <i class="fas fa-eye me-2"></i>View Details
                                    </a>
                                    <button class="btn btn-outline-primary">
                                        <i class="fas fa-shopping-cart me-2"></i>Add to Cart
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($featuredProducts->count() > 6)
                <div class="text-center mt-5">
                    <a href="#" class="btn btn-outline-primary btn-lg">
                        View All Featured Products
                        <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
            @endif
        </div>
    </section>


    <!-- Seller Selection for Bulk Products Section -->
    <section class="container py-5">
        <h2 class="section-title">Select Suppliers for Bulk Order</h2>
        <p class="text-center text-muted mb-5">Compare verified sellers and select the best partners for your bulk
            procurement needs</p>

        <div class="seller-selection-container">
            <div class="row">
                <div class="col-md-3">
                    <!-- Seller Filters -->
                    <div class="seller-filter-card">
                        <h5 class="mb-4">Filter Sellers</h5>

                        <div class="mb-4">
                            <h6 class="mb-3">Business Type</h6>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="manufacturer" checked>
                                <label class="form-check-label" for="manufacturer">Manufacturer</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="trading-company" checked>
                                <label class="form-check-label" for="trading-company">Trading Company</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="distributor">
                                <label class="form-check-label" for="distributor">Distributor</label>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h6 class="mb-3">Minimum Order Quantity</h6>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="moq" id="moq1" checked>
                                <label class="form-check-label" for="moq1">Any MOQ</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="moq" id="moq2">
                                <label class="form-check-label" for="moq2">Up to 500 units</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="moq" id="moq3">
                                <label class="form-check-label" for="moq3">500-2000 units</label>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h6 class="mb-3">Seller Ratings</h6>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="rating5" checked>
                                <label class="form-check-label" for="rating5">
                                    <span class="rating-stars">
                                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                            class="fas fa-star"></i><i class="fas fa-star"></i><i
                                            class="fas fa-star"></i>
                                    </span>
                                    4.5 & up
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="rating4" checked>
                                <label class="form-check-label" for="rating4">
                                    <span class="rating-stars">
                                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                            class="fas fa-star"></i><i class="fas fa-star"></i><i
                                            class="far fa-star"></i>
                                    </span>
                                    4.0 & up
                                </label>
                            </div>
                        </div>

                        <button class="btn btn-primary w-100">Apply Filters</button>
                    </div>

                    <div class="mt-4">
                        <h6>Compare Selected Sellers</h6>
                        <div id="compare-sellers" class="mt-3">
                            <p class="text-muted">Select at least 2 sellers to compare</p>
                            <button class="btn btn-outline-primary w-100" disabled id="compare-btn">Compare
                                Sellers</button>
                        </div>
                    </div>
                </div>

                <div class="col-md-9">
                    <!-- Seller List -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h4 class="mb-0">Available Sellers</h4>
                            <p class="text-muted mb-0">Showing 12 verified sellers</p>
                        </div>
                        <div>
                            <select class="form-select">
                                <option>Sort by: Recommended</option>
                                <option>Sort by: Highest Rated</option>
                                <option>Sort by: Lowest Price</option>
                                <option>Sort by: Response Time</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        @foreach($sellers as $seller)
                            <div class="col-md-6 mb-4">
                                <div class="seller-card position-relative">
                                    <input type="checkbox" class="compare-checkbox" name="compare-seller"
                                        value="{{ $seller['id'] }}">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($seller['company_name']) }}&background=4CAF50&color=fff"
                                            alt="Seller" class="seller-avatar">
                                        <div class="ms-3">
                                            <h5 class="mb-0">
                                                {{ $seller['company_name'] }}
                                                <span class="verification-badge">
                                                    <i class="fas fa-check-circle me-1"></i> Verified
                                                </span>
                                            </h5>
                                            <p class="text-muted mb-0">{{ ucfirst($seller['business_type']) }}</p>
                                        </div>
                                    </div>
                                    <div class="seller-stats mb-3">
                                        <div class="row text-center">
                                            <div class="col-4">
                                                <div class="stat-value">N/A</div>
                                                <div class="stat-label">Rating</div>
                                            </div>
                                            <div class="col-4">
                                                <div class="stat-value">N/A</div>
                                                <div class="stat-label">Response Rate</div>
                                            </div>
                                            <div class="col-4">
                                                <div class="stat-value">{{ $seller['years_in_business'] }}</div>
                                                <div class="stat-label">Since</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <h6>Main Products</h6>
                                        <ul>
                                            @foreach($seller['main_products'] as $product)
                                                <li>{{ $product }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="mb-3">
                                        <h6>Contact</h6>
                                        <div>
                                            <span><i class="fas fa-user"></i>
                                                {{ $seller['contact_person_name'] }}</span><br>
                                            <span><i class="fas fa-envelope"></i>
                                                {{ $seller['contact_person_email'] }}</span><br>
                                            <span><i class="fas fa-phone"></i> {{ $seller['contact_person_phone'] }}</span>
                                        </div>
                                    </div>
                                    <div class="action-buttons">
                                        <button class="btn btn-primary btn-sm flex-fill" data-bs-toggle="modal"
                                            data-bs-target="#sellerDetailModal" data-seller-id="{{ $seller['id'] }}">
                                            <i class="fas fa-eye me-1"></i> View Details
                                        </button>
                                        <button class="btn btn-outline-primary btn-sm flex-fill">
                                            <i class="fas fa-comment me-1"></i> Contact
                                        </button>
                                        <a href="#" class="btn btn-success btn-sm flex-fill select-seller-btn">
                                            <i class="fas fa-check me-1"></i> Select
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    {{ $sellers->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </section>

    <!-- Seller Detail Modal -->
    <div class="modal fade seller-detail-modal" id="sellerDetailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Seller Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Seller"
                                class="img-fluid rounded-circle mb-3"
                                style="width: 120px; height: 120px; object-fit: cover;">
                            <h4>TechPro Electronics</h4>
                            <span class="verification-badge"><i class="fas fa-check-circle me-1"></i> Verified
                                Seller</span>
                            <p class="mt-3">Manufacturer</p>

                            <div class="d-flex justify-content-center mt-4">
                                <button class="btn btn-primary me-2">
                                    <i class="fas fa-comment me-1"></i> Contact
                                </button>
                                <button class="btn btn-outline-primary">
                                    <i class="fas fa-store me-1"></i> Visit Store
                                </button>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="seller-stats mb-4">
                                <div class="row text-center">
                                    <div class="col-3">
                                        <div class="stat-value">4.8</div>
                                        <div class="stat-label">Rating</div>
                                    </div>
                                    <div class="col-3">
                                        <div class="stat-value">98%</div>
                                        <div class="stat-label">Response Rate</div>
                                    </div>
                                    <div class="col-3">
                                        <div class="stat-value">2d</div>
                                        <div class="stat-label">Avg. Response</div>
                                    </div>
                                    <div class="col-3">
                                        <div class="stat-value">5 yrs</div>
                                        <div class="stat-label">On Platform</div>
                                    </div>
                                </div>
                            </div>

                            <h6>Business Information</h6>
                            <p>Established in 2015, TechPro Electronics specializes in industrial-grade computing
                                solutions with a focus on durability and performance.</p>

                            <div class="row mb-3">
                                <div class="col-6">
                                    <strong>Main Products:</strong>
                                    <ul class="mb-0">
                                        <li>Industrial Laptops</li>
                                        <li>Rugged Tablets</li>
                                        <li>Embedded Systems</li>
                                    </ul>
                                </div>
                                <div class="col-6">
                                    <strong>Markets Served:</strong>
                                    <ul class="mb-0">
                                        <li>North America</li>
                                        <li>Europe</li>
                                        <li>Asia Pacific</li>
                                    </ul>
                                </div>
                            </div>

                            <h6 class="mt-4">Production Capacity</h6>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between">
                                    <span>Factory Size:</span>
                                    <strong>10,000 sq meters</strong>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>R&D Staff:</span>
                                    <strong>45 People</strong>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>QC Staff:</span>
                                    <strong>20 People</strong>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>Monthly Output:</span>
                                    <strong>5,000 units</strong>
                                </div>
                            </div>

                            <h6 class="mt-4">Certifications</h6>
                            <div class="d-flex gap-2">
                                <span class="badge bg-light text-dark">ISO 9001</span>
                                <span class="badge bg-light text-dark">ISO 14001</span>
                                <span class="badge bg-light text-dark">RoHS</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Select This Seller</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bulk Order Bidding Section -->
    <section class="bulk-order-section">
        <div class="container">
            <div class="row align-items-center mb-5">
                <div class="col-lg-6">
                    <h2 class="display-5 fw-bold mb-4">Bulk Order Bidding</h2>
                    <p class="lead mb-4">Get the best deals on large quantity orders through our competitive bidding
                        system.</p>
                    <div class="d-flex gap-3">
                        <form action="bulk-order.html" method="get" style="display: inline;">
                            <button type="submit" class="btn btn-light btn-lg"
                                style="background: white; border-radius: 50px; padding: 15px 30px; font-weight: 500; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                                <i class="fas fa-plus me-2"></i>Submit Bulk Order Request
                            </button>
                        </form>
                        <form action="bulk-order.html" method="get" style="display: inline;">
                            <button type="submit" class="btn btn-outline-light btn-lg"
                                style="border-radius: 50px; padding: 15px 30px; font-weight: 500; border-width: 2px;">
                                <i class="fas fa-gavel me-2"></i>View Active Bids
                            </button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row g-4">
                        <div class="col-6">
                            <div class="bulk-order-stat">
                                <i class="fas fa-box-open bulk-order-icon"></i>
                                <h3 class="mb-2">2,500+</h3>
                                <p class="mb-0">Active Bids</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="bulk-order-stat">
                                <i class="fas fa-handshake bulk-order-icon"></i>
                                <h3 class="mb-2">85%</h3>
                                <p class="mb-0">Success Rate</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="bulk-order-stat">
                                <i class="fas fa-users bulk-order-icon"></i>
                                <h3 class="mb-2">5,000+</h3>
                                <p class="mb-0">Verified Suppliers</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="bulk-order-stat">
                                <i class="fas fa-clock bulk-order-icon"></i>
                                <h3 class="mb-2">4 hrs</h3>
                                <p class="mb-0">Avg. Response Time</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="bulk-order-card">
                        <h5 class="text-white mb-4">Recent Bulk Order Requests</h5>
                        <div class="active-bid"
                            style="background: rgba(255, 255, 255, 0.1); border-radius: 15px; padding: 20px;">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h6 class="text-white mb-2">Industrial Grade Laptops</h6>
                                    <span class="badge bg-dark me-2" style="font-size: 0.9rem;">500 Units</span>
                                    <span class="badge" style="background: #00D2FF;">Electronics</span>
                                </div>
                                <span class="text-white opacity-75">2 days left</span>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <small class="d-block text-white opacity-75">Target Price</small>
                                    <strong class="text-white">$800-$1000/unit</strong>
                                </div>
                                <div class="col-md-4">
                                    <small class="d-block text-white opacity-75">Delivery Needed</small>
                                    <strong class="text-white">Within 30 days</strong>
                                </div>
                                <div class="col-md-4">
                                    <small class="d-block text-white opacity-75">Offers</small>
                                    <strong class="text-white">12 bids received</strong>
                                </div>
                            </div>
                        </div>

                        <div class="active-bid mt-4"
                            style="background: rgba(255, 255, 255, 0.1); border-radius: 15px; padding: 20px;">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h6 class="text-white mb-2">Solar Panels - 400W</h6>
                                    <span class="badge bg-dark me-2" style="font-size: 0.9rem;">1000 Units</span>
                                    <span class="badge" style="background: #00D2FF;">Energy</span>
                                </div>
                                <span class="text-white opacity-75">4 days left</span>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <small class="d-block text-white opacity-75">Target Price</small>
                                    <strong class="text-white">$200-$250/unit</strong>
                                </div>
                                <div class="col-md-4">
                                    <small class="d-block text-white opacity-75">Delivery Needed</small>
                                    <strong class="text-white">Within 45 days</strong>
                                </div>
                                <div class="col-md-4">
                                    <small class="d-block text-white opacity-75">Offers</small>
                                    <strong class="text-white">8 bids received</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="bulk-order-card">
                        <h5 class="text-white mb-4">How It Works</h5>
                        <div class="d-flex align-items-start mb-4">
                            <div class="rounded-circle bg-white text-primary d-flex align-items-center justify-content-center me-3"
                                style="width: 40px; height: 40px;">
                                <i class="fas fa-edit"></i>
                            </div>
                            <div>
                                <h6 class="text-white">1. Submit Request</h6>
                                <p class="mb-0 text-white opacity-75">Specify your product requirements, quantity, and
                                    target price</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-start mb-4">
                            <div class="rounded-circle bg-white text-primary d-flex align-items-center justify-content-center me-3"
                                style="width: 40px; height: 40px;">
                                <i class="fas fa-comments"></i>
                            </div>
                            <div>
                                <h6 class="text-white">2. Receive Offers</h6>
                                <p class="mb-0 text-white opacity-75">Get competitive bids from verified suppliers</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-start">
                            <div class="rounded-circle bg-white text-primary d-flex align-items-center justify-content-center me-3"
                                style="width: 40px; height: 40px;">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div>
                                <h6 class="text-white">3. Choose & Order</h6>
                                <p class="mb-0 text-white opacity-75">Select the best offer and proceed with the order
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- Bulk Order Modal -->
    <div class="modal fade" id="bulkOrderModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Submit Bulk Order Request</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="bulkOrderForm">
                        <!-- Product Details -->
                        <div class="mb-3">
                            <label class="form-label">Product Name*</label>
                            <input type="text" class="form-control" placeholder="Enter product name" required>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Category*</label>
                                <select class="form-select" required>
                                    <option value="">Select category</option>
                                    <option>Electronics</option>
                                    <option>Machinery</option>
                                    <option>Textiles</option>
                                    <option>Construction</option>
                                    <option>Automotive</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Quantity Required*</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" placeholder="Enter quantity" required>
                                    <select class="form-select" style="max-width: 100px;">
                                        <option>Units</option>
                                        <option>Pieces</option>
                                        <option>Sets</option>
                                        <option>Tons</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Price and Delivery -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Target Price Range*</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control" placeholder="Min" required>
                                    <input type="number" class="form-control" placeholder="Max" required>
                                    <select class="form-select" style="max-width: 100px;">
                                        <option>Per Unit</option>
                                        <option>Per Set</option>
                                        <option>Total</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Preferred Delivery Time*</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" placeholder="Enter days" required>
                                    <span class="input-group-text">days</span>
                                </div>
                            </div>
                        </div>

                        <!-- Specifications -->
                        <div class="mb-3">
                            <label class="form-label">Product Specifications*</label>
                            <textarea class="form-control" rows="4"
                                placeholder="Enter detailed specifications, requirements, and any additional information"
                                required></textarea>
                        </div>

                        <!-- Attachments -->
                        <div class="mb-3">
                            <label class="form-label">Attachments</label>
                            <input type="file" class="form-control" multiple>
                            <small class="text-muted">Upload relevant documents, drawings, or specifications (Max 5
                                files, 10MB each)</small>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Submit Request</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <section class="container my-5">
        <div class="row g-4">
            <div class="col-md-3">
                <div class="stats-card">
                    <i class="fas fa-users stats-icon"></i>
                    <h3>10,000+</h3>
                    <p class="text-muted mb-0">Active Suppliers</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <i class="fas fa-globe stats-icon"></i>
                    <h3>150+</h3>
                    <p class="text-muted mb-0">Countries</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <i class="fas fa-box stats-icon"></i>
                    <h3>1M+</h3>
                    <p class="text-muted mb-0">Products</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <i class="fas fa-handshake stats-icon"></i>
                    <h3>5M+</h3>
                    <p class="text-muted mb-0">Transactions</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Supplier Section -->
    <section class="supplier-section">
        <div class="container">
            <h2 class="text-center mb-5">Top Verified Suppliers</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="supplier-card">
                        <img src="https://img.freepik.com/free-photo/factory-building_1127-3426.jpg" alt="Supplier"
                            class="img-fluid rounded mb-3">
                        <h5>TechPro Electronics</h5>
                        <p class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Verified Supplier</p>
                        <p class="mb-0">Main Products: Laptops, Smartphones, Tablets</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="supplier-card">
                        <img src="https://img.freepik.com/free-photo/textile-factory_1127-3294.jpg" alt="Supplier"
                            class="img-fluid rounded mb-3">
                        <h5>Global Textile Co.</h5>
                        <p class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Verified Supplier</p>
                        <p class="mb-0">Main Products: Cotton, Polyester, Silk</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="supplier-card">
                        <img src="https://img.freepik.com/free-photo/construction-site_1127-3426.jpg" alt="Supplier"
                            class="img-fluid rounded mb-3">
                        <h5>BuildMaster Construction</h5>
                        <p class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Verified Supplier</p>
                        <p class="mb-0">Main Products: Construction Materials, Tools</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('components.footer')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var logoutForm = document.querySelector('form[action="{{ route('logout') }}"]');
            var logoutButton = logoutForm.querySelector('button[type="submit"]');

            logoutButton.addEventListener('click', function (event) {
                event.preventDefault();
                logoutForm.submit();
            });
        });
    </script>
</body>

</html>
