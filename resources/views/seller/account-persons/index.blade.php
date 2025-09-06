@extends('seller.layouts.app')
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

    .card-header {
        background-color: #ffffff;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        padding: 1.25rem 1.5rem;
    }

    .card-title {
        margin-bottom: 0;
        font-weight: 600;
        color: #2c3e50;
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
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div>
                <h1 class="h3 mb-1">Account Persons Management</h1>
                <p class="text-muted mb-0">Manage your account management team members</p>
            </div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAccountPersonModal">
                <i class="fas fa-plus me-2"></i> Add Account Person
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
                    <i class="fas fa-user-tie"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-value">{{ $accountPersons->count() }}</div>
                    <div class="stat-title">Total Account Persons</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background-color: rgba(40, 167, 69, 0.1); color: #28a745;">
                    <i class="fas fa-user-check"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-value">{{ $accountPersons->where('status', 'active')->count() }}</div>
                    <div class="stat-title">Active Account Persons</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background-color: rgba(220, 53, 69, 0.1); color: #dc3545;">
                    <i class="fas fa-user-times"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-value">{{ $accountPersons->where('status', 'inactive')->count() }}</div>
                    <div class="stat-title">Inactive Account Persons</div>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="filter-section">
            <form action="{{ route('seller.account-persons.index') }}" method="GET">
                <div class="row">
                    <div class="col-md-6">
                        <div class="search-form">
                            <i class="fas fa-search"></i>
                            <input type="text" class="form-control" name="search" placeholder="Search account persons..."
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
                                <a href="{{ route('seller.account-persons.index', array_merge(request()->except('search'), ['page' => 1])) }}"
                                    class="close">&times;</a>
                            </div>
                        @endif

                        @if(request('status'))
                            <div class="filter-tag">
                                Status: {{ ucfirst(request('status')) }}
                                <a href="{{ route('seller.account-persons.index', array_merge(request()->except('status'), ['page' => 1])) }}"
                                    class="close">&times;</a>
                            </div>
                        @endif

                        <a href="{{ route('seller.account-persons.index') }}" class="btn btn-sm btn-outline-secondary ms-auto">
                            <i class="fas fa-times me-1"></i>Clear All
                        </a>
                    </div>
                @endif
            </form>
        </div>

        <!-- Account Persons Table -->
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
                        @forelse($accountPersons as $accountPerson)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="avatar"
                                                style="background-color: #{{ substr(md5($accountPerson->name), 0, 6) }};">
                                                {{ strtoupper(substr($accountPerson->name, 0, 1)) }}
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            {{ $accountPerson->name }}
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $accountPerson->email }}</td>
                                <td>{{ $accountPerson->phone ?? 'N/A' }}</td>
                                <td>
                                    <div class="password-container">
                                        <span class="password-text"
                                            style="display: none;">{{ $accountPerson->visible_password ?? 'password' }}</span>
                                        <span class="password-dots">••••••••</span>
                                        <button class="btn btn-outline-secondary btn-sm toggle-password" type="button">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge {{ $accountPerson->status === 'active' ? 'bg-success' : 'bg-danger' }}">
                                        {{ ucfirst($accountPerson->status) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <button type="button" class="btn btn-sm btn-info"
                                            onclick="editAccountPerson({{ $accountPerson->id }})" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-warning"
                                            onclick="resetPassword({{ $accountPerson->id }})" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Reset Password">
                                            <i class="fas fa-key"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-danger"
                                            onclick="deleteAccountPerson({{ $accountPerson->id }})" data-bs-toggle="tooltip"
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
                                        <i class="fas fa-user-tie"></i>
                                        <h4>No account persons found</h4>
                                        <p>Try adjusting your search or filter to find what you're looking for.</p>
                                        <a href="{{ route('seller.account-persons.index') }}" class="btn btn-primary mt-2">
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
            @if($accountPersons->hasPages())
                <div class="d-flex justify-content-between align-items-center p-3 border-top">
                    <div class="text-muted">
                        Showing {{ $accountPersons->firstItem() }} to {{ $accountPersons->lastItem() }} of
                        {{ $accountPersons->total() }} entries
                    </div>
                    <div>
                        {{ $accountPersons->links() }}
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

            function editAccountPerson(id) {
                // Fetch account person data and populate the edit form
                $.get(`/seller/account-persons/${id}`, function (accountPerson) {
                    $('#edit_account_person_id').val(accountPerson.id);
                    $('#edit_name').val(accountPerson.name);
                    $('#edit_email').val(accountPerson.email);
                    $('#edit_phone').val(accountPerson.phone || '');
                    $('#edit_status').val(accountPerson.status);

                    // Set form action
                    $('#editAccountPersonForm').attr('action', `/seller/account-persons/${accountPerson.id}`);

                    $('#editAccountPersonModal').modal('show');
                }).fail(function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to load account person data. Please try again.'
                    });
                });
            }

            function resetPassword(id) {
                Swal.fire({
                    title: 'Reset Password?',
                    text: 'A new password will be generated and sent to the account person.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, reset it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.post(`/seller/account-persons/${id}/reset-password`, {
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

            function deleteAccountPerson(id) {
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
                            url: `/seller/account-persons/${id}`,
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
                                    text: 'An error occurred while deleting the account person. Please try again.'
                                });
                            }
                        });
                    }
                });
            }
        </script>
    @endpush
@endsection

<!-- Add Account Person Modal -->
<div class="modal fade" id="addAccountPersonModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Account Person</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('seller.account-persons.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" class="form-control" name="phone">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="password" class="form-control" name="password" required minlength="8">
                            <button class="btn btn-outline-secondary toggle-password" type="button">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <small class="form-text text-muted">Password must be at least 8 characters long</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="status">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Add Account Person
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Account Person Modal -->
<div class="modal fade" id="editAccountPersonModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Account Person</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editAccountPersonForm" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="account_person_id" id="edit_account_person_id">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" id="edit_name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" name="email" id="edit_email" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" class="form-control" name="phone" id="edit_phone">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="status" id="edit_status">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Update Account Person
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
