@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-md-6 col-lg-5">
            <div class="text-center mb-4">
                <div class="rounded-circle bg-gradient d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px; background: linear-gradient(45deg, #ff6b6b, #ff8787);">
                    <i class="fas fa-lock-open text-white fa-2x"></i>
                </div>
                <h1 class="h4 mb-2">Set New Password</h1>
                <p class="text-muted">Choose a strong password for your account</p>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    @if($errors->any())
                        <div class="alert alert-danger mb-4">
                            @foreach($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-envelope text-muted"></i>
                                </span>
                                <input type="email" name="email" class="form-control border-start-0 ps-0" placeholder="Email address" value="{{ old('email') }}" required autofocus>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-lock text-muted"></i>
                                </span>
                                <input type="password" name="password" class="form-control border-start-0 ps-0" placeholder="New password" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-lock text-muted"></i>
                                </span>
                                <input type="password" name="password_confirmation" class="form-control border-start-0 ps-0" placeholder="Confirm new password" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mb-3" style="background: linear-gradient(45deg, #ff6b6b, #ff8787); border: none;">
                            Reset Password
                        </button>

                        <div class="text-center">
                            <a href="{{ route('login') }}" class="text-decoration-none">
                                <i class="fas fa-arrow-left me-2"></i>Back to login
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Password Tips -->
            <div class="card border-0 shadow-sm mt-4">
                <div class="card-body p-3">
                    <h6 class="mb-3 text-center">Password Tips</h6>
                    <ul class="list-unstyled mb-0 small">
                        <li class="mb-2">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            Use at least 8 characters
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            Include uppercase and lowercase letters
                        </li>
                        <li class="mb-0">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            Add numbers and special characters
                        </li>
                    </ul>
                </div>
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