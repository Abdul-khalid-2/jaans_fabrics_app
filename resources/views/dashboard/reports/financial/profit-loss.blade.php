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
                <h4 class="mb-3">Profit & Loss Statement</h4>
                <p class="mb-0">Analyze your business profitability and financial performance</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('reports.index') }}">Reports</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('reports.financial.index') }}">Financial Reports</a></li>
                        <li class="breadcrumb-item active">Profit & Loss</li>
                    </ol>
                </nav>
            </div>
            <div>
                <button class="btn btn-outline-primary" onclick="exportProfitLoss()">
                    <i class="las la-file-excel mr-2"></i>Export
                </button>
                <button class="btn btn-primary ml-2" onclick="printProfitLoss()">
                    <i class="las la-print mr-2"></i>Print
                </button>
            </div>
        </div>

        <!-- Filters -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Period</label>
                            <select class="form-control" id="periodFilter">
                                <option value="monthly" selected>Monthly</option>
                                <option value="quarterly">Quarterly</option>
                                <option value="yearly">Yearly</option>
                                <option value="custom">Custom Range</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Month</label>
                            <select class="form-control" id="monthFilter">
                                <option value="1">January</option>
                                <option value="2">February</option>
                                <option value="3">March</option>
                                <option value="4">April</option>
                                <option value="5">May</option>
                                <option value="6">June</option>
                                <option value="7">July</option>
                                <option value="8">August</option>
                                <option value="9">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12" selected>December</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Year</label>
                            <select class="form-control" id="yearFilter">
                                <option value="2023">2023</option>
                                <option value="2024" selected>2024</option>
                                <option value="2025">2025</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <button class="btn btn-primary btn-block" onclick="loadProfitLossReport()">
                                <i class="las la-filter mr-2"></i>Generate Report
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="row mb-4">
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Total Revenue</div>
                                <div class="h3 mb-0 font-weight-bold text-gray-800">Rs245,680</div>
                                <div class="mt-2 text-muted small">Gross sales income</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Total Expenses</div>
                                <div class="h3 mb-0 font-weight-bold text-gray-800">Rs85,420</div>
                                <div class="mt-2 text-muted small">Operating costs</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Net Profit</div>
                                <div class="h3 mb-0 font-weight-bold text-gray-800">Rs160,260</div>
                                <div class="mt-2 text-muted small">65.2% profit margin</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profit & Loss Statement -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Profit & Loss Statement - December 2024</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="profitLossTable">
                        <thead class="thead-light">
                            <tr>
                                <th>Category</th>
                                <th class="text-right">Amount (Rs)</th>
                                <th class="text-right">Percentage</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Revenue Section -->
                            <tr class="table-success">
                                <td><strong>REVENUE</strong></td>
                                <td class="text-right"><strong>Rs245,680</strong></td>
                                <td class="text-right"><strong>100.0%</strong></td>
                            </tr>
                            <tr>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;Product Sales</td>
                                <td class="text-right">Rs215,680</td>
                                <td class="text-right">87.8%</td>
                            </tr>
                            <tr>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;Service Revenue</td>
                                <td class="text-right">Rs20,000</td>
                                <td class="text-right">8.1%</td>
                            </tr>
                            <tr>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;Other Income</td>
                                <td class="text-right">Rs10,000</td>
                                <td class="text-right">4.1%</td>
                            </tr>

                            <!-- Cost of Goods Sold -->
                            <tr class="table-warning">
                                <td><strong>COST OF GOODS SOLD</strong></td>
                                <td class="text-right"><strong>Rs98,272</strong></td>
                                <td class="text-right"><strong>40.0%</strong></td>
                            </tr>
                            <tr>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;Inventory Costs</td>
                                <td class="text-right">Rs85,000</td>
                                <td class="text-right">34.6%</td>
                            </tr>
                            <tr>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;Direct Labor</td>
                                <td class="text-right">Rs8,272</td>
                                <td class="text-right">3.4%</td>
                            </tr>
                            <tr>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;Other COGS</td>
                                <td class="text-right">Rs5,000</td>
                                <td class="text-right">2.0%</td>
                            </tr>

                            <!-- Gross Profit -->
                            <tr class="table-info">
                                <td><strong>GROSS PROFIT</strong></td>
                                <td class="text-right"><strong>Rs147,408</strong></td>
                                <td class="text-right"><strong>60.0%</strong></td>
                            </tr>

                            <!-- Operating Expenses -->
                            <tr class="table-warning">
                                <td><strong>OPERATING EXPENSES</strong></td>
                                <td class="text-right"><strong>Rs85,420</strong></td>
                                <td class="text-right"><strong>34.8%</strong></td>
                            </tr>
                            <tr>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;Salaries & Wages</td>
                                <td class="text-right">Rs45,000</td>
                                <td class="text-right">18.3%</td>
                            </tr>
                            <tr>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;Rent</td>
                                <td class="text-right">Rs15,000</td>
                                <td class="text-right">6.1%</td>
                            </tr>
                            <tr>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;Utilities</td>
                                <td class="text-right">Rs5,000</td>
                                <td class="text-right">2.0%</td>
                            </tr>
                            <tr>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;Marketing</td>
                                <td class="text-right">Rs8,000</td>
                                <td class="text-right">3.3%</td>
                            </tr>
                            <tr>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;Office Supplies</td>
                                <td class="text-right">Rs2,420</td>
                                <td class="text-right">1.0%</td>
                            </tr>
                            <tr>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;Other Expenses</td>
                                <td class="text-right">Rs10,000</td>
                                <td class="text-right">4.1%</td>
                            </tr>

                            <!-- Net Profit -->
                            <tr class="table-primary">
                                <td><strong>NET PROFIT</strong></td>
                                <td class="text-right"><strong>Rs61,988</strong></td>
                                <td class="text-right"><strong>25.2%</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Trend Chart -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Profit Trend - Last 6 Months</h6>
            </div>
            <div class="card-body">
                <canvas id="profitTrendChart" height="200"></canvas>
            </div>
        </div>
    </div>

    @push('js')
    <!-- Backend Bundle JavaScript -->
    <script src="{{ asset('backend/assets/js/backend-bundle.min.js') }}"></script>

    <!-- Chart.js -->
    <script src="{{ asset('backend/assets/vendor/chart.js/Chart.min.js') }}"></script>

    <!-- app JavaScript -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Initialize chart
            initProfitChart();

            // Load profit loss report
            window.loadProfitLossReport = function() {
                const period = $('#periodFilter').val();
                const month = $('#monthFilter').val();
                const year = $('#yearFilter').val();

                console.log('Loading profit loss report:', {
                    period,
                    month,
                    year
                });

                // Show loading
                alert('Generating Profit & Loss report for ' + getMonthName(month) + ' ' + year);
                // In real app, you would load data via AJAX
            };

            function getMonthName(monthNumber) {
                const months = [
                    'January', 'February', 'March', 'April', 'May', 'June',
                    'July', 'August', 'September', 'October', 'November', 'December'
                ];
                return months[monthNumber - 1];
            }

            function initProfitChart() {
                var ctx = document.getElementById('profitTrendChart').getContext('2d');
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ['Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                        datasets: [{
                            label: 'Revenue (Rs)',
                            data: [185000, 195000, 210000, 225000, 235000, 245680],
                            borderColor: 'rgba(40, 167, 69, 1)',
                            backgroundColor: 'rgba(40, 167, 69, 0.1)',
                            tension: 0.3,
                            fill: true
                        }, {
                            label: 'Expenses (Rs)',
                            data: [65000, 68000, 72000, 78000, 82000, 85420],
                            borderColor: 'rgba(255, 193, 7, 1)',
                            backgroundColor: 'rgba(255, 193, 7, 0.1)',
                            tension: 0.3,
                            fill: true
                        }, {
                            label: 'Net Profit (Rs)',
                            data: [120000, 127000, 138000, 147000, 153000, 160260],
                            borderColor: 'rgba(78, 115, 223, 1)',
                            backgroundColor: 'rgba(78, 115, 223, 0.1)',
                            tension: 0.3,
                            fill: true
                        }]
                    }
                });
            }

            window.exportProfitLoss = function() {
                alert('Exporting Profit & Loss statement to Excel...');
            };

            window.printProfitLoss = function() {
                window.print();
            };
        });
    </script>
    @endpush
</x-app-layout>