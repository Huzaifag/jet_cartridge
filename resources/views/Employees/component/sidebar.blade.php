<!-- Sidebar -->
<nav class="sidebar" style="overflow-y: auto; max-height: 100vh;">
    <div class="sidebar-header">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="img-fluid">
    </div>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a href="{{ route('seller.employees.dashboard') }}"
                class="nav-link {{ request()->routeIs('seller.employees.*dashboard') || request()->routeIs('seller.employees.dashboard') ? 'active' : '' }}">
                <i class="fas fa-home"></i>
                Dashboard
            </a>
        </li>


        @php
            $employee = Auth::guard('employee')->user();
        @endphp

        @if($employee->position === 'Accountant')
        <li class="nav-item">
            <a href="{{ route('seller.employees.orders.index') }}"
                class="nav-link {{ request()->routeIs('seller.employees.orders.*') ? 'active' : '' }}">
                <i class="fas fa-file-invoice"></i>
                Orders
            </a>
        </li>
        @endif

        @if($employee->position === 'Warehouse')
        <li class="nav-item">
            <a href="{{ route('seller.employees.warehouse.orders') }}"
                class="nav-link {{ request()->routeIs('seller.employees.warehouse.orders') ? 'active' : '' }}">
                <i class="fas fa-file-invoice"></i>
                Orders
            </a>
        </li>
        @endif

        @if($employee->position === 'Delivery_boy')
        <li class="nav-item">
            <a href="{{ route('seller.employees.delivery-person.orders') }}"
                class="nav-link {{ request()->routeIs('seller.employees.delivery-person.orders') ? 'active' : '' }}">
                <i class="fas fa-file-invoice"></i>
                Orders
            </a>
        </li>
        @endif


        @if($employee->position === 'Sales Manager')
        <li class="nav-item">
            <a href="{{ route('seller.employees.sales_man.products.index') }}"
                class="nav-link {{ request()->routeIs('seller.employees.sales_man.products.index') ? 'active' : '' }}">
                <i class="fas fa-box"></i>
                Products
            </a>
        </li>
        @endif

        @if($employee->position === 'Sales Manager')
        <li class="nav-item">
            <a href="{{ route('seller.employees.sales_man.orders') }}"
                class="nav-link {{ request()->routeIs('seller.employees.sales_man.orders') ? 'active' : '' }}">
                <i class="fas fa-file-invoice"></i>
                Orders
            </a>
        </li>
        @endif

        @if($employee->position === 'Sales Manager')
        <li class="nav-item">
            <a href="{{ route('seller.employees.sales_man.orders.bulk') }}"
                class="nav-link {{ request()->routeIs('seller.employees.sales_man.orders.bulk') ? 'active' : '' }}">
                <i class="fas fa-boxes"></i>
                Bulk Orders
            </a>
        </li>
        @endif

        @if($employee->position === 'Sales Manager')
        <li class="nav-item">
            <a href="{{ route('seller.employees.sales_man.leads') }}"
                class="nav-link {{ request()->routeIs('seller.employees.sales_man.leads') ? 'active' : '' }}">
                <i class="fas fa-chart-bar"></i>
                Leads
            </a>
        </li>
        @endif

    </ul>
</nav>
