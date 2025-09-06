@extends('seller.layouts.app')

@section('content')
    <div class="container">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Split Order #{{ $order->id }}</h1>
            <a href="{{ route('seller.orders.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to Orders
            </a>
        </div>


        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif


        <!-- Order Summary -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="m-0">Order Details</h5>
            </div>
            <div class="card-body">
                <p><strong>Customer:</strong> {{ $order->customer->name }} ({{ $order->customer->email }})</p>
                <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
                <p><strong>Total:</strong> ${{ number_format($order->total, 2) }}</p>
            </div>
        </div>

        <!-- Split Form -->
        <form action="{{ route('seller.orders.split.store', $order->id) }}" method="POST">
            @csrf

            <input type="hidden" name="order_id" value="{{ $order->id }}">

            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="m-0">Select Items to Split</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th>Select</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->orderItems as $item)
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="order_item_ids[]" value="{{ $item->id }}">
                                        </td>
                                        <td>{{ $item->product->name ?? 'Product #' . $item->product_id }}</td>
                                        <td>${{ number_format($item->price, 2) }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                                    </tr>
                                @endforeach
                                @if ($order->orderItems->isEmpty())
                                    <tr>
                                        <td colspan="5" class="text-center">No items found.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Submit button -->
            <div class="mb-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-cut me-1"></i> Split Selected Items
                </button>
            </div>
        </form>

        <!-- Existing Splits -->
        <div class="card">
            <div class="card-header">
                <h5 class="m-0">Existing Splits</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>Split #</th>
                                <th>Items</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orderItemSplits ?? [] as $split)
                                <tr>
                                    <td>Split {{ $loop->iteration }}</td>
                                    <td>
                                        @foreach ($split->order_item_ids as $id)
                                            <span class="badge bg-primary me-1">Item #{{ $id }}</span>
                                        @endforeach
                                    </td>
                                    <td>{{ $split->created_at->format('M d, Y h:i A') }}</td>
                                    <td>
                                        <form onsubmit="return confirm('Are you sure you want to send this split to the selected company?')" action="#" method="POST">
                                            @csrf
                                            <select name="company_id" class="form-select" required>
                                                <option value="">Select Company</option>
                                                <option value="1">Company 1</option>
                                                <option value="2">Company 2</option>
                                            </select>
                                            <button type="submit" class="btn btn-primary mt-2">
                                            <i class="fas fa-paper-plane me-1"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No splits yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
