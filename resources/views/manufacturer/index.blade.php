<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manufacturer Dashboard - JetCartridge</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link href="css/manufacturer-styles.css" rel="stylesheet">
</head>
<body>
    <!-- Navigation -->
    <nav class="manufacturer-navbar">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <a class="navbar-brand text-white" href="#">JetCartridge</a>
                <div class="nav-links">
                    <a class="nav-link active" href="./dashboard.html">Dashboard</a>
                    <a class="nav-link" href="./products.html">Products</a>
                    <a class="nav-link" href="./orders.html">Orders</a>
                    <a class="nav-link" href="./inventory.html">Inventory</a>
                    <a class="nav-link" href="./analytics.html">Analytics</a>
                    <a class="nav-link" href="./profile.html">Profile</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container py-4">
        <!-- Welcome Section -->
        <div class="row mb-4">
            <div class="col-12">
                <h2>Welcome back, Manufacturer!</h2>
                <p class="text-muted">Here's your business overview for today</p>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="stats-card dashboard-card">
                    <div class="stats-icon">
                        <i class='bx bx-shopping-bag'></i>
                    </div>
                    <h3>2,456</h3>
                    <p class="text-muted mb-0">Total Orders</p>
                    <small class="text-success">+15% from last month</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card dashboard-card">
                    <div class="stats-icon">
                        <i class='bx bx-dollar-circle'></i>
                    </div>
                    <h3>$45,678</h3>
                    <p class="text-muted mb-0">Revenue</p>
                    <small class="text-success">+8% from last month</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card dashboard-card">
                    <div class="stats-icon">
                        <i class='bx bx-package'></i>
                    </div>
                    <h3>1,234</h3>
                    <p class="text-muted mb-0">Products</p>
                    <small class="text-warning">3 low stock items</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card dashboard-card">
                    <div class="stats-icon">
                        <i class='bx bx-user'></i>
                    </div>
                    <h3>456</h3>
                    <p class="text-muted mb-0">Customers</p>
                    <small class="text-success">+12% from last month</small>
                </div>
            </div>
        </div>

        <!-- Recent Orders & Inventory Alerts -->
        <div class="row">
            <!-- Recent Orders -->
            <div class="col-md-8 mb-4">
                <div class="dashboard-card p-4">
                    <h4 class="mb-4">Recent Orders</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Customer</th>
                                    <th>Product</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#12345</td>
                                    <td>John Doe</td>
                                    <td>Printer Cartridge</td>
                                    <td>$299</td>
                                    <td><span class="badge badge-success">Delivered</span></td>
                                </tr>
                                <tr>
                                    <td>#12346</td>
                                    <td>Jane Smith</td>
                                    <td>Toner Pack</td>
                                    <td>$199</td>
                                    <td><span class="badge badge-warning">Processing</span></td>
                                </tr>
                                <tr>
                                    <td>#12347</td>
                                    <td>Mike Johnson</td>
                                    <td>Ink Bundle</td>
                                    <td>$499</td>
                                    <td><span class="badge badge-danger">Pending</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-end mt-3">
                        <a href="orders.html" class="btn btn-primary">View All Orders</a>
                    </div>
                </div>
            </div>

            <!-- Inventory Alerts -->
            <div class="col-md-4 mb-4">
                <div class="dashboard-card p-4">
                    <h4 class="mb-4">Inventory Alerts</h4>
                    <div class="alert alert-warning">
                        <i class='bx bx-error me-2'></i>
                        Low stock: Black Toner (5 units left)
                    </div>
                    <div class="alert alert-warning">
                        <i class='bx bx-error me-2'></i>
                        Low stock: Color Cartridge (8 units left)
                    </div>
                    <div class="alert alert-danger">
                        <i class='bx bx-x-circle me-2'></i>
                        Out of stock: Photo Paper
                    </div>
                    <div class="text-end mt-3">
                        <a href="inventory.html" class="btn btn-primary">Manage Inventory</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 