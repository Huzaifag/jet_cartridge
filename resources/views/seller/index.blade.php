<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Dashboard - JetCartridge</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/seller-styles.css">
</head>
<body class="bg-light">
    <!-- Navigation -->
    <nav class="navbar seller-nav">
        <div class="container">
            <a class="navbar-brand text-white" href="#">JetCartridge</a>
            <div class="d-flex">
                <a class="nav-link" href="dashboard.html">Dashboard</a>
                <a class="nav-link" href="kyc-verification.html">KYC</a>
                <a class="nav-link" href="product-management.html">Products</a>
                <a class="nav-link" href="rfq-marketplace.html">RFQs</a>
                <a class="nav-link" href="fulfillment-shipping.html">Fulfillment</a>
                <a class="nav-link" href="buyer-engagement.html">Buyers</a>
                <a class="nav-link" href="promotions.html">Promotions</a>
                <a class="nav-link" href="proof-shipment.html">Shipment</a>
                <a class="nav-link" href="analytics.html">Analytics</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-4">
        <h2 class="mb-4">Seller Dashboard</h2>
        
        <!-- Statistics Cards -->
        <div class="row">
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="text-muted">Total Orders</h6>
                            <h3 class="mb-0">120</h3>
                        </div>
                        <div class="ms-auto">
                            <i class="fas fa-shopping-cart text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="text-muted">Total Revenue</h6>
                            <h3 class="mb-0">$125,000</h3>
                        </div>
                        <div class="ms-auto">
                            <i class="fas fa-dollar-sign text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="text-muted">Pending Shipments</h6>
                            <h3 class="mb-0">12</h3>
                        </div>
                        <div class="ms-auto">
                            <i class="fas fa-truck text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="text-muted">Buyer Messages</h6>
                            <h3 class="mb-0">8</h3>
                        </div>
                        <div class="ms-auto">
                            <i class="fas fa-envelope text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Inventory Alerts & RFQs -->
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Inventory Alerts</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Stock</th>
                                        <th>MOQ</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Blue Shirt</td>
                                        <td>5</td>
                                        <td>20</td>
                                        <td><span class="status-badge status-low">Low Stock</span></td>
                                    </tr>
                                    <tr>
                                        <td>Blue Shirt</td>
                                        <td>5</td>
                                        <td>20</td>
                                        <td><span class="status-badge status-low">Low Stock</span></td>
                                    </tr>
                                    <tr>
                                        <td>Blue Shirt</td>
                                        <td>5</td>
                                        <td>20</td>
                                        <td><span class="status-badge status-ok">OK</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Active RFQs</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>RFQ ID</th>
                                        <th>Qty</th>
                                        <th>Deadline</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>RFQ #2489</td>
                                        <td>100 units</td>
                                        <td>12 May</td>
                                        <td>
                                            <button class="btn btn-sm btn-primary">Submit Quote</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>RFQ #2489</td>
                                        <td>100 units</td>
                                        <td>12 May</td>
                                        <td>
                                            <button class="btn btn-sm btn-primary">Submit Quote</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/your-code.js" crossorigin="anonymous"></script>
</body>
</html> 