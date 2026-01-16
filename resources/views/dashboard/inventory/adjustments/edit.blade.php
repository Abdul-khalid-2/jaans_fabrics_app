<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/remixicon/fonts/remixicon.css') }}">
    <style>
        .adjustment-card {
            border-left: 4px solid #4e73df;
            border-radius: 8px;
            margin-bottom: 15px;
            background: white;
            transition: all 0.3s;
        }
        .adjustment-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .adjustment-type-badge {
            font-size: 0.75rem;
            padding: 3px 8px;
        }
        .adjustment-count {
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-weight: bold;
            font-size: 0.875rem;
        }
        .value-badge {
            font-size: 0.875rem;
            padding: 5px 10px;
        }
        .status-badge {
            min-width: 80px;
            text-align: center;
        }
    </style>
    @endpush

    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
            <div>
                <h4 class="mb-3">Stock Adjustments</h4>
                <p class="mb-0">Manage inventory stock adjustments and counts</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('inventory.index') }}">Inventory</a></li>
                        <li class="breadcrumb-item active">Adjustments</li>
                    </ol>
                </nav>
            </div>
            <div class="d-flex">
                <a href="{{ route('inventory.adjustments.create') }}" class="btn btn-primary add-list">
                    <i class="las la-plus mr-2"></i>New Adjustment
                </a>
                <button class="btn btn-outline-primary ml-2" onclick="exportAdjustments()">
                    <i class="las la-download mr-2"></i>Export
                </button>
                <button class="btn btn-outline-secondary ml-2" onclick="toggleBulkActions()">
                    <i class="las la-tasks mr-2"></i>Bulk Actions
                </button>
            </div>
        </div>

        <!-- Statistics -->
        <div class="row mb-4">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-white mb-0">Total Adjustments</h6>
                                <h2 class="mb-0 text-white">48</h2>
                                <small class="text-white-50">This month: 12</small>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-clipboard-list fa-2x text-primary"></i>
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
                                <h6 class="text-white mb-0">Pending Approval</h6>
                                <h2 class="mb-0 text-white">8</h2>
                                <small class="text-white-50">Awaiting review</small>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-clock fa-2x text-success"></i>
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
                                <h6 class="text-white mb-0">Total Items Adjusted</h6>
                                <h2 class="mb-0 text-white">245</h2>
                                <small class="text-white-50">Units changed</small>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-boxes fa-2x text-info"></i>
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
                                <h6 class="text-white mb-0">Value Impact</h6>
                                <h2 class="mb-0 text-white">-$1,245</h2>
                                <small class="text-white-50">Net inventory value</small>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-dollar-sign fa-2x text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bulk Actions Panel -->
        <div class="card mb-4" id="bulkActionsPanel" style="display: none;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-0"><i class="las la-tasks mr-2"></i>Bulk Actions</h6>
                        <small class="text-muted"><span id="selectedCount">0</span> adjustments selected</small>
                    </div>
                    <div class="d-flex">
                        <select class="form-control form-control-sm mr-2" style="width: 150px;">
                            <option value="">Choose action...</option>
                            <option value="approve">Approve Selected</option>
                            <option value="reject">Reject Selected</option>
                            <option value="process">Process Selected</option>
                            <option value="delete">Delete Selected</option>
                            <option value="export">Export Selected</option>
                        </select>
                        <button class="btn btn-sm btn-primary mr-2" onclick="applyBulkAction()">Apply</button>
                        <button class="btn btn-sm btn-outline-secondary" onclick="toggleBulkActions()">Cancel</button>
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
                            <label>Search Adjustments</label>
                            <input type="text" class="form-control" id="searchAdjustment" 
                                   placeholder="Adjustment #, reason, or items">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" id="filterStatus">
                                <option value="">All Status</option>
                                <option value="pending">Pending</option>
                                <option value="approved">Approved</option>
                                <option value="rejected">Rejected</option>
                                <option value="processed">Processed</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Type</label>
                            <select class="form-control" id="filterType">
                                <option value="">All Types</option>
                                <option value="count">Stock Count</option>
                                <option value="damage">Damage</option>
                                <option value="expired">Expired</option>
                                <option value="theft">Theft</option>
                                <option value="sample">Sample</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Date Range</label>
                            <input type="text" class="form-control daterange" 
                                   placeholder="Select date range">
                        </div>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <div class="form-group w-100 d-flex">
                            <button class="btn btn-primary mr-2 flex-grow-1" onclick="applyFilters()">Filter</button>
                            <button class="btn btn-outline-secondary" onclick="resetFilters()">Reset</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Adjustments List -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0">Recent Adjustments</h6>
                <div class="d-flex">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="toggleCardView" onchange="toggleView()">
                        <label class="custom-control-label" for="toggleCardView">Card View</label>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <!-- Table View -->
                <div class="table-responsive" id="tableView">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="5%">
                                    <input type="checkbox" class="form-check-input" id="selectAll" onchange="toggleSelectAll()">
                                </th>
                                <th width="15%">Adjustment #</th>
                                <th width="15%">Date</th>
                                <th width="15%">Type</th>
                                <th width="10%">Items</th>
                                <th width="15%">Value</th>
                                <th width="15%">Status</th>
                                <th width="10%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Adjustment 1 -->
                            <tr>
                                <td>
                                    <input type="checkbox" class="form-check-input adjustment-checkbox" data-id="1">
                                </td>
                                <td>
                                    <strong>ADJ-20240115-001</strong>
                                    <div class="small text-muted">Main Store</div>
                                </td>
                                <td>
                                    <div>2024-01-15</div>
                                    <div class="small text-muted">10:30 AM</div>
                                </td>
                                <td>
                                    <span class="badge adjustment-type-badge bg-info">Stock Count</span>
                                </td>
                                <td>
                                    <span class="adjustment-count bg-light text-dark">5</span>
                                </td>
                                <td>
                                    <span class="badge value-badge bg-light text-dark">$1,245.75</span>
                                </td>
                                <td>
                                    <span class="badge status-badge badge-warning">Pending</span>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('inventory.adjustments.show', 1) }}" class="btn btn-sm btn-info mr-1" title="View">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="{{ route('inventory.adjustments.edit', 1) }}" class="btn btn-sm btn-primary mr-1" title="Edit">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <button class="btn btn-sm btn-outline-success" title="Approve" onclick="approveAdjustment(1)">
                                            <i class="las la-check"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <!-- Adjustment 2 -->
                            <tr>
                                <td>
                                    <input type="checkbox" class="form-check-input adjustment-checkbox" data-id="2">
                                </td>
                                <td>
                                    <strong>ADJ-20240114-001</strong>
                                    <div class="small text-muted">Warehouse</div>
                                </td>
                                <td>
                                    <div>2024-01-14</div>
                                    <div class="small text-muted">02:45 PM</div>
                                </td>
                                <td>
                                    <span class="badge adjustment-type-badge bg-danger">Damage</span>
                                </td>
                                <td>
                                    <span class="adjustment-count bg-light text-dark">3</span>
                                </td>
                                <td>
                                    <span class="badge value-badge bg-light text-dark">-$450.25</span>
                                </td>
                                <td>
                                    <span class="badge status-badge badge-success">Approved</span>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('inventory.adjustments.show', 2) }}" class="btn btn-sm btn-info mr-1" title="View">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="{{ route('inventory.adjustments.edit', 2) }}" class="btn btn-sm btn-primary mr-1" title="Edit">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <button class="btn btn-sm btn-outline-danger" title="Delete" onclick="deleteAdjustment(2)">
                                            <i class="las la-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <!-- Adjustment 3 -->
                            <tr>
                                <td>
                                    <input type="checkbox" class="form-check-input adjustment-checkbox" data-id="3">
                                </td>
                                <td>
                                    <strong>ADJ-20240113-001</strong>
                                    <div class="small text-muted">Mall Store</div>
                                </td>
                                <td>
                                    <div>2024-01-13</div>
                                    <div class="small text-muted">11:15 AM</div>
                                </td>
                                <td>
                                    <span class="badge adjustment-type-badge bg-warning">Expired</span>
                                </td>
                                <td>
                                    <span class="adjustment-count bg-light text-dark">2</span>
                                </td>
                                <td>
                                    <span class="badge value-badge bg-light text-dark">-$320.50</span>
                                </td>
                                <td>
                                    <span class="badge status-badge badge-info">Processed</span>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('inventory.adjustments.show', 3) }}" class="btn btn-sm btn-info mr-1" title="View">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <button class="btn btn-sm btn-outline-success" title="Process" disabled>
                                            <i class="las la-check-double"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <!-- Adjustment 4 -->
                            <tr>
                                <td>
                                    <input type="checkbox" class="form-check-input adjustment-checkbox" data-id="4">
                                </td>
                                <td>
                                    <strong>ADJ-20240112-001</strong>
                                    <div class="small text-muted">Downtown Outlet</div>
                                </td>
                                <td>
                                    <div>2024-01-12</div>
                                    <div class="small text-muted">04:20 PM</div>
                                </td>
                                <td>
                                    <span class="badge adjustment-type-badge bg-secondary">Theft</span>
                                </td>
                                <td>
                                    <span class="adjustment-count bg-light text-dark">1</span>
                                </td>
                                <td>
                                    <span class="badge value-badge bg-light text-dark">-$89.99</span>
                                </td>
                                <td>
                                    <span class="badge status-badge badge-danger">Rejected</span>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('inventory.adjustments.show', 4) }}" class="btn btn-sm btn-info mr-1" title="View">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="{{ route('inventory.adjustments.edit', 4) }}" class="btn btn-sm btn-primary mr-1" title="Edit">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <button class="btn btn-sm btn-outline-danger" title="Delete" onclick="deleteAdjustment(4)">
                                            <i class="las la-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <!-- Adjustment 5 -->
                            <tr>
                                <td>
                                    <input type="checkbox" class="form-check-input adjustment-checkbox" data-id="5">
                                </td>
                                <td>
                                    <strong>ADJ-20240111-001</strong>
                                    <div class="small text-muted">Main Store</div>
                                </td>
                                <td>
                                    <div>2024-01-11</div>
                                    <div class="small text-muted">09:45 AM</div>
                                </td>
                                <td>
                                    <span class="badge adjustment-type-badge bg-success">Sample</span>
                                </td>
                                <td>
                                    <span class="adjustment-count bg-light text-dark">4</span>
                                </td>
                                <td>
                                    <span class="badge value-badge bg-light text-dark">-$180.00</span>
                                </td>
                                <td>
                                    <span class="badge status-badge badge-success">Approved</span>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('inventory.adjustments.show', 5) }}" class="btn btn-sm btn-info mr-1" title="View">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <button class="btn btn-sm btn-outline-info" title="Process">
                                            <i class="las la-check-double"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Card View (Hidden by default) -->
                <div id="cardView" style="display: none;">
                    <div class="row">
                        <!-- Card 1 -->
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="adjustment-card p-3">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div>
                                        <h6 class="mb-1">ADJ-20240115-001</h6>
                                        <small class="text-muted">Main Store • 2024-01-15</small>
                                    </div>
                                    <span class="badge badge-warning">Pending</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="badge adjustment-type-badge bg-info">Stock Count</span>
                                    <div class="d-flex align-items-center">
                                        <span class="adjustment-count bg-light text-dark mr-2">5</span>
                                        <span class="badge value-badge bg-light text-dark">$1,245.75</span>
                                    </div>
                                </div>
                                <p class="small text-muted mb-3">
                                    Monthly stock count reconciliation. Found discrepancies in physical vs system stock.
                                </p>
                                <div class="d-flex justify-content-between">
                                    <div class="small">
                                        <i class="las la-user mr-1"></i> John Doe
                                    </div>
                                    <div class="btn-group">
                                        <a href="{{ route('inventory.adjustments.show', 1) }}" class="btn btn-sm btn-info" title="View">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="{{ route('inventory.adjustments.edit', 1) }}" class="btn btn-sm btn-primary" title="Edit">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <button class="btn btn-sm btn-outline-success" title="Approve">
                                            <i class="las la-check"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Card 2 -->
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="adjustment-card p-3">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div>
                                        <h6 class="mb-1">ADJ-20240114-001</h6>
                                        <small class="text-muted">Warehouse • 2024-01-14</small>
                                    </div>
                                    <span class="badge badge-success">Approved</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="badge adjustment-type-badge bg-danger">Damage</span>
                                    <div class="d-flex align-items-center">
                                        <span class="adjustment-count bg-light text-dark mr-2">3</span>
                                        <span class="badge value-badge bg-light text-dark">-$450.25</span>
                                    </div>
                                </div>
                                <p class="small text-muted mb-3">
                                    Water damage reported in storage area. Items damaged beyond repair.
                                </p>
                                <div class="d-flex justify-content-between">
                                    <div class="small">
                                        <i class="las la-user mr-1"></i> Jane Smith
                                    </div>
                                    <div class="btn-group">
                                        <a href="{{ route('inventory.adjustments.show', 2) }}" class="btn btn-sm btn-info" title="View">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="{{ route('inventory.adjustments.edit', 2) }}" class="btn btn-sm btn-primary" title="Edit">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <button class="btn btn-sm btn-outline-danger" title="Delete">
                                            <i class="las la-trash"></i>
                                        </button>
                                    </div>
                                </div>
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

    @push('js')
    <!-- Backend Bundle JavaScript -->
    <script src="{{ asset('backend/assets/js/backend-bundle.min.js') }}"></script>
    
    <!-- app JavaScript -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    
    <!-- Date Range Picker -->
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
    
    <script>
        $(document).ready(function() {
            // Initialize tooltips
            $('[title]').tooltip();
            
            // Initialize date range picker
            $('.daterange').daterangepicker({
                opens: 'left',
                locale: {
                    format: 'YYYY-MM-DD'
                }
            });
            
            // Update selected count
            $('.adjustment-checkbox').change(function() {
                updateSelectedCount();
            });
        });
        
        function toggleView() {
            const isChecked = $('#toggleCardView').is(':checked');
            if(isChecked) {
                $('#tableView').hide();
                $('#cardView').show();
            } else {
                $('#tableView').show();
                $('#cardView').hide();
            }
        }
        
        function toggleBulkActions() {
            const panel = $('#bulkActionsPanel');
            if(panel.is(':visible')) {
                panel.slideUp();
                $('.adjustment-checkbox').prop('checked', false);
                updateSelectedCount();
            } else {
                panel.slideDown();
            }
        }
        
        function toggleSelectAll() {
            const isChecked = $('#selectAll').is(':checked');
            $('.adjustment-checkbox').prop('checked', isChecked);
            updateSelectedCount();
        }
        
        function updateSelectedCount() {
            const count = $('.adjustment-checkbox:checked').length;
            $('#selectedCount').text(count);
            if(count > 0 && !$('#bulkActionsPanel').is(':visible')) {
                $('#bulkActionsPanel').show();
            }
        }
        
        function applyBulkAction() {
            const selected = $('.adjustment-checkbox:checked').map(function() {
                return $(this).data('id');
            }).get();
            
            if(selected.length === 0) {
                alert('Please select at least one adjustment.');
                return;
            }
            
            const action = $('#bulkActionsPanel select').val();
            if(!action) {
                alert('Please select an action to perform.');
                return;
            }
            
            if(confirm(`Are you sure you want to ${action} ${selected.length} adjustment(s)?`)) {
                console.log(`Performing ${action} on adjustments:`, selected);
                alert(`${selected.length} adjustment(s) processed successfully.`);
                toggleBulkActions();
            }
        }
        
        function applyFilters() {
            const search = $('#searchAdjustment').val().toLowerCase();
            const status = $('#filterStatus').val();
            const type = $('#filterType').val();
            
            // Filter logic
            $('tbody tr').each(function() {
                const adjustmentNum = $(this).find('strong').text().toLowerCase();
                const adjustmentStatus = $(this).find('.status-badge').text().toLowerCase();
                const adjustmentType = $(this).find('.adjustment-type-badge').text().toLowerCase();
                
                let show = true;
                
                if(search && !adjustmentNum.includes(search)) {
                    show = false;
                }
                if(status && !adjustmentStatus.includes(status.toLowerCase())) {
                    show = false;
                }
                if(type && !adjustmentType.includes(type.toLowerCase())) {
                    show = false;
                }
                
                $(this).toggle(show);
            });
        }
        
        function resetFilters() {
            $('#searchAdjustment').val('');
            $('#filterStatus').val('');
            $('#filterType').val('');
            $('.daterange').val('');
            $('tbody tr').show();
        }
        
        function exportAdjustments() {
            alert('Export functionality would be implemented here');
        }
        
        function approveAdjustment(id) {
            if(confirm('Approve this stock adjustment?')) {
                console.log('Approving adjustment:', id);
                alert('Adjustment approved successfully! (static demo)');
            }
        }
        
        function deleteAdjustment(id) {
            if(confirm('Delete this stock adjustment? This action cannot be undone.')) {
                console.log('Deleting adjustment:', id);
                alert('Adjustment deleted successfully! (static demo)');
            }
        }
    </script>
    @endpush
</x-app-layout>