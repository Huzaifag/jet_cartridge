@extends('Employees.layout.app')

@section('content')
    <style>
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Header Styles */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--light);
        }

        .header h1 {
            font-weight: 600;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .header h1 i {
            color: var(--secondary);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-info img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        /* Tabs Styles */
        .tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .tab-button {
            padding: 10px 20px;
            border: none;
            border-radius: var(--border-radius) var(--border-radius) 0 0;
            cursor: pointer;
            background: var(--light);
            color: var(--dark);
            font-weight: 500;
        }

        .tab-button.active {
            background: var(--white);
            box-shadow: var(--shadow);
            color: var(--primary);
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        /* Form and Preview Styles */
        .form-section,
        .preview-section {
            background: var(--white);
            border-radius: var(--border-radius);
            padding: 25px;
            box-shadow: var(--shadow);
        }

        .section-title {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--light);
            color: var(--primary);
        }

        .section-title i {
            color: var(--secondary);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--dark);
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px 15px;
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

        @media (max-width: 576px) {
            .form-row {
                grid-template-columns: 1fr;
            }
        }

        /* Item Table Styles */
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .items-table th,
        .items-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid var(--light);
        }

        .items-table th {
            background: #f5f7fa;
            font-weight: 600;
        }

        .items-table input {
            width: 100%;
            padding: 8px 10px;
            border: 1px solid var(--light);
            border-radius: 4px;
        }

        .add-item-btn {
            background: var(--secondary);
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: var(--border-radius);
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 5px;
            margin-top: 10px;
        }

        .add-item-btn:hover {
            background: #2980b9;
        }

        .delete-btn {
            color: var(--danger);
            cursor: pointer;
            font-size: 18px;
        }

        /* Calculation Section */
        .calculations {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid var(--light);
        }

        .calc-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .calc-row.total {
            font-weight: bold;
            font-size: 1.2em;
            margin-top: 10px;
            padding-top: 10px;
            border-top: 2px solid var(--light);
        }

        /* Preview Section */
        .invoice-preview {
            background: white;
            border: 1px solid var(--light);
            border-radius: var(--border-radius);
            padding: 30px;
            margin-top: 20px;
        }

        .invoice-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .invoice-id {
            font-size: 1.5em;
            font-weight: bold;
            color: var(--primary);
        }

        .invoice-date {
            color: var(--gray);
        }

        .invoice-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }

        .invoice-to,
        .invoice-from {
            padding: 15px;
            background: #f9f9f9;
            border-radius: var(--border-radius);
        }

        .invoice-to h3,
        .invoice-from h3 {
            margin-bottom: 10px;
            color: var(--primary);
        }

        .preview-items {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .preview-items th,
        .preview-items td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid var(--light);
        }

        .preview-items th {
            background: #f5f7fa;
            font-weight: 600;
        }

        .preview-total {
            margin-top: 20px;
            text-align: right;
        }

        .preview-total .calc-row {
            justify-content: flex-end;
            gap: 20px;
            width: 100%;
            max-width: 300px;
            margin-left: auto;
        }

        .preview-notes {
            margin-top: 30px;
            padding: 15px;
            background: #f9f9f9;
            border-radius: var(--border-radius);
        }

        /* Action Buttons */
        .employee-action-buttons {
            display: flex;
            gap: 15px;
            margin-top: 30px;
            flex-direction: column;
            text-align: center;
        }

        .btn {
            padding: 12px 20px;
            border: none;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
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

        .btn-light {
            background: var(--light);
            color: var(--dark);
        }

        .btn-light:hover {
            background: #dde4e6;
        }

        /* Toggle Switch */
        .toggle-container {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 24px;
        }

        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 24px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked+.slider {
            background-color: var(--success);
        }

        input:checked+.slider:before {
            transform: translateX(26px);
        }
    </style>
    </head>

    <body>
        <div class="container">
            <!-- Header -->
            <div class="header">
                <h1><i class="fas fa-file-invoice-dollar"></i> Invoice Generator</h1>
                <div class="user-info">
                    <img src="https://ui-avatars.com/api/?name=Accountant+User&background=3498db&color=fff" alt="User">
                    <span>Accountant User</span>
                </div>
            </div>

            <!-- Toggle for Auto Calculation -->
            <div class="toggle-container">
                <span>Manual Calculation</span>
                <label class="toggle-switch">
                    <input type="checkbox" id="autoCalculateToggle">
                    <span class="slider"></span>
                </label>
                <span>Auto Calculation</span>
            </div>

            <!-- Tabs -->
            <div class="tabs">
                <button class="tab-button active" data-tab="details">Invoice Details</button>
                <button class="tab-button" data-tab="preview">Invoice Preview</button>
            </div>

            <!-- Tab Content -->
            <div class="tab-content active" id="details">
                <div class="form-section">
                    <div class="section-title">
                        <i class="fas fa-edit"></i>
                        <h2>Invoice Details</h2>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="invoiceNumber">Invoice Number</label>
                            <input type="text" id="invoiceNumber" value="INV-2023-0085" readonly>
                        </div>

                        <div class="form-group">
                            <label for="invoiceDate">Invoice Date</label>
                            <input type="date" id="invoiceDate" value="<?php echo date('Y-m-d'); ?>">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="orderNumber">Order Number</label>
                            <input type="text" id="orderNumber" value="ORD-7281" readonly>
                        </div>

                        <div class="form-group">
                            <label for="dueDate">Due Date</label>
                            <input type="date" id="dueDate" value="2023-11-30">
                        </div>
                    </div>

                    <div class="section-title" style="margin-top: 30px;">
                        <i class="fas fa-user"></i>
                        <h2>Customer Information</h2>
                    </div>

                    <div class="form-group">
                        <label for="customerName">Customer Name</label>
                        <input type="text" id="customerName" value="{{ $order->customer->name }}">
                    </div>

                    <div class="form-group">
                        <label for="customerEmail">Customer Email</label>
                        <input type="email" id="customerEmail" value="{{ $order->customer->email }}">
                    </div>

                    <div class="form-group">
                        <label for="customerAddress">Customer Address</label>
                        <textarea id="customerAddress" rows="3">123 Main Street, Apt 4B\nNew York, NY 10001</textarea>
                    </div>

                    <div class="section-title" style="margin-top: 30px;">
                        <i class="fas fa-box"></i>
                        <h2>Items & Pricing</h2>
                    </div>

                    <div class="table-responsive">
                        <table class="items-table">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <form id="orderItemsForm" data-order-id="{{ $order->id }}">
                                @csrf
                                <tbody id="itemsTableBody">
                                    @foreach ($order->orderItems as $item)
                                        <tr>
                                            <td>
                                                <select name="product_names[]" class="form-control product-select">
                                                    @foreach ($products as $product)
                                                        <option value="{{ $product->id }}"
                                                            {{ $product->id == $item->product_id ? 'selected' : '' }}>
                                                            {{ $product->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><input type="number" name="quantities[]" value="{{ $item->quantity }}"
                                                    class="form-control quantity" min="1"></td>
                                            <td><input type="number" name="prices[]" value="{{ $item->price }}"
                                                    class="form-control price" step="0.01" min="0"></td>
                                            <td class="item-total">{{ $item->quantity * $item->price }}</td>
                                            <td><i class="fas fa-trash delete-btn" style="cursor: pointer;"></i></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="5">
                                            <button type="submit" class="add-item-btn">
                                                <i class="fas fa-save"></i> Save
                                            </button>
                                            <div id="saveMessage" class="mt-2"></div>
                                        </td>
                                    </tr>
                                </tfoot>
                            </form>
                        </table>
                    </div>

                    <button class="add-item-btn" id="addItemBtn">
                        <i class="fas fa-plus"></i> Add Item
                    </button>

                    <div class="calculations">
                        <div class="calc-row">
                            <span>Subtotal:</span>
                            <span id="subtotal">{{ $order->total }}</span>
                        </div>
                        <div class="calc-row">
                            <span>Tax (10%):</span>
                            <span id="taxAmount">{{ $order->total * 0.1 }}</span>
                        </div>
                        <div class="calc-row">
                            <span>Discount:</span>
                            <span id="discount">{{ $order->discount }}</span>
                        </div>
                        <div class="calc-row total">
                            <span>Total:</span>
                            <span id="totalAmount">{{ $order->total }}</span>
                        </div>
                    </div>

                    <div class="form-group" style="margin-top: 20px;">
                        <label for="notes">Notes</label>
                        <textarea id="notes" rows="3" placeholder="Add any notes for the invoice...">Thank you for your business! Payment is due within 15 days.</textarea>
                    </div>
                </div>
            </div>

            <div class="tab-content" id="preview">
                <div class="preview-section">
                    <div class="section-title">
                        <i class="fas fa-eye"></i>
                        <h2>Invoice Preview</h2>
                    </div>

                    <div class="invoice-preview">
                        <div class="invoice-header">
                            <div class="invoice-id">INV-2023-0085</div>
                            <div class="invoice-date">Nov 15, 2023</div>
                        </div>

                        <div class="invoice-details">
                            <div class="invoice-from">
                                <h3>From:</h3>
                                <p>Smith Crafts<br>123 Artisan Street<br>Portland, OR 97205<br>USA</p>
                            </div>

                            <div class="invoice-to">
                                <h3>To:</h3>
                                <p id="previewCustomer">John Davidson<br>123 Main Street, Apt 4B<br>New York, NY 10001</p>
                            </div>
                        </div>

                        <table class="preview-items">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody id="previewItems">
                                <tr>
                                    <td>Custom Wooden Desk</td>
                                    <td>1</td>
                                    <td>$199.99</td>
                                    <td>$199.99</td>
                                </tr>
                                <tr>
                                    <td>Assembly Service</td>
                                    <td>1</td>
                                    <td>$45.00</td>
                                    <td>$45.00</td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="preview-total">
                            <div class="calc-row">
                                <span>Subtotal:</span>
                                <span id="previewSubtotal">$244.99</span>
                            </div>
                            <div class="calc-row">
                                <span>Tax (10%):</span>
                                <span id="previewTax">$24.50</span>
                            </div>
                            <div class="calc-row">
                                <span>Discount:</span>
                                <span id="previewDiscount">$0.00</span>
                            </div>
                            <div class="calc-row total">
                                <span>Total:</span>
                                <span id="previewTotal">$269.49</span>
                            </div>
                        </div>

                        <div class="preview-notes">
                            <h3>Notes:</h3>
                            <p id="previewNotes">Thank you for your business! Payment is due within 15 days.</p>
                        </div>
                    </div>

                    <div class="employee-action-buttons">
                        <button class="btn btn-light">
                            <i class="fas fa-download"></i> Download PDF
                        </button>
                        @if($order->orderInvoice == 'pending' && $order->orderInvoice->customer_id)
                            <div class="text-center mt-2 text-danger font-weight-bold">Please wait for customer to accept the invoice</div>
                        @elseif($order->orderInvoice && $order->orderInvoice->status == 'paid')
                            <button class="btn btn-success" disabled>
                                <i class="fas fa-truck"></i> Sent to Warehouse
                            </button>
                        @else
                            <form id="sendInvoiceForm" action="{{ route('seller.employees.orders.send-invoice', $order->id) }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="order_id" value="{{ $order->id }}">
                                <input type="hidden" name="amount" value="{{ $order->total }}">
                                <input type="hidden" name="status" value="pending">
                                <input type="hidden" name="accountant_id" value="{{ auth('employee')->id() }}">
                                <input type="hidden" name="customer_id" value="{{ $order->customer_id }}">
                                
                                <button type="submit" class="btn btn-primary" id="sendInvoiceBtn">
                                    <i class="fas fa-paper-plane"></i> Send to Customer
                                </button>
                                <div id="sendInvoiceStatus" class="mt-2"></div>
                            </form>
                            
                            <script>
                                document.getElementById('sendInvoiceForm').addEventListener('submit', function(e) {
                                    e.preventDefault();
                                    
                                    const form = this;
                                    const submitBtn = form.querySelector('button[type="submit"]');
                                    const statusDiv = document.getElementById('sendInvoiceStatus');
                                    
                                    submitBtn.disabled = true;
                                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
                                    statusDiv.innerHTML = '';
                                    
                                    fetch(form.action, {
                                        method: 'POST',
                                        headers: {
                                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                            'Accept': 'application/json',
                                            'X-Requested-With': 'XMLHttpRequest'
                                        },
                                        body: new FormData(form)
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.success) {
                                            statusDiv.innerHTML = '<div class="alert alert-success">Invoice sent successfully!</div>';
                                            // Reload the page to show the updated status
                                            setTimeout(() => window.location.reload(), 1500);
                                        } else {
                                            statusDiv.innerHTML = `<div class="alert alert-danger">${data.message || 'Failed to send invoice'}</div>`;
                                            submitBtn.disabled = false;
                                            submitBtn.innerHTML = '<i class="fas fa-paper-plane"></i> Send to Customer';
                                        }
                                    })
                                    .catch(error => {
                                        console.error('Error:', error);
                                        statusDiv.innerHTML = '<div class="alert alert-danger">An error occurred. Please try again.</div>';
                                        submitBtn.disabled = false;
                                        submitBtn.innerHTML = '<i class="fas fa-paper-plane"></i> Send to Customer';
                                    });
                                });
                            </script>
                        @endif
                        <button class="btn btn-success">
                            <i class="fas fa-check"></i> Save Invoice
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Elements
                const products = @json($products);
                const autoCalculateToggle = document.getElementById('autoCalculateToggle');
                const itemsTableBody = document.getElementById('itemsTableBody');
                const addItemBtn = document.getElementById('addItemBtn');
                const tabButtons = document.querySelectorAll('.tab-button');
                const tabContents = document.querySelectorAll('.tab-content');
                const orderItemsForm = document.getElementById('orderItemsForm');
                const saveMessage = document.getElementById('saveMessage');
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                // Tab switching
                tabButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        tabButtons.forEach(btn => btn.classList.remove('active'));
                        tabContents.forEach(content => content.classList.remove('active'));
                        this.classList.add('active');
                        document.getElementById(this.getAttribute('data-tab')).classList.add('active');
                    });
                });

                // Add item row
                addItemBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const newRow = document.createElement('tr');
                    newRow.innerHTML = `
                        <td>
                            <select name="product_names[]" class="form-control product-select">
                                ${products.map(product => 
                                    `<option value="${product.id}">${product.name}</option>`
                                ).join('')}
                            </select>
                        </td>
                        <td><input name="quantities[]" type="number" value="1" class="form-control quantity" min="1"></td>
                        <td><input name="prices[]" type="number" value="0.00" step="0.01" class="form-control price" min="0"></td>
                        <td class="item-total">$0.00</td>
                        <td><i class="fas fa-trash delete-btn" style="cursor: pointer;"></i></td>
                    `;
                    itemsTableBody.appendChild(newRow);
                    
                    // Add event listeners to new row
                    const quantityInput = newRow.querySelector('.quantity');
                    const priceInput = newRow.querySelector('.price');
                    
                    quantityInput.addEventListener('input', calculateTotals);
                    priceInput.addEventListener('input', calculateTotals);
                    
                    newRow.querySelector('.delete-btn').addEventListener('click', function() {
                        itemsTableBody.removeChild(newRow);
                        calculateTotals();
                    });
                    
                    calculateTotals();
                });

                // Form submission
                orderItemsForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const orderId = this.dataset.orderId;
                    const formData = new FormData();
                    
                    // Manually collect all form data
                    document.querySelectorAll('#itemsTableBody tr').forEach((row, index) => {
                        const productSelect = row.querySelector('.product-select');
                        const quantity = row.querySelector('.quantity').value;
                        const price = row.querySelector('.price').value;
                        
                        formData.append(`product_names[${index}]`, productSelect.value);
                        formData.append(`quantities[${index}]`, quantity);
                        formData.append(`prices[${index}]`, price);
                    });
                    
                    // Add CSRF token
                    formData.append('_token', csrfToken);
                    
                    // Show loading state
                    saveMessage.innerHTML = '<div class="alert alert-info">Saving items...</div>';
                    
                    fetch(`/seller/employees/orders/${orderId}/store-item`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            saveMessage.innerHTML = '<div class="alert alert-success">Items saved successfully!</div>';
                            // Update the order total in the UI
                            document.getElementById('subtotal').textContent = '$' + parseFloat(data.order.subtotal).toFixed(2);
                            document.getElementById('taxAmount').textContent = '$' + parseFloat(data.order.tax).toFixed(2);
                            document.getElementById('totalAmount').textContent = '$' + parseFloat(data.order.total).toFixed(2);
                            
                            // Hide success message after 3 seconds
                            setTimeout(() => {
                                saveMessage.innerHTML = '';
                            }, 3000);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        saveMessage.innerHTML = '<div class="alert alert-danger">Error saving items. Please try again.</div>';
                    });
                });

                // Initialize event listeners for existing rows
                function initRowEventListeners() {
                    document.querySelectorAll('.quantity, .price').forEach(input => {
                        input.addEventListener('input', calculateTotals);
                    });

                    document.querySelectorAll('.delete-btn').forEach(btn => {
                        btn.addEventListener('click', function() {
                            itemsTableBody.removeChild(btn.closest('tr'));
                            calculateTotals();
                        });
                    });
                }
                initRowEventListeners();

                function calculateTotals() {
                    let subtotal = 0;

                    document.querySelectorAll('#itemsTableBody tr').forEach(row => {
                        const quantity = parseFloat(row.querySelector('.quantity').value) || 0;
                        const price = parseFloat(row.querySelector('.price').value) || 0;
                        const total = quantity * price;

                        row.querySelector('.item-total').textContent = '$' + total.toFixed(2);
                        subtotal += total;
                    });

                    const taxRate = 0.1;
                    const taxAmount = subtotal * taxRate;
                    const totalAmount = subtotal + taxAmount;

                    document.getElementById('subtotal').textContent = '$' + subtotal.toFixed(2);
                    document.getElementById('taxAmount').textContent = '$' + taxAmount.toFixed(2);
                    document.getElementById('totalAmount').textContent = '$' + totalAmount.toFixed(2);

                    updatePreview(subtotal, taxAmount, totalAmount);
                }

                function updatePreview(subtotal, taxAmount, totalAmount) {
                    document.getElementById('previewSubtotal').textContent = '$' + subtotal.toFixed(2);
                    document.getElementById('previewTax').textContent = '$' + taxAmount.toFixed(2);
                    document.getElementById('previewTotal').textContent = '$' + totalAmount.toFixed(2);

                    const customerName = document.getElementById('customerName').value;
                    const customerAddress = document.getElementById('customerAddress').value;
                    document.getElementById('previewCustomer').innerHTML =
                        `${customerName}<br>${customerAddress.replace(/\n/g, '<br>')}`;

                    document.getElementById('previewNotes').textContent = document.getElementById('notes').value;

                    const previewItems = document.getElementById('previewItems');
                    previewItems.innerHTML = '';

                    document.querySelectorAll('#itemsTableBody tr').forEach(row => {
                        const productSelect = row.querySelector('.product-select');
                        const selectedOption = productSelect.options[productSelect.selectedIndex];
                        const itemName = selectedOption.text;
                        const quantity = row.querySelector('.quantity').value;
                        const price = parseFloat(row.querySelector('.price').value).toFixed(2);
                        const total = (quantity * parseFloat(price)).toFixed(2);

                        const newRow = document.createElement('tr');
                        newRow.innerHTML = `
                            <td>${itemName}</td>
                            <td>${quantity}</td>
                            <td>$${price}</td>
                            <td>$${total}</td>
                        `;
                        previewItems.appendChild(newRow);
                    });
                }

                // Initialize calculations
                calculateTotals();
                
                // Add event listeners for form fields
                document.getElementById('customerName').addEventListener('input', calculateTotals);
                document.getElementById('customerAddress').addEventListener('input', calculateTotals);
                document.getElementById('notes').addEventListener('input', calculateTotals);
            });
        </script>
        
        <!-- Add CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
    @endsection
