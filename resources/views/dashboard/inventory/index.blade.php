<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/remixicon/fonts/remixicon.css') }}">
    <style>
        .stat-card {
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            transition: transform 0.3s;
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            margin-right: 15px;
        }
        .inventory-level {
            height: 8px;
            border-radius: 4px;
            margin-top: 5px;
        }
        .product-avatar {
            width: 50px;
            height: 50px;
            border-radius: 8px;
            object-fit: cover;
            border: 2px solid #fff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .branch-selector {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
        }
        .alert-badge {
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0% { opacity: 1; }
            50% { opacity: 0.7; }
            100% { opacity: 1; }
        }
        .trend-up {
            color: #10b981;
        }
        .trend-down {
            color: #ef4444;
        }
        .inventory-table th {
            border-top: none;
            font-weight: 600;
            color: #6b7280;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
        }
    </style>
    @endpush

    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
            <div>
                <h4 class="mb-3">Inventory Dashboard</h4>
                <p class="mb-0">Monitor and manage your inventory across all branches</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Inventory</li>
                    </ol>
                </nav>
            </div>
            <div class="d-flex">
                <a href="{{ route('inventory.adjustments.create') }}" class="btn btn-primary add-list">
                    <i class="las la-plus mr-2"></i>Stock Adjustment
                </a>
                <button class="btn btn-outline-primary ml-2" onclick="exportInventory()">
                    <i class="las la-download mr-2"></i>Export Report
                </button>
                <button class="btn btn-outline-success ml-2" data-toggle="modal" data-target="#stockTransferModal">
                    <i class="las la-exchange-alt mr-2"></i>Transfer Stock
                </button>
            </div>
        </div>

        <!-- Branch Selector -->
        <div class="branch-selector">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <div class="form-group mb-0">
                        <label class="form-label"><i class="las la-store mr-2"></i>Select Branch</label>
                        <select class="form-control" id="branchSelect" onchange="changeBranch()">
                            <option value="all" selected>All Branches (Consolidated View)</option>
                            <option value="1">Main Store - Downtown</option>
                            <option value="2">Westside Mall Branch</option>
                            <option value="3">Warehouse - North</option>
                            <option value="4">East City Outlet</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group mb-0">
                        <label class="form-label"><i class="las la-filter mr-2"></i>Quick Filters</label>
                        <div class="d-flex">
                            <select class="form-control mr-2" id="categoryFilter">
                                <option value="">All Categories</option>
                                <option value="men">Men's Wear</option>
                                <option value="women">Women's Wear</option>
                                <option value="kids">Kid's Wear</option>
                                <option value="accessories">Accessories</option>
                            </select>
                            <select class="form-control" id="stockFilter">
                                <option value="">All Stock Levels</option>
                                <option value="low">Low Stock</option>
                                <option value="out">Out of Stock</option>
                                <option value="over">Overstock</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-0">
                        <label class="form-label"><i class="las la-calendar mr-2"></i>Date Range</label>
                        <input type="text" class="form-control" id="dateRange" placeholder="Select date range">
                    </div>
                </div>
            </div>
        </div>

        <!-- Key Statistics -->
        <div class="row mb-4">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="stat-card bg-primary text-white">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-white text-primary">
                            <i class="las la-boxes"></i>
                        </div>
                        <div>
                            <div class="h2 mb-0 text-white">12,458</div>
                            <div class="text-white-80">Total Stock Value</div>
                            <div class="small text-white-60">
                                <i class="las la-arrow-up trend-up"></i> 8.5% from last month
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="stat-card bg-success text-white">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-white text-success">
                            <i class="las la-tshirt"></i>
                        </div>
                        <div>
                            <div class="h2 mb-0 text-white">3,847</div>
                            <div class="text-white-80">Total Products</div>
                            <div class="small text-white-60">
                                <i class="las la-arrow-up trend-up"></i> 245 this month
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="stat-card bg-warning text-white">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-white text-warning">
                            <i class="las la-exclamation-triangle"></i>
                        </div>
                        <div>
                            <div class="h2 mb-0 text-white">48</div>
                            <div class="text-white-80">Low Stock Items</div>
                            <div class="small text-white-60">
                                <i class="las la-arrow-down trend-down"></i> 12 resolved
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="stat-card bg-danger text-white">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-white text-danger">
                            <i class="las la-times-circle"></i>
                        </div>
                        <div>
                            <div class="h2 mb-0 text-white">15</div>
                            <div class="text-white-80">Out of Stock</div>
                            <div class="small text-white-60">
                                <i class="las la-arrow-up trend-down"></i> 3 new this week
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Left Column -->
            <div class="col-lg-8">
                <!-- Inventory Summary -->
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="mb-0"><i class="las la-chart-bar mr-2"></i>Inventory Overview</h6>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown">
                                <i class="las la-filter"></i> Filter
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#" onclick="filterInventory('all')">All Products</a>
                                <a class="dropdown-item" href="#" onclick="filterInventory('low')">Low Stock Only</a>
                                <a class="dropdown-item" href="#" onclick="filterInventory('out')">Out of Stock</a>
                                <a class="dropdown-item" href="#" onclick="filterInventory('over')">Overstock</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover inventory-table">
                                <thead>
                                    <tr>
                                        <th width="40%">Product</th>
                                        <th width="15%">Current Stock</th>
                                        <th width="15%">Min/Max</th>
                                        <th width="15%">Status</th>
                                        <th width="15%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="inventoryTable">
                                    <!-- Low Stock Item -->
                                    <tr class="table-warning">
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="https://via.placeholder.com/40" class="product-avatar mr-3" alt="Product">
                                                <div>
                                                    <h6 class="mb-0">Levi's 501 Original Jeans</h6>
                                                    <small class="text-muted">CAT-001 | BR-001</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="h6 mb-0">8</div>
                                            <div class="progress inventory-level">
                                                <div class="progress-bar bg-warning" style="width: 20%"></div>
                                            </div>
                                        </td>
                                        <td>
                                            <small class="text-muted">Min: 10</small><br>
                                            <small class="text-muted">Max: 100</small>
                                        </td>
                                        <td>
                                            <span class="badge badge-warning alert-badge">
                                                <i class="las la-exclamation-circle"></i> Low Stock
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <button class="btn btn-outline-primary" onclick="restockProduct(1)">
                                                    <i class="las la-plus"></i> Restock
                                                </button>
                                                <button class="btn btn-outline-info" onclick="viewProduct(1)">
                                                    <i class="las la-eye"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Out of Stock -->
                                    <tr class="table-danger">
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="https://via.placeholder.com/40" class="product-avatar mr-3" alt="Product">
                                                <div>
                                                    <h6 class="mb-0">Levi's Denim Shorts (Blue)</h6>
                                                    <small class="text-muted">CAT-001 | BR-001</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="h6 mb-0">0</div>
                                            <div class="progress inventory-level">
                                                <div class="progress-bar bg-danger" style="width: 0%"></div>
                                            </div>
                                        </td>
                                        <td>
                                            <small class="text-muted">Min: 5</small><br>
                                            <small class="text-muted">Max: 50</small>
                                        </td>
                                        <td>
                                            <span class="badge badge-danger">
                                                <i class="las la-times-circle"></i> Out of Stock
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <button class="btn btn-outline-primary" onclick="restockProduct(2)">
                                                    <i class="las la-plus"></i> Restock
                                                </button>
                                                <button class="btn btn-outline-info" onclick="viewProduct(2)">
                                                    <i class="las la-eye"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Good Stock -->
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="https://via.placeholder.com/40" class="product-avatar mr-3" alt="Product">
                                                <div>
                                                    <h6 class="mb-0">Nike Air Max Shoes</h6>
                                                    <small class="text-muted">CAT-003 | BR-002</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="h6 mb-0">45</div>
                                            <div class="progress inventory-level">
                                                <div class="progress-bar bg-success" style="width: 75%"></div>
                                            </div>
                                        </td>
                                        <td>
                                            <small class="text-muted">Min: 10</small><br>
                                            <small class="text-muted">Max: 60</small>
                                        </td>
                                        <td>
                                            <span class="badge badge-success">
                                                <i class="las la-check-circle"></i> In Stock
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <button class="btn btn-outline-secondary" onclick="adjustStock(3)">
                                                    <i class="las la-edit"></i> Adjust
                                                </button>
                                                <button class="btn btn-outline-info" onclick="viewProduct(3)">
                                                    <i class="las la-eye"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Overstock -->
                                    <tr class="table-info">
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="https://via.placeholder.com/40" class="product-avatar mr-3" alt="Product">
                                                <div>
                                                    <h6 class="mb-0">Zara Summer Dress (Red)</h6>
                                                    <small class="text-muted">CAT-002 | BR-004</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="h6 mb-0">125</div>
                                            <div class="progress inventory-level">
                                                <div class="progress-bar bg-info" style="width: 125%"></div>
                                            </div>
                                        </td>
                                        <td>
                                            <small class="text-muted">Min: 20</small><br>
                                            <small class="text-muted">Max: 100</small>
                                        </td>
                                        <td>
                                            <span class="badge badge-info">
                                                <i class="las la-boxes"></i> Overstock
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <button class="btn btn-outline-warning" onclick="markForSale(4)">
                                                    <i class="las la-tag"></i> Markdown
                                                </button>
                                                <button class="btn btn-outline-info" onclick="viewProduct(4)">
                                                    <i class="las la-eye"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Good Stock -->
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="https://via.placeholder.com/40" class="product-avatar mr-3" alt="Product">
                                                <div>
                                                    <h6 class="mb-0">Adidas Running Shoes</h6>
                                                    <small class="text-muted">CAT-003 | BR-003</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="h6 mb-0">32</div>
                                            <div class="progress inventory-level">
                                                <div class="progress-bar bg-success" style="width: 64%"></div>
                                            </div>
                                        </td>
                                        <td>
                                            <small class="text-muted">Min: 15</small><br>
                                            <small class="text-muted">Max: 50</small>
                                        </td>
                                        <td>
                                            <span class="badge badge-success">
                                                <i class="las la-check-circle"></i> In Stock
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <button class="btn btn-outline-secondary" onclick="adjustStock(5)">
                                                    <i class="las la-edit"></i> Adjust
                                                </button>
                                                <button class="btn btn-outline-info" onclick="viewProduct(5)">
                                                    <i class="las la-eye"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Recent Stock Movements -->
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="mb-0"><i class="las la-exchange-alt mr-2"></i>Recent Stock Movements</h6>
                        <a href="{{ route('inventory.movements.index') }}" class="btn btn-sm btn-outline-primary">
                            View All <i class="las la-arrow-right ml-1"></i>
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Date & Time</th>
                                        <th>Product</th>
                                        <th>Movement Type</th>
                                        <th>Quantity</th>
                                        <th>Branch</th>
                                        <th>User</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>2024-01-25 14:30</td>
                                        <td>Levi's 501 Jeans</td>
                                        <td><span class="badge badge-success">Sale</span></td>
                                        <td class="text-danger">-2</td>
                                        <td>Main Store</td>
                                        <td>John Doe</td>
                                    </tr>
                                    <tr>
                                        <td>2024-01-25 11:15</td>
                                        <td>Nike Air Max</td>
                                        <td><span class="badge badge-primary">Purchase</span></td>
                                        <td class="text-success">+25</td>
                                        <td>Warehouse</td>
                                        <td>Jane Smith</td>
                                    </tr>
                                    <tr>
                                        <td>2024-01-24 16:45</td>
                                        <td>Zara Dress</td>
                                        <td><span class="badge badge-warning">Adjustment</span></td>
                                        <td class="text-danger">-5</td>
                                        <td>Westside Mall</td>
                                        <td>Robert Brown</td>
                                    </tr>
                                    <tr>
                                        <td>2024-01-24 10:20</td>
                                        <td>Adidas Shoes</td>
                                        <td><span class="badge badge-info">Transfer In</span></td>
                                        <td class="text-success">+15</td>
                                        <td>East City</td>
                                        <td>Sarah Wilson</td>
                                    </tr>
                                    <tr>
                                        <td>2024-01-23 15:10</td>
                                        <td>Levi's Shorts</td>
                                        <td><span class="badge badge-danger">Return</span></td>
                                        <td class="text-success">+1</td>
                                        <td>Main Store</td>
                                        <td>Mike Johnson</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-lg-4">
                <!-- Stock Alerts -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="las la-bell mr-2"></i>Stock Alerts</h6>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-warning d-flex align-items-center mb-3">
                            <i class="las la-exclamation-triangle fa-2x mr-3"></i>
                            <div>
                                <strong>48 Items Low on Stock</strong>
                                <div class="small">Below minimum threshold</div>
                            </div>
                        </div>
                        <div class="alert alert-danger d-flex align-items-center mb-3">
                            <i class="las la-times-circle fa-2x mr-3"></i>
                            <div>
                                <strong>15 Items Out of Stock</strong>
                                <div class="small">Urgent restock needed</div>
                            </div>
                        </div>
                        <div class="alert alert-info d-flex align-items-center">
                            <i class="las la-boxes fa-2x mr-3"></i>
                            <div>
                                <strong>8 Items Overstocked</strong>
                                <div class="small">Above maximum capacity</div>
                            </div>
                        </div>
                        
                        <hr>
                        
                        <div class="text-center">
                            <button class="btn btn-outline-primary btn-sm" onclick="generateReorderList()">
                                <i class="las la-list mr-1"></i> Generate Reorder List
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="las la-bolt mr-2"></i>Quick Actions</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <button class="btn btn-outline-primary" onclick="quickRestock()">
                                <i class="las la-plus-circle mr-2"></i>Quick Restock
                            </button>
                            <button class="btn btn-outline-success" onclick="bulkAdjustment()">
                                <i class="las la-edit mr-2"></i>Bulk Adjustment
                            </button>
                            <button class="btn btn-outline-info" data-toggle="modal" data-target="#stockTransferModal">
                                <i class="las la-exchange-alt mr-2"></i>Stock Transfer
                            </button>
                            <button class="btn btn-outline-warning" onclick="inventoryCount()">
                                <i class="las la-clipboard-check mr-2"></i>Start Count
                            </button>
                            <a href="{{ route('inventory.adjustments.index') }}" class="btn btn-outline-secondary">
                                <i class="las la-history mr-2"></i>View Adjustments
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Branch Stock Summary -->
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="las la-store mr-2"></i>Branch Stock Summary</h6>
                    </div>
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>Main Store</strong>
                                    <div class="small text-muted">Downtown</div>
                                </div>
                                <div class="text-right">
                                    <div class="h6 mb-0">1,245 items</div>
                                    <div class="small text-success">$45,678.90</div>
                                </div>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>Westside Mall</strong>
                                    <div class="small text-muted">Shopping Mall</div>
                                </div>
                                <div class="text-right">
                                    <div class="h6 mb-0">987 items</div>
                                    <div class="small text-success">$32,456.78</div>
                                </div>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>Warehouse North</strong>
                                    <div class="small text-muted">Storage</div>
                                </div>
                                <div class="text-right">
                                    <div class="h6 mb-0">2,345 items</div>
                                    <div class="small text-success">$67,890.12</div>
                                </div>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>East City Outlet</strong>
                                    <div class="small text-muted">Outlet Store</div>
                                </div>
                                <div class="text-right">
                                    <div class="h6 mb-0">654 items</div>
                                    <div class="small text-success">$23,456.78</div>
                                </div>
                            </div>
                        </div>
                        
                        <hr>
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <strong>Total Value:</strong>
                            <div class="h5 mb-0 text-primary">$169,482.58</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stock Transfer Modal -->
    <div class="modal fade" id="stockTransferModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="las la-exchange-alt mr-2"></i>Transfer Stock Between Branches</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="transferForm">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>From Branch <span class="text-danger">*</span></label>
                                    <select class="form-control" required>
                                        <option value="">Select Source Branch</option>
                                        <option value="1">Main Store - Downtown</option>
                                        <option value="2">Westside Mall Branch</option>
                                        <option value="3">Warehouse - North</option>
                                        <option value="4">East City Outlet</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>To Branch <span class="text-danger">*</span></label>
                                    <select class="form-control" required>
                                        <option value="">Select Destination Branch</option>
                                        <option value="1">Main Store - Downtown</option>
                                        <option value="2">Westside Mall Branch</option>
                                        <option value="3">Warehouse - North</option>
                                        <option value="4">East City Outlet</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label>Select Products to Transfer</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search product by name or SKU">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button">
                                        <i class="las la-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label>Transfer Date</label>
                            <input type="date" class="form-control" value="{{ date('Y-m-d') }}">
                        </div>
                        
                        <div class="form-group">
                            <label>Notes</label>
                            <textarea class="form-control" rows="3" placeholder="Add any notes or instructions..."></textarea>
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
    
    <!-- Date Range Picker -->
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
    
    <script>
        $(document).ready(function() {
            // Initialize date range picker
            $('#dateRange').daterangepicker({
                opens: 'left',
                startDate: moment().subtract(30, 'days'),
                endDate: moment(),
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            });
        });
        
        function changeBranch() {
            const branchId = $('#branchSelect').val();
            console.log('Changing to branch:', branchId);
            // Implement branch change logic
            alert(`Loading inventory for ${branchId === 'all' ? 'all branches' : 'selected branch'}`);
        }
        
        function filterInventory(type) {
            const rows = $('#inventoryTable tr');
            rows.hide();
            
            switch(type) {
                case 'low':
                    rows.filter('.table-warning').show();
                    break;
                case 'out':
                    rows.filter('.table-danger').show();
                    break;
                case 'over':
                    rows.filter('.table-info').show();
                    break;
                default:
                    rows.show();
            }
        }
        
        function restockProduct(productId) {
            alert(`Initiating restock for product ${productId}`);
            // Open restock modal or redirect
        }
        
        function viewProduct(productId) {
            window.location.href = `/inventory/${productId}`;
        }
        
        function adjustStock(productId) {
            alert(`Opening adjustment for product ${productId}`);
        }
        
        function markForSale(productId) {
            alert(`Marking product ${productId} for sale`);
        }
        
        function generateReorderList() {
            alert('Generating reorder list for low stock items...');
            // Implement reorder list generation
        }
        
        function quickRestock() {
            alert('Opening quick restock interface...');
        }
        
        function bulkAdjustment() {
            alert('Opening bulk adjustment interface...');
        }
        
        function inventoryCount() {
            if(confirm('Start new inventory count? This will create a new count session.')) {
                alert('Starting inventory count...');
            }
        }
        
        function exportInventory() {
            alert('Exporting inventory report...');
        }
        
        // Apply filters from top filter controls
        $('#categoryFilter, #stockFilter').change(function() {
            applyTableFilters();
        });
        
        function applyTableFilters() {
            const category = $('#categoryFilter').val();
            const stockLevel = $('#stockFilter').val();
            
            console.log('Applying filters:', { category, stockLevel });
            // Implement filter logic
        }
    </script>
    @endpush
</x-app-layout>