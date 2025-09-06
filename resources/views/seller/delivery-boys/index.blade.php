@extends('seller.layouts.app')

@section('content')
    <style>
        .password-container {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .password-text,
        .password-dots {
            font-family: monospace;
            font-size: 14px;
        }

        .toggle-password {
            cursor: pointer;
            border: none;
            background: none;
            padding: 5px;
        }

        .toggle-password:hover {
            color: #0056b3;
        }

        /* Enhanced styling */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #e9ecef;
        }

        .filter-section {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .stats-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .stat-content {
            flex-grow: 1;
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
            color: #2c3e50;
        }

        .stat-title {
            font-size: 0.9rem;
            color: #7f8c8d;
            font-weight: 500;
        }

        .table-container {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .table thead th {
            background-color: #f8f9fa;
            border-top: none;
            font-weight: 600;
            color: #495057;
            padding: 1rem;
        }

        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
        }

        .badge {
            padding: 0.5rem 0.75rem;
            border-radius: 0.5rem;
            font-weight: 500;
        }

        .action-buttons .btn {
            padding: 0.35rem 0.5rem;
            margin-right: 0.5rem;
        }

        .search-form {
            position: relative;
        }

        .search-form .form-control {
            padding-left: 2.5rem;
            border-radius: 0.5rem;
        }

        .search-form i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
        }

        .filter-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .filter-tag {
            background: #e9ecef;
            padding: 0.35rem 0.75rem;
            border-radius: 1rem;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .filter-tag .close {
            font-size: 1.25rem;
            line-height: 1;
            cursor: pointer;
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #6c757d;
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #dee2e6;
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: white;
            font-size: 1rem;
        }

        .table-responsive {
            overflow-x: auto;
            width: 100%;
        }

        .table {
            min-width: 1000px;
            /* Adjust as needed */
        }
    </style>

    <div class="container-fluid">
        <div class="page-header">
            <div>
                <h1 class="h3 mb-1">Delivery Boys Management</h1>
                <p class="text-muted mb-0">Manage your delivery personnel and their status</p>
            </div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDeliveryBoyModal">
                <i class="fas fa-plus me-2"></i> Add Delivery Boy
            </button>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Stats Cards -->
        <div class="stats-cards">
            <div class="stat-card">
                <div class="stat-icon" style="background-color: rgba(67, 97, 238, 0.1); color: #4361ee;">
                    <i class="fas fa-motorcycle"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-value">{{ $deliveryBoys->count() }}</div>
                    <div class="stat-title">Total Delivery Boys</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background-color: rgba(40, 167, 69, 0.1); color: #28a745;">
                    <i class="fas fa-user-check"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-value">{{ $deliveryBoys->where('status', 'active')->count() }}</div>
                    <div class="stat-title">Active Delivery Boys</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background-color: rgba(220, 53, 69, 0.1); color: #dc3545;">
                    <i class="fas fa-user-times"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-value">{{ $deliveryBoys->where('status', 'inactive')->count() }}</div>
                    <div class="stat-title">Inactive Delivery Boys</div>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="filter-section">
            <form action="{{ route('seller.delivery-boys.index') }}" method="GET">
                <div class="row">
                    <div class="col-md-6">
                        <div class="search-form">
                            <i class="fas fa-search"></i>
                            <input type="text" class="form-control" name="search" placeholder="Search delivery boys..."
                                value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" name="status">
                            <option value="">All Status</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-filter me-2"></i>Apply Filters
                        </button>
                    </div>
                </div>

                <!-- Active filter tags -->
                @if(request()->has('search') || request()->has('status'))
                    <div class="filter-tags">
                        @if(request('search'))
                            <div class="filter-tag">
                                Search: "{{ request('search') }}"
                                <a href="{{ route('seller.delivery-boys.index', array_merge(request()->except('search'), ['page' => 1])) }}"
                                    class="close">&times;</a>
                            </div>
                        @endif

                        @if(request('status'))
                            <div class="filter-tag">
                                Status: {{ ucfirst(request('status')) }}
                                <a href="{{ route('seller.delivery-boys.index', array_merge(request()->except('status'), ['page' => 1])) }}"
                                    class="close">&times;</a>
                            </div>
                        @endif

                        <a href="{{ route('seller.delivery-boys.index') }}" class="btn btn-sm btn-outline-secondary ms-auto">
                            <i class="fas fa-times me-1"></i>Clear All
                        </a>
                    </div>
                @endif
            </form>
        </div>

        <!-- Delivery Boys Table -->
        <div class="table-container">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Password</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($deliveryBoys as $deliveryBoy)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="avatar"
                                                style="background-color: #{{ substr(md5($deliveryBoy->name), 0, 6) }};">
                                                {{ strtoupper(substr($deliveryBoy->name, 0, 1)) }}
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            {{ $deliveryBoy->name }}
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $deliveryBoy->email }}</td>
                                <td>{{ $deliveryBoy->phone ?? 'N/A' }}</td>
                                <td>
                                    <div class="password-container">
                                        <span class="password-text"
                                            style="display: none;">{{ $deliveryBoy->visible_password ?? 'password' }}</span>
                                        <span class="password-dots">••••••••</span>
                                        <button class="btn btn-outline-secondary btn-sm toggle-password" type="button">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge {{ $deliveryBoy->status === 'active' ? 'bg-success' : 'bg-danger' }}">
                                        {{ ucfirst($deliveryBoy->status) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <button type="button" class="btn btn-sm btn-info"
                                            onclick="editDeliveryBoy({{ $deliveryBoy->id }})" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-warning"
                                            onclick="resetPassword({{ $deliveryBoy->id }})" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Reset Password">
                                            <i class="fas fa-key"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-danger"
                                            onclick="deleteDeliveryBoy({{ $deliveryBoy->id }})" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    <div class="empty-state">
                                        <i class="fas fa-motorcycle"></i>
                                        <h4>No delivery boys found</h4>
                                        <p>Try adjusting your search or filter to find what you're looking for.</p>
                                        <a href="{{ route('seller.delivery-boys.index') }}" class="btn btn-primary mt-2">
                                            <i class="fas fa-refresh me-2"></i>Reset Filters
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($deliveryBoys->hasPages())
                <div class="d-flex justify-content-between align-items-center p-3 border-top">
                    <div class="text-muted">
                        Showing {{ $deliveryBoys->firstItem() }} to {{ $deliveryBoys->lastItem() }} of
                        {{ $deliveryBoys->total() }} entries
                    </div>
                    <div>
                        {{ $deliveryBoys->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function () {
                // Initialize tooltips
                $('[data-bs-toggle="tooltip"]').tooltip();

                // Toggle password visibility
                $(document).on('click', '.toggle-password', function () {
                    const container = $(this).closest('.input-group');
                    const passwordInput = container.find('input');
                    const icon = $(this).find('i');

                    if (passwordInput.attr('type') === 'password') {
                        passwordInput.attr('type', 'text');
                        icon.removeClass('fa-eye').addClass('fa-eye-slash');
                    } else {
                        passwordInput.attr('type', 'password');
                        icon.removeClass('fa-eye-slash').addClass('fa-eye');
                    }
                });

                // Table password toggle
                $(document).on('click', '.password-container .toggle-password', function () {
                    const container = $(this).closest('.password-container');
                    const passwordText = container.find('.password-text');
                    const passwordDots = container.find('.password-dots');
                    const icon = $(this).find('i');

                    if (passwordText.is(':visible')) {
                        passwordText.hide();
                        passwordDots.show();
                        icon.removeClass('fa-eye-slash').addClass('fa-eye');
                    } else {
                        passwordText.show();
                        passwordDots.hide();
                        icon.removeClass('fa-eye').addClass('fa-eye-slash');
                    }
                });
            });

            function editDeliveryBoy(id) {
                // Fetch delivery boy data and populate the edit form
                $.get(`/seller/delivery-boys/${id}`, function (deliveryBoy) {
                    $('#edit_delivery_boy_id').val(deliveryBoy.id);
                    $('#edit_name').val(deliveryBoy.name);
                    $('#edit_email').val(deliveryBoy.email);
                    $('#edit_phone').val(deliveryBoy.phone || '');
                    $('#edit_status').val(deliveryBoy.status);

                    // Set form action
                    $('#editDeliveryBoyForm').attr('action', `/seller/delivery-boys/${deliveryBoy.id}`);

                    $('#editDeliveryBoyModal').modal('show');
                }).fail(function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to load delivery boy data. Please try again.'
                    });
                });
            }

            function resetPassword(id) {
                Swal.fire({
                    title: 'Reset Password?',
                    text: 'A new password will be generated and sent to the delivery boy.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, reset it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.post(`/seller/delivery-boys/${id}/reset-password`, {
                            _token: '{{ csrf_token() }}'
                        }, function (response) {
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: response.message,
                                    timer: 2000,
                                    showConfirmButton: false
                                }).then(() => {
                                    window.location.reload();
                                });
                            }
                        }).fail(function () {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'An error occurred while resetting the password. Please try again.'
                            });
                        });
                    }
                });
            }

            function deleteDeliveryBoy(id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/seller/delivery-boys/${id}`,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function (response) {
                                if (response.success) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Deleted!',
                                        text: response.message,
                                        timer: 2000,
                                        showConfirmButton: false
                                    }).then(() => {
                                        window.location.reload();
                                    });
                                }
                            },
                            error: function () {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'An error occurred while deleting the delivery boy. Please try again.'
                                });
                            }
                        });
                    }
                });
            }
        </script>
    @endpush
@endsection

<!-- Add Delivery Boy Modal -->
<div class="modal fade" id="addDeliveryBoyModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Delivery Boy</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('seller.delivery-boys.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" name="password" class="form-control" required>
                            <button class="btn btn-outline-secondary toggle-password" type="button">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control" required>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Delivery Boy</button>
                </div>
            </form>
        </div>
    </div>
</div>

@foreach($deliveryBoys as $deliveryBoy)
    <!-- Edit Delivery Boy Modal -->
    <div class="modal fade" id="editDeliveryBoyModal{{ $deliveryBoy->id }}" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Delivery Boy</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('seller.delivery-boys.update', $deliveryBoy->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $deliveryBoy->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ $deliveryBoy->email }}"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" name="phone" class="form-control" value="{{ $deliveryBoy->phone }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-control" required>
                                <option value="active" {{ $deliveryBoy->status === 'active' ? 'selected' : '' }}>Active
                                </option>
                                <option value="inactive" {{ $deliveryBoy->status === 'inactive' ? 'selected' : '' }}>
                                    Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Delivery Boy</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
