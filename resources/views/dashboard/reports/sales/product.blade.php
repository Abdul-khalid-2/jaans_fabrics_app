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
                <h4 class="mb-3">Product-wise Sales Report</h4>
                <p class="mb-0">Analyze product performance and sales trends</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#">Sales Reports</a></li>
                        <li class="breadcrumb-item active">Product-wise</li>
                    </ol>
                </nav>
            </div>
            <div>
                <button class="btn btn-outline-primary" onclick="exportProductReport()">
                    <i class="las la-file-excel mr-2"></i>Export
                </button>
                <button class="btn btn-primary ml-2" onclick="printProductReport()">
                    <i class="las la-print mr-2"></i>Print
                </button>
            </div>
        </div>

        <!-- Filters -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Date Range</label>
                            <div class="input-group">
                                <input type="date" class="form-control" id="productFromDate" value="2024-01-01">
                                <div class="input-group-append">
                                    <span class="input-group-text">to</span>
                                </div>
                                <input type="date" class="form-control" id="productToDate" value="2024-01-15">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label">Category</label>
                            <select class="form-control" id="categoryFilter">
                                <option value="">All Categories</option>
                                <option value="men">Men's Wear</option>
                                <option value="women">Women's Wear</option>
                                <option value="kids">Kid's Wear</option>
                                <option value="accessories">Accessories</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label">Brand</label>
                            <select class="form-control" id="brandFilter">
                                <option value="">All Brands</option>
                                <option value="nike">Nike</option>
                                <option value="adidas">Adidas</option>
                                <option value="puma">Puma</option>
                                <option value="levis">Levi's</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label">Sort By</label>
                            <select class="form-control" id="sortBy">
                                <option value="revenue">Revenue</option>
                                <option value="quantity">Quantity</option>
                                <option value="profit">Profit Margin</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <button class="btn btn-primary btn-block" onclick="loadProductReport()">
                                <i class="las la-chart-bar mr-2"></i>Generate Report
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Summary Stats -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Products Sold</div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800">2,845</div>
                        <div class="mt-2 text-muted small">Units sold this month</div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Total Revenue</div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800">Rs 299,200</div>
                        <div class="mt-2 text-muted small">From product sales</div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Avg. Price/Product</div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800">Rs 864</div>
                        <div class="mt-2 text-muted small">Average selling price</div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Top Product</div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800">Premium T-Shirt</div>
                        <div class="mt-2 text-muted small">Rs 45,600 revenue</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts -->
        <div class="row mb-4">
            <div class="col-lg-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Top 10 Products by Revenue</h6>
                        <select class="form-control form-control-sm w-auto" id="chartType">
                            <option value="bar">Bar Chart</option>
                            <option value="horizontalBar">Horizontal Bar</option>
                        </select>
                    </div>
                    <div class="card-body">
                        <canvas id="topProductsChart" height="300"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Sales by Category</h6>
                    </div>
                    <div class="card-body">
                        <canvas id="categorySalesChart" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Sales Table -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Product Sales Performance</h6>
                <div class="dropdown">
                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="tableOptions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="las la-cog"></i> Options
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="tableOptions">
                        <a class="dropdown-item" href="#" onclick="toggleColumns()">Toggle Columns</a>
                        <a class="dropdown-item" href="#" onclick="showProfitColumns()">Show Profit Columns</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" onclick="downloadTableData()">Download Data</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="productSalesTable" width="100%" cellspacing="0">
                        <thead class="thead-light">
                            <tr>
                                <th>Product</th>
                                <th>Category</th>
                                <th>Brand</th>
                                <th>SKU</th>
                                <th class="text-right">Quantity</th>
                                <th class="text-right">Revenue</th>
                                <th class="text-right">Avg. Price</th>
                                <th class="text-right">Cost</th>
                                <th class="text-right">Profit</th>
                                <th class="text-right">Margin</th>
                                <th>Trend</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Product 1 -->
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/40x40/007bff/ffffff?text=P1" class="rounded mr-2" alt="Product">
                                        <div>
                                            <div class="font-weight-bold">Premium T-Shirt</div>
                                            <small class="text-muted">TS-NIKE-001</small>
                                        </div>
                                    </div>
                                </td>
                                <td>Men</td>
                                <td>Nike</td>
                                <td>TS-NIKE-001</td>
                                <td class="text-right font-weight-bold">120</td>
                                <td class="text-right font-weight-bold text-success">Rs 45,600</td>
                                <td class="text-right">Rs 380</td>
                                <td class="text-right">Rs 27,360</td>
                                <td class="text-right font-weight-bold text-primary">Rs 18,240</td>
                                <td class="text-right">
                                    <span class="badge badge-success">
                                        40.0%
                                    </span>
                                </td>
                                <td>
                                    <span class="text-success">
                                        <i class="las la-arrow-up"></i>
                                        15%
                                    </span>
                                </td>
                            </tr>

                            <!-- Product 2 -->
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/40x40/007bff/ffffff?text=P2" class="rounded mr-2" alt="Product">
                                        <div>
                                            <div class="font-weight-bold">Designer Jeans</div>
                                            <small class="text-muted">DJ-LEVI-001</small>
                                        </div>
                                    </div>
                                </td>
                                <td>Women</td>
                                <td>Levi's</td>
                                <td>DJ-LEVI-001</td>
                                <td class="text-right font-weight-bold">85</td>
                                <td class="text-right font-weight-bold text-success">Rs 38,400</td>
                                <td class="text-right">Rs 452</td>
                                <td class="text-right">Rs 23,040</td>
                                <td class="text-right font-weight-bold text-primary">Rs 15,360</td>
                                <td class="text-right">
                                    <span class="badge badge-success">
                                        40.0%
                                    </span>
                                </td>
                                <td>
                                    <span class="text-success">
                                        <i class="las la-arrow-up"></i>
                                        8%
                                    </span>
                                </td>
                            </tr>

                            <!-- Product 3 -->
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/40x40/007bff/ffffff?text=P3" class="rounded mr-2" alt="Product">
                                        <div>
                                            <div class="font-weight-bold">Running Shoes</div>
                                            <small class="text-muted">RS-ADI-001</small>
                                        </div>
                                    </div>
                                </td>
                                <td>Men</td>
                                <td>Adidas</td>
                                <td>RS-ADI-001</td>
                                <td class="text-right font-weight-bold">65</td>
                                <td class="text-right font-weight-bold text-success">Rs 64,800</td>
                                <td class="text-right">Rs 997</td>
                                <td class="text-right">Rs 38,880</td>
                                <td class="text-right font-weight-bold text-primary">Rs 25,920</td>
                                <td class="text-right">
                                    <span class="badge badge-success">
                                        40.0%
                                    </span>
                                </td>
                                <td>
                                    <span class="text-success">
                                        <i class="las la-arrow-up"></i>
                                        20%
                                    </span>
                                </td>
                            </tr>

                            <!-- Product 4 -->
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/40x40/007bff/ffffff?text=P4" class="rounded mr-2" alt="Product">
                                        <div>
                                            <div class="font-weight-bold">Winter Jacket</div>
                                            <small class="text-muted">WJ-PUMA-001</small>
                                        </div>
                                    </div>
                                </td>
                                <td>Men</td>
                                <td>Puma</td>
                                <td>WJ-PUMA-001</td>
                                <td class="text-right font-weight-bold">40</td>
                                <td class="text-right font-weight-bold text-success">Rs 32,400</td>
                                <td class="text-right">Rs 810</td>
                                <td class="text-right">Rs 19,440</td>
                                <td class="text-right font-weight-bold text-primary">Rs 12,960</td>
                                <td class="text-right">
                                    <span class="badge badge-success">
                                        40.0%
                                    </span>
                                </td>
                                <td>
                                    <span class="text-danger">
                                        <i class="las la-arrow-down"></i>
                                        5%
                                    </span>
                                </td>
                            </tr>

                            <!-- Product 5 -->
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/40x40/007bff/ffffff?text=P5" class="rounded mr-2" alt="Product">
                                        <div>
                                            <div class="font-weight-bold">Formal Shirt</div>
                                            <small class="text-muted">FS-RAY-001</small>
                                        </div>
                                    </div>
                                </td>
                                <td>Men</td>
                                <td>Raymond</td>
                                <td>FS-RAY-001</td>
                                <td class="text-right font-weight-bold">75</td>
                                <td class="text-right font-weight-bold text-success">Rs 28,800</td>
                                <td class="text-right">Rs 384</td>
                                <td class="text-right">Rs 17,280</td>
                                <td class="text-right font-weight-bold text-primary">Rs 11,520</td>
                                <td class="text-right">
                                    <span class="badge badge-success">
                                        40.0%
                                    </span>
                                </td>
                                <td>
                                    <span class="text-success">
                                        <i class="las la-arrow-up"></i>
                                        12%
                                    </span>
                                </td>
                            </tr>

                            <!-- Product 6 -->
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/40x40/007bff/ffffff?text=P6" class="rounded mr-2" alt="Product">
                                        <div>
                                            <div class="font-weight-bold">Summer Dress</div>
                                            <small class="text-muted">SD-ZARA-001</small>
                                        </div>
                                    </div>
                                </td>
                                <td>Women</td>
                                <td>Zara</td>
                                <td>SD-ZARA-001</td>
                                <td class="text-right font-weight-bold">55</td>
                                <td class="text-right font-weight-bold text-success">Rs 25,600</td>
                                <td class="text-right">Rs 465</td>
                                <td class="text-right">Rs 15,360</td>
                                <td class="text-right font-weight-bold text-primary">Rs 10,240</td>
                                <td class="text-right">
                                    <span class="badge badge-success">
                                        40.0%
                                    </span>
                                </td>
                                <td>
                                    <span class="text-success">
                                        <i class="las la-arrow-up"></i>
                                        10%
                                    </span>
                                </td>
                            </tr>

                            <!-- Product 7 -->
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/40x40/007bff/ffffff?text=P7" class="rounded mr-2" alt="Product">
                                        <div>
                                            <div class="font-weight-bold">Kid's T-Shirt</div>
                                            <small class="text-muted">KT-HM-001</small>
                                        </div>
                                    </div>
                                </td>
                                <td>Kids</td>
                                <td>H&M</td>
                                <td>KT-HM-001</td>
                                <td class="text-right font-weight-bold">95</td>
                                <td class="text-right font-weight-bold text-success">Rs 19,200</td>
                                <td class="text-right">Rs 202</td>
                                <td class="text-right">Rs 11,520</td>
                                <td class="text-right font-weight-bold text-primary">Rs 7,680</td>
                                <td class="text-right">
                                    <span class="badge badge-warning">
                                        35.0%
                                    </span>
                                </td>
                                <td>
                                    <span class="text-danger">
                                        <i class="las la-arrow-down"></i>
                                        3%
                                    </span>
                                </td>
                            </tr>

                            <!-- Product 8 -->
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/40x40/007bff/ffffff?text=P8" class="rounded mr-2" alt="Product">
                                        <div>
                                            <div class="font-weight-bold">Sports Shoes</div>
                                            <small class="text-muted">SS-NIKE-001</small>
                                        </div>
                                    </div>
                                </td>
                                <td>Men</td>
                                <td>Nike</td>
                                <td>SS-NIKE-001</td>
                                <td class="text-right font-weight-bold">35</td>
                                <td class="text-right font-weight-bold text-success">Rs 17,600</td>
                                <td class="text-right">Rs 503</td>
                                <td class="text-right">Rs 10,560</td>
                                <td class="text-right font-weight-bold text-primary">Rs 7,040</td>
                                <td class="text-right">
                                    <span class="badge badge-warning">
                                        35.0%
                                    </span>
                                </td>
                                <td>
                                    <span class="text-success">
                                        <i class="las la-arrow-up"></i>
                                        5%
                                    </span>
                                </td>
                            </tr>

                            <!-- Product 9 -->
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/40x40/007bff/ffffff?text=P9" class="rounded mr-2" alt="Product">
                                        <div>
                                            <div class="font-weight-bold">Casual Shirt</div>
                                            <small class="text-muted">CS-UCB-001</small>
                                        </div>
                                    </div>
                                </td>
                                <td>Men</td>
                                <td>UCB</td>
                                <td>CS-UCB-001</td>
                                <td class="text-right font-weight-bold">45</td>
                                <td class="text-right font-weight-bold text-success">Rs 14,400</td>
                                <td class="text-right">Rs 320</td>
                                <td class="text-right">Rs 8,640</td>
                                <td class="text-right font-weight-bold text-primary">Rs 5,760</td>
                                <td class="text-right">
                                    <span class="badge badge-warning">
                                        35.0%
                                    </span>
                                </td>
                                <td>
                                    <span class="text-success">
                                        <i class="las la-arrow-up"></i>
                                        7%
                                    </span>
                                </td>
                            </tr>

                            <!-- Product 10 -->
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/40x40/007bff/ffffff?text=P10" class="rounded mr-2" alt="Product">
                                        <div>
                                            <div class="font-weight-bold">Leather Jacket</div>
                                            <small class="text-muted">LJ-JJ-001</small>
                                        </div>
                                    </div>
                                </td>
                                <td>Men</td>
                                <td>Jack & Jones</td>
                                <td>LJ-JJ-001</td>
                                <td class="text-right font-weight-bold">20</td>
                                <td class="text-right font-weight-bold text-success">Rs 12,800</td>
                                <td class="text-right">Rs 640</td>
                                <td class="text-right">Rs 7,680</td>
                                <td class="text-right font-weight-bold text-primary">Rs 5,120</td>
                                <td class="text-right">
                                    <span class="badge badge-success">
                                        40.0%
                                    </span>
                                </td>
                                <td>
                                    <span class="text-success">
                                        <i class="las la-arrow-up"></i>
                                        18%
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot class="font-weight-bold">
                            <tr>
                                <td colspan="4" class="text-right">Totals:</td>
                                <td class="text-right">635</td>
                                <td class="text-right">Rs 299,200</td>
                                <td class="text-right">Rs 471</td>
                                <td class="text-right">Rs 179,520</td>
                                <td class="text-right">Rs 119,680</td>
                                <td class="text-right">40.0%</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <!-- Slow Moving Products -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-warning">Slow Moving Products (Last 30 Days)</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-borderless">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Category</th>
                                <th>Stock</th>
                                <th>Last Sale</th>
                                <th>Days Since Sale</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Slow Product 1 -->
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/30x30/dc3545/ffffff?text=SM1" class="rounded mr-2" alt="Product">
                                        <div>
                                            <div class="font-weight-bold">Winter Sweater</div>
                                            <small class="text-muted">SKU: SM-001</small>
                                        </div>
                                    </div>
                                </td>
                                <td>Men</td>
                                <td>
                                    <span class="badge badge-warning">42 units</span>
                                </td>
                                <td>20-12-2023</td>
                                <td>
                                    <span class="badge badge-danger">45 days</span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-warning">
                                        <i class="las la-tag"></i> Discount
                                    </button>
                                </td>
                            </tr>

                            <!-- Slow Product 2 -->
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/30x30/dc3545/ffffff?text=SM2" class="rounded mr-2" alt="Product">
                                        <div>
                                            <div class="font-weight-bold">Formal Trousers</div>
                                            <small class="text-muted">SKU: SM-002</small>
                                        </div>
                                    </div>
                                </td>
                                <td>Men</td>
                                <td>
                                    <span class="badge badge-warning">28 units</span>
                                </td>
                                <td>05-01-2024</td>
                                <td>
                                    <span class="badge badge-danger">25 days</span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-warning">
                                        <i class="las la-tag"></i> Discount
                                    </button>
                                </td>
                            </tr>

                            <!-- Slow Product 3 -->
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/30x30/dc3545/ffffff?text=SM3" class="rounded mr-2" alt="Product">
                                        <div>
                                            <div class="font-weight-bold">Evening Gown</div>
                                            <small class="text-muted">SKU: SM-003</small>
                                        </div>
                                    </div>
                                </td>
                                <td>Women</td>
                                <td>
                                    <span class="badge badge-warning">15 units</span>
                                </td>
                                <td>28-12-2023</td>
                                <td>
                                    <span class="badge badge-danger">38 days</span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-warning">
                                        <i class="las la-tag"></i> Discount
                                    </button>
                                </td>
                            </tr>

                            <!-- Slow Product 4 -->
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/30x30/dc3545/ffffff?text=SM4" class="rounded mr-2" alt="Product">
                                        <div>
                                            <div class="font-weight-bold">School Uniform</div>
                                            <small class="text-muted">SKU: SM-004</small>
                                        </div>
                                    </div>
                                </td>
                                <td>Kids</td>
                                <td>
                                    <span class="badge badge-warning">35 units</span>
                                </td>
                                <td>15-12-2023</td>
                                <td>
                                    <span class="badge badge-danger">50 days</span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-warning">
                                        <i class="las la-tag"></i> Discount
                                    </button>
                                </td>
                            </tr>

                            <!-- Slow Product 5 -->
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/30x30/dc3545/ffffff?text=SM5" class="rounded mr-2" alt="Product">
                                        <div>
                                            <div class="font-weight-bold">Leather Belt</div>
                                            <small class="text-muted">SKU: SM-005</small>
                                        </div>
                                    </div>
                                </td>
                                <td>Accessories</td>
                                <td>
                                    <span class="badge badge-warning">22 units</span>
                                </td>
                                <td>10-01-2024</td>
                                <td>
                                    <span class="badge badge-danger">20 days</span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-warning">
                                        <i class="las la-tag"></i> Discount
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
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
            $('#productSalesTable').DataTable({
                pageLength: 10,
                ordering: true,
                order: [
                    [5, 'desc']
                ], // Sort by Revenue by default
                dom: '<"top"f>rt<"bottom"lip><"clear">'
            });

            // Initialize charts
            initProductCharts();

            // Load product report
            window.loadProductReport = function() {
                const fromDate = $('#productFromDate').val();
                const toDate = $('#productToDate').val();
                const category = $('#categoryFilter').val();
                const brand = $('#brandFilter').val();
                const sortBy = $('#sortBy').val();

                console.log('Loading product report:', {
                    fromDate,
                    toDate,
                    category,
                    brand,
                    sortBy
                });

                // Show loading
                $('#productSalesTable_wrapper').html('<div class="text-center py-5"><i class="las la-spinner la-spin fa-2x text-primary"></i><p class="mt-2">Loading product report...</p></div>');

                // Simulate API call
                setTimeout(() => {
                    alert('Product report loaded for selected filters');
                    // Reload charts with new data
                    initProductCharts();
                }, 1000);
            };

            function initProductCharts() {
                // Top Products Chart
                var ctx1 = document.getElementById('topProductsChart').getContext('2d');
                new Chart(ctx1, {
                    type: $('#chartType').val(),
                    data: {
                        labels: ['Premium T-Shirt', 'Designer Jeans', 'Running Shoes', 'Winter Jacket', 'Formal Shirt', 'Summer Dress', 'Kid\'s T-Shirt', 'Sports Shoes', 'Casual Shirt', 'Leather Jacket'],
                        datasets: [{
                            label: 'Revenue (Rs)',
                            data: [45600, 38400, 64800, 32400, 28800, 25600, 19200, 17600, 14400, 12800],
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
                                        return 'Rs' + value / 1000 + 'k';
                                    }
                                }
                            }
                        }
                    }
                });

                // Category Sales Chart
                var ctx2 = document.getElementById('categorySalesChart').getContext('2d');
                new Chart(ctx2, {
                    type: 'pie',
                    data: {
                        labels: ['Men\'s Wear', 'Women\'s Wear', 'Kid\'s Wear', 'Accessories'],
                        datasets: [{
                            data: [45, 35, 15, 5],
                            backgroundColor: [
                                'rgba(78, 115, 223, 0.8)',
                                'rgba(220, 53, 69, 0.8)',
                                'rgba(40, 167, 69, 0.8)',
                                'rgba(255, 193, 7, 0.8)'
                            ]
                        }]
                    }
                });

                // Chart type change
                $('#chartType').change(function() {
                    initProductCharts();
                });
            }

            window.exportProductReport = function() {
                alert('Exporting product report to Excel...');
            };

            window.printProductReport = function() {
                window.print();
            };

            window.toggleColumns = function() {
                alert('Toggle columns functionality - to be implemented');
            };

            window.showProfitColumns = function() {
                $('th:nth-child(8), th:nth-child(9), th:nth-child(10)').toggle();
                $('td:nth-child(8), td:nth-child(9), td:nth-child(10)').toggle();
            };

            window.downloadTableData = function() {
                alert('Downloading table data as CSV...');
            };
        });
    </script>
    @endpush
</x-app-layout>