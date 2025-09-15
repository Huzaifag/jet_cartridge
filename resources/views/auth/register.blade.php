@extends('layouts.app')

@section('content')
    <div class="auth-wrapper">
        <div class="auth-background">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
            <div class="shape shape-4"></div>
        </div>

        <div class="container position-relative">
            <div class="row justify-content-center py-5">
                <div class="col-md-8 col-lg-6">
                    <div class="text-center mb-4">
                        <div class="logo-wrapper">
                            <div class="rounded-circle bg-gradient d-inline-flex align-items-center justify-content-center mb-3 animate-float"
                                style="width: 90px; height: 90px; background: linear-gradient(135deg, #7F00FF, #E100FF);">
                                <i class="fas fa-user-plus text-white fa-2x"></i>
                            </div>
                            <div class="logo-shadow"></div>
                        </div>
                        <h1 class="h3 mb-2 fw-bold text-dark">Create your account</h1>
                        <p class="text-muted">Join our B2B marketplace today</p>
                    </div>

                    <div class="card glass-card border-0">
                        <div class="card-body p-4">
                            @if ($errors->any())
                                <div class="alert alert-danger bg-danger bg-opacity-10 border-0 mb-4">
                                    @foreach ($errors->all() as $error)
                                        <div class="text-danger">{{ $error }}</div>
                                    @endforeach
                                </div>
                            @endif

                            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                                @csrf

                                <!-- Profile Picture -->
                                <div class="text-center mb-4">
                                    <div class="position-relative d-inline-block">
                                        <label for="profile_picture" class="profile-picture-wrapper mb-0"
                                            style="cursor: pointer;">
                                            <img id="profile-preview"
                                                src="{{ old('profile_picture') ? asset('storage/' . old('profile_picture')) : asset('images/profile.jpg') }}"
                                                alt="Profile Picture" class="rounded-circle profile-image"
                                                style="width: 120px; height: 120px; object-fit: cover;">

                                            <div class="profile-picture-overlay rounded-circle">
                                                <i class="fas fa-camera fa-lg mb-1"></i>
                                                <small>Upload</small>
                                            </div>
                                        </label>
                                        <input type="file" id="profile_picture" name="profile_picture"
                                            class="form-control d-none" accept="image/*">
                                        @error('profile_picture')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Name -->
                                <div class="mb-4">
                                    <div class="form-floating glass-input">
                                        <input type="text" name="name"
                                            class="form-control bg-transparent @error('name') is-invalid @enderror"
                                            id="name" placeholder="Full name" value="{{ old('name') }}" required>
                                        <label for="name">
                                            <i class="fas fa-user me-2"></i>Full name
                                        </label>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="mb-4">
                                    <div class="form-floating glass-input">
                                        <input type="email" name="email"
                                            class="form-control bg-transparent @error('email') is-invalid @enderror"
                                            id="email" placeholder="Email address" value="{{ old('email') }}" required>
                                        <label for="email">
                                            <i class="fas fa-envelope me-2"></i>Email address
                                        </label>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Role Selection -->
                                <div class="mb-4">
                                    <label class="form-label">I want to register as:</label>
                                    <div class="row g-3">
                                        <div class="col-6">
                                            <label class="w-100 h-100">
                                                <input type="radio" name="role" value="customer" class="btn-check"
                                                    autocomplete="off" checked>
                                                <div class="card h-100 border-2 hover-shadow cursor-pointer role-card">
                                                    <div class="card-body text-center p-4">
                                                        <i class="fas fa-user fa-2x text-primary mb-3"></i>
                                                        <h5 class="card-title mb-0">Customer</h5>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>

                                        <div class="col-6">
                                            <label class="w-100 h-100">
                                                <input type="radio" name="role" value="retailer" class="btn-check"
                                                    autocomplete="off" checked>
                                                <div class="card h-100 border-2 hover-shadow cursor-pointer role-card">
                                                    <div class="card-body text-center p-4">
                                                        <i class="fas fa-user fa-2x text-primary mb-3"></i>
                                                        <h5 class="card-title mb-0">Retailer</h5>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                    @error('role')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Password -->
                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <div class="form-floating glass-input">
                                            <input type="password" name="password"
                                                class="form-control bg-transparent @error('password') is-invalid @enderror"
                                                id="password" placeholder="Password" required>
                                            <label for="password">
                                                <i class="fas fa-lock me-2"></i>Password
                                            </label>
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating glass-input">
                                            <input type="password" name="password_confirmation"
                                                class="form-control bg-transparent" id="password_confirmation"
                                                placeholder="Confirm password" required>
                                            <label for="password_confirmation">
                                                <i class="fas fa-lock me-2"></i>Confirm
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary w-100 mb-3 btn-lg">
                                    Create Account
                                </button>

                                <div class="text-center">
                                    <p class="text-muted mb-0">Already have an account?
                                        <a href="{{ route('login') }}" class="text-decoration-none link-primary">Sign
                                            in</a>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Feature Highlights -->
                    <div class="row g-4 mt-4">
                        <div class="col-md-4">
                            <div class="feature-card">
                                <div class="feature-icon">
                                    <i class="fas fa-shield-alt fa-2x"></i>
                                </div>
                                <h6>Secure Platform</h6>
                                <p class="text-muted small mb-0">Your data is protected</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="feature-card">
                                <div class="feature-icon">
                                    <i class="fas fa-globe fa-2x"></i>
                                </div>
                                <h6>Global Reach</h6>
                                <p class="text-muted small mb-0">Connect worldwide</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="feature-card">
                                <div class="feature-icon">
                                    <i class="fas fa-headset fa-2x"></i>
                                </div>
                                <h6>24/7 Support</h6>
                                <p class="text-muted small mb-0">Always here to help</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .auth-wrapper {
            min-height: 100vh;
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        }

        .auth-background {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 0;
        }

        .shape {
            position: absolute;
            border-radius: 50%;
            filter: blur(40px);
            opacity: 0.6;
        }

        .shape-1 {
            background: linear-gradient(135deg, #7F00FF, #E100FF);
            width: 300px;
            height: 300px;
            top: -100px;
            right: -100px;
            animation: float 6s ease-in-out infinite;
        }

        .shape-2 {
            background: linear-gradient(135deg, #FC466B, #3F5EFB);
            width: 400px;
            height: 400px;
            bottom: -150px;
            left: -150px;
            animation: float 8s ease-in-out infinite;
        }

        .shape-3 {
            background: linear-gradient(135deg, #0061ff, #60efff);
            width: 200px;
            height: 200px;
            top: 50%;
            right: 15%;
            animation: float 7s ease-in-out infinite;
        }

        .shape-4 {
            background: linear-gradient(135deg, #7F00FF, #E100FF);
            width: 150px;
            height: 150px;
            top: 30%;
            left: 15%;
            animation: float 9s ease-in-out infinite;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .glass-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
        }

        .glass-input {
            background: rgba(255, 255, 255, 0.7);
            border-radius: 12px;
        }

        .profile-picture-wrapper {
            position: relative;
            display: inline-block;
            cursor: pointer;
        }

        .profile-image {
            border: 3px solid #fff;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            width: 120px;
            height: 120px;
            object-fit: cover;
        }

        .profile-picture-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.55);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            border-radius: 50%;
            opacity: 0;
            transition: opacity 0.3s ease;
            font-size: 12px;
            text-align: center;
        }

        .profile-picture-wrapper:hover .profile-picture-overlay {
            opacity: 1;
        }

        .profile-picture-wrapper:hover .profile-image {
            filter: brightness(0.75);
        }



        .role-card {
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .role-card .card-body {
            width: 100%;
        }

        .btn-check:checked+.role-card {
            border-color: #7F00FF !important;
            background-color: rgba(127, 0, 255, 0.05);
        }

        .role-card:hover {
            border-color: #7F00FF !important;
            background-color: rgba(127, 0, 255, 0.02);
            transform: translateY(-2px);
        }

        .invalid-feedback {
            display: block;
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }

            100% {
                transform: translateY(0px);
            }
        }
    </style>

    @push('scripts')
        <script>
            document.getElementById('profile_picture').addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('profile-preview').setAttribute('src', e.target.result);
                    };
                    reader.readAsDataURL(file);
                }
            });
        </script>
    @endpush

@endsection
