<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/remixicon/fonts/remixicon.css') }}">
    <style>
        .customer-avatar {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 5px solid #fff;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .customer-avatar-sm {
            width: 60px;
            height: 60px;
            border-radius: 50%;
        }

        .badge-tier {
            padding: 5px 12px;
            border-radius: 20px;
            font-weight: 600;
        }

        .badge-tier.bronze {
            background-color: #CD7F32;
            color: white;
        }

        .badge-tier.silver {
            background-color: #C0C0C0;
            color: black;
        }

        .badge-tier.gold {
            background-color: #FFD700;
            color: black;
        }

        .badge-tier.platinum {
            background-color: #E5E4E2;
            color: black;
        }

        .info-card {
            border-radius: 10px;
            border: 1px solid #e3e6f0;
            transition: all 0.3s;
        }

        .info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .activity-timeline {
            position: relative;
            padding-left: 30px;
        }

        .activity-timeline::before {
            content: '';
            position: absolute;
            left: 10px;
            top: 0;
            bottom: 0;
            width: 2px;
            background-color: #e3e6f0;
        }

        .activity-dot {
            position: absolute;
            left: -20px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: #007bff;
            border: 2px solid white;
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
        }

        .purchase-item {
            border-left: 3px solid #007bff;
            padding-left: 15px;
            margin-bottom: 15px;
        }

        .stats-number {
            font-size: 2rem;
            font-weight: 700;
            line-height: 1;
        }

        .stats-label {
            font-size: 0.875rem;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .progress-loyalty {
            height: 20px;
            border-radius: 10px;
        }

        .tab-pane {
            padding: 20px;
            border: 1px solid #dee2e6;
            border-top: none;
            border-radius: 0 0 8px 8px;
        }

        .nav-tabs .nav-link {
            border: 1px solid #dee2e6;
            border-bottom: none;
            margin-right: 5px;
            border-radius: 8px 8px 0 0;
        }

        .nav-tabs .nav-link.active {
            background-color: #007bff;
            color: white;
            border-color: #007bff;
        }
    </style>
    @endpush

    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
            <div>
                <h4 class="mb-3">Customer Details</h4>
                <p class="mb-0">View customer information and activities</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('customers.index') }}">Customers</a></li>
                        <li class="breadcrumb-item active">Customer Details</li>
                    </ol>
                </nav>
            </div>
            <div>
                <div class="btn-group" role="group">
                    <a href="{{ route('customers.edit', 1) }}" class="btn btn-primary">
                        <i class="las la-edit mr-2"></i>Edit Customer
                    </a>
                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                        data-toggle="dropdown" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#"><i class="las la-shopping-cart mr-2"></i>New Sale</a>
                        <a class="dropdown-item" href="#"><i class="las la-file-invoice mr-2"></i>View Invoices</a>
                        <a class="dropdown-item" href="#"><i class="las la-phone mr-2"></i>Call Customer</a>
                        <a class="dropdown-item" href="#"><i class="las la-envelope mr-2"></i>Send Email</a>
                        <a class="dropdown-item" href="#"><i class="las la-sms mr-2"></i>Send SMS</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" href="#"><i class="las la-trash mr-2"></i>Delete Customer</a>
                    </div>
                </div>
                <a href="{{ route('customers.index') }}" class="btn btn-outline-secondary ml-2">
                    <i class="las la-arrow-left mr-2"></i>Back to List
                </a>
            </div>
        </div>

        <!-- Customer Header -->
        <div class="row mb-4">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-2 text-center">
                                <img src="https://ui-avatars.com/api/?name=John+Smith&background=007bff&color=fff&size=150"
                                    class="customer-avatar" alt="John Smith">
                                <div class="mt-3">
                                    <span class="badge badge-success">Active</span>
                                    <span class="badge badge-warning ml-1">VIP</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-start">
                                    <div>
                                        <h2 class="mb-1">John Smith</h2>
                                        <div class="d-flex align-items-center mb-2">
                                            <span class="badge badge-primary mr-2">CUST-001</span>
                                            <span class="badge badge-info mr-2">Regular</span>
                                            <span class="badge-tier platinum">PLATINUM</span>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p class="mb-1"><i class="las la-phone mr-2"></i> +91 98765 43210</p>
                                                <p class="mb-1"><i class="las la-envelope mr-2"></i> john.smith@example.com</p>
                                                <p class="mb-1"><i class="las la-map-marker mr-2"></i> Mumbai, India</p>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="mb-1"><i class="las la-user mr-2"></i> Male, 35 years</p>
                                                <p class="mb-1"><i class="las la-calendar mr-2"></i> Member since: 15 Jan 2023</p>
                                                <p class="mb-1"><i class="las la-shopping-bag mr-2"></i> Last purchase: 15 Nov 2024</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-6 text-center">
                                        <div class="info-card p-3 mb-3">
                                            <div class="stats-number text-primary">Rs1,24,850</div>
                                            <div class="stats-label">Total Spent</div>
                                        </div>
                                    </div>
                                    <div class="col-6 text-center">
                                        <div class="info-card p-3 mb-3">
                                            <div class="stats-number text-success">42</div>
                                            <div class="stats-label">Total Orders</div>
                                        </div>
                                    </div>
                                    <div class="col-6 text-center">
                                        <div class="info-card p-3">
                                            <div class="stats-number text-warning">5,240</div>
                                            <div class="stats-label">Loyalty Points</div>
                                        </div>
                                    </div>
                                    <div class="col-6 text-center">
                                        <div class="info-card p-3">
                                            <div class="stats-number text-info">Rs2,950</div>
                                            <div class="stats-label">Avg. Order</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Customer Details Tabs -->
        <div class="row">
            <div class="col-lg-12">
                <ul class="nav nav-tabs" id="customerDetailTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#overview">
                            <i class="las la-chart-bar mr-2"></i>Overview
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile">
                            <i class="las la-user mr-2"></i>Profile
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="purchases-tab" data-toggle="tab" href="#purchases">
                            <i class="las la-shopping-cart mr-2"></i>Purchases (42)
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="loyalty-tab" data-toggle="tab" href="#loyalty">
                            <i class="las la-crown mr-2"></i>Loyalty
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="addresses-tab" data-toggle="tab" href="#addresses">
                            <i class="las la-map-marker mr-2"></i>Addresses
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="activity-tab" data-toggle="tab" href="#activity">
                            <i class="las la-history mr-2"></i>Activity
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="notes-tab" data-toggle="tab" href="#notes">
                            <i class="las la-sticky-note mr-2"></i>Notes
                        </a>
                    </li>
                </ul>

                <div class="tab-content" id="customerDetailTabContent">
                    <!-- Overview Tab -->
                    <div class="tab-pane fade show active" id="overview" role="tabpanel">
                        <div class="row">
                            <!-- Sales Chart -->
                            <div class="col-lg-8">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h6 class="mb-0">Purchase History (Last 6 Months)</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container" style="height: 300px;">
                                            <!-- Chart would go here -->
                                            <div class="text-center text-muted py-5">
                                                <i class="las la-chart-line fa-3x mb-3"></i>
                                                <p>Purchase history chart would be displayed here</p>
                                            </div>
                                        </div>
                                        <div class="row text-center mt-4">
                                            <div class="col-md-3">
                                                <h4 class="text-primary mb-1">Rs24,850</h4>
                                                <small class="text-muted">Last 30 Days</small>
                                            </div>
                                            <div class="col-md-3">
                                                <h4 class="text-success mb-1">8</h4>
                                                <small class="text-muted">Orders This Month</small>
                                            </div>
                                            <div class="col-md-3">
                                                <h4 class="text-warning mb-1">Rs3,106</h4>
                                                <small class="text-muted">Avg. Monthly Spend</small>
                                            </div>
                                            <div class="col-md-3">
                                                <h4 class="text-info mb-1">Rs12,450</h4>
                                                <small class="text-muted">Largest Purchase</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Recent Purchases -->
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0">Recent Purchases</h6>
                                        <a href="#" class="btn btn-sm btn-outline-primary">View All</a>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Invoice #</th>
                                                        <th>Items</th>
                                                        <th>Amount</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>15 Nov 2024</td>
                                                        <td>INV-2024-001245</td>
                                                        <td>3</td>
                                                        <td class="text-success">Rs4,127</td>
                                                        <td><span class="badge badge-success">Paid</span></td>
                                                        <td>
                                                            <a href="#" class="btn btn-sm btn-info">
                                                                <i class="las la-eye"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>10 Nov 2024</td>
                                                        <td>INV-2024-001238</td>
                                                        <td>2</td>
                                                        <td class="text-success">Rs3,598</td>
                                                        <td><span class="badge badge-success">Paid</span></td>
                                                        <td>
                                                            <a href="#" class="btn btn-sm btn-info">
                                                                <i class="las la-eye"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>05 Nov 2024</td>
                                                        <td>INV-2024-001225</td>
                                                        <td>5</td>
                                                        <td class="text-success">Rs8,450</td>
                                                        <td><span class="badge badge-success">Paid</span></td>
                                                        <td>
                                                            <a href="#" class="btn btn-sm btn-info">
                                                                <i class="las la-eye"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>28 Oct 2024</td>
                                                        <td>INV-2024-001218</td>
                                                        <td>1</td>
                                                        <td class="text-success">Rs2,150</td>
                                                        <td><span class="badge badge-success">Paid</span></td>
                                                        <td>
                                                            <a href="#" class="btn btn-sm btn-info">
                                                                <i class="las la-eye"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>20 Oct 2024</td>
                                                        <td>INV-2024-001205</td>
                                                        <td>4</td>
                                                        <td class="text-success">Rs6,820</td>
                                                        <td><span class="badge badge-success">Paid</span></td>
                                                        <td>
                                                            <a href="#" class="btn btn-sm btn-info">
                                                                <i class="las la-eye"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Right Sidebar -->
                            <div class="col-lg-4">
                                <!-- Customer Preferences -->
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h6 class="mb-0">Shopping Preferences</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <small class="text-muted d-block mb-1">Preferred Size</small>
                                            <span class="badge badge-primary">L</span>
                                        </div>
                                        <div class="mb-3">
                                            <small class="text-muted d-block mb-1">Preferred Colors</small>
                                            <div class="d-flex">
                                                <span class="badge mr-2" style="background-color: #0000FF; color: white;">Blue</span>
                                                <span class="badge mr-2" style="background-color: #000000; color: white;">Black</span>
                                                <span class="badge" style="background-color: #808080; color: white;">Gray</span>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <small class="text-muted d-block mb-1">Preferred Brands</small>
                                            <span class="badge badge-info mr-2">Nike</span>
                                            <span class="badge badge-info">Levi's</span>
                                        </div>
                                        <div class="mb-3">
                                            <small class="text-muted d-block mb-1">Preferred Categories</small>
                                            <span class="badge badge-secondary mr-2">Casual</span>
                                            <span class="badge badge-secondary">Formal</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Communication Preferences -->
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h6 class="mb-0">Communication Preferences</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="custom-control custom-checkbox mb-2">
                                            <input type="checkbox" class="custom-control-input" id="emailPref" checked disabled>
                                            <label class="custom-control-label" for="emailPref">Email Offers</label>
                                        </div>
                                        <div class="custom-control custom-checkbox mb-2">
                                            <input type="checkbox" class="custom-control-input" id="smsPref" checked disabled>
                                            <label class="custom-control-label" for="smsPref">SMS Offers</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="whatsappPref" checked disabled>
                                            <label class="custom-control-label" for="whatsappPref">WhatsApp Updates</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Quick Actions -->
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="mb-0">Quick Actions</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6 mb-3">
                                                <a href="#" class="btn btn-outline-primary btn-block">
                                                    <i class="las la-shopping-cart"></i>
                                                    <span class="d-block mt-1">New Sale</span>
                                                </a>
                                            </div>
                                            <div class="col-6 mb-3">
                                                <a href="#" class="btn btn-outline-success btn-block">
                                                    <i class="las la-file-invoice"></i>
                                                    <span class="d-block mt-1">View Invoices</span>
                                                </a>
                                            </div>
                                            <div class="col-6">
                                                <a href="#" class="btn btn-outline-info btn-block">
                                                    <i class="las la-envelope"></i>
                                                    <span class="d-block mt-1">Send Email</span>
                                                </a>
                                            </div>
                                            <div class="col-6">
                                                <a href="#" class="btn btn-outline-warning btn-block">
                                                    <i class="las la-gift"></i>
                                                    <span class="d-block mt-1">Send Offer</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Profile Tab -->
                    <div class="tab-pane fade" id="profile" role="tabpanel">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h6 class="mb-0">Personal Information</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <small class="text-muted d-block mb-1">Full Name</small>
                                                <strong>John Smith</strong>
                                            </div>
                                            <div class="col-md-6">
                                                <small class="text-muted d-block mb-1">Customer Code</small>
                                                <strong>CUST-001</strong>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <small class="text-muted d-block mb-1">Email Address</small>
                                                <strong>john.smith@example.com</strong>
                                            </div>
                                            <div class="col-md-6">
                                                <small class="text-muted d-block mb-1">Phone Number</small>
                                                <strong>+91 98765 43210</strong>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <small class="text-muted d-block mb-1">Alternate Phone</small>
                                                <strong>+91 98765 12345</strong>
                                            </div>
                                            <div class="col-md-6">
                                                <small class="text-muted d-block mb-1">Customer Type</small>
                                                <span class="badge badge-primary">Regular</span>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <small class="text-muted d-block mb-1">Gender</small>
                                                <strong>Male</strong>
                                            </div>
                                            <div class="col-md-6">
                                                <small class="text-muted d-block mb-1">Date of Birth</small>
                                                <strong>15 June 1989</strong>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <small class="text-muted d-block mb-1">Age Group</small>
                                                <strong>Adult (30-45)</strong>
                                            </div>
                                            <div class="col-md-6">
                                                <small class="text-muted d-block mb-1">Anniversary Date</small>
                                                <strong>10 April 2015</strong>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <small class="text-muted d-block mb-1">Reference Source</small>
                                                <strong>Walk-in</strong>
                                            </div>
                                            <div class="col-md-6">
                                                <small class="text-muted d-block mb-1">Member Since</small>
                                                <strong>15 January 2023</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Financial Information -->
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="mb-0">Financial Information</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <small class="text-muted d-block mb-1">Total Purchases</small>
                                                <h5 class="text-success">Rs1,24,850</h5>
                                            </div>
                                            <div class="col-md-6">
                                                <small class="text-muted d-block mb-1">Total Orders</small>
                                                <h5>42</h5>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <small class="text-muted d-block mb-1">Average Order Value</small>
                                                <h5>Rs2,950</h5>
                                            </div>
                                            <div class="col-md-6">
                                                <small class="text-muted d-block mb-1">Last Purchase Date</small>
                                                <h5>15 Nov 2024</h5>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <small class="text-muted d-block mb-1">Credit Limit</small>
                                                <h5 class="text-info">Rs50,000</h5>
                                            </div>
                                            <div class="col-md-6">
                                                <small class="text-muted d-block mb-1">Outstanding Balance</small>
                                                <h5 class="text-danger">Rs0.00</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <!-- Loyalty Information -->
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h6 class="mb-0">Loyalty Program</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="text-center mb-4">
                                            <div class="badge-tier platinum mb-3" style="font-size: 1.2rem;">PLATINUM TIER</div>
                                            <div class="progress progress-loyalty mb-3">
                                                <div class="progress-bar bg-warning" role="progressbar" style="width: 85%"
                                                    aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <small class="text-muted">5,240 / 6,000 points to Diamond Tier</small>
                                        </div>
                                        <div class="row text-center">
                                            <div class="col-6">
                                                <h4 class="text-warning mb-1">5,240</h4>
                                                <small class="text-muted">Current Points</small>
                                            </div>
                                            <div class="col-6">
                                                <h4 class="text-success mb-1">6,850</h4>
                                                <small class="text-muted">Total Earned</small>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <small class="text-muted d-block mb-1">Loyalty Benefits</small>
                                                <ul class="list-unstyled mb-0">
                                                    <li><i class="las la-check text-success mr-2"></i> 3 points per Rs100 spent</li>
                                                    <li><i class="las la-check text-success mr-2"></i> Birthday Gift</li>
                                                    <li><i class="las la-check text-success mr-2"></i> Exclusive Offers</li>
                                                    <li><i class="las la-check text-success mr-2"></i> Personal Shopper</li>
                                                    <li><i class="las la-check text-success mr-2"></i> Early Access to Sales</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Status Information -->
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="mb-0">Status & Settings</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <small class="text-muted d-block mb-1">Account Status</small>
                                                <span class="badge badge-success">Active</span>
                                            </div>
                                            <div class="col-md-6">
                                                <small class="text-muted d-block mb-1">Blacklist Status</small>
                                                <span class="badge badge-secondary">Not Blacklisted</span>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <small class="text-muted d-block mb-1">Payment Terms</small>
                                                <strong>Net 30</strong>
                                            </div>
                                            <div class="col-md-6">
                                                <small class="text-muted d-block mb-1">Assigned Sales Rep</small>
                                                <strong>Sarah Johnson</strong>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <small class="text-muted d-block mb-1">Tags</small>
                                                <span class="badge badge-light mr-1">VIP</span>
                                                <span class="badge badge-light mr-1">Frequent Buyer</span>
                                                <span class="badge badge-light">Early Adopter</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Purchases Tab -->
                    <div class="tab-pane fade" id="purchases" role="tabpanel">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h6 class="mb-0">Purchase History</h6>
                                <div>
                                    <button class="btn btn-sm btn-outline-primary mr-2">Export</button>
                                    <button class="btn btn-sm btn-outline-secondary">Filter</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Invoice #</th>
                                                <th>Date</th>
                                                <th>Items</th>
                                                <th>Amount</th>
                                                <th>Payment Method</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Purchase 1 -->
                                            <tr>
                                                <td><strong>INV-2024-001245</strong></td>
                                                <td>15 Nov 2024</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <img src="https://via.placeholder.com/40" class="rounded mr-2" alt="Product">
                                                        <img src="https://via.placeholder.com/40" class="rounded mr-2" alt="Product">
                                                        <img src="https://via.placeholder.com/40" class="rounded" alt="Product">
                                                    </div>
                                                </td>
                                                <td class="text-success"><strong>Rs4,127</strong></td>
                                                <td><span class="badge badge-success">Card</span></td>
                                                <td><span class="badge badge-success">Completed</span></td>
                                                <td>
                                                    <a href="#" class="btn btn-sm btn-info mr-1"><i class="las la-eye"></i></a>
                                                    <a href="#" class="btn btn-sm btn-primary"><i class="las la-print"></i></a>
                                                </td>
                                            </tr>
                                            <!-- Purchase 2 -->
                                            <tr>
                                                <td><strong>INV-2024-001238</strong></td>
                                                <td>10 Nov 2024</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <img src="https://via.placeholder.com/40" class="rounded mr-2" alt="Product">
                                                        <img src="https://via.placeholder.com/40" class="rounded" alt="Product">
                                                    </div>
                                                </td>
                                                <td class="text-success"><strong>Rs3,598</strong></td>
                                                <td><span class="badge badge-info">UPI</span></td>
                                                <td><span class="badge badge-success">Completed</span></td>
                                                <td>
                                                    <a href="#" class="btn btn-sm btn-info mr-1"><i class="las la-eye"></i></a>
                                                    <a href="#" class="btn btn-sm btn-primary"><i class="las la-print"></i></a>
                                                </td>
                                            </tr>
                                            <!-- Purchase 3 -->
                                            <tr>
                                                <td><strong>INV-2024-001225</strong></td>
                                                <td>05 Nov 2024</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <img src="https://via.placeholder.com/40" class="rounded mr-2" alt="Product">
                                                        <img src="https://via.placeholder.com/40" class="rounded mr-2" alt="Product">
                                                        <img src="https://via.placeholder.com/40" class="rounded mr-2" alt="Product">
                                                        <img src="https://via.placeholder.com/40" class="rounded mr-2" alt="Product">
                                                        <img src="https://via.placeholder.com/40" class="rounded" alt="Product">
                                                    </div>
                                                </td>
                                                <td class="text-success"><strong>Rs8,450</strong></td>
                                                <td><span class="badge badge-primary">Cash</span></td>
                                                <td><span class="badge badge-success">Completed</span></td>
                                                <td>
                                                    <a href="#" class="btn btn-sm btn-info mr-1"><i class="las la-eye"></i></a>
                                                    <a href="#" class="btn btn-sm btn-primary"><i class="las la-print"></i></a>
                                                </td>
                                            </tr>
                                            <!-- Purchase 4 -->
                                            <tr>
                                                <td><strong>INV-2024-001218</strong></td>
                                                <td>28 Oct 2024</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <img src="https://via.placeholder.com/40" class="rounded" alt="Product">
                                                    </div>
                                                </td>
                                                <td class="text-success"><strong>Rs2,150</strong></td>
                                                <td><span class="badge badge-warning">Credit</span></td>
                                                <td><span class="badge badge-success">Completed</span></td>
                                                <td>
                                                    <a href="#" class="btn btn-sm btn-info mr-1"><i class="las la-eye"></i></a>
                                                    <a href="#" class="btn btn-sm btn-primary"><i class="las la-print"></i></a>
                                                </td>
                                            </tr>
                                            <!-- Purchase 5 -->
                                            <tr>
                                                <td><strong>INV-2024-001205</strong></td>
                                                <td>20 Oct 2024</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <img src="https://via.placeholder.com/40" class="rounded mr-2" alt="Product">
                                                        <img src="https://via.placeholder.com/40" class="rounded mr-2" alt="Product">
                                                        <img src="https://via.placeholder.com/40" class="rounded mr-2" alt="Product">
                                                        <img src="https://via.placeholder.com/40" class="rounded" alt="Product">
                                                    </div>
                                                </td>
                                                <td class="text-success"><strong>Rs6,820</strong></td>
                                                <td><span class="badge badge-success">Card</span></td>
                                                <td><span class="badge badge-success">Completed</span></td>
                                                <td>
                                                    <a href="#" class="btn btn-sm btn-info mr-1"><i class="las la-eye"></i></a>
                                                    <a href="#" class="btn btn-sm btn-primary"><i class="las la-print"></i></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Purchase Summary -->
                                <div class="row mt-4">
                                    <div class="col-md-3 col-6">
                                        <div class="card bg-light border">
                                            <div class="card-body text-center">
                                                <h5 class="text-primary">42</h5>
                                                <small class="text-muted">Total Orders</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <div class="card bg-light border">
                                            <div class="card-body text-center">
                                                <h5 class="text-success">Rs1,24,850</h5>
                                                <small class="text-muted">Total Spent</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <div class="card bg-light border">
                                            <div class="card-body text-center">
                                                <h5 class="text-info">Rs2,950</h5>
                                                <small class="text-muted">Avg. Order Value</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <div class="card bg-light border">
                                            <div class="card-body text-center">
                                                <h5 class="text-warning">Rs12,450</h5>
                                                <small class="text-muted">Largest Order</small>
                                            </div>
                                        </div>
                                    </div>
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

                    <!-- Loyalty Tab -->
                    <div class="tab-pane fade" id="loyalty" role="tabpanel">
                        <div class="row">
                            <div class="col-lg-8">
                                <!-- Loyalty Points History -->
                                <div class="card mb-4">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0">Loyalty Points History</h6>
                                        <button class="btn btn-sm btn-outline-primary">Add Points</button>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Transaction</th>
                                                        <th>Points Earned</th>
                                                        <th>Points Redeemed</th>
                                                        <th>Balance</th>
                                                        <th>Notes</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>15 Nov 2024</td>
                                                        <td>Purchase INV-2024-001245</td>
                                                        <td class="text-success">+124</td>
                                                        <td class="text-muted">0</td>
                                                        <td>5,240</td>
                                                        <td>Regular purchase</td>
                                                    </tr>
                                                    <tr>
                                                        <td>10 Nov 2024</td>
                                                        <td>Purchase INV-2024-001238</td>
                                                        <td class="text-success">+108</td>
                                                        <td class="text-muted">0</td>
                                                        <td>5,116</td>
                                                        <td>Regular purchase</td>
                                                    </tr>
                                                    <tr>
                                                        <td>05 Nov 2024</td>
                                                        <td>Birthday Bonus</td>
                                                        <td class="text-success">+500</td>
                                                        <td class="text-muted">0</td>
                                                        <td>5,008</td>
                                                        <td>Birthday gift points</td>
                                                    </tr>
                                                    <tr>
                                                        <td>05 Nov 2024</td>
                                                        <td>Purchase INV-2024-001225</td>
                                                        <td class="text-success">+254</td>
                                                        <td class="text-muted">0</td>
                                                        <td>4,508</td>
                                                        <td>Large purchase</td>
                                                    </tr>
                                                    <tr>
                                                        <td>01 Nov 2024</td>
                                                        <td>Points Redemption</td>
                                                        <td class="text-muted">0</td>
                                                        <td class="text-danger">-1,000</td>
                                                        <td>4,254</td>
                                                        <td>Redeemed for discount</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tier Benefits -->
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="mb-0">Platinum Tier Benefits</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="d-flex align-items-start">
                                                    <div class="bg-primary rounded p-2 mr-3">
                                                        <i class="las la-gem text-white fa-lg"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-1">3x Points</h6>
                                                        <p class="mb-0 text-muted">Earn 3 points for every Rs100 spent</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="d-flex align-items-start">
                                                    <div class="bg-success rounded p-2 mr-3">
                                                        <i class="las la-birthday-cake text-white fa-lg"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-1">Birthday Gift</h6>
                                                        <p class="mb-0 text-muted">500 bonus points on your birthday</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="d-flex align-items-start">
                                                    <div class="bg-warning rounded p-2 mr-3">
                                                        <i class="las la-star text-white fa-lg"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-1">Exclusive Offers</h6>
                                                        <p class="mb-0 text-muted">Access to members-only sales and promotions</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="d-flex align-items-start">
                                                    <div class="bg-info rounded p-2 mr-3">
                                                        <i class="las la-user text-white fa-lg"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-1">Personal Shopper</h6>
                                                        <p class="mb-0 text-muted">Dedicated shopping assistance</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="d-flex align-items-start">
                                                    <div class="bg-danger rounded p-2 mr-3">
                                                        <i class="las la-clock text-white fa-lg"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-1">Early Access</h6>
                                                        <p class="mb-0 text-muted">Shop new collections 48 hours early</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="d-flex align-items-start">
                                                    <div class="bg-purple rounded p-2 mr-3">
                                                        <i class="las la-gift text-white fa-lg"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-1">Free Shipping</h6>
                                                        <p class="mb-0 text-muted">Free shipping on all orders</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <!-- Loyalty Progress -->
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h6 class="mb-0">Tier Progress</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="text-center mb-4">
                                            <div class="badge-tier platinum mb-3" style="font-size: 1.5rem; padding: 10px 20px;">PLATINUM</div>
                                            <p class="text-muted mb-3">You are currently in Platinum tier</p>
                                            <div class="progress progress-loyalty mb-2">
                                                <div class="progress-bar bg-warning" role="progressbar" style="width: 85%"
                                                    aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <small class="text-muted">5,240 / 6,000 points to Diamond Tier</small>
                                        </div>
                                        <div class="text-center">
                                            <h5 class="mb-3">Next Tier: Diamond</h5>
                                            <div class="d-flex justify-content-between mb-2">
                                                <span>Platinum</span>
                                                <span>6,000 pts</span>
                                            </div>
                                            <div class="d-flex justify-content-between mb-2">
                                                <span>Diamond</span>
                                                <span>10,000 pts</span>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <span>Exclusive</span>
                                                <span>15,000 pts</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Points Summary -->
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h6 class="mb-0">Points Summary</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between mb-2">
                                                <span>Current Points</span>
                                                <strong class="text-warning">5,240</strong>
                                            </div>
                                            <div class="d-flex justify-content-between mb-2">
                                                <span>Points Expiring Soon</span>
                                                <strong class="text-danger">240 (31 Dec 2024)</strong>
                                            </div>
                                            <div class="d-flex justify-content-between mb-2">
                                                <span>Total Earned</span>
                                                <strong class="text-success">6,850</strong>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <span>Total Redeemed</span>
                                                <strong class="text-info">1,610</strong>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="mb-3">
                                            <small class="text-muted d-block mb-2">Points Value</small>
                                            <div class="d-flex justify-content-between">
                                                <span>1 Point =</span>
                                                <strong>Rs1.00</strong>
                                            </div>
                                        </div>
                                        <button class="btn btn-warning btn-block">Redeem Points</button>
                                    </div>
                                </div>

                                <!-- Quick Points Actions -->
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="mb-0">Quick Actions</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label">Add/Subtract Points</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control" placeholder="Points">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-success">Add</button>
                                                    <button class="btn btn-outline-danger">Subtract</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Reason</label>
                                            <textarea class="form-control" rows="2" placeholder="Enter reason for points adjustment"></textarea>
                                        </div>
                                        <button class="btn btn-primary btn-block">Update Points</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Addresses Tab -->
                    <div class="tab-pane fade" id="addresses" role="tabpanel">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="card mb-4">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0">Customer Addresses</h6>
                                        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addAddressModal">
                                            <i class="las la-plus mr-1"></i>Add Address
                                        </button>
                                    </div>
                                    <div class="card-body">
                                        <!-- Default Address -->
                                        <div class="card border-success mb-4">
                                            <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                                                <div>
                                                    <i class="las la-home mr-2"></i>
                                                    <strong>Home Address (Default)</strong>
                                                </div>
                                                <div>
                                                    <button class="btn btn-sm btn-light mr-2"><i class="las la-edit"></i></button>
                                                    <button class="btn btn-sm btn-light"><i class="las la-trash"></i></button>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <p class="mb-1">123, Main Street</p>
                                                        <p class="mb-1">Near City Mall</p>
                                                        <p class="mb-1">Mumbai - 400001</p>
                                                        <p class="mb-1">Maharashtra, India</p>
                                                        <p class="mb-1"><i class="las la-phone"></i> +91 98765 43210</p>
                                                    </div>
                                                    <div class="col-md-4 text-right">
                                                        <span class="badge badge-success">Default</span>
                                                        <span class="badge badge-primary">Home</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Other Addresses -->
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="card h-100 border">
                                                    <div class="card-header d-flex justify-content-between align-items-center">
                                                        <div>
                                                            <i class="las la-briefcase mr-2"></i>
                                                            <strong>Office Address</strong>
                                                        </div>
                                                        <div>
                                                            <button class="btn btn-sm btn-outline-primary mr-2"><i class="las la-edit"></i></button>
                                                            <button class="btn btn-sm btn-outline-danger"><i class="las la-trash"></i></button>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <p class="mb-1">456, Business Tower</p>
                                                        <p class="mb-1">Bandra Kurla Complex</p>
                                                        <p class="mb-1">Mumbai - 400051</p>
                                                        <p class="mb-1">Maharashtra, India</p>
                                                        <p class="mb-1"><i class="las la-phone"></i> +91 98765 12345</p>
                                                        <div class="mt-3">
                                                            <span class="badge badge-info">Work</span>
                                                            <button class="btn btn-sm btn-outline-success btn-block mt-2">Set as Default</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="card h-100 border">
                                                    <div class="card-header d-flex justify-content-between align-items-center">
                                                        <div>
                                                            <i class="las la-shipping-fast mr-2"></i>
                                                            <strong>Shipping Address</strong>
                                                        </div>
                                                        <div>
                                                            <button class="btn btn-sm btn-outline-primary mr-2"><i class="las la-edit"></i></button>
                                                            <button class="btn btn-sm btn-outline-danger"><i class="las la-trash"></i></button>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <p class="mb-1">789, Riverside Apartments</p>
                                                        <p class="mb-1">Worli Sea Face</p>
                                                        <p class="mb-1">Mumbai - 400018</p>
                                                        <p class="mb-1">Maharashtra, India</p>
                                                        <p class="mb-1"><i class="las la-phone"></i> +91 98765 67890</p>
                                                        <div class="mt-3">
                                                            <span class="badge badge-warning">Shipping</span>
                                                            <button class="btn btn-sm btn-outline-success btn-block mt-2">Set as Default</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <!-- Address Statistics -->
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h6 class="mb-0">Address Statistics</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between mb-2">
                                                <span>Total Addresses</span>
                                                <strong>3</strong>
                                            </div>
                                            <div class="d-flex justify-content-between mb-2">
                                                <span>Default Address</span>
                                                <strong>Home Address</strong>
                                            </div>
                                            <div class="d-flex justify-content-between mb-2">
                                                <span>Most Used for Shipping</span>
                                                <strong>Home Address</strong>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <span>Last Added</span>
                                                <strong>15 Aug 2024</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Add Address Form -->
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="mb-0">Add New Address</h6>
                                    </div>
                                    <div class="card-body">
                                        <form>
                                            <div class="form-group">
                                                <label class="form-label">Address Type</label>
                                                <select class="form-control">
                                                    <option value="home">Home</option>
                                                    <option value="work">Work</option>
                                                    <option value="billing">Billing</option>
                                                    <option value="shipping">Shipping</option>
                                                    <option value="other">Other</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Address Line 1</label>
                                                <input type="text" class="form-control" placeholder="Street address, P.O. Box">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Address Line 2</label>
                                                <input type="text" class="form-control" placeholder="Apartment, suite, unit, building, floor">
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">City</label>
                                                        <input type="text" class="form-control" placeholder="City">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">State</label>
                                                        <input type="text" class="form-control" placeholder="State">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Pincode</label>
                                                        <input type="text" class="form-control" placeholder="Pincode">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Country</label>
                                                        <select class="form-control">
                                                            <option value="IN" selected>India</option>
                                                            <option value="US">United States</option>
                                                            <option value="UK">United Kingdom</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox" class="custom-control-input" id="setDefaultAddress">
                                                <label class="custom-control-label" for="setDefaultAddress">Set as default address</label>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-block">Save Address</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Activity Tab -->
                    <div class="tab-pane fade" id="activity" role="tabpanel">
                        <div class="row">
                            <div class="col-lg-8">
                                <!-- Activity Timeline -->
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="mb-0">Recent Activity</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="activity-timeline">
                                            <!-- Activity 1 -->
                                            <div class="activity-item mb-4 position-relative">
                                                <div class="activity-dot"></div>
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <h6 class="mb-1">New Purchase</h6>
                                                        <p class="mb-0">Invoice #INV-2024-001245 for Rs4,127</p>
                                                    </div>
                                                    <div class="text-right">
                                                        <small class="text-muted">15 Nov 2024, 14:30</small>
                                                        <div class="mt-1">
                                                            <span class="badge badge-success">Completed</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Activity 2 -->
                                            <div class="activity-item mb-4 position-relative">
                                                <div class="activity-dot"></div>
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <h6 class="mb-1">Customer Profile Updated</h6>
                                                        <p class="mb-0">Updated phone number and preferences</p>
                                                    </div>
                                                    <div class="text-right">
                                                        <small class="text-muted">12 Nov 2024, 11:15</small>
                                                        <div class="mt-1">
                                                            <span class="badge badge-info">Updated</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Activity 3 -->
                                            <div class="activity-item mb-4 position-relative">
                                                <div class="activity-dot"></div>
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <h6 class="mb-1">Points Redemption</h6>
                                                        <p class="mb-0">Redeemed 1,000 points for discount</p>
                                                    </div>
                                                    <div class="text-right">
                                                        <small class="text-muted">01 Nov 2024, 16:45</small>
                                                        <div class="mt-1">
                                                            <span class="badge badge-warning">Redeemed</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Activity 4 -->
                                            <div class="activity-item mb-4 position-relative">
                                                <div class="activity-dot"></div>
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <h6 class="mb-1">Birthday Points Added</h6>
                                                        <p class="mb-0">500 bonus points added for birthday</p>
                                                    </div>
                                                    <div class="text-right">
                                                        <small class="text-muted">05 Nov 2024, 09:00</small>
                                                        <div class="mt-1">
                                                            <span class="badge badge-success">Added</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Activity 5 -->
                                            <div class="activity-item mb-4 position-relative">
                                                <div class="activity-dot"></div>
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <h6 class="mb-1">Email Campaign Sent</h6>
                                                        <p class="mb-0">Seasonal sale announcement email sent</p>
                                                    </div>
                                                    <div class="text-right">
                                                        <small class="text-muted">30 Oct 2024, 10:30</small>
                                                        <div class="mt-1">
                                                            <span class="badge badge-primary">Sent</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Activity 6 -->
                                            <div class="activity-item mb-4 position-relative">
                                                <div class="activity-dot"></div>
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <h6 class="mb-1">Tier Upgraded</h6>
                                                        <p class="mb-0">Customer upgraded to Platinum tier</p>
                                                    </div>
                                                    <div class="text-right">
                                                        <small class="text-muted">15 Oct 2024, 14:20</small>
                                                        <div class="mt-1">
                                                            <span class="badge badge-warning">Upgraded</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Activity 7 -->
                                            <div class="activity-item position-relative">
                                                <div class="activity-dot"></div>
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <h6 class="mb-1">Large Purchase</h6>
                                                        <p class="mb-0">Invoice #INV-2024-001205 for Rs6,820</p>
                                                    </div>
                                                    <div class="text-right">
                                                        <small class="text-muted">20 Oct 2024, 17:15</small>
                                                        <div class="mt-1">
                                                            <span class="badge badge-success">Completed</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <!-- Communication History -->
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h6 class="mb-0">Communication History</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between mb-2">
                                                <span>Total Emails Sent</span>
                                                <strong>24</strong>
                                            </div>
                                            <div class="d-flex justify-content-between mb-2">
                                                <span>SMS Sent</span>
                                                <strong>18</strong>
                                            </div>
                                            <div class="d-flex justify-content-between mb-2">
                                                <span>Phone Calls</span>
                                                <strong>6</strong>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <span>Last Communication</span>
                                                <strong>15 Nov 2024</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Quick Communication -->
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="mb-0">Quick Communication</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label class="form-label">Message Type</label>
                                            <select class="form-control">
                                                <option value="email">Email</option>
                                                <option value="sms">SMS</option>
                                                <option value="whatsapp">WhatsApp</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Subject</label>
                                            <input type="text" class="form-control" placeholder="Message subject">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Message</label>
                                            <textarea class="form-control" rows="3" placeholder="Enter your message"></textarea>
                                        </div>
                                        <button class="btn btn-primary btn-block">Send Message</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Notes Tab -->
                    <div class="tab-pane fade" id="notes" role="tabpanel">
                        <div class="row">
                            <div class="col-lg-8">
                                <!-- Internal Notes -->
                                <div class="card mb-4">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0">Internal Notes</h6>
                                        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addNoteModal">
                                            <i class="las la-plus mr-1"></i>Add Note
                                        </button>
                                    </div>
                                    <div class="card-body">
                                        <!-- Note 1 -->
                                        <div class="card mb-3 border-left-primary">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between mb-2">
                                                    <div>
                                                        <strong>Sarah Johnson</strong>
                                                        <small class="text-muted ml-2">Sales Manager</small>
                                                    </div>
                                                    <small class="text-muted">15 Nov 2024, 15:30</small>
                                                </div>
                                                <p class="mb-0">Customer requested special attention for upcoming wedding season. Will need formal wear and accessories. Promised to bring in his family for shopping next week.</p>
                                                <div class="mt-2">
                                                    <span class="badge badge-light">Follow-up</span>
                                                    <span class="badge badge-light">Wedding</span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Note 2 -->
                                        <div class="card mb-3 border-left-success">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between mb-2">
                                                    <div>
                                                        <strong>Mike Chen</strong>
                                                        <small class="text-muted ml-2">Customer Support</small>
                                                    </div>
                                                    <small class="text-muted">12 Nov 2024, 11:15</small>
                                                </div>
                                                <p class="mb-0">Customer called to inquire about return policy for a recent purchase. Was satisfied with the explanation. Also asked about upcoming winter collection launch.</p>
                                                <div class="mt-2">
                                                    <span class="badge badge-light">Support</span>
                                                    <span class="badge badge-light">Inquiry</span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Note 3 -->
                                        <div class="card mb-3 border-left-warning">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between mb-2">
                                                    <div>
                                                        <strong>Emma Wilson</strong>
                                                        <small class="text-muted ml-2">Marketing</small>
                                                    </div>
                                                    <small class="text-muted">05 Nov 2024, 14:20</small>
                                                </div>
                                                <p class="mb-0">Customer responded positively to birthday email campaign. Redeemed birthday points and made additional purchase. Good candidate for referral program.</p>
                                                <div class="mt-2">
                                                    <span class="badge badge-light">Birthday</span>
                                                    <span class="badge badge-light">Campaign</span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Note 4 -->
                                        <div class="card border-left-info">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between mb-2">
                                                    <div>
                                                        <strong>David Lee</strong>
                                                        <small class="text-muted ml-2">Store Manager</small>
                                                    </div>
                                                    <small class="text-muted">15 Oct 2024, 16:45</small>
                                                </div>
                                                <p class="mb-0">Customer reached Platinum tier today. Sent congratulations email and offered personal shopper service. He seemed very pleased with the recognition.</p>
                                                <div class="mt-2">
                                                    <span class="badge badge-light">Tier Upgrade</span>
                                                    <span class="badge badge-light">VIP</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <!-- Add New Note -->
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h6 class="mb-0">Add New Note</h6>
                                    </div>
                                    <div class="card-body">
                                        <form>
                                            <div class="form-group">
                                                <label class="form-label">Note Type</label>
                                                <select class="form-control">
                                                    <option value="general">General Note</option>
                                                    <option value="followup">Follow-up</option>
                                                    <option value="complaint">Complaint</option>
                                                    <option value="compliment">Compliment</option>
                                                    <option value="preference">Preference</option>
                                                    <option value="other">Other</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Priority</label>
                                                <select class="form-control">
                                                    <option value="low">Low</option>
                                                    <option value="medium" selected>Medium</option>
                                                    <option value="high">High</option>
                                                    <option value="urgent">Urgent</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Note</label>
                                                <textarea class="form-control" rows="5" placeholder="Enter your note here..."></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Tags</label>
                                                <input type="text" class="form-control" placeholder="Add tags separated by commas">
                                            </div>
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox" class="custom-control-input" id="privateNote">
                                                <label class="custom-control-label" for="privateNote">Private note (visible only to you)</label>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-block">Save Note</button>
                                        </form>
                                    </div>
                                </div>

                                <!-- Note Statistics -->
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="mb-0">Note Statistics</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between mb-2">
                                                <span>Total Notes</span>
                                                <strong>12</strong>
                                            </div>
                                            <div class="d-flex justify-content-between mb-2">
                                                <span>Your Notes</span>
                                                <strong>4</strong>
                                            </div>
                                            <div class="d-flex justify-content-between mb-2">
                                                <span>Last Note Added</span>
                                                <strong>15 Nov 2024</strong>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <span>Most Common Tag</span>
                                                <strong>Follow-up</strong>
                                            </div>
                                        </div>
                                        <hr>
                                        <div>
                                            <small class="text-muted d-block mb-2">Recent Tags</small>
                                            <span class="badge badge-light mr-1 mb-1">Follow-up</span>
                                            <span class="badge badge-light mr-1 mb-1">VIP</span>
                                            <span class="badge badge-light mr-1 mb-1">Wedding</span>
                                            <span class="badge badge-light mr-1 mb-1">Birthday</span>
                                            <span class="badge badge-light mr-1 mb-1">Support</span>
                                            <span class="badge badge-light mb-1">Campaign</span>
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

    <!-- Add Address Modal -->
    <div class="modal fade" id="addAddressModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Address</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form content would go here -->
                    <p class="text-center text-muted py-5">
                        Address form would be displayed here
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Save Address</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Note Modal -->
    <div class="modal fade" id="addNoteModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Internal Note</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form content would go here -->
                    <p class="text-center text-muted py-5">
                        Note form would be displayed here
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Save Note</button>
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
            // Tab functionality
            $('#customerDetailTab a').on('click', function(e) {
                e.preventDefault();
                $(this).tab('show');
            });

            // Initialize tooltips
            $('[title]').tooltip();

            // Print invoice button
            $('.btn-print').on('click', function(e) {
                e.preventDefault();
                alert('Print functionality would be implemented here');
            });

            // View invoice button
            $('.btn-view').on('click', function(e) {
                e.preventDefault();
                alert('View invoice functionality would be implemented here');
            });

            // Set default address button
            $('.btn-set-default').on('click', function() {
                if (confirm('Set this as the default address?')) {
                    $(this).closest('.card').find('.badge-default').removeClass('badge-success').addClass('badge-secondary').text('Click to set as default');
                    $(this).addClass('btn-success').removeClass('btn-outline-success').text('Default Address');
                    alert('Address set as default');
                }
            });

            // Delete address button
            $('.btn-delete-address').on('click', function(e) {
                e.stopPropagation();
                if (confirm('Are you sure you want to delete this address?')) {
                    $(this).closest('.card').fadeOut();
                }
            });

            // Points adjustment
            $('.btn-add-points').on('click', function() {
                const points = $(this).closest('.input-group').find('input').val();
                if (points && points > 0) {
                    alert(`Adding ${points} points to customer`);
                }
            });

            $('.btn-subtract-points').on('click', function() {
                const points = $(this).closest('.input-group').find('input').val();
                if (points && points > 0) {
                    alert(`Subtracting ${points} points from customer`);
                }
            });

            // Redeem points button
            $('.btn-redeem-points').on('click', function() {
                alert('Points redemption functionality would be implemented here');
            });
        });
    </script>
    @endpush
</x-app-layout>