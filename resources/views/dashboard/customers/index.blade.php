<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/remixicon/fonts/remixicon.css') }}">
    @endpush

    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
            <div>
                <h4 class="mb-3">Customers Management</h4>
                <p class="mb-0">Manage customer profiles, loyalty programs and communications</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Customers</li>
                    </ol>
                </nav>
            </div>
            <div class="d-flex">
                <a href="{{ route('customers.create') }}" class="btn btn-primary add-list">
                    <i class="las la-plus mr-2"></i>Add New Customer
                </a>
                <button class="btn btn-success ml-2" data-toggle="modal" data-target="#importModal">
                    <i class="las la-file-import mr-2"></i>Import
                </button>
            </div>
        </div>

        <!-- Customer Statistics -->
        <div class="row mb-4">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-white mb-0">Total Customers</h6>
                                <h2 class="mb-0 text-white">1,245</h2>
                                <small class="text-white-50">+12 this month</small>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-users fa-2x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-white mb-0">Active Customers</h6>
                                <h2 class="mb-0 text-white">1,128</h2>
                                <small class="text-white-50">91% active rate</small>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-user-check fa-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-white mb-0">VIP Customers</h6>
                                <h2 class="mb-0 text-white">56</h2>
                                <small class="text-white-50">4.5% of total</small>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-crown fa-2x text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-white mb-0">Loyalty Points</h6>
                                <h2 class="mb-0 text-white">245,680</h2>
                                <small class="text-white-50">Total points issued</small>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-gem fa-2x text-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Search Customer</label>
                            <input type="text" class="form-control" id="customerSearch" placeholder="Name, Phone, Email">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Customer Type</label>
                            <select class="form-control" id="customerTypeFilter">
                                <option value="">All Types</option>
                                <option value="walk_in">Walk-in</option>
                                <option value="regular">Regular</option>
                                <option value="wholesale">Wholesale</option>
                                <option value="corporate">Corporate</option>
                                <option value="vip">VIP</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Loyalty Tier</label>
                            <select class="form-control" id="loyaltyFilter">
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
                            <label>Status</label>
                            <select class="form-control" id="statusFilter">
                                <option value="">All Status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="blacklisted">Blacklisted</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <div class="form-group w-100 d-flex">
                            <button class="btn btn-primary mr-2 flex-grow-1" id="filterBtn">Filter</button>
                            <button class="btn btn-outline-secondary" id="resetBtn">Reset</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Customer Groups -->
        <div class="mb-4">
            <h6 class="mb-3">Customer Groups</h6>
            <div class="d-flex flex-wrap">
                <button class="btn btn-outline-primary m-1 active" data-group="all">
                    All Customers <span class="badge badge-light ml-1">1,245</span>
                </button>
                <button class="btn btn-outline-secondary m-1" data-group="recent">
                    Recent (30 Days) <span class="badge badge-light ml-1">45</span>
                </button>
                <button class="btn btn-outline-success m-1" data-group="high_value">
                    High Value <span class="badge badge-light ml-1">89</span>
                </button>
                <button class="btn btn-outline-warning m-1" data-group="inactive">
                    Inactive (3+ Months) <span class="badge badge-light ml-1">117</span>
                </button>
                <button class="btn btn-outline-info m-1" data-group="birthday">
                    Birthday This Month <span class="badge badge-light ml-1">23</span>
                </button>
                <button class="btn btn-outline-danger m-1" data-group="credit">
                    Credit Customers <span class="badge badge-light ml-1">34</span>
                </button>
            </div>
        </div>

        <!-- Customers Table -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="customersTable">
                        <thead>
                            <tr>
                                <th>Customer</th>
                                <th>Contact</th>
                                <th>Customer Type</th>
                                <th>Loyalty</th>
                                <th>Total Spent</th>
                                <th>Last Purchase</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Customer 1 - VIP -->
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-md mr-3">
                                            <img src="https://ui-avatars.com/api/?name=John+Smith&background=007bff&color=fff&size=100"
                                                class="rounded-circle" alt="John Smith">
                                        </div>
                                        <div>
                                            <h6 class="mb-0">John Smith</h6>
                                            <small class="text-muted">CUST-00123</small>
                                            <br>
                                            <small class="text-muted">Member since: Jan 2023</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <small><i class="las la-phone mr-2"></i>+91 98765 43210</small>
                                        <small><i class="las la-envelope mr-2"></i>john.smith@example.com</small>
                                        <small><i class="las la-map-marker mr-2"></i>Mumbai</small>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-primary">VIP</span>
                                    <br>
                                    <small class="text-muted">Gold Member</small>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <div class="d-flex align-items-center">
                                            <i class="las la-gem text-warning mr-1"></i>
                                            <strong>12,450</strong>
                                        </div>
                                        <small class="text-muted">Platinum Tier</small>
                                        <div class="progress" style="height: 4px; width: 80px;">
                                            <div class="progress-bar bg-warning" style="width: 85%"></div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <strong class="text-success">Rs2,45,680</strong>
                                    <br>
                                    <small class="text-muted">45 purchases</small>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <strong>15 Nov 2024</strong>
                                        <small class="text-muted">Rs4,127</small>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-success">Active</span>
                                    <br>
                                    <small class="text-muted">Frequent buyer</small>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('customers.show', 1) }}" class="btn btn-sm btn-info mr-2" title="View">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="{{ route('customers.edit', 1) }}" class="btn btn-sm btn-primary mr-2" title="Edit">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <button class="btn btn-sm btn-success mr-2" title="Message" data-toggle="modal" data-target="#messageModal">
                                            <i class="las la-comment"></i>
                                        </button>
                                        <button class="btn btn-sm btn-warning" title="Blacklist" data-toggle="modal" data-target="#blacklistModal">
                                            <i class="las la-ban"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Customer 2 - Regular -->
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-md mr-3">
                                            <img src="https://ui-avatars.com/api/?name=Sarah+Johnson&background=28a745&color=fff&size=100"
                                                class="rounded-circle" alt="Sarah Johnson">
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Sarah Johnson</h6>
                                            <small class="text-muted">CUST-00124</small>
                                            <br>
                                            <small class="text-muted">Member since: Mar 2023</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <small><i class="las la-phone mr-2"></i>+91 98765 43211</small>
                                        <small><i class="las la-envelope mr-2"></i>sarah.j@example.com</small>
                                        <small><i class="las la-map-marker mr-2"></i>Delhi</small>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-success">Regular</span>
                                    <br>
                                    <small class="text-muted">Monthly shopper</small>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <div class="d-flex align-items-center">
                                            <i class="las la-gem text-secondary mr-1"></i>
                                            <strong>4,230</strong>
                                        </div>
                                        <small class="text-muted">Gold Tier</small>
                                        <div class="progress" style="height: 4px; width: 80px;">
                                            <div class="progress-bar bg-secondary" style="width: 65%"></div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <strong class="text-success">Rs1,23,450</strong>
                                    <br>
                                    <small class="text-muted">28 purchases</small>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <strong>14 Nov 2024</strong>
                                        <small class="text-muted">Rs6,095</small>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-success">Active</span>
                                    <br>
                                    <small class="text-muted">Online shopper</small>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('customers.show', 2) }}" class="btn btn-sm btn-info mr-2" title="View">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="{{ route('customers.edit', 2) }}" class="btn btn-sm btn-primary mr-2" title="Edit">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <button class="btn btn-sm btn-success mr-2" title="Message">
                                            <i class="las la-comment"></i>
                                        </button>
                                        <button class="btn btn-sm btn-warning" title="Blacklist">
                                            <i class="las la-ban"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Customer 3 - Wholesale -->
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-md mr-3">
                                            <img src="https://ui-avatars.com/api/?name=Michael+Brown&background=ffc107&color=000&size=100"
                                                class="rounded-circle" alt="Michael Brown">
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Michael Brown</h6>
                                            <small class="text-muted">CUST-00125</small>
                                            <br>
                                            <small class="text-muted">Member since: Jun 2023</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <small><i class="las la-phone mr-2"></i>+91 98765 43212</small>
                                        <small><i class="las la-envelope mr-2"></i>michael@store.com</small>
                                        <small><i class="las la-map-marker mr-2"></i>Bangalore</small>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-warning">Wholesale</span>
                                    <br>
                                    <small class="text-muted">Bulk purchases</small>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <div class="d-flex align-items-center">
                                            <i class="las la-gem text-success mr-1"></i>
                                            <strong>8,750</strong>
                                        </div>
                                        <small class="text-muted">Gold Tier</small>
                                        <div class="progress" style="height: 4px; width: 80px;">
                                            <div class="progress-bar bg-success" style="width: 75%"></div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <strong class="text-success">Rs4,56,780</strong>
                                    <br>
                                    <small class="text-muted">12 purchases</small>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <strong>10 Nov 2024</strong>
                                        <small class="text-muted">Rs45,600</small>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-success">Active</span>
                                    <br>
                                    <small class="text-muted">Business account</small>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('customers.show', 3) }}" class="btn btn-sm btn-info mr-2" title="View">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="{{ route('customers.edit', 3) }}" class="btn btn-sm btn-primary mr-2" title="Edit">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <button class="btn btn-sm btn-success mr-2" title="Message">
                                            <i class="las la-comment"></i>
                                        </button>
                                        <button class="btn btn-sm btn-warning" title="Blacklist">
                                            <i class="las la-ban"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Customer 4 - Credit -->
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-md mr-3">
                                            <img src="https://ui-avatars.com/api/?name=Emma+Wilson&background=6f42c1&color=fff&size=100"
                                                class="rounded-circle" alt="Emma Wilson">
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Emma Wilson</h6>
                                            <small class="text-muted">CUST-00126</small>
                                            <br>
                                            <small class="text-muted">Member since: Aug 2023</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <small><i class="las la-phone mr-2"></i>+91 98765 43213</small>
                                        <small><i class="las la-envelope mr-2"></i>emma.w@example.com</small>
                                        <small><i class="las la-map-marker mr-2"></i>Chennai</small>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-info">Corporate</span>
                                    <br>
                                    <small class="text-muted">Credit account</small>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <div class="d-flex align-items-center">
                                            <i class="las la-gem text-info mr-1"></i>
                                            <strong>3,120</strong>
                                        </div>
                                        <small class="text-muted">Silver Tier</small>
                                        <div class="progress" style="height: 4px; width: 80px;">
                                            <div class="progress-bar bg-info" style="width: 45%"></div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <strong class="text-success">Rs89,450</strong>
                                    <br>
                                    <small class="text-muted">18 purchases</small>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <strong>05 Nov 2024</strong>
                                        <small class="text-muted">Rs12,500</small>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-warning">Credit</span>
                                    <br>
                                    <small class="text-danger">Due: Rs2,599</small>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('customers.show', 4) }}" class="btn btn-sm btn-info mr-2" title="View">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="{{ route('customers.edit', 4) }}" class="btn btn-sm btn-primary mr-2" title="Edit">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <button class="btn btn-sm btn-danger mr-2" title="Collect Payment">
                                            <i class="las la-money-bill-wave"></i>
                                        </button>
                                        <button class="btn btn-sm btn-warning" title="Blacklist">
                                            <i class="las la-ban"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Customer 5 - Inactive -->
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-md mr-3">
                                            <img src="https://ui-avatars.com/api/?name=David+Miller&background=17a2b8&color=fff&size=100"
                                                class="rounded-circle" alt="David Miller">
                                        </div>
                                        <div>
                                            <h6 class="mb-0">David Miller</h6>
                                            <small class="text-muted">CUST-00127</small>
                                            <br>
                                            <small class="text-muted">Member since: Feb 2023</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <small><i class="las la-phone mr-2"></i>+91 98765 43214</small>
                                        <small><i class="las la-envelope mr-2"></i>david.m@example.com</small>
                                        <small><i class="las la-map-marker mr-2"></i>Kolkata</small>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-secondary">Walk-in</span>
                                    <br>
                                    <small class="text-muted">Occasional shopper</small>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <div class="d-flex align-items-center">
                                            <i class="las la-gem text-secondary mr-1"></i>
                                            <strong>850</strong>
                                        </div>
                                        <small class="text-muted">Bronze Tier</small>
                                        <div class="progress" style="height: 4px; width: 80px;">
                                            <div class="progress-bar bg-secondary" style="width: 25%"></div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <strong class="text-success">Rs23,450</strong>
                                    <br>
                                    <small class="text-muted">8 purchases</small>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <strong>15 Aug 2024</strong>
                                        <small class="text-muted">Rs3,798</small>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-secondary">Inactive</span>
                                    <br>
                                    <small class="text-muted">3+ months</small>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('customers.show', 5) }}" class="btn btn-sm btn-info mr-2" title="View">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="{{ route('customers.edit', 5) }}" class="btn btn-sm btn-primary mr-2" title="Edit">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <button class="btn btn-sm btn-success mr-2" title="Re-engage">
                                            <i class="las la-bell"></i>
                                        </button>
                                        <button class="btn btn-sm btn-warning" title="Blacklist">
                                            <i class="las la-ban"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Customer 6 - Blacklisted -->
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-md mr-3">
                                            <img src="https://ui-avatars.com/api/?name=Robert+Taylor&background=dc3545&color=fff&size=100"
                                                class="rounded-circle" alt="Robert Taylor">
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Robert Taylor</h6>
                                            <small class="text-muted">CUST-00128</small>
                                            <br>
                                            <small class="text-muted">Member since: Dec 2022</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <small><i class="las la-phone mr-2"></i>+91 98765 43215</small>
                                        <small><i class="las la-envelope mr-2"></i>robert.t@example.com</small>
                                        <small><i class="las la-map-marker mr-2"></i>Hyderabad</small>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-danger">Blacklisted</span>
                                    <br>
                                    <small class="text-muted">Payment issues</small>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <div class="d-flex align-items-center">
                                            <i class="las la-gem text-secondary mr-1"></i>
                                            <strong>0</strong>
                                        </div>
                                        <small class="text-muted">No tier</small>
                                        <div class="progress" style="height: 4px; width: 80px;">
                                            <div class="progress-bar" style="width: 0%"></div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <strong class="text-success">Rs45,670</strong>
                                    <br>
                                    <small class="text-muted">15 purchases</small>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <strong>20 Jun 2024</strong>
                                        <small class="text-muted">Rs8,950</small>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-danger">Blacklisted</span>
                                    <br>
                                    <small class="text-danger">Payment default</small>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('customers.show', 6) }}" class="btn btn-sm btn-info mr-2" title="View">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <button class="btn btn-sm btn-success mr-2" title="Unblock">
                                            <i class="las la-unlock"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger" title="Delete">
                                            <i class="las la-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center mt-4">
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

    <!-- Import Modal -->
    <div class="modal fade" id="importModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Import Customers</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-4">
                        <i class="las la-file-import fa-3x text-primary mb-3"></i>
                        <h5>Import Customer Data</h5>
                        <p class="text-muted">Upload CSV file with customer information</p>
                    </div>

                    <div class="form-group">
                        <label>Download Template</label>
                        <a href="#" class="btn btn-outline-primary btn-block">
                            <i class="las la-download mr-2"></i>Download CSV Template
                        </a>
                    </div>

                    <div class="form-group">
                        <label>Upload CSV File</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customerCSV" accept=".csv">
                            <label class="custom-file-label" for="customerCSV">Choose file</label>
                        </div>
                        <small class="form-text text-muted">Maximum file size: 5MB</small>
                    </div>

                    <div class="form-group">
                        <label>Import Options</label>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="updateExisting" checked>
                            <label class="custom-control-label" for="updateExisting">Update existing customers</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="sendWelcome" checked>
                            <label class="custom-control-label" for="sendWelcome">Send welcome message to new customers</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Import Customers</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Message Modal -->
    <div class="modal fade" id="messageModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Send Message</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label>Customer</label>
                            <input type="text" class="form-control" value="John Smith (CUST-00123)" readonly>
                        </div>
                        <div class="form-group">
                            <label>Communication Type</label>
                            <select class="form-control">
                                <option value="sms">SMS</option>
                                <option value="email">Email</option>
                                <option value="whatsapp">WhatsApp</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Message Template</label>
                            <select class="form-control">
                                <option value="">Custom Message</option>
                                <option value="welcome">Welcome Message</option>
                                <option value="birthday">Birthday Greeting</option>
                                <option value="promotion">Promotion Offer</option>
                                <option value="anniversary">Anniversary Greeting</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Message</label>
                            <textarea class="form-control" rows="5" placeholder="Enter your message here...">Dear John Smith,

