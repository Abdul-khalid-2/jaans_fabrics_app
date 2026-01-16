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
                <h4 class="mb-3">Customer Reports</h4>
                <p class="mb-0">Analyze customer behavior, purchases, and loyalty program</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('reports.index') }}">Reports</a></li>
                        <li class="breadcrumb-item active">Customer Reports</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Customer Report Cards -->
        <div class="row">
            <div class="col-xl-6 col-md-12 mb-4">
                <div class="card border-left-primary shadow h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="h5 font-weight-bold text-primary mb-1">Purchase History Report</div>
                                <p class="text-muted">Track customer purchases, buying patterns, and purchase history</p>
                                <div class="mt-3">
                                    <a href="{{ route('reports.customers.sales') }}" class="btn btn-primary">
                                        <i class="las la-chart-bar mr-2"></i>View Report
                                    </a>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="las la-shopping-cart fa-3x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-md-12 mb-4">
                <div class="card border-left-success shadow h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="h5 font-weight-bold text-success mb-1">Loyalty Program Tracking</div>
                                <p class="text-muted">Monitor loyalty points, rewards redemption, and member engagement</p>
                                <div class="mt-3">
                                    <a href="{{ route('reports.customers.loyalty') }}" class="btn btn-success">
                                        <i class="las la-crown mr-2"></i>View Report
                                    </a>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="las la-crown fa-3x text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Customer Statistics -->
        <div class="row mb-4">
            <div class="col-lg-12">
                <div class="card shadow">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Customer Quick Stats</h6>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-md-3 col-6 mb-3">
                                <div class="border rounded p-3">
                                    <div class="text-muted">Total Customers</div>
                                    <div class="h4 font-weight-bold">1,245</div>
                                    <small class="text-success"><i class="las la-arrow-up"></i> 12.5% growth</small>
                                </div>
                            </div>
                            <div class="col-md-3 col-6 mb-3">
                                <div class="border rounded p-3">
                                    <div class="text-muted">Active Customers</div>
                                    <div class="h4 font-weight-bold">856</div>
                                    <small class="text-success"><i class="las la-user-check"></i> 68.8% active</small>
                                </div>
                            </div>
                            <div class="col-md-3 col-6 mb-3">
                                <div class="border rounded p-3">
                                    <div class="text-muted">Avg. Order Value</div>
                                    <div class="h4 font-weight-bold">Rs3,560</div>
                                    <small class="text-success"><i class="las la-rupee-sign"></i> Per transaction</small>
                                </div>
                            </div>
                            <div class="col-md-3 col-6 mb-3">
                                <div class="border rounded p-3">
                                    <div class="text-muted">Repeat Rate</div>
                                    <div class="h4 font-weight-bold">36.5%</div>
                                    <small class="text-success"><i class="las la-redo"></i> Customer retention</small>
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