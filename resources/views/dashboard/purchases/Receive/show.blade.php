<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/remixicon/fonts/remixicon.css') }}">
    <style>
        .receiving-header {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
            border-radius: 10px;
            padding: 30px;
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
        }
        .receiving-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 200%;
            background: rgba(255,255,255,0.1);
            transform: rotate(30deg);
        }
        .info-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
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
        .condition-badge {
            padding: 4px 12px;
            border-radius: 4px;
            font-size: 12px;
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
        .stats-card {
            text-align: center;
            padding: 20px;
            border-radius: 10px;
            background: white;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
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
        .product-image {
            width: 60px;
            height: 60px;
            border-radius: 4px;
            object-fit: cover;
        }
    </style>
    @endpush

    <div class="container-fluid">
        <!-- Receiving Header -->
        <div class="receiving-header">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h2 class="mb-2">GRN-20240001</h2>
                    <p class="mb-2">Goods Receiving Note</p>
                    <div class="d-flex align-items-center">
                        <span class="badge badge-success mr-3">Completed</span>
                        <span><i class="las la-calendar mr-1"></i>Received: 18 Jan 2024, 11:00 AM</span>
                    </div>
                </div>
                <div class="col-md-4 text-right">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-light" onclick="window.print()">
                            <i class="las la-print mr-2"></i>Print
                        </button>
                        <button type="button" class="btn btn-light ml-2">
                            <i class="las la-file-export mr-2"></i>Export
                        </button>
                        <button type="button" class="btn btn-light ml-2 dropdown-toggle" data-toggle="dropdown">
                            <i class="las la-ellipsis-h"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#"><i class="las la-edit mr-2"></i>Edit Receiving</a>
                            <a class="dropdown-item" href="#"><i class="las la-file-invoice-dollar mr-2"></i>Generate GRN</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="#"><i class="las la-times-circle mr-2"></i>Void Receiving</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="stats-card">
                    <i class="las la-boxes fa-2x text-primary"></i>
                    <div class="stats-value">40</div>
                    <div class="stats-label">Items Received</div>
                    <small class="text-muted">This session</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <i class="las la-money-bill-wave fa-2x text-success"></i>
                    <div class="stats-value">₹36,000</div>
                    <div class="stats-label">Total Value</div>
                    <small class="text-muted">Cost value</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <i class="las la-times-circle fa-2x text-danger"></i>
                    <div class="stats-value">0</div>
                    <div class="stats-label">Damaged Items</div>
                    <small class="text-success">All good</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <i class="las la-percentage fa-2x text-warning"></i>
                    <div class="stats-value">50%</div>
                    <div class="stats-label">Order Complete</div>
                    <small class="text-warning">40/80 items</small>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Receiving Information -->
            <div class="col-md-6">
                <div class="info-card">
                    <h6><i class="las la-info-circle mr-2"></i>Receiving Information</h6>
                    <div class="info-item">
                        <div class="info-label">GRN Number</div>
                        <div class="info-value">GRN-20240001</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Purchase Order</div>
                        <div class="info-value">PO-20240001</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Supplier</div>
                        <div class="info-value">Textile Factory Ltd.</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Received Date & Time</div>
                        <div class="info-value">18 Jan 2024, 11:00 AM</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Received By</div>
                        <div class="info-value">Warehouse Staff</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Received At</div>
                        <div class="info-value">Main Store</div>
                    </div>
                </div>
            </div>

            <!-- Delivery Information -->
            <div class="col-md-6">
                <div class="info-card">
                    <h6><i class="las la-shipping-fast mr-2"></i>Delivery Information</h6>
                    <div class="info-item">
                        <div class="info-label">Delivery Person</div>
                        <div class="info-value">John Delivery</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Vehicle Number</div>
                        <div class="info-value">MH-01-AB-1234</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Delivery Method</div>
                        <div class="info-value">Supplier Delivery</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Expected Delivery</div>
                        <div class="info-value">20 Jan 2024</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Actual Delivery</div>
                        <div class="info-value text-success">18 Jan 2024 (Early)</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Received Products -->
        <div class="card mb-4">
            <div class="card-body">
                <h6>Received Products</h6>
                <p class="mb-4">Items received in this session</p>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>SKU</th>
                                <th>Cost Price</th>
                                <th>Ordered Qty</th>
                                <th>Received Qty</th>
                                <th>Condition</th>
                                <th>Batch No.</th>
                                <th>Expiry Date</th>
                                <th>Total Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Product 1 -->
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/40x40/007bff/ffffff?text=S" 
                                             class="product-image mr-2">
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
                                <td>
                                    <span class="condition-badge condition-good">Good</span>
                                </td>
                                <td>BATCH-001</td>
                                <td>N/A</td>
                                <td>₹20,000</td>
                            </tr>

                            <!-- Product 2 -->
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/40x40/28a745/ffffff?text=J" 
                                             class="product-image mr-2">
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
                                <td>
                                    <span class="condition-badge condition-good">Good</span>
                                </td>
                                <td>BATCH-002</td>
                                <td>N/A</td>
                                <td>₹18,000</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr class="table-success">
                                <th colspan="8" class="text-right">Total Received Value:</th>
                                <th>₹38,000</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <!-- Notes and Additional Information -->
        <div class="row">
            <div class="col-md-6">
                <div class="info-card">
                    <h6><i class="las la-sticky-note mr-2"></i>Notes</h6>
                    <p>All items received in good condition. Packing was proper and secure. Delivery was on time.</p>
                    <div class="mt-3">
                        <small class="text-muted"><i class="las la-history mr-1"></i>Last updated: 18 Jan 2024, 11:30 AM by Warehouse Staff</small>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="info-card">
                    <h6><i class="las la-clipboard-check mr-2"></i>Quality Check</h6>
                    <div class="info-item">
                        <div class="info-label">Quality Check Status</div>
                        <div class="info-value text-success">Passed</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Checked By</div>
                        <div class="info-value">Quality Inspector</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Check Date</div>
                        <div class="info-value">18 Jan 2024</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Remarks</div>
                        <div class="info-value">All products meet quality standards</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Signature Section -->
        <div class="card mt-4">
            <div class="card-body">
                <h6>Signatures</h6>
                <div class="row">
                    <div class="col-md-4 text-center">
                        <div class="signature-box">
                            <div class="signature-placeholder" style="height: 80px; border-bottom: 2px solid #dee2e6; margin-bottom: 10px;"></div>
                            <div class="signature-label">Received By</div>
                            <div class="signature-name">Warehouse Staff</div>
                            <small class="text-muted">Date: 18 Jan 2024</small>
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="signature-box">
                            <div class="signature-placeholder" style="height: 80px; border-bottom: 2px solid #dee2e6; margin-bottom: 10px;"></div>
                            <div class="signature-label">Delivered By</div>
                            <div class="signature-name">John Delivery</div>
                            <small class="text-muted">Supplier Representative</small>
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="signature-box">
                            <div class="signature-placeholder" style="height: 80px; border-bottom: 2px solid #dee2e6; margin-bottom: 10px;"></div>
                            <div class="signature-label">Authorized By</div>
                            <div class="signature-name">Store Manager</div>
                            <small class="text-muted">Date: 18 Jan 2024</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="d-flex justify-content-between mt-4">
            <div>
                <a href="{{ route('purchases.show', 1) }}" class="btn btn-outline-secondary">
                    <i class="las la-arrow-left mr-2"></i> Back to Purchase
                </a>
            </div>
            <div>
                <button type="button" class="btn btn-outline-primary mr-2" onclick="window.print()">
                    <i class="las la-print mr-2"></i> Print GRN
                </button>
                <button type="button" class="btn btn-primary">
                    <i class="las la-check-circle mr-2"></i> Confirm Receiving
                </button>
            </div>
        </div>
    </div>

    @push('js')
    <script src="{{ asset('backend/assets/js/backend-bundle.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Print functionality
            window.printGRN = function() {
                window.print();
            };

            // Export functionality
            window.exportGRN = function(format) {
                alert(`Exporting GRN in ${format} format...`);
            };

            // Email GRN
            window.emailGRN = function() {
                const email = 'accounts@textilefactory.com';
                const subject = 'Goods Receiving Note GRN-20240001';
                const body = 'Please find attached the goods receiving note for PO-20240001.';
                window.location.href = `mailto:${email}?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`;
            };
        });
    </script>
    @endpush
</x-app-layout>