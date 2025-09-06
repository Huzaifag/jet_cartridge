@extends('layouts.app')

@section('content')
<div class="auth-wrapper">
    <div class="auth-background">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
    </div>
    
    <div class="container position-relative">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-6 col-lg-5">
                <div class="text-center mb-4">
                    <div class="logo-wrapper">
                        <div class="rounded-circle bg-gradient d-inline-flex align-items-center justify-content-center mb-3 animate-float" 
                             style="width: 90px; height: 90px; background: linear-gradient(135deg, #FF6B6B, #FFE66D);">
                            <i class="fas fa-box-open text-white fa-2x"></i>
                        </div>
                        <div class="logo-shadow"></div>
                    </div>
                    <h1 class="h3 mb-2 fw-bold text-dark">Welcome back!</h1>
                    <p class="text-muted">Sign in to access your account</p>
                </div>

                <div class="card glass-card border-0">
                    <div class="card-body p-4">
                        @if($errors->any())
                            <div class="alert alert-danger bg-danger bg-opacity-10 border-0 mb-4">
                                @foreach($errors->all() as $error)
                                    <div class="text-danger">{{ $error }}</div>
                                @endforeach
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-4">
                                <div class="form-floating glass-input">
                                    <input type="email" name="email" class="form-control bg-transparent" 
                                           id="email" placeholder="Email address" value="{{ old('email') }}" required autofocus>
                                    <label for="email">
                                        <i class="fas fa-envelope me-2"></i>Email address
                                    </label>
                                </div>
                            </div>

                            <div class="mb-4">
                                <div class="form-floating glass-input">
                                    <input type="password" name="password" class="form-control bg-transparent" 
                                           id="password" placeholder="Password" required>
                                    <label for="password">
                                        <i class="fas fa-lock me-2"></i>Password
                                    </label>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input custom-checkbox" id="remember" name="remember">
                                    <label class="form-check-label" for="remember">Remember me</label>
                                </div>
                                <a href="{{ route('password.request') }}" class="text-decoration-none link-primary">Forgot password?</a>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 mb-3 btn-lg animate-hover">
                                Sign In
                            </button>

                            <div class="text-center">
                                <p class="text-muted mb-0">Don't have an account? 
                                    <a href="{{ route('register') }}" class="text-decoration-none link-primary">Create one</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Social Proof -->
                <div class="text-center mt-4">
                    <div class="d-flex align-items-center justify-content-center gap-4 mb-3">
                        <div class="social-proof-item">
                            <i class="fas fa-users fa-lg mb-2"></i>
                            <div class="h4 mb-0">10K+</div>
                            <small class="text-muted">Users</small>
                        </div>
                        <div class="social-proof-item">
                            <i class="fas fa-star fa-lg mb-2"></i>
                            <div class="h4 mb-0">4.9</div>
                            <small class="text-muted">Rating</small>
                        </div>
                        <div class="social-proof-item">
                            <i class="fas fa-globe fa-lg mb-2"></i>
                            <div class="h4 mb-0">150+</div>
                            <small class="text-muted">Countries</small>
                        </div>
                    </div>
                    <p class="text-muted small">Trusted by businesses worldwide</p>
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
    background: linear-gradient(135deg, #FF6B6B, #FFE66D);
    width: 300px;
    height: 300px;
    top: -100px;
    right: -100px;
    animation: float 6s ease-in-out infinite;
}

.shape-2 {
    background: linear-gradient(135deg, #4158D0, #C850C0);
    width: 400px;
    height: 400px;
    bottom: -150px;
    left: -150px;
    animation: float 8s ease-in-out infinite;
}

.shape-3 {
    background: linear-gradient(135deg, #00B4DB, #0083B0);
    width: 200px;
    height: 200px;
    top: 50%;
    right: 15%;
    animation: float 7s ease-in-out infinite;
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
    transition: all 0.3s ease;
}

.glass-input:focus-within {
    background: rgba(255, 255, 255, 0.9);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
}

.form-floating > .form-control {
    border: none;
    height: calc(3.5rem + 2px);
    line-height: 1.25;
}

.form-floating > label {
    padding: 1rem 0.75rem;
}

.btn-primary {
    background: linear-gradient(135deg, #FF6B6B, #FFE66D);
    border: none;
    border-radius: 12px;
    padding: 12px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #FFE66D, #FF6B6B);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(255, 107, 107, 0.4);
}

.custom-checkbox {
    width: 1.2em;
    height: 1.2em;
    border-radius: 6px;
    border: 2px solid #FF6B6B;
}

.custom-checkbox:checked {
    background-color: #FF6B6B;
    border-color: #FF6B6B;
}

.logo-wrapper {
    position: relative;
    display: inline-block;
}

.logo-shadow {
    position: absolute;
    width: 90px;
    height: 20px;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    background: radial-gradient(ellipse at center, rgba(0,0,0,0.2) 0%, rgba(0,0,0,0) 70%);
    border-radius: 50%;
    animation: shadow 6s ease-in-out infinite;
}

.social-proof-item {
    text-align: center;
    padding: 1rem;
    background: rgba(255, 255, 255, 0.7);
    border-radius: 16px;
    backdrop-filter: blur(5px);
    transition: all 0.3s ease;
}

.social-proof-item:hover {
    transform: translateY(-5px);
    background: rgba(255, 255, 255, 0.9);
}

.social-proof-item i {
    color: #FF6B6B;
}

@keyframes float {
    0% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
    100% { transform: translateY(0px); }
}

@keyframes shadow {
    0% { transform: translateX(-50%) scale(1); opacity: 0.4; }
    50% { transform: translateX(-50%) scale(0.85); opacity: 0.2; }
    100% { transform: translateX(-50%) scale(1); opacity: 0.4; }
}

.link-primary {
    color: #FF6B6B;
    transition: all 0.3s ease;
}

.link-primary:hover {
    color: #ff5252;
}

.animate-hover {
    transition: all 0.3s ease;
}

.animate-hover:hover {
    transform: translateY(-2px);
}

.animate-float {
    animation: float 6s ease-in-out infinite;
}
</style>
@endsection 