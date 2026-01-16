<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/remixicon/fonts/remixicon.css') }}">
    <style>
        .purchase-card {
            border-left: 4px solid #007bff;
            border-radius: 8px;
            margin-bottom: 20px;
            transition: all 0.3s;
        }

        .purchase-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .purchase-card.ordered {
            border-left-color: #007bff;
        }

        .purchase-card.received {
            border-left-color: #28a745;
        }

        .purchase-card.partial {
            border-left-color: #ffc107;
        }

        .purchase-card.cancelled {
            border-left-color: #dc3545;
        }

        .purchase-header {
            padding: 15px;
            border-bottom: 1px solid #dee2e6;
        }

        .purchase-body {
            padding: 15px;
        }

        .purchase-footer {
            padding: 10px 15px;
            background: #f8f9fa;
            border-top: 1px solid #dee2e6;
            border-radius: 0 0 8px 8px;
        }

        .status-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        .status-ordered {
            background: #d1ecf1;
            color: #0c5460;
        }

        .status-received {
            background: #d4edda;
            color: #155724;
        }

        .status-partial {
            background: #fff3cd;
            color: #856404;
        }

        .status-cancelled {
            background: #f8d7da;
            color: #721c24;
        }

        .payment-badge {
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 11px;
        }

        .payment-paid {
            background: #d4edda;
            color: #155724;
        }

        .payment-pending {
            background: #fff3cd;
            color: #856404;
        }

        .payment-partial {
            background: #ffeaa7;
            color: #856404;
        }

        .payment-overdue {
            background: #f8d7da;
            color: #721c24;
        }

        .supplier-avatar {
            width: 40px;
            height: 40px;
            border-radius: 4px;
            object-fit: cover;
        }

        .action-btn {
            width: 35px;
            height: 35px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .quick-stats {
            background: white;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            height: 100%;
        }

        .quick-stats i {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .quick-stats-value {
            font-size: 20px;
            font-weight: 600;
            margin: 5px 0;
        }

        .quick-stats-label {
            color: #6c757d;
            font-size: 13px;
        }

        .filter-tags {
            margin-bottom: 20px;
        }

        .filter-tag {
            display: inline-block;
            background: #e9ecef;
            padding: 4px 12px;
            border-radius: 20px;
            margin-right: 8px;
            margin-bottom: 8px;
            font-size: 13px;
        }

        .filter-tag i {
            cursor: pointer;
            margin-left: 5px;
        }
    </style>
    @endpush

    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
            <div>
                <h4 class="mb-3">Purchase Orders</h4>
                <p class="mb-0">Manage your purchase orders and inventory</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Purchases</li>
                    </ol>
                </nav>
            </div>
            <div>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-outline-secondary">
                        <i class="las la-file-export mr-2"></i>Export
                    </button>
                    <button type="button" class="btn btn-outline-secondary">
                        <i class="las la-print mr-2"></i>Print
                    </button>
                    <a href="{{ route('purchases.create') }}" class="btn btn-primary ml-2">
                        <i class="las la-plus mr-2"></i>New Purchase
                    </a>
                </div>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="quick-stats">
                    <i class="las la-shopping-cart text-primary"></i>
                    <div class="quick-stats-value">48</div>
                    <div class="quick-stats-label">Total Orders</div>
                    <small class="text-muted">This month: 12</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="quick-stats">
                    <i class="las la-money-bill-wave text-success"></i>
                    <div class="quick-stats-value">Rs2.85M</div>
                    <div class="quick-stats-label">Total Value</div>
                    <small class="text-muted">This month: Rs425K</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="quick-stats">
                    <i class="las la-exclamation-triangle text-warning"></i>
                    <div class="quick-stats-value">Rs185K</div>
                    <div class="quick-stats-label">Pending Payments</div>
                    <small class="text-danger">Overdue: Rs25K</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="quick-stats">
                    <i class="las la-clock text-info"></i>
                    <div class="quick-stats-value">8</div>
                    <div class="quick-stats-label">Pending Orders</div>
                    <small class="text-muted">Expected this week: 4</small>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Search</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search purchase orders...">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button">
                                        <i class="las la-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" id="statusFilter">
                                <option value="">All Status</option>
                                <option value="ordered">Ordered</option>
                                <option value="received">Received</option>
                                <option value="partial">Partially Received</option>
                                <option value="cancelled">Cancelled</option>
                                <option value="returned">Returned</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Payment Status</label>
                            <select class="form-control" id="paymentFilter">
                                <option value="">All Payments</option>
                                <option value="paid">Paid</option>
                                <option value="partial">Partial</option>
                                <option value="pending">Pending</option>
                                <option value="overdue">Overdue</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Supplier</label>
                            <select class="form-control" id="supplierFilter">
                                <option value="">All Suppliers</option>
                                <option value="1">Textile Factory Ltd.</option>
                                <option value="2">Fashion Wear Imports</option>
                                <option value="3">Local Distributors Co.</option>
                                <option value="4">Wholesale Vendors Inc.</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Branch</label>
                            <select class="form-control" id="branchFilter">
                                <option value="">All Branches</option>
                                <option value="1">Main Store</option>
                                <option value="2">South Branch</option>
                                <option value="3">Warehouse</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>From Date</label>
                            <input type="date" class="form-control" id="fromDate">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>To Date</label>
                            <input type="date" class="form-control" id="toDate">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Amount Range</label>
                            <select class="form-control" id="amountFilter">
                                <option value="">Any Amount</option>
                                <option value="0-10000">Below Rs10,000</option>
                                <option value="10000-50000">Rs10,000 - Rs50,000</option>
                                <option value="50000-100000">Rs50,000 - Rs1,00,000</option>
                                <option value="100000-500000">Rs1,00,000 - Rs5,00,000</option>
                                <option value="500000+">Above Rs5,00,000</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <div class="form-group w-100">
                            <button type="button" class="btn btn-secondary w-100" onclick="applyFilters()">
                                <i class="las la-filter mr-2"></i>Apply Filters
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Active Filters -->
                <div class="filter-tags" id="activeFilters">
                    <!-- Filters will be added here dynamically -->
                </div>

                <div class="text-right">
                    <button type="button" class="btn btn-outline-secondary" onclick="resetFilters()">
                        <i class="las la-redo mr-2"></i>Reset Filters
                    </button>
                </div>
            </div>
        </div>

        <!-- View Toggle -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-outline-secondary active">
                        <input type="radio" name="viewMode" value="grid" checked>
                        <i class="las la-th-large"></i> Grid
                    </label>
                    <label class="btn btn-outline-secondary">
                        <input type="radio" name="viewMode" value="list">
                        <i class="las la-list"></i> List
                    </label>
                </div>
            </div>
            <div>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-outline-secondary">
                        <i class="las la-sort-amount-down mr-2"></i>Sort By
                    </button>
                    <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#" onclick="sortPurchases('date', 'desc')">Date (Newest First)</a>
                        <a class="dropdown-item" href="#" onclick="sortPurchases('date', 'asc')">Date (Oldest First)</a>
                        <a class="dropdown-item" href="#" onclick="sortPurchases('amount', 'desc')">Amount (High to Low)</a>
                        <a class="dropdown-item" href="#" onclick="sortPurchases('amount', 'asc')">Amount (Low to High)</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" onclick="sortPurchases('supplier')">Supplier (A-Z)</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Purchases Grid View -->
        <div class="row" id="purchasesGridView">
            <!-- Purchase Order 1 -->
            <div class="col-md-6 col-lg-4">
                <div class="card purchase-card ordered">
                    <div class="purchase-header">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="mb-1">PO-20240001</h6>
                                <div class="small text-muted">15 Jan 2024</div>
                            </div>
                            <div>
                                <span class="status-badge status-ordered">Ordered</span>
                            </div>
                        </div>
                    </div>
                    <div class="purchase-body">
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://via.placeholder.com/40x40/007bff/ffffff?text=TF"
                                class="supplier-avatar mr-3" alt="Textile Factory">
                            <div>
                                <h6 class="mb-0">Textile Factory Ltd.</h6>
                                <small class="text-muted">John Doe</small>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-6">
                                <div class="small text-muted">Items</div>
                                <div class="font-weight-bold">12</div>
                            </div>
                            <div class="col-6">
                                <div class="small text-muted">Total Amount</div>
                                <div class="font-weight-bold">Rs125,000</div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="small text-muted">Expected Delivery</div>
                            <div class="font-weight-bold">20 Jan 2024</div>
                            <small class="text-muted">5 days remaining</small>
                        </div>

                        <div class="d-flex justify-content-between">
                            <div>
                                <span class="payment-badge payment-partial">Partial Payment</span>
                            </div>
                            <div>
                                <span class="badge badge-info">Main Store</span>
                            </div>
                        </div>
                    </div>
                    <div class="purchase-footer">
                        <div class="d-flex justify-content-between">
                            <div>
                                <small class="text-muted">Ordered by: Admin</small>
                            </div>
                            <div class="btn-group">
                                <a href="{{ route('purchases.show', 1) }}" class="btn btn-sm btn-outline-primary action-btn" title="View">
                                    <i class="las la-eye"></i>
                                </a>
                                <a href="{{ route('purchases.edit', 1) }}" class="btn btn-sm btn-outline-warning action-btn" title="Edit">
                                    <i class="las la-edit"></i>
                                </a>
                                <a href="{{ route('purchases.receive.create', 1) }}" class="btn btn-sm btn-outline-success action-btn" title="Receive">
                                    <i class="las la-check-circle"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Purchase Order 2 -->
            <div class="col-md-6 col-lg-4">
                <div class="card purchase-card received">
                    <div class="purchase-header">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="mb-1">PO-20240002</h6>
                                <div class="small text-muted">10 Jan 2024</div>
                            </div>
                            <div>
                                <span class="status-badge status-received">Received</span>
                            </div>
                        </div>
                    </div>
                    <div class="purchase-body">
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://via.placeholder.com/40x40/28a745/ffffff?text=FW"
                                class="supplier-avatar mr-3" alt="Fashion Wear">
                            <div>
                                <h6 class="mb-0">Fashion Wear Imports</h6>
                                <small class="text-muted">Sarah Smith</small>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-6">
                                <div class="small text-muted">Items</div>
                                <div class="font-weight-bold">8</div>
                            </div>
                            <div class="col-6">
                                <div class="small text-muted">Total Amount</div>
                                <div class="font-weight-bold">Rs85,000</div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="small text-muted">Received On</div>
                            <div class="font-weight-bold">12 Jan 2024</div>
                            <small class="text-success">On time</small>
                        </div>

                        <div class="d-flex justify-content-between">
                            <div>
                                <span class="payment-badge payment-paid">Paid</span>
                            </div>
                            <div>
                                <span class="badge badge-secondary">South Branch</span>
                            </div>
                        </div>
                    </div>
                    <div class="purchase-footer">
                        <div class="d-flex justify-content-between">
                            <div>
                                <small class="text-muted">Received by: Manager</small>
                            </div>
                            <div class="btn-group">
                                <a href="{{ route('purchases.show', 2) }}" class="btn btn-sm btn-outline-primary action-btn" title="View">
                                    <i class="las la-eye"></i>
                                </a>
                                <a href="{{ route('purchases.edit', 2) }}" class="btn btn-sm btn-outline-warning action-btn" title="Edit">
                                    <i class="las la-edit"></i>
                                </a>
                                <button class="btn btn-sm btn-outline-info action-btn" title="Invoice">
                                    <i class="las la-file-invoice"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Purchase Order 3 -->
            <div class="col-md-6 col-lg-4">
                <div class="card purchase-card partial">
                    <div class="purchase-header">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="mb-1">PO-20240003</h6>
                                <div class="small text-muted">05 Jan 2024</div>
                            </div>
                            <div>
                                <span class="status-badge status-partial">Partially Received</span>
                            </div>
                        </div>
                    </div>
                    <div class="purchase-body">
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://via.placeholder.com/40x40/ffc107/000000?text=LD"
                                class="supplier-avatar mr-3" alt="Local Distributor">
                            <div>
                                <h6 class="mb-0">Local Distributors Co.</h6>
                                <small class="text-muted">Mike Johnson</small>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-6">
                                <div class="small text-muted">Items</div>
                                <div class="font-weight-bold">15/20</div>
                                <div class="progress" style="height: 5px;">
                                    <div class="progress-bar bg-warning" style="width: 75%"></div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="small text-muted">Total Amount</div>
                                <div class="font-weight-bold">Rs150,000</div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="small text-muted">Next Delivery</div>
                            <div class="font-weight-bold">15 Jan 2024</div>
                            <small class="text-warning">5 items pending</small>
                        </div>

                        <div class="d-flex justify-content-between">
                            <div>
                                <span class="payment-badge payment-pending">Pending</span>
                            </div>
                            <div>
                                <span class="badge badge-info">Main Store</span>
                            </div>
                        </div>
                    </div>
                    <div class="purchase-footer">
                        <div class="d-flex justify-content-between">
                            <div>
                                <small class="text-muted">Ordered by: Admin</small>
                            </div>
                            <div class="btn-group">
                                <a href="{{ route('purchases.show', 3) }}" class="btn btn-sm btn-outline-primary action-btn" title="View">
                                    <i class="las la-eye"></i>
                                </a>
                                <a href="{{ route('purchases.receive.create', 3) }}" class="btn btn-sm btn-outline-success action-btn" title="Receive">
                                    <i class="las la-check-circle"></i>
                                </a>
                                <button class="btn btn-sm btn-outline-secondary action-btn" title="Reminder">
                                    <i class="las la-bell"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Purchase Order 4 -->
            <div class="col-md-6 col-lg-4">
                <div class="card purchase-card cancelled">
                    <div class="purchase-header">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="mb-1">PO-20240004</h6>
                                <div class="small text-muted">28 Dec 2023</div>
                            </div>
                            <div>
                                <span class="status-badge status-cancelled">Cancelled</span>
                            </div>
                        </div>
                    </div>
                    <div class="purchase-body">
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://via.placeholder.com/40x40/dc3545/ffffff?text=WV"
                                class="supplier-avatar mr-3" alt="Wholesale Vendor">
                            <div>
                                <h6 class="mb-0">Wholesale Vendors Inc.</h6>
                                <small class="text-muted">Robert Brown</small>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-6">
                                <div class="small text-muted">Items</div>
                                <div class="font-weight-bold">10</div>
                            </div>
                            <div class="col-6">
                                <div class="small text-muted">Total Amount</div>
                                <div class="font-weight-bold">Rs95,000</div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="small text-muted">Cancelled On</div>
                            <div class="font-weight-bold">30 Dec 2023</div>
                            <small class="text-danger">Supplier issue</small>
                        </div>

                        <div class="d-flex justify-content-between">
                            <div>
                                <span class="payment-badge payment-overdue">Refunded</span>
                            </div>
                            <div>
                                <span class="badge badge-warning">Warehouse</span>
                            </div>
                        </div>
                    </div>
                    <div class="purchase-footer">
                        <div class="d-flex justify-content-between">
                            <div>
                                <small class="text-muted">Cancelled by: Admin</small>
                            </div>
                            <div class="btn-group">
                                <a href="{{ route('purchases.show', 4) }}" class="btn btn-sm btn-outline-primary action-btn" title="View">
                                    <i class="las la-eye"></i>
                                </a>
                                <button class="btn btn-sm btn-outline-secondary action-btn" title="Re-order">
                                    <i class="las la-redo"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Purchases List View (Hidden by default) -->
        <div class="card d-none" id="purchasesListView">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Purchase No.</th>
                                <th>Date</th>
                                <th>Supplier</th>
                                <th>Items</th>
                                <th>Total Amount</th>
                                <th>Status</th>
                                <th>Payment</th>
                                <th>Branch</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Sample Data Row 1 -->
                            <tr>
                                <td>
                                    <strong>PO-20240001</strong>
                                    <div class="small text-muted">Expected: 20 Jan</div>
                                </td>
                                <td>15 Jan 2024</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/30x30/007bff/ffffff?text=TF"
                                            class="supplier-avatar mr-2" alt="Textile Factory">
                                        <div>
                                            <div>Textile Factory Ltd.</div>
                                            <small class="text-muted">John Doe</small>
                                        </div>
                                    </div>
                                </td>
                                <td>12 items</td>
                                <td>
                                    <strong>Rs125,000</strong>
                                    <div class="small text-muted">Paid: Rs75,000</div>
                                </td>
                                <td>
                                    <span class="status-badge status-ordered">Ordered</span>
                                </td>
                                <td>
                                    <span class="payment-badge payment-partial">Partial</span>
                                </td>
                                <td>
                                    <span class="badge badge-info">Main Store</span>
                                </td>
                                <td class="table-actions">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('purchases.show', 1) }}" class="btn btn-sm btn-outline-primary action-btn">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="{{ route('purchases.edit', 1) }}" class="btn btn-sm btn-outline-warning action-btn">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <a href="{{ route('purchases.receive.create', 1) }}" class="btn btn-sm btn-outline-success action-btn">
                                            <i class="las la-check-circle"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            <!-- Sample Data Row 2 -->
                            <tr>
                                <td>
                                    <strong>PO-20240002</strong>
                                    <div class="small text-success">Received: 12 Jan</div>
                                </td>
                                <td>10 Jan 2024</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/30x30/28a745/ffffff?text=FW"
                                            class="supplier-avatar mr-2" alt="Fashion Wear">
                                        <div>
                                            <div>Fashion Wear Imports</div>
                                            <small class="text-muted">Sarah Smith</small>
                                        </div>
                                    </div>
                                </td>
                                <td>8 items</td>
                                <td>
                                    <strong>Rs85,000</strong>
                                    <div class="small text-success">Fully paid</div>
                                </td>
                                <td>
                                    <span class="status-badge status-received">Received</span>
                                </td>
                                <td>
                                    <span class="payment-badge payment-paid">Paid</span>
                                </td>
                                <td>
                                    <span class="badge badge-secondary">South Branch</span>
                                </td>
                                <td class="table-actions">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('purchases.show', 2) }}" class="btn btn-sm btn-outline-primary action-btn">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="{{ route('purchases.edit', 2) }}" class="btn btn-sm btn-outline-warning action-btn">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <button class="btn btn-sm btn-outline-info action-btn">
                                            <i class="las la-file-invoice"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-between align-items-center mt-4">
            <div>
                <p class="mb-0">Showing 1 to 4 of 48 purchase orders</p>
            </div>
            <nav>
                <ul class="pagination mb-0">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                            <i class="las la-angle-left"></i>
                        </a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">
                            <i class="las la-angle-right"></i>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    @push('js')
    <script src="{{ asset('backend/assets/js/backend-bundle.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    <script>
        $(document).ready(function() {
            // View mode toggle
            $('input[name="viewMode"]').change(function() {
                const viewMode = $(this).val();
                if (viewMode === 'grid') {
                    $('#purchasesGridView').removeClass('d-none');
                    $('#purchasesListView').addClass('d-none');
                } else {
                    $('#purchasesGridView').addClass('d-none');
                    $('#purchasesListView').removeClass('d-none');
                }
            });

            // Search functionality
            $('input[placeholder="Search purchase orders..."]').on('keyup', function() {
                const searchText = $(this).val().toLowerCase();
                $('#purchasesGridView .card, #purchasesListView tbody tr').each(function() {
                    const rowText = $(this).text().toLowerCase();
                    $(this).toggle(rowText.includes(searchText));
                });
            });
        });

        // Apply filters
        window.applyFilters = function() {
            const status = $('#statusFilter').val();
            const payment = $('#paymentFilter').val();
            const supplier = $('#supplierFilter').val();
            const branch = $('#branchFilter').val();
            const fromDate = $('#fromDate').val();
            const toDate = $('#toDate').val();
            const amount = $('#amountFilter').val();

            // Clear existing filter tags
            $('#activeFilters').empty();

            // Add filter tags
            if (status) {
                $('#activeFilters').append(`
                    <span class="filter-tag">
                        Status: ${$('#statusFilter option:selected').text()}
                        <i class="las la-times" onclick="removeFilter('status')"></i>
                    </span>
                `);
            }

            if (payment) {
                $('#activeFilters').append(`
                    <span class="filter-tag">
                        Payment: ${$('#paymentFilter option:selected').text()}
                        <i class="las la-times" onclick="removeFilter('payment')"></i>
                    </span>
                `);
            }

            if (supplier) {
                $('#activeFilters').append(`
                    <span class="filter-tag">
                        Supplier: ${$('#supplierFilter option:selected').text()}
                        <i class="las la-times" onclick="removeFilter('supplier')"></i>
                    </span>
                `);
            }

            if (branch) {
                $('#activeFilters').append(`
                    <span class="filter-tag">
                        Branch: ${$('#branchFilter option:selected').text()}
                        <i class="las la-times" onclick="removeFilter('branch')"></i>
                    </span>
                `);
            }

            if (fromDate) {
                $('#activeFilters').append(`
                    <span class="filter-tag">
                        From: ${fromDate}
                        <i class="las la-times" onclick="removeFilter('fromDate')"></i>
                    </span>
                `);
            }

            if (toDate) {
                $('#activeFilters').append(`
                    <span class="filter-tag">
                        To: ${toDate}
                        <i class="las la-times" onclick="removeFilter('toDate')"></i>
                    </span>
                `);
            }

            if (amount) {
                $('#activeFilters').append(`
                    <span class="filter-tag">
                        Amount: ${$('#amountFilter option:selected').text()}
                        <i class="las la-times" onclick="removeFilter('amount')"></i>
                    </span>
                `);
            }

            // Show success message
            alert('Filters applied successfully!');
        };

        // Remove individual filter
        window.removeFilter = function(filterType) {
            $(`#${filterType}Filter`).val('');
            applyFilters();
        };

        // Reset all filters
        window.resetFilters = function() {
            $('#statusFilter').val('');
            $('#paymentFilter').val('');
            $('#supplierFilter').val('');
            $('#branchFilter').val('');
            $('#fromDate').val('');
            $('#toDate').val('');
            $('#amountFilter').val('');
            $('#activeFilters').empty();
            alert('All filters cleared!');
        };

        // Sort purchases
        window.sortPurchases = function(sortBy, order = 'desc') {
            let message = `Sorted by ${sortBy}`;
            if (order) {
                message += ` (${order === 'desc' ? 'descending' : 'ascending'})`;
            }
            alert(message + ' - This would sort the purchase orders in real application.');
        };

        // Export purchases
        window.exportPurchases = function(format) {
            alert(`Exporting purchases in ${format} format...`);
        };

        // Bulk actions
        window.bulkAction = function(action) {
            const selected = $('.purchase-checkbox:checked').length;
            if (selected === 0) {
                alert('Please select at least one purchase order');
                return;
            }

            switch (action) {
                case 'delete':
                    if (confirm(`Delete ${selected} purchase order(s)?`)) {
                        alert('Selected purchase orders deleted!');
                    }
                    break;
                case 'export':
                    alert(`Exporting ${selected} purchase order(s)...`);
                    break;
                case 'status':
                    const status = prompt('Enter new status (ordered/received/partial/cancelled):');
                    if (status) {
                        alert(`Status updated to ${status} for ${selected} purchase order(s)`);
                    }
                    break;
                case 'print':
                    alert(`Printing ${selected} purchase order(s)...`);
                    break;
            }
        };
    </script>
    @endpush
</x-app-layout>