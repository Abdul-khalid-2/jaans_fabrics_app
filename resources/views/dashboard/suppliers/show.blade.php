<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/remixicon/fonts/remixicon.css') }}">
    <style>
        .supplier-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 10px;
            padding: 30px;
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
        }

        .supplier-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 200%;
            background: rgba(255, 255, 255, 0.1);
            transform: rotate(30deg);
        }

        .supplier-logo-lg {
            width: 120px;
            height: 120px;
            border-radius: 10px;
            object-fit: cover;
            border: 4px solid white;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
        }

        .info-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            height: 100%;
        }

        .info-card h6 {
            color: #495057;
            font-weight: 600;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f8f9fa;
        }

        .info-item {
            margin-bottom: 12px;
            padding-bottom: 12px;
            border-bottom: 1px dashed #e9ecef;
        }

        .info-item:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }

        .info-label {
            font-weight: 500;
            color: #6c757d;
            font-size: 13px;
        }

        .info-value {
            font-weight: 500;
            color: #343a40;
        }

        .stats-card {
            text-align: center;
            padding: 20px;
            border-radius: 10px;
            background: white;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            height: 100%;
        }

        .stats-value {
            font-size: 24px;
            font-weight: 600;
            margin: 10px 0;
        }

        .stats-label {
            color: #6c757d;
            font-size: 13px;
        }

        .nav-tabs-custom {
            border-bottom: 2px solid #dee2e6;
        }

        .nav-tabs-custom .nav-link {
            border: none;
            color: #6c757d;
            font-weight: 500;
            padding: 12px 20px;
            margin-right: 5px;
            border-radius: 8px 8px 0 0;
        }

        .nav-tabs-custom .nav-link.active {
            color: #007bff;
            background: white;
            border-bottom: 3px solid #007bff;
        }

        .tab-content {
            padding: 20px 0;
        }

        .table-actions {
            width: 120px;
        }

        .status-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        .status-active {
            background: #d4edda;
            color: #155724;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-overdue {
            background: #f8d7da;
            color: #721c24;
        }
    </style>
    @endpush

    <div class="container-fluid">
        <!-- Supplier Header -->
        <div class="supplier-header">
            <div class="row align-items-center">
                <div class="col-md-2 text-center">
                    <img src="https://via.placeholder.com/120x120/007bff/ffffff?text=TF"
                        class="supplier-logo-lg" alt="Textile Factory Ltd.">
                </div>
                <div class="col-md-6">
                    <h2 class="mb-2">Textile Factory Ltd.</h2>
                    <p class="mb-2">SUP-20240001 | Manufacturer</p>
                    <div class="d-flex align-items-center">
                        <div class="rating-stars mr-3">
                            <i class="las la-star"></i>
                            <i class="las la-star"></i>
                            <i class="las la-star"></i>
                            <i class="las la-star"></i>
                            <i class="las la-star-half-alt"></i>
                            <span class="ml-1">4.5</span>
                        </div>
                        <span class="status-badge status-active mr-3">Active</span>
                        <span><i class="las la-calendar mr-1"></i>Last Purchase: 2 days ago</span>
                    </div>
                </div>
                <div class="col-md-4 text-right">
                    <div class="btn-group" role="group">
                        <a href="{{ route('suppliers.edit', 1) }}" class="btn btn-light">
                            <i class="las la-edit mr-2"></i>Edit
                        </a>
                        <a href="{{ route('purchases.create') }}" class="btn btn-light ml-2">
                            <i class="las la-cart-plus mr-2"></i>New Purchase
                        </a>
                        <button type="button" class="btn btn-light ml-2 dropdown-toggle" data-toggle="dropdown">
                            <i class="las la-ellipsis-h"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#"><i class="las la-file-invoice-dollar mr-2"></i>Generate Statement</a>
                            <a class="dropdown-item" href="#"><i class="las la-envelope mr-2"></i>Send Email</a>
                            <a class="dropdown-item" href="#"><i class="las la-phone mr-2"></i>Call Supplier</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="#"><i class="las la-ban mr-2"></i>Blacklist Supplier</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="stats-card">
                    <i class="las la-shopping-cart fa-2x text-primary"></i>
                    <div class="stats-value">Rs1.25M</div>
                    <div class="stats-label">Total Purchases</div>
                    <small class="text-muted">48 orders</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <i class="las la-money-bill-wave fa-2x text-warning"></i>
                    <div class="stats-value">Rs75K</div>
                    <div class="stats-label">Outstanding</div>
                    <small class="text-danger">Due in 15 days</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <i class="las la-credit-card fa-2x text-success"></i>
                    <div class="stats-value">Rs500K</div>
                    <div class="stats-label">Credit Limit</div>
                    <small class="text-muted">85% utilized</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <i class="las la-star fa-2x text-info"></i>
                    <div class="stats-value">4.5/5.0</div>
                    <div class="stats-label">Average Rating</div>
                    <small class="text-muted">Based on 24 reviews</small>
                </div>
            </div>
        </div>

        <!-- Tabs Navigation -->
        <ul class="nav nav-tabs nav-tabs-custom" id="supplierTabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#overview">
                    <i class="las la-info-circle mr-2"></i>Overview
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="purchases-tab" data-toggle="tab" href="#purchases">
                    <i class="las la-shopping-cart mr-2"></i>Purchases
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="payments-tab" data-toggle="tab" href="#payments">
                    <i class="las la-money-bill-wave mr-2"></i>Payments
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="products-tab" data-toggle="tab" href="#products">
                    <i class="las la-boxes mr-2"></i>Products
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="documents-tab" data-toggle="tab" href="#documents">
                    <i class="las la-file-contract mr-2"></i>Documents
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="activity-tab" data-toggle="tab" href="#activity">
                    <i class="las la-history mr-2"></i>Activity Log
                </a>
            </li>
        </ul>

        <!-- Tabs Content -->
        <div class="tab-content" id="supplierTabsContent">
            <!-- Overview Tab -->
            <div class="tab-pane fade show active" id="overview" role="tabpanel">
                <div class="row">
                    <!-- Contact Information -->
                    <div class="col-md-6">
                        <div class="info-card">
                            <h6><i class="las la-address-book mr-2"></i>Contact Information</h6>
                            <div class="info-item">
                                <div class="info-label">Contact Person</div>
                                <div class="info-value">John Doe</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Email Address</div>
                                <div class="info-value">john@textilefactory.com</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Phone Number</div>
                                <div class="info-value">+91 9876543210</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Alternate Phone</div>
                                <div class="info-value">+91 9876543211</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Website</div>
                                <div class="info-value">https://textilefactory.com</div>
                            </div>
                        </div>
                    </div>

                    <!-- Address Information -->
                    <div class="col-md-6">
                        <div class="info-card">
                            <h6><i class="las la-map-marker-alt mr-2"></i>Address</h6>
                            <div class="info-item">
                                <div class="info-label">Full Address</div>
                                <div class="info-value">123 Textile Street, Andheri East, Mumbai, Maharashtra 400069</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Country</div>
                                <div class="info-value">India</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">City</div>
                                <div class="info-value">Mumbai</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">State</div>
                                <div class="info-value">Maharashtra</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Pincode</div>
                                <div class="info-value">400069</div>
                            </div>
                        </div>
                    </div>

                    <!-- Business Information -->
                    <div class="col-md-6">
                        <div class="info-card">
                            <h6><i class="las la-briefcase mr-2"></i>Business Information</h6>
                            <div class="info-item">
                                <div class="info-label">Tax ID (GSTIN)</div>
                                <div class="info-value">27AAACT2725Q1Z5</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Business ID</div>
                                <div class="info-value">BUS123456</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Supplier Type</div>
                                <div class="info-value">Manufacturer</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Established</div>
                                <div class="info-value">2015</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Employee Count</div>
                                <div class="info-value">50-100</div>
                            </div>
                        </div>
                    </div>

                    <!-- Financial Information -->
                    <div class="col-md-6">
                        <div class="info-card">
                            <h6><i class="las la-chart-line mr-2"></i>Financial Information</h6>
                            <div class="info-item">
                                <div class="info-label">Credit Limit</div>
                                <div class="info-value">Rs500,000</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Current Balance</div>
                                <div class="info-value text-warning">Rs75,000</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Total Purchases</div>
                                <div class="info-value">Rs1,250,000</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Payment Terms</div>
                                <div class="info-value">Net 30</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Payment Days</div>
                                <div class="info-value">30 days</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Minimum Order Value</div>
                                <div class="info-value">Rs10,000</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Delivery Days</div>
                                <div class="info-value">7 days</div>
                            </div>
                        </div>
                    </div>

                    <!-- Bank Details -->
                    <div class="col-md-12">
                        <div class="info-card">
                            <h6><i class="las la-university mr-2"></i>Bank Details</h6>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="info-item">
                                        <div class="info-label">Bank Name</div>
                                        <div class="info-value">State Bank of India</div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-item">
                                        <div class="info-label">Account Number</div>
                                        <div class="info-value">123456789012</div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-item">
                                        <div class="info-label">Account Holder</div>
                                        <div class="info-value">Textile Factory Ltd.</div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-item">
                                        <div class="info-label">IFSC Code</div>
                                        <div class="info-value">SBIN0001234</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Notes -->
                    <div class="col-md-12">
                        <div class="info-card">
                            <h6><i class="las la-sticky-note mr-2"></i>Notes & Remarks</h6>
                            <p>Reliable supplier for cotton fabrics. Provides good quality products with consistent delivery. Preferred supplier for our summer collection. Has good after-sales support and responsive customer service.</p>
                            <div class="mt-3">
                                <small class="text-muted"><i class="las la-history mr-1"></i>Last updated: 2 days ago by Admin User</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Purchases Tab -->
            <div class="tab-pane fade" id="purchases" role="tabpanel">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-4">
                            <div>
                                <h6>Purchase History</h6>
                                <p class="mb-0">All purchase orders from this supplier</p>
                            </div>
                            <a href="{{ route('purchases.create') }}" class="btn btn-primary">
                                <i class="las la-plus mr-2"></i>New Purchase
                            </a>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Purchase No.</th>
                                        <th>Date</th>
                                        <th>Items</th>
                                        <th>Total Amount</th>
                                        <th>Status</th>
                                        <th>Payment</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Sample Purchase 1 -->
                                    <tr>
                                        <td>
                                            <strong>PO-20240001</strong>
                                            <div class="small text-muted">Main Store</div>
                                        </td>
                                        <td>15 Jan 2024</td>
                                        <td>12 items</td>
                                        <td>
                                            <strong>Rs125,000</strong>
                                            <div class="small text-muted">Paid: Rs75,000</div>
                                        </td>
                                        <td>
                                            <span class="badge badge-success">Received</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-warning">Partial</span>
                                            <div class="small text-muted">Due: Rs50,000</div>
                                        </td>
                                        <td class="table-actions">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('purchases.show', 1) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="las la-eye"></i>
                                                </a>
                                                <a href="{{ route('purchases.edit', 1) }}" class="btn btn-sm btn-outline-warning">
                                                    <i class="las la-edit"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Sample Purchase 2 -->
                                    <tr>
                                        <td>
                                            <strong>PO-20240002</strong>
                                            <div class="small text-muted">South Branch</div>
                                        </td>
                                        <td>10 Jan 2024</td>
                                        <td>8 items</td>
                                        <td>
                                            <strong>Rs85,000</strong>
                                            <div class="small text-muted">Paid: Rs85,000</div>
                                        </td>
                                        <td>
                                            <span class="badge badge-success">Received</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-success">Paid</span>
                                        </td>
                                        <td class="table-actions">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('purchases.show', 2) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="las la-eye"></i>
                                                </a>
                                                <a href="{{ route('purchases.edit', 2) }}" class="btn btn-sm btn-outline-warning">
                                                    <i class="las la-edit"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Sample Purchase 3 -->
                                    <tr>
                                        <td>
                                            <strong>PO-20240003</strong>
                                            <div class="small text-muted">Main Store</div>
                                        </td>
                                        <td>05 Jan 2024</td>
                                        <td>15 items</td>
                                        <td>
                                            <strong>Rs150,000</strong>
                                            <div class="small text-muted">Paid: Rs150,000</div>
                                        </td>
                                        <td>
                                            <span class="badge badge-primary">Ordered</span>
                                            <div class="small text-muted">Expected: 12 Jan</div>
                                        </td>
                                        <td>
                                            <span class="badge badge-success">Paid</span>
                                        </td>
                                        <td class="table-actions">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('purchases.show', 3) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="las la-eye"></i>
                                                </a>
                                                <a href="{{ route('purchases.edit', 3) }}" class="btn btn-sm btn-outline-warning">
                                                    <i class="las la-edit"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Purchase Summary -->
                        <div class="row mt-4">
                            <div class="col-md-3">
                                <div class="stats-card">
                                    <div class="stats-value">48</div>
                                    <div class="stats-label">Total Orders</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stats-card">
                                    <div class="stats-value">Rs1.25M</div>
                                    <div class="stats-label">Total Value</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stats-card">
                                    <div class="stats-value">32</div>
                                    <div class="stats-label">Completed</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stats-card">
                                    <div class="stats-value">4</div>
                                    <div class="stats-label">Pending</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payments Tab -->
            <div class="tab-pane fade" id="payments" role="tabpanel">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-4">
                            <div>
                                <h6>Payment History</h6>
                                <p class="mb-0">All payments made to this supplier</p>
                            </div>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#makePaymentModal">
                                <i class="las la-money-bill-wave mr-2"></i>Make Payment
                            </button>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Payment Ref.</th>
                                        <th>Date</th>
                                        <th>Purchase No.</th>
                                        <th>Amount</th>
                                        <th>Method</th>
                                        <th>Status</th>
                                        <th>Paid By</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Sample Payment 1 -->
                                    <tr>
                                        <td>
                                            <strong>PAY-20240001</strong>
                                            <div class="small text-muted">Ref: TXN123456</div>
                                        </td>
                                        <td>20 Jan 2024</td>
                                        <td>PO-20240001</td>
                                        <td>
                                            <strong>Rs50,000</strong>
                                            <div class="small text-muted">Balance: Rs25,000</div>
                                        </td>
                                        <td>
                                            <span class="badge badge-info">Bank Transfer</span>
                                        </td>
                                        <td>
                                            <span class="status-badge status-active">Completed</span>
                                        </td>
                                        <td>Admin User</td>
                                        <td class="table-actions">
                                            <button type="button" class="btn btn-sm btn-outline-primary">
                                                <i class="las la-receipt"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Sample Payment 2 -->
                                    <tr>
                                        <td>
                                            <strong>PAY-20240002</strong>
                                            <div class="small text-muted">Ref: CHQ789012</div>
                                        </td>
                                        <td>15 Jan 2024</td>
                                        <td>PO-20240002</td>
                                        <td>
                                            <strong>Rs85,000</strong>
                                            <div class="small text-muted">Full Payment</div>
                                        </td>
                                        <td>
                                            <span class="badge badge-warning">Cheque</span>
                                        </td>
                                        <td>
                                            <span class="status-badge status-active">Completed</span>
                                        </td>
                                        <td>John Manager</td>
                                        <td class="table-actions">
                                            <button type="button" class="btn btn-sm btn-outline-primary">
                                                <i class="las la-receipt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Outstanding Summary -->
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="alert alert-warning">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="alert-heading"><i class="las la-exclamation-triangle mr-2"></i>Outstanding Amount</h6>
                                            <p class="mb-0">Total outstanding: <strong class="h4">Rs75,000</strong></p>
                                            <small>Includes overdue amount of Rs25,000 (due: 5 Jan 2024)</small>
                                        </div>
                                        <button type="button" class="btn btn-danger">
                                            <i class="las la-money-bill-wave mr-2"></i>Pay Now
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products Tab -->
            <div class="tab-pane fade" id="products" role="tabpanel">
                <div class="card">
                    <div class="card-body">
                        <h6>Supplied Products</h6>
                        <p class="mb-4">Products supplied by this vendor</p>

                        <div class="row">
                            <!-- Sample Product 1 -->
                            <div class="col-md-4 mb-4">
                                <div class="card product-card">
                                    <img src="https://via.placeholder.com/300x200/007bff/ffffff?text=Cotton+Shirt"
                                        class="card-img-top" alt="Cotton Shirt">
                                    <div class="card-body">
                                        <h6 class="card-title">Cotton Formal Shirt</h6>
                                        <p class="card-text text-muted small">Premium cotton fabric, formal wear</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <strong>Rs1,200</strong>
                                                <div class="small text-muted">Cost: Rs800</div>
                                            </div>
                                            <span class="badge badge-success">In Stock</span>
                                        </div>
                                        <div class="mt-2">
                                            <small class="text-muted">Last supplied: 15 Jan 2024</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Sample Product 2 -->
                            <div class="col-md-4 mb-4">
                                <div class="card product-card">
                                    <img src="https://via.placeholder.com/300x200/28a745/ffffff?text=Jeans"
                                        class="card-img-top" alt="Denim Jeans">
                                    <div class="card-body">
                                        <h6 class="card-title">Denim Jeans</h6>
                                        <p class="card-text text-muted small">Stretch denim, slim fit</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <strong>Rs1,800</strong>
                                                <div class="small text-muted">Cost: Rs1,200</div>
                                            </div>
                                            <span class="badge badge-warning">Low Stock</span>
                                        </div>
                                        <div class="mt-2">
                                            <small class="text-muted">Last supplied: 10 Jan 2024</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Sample Product 3 -->
                            <div class="col-md-4 mb-4">
                                <div class="card product-card">
                                    <img src="https://via.placeholder.com/300x200/ffc107/000000?text=T-Shirt"
                                        class="card-img-top" alt="T-Shirt">
                                    <div class="card-body">
                                        <h6 class="card-title">Cotton T-Shirt</h6>
                                        <p class="card-text text-muted small">100% cotton, round neck</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <strong>Rs500</strong>
                                                <div class="small text-muted">Cost: Rs350</div>
                                            </div>
                                            <span class="badge badge-success">In Stock</span>
                                        </div>
                                        <div class="mt-2">
                                            <small class="text-muted">Last supplied: 05 Jan 2024</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Product Statistics -->
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="info-card">
                                    <h6>Product Statistics</h6>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="info-item">
                                                <div class="info-label">Total Products</div>
                                                <div class="info-value">24</div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="info-item">
                                                <div class="info-label">Active Products</div>
                                                <div class="info-value">18</div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="info-item">
                                                <div class="info-label">Best Seller</div>
                                                <div class="info-value">Cotton Shirt</div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="info-item">
                                                <div class="info-label">Avg. Rating</div>
                                                <div class="info-value">4.3/5.0</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Documents Tab -->
            <div class="tab-pane fade" id="documents" role="tabpanel">
                <div class="card">
                    <div class="card-body">
                        <h6>Supplier Documents</h6>
                        <p class="mb-4">All documents related to this supplier</p>

                        <div class="row">
                            <!-- Document 1 -->
                            <div class="col-md-4 mb-3">
                                <div class="card document-card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="mr-3">
                                                <i class="las la-file-contract fa-3x text-primary"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0">GST Certificate</h6>
                                                <small class="text-muted">PDF Document</small>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <small class="text-muted">Uploaded: 15 Jan 2024</small>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-outline-primary">
                                                    <i class="las la-eye"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-secondary">
                                                    <i class="las la-download"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Document 2 -->
                            <div class="col-md-4 mb-3">
                                <div class="card document-card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="mr-3">
                                                <i class="las la-file-invoice-dollar fa-3x text-success"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0">MSME Certificate</h6>
                                                <small class="text-muted">PDF Document</small>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <small class="text-muted">Uploaded: 10 Jan 2024</small>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-outline-primary">
                                                    <i class="las la-eye"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-secondary">
                                                    <i class="las la-download"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Document 3 -->
                            <div class="col-md-4 mb-3">
                                <div class="card document-card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="mr-3">
                                                <i class="las la-file-signature fa-3x text-warning"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0">Agreement</h6>
                                                <small class="text-muted">PDF Document</small>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <small class="text-muted">Uploaded: 05 Jan 2024</small>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-outline-primary">
                                                    <i class="las la-eye"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-secondary">
                                                    <i class="las la-download"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <button type="button" class="btn btn-primary">
                                <i class="las la-upload mr-2"></i>Upload New Document
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Activity Log Tab -->
            <div class="tab-pane fade" id="activity" role="tabpanel">
                <div class="card">
                    <div class="card-body">
                        <h6>Activity Timeline</h6>
                        <p class="mb-4">Recent activities for this supplier</p>

                        <div class="timeline">
                            <!-- Activity 1 -->
                            <div class="timeline-item">
                                <div class="timeline-marker bg-success"></div>
                                <div class="timeline-content">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="mb-1">Purchase Order Created</h6>
                                        <small class="text-muted">2 days ago</small>
                                    </div>
                                    <p class="mb-1">Purchase order PO-20240001 created for Rs125,000</p>
                                    <small class="text-muted">By: Admin User</small>
                                </div>
                            </div>

                            <!-- Activity 2 -->
                            <div class="timeline-item">
                                <div class="timeline-marker bg-info"></div>
                                <div class="timeline-content">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="mb-1">Payment Received</h6>
                                        <small class="text-muted">5 days ago</small>
                                    </div>
                                    <p class="mb-1">Payment of Rs50,000 received against PO-20240001</p>
                                    <small class="text-muted">By: John Manager</small>
                                </div>
                            </div>

                            <!-- Activity 3 -->
                            <div class="timeline-item">
                                <div class="timeline-marker bg-primary"></div>
                                <div class="timeline-content">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="mb-1">Supplier Updated</h6>
                                        <small class="text-muted">1 week ago</small>
                                    </div>
                                    <p class="mb-1">Contact information updated</p>
                                    <small class="text-muted">By: Admin User</small>
                                </div>
                            </div>

                            <!-- Activity 4 -->
                            <div class="timeline-item">
                                <div class="timeline-marker bg-warning"></div>
                                <div class="timeline-content">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="mb-1">Credit Limit Increased</h6>
                                        <small class="text-muted">2 weeks ago</small>
                                    </div>
                                    <p class="mb-1">Credit limit increased from Rs300,000 to Rs500,000</p>
                                    <small class="text-muted">By: Finance Manager</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Make Payment Modal -->
    <div class="modal fade" id="makePaymentModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Make Payment to Supplier</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Payment form would go here -->
                    <p>Payment form content would be here...</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Process Payment</button>
                </div>
            </div>
        </div>
    </div>

    @push('js')
    <script src="{{ asset('backend/assets/js/backend-bundle.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Tab functionality
            $('#supplierTabs a').on('click', function(e) {
                e.preventDefault();
                $(this).tab('show');
            });

            // Update active tab on page load
            const hash = window.location.hash;
            if (hash) {
                $('#supplierTabs a[href="' + hash + '"]').tab('show');
            }

            // Smooth scroll for anchor links
            $('a[href^="#"]').on('click', function(e) {
                e.preventDefault();
                const target = $(this.getAttribute('href'));
                if (target.length) {
                    $('html, body').stop().animate({
                        scrollTop: target.offset().top - 100
                    }, 1000);
                }
            });

            // Print supplier details
            $('#printSupplier').click(function() {
                window.print();
            });

            // Export supplier data
            $('#exportSupplier').click(function() {
                alert('Export functionality would be implemented here');
            });

            // Send email
            $('#sendEmail').click(function() {
                const email = 'john@textilefactory.com';
                window.location.href = 'mailto:' + email;
            });
        });
    </script>
    @endpush
</x-app-layout>