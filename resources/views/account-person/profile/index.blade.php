@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <!-- Left Column - Profile Picture and Actions -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <div class="profile-picture-container mb-4">
                        @if($accountPerson->profile_picture)
                            <img src="{{ Storage::url($accountPerson->profile_picture) }}" 
                                 alt="Profile Picture" 
                                 class="rounded-circle profile-picture mb-3"
                                 style="width: 200px; height: 200px; object-fit: cover;">
                        @else
                            <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center text-white mx-auto mb-3"
                                 style="width: 200px; height: 200px; font-size: 4rem;">
                                {{ strtoupper(substr($accountPerson->name, 0, 1)) }}
                            </div>
                        @endif
                        <button class="btn btn-sm btn-light rounded-circle position-absolute camera-btn"
                                onclick="document.getElementById('profile_picture').click();">
                            <i class="fas fa-camera"></i>
                        </button>
                    </div>

                    <h3 class="mb-1">{{ $accountPerson->name }}</h3>
                    <p class="text-muted mb-3">{{ $accountPerson->email }}</p>

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
                            <h4 class="mb-0">245</h4>
                            <small class="text-muted">Following</small>
                        </div>
                        <div class="text-center">
                            <h4 class="mb-0">489</h4>
                            <small class="text-muted">Followers</small>
                        </div>
                        <div class="text-center">
                            <h4 class="mb-0">32</h4>
                            <small class="text-muted">Posts</small>
                        </div>
                    </div>

                    @if($accountPerson->bio)
                        <div class="bio-section text-start">
                            <h5 class="mb-3">About Me</h5>
                            <p>{{ $accountPerson->bio }}</p>
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
                                        <span class="fs-5">{{ $accountPerson->name }}</span>
                                    </div>
                                    <div class="info-item mb-3">
                                        <label class="text-muted d-block">Email</label>
                                        <span class="fs-5">{{ $accountPerson->email }}</span>
                                    </div>
                                    <div class="info-item mb-3">
                                        <label class="text-muted d-block">Phone</label>
                                        <span class="fs-5">{{ $accountPerson->phone }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-item mb-3">
                                        <label class="text-muted d-block">Date of Birth</label>
                                        <span class="fs-5">{{ $accountPerson->date_of_birth ? date('M d, Y', strtotime($accountPerson->date_of_birth)) : 'Not set' }}</span>
                                    </div>
                                    <div class="info-item mb-3">
                                        <label class="text-muted d-block">Gender</label>
                                        <span class="fs-5">{{ ucfirst($accountPerson->gender ?? 'Not set') }}</span>
                                    </div>
                                    <div class="info-item mb-3">
                                        <label class="text-muted d-block">Emergency Contact</label>
                                        <span class="fs-5">{{ $accountPerson->emergency_contact ?? 'Not set' }}</span>
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
                                    <span class="fs-5">{{ $accountPerson->address }}</span>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-item mb-3">
                                        <label class="text-muted d-block">City</label>
                                        <span class="fs-5">{{ $accountPerson->city }}</span>
                                    </div>
                                    <div class="info-item mb-3">
                                        <label class="text-muted d-block">State</label>
                                        <span class="fs-5">{{ $accountPerson->state }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-item mb-3">
                                        <label class="text-muted d-block">Postal Code</label>
                                        <span class="fs-5">{{ $accountPerson->postal_code }}</span>
                                    </div>
                                    <div class="info-item mb-3">
                                        <label class="text-muted d-block">Country</label>
                                        <span class="fs-5">{{ $accountPerson->country }}</span>
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
            <form method="POST" action="{{ route('account-person.profile.update') }}" enctype="multipart/form-data" id="profile_form">
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
                                   name="name" value="{{ old('name', $accountPerson->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   name="email" value="{{ old('email', $accountPerson->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Phone</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                   name="phone" value="{{ old('phone', $accountPerson->phone) }}" required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Date of Birth</label>
                            <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" 
                                   name="date_of_birth" value="{{ old('date_of_birth', $accountPerson->date_of_birth) }}" required>
                            @error('date_of_birth')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Gender</label>
                            <select class="form-select @error('gender') is-invalid @enderror" name="gender" required>
                                <option value="">Select Gender</option>
                                <option value="male" {{ old('gender', $accountPerson->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender', $accountPerson->gender) == 'female' ? 'selected' : '' }}>Female</option>
                                <option value="other" {{ old('gender', $accountPerson->gender) == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('gender')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Emergency Contact</label>
                            <input type="text" class="form-control @error('emergency_contact') is-invalid @enderror" 
                                   name="emergency_contact" value="{{ old('emergency_contact', $accountPerson->emergency_contact) }}" required>
                            @error('emergency_contact')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label">Bio</label>
                            <textarea class="form-control @error('bio') is-invalid @enderror" 
                                      name="bio" rows="3" required>{{ old('bio', $accountPerson->bio) }}</textarea>
                            @error('bio')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Address Information -->
                        <div class="col-12">
                            <label class="form-label">Address</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" 
                                      name="address" required>{{ old('address', $accountPerson->address) }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">City</label>
                            <input type="text" class="form-control @error('city') is-invalid @enderror" 
                                   name="city" value="{{ old('city', $accountPerson->city) }}" required>
                            @error('city')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">State</label>
                            <input type="text" class="form-control @error('state') is-invalid @enderror" 
                                   name="state" value="{{ old('state', $accountPerson->state) }}" required>
                            @error('state')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Postal Code</label>
                            <input type="text" class="form-control @error('postal_code') is-invalid @enderror" 
                                   name="postal_code" value="{{ old('postal_code', $accountPerson->postal_code) }}" required>
                            @error('postal_code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Country</label>
                            <input type="text" class="form-control @error('country') is-invalid @enderror" 
                                   name="country" value="{{ old('country', $accountPerson->country) }}" required>
                            @error('country')
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

.alert {
    border-radius: 0.5rem;
}
</style>
@endsection 