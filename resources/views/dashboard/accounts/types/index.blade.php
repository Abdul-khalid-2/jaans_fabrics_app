<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/remixicon/fonts/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <style>
        .type-card {
            border-radius: 10px;
            transition: all 0.3s;
            border: 1px solid #dee2e6;
        }
        .type-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .type-icon {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            font-size: 1.5rem;
            margin-bottom: 15px;
        }
        .category-badge {
            font-size: 0.7rem;
            padding: 3px 8px;
            border-radius: 10px;
        }
        .stats-badge {
            font-size: 0.8rem;
            padding: 5px 10px;
            border-radius: 20px;
            background: #f8f9fa;
        }
    </style>
    @endpush

    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
            <div>
                <h4 class="mb-3">Account Types</h4>
                <p class="mb-0">Manage accounting account types and categories</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('accounts.index') }}">Accounts</a></li>
                        <li class="breadcrumb-item active">Account Types</li>
                    </ol>
                </nav>
            </div>
            <div>
                <button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#helpModal">
                    <i class="las la-question-circle mr-2"></i>Help
                </button>
                <a href="{{ route('accounts.types.create') }}" class="btn btn-primary ml-2">
                    <i class="las la-plus mr-2"></i>Add Type
                </a>
            </div>
        </div>

        <!-- Info Cards -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Total Types</h5>
                                <span class="h2 font-weight-bold mb-0">15</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-primary text-white rounded-circle shadow">
                                    <i class="las la-tags"></i>
                                </div>
                            </div>
                        </div>
                        <p class="mt-3 mb-0 text-sm">
                            <span class="text-success mr-2"><i class="las la-arrow-up"></i> 3.48%</span>
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
                                <h5 class="card-title text-uppercase text-muted mb-0">Active Types</h5>
                                <span class="h2 font-weight-bold mb-0">13</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-success text-white rounded-circle shadow">
                                    <i class="las la-check-circle"></i>
                                </div>
                            </div>
                        </div>
                        <p class="mt-3 mb-0 text-sm">
                            <span class="text-success mr-2"><i class="las la-arrow-up"></i> 1</span>
                            <span class="text-nowrap">New this month</span>
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-md-6">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Categories</h5>
                                <span class="h2 font-weight-bold mb-0">6</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                    <i class="las la-layer-group"></i>
                                </div>
                            </div>
                        </div>
                        <p class="mt-3 mb-0 text-sm">
                            <span class="text-muted">Asset, Liability, Equity, Revenue, Expense, COGS</span>
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-md-6">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Accounts Using</h5>
                                <span class="h2 font-weight-bold mb-0">48</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-warning text-white rounded-circle shadow">
                                    <i class="las la-book"></i>
                                </div>
                            </div>
                        </div>
                        <p class="mt-3 mb-0 text-sm">
                            <span class="text-success mr-2"><i class="las la-arrow-up"></i> 5</span>
                            <span class="text-nowrap">New accounts</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Categories Tabs -->
        <ul class="nav nav-tabs mb-4" id="categoryTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="all-tab" data-toggle="tab" href="#all">
                    <i class="las la-list mr-1"></i> All Types
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="asset-tab" data-toggle="tab" href="#asset">
                    <span class="badge bg-gradient-green mr-1">A</span> Assets
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="liability-tab" data-toggle="tab" href="#liability">
                    <span class="badge bg-gradient-orange mr-1">L</span> Liabilities
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="equity-tab" data-toggle="tab" href="#equity">
                    <span class="badge bg-gradient-info mr-1">E</span> Equity
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="revenue-tab" data-toggle="tab" href="#revenue">
                    <span class="badge bg-gradient-success mr-1">R</span> Revenue
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="expense-tab" data-toggle="tab" href="#expense">
                    <span class="badge bg-gradient-danger mr-1">E</span> Expenses
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="cogs-tab" data-toggle="tab" href="#cogs">
                    <span class="badge bg-gradient-purple mr-1">C</span> Cost of Sales
                </a>
            </li>
        </ul>

        <div class="tab-content" id="categoryTabContent">
            <!-- All Types Tab -->
            <div class="tab-pane fade show active" id="all">
                <div class="row">
                    <!-- Asset Types -->
                    <div class="col-lg-12 mb-4">
                        <h5 class="mb-3 d-flex align-items-center">
                            <span class="badge bg-gradient-green mr-2">Asset</span>
                            Asset Account Types
                        </h5>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="card type-card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-start">
                                            <div class="type-icon bg-gradient-green text-white mr-3">
                                                <i class="las la-wallet"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h5 class="mb-1">Cash</h5>
                                                <span class="badge bg-gradient-green category-badge">Asset</span>
                                                <p class="mb-2 text-muted small">Physical cash on hand</p>
                                                <div class="d-flex justify-content-between">
                                                    <span class="stats-badge">
                                                        <i class="las la-book mr-1"></i> 2 Accounts
                                                    </span>
                                                    <span class="badge badge-success">Active</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <a href="{{ route('accounts.types.edit', 1) }}" class="btn btn-sm btn-outline-primary mr-2">
                                                <i class="las la-edit"></i>
                                            </a>
                                            <a href="#" class="btn btn-sm btn-outline-info">
                                                <i class="las la-eye"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4 mb-3">
                                <div class="card type-card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-start">
                                            <div class="type-icon bg-gradient-blue text-white mr-3">
                                                <i class="las la-university"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h5 class="mb-1">Bank Accounts</h5>
                                                <span class="badge bg-gradient-green category-badge">Asset</span>
                                                <p class="mb-2 text-muted small">Bank account balances</p>
                                                <div class="d-flex justify-content-between">
                                                    <span class="stats-badge">
                                                        <i class="las la-book mr-1"></i> 3 Accounts
                                                    </span>
                                                    <span class="badge badge-success">Active</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <a href="{{ route('accounts.types.edit', 2) }}" class="btn btn-sm btn-outline-primary mr-2">
                                                <i class="las la-edit"></i>
                                            </a>
                                            <a href="#" class="btn btn-sm btn-outline-info">
                                                <i class="las la-eye"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- More asset types... -->
                        </div>
                    </div>
                    
                    <!-- Liability Types -->
                    <div class="col-lg-12 mb-4">
                        <h5 class="mb-3 d-flex align-items-center">
                            <span class="badge bg-gradient-orange mr-2">Liability</span>
                            Liability Account Types
                        </h5>
                        <div class="row">
                            <!-- Liability type cards... -->
                        </div>
                    </div>
                    
                    <!-- More categories... -->
                </div>
            </div>
            
            <!-- Asset Tab -->
            <div class="tab-pane fade" id="asset">
                <div class="row">
                    <!-- Asset type cards... -->
                </div>
            </div>
            
            <!-- Other category tabs... -->
        </div>

        <!-- Table View -->
        <div class="card mt-4">
            <div class="card-header d-flex justify-content-between">
                <h5 class="mb-0">All Account Types</h5>
                <div>
                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="exportTypes()">
                        <i class="las la-download mr-1"></i> Export
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="typesTable">
                        <thead>
                            <tr>
                                <th>Type Code</th>
                                <th>Type Name</th>
                                <th>Category</th>
                                <th>Description</th>
                                <th>Accounts</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span class="badge badge-light">CASH</span></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="mr-3">
                                            <i class="las la-wallet text-primary"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Cash</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-gradient-green">Asset</span>
                                </td>
                                <td>Physical cash on hand</td>
                                <td>
                                    <span class="badge badge-light">2</span>
                                </td>
                                <td>
                                    <span class="badge badge-success">Active</span>
                                </td>
                                <td>2024-01-15</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown">
                                            Actions
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('accounts.types.show', 1) }}">
                                                <i class="las la-eye mr-2"></i>View
                                            </a>
                                            <a class="dropdown-item" href="{{ route('accounts.types.edit', 1) }}">
                                                <i class="las la-edit mr-2"></i>Edit
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                <i class="las la-copy mr-2"></i>Duplicate
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item text-danger" href="#">
                                                <i class="las la-trash mr-2"></i>Delete
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <!-- More rows... -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Help Modal -->
    <div class="modal fade" id="helpModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Account Types Guide</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Account Categories</h6>
                            <div class="list-group list-group-flush">
                                <div class="list-group-item">
                                    <span class="badge bg-gradient-green mr-2">Asset</span>
                                    <strong>Resources owned</strong>
                                    <p class="mb-0 small">What the business owns (Cash, Inventory, Equipment)</p>
                                </div>
                                <div class="list-group-item">
                                    <span class="badge bg-gradient-orange mr-2">Liability</span>
                                    <strong>Amounts owed</strong>
                                    <p class="mb-0 small">What the business owes (Loans, Accounts Payable)</p>
                                </div>
                                <div class="list-group-item">
                                    <span class="badge bg-gradient-info mr-2">Equity</span>
                                    <strong>Owner's investment</strong>
                                    <p class="mb-0 small">Owner's stake in the business (Capital, Retained Earnings)</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6>Best Practices</h6>
                            <ul class="small">
                                <li>Create consistent naming conventions</li>
                                <li>Use standard account types when possible</li>
                                <li>Don't delete types used by existing accounts</li>
                                <li>Regularly review and update descriptions</li>
                                <li>Keep similar types in the same category</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
            $('#typesTable').DataTable({
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
        });
        
        // Export account types
        window.exportTypes = function() {
            alert('Exporting account types...');
            // In real app: window.location.href = '/accounts/types/export';
        };
        
        // Quick status toggle
        window.toggleTypeStatus = function(typeId, currentStatus) {
            const newStatus = currentStatus === 'active' ? 'inactive' : 'active';
            if(confirm(`Change status to ${newStatus}?`)) {
                // In real app: API call to update status
                alert(`Status changed to ${newStatus}`);
                location.reload();
            }
        };
        
        // Duplicate account type
        window.duplicateType = function(typeId) {
            if(confirm('Create a copy of this account type?')) {
                // In real app: API call to duplicate
                alert('Account type duplicated!');
                location.reload();
            }
        };
    </script>
    @endpush
</x-app-layout>