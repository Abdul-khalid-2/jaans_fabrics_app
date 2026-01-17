<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/remixicon/fonts/remixicon.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    @endpush

    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
            <div>
                <h4 class="mb-3">Payroll Management</h4>
                <p class="mb-0">Manage staff salaries, payments, commissions and advances</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('staff.index') }}">Staff</a></li>
                        <li class="breadcrumb-item active">Payroll</li>
                    </ol>
                </nav>
            </div>
            <div class="d-flex">
                <button class="btn btn-primary mr-2" data-toggle="modal" data-target="#processSalaryModal">
                    <i class="las la-calculator mr-2"></i>Process Salary
                </button>
                <button class="btn btn-success mr-2" data-toggle="modal" data-target="#salaryAdvanceModal">
                    <i class="las la-hand-holding-usd mr-2"></i>Salary Advance
                </button>
                <button class="btn btn-info" data-toggle="modal" data-target="#commissionModal">
                    <i class="las la-percentage mr-2"></i>Add Commission
                </button>
            </div>
        </div>

        <!-- Payroll Statistics -->
        <div class="row mb-4">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-white mb-0">Total Salary (Nov)</h6>
                                <h2 class="mb-0 text-white">Rs8,45,000</h2>
                                <small class="text-white-50">For 48 staff</small>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-money-bill-wave fa-2x text-primary"></i>
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
                                <h6 class="text-white mb-0">Paid This Month</h6>
                                <h2 class="mb-0 text-white">Rs6,20,000</h2>
                                <small class="text-white-50">73% processed</small>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-check-circle fa-2x text-success"></i>
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
                                <h6 class="text-white mb-0">Pending Payments</h6>
                                <h2 class="mb-0 text-white">Rs2,25,000</h2>
                                <small class="text-white-50">For 12 staff</small>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-clock fa-2x text-warning"></i>
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
                                <h6 class="text-white mb-0">Total Advances</h6>
                                <h2 class="mb-0 text-white">Rs1,45,000</h2>
                                <small class="text-white-50">15 active advances</small>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-hand-holding-usd fa-2x text-info"></i>
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
                            <label>Salary Month</label>
                            <input type="month" class="form-control" id="salaryMonth" value="{{ date('Y-m') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Branch</label>
                            <select class="form-control" id="branchFilter">
                                <option value="">All Branches</option>
                                <option value="main">Main Branch</option>
                                <option value="mall">Mall Branch</option>
                                <option value="warehouse">Warehouse</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Department</label>
                            <select class="form-control" id="departmentFilter">
                                <option value="">All Departments</option>
                                <option value="sales">Sales</option>
                                <option value="inventory">Inventory</option>
                                <option value="accounts">Accounts</option>
                                <option value="management">Management</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Payment Status</label>
                            <select class="form-control" id="paymentFilter">
                                <option value="">All Status</option>
                                <option value="paid">Paid</option>
                                <option value="pending">Pending</option>
                                <option value="partial">Partial</option>
                                <option value="overdue">Overdue</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12 d-flex justify-content-end">
                        <button class="btn btn-primary mr-2" id="applyFilters">Apply Filters</button>
                        <button class="btn btn-outline-secondary" id="resetFilters">Reset</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Salary Processing Tabs -->
        <div class="row mb-4">
            <div class="col-md-12">
                <ul class="nav nav-tabs" id="payrollTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="salary-tab" data-toggle="tab" href="#salary" role="tab">
                            <i class="las la-money-bill-wave mr-2"></i>Salary Payments
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="advance-tab" data-toggle="tab" href="#advance" role="tab">
                            <i class="las la-hand-holding-usd mr-2"></i>Salary Advances
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="commission-tab" data-toggle="tab" href="#commission" role="tab">
                            <i class="las la-percentage mr-2"></i>Commissions
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="reports-tab" data-toggle="tab" href="#reports" role="tab">
                            <i class="las la-chart-bar mr-2"></i>Payroll Reports
                        </a>
                    </li>
                </ul>
                
                <div class="tab-content" id="payrollTabContent">
                    <!-- Salary Payments Tab -->
                    <div class="tab-pane fade show active" id="salary" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="mb-0">Salary Payments for November 2024</h5>
                                    <div>
                                        <span class="badge badge-success mr-2">Paid: 36</span>
                                        <span class="badge badge-warning mr-2">Pending: 12</span>
                                        <span class="badge badge-info">Total: Rs8,45,000</span>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-hover" id="salaryTable">
                                        <thead>
                                            <tr>
                                                <th>Staff</th>
                                                <th>Salary Details</th>
                                                <th>Earnings</th>
                                                <th>Deductions</th>
                                                <th>Net Salary</th>
                                                <th>Payment Details</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Paid Salary -->
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar avatar-sm mr-3">
                                                            <img src="https://ui-avatars.com/api/?name=Rajesh+Kumar&background=007bff&color=fff&size=100"
                                                                class="rounded-circle" alt="Rajesh Kumar">
                                                        </div>
                                                        <div>
                                                            <h6 class="mb-0">Rajesh Kumar</h6>
                                                            <small class="text-muted">EMP-S001</small>
                                                            <br>
                                                            <small class="text-muted">Sales Manager</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column">
                                                        <small><strong>Basic:</strong> Rs35,000</small>
                                                        <small><strong>Days Worked:</strong> 28/28</small>
                                                        <small><strong>Attendance:</strong> 100%</small>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column">
                                                        <small>Basic: Rs35,000</small>
                                                        <small>Allowance: Rs5,000</small>
                                                        <small>Commission: Rs8,500</small>
                                                        <small>Overtime: Rs1,200</small>
                                                        <small><strong>Total: Rs49,700</strong></small>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column">
                                                        <small>PF: Rs1,800</small>
                                                        <small>Tax: Rs2,500</small>
                                                        <small>Advance: Rs3,000</small>
                                                        <small>Other: Rs500</small>
                                                        <small><strong>Total: Rs7,800</strong></small>
                                                    </div>
                                                </td>
                                                <td>
                                                    <h5 class="text-success mb-0">Rs41,900</h5>
                                                    <small class="text-muted">Net payable</small>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column">
                                                        <small><strong>Method:</strong> Bank Transfer</small>
                                                        <small><strong>Date:</strong> 05 Nov 2024</small>
                                                        <small><strong>Ref:</strong> TXN123456</small>
                                                        <small><strong>Bank:</strong> HDFC Bank</small>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge badge-success">Paid</span>
                                                    <br>
                                                    <small class="text-muted">On time</small>
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <button class="btn btn-sm btn-info mr-1" title="View Payslip" data-toggle="modal" data-target="#payslipModal">
                                                            <i class="las la-file-invoice"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-warning mr-1" title="Edit">
                                                            <i class="las la-edit"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-success" title="Re-Print">
                                                            <i class="las la-print"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- Pending Salary -->
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar avatar-sm mr-3">
                                                            <img src="https://ui-avatars.com/api/?name=Priya+Sharma&background=28a745&color=fff&size=100"
                                                                class="rounded-circle" alt="Priya Sharma">
                                                        </div>
                                                        <div>
                                                            <h6 class="mb-0">Priya Sharma</h6>
                                                            <small class="text-muted">EMP-S002</small>
                                                            <br>
                                                            <small class="text-muted">Sales Executive</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column">
                                                        <small><strong>Basic:</strong> Rs20,000</small>
                                                        <small><strong>Days Worked:</strong> 26/28</small>
                                                        <small><strong>Attendance:</strong> 93%</small>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column">
                                                        <small>Basic: Rs20,000</small>
                                                        <small>Allowance: Rs2,000</small>
                                                        <small>Commission: Rs15,000</small>
                                                        <small>Bonus: Rs1,000</small>
                                                        <small><strong>Total: Rs38,000</strong></small>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column">
                                                        <small>PF: Rs1,200</small>
                                                        <small>Tax: Rs1,800</small>
                                                        <small>Late Deduction: Rs500</small>
                                                        <small>Other: Rs300</small>
                                                        <small><strong>Total: Rs3,800</strong></small>
                                                    </div>
                                                </td>
                                                <td>
                                                    <h5 class="text-warning mb-0">Rs34,200</h5>
                                                    <small class="text-muted">To be paid</small>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column">
                                                        <small><strong>Method:</strong> Bank Transfer</small>
                                                        <small><strong>Due Date:</strong> 10 Nov 2024</small>
                                                        <small><strong>Account:</strong> ****4321</small>
                                                        <small class="text-danger"><strong>Status:</strong> Pending</small>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge badge-warning">Pending</span>
                                                    <br>
                                                    <small class="text-warning">Due in 2 days</small>
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <button class="btn btn-sm btn-primary mr-1" title="Process Payment" data-toggle="modal" data-target="#processPaymentModal">
                                                            <i class="las la-money-check"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-info mr-1" title="Calculate">
                                                            <i class="las la-calculator"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-danger" title="Hold">
                                                            <i class="las la-pause"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- Partial Payment -->
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar avatar-sm mr-3">
                                                            <img src="https://ui-avatars.com/api/?name=Amit+Patel&background=ffc107&color=000&size=100"
                                                                class="rounded-circle" alt="Amit Patel">
                                                        </div>
                                                        <div>
                                                            <h6 class="mb-0">Amit Patel</h6>
                                                            <small class="text-muted">EMP-I001</small>
                                                            <br>
                                                            <small class="text-muted">Store Keeper</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column">
                                                        <small><strong>Basic:</strong> Rs18,000</small>
                                                        <small><strong>Days Worked:</strong> 27/28</small>
                                                        <small><strong>Leave:</strong> 1 day</small>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column">
                                                        <small>Basic: Rs18,000</small>
                                                        <small>Allowance: Rs1,500</small>
                                                        <small>Overtime: Rs800</small>
                                                        <small><strong>Total: Rs20,300</strong></small>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column">
                                                        <small>PF: Rs1,080</small>
                                                        <small>Tax: Rs1,200</small>
                                                        <small>Advance: Rs5,000</small>
                                                        <small><strong>Total: Rs7,280</strong></small>
                                                    </div>
                                                </td>
                                                <td>
                                                    <h5 class="text-info mb-0">Rs13,020</h5>
                                                    <small class="text-muted">Net payable</small>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column">
                                                        <small><strong>Method:</strong> Cash</small>
                                                        <small><strong>Paid:</strong> Rs8,000</small>
                                                        <small><strong>Balance:</strong> Rs5,020</small>
                                                        <small><strong>Next Pay:</strong> 15 Nov 2024</small>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge badge-info">Partial</span>
                                                    <br>
                                                    <small class="text-info">Rs5,020 pending</small>
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <button class="btn btn-sm btn-success mr-1" title="Pay Balance">
                                                            <i class="las la-money-bill-wave"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-warning mr-1" title="Adjust">
                                                            <i class="las la-adjust"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-info" title="View">
                                                            <i class="las la-eye"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- Overdue Salary -->
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar avatar-sm mr-3">
                                                            <img src="https://ui-avatars.com/api/?name=Neha+Gupta&background=6f42c1&color=fff&size=100"
                                                                class="rounded-circle" alt="Neha Gupta">
                                                        </div>
                                                        <div>
                                                            <h6 class="mb-0">Neha Gupta</h6>
                                                            <small class="text-muted">EMP-A001</small>
                                                            <br>
                                                            <small class="text-muted">Accountant</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column">
                                                        <small><strong>Basic:</strong> Rs25,000</small>
                                                        <small><strong>Days Worked:</strong> 25/28</small>
                                                        <small><strong>Leave:</strong> 3 days</small>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column">
                                                        <small>Basic: Rs25,000</small>
                                                        <small>Allowance: Rs3,000</small>
                                                        <small><strong>Total: Rs28,000</strong></small>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column">
                                                        <small>PF: Rs1,500</small>
                                                        <small>Tax: Rs2,000</small>
                                                        <small>Leave Deduction: Rs2,679</small>
                                                        <small><strong>Total: Rs6,179</strong></small>
                                                    </div>
                                                </td>
                                                <td>
                                                    <h5 class="text-danger mb-0">Rs21,821</h5>
                                                    <small class="text-muted">Overdue</small>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column">
                                                        <small><strong>Method:</strong> Bank Transfer</small>
                                                        <small><strong>Due Date:</strong> 05 Nov 2024</small>
                                                        <small class="text-danger"><strong>Overdue:</strong> 5 days</small>
                                                        <small><strong>Fine:</strong> Rs500</small>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge badge-danger">Overdue</span>
                                                    <br>
                                                    <small class="text-danger">5 days late</small>
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <button class="btn btn-sm btn-danger mr-1" title="Pay Now">
                                                            <i class="las la-exclamation-circle"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-warning mr-1" title="Add Fine">
                                                            <i class="las la-gavel"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-secondary" title="Waive">
                                                            <i class="las la-handshake"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Salary Advances Tab -->
                    <div class="tab-pane fade" id="advance" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="mb-0">Salary Advances</h5>
                                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#newAdvanceModal">
                                        <i class="las la-plus mr-1"></i>New Advance
                                    </button>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Staff</th>
                                                <th>Advance Details</th>
                                                <th>Repayment</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar avatar-sm mr-3">
                                                            <img src="https://ui-avatars.com/api/?name=Rajesh+Kumar&background=007bff&color=fff&size=100"
                                                                class="rounded-circle" alt="Rajesh Kumar">
                                                        </div>
                                                        <div>
                                                            <h6 class="mb-0">Rajesh Kumar</h6>
                                                            <small class="text-muted">EMP-S001</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column">
                                                        <small><strong>Amount:</strong> Rs15,000</small>
                                                        <small><strong>Date:</strong> 15 Oct 2024</small>
                                                        <small><strong>Reason:</strong> Medical emergency</small>
                                                        <small><strong>Approved By:</strong> Admin</small>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column">
                                                        <small><strong>Months:</strong> 3 months</small>
                                                        <small><strong>Monthly:</strong> Rs5,000</small>
                                                        <small><strong>Paid:</strong> Rs5,000</small>
                                                        <small><strong>Balance:</strong> Rs10,000</small>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge badge-warning">Repaying</span>
                                                    <br>
                                                    <small class="text-muted">2 months remaining</small>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-success mr-1" title="Receive Payment">
                                                        <i class="las la-money-bill-wave"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-warning" title="Adjust">
                                                        <i class="las la-edit"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar avatar-sm mr-3">
                                                            <img src="https://ui-avatars.com/api/?name=Priya+Sharma&background=28a745&color=fff&size=100"
                                                                class="rounded-circle" alt="Priya Sharma">
                                                        </div>
                                                        <div>
                                                            <h6 class="mb-0">Priya Sharma</h6>
                                                            <small class="text-muted">EMP-S002</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column">
                                                        <small><strong>Amount:</strong> Rs8,000</small>
                                                        <small><strong>Date:</strong> 20 Oct 2024</small>
                                                        <small><strong>Reason:</strong> Family function</small>
                                                        <small><strong>Approved By:</strong> Manager</small>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column">
                                                        <small><strong>Months:</strong> 2 months</small>
                                                        <small><strong>Monthly:</strong> Rs4,000</small>
                                                        <small><strong>Paid:</strong> Rs4,000</small>
                                                        <small><strong>Balance:</strong> Rs4,000</small>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge badge-warning">Repaying</span>
                                                    <br>
                                                    <small class="text-muted">1 month remaining</small>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-success mr-1" title="Receive Payment">
                                                        <i class="las la-money-bill-wave"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-warning" title="Adjust">
                                                        <i class="las la-edit"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Commissions Tab -->
                    <div class="tab-pane fade" id="commission" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="mb-0">Sales Commissions</h5>
                                    <div>
                                        <span class="badge badge-success mr-2">Total: Rs2,45,000</span>
                                        <span class="badge badge-info">This Month: Rs45,000</span>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Staff</th>
                                                <th>Sale Details</th>
                                                <th>Commission</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar avatar-sm mr-3">
                                                            <img src="https://ui-avatars.com/api/?name=Priya+Sharma&background=28a745&color=fff&size=100"
                                                                class="rounded-circle" alt="Priya Sharma">
                                                        </div>
                                                        <div>
                                                            <h6 class="mb-0">Priya Sharma</h6>
                                                            <small class="text-muted">EMP-S002</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column">
                                                        <small><strong>Invoice:</strong> INV-12345</small>
                                                        <small><strong>Date:</strong> 15 Nov 2024</small>
                                                        <small><strong>Sale Amount:</strong> Rs75,000</small>
                                                        <small><strong>Customer:</strong> John Smith</small>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column">
                                                        <small><strong>Rate:</strong> 2%</small>
                                                        <h5 class="text-success mb-0">Rs1,500</h5>
                                                        <small class="text-muted">Commission</small>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge badge-success">Paid</span>
                                                    <br>
                                                    <small class="text-muted">Included in Nov salary</small>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-info" title="View Details">
                                                        <i class="las la-eye"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Reports Tab -->
                    <div class="tab-pane fade" id="reports" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="mb-3">Payroll Reports</h5>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <div class="card-body text-center">
                                                <i class="las la-file-invoice-dollar fa-3x text-primary mb-3"></i>
                                                <h5>Monthly Payslips</h5>
                                                <p class="text-muted">Generate and download payslips</p>
                                                <button class="btn btn-outline-primary">Generate Report</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <div class="card-body text-center">
                                                <i class="las la-chart-pie fa-3x text-success mb-3"></i>
                                                <h5>Salary Analysis</h5>
                                                <p class="text-muted">Department-wise salary analysis</p>
                                                <button class="btn btn-outline-success">View Analysis</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <div class="card-body text-center">
                                                <i class="las la-file-export fa-3x text-info mb-3"></i>
                                                <h5>Export to Excel</h5>
                                                <p class="text-muted">Export payroll data to Excel</p>
                                                <button class="btn btn-outline-info">Export Data</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Process Salary Modal -->
    <div class="modal fade" id="processSalaryModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Process Salary</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="salaryForm">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Staff Member <span class="text-danger">*</span></label>
                                    <select class="form-control" required>
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
                                    <label>Salary Month <span class="text-danger">*</span></label>
                                    <input type="month" class="form-control" value="{{ date('Y-m') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <h6>Earnings</h6>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Basic Salary</label>
                                            <input type="number" class="form-control" value="25000">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Allowances</label>
                                            <input type="number" class="form-control" value="2000">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Overtime</label>
                                            <input type="number" class="form-control" value="1200">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Commission</label>
                                            <input type="number" class="form-control" value="8500">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <h6>Deductions</h6>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>PF Deduction</label>
                                            <input type="number" class="form-control" value="1800">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Tax Deduction</label>
                                            <input type="number" class="form-control" value="2500">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Advance Deduction</label>
                                            <input type="number" class="form-control" value="3000">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Other Deductions</label>
                                            <input type="number" class="form-control" value="500">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <h6>Payment Details</h6>
                                <div class="row">
                                    <div class="col-md-4">
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
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Payment Date</label>
                                            <input type="date" class="form-control" value="{{ date('Y-m-d') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Reference Number</label>
                                            <input type="text" class="form-control" placeholder="TXN reference">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Notes</label>
                            <textarea class="form-control" rows="2" placeholder="Any payment notes..."></textarea>
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="generatePayslip" checked>
                                <label class="custom-control-label" for="generatePayslip">Generate payslip</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="notifyStaff" checked>
                                <label class="custom-control-label" for="notifyStaff">Notify staff via email</label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="calculateSalary()">Calculate</button>
                    <button type="button" class="btn btn-success" onclick="processSalary()">Process Payment</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Salary Advance Modal -->
    <div class="modal fade" id="salaryAdvanceModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New Salary Advance</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label>Staff Member <span class="text-danger">*</span></label>
                            <select class="form-control" required>
                                <option value="">Select Staff</option>
                                <option value="1">Rajesh Kumar (EMP-S001)</option>
                                <option value="2">Priya Sharma (EMP-S002)</option>
                                <option value="3">Amit Patel (EMP-I001)</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Advance Amount (Rs) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" placeholder="Enter amount" required>
                        </div>

                        <div class="form-group">
                            <label>Reason for Advance <span class="text-danger">*</span></label>
                            <textarea class="form-control" rows="3" placeholder="Enter reason..." required></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Repayment Months</label>
                                    <select class="form-control">
                                        <option value="1">1 Month</option>
                                        <option value="2">2 Months</option>
                                        <option value="3" selected>3 Months</option>
                                        <option value="4">4 Months</option>
                                        <option value="5">5 Months</option>
                                        <option value="6">6 Months</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Monthly Deduction (Rs)</label>
                                    <input type="number" class="form-control" readonly placeholder="Auto-calculated">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Approved By</label>
                            <input type="text" class="form-control" placeholder="Approver name">
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="deductFromSalary" checked>
                                <label class="custom-control-label" for="deductFromSalary">Deduct from salary automatically</label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Approve Advance</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Payslip Modal -->
    <div class="modal fade" id="payslipModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Salary Payslip - November 2024</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="payslip-container">
                        <!-- Payslip Header -->
                        <div class="text-center mb-4 border-bottom pb-3">
                            <h4>CLOTH SHOP</h4>
                            <p class="mb-1">123 Fashion Street, Mumbai</p>
                            <p class="mb-1">Phone: +91-9876543210 | Email: info@clothshop.com</p>
                            <h5 class="mt-3">SALARY PAYSLIP</h5>
                        </div>

                        <!-- Employee Details -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h6>Employee Details</h6>
                                <table class="table table-sm">
                                    <tr>
                                        <td><strong>Name:</strong></td>
                                        <td>Rajesh Kumar</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Employee Code:</strong></td>
                                        <td>EMP-S001</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Department:</strong></td>
                                        <td>Sales</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Designation:</strong></td>
                                        <td>Sales Manager</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Bank Account:</strong></td>
                                        <td>HDFC Bank ****4321</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h6>Payroll Details</h6>
                                <table class="table table-sm">
                                    <tr>
                                        <td><strong>Pay Period:</strong></td>
                                        <td>01 Nov 2024 - 30 Nov 2024</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Payment Date:</strong></td>
                                        <td>05 Nov 2024</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Days Worked:</strong></td>
                                        <td>28/28 days</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Payment Mode:</strong></td>
                                        <td>Bank Transfer</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Transaction ID:</strong></td>
                                        <td>TXN123456</td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <!-- Earnings & Deductions -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h6>Earnings</h6>
                                <table class="table table-sm">
                                    <tr>
                                        <td>Basic Salary</td>
                                        <td class="text-right">Rs35,000</td>
                                    </tr>
                                    <tr>
                                        <td>House Rent Allowance</td>
                                        <td class="text-right">Rs3,000</td>
                                    </tr>
                                    <tr>
                                        <td>Travel Allowance</td>
                                        <td class="text-right">Rs2,000</td>
                                    </tr>
                                    <tr>
                                        <td>Sales Commission</td>
                                        <td class="text-right">Rs8,500</td>
                                    </tr>
                                    <tr>
                                        <td>Overtime Payment</td>
                                        <td class="text-right">Rs1,200</td>
                                    </tr>
                                    <tr class="table-success">
                                        <td><strong>Total Earnings</strong></td>
                                        <td class="text-right"><strong>Rs49,700</strong></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h6>Deductions</h6>
                                <table class="table table-sm">
                                    <tr>
                                        <td>Provident Fund (PF)</td>
                                        <td class="text-right">Rs1,800</td>
                                    </tr>
                                    <tr>
                                        <td>Professional Tax</td>
                                        <td class="text-right">Rs2,500</td>
                                    </tr>
                                    <tr>
                                        <td>Salary Advance</td>
                                        <td class="text-right">Rs3,000</td>
                                    </tr>
                                    <tr>
                                        <td>Other Deductions</td>
                                        <td class="text-right">Rs500</td>
                                    </tr>
                                    <tr class="table-danger">
                                        <td><strong>Total Deductions</strong></td>
                                        <td class="text-right"><strong>Rs7,800</strong></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <!-- Net Salary -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-success">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0">Net Salary Payable</h5>
                                        <h2 class="mb-0">Rs41,900</h2>
                                    </div>
                                    <p class="mb-0 mt-2">In Words: Forty One Thousand Nine Hundred Only</p>
                                </div>
                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <p class="mb-1">Employee Signature</p>
                                <div class="border-top" style="height: 50px;"></div>
                            </div>
                            <div class="col-md-6 text-right">
                                <p class="mb-1">Authorized Signature</p>
                                <div class="border-top" style="height: 50px;"></div>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <p class="text-muted mb-0">This is a computer generated payslip and does not require signature</p>
                            <p class="text-muted">Generated on: {{ date('d M Y H:i:s') }}</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="window.print()">
                        <i class="las la-print mr-1"></i>Print Payslip
                    </button>
                    <button type="button" class="btn btn-success">
                        <i class="las la-download mr-1"></i>Download PDF
                    </button>
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
            // Calculate salary
            window.calculateSalary = function() {
                const basic = parseFloat($('input[value="25000"]').val()) || 0;
                const allowance = parseFloat($('input[value="2000"]').val()) || 0;
                const overtime = parseFloat($('input[value="1200"]').val()) || 0;
                const commission = parseFloat($('input[value="8500"]').val()) || 0;
                
                const pf = parseFloat($('input[value="1800"]').val()) || 0;
                const tax = parseFloat($('input[value="2500"]').val()) || 0;
                const advance = parseFloat($('input[value="3000"]').val()) || 0;
                const other = parseFloat($('input[value="500"]').val()) || 0;
                
                const totalEarnings = basic + allowance + overtime + commission;
                const totalDeductions = pf + tax + advance + other;
                const netSalary = totalEarnings - totalDeductions;
                
                alert(`Salary Calculation:\n\nEarnings: Rs${totalEarnings.toLocaleString()}\nDeductions: Rs${totalDeductions.toLocaleString()}\nNet Salary: Rs${netSalary.toLocaleString()}`);
            };

            // Process salary
            window.processSalary = function() {
                const form = document.getElementById('salaryForm');
                if (form.checkValidity()) {
                    alert('Salary processed successfully!');
                    $('#processSalaryModal').modal('hide');
                } else {
                    form.reportValidity();
                }
            };

            // Calculate advance deduction
            $('select').on('change', function() {
                if ($(this).val() && $('input[placeholder="Enter amount"]').val()) {
                    const amount = parseFloat($('input[placeholder="Enter amount"]').val());
                    const months = parseInt($(this).val());
                    const monthly = amount / months;
                    $('input[placeholder="Auto-calculated"]').val(monthly.toFixed(2));
                }
            });

            // Apply filters
            $('#applyFilters').click(function() {
                const month = $('#salaryMonth').val();
                const branch = $('#branchFilter').val();
                const dept = $('#departmentFilter').val();
                const status = $('#paymentFilter').val();
                
                alert(`Filters applied:\nMonth: ${month}\nBranch: ${branch}\nDepartment: ${dept}\nStatus: ${status}`);
            });

            // Reset filters
            $('#resetFilters').click(function() {
                $('#salaryMonth').val("{{ date('Y-m') }}");
                $('#branchFilter').val('');
                $('#departmentFilter').val('');
                $('#paymentFilter').val('');
            });

            // Tooltip initialization
            $('[title]').tooltip();

            // Tab functionality
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                localStorage.setItem('activePayrollTab', $(e.target).attr('href'));
            });

            // Restore active tab
            const activeTab = localStorage.getItem('activePayrollTab');
            if (activeTab) {
                $('a[href="' + activeTab + '"]').tab('show');
            }
        });
    </script>
    @endpush
</x-app-layout>