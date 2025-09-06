@extends('layouts.frontend')

@section('content')
<div class="container py-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="row">
        <!-- Product Images -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    @if($product->images && count($product->images) > 0)
                        <img src="{{ asset('storage/' . $product->images[0]) }}" 
                             class="img-fluid rounded" 
                             alt="{{ $product->name }}">
                    @else
                        <img src="{{ asset('images/default-product.jpg') }}" 
                             class="img-fluid rounded" 
                             alt="Default Product Image">
                    @endif
                </div>
            </div>
        </div>

        <!-- Product Details -->
        <div class="col-md-6">
            <h1 class="mb-4">{{ $product->name }}</h1>
            
            <div class="mb-4">
                <h2 class="text-primary mb-0">${{ number_format($product->price, 2) }}</h2>
                @if($product->rating > 0)
                    <div class="d-flex align-items-center mt-2">
                        <div class="text-warning me-2">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $product->rating)
                                    <i class="fas fa-star"></i>
                                @elseif($i - 0.5 <= $product->rating)
                                    <i class="fas fa-star-half-alt"></i>
                                @else
                                    <i class="far fa-star"></i>
                                @endif
                            @endfor
                        </div>
                        <span class="text-muted">{{ number_format($product->rating, 1) }} rating</span>
                    </div>
                @endif
            </div>

            <div class="mb-4">
                <h5>Description</h5>
                <p class="text-muted">{{ $product->description ?? 'No description available.' }}</p>
            </div>

            <div class="mb-4">
                <h5>Stock Information</h5>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <i class="fas fa-box me-2"></i>
                        Stock Available: {{ $product->stock_quantity ?? 'N/A' }}
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-truck me-2"></i>
                        Minimum Order: {{ $product->moq ?? 1 }} units
                    </li>
                </ul>
            </div>

            @if($product->seller)
            <div class="mb-4">
                <h5>Seller Information</h5>
                <div class="d-flex align-items-center">
                    <i class="fas fa-store me-2"></i>
                    <span>{{ $product->seller->company_name }}</span>
                </div>
            </div>
            @endif

            <div class="d-grid gap-2">
                <button class="btn btn-primary btn-lg">
                    <i class="fas fa-shopping-cart me-2"></i>Add to Cart
                </button>
                <button class="btn btn-outline-primary btn-lg">
                    <i class="far fa-envelope me-2"></i>Contact Seller
                </button>
            </div>
        </div>
    </div>

    @if($product->specifications)
    <div class="row mt-5">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Specifications</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($product->specifications as $key => $value)
                        <div class="col-md-6 mb-3">
                            <strong>{{ ucfirst($key) }}:</strong> {{ $value }}
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection 