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
                <h4 class="mb-3">Staff Performance Reports</h4>
                <p class="mb-0">Track staff performance, sales targets, and attendance</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('reports.index') }}">Reports</a></li>
                        <li class="breadcrumb-item active">Staff Reports</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Coming Soon Notice -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow">
                    <div class="card-body text-center py-5">
                        <i class="las la-tools fa-5x text-primary mb-4"></i>
                        <h3 class="text-primary mb-3">Staff Reports Coming Soon</h3>
                        <p class="text-muted mb-4">We're working on comprehensive staff performance reports including:</p>
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="row text-left">
                                    <div class="col-md-6 mb-3">
                                        <i class="las la-check-circle text-success mr-2"></i> Sales Performance Tracking
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <i class="las la-check-circle text-success mr-2"></i> Attendance & Time Tracking
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <i class="las la-check-circle text-success mr-2"></i> Commission & Incentive Reports
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <i class="las la-check-circle text-success mr-2"></i> Performance Analytics
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('reports.index') }}" class="btn btn-primary mt-3">
                            <i class="las la-arrow-left mr-2"></i>Back to Reports
                        </a>
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