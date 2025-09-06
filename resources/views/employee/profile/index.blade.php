@extends('employee.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-4">
            <!-- Profile Card -->
            <div class="card shadow mb-4">
                <div class="card-body text-center">
                    <img src="{{ $employee->profile_picture ? asset('storage/' . $employee->profile_picture) : asset('images/default-avatar.png') }}" 
                         class="rounded-circle img-thumbnail mb-3" 
                         style="width: 150px; height: 150px; object-fit: cover;">
                    <h4 class="mb-1">{{ $employee->name }}</h4>
                    <p class="text-muted mb-3">{{ $employee->role }}</p>
                    <div class="d-flex justify-content-center mb-3">
                        <button class="btn btn-primary btn-sm me-2" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                            <i class="fas fa-edit me-1"></i> Edit Profile
                        </button>
                    </div>
                        </div>
                    </div>

            <!-- Contact Information -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Contact Information</h6>
                        </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="text-muted d-block">Email</label>
                        <div>{{ $employee->email }}</div>
                </div>
            </div>
        </div>

            <!-- Skills -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Skills</h6>
                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editSkillsModal">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-wrap gap-2">
                        @forelse($employee->skills ?? [] as $skill)
                            <span class="badge bg-primary">{{ $skill }}</span>
                        @empty
                            <p class="text-muted mb-0">No skills added yet</p>
                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>

        <div class="col-xl-8">
            <!-- Bio -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">About Me</h6>
                                    </div>
                <div class="card-body">
                    {{ $employee->bio ?? 'No bio added yet.' }}
                                    </div>
                                </div>

            <!-- Work Experience -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Work Experience</h6>
                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addExperienceModal">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
                <div class="card-body">
                    @forelse($employee->work_experience ?? [] as $experience)
                        <div class="mb-4">
                            <h5 class="mb-1">{{ $experience['title'] }}</h5>
                            <p class="text-muted mb-2">{{ $experience['company'] }} • {{ $experience['duration'] }}</p>
                            <p class="mb-0">{{ $experience['description'] }}</p>
                                    </div>
                    @empty
                        <p class="text-muted mb-0">No work experience added yet</p>
                    @endforelse
                                        </div>
                                    </div>

            <!-- Products Added -->
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Products Added</h6>
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
                                            <span class="badge bg-{{ $product->status === 'active' ? 'success' : 'warning' }}">
                                                {{ ucfirst($product->status) }}
                                            </span>
                                            <a href="{{ route('employee.products.edit', $product) }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-edit"></i>
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

<!-- Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('employee.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" value="{{ $employee->name }}" required>
                        </div>
                    <div class="mb-3">
                        <label class="form-label">Bio</label>
                        <textarea class="form-control" name="bio" rows="4">{{ $employee->bio }}</textarea>
                        </div>
                    <div class="mb-3">
                        <label class="form-label">Profile Picture</label>
                        <input type="file" class="form-control" name="profile_picture" accept="image/*">
                        </div>
                        </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
            </form>
                        </div>
                        </div>
                        </div>

<!-- Add Experience Modal -->
<div class="modal fade" id="addExperienceModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('employee.profile.add-experience') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add Work Experience</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" required>
                        </div>
                    <div class="mb-3">
                        <label class="form-label">Company</label>
                        <input type="text" class="form-control" name="company" required>
                        </div>
                    <div class="mb-3">
                        <label class="form-label">Duration</label>
                        <input type="text" class="form-control" name="duration" placeholder="e.g. Jan 2020 - Present" required>
                        </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="3" required></textarea>
                        </div>
                        </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Experience</button>
                        </div>
            </form>
                        </div>
                        </div>
                        </div>

<!-- Edit Skills Modal -->
<div class="modal fade" id="editSkillsModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('employee.profile.update-skills') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit Skills</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Skills (comma-separated)</label>
                        <input type="text" class="form-control" name="skills" value="{{ is_array($employee->skills) ? implode(', ', $employee->skills) : '' }}" placeholder="e.g. PHP, Laravel, MySQL">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Skills</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection 