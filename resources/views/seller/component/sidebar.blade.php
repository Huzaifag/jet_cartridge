<!-- Sidebar -->
<nav class="sidebar" style="overflow-y: auto; max-height: 100vh;">
    <div class="sidebar-header">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="img-fluid">
    </div>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a href="{{ route('seller.dashboard') }}"
                class="nav-link {{ request()->routeIs('seller.dashboard') ? 'active' : '' }}">
                <i class="fas fa-home"></i>
                Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('seller.employees.index') }}"
                class="nav-link {{ request()->routeIs('seller.employees.*') ? 'active' : '' }}">
                <i class="fas fa-users"></i>
                Employees
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('seller.products.index') }}"
                class="nav-link {{ request()->routeIs('seller.products.*') ? 'active' : '' }}">
                <i class="fas fa-box"></i>
                Products
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('seller.contact-book.index') }}"
                class="nav-link {{ request()->routeIs('seller.contact-book.*') ? 'active' : '' }}">
                <i class="fas fa-address-book"></i>
                Contact Book
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('seller.delivery-boys.index') }}"
                class="nav-link {{ request()->routeIs('seller.delivery-boys.*') ? 'active' : '' }}">
                <i class="fas fa-motorcycle"></i>
                Delivery Boys
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('seller.account-persons.index') }}"
                class="nav-link {{ request()->routeIs('seller.account-persons.*') ? 'active' : '' }}">
                <i class="fas fa-user-tie"></i>
                Account Persons
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('seller.orders.index') }}"
                class="nav-link {{ request()->routeIs('seller.orders.*') ? 'active' : '' }}">
                <i class="fas fa-shopping-cart"></i>
                Orders
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('seller.orders.bulkIndex') }}"
                class="nav-link {{ request()->routeIs('seller.orders.bulkIndex') ? 'active' : '' }}">
                <i class="fas fa-boxes"></i>
                Bulk Orders
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('seller.orders.track.index') }}"
                class="nav-link {{ request()->routeIs('seller.orders.track') ? 'active' : '' }}">
                <i class="fas fa-map-marker-alt"></i>
                Orders Track
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('seller.leads') }}"
                class="nav-link {{ request()->routeIs('seller.leads') ? 'active' : '' }}">
                <i class="fas fa-chart-bar"></i>
                Leads
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('seller.promotions.index') }}"
                class="nav-link {{ request()->routeIs('seller.promotions.*') ? 'active' : '' }}">
                <i class="fas fa-percentage"></i>
                Promotions
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('seller.coins.index') }}"
                class="nav-link {{ request()->routeIs('seller.coins.*') ? 'active' : '' }}">
                <i class="fas fa-coins"></i>
                Coins & Rewards
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('seller.communication') }}"
                class="nav-link {{ request()->routeIs('seller.communication') ? 'active' : '' }}">
                <i class="fas fa-comments"></i>
                Communication
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('seller.settings') }}"
                class="nav-link {{ request()->routeIs('seller.settings') ? 'active' : '' }}">
                <i class="fas fa-cog"></i>
                Settings
            </a>
        </li>
    </ul>
</nav>
