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


<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm">
  <div class="container">
    <!-- Brand -->
    <a class="navbar-brand d-flex align-items-center" href="index.html">
      <img src="images/logo.png" alt="Logo" height="40" class="me-2">
      <span class="fw-bold">Jet Cartridge</span>
    </a>

    <!-- Toggler -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
      aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar collapse -->
    <div class="collapse navbar-collapse" id="mainNavbar">

      <!-- Main nav links -->
      <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
        
        <!-- Dropdown for many links -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="menuDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Explore
          </a>
          <ul class="dropdown-menu" aria-labelledby="menuDropdown">
            <li><a class="dropdown-item" href="categories.html">Categories</a></li>
            <li><a class="dropdown-item" href="bulk-order.html">Bulk Order</a></li>
            <li><a class="dropdown-item" href="suppliers.html">Suppliers</a></li>
            <li><a class="dropdown-item" href="featured.html">Featured Products</a></li>
            <li><a class="dropdown-item" href="rfq.html">Submit RFQ</a></li>
            <li><a class="dropdown-item" href="sellers.html">Top Sellers</a></li>
            <li><a class="dropdown-item" href="buyer-protection.html">Buyer Protection</a></li>
          </ul>
        </li>
      </ul>

      <!-- Right actions -->
      <div class="d-flex align-items-center gap-2 ms-lg-3">
        <a href="{{ route('unified.login.form') }}" class="btn btn-outline-primary btn-sm d-flex align-items-center">
          <i class="fas fa-building me-2"></i>
          <span class="d-none d-lg-inline">Login Employee Dashboard</span>
          <span class="d-inline d-lg-none">Login</span>
        </a>
        <a href="become-seller.html" class="btn btn-outline-primary d-flex align-items-center">
          <i class="fas fa-store me-2"></i>
          <span class="d-none d-md-inline">Become a Seller</span>
        </a>
        <a href="help-center.html" class="nav-link d-flex align-items-center">
          <i class="fas fa-question-circle me-1"></i>
          <span class="d-none d-sm-inline">Help</span>
        </a>
      </div>
    </div>
  </div>
</nav>


