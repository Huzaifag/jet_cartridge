<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Invoices - GlobalTradeHub</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
        :root {
            --primary: #3a77ff;
            --secondary: #ff6b01;
            --light-bg: #f8f9fa;
            --dark-text: #2d333a;
            --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            --gradient-primary: linear-gradient(135deg, #3a77ff 0%, #2a5dff 100%);
        }

        body {
            background-color: #f8f9fa;
            color: var(--dark-text);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .invoices-container {
            max-width: 1200px;
            margin: 2rem auto;
        }

        .page-title {
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: var(--dark-text);
        }

        .card {
            background: #ffffff;
            border: none;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            margin-bottom: 1.5rem;
        }

        .card-header {
            background: white;
            border-bottom: 1px solid #e9ecef;
            padding: 1rem 1.5rem;
            font-weight: 600;
            color: var(--dark-text);
        }

        .card-body {
            padding: 1.5rem;
        }

        .invoice-card {
            border-left: 4px solid var(--primary);
            transition: all 0.3s;
            margin-bottom: 1rem;
        }

        .invoice-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .invoice-card.overdue {
            border-left: 4px solid #dc3545;
        }

        .invoice-card.paid {
            border-left: 4px solid #28a745;
        }

        .invoice-status {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-paid {
            background-color: #d4edda;
            color: #155724;
        }

        .status-overdue {
            background-color: #f8d7da;
            color: #721c24;
        }

        .invoice-amount {
            font-weight: 600;
            font-size: 1.2rem;
            color: var(--dark-text);
        }

        .invoice-date {
            color: #6c757d;
            font-size: 0.9rem;
        }

        .seller-info {
            display: flex;
            align-items: center;
            margin-bottom: 0.5rem;
        }

        .seller-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 10px;
        }

        .filter-section {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: var(--card-shadow);
            margin-bottom: 1.5rem;
        }

        .stats-card {
            text-align: center;
            padding: 1.5rem;
            border-radius: 12px;
            background: white;
            box-shadow: var(--card-shadow);
        }

        .stats-number {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary);
        }

        .stats-label {
            color: #6c757d;
            font-size: 0.9rem;
        }

        .btn-download {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            color: var(--dark-text);
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 0.9rem;
        }

        .btn-download:hover {
            background: #e9ecef;
        }

        .btn-pay {
            background: var(--primary);
            color: white;
            border: none;
            padding: 6px 16px;
            border-radius: 6px;
            font-weight: 500;
        }

        .btn-pay:hover {
            background: #2a5dff;
        }

        .invoice-details {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 1.5rem;
            margin-top: 1.5rem;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #e9ecef;
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-label {
            color: #6c757d;
        }

        .detail-value {
            font-weight: 500;
        }

        .table-items {
            width: 100%;
            border-collapse: collapse;
        }

        .table-items th {
            background: #f8f9fa;
            padding: 12px;
            text-align: left;
            font-weight: 600;
            color: #495057;
        }

        .table-items td {
            padding: 12px;
            border-bottom: 1px solid #e9ecef;
        }

        .modal-content {
            border-radius: 12px;
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        @media (max-width: 768px) {
            .seller-info {
                margin-bottom: 1rem;
            }

            .invoice-actions {
                margin-top: 1rem;
            }
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    @include('components.header')

    <!-- Main Content -->
    <div class="container invoices-container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="page-title">My Invoices</h1>
            <button class="btn btn-primary">
                <i class="fas fa-download me-1"></i> Export All
            </button>
        </div>

        <!-- Stats Overview -->
        <div class="row mb-4">
            <div class="col-md-3 mb-3">
                <div class="stats-card">
                    <div class="stats-number">5</div>
                    <div class="stats-label">Total Invoices</div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="stats-card">
                    <div class="stats-number">$2,458.75</div>
                    <div class="stats-label">Total Amount</div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="stats-card">
                    <div class="stats-number">2</div>
                    <div class="stats-label">Pending Payment</div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="stats-card">
                    <div class="stats-number">1</div>
                    <div class="stats-label">Overdue</div>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="filter-section">
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label class="form-label">Status</label>
                    <select class="form-select">
                        <option value="">All Statuses</option>
                        <option value="pending">Pending</option>
                        <option value="paid">Paid</option>
                        <option value="overdue">Overdue</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Date From</label>
                    <input type="date" class="form-control">
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Date To</label>
                    <input type="date" class="form-control">
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Seller</label>
                    <select class="form-select">
                        <option value="">All Sellers</option>
                        <option value="1">AudioTech Manufacturers</option>
                        <option value="2">TechGadgets Inc.</option>
                        <option value="3">HomeEssentials Ltd.</option>
                    </select>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button class="btn btn-outline-secondary me-2">
                    <i class="fas fa-times me-1"></i> Reset
                </button>
                <button class="btn btn-primary">
                    <i class="fas fa-filter me-1"></i> Apply Filters
                </button>
            </div>
        </div>

        <!-- Invoices List -->
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <span>Recent Invoices</span>
                    <span class="text-muted">Showing 5 of 5 invoices</span>
                </div>
            </div>
            <div class="card-body p-0">
                @forelse ($invoices as $invoice)
                    <div class="card invoice-card m-3">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-4">
                                    <div class="seller-info">
                                        <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80"
                                            alt="Seller" class="seller-avatar">
                                        <div>
                                            <div class="fw-bold">
                                                {{ $invoice->order->seller->company_name }}
                                            </div>
                                            <div class="invoice-date">
                                                Invoice
                                                #INV-{{ $invoice->created_at->format('Y-m') }}-{{ sprintf('%04d', $invoice->id) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="invoice-date">Issued: {{ $invoice->created_at->format('Y-m') }}</div>
                                    <div class="invoice-date">Due:
                                        {{ $invoice->created_at->copy()->addDays(15)->format('Y-m-d') }}</div>
                                </div>
                                <div class="col-md-2">
                                    <div class="invoice-amount">${{ $invoice->order->total }}</div>
                                </div>
                                <div class="col-md-2">
                                    <span class="invoice-status status-pending"> {{ $invoice->order->status }} </span>
                                </div>
                                <div class="col-md-2 invoice-actions">
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('invoice.download', $invoice->id) }}" class="btn btn-download"
                                            data-bs-toggle="tooltip" title="Download Invoice">
                                            <i class="fas fa-download"></i>
                                        </a>
                                       @if ($invoice->order->status == 'pending')
    <button
        class="btn btn-pay"
        data-bs-toggle="modal"
        data-bs-target="#paymentModal"
        data-id="{{ $invoice->id }}"
        data-seller="{{ $invoice->order->seller->company_name }}"
        data-created="{{ $invoice->created_at->format('M d, Y') }}"
        data-due="{{ $invoice->created_at->copy()->addDays(15)->format('M d, Y') }}"
        data-amount="{{ $invoice->order->total }}">
        Pay Now
    </button>
@else
    <button class="btn btn-pay" disabled>
        Paid
    </button>
@endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-info">No invoices found</p>
                @endforelse

            </div>
        </div>

        <!-- Pagination -->
        <nav aria-label="Invoice pagination">
            <ul class="pagination justify-content-center mt-4">
                <li class="page-item disabled">
                    <a class="page-link" href="#">Previous</a>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Payment Modal -->
    <div class="modal fade" id="paymentModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pay Invoice <span id="modalInvoiceNumber"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="invoice-details">
                                <h6 class="mb-3">Invoice Details</h6>
                                <div class="detail-row">
                                    <span class="detail-label">Seller:</span>
                                    <span class="detail-value" id="modalSeller"></span>
                                </div>
                                <div class="detail-row">
                                    <span class="detail-label">Issue Date:</span>
                                    <span class="detail-value" id="modalCreated"></span>
                                </div>
                                <div class="detail-row">
                                    <span class="detail-label">Due Date:</span>
                                    <span class="detail-value" id="modalDue"></span>
                                </div>
                                <div class="detail-row">
                                    <span class="detail-label">Amount Due:</span>
                                    <span class="detail-value" id="modalAmount"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6 class="mb-3">Payment Method</h6>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="radio" name="paymentMethod" id="creditCard"
                                    checked>
                                <label class="form-check-label" for="creditCard">
                                    Credit/Debit Card
                                </label>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="radio" name="paymentMethod" id="paypal">
                                <label class="form-check-label" for="paypal">
                                    PayPal
                                </label>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="radio" name="paymentMethod"
                                    id="bankTransfer">
                                <label class="form-check-label" for="bankTransfer">
                                    Bank Transfer
                                </label>
                            </div>
                            <a id="confirmPaymentBtn" href="#" class="btn btn-primary">
                                Confirm Payment
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    @include('components.footer')
    <!-- Bootstrap & jQuery JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });

            // Filter functionality (simplified)
            $('.filter-section button').click(function() {
                alert('Filters applied!');
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#paymentModal').on('show.bs.modal', function(event) {
                let button = $(event.relatedTarget);

                let id = button.data('id');
                let seller = button.data('seller');
                let created = button.data('created');
                let due = button.data('due');
                let amount = button.data('amount');

                // Update modal content
                $('#modalInvoiceNumber').text(`#INV-${id.toString().padStart(4, '0')}`);
                $('#modalSeller').text(seller);
                $('#modalCreated').text(created);
                $('#modalDue').text(due);
                $('#modalAmount').text(`$${amount}`);

                // Store invoice ID for AJAX request
                $('#confirmPaymentBtn').data('id', id);
            });

            $('#confirmPaymentBtn').on('click', function(e) {
                e.preventDefault();

                let invoiceId = $(this).data('id');
                let paymentMethod = $('input[name="paymentMethod"]:checked').attr('id');

                $.ajax({
                    url: "{{ route('invoice.pay', ':id') }}".replace(':id', invoiceId),
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        payment_method: paymentMethod
                    },
                    success: function(response) {
                        // Close modal
                        $('#paymentModal').modal('hide');

                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Payment Successful',
                                text: response.success,
                                showConfirmButton: false,
                                timer: 2000
                            }).then(() => {
                                location.reload();
                            });
                        }
                    },
                    error: function(xhr) {
                        let errorMsg = xhr.responseJSON?.message ||
                            'An error occurred while processing payment';
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: errorMsg,
                        });
                    }
                });

            });
        });
    </script>
</body>

</html>
