<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/remixicon/fonts/remixicon.css') }}">
    <style>
        .form-section {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .form-section-title {
            font-weight: 600;
            color: #495057;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #dee2e6;
        }

        .product-item {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            background: white;
        }

        .summary-card {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 20px;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px dashed #dee2e6;
        }

        .summary-item.total {
            border-bottom: 2px solid #007bff;
            font-weight: 600;
            font-size: 18px;
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

        .history-timeline {
            margin-top: 20px;
        }

        .history-item {
            padding: 10px;
            border-left: 3px solid #007bff;
            margin-bottom: 10px;
            background: #f8f9fa;
        }
    </style>
    @endpush

    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
            <div>
                <h4 class="mb-3">Edit Purchase Order</h4>
                <p class="mb-0">Update purchase order details</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('purchases.index') }}">Purchases</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('purchases.show', 1) }}">PO-20240001</a></li>
                        <li class="breadcrumb-item active">Edit Purchase</li>
                    </ol>
                </nav>
            </div>
            <div>
                <a href="{{ route('purchases.show', 1) }}" class="btn btn-outline-secondary">
                    <i class="las la-times mr-2"></i>Cancel
                </a>
                <button type="submit" form="purchaseEditForm" class="btn btn-primary ml-2">
                    <i class="las la-save mr-2"></i>Update Purchase
                </button>
            </div>
        </div>

        <!-- Purchase Summary -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="d-flex align-items-center">
                            <div class="mr-3">
                                <span class="status-badge status-ordered">Ordered</span>
                            </div>
                            <div>
                                <h5 class="mb-0">PO-20240001</h5>
                                <small class="text-muted">Textile Factory Ltd.</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div>
                            <small class="text-muted d-block">Order Date</small>
                            <strong>15 Jan 2024</strong>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div>
                            <small class="text-muted d-block">Expected Delivery</small>
                            <strong>20 Jan 2024</strong>
                            <small class="text-muted">(5 days remaining)</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Left Column: Form -->
            <div class="col-lg-8">
                <form id="purchaseEditForm" action="{{ route('purchases.update', 1) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-section">
                        <h6 class="form-section-title">Basic Information</h6>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Supplier</label>
                                    <select class="form-control" name="supplier_id" required>
                                        <option value="1" selected>Textile Factory Ltd.</option>
                                        <option value="2">Fashion Wear Imports</option>
                                        <option value="3">Local Distributors Co.</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Branch</label>
                                    <select class="form-control" name="branch_id" required>
                                        <option value="1" selected>Main Store</option>
                                        <option value="2">South Branch</option>
                                        <option value="3">Warehouse</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Order Date</label>
                                    <input type="date" class="form-control" name="order_date" value="2024-01-15" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Expected Delivery Date</label>
                                    <input type="date" class="form-control" name="expected_delivery_date" value="2024-01-20">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <h6 class="form-section-title">Products</h6>

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>SKU</th>
                                        <th>Cost Price</th>
                                        <th>Ordered Qty</th>
                                        <th>Received Qty</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Product 1 -->
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="https://via.placeholder.com/40x40/007bff/ffffff?text=S"
                                                    class="mr-2" style="width:40px;height:40px;border-radius:4px;">
                                                <div>
                                                    <div>Cotton Formal Shirt</div>
                                                    <small class="text-muted">Size: M, Color: White</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>CTN-SHT-001</td>
                                        <td>
                                            <input type="number" class="form-control form-control-sm" value="800" style="width:100px;">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control form-control-sm" value="50" style="width:80px;">
                                        </td>
                                        <td>
                                            <div class="text-success">25</div>
                                            <small class="text-muted">Pending: 25</small>
                                        </td>
                                        <td>Rs40,000</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-outline-danger">
                                                <i class="las la-trash"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Product 2 -->
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="https://via.placeholder.com/40x40/28a745/ffffff?text=J"
                                                    class="mr-2" style="width:40px;height:40px;border-radius:4px;">
                                                <div>
                                                    <div>Denim Jeans</div>
                                                    <small class="text-muted">Size: 32, Color: Blue</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>DNM-JNS-002</td>
                                        <td>
                                            <input type="number" class="form-control form-control-sm" value="1200" style="width:100px;">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control form-control-sm" value="30" style="width:80px;">
                                        </td>
                                        <td>
                                            <div class="text-success">15</div>
                                            <small class="text-muted">Pending: 15</small>
                                        </td>
                                        <td>Rs36,000</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-outline-danger">
                                                <i class="las la-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="text-right mt-3">
                            <button type="button" class="btn btn-outline-primary">
                                <i class="las la-plus mr-2"></i>Add Product
                            </button>
                        </div>
                    </div>

                    <div class="form-section">
                        <h6 class="form-section-title">Shipping & Payment</h6>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Shipping Method</label>
                                    <select class="form-control" name="shipping_method">
                                        <option value="delivery" selected>Delivery</option>
                                        <option value="pickup">Pickup</option>
                                        <option value="express">Express</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Tracking Number</label>
                                    <input type="text" class="form-control" name="tracking_number" value="TRK123456789">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Purchase Status</label>
                                    <select class="form-control" name="purchase_status">
                                        <option value="ordered" selected>Ordered</option>
                                        <option value="received">Received</option>
                                        <option value="partially_received">Partially Received</option>
                                        <option value="cancelled">Cancelled</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Payment Status</label>
                                    <select class="form-control" name="payment_status">
                                        <option value="partial" selected>Partial</option>
                                        <option value="pending">Pending</option>
                                        <option value="paid">Paid</option>
                                        <option value="overdue">Overdue</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Amount Paid (Rs)</label>
                                    <input type="number" class="form-control" name="amount_paid" value="75000">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Balance Due (Rs)</label>
                                    <input type="number" class="form-control" value="50000" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Notes</label>
                            <textarea class="form-control" name="notes" rows="3">Please ensure quality check before delivery.</textarea>
                        </div>
                    </div>

                    <!-- History Timeline -->
                    <div class="form-section">
                        <h6 class="form-section-title">History</h6>

                        <div class="history-timeline">
                            <div class="history-item">
                                <div class="d-flex justify-content-between">
                                    <strong>Order Created</strong>
                                    <small class="text-muted">15 Jan 2024, 10:30 AM</small>
                                </div>
                                <small class="text-muted">By: Admin User</small>
                            </div>

                            <div class="history-item">
                                <div class="d-flex justify-content-between">
                                    <strong>Partial Payment Received</strong>
                                    <small class="text-muted">16 Jan 2024, 02:15 PM</small>
                                </div>
                                <small class="text-muted">Amount: Rs75,000 | By: John Manager</small>
                            </div>

                            <div class="history-item">
                                <div class="d-flex justify-content-between">
                                    <strong>Partial Goods Received</strong>
                                    <small class="text-muted">18 Jan 2024, 11:00 AM</small>
                                </div>
                                <small class="text-muted">25 shirts, 15 jeans received | By: Warehouse Staff</small>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <div>
                            <button type="button" class="btn btn-outline-danger" onclick="deletePurchase()">
                                <i class="las la-trash mr-2"></i>Delete Purchase
                            </button>
                        </div>
                        <div>
                            <a href="{{ route('purchases.show', 1) }}" class="btn btn-outline-secondary mr-2">
                                <i class="las la-times mr-2"></i>Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="las la-save mr-2"></i>Update Purchase
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Right Column: Summary -->
            <div class="col-lg-4">
                <div class="summary-card">
                    <h6>Order Summary</h6>

                    <div class="summary-item">
                        <span>Subtotal:</span>
                        <span>Rs76,000</span>
                    </div>

                    <div class="summary-item">
                        <span>Tax (18%):</span>
                        <span>Rs13,680</span>
                    </div>

                    <div class="summary-item">
                        <span>Shipping:</span>
                        <span>Rs5,000</span>
                    </div>

                    <div class="summary-item">
                        <span>Other Charges:</span>
                        <span>Rs3,000</span>
                    </div>

                    <div class="summary-item">
                        <span>Discount:</span>
                        <span>Rs2,000</span>
                    </div>

                    <div class="summary-item total">
                        <span>Grand Total:</span>
                        <span>Rs95,680</span>
                    </div>

                    <div class="summary-item">
                        <span>Amount Paid:</span>
                        <span class="text-success">Rs75,000</span>
                    </div>

                    <div class="summary-item">
                        <span>Balance Due:</span>
                        <span class="text-warning">Rs20,680</span>
                    </div>

                    <hr>

                    <!-- Quick Actions -->
                    <div class="mt-3">
                        <h6 class="mb-3">Quick Actions</h6>
                        <div class="d-grid gap-2">
                            <a href="{{ route('purchases.receive.create', 1) }}" class="btn btn-success">
                                <i class="las la-check-circle mr-2"></i> Receive Goods
                            </a>
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#makePaymentModal">
                                <i class="las la-money-bill-wave mr-2"></i> Make Payment
                            </button>
                            <button type="button" class="btn btn-info">
                                <i class="las la-file-invoice mr-2"></i> Generate Invoice
                            </button>
                            <button type="button" class="btn btn-secondary">
                                <i class="las la-print mr-2"></i> Print Order
                            </button>
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
                        <label>Payment Amount (Rs)</label>
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
            // Form submission
            $('#purchaseEditForm').submit(function(e) {
                e.preventDefault();

                // Show loading
                $('button[type="submit"]').prop('disabled', true).html('<i class="las la-spinner la-spin mr-2"></i>Updating...');

                // Simulate API call
                setTimeout(() => {
                    alert('Purchase order updated successfully!');
                    window.location.href = "{{ route('purchases.show', 1) }}";
                }, 1500);

                return false;
            });
        });

        // Delete purchase
        window.deletePurchase = function() {
            if (confirm('Are you sure you want to delete this purchase order? This action cannot be undone.')) {
                // Show loading
                $('button').prop('disabled', true);

                // Simulate delete action
                setTimeout(() => {
                    alert('Purchase order deleted successfully!');
                    window.location.href = "{{ route('purchases.index') }}";
                }, 1500);
            }
        };

        // Recalculate totals
        window.recalculateTotals = function() {
            // This would recalculate based on product quantities and prices
            alert('Totals recalculated!');
        };
    </script>
    @endpush
</x-app-layout>