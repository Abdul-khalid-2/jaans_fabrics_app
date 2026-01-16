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
                <h4 class="mb-3">Loyalty Program Tracking</h4>
                <p class="mb-0">Monitor customer loyalty points, rewards, and program performance</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#">Reports</a></li>
                        <li class="breadcrumb-item"><a href="#">Customer Reports</a></li>
                        <li class="breadcrumb-item active">Loyalty Tracking</li>
                    </ol>
                </nav>
            </div>
            <div>
                <button class="btn btn-outline-primary" onclick="exportLoyaltyReport()">
                    <i class="las la-file-excel mr-2"></i>Export
                </button>
                <button class="btn btn-primary ml-2" onclick="printLoyaltyReport()">
                    <i class="las la-print mr-2"></i>Print
                </button>
                <button class="btn btn-success ml-2" onclick="runLoyaltyCampaign()">
                    <i class="las la-bullhorn mr-2"></i>Run Campaign
                </button>
            </div>
        </div>

        <!-- Loyalty Program Stats -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Loyalty Members</div>
                                <div class="h3 mb-0 font-weight-bold text-gray-800">856</div>
                                <div class="mt-2 text-muted small">Active members</div>
                            </div>
                            <div class="col-auto">
                                <i class="las la-crown fa-2x text-primary"></i>
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
                                    Total Points Issued</div>
                                <div class="h3 mb-0 font-weight-bold text-gray-800">245,680</div>
                                <div class="mt-2 text-muted small">This year</div>
                            </div>
                            <div class="col-auto">
                                <i class="las la-star fa-2x text-success"></i>
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
                                    Points Redeemed</div>
                                <div class="h3 mb-0 font-weight-bold text-gray-800">85,420</div>
                                <div class="mt-2 text-muted small">34.8% redemption rate</div>
                            </div>
                            <div class="col-auto">
                                <i class="las la-gift fa-2x text-warning"></i>
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
                                    Rewards Value</div>
                                <div class="h3 mb-0 font-weight-bold text-gray-800">Rs 42,580</div>
                                <div class="mt-2 text-muted small">Total rewards issued</div>
                            </div>
                            <div class="col-auto">
                                <i class="las la-rupee-sign fa-2x text-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Loyalty Program Overview -->
        <div class="row mb-4">
            <div class="col-lg-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Loyalty Points Trend</h6>
                        <div class="dropdown">
                            <select class="form-control form-control-sm" id="pointsTrendFilter">
                                <option value="monthly">Monthly</option>
                                <option value="quarterly">Quarterly</option>
                                <option value="yearly">Yearly</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="pointsTrendChart" height="250"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Member Distribution by Tier</h6>
                    </div>
                    <div class="card-body">
                        <canvas id="tierDistributionChart" height="250"></canvas>
                        <div class="mt-4">
                            <div class="row text-center">
                                <div class="col-6">
                                    <div class="h4 font-weight-bold">15%</div>
                                    <small class="text-muted">Platinum Members</small>
                                </div>
                                <div class="col-6">
                                    <div class="h4 font-weight-bold">45%</div>
                                    <small class="text-muted">Generate 65% Revenue</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Loyalty Program Settings -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Loyalty Program Rules</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card border-left-success h-100">
                            <div class="card-body">
                                <h6 class="font-weight-bold text-success">Points Earning</h6>
                                <div class="mt-3">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Rs 1 Spent =</span>
                                        <span class="font-weight-bold">1 Point</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Bonus on First Purchase</span>
                                        <span class="font-weight-bold">500 Points</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Birthday Bonus</span>
                                        <span class="font-weight-bold">1000 Points</span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span>Referral Bonus</span>
                                        <span class="font-weight-bold">2000 Points</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="card border-left-warning h-100">
                            <div class="card-body">
                                <h6 class="font-weight-bold text-warning">Tier Requirements</h6>
                                <div class="mt-3">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span><span class="badge badge-dark">Bronze</span></span>
                                        <span class="font-weight-bold">0-4,999 Points</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span><span class="badge badge-secondary">Silver</span></span>
                                        <span class="font-weight-bold">5,000-14,999 Points</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span><span class="badge badge-warning">Gold</span></span>
                                        <span class="font-weight-bold">15,000-49,999 Points</span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span><span class="badge badge-primary">Platinum</span></span>
                                        <span class="font-weight-bold">50,000+ Points</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="card border-left-info h-100">
                            <div class="card-body">
                                <h6 class="font-weight-bold text-info">Rewards Redemption</h6>
                                <div class="mt-3">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>100 Points =</span>
                                        <span class="font-weight-bold">Rs 10 Discount</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Minimum Redemption</span>
                                        <span class="font-weight-bold">1000 Points</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Points Expiry</span>
                                        <span class="font-weight-bold">12 Months</span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span>Max Redemption/Order</span>
                                        <span class="font-weight-bold">5000 Points</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top Loyalty Members -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Top Loyalty Members</h6>
                <div class="dropdown">
                    <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" id="topMembersOptions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="las la-filter"></i> Filter By
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="topMembersOptions">
                        <a class="dropdown-item" href="#" onclick="filterByPoints()">Highest Points</a>
                        <a class="dropdown-item" href="#" onclick="filterByRedemption()">Most Redemptions</a>
                        <a class="dropdown-item" href="#" onclick="filterByTier('platinum')">Platinum Only</a>
                        <a class="dropdown-item" href="#" onclick="filterByTier('gold')">Gold Only</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" onclick="showAllMembers()">Show All</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="loyaltyMembersTable" width="100%" cellspacing="0">
                        <thead class="thead-light">
                            <tr>
                                <th>Member</th>
                                <th>Member Since</th>
                                <th class="text-right">Total Points</th>
                                <th class="text-right">Points Earned</th>
                                <th class="text-right">Points Redeemed</th>
                                <th class="text-right">Points Balance</th>
                                <th class="text-right">Rewards Value</th>
                                <th>Current Tier</th>
                                <th>Next Tier</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Member 1 -->
                            <tr data-tier="platinum">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm mr-2">
                                            <span class="avatar-title rounded-circle bg-primary text-white">
                                                J
                                            </span>
                                        </div>
                                        <div>
                                            <div class="font-weight-bold">John Doe</div>
                                            <small class="text-muted">MEMBER-001</small>
                                        </div>
                                    </div>
                                </td>
                                <td>15-06-2023</td>
                                <td class="text-right font-weight-bold">45,280</td>
                                <td class="text-right text-success">48,750</td>
                                <td class="text-right text-warning">12,450</td>
                                <td class="text-right font-weight-bold text-primary">36,300</td>
                                <td class="text-right font-weight-bold text-success">Rs 1,245</td>
                                <td>
                                    <span class="badge badge-primary">Platinum</span>
                                </td>
                                <td>
                                    <div class="small">
                                        <div class="font-weight-bold">Max</div>
                                        <div class="text-muted">0 points needed</div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-success">Active</span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-primary" onclick="viewMember(1)">
                                            <i class="las la-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-success" onclick="addPoints(1)">
                                            <i class="las la-plus"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-warning" onclick="redeemPoints(1)">
                                            <i class="las la-gift"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            
                            <!-- Member 2 -->
                            <tr data-tier="gold">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm mr-2">
                                            <span class="avatar-title rounded-circle bg-primary text-white">
                                                J
                                            </span>
                                        </div>
                                        <div>
                                            <div class="font-weight-bold">Jane Smith</div>
                                            <small class="text-muted">MEMBER-002</small>
                                        </div>
                                    </div>
                                </td>
                                <td>22-03-2023</td>
                                <td class="text-right font-weight-bold">32,150</td>
                                <td class="text-right text-success">35,820</td>
                                <td class="text-right text-warning">8,430</td>
                                <td class="text-right font-weight-bold text-primary">27,390</td>
                                <td class="text-right font-weight-bold text-success">Rs 843</td>
                                <td>
                                    <span class="badge badge-warning">Gold</span>
                                </td>
                                <td>
                                    <div class="small">
                                        <div class="font-weight-bold">Platinum</div>
                                        <div class="text-muted">22,610 points needed</div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-success">Active</span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-primary" onclick="viewMember(2)">
                                            <i class="las la-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-success" onclick="addPoints(2)">
                                            <i class="las la-plus"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-warning" onclick="redeemPoints(2)">
                                            <i class="las la-gift"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            
                            <!-- Member 3 -->
                            <tr data-tier="silver">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm mr-2">
                                            <span class="avatar-title rounded-circle bg-primary text-white">
                                                R
                                            </span>
                                        </div>
                                        <div>
                                            <div class="font-weight-bold">Robert Johnson</div>
                                            <small class="text-muted">MEMBER-003</small>
                                        </div>
                                    </div>
                                </td>
                                <td>10-09-2023</td>
                                <td class="text-right font-weight-bold">12,850</td>
                                <td class="text-right text-success">14,320</td>
                                <td class="text-right text-warning">2,150</td>
                                <td class="text-right font-weight-bold text-primary">12,170</td>
                                <td class="text-right font-weight-bold text-success">Rs 215</td>
                                <td>
                                    <span class="badge badge-secondary">Silver</span>
                                </td>
                                <td>
                                    <div class="small">
                                        <div class="font-weight-bold">Gold</div>
                                        <div class="text-muted">2,830 points needed</div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-success">Active</span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-primary" onclick="viewMember(3)">
                                            <i class="las la-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-success" onclick="addPoints(3)">
                                            <i class="las la-plus"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-warning" onclick="redeemPoints(3)">
                                            <i class="las la-gift"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            
                            <!-- Member 4 -->
                            <tr data-tier="platinum">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm mr-2">
                                            <span class="avatar-title rounded-circle bg-primary text-white">
                                                S
                                            </span>
                                        </div>
                                        <div>
                                            <div class="font-weight-bold">Sarah Williams</div>
                                            <small class="text-muted">MEMBER-004</small>
                                        </div>
                                    </div>
                                </td>
                                <td>05-12-2022</td>
                                <td class="text-right font-weight-bold">68,420</td>
                                <td class="text-right text-success">72,150</td>
                                <td class="text-right text-warning">25,730</td>
                                <td class="text-right font-weight-bold text-primary">46,420</td>
                                <td class="text-right font-weight-bold text-success">Rs 2,573</td>
                                <td>
                                    <span class="badge badge-primary">Platinum</span>
                                </td>
                                <td>
                                    <span class="badge badge-success">Max Tier</span>
                                </td>
                                <td>
                                    <span class="badge badge-success">Active</span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-primary" onclick="viewMember(4)">
                                            <i class="las la-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-success" onclick="addPoints(4)">
                                            <i class="las la-plus"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-warning" onclick="redeemPoints(4)">
                                            <i class="las la-gift"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            
                            <!-- Member 5 -->
                            <tr data-tier="gold">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm mr-2">
                                            <span class="avatar-title rounded-circle bg-primary text-white">
                                                M
                                            </span>
                                        </div>
                                        <div>
                                            <div class="font-weight-bold">Michael Brown</div>
                                            <small class="text-muted">MEMBER-005</small>
                                        </div>
                                    </div>
                                </td>
                                <td>18-04-2023</td>
                                <td class="text-right font-weight-bold">28,750</td>
                                <td class="text-right text-success">31,420</td>
                                <td class="text-right text-warning">6,850</td>
                                <td class="text-right font-weight-bold text-primary">24,570</td>
                                <td class="text-right font-weight-bold text-success">Rs 685</td>
                                <td>
                                    <span class="badge badge-warning">Gold</span>
                                </td>
                                <td>
                                    <div class="small">
                                        <div class="font-weight-bold">Platinum</div>
                                        <div class="text-muted">25,430 points needed</div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-success">Active</span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-primary" onclick="viewMember(5)">
                                            <i class="las la-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-success" onclick="addPoints(5)">
                                            <i class="las la-plus"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-warning" onclick="redeemPoints(5)">
                                            <i class="las la-gift"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            
                            <!-- Member 6 -->
                            <tr data-tier="silver">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm mr-2">
                                            <span class="avatar-title rounded-circle bg-primary text-white">
                                                E
                                            </span>
                                        </div>
                                        <div>
                                            <div class="font-weight-bold">Emily Davis</div>
                                            <small class="text-muted">MEMBER-006</small>
                                        </div>
                                    </div>
                                </td>
                                <td>30-07-2023</td>
                                <td class="text-right font-weight-bold">8,420</td>
                                <td class="text-right text-success">9,150</td>
                                <td class="text-right text-warning">1,850</td>
                                <td class="text-right font-weight-bold text-primary">7,300</td>
                                <td class="text-right font-weight-bold text-success">Rs 185</td>
                                <td>
                                    <span class="badge badge-secondary">Silver</span>
                                </td>
                                <td>
                                    <div class="small">
                                        <div class="font-weight-bold">Gold</div>
                                        <div class="text-muted">7,700 points needed</div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-success">Active</span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-primary" onclick="viewMember(6)">
                                            <i class="las la-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-success" onclick="addPoints(6)">
                                            <i class="las la-plus"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-warning" onclick="redeemPoints(6)">
                                            <i class="las la-gift"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            
                            <!-- Member 7 -->
                            <tr data-tier="bronze">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm mr-2">
                                            <span class="avatar-title rounded-circle bg-primary text-white">
                                                D
                                            </span>
                                        </div>
                                        <div>
                                            <div class="font-weight-bold">David Wilson</div>
                                            <small class="text-muted">MEMBER-007</small>
                                        </div>
                                    </div>
                                </td>
                                <td>12-10-2023</td>
                                <td class="text-right font-weight-bold">3,250</td>
                                <td class="text-right text-success">3,850</td>
                                <td class="text-right text-warning">420</td>
                                <td class="text-right font-weight-bold text-primary">3,430</td>
                                <td class="text-right font-weight-bold text-success">Rs 42</td>
                                <td>
                                    <span class="badge badge-dark">Bronze</span>
                                </td>
                                <td>
                                    <div class="small">
                                        <div class="font-weight-bold">Silver</div>
                                        <div class="text-muted">1,570 points needed</div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-success">Active</span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-primary" onclick="viewMember(7)">
                                            <i class="las la-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-success" onclick="addPoints(7)">
                                            <i class="las la-plus"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-warning" onclick="redeemPoints(7)">
                                            <i class="las la-gift"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            
                            <!-- Member 8 -->
                            <tr data-tier="platinum">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm mr-2">
                                            <span class="avatar-title rounded-circle bg-primary text-white">
                                                L
                                            </span>
                                        </div>
                                        <div>
                                            <div class="font-weight-bold">Lisa Miller</div>
                                            <small class="text-muted">MEMBER-008</small>
                                        </div>
                                    </div>
                                </td>
                                <td>22-01-2023</td>
                                <td class="text-right font-weight-bold">52,180</td>
                                <td class="text-right text-success">55,420</td>
                                <td class="text-right text-warning">18,250</td>
                                <td class="text-right font-weight-bold text-primary">37,170</td>
                                <td class="text-right font-weight-bold text-success">Rs 1,825</td>
                                <td>
                                    <span class="badge badge-primary">Platinum</span>
                                </td>
                                <td>
                                    <span class="badge badge-success">Max Tier</span>
                                </td>
                                <td>
                                    <span class="badge badge-success">Active</span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-primary" onclick="viewMember(8)">
                                            <i class="las la-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-success" onclick="addPoints(8)">
                                            <i class="las la-plus"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-warning" onclick="redeemPoints(8)">
                                            <i class="las la-gift"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            
                            <!-- Member 9 -->
                            <tr data-tier="gold">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm mr-2">
                                            <span class="avatar-title rounded-circle bg-primary text-white">
                                                J
                                            </span>
                                        </div>
                                        <div>
                                            <div class="font-weight-bold">James Taylor</div>
                                            <small class="text-muted">MEMBER-009</small>
                                        </div>
                                    </div>
                                </td>
                                <td>08-05-2023</td>
                                <td class="text-right font-weight-bold">36,420</td>
                                <td class="text-right text-success">39,850</td>
                                <td class="text-right text-warning">10,280</td>
                                <td class="text-right font-weight-bold text-primary">29,570</td>
                                <td class="text-right font-weight-bold text-success">Rs 1,028</td>
                                <td>
                                    <span class="badge badge-warning">Gold</span>
                                </td>
                                <td>
                                    <div class="small">
                                        <div class="font-weight-bold">Platinum</div>
                                        <div class="text-muted">20,430 points needed</div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-success">Active</span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-primary" onclick="viewMember(9)">
                                            <i class="las la-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-success" onclick="addPoints(9)">
                                            <i class="las la-plus"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-warning" onclick="redeemPoints(9)">
                                            <i class="las la-gift"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            
                            <!-- Member 10 -->
                            <tr data-tier="silver">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm mr-2">
                                            <span class="avatar-title rounded-circle bg-primary text-white">
                                                J
                                            </span>
                                        </div>
                                        <div>
                                            <div class="font-weight-bold">Jennifer Anderson</div>
                                            <small class="text-muted">MEMBER-010</small>
                                        </div>
                                    </div>
                                </td>
                                <td>14-08-2023</td>
                                <td class="text-right font-weight-bold">15,280</td>
                                <td class="text-right text-success">16,420</td>
                                <td class="text-right text-warning">3,150</td>
                                <td class="text-right font-weight-bold text-primary">13,270</td>
                                <td class="text-right font-weight-bold text-success">Rs 315</td>
                                <td>
                                    <span class="badge badge-secondary">Silver</span>
                                </td>
                                <td>
                                    <div class="small">
                                        <div class="font-weight-bold">Gold</div>
                                        <div class="text-muted">1,730 points needed</div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-success">Active</span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-primary" onclick="viewMember(10)">
                                            <i class="las la-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-success" onclick="addPoints(10)">
                                            <i class="las la-plus"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-warning" onclick="redeemPoints(10)">
                                            <i class="las la-gift"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Points Transactions -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Recent Points Transactions</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="pointsTransactionsTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Date & Time</th>
                                <th>Member</th>
                                <th>Transaction Type</th>
                                <th>Points</th>
                                <th>Reference</th>
                                <th>Description</th>
                                <th>Balance</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Transaction 1 -->
                            <tr>
                                <td>15-01-2024 14:30</td>
                                <td>John Doe</td>
                                <td>
                                    <span class="badge badge-success">Purchase</span>
                                </td>
                                <td class="font-weight-bold text-success">+1,250</td>
                                <td>INV-2024-00123</td>
                                <td>
                                    <small class="text-muted">Purchase transaction</small>
                                </td>
                                <td class="font-weight-bold">36,300</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary" onclick="viewTransaction(1)">
                                        <i class="las la-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            
                            <!-- Transaction 2 -->
                            <tr>
                                <td>14-01-2024 11:20</td>
                                <td>Jane Smith</td>
                                <td>
                                    <span class="badge badge-warning">Redemption</span>
                                </td>
                                <td class="font-weight-bold text-danger">-2,000</td>
                                <td>RED-2024-0005</td>
                                <td>
                                    <small class="text-muted">Points redeemed for reward</small>
                                </td>
                                <td class="font-weight-bold">27,390</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary" onclick="viewTransaction(2)">
                                        <i class="las la-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            
                            <!-- Transaction 3 -->
                            <tr>
                                <td>13-01-2024 09:15</td>
                                <td>Robert Johnson</td>
                                <td>
                                    <span class="badge badge-info">Bonus</span>
                                </td>
                                <td class="font-weight-bold text-success">+500</td>
                                <td>BONUS-20240113</td>
                                <td>
                                    <small class="text-muted">Special bonus points</small>
                                </td>
                                <td class="font-weight-bold">12,170</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary" onclick="viewTransaction(3)">
                                        <i class="las la-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            
                            <!-- Transaction 4 -->
                            <tr>
                                <td>12-01-2024 16:45</td>
                                <td>Sarah Williams</td>
                                <td>
                                    <span class="badge badge-success">Purchase</span>
                                </td>
                                <td class="font-weight-bold text-success">+3,200</td>
                                <td>INV-2024-00122</td>
                                <td>
                                    <small class="text-muted">Purchase transaction</small>
                                </td>
                                <td class="font-weight-bold">46,420</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary" onclick="viewTransaction(4)">
                                        <i class="las la-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            
                            <!-- Transaction 5 -->
                            <tr>
                                <td>11-01-2024 10:10</td>
                                <td>Michael Brown</td>
                                <td>
                                    <span class="badge badge-secondary">Adjustment</span>
                                </td>
                                <td class="font-weight-bold text-success">+1,000</td>
                                <td>ADJ-20240111</td>
                                <td>
                                    <small class="text-muted">Manual adjustment</small>
                                </td>
                                <td class="font-weight-bold">24,570</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary" onclick="viewTransaction(5)">
                                        <i class="las la-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            
                            <!-- Transaction 6 -->
                            <tr>
                                <td>10-01-2024 15:30</td>
                                <td>Emily Davis</td>
                                <td>
                                    <span class="badge badge-danger">Expiry</span>
                                </td>
                                <td class="font-weight-bold text-danger">-150</td>
                                <td>EXP-20240110</td>
                                <td>
                                    <small class="text-muted">Points expired</small>
                                </td>
                                <td class="font-weight-bold">7,300</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary" onclick="viewTransaction(6)">
                                        <i class="las la-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            
                            <!-- Transaction 7 -->
                            <tr>
                                <td>09-01-2024 12:25</td>
                                <td>David Wilson</td>
                                <td>
                                    <span class="badge badge-success">Purchase</span>
                                </td>
                                <td class="font-weight-bold text-success">+850</td>
                                <td>INV-2024-00121</td>
                                <td>
                                    <small class="text-muted">Purchase transaction</small>
                                </td>
                                <td class="font-weight-bold">3,430</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary" onclick="viewTransaction(7)">
                                        <i class="las la-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            
                            <!-- Transaction 8 -->
                            <tr>
                                <td>08-01-2024 14:15</td>
                                <td>Lisa Miller</td>
                                <td>
                                    <span class="badge badge-warning">Redemption</span>
                                </td>
                                <td class="font-weight-bold text-danger">-5,000</td>
                                <td>RED-2024-0004</td>
                                <td>
                                    <small class="text-muted">Points redeemed for reward</small>
                                </td>
                                <td class="font-weight-bold">37,170</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary" onclick="viewTransaction(8)">
                                        <i class="las la-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            
                            <!-- Transaction 9 -->
                            <tr>
                                <td>07-01-2024 11:40</td>
                                <td>James Taylor</td>
                                <td>
                                    <span class="badge badge-info">Bonus</span>
                                </td>
                                <td class="font-weight-bold text-success">+1,000</td>
                                <td>BONUS-20240107</td>
                                <td>
                                    <small class="text-muted">Birthday bonus points</small>
                                </td>
                                <td class="font-weight-bold">29,570</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary" onclick="viewTransaction(9)">
                                        <i class="las la-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            
                            <!-- Transaction 10 -->
                            <tr>
                                <td>06-01-2024 16:20</td>
                                <td>Jennifer Anderson</td>
                                <td>
                                    <span class="badge badge-success">Purchase</span>
                                </td>
                                <td class="font-weight-bold text-success">+2,100</td>
                                <td>INV-2024-00120</td>
                                <td>
                                    <small class="text-muted">Purchase transaction</small>
                                </td>
                                <td class="font-weight-bold">13,270</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary" onclick="viewTransaction(10)">
                                        <i class="las la-eye"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Rewards Redemption Analysis -->
        <div class="row">
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Rewards Redemption Summary</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Reward Type</th>
                                        <th>Points Required</th>
                                        <th>Redemptions</th>
                                        <th>Total Points</th>
                                        <th>Success Rate</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="font-weight-bold">Rs 100 Discount</td>
                                        <td>1,000</td>
                                        <td class="font-weight-bold">45</td>
                                        <td class="text-success">45,000</td>
                                        <td>
                                            <span class="badge badge-success">92%</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Rs 500 Discount</td>
                                        <td>5,000</td>
                                        <td class="font-weight-bold">18</td>
                                        <td class="text-success">90,000</td>
                                        <td>
                                            <span class="badge badge-warning">78%</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Free Product</td>
                                        <td>10,000</td>
                                        <td class="font-weight-bold">12</td>
                                        <td class="text-success">120,000</td>
                                        <td>
                                            <span class="badge badge-success">85%</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Free Shipping</td>
                                        <td>2,000</td>
                                        <td class="font-weight-bold">28</td>
                                        <td class="text-success">56,000</td>
                                        <td>
                                            <span class="badge badge-success">88%</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">VIP Service</td>
                                        <td>15,000</td>
                                        <td class="font-weight-bold">8</td>
                                        <td class="text-success">120,000</td>
                                        <td>
                                            <span class="badge badge-danger">72%</span>
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
                        <h6 class="m-0 font-weight-bold text-primary">Loyalty Program Performance</h6>
                    </div>
                    <div class="card-body">
                        <canvas id="loyaltyPerformanceChart" height="200"></canvas>
                        <div class="mt-3">
                            <div class="row text-center">
                                <div class="col-4">
                                    <div class="h5 font-weight-bold">24.5%</div>
                                    <small class="text-muted">Member Growth</small>
                                </div>
                                <div class="col-4">
                                    <div class="h5 font-weight-bold">34.8%</div>
                                    <small class="text-muted">Redemption Rate</small>
                                </div>
                                <div class="col-4">
                                    <div class="h5 font-weight-bold">42.5%</div>
                                    <small class="text-muted">Revenue from Members</small>
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
        $('#loyaltyMembersTable').DataTable({
            pageLength: 10,
            ordering: true,
            order: [[2, 'desc']], // Sort by Total Points
            dom: '<"top"f>rt<"bottom"lip><"clear">'
        });
        
        $('#pointsTransactionsTable').DataTable({
            pageLength: 10,
            ordering: true,
            order: [[0, 'desc']], // Sort by Date
            dom: '<"top"f>rt<"bottom"lip><"clear">'
        });
        
        // Initialize charts
        initLoyaltyCharts();
        
        // Points trend filter
        $('#pointsTrendFilter').change(function() {
            initLoyaltyCharts();
        });
        
        function initLoyaltyCharts() {
            // Points Trend Chart
            var ctx1 = document.getElementById('pointsTrendChart').getContext('2d');
            const trendFilter = $('#pointsTrendFilter').val();
            let labels, earnedData, redeemedData;
            
            if (trendFilter === 'monthly') {
                labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                earnedData = [4500, 5200, 4800, 6100, 7200, 6800, 7500, 8200, 7800, 8500, 9200, 9800];
                redeemedData = [1500, 2200, 1800, 3100, 4200, 3800, 4500, 5200, 4800, 5500, 6200, 6800];
            } else if (trendFilter === 'quarterly') {
                labels = ['Q1', 'Q2', 'Q3', 'Q4'];
                earnedData = [14500, 22200, 27800, 31500];
                redeemedData = [5500, 11200, 14800, 17500];
            } else {
                labels = ['2020', '2021', '2022', '2023', '2024'];
                earnedData = [24500, 45200, 67800, 81500, 95600];
                redeemedData = [8500, 21200, 34800, 47500, 56800];
            }
            
            new Chart(ctx1, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Points Earned',
                        data: earnedData,
                        borderColor: 'rgba(40, 167, 69, 1)',
                        backgroundColor: 'rgba(40, 167, 69, 0.1)',
                        tension: 0.3,
                        fill: true
                    }, {
                        label: 'Points Redeemed',
                        data: redeemedData,
                        borderColor: 'rgba(255, 193, 7, 1)',
                        backgroundColor: 'rgba(255, 193, 7, 0.1)',
                        tension: 0.3,
                        fill: true
                    }]
                }
            });
            
            // Tier Distribution Chart
            var ctx2 = document.getElementById('tierDistributionChart').getContext('2d');
            new Chart(ctx2, {
                type: 'pie',
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
            
            // Loyalty Performance Chart
            var ctx3 = document.getElementById('loyaltyPerformanceChart').getContext('2d');
            new Chart(ctx3, {
                type: 'bar',
                data: {
                    labels: ['Customer Retention', 'Avg. Order Value', 'Purchase Frequency', 'Referral Rate'],
                    datasets: [{
                        label: 'Members vs Non-Members',
                        data: [42, 35, 28, 15],
                        backgroundColor: 'rgba(78, 115, 223, 0.5)',
                        borderColor: 'rgba(78, 115, 223, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100,
                            ticks: {
                                callback: function(value) {
                                    return value + '%';
                                }
                            }
                        }
                    }
                }
            });
        }
        
        window.exportLoyaltyReport = function() {
            alert('Exporting loyalty report to Excel...');
        };
        
        window.printLoyaltyReport = function() {
            window.print();
        };
        
        window.runLoyaltyCampaign = function() {
            const campaignType = prompt('Enter campaign type (Birthday/Referral/Seasonal):');
            if (campaignType) {
                alert('Launching ' + campaignType + ' loyalty campaign...');
            }
        };
        
        window.filterByPoints = function() {
            $('#loyaltyMembersTable').DataTable().order([2, 'desc']).draw();
            alert('Showing members with highest points');
        };
        
        window.filterByRedemption = function() {
            $('#loyaltyMembersTable').DataTable().order([4, 'desc']).draw();
            alert('Showing members with most redemptions');
        };
        
        window.filterByTier = function(tier) {
            const table = $('#loyaltyMembersTable').DataTable();
            table.column(7).search(tier, true, false).draw();
            alert('Showing ' + tier + ' tier members only');
        };
        
        window.showAllMembers = function() {
            $('#loyaltyMembersTable').DataTable().search('').draw();
            alert('Showing all members');
        };
        
        window.viewMember = function(memberId) {
            alert('Viewing member details for ID: ' + memberId);
            window.open('/customers/' + memberId, '_blank');
        };
        
        window.addPoints = function(memberId) {
            const points = prompt('Enter points to add:');
            if (points && !isNaN(points)) {
                alert('Adding ' + points + ' points to member ' + memberId);
            }
        };
        
        window.redeemPoints = function(memberId) {
            alert('Processing points redemption for member ' + memberId);
        };
        
        window.viewTransaction = function(transactionId) {
            alert('Viewing transaction details: ' + transactionId);
        };
    });
    </script>
    @endpush
</x-app-layout>