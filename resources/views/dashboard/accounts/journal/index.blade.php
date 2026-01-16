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
        .journal-card {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            transition: all 0.3s;
            margin-bottom: 20px;
        }
        .journal-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .journal-header {
            background: #f8f9fa;
            padding: 15px;
            border-bottom: 1px solid #dee2e6;
            border-radius: 8px 8px 0 0;
        }
        .journal-item {
            padding: 15px;
            border-bottom: 1px solid #f8f9fa;
        }
        .journal-item:last-child {
            border-bottom: none;
        }
        .debit-item {
            border-left: 3px solid #28a745;
        }
        .credit-item {
            border-left: 3px solid #dc3545;
        }
        .amount-debit {
            color: #28a745;
            font-weight: 600;
        }
        .amount-credit {
            color: #dc3545;
            font-weight: 600;
        }
        .balance-check {
            padding: 15px;
            background: #e9ecef;
            border-radius: 0 0 8px 8px;
        }
        .filter-section {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .journal-status {
            font-size: 0.8rem;
            padding: 5px 10px;
            border-radius: 20px;
        }
        .totals-row {
            background: #f8f9fa;
            font-weight: 600;
        }
    </style>
    @endpush

    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
            <div>
                <h4 class="mb-3">Journal Entries</h4>
                <p class="mb-0">Manage general journal entries (double-entry bookkeeping)</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('accounts.index') }}">Accounts</a></li>
                        <li class="breadcrumb-item active">Journal Entries</li>
                    </ol>
                </nav>
            </div>
            <div>
                <button type="button" class="btn btn-outline-secondary" data-toggle="collapse" data-target="#filterSection">
                    <i class="las la-filter mr-2"></i>Filters
                </button>
                <a href="{{ route('accounts.journal.entries.create') }}" class="btn btn-primary ml-2">
                    <i class="las la-plus mr-2"></i>New Entry
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
                                <h5 class="card-title text-uppercase text-muted mb-0">Total Entries</h5>
                                <span class="h2 font-weight-bold mb-0">248</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-primary text-white rounded-circle shadow">
                                    <i class="las la-book"></i>
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
                                <h5 class="card-title text-uppercase text-muted mb-0">Pending Approval</h5>
                                <span class="h2 font-weight-bold mb-0">8</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-warning text-white rounded-circle shadow">
                                    <i class="las la-clock"></i>
                                </div>
                            </div>
                        </div>
                        <p class="mt-3 mb-0 text-sm">
                            <span class="text-danger mr-2"><i class="las la-arrow-down"></i> 2</span>
                            <span class="text-nowrap">Since yesterday</span>
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-md-6">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Total Debits</h5>
                                <span class="h2 font-weight-bold mb-0">₹2.5M</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-success text-white rounded-circle shadow">
                                    <i class="las la-arrow-down"></i>
                                </div>
                            </div>
                        </div>
                        <p class="mt-3 mb-0 text-sm">
                            <span class="text-success mr-2"><i class="las la-arrow-up"></i> 15.2%</span>
                            <span class="text-nowrap">This month</span>
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-md-6">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Total Credits</h5>
                                <span class="h2 font-weight-bold mb-0">₹2.5M</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-danger text-white rounded-circle shadow">
                                    <i class="las la-arrow-up"></i>
                                </div>
                            </div>
                        </div>
                        <p class="mt-3 mb-0 text-sm">
                            <span class="text-success mr-2"><i class="las la-arrow-up"></i> 15.2%</span>
                            <span class="text-nowrap">This month</span>
                        </p>
                    </div>
                </div>
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
                                <label>Status</label>
                                <select class="form-control" name="status">
                                    <option value="">All Status</option>
                                    <option value="approved">Approved</option>
                                    <option value="pending">Pending</option>
                                    <option value="rejected">Rejected</option>
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
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Search Description</label>
                                <input type="text" class="form-control" name="search" placeholder="Search in descriptions">
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Minimum Amount</label>
                                <input type="number" class="form-control" name="amount_min" placeholder="Min amount">
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Maximum Amount</label>
                                <input type="number" class="form-control" name="amount_max" placeholder="Max amount">
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

        <!-- Journal Entries List -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h5 class="mb-0">Journal Entries</h5>
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="exportJournal()">
                                <i class="las la-download"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="printJournal()">
                                <i class="las la-print"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Journal Entry 1 -->
                        <div class="journal-card">
                            <div class="journal-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">Adjusting Entry - Depreciation</h6>
                                        <div class="d-flex align-items-center">
                                            <span class="badge badge-light mr-2">JE-20240320-001</span>
                                            <small class="text-muted mr-3">
                                                <i class="las la-calendar mr-1"></i> 2024-03-20
                                            </small>
                                            <small class="text-muted mr-3">
                                                <i class="las la-map-marker mr-1"></i> Main Branch
                                            </small>
                                            <span class="journal-status badge badge-success">Approved</span>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown">
                                                Actions
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('accounts.journal.entries.show', 1) }}">
                                                    <i class="las la-eye mr-2"></i>View Details
                                                </a>
                                                <a class="dropdown-item" href="{{ route('accounts.journal.entries.edit', 1) }}">
                                                    <i class="las la-edit mr-2"></i>Edit
                                                </a>
                                                <a class="dropdown-item" href="#">
                                                    <i class="las la-copy mr-2"></i>Duplicate
                                                </a>
                                                <a class="dropdown-item" href="#">
                                                    <i class="las la-file-invoice mr-2"></i>Post to Ledger
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item text-danger" href="#">
                                                    <i class="las la-trash mr-2"></i>Delete
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p class="mb-0 mt-2">Monthly depreciation expense for equipment</p>
                            </div>
                            
                            <div class="journal-item debit-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">Depreciation Expense</h6>
                                        <small class="text-muted">Account: 5004 - Depreciation Expense</small>
                                    </div>
                                    <div class="text-right">
                                        <h5 class="amount-debit mb-0">₹10,000</h5>
                                        <small>Debit</small>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="journal-item credit-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">Accumulated Depreciation</h6>
                                        <small class="text-muted">Account: 1008 - Accumulated Depreciation</small>
                                    </div>
                                    <div class="text-right">
                                        <h5 class="amount-credit mb-0">₹10,000</h5>
                                        <small>Credit</small>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="balance-check">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>Total Debits:</strong> ₹10,000
                                    </div>
                                    <div>
                                        <strong>Total Credits:</strong> ₹10,000
                                    </div>
                                    <div>
                                        <span class="badge badge-success">
                                            <i class="las la-check mr-1"></i> Balanced
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Journal Entry 2 -->
                        <div class="journal-card">
                            <div class="journal-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">Bank Interest Income</h6>
                                        <div class="d-flex align-items-center">
                                            <span class="badge badge-light mr-2">JE-20240319-002</span>
                                            <small class="text-muted mr-3">
                                                <i class="las la-calendar mr-1"></i> 2024-03-19
                                            </small>
                                            <small class="text-muted mr-3">
                                                <i class="las la-map-marker mr-1"></i> Main Branch
                                            </small>
                                            <span class="journal-status badge badge-warning">Pending</span>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown">
                                                Actions
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('accounts.journal.entries.show', 2) }}">
                                                    <i class="las la-eye mr-2"></i>View Details
                                                </a>
                                                <a class="dropdown-item" href="{{ route('accounts.journal.entries.edit', 2) }}">
                                                    <i class="las la-edit mr-2"></i>Edit
                                                </a>
                                                <a class="dropdown-item" href="#">
                                                    <i class="las la-check mr-2"></i>Approve
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p class="mb-0 mt-2">Monthly interest income from bank deposits</p>
                            </div>
                            
                            <div class="journal-item debit-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">Bank Account</h6>
                                        <small class="text-muted">Account: 1002 - Bank Account - HDFC</small>
                                    </div>
                                    <div class="text-right">
                                        <h5 class="amount-debit mb-0">₹5,250</h5>
                                        <small>Debit</small>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="journal-item credit-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">Interest Income</h6>
                                        <small class="text-muted">Account: 4001 - Interest Income</small>
                                    </div>
                                    <div class="text-right">
                                        <h5 class="amount-credit mb-0">₹5,250</h5>
                                        <small>Credit</small>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="balance-check">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>Total Debits:</strong> ₹5,250
                                    </div>
                                    <div>
                                        <strong>Total Credits:</strong> ₹5,250
                                    </div>
                                    <div>
                                        <span class="badge badge-success">
                                            <i class="las la-check mr-1"></i> Balanced
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- More journal entries... -->
                    </div>
                    
                    <div class="card-footer">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <span class="text-muted">Showing 1-2 of 248 entries</span>
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

        <!-- Table View (Alternative) -->
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Journal Entries Summary</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover" id="journalTable">
                                <thead>
                                    <tr>
                                        <th>Journal #</th>
                                        <th>Date</th>
                                        <th>Description</th>
                                        <th>Debit Total</th>
                                        <th>Credit Total</th>
                                        <th>Status</th>
                                        <th>Created By</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><span class="badge badge-light">JE-20240320-001</span></td>
                                        <td>2024-03-20</td>
                                        <td>Adjusting Entry - Depreciation</td>
                                        <td class="amount-debit">₹10,000</td>
                                        <td class="amount-credit">₹10,000</td>
                                        <td><span class="badge badge-success">Approved</span></td>
                                        <td>Admin User</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown">
                                                    Actions
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ route('accounts.journal.entries.show', 1) }}">
                                                        <i class="las la-eye mr-2"></i>View
                                                    </a>
                                                    <a class="dropdown-item" href="{{ route('accounts.journal.entries.edit', 1) }}">
                                                        <i class="las la-edit mr-2"></i>Edit
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="badge badge-light">JE-20240319-002</span></td>
                                        <td>2024-03-19</td>
                                        <td>Bank Interest Income</td>
                                        <td class="amount-debit">₹5,250</td>
                                        <td class="amount-credit">₹5,250</td>
                                        <td><span class="badge badge-warning">Pending</span></td>
                                        <td>Accountant</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown">
                                                    Actions
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ route('accounts.journal.entries.show', 2) }}">
                                                        <i class="las la-eye mr-2"></i>View
                                                    </a>
                                                    <a class="dropdown-item" href="{{ route('accounts.journal.entries.edit', 2) }}">
                                                        <i class="las la-edit mr-2"></i>Edit
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- More rows... -->
                                </tbody>
                                <tfoot>
                                    <tr class="totals-row">
                                        <td colspan="3" class="text-right"><strong>Totals:</strong></td>
                                        <td class="amount-debit"><strong>₹15,250</strong></td>
                                        <td class="amount-credit"><strong>₹15,250</strong></td>
                                        <td colspan="3"></td>
                                    </tr>
                                </tfoot>
                            </table>
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
            $('#journalTable').DataTable({
                pageLength: 10,
                responsive: true,
                order: [[1, 'desc']]
            });
            
            // Initialize tooltips
            $('[data-toggle="tooltip"]').tooltip();
        });
        
        // Apply filters
        window.applyFilters = function() {
            const formData = new FormData(document.getElementById('filterForm'));
            const filters = Object.fromEntries(formData);
            console.log('Applying filters:', filters);
            
            // In real app, this would reload the journal entries with filters
            alert('Filters applied! Loading filtered journal entries...');
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
        
        // Export journal entries
        window.exportJournal = function() {
            const format = prompt('Export format (csv, excel, pdf):', 'excel');
            if(format) {
                alert(`Exporting journal entries in ${format} format...`);
                // In real app: window.location.href = `/accounts/journal/export?format=${format}`;
            }
        };
        
        // Print journal entries
        window.printJournal = function() {
            window.print();
        };
        
        // Quick status update
        window.updateJournalStatus = function(journalId, newStatus) {
            if(confirm(`Change status to ${newStatus}?`)) {
                // In real app: API call to update status
                alert(`Journal entry status updated to ${newStatus}`);
                location.reload();
            }
        };
        
        // Duplicate journal entry
        window.duplicateJournal = function(journalId) {
            if(confirm('Create a copy of this journal entry?')) {
                // In real app: API call to duplicate
                window.location.href = `/accounts/journal/entries/create?duplicate=${journalId}`;
            }
        };
        
        // Post to ledger
        window.postToLedger = function(journalId) {
            if(confirm('Post this journal entry to general ledger?')) {
                // In real app: API call to post to ledger
                alert('Journal entry posted to ledger successfully');
                location.reload();
            }
        };
    </script>
    @endpush
</x-app-layout>