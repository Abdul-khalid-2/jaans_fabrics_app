<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/remixicon/fonts/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <style>
        .account-card {
            border-left: 4px solid #007bff;
            transition: all 0.3s;
        }
        .account-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .account-type-badge {
            font-size: 0.7rem;
            padding: 3px 8px;
            border-radius: 10px;
        }
        .balance-positive {
            color: #28a745;
            font-weight: 600;
        }
        .balance-negative {
            color: #dc3545;
            font-weight: 600;
        }
        .tree-view {
            margin-left: 20px;
        }
        .tree-node {
            position: relative;
            padding-left: 30px;
            margin-bottom: 10px;
        }
        .tree-node::before {
            content: "";
            position: absolute;
            left: 10px;
            top: 15px;
            width: 10px;
            height: 1px;
            background: #dee2e6;
        }
        .tree-node::after {
            content: "";
            position: absolute;
            left: 10px;
            top: 15px;
            width: 1px;
            height: calc(100% - 15px);
            background: #dee2e6;
        }
        .tree-node:last-child::after {
            display: none;
        }
    </style>
    @endpush

    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
            <div>
                <h4 class="mb-3">Chart of Accounts</h4>
                <p class="mb-0">Manage your accounting accounts and their hierarchy</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Accounts</li>
                    </ol>
                </nav>
            </div>
            <div>
                <button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#filterModal">
                    <i class="las la-filter mr-2"></i>Filter
                </button>
                <a href="{{ route('accounts.create') }}" class="btn btn-primary ml-2">
                    <i class="las la-plus mr-2"></i>Add Account
                </a>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Total Assets</h5>
                                <span class="h2 font-weight-bold mb-0">₹1,250,000</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                    <i class="las la-wallet"></i>
                                </div>
                            </div>
                        </div>
                        <p class="mt-3 mb-0 text-sm">
                            <span class="text-success mr-2"><i class="las la-arrow-up"></i> 12.5%</span>
                            <span class="text-nowrap">Since last month</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Total Liabilities</h5>
                                <span class="h2 font-weight-bold mb-0">₹850,000</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                    <i class="las la-hand-holding-usd"></i>
                                </div>
                            </div>
                        </div>
                        <p class="mt-3 mb-0 text-sm">
                            <span class="text-danger mr-2"><i class="las la-arrow-down"></i> 3.48%</span>
                            <span class="text-nowrap">Since last month</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Total Equity</h5>
                                <span class="h2 font-weight-bold mb-0">₹400,000</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                    <i class="las la-chart-line"></i>
                                </div>
                            </div>
                        </div>
                        <p class="mt-3 mb-0 text-sm">
                            <span class="text-success mr-2"><i class="las la-arrow-up"></i> 5.2%</span>
                            <span class="text-nowrap">Since last month</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Active Accounts</h5>
                                <span class="h2 font-weight-bold mb-0">48</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-primary text-white rounded-circle shadow">
                                    <i class="las la-book"></i>
                                </div>
                            </div>
                        </div>
                        <p class="mt-3 mb-0 text-sm">
                            <span class="text-success mr-2"><i class="las la-arrow-up"></i> 2</span>
                            <span class="text-nowrap">New this month</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h5 class="mb-0">Accounts List</h5>
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-outline-secondary">
                                <i class="las la-print"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-secondary">
                                <i class="las la-file-export"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Account Types Tabs -->
                        <ul class="nav nav-tabs mb-4" id="accountTypeTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="assets-tab" data-toggle="tab" href="#assets">
                                    <i class="las la-wallet mr-1"></i> Assets
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="liabilities-tab" data-toggle="tab" href="#liabilities">
                                    <i class="las la-hand-holding-usd mr-1"></i> Liabilities
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="equity-tab" data-toggle="tab" href="#equity">
                                    <i class="las la-chart-line mr-1"></i> Equity
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="revenue-tab" data-toggle="tab" href="#revenue">
                                    <i class="las la-money-bill-wave mr-1"></i> Revenue
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="expenses-tab" data-toggle="tab" href="#expenses">
                                    <i class="las la-receipt mr-1"></i> Expenses
                                </a>
                            </li>
                        </ul>

                        <!-- Tab Content -->
                        <div class="tab-content" id="accountTypeTabContent">
                            <!-- Assets Tab -->
                            <div class="tab-pane fade show active" id="assets">
                                <div class="table-responsive">
                                    <table class="table table-hover" id="assetsTable">
                                        <thead>
                                            <tr>
                                                <th>Account Code</th>
                                                <th>Account Name</th>
                                                <th>Type</th>
                                                <th>Current Balance</th>
                                                <th>Branch</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><span class="badge badge-light">1001</span></td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="mr-3">
                                                            <i class="las la-university text-primary"></i>
                                                        </div>
                                                        <div>
                                                            <h6 class="mb-0">Cash in Hand</h6>
                                                            <small class="text-muted">Main cash register</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge bg-gradient-green account-type-badge">Cash Account</span>
                                                </td>
                                                <td class="balance-positive">₹125,000</td>
                                                <td>Main Branch</td>
                                                <td>
                                                    <span class="badge badge-success">Active</span>
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown">
                                                            Actions
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="{{ route('accounts.show', 1) }}">
                                                                <i class="las la-eye mr-2"></i>View
                                                            </a>
                                                            <a class="dropdown-item" href="{{ route('accounts.edit', 1) }}">
                                                                <i class="las la-edit mr-2"></i>Edit
                                                            </a>
                                                            <a class="dropdown-item" href="#">
                                                                <i class="las la-file-invoice mr-2"></i>Ledger
                                                            </a>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item text-danger" href="#">
                                                                <i class="las la-trash mr-2"></i>Delete
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><span class="badge badge-light">1002</span></td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="mr-3">
                                                            <i class="las la-piggy-bank text-success"></i>
                                                        </div>
                                                        <div>
                                                            <h6 class="mb-0">Bank Account - HDFC</h6>
                                                            <small class="text-muted">Current Account</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge bg-gradient-blue account-type-badge">Bank Account</span>
                                                </td>
                                                <td class="balance-positive">₹850,000</td>
                                                <td>Main Branch</td>
                                                <td>
                                                    <span class="badge badge-success">Active</span>
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown">
                                                            Actions
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="{{ route('accounts.show', 2) }}">
                                                                <i class="las la-eye mr-2"></i>View
                                                            </a>
                                                            <a class="dropdown-item" href="{{ route('accounts.edit', 2) }}">
                                                                <i class="las la-edit mr-2"></i>Edit
                                                            </a>
                                                            <a class="dropdown-item" href="#">
                                                                <i class="las la-file-invoice mr-2"></i>Ledger
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- More rows... -->
                                        </tbody>
                                        <tfoot>
                                            <tr class="table-active">
                                                <td colspan="3" class="text-right"><strong>Total Assets:</strong></td>
                                                <td class="balance-positive"><strong>₹1,250,000</strong></td>
                                                <td colspan="3"></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                            <!-- Liabilities Tab -->
                            <div class="tab-pane fade" id="liabilities">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Account Code</th>
                                                <th>Account Name</th>
                                                <th>Type</th>
                                                <th>Current Balance</th>
                                                <th>Branch</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Liability accounts data -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Other tabs content... -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Account Hierarchy Card -->
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Account Hierarchy</h5>
                    </div>
                    <div class="card-body">
                        <div id="accountTree">
                            <div class="tree-view">
                                <!-- Assets -->
                                <div class="tree-node">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="las la-folder text-warning mr-2"></i>
                                        <h6 class="mb-0">Assets</h6>
                                        <span class="badge badge-light ml-2">₹1,250,000</span>
                                    </div>
                                    <div class="tree-view ml-4">
                                        <!-- Current Assets -->
                                        <div class="tree-node">
                                            <div class="d-flex align-items-center mb-2">
                                                <i class="las la-folder text-info mr-2"></i>
                                                <h6 class="mb-0">Current Assets</h6>
                                            </div>
                                            <div class="tree-view ml-4">
                                                <div class="tree-node">
                                                    <div class="d-flex align-items-center">
                                                        <i class="las la-file-alt text-success mr-2"></i>
                                                        <span>Cash in Hand</span>
                                                        <span class="badge badge-light ml-auto">₹125,000</span>
                                                    </div>
                                                </div>
                                                <div class="tree-node">
                                                    <div class="d-flex align-items-center">
                                                        <i class="las la-file-alt text-success mr-2"></i>
                                                        <span>Bank Accounts</span>
                                                        <span class="badge badge-light ml-auto">₹850,000</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Fixed Assets -->
                                        <div class="tree-node">
                                            <div class="d-flex align-items-center mb-2">
                                                <i class="las la-folder text-info mr-2"></i>
                                                <h6 class="mb-0">Fixed Assets</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Liabilities -->
                                <div class="tree-node">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="las la-folder text-danger mr-2"></i>
                                        <h6 class="mb-0">Liabilities</h6>
                                        <span class="badge badge-light ml-2">₹850,000</span>
                                    </div>
                                </div>
                                <!-- Equity -->
                                <div class="tree-node">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="las la-folder text-success mr-2"></i>
                                        <h6 class="mb-0">Equity</h6>
                                        <span class="badge badge-light ml-2">₹400,000</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Modal -->
    <div class="modal fade" id="filterModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Filter Accounts</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="filterForm">
                        <div class="form-group">
                            <label>Account Type</label>
                            <select class="form-control" name="account_type">
                                <option value="">All Types</option>
                                <option value="asset">Assets</option>
                                <option value="liability">Liabilities</option>
                                <option value="equity">Equity</option>
                                <option value="revenue">Revenue</option>
                                <option value="expense">Expenses</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Branch</label>
                            <select class="form-control" name="branch_id">
                                <option value="">All Branches</option>
                                <option value="1">Main Branch</option>
                                <option value="2">Downtown Branch</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="status">
                                <option value="">All Status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="showZeroBalance">
                                <label class="custom-control-label" for="showZeroBalance">Show zero balance accounts</label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="applyFilters()">Apply Filters</button>
                </div>
            </div>
        </div>
    </div>

    @push('js')
    <!-- Backend Bundle JavaScript -->
    <script src="{{ asset('backend/assets/js/backend-bundle.min.js') }}"></script>
    
    <!-- DataTable -->
    <script src="{{ asset('backend/assets/vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    
    <!-- app JavaScript -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    
    <script>
        $(document).ready(function() {
            // Initialize DataTable
            $('#assetsTable').DataTable({
                pageLength: 10,
                responsive: true,
                order: [[0, 'asc']]
            });
            
            // Tab switching with URL hash
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                const hash = $(e.target).attr('href');
                window.location.hash = hash;
            });
            
            // Restore tab from URL hash
            const hash = window.location.hash;
            if(hash) {
                $(`a[href="${hash}"]`).tab('show');
            }
            
            // Expand/collapse tree nodes
            $('.tree-view .fa-folder').on('click', function() {
                $(this).toggleClass('fa-folder-open');
                $(this).closest('.tree-node').find('.tree-view').first().slideToggle();
            });
        });
        
        // Apply filters
        window.applyFilters = function() {
            const formData = new FormData(document.getElementById('filterForm'));
            const filters = Object.fromEntries(formData);
            console.log('Applying filters:', filters);
            
            // Simulate filtering
            alert('Filters applied! (In a real app, this would reload the table with filtered data)');
            $('#filterModal').modal('hide');
        };
        
        // Export accounts
        window.exportAccounts = function(format) {
            alert(`Exporting accounts in ${format} format...`);
            // In real app: window.location.href = `/accounts/export?format=${format}`;
        };
        
        // Print accounts
        window.printAccounts = function() {
            window.print();
        };
    </script>
    @endpush
</x-app-layout>