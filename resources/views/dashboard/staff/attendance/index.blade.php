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
                <h4 class="mb-3">Staff Attendance</h4>
                <p class="mb-0">Track and manage staff attendance, leaves and time tracking</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('staff.index') }}">Staff</a></li>
                        <li class="breadcrumb-item active">Attendance</li>
                    </ol>
                </nav>
            </div>
            <div class="d-flex">
                <button class="btn btn-primary mr-2" data-toggle="modal" data-target="#markAttendanceModal">
                    <i class="las la-calendar-plus mr-2"></i>Mark Attendance
                </button>
                <button class="btn btn-success mr-2" data-toggle="modal" data-target="#bulkAttendanceModal">
                    <i class="las la-users mr-2"></i>Bulk Attendance
                </button>
                <button class="btn btn-info" data-toggle="modal" data-target="#importAttendanceModal">
                    <i class="las la-file-import mr-2"></i>Import
                </button>
            </div>
        </div>

        <!-- Attendance Statistics -->
        <div class="row mb-4">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-white mb-0">Present Today</h6>
                                <h2 class="mb-0 text-white">42</h2>
                                <small class="text-white-50">87.5% of staff</small>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-user-check fa-2x text-primary"></i>
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
                                <h6 class="text-white mb-0">On Time Today</h6>
                                <h2 class="mb-0 text-white">38</h2>
                                <small class="text-white-50">90% punctuality</small>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-clock fa-2x text-success"></i>
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
                                <h6 class="text-white mb-0">On Leave</h6>
                                <h2 class="mb-0 text-white">3</h2>
                                <small class="text-white-50">Sick: 2, Casual: 1</small>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-bed fa-2x text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="card bg-danger text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-white mb-0">Absent</h6>
                                <h2 class="mb-0 text-white">3</h2>
                                <small class="text-white-50">Unauthorized: 2</small>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-user-times fa-2x text-danger"></i>
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
                            <label>Select Date</label>
                            <input type="text" class="form-control datepicker" id="attendanceDate" value="{{ date('Y-m-d') }}">
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
                                <option value="sub">Sub Branch</option>
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
                            <label>Attendance Status</label>
                            <select class="form-control" id="statusFilter">
                                <option value="">All Status</option>
                                <option value="present">Present</option>
                                <option value="absent">Absent</option>
                                <option value="late">Late</option>
                                <option value="half_day">Half Day</option>
                                <option value="leave">On Leave</option>
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

        <!-- Attendance Summary -->
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Today's Attendance Summary ({{ date('d M Y') }})</h5>
                <div>
                    <span class="badge badge-primary mr-2">Present: 42</span>
                    <span class="badge badge-warning mr-2">Late: 4</span>
                    <span class="badge badge-danger mr-2">Absent: 3</span>
                    <span class="badge badge-info">Leave: 3</span>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="attendanceTable">
                        <thead>
                            <tr>
                                <th>Staff Member</th>
                                <th>Department</th>
                                <th>Shift Timing</th>
                                <th>Check-in</th>
                                <th>Check-out</th>
                                <th>Working Hours</th>
                                <th>Overtime</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Present - On Time -->
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
                                    <span class="badge badge-primary">Sales</span>
                                    <br>
                                    <small>Manager</small>
                                </td>
                                <td>
                                    <small>09:00 - 18:00</small>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <strong class="text-success">09:05 AM</strong>
                                        <small class="text-muted">On time</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <strong class="text-info">06:15 PM</strong>
                                        <small class="text-muted">Expected: 06:00 PM</small>
                                    </div>
                                </td>
                                <td>
                                    <strong>9.2 hours</strong>
                                </td>
                                <td>
                                    <strong class="text-warning">0.3 hours</strong>
                                </td>
                                <td>
                                    <span class="badge badge-success">Present</span>
                                    <br>
                                    <small class="text-success">On time</small>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <button class="btn btn-sm btn-warning mr-1" title="Edit" data-toggle="modal" data-target="#editAttendanceModal">
                                            <i class="las la-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-info" title="Details">
                                            <i class="las la-info-circle"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Present - Late -->
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
                                    <span class="badge badge-primary">Sales</span>
                                    <br>
                                    <small>Executive</small>
                                </td>
                                <td>
                                    <small>09:00 - 18:00</small>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <strong class="text-warning">09:45 AM</strong>
                                        <small class="text-danger">45 mins late</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <strong class="text-info">06:30 PM</strong>
                                        <small class="text-muted">Expected: 06:00 PM</small>
                                    </div>
                                </td>
                                <td>
                                    <strong>8.8 hours</strong>
                                </td>
                                <td>
                                    <strong class="text-warning">0.5 hours</strong>
                                </td>
                                <td>
                                    <span class="badge badge-warning">Late</span>
                                    <br>
                                    <small class="text-warning">45 mins delay</small>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <button class="btn btn-sm btn-warning mr-1" title="Edit">
                                            <i class="las la-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger" title="Deduct Pay">
                                            <i class="las la-money-bill-wave"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Half Day -->
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
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-success">Inventory</span>
                                    <br>
                                    <small>Store Keeper</small>
                                </td>
                                <td>
                                    <small>09:00 - 18:00</small>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <strong class="text-success">09:10 AM</strong>
                                        <small class="text-muted">On time</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <strong class="text-info">02:00 PM</strong>
                                        <small class="text-muted">Early leave</small>
                                    </div>
                                </td>
                                <td>
                                    <strong>4.8 hours</strong>
                                </td>
                                <td>
                                    <strong class="text-secondary">0 hours</strong>
                                </td>
                                <td>
                                    <span class="badge badge-info">Half Day</span>
                                    <br>
                                    <small class="text-info">Medical appointment</small>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <button class="btn btn-sm btn-warning mr-1" title="Edit">
                                            <i class="las la-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-success" title="Approve">
                                            <i class="las la-check"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- On Leave -->
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
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-info">Accounts</span>
                                    <br>
                                    <small>Accountant</small>
                                </td>
                                <td>
                                    <small>09:00 - 18:00</small>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <strong class="text-secondary">--:--</strong>
                                        <small class="text-muted">Not checked in</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <strong class="text-secondary">--:--</strong>
                                        <small class="text-muted">Not checked out</small>
                                    </div>
                                </td>
                                <td>
                                    <strong>0 hours</strong>
                                </td>
                                <td>
                                    <strong class="text-secondary">0 hours</strong>
                                </td>
                                <td>
                                    <span class="badge badge-warning">On Leave</span>
                                    <br>
                                    <small class="text-warning">Sick leave</small>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <button class="btn btn-sm btn-info mr-1" title="View Leave">
                                            <i class="las la-file-medical"></i>
                                        </button>
                                        <button class="btn btn-sm btn-success" title="Return">
                                            <i class="las la-sign-in-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Absent -->
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm mr-3">
                                            <img src="https://ui-avatars.com/api/?name=Rohan+Singh&background=17a2b8&color=fff&size=100"
                                                class="rounded-circle" alt="Rohan Singh">
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Rohan Singh</h6>
                                            <small class="text-muted">EMP-S003</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-primary">Sales</span>
                                    <br>
                                    <small>Cashier</small>
                                </td>
                                <td>
                                    <small>09:00 - 18:00</small>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <strong class="text-secondary">--:--</strong>
                                        <small class="text-muted">Not checked in</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <strong class="text-secondary">--:--</strong>
                                        <small class="text-muted">Not checked out</small>
                                    </div>
                                </td>
                                <td>
                                    <strong>0 hours</strong>
                                </td>
                                <td>
                                    <strong class="text-secondary">0 hours</strong>
                                </td>
                                <td>
                                    <span class="badge badge-danger">Absent</span>
                                    <br>
                                    <small class="text-danger">No information</small>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <button class="btn btn-sm btn-warning mr-1" title="Mark Present">
                                            <i class="las la-user-check"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger" title="Deduct Salary">
                                            <i class="las la-money-bill-wave"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Week Off -->
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm mr-3">
                                            <img src="https://ui-avatars.com/api/?name=Sanjay+Verma&background=dc3545&color=fff&size=100"
                                                class="rounded-circle" alt="Sanjay Verma">
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Sanjay Verma</h6>
                                            <small class="text-muted">EMP-S005</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-primary">Sales</span>
                                    <br>
                                    <small>Executive</small>
                                </td>
                                <td>
                                    <small>09:00 - 18:00</small>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <strong class="text-secondary">--:--</strong>
                                        <small class="text-muted">Week off</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <strong class="text-secondary">--:--</strong>
                                        <small class="text-muted">Week off</small>
                                    </div>
                                </td>
                                <td>
                                    <strong>0 hours</strong>
                                </td>
                                <td>
                                    <strong class="text-secondary">0 hours</strong>
                                </td>
                                <td>
                                    <span class="badge badge-secondary">Week Off</span>
                                    <br>
                                    <small class="text-muted">Sunday</small>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <button class="btn btn-sm btn-primary mr-1" title="Call to Work">
                                            <i class="las la-phone"></i>
                                        </button>
                                        <button class="btn btn-sm btn-success" title="Mark Present">
                                            <i class="las la-calendar-plus"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Monthly Attendance Summary -->
                <div class="row mt-4">
                    <div class="col-md-12">
                        <h6 class="mb-3">Monthly Attendance Summary (Nov 2024)</h6>
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th>Staff</th>
                                        <th>Total Days</th>
                                        <th>Present</th>
                                        <th>Absent</th>
                                        <th>Late</th>
                                        <th>Leave</th>
                                        <th>Half Days</th>
                                        <th>Attendance %</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Rajesh Kumar</td>
                                        <td>20</td>
                                        <td class="text-success">20</td>
                                        <td class="text-danger">0</td>
                                        <td class="text-warning">1</td>
                                        <td class="text-info">0</td>
                                        <td class="text-info">0</td>
                                        <td><strong class="text-success">100%</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Priya Sharma</td>
                                        <td>20</td>
                                        <td class="text-success">18</td>
                                        <td class="text-danger">1</td>
                                        <td class="text-warning">3</td>
                                        <td class="text-info">1</td>
                                        <td class="text-info">0</td>
                                        <td><strong class="text-success">90%</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Amit Patel</td>
                                        <td>20</td>
                                        <td class="text-success">19</td>
                                        <td class="text-danger">0</td>
                                        <td class="text-warning">0</td>
                                        <td class="text-info">1</td>
                                        <td class="text-info">1</td>
                                        <td><strong class="text-success">95%</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Leave Requests -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Pending Leave Requests</h5>
                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#applyLeaveModal">
                    <i class="las la-plus mr-1"></i>Apply Leave
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Staff</th>
                                <th>Leave Type</th>
                                <th>From - To</th>
                                <th>Total Days</th>
                                <th>Reason</th>
                                <th>Applied On</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm mr-2">
                                            <img src="https://ui-avatars.com/api/?name=Mohit+Sharma&background=007bff&color=fff&size=100"
                                                class="rounded-circle" alt="Mohit Sharma">
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Mohit Sharma</h6>
                                            <small class="text-muted">EMP-S006</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-warning">Casual Leave</span>
                                </td>
                                <td>
                                    <small>15 Nov - 17 Nov 2024</small>
                                </td>
                                <td><strong>3 days</strong></td>
                                <td>Family function</td>
                                <td>10 Nov 2024</td>
                                <td><span class="badge badge-warning">Pending</span></td>
                                <td>
                                    <button class="btn btn-sm btn-success mr-1" title="Approve">
                                        <i class="las la-check"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" title="Reject">
                                        <i class="las la-times"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm mr-2">
                                            <img src="https://ui-avatars.com/api/?name=Anjali+Patil&background=28a745&color=fff&size=100"
                                                class="rounded-circle" alt="Anjali Patil">
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Anjali Patil</h6>
                                            <small class="text-muted">EMP-S007</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-danger">Sick Leave</span>
                                </td>
                                <td>
                                    <small>18 Nov - 20 Nov 2024</small>
                                </td>
                                <td><strong>3 days</strong></td>
                                <td>Medical treatment</td>
                                <td>12 Nov 2024</td>
                                <td><span class="badge badge-warning">Pending</span></td>
                                <td>
                                    <button class="btn btn-sm btn-success mr-1" title="Approve">
                                        <i class="las la-check"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" title="Reject">
                                        <i class="las la-times"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Mark Attendance Modal -->
    <div class="modal fade" id="markAttendanceModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Mark Attendance</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="attendanceForm">
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
                                        <option value="5">Rohan Singh (EMP-S003)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" value="{{ date('Y-m-d') }}" required>
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
                            <label>Attendance Status <span class="text-danger">*</span></label>
                            <select class="form-control" required>
                                <option value="present">Present</option>
                                <option value="absent">Absent</option>
                                <option value="half_day">Half Day</option>
                                <option value="leave">On Leave</option>
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
                                <option value="maternity">Maternity Leave</option>
                                <option value="paternity">Paternity Leave</option>
                                <option value="emergency">Emergency Leave</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Notes</label>
                            <textarea class="form-control" rows="3" placeholder="Any additional notes..."></textarea>
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="notifyStaff" checked>
                                <label class="custom-control-label" for="notifyStaff">Notify staff about attendance update</label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="saveAttendance()">Save Attendance</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bulk Attendance Modal -->
    <div class="modal fade" id="bulkAttendanceModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Bulk Attendance</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info">
                        <i class="las la-info-circle mr-2"></i>
                        Mark attendance for multiple staff members at once. Select date and branch first.
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" value="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Branch <span class="text-danger">*</span></label>
                                <select class="form-control">
                                    <option value="">Select Branch</option>
                                    <option value="main" selected>Main Branch</option>
                                    <option value="mall">Mall Branch</option>
                                    <option value="warehouse">Warehouse</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Default Status</label>
                                <select class="form-control">
                                    <option value="present">Present</option>
                                    <option value="absent">Absent</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Staff</th>
                                    <th>Default Status</th>
                                    <th>Check-in</th>
                                    <th>Check-out</th>
                                    <th>Status</th>
                                    <th>Notes</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-sm mr-2">
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
                                        <span class="badge badge-success">Present</span>
                                    </td>
                                    <td>
                                        <input type="time" class="form-control form-control-sm" value="09:00">
                                    </td>
                                    <td>
                                        <input type="time" class="form-control form-control-sm" value="18:00">
                                    </td>
                                    <td>
                                        <select class="form-control form-control-sm">
                                            <option value="present" selected>Present</option>
                                            <option value="absent">Absent</option>
                                            <option value="half_day">Half Day</option>
                                            <option value="leave">Leave</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control form-control-sm" placeholder="Notes">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-sm mr-2">
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
                                        <span class="badge badge-success">Present</span>
                                    </td>
                                    <td>
                                        <input type="time" class="form-control form-control-sm" value="09:00">
                                    </td>
                                    <td>
                                        <input type="time" class="form-control form-control-sm" value="18:00">
                                    </td>
                                    <td>
                                        <select class="form-control form-control-sm">
                                            <option value="present" selected>Present</option>
                                            <option value="absent">Absent</option>
                                            <option value="half_day">Half Day</option>
                                            <option value="leave">Leave</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control form-control-sm" placeholder="Notes">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Save All</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Apply Leave Modal -->
    <div class="modal fade" id="applyLeaveModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Apply for Leave</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label>Staff Member</label>
                            <select class="form-control">
                                <option value="">Select Staff</option>
                                <option value="1">Rajesh Kumar (EMP-S001)</option>
                                <option value="2">Priya Sharma (EMP-S002)</option>
                                <option value="3">Amit Patel (EMP-I001)</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Leave Type <span class="text-danger">*</span></label>
                            <select class="form-control" required>
                                <option value="">Select Leave Type</option>
                                <option value="sick">Sick Leave</option>
                                <option value="casual">Casual Leave</option>
                                <option value="paid">Paid Leave</option>
                                <option value="unpaid">Unpaid Leave</option>
                                <option value="maternity">Maternity Leave</option>
                                <option value="paternity">Paternity Leave</option>
                                <option value="emergency">Emergency Leave</option>
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>From Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>To Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Total Days</label>
                            <input type="number" class="form-control" readonly value="1">
                        </div>

                        <div class="form-group">
                            <label>Reason <span class="text-danger">*</span></label>
                            <textarea class="form-control" rows="3" placeholder="Enter reason for leave..." required></textarea>
                        </div>

                        <div class="form-group">
                            <label>Contact During Leave</label>
                            <input type="text" class="form-control" placeholder="Emergency contact number">
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="attachDocument">
                                <label class="custom-control-label" for="attachDocument">Attach supporting document</label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Submit Leave Request</button>
                </div>
            </div>
        </div>
    </div>

    @push('js')
    <!-- Backend Bundle JavaScript -->
    <script src="{{ asset('backend/assets/js/backend-bundle.min.js') }}"></script>

    <!-- app JavaScript -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>

    <!-- Flatpickr -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        $(document).ready(function() {
            // Initialize datepicker
            $('.datepicker').flatpickr({
                dateFormat: "Y-m-d",
                defaultDate: "today"
            });

            // Apply filters
            $('#applyFilters').click(function() {
                const date = $('#attendanceDate').val();
                const branch = $('#branchFilter').val();
                const dept = $('#departmentFilter').val();
                const status = $('#statusFilter').val();
                
                // In real app, this would make an AJAX call
                alert(`Filters applied:\nDate: ${date}\nBranch: ${branch}\nDepartment: ${dept}\nStatus: ${status}`);
            });

            // Reset filters
            $('#resetFilters').click(function() {
                $('#attendanceDate').val("{{ date('Y-m-d') }}");
                $('#branchFilter').val('');
                $('#departmentFilter').val('');
                $('#statusFilter').val('');
            });

            // Calculate leave days
            $('input[type="date"]').on('change', function() {
                const fromDate = new Date($('#fromDate').val());
                const toDate = new Date($('#toDate').val());
                
                if (fromDate && toDate && fromDate <= toDate) {
                    const diffTime = Math.abs(toDate - fromDate);
                    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
                    $('#totalDays').val(diffDays);
                }
            });

            // Save attendance
            window.saveAttendance = function() {
                const form = document.getElementById('attendanceForm');
                if (form.checkValidity()) {
                    alert('Attendance saved successfully!');
                    $('#markAttendanceModal').modal('hide');
                } else {
                    form.reportValidity();
                }
            };

            // Tooltip initialization
            $('[title]').tooltip();
        });
    </script>
    @endpush
</x-app-layout>