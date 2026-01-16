<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/remixicon/fonts/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/datatables/datatables.min.css') }}">
    <style>
        .report-card {
            border-radius: 10px;
            border: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        .report-card:hover {
            transform: translateY(-5px);
        }
        .filter-section {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .export-buttons .btn {
            min-width: 120px;
        }
        .date-range-picker {
            background: white;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 8px 15px;
            cursor: pointer;
        }
    </style>
    @endpush

    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
            <div>
                <h4 class="mb-3">Sales Reports</h4>
                <p class="mb-0">Analyze and export your sales performance data</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#">Reports</a></li>
                        <li class="breadcrumb-item active">Sales Reports</li>
                    </ol>
                </nav>
            </div>
            <div class="export-buttons">
                <button class="btn btn-outline-primary" onclick="exportToExcel()">
                    <i class="las la-file-excel mr-2"></i>Excel
                </button>
                <button class="btn btn-outline-danger ml-2" onclick="exportToPDF()">
                    <i class="las la-file-pdf mr-2"></i>PDF
                </button>
                <button class="btn btn-outline-secondary ml-2" onclick="printReport()">
                    <i class="las la-print mr-2"></i>Print
                </button>
            </div>
        </div>

        <!-- Report Filters -->
        <div class="filter-section">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Date Range</label>
                        <div class="date-range-picker" id="dateRangePicker">
                            <i class="las la-calendar mr-2"></i>
                            <span id="dateRangeText">This Month</span>
                            <i class="las la-angle-down ml-2"></i>
                        </div>
                        <div id="dateRangeDropdown" class="dropdown-menu p-3" style="width: 300px;">
                            <div class="row">
                                <div class="col-6">
                                    <label>From Date</label>
                                    <input type="date" class="form-control" id="fromDate" value="2024-01-01">
                                </div>
                                <div class="col-6">
                                    <label>To Date</label>
                                    <input type="date" class="form-control" id="toDate" value="2024-01-15">
                                </div>
                            </div>
                            <div class="mt-3">
                                <button class="btn btn-primary btn-sm btn-block" onclick="applyDateRange()">Apply</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="form-label">Branch</label>
                        <select class="form-control" id="branchFilter">
                            <option value="">All Branches</option>
                            <option value="1" selected>Main Store</option>
                            <option value="2">Warehouse</option>
                            <option value="3">Outlet 1</option>
                        </select>
                    </div>
                </div>
                
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="form-label">Payment Method</label>
                        <select class="form-control" id="paymentFilter">
                            <option value="">All Methods</option>
                            <option value="cash">Cash</option>
                            <option value="card">Card</option>
                            <option value="upi">UPI</option>
                            <option value="credit">Credit</option>
                        </select>
                    </div>
                </div>
                
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="form-label">Sales Person</label>
                        <select class="form-control" id="salesPersonFilter">
                            <option value="">All Staff</option>
                            <option value="1">John Smith</option>
                            <option value="2">Sarah Johnson</option>
                            <option value="3">Mike Williams</option>
                        </select>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Customer Type</label>
                        <select class="form-control" id="customerTypeFilter">
                            <option value="">All Types</option>
                            <option value="walk_in">Walk-in</option>
                            <option value="regular">Regular</option>
                            <option value="wholesale">Wholesale</option>
                            <option value="vip">VIP</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="row mt-3">
                <div class="col-md-12 text-right">
                    <button class="btn btn-secondary" onclick="resetFilters()">
                        <i class="las la-redo mr-2"></i>Reset Filters
                    </button>
                    <button class="btn btn-primary ml-2" onclick="generateReport()">
                        <i class="las la-filter mr-2"></i>Apply Filters
                    </button>
                    <button class="btn btn-success ml-2" onclick="saveReportTemplate()">
                        <i class="las la-save mr-2"></i>Save Template
                    </button>
                </div>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card report-card border-left-primary">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Sales</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rs 245,680</div>
                                <div class="mt-2 mb-0 text-muted text-xs">
                                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 15.2%</span>
                                    <span>vs last month</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="las la-rupee-sign fa-2x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card report-card border-left-success">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Total Orders</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">856</div>
                                <div class="mt-2 mb-0 text-muted text-xs">
                                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 8.5%</span>
                                    <span>vs last month</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="las la-shopping-cart fa-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card report-card border-left-info">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Average Order Value</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rs 2,870</div>
                                <div class="mt-2 mb-0 text-muted text-xs">
                                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 6.2%</span>
                                    <span>vs last month</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="las la-chart-line fa-2x text-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card report-card border-left-warning">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Returns</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-8">Rs 12,450</div>
                                <div class="mt-2 mb-0 text-muted text-xs">
                                    <span class="text-danger mr-2"><i class="fa fa-arrow-up"></i> 2.1%</span>
                                    <span>of total sales</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="las la-exchange-alt fa-2x text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="row mb-4">
            <div class="col-lg-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Sales Trend - Monthly</h6>
                    </div>
                    <div class="card-body">
                        <canvas id="monthlySalesChart" height="250"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Sales by Payment Method</h6>
                    </div>
                    <div class="card-body">
                        <canvas id="paymentMethodChart" height="250"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detailed Report Table -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Detailed Sales Report</h6>
                <div>
                    <select class="form-control form-control-sm d-inline-block w-auto mr-2" id="reportType">
                        <option value="summary">Summary View</option>
                        <option value="detailed" selected>Detailed View</option>
                        <option value="product">Product-wise</option>
                        <option value="customer">Customer-wise</option>
                    </select>
                    <button class="btn btn-sm btn-primary" onclick="refreshReport()">
                        <i class="las la-sync"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="salesReportTable" width="100%" cellspacing="0">
                        <thead class="thead-light">
                            <tr>
                                <th>Date</th>
                                <th>Invoice #</th>
                                <th>Customer</th>
                                <th>Items</th>
                                <th>Subtotal</th>
                                <th>Discount</th>
                                <th>Tax</th>
                                <th>Total</th>
                                <th>Payment</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Sale 1 -->
                            <tr>
                                <td>15-01-2024</td>
                                <td>INV-2024-00101</td>
                                <td>John Doe</td>
                                <td class="text-center">3</td>
                                <td class="text-right">Rs 8,450</td>
                                <td class="text-right">Rs 250</td>
                                <td class="text-right">Rs 845</td>
                                <td class="text-right font-weight-bold">Rs 9,045</td>
                                <td>
                                    <span class="badge badge-success">Cash</span>
                                </td>
                                <td>
                                    <span class="badge badge-success">Completed</span>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-outline-primary">
                                        <i class="las la-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            
                            <!-- Sale 2 -->
                            <tr>
                                <td>14-01-2024</td>
                                <td>INV-2024-00102</td>
                                <td>Jane Smith</td>
                                <td class="text-center">2</td>
                                <td class="text-right">Rs 5,280</td>
                                <td class="text-right">Rs 120</td>
                                <td class="text-right">Rs 528</td>
                                <td class="text-right font-weight-bold">Rs 5,688</td>
                                <td>
                                    <span class="badge badge-primary">Card</span>
                                </td>
                                <td>
                                    <span class="badge badge-success">Completed</span>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-outline-primary">
                                        <i class="las la-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            
                            <!-- Sale 3 -->
                            <tr>
                                <td>13-01-2024</td>
                                <td>INV-2024-00103</td>
                                <td>Robert Johnson</td>
                                <td class="text-center">4</td>
                                <td class="text-right">Rs 12,850</td>
                                <td class="text-right">Rs 450</td>
                                <td class="text-right">Rs 1,285</td>
                                <td class="text-right font-weight-bold">Rs 13,685</td>
                                <td>
                                    <span class="badge badge-info">UPI</span>
                                </td>
                                <td>
                                    <span class="badge badge-success">Completed</span>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-outline-primary">
                                        <i class="las la-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            
                            <!-- Sale 4 -->
                            <tr>
                                <td>12-01-2024</td>
                                <td>INV-2024-00104</td>
                                <td>Sarah Williams</td>
                                <td class="text-center">1</td>
                                <td class="text-right">Rs 3,200</td>
                                <td class="text-right">Rs 80</td>
                                <td class="text-right">Rs 320</td>
                                <td class="text-right font-weight-bold">Rs 3,440</td>
                                <td>
                                    <span class="badge badge-success">Cash</span>
                                </td>
                                <td>
                                    <span class="badge badge-success">Completed</span>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-outline-primary">
                                        <i class="las la-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            
                            <!-- Sale 5 -->
                            <tr>
                                <td>11-01-2024</td>
                                <td>INV-2024-00105</td>
                                <td>Michael Brown</td>
                                <td class="text-center">5</td>
                                <td class="text-right">Rs 15,420</td>
                                <td class="text-right">Rs 520</td>
                                <td class="text-right">Rs 1,542</td>
                                <td class="text-right font-weight-bold">Rs 16,442</td>
                                <td>
                                    <span class="badge badge-primary">Card</span>
                                </td>
                                <td>
                                    <span class="badge badge-success">Completed</span>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-outline-primary">
                                        <i class="las la-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            
                            <!-- Sale 6 -->
                            <tr>
                                <td>10-01-2024</td>
                                <td>INV-2024-00106</td>
                                <td>Emily Davis</td>
                                <td class="text-center">2</td>
                                <td class="text-right">Rs 6,850</td>
                                <td class="text-right">Rs 150</td>
                                <td class="text-right">Rs 685</td>
                                <td class="text-right font-weight-bold">Rs 7,385</td>
                                <td>
                                    <span class="badge badge-info">UPI</span>
                                </td>
                                <td>
                                    <span class="badge badge-success">Completed</span>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-outline-primary">
                                        <i class="las la-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            
                            <!-- Sale 7 -->
                            <tr>
                                <td>09-01-2024</td>
                                <td>INV-2024-00107</td>
                                <td>David Wilson</td>
                                <td class="text-center">3</td>
                                <td class="text-right">Rs 9,250</td>
                                <td class="text-right">Rs 320</td>
                                <td class="text-right">Rs 925</td>
                                <td class="text-right font-weight-bold">Rs 9,855</td>
                                <td>
                                    <span class="badge badge-success">Cash</span>
                                </td>
                                <td>
                                    <span class="badge badge-success">Completed</span>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-outline-primary">
                                        <i class="las la-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            
                            <!-- Sale 8 -->
                            <tr>
                                <td>08-01-2024</td>
                                <td>INV-2024-00108</td>
                                <td>Lisa Miller</td>
                                <td class="text-center">4</td>
                                <td class="text-right">Rs 11,680</td>
                                <td class="text-right">Rs 480</td>
                                <td class="text-right">Rs 1,168</td>
                                <td class="text-right font-weight-bold">Rs 12,368</td>
                                <td>
                                    <span class="badge badge-primary">Card</span>
                                </td>
                                <td>
                                    <span class="badge badge-success">Completed</span>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-outline-primary">
                                        <i class="las la-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            
                            <!-- Sale 9 -->
                            <tr>
                                <td>07-01-2024</td>
                                <td>INV-2024-00109</td>
                                <td>James Taylor</td>
                                <td class="text-center">1</td>
                                <td class="text-right">Rs 2,850</td>
                                <td class="text-right">Rs 50</td>
                                <td class="text-right">Rs 285</td>
                                <td class="text-right font-weight-bold">Rs 3,085</td>
                                <td>
                                    <span class="badge badge-info">UPI</span>
                                </td>
                                <td>
                                    <span class="badge badge-success">Completed</span>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-outline-primary">
                                        <i class="las la-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            
                            <!-- Sale 10 -->
                            <tr>
                                <td>06-01-2024</td>
                                <td>INV-2024-00110</td>
                                <td>Jennifer Anderson</td>
                                <td class="text-center">2</td>
                                <td class="text-right">Rs 7,420</td>
                                <td class="text-right">Rs 220</td>
                                <td class="text-right">Rs 742</td>
                                <td class="text-right font-weight-bold">Rs 7,942</td>
                                <td>
                                    <span class="badge badge-warning">Credit</span>
                                </td>
                                <td>
                                    <span class="badge badge-success">Completed</span>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-outline-primary">
                                        <i class="las la-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot class="font-weight-bold">
                            <tr>
                                <td colspan="4" class="text-right">Totals:</td>
                                <td class="text-right">Rs 82,250</td>
                                <td class="text-right">Rs 2,640</td>
                                <td class="text-right">Rs 8,225</td>
                                <td class="text-right">Rs 87,835</td>
                                <td colspan="3"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                
                <!-- Pagination -->
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div>
                        Showing 1 to 10 of 856 entries
                    </div>
                    <nav>
                        <ul class="pagination mb-0">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Previous</a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Additional Analysis -->
        <div class="row">
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Top 5 Customers</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Customer</th>
                                        <th>Orders</th>
                                        <th>Total Spent</th>
                                        <th>Last Purchase</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Customer 1 -->
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-sm mr-2">
                                                    <span class="avatar-title rounded-circle bg-primary text-white">
                                                        C1
                                                    </span>
                                                </div>
                                                <div>
                                                    <div class="font-weight-bold">John Doe</div>
                                                    <small class="text-muted">john@example.com</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="font-weight-bold">42</td>
                                        <td class="font-weight-bold text-success">Rs 145,280</td>
                                        <td>15-01-2024</td>
                                    </tr>
                                    
                                    <!-- Customer 2 -->
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-sm mr-2">
                                                    <span class="avatar-title rounded-circle bg-primary text-white">
                                                        C2
                                                    </span>
                                                </div>
                                                <div>
                                                    <div class="font-weight-bold">Jane Smith</div>
                                                    <small class="text-muted">jane@example.com</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="font-weight-bold">35</td>
                                        <td class="font-weight-bold text-success">Rs 128,420</td>
                                        <td>14-01-2024</td>
                                    </tr>
                                    
                                    <!-- Customer 3 -->
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-sm mr-2">
                                                    <span class="avatar-title rounded-circle bg-primary text-white">
                                                        C3
                                                    </span>
                                                </div>
                                                <div>
                                                    <div class="font-weight-bold">Robert Johnson</div>
                                                    <small class="text-muted">robert@example.com</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="font-weight-bold">28</td>
                                        <td class="font-weight-bold text-success">Rs 98,750</td>
                                        <td>13-01-2024</td>
                                    </tr>
                                    
                                    <!-- Customer 4 -->
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-sm mr-2">
                                                    <span class="avatar-title rounded-circle bg-primary text-white">
                                                        C4
                                                    </span>
                                                </div>
                                                <div>
                                                    <div class="font-weight-bold">Sarah Williams</div>
                                                    <small class="text-muted">sarah@example.com</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="font-weight-bold">31</td>
                                        <td class="font-weight-bold text-success">Rs 112,180</td>
                                        <td>12-01-2024</td>
                                    </tr>
                                    
                                    <!-- Customer 5 -->
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-sm mr-2">
                                                    <span class="avatar-title rounded-circle bg-primary text-white">
                                                        C5
                                                    </span>
                                                </div>
                                                <div>
                                                    <div class="font-weight-bold">Michael Brown</div>
                                                    <small class="text-muted">michael@example.com</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="font-weight-bold">22</td>
                                        <td class="font-weight-bold text-success">Rs 86,420</td>
                                        <td>11-01-2024</td>
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
                        <h6 class="m-0 font-weight-bold text-primary">Hourly Sales Performance</h6>
                    </div>
                    <div class="card-body">
                        <canvas id="hourlySalesChart" height="200"></canvas>
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
        $('#salesReportTable').DataTable({
            pageLength: 10,
            ordering: true,
            order: [[0, 'desc']],
            dom: '<"top"f>rt<"bottom"lip><"clear">',
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search reports..."
            }
        });
        
        // Date range picker
        $('#dateRangePicker').click(function(e) {
            e.stopPropagation();
            $('#dateRangeDropdown').toggle();
        });
        
        $(document).click(function() {
            $('#dateRangeDropdown').hide();
        });
        
        // Initialize charts
        initCharts();
        
        // Apply filters
        window.generateReport = function() {
            const filters = {
                dateRange: $('#dateRangeText').text(),
                branch: $('#branchFilter').val(),
                paymentMethod: $('#paymentFilter').val(),
                salesPerson: $('#salesPersonFilter').val(),
                customerType: $('#customerTypeFilter').val()
            };
            
            console.log('Generating report with filters:', filters);
            
            // Show loading
            $('#salesReportTable_wrapper').html('<div class="text-center py-5"><i class="las la-spinner la-spin fa-2x text-primary"></i><p class="mt-2">Generating report...</p></div>');
            
            // Simulate API call
            setTimeout(() => {
                alert('Report generated with applied filters!');
                // Reload table data
                location.reload();
            }, 1500);
        };
        
        // Reset filters
        window.resetFilters = function() {
            $('#branchFilter').val('');
            $('#paymentFilter').val('');
            $('#salesPersonFilter').val('');
            $('#customerTypeFilter').val('');
            $('#dateRangeText').text('This Month');
            $('#fromDate').val('2024-01-01');
            $('#toDate').val('2024-01-15');
            
            alert('Filters reset to default values!');
        };
        
        // Export functions
        window.exportToExcel = function() {
            alert('Exporting to Excel...');
            // Implement Excel export logic
        };
        
        window.exportToPDF = function() {
            alert('Exporting to PDF...');
            // Implement PDF export logic
        };
        
        window.printReport = function() {
            window.print();
        };
        
        window.saveReportTemplate = function() {
            const templateName = prompt('Enter template name:');
            if (templateName) {
                alert('Template "' + templateName + '" saved successfully!');
            }
        };
        
        window.refreshReport = function() {
            const reportType = $('#reportType').val();
            alert('Refreshing ' + reportType + ' report...');
            // Implement report refresh logic
        };
        
        function initCharts() {
            // Monthly Sales Chart
            var ctx1 = document.getElementById('monthlySalesChart').getContext('2d');
            new Chart(ctx1, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        label: 'Sales (₹)',
                        data: [45000, 52000, 48000, 61000, 72000, 68000, 75000, 82000, 78000, 85000, 92000, 98000],
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
            
            // Payment Method Chart
            var ctx2 = document.getElementById('paymentMethodChart').getContext('2d');
            new Chart(ctx2, {
                type: 'pie',
                data: {
                    labels: ['Cash', 'Card', 'UPI', 'Credit'],
                    datasets: [{
                        data: [35, 40, 15, 10],
                        backgroundColor: [
                            'rgba(40, 167, 69, 0.8)',
                            'rgba(0, 123, 255, 0.8)',
                            'rgba(23, 162, 184, 0.8)',
                            'rgba(255, 193, 7, 0.8)'
                        ]
                    }]
                }
            });
            
            // Hourly Sales Chart
            var ctx3 = document.getElementById('hourlySalesChart').getContext('2d');
            new Chart(ctx3, {
                type: 'line',
                data: {
                    labels: ['9 AM', '10 AM', '11 AM', '12 PM', '1 PM', '2 PM', '3 PM', '4 PM', '5 PM', '6 PM', '7 PM', '8 PM'],
                    datasets: [{
                        label: 'Sales Amount',
                        data: [2500, 4200, 3800, 5200, 4800, 3500, 4200, 5800, 6200, 7800, 6500, 4200],
                        borderColor: 'rgba(220, 53, 69, 1)',
                        backgroundColor: 'rgba(220, 53, 69, 0.1)',
                        tension: 0.3
                    }]
                }
            });
        }
    });
    
    function applyDateRange() {
        const fromDate = $('#fromDate').val();
        const toDate = $('#toDate').val();
        
        if (fromDate && toDate) {
            const from = new Date(fromDate).toLocaleDateString();
            const to = new Date(toDate).toLocaleDateString();
            $('#dateRangeText').text(from + ' to ' + to);
        }
        
        $('#dateRangeDropdown').hide();
    }
    </script>
    @endpush
</x-app-layout>