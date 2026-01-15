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
                <h4 class="mb-3">Sales Management</h4>
                <p class="mb-0">View and manage all sales transactions</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Sales</li>
                    </ol>
                </nav>
            </div>
            <div class="d-flex">
                <a href="{{ route('sales.create') }}" class="btn btn-primary add-list">
                    <i class="las la-plus mr-2"></i>New Sale
                </a>
                <a href="{{ route('pos.index') }}" class="btn btn-success ml-2">
                    <i class="las la-cash-register mr-2"></i>POS
                </a>
            </div>
        </div>

        <!-- Sales Statistics -->
        <div class="row mb-4">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-white mb-0">Today's Sales</h6>
                                <h2 class="mb-0 text-white">₹45,820</h2>
                                <small class="text-white-50">12 orders</small>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-shopping-cart fa-2x text-primary"></i>
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
                                <h6 class="text-white mb-0">This Month</h6>
                                <h2 class="mb-0 text-white">₹5,42,150</h2>
                                <small class="text-white-50">248 orders</small>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-chart-line fa-2x text-success"></i>
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
                                <h6 class="text-white mb-0">Pending Orders</h6>
                                <h2 class="mb-0 text-white">8</h2>
                                <small class="text-white-50">₹24,500</small>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-clock fa-2x text-warning"></i>
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
                                <h6 class="text-white mb-0">Returns</h6>
                                <h2 class="mb-0 text-white">₹12,450</h2>
                                <small class="text-white-50">5 returns</small>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-exchange-alt fa-2x text-info"></i>
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
                            <input type="text" class="form-control date-range-picker" placeholder="Select date range">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Invoice No</label>
                            <input type="text" class="form-control" placeholder="Search invoice">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Customer</label>
                            <select class="form-control">
                                <option value="">All Customers</option>
                                <option value="walk_in">Walk-in Customer</option>
                                <option value="regular">Regular Customers</option>
                                <option value="vip">VIP Customers</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control">
                                <option value="">All Status</option>
                                <option value="completed">Completed</option>
                                <option value="pending">Pending</option>
                                <option value="cancelled">Cancelled</option>
                                <option value="returned">Returned</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <div class="form-group w-100 d-flex">
                            <button class="btn btn-primary mr-2 flex-grow-1">Filter</button>
                            <button class="btn btn-outline-secondary">Reset</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sales Table -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Invoice No</th>
                                <th>Date & Time</th>
                                <th>Customer</th>
                                <th>Items</th>
                                <th>Total Amount</th>
                                <th>Payment</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Sale 1 -->
                            <tr>
                                <td>
                                    <strong class="text-primary">INV-2024-00123</strong>
                                    <br>
                                    <small class="text-muted">POS Sale</small>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <strong>15 Nov 2024</strong>
                                        <small class="text-muted">10:30 AM</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm mr-2">
                                            <img src="https://ui-avatars.com/api/?name=John+Smith&background=007bff&color=fff" 
                                                 class="rounded-circle" alt="John Smith">
                                        </div>
                                        <div>
                                            <h6 class="mb-0">John Smith</h6>
                                            <small class="text-muted">Regular Customer</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <strong>3 items</strong>
                                        <small class="text-muted">₹1,299 × 2, ₹899 × 1</small>
                                    </div>
                                </td>
                                <td>
                                    <strong class="text-success">₹3,497</strong>
                                    <br>
                                    <small class="text-muted">Paid: ₹3,497</small>
                                </td>
                                <td>
                                    <span class="badge badge-success">Paid</span>
                                    <br>
                                    <small class="text-muted">Cash</small>
                                </td>
                                <td>
                                    <span class="badge badge-success">Completed</span>
                                    <br>
                                    <small class="text-muted">Delivered</small>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('sales.show', 1) }}" class="btn btn-sm btn-info mr-2" title="View">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="{{ route('sales.show', 1) }}/invoice" class="btn btn-sm btn-primary mr-2" title="Invoice">
                                            <i class="las la-file-invoice"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-warning mr-2" title="Return">
                                            <i class="las la-exchange-alt"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-danger" title="Cancel">
                                            <i class="las la-times"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            <!-- Sale 2 -->
                            <tr>
                                <td>
                                    <strong class="text-primary">INV-2024-00122</strong>
                                    <br>
                                    <small class="text-muted">Online Sale</small>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <strong>15 Nov 2024</strong>
                                        <small class="text-muted">09:15 AM</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm mr-2">
                                            <img src="https://ui-avatars.com/api/?name=Sarah+Johnson&background=28a745&color=fff" 
                                                 class="rounded-circle" alt="Sarah Johnson">
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Sarah Johnson</h6>
                                            <small class="text-muted">VIP Customer</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <strong>5 items</strong>
                                        <small class="text-muted">₹2,499 × 1, ₹899 × 4</small>
                                    </div>
                                </td>
                                <td>
                                    <strong class="text-success">₹6,095</strong>
                                    <br>
                                    <small class="text-muted">Paid: ₹6,095</small>
                                </td>
                                <td>
                                    <span class="badge badge-success">Paid</span>
                                    <br>
                                    <small class="text-muted">Card</small>
                                </td>
                                <td>
                                    <span class="badge badge-primary">Processing</span>
                                    <br>
                                    <small class="text-muted">Packaging</small>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('sales.show', 2) }}" class="btn btn-sm btn-info mr-2" title="View">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="{{ route('sales.show', 2) }}/invoice" class="btn btn-sm btn-primary mr-2" title="Invoice">
                                            <i class="las la-file-invoice"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-success mr-2" title="Ship">
                                            <i class="las la-shipping-fast"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-danger" title="Cancel">
                                            <i class="las la-times"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            <!-- Sale 3 -->
                            <tr>
                                <td>
                                    <strong class="text-primary">INV-2024-00121</strong>
                                    <br>
                                    <small class="text-muted">Walk-in Sale</small>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <strong>14 Nov 2024</strong>
                                        <small class="text-muted">04:45 PM</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm mr-2">
                                            <div class="rounded-circle bg-light d-flex align-items-center justify-content-center" 
                                                 style="width: 32px; height: 32px;">
                                                <i class="las la-user text-muted"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Walk-in Customer</h6>
                                            <small class="text-muted">No account</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <strong>2 items</strong>
                                        <small class="text-muted">₹1,899 × 2</small>
                                    </div>
                                </td>
                                <td>
                                    <strong class="text-success">₹3,798</strong>
                                    <br>
                                    <small class="text-muted">Paid: ₹3,798</small>
                                </td>
                                <td>
                                    <span class="badge badge-success">Paid</span>
                                    <br>
                                    <small class="text-muted">UPI</small>
                                </td>
                                <td>
                                    <span class="badge badge-success">Completed</span>
                                    <br>
                                    <small class="text-muted">Pickup</small>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('sales.show', 3) }}" class="btn btn-sm btn-info mr-2" title="View">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="{{ route('sales.show', 3) }}/invoice" class="btn btn-sm btn-primary mr-2" title="Invoice">
                                            <i class="las la-file-invoice"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-warning mr-2" title="Return">
                                            <i class="las la-exchange-alt"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-danger" title="Cancel">
                                            <i class="las la-times"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            <!-- Sale 4 - Pending Payment -->
                            <tr>
                                <td>
                                    <strong class="text-primary">INV-2024-00120</strong>
                                    <br>
                                    <small class="text-muted">Phone Order</small>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <strong>14 Nov 2024</strong>
                                        <small class="text-muted">02:30 PM</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm mr-2">
                                            <img src="https://ui-avatars.com/api/?name=Michael+Brown&background=ffc107&color=000" 
                                                 class="rounded-circle" alt="Michael Brown">
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Michael Brown</h6>
                                            <small class="text-muted">Credit Customer</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <strong>1 item</strong>
                                        <small class="text-muted">₹4,599 × 1</small>
                                    </div>
                                </td>
                                <td>
                                    <strong class="text-warning">₹4,599</strong>
                                    <br>
                                    <small class="text-muted">Paid: ₹2,000</small>
                                </td>
                                <td>
                                    <span class="badge badge-warning">Partial</span>
                                    <br>
                                    <small class="text-muted">Due: ₹2,599</small>
                                </td>
                                <td>
                                    <span class="badge badge-warning">Pending</span>
                                    <br>
                                    <small class="text-muted">Awaiting Payment</small>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('sales.show', 4) }}" class="btn btn-sm btn-info mr-2" title="View">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="{{ route('sales.show', 4) }}/invoice" class="btn btn-sm btn-primary mr-2" title="Invoice">
                                            <i class="las la-file-invoice"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-success mr-2" title="Receive Payment">
                                            <i class="las la-money-bill-wave"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-danger" title="Cancel">
                                            <i class="las la-times"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            <!-- Sale 5 - Returned -->
                            <tr>
                                <td>
                                    <strong class="text-primary">INV-2024-00119</strong>
                                    <br>
                                    <small class="text-muted">Online Sale</small>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <strong>13 Nov 2024</strong>
                                        <small class="text-muted">11:00 AM</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm mr-2">
                                            <img src="https://ui-avatars.com/api/?name=Emma+Wilson&background=6f42c1&color=fff" 
                                                 class="rounded-circle" alt="Emma Wilson">
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Emma Wilson</h6>
                                            <small class="text-muted">Regular Customer</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <strong>3 items</strong>
                                        <small class="text-muted">₹2,999 × 1, ₹1,299 × 2</small>
                                    </div>
                                </td>
                                <td>
                                    <strong class="text-danger">₹5,597</strong>
                                    <br>
                                    <small class="text-muted">Refunded: ₹1,299</small>
                                </td>
                                <td>
                                    <span class="badge badge-info">Refunded</span>
                                    <br>
                                    <small class="text-muted">Card Refund</small>
                                </td>
                                <td>
                                    <span class="badge badge-danger">Returned</span>
                                    <br>
                                    <small class="text-muted">Size Issue</small>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('sales.show', 5) }}" class="btn btn-sm btn-info mr-2" title="View">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="{{ route('sales.show', 5) }}/invoice" class="btn btn-sm btn-primary mr-2" title="Invoice">
                                            <i class="las la-file-invoice"></i>
                                        </a>
                                        <a href="{{ route('sale-returns.index') }}" class="btn btn-sm btn-secondary mr-2" title="Return Details">
                                            <i class="las la-clipboard-list"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-danger" title="Delete">
                                            <i class="las la-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            <!-- Sale 6 - Cancelled -->
                            <tr>
                                <td>
                                    <strong class="text-primary">INV-2024-00118</strong>
                                    <br>
                                    <small class="text-muted">POS Sale</small>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <strong>12 Nov 2024</strong>
                                        <small class="text-muted">03:15 PM</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm mr-2">
                                            <img src="https://ui-avatars.com/api/?name=David+Miller&background=17a2b8&color=fff" 
                                                 class="rounded-circle" alt="David Miller">
                                        </div>
                                        <div>
                                            <h6 class="mb-0">David Miller</h6>
                                            <small class="text-muted">Walk-in Customer</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <strong>4 items</strong>
                                        <small class="text-muted">₹899 × 4</small>
                                    </div>
                                </td>
                                <td>
                                    <strong class="text-secondary">₹3,596</strong>
                                    <br>
                                    <small class="text-muted">Cancelled</small>
                                </td>
                                <td>
                                    <span class="badge badge-secondary">Cancelled</span>
                                </td>
                                <td>
                                    <span class="badge badge-secondary">Cancelled</span>
                                    <br>
                                    <small class="text-muted">Customer Request</small>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('sales.show', 6) }}" class="btn btn-sm btn-info mr-2" title="View">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-warning mr-2" title="Restore">
                                            <i class="las la-redo"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-danger" title="Delete">
                                            <i class="las la-trash"></i>
                                        </a>
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

    @push('js')
    <!-- Backend Bundle JavaScript -->
    <script src="{{ asset('backend/assets/js/backend-bundle.min.js') }}"></script>
    
    <!-- app JavaScript -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    
    <!-- Date Range Picker -->
    <script src="{{ asset('backend/assets/vendor/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendor/daterangepicker/daterangepicker.js') }}"></script>
    
    <script>
        $(document).ready(function() {
            // Initialize date range picker
            $('.date-range-picker').daterangepicker({
                opens: 'left',
                locale: {
                    format: 'DD/MM/YYYY'
                }
            });
            
            // Tooltip initialization
            $('[title]').tooltip();
        });
    </script>
    @endpush
</x-app-layout>