<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/remixicon/fonts/remixicon.css') }}">
    <style>
        .product-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 15px;
            padding: 30px;
            color: white;
            margin-bottom: 30px;
        }
        .product-image {
            width: 150px;
            height: 150px;
            border-radius: 15px;
            object-fit: cover;
            border: 5px solid white;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        .stock-level-indicator {
            height: 10px;
            border-radius: 5px;
            margin-top: 10px;
            background: #e9ecef;
            position: relative;
        }
        .stock-level-fill {
            height: 100%;
            border-radius: 5px;
            position: absolute;
            left: 0;
            top: 0;
        }
        .branch-stock-card {
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            background: white;
            border: 1px solid #e3e6f0;
            transition: all 0.3s;
        }
        .branch-stock-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .inventory-movement {
            border-left: 4px solid #4e73df;
            padding-left: 15px;
            margin-bottom: 15px;
        }
        .movement-in {
            border-left-color: #10b981;
        }
        .movement-out {
            border-left-color: #ef4444;
        }
        .stock-alert {
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0% { opacity: 1; }
            50% { opacity: 0.7; }
            100% { opacity: 1; }
        }
        .location-badge {
            background: #f3f4f6;
            border: 1px solid #d1d5db;
            color: #6b7280;
            font-size: 12px;
            padding: 3px 8px;
            border-radius: 12px;
        }
    </style>
    @endpush

    <div class="container-fluid">
        <!-- Product Header -->
        <div class="product-header">
            <div class="row align-items-center">
                <div class="col-md-2 text-center">
                    <img src="https://via.placeholder.com/150" class="product-image" alt="Levi's 501 Jeans">
                </div>
                <div class="col-md-7">
                    <h2 class="h3 mb-2">Levi's 501 Original Jeans</h2>
                    <div class="d-flex flex-wrap mb-3">
                        <span class="badge badge-light mr-2">SKU: LS-501-BL-32</span>
                        <span class="badge badge-info mr-2">CAT-001: Men's Wear</span>
                        <span class="badge badge-primary mr-2">BR-001: Levi's</span>
                        <span class="badge badge-success">Active</span>
                    </div>
                    <p class="mb-0">Classic straight fit jeans in dark blue denim. 100% cotton.</p>
                </div>
                <div class="col-md-3 text-right">
                    <div class="h1 mb-2">$89.99</div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Cost Price:</span>
                            <span class="text-white">$45.00</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Profit Margin:</span>
                            <span class="text-success">50%</span>
                        </div>
                    </div>
                    <button class="btn btn-light btn-sm" onclick="window.history.back()">
                        <i class="las la-arrow-left mr-1"></i> Back
                    </button>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Left Column -->
            <div class="col-lg-8">
                <!-- Stock Summary -->
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="mb-0"><i class="las la-boxes mr-2"></i>Stock Summary</h6>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-toggle="dropdown">
                                <i class="las la-cog mr-1"></i> Actions
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#adjustStockModal">
                                    <i class="las la-edit mr-2"></i>Adjust Stock
                                </a>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#transferStockModal">
                                    <i class="las la-exchange-alt mr-2"></i>Transfer Stock
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="las la-plus-circle mr-2"></i>Restock
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">
                                    <i class="las la-history mr-2"></i>View History
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-3 text-center">
                                <div class="h2 text-primary mb-1">158</div>
                                <div class="text-muted">Total Stock</div>
                            </div>
                            <div class="col-md-3 text-center">
                                <div class="h2 text-success mb-1">142</div>
                                <div class="text-muted">Available</div>
                            </div>
                            <div class="col-md-3 text-center">
                                <div class="h2 text-info mb-1">12</div>
                                <div class="text-muted">Reserved</div>
                            </div>
                            <div class="col-md-3 text-center">
                                <div class="h2 text-warning mb-1">4</div>
                                <div class="text-muted">Damaged</div>
                            </div>
                        </div>

                        <!-- Stock Level Indicator -->
                        <div class="mb-4">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Stock Level: 158 units</span>
                                <span class="text-warning"><i class="las la-exclamation-triangle"></i> 8 units below minimum</span>
                            </div>
                            <div class="stock-level-indicator">
                                <div class="stock-level-fill bg-danger" style="width: 0%"></div>
                                <div class="stock-level-fill bg-warning" style="width: 15%"></div>
                                <div class="stock-level-fill bg-success" style="width: 70%"></div>
                                <div class="stock-level-fill bg-info" style="width: 15%"></div>
                            </div>
                            <div class="d-flex justify-content-between mt-2">
                                <small class="text-danger">Out of Stock (0)</small>
                                <small class="text-warning">Low Stock (10)</small>
                                <small class="text-success">Good Stock (100)</small>
                                <small class="text-info">Max (200)</small>
                            </div>
                        </div>

                        <!-- Reorder Information -->
                        <div class="alert alert-warning stock-alert">
                            <div class="d-flex align-items-center">
                                <i class="las la-exclamation-triangle fa-2x mr-3"></i>
                                <div class="flex-grow-1">
                                    <strong>Reorder Alert!</strong>
                                    <div>Current stock (158) is below reorder point (166). Recommended reorder quantity: 100 units.</div>
                                </div>
                                <button class="btn btn-sm btn-warning">
                                    <i class="las la-cart-plus mr-1"></i> Create PO
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Branch Stock Details -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="las la-store mr-2"></i>Stock by Branch</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Main Store -->
                            <div class="col-md-6">
                                <div class="branch-stock-card">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h6 class="mb-0">Main Store - Downtown</h6>
                                        <span class="badge badge-success">In Stock</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Current Stock:</span>
                                        <strong>45 units</strong>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Available:</span>
                                        <span class="text-success">40 units</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Reserved:</span>
                                        <span class="text-info">5 units</span>
                                    </div>
                                    <div class="location-info mb-2">
                                        <small class="text-muted">
                                            <i class="las la-map-marker"></i> Aisle: A3, Rack: 12, Shelf: 4
                                        </small>
                                    </div>
                                    <div class="progress mb-2" style="height: 8px;">
                                        <div class="progress-bar bg-success" style="width: 75%"></div>
                                    </div>
                                    <div class="text-right">
                                        <button class="btn btn-sm btn-outline-primary" onclick="adjustBranchStock(1)">
                                            <i class="las la-edit"></i> Adjust
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- Westside Mall -->
                            <div class="col-md-6">
                                <div class="branch-stock-card">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h6 class="mb-0">Westside Mall Branch</h6>
                                        <span class="badge badge-warning stock-alert">Low Stock</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Current Stock:</span>
                                        <strong>8 units</strong>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Available:</span>
                                        <span class="text-danger">8 units</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Reserved:</span>
                                        <span class="text-info">0 units</span>
                                    </div>
                                    <div class="location-info mb-2">
                                        <small class="text-muted">
                                            <i class="las la-map-marker"></i> Aisle: B2, Rack: 8, Shelf: 2
                                        </small>
                                    </div>
                                    <div class="progress mb-2" style="height: 8px;">
                                        <div class="progress-bar bg-warning" style="width: 20%"></div>
                                    </div>
                                    <div class="text-right">
                                        <button class="btn btn-sm btn-outline-primary" onclick="adjustBranchStock(2)">
                                            <i class="las la-edit"></i> Adjust
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- Warehouse -->
                            <div class="col-md-6">
                                <div class="branch-stock-card">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h6 class="mb-0">Warehouse - North</h6>
                                        <span class="badge badge-success">In Stock</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Current Stock:</span>
                                        <strong>92 units</strong>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Available:</span>
                                        <span class="text-success">92 units</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Reserved:</span>
                                        <span class="text-info">0 units</span>
                                    </div>
                                    <div class="location-info mb-2">
                                        <small class="text-muted">
                                            <i class="las la-map-marker"></i> Section: WH-12, Bin: B45
                                        </small>
                                    </div>
                                    <div class="progress mb-2" style="height: 8px;">
                                        <div class="progress-bar bg-success" style="width: 92%"></div>
                                    </div>
                                    <div class="text-right">
                                        <button class="btn btn-sm btn-outline-primary" onclick="adjustBranchStock(3)">
                                            <i class="las la-edit"></i> Adjust
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- East City -->
                            <div class="col-md-6">
                                <div class="branch-stock-card">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h6 class="mb-0">East City Outlet</h6>
                                        <span class="badge badge-danger">Out of Stock</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Current Stock:</span>
                                        <strong>0 units</strong>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Available:</span>
                                        <span class="text-danger">0 units</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Reserved:</span>
                                        <span class="text-info">0 units</span>
                                    </div>
                                    <div class="location-info mb-2">
                                        <small class="text-muted">
                                            <i class="las la-map-marker"></i> Aisle: C1, Rack: 5, Shelf: 3
                                        </small>
                                    </div>
                                    <div class="progress mb-2" style="height: 8px;">
                                        <div class="progress-bar bg-danger" style="width: 0%"></div>
                                    </div>
                                    <div class="text-right">
                                        <button class="btn btn-sm btn-outline-primary" onclick="adjustBranchStock(4)">
                                            <i class="las la-edit"></i> Adjust
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Stock Movements -->
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="mb-0"><i class="las la-history mr-2"></i>Recent Stock Movements</h6>
                        <a href="{{ route('inventory.movements.index') }}?product_id=1" class="btn btn-sm btn-outline-primary">
                            View All <i class="las la-arrow-right ml-1"></i>
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="inventory-movement movement-out">
                            <div class="d-flex justify-content-between">
                                <strong>Sale</strong>
                                <span class="text-danger">-2 units</span>
                            </div>
                            <div class="small text-muted">
                                <i class="las la-store"></i> Main Store | 
                                <i class="las la-user"></i> John Doe |
                                <i class="las la-clock"></i> Today, 14:30
                            </div>
                            <div>Invoice #INV-2024-00125</div>
                        </div>
                        <div class="inventory-movement movement-in">
                            <div class="d-flex justify-content-between">
                                <strong>Purchase Receipt</strong>
                                <span class="text-success">+50 units</span>
                            </div>
                            <div class="small text-muted">
                                <i class="las la-store"></i> Warehouse | 
                                <i class="las la-user"></i> Jane Smith |
                                <i class="las la-clock"></i> Jan 22, 11:15
                            </div>
                            <div>PO #PO-2024-0012</div>
                        </div>
                        <div class="inventory-movement movement-out">
                            <div class="d-flex justify-content-between">
                                <strong>Stock Transfer</strong>
                                <span class="text-danger">-15 units</span>
                            </div>
                            <div class="small text-muted">
                                <i class="las la-store"></i> Warehouse → Main Store | 
                                <i class="las la-user"></i> Robert Brown |
                                <i class="las la-clock"></i> Jan 20, 09:45
                            </div>
                            <div>Transfer #TR-2024-0045</div>
                        </div>
                        <div class="inventory-movement movement-out">
                            <div class="d-flex justify-content-between">
                                <strong>Damage Adjustment</strong>
                                <span class="text-danger">-3 units</span>
                            </div>
                            <div class="small text-muted">
                                <i class="las la-store"></i> Westside Mall | 
                                <i class="las la-user"></i> Sarah Wilson |
                                <i class="las la-clock"></i> Jan 18, 16:20
                            </div>
                            <div>Adjustment #ADJ-2024-0034</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-lg-4">
                <!-- Product Information -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="las la-info-circle mr-2"></i>Product Information</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm">
                            <tr>
                                <th width="40%">Product Code:</th>
                                <td>PR-00123</td>
                            </tr>
                            <tr>
                                <th>SKU:</th>
                                <td>LS-501-BL-32</td>
                            </tr>
                            <tr>
                                <th>Barcode:</th>
                                <td>8901234567890</td>
                            </tr>
                            <tr>
                                <th>Category:</th>
                                <td>Men's Wear > Jeans</td>
                            </tr>
                            <tr>
                                <th>Brand:</th>
                                <td>Levi's</td>
                            </tr>
                            <tr>
                                <th>Size:</th>
                                <td>32</td>
                            </tr>
                            <tr>
                                <th>Color:</th>
                                <td>Dark Blue</td>
                            </tr>
                            <tr>
                                <th>Material:</th>
                                <td>100% Cotton Denim</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- Inventory Settings -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="las la-cog mr-2"></i>Inventory Settings</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Minimum Stock Level</label>
                            <input type="number" class="form-control" value="10">
                        </div>
                        <div class="form-group">
                            <label>Maximum Stock Level</label>
                            <input type="number" class="form-control" value="100">
                        </div>
                        <div class="form-group">
                            <label>Reorder Point</label>
                            <input type="number" class="form-control" value="20">
                        </div>
                        <div class="form-group">
                            <label>Reorder Quantity</label>
                            <input type="number" class="form-control" value="50">
                        </div>
                        <div class="form-group">
                            <label>Lead Time (Days)</label>
                            <input type="number" class="form-control" value="7">
                        </div>
                        <button class="btn btn-primary btn-block">
                            <i class="las la-save mr-2"></i>Save Settings
                        </button>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="las la-bolt mr-2"></i>Quick Actions</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <button class="btn btn-outline-primary" data-toggle="modal" data-target="#adjustStockModal">
                                <i class="las la-edit mr-2"></i>Adjust Stock
                            </button>
                            <button class="btn btn-outline-success" data-toggle="modal" data-target="#transferStockModal">
                                <i class="las la-exchange-alt mr-2"></i>Transfer Stock
                            </button>
                            <button class="btn btn-outline-info">
                                <i class="las la-cart-plus mr-2"></i>Create Purchase Order
                            </button>
                            <button class="btn btn-outline-warning">
                                <i class="las la-tag mr-2"></i>Price Adjustment
                            </button>
                            <button class="btn btn-outline-danger" onclick="markAsDamaged()">
                                <i class="las la-times-circle mr-2"></i>Mark as Damaged
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Adjust Stock Modal -->
    <div class="modal fade" id="adjustStockModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="las la-edit mr-2"></i>Adjust Stock</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="adjustForm">
                        <div class="form-group">
                            <label>Select Branch</label>
                            <select class="form-control" required>
                                <option value="">Choose branch</option>
                                <option value="1">Main Store - Downtown</option>
                                <option value="2">Westside Mall Branch</option>
                                <option value="3">Warehouse - North</option>
                                <option value="4">East City Outlet</option>
                                <option value="all">All Branches</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Adjustment Type</label>
                            <select class="form-control" required>
                                <option value="">Select type</option>
                                <option value="add">Add Stock</option>
                                <option value="remove">Remove Stock</option>
                                <option value="damage">Mark as Damaged</option>
                                <option value="expired">Mark as Expired</option>
                                <option value="sample">Sample/Display</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Quantity <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" min="1" required>
                        </div>
                        <div class="form-group">
                            <label>Reason <span class="text-danger">*</span></label>
                            <textarea class="form-control" rows="3" placeholder="Enter reason for adjustment..." required></textarea>
                        </div>
                        <div class="form-group">
                            <label>Reference (Optional)</label>
                            <input type="text" class="form-control" placeholder="e.g., Invoice #, PO #, etc.">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" form="adjustForm">Save Adjustment</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Transfer Stock Modal -->
    <div class="modal fade" id="transferStockModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="las la-exchange-alt mr-2"></i>Transfer Stock</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="transferForm">
                        <div class="form-group">
                            <label>From Branch <span class="text-danger">*</span></label>
                            <select class="form-control" required>
                                <option value="">Select source branch</option>
                                <option value="1">Main Store - Downtown</option>
                                <option value="2">Westside Mall Branch</option>
                                <option value="3">Warehouse - North</option>
                                <option value="4">East City Outlet</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>To Branch <span class="text-danger">*</span></label>
                            <select class="form-control" required>
                                <option value="">Select destination branch</option>
                                <option value="1">Main Store - Downtown</option>
                                <option value="2">Westside Mall Branch</option>
                                <option value="3">Warehouse - North</option>
                                <option value="4">East City Outlet</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Quantity <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" min="1" required>
                        </div>
                        <div class="form-group">
                            <label>Transfer Date</label>
                            <input type="date" class="form-control" value="{{ date('Y-m-d') }}">
                        </div>
                        <div class="form-group">
                            <label>Notes (Optional)</label>
                            <textarea class="form-control" rows="3" placeholder="Add any notes..."></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" form="transferForm">Initiate Transfer</button>
                </div>
            </div>
        </div>
    </div>

    @push('js')
    <!-- Backend Bundle JavaScript -->
    <script src="{{ asset('backend/assets/js/backend-bundle.min.js') }}"></script>
    
    <!-- app JavaScript -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    
    <script>
        $(document).ready(function() {
            // Initialize tooltips
            $('[title]').tooltip();
        });
        
        function adjustBranchStock(branchId) {
            $('#adjustStockModal select').val(branchId);
            $('#adjustStockModal').modal('show');
        }
        
        function markAsDamaged() {
            if(confirm('Mark this product as damaged? This will reduce available stock.')) {
                $('#adjustStockModal select').val('damage');
                $('#adjustStockModal').modal('show');
            }
        }
        
        // Form submissions
        $('#adjustForm').submit(function(e) {
            e.preventDefault();
            alert('Stock adjustment saved successfully!');
            $('#adjustStockModal').modal('hide');
            // Reload or update page
        });
        
        $('#transferForm').submit(function(e) {
            e.preventDefault();
            alert('Stock transfer initiated!');
            $('#transferStockModal').modal('hide');
            // Reload or update page
        });
    </script>
    @endpush
</x-app-layout>