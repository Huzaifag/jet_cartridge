@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <!-- Left Column -->
        <div class="col-md-4">
            <!-- Profile Card -->
            <div class="card shadow mb-4">
                <div class="card-body text-center">
                    <img src="{{ $employee->profile_picture ? asset('storage/' . $employee->profile_picture) : asset('images/default-avatar.png') }}" 
                         class="rounded-circle img-thumbnail mb-3" 
                         style="width: 150px; height: 150px; object-fit: cover;">
                    <h3 class="mb-3">{{ $employee->name }}</h3>
                    
                    <!-- Follow/Unfollow Buttons -->
                    @auth
                        @if($employee->isFollowedBy(auth()->user()))
                            <form action="{{ route('employees.unfollow', $employee) }}" method="POST" class="mb-3">
                                @csrf
                                <button type="submit" class="btn btn-outline-primary">
                                    <i class="fas fa-user-minus"></i> Unfollow
                                </button>
                            </form>
                        @else
                            <form action="{{ route('employees.follow', $employee) }}" method="POST" class="mb-3">
                                @csrf
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-user-plus"></i> Follow
                                </button>
                            </form>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary mb-3">
                            <i class="fas fa-user-plus"></i> Login to Follow
                        </a>
                    @endauth
                    
                    <!-- Followers Count -->
                    <div class="text-muted mb-3">
                        <i class="fas fa-users"></i> {{ $employee->followers()->count() }} Followers
                    </div>
                    <p class="text-muted mb-3">{{ $employee->position }}</p>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="card shadow mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0 text-primary">Contact Information</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="text-muted">Email</label>
                        <div>{{ $employee->email }}</div>
                    </div>
                </div>
            </div>

            <!-- Skills -->
            <div class="card shadow mb-4">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-primary">Skills</h5>
                </div>
                <div class="card-body">
                    @if($employee->skills && count($employee->skills) > 0)
                        <div class="d-flex flex-wrap gap-2">
                            @foreach($employee->skills as $skill)
                                <span class="badge bg-primary">{{ $skill }}</span>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted mb-0">No skills added yet</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div class="col-md-8">
            <!-- About Me -->
            <div class="card shadow mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0 text-primary">About Me</h5>
                </div>
                <div class="card-body">
                    {{ $employee->bio ?? 'No bio added yet.' }}
                </div>
            </div>

            <!-- Work Experience -->
            <div class="card shadow mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0 text-primary">Work Experience</h5>
                </div>
                <div class="card-body">
                    @if($employee->work_experience && count($employee->work_experience) > 0)
                        @foreach($employee->work_experience as $experience)
                            <div class="mb-4">
                                <h5 class="mb-1">{{ $experience['title'] ?? '' }}</h5>
                                <p class="text-muted mb-2">
                                    {{ $experience['company'] ?? '' }} • {{ $experience['duration'] ?? '' }}
                                </p>
                                <p class="mb-0">{{ $experience['description'] ?? '' }}</p>
                            </div>
                        @endforeach
                    @else
                        <p class="text-muted mb-0">No work experience added yet</p>
                    @endif
                </div>
            </div>

            <!-- Products Added -->
            <div class="card shadow">
                <div class="card-header bg-white">
                    <h5 class="mb-0 text-primary">Products Added</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        @forelse($employee->products as $product)
                            <div class="col-md-6 mb-4">
                                <div class="card h-100">
                                    <img src="{{ asset('storage/' . ($product->images[0] ?? 'products/default.jpg')) }}" 
                                         class="card-img-top" 
                                         style="height: 200px; object-fit: cover;"
                                         alt="{{ $product->name }}">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $product->name }}</h5>
                                        <p class="card-text text-muted">{{ Str::limit($product->description, 100) }}</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="h5 mb-0">${{ number_format($product->price, 2) }}</span>
                                            <a href="{{ route('product.show', $product) }}" class="btn btn-primary btn-sm">
                                                View Details
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <p class="text-muted mb-0">No products added yet</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    border: none;
    border-radius: 10px;
}

.card-header {
    border-bottom: 1px solid rgba(0,0,0,.125);
    padding: 1rem;
}

.badge {
    padding: 0.5rem 1rem;
    font-weight: 500;
}

.text-primary {
    color: #0d6efd !important;
}

.gap-2 {
    gap: 0.5rem !important;
}

.img-thumbnail {
    padding: 0.25rem;
    border: 1px solid #dee2e6;
    border-radius: 50%;
}
</style>
@endsection 