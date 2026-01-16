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
                <h4 class="mb-3">Daily Sales Report</h4>
                <p class="mb-0">Daily sales performance and transactions</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#">Sales Reports</a></li>
                        <li class="breadcrumb-item active">Daily Report</li>
                    </ol>
                </nav>
            </div>
            <div>
                <button class="btn btn-outline-primary" onclick="exportDailyReport()">
                    <i class="las la-file-excel mr-2"></i>Export
                </button>
                <button class="btn btn-primary ml-2" onclick="printDailyReport()">
                    <i class="las la-print mr-2"></i>Print
                </button>
            </div>
        </div>

        <!-- Date Selector -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Select Date</label>
                            <input type="date" class="form-control" id="reportDate" value="2024-01-15">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Compare With</label>
                            <select class="form-control" id="compareWith">
                                <option value="">No Comparison</option>
                                <option value="yesterday">Yesterday</option>
                                <option value="last_week">Last Week Same Day</option>
                                <option value="last_month">Last Month Same Day</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Branch</label>
                            <select class="form-control" id="dailyBranchFilter">
                                <option value="">All Branches</option>
                                <option value="1" selected>Main Store</option>
                                <option value="2">Warehouse</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <button class="btn btn-primary btn-block" onclick="loadDailyReport()">
                                <i class="las la-filter mr-2"></i>Generate Report
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Daily Summary -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Today's Sales</div>
                                <div class="h2 mb-0 font-weight-bold text-gray-800">Rs 45,680</div>
                                <div class="mt-2 mb-0 text-muted">
                                    <span class="text-success"><i class="fas fa-arrow-up mr-1"></i>12.5%</span>
                                    from yesterday
                                </div>
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
                                    Transactions</div>
                                <div class="h2 mb-0 font-weight-bold text-gray-800">128</div>
                                <div class="mt-2 mb-0 text-muted">
                                    <span class="text-success"><i class="fas fa-arrow-up mr-1"></i>8.2%</span>
                                    from yesterday
                                </div>
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
                                    Avg. Order Value</div>
                                <div class="h2 mb-0 font-weight-bold text-gray-800">Rs 3,568</div>
                                <div class="mt-2 mb-0 text-muted">
                                    <span class="text-success"><i class="fas fa-arrow-up mr-1"></i>5.7%</span>
                                    from yesterday
                                </div>
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
                                    Returns</div>
                                <div class="h2 mb-0 font-weight-bold text-gray-8">Rs 1,240</div>
                                <div class="mt-2 mb-0 text-muted">
                                    <span class="text-danger"><i class="fas fa-arrow-up mr-1"></i>2.1%</span>
                                    of total sales
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hourly Breakdown -->
        <div class="row mb-4">
            <div class="col-lg-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Hourly Sales Breakdown</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-bar">
                            <canvas id="hourlyBreakdownChart" height="250"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Payment Methods</h6>
                    </div>
                    <div class="card-body">
                        <canvas id="dailyPaymentChart" height="250"></canvas>
                        <div class="mt-4">
                            <div class="row text-center">
                                <div class="col-6">
                                    <div class="h4 font-weight-bold">Rs 28,450</div>
                                    <small class="text-muted">Cash Sales</small>
                                </div>
                                <div class="col-6">
                                    <div class="h4 font-weight-bold">Rs 17,230</div>
                                    <small class="text-muted">Digital Sales</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Daily Transactions Table -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Today's Transactions</h6>
                <span class="badge badge-primary">15 January 2024</span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dailyTransactionsTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Time</th>
                                <th>Invoice #</th>
                                <th>Customer</th>
                                <th>Items</th>
                                <th>Amount</th>
                                <th>Payment</th>
                                <th>Staff</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Transaction 1 -->
                            <tr>
                                <td>09:15</td>
                                <td>INV-20240115-001</td>
                                <td>Customer 1</td>
                                <td>3</td>
                                <td class="font-weight-bold">Rs 8,450</td>
                                <td>
                                    <span class="badge badge-success">Cash</span>
                                </td>
                                <td>Staff 1</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-outline-primary">
                                        <i class="las la-eye"></i>
                                    </a>
                                </td>
                            </tr>

                            <!-- Transaction 2 -->
                            <tr>
                                <td>10:30</td>
                                <td>INV-20240115-002</td>
                                <td>Customer 2</td>
                                <td>2</td>
                                <td class="font-weight-bold">Rs 5,280</td>
                                <td>
                                    <span class="badge badge-primary">Card</span>
                                </td>
                                <td>Staff 2</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-outline-primary">
                                        <i class="las la-eye"></i>
                                    </a>
                                </td>
                            </tr>

                            <!-- Transaction 3 -->
                            <tr>
                                <td>11:45</td>
                                <td>INV-20240115-003</td>
                                <td>Customer 3</td>
                                <td>4</td>
                                <td class="font-weight-bold">Rs 12,850</td>
                                <td>
                                    <span class="badge badge-info">UPI</span>
                                </td>
                                <td>Staff 3</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-outline-primary">
                                        <i class="las la-eye"></i>
                                    </a>
                                </td>
                            </tr>

                            <!-- Transaction 4 -->
                            <tr>
                                <td>12:20</td>
                                <td>INV-20240115-004</td>
                                <td>Customer 4</td>
                                <td>1</td>
                                <td class="font-weight-bold">Rs 3,200</td>
                                <td>
                                    <span class="badge badge-success">Cash</span>
                                </td>
                                <td>Staff 1</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-outline-primary">
                                        <i class="las la-eye"></i>
                                    </a>
                                </td>
                            </tr>

                            <!-- Transaction 5 -->
                            <tr>
                                <td>14:30</td>
                                <td>INV-20240115-005</td>
                                <td>Customer 5</td>
                                <td>5</td>
                                <td class="font-weight-bold">Rs 15,420</td>
                                <td>
                                    <span class="badge badge-primary">Card</span>
                                </td>
                                <td>Staff 2</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-outline-primary">
                                        <i class="las la-eye"></i>
                                    </a>
                                </td>
                            </tr>

                            <!-- Transaction 6 -->
                            <tr>
                                <td>15:45</td>
                                <td>INV-20240115-006</td>
                                <td>Customer 6</td>
                                <td>2</td>
                                <td class="font-weight-bold">Rs 6,850</td>
                                <td>
                                    <span class="badge badge-info">UPI</span>
                                </td>
                                <td>Staff 3</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-outline-primary">
                                        <i class="las la-eye"></i>
                                    </a>
                                </td>
                            </tr>

                            <!-- Transaction 7 -->
                            <tr>
                                <td>16:20</td>
                                <td>INV-20240115-007</td>
                                <td>Customer 7</td>
                                <td>3</td>
                                <td class="font-weight-bold">Rs 9,250</td>
                                <td>
                                    <span class="badge badge-success">Cash</span>
                                </td>
                                <td>Staff 1</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-outline-primary">
                                        <i class="las la-eye"></i>
                                    </a>
                                </td>
                            </tr>

                            <!-- Transaction 8 -->
                            <tr>
                                <td>17:30</td>
                                <td>INV-20240115-008</td>
                                <td>Customer 8</td>
                                <td>4</td>
                                <td class="font-weight-bold">Rs 11,680</td>
                                <td>
                                    <span class="badge badge-primary">Card</span>
                                </td>
                                <td>Staff 2</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-outline-primary">
                                        <i class="las la-eye"></i>
                                    </a>
                                </td>
                            </tr>

                            <!-- Transaction 9 -->
                            <tr>
                                <td>18:45</td>
                                <td>INV-20240115-009</td>
                                <td>Customer 9</td>
                                <td>1</td>
                                <td class="font-weight-bold">Rs 2,850</td>
                                <td>
                                    <span class="badge badge-info">UPI</span>
                                </td>
                                <td>Staff 3</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-outline-primary">
                                        <i class="las la-eye"></i>
                                    </a>
                                </td>
                            </tr>

                            <!-- Transaction 10 -->
                            <tr>
                                <td>19:20</td>
                                <td>INV-20240115-010</td>
                                <td>Customer 10</td>
                                <td>2</td>
                                <td class="font-weight-bold">Rs 7,420</td>
                                <td>
                                    <span class="badge badge-success">Cash</span>
                                </td>
                                <td>Staff 1</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-outline-primary">
                                        <i class="las la-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot class="font-weight-bold">
                            <tr>
                                <td colspan="4" class="text-right">Daily Total:</td>
                                <td>Rs 82,250</td>
                                <td colspan="3"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <!-- Product Performance -->
        <div class="row">
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Top Selling Products Today</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Category</th>
                                        <th>Qty Sold</th>
                                        <th>Revenue</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Product 1 -->
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="https://via.placeholder.com/40x40/007bff/ffffff?text=P1" class="rounded mr-2" alt="Product">
                                                <div>
                                                    <div class="font-weight-bold">Premium T-Shirt</div>
                                                    <small class="text-muted">SKU: PRD-001</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Men</td>
                                        <td class="font-weight-bold">18</td>
                                        <td class="font-weight-bold text-success">Rs 12,600</td>
                                    </tr>

                                    <!-- Product 2 -->
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="https://via.placeholder.com/40x40/007bff/ffffff?text=P2" class="rounded mr-2" alt="Product">
                                                <div>
                                                    <div class="font-weight-bold">Designer Jeans</div>
                                                    <small class="text-muted">SKU: PRD-002</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Women</td>
                                        <td class="font-weight-bold">12</td>
                                        <td class="font-weight-bold text-success">Rs 8,400</td>
                                    </tr>

                                    <!-- Product 3 -->
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="https://via.placeholder.com/40x40/007bff/ffffff?text=P3" class="rounded mr-2" alt="Product">
                                                <div>
                                                    <div class="font-weight-bold">Running Shoes</div>
                                                    <small class="text-muted">SKU: PRD-003</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Men</td>
                                        <td class="font-weight-bold">8</td>
                                        <td class="font-weight-bold text-success">Rs 16,800</td>
                                    </tr>

                                    <!-- Product 4 -->
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="https://via.placeholder.com/40x40/007bff/ffffff?text=P4" class="rounded mr-2" alt="Product">
                                                <div>
                                                    <div class="font-weight-bold">Winter Jacket</div>
                                                    <small class="text-muted">SKU: PRD-004</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Men</td>
                                        <td class="font-weight-bold">5</td>
                                        <td class="font-weight-bold text-success">Rs 12,500</td>
                                    </tr>

                                    <!-- Product 5 -->
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="https://via.placeholder.com/40x40/007bff/ffffff?text=P5" class="rounded mr-2" alt="Product">
                                                <div>
                                                    <div class="font-weight-bold">Summer Dress</div>
                                                    <small class="text-muted">SKU: PRD-005</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Women</td>
                                        <td class="font-weight-bold">7</td>
                                        <td class="font-weight-bold text-success">Rs 6,300</td>
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
                        <h6 class="m-0 font-weight-bold text-primary">Staff Performance</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Staff</th>
                                        <th>Sales</th>
                                        <th>Transactions</th>
                                        <th>Avg. Value</th>
                                        <th>Commission</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Staff 1 -->
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-sm mr-2">
                                                    <span class="avatar-title rounded-circle bg-primary text-white">
                                                        S1
                                                    </span>
                                                </div>
                                                <div class="font-weight-bold">John Smith</div>
                                            </div>
                                        </td>
                                        <td class="font-weight-bold">Rs 15,680</td>
                                        <td>28</td>
                                        <td>Rs 3,568</td>
                                        <td class="font-weight-bold text-success">Rs 784</td>
                                    </tr>

                                    <!-- Staff 2 -->
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-sm mr-2">
                                                    <span class="avatar-title rounded-circle bg-primary text-white">
                                                        S2
                                                    </span>
                                                </div>
                                                <div class="font-weight-bold">Sarah Johnson</div>
                                            </div>
                                        </td>
                                        <td class="font-weight-bold">Rs 12,450</td>
                                        <td>22</td>
                                        <td>Rs 4,236</td>
                                        <td class="font-weight-bold text-success">Rs 623</td>
                                    </tr>

                                    <!-- Staff 3 -->
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-sm mr-2">
                                                    <span class="avatar-title rounded-circle bg-primary text-white">
                                                        S3
                                                    </span>
                                                </div>
                                                <div class="font-weight-bold">Michael Brown</div>
                                            </div>
                                        </td>
                                        <td class="font-weight-bold">Rs 10,850</td>
                                        <td>18</td>
                                        <td>Rs 2,847</td>
                                        <td class="font-weight-bold text-success">Rs 543</td>
                                    </tr>

                                    <!-- Staff 4 -->
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-sm mr-2">
                                                    <span class="avatar-title rounded-circle bg-primary text-white">
                                                        S4
                                                    </span>
                                                </div>
                                                <div class="font-weight-bold">Emily Davis</div>
                                            </div>
                                        </td>
                                        <td class="font-weight-bold">Rs 6,700</td>
                                        <td>12</td>
                                        <td>Rs 2,233</td>
                                        <td class="font-weight-bold text-success">Rs 335</td>
                                    </tr>
                                </tbody>
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

    <!-- Chart.js -->
    <script src="{{ asset('backend/assets/vendor/chart.js/Chart.min.js') }}"></script>

    <!-- DataTables -->
    <script src="{{ asset('backend/assets/vendor/datatables/datatables.min.js') }}"></script>

    <!-- app JavaScript -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Initialize DataTable
            $('#dailyTransactionsTable').DataTable({
                pageLength: 10,
                ordering: true,
                order: [
                    [0, 'desc']
                ],
                dom: '<"top">rt<"bottom"lip><"clear">'
            });

            // Initialize charts
            initDailyCharts();

            // Load daily report
            window.loadDailyReport = function() {
                const reportDate = $('#reportDate').val();
                const compareWith = $('#compareWith').val();
                const branch = $('#dailyBranchFilter').val();

                console.log('Loading daily report for:', {
                    reportDate,
                    compareWith,
                    branch
                });

                // Show loading
                $('#dailyTransactionsTable_wrapper').html('<div class="text-center py-5"><i class="las la-spinner la-spin fa-2x text-primary"></i><p class="mt-2">Loading daily report...</p></div>');

                // Simulate API call
                setTimeout(() => {
                    alert('Daily report loaded for ' + reportDate);
                    // Reload charts with new data
                    initDailyCharts();
                }, 1000);
            };

            function initDailyCharts() {
                // Hourly Breakdown Chart
                var ctx1 = document.getElementById('hourlyBreakdownChart').getContext('2d');
                new Chart(ctx1, {
                    type: 'bar',
                    data: {
                        labels: ['9-10', '10-11', '11-12', '12-1', '1-2', '2-3', '3-4', '4-5', '5-6', '6-7', '7-8', '8-9'],
                        datasets: [{
                            label: 'Sales Amount (Rs)',
                            data: [2500, 4200, 3800, 5200, 4800, 3500, 4200, 5800, 6200, 7800, 6500, 4200],
                            backgroundColor: 'rgba(78, 115, 223, 0.5)',
                            borderColor: 'rgba(78, 115, 223, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        return 'Rs' + value;
                                    }
                                }
                            }
                        }
                    }
                });

                // Daily Payment Chart
                var ctx2 = document.getElementById('dailyPaymentChart').getContext('2d');
                new Chart(ctx2, {
                    type: 'doughnut',
                    data: {
                        labels: ['Cash', 'Card', 'UPI', 'Credit'],
                        datasets: [{
                            data: [35, 40, 20, 5],
                            backgroundColor: [
                                'rgba(40, 167, 69, 0.8)',
                                'rgba(0, 123, 255, 0.8)',
                                'rgba(23, 162, 184, 0.8)',
                                'rgba(255, 193, 7, 0.8)'
                            ]
                        }]
                    }
                });
            }

            window.exportDailyReport = function() {
                alert('Exporting daily report to Excel...');
            };

            window.printDailyReport = function() {
                window.print();
            };
        });
    </script>
    @endpush
</x-app-layout>