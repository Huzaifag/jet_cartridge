@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- Seller Header -->
    <div class="bg-white rounded-lg shadow-sm p-4 mb-4">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="h2 mb-2">{{ $seller->company_name }}</h1>
                <p class="text-muted mb-2">
                    <i class="fas fa-map-marker-alt me-2"></i>{{ $seller->company_city }}, {{ $seller->company_state }}, {{ $seller->company_country }}
                </p>
                <p class="text-muted mb-0">
                    <i class="fas fa-building me-2"></i>{{ ucfirst($seller->business_type) }} • {{ $seller->years_in_business }} Years in Business
                </p>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <a href="mailto:{{ $seller->contact_person_email }}" class="btn btn-primary me-2">
                    <i class="fas fa-envelope me-2"></i>Contact
                </a>
                <button class="btn btn-outline-primary">
                    <i class="fas fa-star me-2"></i>Follow
                </button>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Company Information -->
        <div class="col-lg-4 mb-4">
            <div class="bg-white rounded-lg shadow-sm p-4">
                <h3 class="h5 mb-4">Company Information</h3>
                
                <div class="mb-3">
                    <h6 class="text-muted mb-2">Contact Person</h6>
                    <p class="mb-1">{{ $seller->contact_person_name }}</p>
                    <p class="mb-1 text-muted small">{{ $seller->contact_person_position }}</p>
                </div>

                <div class="mb-3">
                    <h6 class="text-muted mb-2">Contact Details</h6>
                    <p class="mb-1">
                        <i class="fas fa-phone me-2"></i>
                        <a href="tel:{{ $seller->company_phone }}" class="text-decoration-none">{{ $seller->company_phone }}</a>
                    </p>
                    <p class="mb-1">
                        <i class="fas fa-globe me-2"></i>
                        <a href="{{ $seller->company_website }}" target="_blank" class="text-decoration-none">{{ $seller->company_website }}</a>
                    </p>
                </div>

                <div class="mb-3">
                    <h6 class="text-muted mb-2">Business Details</h6>
                    <p class="mb-1">
                        <i class="fas fa-users me-2"></i>
                        {{ $seller->number_of_employees }} Employees
                    </p>
                    <p class="mb-1">
                        <i class="fas fa-chart-line me-2"></i>
                        Annual Revenue: ${{ is_numeric($seller->annual_revenue) ? number_format((float)$seller->annual_revenue) : $seller->annual_revenue }}
                    </p>
                </div>

                <div>
                    <h6 class="text-muted mb-2">Main Products</h6>
                    @foreach($seller->main_products as $product)
                        <span class="badge bg-light text-dark me-2 mb-2">{{ $product }}</span>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Featured Products -->
        <div class="col-lg-8">
            <div class="bg-white rounded-lg shadow-sm p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="h5 mb-0">Featured Products</h3>
                    <a href="#" class="text-decoration-none">View All</a>
                </div>

                <div class="row g-4">
                    @foreach($products as $product)
                    <div class="col-md-6">
                        <div class="card h-100 border-0 shadow-sm">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                            @else
                                <div class="bg-light text-center py-5">
                                    <i class="fas fa-image fa-3x text-muted"></i>
                                </div>
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text text-muted">{{ Str::limit($product->description, 100) }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="h6 mb-0">${{ number_format($product->price, 2) }}</span>
                                    <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-outline-primary">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .badge {
        font-weight: 500;
        padding: 0.5em 1em;
    }
    .card-img-top {
        border-top-left-radius: calc(0.5rem - 1px);
        border-top-right-radius: calc(0.5rem - 1px);
    }
    .btn-outline-primary:hover {
        color: #fff;
    }
</style>
@endpush
@endsection 