@extends('Employees.layout.app')
@section('content')
    <style>

        
      
        
        .container {
            display: grid;
            
            min-height: 100vh;
        }
        
      
        
        /* Main Content Styles */
        .employee-main-content {
            grid-column: 1;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--light);
        }
        
        .header h2 {
            font-weight: 600;
            color: var(--dark);
        }
        
        .user-info {
            display: flex;
            align-items: center;
        }
        
        .user-info img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
            object-fit: cover;
        }
        
        /* Dashboard Cards */
        .stats-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .card {
            background: var(--white);
            border-radius: var(--border-radius);
            padding: 20px;
            box-shadow: var(--shadow);
        }
        
        .stat-card {
            display: flex;
            align-items: center;
        }
        
        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 24px;
        }
        
        .pending .stat-icon {
            background: rgba(243, 156, 18, 0.2);
            color: var(--warning);
        }
        
        .invoices .stat-icon {
            background: rgba(46, 204, 113, 0.2);
            color: var(--success);
        }
        
        .revenue .stat-icon {
            background: rgba(52, 152, 219, 0.2);
            color: var(--secondary);
        }
        
        .overdue .stat-icon {
            background: rgba(231, 76, 60, 0.2);
            color: var(--danger);
        }
        
        .stat-info h3 {
            font-size: 24px;
            margin-bottom: 5px;
        }
        
        .stat-info p {
            color: var(--gray);
            font-size: 14px;
        }
        
        /* Quick Actions */
        .employee-quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 30px;
        }
        
        .action-card {
            background: var(--white);
            border-radius: var(--border-radius);
            padding: 20px;
            box-shadow: var(--shadow);
            text-align: center;
            cursor: pointer;
            transition: transform 0.3s ease;
        }
        
        .action-card:hover {
            transform: translateY(-5px);
        }
        
        .action-card i {
            font-size: 32px;
            margin-bottom: 15px;
            color: var(--secondary);
        }
        
        .action-card h3 {
            font-size: 16px;
            margin-bottom: 5px;
        }
        
        .action-card p {
            color: var(--gray);
            font-size: 13px;
        }
        
        /* Table Styles */
        .table-container {
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            overflow: hidden;
            margin-bottom: 30px;
        }
        
        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            border-bottom: 1px solid var(--light);
        }
        
        .table-header h3 {
            font-weight: 600;
        }
        
        .view-all {
            color: var(--secondary);
            text-decoration: none;
            font-weight: 500;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        thead {
            background: #f5f7fa;
        }
        
        th, td {
            padding: 15px 20px;
            text-align: left;
            border-bottom: 1px solid var(--light);
        }
        
        th {
            font-weight: 600;
            color: var(--dark);
        }
        
        tbody tr {
            transition: background 0.3s ease;
        }
        
        tbody tr:hover {
            background: #f9fafb;
        }
        
        .status {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }
        
        .status-pending {
            background: rgba(243, 156, 18, 0.2);
            color: var(--warning);
        }
        
        .status-approved {
            background: rgba(46, 204, 113, 0.2);
            color: var(--success);
        }
        
        .status-rejected {
            background: rgba(231, 76, 60, 0.2);
            color: var(--danger);
        }
        
        .status-overdue {
            background: rgba(231, 76, 60, 0.2);
            color: var(--danger);
        }
        
        .employee-action-btn {
            padding: 8px 15px;
            border: none;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-primary {
            background: var(--secondary);
            color: var(--white);
        }
        
        .btn-primary:hover {
            background: #2980b9;
        }
        
        .btn-success {
            background: var(--success);
            color: var(--white);
        }
        
        .btn-success:hover {
            background: #27ae60;
        }
        
        /* Charts Section */
        .charts {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .chart-container {
            background: var(--white);
            border-radius: var(--border-radius);
            padding: 20px;
            box-shadow: var(--shadow);
        }
        
        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .chart-header h3 {
            font-weight: 600;
        }
        
        .chart-placeholder {
            background: #f5f7fa;
            height: 250px;
            border-radius: var(--border-radius);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gray);
        }
        
        /* Responsive Styles */
        @media (max-width: 992px) {
            .container {
                grid-template-columns: 1fr;
            }
            
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }
            
            .employee-main-content {
                grid-column: 1;
            }
            
            .stats-cards, .quick-actions, .charts {
                grid-template-columns: 1fr;
            }
        }
        
        @media (max-width: 768px) {
            .table-header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .view-all {
                margin-top: 10px;
            }
        }
    </style>

    <div class="container">
        
        <!-- Main Content -->
        <div class="employee-main-content">
            <div class="header">
                <h2>Accountant Dashboard</h2>
                <div class="user-info">
                    <img src="https://ui-avatars.com/api/?name=Accountant+User&background=3498db&color=fff" alt="User">
                    <span>Sarah Johnson, Accountant</span>
                </div>
            </div>
            
            <!-- Stats Cards -->
            <div class="stats-cards">
                <div class="card stat-card pending">
                    <div class="stat-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-info">
                        <h3>12</h3>
                        <p>Pending Approvals</p>
                    </div>
                </div>
                
                <div class="card stat-card invoices">
                    <div class="stat-icon">
                        <i class="fas fa-file-invoice"></i>
                    </div>
                    <div class="stat-info">
                        <h3>8</h3>
                        <p>Invoices to Send</p>
                    </div>
                </div>
                
                <div class="card stat-card revenue">
                    <div class="stat-icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="stat-info">
                        <h3>$4,835</h3>
                        <p>Revenue This Week</p>
                    </div>
                </div>
                
                <div class="card stat-card overdue">
                    <div class="stat-icon">
                        <i class="fas fa-exclamation-circle"></i>
                    </div>
                    <div class="stat-info">
                        <h3>5</h3>
                        <p>Overdue Invoices</p>
                    </div>
                </div>
            </div>
            
            <!-- Quick Actions -->
            <div class="employee-quick-actions">
                <div class="action-card" onclick="location.href='#';">
                    <i class="fas fa-file-invoice-dollar"></i>
                    <h3>Create Invoice</h3>
                    <p>Generate a new invoice</p>
                </div>
                
                <div class="action-card" onclick="location.href='#';">
                    <i class="fas fa-check-circle"></i>
                    <h3>Approve Orders</h3>
                    <p>Review pending orders</p>
                </div>
                
                <div class="action-card" onclick="location.href='#';">
                    <i class="fas fa-paper-plane"></i>
                    <h3>Send Invoices</h3>
                    <p>Send pending invoices</p>
                </div>
                
                <div class="action-card" onclick="location.href='#';">
                    <i class="fas fa-chart-pie"></i>
                    <h3>View Reports</h3>
                    <p>Financial reports</p>
                </div>
            </div>
            
            <!-- Pending Approvals Table -->
            <div class="table-container">
                <div class="table-header">
                    <h3>Pending Approvals from Sellers</h3>
                    <a href="#" class="view-all">View All</a>
                </div>
                
                <table>
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Seller</th>
                            <th>Customer</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#ORD-7281</td>
                            <td>Smith Crafts</td>
                            <td>John Davidson</td>
                            <td>$245.99</td>
                            <td><span class="status status-pending">Pending</span></td>
                            <td>
                                <button class="employee-action-btn btn-primary">
                                    <i class="fas fa-check"></i> Approve
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>#ORD-7282</td>
                            <td>WoodArt Studio</td>
                            <td>Emma Wilson</td>
                            <td>$189.50</td>
                            <td><span class="status status-pending">Pending</span></td>
                            <td>
                                <button class="employee-action-btn btn-primary">
                                    <i class="fas fa-check"></i> Approve
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>#ORD-7285</td>
                            <td>Handmade Treasures</td>
                            <td>Michael Brown</td>
                            <td>$320.00</td>
                            <td><span class="status status-pending">Pending</span></td>
                            <td>
                                <button class="employee-action-btn btn-primary">
                                    <i class="fas fa-check"></i> Approve
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <!-- Recent Invoices Table -->
            <div class="table-container">
                <div class="table-header">
                    <h3>Recent Invoices</h3>
                    <a href="#" class="view-all">View All</a>
                </div>
                
                <table>
                    <thead>
                        <tr>
                            <th>Invoice ID</th>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Amount</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#INV-5281</td>
                            <td>#ORD-7275</td>
                            <td>Robert Parker</td>
                            <td>$189.50</td>
                            <td>Nov 15, 2023</td>
                            <td><span class="status status-pending">Pending Payment</span></td>
                            <td>
                                <button class="employee-action-btn btn-success">
                                    <i class="fas fa-paper-plane"></i> Send
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>#INV-5278</td>
                            <td>#ORD-7271</td>
                            <td>Jennifer Lopez</td>
                            <td>$425.00</td>
                            <td>Nov 10, 2023</td>
                            <td><span class="status status-overdue">Overdue</span></td>
                            <td>
                                <button class="employee-action-btn btn-primary">
                                    <i class="fas fa-envelope"></i> Remind
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>#INV-5275</td>
                            <td>#ORD-7268</td>
                            <td>David Miller</td>
                            <td>$210.75</td>
                            <td>Nov 20, 2023</td>
                            <td><span class="status status-approved">Paid</span></td>
                            <td>
                                <button class="employee-action-btn btn-primary">
                                    <i class="fas fa-warehouse"></i> Fulfill
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <!-- Charts Section -->
            <div class="charts">
                <div class="chart-container">
                    <div class="chart-header">
                        <h3>Revenue Overview</h3>
                        <select>
                            <option>Last 7 Days</option>
                            <option>Last 30 Days</option>
                            <option>Last 90 Days</option>
                        </select>
                    </div>
                    <div class="chart-placeholder">
                        <i class="fas fa-chart-bar" style="font-size: 48px; margin-right: 15px;"></i>
                        Revenue Chart Visualization
                    </div>
                </div>
                
                <div class="chart-container">
                    <div class="chart-header">
                        <h3>Invoice Status</h3>
                    </div>
                    <div class="chart-placeholder">
                        <i class="fas fa-chart-pie" style="font-size: 48px; margin-right: 15px;"></i>
                        Invoice Status Chart
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Simple interactivity for the dashboard
        document.addEventListener('DOMContentLoaded', function() {
            // Add active class to menu items on click
            
            // Simulate chart loading
            setTimeout(() => {
                const chartPlaceholders = document.querySelectorAll('.chart-placeholder');
                chartPlaceholders.forEach(chart => {
                    chart.innerHTML = '<i class="fas fa-spinner fa-spin" style="font-size: 48px;"></i> Loading chart data...';
                });
                
                // Simulate chart data loaded
                setTimeout(() => {
                    chartPlaceholders.forEach(chart => {
                        chart.innerHTML = '<i class="fas fa-check-circle" style="font-size: 48px; color: #2ecc71; margin-right: 15px;"></i> Chart data loaded';
                    });
                }, 2000);
            }, 1000);
        });
    </script>
@endsection