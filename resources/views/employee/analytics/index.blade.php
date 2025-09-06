@extends('employee.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2>Analytics Dashboard</h2>
            <p class="text-muted">Overview of your store's performance</p>
        </div>
    </div>

    <!-- Products Analytics -->
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="mb-3">Products</h4>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-muted">Total Products</h5>
                    <h2 class="mb-0">{{ $analytics['total_products'] }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-muted">Active Products</h5>
                    <h2 class="mb-0 text-success">{{ $analytics['active_products'] }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-muted">Out of Stock</h5>
                    <h2 class="mb-0 text-danger">{{ $analytics['out_of_stock_products'] }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Orders Analytics -->
    <div class="row">
        <div class="col-12">
            <h4 class="mb-3">Orders</h4>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-muted">Total Orders</h5>
                    <h2 class="mb-0">{{ $analytics['total_orders'] }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-muted">Pending Orders</h5>
                    <h2 class="mb-0 text-warning">{{ $analytics['pending_orders'] }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-muted">Completed Orders</h5>
                    <h2 class="mb-0 text-success">{{ $analytics['completed_orders'] }}</h2>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 