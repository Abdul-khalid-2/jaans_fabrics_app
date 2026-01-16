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
                <h4 class="mb-3">Inventory Reports</h4>
                <p class="mb-0">Track inventory levels, movements, and stock performance</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('reports.index') }}">Reports</a></li>
                        <li class="breadcrumb-item active">Inventory Reports</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Inventory Report Cards -->
        <div class="row">
            <div class="col-xl-6 col-md-12 mb-4">
                <div class="card border-left-primary shadow h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="h5 font-weight-bold text-primary mb-1">Stock Levels Report</div>
                                <p class="text-muted">Monitor current stock levels, low stock alerts, and reorder points</p>
                                <div class="mt-3">
                                    <a href="{{ route('reports.inventory.stock-levels') }}" class="btn btn-primary">
                                        <i class="las la-chart-bar mr-2"></i>View Report
                                    </a>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="las la-boxes fa-3x text-primary"></i>
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
                                <div class="h5 font-weight-bold text-success mb-1">Inventory Movements</div>
                                <p class="text-muted">Track all inventory movements, adjustments, and transfers</p>
                                <div class="mt-3">
                                    <a href="{{ route('reports.inventory.movements') }}" class="btn btn-success">
                                        <i class="las la-exchange-alt mr-2"></i>View Report
                                    </a>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="las la-exchange-alt fa-3x text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Statistics -->
        <div class="row mb-4">
            <div class="col-lg-12">
                <div class="card shadow">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Inventory Quick Stats</h6>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-md-3 col-6 mb-3">
                                <div class="border rounded p-3">
                                    <div class="text-muted">Total Stock Value</div>
                                    <div class="h4 font-weight-bold">Rs245,800</div>
                                    <small class="text-success"><i class="las la-arrow-up"></i> 8.5% increase</small>
                                </div>
                            </div>
                            <div class="col-md-3 col-6 mb-3">
                                <div class="border rounded p-3">
                                    <div class="text-muted">Low Stock Items</div>
                                    <div class="h4 font-weight-bold">18</div>
                                    <small class="text-danger"><i class="las la-exclamation-triangle"></i> Needs attention</small>
                                </div>
                            </div>
                            <div class="col-md-3 col-6 mb-3">
                                <div class="border rounded p-3">
                                    <div class="text-muted">Out of Stock</div>
                                    <div class="h4 font-weight-bold">5</div>
                                    <small class="text-danger"><i class="las la-times-circle"></i> Critical</small>
                                </div>
                            </div>
                            <div class="col-md-3 col-6 mb-3">
                                <div class="border rounded p-3">
                                    <div class="text-muted">Total SKUs</div>
                                    <div class="h4 font-weight-bold">1,681</div>
                                    <small class="text-success"><i class="las la-box"></i> Active products</small>
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