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
                <h4 class="mb-3">Staff Management</h4>
                <p class="mb-0">Manage staff profiles, assignments and employment details</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Staff</li>
                    </ol>
                </nav>
            </div>
            <div class="d-flex">
                <a href="{{ route('staff.create') }}" class="btn btn-primary add-list">
                    <i class="las la-plus mr-2"></i>Add New Staff
                </a>
                <button class="btn btn-success ml-2" data-toggle="modal" data-target="#importModal">
                    <i class="las la-file-import mr-2"></i>Import Staff
                </button>
                <button class="btn btn-warning ml-2" data-toggle="modal" data-target="#attendanceModal">
                    <i class="las la-calendar-check mr-2"></i>Bulk Attendance
                </button>
            </div>
        </div>

        <!-- Staff Statistics -->
        <div class="row mb-4">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-white mb-0">Total Staff</h6>
                                <h2 class="mb-0 text-white">48</h2>
                                <small class="text-white-50">+3 this month</small>
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
                                <h6 class="text-white mb-0">Active Staff</h6>
                                <h2 class="mb-0 text-white">45</h2>
                                <small class="text-white-50">94% active rate</small>
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
                                <h6 class="text-white mb-0">On Leave Today</h6>
                                <h2 class="mb-0 text-white">3</h2>
                                <small class="text-white-50">6% of staff</small>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-bed fa-2x text-warning"></i>
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
                                <h6 class="text-white mb-0">Avg. Attendance</h6>
                                <h2 class="mb-0 text-white">96%</h2>
                                <small class="text-white-50">This month</small>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-chart-line fa-2x text-info"></i>
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
                            <label>Search Staff</label>
                            <input type="text" class="form-control" id="staffSearch" placeholder="Name, Employee Code">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Department</label>
                            <select class="form-control" id="departmentFilter">
                                <option value="">All Departments</option>
                                <option value="sales">Sales</option>
                                <option value="inventory">Inventory</option>
                                <option value="accounts">Accounts</option>
                                <option value="management">Management</option>
                                <option value="purchasing">Purchasing</option>
                                <option value="hr">HR</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Designation</label>
                            <select class="form-control" id="designationFilter">
                                <option value="">All Designations</option>
                                <option value="manager">Manager</option>
                                <option value="sales_executive">Sales Executive</option>
                                <option value="cashier">Cashier</option>
                                <option value="store_keeper">Store Keeper</option>
                                <option value="accountant">Accountant</option>
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
                                <option value="probation">Probation</option>
                                <option value="leave">On Leave</option>
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

        <!-- Staff Groups -->
        <div class="mb-4">
            <h6 class="mb-3">Staff Groups</h6>
            <div class="d-flex flex-wrap">
                <button class="btn btn-outline-primary m-1 active" data-group="all">
                    All Staff <span class="badge badge-light ml-1">48</span>
                </button>
                <button class="btn btn-outline-secondary m-1" data-group="sales">
                    Sales Team <span class="badge badge-light ml-1">18</span>
                </button>
                <button class="btn btn-outline-success m-1" data-group="inventory">
                    Inventory Team <span class="badge badge-light ml-1">8</span>
                </button>
                <button class="btn btn-outline-warning m-1" data-group="management">
                    Management <span class="badge badge-light ml-1">6</span>
                </button>
                <button class="btn btn-outline-info m-1" data-group="probation">
                    Probation Period <span class="badge badge-light ml-1">4</span>
                </button>
                <button class="btn btn-outline-danger m-1" data-group="leave">
                    On Leave Today <span class="badge badge-light ml-1">3</span>
                </button>
            </div>
        </div>

        <!-- Staff Table -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="staffTable">
                        <thead>
                            <tr>
                                <th>Employee</th>
                                <th>Department & Designation</th>
                                <th>Contact</th>
                                <th>Employment</th>
                                <th>Attendance</th>
                                <th>Performance</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Staff 1 - Sales Manager -->
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-md mr-3">
                                            <img src="https://ui-avatars.com/api/?name=Rajesh+Kumar&background=007bff&color=fff&size=100"
                                                class="rounded-circle" alt="Rajesh Kumar">
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Rajesh Kumar</h6>
                                            <small class="text-muted">EMP-S001</small>
                                            <br>
                                            <small class="text-muted">Joined: 15 Jan 2022</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span class="badge badge-primary">Sales</span>
                                        <strong>Sales Manager</strong>
                                        <small class="text-muted">Main Branch</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <small><i class="las la-phone mr-2"></i>+91 98765 43210</small>
                                        <small><i class="las la-envelope mr-2"></i>rajesh@clothshop.com</small>
                                        <small><i class="las la-map-marker mr-2"></i>Mumbai</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <small><strong>Type:</strong> Permanent</small>
                                        <small><strong>Salary:</strong> Rs45,000</small>
                                        <small><strong>Bank:</strong> HDFC Bank</small>
                                        <small><strong>Account:</strong> ****4321</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <div class="d-flex justify-content-between">
                                            <small>This Month:</small>
                                            <strong class="text-success">28/28</strong>
                                        </div>
                                        <div class="progress" style="height: 5px;">
                                            <div class="progress-bar bg-success" style="width: 100%"></div>
                                        </div>
                                        <small class="text-muted">Last: Today, 9:05 AM</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <div class="d-flex justify-content-between">
                                            <small>Sales Target:</small>
                                            <strong>Rs5,00,000</strong>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <small>Achieved:</small>
                                            <strong class="text-success">Rs4,85,000</strong>
                                        </div>
                                        <div class="progress" style="height: 5px;">
                                            <div class="progress-bar bg-success" style="width: 97%"></div>
                                        </div>
                                        <small class="text-muted">97% achieved</small>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-success">Active</span>
                                    <br>
                                    <small class="text-muted">Present today</small>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('staff.show', 1) }}" class="btn btn-sm btn-info mr-1" title="View">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="{{ route('staff.edit', 1) }}" class="btn btn-sm btn-primary mr-1" title="Edit">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <button class="btn btn-sm btn-warning mr-1" title="Attendance" data-toggle="modal" data-target="#attendanceModal">
                                            <i class="las la-calendar-check"></i>
                                        </button>
                                        <button class="btn btn-sm btn-success" title="Payroll" data-toggle="modal" data-target="#salaryModal">
                                            <i class="las la-money-bill-wave"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Staff 2 - Sales Executive -->
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-md mr-3">
                                            <img src="https://ui-avatars.com/api/?name=Priya+Sharma&background=28a745&color=fff&size=100"
                                                class="rounded-circle" alt="Priya Sharma">
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Priya Sharma</h6>
                                            <small class="text-muted">EMP-S002</small>
                                            <br>
                                            <small class="text-muted">Joined: 20 Mar 2023</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span class="badge badge-primary">Sales</span>
                                        <strong>Sales Executive</strong>
                                        <small class="text-muted">Main Branch</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <small><i class="las la-phone mr-2"></i>+91 98765 43211</small>
                                        <small><i class="las la-envelope mr-2"></i>priya@clothshop.com</small>
                                        <small><i class="las la-map-marker mr-2"></i>Mumbai</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <small><strong>Type:</strong> Permanent</small>
                                        <small><strong>Salary:</strong> Rs25,000</small>
                                        <small><strong>Commission:</strong> 2%</small>
                                        <small><strong>Aadhar:</strong> ****5678</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <div class="d-flex justify-content-between">
                                            <small>This Month:</small>
                                            <strong class="text-success">26/28</strong>
                                        </div>
                                        <div class="progress" style="height: 5px;">
                                            <div class="progress-bar bg-success" style="width: 93%"></div>
                                        </div>
                                        <small class="text-muted">Last: Today, 9:15 AM</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <div class="d-flex justify-content-between">
                                            <small>Sales Target:</small>
                                            <strong>Rs2,00,000</strong>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <small>Achieved:</small>
                                            <strong class="text-success">Rs2,15,000</strong>
                                        </div>
                                        <div class="progress" style="height: 5px;">
                                            <div class="progress-bar bg-success" style="width: 108%"></div>
                                        </div>
                                        <small class="text-muted">Overachieved</small>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-success">Active</span>
                                    <br>
                                    <small class="text-success">Top performer</small>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('staff.show', 2) }}" class="btn btn-sm btn-info mr-1" title="View">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="{{ route('staff.edit', 2) }}" class="btn btn-sm btn-primary mr-1" title="Edit">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <button class="btn btn-sm btn-warning mr-1" title="Attendance">
                                            <i class="las la-calendar-check"></i>
                                        </button>
                                        <button class="btn btn-sm btn-success" title="Payroll">
                                            <i class="las la-money-bill-wave"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Staff 3 - Store Keeper -->
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-md mr-3">
                                            <img src="https://ui-avatars.com/api/?name=Amit+Patel&background=ffc107&color=000&size=100"
                                                class="rounded-circle" alt="Amit Patel">
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Amit Patel</h6>
                                            <small class="text-muted">EMP-I001</small>
                                            <br>
                                            <small class="text-muted">Joined: 10 Feb 2022</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span class="badge badge-success">Inventory</span>
                                        <strong>Store Keeper</strong>
                                        <small class="text-muted">Warehouse Branch</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <small><i class="las la-phone mr-2"></i>+91 98765 43212</small>
                                        <small><i class="las la-envelope mr-2"></i>amit@clothshop.com</small>
                                        <small><i class="las la-map-marker mr-2"></i>Thane</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <small><strong>Type:</strong> Permanent</small>
                                        <small><strong>Salary:</strong> Rs22,000</small>
                                        <small><strong>Bank:</strong> SBI</small>
                                        <small><strong>PAN:</strong> ABCP1234D</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <div class="d-flex justify-content-between">
                                            <small>This Month:</small>
                                            <strong class="text-success">27/28</strong>
                                        </div>
                                        <div class="progress" style="height: 5px;">
                                            <div class="progress-bar bg-success" style="width: 96%"></div>
                                        </div>
                                        <small class="text-muted">Last: Today, 8:55 AM</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <div class="d-flex justify-content-between">
                                            <small>Inventory Accuracy:</small>
                                            <strong>98.5%</strong>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <small>Stock Counts:</small>
                                            <strong class="text-success">45</strong>
                                        </div>
                                        <div class="progress" style="height: 5px;">
                                            <div class="progress-bar bg-info" style="width: 98.5%"></div>
                                        </div>
                                        <small class="text-muted">Excellent</small>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-success">Active</span>
                                    <br>
                                    <small class="text-muted">Regular</small>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('staff.show', 3) }}" class="btn btn-sm btn-info mr-1" title="View">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="{{ route('staff.edit', 3) }}" class="btn btn-sm btn-primary mr-1" title="Edit">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <button class="btn btn-sm btn-warning mr-1" title="Attendance">
                                            <i class="las la-calendar-check"></i>
                                        </button>
                                        <button class="btn btn-sm btn-success" title="Payroll">
                                            <i class="las la-money-bill-wave"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Staff 4 - Accountant -->
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-md mr-3">
                                            <img src="https://ui-avatars.com/api/?name=Neha+Gupta&background=6f42c1&color=fff&size=100"
                                                class="rounded-circle" alt="Neha Gupta">
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Neha Gupta</h6>
                                            <small class="text-muted">EMP-A001</small>
                                            <br>
                                            <small class="text-muted">Joined: 05 Apr 2023</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span class="badge badge-info">Accounts</span>
                                        <strong>Accountant</strong>
                                        <small class="text-muted">Main Branch</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <small><i class="las la-phone mr-2"></i>+91 98765 43213</small>
                                        <small><i class="las la-envelope mr-2"></i>neha@clothshop.com</small>
                                        <small><i class="las la-map-marker mr-2"></i>Mumbai</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <small><strong>Type:</strong> Permanent</small>
                                        <small><strong>Salary:</strong> Rs35,000</small>
                                        <small><strong>Bank:</strong> ICICI</small>
                                        <small><strong>Account:</strong> ****8765</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <div class="d-flex justify-content-between">
                                            <small>This Month:</small>
                                            <strong class="text-warning">25/28</strong>
                                        </div>
                                        <div class="progress" style="height: 5px;">
                                            <div class="progress-bar bg-warning" style="width: 89%"></div>
                                        </div>
                                        <small class="text-muted">On leave: 3 days</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <div class="d-flex justify-content-between">
                                            <small>Reports:</small>
                                            <strong>45</strong>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <small>Accuracy:</small>
                                            <strong class="text-success">99.8%</strong>
                                        </div>
                                        <div class="progress" style="height: 5px;">
                                            <div class="progress-bar bg-success" style="width: 99.8%"></div>
                                        </div>
                                        <small class="text-muted">Excellent</small>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-warning">On Leave</span>
                                    <br>
                                    <small class="text-warning">Sick leave</small>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('staff.show', 4) }}" class="btn btn-sm btn-info mr-1" title="View">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="{{ route('staff.edit', 4) }}" class="btn btn-sm btn-primary mr-1" title="Edit">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <button class="btn btn-sm btn-warning mr-1" title="Attendance">
                                            <i class="las la-calendar-check"></i>
                                        </button>
                                        <button class="btn btn-sm btn-success" title="Payroll">
                                            <i class="las la-money-bill-wave"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Staff 5 - Cashier -->
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-md mr-3">
                                            <img src="https://ui-avatars.com/api/?name=Rohan+Singh&background=17a2b8&color=fff&size=100"
                                                class="rounded-circle" alt="Rohan Singh">
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Rohan Singh</h6>
                                            <small class="text-muted">EMP-S003</small>
                                            <br>
                                            <small class="text-muted">Joined: 15 Jun 2024</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span class="badge badge-primary">Sales</span>
                                        <strong>Cashier</strong>
                                        <small class="text-muted">Mall Branch</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <small><i class="las la-phone mr-2"></i>+91 98765 43214</small>
                                        <small><i class="las la-envelope mr-2"></i>rohan@clothshop.com</small>
                                        <small><i class="las la-map-marker mr-2"></i>Andheri</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <small><strong>Type:</strong> Probation</small>
                                        <small><strong>Salary:</strong> Rs18,000</small>
                                        <small><strong>Period:</strong> 3 months</small>
                                        <small><strong>Ends:</strong> 15 Sep 2024</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <div class="d-flex justify-content-between">
                                            <small>This Month:</small>
                                            <strong class="text-success">28/28</strong>
                                        </div>
                                        <div class="progress" style="height: 5px;">
                                            <div class="progress-bar bg-success" style="width: 100%"></div>
                                        </div>
                                        <small class="text-muted">Punctual</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <div class="d-flex justify-content-between">
                                            <small>Transactions:</small>
                                            <strong>1,245</strong>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <small>Accuracy:</small>
                                            <strong class="text-success">100%</strong>
                                        </div>
                                        <div class="progress" style="height: 5px;">
                                            <div class="progress-bar bg-success" style="width: 100%"></div>
                                        </div>
                                        <small class="text-muted">No errors</small>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-info">Probation</span>
                                    <br>
                                    <small class="text-info">2 months completed</small>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('staff.show', 5) }}" class="btn btn-sm btn-info mr-1" title="View">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="{{ route('staff.edit', 5) }}" class="btn btn-sm btn-primary mr-1" title="Edit">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <button class="btn btn-sm btn-warning mr-1" title="Attendance">
                                            <i class="las la-calendar-check"></i>
                                        </button>
                                        <button class="btn btn-sm btn-success" title="Payroll">
                                            <i class="las la-money-bill-wave"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Staff 6 - Inactive -->
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-md mr-3">
                                            <img src="https://ui-avatars.com/api/?name=Suresh+Yadav&background=dc3545&color=fff&size=100"
                                                class="rounded-circle" alt="Suresh Yadav">
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Suresh Yadav</h6>
                                            <small class="text-muted">EMP-S004</small>
                                            <br>
                                            <small class="text-muted">Joined: 10 Jan 2023</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span class="badge badge-secondary">Sales</span>
                                        <strong>Sales Executive</strong>
                                        <small class="text-muted">Ex-employee</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <small><i class="las la-phone mr-2"></i>+91 98765 43215</small>
                                        <small><i class="las la-envelope mr-2"></i>suresh@clothshop.com</small>
                                        <small><i class="las la-map-marker mr-2"></i>Navi Mumbai</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <small><strong>Type:</strong> Resigned</small>
                                        <small><strong>Last Salary:</strong> Rs22,000</small>
                                        <small><strong>Date:</strong> 30 Jun 2024</small>
                                        <small><strong>Reason:</strong> Personal</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <div class="d-flex justify-content-between">
                                            <small>Last Month:</small>
                                            <strong class="text-secondary">18/20</strong>
                                        </div>
                                        <div class="progress" style="height: 5px;">
                                            <div class="progress-bar bg-secondary" style="width: 90%"></div>
                                        </div>
                                        <small class="text-muted">Last: 30 Jun 2024</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <div class="d-flex justify-content-between">
                                            <small>Avg. Sales:</small>
                                            <strong>Rs1,50,000</strong>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <small>Performance:</small>
                                            <strong class="text-warning">Average</strong>
                                        </div>
                                        <div class="progress" style="height: 5px;">
                                            <div class="progress-bar bg-warning" style="width: 75%"></div>
                                        </div>
                                        <small class="text-muted">6 months service</small>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-danger">Inactive</span>
                                    <br>
                                    <small class="text-danger">Resigned</small>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('staff.show', 6) }}" class="btn btn-sm btn-info mr-1" title="View">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <button class="btn btn-sm btn-warning mr-1" title="Rehire">
                                            <i class="las la-user-plus"></i>
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
                    <h5 class="modal-title">Import Staff Data</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-4">
                        <i class="las la-file-import fa-3x text-primary mb-3"></i>
                        <h5>Import Staff Information</h5>
                        <p class="text-muted">Upload CSV file with staff details</p>
                    </div>

                    <div class="form-group">
                        <label>Download Template</label>
                        <a href="#" class="btn btn-outline-primary btn-block">
                            <i class="las la-download mr-2"></i>Download Staff CSV Template
                        </a>
                    </div>

                    <div class="form-group">
                        <label>Upload CSV File</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="staffCSV" accept=".csv">
                            <label class="custom-file-label" for="staffCSV">Choose file</label>
                        </div>
                        <small class="form-text text-muted">Maximum file size: 5MB. Include columns: Name, Email, Phone, Designation, Department</small>
                    </div>

                    <div class="form-group">
                        <label>Import Options</label>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="createUsers" checked>
                            <label class="custom-control-label" for="createUsers">Create user accounts</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="sendCredentials" checked>
                            <label class="custom-control-label" for="sendCredentials">Send login credentials</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="assignDefaultBranch">
                            <label class="custom-control-label" for="assignDefaultBranch">Assign to default branch</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Import Staff</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Attendance Modal -->
    <div class="modal fade" id="attendanceModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Mark Attendance</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Staff Member</label>
                                    <select class="form-control">
                                        <option value="">Select Staff</option>
                                        <option value="1">Rajesh Kumar (EMP-S001)</option>
                                        <option value="2">Priya Sharma (EMP-S002)</option>
                                        <option value="3">Amit Patel (EMP-I001)</option>
                                        <option value="5">Rohan Singh (EMP-S003)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="date" class="form-control" value="{{ date('Y-m-d') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Check-in Time</label>
                                    <input type="time" class="form-control" value="09:00">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Check-out Time</label>
                                    <input type="time" class="form-control" value="18:00">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Attendance Status</label>
                            <select class="form-control">
                                <option value="present">Present</option>
                                <option value="absent">Absent</option>
                                <option value="half_day">Half Day</option>
                                <option value="leave">Leave</option>
                                <option value="holiday">Holiday</option>
                                <option value="week_off">Week Off</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Leave Type (if applicable)</label>
                            <select class="form-control">
                                <option value="">Select Leave Type</option>
                                <option value="sick">Sick Leave</option>
                                <option value="casual">Casual Leave</option>
                                <option value="paid">Paid Leave</option>
                                <option value="unpaid">Unpaid Leave</option>
                                <option value="emergency">Emergency Leave</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Notes</label>
                            <textarea class="form-control" rows="3" placeholder="Any additional notes..."></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Save Attendance</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Salary Modal -->
    <div class="modal fade" id="salaryModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Process Salary</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Staff Member</label>
                                    <select class="form-control">
                                        <option value="">Select Staff</option>
                                        <option value="1">Rajesh Kumar (EMP-S001)</option>
                                        <option value="2">Priya Sharma (EMP-S002)</option>
                                        <option value="3">Amit Patel (EMP-I001)</option>
                                        <option value="4">Neha Gupta (EMP-A001)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Salary Month</label>
                                    <input type="month" class="form-control" value="{{ date('Y-m') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <h6>Earnings</h6>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Basic Salary</label>
                                            <input type="number" class="form-control" value="25000">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Allowances</label>
                                            <input type="number" class="form-control" value="2000">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Commission</label>
                                            <input type="number" class="form-control" value="1500">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <h6>Deductions</h6>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>PF Deduction</label>
                                            <input type="number" class="form-control" value="1800">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Tax Deduction</label>
                                            <input type="number" class="form-control" value="1500">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Advance Deduction</label>
                                            <input type="number" class="form-control" value="0">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <h6>Payment Details</h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Payment Method</label>
                                            <select class="form-control">
                                                <option value="bank_transfer">Bank Transfer</option>
                                                <option value="cash">Cash</option>
                                                <option value="cheque">Cheque</option>
                                                <option value="upi">UPI</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Payment Date</label>
                                            <input type="date" class="form-control" value="{{ date('Y-m-d') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Notes</label>
                            <textarea class="form-control" rows="2" placeholder="Any payment notes..."></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Calculate & Preview</button>
                    <button type="button" class="btn btn-success">Process Payment</button>
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
            // Staff search
            $('#staffSearch').on('input', function() {
                const searchTerm = $(this).val().toLowerCase();
                filterStaff();
            });

            // Filter staff
            $('#filterBtn').click(function() {
                filterStaff();
            });

            // Reset filters
            $('#resetBtn').click(function() {
                $('#staffSearch').val('');
                $('#departmentFilter').val('');
                $('#designationFilter').val('');
                $('#statusFilter').val('');
                $('[data-group]').removeClass('active');
                $('[data-group="all"]').addClass('active');
                filterStaff();
            });

            // Staff groups
            $('[data-group]').click(function() {
                $('[data-group]').removeClass('active');
                $(this).addClass('active');
                filterStaff();
            });

            // File input label
            $('#staffCSV').on('change', function() {
                const fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').text(fileName || 'Choose file');
            });

            // Tooltip initialization
            $('[title]').tooltip();

            function filterStaff() {
                const searchTerm = $('#staffSearch').val().toLowerCase();
                const department = $('#departmentFilter').val();
                const designation = $('#designationFilter').val();
                const status = $('#statusFilter').val();
                const activeGroup = $('[data-group].active').data('group');

                $('#staffTable tbody tr').each(function() {
                    const row = $(this);
                    const staffName = row.find('h6').text().toLowerCase();
                    const empCode = row.find('.text-muted').first().text().toLowerCase();
                    const deptBadge = row.find('td:nth-child(2) .badge').text().toLowerCase();
                    const desigText = row.find('td:nth-child(2) strong').text().toLowerCase();
                    const statusBadge = row.find('td:nth-child(7) .badge').text().toLowerCase();

                    let show = true;

                    // Search filter
                    if (searchTerm && !staffName.includes(searchTerm) &&
                        !empCode.includes(searchTerm)) {
                        show = false;
                    }

                    // Department filter
                    if (department && !deptBadge.includes(department)) {
                        show = false;
                    }

                    // Designation filter (simplified)
                    if (designation && !desigText.includes(designation)) {
                        show = false;
                    }

                    // Status filter
                    if (status && !statusBadge.includes(status)) {
                        show = false;
                    }

                    // Group filter
                    if (activeGroup === 'sales' && !deptBadge.includes('sales')) {
                        show = false;
                    } else if (activeGroup === 'inventory' && !deptBadge.includes('inventory')) {
                        show = false;
                    } else if (activeGroup === 'management' && !deptBadge.includes('management')) {
                        show = false;
                    } else if (activeGroup === 'probation' && !statusBadge.includes('probation')) {
                        show = false;
                    } else if (activeGroup === 'leave' && !statusBadge.includes('leave')) {
                        show = false;
                    }

                    row.toggle(show);
                });
            }

            // Initialize filtering
            filterStaff();
        });
    </script>
    @endpush
</x-app-layout>