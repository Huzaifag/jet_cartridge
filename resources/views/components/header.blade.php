<!-- Top Bar -->
<div class="top-bar py-2">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <span class="text-white me-3">Ship to: <img src="https://flagcdn.com/w20/us.png" alt="USA"
                        class="ms-2"></span>
                <span class="text-white">USD</span>
            </div>
            <div class="d-flex align-items-center gap-3">
                @if(auth()->guard('seller')->check())
                    <a href="{{ route('seller.dashboard') }}" class="btn btn-outline-light">Seller Dashboard</a>
                @elseif(auth()->guard('employee')->check())
                    <a href="{{ route('seller.employees.dashboard') }}" class="btn btn-outline-light">Employee Dashboard</a>
                @elseif(auth()->guard('delivery_boy')->check())
                    <a href="{{ route('seller.delivery-boys.dashboard') }}" class="btn btn-outline-light">Delivery Dashboard</a>
                @elseif(auth()->guard('account-person')->check())
                    <a href="{{ route('seller.account-person.dashboard') }}" class="btn btn-outline-light">Account
                        Dashboard</a>
                @endif
                <a href="messages.html" class="text-white text-decoration-none" title="Messages">
                    <i class="far fa-comment"></i>
                </a>
                <a href="orders.html" class="text-white text-decoration-none" title="Orders">
                    <i class="far fa-clipboard"></i>
                </a>
                <a href="cart.html" class="text-white text-decoration-none position-relative" title="Cart">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="notification-badge">3</span>
                </a>
                <div class="d-flex align-items-center">
                    @guest
                        <a href="{{ route('login') }}" class="text-decoration-none"><i class="far fa-user"></i></a>
                    @else
                        <div class="dropdown">
                            <a href="#" class="text-decoration-none dropdown-toggle" id="userDropdown"
                                data-bs-toggle="dropdown">
                                <i class="far fa-user"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end profile-dropdown" aria-labelledby="userDropdown">
                                <li>
                                    @auth
                                            <a class="dropdown-item" href="{{ route('profile.index') }}">My Profile</a>
                                            <a class="dropdown-item" href="#orders">My Orders</a>
                                            <a class="dropdown-item" href="#wishlist">Wishlist</a>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="dropdown-item">Logout</button>
                                        </form>
                                    @endauth
                                </li>
                            </ul>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Navbar -->
<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="index.html">
            <img src="images/logo.png" alt="Logo" height="40" class="me-2">
            <span>Jet Cartridge</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="categories.html">Categories</a></li>
                <li class="nav-item"><a class="nav-link" href="bulk-order.html">Bulk Order</a></li>
                <li class="nav-item"><a class="nav-link" href="suppliers.html">Suppliers</a></li>
                <li class="nav-item"><a class="nav-link" href="featured.html">Featured Products</a></li>
                <li class="nav-item"><a class="nav-link" href="rfq.html">Submit RFQ</a></li>
                <li class="nav-item"><a class="nav-link" href="sellers.html">Top Sellers</a></li>
                <li class="nav-item"><a class="nav-link" href="buyer-protection.html">Buyer Protection</a></li>
                <li class="nav-item">
                    <a href="{{ route('unified.login.form') }}" class="nav-link btn btn-outline-primary ms-2">
                        <i class="fas fa-building me-2"></i>Login Employee Dashboard
                    </a>
                </li>
            </ul>
            <div class="d-flex align-items-center gap-3">
                <a href="become-seller.html" class="btn btn-outline-primary">
                    <i class="fas fa-store me-1"></i>Become a Seller
                </a>
                <a href="help-center.html" class="nav-link">
                    <i class="fas fa-question-circle me-1"></i>Help
                </a>
            </div>
        </div>
    </div>
</nav>
