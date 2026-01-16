<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/remixicon/fonts/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/flatpickr/dist/flatpickr.min.css') }}">
    <style>
        .transaction-card {
            border-left: 4px solid;
            transition: all 0.3s;
        }
        .transaction-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .transaction-debit {
            border-left-color: #28a745;
        }
        .transaction-credit {
            border-left-color: #dc3545;
        }
        .transaction-journal {
            border-left-color: #17a2b8;
        }
        .amount-debit {
            color: #28a745;
            font-weight: 600;
        }
        .amount-credit {
            color: #dc3545;
            font-weight: 600;
        }
        .filter-section {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .quick-stats {
            display: flex;
            justify-content: space-between;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .stat-item {
            text-align: center;
        }
        .transaction-badge {
            font-size: 0.7rem;
            padding: 3px 8px;
            border-radius: 10px;
        }
    </style>
    @endpush

    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
            <div>
                <h4 class="mb-3">Transactions</h4>
                <p class="mb-0">View and manage all financial transactions</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('accounts.index') }}">Accounts</a></li>
                        <li class="breadcrumb-item active">Transactions</li>
                    </ol>
                </nav>
            </div>
            <div>
                <button type="button" class="btn btn-outline-secondary" data-toggle="collapse" data-target="#filterSection">
                    <i class="las la-filter mr-2"></i>Filters
                </button>
                <a href="{{ route('accounts.transactions.create') }}" class="btn btn-primary ml-2">
                    <i class="las la-plus mr-2"></i>New Transaction
                </a>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="quick-stats">
            <div class="stat-item">
                <h4 class="mb-1">₹1,250,000</h4>
                <small>Total Debits</small>
            </div>
            <div class="stat-item">
                <h4 class="mb-1">₹1,100,000</h4>
                <small>Total Credits</small>
            </div>
            <div class="stat-item">
                <h4 class="mb-1">1,248</h4>
                <small>Total Transactions</small>
            </div>
            <div class="stat-item">
                <h4 class="mb-1">48</h4>
                <small>Today</small>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="collapse show" id="filterSection">
            <div class="filter-section">
                <form id="filterForm">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Date Range</label>
                                <div class="input-group">
                                    <input type="text" class="form-control datepicker" id="dateRange" placeholder="Select date range">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="las la-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Transaction Type</label>
                                <select class="form-control" name="transaction_type">
                                    <option value="">All Types</option>
                                    <option value="debit">Debit</option>
                                    <option value="credit">Credit</option>
                                    <option value="journal">Journal</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Account</label>
                                <select class="form-control" name="account_id">
                                    <option value="">All Accounts</option>
                                    <option value="1">Cash in Hand</option>
                                    <option value="2">Bank Account - HDFC</option>
                                    <option value="3">Accounts Receivable</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" name="status">
                                    <option value="">All Status</option>
                                    <option value="approved">Approved</option>
                                    <option value="pending">Pending</option>
                                    <option value="rejected">Rejected</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Amount Range</label>
                                <div class="row">
                                    <div class="col">
                                        <input type="number" class="form-control" name="amount_min" placeholder="Min">
                                    </div>
                                    <div class="col">
                                        <input type="number" class="form-control" name="amount_max" placeholder="Max">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Reference Type</label>
                                <select class="form-control" name="reference_type">
                                    <option value="">All References</option>
                                    <option value="sale">Sale</option>
                                    <option value="purchase">Purchase</option>
                                    <option value="expense">Expense</option>
                                    <option value="salary">Salary</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Branch</label>
                                <select class="form-control" name="branch_id">
                                    <option value="">All Branches</option>
                                    <option value="1">Main Branch</option>
                                    <option value="2">Downtown Branch</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Created By</label>
                                <select class="form-control" name="created_by">
                                    <option value="">All Users</option>
                                    <option value="1">Admin User</option>
                                    <option value="2">Accountant</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-outline-secondary" onclick="resetFilters()">
                            <i class="las la-redo mr-2"></i>Reset Filters
                        </button>
                        <button type="button" class="btn btn-primary" onclick="applyFilters()">
                            <i class="las la-filter mr-2"></i>Apply Filters
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Transaction Cards View -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h5 class="mb-0">Recent Transactions</h5>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-outline-primary btn-sm active">
                                <input type="radio" name="viewMode" value="cards" checked> Cards
                            </label>
                            <label class="btn btn-outline-primary btn-sm">
                                <input type="radio" name="viewMode" value="table"> Table
                            </label>
                        </div>
                    </div>
                    <div class="card-body" id="cardsView">
                        <div class="row">
                            <!-- Transaction Card 1 -->
                            <div class="col-md-6 mb-3">
                                <div class="card transaction-card transaction-debit">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <div>
                                                <h6 class="mb-1">Cash Sale</h6>
                                                <span class="badge badge-light">TRX-20240320-001</span>
                                            </div>
                                            <div class="text-right">
                                                <h5 class="amount-debit mb-1">₹5,000</h5>
                                                <span class="badge badge-success">Debit</span>
                                            </div>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <small class="text-muted">
                                                <i class="las la-calendar mr-1"></i> 2024-03-20 10:30 AM
                                            </small>
                                        </div>
                                        
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <div>
                                                <small class="text-muted">Account:</small>
                                                <div class="font-weight-bold">Cash in Hand</div>
                                            </div>
                                            <div class="text-right">
                                                <small class="text-muted">Reference:</small>
                                                <div class="font-weight-bold">Sale #INV-20240320-045</div>
                                            </div>
                                        </div>
                                        
                                        <p class="mb-3">Cash sale for clothing items</p>
                                        
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <span class="badge badge-success transaction-badge">Approved</span>
                                                <span class="badge badge-info transaction-badge">Main Branch</span>
                                            </div>
                                            <div>
                                                <a href="{{ route('accounts.transactions.show', 1) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="las la-eye"></i>
                                                </a>
                                                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="editTransaction(1)">
                                                    <i class="las la-edit"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Transaction Card 2 -->
                            <div class="col-md-6 mb-3">
                                <div class="card transaction-card transaction-credit">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <div>
                                                <h6 class="mb-1">Supplier Payment</h6>
                                                <span class="badge badge-light">TRX-20240319-002</span>
                                            </div>
                                            <div class="text-right">
                                                <h5 class="amount-credit mb-1">₹2,500</h5>
                                                <span class="badge badge-danger">Credit</span>
                                            </div>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <small class="text-muted">
                                                <i class="las la-calendar mr-1"></i> 2024-03-19 3:45 PM
                                            </small>
                                        </div>
                                        
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <div>
                                                <small class="text-muted">Account:</small>
                                                <div class="font-weight-bold">Bank Account - HDFC</div>
                                            </div>
                                            <div class="text-right">
                                                <small class="text-muted">Reference:</small>
                                                <div class="font-weight-bold">Purchase #PUR-20240315-012</div>
                                            </div>
                                        </div>
                                        
                                        <p class="mb-3">Payment to supplier for inventory purchase</p>
                                        
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <span class="badge badge-success transaction-badge">Approved</span>
                                                <span class="badge badge-info transaction-badge">Main Branch</span>
                                            </div>
                                            <div>
                                                <a href="{{ route('accounts.transactions.show', 2) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="las la-eye"></i>
                                                </a>
                                                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="editTransaction(2)">
                                                    <i class="las la-edit"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- More transaction cards... -->
                        </div>
                    </div>
                    
                    <!-- Table View (Hidden by default) -->
                    <div class="card-body d-none" id="tableView">
                        <div class="table-responsive">
                            <table class="table table-hover" id="transactionsTable">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Transaction #</th>
                                        <th>Account</th>
                                        <th>Description</th>
                                        <th>Type</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>2024-03-20</td>
                                        <td><span class="badge badge-light">TRX-20240320-001</span></td>
                                        <td>Cash in Hand</td>
                                        <td>Cash sale - Invoice #INV-20240320-045</td>
                                        <td><span class="badge badge-success">Debit</span></td>
                                        <td class="amount-debit">₹5,000</td>
                                        <td><span class="badge badge-success">Approved</span></td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown">
                                                    Actions
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ route('accounts.transactions.show', 1) }}">
                                                        <i class="las la-eye mr-2"></i>View
                                                    </a>
                                                    <a class="dropdown-item" href="{{ route('accounts.transactions.edit', 1) }}">
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
                    
                    <div class="card-footer">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <span class="text-muted">Showing 1-10 of 1,248 transactions</span>
                            </div>
                            <div>
                                <nav aria-label="Page navigation">
                                    <ul class="pagination pagination-sm mb-0">
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#" tabindex="-1">
                                                <i class="las la-angle-left"></i>
                                            </a>
                                        </li>
                                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">
                                                <i class="las la-angle-right"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Batch Actions Card -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Batch Operations</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Select Action</label>
                                    <select class="form-control" id="batchAction">
                                        <option value="">Choose action...</option>
                                        <option value="approve">Approve Selected</option>
                                        <option value="reject">Reject Selected</option>
                                        <option value="export">Export Selected</option>
                                        <option value="delete">Delete Selected</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Selected Transactions (0)</label>
                                    <div class="d-flex">
                                        <button type="button" class="btn btn-outline-secondary mr-2" onclick="selectAll()">
                                            Select All
                                        </button>
                                        <button type="button" class="btn btn-outline-secondary" onclick="deselectAll()">
                                            Deselect All
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <button type="button" class="btn btn-primary btn-block" onclick="executeBatchAction()">
                                        Execute Action
                                    </button>
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
    
    <!-- DataTable -->
    <script src="{{ asset('backend/assets/vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    
    <!-- Flatpickr -->
    <script src="{{ asset('backend/assets/vendor/flatpickr/dist/flatpickr.min.js') }}"></script>
    
    <!-- app JavaScript -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    
    <script>
        $(document).ready(function() {
            // Initialize datepicker
            flatpickr("#dateRange", {
                mode: "range",
                dateFormat: "Y-m-d",
                defaultDate: ["2024-03-01", "2024-03-20"]
            });
            
            // Initialize DataTable
            $('#transactionsTable').DataTable({
                pageLength: 10,
                responsive: true,
                order: [[0, 'desc']]
            });
            
            // View mode toggle
            $('input[name="viewMode"]').change(function() {
                const viewMode = $(this).val();
                if(viewMode === 'cards') {
                    $('#cardsView').removeClass('d-none');
                    $('#tableView').addClass('d-none');
                } else {
                    $('#cardsView').addClass('d-none');
                    $('#tableView').removeClass('d-none');
                }
            });
            
            // Initialize tooltips
            $('[data-toggle="tooltip"]').tooltip();
        });
        
        // Apply filters
        window.applyFilters = function() {
            const formData = new FormData(document.getElementById('filterForm'));
            const filters = Object.fromEntries(formData);
            console.log('Applying filters:', filters);
            
            // In real app, this would reload the transactions with filters
            alert('Filters applied! Loading filtered transactions...');
            $('#filterSection').collapse('hide');
        };
        
        // Reset filters
        window.resetFilters = function() {
            if(confirm('Reset all filters to default?')) {
                $('#filterForm')[0].reset();
                $('#dateRange').val('');
                alert('Filters reset successfully');
            }
        };
        
        // Edit transaction
        window.editTransaction = function(id) {
            window.location.href = `/accounts/transactions/${id}/edit`;
        };
        
        // View transaction
        window.viewTransaction = function(id) {
            window.location.href = `/accounts/transactions/${id}`;
        };
        
        // Batch operations
        window.selectAll = function() {
            $('.transaction-select').prop('checked', true);
            updateSelectedCount();
        };
        
        window.deselectAll = function() {
            $('.transaction-select').prop('checked', false);
            updateSelectedCount();
        };
        
        window.updateSelectedCount = function() {
            const selectedCount = $('.transaction-select:checked').length;
            $('#selectedCount').text(selectedCount);
        };
        
        window.executeBatchAction = function() {
            const action = $('#batchAction').val();
            const selectedCount = $('.transaction-select:checked').length;
            
            if(!action) {
                alert('Please select an action');
                return;
            }
            
            if(selectedCount === 0) {
                alert('Please select at least one transaction');
                return;
            }
            
            if(confirm(`Are you sure you want to ${action} ${selectedCount} transaction(s)?`)) {
                // In real app: API call for batch action
                alert(`${action.charAt(0).toUpperCase() + action.slice(1)} action executed on ${selectedCount} transaction(s)`);
                $('#batchAction').val('');
                $('.transaction-select').prop('checked', false);
                updateSelectedCount();
            }
        };
        
        // Export transactions
        window.exportTransactions = function(format) {
            const filters = Object.fromEntries(new FormData(document.getElementById('filterForm')));
            const queryString = new URLSearchParams(filters).toString();
            
            alert(`Exporting transactions in ${format} format...`);
            // In real app: window.location.href = `/accounts/transactions/export?format=${format}&${queryString}`;
        };
        
        // Quick filter shortcuts
        window.filterToday = function() {
            const today = new Date().toISOString().split('T')[0];
            $('#dateRange').val(`${today} to ${today}`);
            applyFilters();
        };
        
        window.filterThisMonth = function() {
            const now = new Date();
            const firstDay = new Date(now.getFullYear(), now.getMonth(), 1).toISOString().split('T')[0];
            const lastDay = new Date(now.getFullYear(), now.getMonth() + 1, 0).toISOString().split('T')[0];
            $('#dateRange').val(`${firstDay} to ${lastDay}`);
            applyFilters();
        };
    </script>
    @endpush
</x-app-layout>