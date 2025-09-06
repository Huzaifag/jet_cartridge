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
                <h1 class="h3 mb-1">Employee Management</h1>
                <p class="text-muted mb-0">Manage your team members and their permissions</p>
            </div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">
                <i class="fas fa-plus me-2"></i> Add Employee
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
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-value">100</div>
                    <div class="stat-title">Total Employees</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background-color: rgba(40, 167, 69, 0.1); color: #28a745;">
                    <i class="fas fa-user-check"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-value">{{ $employees->where('is_active', true)->count() }}</div>
                    <div class="stat-title">Active Employees</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background-color: rgba(220, 53, 69, 0.1); color: #dc3545;">
                    <i class="fas fa-user-times"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-value">{{ $employees->where('is_active', false)->count() }}</div>
                    <div class="stat-title">Inactive Employees</div>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="filter-section">
            <form action="{{ route('seller.employees.index') }}" method="GET">
                <div class="row">
                    <div class="col-md-6">
                        <div class="search-form">
                            <i class="fas fa-search"></i>
                            <input type="text" class="form-control" name="search" placeholder="Search employees..."
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
                        <select class="form-select" name="position">
                            <option value="">All Positions</option>
                            {{-- @foreach($positions as $position)
                            <option value="{{ $position }}" {{ request('position')==$position ? 'selected' : '' }}>
                                {{ $position }}</option>
                            @endforeach --}}
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12 d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-filter me-2"></i>Apply Filters
                        </button>
                        <a href="{{ route('seller.employees.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times me-2"></i>Clear Filters
                        </a>
                    </div>
                </div>

                <!-- Active filter tags -->
                @if(request()->has('search') || request()->has('status') || request()->has('position'))
                    <div class="filter-tags">
                        @if(request('search'))
                            <div class="filter-tag">
                                Search: "{{ request('search') }}"
                                <a href="{{ route('seller.employees.index', array_merge(request()->except('search'), ['page' => 1])) }}"
                                    class="close">&times;</a>
                            </div>
                        @endif

                        @if(request('status'))
                            <div class="filter-tag">
                                Status: {{ ucfirst(request('status')) }}
                                <a href="{{ route('seller.employees.index', array_merge(request()->except('status'), ['page' => 1])) }}"
                                    class="close">&times;</a>
                            </div>
                        @endif

                        @if(request('position'))
                            <div class="filter-tag">
                                Position: {{ request('position') }}
                                <a href="{{ route('seller.employees.index', array_merge(request()->except('position'), ['page' => 1])) }}"
                                    class="close">&times;</a>
                            </div>
                        @endif
                    </div>
                @endif
            </form>
        </div>

        <!-- Employees Table -->
        <div class="table-container">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Position</th>
                            <th>Permissions</th>
                            <th>Status</th>
                            <th>Password</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($employees as $employee)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                                                style="width: 40px; height: 40px;">
                                                {{ strtoupper(substr($employee->name, 0, 1)) }}
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            {{ $employee->name }}
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $employee->email }}</td>
                                <td>{{ $employee->position }}</td>
                                <td>
                                    @foreach($employee->permissions ?? [] as $permission)
                                        <span
                                            class="badge bg-info me-1 mb-1">{{ str_replace('_', ' ', ucfirst($permission)) }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <span class="badge {{ $employee->is_active ? 'bg-success' : 'bg-danger' }}">
                                        {{ $employee->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="password-container">
                                        <span class="password-text"
                                            style="display: none;">{{ $employee->visible_password }}</span>
                                        <span class="password-dots">••••••••</span>
                                        <button class="btn btn-outline-secondary btn-sm toggle-password" type="button">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <button type="button" class="btn btn-sm btn-info"
                                            onclick="editEmployee({{ $employee->id }})" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-warning"
                                            onclick="resetPassword({{ $employee->id }})" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Reset Password">
                                            <i class="fas fa-key"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-danger"
                                            onclick="deleteEmployee({{ $employee->id }})" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">
                                    <div class="empty-state">
                                        <i class="fas fa-users-slash"></i>
                                        <h4>No employees found</h4>
                                        <p>Try adjusting your search or filter to find what you're looking for.</p>
                                        <a href="{{ route('seller.employees.index') }}" class="btn btn-primary mt-2">
                                            <i class="fas fa-refresh me-2"></i>Reset Filters
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        @if($employees->hasPages())
            <div class="d-flex justify-content-between align-items-center p-3 border-top">
                <div class="text-muted">
                    Showing {{ $employees->firstItem() }} to {{ $employees->lastItem() }} of {{ $employees->total() }}
                    entries
                </div>
                <div>
                    {{ $employees->links() }}
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

                // Modal password toggle
                $('#togglePassword').click(function () {
                    const passwordInput = $(this).closest('.input-group').find('input');
                    const icon = $(this).find('i');

                    if (passwordInput.attr('type') === 'password') {
                        passwordInput.attr('type', 'text');
                        icon.removeClass('fa-eye').addClass('fa-eye-slash');
                    } else {
                        passwordInput.attr('type', 'password');
                        icon.removeClass('fa-eye-slash').addClass('fa-eye');
                    }
                });

                // Reset form and errors when modal is closed
                $('#addEmployeeModal').on('hidden.bs.modal', function () {
                    $('#addEmployeeForm')[0].reset();
                    $('#addErrorAlert').hide();
                    $('.is-invalid').removeClass('is-invalid');
                });

                $('#editEmployeeModal').on('hidden.bs.modal', function () {
                    $('#editErrorAlert').hide();
                    $('.is-invalid').removeClass('is-invalid');
                });

                // Add Employee Form Submission
                $('#addEmployeeForm').on('submit', function (e) {
                    e.preventDefault();
                    $('#addErrorAlert').hide();
                    $('.is-invalid').removeClass('is-invalid');

                    let formData = new FormData(this);
                    if (!formData.has('permissions[]')) {
                        formData.append('permissions[]', []);
                    }

                    $.ajax({
                        url: '{{ route("seller.employees.store") }}',
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            if (response.success) {
                                $('#addEmployeeModal').modal('hide');
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
                        },
                        error: function (xhr) {
                            if (xhr.status === 422) {
                                let errors = xhr.responseJSON.errors;
                                let errorMessage = '<ul class="mb-0">';

                                Object.keys(errors).forEach(function (key) {
                                    let fieldName = key.replace('[]', '');
                                    $(`[name="${key}"]`).addClass('is-invalid');
                                    $(`#${fieldName}-error`).text(errors[key][0]);
                                    errorMessage += `<li>${errors[key][0]}</li>`;
                                });

                                errorMessage += '</ul>';
                                $('#addErrorAlert').html(errorMessage).show();
                            } else {
                                let errorMessage = xhr.responseJSON?.message || 'An error occurred while adding the employee. Please try again.';
                                $('#addErrorAlert').html(errorMessage).show();
                            }
                        }
                    });
                });

                // Edit Employee Form Submission
                $('#editEmployeeForm').on('submit', function (e) {
                    e.preventDefault();
                    $('#editErrorAlert').hide();
                    $('.is-invalid').removeClass('is-invalid');

                    let employeeId = $('#edit_employee_id').val();
                    let formData = new FormData(this);

                    if (!formData.has('is_active')) {
                        formData.append('is_active', '0');
                    }

                    $.ajax({
                        url: `/seller/employees/${employeeId}`,
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            if (response.success) {
                                $('#editEmployeeModal').modal('hide');
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
                        },
                        error: function (xhr) {
                            if (xhr.status === 422) {
                                let errors = xhr.responseJSON.errors;
                                let errorMessage = '<ul class="mb-0">';

                                Object.keys(errors).forEach(function (key) {
                                    $(`[name="${key}"]`).addClass('is-invalid');
                                    $(`#edit-${key}-error`).text(errors[key][0]);
                                    errorMessage += `<li>${errors[key][0]}</li>`;
                                });

                                errorMessage += '</ul>';
                                $('#editErrorAlert').html(errorMessage).show();
                            } else {
                                $('#editErrorAlert').html('An error occurred while updating the employee. Please try again.').show();
                            }
                        }
                    });
                });
            });

            function editEmployee(id) {
                $('#editErrorAlert').hide();
                $('.is-invalid').removeClass('is-invalid');

                $.get(`/seller/employees/getEmployee/${id}`, function (employee) {
                    $('#edit_employee_id').val(employee.id);
                    $('#edit_name').val(employee.name);
                    $('#edit_position').val(employee.position);
                    $('#edit_is_active').prop('checked', employee.is_active);

                    $('input[name="permissions[]"]').prop('checked', false);
                    employee.permissions.forEach(function (permission) {
                        $(`#edit_perm_${permission}`).prop('checked', true);
                    });

                    $('#editEmployeeModal').modal('show');
                });
            }

            function resetPassword(id) {
                Swal.fire({
                    title: 'Reset Password?',
                    text: 'A new password will be generated and sent to the employee\'s email.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, reset it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.post(`/seller/employees/${id}/reset-password`, {
                            _token: '{{ csrf_token() }}'
                        }, function (response) {
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: response.message,
                                    timer: 2000,
                                    showConfirmButton: false
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

            function deleteEmployee(id) {
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
                            url: `/seller/employees/${id}`,
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
                                    text: 'An error occurred while deleting the employee. Please try again.'
                                });
                            }
                        });
                    }
                });
            }
        </script>
    @endpush
@endsection
