@extends('Employees.layout.app')

@section('content')
    <style>
        :root {
            --primary: #2c3e50;
            --secondary: #3498db;
            --accent: #e74c3c;
            --light: #ecf0f1;
            --dark: #2c3e50;
            --success: #2ecc71;
            --warning: #f39c12;
            --danger: #e74c3c;
            --gray: #95a5a6;
            --white: #ffffff;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --border-radius: 8px;
        }

        .container {
            min-height: 100vh;
        }

        .logo {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .logo i {
            font-size: 24px;
            margin-right: 10px;
            color: var(--secondary);
        }

        .logo h1 {
            font-size: 20px;
            font-weight: 600;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            margin-bottom: 5px;
            border-radius: var(--border-radius);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .menu-item:hover,
        .menu-item.active {
            background: rgba(255, 255, 255, 0.1);
        }

        .menu-item i {
            margin-right: 10px;
            font-size: 18px;
        }

        /* Main Content Styles */
        .employee-main-content {
            grid-column: 2;
            padding: 20px 30px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--light);
        }

        .header h2 {
            font-weight: 600;
            color: var(--dark);
        }

        .user-info {
            display: flex;
            align-items: center;
        }

        .user-info img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
            object-fit: cover;
        }

        /* Dashboard Cards */
        .stats-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background: var(--white);
            border-radius: var(--border-radius);
            padding: 20px;
            box-shadow: var(--shadow);
        }

        .stat-card {
            display: flex;
            align-items: center;
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 24px;
        }

        .assigned .stat-icon {
            background: rgba(52, 152, 219, 0.2);
            color: var(--secondary);
        }

        .delivered .stat-icon {
            background: rgba(46, 204, 113, 0.2);
            color: var(--success);
        }

        .today .stat-icon {
            background: rgba(155, 89, 182, 0.2);
            color: #9b59b6;
        }

        .pending .stat-icon {
            background: rgba(243, 156, 18, 0.2);
            color: var(--warning);
        }

        .stat-info h3 {
            font-size: 24px;
            margin-bottom: 5px;
        }

        .stat-info p {
            color: var(--gray);
            font-size: 14px;
        }

        /* Filter Section */
        .filters {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 10px 20px;
            background: var(--white);
            border: 1px solid var(--light);
            border-radius: var(--border-radius);
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .filter-btn.active,
        .filter-btn:hover {
            background: var(--secondary);
            color: var(--white);
            border-color: var(--secondary);
        }

        /* Delivery Cards */
        .deliveries-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 20px;
        }

        .delivery-card {
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .delivery-card:hover {
            transform: translateY(-5px);
        }

        .card-top {
            padding: 20px;
            border-bottom: 1px solid var(--light);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .order-id {
            font-weight: bold;
            color: var(--primary);
        }

        .delivery-status {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        .status-assigned {
            background: rgba(52, 152, 219, 0.2);
            color: var(--secondary);
        }

        .status-delivered {
            background: rgba(46, 204, 113, 0.2);
            color: var(--success);
        }

        .card-details {
            margin-bottom: 15px;
        }

        .detail-item {
            display: flex;
            margin-bottom: 10px;
        }

        .detail-item i {
            width: 20px;
            color: var(--secondary);
            margin-right: 10px;
        }

        .detail-item span {
            flex: 1;
        }

        .card-bottom {
            padding: 15px 20px;
            background: #f9fafb;
            display: flex;
            justify-content: space-between;
        }

        /* Action Buttons */
        .employee-action-btn {
            padding: 8px 15px;
            border: none;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .btn-primary {
            background: var(--secondary);
            color: var(--white);
        }

        .btn-primary:hover {
            background: #2980b9;
        }

        .btn-success {
            background: var(--success);
            color: var(--white);
        }

        .btn-success:hover {
            background: #27ae60;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }

        .modal-content {
            background: var(--white);
            border-radius: var(--border-radius);
            width: 500px;
            max-width: 90%;
            box-shadow: var(--shadow);
            overflow: hidden;
            max-height: 90vh;
            overflow-y: auto;
        }

        .modal-header {
            padding: 20px;
            border-bottom: 1px solid var(--light);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h3 {
            font-weight: 600;
        }

        .close {
            font-size: 24px;
            cursor: pointer;
            color: var(--gray);
        }

        .modal-body {
            padding: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px 15px;
            border: 1px solid var(--light);
            border-radius: var(--border-radius);
            outline: none;
            transition: border 0.3s ease;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: var(--secondary);
        }

        .upload-area {
            border: 2px dashed var(--light);
            border-radius: var(--border-radius);
            padding: 30px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 15px;
        }

        .upload-area:hover {
            border-color: var(--secondary);
        }

        .upload-area i {
            font-size: 48px;
            color: var(--gray);
            margin-bottom: 15px;
        }

        .upload-area p {
            color: var(--gray);
            margin-bottom: 10px;
        }

        .upload-preview {
            margin-top: 15px;
            display: none;
            text-align: center;
        }

        .upload-preview img {
            max-width: 100%;
            max-height: 200px;
            border-radius: var(--border-radius);
        }

        .modal-footer {
            padding: 20px;
            border-top: 1px solid var(--light);
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        /* Responsive Styles */
        @media (max-width: 992px) {
            .container {
                grid-template-columns: 1fr;
            }

            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }

            .employee-main-content {
                grid-column: 1;
            }

            .stats-cards,
            .deliveries-container {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .filters {
                flex-direction: column;
            }

            .card-bottom {
                flex-direction: column;
                gap: 10px;
            }

            .employee-action-btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>

    <div class="container">
        <!-- Main Content -->
        <div class="employee-main-content">
            <div class="header">
                <h2>Assigned Deliveries</h2>
                <div class="user-info">
                    <img src="https://ui-avatars.com/api/?name=Delivery+Driver&background=3498db&color=fff" alt="User">
                    <span>Michael Johnson, Delivery Driver</span>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="stats-cards">
                <div class="card stat-card assigned">
                    <div class="stat-icon">
                        <i class="fas fa-box"></i>
                    </div>
                    <div class="stat-info">
                        <h3>8</h3>
                        <p>Assigned Deliveries</p>
                    </div>
                </div>

                <div class="card stat-card delivered">
                    <div class="stat-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-info">
                        <h3>12</h3>
                        <p>Delivered Today</p>
                    </div>
                </div>

                <div class="card stat-card today">
                    <div class="stat-icon">
                        <i class="fas fa-calendar-day"></i>
                    </div>
                    <div class="stat-info">
                        <h3>5</h3>
                        <p>Scheduled for Today</p>
                    </div>
                </div>

                <div class="card stat-card pending">
                    <div class="stat-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-info">
                        <h3>3</h3>
                        <p>Pending Verification</p>
                    </div>
                </div>
            </div>

            <!-- Filters -->
            <div class="filters">
                <div class="filter-btn active">
                    <i class="fas fa-list"></i> All Deliveries
                </div>
                <div class="filter-btn">
                    <i class="fas fa-box"></i> Assigned
                </div>
                <div class="filter-btn">
                    <i class="fas fa-check-circle"></i> Delivered
                </div>
                <div class="filter-btn">
                    <i class="fas fa-calendar-day"></i> Today's Deliveries
                </div>
                <div class="filter-btn">
                    <i class="fas fa-map-marker-alt"></i> Delivery Route
                </div>
            </div>

            <!-- Delivery Cards -->
            <div class="deliveries-container">
                @foreach ($orders as $order)
                    <div class="delivery-card">
                        <div class="card-top">
                            <div class="card-header">
                                <span class="order-id">#ORD-{{ $order->id }}</span>
                                <span
                                    class="delivery-status {{ 'status-' . strtolower(str_replace(' ', '-', $order->status)) }}">{{ $order->status }}</span>
                            </div>

                            <div class="card-details">
                                <div class="detail-item">
                                    <i class="fas fa-user"></i>
                                    <span>{{ $order->customer->name ?? 'N/A' }}</span>
                                </div>
                                <div class="detail-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>{{ $order->customer->address ?? 'No address' }}</span>
                                </div>
                                <div class="detail-item">
                                    <i class="fas fa-box"></i>
                                    <span>{{ $order->products->first()->name ?? 'N/A' }}</span>
                                </div>
                                <div class="detail-item">
                                    <i class="fas fa-file-invoice"></i>
                                    <span>Invoice: #INV-{{ $order->id }}-{{ now()->year }}</span>
                                </div>
                                <div class="detail-item">
                                    <i class="fas fa-phone"></i>
                                    <span>{{ $order->customer->phone ?? '(N/A)' }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="card-bottom">
                            <button class="employee-action-btn btn-primary"
                                onclick="openModal('detailsModal', {{ json_encode($order) }})">
                                <i class="fas fa-info-circle"></i> Details
                            </button>
                            @if ($order->status === 'assigned')
                                <button type="button" class="employee-action-btn btn-success btn-open-delivery"
                                    data-order='{{ json_encode($order) }}'>
                                    <i class="fas fa-check"></i> Mark Delivered
                                </button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Delivery Modal -->
    <div class="modal" id="deliveryModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Mark as Delivered</h3>
                <span class="close" onclick="closeModal('deliveryModal')">&times;</span>
            </div>
            <form id="deliveryForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="order_id" id="deliveryOrderId">
                <div class="modal-body">
                    <div id="deliveryAlert" class="alert" style="display: none;"></div>

                    <div class="form-group">
                        <label for="displayOrderId">Order ID</label>
                        <input type="text" id="displayOrderId" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                        <label for="customerName">Customer Name</label>
                        <input type="text" id="customerName" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                        <label for="deliveryDate">Delivery Date</label>
                        <input type="date" id="deliveryDate" name="delivery_date" class="form-control" required>
                        <div class="invalid-feedback">Please select a delivery date</div>
                    </div>

                    <div class="form-group">
                        <label for="deliveryTime">Delivery Time</label>
                        <input type="time" id="deliveryTime" name="delivery_time" class="form-control" required>
                        <div class="invalid-feedback">Please select a delivery time</div>
                    </div>

                    <div class="form-group">
                        <label>Upload Proof of Delivery</label>
                        <div class="upload-area" onclick="document.getElementById('proofUpload').click()">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <p>Click to upload signature or photo</p>
                            <span class="upload-text">Max file size: 5MB</span>
                            <input type="file" id="proofUpload" name="proof_file" accept="image/*"
                                style="display: none;" onchange="previewImage(this)">
                        </div>
                        <div class="upload-preview" id="uploadPreview">
                            <img id="previewImage" src="" alt="Preview">
                            <button class="employee-action-btn" type="button" onclick="removeImage()">Remove
                                Image</button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="deliveryNotes">Delivery Notes</label>
                        <textarea id="deliveryNotes" name="delivery_notes" rows="3" class="form-control"
                            placeholder="Add any notes about the delivery..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="employee-action-btn"
                        onclick="closeModal('deliveryModal')">Cancel</button>
                    <button type="submit" class="employee-action-btn btn-success" id="confirmDeliveryBtn">
                        <i class="fas fa-check"></i> Confirm Delivery
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Details Modal -->
    <div class="modal" id="detailsModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Delivery Details</h3>
                <span class="close" onclick="closeModal('detailsModal')">&times;</span>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Order ID</label>
                    <span id="detailOrderId" class="detail-value"></span>
                </div>

                <div class="form-group">
                    <label>Customer</label>
                    <span id="detailCustomer" class="detail-value"></span>
                </div>

                <div class="form-group">
                    <label>Delivery Address</label>
                    <span id="detailAddress" class="detail-value"></span>
                </div>

                <div class="form-group">
                    <label>Contact Number</label>
                    <span id="detailPhone" class="detail-value"></span>
                </div>

                <div class="form-group">
                    <label>Product Details</label>
                    <span id="detailProduct" class="detail-value"></span>
                </div>

                <div class="form-group">
                    <label>Special Instructions</label>
                    <span id="detailInstructions" class="detail-value"></span>
                </div>

                <div class="form-group">
                    <label>Invoice Details</label>
                    <span id="detailInvoice" class="detail-value"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button class="employee-action-btn" onclick="closeModal('detailsModal')">Close</button>
                <button class="employee-action-btn btn-primary" onclick="openDirections()">
                    <i class="fas fa-map-marked-alt"></i> Open in Maps
                </button>
            </div>
        </div>
    </div>

    <style>
        .form-control {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-top: 5px;
        }

        .alert {
            padding: 10px 15px;
            border-radius: 4px;
            margin-bottom: 15px;
            display: none;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .is-invalid {
            border-color: #dc3545 !important;
        }

        .invalid-feedback {
            color: #dc3545;
            font-size: 0.875em;
            margin-top: 5px;
            display: none;
        }

        .is-invalid+.invalid-feedback {
            display: block;
        }
    </style>

    <script>
        // Ensure jQuery is loaded
        if (typeof jQuery === 'undefined') {
            console.error('jQuery is required but not loaded. Loading it now...');
            const script = document.createElement('script');
            script.src = 'https://code.jquery.com/jquery-3.6.0.min.js';
            script.onload = function() {
                console.log('jQuery loaded successfully');
                initializeScripts();
            };
            script.onerror = function() {
                console.error('Failed to load jQuery');
            };
            document.head.appendChild(script);
        } else {
            initializeScripts();
        }

        function initializeScripts() {
            // CSRF Token for AJAX requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Global modal functions
            window.openModal = function(modalId, orderData) {
    const modal = document.getElementById(modalId);
    if (!modal) {
        console.error('Modal not found:', modalId);
        return;
    }

    let order;
    try {
        order = typeof orderData === 'string' ? JSON.parse(orderData) : orderData;
    } catch (e) {
        console.error('Error parsing order data:', e);
        return;
    }

    // Populate fields like you already do
    if (modalId === 'deliveryModal' && order) {
        const $form = $('#deliveryForm');
        $form[0].reset();
        $form.find('#deliveryAlert').hide().removeClass('alert-success alert-danger').text('');
        $form.find('.is-invalid').removeClass('is-invalid');
        $form.find('input[name="order_id"]').val(order.id);
        $form.find('#displayOrderId').val(`#ORD-${order.id}`);
        $form.find('#customerName').val(order.customer?.name || 'N/A');

        const now = new Date();
        $('#deliveryDate').val(now.toISOString().substr(0, 10));
        $('#deliveryTime').val(now.toTimeString().substr(0, 5));
        $('#deliveryNotes').val('');
        $('#uploadPreview').hide();
        $('#proofUpload').val('');
    }

    if (modalId === 'detailsModal' && order) {
        $('#detailOrderId').text(`#ORD-${order.id}`);
        $('#detailCustomer').text(order.customer?.name || 'N/A');
        $('#detailAddress').text(order.customer?.address || 'No address');
        $('#detailPhone').text(order.customer?.phone || '(N/A)');
        $('#detailProduct').text(order.products?.[0]?.name || 'N/A');
        $('#detailInstructions').text(order.special_instructions || 'None');
        $('#detailInvoice').text(`#INV-${order.id}-${new Date().getFullYear()}`);
    }

    // 👇 THIS LINE actually shows the modal
    modal.style.display = 'flex';
};


window.closeModal = function(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.style.display = 'none';
    }
};


            // Image upload preview
            function previewImage(input) {
                const preview = document.getElementById('uploadPreview');
                const previewImage = document.getElementById('previewImage');

                if (input.files && input.files[0]) {
                    if (input.files[0].size > 5 * 1024 * 1024) {
                        alert('File size exceeds 5MB limit');
                        input.value = '';
                        return;
                    }
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                        preview.style.display = 'block';
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }

            function removeImage() {
                document.getElementById('proofUpload').value = '';
                document.getElementById('uploadPreview').style.display = 'none';
            }

            // Open directions in maps
            function openDirections() {
                alert('Opening directions in maps app...');
                closeModal('detailsModal');
            }

            // Handle delivery form submission
            $('#deliveryForm').on('submit', function(e) {
                e.preventDefault();

                const form = $(this);
                const submitBtn = $('#confirmDeliveryBtn');
                const alertBox = $('#deliveryAlert');

                // Reset previous states
                $('.is-invalid').removeClass('is-invalid');
                alertBox.hide().removeClass('alert-success alert-danger').text('');

                // Validation
                const deliveryDate = $('#deliveryDate').val();
                const deliveryTime = $('#deliveryTime').val();
                if (!deliveryDate || !deliveryTime) {
                    if (!deliveryDate) $('#deliveryDate').addClass('is-invalid');
                    if (!deliveryTime) $('#deliveryTime').addClass('is-invalid');
                    alertBox.addClass('alert-danger').text('Please fill in all required fields').fadeIn();
                    return;
                }

                // Show loading state
                const originalBtnText = submitBtn.html();
                submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Processing...');

                // Prepare form data
                const formData = new FormData(this);

                // Send AJAX request
                $.ajax({
                    url: '{{ route("seller.employees.delivery-person.orders.mark-delivered") }}',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            alertBox.addClass('alert-success').text(response.message || 'Delivery marked successfully!').fadeIn();
                            setTimeout(() => {
                                closeModal('deliveryModal');
                                location.reload();
                            }, 1500);
                        } else {
                            alertBox.addClass('alert-danger').text(response.message || 'Failed to mark delivery').fadeIn();
                            submitBtn.prop('disabled', false).html(originalBtnText);
                        }
                    },
                    error: function(xhr) {
                        const response = xhr.responseJSON || {};
                        if (xhr.status === 422 && response.errors) {
                            Object.entries(response.errors).forEach(([field, messages]) => {
                                const input = $(`[name="${field}"]`);
                                input.addClass('is-invalid');
                                input.next('.invalid-feedback').text(messages[0]);
                            });
                            alertBox.addClass('alert-danger').text('Please fix the errors in the form').fadeIn();
                        } else {
                            alertBox.addClass('alert-danger').text(response.message || 'An error occurred').fadeIn();
                        }
                        submitBtn.prop('disabled', false).html(originalBtnText);
                    }
                });
            });

            // Initialize event listeners
            $(document).on('click', '.btn-open-delivery', function(e) {
                e.preventDefault();
                try {
                    const orderData = $(this).data('order');
                    const order = typeof orderData === 'string' ? JSON.parse(orderData) : orderData;
                    if (order) {
                        openModal('deliveryModal', order);
                    } else {
                        console.error('Invalid order data:', orderData);
                    }
                } catch (error) {
                    console.error('Error opening delivery modal:', error);
                }
            });

            // Close modal when clicking outside
            $(document).on('click', '.modal', function(e) {
                if (e.target === this) {
                    $(this).hide();
                }
            });

            // Close modal when clicking close button
            $('.close').on('click', function() {
                $(this).closest('.modal').hide();
            });

            // Filter buttons functionality
            $('.filter-btn').on('click', function() {
                $('.filter-btn').removeClass('active');
                $(this).addClass('active');
            });

            // Image preview
            $('#proofUpload').on('change', function() {
                previewImage(this);
            });
        }
    </script>
@endsection