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
                <h4 class="mb-3">Financial Reports</h4>
                <p class="mb-0">Comprehensive financial analysis and reports</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('reports.index') }}">Reports</a></li>
                        <li class="breadcrumb-item active">Financial Reports</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Financial Report Cards -->
        <div class="row">
            <div class="col-xl-12 mb-4">
                <div class="card border-left-primary shadow h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="h5 font-weight-bold text-primary mb-1">Profit & Loss Statement</div>
                                <p class="text-muted">Analyze revenue, costs, expenses, and net profit over time periods</p>
                                <div class="mt-3">
                                    <a href="{{ route('reports.financial.profit-loss') }}" class="btn btn-primary">
                                        <i class="las la-chart-line mr-2"></i>View Profit & Loss Report
                                    </a>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="las la-chart-line fa-3x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Financial Metrics -->
        <div class="row mb-4">
            <div class="col-lg-12">
                <div class="card shadow">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Financial Quick Stats</h6>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-md-4 col-6 mb-3">
                                <div class="border rounded p-3">
                                    <div class="text-muted">Monthly Revenue</div>
                                    <div class="h4 font-weight-bold">Rs245,680</div>
                                    <small class="text-success"><i class="las la-arrow-up"></i> 15.2% growth</small>
                                </div>
                            </div>
                            <div class="col-md-4 col-6 mb-3">
                                <div class="border rounded p-3">
                                    <div class="text-muted">Monthly Expenses</div>
                                    <div class="h4 font-weight-bold">Rs85,420</div>
                                    <small class="text-warning"><i class="las la-chart-pie"></i> 34.8% of revenue</small>
                                </div>
                            </div>
                            <div class="col-md-4 col-6 mb-3">
                                <div class="border rounded p-3">
                                    <div class="text-muted">Net Profit</div>
                                    <div class="h4 font-weight-bold">Rs160,260</div>
                                    <small class="text-success"><i class="las la-percentage"></i> 65.2% margin</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
    <script src="{{ asset('backend/assets/js/backend-bundle.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    @endpush
</x-app-layout>