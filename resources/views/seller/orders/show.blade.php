@extends('seller.layouts.app')

@section('content')
    <style>
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            margin-bottom: 1.5rem;
        }

        .card-header {
            background-color: #fff;
            border-bottom: 1px solid #e3e6f0;
            padding: 1rem 1.35rem;
            font-weight: 700;
            color: var(--dark);
        }

        .order-status {
            font-weight: 600;
            padding: 0.35rem 0.8rem;
            border-radius: 0.35rem;
        }

        .status-pending {
            background-color: rgba(246, 194, 62, 0.2);
            color: var(--warning);
        }

        .status-paid {
            background-color: rgba(28, 200, 138, 0.2);
            color: var(--success);
        }

        .product-img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
        }

        .summary-card {
            background: linear-gradient(45deg, var(--primary), var(--secondary));
            color: white;
        }

        .address-box {
            background-color: #f8f9fc;
            border-radius: 8px;
            padding: 1rem;
            border-left: 4px solid var(--primary);
        }

        .badge-custom {
            padding: 0.5em 0.8em;
            border-radius: 0.35rem;
            font-weight: 600;
        }

        .customer-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #fff;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }

        .detail-label {
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 0.3rem;
        }

        .detail-value {
            margin-bottom: 1rem;
            color: #5a5c69;
        }

        .order-action-btn {
            border-radius: 0.35rem;
            font-weight: 600;
            padding: 0.5rem 1rem;
        }
    </style>

    <div class="container">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                <h1 class="h3 mb-0 text-gray-800">Order Details</h1>
                <p class="text-muted">Manage and view order information</p>
            </div>
            <div>
                <a href="{{ route('seller.orders.index') }}" class="btn btn-outline-secondary order-action-btn">
                    <i class="fas fa-arrow-left me-1"></i> Back to Orders
                </a>
            </div>
        </div>

        <!-- Order Summary Cards -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card summary-card">
                    <div class="card-body py-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="text-xs font-weight-bold text-white text-uppercase mb-1">Order Value</div>
                                <div class="h5 mb-0 font-weight-bold text-white">${{ number_format($total, 2) }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-white-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body py-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Status</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <span
                                        class="order-status {{ $order->status === 'pending' ? 'status-pending' : '' }}">{{ ucfirst($order->status) }}</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clock fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body py-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Payment</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <span
                                        class="order-status {{ $order->payment_status === 'paid' ? 'status-paid' : '' }}">{{ ucfirst($order->payment_status) }}</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body py-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Items</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $orderItemsCount ?? [] }} Products
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Order Details -->
            <div class="col-lg-8">
                <!-- Order Items -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="m-0">Order Items</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Product</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orderItems as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ asset('storage/' . $item->product->images[0]) ?? 'https://via.placeholder.com/200x200.png' }}"
                                                        alt="Product" class="product-img me-3">
                                                    <div>
                                                        <h6 class="mb-0">{{ $item->product->name ?? 'Unknown Product' }}
                                                        </h6>
                                                        <small class="text-muted">SKU:
                                                            {{ $item->product->id ?? 'N/A' }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>${{ number_format($item->price, 2) }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                                        </tr>
                                    @endforeach
                                    @if ($orderItems->isEmpty())
                                        <tr>
                                            <td colspan="4" class="text-center">No items found for this order.</td>
                                        </tr>
                                    @endif
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="text-end fw-bold">Subtotal</td>
                                        <td class="fw-bold">${{ number_format($subtotal, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-end fw-bold">Shipping</td>
                                        <td class="fw-bold">${{ number_format($shipping, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-end fw-bold">Tax</td>
                                        <td class="fw-bold">${{ number_format($tax, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-end fw-bold">Total</td>
                                        <td class="fw-bold">${{ number_format($total, 2) }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card mb-4 row justify-content-between flex-row gap-2 align-items-center">
                    <!-- Address Information -->
                    <div class="card mb-4 col-lg-6">
                        <div class="card-header">
                            <h5 class="m-0">Address Information</h5>
                        </div>
                        <div class="card-body">
                            @php
                                $shipping = json_decode($order->shipping_address, true);
                                $billing = json_decode($order->billing_address, true);
                            @endphp

                            @php
                                function formatAddress($address)
                                {
                                    $decoded = json_decode($address, true);

                                    // If JSON is valid → return formatted structured address
                                    if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                                        return $decoded['street'] .
                                            ', ' .
                                            $decoded['city'] .
                                            ', ' .
                                            $decoded['state'] .
                                            ' - ' .
                                            $decoded['postal_code'] .
                                            ', ' .
                                            $decoded['country'];
                                    }

                                    // Otherwise → return plain text with newlines
                                    return nl2br(e($address));
                                }
                            @endphp

                            <h6 class="text-primary mb-3">Shipping Address</h6>
                            <div class="address-box mb-4">
                                {!! formatAddress($order->shipping_address) !!}
                            </div>

                            <h6 class="text-primary mb-3">Billing Address</h6>
                            <div class="address-box">
                                {!! formatAddress($order->billing_address) !!}
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="card col-lg-5">
                        <div class="card-header">
                            <h5 class="m-0">Order Actions</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                @if ($order->customer->hasRole('retailer'))
                                    <a href="{{ route('seller.orders.order-split', $order->id) }}"
                                        class="btn btn-primary order-action-btn" type="submit">
                                        <i class="fas fa-box me-1"></i> Split Order
                                    </a>
                                @endif
                                <!-- Button -->
                                <button class="btn btn-success order-action-btn" data-bs-toggle="modal"
                                    data-bs-target="#reviewOrderModal">
                                    <i class="fas fa-check me-1"></i> Review Order
                                </button>
                                <button class="btn btn-danger order-action-btn">
                                    <i class="fas fa-times me-1"></i> Cancel Order
                                </button>
                                <a href="{{ route('seller.orders.print-invoice', $order->id) }}"
                                    class="btn btn-outline-secondary order-action-btn">
                                    <i class="fas fa-print me-1"></i> Print Invoice
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Order Notes -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="m-0">Order Notes</h5>
                    </div>
                    <div class="card-body">
                        <p>{{ $order->notes ?? 'No notes available.' }}</p>
                    </div>
                </div>

            </div>

            <!-- Customer & Order Info -->
            <div class="col-lg-4">
                <!-- Customer Information -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="m-0">Customer Information</h5>
                    </div>
                    <div class="card-body text-center">
                        <img src="https://img.freepik.com/free-vector/blue-circle-with-white-user_78370-4707.jpg?semt=ais_hybrid&w=740&q=80"
                            alt="Customer" class="customer-avatar mb-3">
                        <h4>{{ $order->customer->name }}</h4>
                        <p class="text-muted">{{ $order->customer->email }}</p>
                        <p class="mt-3">{{ $order->customer->bio ?? 'No bio available.' }}</p>
                        <button class="btn btn-outline-primary btn-sm order-action-btn">
                            <i class="fas fa-envelope me-1"></i> Contact Customer
                        </button>
                    </div>
                </div>

                <!-- Order Information -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="m-0">Order Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="detail-label">Order ID</div>
                        <div class="detail-value">#ORD-{{ $order->id }}</div>

                        <div class="detail-label">Order Date</div>
                        <div class="detail-value">{{ $order->created_at->format('F j, Y h:i A') }}</div>

                        <div class="detail-label">Payment Method</div>
                        <div class="detail-value">{{ $order->payment_method }}</div>

                        <div class="detail-label">Payment Status</div>
                        <div class="detail-value">
                            <span
                                class="badge {{ $order->payment_status === 'paid' ? 'bg-success' : 'bg-warning' }} badge-custom">{{ ucfirst($order->payment_status) }}</span>
                        </div>

                        <div class="detail-label">Fulfillment Status</div>
                        <div class="detail-value">
                            <span
                                class="badge {{ $order->status === 'pending' ? 'bg-warning' : 'bg-success' }} badge-custom">{{ ucfirst($order->status) }}</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection

<!-- Modal -->
<div class="modal fade" id="reviewOrderModal" tabindex="-1" aria-labelledby="reviewOrderModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="reviewOrderModalLabel">Review Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form action="{{ route('seller.orders.update-status', $order->id) }}" id="orderReviewForm"
                    method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="orderStatus" class="form-label">Select Action</label>
                        <select class="form-select" id="orderStatus" name="status" required>
                            <option value="">-- Choose --</option>
                            <option value="approved">Approve Order</option>
                            <option value="rejected">Reject Order</option>
                        </select>
                    </div>
                </form>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="orderReviewForm" class="btn btn-success">Submit</button>
            </div>

        </div>
    </div>
</div>
@if(session('invoice_file'))
    <script>
        window.onload = function() {
            let fileUrl = "{{ asset('storage/' . session('invoice_file')) }}";
            // Trigger download
            const link = document.createElement('a');
            link.href = fileUrl;
            link.download = fileUrl.split('/').pop();
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
    </script>
@endif

