<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/remixicon/fonts/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <style>
        .aging-header {
            background: linear-gradient(135deg, #dc3545 0%, #e83e8c 100%);
            color: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .aging-bucket {
            text-align: center;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .current {
            background: #d4edda;
            border-left: 4px solid #28a745;
        }

        .days30 {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
        }

        .days60 {
            background: #f8d7da;
            border-left: 4px solid #dc3545;
        }

        .days90 {
            background: #d1ecf1;
            border-left: 4px solid #17a2b8;
        }

        .over90 {
            background: #e2e3e5;
            border-left: 4px solid #6c757d;
        }

        .supplier-row {
            padding: 10px 15px;
            border-bottom: 1px solid #e9ecef;
            transition: all 0.3s;
        }

        .supplier-row:hover {
            background-color: #f8f9fa;
        }

        .invoice-item {
            padding-left: 30px;
            font-size: 0.9rem;
        }

        .invoice-date {
            width: 100px;
        }

        .invoice-amount {
            width: 120px;
            text-align: right;
        }

        .invoice-age {
            width: 80px;
            text-align: center;
        }

        .invoice-status {
            width: 100px;
        }

        .age-badge {
            font-size: 0.8rem;
            padding: 3px 8px;
            border-radius: 10px;
        }

        .age-current {
            background: #d4edda;
            color: #155724;
        }

        .age-warning {
            background: #fff3cd;
            color: #856404;
        }

        .age-danger {
            background: #f8d7da;
            color: #721c24;
        }

        .action-buttons {
            width: 150px;
        }

        .total-row {
            background: #e9ecef;
            font-weight: 600;
            padding: 15px;
            font-size: 1.1rem;
        }

        .payment-priority {
            width: 120px;
        }

        .priority-high {
            background: #f8d7da;
            color: #721c24;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 0.8rem;
        }

        .priority-medium {
            background: #fff3cd;
            color: #856404;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 0.8rem;
        }

        .priority-low {
            background: #d4edda;
            color: #155724;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 0.8rem;
        }
    </style>
    @endpush

    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
            <div>
                <h4 class="mb-3">Accounts Payable Aging Report</h4>
                <p class="mb-0">As of {{ date('F d, Y') }}</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('accounts.reports.index') }}">Reports</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('accounts.reports.index') }}">Financial Reports</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('accounts.reports.aging.index') }}">Aging Reports</a></li>
                        <li class="breadcrumb-item active">Payables Aging</li>
                    </ol>
                </nav>
            </div>
            <div>
                <button type="button" class="btn btn-outline-secondary mr-2" onclick="printReport()">
                    <i class="las la-print mr-2"></i>Print
                </button>
                <button type="button" class="btn btn-outline-primary mr-2" onclick="exportReport()">
                    <i class="las la-download mr-2"></i>Export
                </button>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#filterModal">
                    <i class="las la-filter mr-2"></i>Filter
                </button>
            </div>
        </div>

        <!-- Aging Summary -->
        <div class="aging-header">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h2 class="mb-2">Total Payables: Rs650,000</h2>
                    <div class="d-flex">
                        <div class="mr-4">
                            <small class="d-block">Active Suppliers</small>
                            <h4 class="mb-0">24</h4>
                        </div>
                        <div class="mr-4">
                            <small class="d-block">Overdue Bills</small>
                            <h4 class="mb-0">8</h4>
                        </div>
                        <div>
                            <small class="d-block">Average Days Payable</small>
                            <h4 class="mb-0">35</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-right">
                    <div class="alert alert-light">
                        <h5 class="mb-1">Payment Efficiency</h5>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-success" style="width: 92%"></div>
                        </div>
                        <small class="mb-0">92% paid within terms</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Aging Buckets -->
        <div class="row mb-4">
            <div class="col-xl-2 col-md-4 col-sm-6">
                <div class="aging-bucket current">
                    <h5 class="mb-1">Current</h5>
                    <h3 class="mb-2">Rs400,000</h3>
                    <small>0-30 days</small>
                </div>
            </div>
            <div class="col-xl-2 col-md-4 col-sm-6">
                <div class="aging-bucket days30">
                    <h5 class="mb-1">31-60 Days</h5>
                    <h3 class="mb-2">Rs150,000</h3>
                    <small>15 bills</small>
                </div>
            </div>
            <div class="col-xl-2 col-md-4 col-sm-6">
                <div class="aging-bucket days60">
                    <h5 class="mb-1">61-90 Days</h5>
                    <h3 class="mb-2">Rs75,000</h3>
                    <small>10 bills</small>
                </div>
            </div>
            <div class="col-xl-2 col-md-4 col-sm-6">
                <div class="aging-bucket days90">
                    <h5 class="mb-1">91-180 Days</h5>
                    <h3 class="mb-2">Rs20,000</h3>
                    <small>4 bills</small>
                </div>
            </div>
            <div class="col-xl-2 col-md-4 col-sm-6">
                <div class="aging-bucket over90">
                    <h5 class="mb-1">Over 180 Days</h5>
                    <h3 class="mb-2">Rs5,000</h3>
                    <small>2 bills</small>
                </div>
            </div>
            <div class="col-xl-2 col-md-4 col-sm-6">
                <div class="aging-bucket" style="background: #f8f9fa; border-left: 4px solid #6c757d;">
                    <h5 class="mb-1">Total Due</h5>
                    <h3 class="mb-2">Rs650,000</h3>
                    <small>45 bills</small>
                </div>
            </div>
        </div>

        <!-- Supplier Aging Details -->
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5 class="mb-0">Supplier Aging Details</h5>
                <div>
                    <input type="text" class="form-control form-control-sm" placeholder="Search suppliers..."
                        style="width: 200px;" onkeyup="searchSuppliers(this.value)">
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0" id="agingTable">
                        <thead>
                            <tr class="bg-light">
                                <th>Supplier</th>
                                <th class="text-center">Current</th>
                                <th class="text-center">31-60 Days</th>
                                <th class="text-center">61-90 Days</th>
                                <th class="text-center">91-180 Days</th>
                                <th class="text-center">Over 180 Days</th>
                                <th class="text-right">Total Due</th>
                                <th>Credit Used</th>
                                <th>Payment Priority</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="supplier-row">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="mr-3">
                                            <i class="las la-industry fa-2x text-primary"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">Fashion Textiles Ltd.</h6>
                                            <small class="text-muted">SUPP-001 | Manufacturer</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="badge age-current">Rs75,000</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge age-warning">Rs25,000</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge age-danger">Rs15,000</span>
                                </td>
                                <td class="text-center">
                                    <span>-</span>
                                </td>
                                <td class="text-center">
                                    <span>-</span>
                                </td>
                                <td class="text-right">
                                    <strong>Rs115,000</strong>
                                </td>
                                <td>
                                    <div class="progress" style="height: 6px;">
                                        <div class="progress-bar bg-danger" style="width: 95%"></div>
                                    </div>
                                    <small>Used: Rs115,000 of Rs120,000</small>
                                </td>
                                <td class="payment-priority">
                                    <span class="priority-high">High Priority</span>
                                </td>
                                <td class="action-buttons">
                                    <button class="btn btn-sm btn-outline-primary" onclick="viewSupplier(1)">
                                        <i class="las la-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-success" onclick="makePayment(1)">
                                        <i class="las la-money-bill"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-info" onclick="schedulePayment(1)">
                                        <i class="las la-calendar"></i>
                                    </button>
                                </td>
                            </tr>

                            <!-- Supplier Invoice Details (Collapsible) -->
                            <tr id="supplierDetails1" style="display: none;">
                                <td colspan="10" class="p-0">
                                    <div class="p-3 bg-light">
                                        <h6 class="mb-3">Outstanding Bills for Fashion Textiles Ltd.</h6>
                                        <div class="table-responsive">
                                            <table class="table table-sm">
                                                <thead>
                                                    <tr>
                                                        <th>Bill #</th>
                                                        <th>Date</th>
                                                        <th>Due Date</th>
                                                        <th class="text-right">Amount</th>
                                                        <th class="text-center">Days Overdue</th>
                                                        <th>Payment Terms</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>BILL-20240315-001</td>
                                                        <td>2024-03-15</td>
                                                        <td>2024-04-14</td>
                                                        <td class="text-right">Rs50,000</td>
                                                        <td class="text-center">
                                                            <span class="badge age-current">Current</span>
                                                        </td>
                                                        <td>Net 30</td>
                                                        <td>
                                                            <button class="btn btn-sm btn-outline-primary">
                                                                <i class="las la-file-invoice"></i>
                                                            </button>
                                                            <button class="btn btn-sm btn-outline-success">
                                                                <i class="las la-check-circle"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <!-- More bills... -->
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <!-- More supplier rows... -->
                        </tbody>
                        <tfoot>
                            <tr class="total-row">
                                <td><strong>TOTAL</strong></td>
                                <td class="text-center"><strong>Rs400,000</strong></td>
                                <td class="text-center"><strong>Rs150,000</strong></td>
                                <td class="text-center"><strong>Rs75,000</strong></td>
                                <td class="text-center"><strong>Rs20,000</strong></td>
                                <td class="text-center"><strong>Rs5,000</strong></td>
                                <td class="text-right"><strong>Rs650,000</strong></td>
                                <td colspan="3"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <!-- Payment Analysis -->
        <div class="row mt-4">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Aging Analysis</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Aging Period</th>
                                        <th>Amount</th>
                                        <th>% of Total</th>
                                        <th># of Bills</th>
                                        <th>Average per Bill</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Current (0-30 days)</td>
                                        <td class="text-success">Rs400,000</td>
                                        <td>61.5%</td>
                                        <td>30</td>
                                        <td>Rs13,333</td>
                                    </tr>
                                    <tr>
                                        <td>31-60 days</td>
                                        <td class="text-warning">Rs150,000</td>
                                        <td>23.1%</td>
                                        <td>15</td>
                                        <td>Rs10,000</td>
                                    </tr>
                                    <tr>
                                        <td>61-90 days</td>
                                        <td class="text-danger">Rs75,000</td>
                                        <td>11.5%</td>
                                        <td>10</td>
                                        <td>Rs7,500</td>
                                    </tr>
                                    <tr>
                                        <td>91-180 days</td>
                                        <td>Rs20,000</td>
                                        <td>3.1%</td>
                                        <td>4</td>
                                        <td>Rs5,000</td>
                                    </tr>
                                    <tr>
                                        <td>Over 180 days</td>
                                        <td>Rs5,000</td>
                                        <td>0.8%</td>
                                        <td>2</td>
                                        <td>Rs2,500</td>
                                    </tr>
                                    <tr class="table-active">
                                        <td><strong>Total</strong></td>
                                        <td><strong>Rs650,000</strong></td>
                                        <td><strong>100%</strong></td>
                                        <td><strong>61</strong></td>
                                        <td><strong>Rs10,656</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Payment Recommendations</h5>
                    </div>
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            <div class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">Immediate Payment Required</h6>
                                        <p class="mb-0 small">Critical suppliers with overdue bills</p>
                                    </div>
                                    <span class="badge badge-danger">Rs95,000</span>
                                </div>
                            </div>
                            <div class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">Schedule This Week</h6>
                                        <p class="mb-0 small">Bills due within 7 days</p>
                                    </div>
                                    <span class="badge badge-warning">Rs150,000</span>
                                </div>
                            </div>
                            <div class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">Negotiate Payment Terms</h6>
                                        <p class="mb-0 small">Suppliers with long overdue amounts</p>
                                    </div>
                                    <span class="badge badge-info">Rs45,000</span>
                                </div>
                            </div>
                            <div class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">Upcoming Payments</h6>
                                        <p class="mb-0 small">Bills due next 30 days</p>
                                    </div>
                                    <span class="badge badge-primary">Rs360,000</span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <h6>Payment Strategy</h6>
                            <div class="progress mb-2" style="height: 10px;">
                                <div class="progress-bar bg-success" style="width: 62%"></div>
                                <div class="progress-bar bg-warning" style="width: 23%"></div>
                                <div class="progress-bar bg-danger" style="width: 15%"></div>
                            </div>
                            <div class="d-flex justify-content-between small">
                                <span>Current (62%)</span>
                                <span>31-90 days (23%)</span>
                                <span>Over 90 days (15%)</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cash Flow Impact -->
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Cash Flow Impact Analysis</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="text-center p-3 border rounded">
                                    <h3 class="mb-1 text-danger">Rs650,000</h3>
                                    <p class="mb-0 small">Total Payables</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-center p-3 border rounded">
                                    <h3 class="mb-1 text-warning">Rs245,000</h3>
                                    <p class="mb-0 small">Overdue Amount</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-center p-3 border rounded">
                                    <h3 class="mb-1 text-success">Rs405,000</h3>
                                    <p class="mb-0 small">Available Cash for Payments</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <h6>Payment Schedule Recommendation</h6>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Week</th>
                                            <th>Priority</th>
                                            <th>Supplier Count</th>
                                            <th>Amount</th>
                                            <th>Cash Required</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>This Week</td>
                                            <td><span class="priority-high">High</span></td>
                                            <td>8</td>
                                            <td>Rs95,000</td>
                                            <td class="text-success">Rs95,000</td>
                                            <td><span class="badge badge-warning">Pending</span></td>
                                        </tr>
                                        <tr>
                                            <td>Next Week</td>
                                            <td><span class="priority-medium">Medium</span></td>
                                            <td>12</td>
                                            <td>Rs150,000</td>
                                            <td class="text-success">Rs245,000</td>
                                            <td><span class="badge badge-info">Scheduled</span></td>
                                        </tr>
                                        <tr>
                                            <td>Week 3</td>
                                            <td><span class="priority-low">Low</span></td>
                                            <td>15</td>
                                            <td>Rs200,000</td>
                                            <td class="text-danger">Rs445,000</td>
                                            <td><span class="badge badge-secondary">Review</span></td>
                                        </tr>
                                    </tbody>
                                </table>
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
                    <h5 class="modal-title">Payables Aging Filters</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="filterForm">
                        <div class="form-group">
                            <label>Aging Date</label>
                            <input type="date" class="form-control" name="aging_date" value="{{ date('Y-m-d') }}">
                        </div>
                        <div class="form-group">
                            <label>Branch</label>
                            <select class="form-control" name="branch_id">
                                <option value="all">All Branches</option>
                                <option value="1">Main Branch</option>
                                <option value="2">Downtown Branch</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Supplier Type</label>
                            <select class="form-control" name="supplier_type">
                                <option value="all">All Suppliers</option>
                                <option value="manufacturer">Manufacturer</option>
                                <option value="wholesaler">Wholesaler</option>
                                <option value="distributor">Distributor</option>
                                <option value="local">Local Vendor</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Minimum Amount</label>
                            <input type="number" class="form-control" name="min_amount" placeholder="0" min="0">
                        </div>
                        <div class="form-group">
                            <label>Show Only Overdue</label>
                            <select class="form-control" name="show_overdue">
                                <option value="no">No (Show All)</option>
                                <option value="yes">Yes (Overdue Only)</option>
                                <option value="30">Over 30 Days</option>
                                <option value="60">Over 60 Days</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="showPaymentSchedule" checked>
                                <label class="custom-control-label" for="showPaymentSchedule">Show payment schedule</label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="applyFilters()">Generate Report</button>
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
            $('#agingTable').DataTable({
                pageLength: 10,
                responsive: true,
                order: [
                    [6, 'desc']
                ],
                columnDefs: [{
                    orderable: false,
                    targets: [9]
                }]
            });

            // Toggle supplier details
            window.viewSupplier = function(supplierId) {
                const detailsRow = $(`#supplierDetails${supplierId}`);
                if (detailsRow.is(':visible')) {
                    detailsRow.slideUp();
                } else {
                    detailsRow.slideDown();
                }
            };

            // Make payment
            window.makePayment = function(supplierId) {
                alert('Opening payment processing form...');
                // In real app: open payment modal or redirect
            };

            // Schedule payment
            window.schedulePayment = function(supplierId) {
                const paymentDate = prompt('Enter payment date (YYYY-MM-DD):', '{{ date("Y-m-d", strtotime("+7 days")) }}');
                if (paymentDate) {
                    alert(`Payment scheduled for ${paymentDate}`);
                    // In real app: API call to schedule payment
                }
            };
        });

        // Search suppliers
        window.searchSuppliers = function(searchTerm) {
            const table = $('#agingTable').DataTable();
            table.search(searchTerm).draw();
        };

        // Print report
        window.printReport = function() {
            window.print();
        };

        // Export report
        window.exportReport = function() {
            const format = prompt('Select export format (PDF, Excel, CSV):', 'PDF');
            if (format) {
                alert(`Exporting payables aging report in ${format} format...`);
                // In real app: window.location.href = `/accounts/reports/aging/payables/export?format=${format}`;
            }
        };

        // Apply filters
        window.applyFilters = function() {
            const formData = new FormData(document.getElementById('filterForm'));
            const filters = Object.fromEntries(formData);
            console.log('Applying filters:', filters);

            alert('Generaging payables aging report with selected filters...');
            $('#filterModal').modal('hide');
            // In real app: reload page with filters or make API call
        };
    </script>
    @endpush
</x-app-layout>