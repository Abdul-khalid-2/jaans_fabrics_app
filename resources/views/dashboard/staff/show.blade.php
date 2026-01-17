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
                <h4 class="mb-3">Staff Profile</h4>
                <p class="mb-0">View and manage staff member details</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('staff.index') }}">Staff</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </nav>
            </div>
            <div class="d-flex">
                <a href="{{ route('staff.index') }}" class="btn btn-secondary mr-2">
                    <i class="las la-arrow-left mr-2"></i>Back to Staff
                </a>
                <a href="{{ route('staff.edit', 1) }}" class="btn btn-primary mr-2">
                    <i class="las la-edit mr-2"></i>Edit Profile
                </a>
                <div class="dropdown">
                    <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown">
                        <i class="las la-cog mr-2"></i>Actions
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#"><i class="las la-file-invoice-dollar mr-2"></i>Process Salary</a>
                        <a class="dropdown-item" href="#"><i class="las la-calendar-check mr-2"></i>Mark Attendance</a>
                        <a class="dropdown-item" href="#"><i class="las la-hand-holding-usd mr-2"></i>Give Advance</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" href="#"><i class="las la-user-times mr-2"></i>Terminate</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Left Column - Profile Info -->
            <div class="col-lg-4">
                <!-- Profile Card -->
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <div class="avatar avatar-xxl mb-3">
                            <img src="https://ui-avatars.com/api/?name=Rajesh+Kumar&background=007bff&color=fff&size=300"
                                class="rounded-circle" alt="Rajesh Kumar">
                        </div>
                        <h4 class="mb-1">Rajesh Kumar</h4>
                        <p class="text-muted mb-2">EMP-S001</p>
                        <span class="badge badge-primary mb-3">Sales Manager</span>
                        
                        <div class="d-flex justify-content-center mb-3">
                            <div class="text-center mx-3">
                                <h5 class="mb-0">2.5</h5>
                                <small class="text-muted">Years</small>
                            </div>
                            <div class="text-center mx-3">
                                <h5 class="mb-0">98%</h5>
                                <small class="text-muted">Attendance</small>
                            </div>
                            <div class="text-center mx-3">
                                <h5 class="mb-0">Rs45L</h5>
                                <small class="text-muted">Sales</small>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center">
                            <button class="btn btn-outline-primary btn-sm mr-2">
                                <i class="las la-envelope"></i> Message
                            </button>
                            <button class="btn btn-outline-info btn-sm">
                                <i class="las la-phone"></i> Call
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="mb-0">Quick Stats</h6>
                    </div>
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <span>Current Month Sales</span>
                                <strong class="text-success">Rs4,85,000</strong>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <span>This Month Attendance</span>
                                <strong class="text-success">28/28</strong>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <span>Pending Commission</span>
                                <strong class="text-warning">Rs8,500</strong>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <span>Salary Advance Due</span>
                                <strong class="text-danger">Rs10,000</strong>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <span>Next Salary Date</span>
                                <strong>05 Dec 2024</strong>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Emergency Contact -->
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0">Emergency Contact</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-start mb-3">
                            <i class="las la-user-circle fa-2x text-primary mr-3"></i>
                            <div>
                                <h6 class="mb-0">Mrs. Sunita Kumar</h6>
                                <small class="text-muted">Mother</small>
                            </div>
                        </div>
                        <div class="d-flex align-items-start mb-3">
                            <i class="las la-phone fa-2x text-success mr-3"></i>
                            <div>
                                <h6 class="mb-0">+91 98765 43210</h6>
                                <small class="text-muted">Primary Contact</small>
                            </div>
                        </div>
                        <div class="d-flex align-items-start">
                            <i class="las la-map-marker fa-2x text-danger mr-3"></i>
                            <div>
                                <h6 class="mb-0">123, ABC Apartment, Mumbai</h6>
                                <small class="text-muted">Home Address</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Details -->
            <div class="col-lg-8">
                <!-- Personal Information -->
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Personal Information</h6>
                        <button class="btn btn-sm btn-outline-primary">Edit</button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <small class="text-muted">Full Name</small>
                                    <p class="mb-0"><strong>Rajesh Kumar</strong></p>
                                </div>
                                <div class="mb-3">
                                    <small class="text-muted">Date of Birth</small>
                                    <p class="mb-0"><strong>15 March 1990</strong></p>
                                </div>
                                <div class="mb-3">
                                    <small class="text-muted">Gender</small>
                                    <p class="mb-0"><strong>Male</strong></p>
                                </div>
                                <div class="mb-3">
                                    <small class="text-muted">Marital Status</small>
                                    <p class="mb-0"><strong>Married</strong></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <small class="text-muted">Email Address</small>
                                    <p class="mb-0"><strong>rajesh@clothshop.com</strong></p>
                                </div>
                                <div class="mb-3">
                                    <small class="text-muted">Phone Number</small>
                                    <p class="mb-0"><strong>+91 98765 43210</strong></p>
                                </div>
                                <div class="mb-3">
                                    <small class="text-muted">Alternate Phone</small>
                                    <p class="mb-0"><strong>+91 98765 43211</strong></p>
                                </div>
                                <div class="mb-3">
                                    <small class="text-muted">Address</small>
                                    <p class="mb-0"><strong>123, ABC Apartment, Mumbai - 400001</strong></p>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <small class="text-muted">Aadhar Number</small>
                                    <p class="mb-0"><strong>1234 5678 9012</strong></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <small class="text-muted">PAN Number</small>
                                    <p class="mb-0"><strong>ABCDE1234F</strong></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Employment Details -->
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Employment Details</h6>
                        <button class="btn btn-sm btn-outline-primary">Edit</button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <small class="text-muted">Employee Code</small>
                                    <p class="mb-0"><strong>EMP-S001</strong></p>
                                </div>
                                <div class="mb-3">
                                    <small class="text-muted">Department</small>
                                    <p class="mb-0"><span class="badge badge-primary">Sales</span></p>
                                </div>
                                <div class="mb-3">
                                    <small class="text-muted">Designation</small>
                                    <p class="mb-0"><strong>Sales Manager</strong></p>
                                </div>
                                <div class="mb-3">
                                    <small class="text-muted">Date of Joining</small>
                                    <p class="mb-0"><strong>15 January 2022</strong></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <small class="text-muted">Employment Type</small>
                                    <p class="mb-0"><strong>Permanent</strong></p>
                                </div>
                                <div class="mb-3">
                                    <small class="text-muted">Employment Status</small>
                                    <p class="mb-0"><span class="badge badge-success">Active</span></p>
                                </div>
                                <div class="mb-3">
                                    <small class="text-muted">Experience</small>
                                    <p class="mb-0"><strong>2 years 10 months</strong></p>
                                </div>
                                <div class="mb-3">
                                    <small class="text-muted">Notice Period</small>
                                    <p class="mb-0"><strong>30 days</strong></p>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-12">
                                <small class="text-muted">Assigned Branches</small>
                                <div class="d-flex flex-wrap mt-2">
                                    <span class="badge badge-light mr-2 mb-2">Main Branch (Primary)</span>
                                    <span class="badge badge-light mr-2 mb-2">Mall Branch</span>
                                    <span class="badge badge-light mb-2">Warehouse Branch</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Salary & Bank Details -->
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Salary & Bank Details</h6>
                        <button class="btn btn-sm btn-outline-primary">Edit</button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="mb-3">Salary Structure</h6>
                                <div class="mb-3">
                                    <small class="text-muted">Basic Salary</small>
                                    <p class="mb-0"><strong>Rs35,000</strong></p>
                                </div>
                                <div class="mb-3">
                                    <small class="text-muted">Allowances</small>
                                    <p class="mb-0"><strong>Rs5,000</strong></p>
                                </div>
                                <div class="mb-3">
                                    <small class="text-muted">Commission Rate</small>
                                    <p class="mb-0"><strong>2.5%</strong></p>
                                </div>
                                <div class="mb-3">
                                    <small class="text-muted">Net Salary (Last Month)</small>
                                    <p class="mb-0"><strong class="text-success">Rs41,900</strong></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h6 class="mb-3">Bank Details</h6>
                                <div class="mb-3">
                                    <small class="text-muted">Bank Name</small>
                                    <p class="mb-0"><strong>HDFC Bank</strong></p>
                                </div>
                                <div class="mb-3">
                                    <small class="text-muted">Account Number</small>
                                    <p class="mb-0"><strong>123456789012</strong></p>
                                </div>
                                <div class="mb-3">
                                    <small class="text-muted">Account Holder</small>
                                    <p class="mb-0"><strong>Rajesh Kumar</strong></p>
                                </div>
                                <div class="mb-3">
                                    <small class="text-muted">IFSC Code</small>
                                    <p class="mb-0"><strong>HDFC0000123</strong></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Performance & Attendance -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h6 class="mb-0">Sales Performance</h6>
                            </div>
                            <div class="card-body">
                                <div class="text-center mb-3">
                                    <h2 class="text-success mb-0">Rs4,85,000</h2>
                                    <small class="text-muted">Current Month Sales</small>
                                </div>
                                <div class="progress mb-2" style="height: 10px;">
                                    <div class="progress-bar bg-success" style="width: 97%"></div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <small>Target: Rs5,00,000</small>
                                    <small><strong>97%</strong></small>
                                </div>
                                <hr>
                                <div class="row text-center">
                                    <div class="col-6">
                                        <h5 class="mb-0">45</h5>
                                        <small class="text-muted">Total Sales</small>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="mb-0">Rs45.2L</h5>
                                        <small class="text-muted">Lifetime Sales</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h6 class="mb-0">Attendance Summary</h6>
                            </div>
                            <div class="card-body">
                                <div class="text-center mb-3">
                                    <h2 class="text-primary mb-0">98%</h2>
                                    <small class="text-muted">Monthly Attendance Rate</small>
                                </div>
                                <div class="row text-center mb-3">
                                    <div class="col-4">
                                        <h5 class="mb-0 text-success">28</h5>
                                        <small class="text-muted">Present</small>
                                    </div>
                                    <div class="col-4">
                                        <h5 class="mb-0 text-warning">1</h5>
                                        <small class="text-muted">Late</small>
                                    </div>
                                    <div class="col-4">
                                        <h5 class="mb-0 text-danger">0</h5>
                                        <small class="text-muted">Absent</small>
                                    </div>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <small>Last Check-in</small>
                                    <small><strong>Today, 9:05 AM</strong></small>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <small>Average Check-in Time</small>
                                    <small><strong>9:10 AM</strong></small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activities -->
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0">Recent Activities</h6>
                    </div>
                    <div class="card-body">
                        <div class="timeline">
                            <div class="timeline-item">
                                <div class="timeline-marker bg-success"></div>
                                <div class="timeline-content">
                                    <h6 class="mb-1">Salary Processed</h6>
                                    <p class="text-muted mb-1">November salary of Rs41,900 processed</p>
                                    <small class="text-muted">05 Nov 2024, 10:30 AM</small>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-marker bg-primary"></div>
                                <div class="timeline-content">
                                    <h6 class="mb-1">Sales Commission Added</h6>
                                    <p class="text-muted mb-1">Commission of Rs8,500 added for October sales</p>
                                    <small class="text-muted">01 Nov 2024, 11:15 AM</small>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-marker bg-warning"></div>
                                <div class="timeline-content">
                                    <h6 class="mb-1">Late Check-in</h6>
                                    <p class="text-muted mb-1">Checked in at 9:45 AM (45 minutes late)</p>
                                    <small class="text-muted">30 Oct 2024, 9:45 AM</small>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-marker bg-info"></div>
                                <div class="timeline-content">
                                    <h6 class="mb-1">Leave Approved</h6>
                                    <p class="text-muted mb-1">Casual leave approved for 2 days</p>
                                    <small class="text-muted">25 Oct 2024, 3:20 PM</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .timeline {
            position: relative;
            padding-left: 30px;
        }
        .timeline:before {
            content: '';
            position: absolute;
            left: 15px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: #e9ecef;
        }
        .timeline-item {
            position: relative;
            margin-bottom: 20px;
        }
        .timeline-marker {
            position: absolute;
            left: -30px;
            top: 0;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            border: 3px solid #fff;
            z-index: 1;
        }
        .timeline-content {
            padding-left: 10px;
        }
    </style>

    @push('js')
    <!-- Backend Bundle JavaScript -->
    <script src="{{ asset('backend/assets/js/backend-bundle.min.js') }}"></script>

    <!-- app JavaScript -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Print functionality
            $('.btn-outline-primary').click(function(e) {
                e.preventDefault();
                const section = $(this).closest('.card').find('.card-body');
                const sectionTitle = $(this).closest('.card').find('.card-header h6').text();
                
                alert(`Editing ${sectionTitle}`);
            });
        });
    </script>
    @endpush
</x-app-layout>