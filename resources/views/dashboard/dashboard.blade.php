@extends('dashboard.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard Overview')

@section('breadcrumbs')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('styles')
    <style>
        .stat-card {
            border: none;
            border-radius: 12px;
            transition: all 0.3s ease;
            overflow: hidden;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
        }
        
        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }
        
        .chart-container {
            position: relative;
            height: 250px;
            width: 100%;
        }
        
        .recent-activity-item {
            padding: 1rem;
            border-bottom: 1px solid #f0f0f0;
            transition: background-color 0.2s;
        }
        
        .recent-activity-item:hover {
            background-color: #f8f9fa;
        }
        
        .activity-time {
            font-size: 0.75rem;
            color: #6c757d;
        }
        
        .top-product-card {
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 1rem;
            transition: all 0.2s;
        }
        
        .top-product-card:hover {
            border-color: #4361ee;
            box-shadow: 0 2px 8px rgba(67, 97, 238, 0.1);
        }
        
        .low-stock-alert {
            padding: 0.75rem;
            border-radius: 8px;
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, #fff8e1 0%, #fff3cd 100%);
            border-left: 4px solid #ffc107;
        }
        
        .low-stock-alert.danger {
            background: linear-gradient(135deg, #ffebee 0%, #ffcdd2 100%);
            border-left-color: #dc3545;
        }
    </style>
@endsection

@section('content')
<div class="container-fluid py-4">
    <!-- Welcome Banner -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card stat-card bg-gradient-primary text-white border-0">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h4 class="mb-2">Welcome back, {{ Auth::user()->name }}!</h4>
                            <p class="mb-0 opacity-75">Here's what's happening with your business today.</p>
                        </div>
                        <div class="col-md-4 text-end">
                            <div class="d-flex align-items-center justify-content-end">
                                <div class="me-3">
                                    <small class="opacity-75">Today's Date</small>
                                    <h5 class="mb-0">{{ now()->format('F d, Y') }}</h5>
                                </div>
                                <div class="bg-white bg-opacity-20 rounded-circle p-3">
                                    <i class="fas fa-calendar-alt fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Row -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Today's Sales</h6>
                            <h3 class="mb-0">₹45,250</h3>
                            <span class="text-success small">
                                <i class="fas fa-arrow-up me-1"></i>12.5%
                            </span>
                            <span class="text-muted small ms-2">vs yesterday</span>
                        </div>
                        <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Total Orders</h6>
                            <h3 class="mb-0">142</h3>
                            <span class="text-success small">
                                <i class="fas fa-arrow-up me-1"></i>8.2%
                            </span>
                            <span class="text-muted small ms-2">this week</span>
                        </div>
                        <div class="stat-icon bg-success bg-opacity-10 text-success">
                            <i class="fas fa-chart-line"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">New Customers</h6>
                            <h3 class="mb-0">24</h3>
                            <span class="text-success small">
                                <i class="fas fa-arrow-up me-1"></i>5.3%
                            </span>
                            <span class="text-muted small ms-2">today</span>
                        </div>
                        <div class="stat-icon bg-info bg-opacity-10 text-info">
                            <i class="fas fa-user-plus"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Low Stock Items</h6>
                            <h3 class="mb-0">18</h3>
                            <span class="text-danger small">
                                <i class="fas fa-exclamation-circle me-1"></i>Need attention
                            </span>
                            <span class="text-muted small ms-2"></span>
                        </div>
                        <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row mb-4">
        <div class="col-xl-8 col-lg-7 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0">
                    <h5 class="mb-0">Sales Overview</h5>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            This Week
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#" onclick="updateChart('week')">This Week</a></li>
                            <li><a class="dropdown-item" href="#" onclick="updateChart('month')">This Month</a></li>
                            <li><a class="dropdown-item" href="#" onclick="updateChart('year')">This Year</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="salesChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-5 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0">
                    <h5 class="mb-0">Revenue Breakdown</h5>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="revenueChart"></canvas>
                    </div>
                    <div class="row text-center mt-4">
                        <div class="col-4">
                            <div class="fw-bold text-primary">₹25.4K</div>
                            <small class="text-muted">Online</small>
                        </div>
                        <div class="col-4">
                            <div class="fw-bold text-success">₹18.2K</div>
                            <small class="text-muted">In-store</small>
                        </div>
                        <div class="col-4">
                            <div class="fw-bold text-info">₹1.6K</div>
                            <small class="text-muted">Returns</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Second Row -->
    <div class="row">
        <!-- Recent Sales -->
        <div class="col-xl-6 col-lg-12 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Recent Sales</h5>
                    <a href="{{ route('sales.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Invoice No</th>
                                    <th>Customer</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for($i = 1; $i <= 5; $i++)
                                <tr>
                                    <td class="fw-medium">#INV-{{ str_pad($i, 3, '0', STR_PAD_LEFT) }}</td>
                                    <td>Customer {{ $i }}</td>
                                    <td>₹{{ number_format(rand(1000, 10000), 2) }}</td>
                                    <td>
                                        @php
                                            $statuses = ['success' => 'Paid', 'warning' => 'Pending', 'danger' => 'Cancelled'];
                                            $status = array_rand($statuses);
                                        @endphp
                                        <span class="badge bg-{{ $status }}">{{ $statuses[$status] }}</span>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye fa-xs"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="col-xl-6 col-lg-12 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0">
                    <h5 class="mb-0">Recent Activity</h5>
                </div>
                <div class="card-body">
                    <div class="recent-activity-list">
                        @php
                            $activities = [
                                ['icon' => 'fas fa-shopping-cart text-success', 'title' => 'New sale recorded', 'time' => '2 mins ago', 'desc' => 'INV-2024-006 for ₹5,500'],
                                ['icon' => 'fas fa-box text-primary', 'title' => 'Product stock updated', 'time' => '30 mins ago', 'desc' => 'Wireless Headphones stock increased'],
                                ['icon' => 'fas fa-exclamation-triangle text-warning', 'title' => 'Low stock alert', 'time' => '1 hour ago', 'desc' => 'iPhone 14 Case is out of stock'],
                                ['icon' => 'fas fa-user-plus text-info', 'title' => 'New customer registered', 'time' => '2 hours ago', 'desc' => 'John Doe joined as new customer'],
                                ['icon' => 'fas fa-exchange-alt text-danger', 'title' => 'Sale return processed', 'time' => '3 hours ago', 'desc' => 'Return #RET-2024-001 for ₹1,200'],
                            ];
                        @endphp
                        @foreach($activities as $activity)
                        <div class="recent-activity-item d-flex">
                            <div class="activity-icon me-3">
                                <i class="{{ $activity['icon'] }} fa-lg"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="mb-1">{{ $activity['title'] }}</h6>
                                        <p class="mb-0 text-muted small">{{ $activity['desc'] }}</p>
                                    </div>
                                    <span class="activity-time">{{ $activity['time'] }}</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="text-center mt-3">
                        <a href="#" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-history me-1"></i> View All Activity
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Third Row -->
    <div class="row">
        <!-- Top Products -->
        <div class="col-lg-8 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Top Selling Products</h5>
                    <select class="form-select form-select-sm w-auto">
                        <option>This Week</option>
                        <option>This Month</option>
                        <option>This Year</option>
                    </select>
                </div>
                <div class="card-body">
                    <div class="row">
                        @php
                            $products = [
                                ['name' => 'Wireless Headphones', 'sales' => 42, 'revenue' => 8400, 'color' => 'primary'],
                                ['name' => 'Running Shoes', 'sales' => 38, 'revenue' => 7600, 'color' => 'success'],
                                ['name' => 'Smart Watch', 'sales' => 35, 'revenue' => 10500, 'color' => 'info'],
                                ['name' => 'Coffee Maker', 'sales' => 28, 'revenue' => 5600, 'color' => 'warning'],
                                ['name' => 'Bluetooth Speaker', 'sales' => 25, 'revenue' => 3750, 'color' => 'secondary'],
                            ];
                        @endphp
                        @foreach($products as $index => $product)
                        <div class="col-md-6 col-lg-4 mb-3">
                            <div class="top-product-card">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="bg-{{ $product['color'] }} bg-opacity-10 rounded p-2 me-3">
                                        <i class="fas fa-shopping-bag text-{{ $product['color'] }} fa-lg"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">{{ $product['name'] }}</h6>
                                        <div class="text-muted small">{{ $product['sales'] }} sales</div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold">₹{{ number_format($product['revenue'], 2) }}</span>
                                    <span class="badge bg-light text-dark">#{{ $index + 1 }}</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Low Stock Alerts -->
        <div class="col-lg-4 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Low Stock Alerts</h5>
                    <span class="badge bg-warning">{{ rand(5, 20) }} items</span>
                </div>
                <div class="card-body">
                    <div class="low-stock-alert">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div class="fw-medium">Men's Running Shoes (Nike)</div>
                            <span class="badge bg-warning">Low</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted small">SKU: NIKE-RUN-001</span>
                            <span class="fw-bold text-danger">5/50</span>
                        </div>
                    </div>
                    
                    <div class="low-stock-alert">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div class="fw-medium">Wireless Headphones (Sony)</div>
                            <span class="badge bg-warning">Low</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted small">SKU: SONY-WH-100</span>
                            <span class="fw-bold text-danger">3/20</span>
                        </div>
                    </div>
                    
                    <div class="low-stock-alert danger">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div class="fw-medium">iPhone 14 Case</div>
                            <span class="badge bg-danger">Out</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted small">SKU: CASE-IP14-RED</span>
                            <span class="fw-bold text-danger">0/30</span>
                        </div>
                    </div>
                    
                    <div class="low-stock-alert">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div class="fw-medium">Coffee Maker (Deluxe)</div>
                            <span class="badge bg-warning">Low</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted small">SKU: COFFEE-DLX-01</span>
                            <span class="fw-bold text-danger">2/15</span>
                        </div>
                    </div>
                    
                    <div class="text-center mt-3">
                        <a href="{{ route('inventory.index') }}?filter=low_stock" class="btn btn-sm btn-warning w-100">
                            <i class="fas fa-exclamation-triangle me-1"></i> View All Alerts
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Initialize sales chart
        const salesCtx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(salesCtx, {
            type: 'line',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                datasets: [{
                    label: 'Sales (₹)',
                    data: [32000, 41000, 38000, 52000, 62000, 78000, 45000],
                    borderColor: '#4361ee',
                    backgroundColor: 'rgba(67, 97, 238, 0.1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#4361ee',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                        callbacks: {
                            label: function(context) {
                                return '₹' + context.parsed.y.toLocaleString('en-IN');
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            drawBorder: false
                        },
                        ticks: {
                            callback: function(value) {
                                return '₹' + value.toLocaleString('en-IN');
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Initialize revenue chart
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(revenueCtx, {
            type: 'doughnut',
            data: {
                labels: ['Online Sales', 'In-store Sales', 'Returns'],
                datasets: [{
                    data: [65, 30, 5],
                    backgroundColor: [
                        '#4361ee',
                        '#06d6a0',
                        '#ef476f'
                    ],
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            usePointStyle: true
                        }
                    }
                }
            }
        });

        // Update chart based on period
        window.updateChart = function(period) {
            let labels, data;
            
            switch(period) {
                case 'week':
                    labels = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
                    data = [32000, 41000, 38000, 52000, 62000, 78000, 45000];
                    break;
                case 'month':
                    labels = ['Week 1', 'Week 2', 'Week 3', 'Week 4'];
                    data = [125000, 145000, 135000, 155000];
                    break;
                case 'year':
                    labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                    data = [450000, 520000, 480000, 550000, 620000, 580000, 650000, 720000, 680000, 750000, 820000, 890000];
                    break;
            }
            
            salesChart.data.labels = labels;
            salesChart.data.datasets[0].data = data;
            salesChart.update();
            
            toastr.info(`Showing data for ${period}`);
        };
    });
</script>
@endsection