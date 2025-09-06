@extends('Employees.layout.app')

@section('content')
<style>
        .password-container {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .password-text,
        .password-dots {
            font-family: monospace;
            font-size: 14px;
        }

        .toggle-password {
            cursor: pointer;
            border: none;
            background: none;
            padding: 5px;
        }

        .toggle-password:hover {
            color: #0056b3;
        }

        /* Enhanced styling */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #e9ecef;
        }

        .filter-section {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .stats-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .stat-content {
            flex-grow: 1;
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
            color: #2c3e50;
        }

        .stat-title {
            font-size: 0.9rem;
            color: #7f8c8d;
            font-weight: 500;
        }

        .table-container {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .table thead th {
            background-color: #f8f9fa;
            border-top: none;
            font-weight: 600;
            color: #495057;
            padding: 1rem;
        }

        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
        }

        .badge {
            padding: 0.5rem 0.75rem;
            border-radius: 0.5rem;
            font-weight: 500;
        }

        .action-buttons .btn {
            padding: 0.35rem 0.5rem;
            margin-right: 0.5rem;
        }

        .search-form {
            position: relative;
        }

        .search-form .form-control {
            padding-left: 2.5rem;
            border-radius: 0.5rem;
        }

        .search-form i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
        }

        .filter-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .filter-tag {
            background: #e9ecef;
            padding: 0.35rem 0.75rem;
            border-radius: 1rem;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .filter-tag .close {
            font-size: 1.25rem;
            line-height: 1;
            cursor: pointer;
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #6c757d;
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #dee2e6;
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: white;
            font-size: 1rem;
        }

        .table-responsive {
            overflow-x: auto;
            width: 100%;
        }

        .table {
            min-width: 1000px;
            /* Adjust as needed */
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Orders</h4>
                    </div>
                    <div class="card-body">
                        <!-- Stats Cards -->
                        <div class="stats-cards">
                            <div class="stat-card">
                                <div class="stat-icon" style="background-color: rgba(67, 97, 238, 0.1); color: #4361ee;">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="stat-value">{{ $orders->count() }}</div>
                                    <div class="stat-title">Total Orders</div>
                                </div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-icon" style="background-color: rgba(40, 167, 69, 0.1); color: #28a745;">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="stat-value">{{ $orders->where('status', 'completed')->count() }}</div>
                                    <div class="stat-title">Completed Orders</div>
                                </div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-icon" style="background-color: rgba(220, 53, 69, 0.1); color: #dc3545;">
                                    <i class="fas fa-times-circle"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="stat-value">{{ $orders->where('status', 'cancelled')->count() }}</div>
                                    <div class="stat-title">Cancelled Orders</div>
                                </div>
                            </div>
                        </div>

                        <!-- Filter Section -->
                        <form method="GET" action="?{{ http_build_query(request()->except('_token')) }}">
                            <div class="filter-section">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="search-form">
                                            <i class="fas fa-search"></i>
                                            <input type="text" class="form-control" name="search"
                                                placeholder="Search orders..." value="{{ request('search') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <select class="form-select" name="status">
                                            <option value="">All Status</option>
                                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>
                                                Completed</option>
                                            <option value="cancelled"
                                                {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                            <option value="pending"
                                                {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="approved"
                                                {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                                            <option value="rejected"
                                                {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12 d-flex justify-content-between">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-filter me-2"></i>Apply Filters
                                        </button>
                                        <a href="?{{ http_build_query(request()->except(['search', 'status'])) }}" class="btn btn-outline-secondary">
                                            <i class="fas fa-times me-2"></i>Clear Filters
                                        </a>
                                    </div>
                                </div>

                                <!-- Active filter tags -->
                                @if (request()->has('search') || request()->has('status'))
                                    <div class="filter-tags">
                                        @if (request('search'))
                                            <div class="filter-tag">
                                                Search: "{{ request('search') }}"
                                                <a href="?{{ http_build_query(array_merge(request()->except('search'), ['page' => 1])) }}"
                                                    class="close">&times;</a>
                                            </div>
                                        @endif

                                        @if (request('status'))
                                            <div class="filter-tag">
                                                Status: {{ ucfirst(request('status')) }}
                                                <a href="?{{ http_build_query(array_merge(request()->except('status'), ['page' => 1])) }}"
                                                    class="close">&times;</a>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Customer</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->customer->name }}</td>
                                            <td>{{ $order->total }}</td>
                                            <td>{{ $order->status }}</td>
                                            <td>{{ $order->created_at }}</td>
                                            <td>
                                                <a href="{{ route('seller.employees.sales_man.orders.show', $order->id) }}"
                                                    class="btn btn-primary">View</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
