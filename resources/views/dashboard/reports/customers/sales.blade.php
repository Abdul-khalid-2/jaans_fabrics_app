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
                <h4 class="mb-3">Customer Purchase History</h4>
                <p class="mb-0">Track customer purchases, loyalty, and buying patterns</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#">Reports</a></li>
                        <li class="breadcrumb-item"><a href="#">Customers</a></li>
                        <li class="breadcrumb-item active">Purchase History</li>
                    </ol>
                </nav>
            </div>
            <div>
                <button class="btn btn-outline-primary" onclick="exportCustomerReport()">
                    <i class="las la-file-excel mr-2"></i>Export
                </button>
                <button class="btn btn-primary ml-2" onclick="printCustomerReport()">
                    <i class="las la-print mr-2"></i>Print
                </button>
                <button class="btn btn-success ml-2" onclick="sendCustomerReport()">
                    <i class="las la-envelope mr-2"></i>Email Report
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
                                <input type="date" class="form-control" id="customerFromDate" value="2024-01-01">
                                <div class="input-group-append">
                                    <span class="input-group-text">to</span>
                                </div>
                                <input type="date" class="form-control" id="customerToDate" value="2024-01-15">
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-2">
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
                    
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label">Loyalty Tier</label>
                            <select class="form-control" id="loyaltyTierFilter">
                                <option value="">All Tiers</option>
                                <option value="bronze">Bronze</option>
                                <option value="silver">Silver</option>
                                <option value="gold">Gold</option>
                                <option value="platinum">Platinum</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label">Branch</label>
                            <select class="form-control" id="customerBranchFilter">
                                <option value="">All Branches</option>
                                <option value="1">Main Store</option>
                                <option value="2">Outlet 1</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Search Customer</label>
                            <input type="text" class="form-control" id="customerSearch" placeholder="Name, phone, or email">
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12 text-right">
                        <button class="btn btn-secondary" onclick="resetCustomerFilters()">
                            <i class="las la-redo mr-2"></i>Reset
                        </button>
                        <button class="btn btn-primary ml-2" onclick="loadCustomerReport()">
                            <i class="las la-filter mr-2"></i>Generate Report
                        </button>
                        <button class="btn btn-success ml-2" onclick="saveCustomerSegment()">
                            <i class="las la-save mr-2"></i>Save Segment
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Customer Insights -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Customers</div>
                                <div class="h3 mb-0 font-weight-bold text-gray-800">1,245</div>
                                <div class="mt-2 text-muted small">Active customers</div>
                            </div>
                            <div class="col-auto">
                                <i class="las la-users fa-2x text-primary"></i>
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
                                    Repeat Customers</div>
                                <div class="h3 mb-0 font-weight-bold text-gray-800">456</div>
                                <div class="mt-2 text-muted small">36.6% retention rate</div>
                            </div>
                            <div class="col-auto">
                                <i class="las la-user-check fa-2x text-success"></i>
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
                                    Avg. Purchase Value</div>
                                <div class="h3 mb-0 font-weight-bold text-gray-800">Rs 3,560</div>
                                <div class="mt-2 text-muted small">Per transaction</div>
                            </div>
                            <div class="col-auto">
                                <i class="las la-rupee-sign fa-2x text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Lifetime Value</div>
                                <div class="h3 mb-0 font-weight-bold text-gray-800">Rs 245,680</div>
                                <div class="mt-2 text-muted small">Total customer value</div>
                            </div>
                            <div class="col-auto">
                                <i class="las la-chart-line fa-2x text-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Customer Segmentation -->
        <div class="row mb-4">
            <div class="col-lg-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Customer Purchase Trends</h6>
                    </div>
                    <div class="card-body">
                        <canvas id="customerTrendChart" height="250"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Customer Distribution by Tier</h6>
                    </div>
                    <div class="card-body">
                        <canvas id="customerTierChart" height="250"></canvas>
                        <div class="mt-4">
                            <div class="row text-center">
                                <div class="col-6">
                                    <div class="h4 font-weight-bold">45%</div>
                                    <small class="text-muted">Premium Customers</small>
                                </div>
                                <div class="col-6">
                                    <div class="h4 font-weight-bold">Rs 184,560</div>
                                    <small class="text-muted">Revenue from Premium</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top Customers Table -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Top Customers by Revenue</h6>
                <div class="dropdown">
                    <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" id="topCustomersOptions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="las la-cog"></i> View Options
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="topCustomersOptions">
                        <a class="dropdown-item" href="#" onclick="showTopByRevenue()">Top by Revenue</a>
                        <a class="dropdown-item" href="#" onclick="showTopByFrequency()">Top by Frequency</a>
                        <a class="dropdown-item" href="#" onclick="showTopByRecency()">Top by Recency</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" onclick="showInactiveCustomers()">Inactive Customers</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="topCustomersTable" width="100%" cellspacing="0">
                        <thead class="thead-light">
                            <tr>
                                <th>Customer</th>
                                <th>Contact</th>
                                <th>Customer Since</th>
                                <th class="text-right">Total Orders</th>
                                <th class="text-right">Total Spent</th>
                                <th class="text-right">Avg. Order Value</th>
                                <th class="text-right">Last Purchase</th>
                                <th>Loyalty Tier</th>
                                <th>Loyalty Points</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Customer 1 -->
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm mr-2">
                                            <span class="avatar-title rounded-circle bg-primary text-white">
                                                J
                                            </span>
                                        </div>
                                        <div>
                                            <div class="font-weight-bold">John Doe</div>
                                            <small class="text-muted">CUST-001</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div>john@example.com</div>
                                    <small class="text-muted">9876543210</small>
                                </td>
                                <td>15-10-2023</td>
                                <td class="text-right font-weight-bold">28</td>
                                <td class="text-right font-weight-bold text-success">Rs 145,280</td>
                                <td class="text-right">Rs 5,188</td>
                                <td class="text-right">05-01-2024</td>
                                <td>
                                    <span class="badge badge-primary">Platinum</span>
                                </td>
                                <td class="font-weight-bold">4,250</td>
                                <td>
                                    <span class="badge badge-success">Active</span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-primary" onclick="viewCustomer(1)">
                                            <i class="las la-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-success" onclick="contactCustomer('john@example.com')">
                                            <i class="las la-envelope"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            
                            <!-- Customer 2 -->
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm mr-2">
                                            <span class="avatar-title rounded-circle bg-primary text-white">
                                                J
                                            </span>
                                        </div>
                                        <div>
                                            <div class="font-weight-bold">Jane Smith</div>
                                            <small class="text-muted">CUST-002</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div>jane@example.com</div>
                                    <small class="text-muted">9876543211</small>
                                </td>
                                <td>22-08-2023</td>
                                <td class="text-right font-weight-bold">35</td>
                                <td class="text-right font-weight-bold text-success">Rs 128,420</td>
                                <td class="text-right">Rs 3,669</td>
                                <td class="text-right">08-01-2024</td>
                                <td>
                                    <span class="badge badge-warning">Gold</span>
                                </td>
                                <td class="font-weight-bold">3,850</td>
                                <td>
                                    <span class="badge badge-success">Active</span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-primary" onclick="viewCustomer(2)">
                                            <i class="las la-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-success" onclick="contactCustomer('jane@example.com')">
                                            <i class="las la-envelope"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            
                            <!-- Customer 3 -->
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm mr-2">
                                            <span class="avatar-title rounded-circle bg-primary text-white">
                                                R
                                            </span>
                                        </div>
                                        <div>
                                            <div class="font-weight-bold">Robert Johnson</div>
                                            <small class="text-muted">CUST-003</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div>robert@example.com</div>
                                    <small class="text-muted">9876543212</small>
                                </td>
                                <td>10-05-2023</td>
                                <td class="text-right font-weight-bold">42</td>
                                <td class="text-right font-weight-bold text-success">Rs 112,850</td>
                                <td class="text-right">Rs 2,687</td>
                                <td class="text-right">10-01-2024</td>
                                <td>
                                    <span class="badge badge-secondary">Silver</span>
                                </td>
                                <td class="font-weight-bold">2,150</td>
                                <td>
                                    <span class="badge badge-success">Active</span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-primary" onclick="viewCustomer(3)">
                                            <i class="las la-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-success" onclick="contactCustomer('robert@example.com')">
                                            <i class="las la-envelope"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            
                            <!-- Customer 4 -->
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm mr-2">
                                            <span class="avatar-title rounded-circle bg-primary text-white">
                                                S
                                            </span>
                                        </div>
                                        <div>
                                            <div class="font-weight-bold">Sarah Williams</div>
                                            <small class="text-muted">CUST-004</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div>sarah@example.com</div>
                                    <small class="text-muted">9876543213</small>
                                </td>
                                <td>05-12-2022</td>
                                <td class="text-right font-weight-bold">18</td>
                                <td class="text-right font-weight-bold text-success">Rs 98,420</td>
                                <td class="text-right">Rs 5,467</td>
                                <td class="text-right">12-01-2024</td>
                                <td>
                                    <span class="badge badge-primary">Platinum</span>
                                </td>
                                <td class="font-weight-bold">4,850</td>
                                <td>
                                    <span class="badge badge-success">Active</span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-primary" onclick="viewCustomer(4)">
                                            <i class="las la-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-success" onclick="contactCustomer('sarah@example.com')">
                                            <i class="las la-envelope"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            
                            <!-- Customer 5 -->
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm mr-2">
                                            <span class="avatar-title rounded-circle bg-primary text-white">
                                                M
                                            </span>
                                        </div>
                                        <div>
                                            <div class="font-weight-bold">Michael Brown</div>
                                            <small class="text-muted">CUST-005</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div>michael@example.com</div>
                                    <small class="text-muted">9876543214</small>
                                </td>
                                <td>18-09-2023</td>
                                <td class="text-right font-weight-bold">22</td>
                                <td class="text-right font-weight-bold text-success">Rs 86,750</td>
                                <td class="text-right">Rs 3,943</td>
                                <td class="text-right">15-01-2024</td>
                                <td>
                                    <span class="badge badge-warning">Gold</span>
                                </td>
                                <td class="font-weight-bold">3,250</td>
                                <td>
                                    <span class="badge badge-success">Active</span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-primary" onclick="viewCustomer(5)">
                                            <i class="las la-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-success" onclick="contactCustomer('michael@example.com')">
                                            <i class="las la-envelope"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            
                            <!-- Customer 6 -->
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm mr-2">
                                            <span class="avatar-title rounded-circle bg-primary text-white">
                                                E
                                            </span>
                                        </div>
                                        <div>
                                            <div class="font-weight-bold">Emily Davis</div>
                                            <small class="text-muted">CUST-006</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div>emily@example.com</div>
                                    <small class="text-muted">9876543215</small>
                                </td>
                                <td>30-11-2023</td>
                                <td class="text-right font-weight-bold">15</td>
                                <td class="text-right font-weight-bold text-success">Rs 72,420</td>
                                <td class="text-right">Rs 4,828</td>
                                <td class="text-right">14-01-2024</td>
                                <td>
                                    <span class="badge badge-secondary">Silver</span>
                                </td>
                                <td class="font-weight-bold">1,850</td>
                                <td>
                                    <span class="badge badge-success">Active</span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-primary" onclick="viewCustomer(6)">
                                            <i class="las la-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-success" onclick="contactCustomer('emily@example.com')">
                                            <i class="las la-envelope"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            
                            <!-- Customer 7 -->
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm mr-2">
                                            <span class="avatar-title rounded-circle bg-primary text-white">
                                                D
                                            </span>
                                        </div>
                                        <div>
                                            <div class="font-weight-bold">David Wilson</div>
                                            <small class="text-muted">CUST-007</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div>david@example.com</div>
                                    <small class="text-muted">9876543216</small>
                                </td>
                                <td>12-07-2023</td>
                                <td class="text-right font-weight-bold">8</td>
                                <td class="text-right font-weight-bold text-success">Rs 45,250</td>
                                <td class="text-right">Rs 5,656</td>
                                <td class="text-right">11-01-2024</td>
                                <td>
                                    <span class="badge badge-dark">Bronze</span>
                                </td>
                                <td class="font-weight-bold">850</td>
                                <td>
                                    <span class="badge badge-success">Active</span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-primary" onclick="viewCustomer(7)">
                                            <i class="las la-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-success" onclick="contactCustomer('david@example.com')">
                                            <i class="las la-envelope"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            
                            <!-- Customer 8 -->
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm mr-2">
                                            <span class="avatar-title rounded-circle bg-primary text-white">
                                                L
                                            </span>
                                        </div>
                                        <div>
                                            <div class="font-weight-bold">Lisa Miller</div>
                                            <small class="text-muted">CUST-008</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div>lisa@example.com</div>
                                    <small class="text-muted">9876543217</small>
                                </td>
                                <td>22-04-2023</td>
                                <td class="text-right font-weight-bold">31</td>
                                <td class="text-right font-weight-bold text-success">Rs 128,180</td>
                                <td class="text-right">Rs 4,134</td>
                                <td class="text-right">09-01-2024</td>
                                <td>
                                    <span class="badge badge-primary">Platinum</span>
                                </td>
                                <td class="font-weight-bold">4,620</td>
                                <td>
                                    <span class="badge badge-success">Active</span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-primary" onclick="viewCustomer(8)">
                                            <i class="las la-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-success" onclick="contactCustomer('lisa@example.com')">
                                            <i class="las la-envelope"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            
                            <!-- Customer 9 -->
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm mr-2">
                                            <span class="avatar-title rounded-circle bg-primary text-white">
                                                J
                                            </span>
                                        </div>
                                        <div>
                                            <div class="font-weight-bold">James Taylor</div>
                                            <small class="text-muted">CUST-009</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div>james@example.com</div>
                                    <small class="text-muted">9876543218</small>
                                </td>
                                <td>08-06-2023</td>
                                <td class="text-right font-weight-bold">26</td>
                                <td class="text-right font-weight-bold text-success">Rs 96,420</td>
                                <td class="text-right">Rs 3,708</td>
                                <td class="text-right">13-01-2024</td>
                                <td>
                                    <span class="badge badge-warning">Gold</span>
                                </td>
                                <td class="font-weight-bold">3,420</td>
                                <td>
                                    <span class="badge badge-success">Active</span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-primary" onclick="viewCustomer(9)">
                                            <i class="las la-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-success" onclick="contactCustomer('james@example.com')">
                                            <i class="las la-envelope"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            
                            <!-- Customer 10 -->
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm mr-2">
                                            <span class="avatar-title rounded-circle bg-primary text-white">
                                                J
                                            </span>
                                        </div>
                                        <div>
                                            <div class="font-weight-bold">Jennifer Anderson</div>
                                            <small class="text-muted">CUST-010</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div>jennifer@example.com</div>
                                    <small class="text-muted">9876543219</small>
                                </td>
                                <td>14-02-2023</td>
                                <td class="text-right font-weight-bold">19</td>
                                <td class="text-right font-weight-bold text-success">Rs 78,280</td>
                                <td class="text-right">Rs 4,120</td>
                                <td class="text-right">07-01-2024</td>
                                <td>
                                    <span class="badge badge-secondary">Silver</span>
                                </td>
                                <td class="font-weight-bold">2,850</td>
                                <td>
                                    <span class="badge badge-success">Active</span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-primary" onclick="viewCustomer(10)">
                                            <i class="las la-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-success" onclick="contactCustomer('jennifer@example.com')">
                                            <i class="las la-envelope"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Customer Purchase History -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Detailed Purchase History</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="purchaseHistoryTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Invoice #</th>
                                <th>Customer</th>
                                <th>Items</th>
                                <th>Amount</th>
                                <th>Payment Method</th>
                                <th>Branch</th>
                                <th>Sales Person</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Purchase 1 -->
                            <tr>
                                <td>15-01-2024</td>
                                <td>INV-2024-00101</td>
                                <td>John Doe</td>
                                <td class="text-center">3</td>
                                <td class="font-weight-bold">Rs 8,450</td>
                                <td>
                                    <span class="badge badge-primary">Card</span>
                                </td>
                                <td>Main Store</td>
                                <td>Staff 1</td>
                                <td>
                                    <span class="badge badge-success">Completed</span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary" onclick="viewInvoice('INV-2024-00101')">
                                        <i class="las la-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            
                            <!-- Purchase 2 -->
                            <tr>
                                <td>14-01-2024</td>
                                <td>INV-2024-00102</td>
                                <td>Jane Smith</td>
                                <td class="text-center">2</td>
                                <td class="font-weight-bold">Rs 5,280</td>
                                <td>
                                    <span class="badge badge-success">Cash</span>
                                </td>
                                <td>Main Store</td>
                                <td>Staff 2</td>
                                <td>
                                    <span class="badge badge-success">Completed</span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary" onclick="viewInvoice('INV-2024-00102')">
                                        <i class="las la-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            
                            <!-- Purchase 3 -->
                            <tr>
                                <td>13-01-2024</td>
                                <td>INV-2024-00103</td>
                                <td>Robert Johnson</td>
                                <td class="text-center">4</td>
                                <td class="font-weight-bold">Rs 12,850</td>
                                <td>
                                    <span class="badge badge-info">UPI</span>
                                </td>
                                <td>Main Store</td>
                                <td>Staff 3</td>
                                <td>
                                    <span class="badge badge-success">Completed</span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary" onclick="viewInvoice('INV-2024-00103')">
                                        <i class="las la-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            
                            <!-- Purchase 4 -->
                            <tr>
                                <td>12-01-2024</td>
                                <td>INV-2024-00104</td>
                                <td>Sarah Williams</td>
                                <td class="text-center">1</td>
                                <td class="font-weight-bold">Rs 3,200</td>
                                <td>
                                    <span class="badge badge-success">Cash</span>
                                </td>
                                <td>Main Store</td>
                                <td>Staff 1</td>
                                <td>
                                    <span class="badge badge-success">Completed</span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary" onclick="viewInvoice('INV-2024-00104')">
                                        <i class="las la-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            
                            <!-- Purchase 5 -->
                            <tr>
                                <td>11-01-2024</td>
                                <td>INV-2024-00105</td>
                                <td>Michael Brown</td>
                                <td class="text-center">5</td>
                                <td class="font-weight-bold">Rs 15,420</td>
                                <td>
                                    <span class="badge badge-primary">Card</span>
                                </td>
                                <td>Main Store</td>
                                <td>Staff 2</td>
                                <td>
                                    <span class="badge badge-success">Completed</span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary" onclick="viewInvoice('INV-2024-00105')">
                                        <i class="las la-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            
                            <!-- Purchase 6 -->
                            <tr>
                                <td>10-01-2024</td>
                                <td>INV-2024-00106</td>
                                <td>Emily Davis</td>
                                <td class="text-center">2</td>
                                <td class="font-weight-bold">Rs 6,850</td>
                                <td>
                                    <span class="badge badge-info">UPI</span>
                                </td>
                                <td>Main Store</td>
                                <td>Staff 3</td>
                                <td>
                                    <span class="badge badge-success">Completed</span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary" onclick="viewInvoice('INV-2024-00106')">
                                        <i class="las la-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            
                            <!-- Purchase 7 -->
                            <tr>
                                <td>09-01-2024</td>
                                <td>INV-2024-00107</td>
                                <td>David Wilson</td>
                                <td class="text-center">3</td>
                                <td class="font-weight-bold">Rs 9,250</td>
                                <td>
                                    <span class="badge badge-success">Cash</span>
                                </td>
                                <td>Main Store</td>
                                <td>Staff 1</td>
                                <td>
                                    <span class="badge badge-success">Completed</span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary" onclick="viewInvoice('INV-2024-00107')">
                                        <i class="las la-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            
                            <!-- Purchase 8 -->
                            <tr>
                                <td>08-01-2024</td>
                                <td>INV-2024-00108</td>
                                <td>Lisa Miller</td>
                                <td class="text-center">4</td>
                                <td class="font-weight-bold">Rs 11,680</td>
                                <td>
                                    <span class="badge badge-primary">Card</span>
                                </td>
                                <td>Main Store</td>
                                <td>Staff 2</td>
                                <td>
                                    <span class="badge badge-success">Completed</span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary" onclick="viewInvoice('INV-2024-00108')">
                                        <i class="las la-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            
                            <!-- Purchase 9 -->
                            <tr>
                                <td>07-01-2024</td>
                                <td>INV-2024-00109</td>
                                <td>James Taylor</td>
                                <td class="text-center">1</td>
                                <td class="font-weight-bold">Rs 2,850</td>
                                <td>
                                    <span class="badge badge-info">UPI</span>
                                </td>
                                <td>Main Store</td>
                                <td>Staff 3</td>
                                <td>
                                    <span class="badge badge-success">Completed</span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary" onclick="viewInvoice('INV-2024-00109')">
                                        <i class="las la-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            
                            <!-- Purchase 10 -->
                            <tr>
                                <td>06-01-2024</td>
                                <td>INV-2024-00110</td>
                                <td>Jennifer Anderson</td>
                                <td class="text-center">2</td>
                                <td class="font-weight-bold">Rs 7,420</td>
                                <td>
                                    <span class="badge badge-success">Cash</span>
                                </td>
                                <td>Main Store</td>
                                <td>Staff 1</td>
                                <td>
                                    <span class="badge badge-success">Completed</span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary" onclick="viewInvoice('INV-2024-00110')">
                                        <i class="las la-eye"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Customer Insights -->
        <div class="row">
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Customer Demographics</h6>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-4 mb-3">
                                <div class="h4 font-weight-bold">42%</div>
                                <small class="text-muted">Male</small>
                            </div>
                            <div class="col-4 mb-3">
                                <div class="h4 font-weight-bold">56%</div>
                                <small class="text-muted">Female</small>
                            </div>
                            <div class="col-4 mb-3">
                                <div class="h4 font-weight-bold">2%</div>
                                <small class="text-muted">Other</small>
                            </div>
                        </div>
                        <hr>
                        <div class="row text-center">
                            <div class="col-3 mb-3">
                                <div class="h5 font-weight-bold">18-25</div>
                                <small class="text-muted">25%</small>
                            </div>
                            <div class="col-3 mb-3">
                                <div class="h5 font-weight-bold">26-35</div>
                                <small class="text-muted">45%</small>
                            </div>
                            <div class="col-3 mb-3">
                                <div class="h5 font-weight-bold">36-50</div>
                                <small class="text-muted">25%</small>
                            </div>
                            <div class="col-3 mb-3">
                                <div class="h5 font-weight-bold">50+</div>
                                <small class="text-muted">5%</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Customer Acquisition</h6>
                    </div>
                    <div class="card-body">
                        <canvas id="acquisitionChart" height="200"></canvas>
                        <div class="mt-3">
                            <div class="row text-center">
                                <div class="col-4">
                                    <div class="h5 font-weight-bold">24</div>
                                    <small class="text-muted">New This Month</small>
                                </div>
                                <div class="col-4">
                                    <div class="h5 font-weight-bold">156</div>
                                    <small class="text-muted">New This Year</small>
                                </div>
                                <div class="col-4">
                                    <div class="h5 font-weight-bold">12.5%</div>
                                    <small class="text-muted">Growth Rate</small>
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
        // Initialize DataTables
        $('#topCustomersTable').DataTable({
            pageLength: 10,
            ordering: true,
            order: [[4, 'desc']], // Sort by Total Spent
            dom: '<"top"f>rt<"bottom"lip><"clear">'
        });
        
        $('#purchaseHistoryTable').DataTable({
            pageLength: 10,
            ordering: true,
            order: [[0, 'desc']], // Sort by Date
            dom: '<"top"f>rt<"bottom"lip><"clear">'
        });
        
        // Initialize charts
        initCustomerCharts();
        
        // Load customer report
        window.loadCustomerReport = function() {
            const fromDate = $('#customerFromDate').val();
            const toDate = $('#customerToDate').val();
            const customerType = $('#customerTypeFilter').val();
            const loyaltyTier = $('#loyaltyTierFilter').val();
            const branch = $('#customerBranchFilter').val();
            const search = $('#customerSearch').val();
            
            console.log('Loading customer report:', { fromDate, toDate, customerType, loyaltyTier, branch, search });
            
            // Show loading
            $('#topCustomersTable_wrapper').html('<div class="text-center py-5"><i class="las la-spinner la-spin fa-2x text-primary"></i><p class="mt-2">Loading customer report...</p></div>');
            
            // Simulate API call
            setTimeout(() => {
                alert('Customer report loaded for selected filters');
                // Reload charts with new data
                initCustomerCharts();
            }, 1000);
        };
        
        function initCustomerCharts() {
            // Customer Trend Chart
            var ctx1 = document.getElementById('customerTrendChart').getContext('2d');
            new Chart(ctx1, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        label: 'New Customers',
                        data: [25, 32, 28, 41, 52, 48, 55, 62, 58, 65, 72, 78],
                        borderColor: 'rgba(78, 115, 223, 1)',
                        backgroundColor: 'rgba(78, 115, 223, 0.1)',
                        tension: 0.3,
                        fill: true
                    }, {
                        label: 'Repeat Customers',
                        data: [20, 28, 25, 35, 42, 40, 47, 52, 48, 55, 62, 68],
                        borderColor: 'rgba(40, 167, 69, 1)',
                        backgroundColor: 'rgba(40, 167, 69, 0.1)',
                        tension: 0.3,
                        fill: true
                    }]
                }
            });
            
            // Customer Tier Chart
            var ctx2 = document.getElementById('customerTierChart').getContext('2d');
            new Chart(ctx2, {
                type: 'doughnut',
                data: {
                    labels: ['Platinum', 'Gold', 'Silver', 'Bronze'],
                    datasets: [{
                        data: [15, 30, 25, 30],
                        backgroundColor: [
                            'rgba(78, 115, 223, 0.8)',
                            'rgba(255, 193, 7, 0.8)',
                            'rgba(108, 117, 125, 0.8)',
                            'rgba(220, 53, 69, 0.8)'
                        ]
                    }]
                }
            });
            
            // Acquisition Chart
            var ctx3 = document.getElementById('acquisitionChart').getContext('2d');
            new Chart(ctx3, {
                type: 'bar',
                data: {
                    labels: ['Walk-in', 'Referral', 'Online', 'Social Media', 'Events'],
                    datasets: [{
                        label: 'New Customers',
                        data: [45, 25, 15, 10, 5],
                        backgroundColor: 'rgba(40, 167, 69, 0.5)',
                        borderColor: 'rgba(40, 167, 69, 1)',
                        borderWidth: 1
                    }]
                }
            });
        }
        
        window.exportCustomerReport = function() {
            alert('Exporting customer report to Excel...');
        };
        
        window.printCustomerReport = function() {
            window.print();
        };
        
        window.sendCustomerReport = function() {
            const email = prompt('Enter email address to send report:');
            if (email) {
                alert('Customer report sent to ' + email);
            }
        };
        
        window.resetCustomerFilters = function() {
            $('#customerFromDate').val('2024-01-01');
            $('#customerToDate').val('2024-01-15');
            $('#customerTypeFilter').val('');
            $('#loyaltyTierFilter').val('');
            $('#customerBranchFilter').val('');
            $('#customerSearch').val('');
            
            alert('Filters reset to default values!');
        };
        
        window.saveCustomerSegment = function() {
            const segmentName = prompt('Enter segment name:');
            if (segmentName) {
                alert('Customer segment "' + segmentName + '" saved successfully!');
            }
        };
        
        window.showTopByRevenue = function() {
            alert('Showing top customers by revenue...');
        };
        
        window.showTopByFrequency = function() {
            alert('Showing top customers by purchase frequency...');
        };
        
        window.showTopByRecency = function() {
            alert('Showing top customers by recency...');
        };
        
        window.showInactiveCustomers = function() {
            alert('Showing inactive customers (no purchase in 90 days)...');
        };
        
        window.viewCustomer = function(customerId) {
            alert('Viewing customer details for ID: ' + customerId);
            window.open('/customers/' + customerId, '_blank');
        };
        
        window.contactCustomer = function(email) {
            alert('Opening contact form for: ' + email);
        };
        
        window.viewInvoice = function(invoiceNumber) {
            alert('Viewing invoice: ' + invoiceNumber);
            window.open('/sales/' + invoiceNumber, '_blank');
        };
    });
    </script>
    @endpush
</x-app-layout>