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
            display: grid;
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
            grid-column: 1;
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

        .pending .stat-icon {
            background: rgba(243, 156, 18, 0.2);
            color: var(--warning);
        }

        .production .stat-icon {
            background: rgba(52, 152, 219, 0.2);
            color: var(--secondary);
        }

        .ready .stat-icon {
            background: rgba(46, 204, 113, 0.2);
            color: var(--success);
        }

        .shipped .stat-icon {
            background: rgba(155, 89, 182, 0.2);
            color: #9b59b6;
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

        /* Table Styles */
        .table-container {
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            overflow: hidden;
            margin-bottom: 30px;
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            border-bottom: 1px solid var(--light);
        }

        .table-header h3 {
            font-weight: 600;
        }

        .search-box {
            display: flex;
            align-items: center;
            background: #f5f7fa;
            padding: 8px 15px;
            border-radius: 20px;
        }

        .search-box input {
            border: none;
            background: transparent;
            outline: none;
            margin-left: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #f5f7fa;
        }

        th,
        td {
            padding: 15px 20px;
            text-align: left;
            border-bottom: 1px solid var(--light);
        }

        th {
            font-weight: 600;
            color: var(--dark);
        }

        tbody tr {
            transition: background 0.3s ease;
        }

        tbody tr:hover {
            background: #f9fafb;
        }

        .status {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        .status-pending {
            background: rgba(243, 156, 18, 0.2);
            color: var(--warning);
        }

        .status-production {
            background: rgba(52, 152, 219, 0.2);
            color: var(--secondary);
        }

        .status-ready {
            background: rgba(46, 204, 113, 0.2);
            color: var(--success);
        }

        .status-shipped {
            background: rgba(155, 89, 182, 0.2);
            color: #9b59b6;
        }

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

        .btn-warning {
            background: var(--warning);
            color: var(--white);
        }

        .btn-warning:hover {
            background: #e67e22;
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

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
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

            .stats-cards {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }

            .table-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .search-box {
                margin-top: 10px;
                width: 100%;
            }

            .filters {
                flex-direction: column;
            }
        }

        /* Additional Styles for Form and Alerts */
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

        .is-invalid + .invalid-feedback {
            display: block;
        }
    </style>

    <div class="container">
        <!-- Main Content -->
        <div class="employee-main-content">
            <div class="header">
                <h2>Custom Orders Production</h2>
                <div class="user-info">
                    <img src="https://ui-avatars.com/api/?name=Warehouse+Manager&background=3498db&color=fff" alt="User">
                    <span>Warehouse Manager</span>
                </div>
            </div>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Stats Cards -->
            <div class="stats-cards">
                <div class="card stat-card pending">
                    <div class="stat-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-info">
                        <h3>8</h3>
                        <p>Pending Production</p>
                    </div>
                </div>

                <div class="card stat-card production">
                    <div class="stat-icon">
                        <i class="fas fa-cogs"></i>
                    </div>
                    <div class="stat-info">
                        <h3>5</h3>
                        <p>In Production</p>
                    </div>
                </div>

                <div class="card stat-card ready">
                    <div class="stat-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-info">
                        <h3>3</h3>
                        <p>Ready for Shipping</p>
                    </div>
                </div>

                <div class="card stat-card shipped">
                    <div class="stat-icon">
                        <i class="fas fa-shipping-fast"></i>
                    </div>
                    <div class="stat-info">
                        <h3>12</h3>
                        <p>Shipped This Week</p>
                    </div>
                </div>
            </div>

            <!-- Filters -->
            <div class="filters">
                <div class="filter-btn active">
                    <i class="fas fa-list"></i> All Orders
                </div>
                <div class="filter-btn">
                    <i class="fas fa-clock"></i> Pending
                </div>
                <div class="filter-btn">
                    <i class="fas fa-cogs"></i> In Production
                </div>
                <div class="filter-btn">
                    <i class="fas fa-check-circle"></i> Ready
                </div>
                <div class="filter-btn">
                    <i class="fas fa-truck"></i> Assigned for Delivery
                </div>
            </div>

            <!-- Orders Table -->
            <div class="table-container">
                <div class="table-header">
                    <h3>Confirmed & Paid Orders</h3>
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Search orders...">
                    </div>
                </div>
                <div class="table-responsive" style="overflow-y: auto; max-width: 900px;">
                    <table>
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Product</th>
                                <th>Value</th>
                                <th>Payment Status</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>#ORD-{{$order->id}}</td>
                                    <td>{{$order->customer->name ?? 'N/A'}}</td>
                                    <td>
                                        @foreach ($order->products as $product)
                                            {{$product->name}} 
                                        @endforeach
                                    </td>
                                    <td>${{$order->total ?? 0}}</td>
                                    <td><span class="status status-{{strtolower(str_replace(' ', '-', $order->payment_status))}}">{{$order->payment_status}}</span></td>
                                    <td><span class="status status-{{strtolower(str_replace(' ', '-', $order->status))}}">{{$order->status}}</span></td>
                                    <td>
                                        @if($order->status == 'pending')
                                            <button type="button" class="employee-action-btn btn-primary" onclick="openModal('productionModal_{{ $order->id }}', {{ json_encode($order) }});">
                                                <i class="fas fa-play"></i> Start Production
                                            </button>
                                        @elseif($order->status == 'production')
                                            <button class="employee-action-btn btn-warning" onclick="openModal('deliveryModal', {{ json_encode($order) }})">
                                                <i class="fas fa-truck"></i> Assign for Delivery
                                            </button>
                                        @elseif($order->status == 'assigned')
                                            <span class="status">Assigned to {{ $order->deliveryPerson->name }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @foreach ($orders as $order)
            <!-- Start Production Modal -->
        <div class="modal" id="productionModal_{{$order->id}}">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Start Production</h3>
                    <span class="close" onclick="closeModal('productionModal_{{$order->id}}')">&times;</span>
                </div>
                <form id="productionForm" action="{{ route('warehouse.orders.start-production', $order->id) }}" method="POST">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="order_id" id="orderId">
                    <div class="modal-body">
                        <div id="productionAlert" class="alert" style="display: none;"></div>
                        
                        <div class="form-group">
                            <label for="displayOrderId">Order ID</label>
                            <input type="text" id="displayOrderId" class="form-control" readonly>
                        </div>

                        <div class="form-group">
                            <label for="productName">Product</label>
                            <input type="text" id="productName" class="form-control" readonly>
                        </div>

                        <div class="form-group">
                            <label for="estimatedTime">Estimated Production Time (days) *</label>
                            <input type="number" id="estimatedTime" name="estimated_time" class="form-control" value="5" min="1" required>
                            <div class="invalid-feedback">Please provide estimated time</div>
                        </div>

                        <div class="form-group">
                            <label for="productionNotes">Production Notes</label>
                            <textarea id="productionNotes" name="notes" rows="3" class="form-control" placeholder="Add any notes for production..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="employee-action-btn" onclick="closeModal('productionModal_{{$order->id}}')">
                            <i class="fas fa-times"></i> Cancel
                        </button>
                        <button type="submit" class="employee-action-btn btn-primary" id="startProductionBtn">
                            <i class="fas fa-play-circle"></i> Start Production
                        </button>
                    </div>
                </form>
            </div>
        </div>
        @endforeach

        <!-- Mark as Ready Modal -->
        <div class="modal" id="notesModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Mark Order as Ready</h3>
                    <span class="close" onclick="closeModal('notesModal')">&times;</span>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="readyOrderId">Order ID</label>
                        <input type="text" id="readyOrderId" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                        <label for="completionDate">Completion Date</label>
                        <input type="date" id="completionDate" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="materialsUsed">Materials Used</label>
                        <textarea id="materialsUsed" rows="3" class="form-control" placeholder="List materials used in production..."></textarea>
                    </div>

                    <div class="form-group">
                        <label for="finalNotes">Final Notes</label>
                        <textarea id="finalNotes" rows="3" class="form-control" placeholder="Add any final notes..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="employee-action-btn" onclick="closeModal('notesModal')">Cancel</button>
                    <button class="employee-action-btn btn-success" onclick="saveReadyStatus()">Mark as Ready</button>
                </div>
            </div>
        </div>

        <!-- Assign Delivery Modal -->
        <div class="modal" id="deliveryModal">
            <form action="{{ route('seller.employees.warehouse.orders.assign-delivery') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h3>Assign to Delivery</h3>
                        <span class="close" onclick="closeModal('deliveryModal')">&times;</span>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="deliveryOrderId">Order ID</label>
                            <input type="text" name="deliveryOrderId" id="deliveryOrderId" class="form-control" readonly>
                        </div>

                        <div class="form-group">
                            <label for="customerInfo">Customer</label>
                            <input type="text" name="customerInfo" id="customerInfo" class="form-control" readonly>
                        </div>

                        <div class="form-group">
                            <label for="deliveryAddress">Delivery Address</label>
                            <textarea id="deliveryAddress" rows="2" class="form-control" readonly></textarea>
                        </div>

                        <div class="form-group">
                            <label for="deliveryPerson">Assign Delivery Person</label>
                            <select name="deliveryPerson" id="deliveryPerson" class="form-control">
                                <option value="">Select delivery person</option>
                                @foreach ($deliveryPersons as $deliveryPerson)
                                    <option value="{{ $deliveryPerson->id }}">{{ $deliveryPerson->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="deliveryNotes">Delivery Notes</label>
                            <textarea name="deliveryNotes" id="deliveryNotes" rows="2" class="form-control" placeholder="Add any notes for delivery..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="employee-action-btn" onclick="closeModal('deliveryModal')">Cancel</button>
                        <button class="employee-action-btn btn-warning" type="submit">Assign Delivery</button>
                    </div>
                </div>
            </form>
        </div>

        <script>
            // CSRF Token for AJAX requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Handle production form submission
            $(document).on('submit', 'form[id^="productionForm"]', function(e) {
                e.preventDefault();
                
                const form = $(this);
                const submitBtn = form.find('button[type="submit"]');
                const alertBox = form.find('.alert');
                const modalId = form.closest('.modal').attr('id');
                
                // Reset previous states
                form.find('.is-invalid').removeClass('is-invalid');
                alertBox.hide().removeClass('alert-success alert-danger').text('');
                
                // Show loading state
                const originalBtnText = submitBtn.html();
                submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Processing...');
                
                // Get form data
                const formData = new FormData(this);
                
                // Send AJAX request
                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            alertBox.addClass('alert-success').text(response.message || 'Production started successfully!').fadeIn();
                            setTimeout(() => {
                                closeModal(modalId);
                                location.reload();
                            }, 1500);
                        } else {
                            alertBox.addClass('alert-danger').text(response.message || 'Failed to start production').fadeIn();
                            submitBtn.prop('disabled', false).html(originalBtnText);
                        }
                    },
                    error: function(xhr) {
                        const response = xhr.responseJSON || {};
                        if (xhr.status === 422 && response.errors) {
                            Object.entries(response.errors).forEach(([field, messages]) => {
                                const input = form.find(`[name="${field}"]`);
                                input.addClass('is-invalid');
                                input.next('.invalid-feedback').text(messages[0]);
                            });
                            alertBox.addClass('alert-danger').text('Please fix the errors in the form').fadeIn();
                        } else {
                            const errorMessage = xhr.status === 0 ? 'Network error. Please check your connection.' : 
                                (response.message || 'An error occurred');
                            alertBox.addClass('alert-danger').text(errorMessage).fadeIn();
                        }
                        submitBtn.prop('disabled', false).html(originalBtnText);
                    }
                });
            });

            // Save Ready Status
            function saveReadyStatus() {
                const orderId = $('#readyOrderId').val().replace('#ORD-', '');
                const completionDate = $('#completionDate').val();
                const materialsUsed = $('#materialsUsed').val();
                const finalNotes = $('#finalNotes').val();

                if (!completionDate) {
                    alert('Please select a completion date');
                    return;
                }

                $.ajax({
                    url: `/seller/employees/warehouse/orders/${orderId}/mark-ready`,
                    type: 'POST',
                    data: {
                        order_id: orderId,
                        completion_date: completionDate,
                        materials_used: materialsUsed,
                        final_notes: finalNotes
                    },
                    success: function(response) {
                        if (response.success) {
                            alert('Order marked as ready!');
                            closeModal('notesModal');
                            location.reload();
                        } else {
                            alert(response.message || 'Failed to mark as ready');
                        }
                    },
                    error: function(xhr) {
                        alert(xhr.responseJSON?.message || 'An error occurred');
                    }
                });
            }

            // Assign Delivery
            function assignDelivery() {
                const orderId = $('#deliveryOrderId').val().replace('#ORD-', '');
                const deliveryPerson = $('#deliveryPerson').val();
                const deliveryNotes = $('#deliveryNotes').val();

                if (!deliveryPerson) {
                    alert('Please select a delivery person');
                    return;
                }

                // Show loading state
                const btn = $('.btn-warning', '#deliveryModal');
                const originalBtnText = btn.html();
                btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Assigning...');

                $.ajax({
                    url: `/seller/employees/warehouse/orders/${orderId}/assign-delivery`,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        delivery_person: deliveryPerson,
                        delivery_notes: deliveryNotes
                    },
                    success: function(response) {
                        if (response.success) {
                            alertBox = $('#deliveryAlert').removeClass('alert-danger').addClass('alert-success')
                                .text('Delivery assigned successfully!').fadeIn();
                            setTimeout(() => {
                                closeModal('deliveryModal');
                                location.reload();
                            }, 1500);
                        } else {
                            alertBox = $('#deliveryAlert').removeClass('alert-success').addClass('alert-danger')
                                .text(response.message || 'Failed to assign delivery').fadeIn();
                            btn.prop('disabled', false).html(originalBtnText);
                        }
                    },
                    error: function(xhr) {
                        alert(xhr.responseJSON?.message || 'An error occurred');
                    }
                });
            }

            // Modal functions
            function openModal(modalId, order) {
                const modal = document.getElementById(modalId);
                modal.style.display = 'flex';

                if (modalId.startsWith('productionModal_') && order) {
                    const form = modal.querySelector('form');
                    form.reset();
                    
                    const alertBox = modal.querySelector('.alert');
                    if (alertBox) {
                        alertBox.style.display = 'none';
                        alertBox.className = 'alert';
                        alertBox.textContent = '';
                    }
                    
                    // Update form fields
                    form.querySelector('[name="order_id"]').value = order.id;
                    form.querySelector('#displayOrderId').value = `#ORD-${order.id}`;
                    
                    const productName = order.products ? 
                        order.products.map(p => p.name).join(', ') : 'N/A';
                    form.querySelector('#productName').value = productName;
                    
                    form.querySelector('#estimatedTime').value = 5;
                    form.querySelector('#productionNotes').value = '';
                    $('#startProductionBtn').prop('disabled', false).html('<i class="fas fa-play-circle"></i> Start Production');
                }

                if (modalId === 'notesModal' && order) {
                    $('#readyOrderId').val(`#ORD-${order.id}`);
                    const today = new Date();
                    const formattedDate = today.toISOString().substr(0, 10);
                    $('#completionDate').val(formattedDate);
                    $('#materialsUsed').val('');
                    $('#finalNotes').val('');
                }

                if (modalId === 'deliveryModal' && order) {
                    $('#deliveryOrderId').val(`#ORD-${order.id}`);
                    $('#customerInfo').val(order.customer?.name || 'N/A');
                    $('#deliveryAddress').val(order.customer?.address || 'No address provided');
                    $('#deliveryPerson').val('');
                    $('#deliveryNotes').val('');
                }
            }

            function closeModal(modalId) {
                document.getElementById(modalId).style.display = 'none';
            }

            // Close modal when clicking outside of it
            window.onclick = function(event) {
                const modals = document.getElementsByClassName('modal');
                for (let i = 0; i < modals.length; i++) {
                    if (event.target == modals[i]) {
                        modals[i].style.display = 'none';
                    }
                }
            }

            // Filter buttons functionality
            const filterButtons = document.querySelectorAll('.filter-btn');
            filterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    filterButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');
                });
            });
        </script>
    @endsection