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

        .quantity-controls {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .quantity-input {
            width: 80px;
            text-align: center;
        }

        .condition-badge {
            padding: 4px 12px;
            border-radius: 4px;
            font-size: 12px;
            cursor: pointer;
        }

        .condition-good {
            background: #d4edda;
            color: #155724;
        }

        .condition-damaged {
            background: #f8d7da;
            color: #721c24;
        }

        .condition-expired {
            background: #fff3cd;
            color: #856404;
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

        .purchase-info {
            background: #e8f4ff;
            border-left: 4px solid #007bff;
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        .receive-status {
            font-size: 12px;
            padding: 2px 8px;
            border-radius: 10px;
            margin-left: 5px;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-received {
            background: #d4edda;
            color: #155724;
        }

        .status-partial {
            background: #ffeaa7;
            color: #856404;
        }
    </style>
    @endpush

    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
            <div>
                <h4 class="mb-3">Receive Goods</h4>
                <p class="mb-0">Receive items for purchase order</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('purchases.index') }}">Purchases</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('purchases.show', 1) }}">PO-20240001</a></li>
                        <li class="breadcrumb-item active">Receive Goods</li>
                    </ol>
                </nav>
            </div>
            <div>
                <a href="{{ route('purchases.show', 1) }}" class="btn btn-outline-secondary">
                    <i class="las la-times mr-2"></i>Cancel
                </a>
                <button type="submit" form="receiveForm" class="btn btn-primary ml-2">
                    <i class="las la-check-circle mr-2"></i>Complete Receiving
                </button>
            </div>
        </div>

        <!-- Purchase Information -->
        <div class="purchase-info">
            <div class="row">
                <div class="col-md-3">
                    <div><strong>Purchase Order:</strong> PO-20240001</div>
                </div>
                <div class="col-md-3">
                    <div><strong>Supplier:</strong> Textile Factory Ltd.</div>
                </div>
                <div class="col-md-3">
                    <div><strong>Expected Delivery:</strong> 20 Jan 2024</div>
                </div>
                <div class="col-md-3">
                    <div><strong>Received Status:</strong> 40/80 items</div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Left Column: Receive Form -->
            <div class="col-lg-8">
                <form id="receiveForm" action="{{ route('purchases.receive.store', 1) }}" method="POST">
                    @csrf

                    <div class="form-section">
                        <h6 class="form-section-title">Receiving Details</h6>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Receiving Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="receive_date" value="{{ date('Y-m-d') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Receiving Time</label>
                                    <input type="time" class="form-control" name="receive_time" value="{{ date('H:i') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Received By <span class="text-danger">*</span></label>
                                    <select class="form-control" name="received_by" required>
                                        <option value="">Select Staff</option>
                                        <option value="1" selected>Warehouse Staff</option>
                                        <option value="2">Admin User</option>
                                        <option value="3">Store Manager</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Received At</label>
                                    <select class="form-control" name="branch_id" required>
                                        <option value="1" selected>Main Store</option>
                                        <option value="2">South Branch</option>
                                        <option value="3">Warehouse</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Delivery Person</label>
                            <input type="text" class="form-control" name="delivery_person" placeholder="Enter delivery person name">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Vehicle Number</label>
                            <input type="text" class="form-control" name="vehicle_number" placeholder="Enter vehicle number">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Notes</label>
                            <textarea class="form-control" name="notes" rows="3" placeholder="Enter any notes about this delivery"></textarea>
                        </div>
                    </div>

                    <div class="form-section">
                        <h6 class="form-section-title">Products to Receive</h6>

                        <!-- Product 1 -->
                        <div class="product-item">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div class="d-flex align-items-center">
                                    <img src="https://via.placeholder.com/60x60/007bff/ffffff?text=S"
                                        style="width:60px;height:60px;border-radius:4px;margin-right:15px;">
                                    <div>
                                        <h6 class="mb-0">Cotton Formal Shirt</h6>
                                        <small class="text-muted">SKU: CTN-SHT-001 | Size: M, Color: White</small>
                                        <div class="small">
                                            <span class="text-danger">Cost: Rs800</span> |
                                            <span>Ordered: 50</span> |
                                            <span class="text-success">Received: 25</span> |
                                            <span class="text-warning">Pending: 25</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="receive-status status-partial">Partial</div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Quantity Received</label>
                                        <div class="quantity-controls">
                                            <input type="number" class="form-control quantity-input"
                                                name="products[1][quantity]" value="10" min="0" max="25">
                                            <small class="text-muted">Max: 25</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Condition</label>
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            <label class="btn btn-outline-success active">
                                                <input type="radio" name="products[1][condition]" value="good" checked> Good
                                            </label>
                                            <label class="btn btn-outline-danger">
                                                <input type="radio" name="products[1][condition]" value="damaged"> Damaged
                                            </label>
                                            <label class="btn btn-outline-warning">
                                                <input type="radio" name="products[1][condition]" value="expired"> Expired
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Batch Number</label>
                                <input type="text" class="form-control" name="products[1][batch_number]" placeholder="Enter batch number">
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Expiry Date</label>
                                        <input type="date" class="form-control" name="products[1][expiry_date]">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Manufacturing Date</label>
                                        <input type="date" class="form-control" name="products[1][manufacturing_date]">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Rejection Reason (if any)</label>
                                <textarea class="form-control" name="products[1][rejection_reason]" rows="2" placeholder="If rejected, specify reason"></textarea>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="products[1][restock]" id="restock1" checked>
                                <label class="form-check-label" for="restock1">Restock to inventory</label>
                            </div>
                        </div>

                        <!-- Product 2 -->
                        <div class="product-item">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div class="d-flex align-items-center">
                                    <img src="https://via.placeholder.com/60x60/28a745/ffffff?text=J"
                                        style="width:60px;height:60px;border-radius:4px;margin-right:15px;">
                                    <div>
                                        <h6 class="mb-0">Denim Jeans</h6>
                                        <small class="text-muted">SKU: DNM-JNS-002 | Size: 32, Color: Blue</small>
                                        <div class="small">
                                            <span class="text-danger">Cost: Rs1,200</span> |
                                            <span>Ordered: 30</span> |
                                            <span class="text-success">Received: 15</span> |
                                            <span class="text-warning">Pending: 15</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="receive-status status-partial">Partial</div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Quantity Received</label>
                                        <div class="quantity-controls">
                                            <input type="number" class="form-control quantity-input"
                                                name="products[2][quantity]" value="5" min="0" max="15">
                                            <small class="text-muted">Max: 15</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Condition</label>
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            <label class="btn btn-outline-success active">
                                                <input type="radio" name="products[2][condition]" value="good" checked> Good
                                            </label>
                                            <label class="btn btn-outline-danger">
                                                <input type="radio" name="products[2][condition]" value="damaged"> Damaged
                                            </label>
                                            <label class="btn btn-outline-warning">
                                                <input type="radio" name="products[2][condition]" value="expired"> Expired
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Batch Number</label>
                                <input type="text" class="form-control" name="products[2][batch_number]" placeholder="Enter batch number">
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Expiry Date</label>
                                        <input type="date" class="form-control" name="products[2][expiry_date]">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Manufacturing Date</label>
                                        <input type="date" class="form-control" name="products[2][manufacturing_date]">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Rejection Reason (if any)</label>
                                <textarea class="form-control" name="products[2][rejection_reason]" rows="2" placeholder="If rejected, specify reason"></textarea>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="products[2][restock]" id="restock2" checked>
                                <label class="form-check-label" for="restock2">Restock to inventory</label>
                            </div>
                        </div>
                    </div>

                    <!-- Damaged Items Section -->
                    <div class="form-section">
                        <h6 class="form-section-title">Damaged/Rejected Items</h6>

                        <div class="form-group">
                            <label class="form-label">Total Damaged Items</label>
                            <input type="number" class="form-control" name="total_damaged" value="0" min="0">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Damaged Items Value (Rs)</label>
                            <input type="number" class="form-control" name="damaged_value" value="0" min="0" step="0.01">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Rejection Reason</label>
                            <textarea class="form-control" name="rejection_reason" rows="3" placeholder="Specify reason for damaged/rejected items"></textarea>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Action for Damaged Items</label>
                            <select class="form-control" name="damaged_action">
                                <option value="return">Return to Supplier</option>
                                <option value="discard">Discard</option>
                                <option value="repair">Send for Repair</option>
                                <option value="store">Store Separately</option>
                            </select>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-outline-secondary" onclick="window.history.back()">
                            <i class="las la-arrow-left mr-2"></i> Back
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="las la-check-circle mr-2"></i> Complete Receiving
                        </button>
                    </div>
                </form>
            </div>

            <!-- Right Column: Summary -->
            <div class="col-lg-4">
                <div class="summary-card">
                    <h6>Receiving Summary</h6>

                    <div class="summary-item">
                        <span>Total Items to Receive:</span>
                        <span id="totalItems">40</span>
                    </div>

                    <div class="summary-item">
                        <span>Items Being Received:</span>
                        <span id="receivingItems">15</span>
                    </div>

                    <div class="summary-item">
                        <span>Good Condition:</span>
                        <span id="goodItems">15</span>
                    </div>

                    <div class="summary-item">
                        <span>Damaged Items:</span>
                        <span id="damagedItems">0</span>
                    </div>

                    <div class="summary-item">
                        <span>Total Value:</span>
                        <span id="totalValue">Rs17,000</span>
                    </div>

                    <div class="summary-item">
                        <span>Damaged Value:</span>
                        <span id="damagedValue">Rs0.00</span>
                    </div>

                    <div class="summary-item total">
                        <span>Net Value:</span>
                        <span id="netValue">Rs17,000</span>
                    </div>

                    <hr>

                    <!-- Quick Actions -->
                    <div class="mt-3">
                        <h6 class="mb-3">Quick Actions</h6>
                        <div class="d-grid gap-2">
                            <button type="button" class="btn btn-outline-success" onclick="receiveAllGood()">
                                <i class="las la-check-double mr-2"></i> Receive All as Good
                            </button>
                            <button type="button" class="btn btn-outline-warning" onclick="receivePartial()">
                                <i class="las la-percentage mr-2"></i> Receive 50% Each
                            </button>
                            <button type="button" class="btn btn-outline-danger" onclick="clearAll()">
                                <i class="las la-times-circle mr-2"></i> Clear All
                            </button>
                        </div>
                    </div>

                    <!-- Receiving Status -->
                    <div class="mt-4">
                        <h6 class="mb-3">Receiving Progress</h6>
                        <div class="progress" style="height: 20px;">
                            <div class="progress-bar bg-success" style="width: 50%">50%</div>
                            <div class="progress-bar bg-warning" style="width: 19%">19%</div>
                            <div class="progress-bar bg-danger" style="width: 0%">0%</div>
                        </div>
                        <div class="mt-2">
                            <small class="text-success"><i class="las la-check-circle"></i> Received: 50%</small>
                            <small class="text-warning ml-2"><i class="las la-clock"></i> This Session: 19%</small>
                            <small class="text-danger ml-2"><i class="las la-times-circle"></i> Pending: 31%</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
    <script src="{{ asset('backend/assets/js/backend-bundle.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Update summary on quantity change
            $('.quantity-input').on('change', updateSummary);

            // Update condition counts
            $('input[type="radio"][name*="condition"]').on('change', updateSummary);

            // Form submission
            $('#receiveForm').submit(function(e) {
                e.preventDefault();

                // Validate form
                const receivedBy = $('select[name="received_by"]').val();
                if (!receivedBy) {
                    alert('Please select who received the goods');
                    return false;
                }

                const totalReceiving = parseInt($('#receivingItems').text()) || 0;
                if (totalReceiving === 0) {
                    alert('Please enter quantity for at least one product');
                    return false;
                }

                // Show loading
                $('button[type="submit"]').prop('disabled', true).html('<i class="las la-spinner la-spin mr-2"></i>Processing...');

                // Prepare form data
                const formData = $(this).serializeArray();

                // Simulate API call
                setTimeout(() => {
                    console.log('Form data:', formData);
                    alert('Goods received successfully!');
                    window.location.href = "{{ route('purchases.show', 1) }}";
                }, 1500);

                return false;
            });
        });

        // Update summary
        function updateSummary() {
            let receivingItems = 0;
            let goodItems = 0;
            let damagedItems = 0;
            let totalValue = 0;

            // Calculate for each product
            $('.product-item').each(function() {
                const quantityInput = $(this).find('.quantity-input');
                const quantity = parseInt(quantityInput.val()) || 0;
                const cost = parseFloat($(this).find('.text-danger').text().replace('Cost: Rs', '')) || 0;
                const condition = $(this).find('input[type="radio"][name*="condition"]:checked').val();

                receivingItems += quantity;
                totalValue += quantity * cost;

                if (condition === 'good') {
                    goodItems += quantity;
                } else if (condition === 'damaged' || condition === 'expired') {
                    damagedItems += quantity;
                }
            });

            // Update summary display
            $('#receivingItems').text(receivingItems);
            $('#goodItems').text(goodItems);
            $('#damagedItems').text(damagedItems);
            $('#totalValue').text('Rs' + totalValue.toFixed(2));

            // Update damaged value (assuming 100% loss for damaged items)
            const damagedValue = damagedItems * 100; // This should be calculated properly
            $('#damagedValue').text('Rs' + damagedValue.toFixed(2));
            $('#netValue').text('Rs' + (totalValue - damagedValue).toFixed(2));

            // Update damaged items field
            $('input[name="total_damaged"]').val(damagedItems);
            $('input[name="damaged_value"]').val(damagedValue);
        }

        // Quick actions
        window.receiveAllGood = function() {
            $('.quantity-input').each(function() {
                const max = parseInt($(this).attr('max')) || 0;
                $(this).val(max);
            });

            $('input[type="radio"][name*="condition"][value="good"]').prop('checked', true);
            $('.btn-outline-success').addClass('active');
            $('.btn-outline-danger, .btn-outline-warning').removeClass('active');

            updateSummary();
            alert('All items set to maximum quantity and good condition!');
        };

        window.receivePartial = function() {
            $('.quantity-input').each(function() {
                const max = parseInt($(this).attr('max')) || 0;
                const half = Math.ceil(max * 0.5);
                $(this).val(half);
            });

            updateSummary();
            alert('All items set to 50% of remaining quantity!');
        };

        window.clearAll = function() {
            if (confirm('Clear all quantities?')) {
                $('.quantity-input').val(0);
                updateSummary();
            }
        };

        // Auto-calculate damaged value
        $('input[name="total_damaged"]').on('change', function() {
            const damagedCount = parseInt($(this).val()) || 0;
            const avgCost = 100; // This should be calculated from products
            const damagedValue = damagedCount * avgCost;
            $('input[name="damaged_value"]').val(damagedValue);
            updateSummary();
        });
    </script>
    @endpush
</x-app-layout>