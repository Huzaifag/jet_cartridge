<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} - Seller Dashboard</title>

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Custom CSS -->
    @include('seller.assets.css')
    @stack('styles')
</head>

<body>
    <!-- Overlay for Mobile -->
    <div class="overlay"></div>

    @include('seller.component.sidebar')

    @include('seller.component.navbar')

    <!-- Main Content -->
    <div class="main-content">
        <div class="content-wrapper animate-fadeIn">
            @yield('content')
        </div>
    </div>


    <!-- Add Employee Modal -->
    <div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="addEmployeeForm">
                    @csrf
                    <div class="modal-body">
                        <div class="alert alert-danger" style="display: none;" id="addErrorAlert"></div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" required>
                                    <div class="invalid-feedback" id="name-error"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="email" required>
                                    <div class="invalid-feedback" id="email-error"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Password <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" name="password" required
                                            minlength="8">
                                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    <div class="invalid-feedback" id="password-error"></div>
                                    <small class="form-text text-muted">Password must be at least 8 characters
                                        long</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Position <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="position" required>
                                    <div class="invalid-feedback" id="position-error"></div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Permissions</label>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="permissions[]"
                                            value="manage_products" id="perm_products">
                                        <label class="form-check-label" for="perm_products">Product Management</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="permissions[]"
                                            value="manage_orders" id="perm_orders">
                                        <label class="form-check-label" for="perm_orders">Order Management</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="permissions[]"
                                            value="view_analytics" id="perm_analytics">
                                        <label class="form-check-label" for="perm_analytics">Analytics</label>
                                    </div>
                                </div>
                            </div>
                            <div class="invalid-feedback" id="permissions-error"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Add Employee
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Employee Modal -->
    <div class="modal fade" id="editEmployeeModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="editEmployeeForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="employee_id" id="edit_employee_id">
                    <div class="modal-body">
                        <div class="alert alert-danger" style="display: none;" id="editErrorAlert"></div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" id="edit_name" required>
                                    <div class="invalid-feedback" id="edit-name-error"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Position <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="position" id="edit_position" required>
                                    <div class="invalid-feedback" id="edit-position-error"></div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_active" id="edit_is_active"
                                    value="1">
                                <label class="form-check-label" for="edit_is_active">Active Employee</label>
                            </div>
                            <div class="invalid-feedback" id="edit-is_active-error"></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Permissions</label>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="permissions[]"
                                            value="manage_products" id="edit_perm_manage_products">
                                        <label class="form-check-label" for="edit_perm_manage_products">Product
                                            Management</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="permissions[]"
                                            value="manage_orders" id="edit_perm_manage_orders">
                                        <label class="form-check-label" for="edit_perm_manage_orders">Order
                                            Management</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="permissions[]"
                                            value="view_analytics" id="edit_perm_view_analytics">
                                        <label class="form-check-label" for="edit_perm_view_analytics">Analytics</label>
                                    </div>
                                </div>
                            </div>
                            <div class="invalid-feedback" id="edit-permissions-error"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Update Employee
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- jQuery -->
    <script src="{{ asset('js/jquery-3.7.1.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Custom JS -->
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Mobile sidebar toggle
        document.getElementById('sidebarToggle').addEventListener('click', function () {
            document.querySelector('.sidebar').classList.toggle('show');
            document.querySelector('.overlay').classList.toggle('show');
        });

        // Close sidebar when clicking overlay
        document.querySelector('.overlay').addEventListener('click', function () {
            document.querySelector('.sidebar').classList.remove('show');
            this.classList.remove('show');
        });

        // Setup AJAX CSRF token
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Add animation to cards on page load
        document.addEventListener('DOMContentLoaded', function () {
            const cards = document.querySelectorAll('.card');
            cards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
            });

            // Filter button functionality
            document.querySelectorAll('.filter-btn').forEach(button => {
                button.addEventListener('click', function () {
                    document.querySelectorAll('.filter-btn').forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');
                    // Here you would typically reload data based on the selected range
                });
            });
        });
    </script>
    @stack('scripts')
</body>

</html>
