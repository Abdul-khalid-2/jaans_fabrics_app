<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/remixicon/fonts/remixicon.css') }}">
    <style>
        .purchase-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 10px;
            padding: 30px;
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
        }

        .purchase-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 200%;
            background: rgba(255, 255, 255, 0.1);
            transform: rotate(30deg);
        }

        .status-badge {
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 14px;
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
            padding: 4px 12px;
            border-radius: 4px;
            font-size: 12px;
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

        .timeline {
            position: relative;
            padding-left: 30px;
        }

        .timeline-item {
            position: relative;
            margin-bottom: 20px;
            padding-left: 20px;
        }

        .timeline-marker {
            position: absolute;
            left: -30px;
            top: 5px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #007bff;
        }

        .timeline-content {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
        }
    </style>
    @endpush

    <div class="container-fluid">
        <!-- Purchase Header -->
        <div class="purchase-header">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h2 class="mb-2">PO-20240001</h2>
                    <p class="mb-2">Textile Factory Ltd. | Main Store</p>
                    <div class="d-flex align-items-center">
                        <span class="status-badge status-ordered mr-3">Ordered</span>
                        <span class="payment-badge payment-partial mr-3">Partial Payment</span>
                        <span><i class="las la-calendar mr-1"></i>Ordered: 15 Jan 2024</span>
                    </div>
                </div>
                <div class="col-md-4 text-right">
                    <div class="btn-group" role="group">
                        <a href="{{ route('purchases.edit', 1) }}" class="btn btn-light">
                            <i class="las la-edit mr-2"></i>Edit
                        </a>
                        <a href="{{ route('purchases.receive.create', 1) }}" class="btn btn-light ml-2">
                            <i class="las la-check-circle mr-2"></i>Receive
                        </a>
                        <button type="button" class="btn btn-light ml-2 dropdown-toggle" data-toggle="dropdown">
                            <i class="las la-ellipsis-h"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#"><i class="las la-file-invoice-dollar mr-2"></i>Generate Invoice</a>
                            <a class="dropdown-item" href="#"><i class="las la-print mr-2"></i>Print Order</a>
                            <a class="dropdown-item" href="#"><i class="las la-file-export mr-2"></i>Export PDF</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="#"><i class="las la-times-circle mr-2"></i>Cancel Order</a>
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
                    <div class="stats-value">₹95,680</div>
                    <div class="stats-label">Total Amount</div>
                    <small class="text-muted">Balance: ₹20,680</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <i class="las la-boxes fa-2x text-success"></i>
                    <div class="stats-value">12</div>
                    <div class="stats-label">Total Items</div>
                    <small class="text-success">Received: 40/80</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <i class="las la-money-bill-wave fa-2x text-warning"></i>
                    <div class="stats-value">₹75,000</div>
                    <div class="stats-label">Amount Paid</div>
                    <small class="text-warning">Due: 20 Jan 2024</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <i class="las la-shipping-fast fa-2x text-info"></i>
                    <div class="stats-value">20 Jan</div>
                    <div class="stats-label">Expected Delivery</div>
                    <small class="text-info">5 days remaining</small>
                </div>
            </div>
        </div>

        <!-- Tabs Navigation -->
        <ul class="nav nav-tabs nav-tabs-custom" id="purchaseTabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="details-tab" data-toggle="tab" href="#details">
                    <i class="las la-info-circle mr-2"></i>Details
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="products-tab" data-toggle="tab" href="#products">
                    <i class="las la-boxes mr-2"></i>Products
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="payments-tab" data-toggle="tab" href="#payments">
                    <i class="las la-money-bill-wave mr-2"></i>Payments
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="receiving-tab" data-toggle="tab" href="#receiving">
                    <i class="las la-check-circle mr-2"></i>Receiving
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="documents-tab" data-toggle="tab" href="#documents">
                    <i class="las la-file-contract mr-2"></i>Documents
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="activity-tab" data-toggle="tab" href="#activity">
                    <i class="las la-history mr-2"></i>Activity
                </a>
            </li>
        </ul>

        <!-- Tabs Content -->
        <div class="tab-content" id="purchaseTabsContent">
            <!-- Details Tab -->
            <div class="tab-pane fade show active" id="details" role="tabpanel">
                <div class="row">
                    <!-- Supplier Information -->
                    <div class="col-md-6">
                        <div class="info-card">
                            <h6><i class="las la-user-tie mr-2"></i>Supplier Information</h6>
                            <div class="info-item">
                                <div class="info-label">Company Name</div>
                                <div class="info-value">Textile Factory Ltd.</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Contact Person</div>
                                <div class="info-value">John Doe</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Email</div>
                                <div class="info-value">john@textilefactory.com</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Phone</div>
                                <div class="info-value">+91 9876543210</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Address</div>
                                <div class="info-value">123 Textile Street, Andheri East, Mumbai</div>
                            </div>
                        </div>
                    </div>

                    <!-- Order Information -->
                    <div class="col-md-6">
                        <div class="info-card">
                            <h6><i class="las la-clipboard-list mr-2"></i>Order Information</h6>
                            <div class="info-item">
                                <div class="info-label">Order Date</div>
                                <div class="info-value">15 January 2024</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Expected Delivery</div>
                                <div class="info-value">20 January 2024</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Purchase Status</div>
                                <div class="info-value">
                                    <span class="status-badge status-ordered">Ordered</span>
                                </div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Payment Status</div>
                                <div class="info-value">
                                    <span class="payment-badge payment-partial">Partial</span>
                                </div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Branch</div>
                                <div class="info-value">Main Store</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Ordered By</div>
                                <div class="info-value">Admin User</div>
                            </div>
                        </div>
                    </div>

                    <!-- Shipping Information -->
                    <div class="col-md-6">
                        <div class="info-card">
                            <h6><i class="las la-shipping-fast mr-2"></i>Shipping Information</h6>
                            <div class="info-item">
                                <div class="info-label">Shipping Method</div>
                                <div class="info-value">Delivery</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Tracking Number</div>
                                <div class="info-value">TRK123456789</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Carrier</div>
                                <div class="info-value">Blue Dart</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Shipping Address</div>
                                <div class="info-value">Main Store, 123 Fashion Street, Mumbai</div>
                            </div>
                        </div>
                    </div>

                    <!-- Financial Summary -->
                    <div class="col-md-6">
                        <div class="info-card">
                            <h6><i class="las la-calculator mr-2"></i>Financial Summary</h6>
                            <div class="info-item">
                                <div class="info-label">Subtotal</div>
                                <div class="info-value">₹76,000</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Tax (18%)</div>
                                <div class="info-value">₹13,680</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Shipping Charge</div>
                                <div class="info-value">₹5,000</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Other Charges</div>
                                <div class="info-value">₹3,000</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Discount</div>
                                <div class="info-value">₹2,000</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Grand Total</div>
                                <div class="info-value">₹95,680</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Amount Paid</div>
                                <div class="info-value text-success">₹75,000</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Balance Due</div>
                                <div class="info-value text-warning">₹20,680</div>
                            </div>
                        </div>
                    </div>

                    <!-- Notes -->
                    <div class="col-md-12">
                        <div class="info-card">
                            <h6><i class="las la-sticky-note mr-2"></i>Notes & Instructions</h6>
                            <p>Please ensure quality check before delivery. All items should be properly packed. Contact supplier for any delivery delays.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products Tab -->
            <div class="tab-pane fade" id="products" role="tabpanel">
                <div class="card">
                    <div class="card-body">
                        <h6>Ordered Products</h6>
                        <p class="mb-4">List of products in this purchase order</p>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>SKU</th>
                                        <th>Cost Price</th>
                                        <th>Ordered Qty</th>
                                        <th>Received Qty</th>
                                        <th>Pending Qty</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Product 1 -->
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="https://via.placeholder.com/40x40/007bff/ffffff?text=S"
                                                    style="width:40px;height:40px;border-radius:4px;margin-right:10px;">
                                                <div>
                                                    <div>Cotton Formal Shirt</div>
                                                    <small class="text-muted">Size: M, Color: White</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>CTN-SHT-001</td>
                                        <td>₹800</td>
                                        <td>50</td>
                                        <td class="text-success">25</td>
                                        <td class="text-warning">25</td>
                                        <td>₹40,000</td>
                                        <td>
                                            <span class="badge badge-warning">Partial</span>
                                        </td>
                                    </tr>

                                    <!-- Product 2 -->
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="https://via.placeholder.com/40x40/28a745/ffffff?text=J"
                                                    style="width:40px;height:40px;border-radius:4px;margin-right:10px;">
                                                <div>
                                                    <div>Denim Jeans</div>
                                                    <small class="text-muted">Size: 32, Color: Blue</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>DNM-JNS-002</td>
                                        <td>₹1,200</td>
                                        <td>30</td>
                                        <td class="text-success">15</td>
                                        <td class="text-warning">15</td>
                                        <td>₹36,000</td>
                                        <td>
                                            <span class="badge badge-warning">Partial</span>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="6" class="text-right">Total:</th>
                                        <th>₹76,000</th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
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
                                <p class="mb-0">Payments made for this purchase order</p>
                            </div>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#makePaymentModal">
                                <i class="las la-money-bill-wave mr-2"></i>Make Payment
                            </button>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Payment Date</th>
                                        <th>Reference</th>
                                        <th>Amount</th>
                                        <th>Method</th>
                                        <th>Status</th>
                                        <th>Paid By</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Payment 1 -->
                                    <tr>
                                        <td>16 Jan 2024</td>
                                        <td>
                                            <div>PAY-20240001</div>
                                            <small class="text-muted">TXN: TXN123456</small>
                                        </td>
                                        <td>
                                            <strong>₹50,000</strong>
                                        </td>
                                        <td>
                                            <span class="badge badge-info">Bank Transfer</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-success">Completed</span>
                                        </td>
                                        <td>Admin User</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-outline-primary">
                                                <i class="las la-receipt"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Payment 2 -->
                                    <tr>
                                        <td>18 Jan 2024</td>
                                        <td>
                                            <div>PAY-20240002</div>
                                            <small class="text-muted">Cheque: CHQ789012</small>
                                        </td>
                                        <td>
                                            <strong>₹25,000</strong>
                                        </td>
                                        <td>
                                            <span class="badge badge-warning">Cheque</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-success">Completed</span>
                                        </td>
                                        <td>John Manager</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-outline-primary">
                                                <i class="las la-receipt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr class="table-warning">
                                        <th colspan="2" class="text-right">Total Paid:</th>
                                        <th>₹75,000</th>
                                        <th colspan="2"></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    <tr class="table-danger">
                                        <th colspan="2" class="text-right">Balance Due:</th>
                                        <th>₹20,680</th>
                                        <th colspan="2"></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Receiving Tab -->
            <div class="tab-pane fade" id="receiving" role="tabpanel">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-4">
                            <div>
                                <h6>Goods Receiving History</h6>
                                <p class="mb-0">Received items for this purchase order</p>
                            </div>
                            <a href="{{ route('purchases.receive.create', 1) }}" class="btn btn-primary">
                                <i class="las la-check-circle mr-2"></i>Receive Goods
                            </a>
                        </div>

                        <!-- Receiving Summary -->
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <div class="stats-card">
                                    <div class="stats-value">40/80</div>
                                    <div class="stats-label">Items Received</div>
                                    <small class="text-warning">50% complete</small>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stats-card">
                                    <div class="stats-value">2</div>
                                    <div class="stats-label">Receiving Sessions</div>
                                    <small class="text-muted">Last: 18 Jan</small>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stats-card">
                                    <div class="stats-value">0</div>
                                    <div class="stats-label">Damaged Items</div>
                                    <small class="text-success">All good</small>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stats-card">
                                    <div class="stats-value">40</div>
                                    <div class="stats-label">Restocked</div>
                                    <small class="text-info">To inventory</small>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Receiving Date</th>
                                        <th>Received By</th>
                                        <th>Items Received</th>
                                        <th>Condition</th>
                                        <th>Notes</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Receiving 1 -->
                                    <tr>
                                        <td>18 Jan 2024</td>
                                        <td>Warehouse Staff</td>
                                        <td>40 items (25 shirts, 15 jeans)</td>
                                        <td>
                                            <span class="badge badge-success">Good</span>
                                        </td>
                                        <td>All items in good condition</td>
                                        <td>
                                            <a href="{{ route('purchases.receive.show', ['purchase' => 1,'receive' => 1]) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="las la-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Documents Tab -->
            <div class="tab-pane fade" id="documents" role="tabpanel">
                <div class="card">
                    <div class="card-body">
                        <h6>Purchase Documents</h6>
                        <p class="mb-4">All documents related to this purchase order</p>

                        <div class="row">
                            <!-- Document 1 -->
                            <div class="col-md-4 mb-3">
                                <div class="card document-card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="mr-3">
                                                <i class="las la-file-invoice-dollar fa-3x text-primary"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0">Purchase Order</h6>
                                                <small class="text-muted">PDF Document</small>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <small class="text-muted">Generated: 15 Jan 2024</small>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-outline-primary">
                                                    <i class="las la-eye"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-secondary">
                                                    <i class="las la-download"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-info">
                                                    <i class="las la-print"></i>
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
                                                <i class="las la-file-contract fa-3x text-success"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0">Goods Receipt</h6>
                                                <small class="text-muted">PDF Document</small>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <small class="text-muted">Generated: 18 Jan 2024</small>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-outline-primary">
                                                    <i class="las la-eye"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-secondary">
                                                    <i class="las la-download"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-info">
                                                    <i class="las la-print"></i>
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
                                                <i class="las la-receipt fa-3x text-warning"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0">Payment Receipt</h6>
                                                <small class="text-muted">PDF Document</small>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <small class="text-muted">Generated: 16 Jan 2024</small>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-outline-primary">
                                                    <i class="las la-eye"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-secondary">
                                                    <i class="las la-download"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-info">
                                                    <i class="las la-print"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <button type="button" class="btn btn-primary">
                                <i class="las la-upload mr-2"></i>Upload Document
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Activity Tab -->
            <div class="tab-pane fade" id="activity" role="tabpanel">
                <div class="card">
                    <div class="card-body">
                        <h6>Activity Timeline</h6>
                        <p class="mb-4">All activities for this purchase order</p>

                        <div class="timeline">
                            <!-- Activity 1 -->
                            <div class="timeline-item">
                                <div class="timeline-marker bg-success"></div>
                                <div class="timeline-content">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="mb-1">Purchase Order Created</h6>
                                        <small class="text-muted">15 Jan 2024, 10:30 AM</small>
                                    </div>
                                    <p class="mb-1">Purchase order PO-20240001 created for ₹95,680</p>
                                    <small class="text-muted">By: Admin User</small>
                                </div>
                            </div>

                            <!-- Activity 2 -->
                            <div class="timeline-item">
                                <div class="timeline-marker bg-info"></div>
                                <div class="timeline-content">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="mb-1">Payment Received</h6>
                                        <small class="text-muted">16 Jan 2024, 02:15 PM</small>
                                    </div>
                                    <p class="mb-1">Payment of ₹50,000 received via bank transfer</p>
                                    <small class="text-muted">By: Admin User</small>
                                </div>
                            </div>

                            <!-- Activity 3 -->
                            <div class="timeline-item">
                                <div class="timeline-marker bg-primary"></div>
                                <div class="timeline-content">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="mb-1">Partial Goods Received</h6>
                                        <small class="text-muted">18 Jan 2024, 11:00 AM</small>
                                    </div>
                                    <p class="mb-1">40 items received in good condition</p>
                                    <small class="text-muted">By: Warehouse Staff</small>
                                </div>
                            </div>

                            <!-- Activity 4 -->
                            <div class="timeline-item">
                                <div class="timeline-marker bg-warning"></div>
                                <div class="timeline-content">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="mb-1">Second Payment Received</h6>
                                        <small class="text-muted">18 Jan 2024, 04:30 PM</small>
                                    </div>
                                    <p class="mb-1">Payment of ₹25,000 received via cheque</p>
                                    <small class="text-muted">By: John Manager</small>
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
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Make Payment</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Payment Amount (₹)</label>
                        <input type="number" class="form-control" value="20680">
                    </div>
                    <div class="form-group">
                        <label>Payment Method</label>
                        <select class="form-control">
                            <option>Bank Transfer</option>
                            <option>Cash</option>
                            <option>Cheque</option>
                            <option>UPI</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Reference Number</label>
                        <input type="text" class="form-control" placeholder="Enter reference number">
                    </div>
                    <div class="form-group">
                        <label>Payment Date</label>
                        <input type="date" class="form-control" value="{{ date('Y-m-d') }}">
                    </div>
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
            $('#purchaseTabs a').on('click', function(e) {
                e.preventDefault();
                $(this).tab('show');
            });

            // Update active tab on page load
            const hash = window.location.hash;
            if (hash) {
                $('#purchaseTabs a[href="' + hash + '"]').tab('show');
            }

            // Print purchase order
            $('#printPurchase').click(function() {
                window.print();
            });

            // Export purchase data
            $('#exportPurchase').click(function() {
                alert('Export functionality would be implemented here');
            });

            // Email purchase order
            $('#emailPurchase').click(function() {
                const email = 'john@textilefactory.com';
                const subject = 'Purchase Order PO-20240001';
                const body = 'Please find attached the purchase order details.';
                window.location.href = `mailto:${email}?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`;
            });
        });
    </script>
    @endpush
</x-app-layout>