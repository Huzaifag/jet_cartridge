@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-md-6 col-lg-5">
            <div class="text-center mb-4">
                <div class="rounded-circle bg-gradient d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px; background: linear-gradient(45deg, #ff6b6b, #ff8787);">
                    <i class="fas fa-key text-white fa-2x"></i>
                </div>
                <h1 class="h4 mb-2">Reset Password</h1>
                <p class="text-muted">Enter your email to receive reset instructions</p>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    @if(session('status'))
                        <div class="alert alert-success mb-4">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger mb-4">
                            @foreach($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="mb-4">
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-envelope text-muted"></i>
                                </span>
                                <input type="email" name="email" class="form-control border-start-0 ps-0" placeholder="Email address" value="{{ old('email') }}" required autofocus>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mb-3" style="background: linear-gradient(45deg, #ff6b6b, #ff8787); border: none;">
                            Send Reset Link
                        </button>

                        <div class="text-center">
                            <a href="{{ route('login') }}" class="text-decoration-none">
                                <i class="fas fa-arrow-left me-2"></i>Back to login
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Security Info -->
            <div class="text-center mt-4">
                <div class="d-flex justify-content-center align-items-center gap-3 mb-2">
                    <i class="fas fa-shield-alt text-primary"></i>
                    <i class="fas fa-lock text-primary"></i>
                    <i class="fas fa-user-shield text-primary"></i>
                </div>
                <p class="text-muted small mb-0">Your security is our top priority</p>
            </div>
        </div>
    </div>
</div>

<style>
.input-group-text {
    background-color: #f8f9fa;
    border-right: none;
}
.form-control {
    border-left: none;
}
.form-control:focus {
    box-shadow: none;
    border-color: #ced4da;
}
.input-group:focus-within {
    box-shadow: 0 0 0 0.25rem rgba(255, 107, 107, 0.25);
}
.btn-primary:hover {
    background: linear-gradient(45deg, #ff5252, #ff6b6b) !important;
}
.text-primary {
    color: #ff6b6b !important;
}
</style>
@endsection 