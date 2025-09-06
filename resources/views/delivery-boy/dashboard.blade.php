<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Boy Dashboard - {{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar {
            min-height: 100vh;
            background: #343a40;
            color: white;
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,.75);
            padding: 1rem;
        }
        .sidebar .nav-link:hover {
            color: rgba(255,255,255,1);
            background: rgba(255,255,255,.1);
        }
        .sidebar .nav-link.active {
            color: white;
            background: rgba(255,255,255,.1);
        }
        .main-content {
            min-height: 100vh;
            background: #f8f9fa;
        }
        .navbar {
            background: white;
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
        }
        .welcome-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0,0,0,.1);
        }
        .status-badge {
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
            font-size: 0.875rem;
        }
        .status-pending { background-color: #fef3c7; color: #92400e; }
        .status-picked_up { background-color: #dbeafe; color: #1e40af; }
        .status-in_transit { background-color: #e0e7ff; color: #3730a3; }
        .status-delivered { background-color: #dcfce7; color: #166534; }
        .status-cancelled { background-color: #fee2e2; color: #991b1b; }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 px-0 sidebar">
                <div class="d-flex flex-column">
                    <div class="p-3 text-center">
                        <i class="fas fa-motorcycle fa-2x mb-2"></i>
                        <h5>Delivery Dashboard</h5>
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('delivery-boy.dashboard') }}">
                                <i class="fas fa-home me-2"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-box me-2"></i> My Deliveries
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('delivery-boy.profile') }}">
                                <i class="fas fa-user me-2"></i> Profile
                            </a>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('delivery-boy.logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="nav-link w-100 text-start border-0 bg-transparent">
                                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 px-0 main-content">
                <!-- Navbar -->
                <nav class="navbar navbar-expand-lg navbar-light px-4 py-3">
                    <div class="container-fluid">
                        <span class="navbar-brand">Welcome, {{ auth()->user()->name }}</span>
                    </div>
                </nav>

                <!-- Content -->
                <div class="container-fluid p-4">
                    <div class="row">
                        <div class="col-12">
                            <div class="welcome-card p-4">
                                <h4>Dashboard Overview</h4>
                                <p class="text-muted">Welcome to your delivery dashboard. Here you can manage your deliveries and update your profile.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Statistics Cards -->
                    <div class="row mt-4">
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title text-muted">Total Deliveries</h5>
                                    <h2 class="text-primary">{{ $stats['total_deliveries'] }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title text-muted">Completed Today</h5>
                                    <h2 class="text-success">{{ $stats['completed_today'] }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title text-muted">Pending Deliveries</h5>
                                    <h2 class="text-warning">{{ $stats['pending_deliveries'] }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Deliveries -->
                    <div class="card mt-4">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Recent Deliveries</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Customer</th>
                                            <th>Address</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($recent_deliveries as $delivery)
                                            <tr>
                                                <td>{{ $delivery->order_id }}</td>
                                                <td>{{ $delivery->customer_name }}</td>
                                                <td>{{ Str::limit($delivery->delivery_address, 30) }}</td>
                                                <td>
                                                    <span class="status-badge status-{{ $delivery->status }}">
                                                        {{ ucfirst($delivery->status) }}
                                                    </span>
                                                </td>
                                                <td>{{ $delivery->delivery_date?->format('M d, Y') }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center py-4">
                                                    <i class="fas fa-inbox fa-2x mb-3 text-muted d-block"></i>
                                                    No deliveries found
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 