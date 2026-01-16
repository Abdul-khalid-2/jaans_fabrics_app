<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/remixicon/fonts/remixicon.css') }}">
    <style>
        .category-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 10px;
            color: white;
            padding: 30px;
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
        }

        .category-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .category-header::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -30%;
            width: 150px;
            height: 150px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
        }

        .category-image {
            width: 120px;
            height: 120px;
            border-radius: 10px;
            object-fit: cover;
            border: 4px solid white;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .stats-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            border: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: all 0.3s;
        }

        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .stats-number {
            font-size: 2rem;
            font-weight: 700;
            line-height: 1;
        }

        .stats-label {
            font-size: 0.875rem;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .product-card {
            border: 1px solid #e3e6f0;
            border-radius: 8px;
            overflow: hidden;
            transition: all 0.3s;
            height: 100%;
        }

        .product-card:hover {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transform: translateY(-5px);
        }

        .product-image {
            height: 180px;
            object-fit: cover;
            width: 100%;
        }

        .tab-content {
            padding: 20px;
            border: 1px solid #dee2e6;
            border-top: none;
            border-radius: 0 0 8px 8px;
        }

        .nav-tabs .nav-link {
            border: 1px solid #dee2e6;
            border-bottom: none;
            margin-right: 5px;
            border-radius: 8px 8px 0 0;
        }

        .nav-tabs .nav-link.active {
            background-color: #007bff;
            color: white;
            border-color: #007bff;
        }

        .category-breadcrumb {
            background: rgba(255, 255, 255, 0.1);
            padding: 8px 15px;
            border-radius: 5px;
            font-size: 0.9rem;
        }

        .sub-category-card {
            border: 1px solid #e3e6f0;
            border-radius: 8px;
            padding: 15px;
            transition: all 0.3s;
        }

        .sub-category-card:hover {
            border-color: #007bff;
            background-color: rgba(0, 123, 255, 0.05);
            transform: translateX(5px);
        }

        .chart-container {
            height: 300px;
            position: relative;
        }
    </style>
    @endpush

    <div class="container-fluid">
        <!-- Category Header -->
        <div class="category-header">
            <div class="row align-items-center">
                <div class="col-md-2 text-center">
                    <img src="https://via.placeholder.com/120x120/007bff/ffffff?text=Men's+Wear"
                        class="category-image" alt="Men's Wear">
                </div>
                <div class="col-md-7">
                    <h2 class="mb-2">Men's Wear</h2>
                    <div class="d-flex align-items-center mb-3">
                        <span class="badge badge-light mr-2">CAT-001</span>
                        <span class="badge badge-success mr-2">Active</span>
                        <span class="badge badge-info">Featured</span>
                    </div>
                    <p class="mb-0 opacity-75">All men's clothing including shirts, t-shirts, jeans, and formal wear</p>
                </div>
                <div class="col-md-3 text-right">
                    <div class="category-breadcrumb d-inline-block mb-3">
                        <i class="las la-sitemap mr-1"></i>
                        <span>Main Category</span>
                    </div>
                    <div class="btn-group" role="group">
                        <a href="{{ route('categories.edit', 1) }}" class="btn btn-light">
                            <i class="las la-edit mr-1"></i>Edit
                        </a>
                        <button type="button" class="btn btn-light dropdown-toggle dropdown-toggle-split"
                            data-toggle="dropdown" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#"><i class="las la-copy mr-2"></i>Duplicate</a>
                            <a class="dropdown-item" href="#"><i class="las la-chart-bar mr-2"></i>View Reports</a>
                            <a class="dropdown-item" href="#"><i class="las la-file-export mr-2"></i>Export Products</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="#" onclick="deleteCategory()">
                                <i class="las la-trash mr-2"></i>Delete Category
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="stats-card">
                    <div class="stats-number text-primary">248</div>
                    <div class="stats-label">Total Products</div>
                    <small class="text-muted">42 active, 206 inactive</small>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="stats-card">
                    <div class="stats-number text-success">3</div>
                    <div class="stats-label">Sub Categories</div>
                    <small class="text-muted">Shirts, T-Shirts, Jeans</small>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="stats-card">
                    <div class="stats-number text-warning">Rs12,45,800</div>
                    <div class="stats-label">Total Sales</div>
                    <small class="text-muted">Last 12 months</small>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="stats-card">
                    <div class="stats-number text-info">18.5%</div>
                    <div class="stats-label">Sales Contribution</div>
                    <small class="text-muted">Of total store sales</small>
                </div>
            </div>
        </div>

        <!-- Category Details Tabs -->
        <div class="row">
            <div class="col-lg-12">
                <ul class="nav nav-tabs" id="categoryTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#overview">
                            <i class="las la-chart-bar mr-2"></i>Overview
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="products-tab" data-toggle="tab" href="#products">
                            <i class="las la-boxes mr-2"></i>Products (248)
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="subcategories-tab" data-toggle="tab" href="#subcategories">
                            <i class="las la-sitemap mr-2"></i>Sub Categories
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="performance-tab" data-toggle="tab" href="#performance">
                            <i class="las la-chart-line mr-2"></i>Performance
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings">
                            <i class="las la-cog mr-2"></i>Settings
                        </a>
                    </li>
                </ul>

                <div class="tab-content" id="categoryTabContent">
                    <!-- Overview Tab -->
                    <div class="tab-pane fade show active" id="overview" role="tabpanel">
                        <div class="row">
                            <div class="col-lg-8">
                                <!-- Sales Chart -->
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h6 class="mb-0">Sales Performance (Last 6 Months)</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container">
                                            <!-- Chart would go here -->
                                            <div class="text-center text-muted py-5">
                                                <i class="las la-chart-line fa-3x mb-3"></i>
                                                <p>Sales chart would be displayed here</p>
                                            </div>
                                        </div>
                                        <div class="row text-center mt-4">
                                            <div class="col-md-4">
                                                <h5 class="text-primary mb-1">Rs2,45,800</h5>
                                                <small class="text-muted">Last 30 Days</small>
                                            </div>
                                            <div class="col-md-4">
                                                <h5 class="text-success mb-1">18.5%</h5>
                                                <small class="text-muted">Sales Growth</small>
                                            </div>
                                            <div class="col-md-4">
                                                <h5 class="text-warning mb-1">42</h5>
                                                <small class="text-muted">Products Sold</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Recent Products -->
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0">Recent Products</h6>
                                        <a href="{{ route('products.create') }}" class="btn btn-sm btn-primary">
                                            <i class="las la-plus mr-1"></i>Add Product
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Product</th>
                                                        <th>SKU</th>
                                                        <th>Price</th>
                                                        <th>Stock</th>
                                                        <th>Status</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <img src="https://via.placeholder.com/40" class="rounded mr-3" alt="Product">
                                                                <div>
                                                                    <h6 class="mb-0">Men's Formal Shirt</h6>
                                                                    <small class="text-muted">Blue Striped</small>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>MSHIRT-001</td>
                                                        <td class="text-success">Rs1,299</td>
                                                        <td>
                                                            <div class="progress" style="height: 5px;">
                                                                <div class="progress-bar bg-success" style="width: 60%"></div>
                                                            </div>
                                                            <small>24/40 units</small>
                                                        </td>
                                                        <td><span class="badge badge-success">Active</span></td>
                                                        <td>
                                                            <a href="{{ route('products.show', 1) }}" class="btn btn-sm btn-info">
                                                                <i class="las la-eye"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <img src="https://via.placeholder.com/40" class="rounded mr-3" alt="Product">
                                                                <div>
                                                                    <h6 class="mb-0">Men's T-Shirt</h6>
                                                                    <small class="text-muted">Black Cotton</small>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>MTSHIRT-001</td>
                                                        <td class="text-success">Rs499</td>
                                                        <td>
                                                            <div class="progress" style="height: 5px;">
                                                                <div class="progress-bar bg-warning" style="width: 30%"></div>
                                                            </div>
                                                            <small>12/40 units</small>
                                                        </td>
                                                        <td><span class="badge badge-success">Active</span></td>
                                                        <td>
                                                            <a href="{{ route('products.show', 2) }}" class="btn btn-sm btn-info">
                                                                <i class="las la-eye"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <img src="https://via.placeholder.com/40" class="rounded mr-3" alt="Product">
                                                                <div>
                                                                    <h6 class="mb-0">Men's Jeans</h6>
                                                                    <small class="text-muted">Blue Denim</small>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>MJNS-001</td>
                                                        <td class="text-success">Rs1,899</td>
                                                        <td>
                                                            <div class="progress" style="height: 5px;">
                                                                <div class="progress-bar bg-success" style="width: 80%"></div>
                                                            </div>
                                                            <small>32/40 units</small>
                                                        </td>
                                                        <td><span class="badge badge-success">Active</span></td>
                                                        <td>
                                                            <a href="{{ route('products.show', 3) }}" class="btn btn-sm btn-info">
                                                                <i class="las la-eye"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <!-- Category Details -->
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h6 class="mb-0">Category Details</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <small class="text-muted d-block mb-1">Category Code</small>
                                            <strong>CAT-001</strong>
                                        </div>
                                        <div class="mb-3">
                                            <small class="text-muted d-block mb-1">Parent Category</small>
                                            <strong>-- Main Category --</strong>
                                        </div>
                                        <div class="mb-3">
                                            <small class="text-muted d-block mb-1">Display Order</small>
                                            <strong>1</strong>
                                        </div>
                                        <div class="mb-3">
                                            <small class="text-muted d-block mb-1">Created Date</small>
                                            <strong>15 Jan 2023</strong>
                                        </div>
                                        <div class="mb-3">
                                            <small class="text-muted d-block mb-1">Last Updated</small>
                                            <strong>15 Nov 2024</strong>
                                        </div>
                                        <div class="mb-3">
                                            <small class="text-muted d-block mb-1">Created By</small>
                                            <strong>Admin User</strong>
                                        </div>
                                    </div>
                                </div>

                                <!-- Quick Stats -->
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h6 class="mb-0">Quick Stats</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6 mb-3">
                                                <div class="text-center">
                                                    <div class="stats-number text-primary">Rs2,45,800</div>
                                                    <small class="text-muted">Monthly Sales</small>
                                                </div>
                                            </div>
                                            <div class="col-6 mb-3">
                                                <div class="text-center">
                                                    <div class="stats-number text-success">18.5%</div>
                                                    <small class="text-muted">Profit Margin</small>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-center">
                                                    <div class="stats-number text-warning">42</div>
                                                    <small class="text-muted">Avg. Stock</small>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-center">
                                                    <div class="stats-number text-info">85%</div>
                                                    <small class="text-muted">Sell-through</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Quick Actions -->
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="mb-0">Quick Actions</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6 mb-3">
                                                <a href="{{ route('products.create') }}" class="btn btn-outline-primary btn-block">
                                                    <i class="las la-plus"></i>
                                                    <span class="d-block mt-1">Add Product</span>
                                                </a>
                                            </div>
                                            <div class="col-6 mb-3">
                                                <a href="#" class="btn btn-outline-success btn-block" data-toggle="modal" data-target="#addSubCategoryModal">
                                                    <i class="las la-folder-plus"></i>
                                                    <span class="d-block mt-1">Add Sub-Category</span>
                                                </a>
                                            </div>
                                            <div class="col-6">
                                                <a href="#" class="btn btn-outline-info btn-block">
                                                    <i class="las la-chart-bar"></i>
                                                    <span class="d-block mt-1">View Reports</span>
                                                </a>
                                            </div>
                                            <div class="col-6">
                                                <a href="#" class="btn btn-outline-warning btn-block">
                                                    <i class="las la-file-export"></i>
                                                    <span class="d-block mt-1">Export Data</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Products Tab -->
                    <div class="tab-pane fade" id="products" role="tabpanel">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h6 class="mb-0">Products in Men's Wear (248)</h6>
                                <div>
                                    <button class="btn btn-sm btn-outline-primary mr-2">Filter</button>
                                    <button class="btn btn-sm btn-outline-secondary mr-2">Export</button>
                                    <a href="{{ route('products.create') }}" class="btn btn-sm btn-primary">
                                        <i class="las la-plus mr-1"></i>Add Product
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <!-- Product Card 1 -->
                                    <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                                        <div class="product-card">
                                            <img src="https://via.placeholder.com/300x180/007bff/ffffff?text=Men's+Shirt"
                                                class="product-image" alt="Men's Shirt">
                                            <div class="p-3">
                                                <h6 class="mb-1">Men's Formal Shirt</h6>
                                                <p class="text-muted mb-2" style="font-size: 0.8rem;">Blue Striped Cotton</p>
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <span class="text-success font-weight-bold">Rs1,299</span>
                                                    <span class="badge badge-success">In Stock</span>
                                                </div>
                                                <div class="progress mb-2" style="height: 5px;">
                                                    <div class="progress-bar bg-success" style="width: 60%"></div>
                                                </div>
                                                <small class="text-muted d-block mb-3">24/40 units left</small>
                                                <div class="d-flex justify-content-between">
                                                    <a href="{{ route('products.edit', 1) }}" class="btn btn-sm btn-outline-primary">
                                                        <i class="las la-edit"></i>
                                                    </a>
                                                    <a href="{{ route('products.show', 1) }}" class="btn btn-sm btn-outline-info">
                                                        <i class="las la-eye"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-sm btn-outline-success">
                                                        <i class="las la-chart-bar"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-sm btn-outline-danger">
                                                        <i class="las la-trash"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Product Card 2 -->
                                    <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                                        <div class="product-card">
                                            <img src="https://via.placeholder.com/300x180/28a745/ffffff?text=Men's+T-Shirt"
                                                class="product-image" alt="Men's T-Shirt">
                                            <div class="p-3">
                                                <h6 class="mb-1">Men's T-Shirt</h6>
                                                <p class="text-muted mb-2" style="font-size: 0.8rem;">Black Cotton</p>
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <span class="text-success font-weight-bold">Rs499</span>
                                                    <span class="badge badge-warning">Low Stock</span>
                                                </div>
                                                <div class="progress mb-2" style="height: 5px;">
                                                    <div class="progress-bar bg-warning" style="width: 30%"></div>
                                                </div>
                                                <small class="text-muted d-block mb-3">12/40 units left</small>
                                                <div class="d-flex justify-content-between">
                                                    <a href="{{ route('products.edit', 2) }}" class="btn btn-sm btn-outline-primary">
                                                        <i class="las la-edit"></i>
                                                    </a>
                                                    <a href="{{ route('products.show', 2) }}" class="btn btn-sm btn-outline-info">
                                                        <i class="las la-eye"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-sm btn-outline-success">
                                                        <i class="las la-chart-bar"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-sm btn-outline-danger">
                                                        <i class="las la-trash"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Product Card 3 -->
                                    <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                                        <div class="product-card">
                                            <img src="https://via.placeholder.com/300x180/ffc107/000000?text=Men's+Jeans"
                                                class="product-image" alt="Men's Jeans">
                                            <div class="p-3">
                                                <h6 class="mb-1">Men's Jeans</h6>
                                                <p class="text-muted mb-2" style="font-size: 0.8rem;">Blue Denim</p>
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <span class="text-success font-weight-bold">Rs1,899</span>
                                                    <span class="badge badge-success">In Stock</span>
                                                </div>
                                                <div class="progress mb-2" style="height: 5px;">
                                                    <div class="progress-bar bg-success" style="width: 80%"></div>
                                                </div>
                                                <small class="text-muted d-block mb-3">32/40 units left</small>
                                                <div class="d-flex justify-content-between">
                                                    <a href="{{ route('products.edit', 3) }}" class="btn btn-sm btn-outline-primary">
                                                        <i class="las la-edit"></i>
                                                    </a>
                                                    <a href="{{ route('products.show', 3) }}" class="btn btn-sm btn-outline-info">
                                                        <i class="las la-eye"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-sm btn-outline-success">
                                                        <i class="las la-chart-bar"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-sm btn-outline-danger">
                                                        <i class="las la-trash"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Product Card 4 -->
                                    <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                                        <div class="product-card">
                                            <img src="https://via.placeholder.com/300x180/dc3545/ffffff?text=Men's+Jacket"
                                                class="product-image" alt="Men's Jacket">
                                            <div class="p-3">
                                                <h6 class="mb-1">Men's Winter Jacket</h6>
                                                <p class="text-muted mb-2" style="font-size: 0.8rem;">Black Puffer</p>
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <span class="text-success font-weight-bold">Rs2,999</span>
                                                    <span class="badge badge-danger">Out of Stock</span>
                                                </div>
                                                <div class="progress mb-2" style="height: 5px;">
                                                    <div class="progress-bar bg-danger" style="width: 0%"></div>
                                                </div>
                                                <small class="text-muted d-block mb-3">0/40 units left</small>
                                                <div class="d-flex justify-content-between">
                                                    <a href="{{ route('products.edit', 4) }}" class="btn btn-sm btn-outline-primary">
                                                        <i class="las la-edit"></i>
                                                    </a>
                                                    <a href="{{ route('products.show', 4) }}" class="btn btn-sm btn-outline-info">
                                                        <i class="las la-eye"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-sm btn-outline-success">
                                                        <i class="las la-chart-bar"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-sm btn-outline-danger">
                                                        <i class="las la-trash"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Pagination -->
                                <nav aria-label="Page navigation">
                                    <ul class="pagination justify-content-center mt-4">
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#" tabindex="-1">Previous</a>
                                        </li>
                                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                                        <li class="page-item"><a class="page-link" href="#">5</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">Next</a>
                                        </li>
                                    </ul>
                                </nav>

                                <!-- Product Summary -->
                                <div class="row mt-4">
                                    <div class="col-md-3 col-6">
                                        <div class="card bg-light border">
                                            <div class="card-body text-center">
                                                <h5 class="text-primary">248</h5>
                                                <small class="text-muted">Total Products</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <div class="card bg-light border">
                                            <div class="card-body text-center">
                                                <h5 class="text-success">42</h5>
                                                <small class="text-muted">Active Products</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <div class="card bg-light border">
                                            <div class="card-body text-center">
                                                <h5 class="text-warning">12</h5>
                                                <small class="text-muted">Low Stock</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <div class="card bg-light border">
                                            <div class="card-body text-center">
                                                <h5 class="text-danger">6</h5>
                                                <small class="text-muted">Out of Stock</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sub Categories Tab -->
                    <div class="tab-pane fade" id="subcategories" role="tabpanel">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="card mb-4">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0">Sub Categories</h6>
                                        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addSubCategoryModal">
                                            <i class="las la-plus mr-1"></i>Add Sub-Category
                                        </button>
                                    </div>
                                    <div class="card-body">
                                        <!-- Sub Category 1 -->
                                        <div class="sub-category-card mb-3">
                                            <div class="row align-items-center">
                                                <div class="col-md-2 text-center">
                                                    <img src="https://via.placeholder.com/80x80/007bff/ffffff?text=Shirts"
                                                        class="rounded" alt="Shirts" style="width: 80px; height: 80px; object-fit: cover;">
                                                </div>
                                                <div class="col-md-6">
                                                    <h5 class="mb-1">Shirts</h5>
                                                    <p class="text-muted mb-2">Formal and casual shirts</p>
                                                    <div class="d-flex">
                                                        <span class="badge badge-primary mr-2">CAT-002</span>
                                                        <span class="badge badge-success">Active</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 text-right">
                                                    <div class="mb-2">
                                                        <span class="text-primary font-weight-bold">85</span>
                                                        <small class="text-muted"> products</small>
                                                    </div>
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('categories.edit', 2) }}" class="btn btn-sm btn-outline-primary">
                                                            <i class="las la-edit"></i>
                                                        </a>
                                                        <a href="{{ route('categories.show', 2) }}" class="btn btn-sm btn-outline-info">
                                                            <i class="las la-eye"></i>
                                                        </a>
                                                        <button class="btn btn-sm btn-outline-danger">
                                                            <i class="las la-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Sub Category 2 -->
                                        <div class="sub-category-card mb-3">
                                            <div class="row align-items-center">
                                                <div class="col-md-2 text-center">
                                                    <img src="https://via.placeholder.com/80x80/28a745/ffffff?text=T-Shirts"
                                                        class="rounded" alt="T-Shirts" style="width: 80px; height: 80px; object-fit: cover;">
                                                </div>
                                                <div class="col-md-6">
                                                    <h5 class="mb-1">T-Shirts</h5>
                                                    <p class="text-muted mb-2">Cotton t-shirts and polo shirts</p>
                                                    <div class="d-flex">
                                                        <span class="badge badge-primary mr-2">CAT-003</span>
                                                        <span class="badge badge-success">Active</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 text-right">
                                                    <div class="mb-2">
                                                        <span class="text-primary font-weight-bold">92</span>
                                                        <small class="text-muted"> products</small>
                                                    </div>
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('categories.edit', 3) }}" class="btn btn-sm btn-outline-primary">
                                                            <i class="las la-edit"></i>
                                                        </a>
                                                        <a href="{{ route('categories.show', 3) }}" class="btn btn-sm btn-outline-info">
                                                            <i class="las la-eye"></i>
                                                        </a>
                                                        <button class="btn btn-sm btn-outline-danger">
                                                            <i class="las la-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Sub Category 3 -->
                                        <div class="sub-category-card">
                                            <div class="row align-items-center">
                                                <div class="col-md-2 text-center">
                                                    <img src="https://via.placeholder.com/80x80/ffc107/000000?text=Jeans"
                                                        class="rounded" alt="Jeans" style="width: 80px; height: 80px; object-fit: cover;">
                                                </div>
                                                <div class="col-md-6">
                                                    <h5 class="mb-1">Jeans</h5>
                                                    <p class="text-muted mb-2">Denim jeans and trousers</p>
                                                    <div class="d-flex">
                                                        <span class="badge badge-primary mr-2">CAT-007</span>
                                                        <span class="badge badge-success">Active</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 text-right">
                                                    <div class="mb-2">
                                                        <span class="text-primary font-weight-bold">71</span>
                                                        <small class="text-muted"> products</small>
                                                    </div>
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('categories.edit', 7) }}" class="btn btn-sm btn-outline-primary">
                                                            <i class="las la-edit"></i>
                                                        </a>
                                                        <a href="{{ route('categories.show', 7) }}" class="btn btn-sm btn-outline-info">
                                                            <i class="las la-eye"></i>
                                                        </a>
                                                        <button class="btn btn-sm btn-outline-danger">
                                                            <i class="las la-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <!-- Sub-Category Statistics -->
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="mb-0">Sub-Category Statistics</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between mb-2">
                                                <span>Total Sub-Categories</span>
                                                <strong>3</strong>
                                            </div>
                                            <div class="d-flex justify-content-between mb-2">
                                                <span>Total Products</span>
                                                <strong>248</strong>
                                            </div>
                                            <div class="d-flex justify-content-between mb-2">
                                                <span>Average Products per Sub-Category</span>
                                                <strong>83</strong>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <span>Largest Sub-Category</span>
                                                <strong>T-Shirts (92 products)</strong>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="mb-3">
                                            <small class="text-muted d-block mb-2">Products Distribution</small>
                                            <div class="mb-2">
                                                <div class="d-flex justify-content-between mb-1">
                                                    <span>T-Shirts</span>
                                                    <span>92 (37%)</span>
                                                </div>
                                                <div class="progress" style="height: 8px;">
                                                    <div class="progress-bar bg-success" style="width: 37%"></div>
                                                </div>
                                            </div>
                                            <div class="mb-2">
                                                <div class="d-flex justify-content-between mb-1">
                                                    <span>Shirts</span>
                                                    <span>85 (34%)</span>
                                                </div>
                                                <div class="progress" style="height: 8px;">
                                                    <div class="progress-bar bg-primary" style="width: 34%"></div>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="d-flex justify-content-between mb-1">
                                                    <span>Jeans</span>
                                                    <span>71 (29%)</span>
                                                </div>
                                                <div class="progress" style="height: 8px;">
                                                    <div class="progress-bar bg-warning" style="width: 29%"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Performance Tab -->
                    <div class="tab-pane fade" id="performance" role="tabpanel">
                        <div class="row">
                            <div class="col-lg-8">
                                <!-- Sales Performance -->
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h6 class="mb-0">Sales Performance Metrics</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row mb-4">
                                            <div class="col-md-3 col-6 text-center">
                                                <div class="stats-card">
                                                    <div class="stats-number text-primary">Rs12,45,800</div>
                                                    <div class="stats-label">Total Sales</div>
                                                    <small class="text-success">+12.5% growth</small>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-6 text-center">
                                                <div class="stats-card">
                                                    <div class="stats-number text-success">18.5%</div>
                                                    <div class="stats-label">Profit Margin</div>
                                                    <small class="text-success">+2.3% from last year</small>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-6 text-center">
                                                <div class="stats-card">
                                                    <div class="stats-number text-warning">42</div>
                                                    <div class="stats-label">Avg. Monthly Sales</div>
                                                    <small class="text-danger">-3% from last month</small>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-6 text-center">
                                                <div class="stats-card">
                                                    <div class="stats-number text-info">85%</div>
                                                    <div class="stats-label">Sell-through Rate</div>
                                                    <small class="text-success">+5% from target</small>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Performance Charts -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h6 class="mb-0">Monthly Sales Trend</h6>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="chart-container">
                                                            <div class="text-center text-muted py-4">
                                                                <i class="las la-chart-area fa-3x mb-3"></i>
                                                                <p>Monthly sales chart would be displayed here</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h6 class="mb-0">Product Performance</h6>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="chart-container">
                                                            <div class="text-center text-muted py-4">
                                                                <i class="las la-chart-pie fa-3x mb-3"></i>
                                                                <p>Product performance chart would be displayed here</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <!-- Performance Insights -->
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h6 class="mb-0">Performance Insights</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="alert alert-success">
                                            <i class="las la-chart-line mr-2"></i>
                                            <strong>Strong Performance:</strong> Category is performing 12.5% above target
                                        </div>
                                        <div class="alert alert-warning">
                                            <i class="las la-exclamation-triangle mr-2"></i>
                                            <strong>Stock Alert:</strong> 12 products running low on stock
                                        </div>
                                        <div class="alert alert-info">
                                            <i class="las la-lightbulb mr-2"></i>
                                            <strong>Opportunity:</strong> T-Shirts segment shows highest growth potential
                                        </div>
                                        <div class="alert alert-danger">
                                            <i class="las la-ban mr-2"></i>
                                            <strong>Attention Needed:</strong> 6 products are out of stock
                                        </div>
                                    </div>
                                </div>

                                <!-- Top Products -->
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="mb-0">Top Products in Category</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="list-group">
                                            <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h6 class="mb-0">Men's Formal Shirt</h6>
                                                    <small class="text-muted">Rs1,299</small>
                                                </div>
                                                <span class="badge badge-primary">Rs2,45,800</span>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h6 class="mb-0">Men's Jeans</h6>
                                                    <small class="text-muted">Rs1,899</small>
                                                </div>
                                                <span class="badge badge-primary">Rs1,89,500</span>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h6 class="mb-0">Men's T-Shirt</h6>
                                                    <small class="text-muted">Rs499</small>
                                                </div>
                                                <span class="badge badge-primary">Rs1,23,400</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Settings Tab -->
                    <div class="tab-pane fade" id="settings" role="tabpanel">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="mb-0">Category Settings</h6>
                                    </div>
                                    <div class="card-body">
                                        <form>
                                            <div class="form-group">
                                                <label class="form-label">Category Status</label>
                                                <select class="form-control">
                                                    <option value="1" selected>Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>
                                                <small class="form-text text-muted">Inactive categories won't be shown to customers</small>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label">Display in Navigation</label>
                                                <select class="form-control">
                                                    <option value="1" selected>Yes</option>
                                                    <option value="0">No</option>
                                                </select>
                                                <small class="form-text text-muted">Show category in website navigation menu</small>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label">Display Order</label>
                                                <input type="number" class="form-control" value="1">
                                                <small class="form-text text-muted">Lower numbers display first</small>
                                            </div>

                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="featuredCategory" checked>
                                                    <label class="custom-control-label" for="featuredCategory">Featured Category</label>
                                                </div>
                                                <small class="form-text text-muted">Show on homepage or featured sections</small>
                                            </div>

                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="showInFilters" checked>
                                                    <label class="custom-control-label" for="showInFilters">Show in Filter Options</label>
                                                </div>
                                                <small class="form-text text-muted">Include category in product filters</small>
                                            </div>

                                            <button type="submit" class="btn btn-primary">Update Settings</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <!-- SEO Settings -->
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h6 class="mb-0">SEO Settings</h6>
                                    </div>
                                    <div class="card-body">
                                        <form>
                                            <div class="form-group">
                                                <label class="form-label">Meta Title</label>
                                                <input type="text" class="form-control" value="Men's Clothing Collection">
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label">Meta Keywords</label>
                                                <input type="text" class="form-control" value="men's wear, clothing, shirts, t-shirts, jeans">
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label">Meta Description</label>
                                                <textarea class="form-control" rows="3">Browse our collection of men's clothing including shirts, t-shirts, jeans, and formal wear. Latest fashion trends for men.</textarea>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label">URL Slug</label>
                                                <input type="text" class="form-control" value="mens-wear">
                                            </div>

                                            <button type="submit" class="btn btn-primary">Update SEO</button>
                                        </form>
                                    </div>
                                </div>

                                <!-- Danger Zone -->
                                <div class="card border-danger">
                                    <div class="card-header bg-danger text-white">
                                        <h6 class="mb-0">Danger Zone</h6>
                                    </div>
                                    <div class="card-body">
                                        <p class="text-muted">Once you delete a category, there is no going back. Please be certain.</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="mb-0">Delete Category</h6>
                                                <small class="text-muted">This will also delete all sub-categories and products</small>
                                            </div>
                                            <button class="btn btn-danger" onclick="deleteCategory()">
                                                <i class="las la-trash mr-2"></i>Delete Category
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Sub-Category Modal -->
    <div class="modal fade" id="addSubCategoryModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Sub-Category to Men's Wear</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="subCategoryForm">
                        <div class="form-group">
                            <label>Category Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Enter sub-category name" required>
                        </div>
                        <div class="form-group">
                            <label>Category Code</label>
                            <input type="text" class="form-control" value="CAT-{{ date('YmdHis') }}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" rows="3" placeholder="Category description"></textarea>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="subCategoryActive" checked>
                                <label class="custom-control-label" for="subCategoryActive">Active</label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Add Sub-Category</button>
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
            // Tab functionality
            $('#categoryTab a').on('click', function(e) {
                e.preventDefault();
                $(this).tab('show');
            });

            // Delete category function
            window.deleteCategory = function() {
                if (confirm('⚠️ WARNING: Are you sure you want to delete this category?\n\n' +
                        'This action will permanently delete:\n' +
                        '• This category and all its sub-categories\n' +
                        '• All products under this category\n' +
                        '• All associated sales data\n\n' +
                        'This action cannot be undone!')) {

                    // Show loading
                    $('body').append('<div class="loading-overlay"><div class="spinner"></div></div>');

                    // Simulate API call
                    setTimeout(() => {
                        $('.loading-overlay').remove();
                        alert('Category deleted successfully!');
                        window.location.href = "{{ route('categories.index') }}";
                    }, 1500);
                }
            };

            // Add sub-category modal
            $('#addSubCategoryModal').on('show.bs.modal', function() {
                $('#subCategoryForm')[0].reset();
                $('#subCategoryForm input[readonly]').val('CAT-' + Date.now().toString().slice(-8));
            });

            // Add sub-category button
            $('button:contains("Add Sub-Category")').filter(function() {
                return $(this).text() === 'Add Sub-Category';
            }).click(function() {
                const name = $('#subCategoryForm input[placeholder="Enter sub-category name"]').val().trim();
                if (!name) {
                    alert('Please enter sub-category name');
                    return;
                }

                alert('Sub-category added successfully!');
                $('#addSubCategoryModal').modal('hide');

                // In real app, you would add the sub-category to the list
            });

            // Export data
            $('a:contains("Export Data")').click(function(e) {
                e.preventDefault();
                alert('Export functionality would be implemented here');
            });

            // View reports
            $('a:contains("View Reports")').click(function(e) {
                e.preventDefault();
                alert('Reports functionality would be implemented here');
            });

            // Filter button
            $('button:contains("Filter")').click(function() {
                alert('Filter functionality would be implemented here');
            });

            // Export button
            $('button:contains("Export")').click(function() {
                alert('Export functionality would be implemented here');
            });
        });
    </script>

    <style>
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }

        .loading-overlay .spinner {
            width: 50px;
            height: 50px;
            border: 5px solid #f3f3f3;
            border-top: 5px solid #007bff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
    @endpush
</x-app-layout>