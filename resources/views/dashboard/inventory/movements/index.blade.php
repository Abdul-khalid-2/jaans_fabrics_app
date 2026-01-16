<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/remixicon/fonts/remixicon.css') }}">
    <style>
        .movement-card {
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            border-left: 4px solid #4e73df;
            background: white;
            transition: all 0.3s;
        }
        .movement-card:hover {
            transform: translateX(5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .movement-in {
            border-left-color: #10b981;
        }
        .movement-out {
            border-left-color: #ef4444;
        }
        .movement-type {
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .quantity-badge {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 14px;
        }
        .filter-tag {
            display: inline-block;
            padding: 5px 12px;
            margin: 2px;
            background: #f3f4f6;
            border: 1px solid #d1d5db;
            border-radius: 15px;
            font-size: 12px;
            color: #6b7280;
            cursor: pointer;
            transition: all 0.3s;
        }
        .filter-tag.active {
            background: #4e73df;
            color: white;
            border-color: #4e73df;
        }
        .timeline-item {
            position: relative;
            padding-left: 30px;
            margin-bottom: 20px;
        }
        .timeline-item:before {
            content: '';
            position: absolute;
            left: 0;
            top: 5px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #e5e7eb;
        }
        .timeline-item.movement-in:before {
            background: #10b981;
        }
        .timeline-item.movement-out:before {
            background: #ef4444;
        }
    </style>
    @endpush

    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
            <div>
                <h4 class="mb-3">Stock Movement History</h4>
                <p class="mb-0">Track all stock movements and inventory changes</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('inventory.index') }}">Inventory</a></li>
                        <li class="breadcrumb-item active">Movements</li>
                    </ol>
                </nav>
            </div>
            <div class="d-flex">
                <button class="btn btn-outline-primary ml-2" onclick="exportMovements()">
                    <i class="las la-download mr-2"></i>Export
                </button>
                <button class="btn btn-outline-secondary ml-2" onclick="printReport()">
                    <i class="las la-print mr-2"></i>Print
                </button>
                <div class="dropdown ml-2">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                        <i class="las la-filter mr-2"></i>Views
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#" onclick="setView('table')">
                            <i class="las la-table mr-2"></i>Table View
                        </a>
                        <a class="dropdown-item" href="#" onclick="setView('timeline')">
                            <i class="las la-stream mr-2"></i>Timeline View
                        </a>
                        <a class="dropdown-item" href="#" onclick="setView('cards')">
                            <i class="las la-th-large mr-2"></i>Card View
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics -->
        <div class="row mb-4">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-white mb-0">Total Movements</h6>
                                <h2 class="mb-0 text-white">1,248</h2>
                                <small class="text-white-50">Last 30 days</small>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-exchange-alt fa-2x text-primary"></i>
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
                                <h6 class="text-white mb-0">Stock In</h6>
                                <h2 class="mb-0 text-white">+2,458</h2>
                                <small class="text-white-50">Units received</small>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-arrow-down fa-2x text-success"></i>
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
                                <h6 class="text-white mb-0">Stock Out</h6>
                                <h2 class="mb-0 text-white">-1,845</h2>
                                <small class="text-white-50">Units sold/moved</small>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-arrow-up fa-2x text-danger"></i>
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
                                <h6 class="text-white mb-0">Net Change</h6>
                                <h2 class="mb-0 text-white">+613</h2>
                                <small class="text-white-50">Net stock increase</small>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-chart-line fa-2x text-info"></i>
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
                            <label>Date Range</label>
                            <input type="text" class="form-control" id="dateRange" placeholder="Select range">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Movement Type</label>
                            <select class="form-control" id="movementType">
                                <option value="">All Types</option>
                                <option value="purchase">Purchase</option>
                                <option value="sale">Sale</option>
                                <option value="transfer">Transfer</option>
                                <option value="adjustment">Adjustment</option>
                                <option value="return">Return</option>
                                <option value="damage">Damage</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Branch</label>
                            <select class="form-control" id="branchFilter">
                                <option value="">All Branches</option>
                                <option value="1">Main Store</option>
                                <option value="2">Westside Mall</option>
                                <option value="3">Warehouse</option>
                                <option value="4">East City</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Product Search</label>
                            <input type="text" class="form-control" placeholder="Product name, SKU or code">
                        </div>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <div class="form-group w-100 d-flex">
                            <button class="btn btn-primary mr-2 flex-grow-1" onclick="applyFilters()">Filter</button>
                            <button class="btn btn-outline-secondary" onclick="resetFilters()">Reset</button>
                        </div>
                    </div>
                </div>
                
                <!-- Quick Filter Tags -->
                <div class="mt-3">
                    <div class="mb-2"><small class="text-muted">Quick Filters:</small></div>
                    <div>
                        <span class="filter-tag active" onclick="setQuickFilter('today')">Today</span>
                        <span class="filter-tag" onclick="setQuickFilter('week')">This Week</span>
                        <span class="filter-tag" onclick="setQuickFilter('month')">This Month</span>
                        <span class="filter-tag" onclick="setQuickFilter('sales')">Sales Only</span>
                        <span class="filter-tag" onclick="setQuickFilter('purchases')">Purchases Only</span>
                        <span class="filter-tag" onclick="setQuickFilter('adjustments')">Adjustments</span>
                        <span class="filter-tag" onclick="setQuickFilter('transfers')">Transfers</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table View (Default) -->
        <div class="card" id="tableView">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0">Stock Movements</h6>
                <div class="dropdown">
                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown">
                        <i class="las la-columns"></i> Columns
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-item">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="colProduct" checked>
                                <label class="custom-control-label" for="colProduct">Product</label>
                            </div>
                        </div>
                        <div class="dropdown-item">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="colBranch" checked>
                                <label class="custom-control-label" for="colBranch">Branch</label>
                            </div>
                        </div>
                        <div class="dropdown-item">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="colUser" checked>
                                <label class="custom-control-label" for="colUser">User</label>
                            </div>
                        </div>
                        <div class="dropdown-item">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="colReference" checked>
                                <label class="custom-control-label" for="colReference">Reference</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="15%">Date & Time</th>
                                <th width="25%">Product</th>
                                <th width="10%">Type</th>
                                <th width="10%">Quantity</th>
                                <th width="10%">Branch</th>
                                <th width="10%">User</th>
                                <th width="10%">Reference</th>
                                <th width="10%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Movement 1 -->
                            <tr>
                                <td>
                                    2024-01-25<br>
                                    <small class="text-muted">14:30:45</small>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/40" class="rounded mr-3" style="width: 40px; height: 40px;">
                                        <div>
                                            <h6 class="mb-0">Levi's 501 Original Jeans</h6>
                                            <small class="text-muted">SKU: LS-501-BL</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="movement-type" style="background: #dcfce7; color: #166534;">Sale</span>
                                </td>
                                <td>
                                    <div class="quantity-badge bg-danger text-white">-2</div>
                                </td>
                                <td>Main Store</td>
                                <td>John Doe</td>
                                <td>
                                    <span class="badge badge-light">INV-2024-00125</span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-info" title="View Details">
                                        <i class="las la-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            <!-- Movement 2 -->
                            <tr>
                                <td>
                                    2024-01-25<br>
                                    <small class="text-muted">11:15:22</small>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/40" class="rounded mr-3" style="width: 40px; height: 40px;">
                                        <div>
                                            <h6 class="mb-0">Nike Air Max Shoes</h6>
                                            <small class="text-muted">SKU: NK-AM-001</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="movement-type" style="background: #dbeafe; color: #1e40af;">Purchase</span>
                                </td>
                                <td>
                                    <div class="quantity-badge bg-success text-white">+25</div>
                                </td>
                                <td>Warehouse</td>
                                <td>Jane Smith</td>
                                <td>
                                    <span class="badge badge-light">PO-2024-0012</span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-info" title="View Details">
                                        <i class="las la-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            <!-- Movement 3 -->
                            <tr>
                                <td>
                                    2024-01-24<br>
                                    <small class="text-muted">16:45:18</small>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/40" class="rounded mr-3" style="width: 40px; height: 40px;">
                                        <div>
                                            <h6 class="mb-0">Zara Summer Dress</h6>
                                            <small class="text-muted">SKU: ZR-SD-RD</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="movement-type" style="background: #fef3c7; color: #92400e;">Adjustment</span>
                                </td>
                                <td>
                                    <div class="quantity-badge bg-warning text-white">-5</div>
                                </td>
                                <td>Westside Mall</td>
                                <td>Robert Brown</td>
                                <td>
                                    <span class="badge badge-light">ADJ-2024-0034</span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-info" title="View Details">
                                        <i class="las la-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            <!-- Movement 4 -->
                            <tr>
                                <td>
                                    2024-01-24<br>
                                    <small class="text-muted">10:20:33</small>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/40" class="rounded mr-3" style="width: 40px; height: 40px;">
                                        <div>
                                            <h6 class="mb-0">Adidas Running Shoes</h6>
                                            <small class="text-muted">SKU: AD-RS-BK</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="movement-type" style="background: #e0e7ff; color: #3730a3;">Transfer In</span>
                                </td>
                                <td>
                                    <div class="quantity-badge bg-success text-white">+15</div>
                                </td>
                                <td>East City</td>
                                <td>Sarah Wilson</td>
                                <td>
                                    <span class="badge badge-light">TR-2024-0045</span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-info" title="View Details">
                                        <i class="las la-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            <!-- Movement 5 -->
                            <tr>
                                <td>
                                    2024-01-23<br>
                                    <small class="text-muted">15:10:55</small>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/40" class="rounded mr-3" style="width: 40px; height: 40px;">
                                        <div>
                                            <h6 class="mb-0">Levi's Denim Shorts</h6>
                                            <small class="text-muted">SKU: LS-DS-BL</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="movement-type" style="background: #fce7f3; color: #9d174d;">Return</span>
                                </td>
                                <td>
                                    <div class="quantity-badge bg-success text-white">+1</div>
                                </td>
                                <td>Main Store</td>
                                <td>Mike Johnson</td>
                                <td>
                                    <span class="badge badge-light">RTN-2024-0012</span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-info" title="View Details">
                                        <i class="las la-eye"></i>
                                    </button>
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

        <!-- Card View (Hidden by default) -->
        <div class="row" id="cardView" style="display: none;">
            <div class="col-lg-6">
                <div class="movement-card movement-out">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <h6 class="mb-1">Levi's 501 Original Jeans</h6>
                            <small class="text-muted">SKU: LS-501-BL</small>
                        </div>
                        <span class="movement-type" style="background: #dcfce7; color: #166534;">Sale</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="h4 mb-0 text-danger">-2 units</div>
                            <small class="text-muted">Main Store | John Doe</small>
                        </div>
                        <div class="text-right">
                            <div class="small text-muted">2024-01-25 14:30</div>
                            <span class="badge badge-light">INV-2024-00125</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="movement-card movement-in">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <h6 class="mb-1">Nike Air Max Shoes</h6>
                            <small class="text-muted">SKU: NK-AM-001</small>
                        </div>
                        <span class="movement-type" style="background: #dbeafe; color: #1e40af;">Purchase</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="h4 mb-0 text-success">+25 units</div>
                            <small class="text-muted">Warehouse | Jane Smith</small>
                        </div>
                        <div class="text-right">
                            <div class="small text-muted">2024-01-25 11:15</div>
                            <span class="badge badge-light">PO-2024-0012</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Timeline View (Hidden by default) -->
        <div class="card" id="timelineView" style="display: none;">
            <div class="card-body">
                <div class="timeline-item movement-out">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="mb-1">Levi's 501 Original Jeans</h6>
                            <div class="small text-muted">
                                <span class="badge badge-danger">Sale</span> | Main Store | John Doe
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="h5 mb-1 text-danger">-2 units</div>
                            <small class="text-muted">2024-01-25 14:30</small>
                        </div>
                    </div>
                    <div class="mt-2">
                        <span class="badge badge-light">INV-2024-00125</span>
                        <small class="text-muted ml-2">Customer purchase</small>
                    </div>
                </div>
                <div class="timeline-item movement-in">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="mb-1">Nike Air Max Shoes</h6>
                            <div class="small text-muted">
                                <span class="badge badge-success">Purchase</span> | Warehouse | Jane Smith
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="h5 mb-1 text-success">+25 units</div>
                            <small class="text-muted">2024-01-25 11:15</small>
                        </div>
                    </div>
                    <div class="mt-2">
                        <span class="badge badge-light">PO-2024-0012</span>
                        <small class="text-muted ml-2">Stock replenishment</small>
                    </div>
                </div>
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
            // Initialize date range picker
            $('#dateRange').daterangepicker({
                opens: 'left',
                startDate: moment().subtract(30, 'days'),
                endDate: moment(),
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            });
            
            // Column visibility toggles
            $('.custom-control-input').change(function() {
                const columnId = $(this).attr('id').replace('col', '').toLowerCase();
                const columnIndex = getColumnIndex(columnId);
                const isVisible = $(this).is(':checked');
                
                // Toggle column visibility
                $(`table th:nth-child(${columnIndex}), table td:nth-child(${columnIndex})`).toggle(isVisible);
            });
        });
        
        function getColumnIndex(column) {
            const columns = {
                'product': 2,
                'branch': 5,
                'user': 6,
                'reference': 7
            };
            return columns[column] || 1;
        }
        
        function setView(viewType) {
            // Hide all views
            $('#tableView, #cardView, #timelineView').hide();
            
            // Show selected view
            $(`#${viewType}View`).show();
            
            console.log('Switched to', viewType, 'view');
        }
        
        function setQuickFilter(filter) {
            // Remove active class from all tags
            $('.filter-tag').removeClass('active');
            
            // Add active class to clicked tag
            $(event.target).addClass('active');
            
            console.log('Applying quick filter:', filter);
            
            // Implement filter logic
            switch(filter) {
                case 'today':
                    $('#dateRange').val(moment().format('MM/DD/YYYY') + ' - ' + moment().format('MM/DD/YYYY'));
                    break;
                case 'week':
                    $('#dateRange').val(moment().subtract(6, 'days').format('MM/DD/YYYY') + ' - ' + moment().format('MM/DD/YYYY'));
                    break;
                case 'month':
                    $('#dateRange').val(moment().startOf('month').format('MM/DD/YYYY') + ' - ' + moment().endOf('month').format('MM/DD/YYYY'));
                    break;
                case 'sales':
                    $('#movementType').val('sale');
                    break;
                case 'purchases':
                    $('#movementType').val('purchase');
                    break;
                case 'adjustments':
                    $('#movementType').val('adjustment');
                    break;
                case 'transfers':
                    $('#movementType').val('transfer');
                    break;
            }
            
            applyFilters();
        }
        
        function applyFilters() {
            const dateRange = $('#dateRange').val();
            const type = $('#movementType').val();
            const branch = $('#branchFilter').val();
            
            console.log('Applying filters:', { dateRange, type, branch });
            alert('Filters applied! Showing filtered results.');
            
            // In a real app, this would make an AJAX call to reload data
        }
        
        function resetFilters() {
            $('#dateRange').val('');
            $('#movementType').val('');
            $('#branchFilter').val('');
            $('.filter-tag').removeClass('active');
            alert('Filters reset.');
            
            // In a real app, this would reload all data
        }
        
        function exportMovements() {
            alert('Exporting stock movements report...');
            // Implement export functionality
        }
        
        function printReport() {
            window.print();
        }
    </script>
    @endpush
</x-app-layout>