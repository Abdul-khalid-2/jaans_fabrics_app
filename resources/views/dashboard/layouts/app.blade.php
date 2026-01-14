<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'RetailPro Dashboard')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Toastr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- Custom CSS -->
    <link href="{{ asset('assets/css/dashboard.css') }}" rel="stylesheet">

    <!-- Page Specific CSS -->
    @stack('styles')

    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3a0ca3;
            --success-color: #06d6a0;
            --info-color: #118ab2;
            --warning-color: #ffd166;
            --danger-color: #ef476f;
            --light-color: #f8f9fa;
            --dark-color: #212529;
            --sidebar-width: 260px;
            --sidebar-collapsed-width: 70px;
            --header-height: 70px;
        }

        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: #f5f7fb;
            color: #333;
            overflow-x: hidden;
        }

        /* Preloader Styles */
        #preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: white;
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>

<body>
    <!-- Preloader -->
    <div id="preloader">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="{{ route('dashboard') }}" class="logo">
                <i class="fas fa-store fa-lg text-primary"></i>
                <span class="logo-text">RetailPro</span>
            </a>
            <button class="sidebar-toggle" id="sidebarToggle">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div class="sidebar-content">
            <ul class="sidebar-menu">
                <!-- Dashboard -->
                <li class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}">
                        <i class="fas fa-home"></i>
                        <span class="menu-text">Dashboard</span>
                    </a>
                </li>

                <!-- Sales -->
                <li class="menu-item {{ request()->is('dashboard/sales*') ? 'active' : '' }}">
                    <a href="{{ route('sales.index') }}">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="menu-text">Sales</span>
                    </a>
                </li>
                <li class="menu-item {{ request()->is('dashboard/pos*') ? 'active' : '' }}">
                    <a href="{{ route('pos.index') }}">
                        <i class="fas fa-cash-register"></i>
                        <span class="menu-text">POS</span>
                        <span class="badge bg-success ms-auto">Live</span>
                    </a>
                </li>

                <!-- Products -->
                <li class="menu-item {{ request()->is('dashboard/products*') ? 'active' : '' }}">
                    <a href="{{ route('products.index') }}">
                        <i class="fas fa-box"></i>
                        <span class="menu-text">Products</span>
                    </a>
                </li>

                <!-- Inventory -->
                <li class="menu-item {{ request()->is('dashboard/inventory*') ? 'active' : '' }}">
                    <a href="{{ route('inventory.index') }}">
                        <i class="fas fa-warehouse"></i>
                        <span class="menu-text">Inventory</span>
                    </a>
                </li>

                <!-- Customers -->
                <li class="menu-item {{ request()->is('dashboard/customers*') ? 'active' : '' }}">
                    <a href="{{ route('customers.index') }}">
                        <i class="fas fa-users"></i>
                        <span class="menu-text">Customers</span>
                    </a>
                </li>

                <!-- Purchases -->
                <li class="menu-item {{ request()->is('dashboard/purchases*') ? 'active' : '' }}">
                    <a href="{{ route('purchases.index') }}">
                        <i class="fas fa-truck"></i>
                        <span class="menu-text">Purchases</span>
                    </a>
                </li>

                <!-- Staff -->
                <li class="menu-item {{ request()->is('dashboard/staff*') ? 'active' : '' }}">
                    <a href="{{ route('staff.index') }}">
                        <i class="fas fa-user-tie"></i>
                        <span class="menu-text">Staff</span>
                    </a>
                </li>

                <!-- Accounts -->
                <li class="menu-item {{ request()->is('dashboard/accounts*') ? 'active' : '' }}">
                    <a href="{{ route('accounts.index') }}">
                        <i class="fas fa-chart-pie"></i>
                        <span class="menu-text">Accounts</span>
                    </a>
                </li>

                <!-- Reports -->
                <li class="menu-item {{ request()->is('dashboard/reports*') ? 'active' : '' }}">
                    <a href="{{ route('reports.sales') }}">
                        <i class="fas fa-chart-bar"></i>
                        <span class="menu-text">Reports</span>
                    </a>
                </li>

                <!-- Branches -->
                <li class="menu-item {{ request()->is('dashboard/branches*') ? 'active' : '' }}">
                    <a href="{{ route('branches.index') }}">
                        <i class="fas fa-code-branch"></i>
                        <span class="menu-text">Branches</span>
                    </a>
                </li>

                <!-- Settings -->
                <li class="menu-item {{ request()->is('dashboard/settings*') ? 'active' : '' }}">
                    <a href="{{ route('settings.index') }}">
                        <i class="fas fa-cog"></i>
                        <span class="menu-text">Settings</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="sidebar-footer">
            <div class="user-info">
                <div class="user-avatar">
                    @auth
                    @if(Auth::user()->profile_image)
                    <img src="{{ asset('storage/' . Auth::user()->profile_image) }}" alt="{{ Auth::user()->name }}">
                    @else
                    <div class="avatar-placeholder">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    @endif
                    @endauth
                </div>
                <div class="user-details">
                    <h6 class="user-name">{{ Auth::user()->name ?? 'User' }}</h6>
                    <span class="user-role text-muted">Admin</span>
                </div>
                <div class="user-actions">
                    <div class="dropdown">
                        <button class="btn btn-link" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fas fa-user me-2"></i> Profile</a></li>
                            <li><a class="dropdown-item" href="{{ route('settings.index') }}"><i class="fas fa-cog me-2"></i> Settings</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Navigation -->
        <nav class="top-navbar navbar navbar-expand-lg">
            <div class="container-fluid">
                <button class="sidebar-toggle-mobile btn btn-link" id="sidebarToggleMobile">
                    <i class="fas fa-bars"></i>
                </button>

                <div class="navbar-title">
                    <h4 class="mb-0">@yield('page-title', 'Dashboard')</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            @yield('breadcrumbs')
                        </ol>
                    </nav>
                </div>

                <div class="navbar-actions">
                    <!-- Branch Selector -->
                    <div class="branch-selector me-3">
                        <select class="form-select form-select-sm" id="branchSelector">
                            <option value="1" selected>Main Branch</option>
                            <option value="2">North Branch</option>
                            <option value="3">South Branch</option>
                            <option value="4">Warehouse</option>
                        </select>
                    </div>

                    <!-- Quick Actions -->
                    <div class="btn-group me-3">
                        <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fas fa-plus me-1"></i> Quick Add
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('products.create') }}"><i class="fas fa-box me-2"></i> Product</a></li>
                            <li><a class="dropdown-item" href="{{ route('customers.create') }}"><i class="fas fa-user-plus me-2"></i> Customer</a></li>
                            <li><a class="dropdown-item" href="{{ route('sales.create') }}"><i class="fas fa-shopping-cart me-2"></i> Sale</a></li>
                            <li><a class="dropdown-item" href="{{ route('purchases.create') }}"><i class="fas fa-truck me-2"></i> Purchase</a></li>
                        </ul>
                    </div>

                    <!-- Notifications -->
                    <div class="dropdown me-3">
                        <button class="btn btn-link text-dark position-relative p-0" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-bell fa-lg"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="notificationCount">
                                3
                            </span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end shadow-lg" style="min-width: 320px;">
                            <div class="dropdown-header d-flex justify-content-between align-items-center">
                                <h6 class="mb-0">Notifications</h6>
                                <a href="#" class="small text-primary">View All</a>
                            </div>
                            <div class="dropdown-divider"></div>
                            <div class="notification-list" style="max-height: 300px; overflow-y: auto;">
                                <a href="#" class="dropdown-item notification-item">
                                    <div class="d-flex">
                                        <div class="notification-icon me-3">
                                            <i class="fas fa-exclamation-triangle text-warning"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="small text-muted">5 minutes ago</div>
                                            <div class="fw-medium">Low stock alert</div>
                                            <div class="small">Product #P-1001 is running low</div>
                                        </div>
                                    </div>
                                </a>
                                <a href="#" class="dropdown-item notification-item">
                                    <div class="d-flex">
                                        <div class="notification-icon me-3">
                                            <i class="fas fa-shopping-cart text-success"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="small text-muted">1 hour ago</div>
                                            <div class="fw-medium">New sale completed</div>
                                            <div class="small">INV-2024-001 for $450.00</div>
                                        </div>
                                    </div>
                                </a>
                                <a href="#" class="dropdown-item notification-item">
                                    <div class="d-flex">
                                        <div class="notification-icon me-3">
                                            <i class="fas fa-user-plus text-info"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="small text-muted">2 hours ago</div>
                                            <div class="fw-medium">New customer registered</div>
                                            <div class="small">John Doe joined as new customer</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="dropdown-divider"></div>
                            <div class="text-center p-2">
                                <button class="btn btn-sm btn-outline-primary w-100" id="markAllRead">Mark all as read</button>
                            </div>
                        </div>
                    </div>

                    <!-- Fullscreen Toggle -->
                    <button class="btn btn-link text-dark me-3" id="fullscreenToggle">
                        <i class="fas fa-expand fa-lg"></i>
                    </button>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <div class="page-content">
            @yield('content')
        </div>

        <!-- Footer -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <span class="text-muted">
                            © {{ date('Y') }} RetailPro. All rights reserved.
                            <span class="d-none d-md-inline">v1.0.0</span>
                        </span>
                    </div>
                    <div class="col-md-6 text-end">
                        <span class="text-muted small">
                            Server Time: <span id="serverTime">{{ now()->format('Y-m-d H:i:s') }}</span>
                        </span>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- Custom JS -->
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>

    @stack('scripts')

    <script>
        // Hide preloader
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                document.getElementById('preloader').style.display = 'none';
            }, 500);
        });

        // Initialize dashboard
        $(document).ready(function() {
            // Sidebar toggle for desktop
            $('#sidebarToggle').click(function(e) {
                e.preventDefault();
                e.stopPropagation();
                $('body').toggleClass('sidebar-collapsed');

                // Toggle icon
                const icon = $(this).find('i');
                if ($('body').hasClass('sidebar-collapsed')) {
                    icon.removeClass('fa-times').addClass('fa-bars');
                } else {
                    icon.removeClass('fa-bars').addClass('fa-times');
                }

                // Save state to localStorage
                localStorage.setItem('sidebarCollapsed', $('body').hasClass('sidebar-collapsed'));
            });

            // Sidebar toggle for mobile
            $('#sidebarToggleMobile').click(function(e) {
                e.preventDefault();
                e.stopPropagation();
                $('body').toggleClass('sidebar-collapsed');

                // Toggle icon on desktop toggle button
                const icon = $('#sidebarToggle').find('i');
                if ($('body').hasClass('sidebar-collapsed')) {
                    icon.removeClass('fa-times').addClass('fa-bars');
                } else {
                    icon.removeClass('fa-bars').addClass('fa-times');
                }

                // Save state to localStorage
                localStorage.setItem('sidebarCollapsed', $('body').hasClass('sidebar-collapsed'));
            });

            // Fullscreen toggle
            $('#fullscreenToggle').click(function() {
                if (!document.fullscreenElement) {
                    document.documentElement.requestFullscreen();
                    $(this).html('<i class="fas fa-compress fa-lg"></i>');
                } else {
                    if (document.exitFullscreen) {
                        document.exitFullscreen();
                        $(this).html('<i class="fas fa-expand fa-lg"></i>');
                    }
                }
            });

            // Mark all notifications as read
            $('#markAllRead').click(function() {
                $('#notificationCount').fadeOut();
                toastr.success('All notifications marked as read');
            });

            // Branch selector
            $('#branchSelector').change(function() {
                const branchId = $(this).val();
                toastr.info('Switching branch to ' + $(this).find('option:selected').text());
                // In real app, make AJAX call to switch branch
            });

            // Update server time
            function updateServerTime() {
                const now = new Date();
                $('#serverTime').text(now.toLocaleString('en-US', {
                    year: 'numeric',
                    month: 'short',
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit'
                }));
            }
            updateServerTime();
            setInterval(updateServerTime, 1000);

            // Initialize select2
            $('.select2').select2({
                theme: 'bootstrap-5'
            });

            // Toastr configuration
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "timeOut": "3000"
            };

            // Load sidebar state from localStorage
            const sidebarCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
            if (sidebarCollapsed) {
                $('body').addClass('sidebar-collapsed');
                $('#sidebarToggle i').removeClass('fa-times').addClass('fa-bars');
            }

            // Auto-hide sidebar on mobile when clicking outside
            $(document).click(function(e) {
                if ($(window).width() < 992) {
                    if (!$(e.target).closest('#sidebar').length &&
                        !$(e.target).closest('#sidebarToggleMobile').length &&
                        !$('body').hasClass('sidebar-collapsed')) {
                        $('body').addClass('sidebar-collapsed');
                        $('#sidebarToggle i').removeClass('fa-times').addClass('fa-bars');
                    }
                }
            });

            // Prevent sidebar toggle from closing when clicking inside sidebar
            $('#sidebar').click(function(e) {
                e.stopPropagation();
            });

            // Handle window resize
            $(window).resize(function() {
                if ($(window).width() >= 992) {
                    // On desktop, remove mobile sidebar collapsed state
                    $('body').removeClass('sidebar-collapsed');
                }
            });
        });

        // Error handling
        window.addEventListener('error', function(e) {
            console.error('Error:', e.error);
            toastr.error('An error occurred. Please try again.');
        });
    </script>
</body>

</html>