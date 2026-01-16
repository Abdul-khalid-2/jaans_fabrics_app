<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/remixicon/fonts/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/datatables/datatables.min.css') }}">
    @endpush

    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
            <div>
                <h4 class="mb-3">Stock Levels Report</h4>
                <p class="mb-0">Monitor inventory levels, stock values, and reorder points</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#">Reports</a></li>
                        <li class="breadcrumb-item active">Stock Levels</li>
                    </ol>
                </nav>
            </div>
            <div>
                <button class="btn btn-outline-primary" onclick="exportStockReport()">
                    <i class="las la-file-excel mr-2"></i>Export
                </button>
                <button class="btn btn-primary ml-2" onclick="printStockReport()">
                    <i class="las la-print mr-2"></i>Print
                </button>
                <button class="btn btn-success ml-2" onclick="generateReorderList()">
                    <i class="las la-clipboard-list mr-2"></i>Reorder List
                </button>
            </div>
        </div>

        <!-- Filters -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label">Branch</label>
                            <select class="form-control" id="stockBranchFilter">
                                <option value="">All Branches</option>
                                <option value="1" selected>Main Store</option>
                                <option value="2">Warehouse</option>
                                <option value="3">Outlet 1</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label">Category</label>
                            <select class="form-control" id="stockCategoryFilter">
                                <option value="">All Categories</option>
                                <option value="men">Men's Wear</option>
                                <option value="women">Women's Wear</option>
                                <option value="kids">Kid's Wear</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label">Brand</label>
                            <select class="form-control" id="stockBrandFilter">
                                <option value="">All Brands</option>
                                <option value="nike">Nike</option>
                                <option value="adidas">Adidas</option>
                                <option value="puma">Puma</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label">Stock Status</label>
                            <select class="form-control" id="stockStatusFilter">
                                <option value="">All Status</option>
                                <option value="low">Low Stock</option>
                                <option value="out">Out of Stock</option>
                                <option value="over">Overstock</option>
                                <option value="normal">Normal</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label">Sort By</label>
                            <select class="form-control" id="stockSortBy">
                                <option value="quantity">Quantity</option>
                                <option value="value">Stock Value</option>
                                <option value="days">Days in Stock</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <button class="btn btn-primary btn-block" onclick="loadStockReport()">
                                <i class="las la-filter mr-2"></i>Filter
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Summary Stats -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Stock Value</div>
                                <div class="h3 mb-0 font-weight-bold text-gray-800">Rs 245,800</div>
                                <div class="mt-2 mb-0 text-muted text-xs">
                                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 8.5%</span>
                                    <span>from last month</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="las la-boxes fa-2x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Low Stock Items</div>
                                <div class="h3 mb-0 font-weight-bold text-gray-800">18</div>
                                <div class="mt-2 mb-0 text-muted text-xs">
                                    <span class="text-danger mr-2"><i class="fa fa-arrow-up"></i> 3.2%</span>
                                    <span>needs attention</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="las la-exclamation-triangle fa-2x text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    Out of Stock</div>
                                <div class="h3 mb-0 font-weight-bold text-gray-800">5</div>
                                <div class="mt-2 mb-0 text-muted text-xs">
                                    <span class="text-danger mr-2"><i class="fa fa-arrow-up"></i> 1.5%</span>
                                    <span>critical items</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="las la-times-circle fa-2x text-danger"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Total SKUs</div>
                                <div class="h3 mb-0 font-weight-bold text-gray-800">1,681</div>
                                <div class="mt-2 mb-0 text-muted text-xs">
                                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 5.2%</span>
                                    <span>active products</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="las la-barcode fa-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stock Analysis Charts -->
        <div class="row mb-4">
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Stock Status Distribution</h6>
                    </div>
                    <div class="card-body">
                        <canvas id="stockStatusChart" height="250"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Stock Value by Category</h6>
                    </div>
                    <div class="card-body">
                        <canvas id="categoryValueChart" height="250"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stock Levels Table -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Current Stock Levels</h6>
                <div class="dropdown">
                    <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" id="stockTableOptions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="las la-columns"></i> View Options
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="stockTableOptions">
                        <a class="dropdown-item" href="#" onclick="showLowStockOnly()">Show Low Stock Only</a>
                        <a class="dropdown-item" href="#" onclick="showOutOfStockOnly()">Show Out of Stock</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" onclick="showAllStock()">Show All Stock</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="stockLevelsTable" width="100%" cellspacing="0">
                        <thead class="thead-light">
                            <tr>
                                <th>Product</th>
                                <th>SKU</th>
                                <th>Category</th>
                                <th>Brand</th>
                                <th class="text-right">Current Stock</th>
                                <th class="text-right">Min Level</th>
                                <th class="text-right">Max Level</th>
                                <th class="text-right">Reorder Qty</th>
                                <th class="text-right">Unit Cost</th>
                                <th class="text-right">Stock Value</th>
                                <th>Status</th>
                                <th>Last Received</th>
                                <th>Last Sold</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Product 1 -->
                            <tr class="stock-row" data-status="low">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/40x40/007bff/ffffff?text=P1" class="rounded mr-2" alt="Product">
                                        <div class="font-weight-bold">Premium T-Shirt</div>
                                    </div>
                                </td>
                                <td>TS-M-XL-001</td>
                                <td>Men</td>
                                <td>Nike</td>
                                <td class="text-right font-weight-bold text-warning">8</td>
                                <td class="text-right">15</td>
                                <td class="text-right">100</td>
                                <td class="text-right">50</td>
                                <td class="text-right">Rs 850</td>
                                <td class="text-right font-weight-bold">Rs 6,800</td>
                                <td>
                                    <span class="badge badge-warning">Low Stock</span>
                                </td>
                                <td>15-01-2024</td>
                                <td>14-01-2024</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-warning" onclick="reorderProduct('TS-M-XL-001')">
                                        <i class="las la-shopping-cart"></i> Reorder
                                    </button>
                                </td>
                            </tr>
                            
                            <!-- Product 2 -->
                            <tr class="stock-row" data-status="normal">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/40x40/007bff/ffffff?text=P2" class="rounded mr-2" alt="Product">
                                        <div class="font-weight-bold">Designer Jeans</div>
                                    </div>
                                </td>
                                <td>DJ-W-32-001</td>
                                <td>Women</td>
                                <td>Levi's</td>
                                <td class="text-right font-weight-bold">42</td>
                                <td class="text-right">20</td>
                                <td class="text-right">80</td>
                                <td class="text-right">40</td>
                                <td class="text-right">Rs 1,250</td>
                                <td class="text-right font-weight-bold">Rs 52,500</td>
                                <td>
                                    <span class="badge badge-success">Normal</span>
                                </td>
                                <td>12-01-2024</td>
                                <td>15-01-2024</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-secondary" onclick="viewProduct('DJ-W-32-001')">
                                        <i class="las la-eye"></i> View
                                    </button>
                                </td>
                            </tr>
                            
                            <!-- Product 3 -->
                            <tr class="stock-row" data-status="normal">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/40x40/007bff/ffffff?text=P3" class="rounded mr-2" alt="Product">
                                        <div class="font-weight-bold">Running Shoes</div>
                                    </div>
                                </td>
                                <td>RS-M-10-001</td>
                                <td>Men</td>
                                <td>Adidas</td>
                                <td class="text-right font-weight-bold">65</td>
                                <td class="text-right">15</td>
                                <td class="text-right">120</td>
                                <td class="text-right">60</td>
                                <td class="text-right">Rs 2,500</td>
                                <td class="text-right font-weight-bold">Rs 162,500</td>
                                <td>
                                    <span class="badge badge-success">Normal</span>
                                </td>
                                <td>10-01-2024</td>
                                <td>13-01-2024</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-secondary" onclick="viewProduct('RS-M-10-001')">
                                        <i class="las la-eye"></i> View
                                    </button>
                                </td>
                            </tr>
                            
                            <!-- Product 4 -->
                            <tr class="stock-row" data-status="over">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/40x40/007bff/ffffff?text=P4" class="rounded mr-2" alt="Product">
                                        <div class="font-weight-bold">Winter Jacket</div>
                                    </div>
                                </td>
                                <td>WJ-M-L-001</td>
                                <td>Men</td>
                                <td>Puma</td>
                                <td class="text-right font-weight-bold">135</td>
                                <td class="text-right">10</td>
                                <td class="text-right">100</td>
                                <td class="text-right">30</td>
                                <td class="text-right">Rs 3,200</td>
                                <td class="text-right font-weight-bold">Rs 432,000</td>
                                <td>
                                    <span class="badge badge-info">Overstock</span>
                                </td>
                                <td>05-01-2024</td>
                                <td>12-01-2024</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-secondary" onclick="viewProduct('WJ-M-L-001')">
                                        <i class="las la-eye"></i> View
                                    </button>
                                </td>
                            </tr>
                            
                            <!-- Product 5 -->
                            <tr class="stock-row" data-status="low">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/40x40/007bff/ffffff?text=P5" class="rounded mr-2" alt="Product">
                                        <div class="font-weight-bold">Formal Shirt</div>
                                    </div>
                                </td>
                                <td>FS-M-L-001</td>
                                <td>Men</td>
                                <td>Raymond</td>
                                <td class="text-right font-weight-bold text-warning">12</td>
                                <td class="text-right">15</td>
                                <td class="text-right">90</td>
                                <td class="text-right">45</td>
                                <td class="text-right">Rs 1,800</td>
                                <td class="text-right font-weight-bold">Rs 21,600</td>
                                <td>
                                    <span class="badge badge-warning">Low Stock</span>
                                </td>
                                <td>08-01-2024</td>
                                <td>15-01-2024</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-warning" onclick="reorderProduct('FS-M-L-001')">
                                        <i class="las la-shopping-cart"></i> Reorder
                                    </button>
                                </td>
                            </tr>
                            
                            <!-- Product 6 -->
                            <tr class="stock-row" data-status="normal">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/40x40/007bff/ffffff?text=P6" class="rounded mr-2" alt="Product">
                                        <div class="font-weight-bold">Summer Dress</div>
                                    </div>
                                </td>
                                <td>SD-W-M-001</td>
                                <td>Women</td>
                                <td>Zara</td>
                                <td class="text-right font-weight-bold">58</td>
                                <td class="text-right">12</td>
                                <td class="text-right">80</td>
                                <td class="text-right">40</td>
                                <td class="text-right">Rs 2,100</td>
                                <td class="text-right font-weight-bold">Rs 121,800</td>
                                <td>
                                    <span class="badge badge-success">Normal</span>
                                </td>
                                <td>14-01-2024</td>
                                <td>15-01-2024</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-secondary" onclick="viewProduct('SD-W-M-001')">
                                        <i class="las la-eye"></i> View
                                    </button>
                                </td>
                            </tr>
                            
                            <!-- Product 7 -->
                            <tr class="stock-row" data-status="out">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/40x40/007bff/ffffff?text=P7" class="rounded mr-2" alt="Product">
                                        <div class="font-weight-bold">Kid's T-Shirt</div>
                                    </div>
                                </td>
                                <td>KT-K-M-001</td>
                                <td>Kids</td>
                                <td>H&M</td>
                                <td class="text-right font-weight-bold text-danger">0</td>
                                <td class="text-right">10</td>
                                <td class="text-right">60</td>
                                <td class="text-right">30</td>
                                <td class="text-right">Rs 450</td>
                                <td class="text-right font-weight-bold">Rs 0</td>
                                <td>
                                    <span class="badge badge-danger">Out of Stock</span>
                                </td>
                                <td>20-12-2023</td>
                                <td>10-01-2024</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-warning" onclick="reorderProduct('KT-K-M-001')">
                                        <i class="las la-shopping-cart"></i> Reorder
                                    </button>
                                </td>
                            </tr>
                            
                            <!-- Product 8 -->
                            <tr class="stock-row" data-status="normal">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/40x40/007bff/ffffff?text=P8" class="rounded mr-2" alt="Product">
                                        <div class="font-weight-bold">Sports Shoes</div>
                                    </div>
                                </td>
                                <td>SS-M-9-001</td>
                                <td>Men</td>
                                <td>Nike</td>
                                <td class="text-right font-weight-bold">85</td>
                                <td class="text-right">20</td>
                                <td class="text-right">150</td>
                                <td class="text-right">75</td>
                                <td class="text-right">Rs 3,500</td>
                                <td class="text-right font-weight-bold">Rs 297,500</td>
                                <td>
                                    <span class="badge badge-success">Normal</span>
                                </td>
                                <td>12-01-2024</td>
                                <td>14-01-2024</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-secondary" onclick="viewProduct('SS-M-9-001')">
                                        <i class="las la-eye"></i> View
                                    </button>
                                </td>
                            </tr>
                            
                            <!-- Product 9 -->
                            <tr class="stock-row" data-status="low">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/40x40/007bff/ffffff?text=P9" class="rounded mr-2" alt="Product">
                                        <div class="font-weight-bold">Casual Shirt</div>
                                    </div>
                                </td>
                                <td>CS-M-L-001</td>
                                <td>Men</td>
                                <td>UCB</td>
                                <td class="text-right font-weight-bold text-warning">9</td>
                                <td class="text-right">15</td>
                                <td class="text-right">100</td>
                                <td class="text-right">50</td>
                                <td class="text-right">Rs 1,500</td>
                                <td class="text-right font-weight-bold">Rs 13,500</td>
                                <td>
                                    <span class="badge badge-warning">Low Stock</span>
                                </td>
                                <td>10-01-2024</td>
                                <td>15-01-2024</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-warning" onclick="reorderProduct('CS-M-L-001')">
                                        <i class="las la-shopping-cart"></i> Reorder
                                    </button>
                                </td>
                            </tr>
                            
                            <!-- Product 10 -->
                            <tr class="stock-row" data-status="normal">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/40x40/007bff/ffffff?text=P10" class="rounded mr-2" alt="Product">
                                        <div class="font-weight-bold">Leather Jacket</div>
                                    </div>
                                </td>
                                <td>LJ-M-L-001</td>
                                <td>Men</td>
                                <td>Jack & Jones</td>
                                <td class="text-right font-weight-bold">28</td>
                                <td class="text-right">5</td>
                                <td class="text-right">50</td>
                                <td class="text-right">25</td>
                                <td class="text-right">Rs 5,800</td>
                                <td class="text-right font-weight-bold">Rs 162,400</td>
                                <td>
                                    <span class="badge badge-success">Normal</span>
                                </td>
                                <td>05-01-2024</td>
                                <td>12-01-2024</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-secondary" onclick="viewProduct('LJ-M-L-001')">
                                        <i class="las la-eye"></i> View
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot class="font-weight-bold">
                            <tr>
                                <td colspan="9" class="text-right">Total Stock Value:</td>
                                <td class="text-right">Rs 1,273,600</td>
                                <td colspan="4"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <!-- Low Stock Alert Section -->
        <div class="card border-left-warning shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center bg-warning">
                <h6 class="m-0 font-weight-bold text-dark">
                    <i class="las la-exclamation-triangle mr-2"></i>Low Stock Alerts
                </h6>
                <button class="btn btn-sm btn-dark" onclick="printReorderList()">
                    <i class="las la-print mr-1"></i> Print List
                </button>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Alert 1 -->
                    <div class="col-md-4 mb-3">
                        <div class="card border-warning">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="font-weight-bold mb-1">Premium T-Shirt</h6>
                                        <small class="text-muted">SKU: TS-M-XL-001</small>
                                        <div class="mt-2">
                                            <span class="badge badge-warning">Current: 8</span>
                                            <span class="badge badge-secondary ml-2">Min: 15</span>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div class="font-weight-bold text-danger">Rs 850</div>
                                        <small class="text-muted">unit cost</small>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-sm btn-warning btn-block" onclick="quickReorder('TS-M-XL-001')">
                                        <i class="las la-cart-plus mr-1"></i> Quick Reorder
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Alert 2 -->
                    <div class="col-md-4 mb-3">
                        <div class="card border-warning">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="font-weight-bold mb-1">Formal Shirt</h6>
                                        <small class="text-muted">SKU: FS-M-L-001</small>
                                        <div class="mt-2">
                                            <span class="badge badge-warning">Current: 12</span>
                                            <span class="badge badge-secondary ml-2">Min: 15</span>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div class="font-weight-bold text-danger">Rs 1,800</div>
                                        <small class="text-muted">unit cost</small>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-sm btn-warning btn-block" onclick="quickReorder('FS-M-L-001')">
                                        <i class="las la-cart-plus mr-1"></i> Quick Reorder
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Alert 3 -->
                    <div class="col-md-4 mb-3">
                        <div class="card border-warning">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="font-weight-bold mb-1">Casual Shirt</h6>
                                        <small class="text-muted">SKU: CS-M-L-001</small>
                                        <div class="mt-2">
                                            <span class="badge badge-warning">Current: 9</span>
                                            <span class="badge badge-secondary ml-2">Min: 15</span>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div class="font-weight-bold text-danger">Rs 1,500</div>
                                        <small class="text-muted">unit cost</small>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-sm btn-warning btn-block" onclick="quickReorder('CS-M-L-001')">
                                        <i class="las la-cart-plus mr-1"></i> Quick Reorder
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Alert 4 -->
                    <div class="col-md-4 mb-3">
                        <div class="card border-warning">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="font-weight-bold mb-1">Kid's T-Shirt</h6>
                                        <small class="text-muted">SKU: KT-K-M-001</small>
                                        <div class="mt-2">
                                            <span class="badge badge-danger">Current: 0</span>
                                            <span class="badge badge-secondary ml-2">Min: 10</span>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div class="font-weight-bold text-danger">Rs 450</div>
                                        <small class="text-muted">unit cost</small>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-sm btn-warning btn-block" onclick="quickReorder('KT-K-M-001')">
                                        <i class="las la-cart-plus mr-1"></i> Quick Reorder
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Alert 5 -->
                    <div class="col-md-4 mb-3">
                        <div class="card border-warning">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="font-weight-bold mb-1">Running Shorts</h6>
                                        <small class="text-muted">SKU: LOW-005</small>
                                        <div class="mt-2">
                                            <span class="badge badge-warning">Current: 6</span>
                                            <span class="badge badge-secondary ml-2">Min: 12</span>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div class="font-weight-bold text-danger">Rs 1,200</div>
                                        <small class="text-muted">unit cost</small>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-sm btn-warning btn-block" onclick="quickReorder('LOW-005')">
                                        <i class="las la-cart-plus mr-1"></i> Quick Reorder
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Alert 6 -->
                    <div class="col-md-4 mb-3">
                        <div class="card border-warning">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="font-weight-bold mb-1">Sports Cap</h6>
                                        <small class="text-muted">SKU: LOW-006</small>
                                        <div class="mt-2">
                                            <span class="badge badge-warning">Current: 7</span>
                                            <span class="badge badge-secondary ml-2">Min: 15</span>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div class="font-weight-bold text-danger">Rs 650</div>
                                        <small class="text-muted">unit cost</small>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-sm btn-warning btn-block" onclick="quickReorder('LOW-006')">
                                        <i class="las la-cart-plus mr-1"></i> Quick Reorder
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
    <!-- Backend Bundle JavaScript -->
    <script src="{{ asset('backend/assets/js/backend-bundle.min.js') }}"></script>
    
    <!-- Chart.js -->
    <script src="{{ asset('backend/assets/vendor/chart.js/Chart.min.js') }}"></script>
    
    <!-- DataTables -->
    <script src="{{ asset('backend/assets/vendor/datatables/datatables.min.js') }}"></script>
    
    <!-- app JavaScript -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    
    <script>
    $(document).ready(function() {
        // Initialize DataTable
        $('#stockLevelsTable').DataTable({
            pageLength: 10,
            ordering: true,
            order: [[4, 'asc']], // Sort by Current Stock (lowest first)
            dom: '<"top"f>rt<"bottom"lip><"clear">'
        });
        
        // Initialize charts
        initStockCharts();
        
        // Load stock report
        window.loadStockReport = function() {
            const branch = $('#stockBranchFilter').val();
            const category = $('#stockCategoryFilter').val();
            const brand = $('#stockBrandFilter').val();
            const status = $('#stockStatusFilter').val();
            const sortBy = $('#stockSortBy').val();
            
            console.log('Loading stock report:', { branch, category, brand, status, sortBy });
            
            // Show loading
            $('#stockLevelsTable_wrapper').html('<div class="text-center py-5"><i class="las la-spinner la-spin fa-2x text-primary"></i><p class="mt-2">Loading stock report...</p></div>');
            
            // Simulate API call
            setTimeout(() => {
                alert('Stock report loaded with applied filters');
                // Reload charts with new data
                initStockCharts();
            }, 1000);
        };
        
        function initStockCharts() {
            // Stock Status Chart
            var ctx1 = document.getElementById('stockStatusChart').getContext('2d');
            new Chart(ctx1, {
                type: 'doughnut',
                data: {
                    labels: ['Normal Stock', 'Low Stock', 'Out of Stock', 'Overstock'],
                    datasets: [{
                        data: [1560, 85, 5, 31],
                        backgroundColor: [
                            'rgba(40, 167, 69, 0.8)',
                            'rgba(255, 193, 7, 0.8)',
                            'rgba(220, 53, 69, 0.8)',
                            'rgba(23, 162, 184, 0.8)'
                        ]
                    }]
                }
            });
            
            // Category Value Chart
            var ctx2 = document.getElementById('categoryValueChart').getContext('2d');
            new Chart(ctx2, {
                type: 'bar',
                data: {
                    labels: ['Men\'s Wear', 'Women\'s Wear', 'Kid\'s Wear', 'Accessories'],
                    datasets: [{
                        label: 'Stock Value (₹)',
                        data: [120000, 80000, 30000, 15800],
                        backgroundColor: 'rgba(78, 115, 223, 0.5)',
                        borderColor: 'rgba(78, 115, 223, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return '₹' + value/1000 + 'k';
                                }
                            }
                        }
                    }
                }
            });
        }
        
        window.exportStockReport = function() {
            alert('Exporting stock report to Excel...');
        };
        
        window.printStockReport = function() {
            window.print();
        };
        
        window.generateReorderList = function() {
            const lowStockItems = $('.stock-row[data-status="low"], .stock-row[data-status="out"]').length;
            alert('Generating reorder list for ' + lowStockItems + ' items...');
        };
        
        window.printReorderList = function() {
            alert('Printing reorder list...');
        };
        
        window.showLowStockOnly = function() {
            $('.stock-row').hide();
            $('.stock-row[data-status="low"], .stock-row[data-status="out"]').show();
            alert('Showing low and out of stock items only');
        };
        
        window.showOutOfStockOnly = function() {
            $('.stock-row').hide();
            $('.stock-row[data-status="out"]').show();
            alert('Showing out of stock items only');
        };
        
        window.showAllStock = function() {
            $('.stock-row').show();
            alert('Showing all stock items');
        };
        
        window.reorderProduct = function(sku) {
            alert('Initiating reorder for SKU: ' + sku);
            // Open purchase order creation
            window.open('/purchases/create?sku=' + sku, '_blank');
        };
        
        window.viewProduct = function(sku) {
            alert('Viewing product: ' + sku);
            // Open product details
            window.open('/products/' + sku, '_blank');
        };
        
        window.quickReorder = function(sku) {
            alert('Quick reorder for: ' + sku);
            // Quick reorder functionality
        };
    });
    </script>
    @endpush
</x-app-layout>