Thank you for being a valued customer!

Best regards,
Cloth Shop Team</textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Send Message</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Blacklist Modal -->
    <div class="modal fade" id="blacklistModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Blacklist Customer</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning">
                        <i class="las la-exclamation-triangle mr-2"></i>
                        Are you sure you want to blacklist this customer?
                    </div>

                    <form>
                        <div class="form-group">
                            <label>Customer</label>
                            <input type="text" class="form-control" value="John Smith (CUST-00123)" readonly>
                        </div>
                        <div class="form-group">
                            <label>Reason for Blacklisting</label>
                            <select class="form-control">
                                <option value="">Select Reason</option>
                                <option value="payment_default">Payment Default</option>
                                <option value="fraudulent">Fraudulent Activity</option>
                                <option value="abusive">Abusive Behavior</option>
                                <option value="policy_violation">Policy Violation</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Details</label>
                            <textarea class="form-control" rows="3" placeholder="Provide additional details..."></textarea>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="notifyCustomer">
                                <label class="custom-control-label" for="notifyCustomer">Notify customer about blacklisting</label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger">Confirm Blacklist</button>
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
            // Customer search
            $('#customerSearch').on('input', function() {
                const searchTerm = $(this).val().toLowerCase();
                filterCustomers();
            });

            // Filter customers
            $('#filterBtn').click(function() {
                filterCustomers();
            });

            // Reset filters
            $('#resetBtn').click(function() {
                $('#customerSearch').val('');
                $('#customerTypeFilter').val('');
                $('#loyaltyFilter').val('');
                $('#statusFilter').val('');
                $('[data-group]').removeClass('active');
                $('[data-group="all"]').addClass('active');
                filterCustomers();
            });

            // Customer groups
            $('[data-group]').click(function() {
                $('[data-group]').removeClass('active');
                $(this).addClass('active');
                filterCustomers();
            });

            // File input label
            $('#customerCSV').on('change', function() {
                const fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').text(fileName || 'Choose file');
            });

            // Tooltip initialization
            $('[title]').tooltip();

            function filterCustomers() {
                const searchTerm = $('#customerSearch').val().toLowerCase();
                const customerType = $('#customerTypeFilter').val();
                const loyaltyTier = $('#loyaltyFilter').val();
                const status = $('#statusFilter').val();
                const activeGroup = $('[data-group].active').data('group');

                $('#customersTable tbody tr').each(function() {
                    const row = $(this);
                    const customerName = row.find('h6').text().toLowerCase();
                    const customerCode = row.find('.text-muted').first().text().toLowerCase();
                    const customerPhone = row.find('small').eq(0).text().toLowerCase();
                    const customerEmail = row.find('small').eq(1).text().toLowerCase();

                    const typeBadge = row.find('td:nth-child(3) .badge').text().toLowerCase();
                    const loyaltyText = row.find('td:nth-child(4) small').text().toLowerCase();
                    const statusBadge = row.find('td:nth-child(7) .badge').text().toLowerCase();

                    let show = true;

                    // Search filter
                    if (searchTerm && !customerName.includes(searchTerm) &&
                        !customerCode.includes(searchTerm) &&
                        !customerPhone.includes(searchTerm) &&
                        !customerEmail.includes(searchTerm)) {
                        show = false;
                    }

                    // Customer type filter
                    if (customerType && !typeBadge.includes(customerType)) {
                        show = false;
                    }

                    // Loyalty tier filter
                    if (loyaltyTier && !loyaltyText.includes(loyaltyTier)) {
                        show = false;
                    }

                    // Status filter
                    if (status && !statusBadge.includes(status)) {
                        show = false;
                    }

                    // Group filter (simplified example)
                    if (activeGroup === 'inactive' && !statusBadge.includes('inactive')) {
                        show = false;
                    } else if (activeGroup === 'credit' && !statusBadge.includes('credit')) {
                        show = false;
                    } else if (activeGroup === 'blacklisted' && !statusBadge.includes('blacklisted')) {
                        show = false;
                    }

                    row.toggle(show);
                });
            }

            // Initialize filtering
            filterCustomers();
        });
    </script>
    @endpush
</x-app-layout>