@extends('layouts.app')

@section('content')
<div class="profile-wrapper">
    <div class="profile-background">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
        <div class="shape shape-4"></div>
    </div>
    
    <div class="container position-relative py-5">
    <div class="row justify-content-center">
            <!-- Profile Sidebar -->
            <div class="col-lg-3">
                <div class="card glass-card border-0 mb-4">
                    <div class="card-body text-center p-4">
                        <div class="position-relative d-inline-block mb-3">
                            <div class="profile-picture-wrapper">
                                @if($user->profile_picture)
                                    <img id="profile-preview" src="{{ asset('storage/profile_pictures/' . $user->profile_picture) }}" 
                                         alt="{{ $user->name }}'s Profile Picture" 
                                         class="rounded-circle profile-image" style="width: 120px; height: 120px; object-fit: cover;">
                                @else
                                    <img id="profile-preview" src="{{ asset('images/default-avatar.png') }}" 
                                         alt="Default Profile Picture" 
                                         class="rounded-circle profile-image" style="width: 120px; height: 120px; object-fit: cover;">
                                @endif
                                <div class="profile-picture-overlay">
                                    <i class="fas fa-camera fa-lg"></i>
                                    <div class="mt-2">Change Photo</div>
                                </div>
                                <input type="file" id="profile_picture" name="profile_picture" class="d-none" accept="image/*">
                            </div>
                        </div>
                        <h5 class="mb-1">{{ $user->name }}</h5>
                        <p class="text-muted small mb-3">Member since {{ $user->created_at->format('F Y') }}</p>
                        <div class="d-flex justify-content-center gap-4 mb-3">
                            <div class="stat-item">
                                <div class="h4 mb-0">4</div>
                                <small class="text-muted">Orders</small>
                            </div>
                            <div class="stat-item">
                                <div class="h4 mb-0">2</div>
                                <small class="text-muted">Reviews</small>
                            </div>
                            <div class="stat-item">
                                <div class="h4 mb-0">1</div>
                                <small class="text-muted">Wishlists</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation Menu -->
                <div class="glass-nav border-0 mb-4">
                    <a href="#profile" class="nav-item active" data-bs-toggle="list">
                        <i class="fas fa-user me-2"></i>Profile Settings
                    </a>
                    <a href="#orders" class="nav-item" data-bs-toggle="list">
                        <i class="fas fa-shopping-bag me-2"></i>My Orders
                    </a>
                    <a href="#reviews" class="nav-item" data-bs-toggle="list">
                        <i class="fas fa-star me-2"></i>My Reviews
                    </a>
                    <a href="#wishlist" class="nav-item" data-bs-toggle="list">
                        <i class="fas fa-heart me-2"></i>Wishlist
                    </a>
                </div>
                    </div>

            <!-- Main Content -->
            <div class="col-lg-9">
                <div class="tab-content">
                    <!-- Profile Settings Tab -->
                    <div class="tab-pane fade show active" id="profile">
                        <div class="card glass-card border-0">
                            <div class="card-header bg-transparent border-0 py-3">
                                <h5 class="mb-0 fw-bold">Profile Settings</h5>
                            </div>
                            <div class="card-body p-4">
                    @if(session('status'))
                                    <div class="alert custom-alert alert-success border-0 mb-4">
                            {{ session('status') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                                    <!-- Name -->
                                    <div class="mb-4">
                                        <div class="form-floating glass-input">
                                            <input type="text" name="name" class="form-control bg-transparent" 
                                                   id="name" placeholder="Full name" value="{{ old('name', $user->name) }}" required>
                                            <label for="name">
                                                <i class="fas fa-user me-2"></i>Full name
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Email -->
                                    <div class="mb-4">
                                        <div class="form-floating glass-input">
                                            <input type="email" name="email" class="form-control bg-transparent" 
                                                   id="email" placeholder="Email address" value="{{ old('email', $user->email) }}" required>
                                            <label for="email">
                                                <i class="fas fa-envelope me-2"></i>Email address
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Bio -->
                                    <div class="mb-4">
                                        <div class="form-floating glass-input">
                                            <textarea name="bio" class="form-control bg-transparent" 
                                                      id="bio" placeholder="Tell us about yourself" 
                                                      style="height: 100px">{{ old('bio', $user->bio) }}</textarea>
                                            <label for="bio">
                                                <i class="fas fa-comment me-2"></i>Bio
                                            </label>
                                        </div>
                                    </div>

                                    <hr class="my-4">
                                    <h6 class="mb-3 text-muted fw-bold">Change Password</h6>

                                    <!-- Current Password -->
                                    <div class="mb-4">
                                        <div class="form-floating glass-input">
                                            <input type="password" name="current_password" class="form-control bg-transparent" 
                                                   id="current_password" placeholder="Current password">
                                            <label for="current_password">
                                                <i class="fas fa-lock me-2"></i>Current password
                                            </label>
                                        </div>
                                    </div>

                                    <!-- New Password -->
                                    <div class="mb-4">
                                        <div class="form-floating glass-input">
                                            <input type="password" name="new_password" class="form-control bg-transparent" 
                                                   id="new_password" placeholder="New password">
                                            <label for="new_password">
                                                <i class="fas fa-key me-2"></i>New password
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Confirm New Password -->
                                    <div class="mb-4">
                                        <div class="form-floating glass-input">
                                            <input type="password" name="new_password_confirmation" class="form-control bg-transparent" 
                                                   id="new_password_confirmation" placeholder="Confirm new password">
                                            <label for="new_password_confirmation">
                                                <i class="fas fa-key me-2"></i>Confirm new password
                                            </label>
                                </div>
                            </div>

                                    <button type="submit" class="btn btn-primary w-100 mb-3 btn-lg animate-hover">
                                        Save Changes
                                    </button>
                                </form>
                            </div>
                        </div>
                            </div>

                    <!-- Orders Tab -->
                    <div class="tab-pane fade" id="orders">
                        <div class="card glass-card border-0">
                            <div class="card-header bg-transparent border-0 py-3">
                                <h5 class="mb-0 fw-bold">My Orders</h5>
                            </div>
                            <div class="card-body p-4">
                                <!-- Sample Order -->
                                <div class="order-card mb-4">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <img src="https://via.placeholder.com/100" alt="Product" class="rounded-3" style="width: 80px;">
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <div>
                                                    <h6 class="mb-1">Premium Gaming Laptop</h6>
                                                    <p class="text-muted small mb-1">Order #ORD-2024-001</p>
                                                    <span class="badge bg-success bg-opacity-10 text-success">Delivered</span>
                                                </div>
                                                <div class="text-end">
                                                    <h6 class="mb-2">$1,299.99</h6>
                                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#reviewModal">
                                                        Write Review
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>

                                <!-- Another Sample Order -->
                                <div class="order-card">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <img src="https://via.placeholder.com/100" alt="Product" class="rounded-3" style="width: 80px;">
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <div>
                                                    <h6 class="mb-1">Wireless Gaming Mouse</h6>
                                                    <p class="text-muted small mb-1">Order #ORD-2024-002</p>
                                                    <span class="badge bg-info bg-opacity-10 text-info">In Transit</span>
                                                </div>
                                                <div class="text-end">
                                                    <h6 class="mb-2">$79.99</h6>
                                                    <button class="btn btn-sm btn-secondary" disabled>
                                                        Pending Delivery
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            </div>

                    <!-- Reviews Tab -->
                    <div class="tab-pane fade" id="reviews">
                        <div class="card glass-card border-0">
                            <div class="card-header bg-transparent border-0 py-3">
                                <h5 class="mb-0 fw-bold">My Reviews</h5>
                            </div>
                            <div class="card-body p-4">
                                <!-- Sample Review -->
                                <div class="review-card mb-4">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <img src="https://via.placeholder.com/100" alt="Product" class="rounded-3" style="width: 80px;">
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <div class="d-flex align-items-center mb-2">
                                                <h6 class="mb-0 me-2">Premium Gaming Laptop</h6>
                                                <div class="rating">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star-half-alt"></i>
                                                </div>
                                            </div>
                                            <p class="mb-3">Excellent performance and build quality. The screen is amazing for gaming!</p>
                                            <div class="review-images mb-3">
                                                <img src="https://via.placeholder.com/100" alt="Review" class="review-image me-2">
                                                <img src="https://via.placeholder.com/100" alt="Review" class="review-image me-2">
                                            </div>
                                            <small class="text-muted">Reviewed on March 15, 2024</small>
                                        </div>
                                    </div>
                            </div>

                                <!-- Another Sample Review -->
                                <div class="review-card">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <img src="https://via.placeholder.com/100" alt="Product" class="rounded-3" style="width: 80px;">
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <div class="d-flex align-items-center mb-2">
                                                <h6 class="mb-0 me-2">Wireless Gaming Mouse</h6>
                                                <div class="rating">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                </div>
                                            </div>
                                            <p class="mb-3">Perfect for gaming! Great battery life and responsive.</p>
                                            <div class="review-images mb-3">
                                                <img src="https://via.placeholder.com/100" alt="Review" class="review-image">
                                            </div>
                                            <small class="text-muted">Reviewed on March 10, 2024</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            </div>

                    <!-- Wishlist Tab -->
                    <div class="tab-pane fade" id="wishlist">
                        <div class="card glass-card border-0">
                            <div class="card-header bg-transparent border-0 py-3">
                                <h5 class="mb-0 fw-bold">My Wishlist</h5>
                            </div>
                            <div class="card-body p-4">
                                <div class="row g-4">
                                    <!-- Sample Wishlist Item -->
                                    <div class="col-md-6">
                                        <div class="wishlist-card">
                                            <img src="https://via.placeholder.com/300x200" class="card-img-top rounded-3" alt="Product">
                                            <div class="card-body p-3">
                                                <h6 class="card-title mb-2">4K Gaming Monitor</h6>
                                                <p class="card-text text-primary h5 mb-2">$499.99</p>
                                                <p class="card-text small text-muted mb-3">Added on March 1, 2024</p>
                                                <div class="d-flex gap-2">
                                                    <button class="btn btn-primary flex-grow-1">
                                                        Add to Cart
                                                    </button>
                                                    <button class="btn btn-outline-danger">
                                                        <i class="fas fa-trash"></i>
                                </button>
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
        </div>
    </div>
</div>

<!-- Review Modal -->
<div class="modal fade" id="reviewModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content glass-card border-0">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold">Write a Review</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-4">
                        <label class="form-label">Rating</label>
                        <div class="rating-stars mb-2">
                            <i class="fas fa-star fa-lg me-1"></i>
                            <i class="fas fa-star fa-lg me-1"></i>
                            <i class="fas fa-star fa-lg me-1"></i>
                            <i class="fas fa-star fa-lg me-1"></i>
                            <i class="far fa-star fa-lg me-1"></i>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="form-floating glass-input">
                            <textarea class="form-control bg-transparent" rows="3" 
                                      id="review" placeholder="Share your experience"></textarea>
                            <label for="review">
                                <i class="fas fa-comment me-2"></i>Your Review
                            </label>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Photos</label>
                        <div class="dropzone-input">
                            <input type="file" class="form-control bg-transparent" multiple accept="image/*">
                            <div class="dropzone-message">
                                <i class="fas fa-cloud-upload-alt fa-2x mb-2"></i>
                                <p class="mb-0">Drag & drop photos here or click to upload</p>
                                <small class="text-muted">You can upload up to 5 photos</small>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Video Review</label>
                        <div class="video-upload-input glass-input p-3">
                            <input type="file" class="form-control bg-transparent" accept="video/mp4,video/x-m4v,video/*" id="review-video">
                            <div class="video-upload-message text-center mt-2">
                                <i class="fas fa-video fa-2x mb-2"></i>
                                <p class="mb-0">Upload a video review</p>
                                <small class="text-muted">Max video size: 100MB (MP4 format recommended)</small>
                            </div>
                            <div class="video-preview mt-3 d-none">
                                <video controls class="w-100 rounded" style="max-height: 200px;">
                                    <source src="" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Submit Review</button>
            </div>
        </div>
    </div>
</div>

<style>
.profile-wrapper {
    min-height: 100vh;
    position: relative;
    overflow: hidden;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
}

.profile-background {
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
    background: linear-gradient(135deg, #43CBFF, #9708CC);
    width: 300px;
    height: 300px;
    top: -100px;
    right: -100px;
    animation: float 6s ease-in-out infinite;
}

.shape-2 {
    background: linear-gradient(135deg, #FFA8A8, #FCFF00);
    width: 400px;
    height: 400px;
    bottom: -150px;
    left: -150px;
    animation: float 8s ease-in-out infinite;
}

.shape-3 {
    background: linear-gradient(135deg, #43CBFF, #9708CC);
    width: 200px;
    height: 200px;
    top: 50%;
    right: 15%;
    animation: float 7s ease-in-out infinite;
}

.shape-4 {
    background: linear-gradient(135deg, #FFA8A8, #FCFF00);
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
    transition: all 0.3s ease;
}

.glass-input:focus-within {
    background: rgba(255, 255, 255, 0.9);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
}

.glass-nav {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(10px);
    border-radius: 16px;
    overflow: hidden;
}

.nav-item {
    display: block;
    padding: 1rem 1.5rem;
    color: #6c757d;
    text-decoration: none;
    transition: all 0.3s ease;
}

.nav-item:hover {
    background: rgba(67, 203, 255, 0.1);
    color: #43CBFF;
}

.nav-item.active {
    background: linear-gradient(135deg, #43CBFF, #9708CC);
    color: white;
}

.profile-picture-wrapper {
        position: relative;
        border-radius: 50%;
        overflow: hidden;
    cursor: pointer;
    transition: all 0.3s ease;
}

.profile-picture-wrapper:hover .profile-picture-overlay {
    opacity: 1;
}

.profile-picture-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(67, 203, 255, 0.8);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: white;
    opacity: 0;
    transition: all 0.3s ease;
}

.stat-item {
    text-align: center;
    padding: 0.5rem 1rem;
    background: rgba(255, 255, 255, 0.7);
    border-radius: 12px;
    transition: all 0.3s ease;
}

.stat-item:hover {
    transform: translateY(-5px);
    background: rgba(255, 255, 255, 0.9);
}

.order-card {
    background: rgba(255, 255, 255, 0.7);
    border-radius: 12px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    transition: all 0.3s ease;
}

.order-card:hover {
    transform: translateY(-5px);
    background: rgba(255, 255, 255, 0.9);
    box-shadow: 0 8px 25px rgba(67, 203, 255, 0.15);
}

.review-card {
    background: rgba(255, 255, 255, 0.7);
    border-radius: 12px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    transition: all 0.3s ease;
}

.review-card:hover {
    transform: translateY(-5px);
    background: rgba(255, 255, 255, 0.9);
    box-shadow: 0 8px 25px rgba(67, 203, 255, 0.15);
}

.review-image {
    width: 60px;
    height: 60px;
    border-radius: 8px;
        object-fit: cover;
    cursor: pointer;
    transition: all 0.3s ease;
}

.review-image:hover {
    transform: scale(1.1);
    box-shadow: 0 5px 15px rgba(67, 203, 255, 0.2);
}

.wishlist-card {
    background: rgba(255, 255, 255, 0.7);
    border-radius: 12px;
    overflow: hidden;
    transition: all 0.3s ease;
}

.wishlist-card:hover {
    transform: translateY(-5px);
    background: rgba(255, 255, 255, 0.9);
    box-shadow: 0 8px 25px rgba(67, 203, 255, 0.15);
}

.rating {
    color: #ffc107;
    }
    
    .btn-primary {
    background: linear-gradient(135deg, #43CBFF, #9708CC);
    border: none;
    border-radius: 12px;
    padding: 12px;
    font-weight: 600;
    transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
    background: linear-gradient(135deg, #9708CC, #43CBFF);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(67, 203, 255, 0.4);
}

.custom-alert {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(10px);
    border-radius: 12px;
}

.dropzone-input {
    background: rgba(255, 255, 255, 0.7);
    border: 2px dashed rgba(67, 203, 255, 0.5);
    border-radius: 12px;
    padding: 2rem;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
}

.dropzone-input:hover {
    background: rgba(255, 255, 255, 0.9);
    border-color: #43CBFF;
}

.dropzone-message {
    color: #6c757d;
}

.rating-stars i {
    color: #ffc107;
    cursor: pointer;
    transition: all 0.3s ease;
}

.rating-stars i:hover {
    transform: scale(1.2);
}

@keyframes float {
    0% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
    100% { transform: translateY(0px); }
}

@keyframes slideIn {
    from { transform: translateX(-20px); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
}

.tab-pane {
    animation: fadeIn 0.5s ease-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
    }

.video-upload-input {
    border: 2px dashed rgba(67, 203, 255, 0.2);
    border-radius: 12px;
    transition: all 0.3s ease;
    cursor: pointer;
}

.video-upload-input:hover {
    border-color: #43CBFF;
    background: rgba(255, 255, 255, 0.1);
}

.video-upload-message {
    color: #6c757d;
}

.video-upload-message i {
    color: #43CBFF;
}

.video-preview {
    background: rgba(0, 0, 0, 0.05);
    border-radius: 8px;
    overflow: hidden;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Profile picture upload handling
    const profilePictureWrapper = document.querySelector('.profile-picture-wrapper');
    const profilePicture = document.getElementById('profile_picture');
    const previewImage = document.getElementById('profile-preview');
    
    if (profilePictureWrapper) {
        profilePictureWrapper.addEventListener('click', function() {
            profilePicture.click();
        });
    }
    
    if (profilePicture) {
    profilePicture.addEventListener('change', function(e) {
            if (e.target.files && e.target.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
            }
                reader.readAsDataURL(e.target.files[0]);
            }
        });
    }

    // Tab navigation
    const tabLinks = document.querySelectorAll('[data-bs-toggle="list"]');
    tabLinks.forEach(tabLink => {
        tabLink.addEventListener('click', function(e) {
            e.preventDefault();
            // Remove active class from all links
            tabLinks.forEach(link => link.classList.remove('active'));
            // Add active class to clicked link
            this.classList.add('active');
            
            // Show corresponding tab content
            const target = this.getAttribute('href').substring(1);
            document.querySelectorAll('.tab-pane').forEach(pane => {
                pane.classList.remove('show', 'active');
            });
            document.getElementById(target).classList.add('show', 'active');
        });
    });

    // Rating stars functionality
    const ratingStars = document.querySelectorAll('.rating-stars i');
    if (ratingStars.length) {
        ratingStars.forEach((star, index) => {
            star.addEventListener('click', () => {
                ratingStars.forEach((s, i) => {
                    if (i <= index) {
                        s.className = 'fas fa-star fa-lg me-1';
                    } else {
                        s.className = 'far fa-star fa-lg me-1';
                    }
                });
            });
        });
    }

    // Video upload preview
    const videoInput = document.getElementById('review-video');
    const videoPreview = document.querySelector('.video-preview');
    
    if (videoInput) {
        videoInput.addEventListener('change', function(e) {
            if (e.target.files && e.target.files[0]) {
                const file = e.target.files[0];
                
                // Check file size (100MB limit)
                if (file.size > 100 * 1024 * 1024) {
                    alert('Video file is too large. Please select a file under 100MB.');
                    this.value = '';
                    return;
                }
                
                const video = videoPreview.querySelector('video');
                const source = video.querySelector('source');
                source.src = URL.createObjectURL(file);
                video.load();
                videoPreview.classList.remove('d-none');
            }
        });
    }
});
</script>
@endsection 