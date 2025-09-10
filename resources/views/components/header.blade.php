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

<!-- bootstrap & fontawesome (use your project's versions if you prefer) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">

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

    <!-- Collapse: center links + right actions -->
    <div class="collapse navbar-collapse" id="mainNavbar">
      <!-- Centered nav links -->
      <ul class="navbar-nav mx-auto mb-2 mb-lg-0 align-items-lg-center" id="main-nav-list" role="menu">
        <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="categories.html">Categories</a></li>
        <li class="nav-item"><a class="nav-link" href="bulk-order.html">Bulk Order</a></li>
        <li class="nav-item"><a class="nav-link" href="suppliers.html">Suppliers</a></li>
        <li class="nav-item"><a class="nav-link" href="featured.html">Featured Products</a></li>
        <li class="nav-item"><a class="nav-link" href="rfq.html">Submit RFQ</a></li>
        <li class="nav-item"><a class="nav-link" href="sellers.html">Top Sellers</a></li>
        <li class="nav-item"><a class="nav-link" href="buyer-protection.html">Buyer Protection</a></li>
      </ul>

      <!-- Right actions -->
      <div class="d-flex align-items-center gap-2 ms-lg-3">
        <!-- Login (icon + full text on lg) -->
        <a href="{{ route('unified.login.form') }}" class="btn btn-outline-primary btn-sm d-flex align-items-center">
          <i class="fas fa-building me-2"></i>
          <span class="d-none d-lg-inline">Login Employee Dashboard</span>
          <span class="d-inline d-lg-none">Login</span>
        </a>

        <!-- Become a seller: icon-only on small, text on large -->
        <a href="become-seller.html" class="btn btn-outline-primary d-flex align-items-center justify-content-center
           rounded-pill px-3 py-1">
          <i class="fas fa-store me-2"></i>
          <span class="d-none d-lg-inline">Become a Seller</span>
        </a>

        <!-- Help (icon + short text on small if needed) -->
        <a href="help-center.html" class="nav-link d-flex align-items-center mb-0 ms-2">
          <i class="fas fa-question-circle me-1"></i>
          <span class="d-none d-sm-inline">Help</span>
        </a>
      </div>
    </div>
  </div>
</nav>

<!-- small custom styles to prevent wrap and allow horizontal scroll on narrow devices -->
<style>
  /* prevent links from wrapping and allow touch horizontal scroll when collapsed */
  #main-nav-list {
    gap: 0.25rem;
    overflow-x: auto;
    white-space: nowrap;
    -webkit-overflow-scrolling: touch;
  }
  #main-nav-list .nav-link {
    white-space: nowrap;
    padding: .45rem .7rem;
  }

  /* smaller paddings for very small screens */
  @media (max-width: 420px) {
    .navbar-brand img { height: 34px; }
    .navbar .btn { font-size: .85rem; padding: .35rem .6rem; }
  }

  /* make the toggler icon visible if default styles are overridden */
  .navbar-toggler-icon {
    background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba%280,0,0,0.7%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
  }

  /* optional: hide horizontal scrollbar in desktop (still scrollable on touch) */
  #main-nav-list::-webkit-scrollbar { height: 6px; }
  #main-nav-list::-webkit-scrollbar-thumb { border-radius: 6px; background: rgba(0,0,0,0.12); }
</style>

<!-- Required bootstrap js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

