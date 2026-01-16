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
                <h4 class="mb-3">Reports Dashboard</h4>
                <p class="mb-0">Access all your business reports and analytics from one place</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Reports</li>
                    </ol>
                </nav>
            </div>
            <div>
                <button class="btn btn-primary" onclick="generateQuickReport()">
                    <i class="las la-file-alt mr-2"></i>Quick Report
                </button>
            </div>
        </div>

        <!-- Report Categories -->
        <div class="row">
            <!-- Sales Reports -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Sales Reports</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Revenue & Performance</div>
                                <div class="mt-3">
                                    <ul class="list-unstyled">
                                        <li class="mb-2">
                                            <a href="{{ route('reports.sales.index') }}" class="text-primary">
                                                <i class="las la-chart-bar mr-2"></i>Sales Overview
                                            </a>
                                        </li>
                                        <li class="mb-2">
                                            <a href="{{ route('reports.sales.daily') }}" class="text-primary">
                                                <i class="las la-calendar-day mr-2"></i>Daily Sales
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('reports.sales.product') }}" class="text-primary">
                                                <i class="las la-boxes mr-2"></i>Product-wise Sales
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="las la-shopping-cart fa-3x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Inventory Reports -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Inventory Reports</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Stock & Movements</div>
                                <div class="mt-3">
                                    <ul class="list-unstyled">
                                        <li class="mb-2">
                                            <a href="{{ route('reports.inventory.stock-levels') }}" class="text-success">
                                                <i class="las la-boxes mr-2"></i>Stock Levels
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('reports.inventory.movements') }}" class="text-success">
                                                <i class="las la-exchange-alt mr-2"></i>Inventory Movements
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="las la-warehouse fa-3x text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Customer Reports -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Customer Reports</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Purchase & Loyalty</div>
                                <div class="mt-3">
                                    <ul class="list-unstyled">
                                        <li class="mb-2">
                                            <a href="{{ route('reports.customers.sales') }}" class="text-info">
                                                <i class="las la-users mr-2"></i>Purchase History
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('reports.customers.loyalty') }}" class="text-info">
                                                <i class="las la-crown mr-2"></i>Loyalty Tracking
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="las la-user-friends fa-3x text-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Reports -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Quick Report Templates</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <div class="card border-left-primary h-100">
                                    <div class="card-body">
                                        <h6 class="font-weight-bold text-primary">Daily Sales Summary</h6>
                                        <p class="small text-muted">Yesterday's sales performance</p>
                                        <button class="btn btn-sm btn-outline-primary btn-block" onclick="generateDailyReport()">
                                            Generate
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-3 mb-3">
                                <div class="card border-left-warning h-100">
                                    <div class="card-body">
                                        <h6 class="font-weight-bold text-warning">Low Stock Alert</h6>
                                        <p class="small text-muted">Items below minimum stock</p>
                                        <button class="btn btn-sm btn-outline-warning btn-block" onclick="generateLowStockReport()">
                                            Generate
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-3 mb-3">
                                <div class="card border-left-success h-100">
                                    <div class="card-body">
                                        <h6 class="font-weight-bold text-success">Top Customers</h6>
                                        <p class="small text-muted">Best customers this month</p>
                                        <button class="btn btn-sm btn-outline-success btn-block" onclick="generateTopCustomersReport()">
                                            Generate
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-3 mb-3">
                                <div class="card border-left-info h-100">
                                    <div class="card-body">
                                        <h6 class="font-weight-bold text-info">Product Performance</h6>
                                        <p class="small text-muted">Best selling products</p>
                                        <button class="btn btn-sm btn-outline-info btn-block" onclick="generateProductPerformanceReport()">
                                            Generate
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Reports -->
        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Recently Generated Reports</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Report Name</th>
                                        <th>Generated On</th>
                                        <th>Format</th>
                                        <th>Size</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Monthly Sales Report - Jan 2024</td>
                                        <td>01 Feb 2024, 10:30 AM</td>
                                        <td><span class="badge badge-primary">PDF</span></td>
                                        <td>2.5 MB</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary">
                                                <i class="las la-download"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Inventory Stock Levels</td>
                                        <td>31 Jan 2024, 04:15 PM</td>
                                        <td><span class="badge badge-success">Excel</span></td>
                                        <td>1.8 MB</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary">
                                                <i class="las la-download"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Customer Purchase Analysis</td>
                                        <td>30 Jan 2024, 11:20 AM</td>
                                        <td><span class="badge badge-info">CSV</span></td>
                                        <td>3.2 MB</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary">
                                                <i class="las la-download"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Weekly Sales Report</td>
                                        <td>29 Jan 2024, 09:45 AM</td>
                                        <td><span class="badge badge-primary">PDF</span></td>
                                        <td>1.5 MB</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary">
                                                <i class="las la-download"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Report Statistics</h6>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <div class="mb-4">
                                <div class="h1 font-weight-bold text-primary">128</div>
                                <div class="text-muted">Reports Generated</div>
                            </div>
                            <div class="mb-4">
                                <div class="h1 font-weight-bold text-success">45</div>
                                <div class="text-muted">This Month</div>
                            </div>
                            <div class="mb-4">
                                <div class="h1 font-weight-bold text-info">2.8 GB</div>
                                <div class="text-muted">Total Storage Used</div>
                            </div>
                            <div>
                                <div class="h1 font-weight-bold text-warning">85%</div>
                                <div class="text-muted">PDF Reports</div>
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
    
    <!-- app JavaScript -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    
    <script>
    $(document).ready(function() {
        // Initialize report generation functions
    });
    
    function generateQuickReport() {
        alert('Generating quick report...');
        // Implement quick report generation logic
    }
    
    function generateDailyReport() {
        alert('Generating daily sales summary report...');
        // Redirect to daily sales report with today's date
        window.location.href = "{{ route('reports.sales.daily') }}";
    }
    
    function generateLowStockReport() {
        alert('Generating low stock alert report...');
        // Redirect to stock levels report
        window.location.href = "{{ route('reports.inventory.stock-levels') }}";
    }
    
    function generateTopCustomersReport() {
        alert('Generating top customers report...');
        // Redirect to customer sales report
        window.location.href = "{{ route('reports.customers.sales') }}";
    }
    
    function generateProductPerformanceReport() {
        alert('Generating product performance report...');
        // Redirect to product-wise sales report
        window.location.href = "{{ route('reports.sales.product') }}";
    }
    </script>
    @endpush
</x-app-layout>