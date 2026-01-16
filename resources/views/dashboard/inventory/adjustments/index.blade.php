<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/remixicon/fonts/remixicon.css') }}">
    <style>
        .adjustment-card {
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            border-left: 4px solid #4e73df;
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            transition: all 0.3s;
        }
        .adjustment-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .adjustment-type {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .adjustment-count {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 10px;
        }
        .status-badge {
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        .filter-pill {
            padding: 5px 15px;
            border-radius: 20px;
            background: #f3f4f6;
            border: 1px solid #d1d5db;
            color: #6b7280;
            cursor: pointer;
            transition: all 0.3s;
        }
        .filter-pill.active {
            background: #4e73df;
            color: white;
            border-color: #4e73df;
        }
        .adjustment-table th {
            border-top: none;
            font-weight: 600;
            color: #6b7280;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
        }
    </style>
    @endpush

    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
            <div>
                <h4 class="mb-3">Stock Adjustments</h4>
                <p class="mb-0">Track and manage all stock adjustments across branches</p>
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
                <button class="btn btn-outline-secondary ml-2" data-toggle="modal" data-target="#bulkAdjustmentModal">
                    <i class="las la-tasks mr-2"></i>Bulk Adjustment
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
                                <h2 class="mb-0 text-white">124</h2>
                                <small class="text-white-50">This month: 24</small>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-edit fa-2x text-primary"></i>
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
                                <h6 class="text-white mb-0">Stock Added</h6>
                                <h2 class="mb-0 text-white">+2,458</h2>
                                <small class="text-white-50">Units this month</small>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-plus-circle fa-2x text-success"></i>
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
                                <h6 class="text-white mb-0">Stock Removed</h6>
                                <h2 class="mb-0 text-white">-1,245</h2>
                                <small class="text-white-50">Units this month</small>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-minus-circle fa-2x text-danger"></i>
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
                                <h6 class="text-white mb-0">Adjustment Value</h6>
                                <h2 class="mb-0 text-white">$12,456</h2>
                                <small class="text-white-50">Total this month</small>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-dollar-sign fa-2x text-warning"></i>
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
                            <label>Adjustment Number</label>
                            <input type="text" class="form-control" placeholder="ADJ-XXXXXX">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Type</label>
                            <select class="form-control">
                                <option value="">All Types</option>
                                <option value="count">Count Adjustment</option>
                                <option value="damage">Damage</option>
                                <option value="expired">Expired</option>
                                <option value="theft">Theft</option>
                                <option value="sample">Sample</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control">
                                <option value="">All Status</option>
                                <option value="pending">Pending</option>
                                <option value="approved">Approved</option>
                                <option value="rejected">Rejected</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Branch</label>
                            <select class="form-control">
                                <option value="">All Branches</option>
                                <option value="1">Main Store</option>
                                <option value="2">Westside Mall</option>
                                <option value="3">Warehouse</option>
                                <option value="4">East City</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <div class="form-group w-100 d-flex">
                            <button class="btn btn-primary mr-2 flex-grow-1" onclick="applyFilters()">Filter</button>
                            <button class="btn btn-outline-secondary" onclick="resetFilters()">Reset</button>
                        </div>
                    </div>
                </div>
                
                <!-- Quick Filter Pills -->
                <div class="d-flex flex-wrap mt-3">
                    <div class="filter-pill mr-2 mb-2 active" onclick="setQuickFilter('all')">
                        All Adjustments
                    </div>
                    <div class="filter-pill mr-2 mb-2" onclick="setQuickFilter('today')">
                        Today
                    </div>
                    <div class="filter-pill mr-2 mb-2" onclick="setQuickFilter('week')">
                        This Week
                    </div>
                    <div class="filter-pill mr-2 mb-2" onclick="setQuickFilter('pending')">
                        Pending Approval
                    </div>
                    <div class="filter-pill mr-2 mb-2" onclick="setQuickFilter('damage')">
                        Damaged Goods
                    </div>
                    <div class="filter-pill mb-2" onclick="setQuickFilter('highvalue')">
                        High Value
                    </div>
                </div>
            </div>
        </div>

        <!-- Adjustments List -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0">Adjustments List</h6>
                <div class="dropdown">
                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown">
                        <i class="las la-ellipsis-v"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#" onclick="approveSelected()">
                            <i class="las la-check-circle mr-2"></i>Approve Selected
                        </a>
                        <a class="dropdown-item" href="#" onclick="rejectSelected()">
                            <i class="las la-times-circle mr-2"></i>Reject Selected
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" href="#" onclick="deleteSelected()">
                            <i class="las la-trash mr-2"></i>Delete Selected
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <!-- Table View -->
                <div class="table-responsive">
                    <table class="table table-hover adjustment-table">
                        <thead>
                            <tr>
                                <th width="5%">
                                    <input type="checkbox" class="form-check-input" id="selectAll" onchange="toggleSelectAll()">
                                </th>
                                <th width="15%">Adjustment #</th>
                                <th width="15%">Date & Time</th>
                                <th width="15%">Type</th>
                                <th width="15%">Branch</th>
                                <th width="10%">Items</th>
                                <th width="10%">Value</th>
                                <th width="10%">Status</th>
                                <th width="15%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Adjustment 1 -->
                            <tr>
                                <td>
                                    <input type="checkbox" class="form-check-input adjustment-checkbox" data-id="1">
                                </td>
                                <td>
                                    <strong>ADJ-2024-00125</strong>
                                    <div class="small text-muted">Created by: John Doe</div>
                                </td>
                                <td>2024-01-25<br><small class="text-muted">14:30</small></td>
                                <td>
                                    <span class="adjustment-type" style="background: #fef3c7; color: #92400e;">
                                        Damage
                                    </span>
                                </td>
                                <td>Main Store</td>
                                <td>
                                    <div class="adjustment-count bg-primary text-white">5</div>
                                </td>
                                <td class="text-danger">-$245.00</td>
                                <td>
                                    <span class="status-badge bg-warning text-white">Pending</span>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('inventory.adjustments.show', 1) }}" class="btn btn-info" title="View">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <button class="btn btn-success" title="Approve" onclick="approveAdjustment(1)">
                                            <i class="las la-check"></i>
                                        </button>
                                        <button class="btn btn-danger" title="Reject" onclick="rejectAdjustment(1)">
                                            <i class="las la-times"></i>
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
                                    <strong>ADJ-2024-00124</strong>
                                    <div class="small text-muted">Created by: Jane Smith</div>
                                </td>
                                <td>2024-01-24<br><small class="text-muted">11:15</small></td>
                                <td>
                                    <span class="adjustment-type" style="background: #d1fae5; color: #065f46;">
                                        Count
                                    </span>
                                </td>
                                <td>Warehouse</td>
                                <td>
                                    <div class="adjustment-count bg-success text-white">12</div>
                                </td>
                                <td class="text-success">+$1,245.00</td>
                                <td>
                                    <span class="status-badge bg-success text-white">Approved</span>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('inventory.adjustments.show', 2) }}" class="btn btn-info" title="View">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="{{ route('inventory.adjustments.edit', 2) }}" class="btn btn-primary" title="Edit">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <button class="btn btn-outline-secondary" title="Print">
                                            <i class="las la-print"></i>
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
                                    <strong>ADJ-2024-00123</strong>
                                    <div class="small text-muted">Created by: Robert Brown</div>
                                </td>
                                <td>2024-01-23<br><small class="text-muted">16:45</small></td>
                                <td>
                                    <span class="adjustment-type" style="background: #fee2e2; color: #991b1b;">
                                        Expired
                                    </span>
                                </td>
                                <td>Westside Mall</td>
                                <td>
                                    <div class="adjustment-count bg-danger text-white">8</div>
                                </td>
                                <td class="text-danger">-$890.00</td>
                                <td>
                                    <span class="status-badge bg-danger text-white">Rejected</span>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('inventory.adjustments.show', 3) }}" class="btn btn-info" title="View">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <button class="btn btn-warning" title="Re-open" onclick="reopenAdjustment(3)">
                                            <i class="las la-redo"></i>
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
                                    <strong>ADJ-2024-00122</strong>
                                    <div class="small text-muted">Created by: Sarah Wilson</div>
                                </td>
                                <td>2024-01-22<br><small class="text-muted">10:20</small></td>
                                <td>
                                    <span class="adjustment-type" style="background: #e0e7ff; color: #3730a3;">
                                        Theft
                                    </span>
                                </td>
                                <td>East City</td>
                                <td>
                                    <div class="adjustment-count bg-info text-white">3</div>
                                </td>
                                <td class="text-danger">-$345.00</td>
                                <td>
                                    <span class="status-badge bg-success text-white">Approved</span>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('inventory.adjustments.show', 4) }}" class="btn btn-info" title="View">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="{{ route('inventory.adjustments.edit', 4) }}" class="btn btn-primary" title="Edit">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <button class="btn btn-outline-secondary" title="Print">
                                            <i class="las la-print"></i>
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
                                    <strong>ADJ-2024-00121</strong>
                                    <div class="small text-muted">Created by: Mike Johnson</div>
                                </td>
                                <td>2024-01-21<br><small class="text-muted">15:10</small></td>
                                <td>
                                    <span class="adjustment-type" style="background: #f3e8ff; color: #6b21a8;">
                                        Sample
                                    </span>
                                </td>
                                <td>Main Store</td>
                                <td>
                                    <div class="adjustment-count bg-warning text-white">2</div>
                                </td>
                                <td class="text-danger">-$178.00</td>
                                <td>
                                    <span class="status-badge bg-success text-white">Approved</span>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('inventory.adjustments.show', 5) }}" class="btn btn-info" title="View">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <button class="btn btn-outline-secondary" title="Print">
                                            <i class="las la-print"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
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

    <!-- Bulk Adjustment Modal -->
    <div class="modal fade" id="bulkAdjustmentModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="las la-tasks mr-2"></i>Bulk Stock Adjustment</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="bulkAdjustmentForm">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Adjustment Type <span class="text-danger">*</span></label>
                                    <select class="form-control" required>
                                        <option value="">Select type</option>
                                        <option value="damage">Damage</option>
                                        <option value="expired">Expired</option>
                                        <option value="theft">Theft</option>
                                        <option value="sample">Sample</option>
                                        <option value="count">Count Adjustment</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Branch <span class="text-danger">*</span></label>
                                    <select class="form-control" required>
                                        <option value="">Select branch</option>
                                        <option value="1">Main Store</option>
                                        <option value="2">Westside Mall</option>
                                        <option value="3">Warehouse</option>
                                        <option value="4">East City</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label>Reason <span class="text-danger">*</span></label>
                            <textarea class="form-control" rows="3" placeholder="Enter reason for bulk adjustment..." required></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label>Upload CSV File</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="bulkFile" accept=".csv">
                                <label class="custom-file-label" for="bulkFile">Choose CSV file...</label>
                            </div>
                            <small class="form-text text-muted">
                                Upload CSV file with columns: Product Code, Quantity, Reason (Optional)
                            </small>
                        </div>
                        
                        <div class="alert alert-info">
                            <i class="las la-info-circle"></i>
                            You can also add products manually below:
                        </div>
                        
                        <div class="text-center">
                            <button type="button" class="btn btn-outline-primary" onclick="addProductRow()">
                                <i class="las la-plus"></i> Add Product
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" form="bulkAdjustmentForm">Create Bulk Adjustment</button>
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
            // File upload label
            $('.custom-file-input').on('change', function() {
                const fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').text(fileName || 'Choose file...');
            });
        });
        
        function setQuickFilter(filter) {
            // Remove active class from all pills
            $('.filter-pill').removeClass('active');
            
            // Add active class to clicked pill
            $(event.target).addClass('active');
            
            console.log('Applying quick filter:', filter);
            // Implement filter logic
            switch(filter) {
                case 'today':
                    alert('Showing today\'s adjustments');
                    break;
                case 'week':
                    alert('Showing this week\'s adjustments');
                    break;
                case 'pending':
                    alert('Showing pending adjustments');
                    break;
                case 'damage':
                    alert('Showing damage adjustments');
                    break;
                case 'highvalue':
                    alert('Showing high value adjustments');
                    break;
                default:
                    alert('Showing all adjustments');
            }
        }
        
        function toggleSelectAll() {
            const isChecked = $('#selectAll').is(':checked');
            $('.adjustment-checkbox').prop('checked', isChecked);
        }
        
        function approveAdjustment(id) {
            if(confirm('Approve this adjustment?')) {
                console.log('Approving adjustment:', id);
                alert('Adjustment approved successfully!');
                // Update UI
                $(`tr:has(input[data-id="${id}"]) .status-badge`)
                    .removeClass('bg-warning bg-danger')
                    .addClass('bg-success')
                    .text('Approved');
            }
        }
        
        function rejectAdjustment(id) {
            if(confirm('Reject this adjustment?')) {
                console.log('Rejecting adjustment:', id);
                alert('Adjustment rejected!');
                // Update UI
                $(`tr:has(input[data-id="${id}"]) .status-badge`)
                    .removeClass('bg-warning bg-success')
                    .addClass('bg-danger')
                    .text('Rejected');
            }
        }
        
        function reopenAdjustment(id) {
            if(confirm('Re-open this adjustment for editing?')) {
                console.log('Re-opening adjustment:', id);
                alert('Adjustment re-opened!');
                // Update UI
                $(`tr:has(input[data-id="${id}"]) .status-badge`)
                    .removeClass('bg-danger bg-success')
                    .addClass('bg-warning')
                    .text('Pending');
            }
        }
        
        function approveSelected() {
            const selected = $('.adjustment-checkbox:checked').map(function() {
                return $(this).data('id');
            }).get();
            
            if(selected.length === 0) {
                alert('Please select at least one adjustment.');
                return;
            }
            
            if(confirm(`Approve ${selected.length} selected adjustment(s)?`)) {
                selected.forEach(id => approveAdjustment(id));
            }
        }
        
        function rejectSelected() {
            const selected = $('.adjustment-checkbox:checked').map(function() {
                return $(this).data('id');
            }).get();
            
            if(selected.length === 0) {
                alert('Please select at least one adjustment.');
                return;
            }
            
            if(confirm(`Reject ${selected.length} selected adjustment(s)?`)) {
                selected.forEach(id => rejectAdjustment(id));
            }
        }
        
        function deleteSelected() {
            const selected = $('.adjustment-checkbox:checked').map(function() {
                return $(this).data('id');
            }).get();
            
            if(selected.length === 0) {
                alert('Please select at least one adjustment.');
                return;
            }
            
            if(confirm(`Delete ${selected.length} selected adjustment(s)? This action cannot be undone.`)) {
                console.log('Deleting adjustments:', selected);
                alert('Adjustments deleted successfully!');
                // Remove rows from table
                selected.forEach(id => {
                    $(`tr:has(input[data-id="${id}"])`).remove();
                });
            }
        }
        
        function applyFilters() {
            alert('Applying filters...');
            // Implement filter logic
        }
        
        function resetFilters() {
            $('.filter-pill').removeClass('active');
            $('.filter-pill:first').addClass('active');
            $('input[type="text"], select').val('');
            alert('Filters reset.');
        }
        
        function exportAdjustments() {
            alert('Exporting adjustments report...');
        }
        
        function addProductRow() {
            alert('Adding product row to bulk adjustment form...');
        }
        
        // Form submission
        $('#bulkAdjustmentForm').submit(function(e) {
            e.preventDefault();
            alert('Bulk adjustment created successfully!');
            $('#bulkAdjustmentModal').modal('hide');
        });
    </script>
    @endpush
</x-app-layout>