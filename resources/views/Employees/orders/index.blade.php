@extends('Employees.layout.app')

@section('content')
    <style>
        
        
        
        
        .container {
            display: grid;
            
            min-height: 100vh;
        }

        .logo {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .logo i {
            font-size: 24px;
            margin-right: 10px;
            color: var(--secondary);
        }
        
        .logo h1 {
            font-size: 20px;
            font-weight: 600;
        }
        
        .menu-item {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            margin-bottom: 5px;
            border-radius: var(--border-radius);
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .menu-item:hover, .menu-item.active {
            background: rgba(255, 255, 255, 0.1);
        }
        
        .menu-item i {
            margin-right: 10px;
            font-size: 18px;
        }
        
        /* Main Content Styles */
        .employee-main-content {
            grid-column: 1;
            padding: 20px 30px;
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
        
        .stat-info h3 {
          text-align: center;
            font-size: 24px;
            margin: 5px 0;
        }
        
        .stat-info p {
            color: var(--gray);
            font-size: 14px;
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
        
        .search-box {
            display: flex;
            align-items: center;
            background: #f5f7fa;
            padding: 8px 15px;
            border-radius: 20px;
        }
        
        .search-box input {
            border: none;
            background: transparent;
            outline: none;
            margin-left: 5px;
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
        
        .employee-action-btn {
            padding: 8px 15px;
            border: none;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s ease;
            color: #f9fafb;
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
        
        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }
        
        .modal-content {
            background: var(--white);
            border-radius: var(--border-radius);
            width: 500px;
            max-width: 90%;
            box-shadow: var(--shadow);
            overflow: hidden;
        }
        
        .modal-header {
            padding: 20px;
            border-bottom: 1px solid var(--light);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .modal-header h3 {
            font-weight: 600;
        }
        
        .close {
            font-size: 24px;
            cursor: pointer;
            color: var(--gray);
        }
        
        .modal-body {
            padding: 20px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }
        
        .form-group input, .form-group select, .form-group textarea {
            width: 100%;
            padding: 10px 15px;
            border: 1px solid var(--light);
            border-radius: var(--border-radius);
            outline: none;
            transition: border 0.3s ease;
        }
        
        .form-group input:focus, .form-group select:focus, .form-group textarea:focus {
            border-color: var(--secondary);
        }
        
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }
        
        .modal-footer {
            padding: 20px;
            border-top: 1px solid var(--light);
            display: flex;
            justify-content: flex-end;
            gap: 10px;
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
            
            .stats-cards {
                grid-template-columns: 1fr;
            }
        }
        
        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }
            
            .table-header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .search-box {
                margin-top: 10px;
                width: 100%;
            }
        }
    </style>

    <div class="container">
        <!-- Main Content -->
        <div class="employee-main-content">
            <div class="header">
                <h2>Custom Orders Billing</h2>
                <div class="user-info">
                    <img src="https://ui-avatars.com/api/?name=Accountant+User&background=3498db&color=fff" alt="User">
                    <span>Accountant User</span>
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
            </div>
            
            <!-- Pending Approvals Table -->
            <div class="table-container">
                <div class="table-header">
                    <h3>Pending Approvals from Sellers</h3>
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Search orders...">
                    </div>
                </div>
                
                <div class="table" style="overflow-x: auto; min-width: 100%;">
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
                        @forelse ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->seller->contact_person_name }}</td>
                            <td>{{ $order->customer->name }}</td>
                            <td>{{ $order->total }}</td>
                            <td><span class="status status-pending">{{ $order->status }}</span></td>
                            <td>
                                <a class="employee-action-btn btn-primary" href="{{ route('seller.employees.orders.create-invoice', $order->id) }}">
                                    <i class="fas fa-file-invoice"></i> Create Invoice
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">No orders found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                </div>
            </div>
            
            <!-- Invoices Table -->
            <div class="table-container">
                <div class="table-header">
                    <h3>Recent Invoices</h3>
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Search invoices...">
                    </div>
                </div>
                
                <table>
                    <thead>
                        <tr>
                            <th>Invoice ID</th>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Amount</th>
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
                            <td><span class="status status-approved">Paid</span></td>
                            <td>
                                <button class="employee-action-btn btn-primary">
                                    <i class="fas fa-warehouse"></i> Send to Warehouse
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>#INV-5275</td>
                            <td>#ORD-7268</td>
                            <td>David Miller</td>
                            <td>$210.75</td>
                            <td><span class="status status-approved">Paid</span></td>
                            <td>
                                <button class="employee-action-btn btn-primary">
                                    <i class="fas fa-warehouse"></i> Send to Warehouse
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    

@endsection

