@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <!-- Left Column - Profile Picture and Actions -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <div class="profile-picture-container mb-4">
                        @if($user->profile_picture)
                            <img src="{{ Storage::url($user->profile_picture) }}" 
                                 alt="Profile Picture" 
                                 class="rounded-circle profile-picture mb-3"
                                 style="width: 200px; height: 200px; object-fit: cover;">
                        @else
                            <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center text-white mx-auto mb-3"
                                 style="width: 200px; height: 200px; font-size: 4rem;">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                        @endif
                        <button class="btn btn-sm btn-light rounded-circle position-absolute camera-btn"
                                onclick="document.getElementById('profile_picture').click();">
                            <i class="fas fa-camera"></i>
                        </button>
                    </div>

                    <h3 class="mb-1">{{ $user->name }}</h3>
                    <p class="text-muted mb-3">{{ $user->email }}</p>

                    <div class="d-grid gap-2 mb-4">
                        <button class="btn btn-primary">
                            <i class="fas fa-user-plus me-2"></i> Follow
                        </button>
                        <button class="btn btn-outline-primary">
                            <i class="fas fa-envelope me-2"></i> Message
                        </button>
                    </div>

                    <div class="profile-stats d-flex justify-content-around mb-4">
                        <div class="text-center">
                            <h4 class="mb-0">{{ $stats['total_deliveries'] ?? 0 }}</h4>
                            <small class="text-muted">Deliveries</small>
                        </div>
                        <div class="text-center">
                            <h4 class="mb-0">{{ $stats['completed_deliveries'] ?? 0 }}</h4>
                            <small class="text-muted">Completed</small>
                        </div>
                        <div class="text-center">
                            <h4 class="mb-0">{{ $stats['rating'] ?? '0.0' }}</h4>
                            <small class="text-muted">Rating</small>
                        </div>
                    </div>

                    @if($user->bio)
                        <div class="bio-section text-start">
                            <h5 class="mb-3">About Me</h5>
                            <p>{{ $user->bio }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Right Column - Profile Information -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Profile Information</h4>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                        <i class="fas fa-edit me-2"></i>Edit Profile
                    </button>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        <!-- Personal Information -->
                        <div class="col-12">
                            <h5 class="border-bottom pb-2 mb-3">Personal Information</h5>
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="info-item mb-3">
                                        <label class="text-muted d-block">Full Name</label>
                                        <span class="fs-5">{{ $user->name }}</span>
                                    </div>
                                    <div class="info-item mb-3">
                                        <label class="text-muted d-block">Email</label>
                                        <span class="fs-5">{{ $user->email }}</span>
                                    </div>
                                    <div class="info-item mb-3">
                                        <label class="text-muted d-block">Phone</label>
                                        <span class="fs-5">{{ $user->phone }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-item mb-3">
                                        <label class="text-muted d-block">Date of Birth</label>
                                        <span class="fs-5">{{ $user->date_of_birth ? date('M d, Y', strtotime($user->date_of_birth)) : 'Not set' }}</span>
                                    </div>
                                    <div class="info-item mb-3">
                                        <label class="text-muted d-block">Gender</label>
                                        <span class="fs-5">{{ ucfirst($user->gender ?? 'Not set') }}</span>
                                    </div>
                                    <div class="info-item mb-3">
                                        <label class="text-muted d-block">Emergency Contact</label>
                                        <span class="fs-5">{{ $user->emergency_contact ?? 'Not set' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Work Experience -->
                        <div class="col-12">
                            <h5 class="border-bottom pb-2 mb-3">Work Experience</h5>
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="info-item mb-3">
                                        <label class="text-muted d-block">Previous Company</label>
                                        <span class="fs-5">{{ $user->previous_company }}</span>
                                    </div>
                                    <div class="info-item mb-3">
                                        <label class="text-muted d-block">Previous Position</label>
                                        <span class="fs-5">{{ $user->previous_position }}</span>
                                    </div>
                                    <div class="info-item mb-3">
                                        <label class="text-muted d-block">Employment Period</label>
                                        <span class="fs-5">
                                            {{ $user->previous_employment_start ? date('M Y', strtotime($user->previous_employment_start)) : 'Not set' }}
                                            -
                                            {{ $user->previous_employment_end ? date('M Y', strtotime($user->previous_employment_end)) : 'Not set' }}
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-item mb-3">
                                        <label class="text-muted d-block">Years of Experience</label>
                                        <span class="fs-5">{{ $user->years_of_experience }} years</span>
                                    </div>
                                    <div class="info-item mb-3">
                                        <label class="text-muted d-block">Skills</label>
                                        <div class="d-flex flex-wrap gap-2">
                                            @foreach(explode(',', $user->skills) as $skill)
                                                <span class="badge bg-primary">{{ trim($skill) }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="info-item mb-3">
                                        <label class="text-muted d-block">Work Experience Description</label>
                                        <p class="fs-5">{{ $user->work_experience }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Vehicle Information -->
                        <div class="col-12">
                            <h5 class="border-bottom pb-2 mb-3">Vehicle Information</h5>
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="info-item mb-3">
                                        <label class="text-muted d-block">Vehicle Type</label>
                                        <span class="fs-5">{{ $user->vehicle_type }}</span>
                                    </div>
                                    <div class="info-item mb-3">
                                        <label class="text-muted d-block">License Number</label>
                                        <span class="fs-5">{{ $user->license_number }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-item mb-3">
                                        <label class="text-muted d-block">License Expiry</label>
                                        <span class="fs-5">{{ $user->license_expiry ? date('M d, Y', strtotime($user->license_expiry)) : 'Not set' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Address Information -->
                        <div class="col-12">
                            <h5 class="border-bottom pb-2 mb-3">Address Information</h5>
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label class="text-muted d-block">Address</label>
                                    <span class="fs-5">{{ $user->address }}</span>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-item mb-3">
                                        <label class="text-muted d-block">City</label>
                                        <span class="fs-5">{{ $user->city }}</span>
                                    </div>
                                    <div class="info-item mb-3">
                                        <label class="text-muted d-block">State</label>
                                        <span class="fs-5">{{ $user->state }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-item mb-3">
                                        <label class="text-muted d-block">Postal Code</label>
                                        <span class="fs-5">{{ $user->postal_code }}</span>
                                    </div>
                                    <div class="info-item mb-3">
                                        <label class="text-muted d-block">Country</label>
                                        <span class="fs-5">{{ $user->country }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" action="{{ route('delivery-boy.profile.update') }}" enctype="multipart/form-data" id="profile_form">
                @csrf
                @method('PUT')
                <input type="file" id="profile_picture" name="profile_picture" class="d-none" onchange="document.getElementById('profile_form').submit()">
                
                <div class="modal-header">
                    <h5 class="modal-title">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <!-- Personal Information -->
                        <div class="col-md-6">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   name="name" value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   name="email" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Phone</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                   name="phone" value="{{ old('phone', $user->phone) }}" required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Date of Birth</label>
                            <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" 
                                   name="date_of_birth" value="{{ old('date_of_birth', $user->date_of_birth) }}" required>
                            @error('date_of_birth')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Gender</label>
                            <select class="form-select @error('gender') is-invalid @enderror" name="gender" required>
                                <option value="">Select Gender</option>
                                <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>Female</option>
                                <option value="other" {{ old('gender', $user->gender) == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('gender')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Emergency Contact</label>
                            <input type="text" class="form-control @error('emergency_contact') is-invalid @enderror" 
                                   name="emergency_contact" value="{{ old('emergency_contact', $user->emergency_contact) }}" required>
                            @error('emergency_contact')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Work Experience -->
                        <div class="col-12">
                            <hr class="my-4">
                            <h5 class="mb-3">Work Experience</h5>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Previous Company</label>
                            <input type="text" class="form-control @error('previous_company') is-invalid @enderror" 
                                   name="previous_company" value="{{ old('previous_company', $user->previous_company) }}" required>
                            @error('previous_company')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Previous Position</label>
                            <input type="text" class="form-control @error('previous_position') is-invalid @enderror" 
                                   name="previous_position" value="{{ old('previous_position', $user->previous_position) }}" required>
                            @error('previous_position')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Employment Start Date</label>
                            <input type="date" class="form-control @error('previous_employment_start') is-invalid @enderror" 
                                   name="previous_employment_start" value="{{ old('previous_employment_start', $user->previous_employment_start) }}" required>
                            @error('previous_employment_start')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Employment End Date</label>
                            <input type="date" class="form-control @error('previous_employment_end') is-invalid @enderror" 
                                   name="previous_employment_end" value="{{ old('previous_employment_end', $user->previous_employment_end) }}" required>
                            @error('previous_employment_end')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label">Work Experience Description</label>
                            <textarea class="form-control @error('work_experience') is-invalid @enderror" 
                                      name="work_experience" rows="3" required>{{ old('work_experience', $user->work_experience) }}</textarea>
                            @error('work_experience')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Years of Experience</label>
                            <input type="number" class="form-control @error('years_of_experience') is-invalid @enderror" 
                                   name="years_of_experience" value="{{ old('years_of_experience', $user->years_of_experience) }}" required min="0">
                            @error('years_of_experience')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-8">
                            <label class="form-label">Skills</label>
                            <input type="text" class="form-control @error('skills') is-invalid @enderror" 
                                   name="skills" value="{{ old('skills', $user->skills) }}" required 
                                   placeholder="Separate skills with commas">
                            @error('skills')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Vehicle Information -->
                        <div class="col-12">
                            <hr class="my-4">
                            <h5 class="mb-3">Vehicle Information</h5>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Vehicle Type</label>
                            <select class="form-select @error('vehicle_type') is-invalid @enderror" name="vehicle_type" required>
                                <option value="">Select Vehicle Type</option>
                                <option value="motorcycle" {{ old('vehicle_type', $user->vehicle_type) == 'motorcycle' ? 'selected' : '' }}>Motorcycle</option>
                                <option value="car" {{ old('vehicle_type', $user->vehicle_type) == 'car' ? 'selected' : '' }}>Car</option>
                                <option value="van" {{ old('vehicle_type', $user->vehicle_type) == 'van' ? 'selected' : '' }}>Van</option>
                                <option value="bicycle" {{ old('vehicle_type', $user->vehicle_type) == 'bicycle' ? 'selected' : '' }}>Bicycle</option>
                            </select>
                            @error('vehicle_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">License Number</label>
                            <input type="text" class="form-control @error('license_number') is-invalid @enderror" 
                                   name="license_number" value="{{ old('license_number', $user->license_number) }}" required>
                            @error('license_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">License Expiry Date</label>
                            <input type="date" class="form-control @error('license_expiry') is-invalid @enderror" 
                                   name="license_expiry" value="{{ old('license_expiry', $user->license_expiry) }}" required>
                            @error('license_expiry')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Address Information -->
                        <div class="col-12">
                            <hr class="my-4">
                            <h5 class="mb-3">Address Information</h5>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Address</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" 
                                      name="address" required>{{ old('address', $user->address) }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">City</label>
                            <input type="text" class="form-control @error('city') is-invalid @enderror" 
                                   name="city" value="{{ old('city', $user->city) }}" required>
                            @error('city')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">State</label>
                            <input type="text" class="form-control @error('state') is-invalid @enderror" 
                                   name="state" value="{{ old('state', $user->state) }}" required>
                            @error('state')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Postal Code</label>
                            <input type="text" class="form-control @error('postal_code') is-invalid @enderror" 
                                   name="postal_code" value="{{ old('postal_code', $user->postal_code) }}" required>
                            @error('postal_code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Country</label>
                            <input type="text" class="form-control @error('country') is-invalid @enderror" 
                                   name="country" value="{{ old('country', $user->country) }}" required>
                            @error('country')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Bio -->
                        <div class="col-12">
                            <hr class="my-4">
                            <h5 class="mb-3">Bio</h5>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Bio</label>
                            <textarea class="form-control @error('bio') is-invalid @enderror" 
                                      name="bio" rows="3">{{ old('bio', $user->bio) }}</textarea>
                            @error('bio')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.profile-picture {
    border: 4px solid #fff;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.profile-picture-container {
    position: relative;
    display: inline-block;
}

.camera-btn {
    position: absolute;
    bottom: 10px;
    right: 10px;
    width: 32px;
    height: 32px;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    background: white;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.card {
    border: none;
    box-shadow: 0 0 20px rgba(0,0,0,0.08);
}

.card-header {
    background-color: transparent;
    border-bottom: 1px solid rgba(0,0,0,0.05);
}

.form-control, .form-select {
    padding: 0.75rem 1rem;
    border-radius: 0.5rem;
    border: 1px solid rgba(0,0,0,0.1);
}

.form-control:focus, .form-select:focus {
    border-color: #4f46e5;
    box-shadow: 0 0 0 0.2rem rgba(79, 70, 229, 0.25);
}

.btn {
    padding: 0.75rem 1.5rem;
    border-radius: 0.5rem;
    font-weight: 500;
}

.btn-primary {
    background-color: #4f46e5;
    border-color: #4f46e5;
}

.btn-primary:hover {
    background-color: #4338ca;
    border-color: #4338ca;
}

.btn-outline-primary {
    color: #4f46e5;
    border-color: #4f46e5;
}

.btn-outline-primary:hover {
    background-color: #4f46e5;
    border-color: #4f46e5;
}

.info-item label {
    font-size: 0.875rem;
    margin-bottom: 0.25rem;
}

.modal-content {
    border: none;
    border-radius: 1rem;
}

.modal-header {
    border-bottom: 1px solid rgba(0,0,0,0.05);
}

.modal-footer {
    border-top: 1px solid rgba(0,0,0,0.05);
}

.badge {
    padding: 0.5rem 1rem;
    font-weight: 500;
}

.alert {
    border-radius: 0.5rem;
}
</style>
@endsection 