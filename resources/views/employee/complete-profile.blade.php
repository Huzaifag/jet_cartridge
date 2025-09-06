@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-white">
                    <h4 class="mb-0">Complete Your Profile</h4>
                    <p class="text-muted mb-0">Please provide your information to continue</p>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('employee.complete-profile') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Personal Information -->
                        <h5 class="border-bottom pb-2 mb-4">Personal Information</h5>
                        <div class="row mb-4">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Profile Picture</label>
                                <input type="file" name="profile_picture" class="form-control" accept="image/*">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Date of Birth</label>
                                <input type="date" name="date_of_birth" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Gender</label>
                                <select name="gender" class="form-select" required>
                                    <option value="">Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Emergency Contact</label>
                                <input type="text" name="emergency_contact" class="form-control" required>
                            </div>
                        </div>

                        <!-- Work Experience -->
                        <h5 class="border-bottom pb-2 mb-4">Work Experience</h5>
                        <div class="row mb-4">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Previous Company</label>
                                <input type="text" name="previous_company" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Previous Position</label>
                                <input type="text" name="previous_position" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Employment Start Date</label>
                                <input type="date" name="previous_employment_start" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Employment End Date</label>
                                <input type="date" name="previous_employment_end" class="form-control" required>
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label">Work Experience Description</label>
                                <textarea name="work_experience" class="form-control" rows="3" required></textarea>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Years of Experience</label>
                                <input type="number" name="years_of_experience" class="form-control" required min="0">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Skills</label>
                                <input type="text" name="skills" class="form-control" required 
                                       placeholder="Separate skills with commas">
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label">Certifications</label>
                                <input type="text" name="certifications" class="form-control" 
                                       placeholder="Separate certifications with commas">
                            </div>
                        </div>

                        <!-- Address Information -->
                        <h5 class="border-bottom pb-2 mb-4">Address Information</h5>
                        <div class="row mb-4">
                            <div class="col-12 mb-3">
                                <label class="form-label">Address</label>
                                <textarea name="address" class="form-control" rows="2" required></textarea>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">City</label>
                                <input type="text" name="city" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">State</label>
                                <input type="text" name="state" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Postal Code</label>
                                <input type="text" name="postal_code" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Country</label>
                                <input type="text" name="country" class="form-control" required>
                            </div>
                        </div>

                        <!-- Bio -->
                        <div class="mb-4">
                            <label class="form-label">Bio</label>
                            <textarea name="bio" class="form-control" rows="3" required></textarea>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Complete Profile
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.form-control, .form-select {
    padding: 0.75rem 1rem;
    border-radius: 0.5rem;
    border: 1px solid rgba(0,0,0,0.1);
}

.form-control:focus, .form-select:focus {
    border-color: #4f46e5;
    box-shadow: 0 0 0 0.2rem rgba(79, 70, 229, 0.25);
}

.btn-primary {
    background-color: #4f46e5;
    border-color: #4f46e5;
    padding: 0.75rem 1.5rem;
    border-radius: 0.5rem;
}

.btn-primary:hover {
    background-color: #4338ca;
    border-color: #4338ca;
}

.card {
    border: none;
    border-radius: 1rem;
}

.card-header {
    border-bottom: 1px solid rgba(0,0,0,0.05);
    border-top-left-radius: 1rem !important;
    border-top-right-radius: 1rem !important;
}
</style>
@endsection 