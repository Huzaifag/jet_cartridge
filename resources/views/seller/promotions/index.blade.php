@extends('seller.layouts.app')

@section('content')
    <style>
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
            margin-bottom: 30px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 24px;
            font-weight: 700;
            color: var(--primary);
        }

        .logo i {
            color: var(--secondary);
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: linear-gradient(45deg, var(--primary), var(--secondary));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 18px;
        }

        .page-title {
            font-size: 28px;
            font-weight: 700;
            color: var(--primary-dark);
            margin-bottom: 10px;
        }

        .page-subtitle {
            color: var(--gray);
            font-size: 16px;
            margin-bottom: 30px;
        }

        .stats-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: var(--border-radius);
            padding: 25px;
            box-shadow: var(--shadow);
            display: flex;
            align-items: center;
            transition: var(--transition);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
            font-size: 24px;
            flex-shrink: 0;
        }

        .stat-content {
            flex-grow: 1;
        }

        .stat-value {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 5px;
            color: var(--dark);
        }

        .stat-title {
            font-size: 14px;
            color: var(--gray);
            font-weight: 500;
        }

        .card {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            margin-bottom: 25px;
            transition: var(--transition);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background: white;
            border-bottom: 1px solid var(--light-gray);
            padding: 20px 25px;
            font-weight: 600;
            font-size: 18px;
            color: var(--primary-dark);
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: var(--border-radius) var(--border-radius) 0 0 !important;
        }

        .card-body {
            padding: 25px;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 30px;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            border: none;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }

        .btn-success {
            background: var(--success);
            color: white;
        }

        .btn-success:hover {
            background: #3aa5c7;
            transform: translateY(-2px);
        }

        .btn-outline {
            background: transparent;
            border: 1px solid var(--primary);
            color: var(--primary);
        }

        .btn-outline:hover {
            background: var(--primary);
            color: white;
        }

        .btn-outline-danger {
            background: transparent;
            border: 1px solid var(--danger);
            color: var(--danger);
        }

        .btn-outline-danger:hover {
            background: var(--danger);
            color: white;
        }

        .btn-sm {
            padding: 8px 16px;
            font-size: 13px;
        }

        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid var(--light-gray);
        }

        th {
            background: var(--primary-light);
            color: var(--primary-dark);
            font-weight: 600;
        }

        tr:hover {
            background: var(--light);
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        .status-active {
            background: rgba(40, 167, 69, 0.1);
            color: #28a745;
        }

        .status-draft {
            background: rgba(108, 117, 125, 0.1);
            color: #6c757d;
        }

        .status-expired {
            background: rgba(220, 53, 69, 0.1);
            color: #dc3545;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background: white;
            border-radius: var(--border-radius);
            width: 600px;
            max-width: 90%;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            padding: 20px 25px;
            border-bottom: 1px solid var(--light-gray);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-title {
            font-weight: 600;
            color: var(--primary-dark);
            font-size: 20px;
        }

        .close-modal {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: var(--gray);
        }

        .modal-body {
            padding: 25px;
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

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid var(--light-gray);
            border-radius: 8px;
            font-size: 15px;
            transition: var(--transition);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
        }

        .form-select {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid var(--light-gray);
            border-radius: 8px;
            font-size: 15px;
            background: white;
            cursor: pointer;
        }

        .form-check {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
        }

        .form-check-input {
            width: 18px;
            height: 18px;
        }

        .form-check-label {
            font-weight: 500;
        }

        .products-selector {
            border: 1px solid var(--light-gray);
            border-radius: 8px;
            padding: 15px;
            max-height: 200px;
            overflow-y: auto;
        }

        .product-checkbox {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px;
            border-bottom: 1px solid var(--light-gray);
        }

        .product-checkbox:last-child {
            border-bottom: none;
        }

        .modal-footer {
            padding: 20px 25px;
            border-top: 1px solid var(--light-gray);
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .detail-view {
            display: none;
        }

        .detail-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .back-button {
            background: none;
            border: none;
            color: var(--primary);
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .promotion-detail-card {
            background: white;
            border-radius: var(--border-radius);
            padding: 25px;
            box-shadow: var(--shadow);
            margin-bottom: 25px;
        }

        .detail-row {
            display: flex;
            margin-bottom: 15px;
        }

        .detail-label {
            width: 150px;
            font-weight: 600;
            color: var(--dark);
        }

        .detail-value {
            flex-grow: 1;
        }

        .detail-products {
            margin-top: 30px;
        }

        @media (max-width: 768px) {
            .stats-cards {
                grid-template-columns: 1fr;
            }

            .action-buttons {
                flex-direction: column;
            }

            .detail-row {
                flex-direction: column;
                margin-bottom: 20px;
            }

            .detail-label {
                width: 100%;
                margin-bottom: 5px;
            }
        }
    </style>

    <div class="container">
        <div>
            <h1 class="page-title">Promotions & Discount Campaigns</h1>
            <p class="page-subtitle">Create and manage discount campaigns to boost your sales</p>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- Stats Cards -->
        <div class="stats-cards">
            <div class="stat-card">
                <div class="stat-icon" style="background-color: rgba(67, 97, 238, 0.1); color: #4361ee;">
                    <i class="fas fa-tags"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-value">{{ $active_promotions_count ?? 5 }}</div>
                    <div class="stat-title">Active Promotions</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background-color: rgba(76, 201, 240, 0.1); color: #4cc9f0;">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-value">{{ $avg_sales_increase ?? '23%' }}</div>
                    <div class="stat-title">Avg. Sales Increase</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background-color: rgba(57, 204, 102, 0.1); color: #39cc66;">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-value">{{ $redemptions_this_month ?? 142 }}</div>
                    <div class="stat-title">Redemptions This Month</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background-color: rgba(249, 199, 79, 0.1); color: #f9c74f;">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-value">{{ $upcoming_promotions ?? 3 }}</div>
                    <div class="stat-title">Upcoming Promotions</div>
                </div>
            </div>
        </div>

        <!-- Main Content Area -->
        <div id="promotions-list">
            <div class="card">
                <div class="card-header">
                    <span>Your Promotions</span>
                    <button class="btn btn-primary" id="createPromotionBtn">
                        <i class="fas fa-plus"></i> Create New Promotion
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Discount Type</th>
                                    <th>Duration</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($promotions as $promotion)
                                    <tr>
                                        <td>{{ $promotion->title }}</td>
                                        <td>
                                            @if ($promotion->discount_type == 'percentage')
                                                Percentage ({{ $promotion->percentage_off }}% off)
                                            @elseif($promotion->discount_type == 'fixed')
                                                Fixed Amount (${{ $promotion->fixed_amount }} off)
                                            @elseif($promotion->discount_type == 'bogo')
                                                Buy {{ $promotion->buy_x }} Get {{ $promotion->get_y }}
                                                {{ $promotion->bogo_type == 'free' ? 'Free' : '% Off' }}
                                            @endif
                                        </td>
                                        <td>{{ is_string($promotion->start_date) ? $promotion->start_date : $promotion->start_date->format('M d') }}
                                            -
                                            {{ is_string($promotion->end_date) ? $promotion->end_date : $promotion->end_date->format('M d, Y') }}
                                        </td>
                                        <td><span
                                                class="status-badge status-{{ $promotion->status }}">{{ ucfirst($promotion->status) }}</span>
                                        </td>
                                        <td class="action-buttons">
                                            <button class="btn btn-outline btn-sm view-detail"
                                                data-id="{{ $promotion->id }}">View</button>
                                            <button class="btn btn-outline btn-sm edit-promotion"
                                                data-id="{{ $promotion->id }}">Edit</button>
                                                @if ($promotion->status == 'active')
                                                <form action="{{ route('seller.promotion.status', $promotion->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm">End</button>
                                                </form>
                                            @else
                                                <form action="{{ route('seller.promotions.destroy', $promotion->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Promotion Detail View -->
        <div id="promotion-detail" class="detail-view">
            <div class="detail-header">
                <button class="back-button" id="backToList">
                    <i class="fas fa-arrow-left"></i> Back to Promotions
                </button>
                <div class="action-buttons">
                    <button class="btn btn-outline btn-sm edit-promotion" id="detailEditBtn" data-id="">Edit</button>
                    <button class="btn btn-outline-danger btn-sm">End Promotion</button>
                </div>
            </div>

            <div class="promotion-detail-card">
                <h2 id="detailTitle"></h2>
                <p class="page-subtitle" id="detailDescription"></p>

                <div class="detail-row">
                    <div class="detail-label">Discount Type:</div>
                    <div class="detail-value" id="detailDiscountType"></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Status:</div>
                    <div class="detail-value"><span class="status-badge" id="detailStatus"></span></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Start Date:</div>
                    <div class="detail-value" id="detailStartDate"></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">End Date:</div>
                    <div class="detail-value" id="detailEndDate"></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Created On:</div>
                    <div class="detail-value" id="detailCreatedAt"></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Total Redemptions:</div>
                    <div class="detail-value" id="detailRedemptions"></div>
                </div>

                <div class="detail-products">
                    <h3>Products Included in This Promotion</h3>
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Original Price</th>
                                    <th>Discounted Price</th>
                                    <th>Sales</th>
                                </tr>
                            </thead>
                            <tbody id="detailProducts">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Promotion Modal (Create/Edit) -->
    <div class="modal" id="promotionModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modalTitle">Create New Promotion</h3>
                <button type="button" class="close-modal">&times;</button>
            </div>

            <form id="promotionForm" method="POST" action="{{ route('seller.promotions.store') }}">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST">
                <input type="hidden" name="id" id="promotionId">

                <div class="modal-body">
                    <div class="form-group">
                        <label for="promotionTitle">Promotion Title</label>
                        <input type="text" name="title" class="form-control" id="promotionTitle"
                            placeholder="e.g., Summer Sale" required>
                    </div>

                    <div class="form-group">
                        <label for="promotionDescription">Description (Optional)</label>
                        <textarea name="description" class="form-control" id="promotionDescription" rows="2"
                            placeholder="Describe your promotion"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="discountType">Discount Type</label>
                        <select name="discount_type" class="form-select" id="discountType" required>
                            <option value="">Select discount type</option>
                            <option value="percentage">Percentage Off</option>
                            <option value="fixed">Fixed Amount Off</option>
                            <option value="bogo">Buy X Get Y Free</option>
                        </select>
                    </div>

                    <div class="form-group" id="percentageField" style="display:none;">
                        <label for="percentageOff">Percentage Off</label>
                        <input type="number" name="percentage_off" class="form-control" id="percentageOff"
                            min="1" max="100" placeholder="e.g., 15 for 15%">
                    </div>

                    <div class="form-group" id="fixedAmountField" style="display:none;">
                        <label for="fixedAmount">Fixed Amount Off</label>
                        <input type="number" name="fixed_amount" class="form-control" id="fixedAmount" min="1"
                            placeholder="e.g., 20 for $20">
                    </div>

                    <div class="form-group" id="bogoField" style="display:none;">
                        <label for="bogoDetails">Buy X Get Y Details</label>
                        <div style="display: flex; gap: 10px;">
                            <input type="number" name="buy_x" class="form-control" id="buyX" min="1"
                                placeholder="Buy X">
                            <input type="number" name="get_y" class="form-control" id="getY" min="1"
                                placeholder="Get Y">
                            <select name="bogo_type" class="form-select" id="bogoType">
                                <option value="free">Free</option>
                                <option value="percentOff">% Off</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="startDate">Start Date</label>
                        <input type="datetime-local" name="start_date" class="form-control" id="startDate">
                    </div>
                    <div class="form-group">
                        <label for="endDate">End Date</label>
                        <input type="datetime-local" name="end_date" class="form-control" id="endDate">
                    </div>

                    <div class="form-group">
                        <label>Products to Apply On</label>
                        <div class="products-selector" id="productsSelector">
                            @foreach ($products as $product)
                                <div class="product-checkbox">
                                    <input type="checkbox" name="products[]" value="{{ $product->id }}"
                                        id="product{{ $product->id }}" class="form-check-input">
                                    <label for="product{{ $product->id }}" class="form-check-label">
                                        {{ number_format($product->price, 2) }} - {{ $product->name }}
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="promotionStatus">Status</label>
                        <select name="status" class="form-select" id="promotionStatus">
                            <option value="active">Active</option>
                            <option value="draft">Draft</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline" id="cancelPromotion">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="savePromotion">Save Promotion</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const createPromotionBtn = document.getElementById('createPromotionBtn');
            const promotionModal = document.getElementById('promotionModal');
            const closeModal = document.querySelector('.close-modal');
            const cancelPromotion = document.getElementById('cancelPromotion');
            const savePromotion = document.getElementById('savePromotion');
            const backToList = document.getElementById('backToList');
            const viewDetailButtons = document.querySelectorAll('.view-detail');
            const editPromotionButtons = document.querySelectorAll('.edit-promotion');
            const detailEditBtn = document.getElementById('detailEditBtn');
            const promotionsList = document.getElementById('promotions-list');
            const promotionDetail = document.getElementById('promotion-detail');
            const discountType = document.getElementById('discountType');
            const percentageField = document.getElementById('percentageField');
            const fixedAmountField = document.getElementById('fixedAmountField');
            const bogoField = document.getElementById('bogoField');
            const modalTitle = document.getElementById('modalTitle');

            // Initially hide discount type fields
            percentageField.style.display = 'none';
            fixedAmountField.style.display = 'none';
            bogoField.style.display = 'none';

            // Open modal for creating promotion
            createPromotionBtn.addEventListener('click', function() {
                modalTitle.textContent = 'Create New Promotion';
                document.getElementById('promotionForm').action = '{{ route('seller.promotions.store') }}';
                document.getElementById('formMethod').value = 'POST';
                document.getElementById('promotionId').value = '';
                document.getElementById('promotionTitle').value = '';
                document.getElementById('promotionDescription').value = '';
                document.getElementById('discountType').value = '';
                percentageField.style.display = 'none';
                fixedAmountField.style.display = 'none';
                bogoField.style.display = 'none';
                document.getElementById('percentageOff').value = '';
                document.getElementById('fixedAmount').value = '';
                document.getElementById('buyX').value = '';
                document.getElementById('getY').value = '';
                document.getElementById('bogoType').value = 'free';
                document.getElementById('startDate').value = '';
                document.getElementById('endDate').value = '';
                document.getElementById('promotionStatus').value = 'draft';
                document.querySelectorAll('.form-check-input').forEach(checkbox => checkbox.checked =
                false);
                promotionModal.style.display = 'flex';
            });

            editPromotionButtons.forEach(button => {
    button.addEventListener('click', function() {
        const id = this.dataset.id;
        modalTitle.textContent = 'Edit Promotion';

        // ✅ Correct action with placeholder
        document.getElementById('promotionForm').action = '/seller/promotions/' + id;

        document.getElementById('formMethod').value = 'PUT';
        document.getElementById('promotionId').value = id;

        fetch(`/seller/promotions/${id}/edit`, {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('promotionTitle').value = data.title;
            document.getElementById('promotionDescription').value = data.description;
            document.getElementById('discountType').value = data.discount_type;

            // trigger field toggling
            discountType.dispatchEvent(new Event('change'));

            if (data.discount_type === 'percentage') {
                document.getElementById('percentageOff').value = data.percentage_off;
            } else if (data.discount_type === 'fixed') {
                document.getElementById('fixedAmount').value = data.fixed_amount;
            } else if (data.discount_type === 'bogo') {
                document.getElementById('buyX').value = data.buy_x;
                document.getElementById('getY').value = data.get_y;
                document.getElementById('bogoType').value = data.bogo_type;
            }

            document.getElementById('startDate').value = data.start_date;
            document.getElementById('endDate').value = data.end_date;
            document.getElementById('promotionStatus').value = data.status;

            // ✅ Update products selector
            const productsSelector = document.getElementById('productsSelector');
            productsSelector.innerHTML = '';
            data.all_products.forEach(product => {
                const isChecked = data.selected_products.includes(product.id) ? 'checked' : '';
                productsSelector.innerHTML += `
                    <div class="product-checkbox">
                        <input type="checkbox" name="products[]" value="${product.id}"
                            id="product${product.id}" class="form-check-input" ${isChecked}>
                        <label for="product${product.id}" class="form-check-label">
                            ${product.name} - $${product.price}
                        </label>
                    </div>
                `;
            });

            promotionModal.style.display = 'flex';
        })
        .catch(error => console.error('Error fetching promotion:', error));
    });
});


            // View promotion detail
            viewDetailButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.dataset.id;
                    detailEditBtn.dataset.id = id;

                    fetch(`/seller/promotions/${id}`, {
                            method: 'GET',
                            headers: {
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            document.getElementById('detailTitle').textContent = data.title;
                            document.getElementById('detailDescription').textContent = data
                                .description;

                            let discountText = '';
                            if (data.discount_type === 'percentage') {
                                discountText = `Percentage (${data.percentage_off}% off)`;
                            } else if (data.discount_type === 'fixed') {
                                discountText = `Fixed Amount ($${data.fixed_amount} off)`;
                            } else if (data.discount_type === 'bogo') {
                                discountText =
                                    `Buy ${data.buy_x} Get ${data.get_y} ${data.bogo_type === 'free' ? 'Free' : '% Off'}`;
                            }
                            document.getElementById('detailDiscountType').textContent =
                                discountText;

                            const statusBadge = document.getElementById('detailStatus');
                            statusBadge.textContent = data.status.charAt(0).toUpperCase() + data
                                .status.slice(1);
                            statusBadge.className = `status-badge status-${data.status}`;

                            document.getElementById('detailStartDate').textContent = data
                                .start_date;
                            document.getElementById('detailEndDate').textContent = data
                            .end_date;
                            document.getElementById('detailCreatedAt').textContent = data
                                .created_at;
                            document.getElementById('detailRedemptions').textContent = data
                                .total_redemptions;

                            const tbody = document.getElementById('detailProducts');
                            tbody.innerHTML = '';
                            data.products.forEach(product => {
                                tbody.innerHTML += `
                                <tr>
                                    <td>${product.name}</td>
                                    <td>${product.original_price}</td>
                                    <td>${product.discounted_price}</td>
                                    <td>${product.sales}</td>
                                </tr>
                            `;
                            });

                            promotionsList.style.display = 'none';
                            promotionDetail.style.display = 'block';
                        })
                        .catch(error => console.error('Error fetching promotion detail:', error));
                });
            });

            // Edit from detail view
            detailEditBtn.addEventListener('click', function() {
                const id = this.dataset.id;
                modalTitle.textContent = 'Edit Promotion';
                document.getElementById('promotionForm').action = `/seller/promotions/${id}`;
                document.getElementById('formMethod').value = 'PUT';
                document.getElementById('promotionId').value = id;

                fetch(`/seller/promotions/${id}/edit`, {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('promotionTitle').value = data.title;
                        document.getElementById('promotionDescription').value = data.description;
                        document.getElementById('discountType').value = data.discount_type;
                        discountType.dispatchEvent(new Event('change'));
                        if (data.discount_type === 'percentage') {
                            document.getElementById('percentageOff').value = data.percentage_off;
                        } else if (data.discount_type === 'fixed') {
                            document.getElementById('fixedAmount').value = data.fixed_amount;
                        } else if (data.discount_type === 'bogo') {
                            document.getElementById('buyX').value = data.buy_x;
                            document.getElementById('getY').value = data.get_y;
                            document.getElementById('bogoType').value = data.bogo_type;
                        }
                        document.getElementById('startDate').value = data.start_date;
                        document.getElementById('endDate').value = data.end_date;
                        document.getElementById('promotionStatus').value = data.status;

                        const productsSelector = document.getElementById('productsSelector');
                        productsSelector.innerHTML = '';
                        data.all_products.forEach(product => {
                            const isChecked = data.selected_products.includes(product.id) ?
                                'checked' : '';
                            productsSelector.innerHTML += `
                            <div class="product-checkbox">
                                <input type="checkbox" name="products[]" value="${product.id}"
                                    id="product${product.id}" class="form-check-input" ${isChecked}>
                                <label for="product${product.id}" class="form-check-label">
                                    ${product.name} - $${product.price}
                                </label>
                            </div>
                        `;
                        });

                        promotionModal.style.display = 'flex';
                    })
                    .catch(error => console.error('Error fetching promotion:', error));
            });

            // Back to list from detail view
            backToList.addEventListener('click', function() {
                promotionDetail.style.display = 'none';
                promotionsList.style.display = 'block';
            });

            // Close modal
            function closePromotionModal() {
                promotionModal.style.display = 'none';
            }

            closeModal.addEventListener('click', closePromotionModal);
            cancelPromotion.addEventListener('click', closePromotionModal);

            // Show/hide discount type fields
            discountType.addEventListener('change', function() {
                percentageField.style.display = 'none';
                fixedAmountField.style.display = 'none';
                bogoField.style.display = 'none';

                if (this.value === 'percentage') {
                    percentageField.style.display = 'block';
                } else if (this.value === 'fixed') {
                    fixedAmountField.style.display = 'block';
                } else if (this.value === 'bogo') {
                    bogoField.style.display = 'block';
                }
            });

            // Close modal if clicked outside
            window.addEventListener('click', function(event) {
                if (event.target === promotionModal) {
                    closePromotionModal();
                }
            });
        });
    </script>
@endsection
