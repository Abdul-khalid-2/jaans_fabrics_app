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
                <h4 class="mb-3">Inventory Movements Report</h4>
                <p class="mb-0">Track all inventory movements, adjustments, and transfers</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#">Reports</a></li>
                        <li class="breadcrumb-item"><a href="#">Inventory Reports</a></li>
                        <li class="breadcrumb-item active">Movements</li>
                    </ol>
                </nav>
            </div>
            <div>
                <button class="btn btn-outline-primary" onclick="exportMovementsReport()">
                    <i class="las la-file-excel mr-2"></i>Export
                </button>
                <button class="btn btn-primary ml-2" onclick="printMovementsReport()">
                    <i class="las la-print mr-2"></i>Print
                </button>
            </div>
        </div>

        <!-- Filters -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label">Date Range</label>
                            <input type="date" class="form-control" id="movementFromDate" value="2024-01-01">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label">&nbsp;</label>
                            <input type="date" class="form-control" id="movementToDate" value="2024-01-15">
                        </div>
                    </div>
                    
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label">Movement Type</label>
                            <select class="form-control" id="movementTypeFilter">
                                <option value="">All Types</option>
                                <option value="sale">Sales</option>
                                <option value="purchase">Purchases</option>
                                <option value="return">Returns</option>
                                <option value="transfer">Transfers</option>
                                <option value="adjustment">Adjustments</option>
                                <option value="damage">Damages</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label">Product</label>
                            <select class="form-control" id="movementProductFilter">
                                <option value="">All Products</option>
                                <option value="tshirt">Premium T-Shirt</option>
                                <option value="jeans">Designer Jeans</option>
                                <option value="shoes">Running Shoes</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label">Branch</label>
                            <select class="form-control" id="movementBranchFilter">
                                <option value="">All Branches</option>
                                <option value="1">Main Store</option>
                                <option value="2">Warehouse</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <button class="btn btn-primary btn-block" onclick="loadMovementsReport()">
                                <i class="las la-filter mr-2"></i>Apply Filters
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Summary Stats -->
        <div class="row mb-4">
            <div class="col-xl-2 col-md-4 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Movements</div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800">1,245</div>
                        <div class="mt-2 text-muted small">This month</div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-2 col-md-4 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Stock In</div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800">2,845</div>
                        <div class="mt-2 text-muted small">Units received</div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-2 col-md-4 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            Stock Out</div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800">2,680</div>
                        <div class="mt-2 text-muted small">Units sold</div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-2 col-md-4 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Returns</div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800">125</div>
                        <div class="mt-2 text-muted small">Units returned</div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-2 col-md-4 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Adjustments</div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800">85</div>
                        <div class="mt-2 text-muted small">Units adjusted</div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-2 col-md-4 mb-4">
                <div class="card border-left-secondary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                            Net Change</div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800">+165</div>
                        <div class="mt-2 text-muted small">Net increase</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts -->
        <div class="row mb-4">
            <div class="col-lg-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Daily Movement Trends</h6>
                    </div>
                    <div class="card-body">
                        <canvas id="dailyMovementChart" height="250"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Movement Type Distribution</h6>
                    </div>
                    <div class="card-body">
                        <canvas id="movementTypeChart" height="250"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Movement Logs -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Inventory Movement Logs</h6>
                <div class="dropdown">
                    <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" id="logOptions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="las la-download"></i> Download
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="logOptions">
                        <a class="dropdown-item" href="#" onclick="downloadMovementLogs('csv')">CSV Format</a>
                        <a class="dropdown-item" href="#" onclick="downloadMovementLogs('excel')">Excel Format</a>
                        <a class="dropdown-item" href="#" onclick="downloadMovementLogs('pdf')">PDF Format</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="movementLogsTable" width="100%" cellspacing="0">
                        <thead class="thead-light">
                            <tr>
                                <th>Date & Time</th>
                                <th>Movement Type</th>
                                <th>Product</th>
                                <th>SKU</th>
                                <th>Reference</th>
                                <th class="text-right">Quantity</th>
                                <th class="text-right">Previous Stock</th>
                                <th class="text-right">New Stock</th>
                                <th>Branch</th>
                                <th>Recorded By</th>
                                <th>Notes</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Movement 1 -->
                            <tr>
                                <td>15-01-2024 14:30</td>
                                <td>
                                    <span class="badge badge-danger">Sale</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/30x30/007bff/ffffff?text=P1" class="rounded mr-2" alt="Product">
                                        <div>Product 1</div>
                                    </div>
                                </td>
                                <td>SKU-00101</td>
                                <td>
                                    <a href="#" class="text-primary">INV-2024-00125</a>
                                </td>
                                <td class="text-right font-weight-bold text-danger">-3</td>
                                <td class="text-right">85</td>
                                <td class="text-right font-weight-bold">82</td>
                                <td>Main Store</td>
                                <td>User 1</td>
                                <td>
                                    <small class="text-muted">Customer sale</small>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary" onclick="viewMovementDetails('INV-2024-00125')">
                                        <i class="las la-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            
                            <!-- Movement 2 -->
                            <tr>
                                <td>14-01-2024 11:20</td>
                                <td>
                                    <span class="badge badge-success">Purchase</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/30x30/007bff/ffffff?text=P2" class="rounded mr-2" alt="Product">
                                        <div>Product 2</div>
                                    </div>
                                </td>
                                <td>SKU-00102</td>
                                <td>
                                    <a href="#" class="text-primary">PO-2024-00102</a>
                                </td>
                                <td class="text-right font-weight-bold text-success">+15</td>
                                <td class="text-right">60</td>
                                <td class="text-right font-weight-bold">75</td>
                                <td>Warehouse</td>
                                <td>User 2</td>
                                <td>
                                    <small class="text-muted">Stock received</small>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary" onclick="viewMovementDetails('PO-2024-00102')">
                                        <i class="las la-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            
                            <!-- Movement 3 -->
                            <tr>
                                <td>13-01-2024 09:15</td>
                                <td>
                                    <span class="badge badge-warning">Return</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/30x30/007bff/ffffff?text=P3" class="rounded mr-2" alt="Product">
                                        <div>Product 3</div>
                                    </div>
                                </td>
                                <td>SKU-00103</td>
                                <td>
                                    <a href="#" class="text-primary">RTN-2024-00015</a>
                                </td>
                                <td class="text-right font-weight-bold text-success">+2</td>
                                <td class="text-right">48</td>
                                <td class="text-right font-weight-bold">50</td>
                                <td>Main Store</td>
                                <td>User 3</td>
                                <td>
                                    <small class="text-muted">Customer return</small>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary" onclick="viewMovementDetails('RTN-2024-00015')">
                                        <i class="las la-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            
                            <!-- Movement 4 -->
                            <tr>
                                <td>12-01-2024 16:45</td>
                                <td>
                                    <span class="badge badge-info">Transfer</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/30x30/007bff/ffffff?text=P4" class="rounded mr-2" alt="Product">
                                        <div>Product 4</div>
                                    </div>
                                </td>
                                <td>SKU-00104</td>
                                <td>
                                    <a href="#" class="text-primary">TRF-2024-00025</a>
                                </td>
                                <td class="text-right font-weight-bold text-danger">-10</td>
                                <td class="text-right">90</td>
                                <td class="text-right font-weight-bold">80</td>
                                <td>Warehouse</td>
                                <td>User 1</td>
                                <td>
                                    <small class="text-muted">Transfer to store</small>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary" onclick="viewMovementDetails('TRF-2024-00025')">
                                        <i class="las la-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            
                            <!-- Movement 5 -->
                            <tr>
                                <td>11-01-2024 10:10</td>
                                <td>
                                    <span class="badge badge-secondary">Adjustment</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/30x30/007bff/ffffff?text=P5" class="rounded mr-2" alt="Product">
                                        <div>Product 5</div>
                                    </div>
                                </td>
                                <td>SKU-00105</td>
                                <td>
                                    <a href="#" class="text-primary">ADJ-2024-00008</a>
                                </td>
                                <td class="text-right font-weight-bold text-success">+5</td>
                                <td class="text-right">72</td>
                                <td class="text-right font-weight-bold">77</td>
                                <td>Main Store</td>
                                <td>User 2</td>
                                <td>
                                    <small class="text-muted">Stock count adjustment</small>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary" onclick="viewMovementDetails('ADJ-2024-00008')">
                                        <i class="las la-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            
                            <!-- Movement 6 -->
                            <tr>
                                <td>10-01-2024 15:30</td>
                                <td>
                                    <span class="badge badge-dark">Damage</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/30x30/007bff/ffffff?text=P6" class="rounded mr-2" alt="Product">
                                        <div>Product 6</div>
                                    </div>
                                </td>
                                <td>SKU-00106</td>
                                <td>
                                    <a href="#" class="text-primary">DAM-2024-00003</a>
                                </td>
                                <td class="text-right font-weight-bold text-danger">-2</td>
                                <td class="text-right">65</td>
                                <td class="text-right font-weight-bold">63</td>
                                <td>Main Store</td>
                                <td>User 3</td>
                                <td>
                                    <small class="text-muted">Damaged item</small>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary" onclick="viewMovementDetails('DAM-2024-00003')">
                                        <i class="las la-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            
                            <!-- Movement 7 -->
                            <tr>
                                <td>09-01-2024 12:25</td>
                                <td>
                                    <span class="badge badge-danger">Sale</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/30x30/007bff/ffffff?text=P7" class="rounded mr-2" alt="Product">
                                        <div>Product 7</div>
                                    </div>
                                </td>
                                <td>SKU-00107</td>
                                <td>
                                    <a href="#" class="text-primary">INV-2024-00126</a>
                                </td>
                                <td class="text-right font-weight-bold text-danger">-5</td>
                                <td class="text-right">88</td>
                                <td class="text-right font-weight-bold">83</td>
                                <td>Main Store</td>
                                <td>User 1</td>
                                <td>
                                    <small class="text-muted">Customer sale</small>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary" onclick="viewMovementDetails('INV-2024-00126')">
                                        <i class="las la-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            
                            <!-- Movement 8 -->
                            <tr>
                                <td>08-01-2024 14:15</td>
                                <td>
                                    <span class="badge badge-success">Purchase</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/30x30/007bff/ffffff?text=P8" class="rounded mr-2" alt="Product">
                                        <div>Product 8</div>
                                    </div>
                                </td>
                                <td>SKU-00108</td>
                                <td>
                                    <a href="#" class="text-primary">PO-2024-00103</a>
                                </td>
                                <td class="text-right font-weight-bold text-success">+20</td>
                                <td class="text-right">70</td>
                                <td class="text-right font-weight-bold">90</td>
                                <td>Warehouse</td>
                                <td>User 2</td>
                                <td>
                                    <small class="text-muted">Stock received</small>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary" onclick="viewMovementDetails('PO-2024-00103')">
                                        <i class="las la-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            
                            <!-- Movement 9 -->
                            <tr>
                                <td>07-01-2024 11:40</td>
                                <td>
                                    <span class="badge badge-info">Transfer</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/30x30/007bff/ffffff?text=P9" class="rounded mr-2" alt="Product">
                                        <div>Product 9</div>
                                    </div>
                                </td>
                                <td>SKU-00109</td>
                                <td>
                                    <a href="#" class="text-primary">TRF-2024-00026</a>
                                </td>
                                <td class="text-right font-weight-bold text-success">+8</td>
                                <td class="text-right">42</td>
                                <td class="text-right font-weight-bold">50</td>
                                <td>Main Store</td>
                                <td>User 3</td>
                                <td>
                                    <small class="text-muted">Transfer from warehouse</small>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary" onclick="viewMovementDetails('TRF-2024-00026')">
                                        <i class="las la-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            
                            <!-- Movement 10 -->
                            <tr>
                                <td>06-01-2024 16:20</td>
                                <td>
                                    <span class="badge badge-warning">Return</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/30x30/007bff/ffffff?text=P10" class="rounded mr-2" alt="Product">
                                        <div>Product 10</div>
                                    </div>
                                </td>
                                <td>SKU-00110</td>
                                <td>
                                    <a href="#" class="text-primary">RTN-2024-00016</a>
                                </td>
                                <td class="text-right font-weight-bold text-success">+1</td>
                                <td class="text-right">55</td>
                                <td class="text-right font-weight-bold">56</td>
                                <td>Main Store</td>
                                <td>User 1</td>
                                <td>
                                    <small class="text-muted">Customer return</small>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary" onclick="viewMovementDetails('RTN-2024-00016')">
                                        <i class="las la-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            
                            <!-- Movement 11 -->
                            <tr>
                                <td>05-01-2024 09:45</td>
                                <td>
                                    <span class="badge badge-secondary">Adjustment</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/30x30/007bff/ffffff?text=P11" class="rounded mr-2" alt="Product">
                                        <div>Product 11</div>
                                    </div>
                                </td>
                                <td>SKU-00111</td>
                                <td>
                                    <a href="#" class="text-primary">ADJ-2024-00009</a>
                                </td>
                                <td class="text-right font-weight-bold text-danger">-3</td>
                                <td class="text-right">68</td>
                                <td class="text-right font-weight-bold">65</td>
                                <td>Warehouse</td>
                                <td>User 2</td>
                                <td>
                                    <small class="text-muted">Stock count adjustment</small>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary" onclick="viewMovementDetails('ADJ-2024-00009')">
                                        <i class="las la-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            
                            <!-- Movement 12 -->
                            <tr>
                                <td>04-01-2024 13:55</td>
                                <td>
                                    <span class="badge badge-danger">Sale</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/30x30/007bff/ffffff?text=P12" class="rounded mr-2" alt="Product">
                                        <div>Product 12</div>
                                    </div>
                                </td>
                                <td>SKU-00112</td>
                                <td>
                                    <a href="#" class="text-primary">INV-2024-00127</a>
                                </td>
                                <td class="text-right font-weight-bold text-danger">-7</td>
                                <td class="text-right">92</td>
                                <td class="text-right font-weight-bold">85</td>
                                <td>Main Store</td>
                                <td>User 3</td>
                                <td>
                                    <small class="text-muted">Customer sale</small>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary" onclick="viewMovementDetails('INV-2024-00127')">
                                        <i class="las la-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            
                            <!-- Movement 13 -->
                            <tr>
                                <td>03-01-2024 10:30</td>
                                <td>
                                    <span class="badge badge-success">Purchase</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/30x30/007bff/ffffff?text=P13" class="rounded mr-2" alt="Product">
                                        <div>Product 13</div>
                                    </div>
                                </td>
                                <td>SKU-00113</td>
                                <td>
                                    <a href="#" class="text-primary">PO-2024-00104</a>
                                </td>
                                <td class="text-right font-weight-bold text-success">+12</td>
                                <td class="text-right">58</td>
                                <td class="text-right font-weight-bold">70</td>
                                <td>Warehouse</td>
                                <td>User 1</td>
                                <td>
                                    <small class="text-muted">Stock received</small>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary" onclick="viewMovementDetails('PO-2024-00104')">
                                        <i class="las la-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            
                            <!-- Movement 14 -->
                            <tr>
                                <td>02-01-2024 15:15</td>
                                <td>
                                    <span class="badge badge-dark">Damage</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/30x30/007bff/ffffff?text=P14" class="rounded mr-2" alt="Product">
                                        <div>Product 14</div>
                                    </div>
                                </td>
                                <td>SKU-00114</td>
                                <td>
                                    <a href="#" class="text-primary">DAM-2024-00004</a>
                                </td>
                                <td class="text-right font-weight-bold text-danger">-1</td>
                                <td class="text-right">74</td>
                                <td class="text-right font-weight-bold">73</td>
                                <td>Main Store</td>
                                <td>User 2</td>
                                <td>
                                    <small class="text-muted">Damaged item</small>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary" onclick="viewMovementDetails('DAM-2024-00004')">
                                        <i class="las la-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            
                            <!-- Movement 15 -->
                            <tr>
                                <td>01-01-2024 08:45</td>
                                <td>
                                    <span class="badge badge-info">Transfer</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/30x30/007bff/ffffff?text=P15" class="rounded mr-2" alt="Product">
                                        <div>Product 15</div>
                                    </div>
                                </td>
                                <td>SKU-00115</td>
                                <td>
                                    <a href="#" class="text-primary">TRF-2024-00027</a>
                                </td>
                                <td class="text-right font-weight-bold text-success">+6</td>
                                <td class="text-right">34</td>
                                <td class="text-right font-weight-bold">40</td>
                                <td>Main Store</td>
                                <td>User 3</td>
                                <td>
                                    <small class="text-muted">Transfer from warehouse</small>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary" onclick="viewMovementDetails('TRF-2024-00027')">
                                        <i class="las la-eye"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Adjustment Summary -->
        <div class="row">
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-warning">Recent Adjustments</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Adjustment #</th>
                                        <th>Date</th>
                                        <th>Items</th>
                                        <th>Total Value</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <a href="#" class="text-primary">ADJ-2024-00001</a>
                                        </td>
                                        <td>15-01-2024</td>
                                        <td>3</td>
                                        <td class="font-weight-bold">Rs 4,250</td>
                                        <td>
                                            <span class="badge badge-info">Count</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-success">Approved</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="#" class="text-primary">ADJ-2024-00002</a>
                                        </td>
                                        <td>14-01-2024</td>
                                        <td>1</td>
                                        <td class="font-weight-bold">Rs 1,850</td>
                                        <td>
                                            <span class="badge badge-danger">Damage</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-success">Approved</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="#" class="text-primary">ADJ-2024-00003</a>
                                        </td>
                                        <td>13-01-2024</td>
                                        <td>2</td>
                                        <td class="font-weight-bold">Rs 3,420</td>
                                        <td>
                                            <span class="badge badge-warning">Expired</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-success">Approved</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="#" class="text-primary">ADJ-2024-00004</a>
                                        </td>
                                        <td>12-01-2024</td>
                                        <td>1</td>
                                        <td class="font-weight-bold">Rs 2,150</td>
                                        <td>
                                            <span class="badge badge-info">Sample</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-success">Approved</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="#" class="text-primary">ADJ-2024-00005</a>
                                        </td>
                                        <td>11-01-2024</td>
                                        <td>4</td>
                                        <td class="font-weight-bold">Rs 6,850</td>
                                        <td>
                                            <span class="badge badge-info">Count</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-success">Approved</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Top Products by Movement</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Sales</th>
                                        <th>Purchases</th>
                                        <th>Returns</th>
                                        <th>Net Change</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Product 1</td>
                                        <td class="text-danger">-45</td>
                                        <td class="text-success">+60</td>
                                        <td class="text-warning">+5</td>
                                        <td class="font-weight-bold text-success">+20</td>
                                    </tr>
                                    <tr>
                                        <td>Product 2</td>
                                        <td class="text-danger">-38</td>
                                        <td class="text-success">+50</td>
                                        <td class="text-warning">+3</td>
                                        <td class="font-weight-bold text-success">+15</td>
                                    </tr>
                                    <tr>
                                        <td>Product 3</td>
                                        <td class="text-danger">-42</td>
                                        <td class="text-success">+55</td>
                                        <td class="text-warning">+4</td>
                                        <td class="font-weight-bold text-success">+17</td>
                                    </tr>
                                    <tr>
                                        <td>Product 4</td>
                                        <td class="text-danger">-35</td>
                                        <td class="text-success">+45</td>
                                        <td class="text-warning">+2</td>
                                        <td class="font-weight-bold text-success">+12</td>
                                    </tr>
                                    <tr>
                                        <td>Product 5</td>
                                        <td class="text-danger">-30</td>
                                        <td class="text-success">+40</td>
                                        <td class="text-warning">+1</td>
                                        <td class="font-weight-bold text-success">+11</td>
                                    </tr>
                                </tbody>
                            </table>
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
        $('#movementLogsTable').DataTable({
            pageLength: 10,
            ordering: true,
            order: [[0, 'desc']], // Sort by date descending
            dom: '<"top"f>rt<"bottom"lip><"clear">'
        });
        
        // Initialize charts
        initMovementCharts();
        
        // Load movements report
        window.loadMovementsReport = function() {
            const fromDate = $('#movementFromDate').val();
            const toDate = $('#movementToDate').val();
            const movementType = $('#movementTypeFilter').val();
            const product = $('#movementProductFilter').val();
            const branch = $('#movementBranchFilter').val();
            
            console.log('Loading movements report:', { fromDate, toDate, movementType, product, branch });
            
            // Show loading
            $('#movementLogsTable_wrapper').html('<div class="text-center py-5"><i class="las la-spinner la-spin fa-2x text-primary"></i><p class="mt-2">Loading movements report...</p></div>');
            
            // Simulate API call
            setTimeout(() => {
                alert('Movements report loaded for selected period');
                // Reload charts with new data
                initMovementCharts();
            }, 1000);
        };
        
        function initMovementCharts() {
            // Daily Movement Chart
            var ctx1 = document.getElementById('dailyMovementChart').getContext('2d');
            new Chart(ctx1, {
                type: 'line',
                data: {
                    labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15'],
                    datasets: [{
                        label: 'Stock In',
                        data: [45, 52, 48, 61, 72, 68, 75, 82, 78, 85, 92, 98, 105, 112, 120],
                        borderColor: 'rgba(40, 167, 69, 1)',
                        backgroundColor: 'rgba(40, 167, 69, 0.1)',
                        tension: 0.3,
                        fill: true
                    }, {
                        label: 'Stock Out',
                        data: [38, 45, 42, 52, 58, 55, 62, 68, 65, 72, 78, 82, 88, 92, 98],
                        borderColor: 'rgba(220, 53, 69, 1)',
                        backgroundColor: 'rgba(220, 53, 69, 0.1)',
                        tension: 0.3,
                        fill: true
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
            
            // Movement Type Chart
            var ctx2 = document.getElementById('movementTypeChart').getContext('2d');
            new Chart(ctx2, {
                type: 'pie',
                data: {
                    labels: ['Sales', 'Purchases', 'Returns', 'Transfers', 'Adjustments', 'Damages'],
                    datasets: [{
                        data: [35, 30, 10, 15, 5, 5],
                        backgroundColor: [
                            'rgba(220, 53, 69, 0.8)',
                            'rgba(40, 167, 69, 0.8)',
                            'rgba(255, 193, 7, 0.8)',
                            'rgba(23, 162, 184, 0.8)',
                            'rgba(108, 117, 125, 0.8)',
                            'rgba(52, 58, 64, 0.8)'
                        ]
                    }]
                }
            });
        }
        
        window.exportMovementsReport = function() {
            alert('Exporting movements report to Excel...');
        };
        
        window.printMovementsReport = function() {
            window.print();
        };
        
        window.downloadMovementLogs = function(format) {
            alert('Downloading movement logs in ' + format.toUpperCase() + ' format...');
        };
        
        window.viewMovementDetails = function(reference) {
            alert('Viewing movement details for: ' + reference);
            // Open movement details modal or page
        };
    });
    </script>
    @endpush
</x-app-layout>