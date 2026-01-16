<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/remixicon/fonts/remixicon.css') }}">
    <style>
        .brand-logo-container {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
            border: 2px solid #e3e6f0;
            overflow: hidden;
        }
        .brand-logo {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }
        .country-flag {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            object-fit: cover;
            border: 1px solid #dee2e6;
        }
        .badge-count {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            color: #6c757d;
            font-weight: 600;
        }
        .stat-card-icon {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            font-size: 24px;
        }
        .product-count-pill {
            min-width: 70px;
            text-align: center;
        }
    </style>
    @endpush

    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
            <div>
                <h4 class="mb-3">Product Brands</h4>
                <p class="mb-0">Manage and organize your product brands</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Brands</li>
                    </ol>
                </nav>
            </div>
            <div class="d-flex">
                <a href="{{ route('brands.create') }}" class="btn btn-primary add-list">
                    <i class="las la-plus mr-2"></i>Add Brand
                </a>
                <button class="btn btn-outline-primary ml-2" onclick="exportBrands()">
                    <i class="las la-download mr-2"></i>Export
                </button>
                <button class="btn btn-outline-secondary ml-2" onclick="toggleBulkActions()">
                    <i class="las la-tasks mr-2"></i>Bulk Actions
                </button>
            </div>
        </div>

        <!-- Brand Statistics -->
        <div class="row mb-4">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-white mb-0">Total Brands</h6>
                                <h2 class="mb-0 text-white">24</h2>
                                <small class="text-white-50">Active: 22</small>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-tags fa-2x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-white mb-0">International Brands</h6>
                                <h2 class="mb-0 text-white">18</h2>
                                <small class="text-white-50">From 12 countries</small>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-globe fa-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-white mb-0">Total Products</h6>
                                <h2 class="mb-0 text-white">1,248</h2>
                                <small class="text-white-50">Across all brands</small>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-boxes fa-2x text-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-white mb-0">Featured Brands</h6>
                                <h2 class="mb-0 text-white">8</h2>
                                <small class="text-white-50">Featured on homepage</small>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-star fa-2x text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bulk Actions Panel (Hidden by default) -->
        <div class="card mb-4" id="bulkActionsPanel" style="display: none;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-0"><i class="las la-tasks mr-2"></i>Bulk Actions</h6>
                        <small class="text-muted"><span id="selectedCount">0</span> brands selected</small>
                    </div>
                    <div class="d-flex">
                        <select class="form-control form-control-sm mr-2" style="width: 150px;">
                            <option value="">Choose action...</option>
                            <option value="activate">Activate Selected</option>
                            <option value="deactivate">Deactivate Selected</option>
                            <option value="delete">Delete Selected</option>
                            <option value="export">Export Selected</option>
                        </select>
                        <button class="btn btn-sm btn-primary mr-2" onclick="applyBulkAction()">Apply</button>
                        <button class="btn btn-sm btn-outline-secondary" onclick="toggleBulkActions()">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Search Brands</label>
                            <input type="text" class="form-control" id="searchBrand" placeholder="Brand name, code or contact">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" id="filterStatus">
                                <option value="">All Status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Country</label>
                            <select class="form-control" id="filterCountry">
                                <option value="">All Countries</option>
                                <option value="US">United States</option>
                                <option value="IN">India</option>
                                <option value="DE">Germany</option>
                                <option value="FR">France</option>
                                <option value="IT">Italy</option>
                                <option value="ES">Spain</option>
                                <option value="UK">United Kingdom</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Sort By</label>
                            <select class="form-control" id="sortBy">
                                <option value="name_asc">Name (A-Z)</option>
                                <option value="name_desc">Name (Z-A)</option>
                                <option value="products_desc">Products (High-Low)</option>
                                <option value="products_asc">Products (Low-High)</option>
                                <option value="recent">Recently Added</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <div class="form-group w-100 d-flex">
                            <button class="btn btn-primary mr-2 flex-grow-1" onclick="applyFilters()">Filter</button>
                            <button class="btn btn-outline-secondary" onclick="resetFilters()">Reset</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Brands Table -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0">Brands List</h6>
                <div class="d-flex">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="toggleGridView" onchange="toggleView()">
                        <label class="custom-control-label" for="toggleGridView">Grid View</label>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <!-- Table View -->
                <div class="table-responsive" id="tableView">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="5%">
                                    <input type="checkbox" class="form-check-input" id="selectAll" onchange="toggleSelectAll()">
                                </th>
                                <th width="10%">Logo</th>
                                <th width="15%">Brand Code</th>
                                <th width="20%">Brand Name</th>
                                <th width="10%">Country</th>
                                <th width="15%">Contact</th>
                                <th width="10%">Products</th>
                                <th width="10%">Status</th>
                                <th width="15%">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="brandTableBody">
                            <!-- Levi's -->
                            <tr>
                                <td>
                                    <input type="checkbox" class="form-check-input brand-checkbox" data-id="1">
                                </td>
                                <td>
                                    <div class="brand-logo-container">
                                        <img src="https://via.placeholder.com/50/1e40af/ffffff?text=LS" 
                                             class="brand-logo" alt="Levi's">
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-light">BR-001</span>
                                </td>
                                <td>
                                    <h6 class="mb-0">Levi's</h6>
                                    <small class="text-muted">Denim & Casual Wear</small>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://flagcdn.com/w40/us.png" class="country-flag mr-2" alt="US">
                                        <span>USA</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="small">
                                        <div><i class="las la-envelope text-primary mr-1"></i> contact@levi.com</div>
                                        <div><i class="las la-phone text-success mr-1"></i> +1-555-1234</div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-count product-count-pill">248</span>
                                </td>
                                <td>
                                    <span class="badge badge-success">Active</span>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('brands.show', 1) }}" class="btn btn-sm btn-info mr-2" title="View">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="{{ route('brands.edit', 1) }}" class="btn btn-sm btn-primary mr-2" title="Edit">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown">
                                                <i class="las la-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#"><i class="las la-copy mr-2"></i>Duplicate</a>
                                                <a class="dropdown-item" href="#"><i class="las la-chart-line mr-2"></i>View Report</a>
                                                <a class="dropdown-item" href="#"><i class="las la-toggle-on mr-2"></i>Toggle Status</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item text-danger" href="#" onclick="deleteBrand(1)"><i class="las la-trash mr-2"></i>Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <!-- Nike -->
                            <tr>
                                <td>
                                    <input type="checkbox" class="form-check-input brand-checkbox" data-id="2">
                                </td>
                                <td>
                                    <div class="brand-logo-container">
                                        <img src="https://via.placeholder.com/50/000000/ffffff?text=NK" 
                                             class="brand-logo" alt="Nike">
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-light">BR-002</span>
                                </td>
                                <td>
                                    <h6 class="mb-0">Nike</h6>
                                    <small class="text-muted">Sportswear & Footwear</small>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://flagcdn.com/w40/us.png" class="country-flag mr-2" alt="US">
                                        <span>USA</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="small">
                                        <div><i class="las la-envelope text-primary mr-1"></i> support@nike.com</div>
                                        <div><i class="las la-phone text-success mr-1"></i> +1-555-5678</div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-count product-count-pill">312</span>
                                </td>
                                <td>
                                    <span class="badge badge-success">Active</span>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('brands.show', 2) }}" class="btn btn-sm btn-info mr-2" title="View">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="{{ route('brands.edit', 2) }}" class="btn btn-sm btn-primary mr-2" title="Edit">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown">
                                                <i class="las la-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#"><i class="las la-copy mr-2"></i>Duplicate</a>
                                                <a class="dropdown-item" href="#"><i class="las la-chart-line mr-2"></i>View Report</a>
                                                <a class="dropdown-item" href="#"><i class="las la-toggle-on mr-2"></i>Toggle Status</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item text-danger" href="#" onclick="deleteBrand(2)"><i class="las la-trash mr-2"></i>Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <!-- Adidas -->
                            <tr>
                                <td>
                                    <input type="checkbox" class="form-check-input brand-checkbox" data-id="3">
                                </td>
                                <td>
                                    <div class="brand-logo-container">
                                        <img src="https://via.placeholder.com/50/000000/ffffff?text=AD" 
                                             class="brand-logo" alt="Adidas">
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-light">BR-003</span>
                                </td>
                                <td>
                                    <h6 class="mb-0">Adidas</h6>
                                    <small class="text-muted">Sportswear & Accessories</small>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://flagcdn.com/w40/de.png" class="country-flag mr-2" alt="DE">
                                        <span>Germany</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="small">
                                        <div><i class="las la-envelope text-primary mr-1"></i> info@adidas.com</div>
                                        <div><i class="las la-phone text-success mr-1"></i> +49-30-123456</div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-count product-count-pill">278</span>
                                </td>
                                <td>
                                    <span class="badge badge-success">Active</span>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('brands.show', 3) }}" class="btn btn-sm btn-info mr-2" title="View">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="{{ route('brands.edit', 3) }}" class="btn btn-sm btn-primary mr-2" title="Edit">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown">
                                                <i class="las la-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#"><i class="las la-copy mr-2"></i>Duplicate</a>
                                                <a class="dropdown-item" href="#"><i class="las la-chart-line mr-2"></i>View Report</a>
                                                <a class="dropdown-item" href="#"><i class="las la-toggle-on mr-2"></i>Toggle Status</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item text-danger" href="#" onclick="deleteBrand(3)"><i class="las la-trash mr-2"></i>Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <!-- Zara -->
                            <tr>
                                <td>
                                    <input type="checkbox" class="form-check-input brand-checkbox" data-id="4">
                                </td>
                                <td>
                                    <div class="brand-logo-container">
                                        <img src="https://via.placeholder.com/50/000000/ffffff?text=ZA" 
                                             class="brand-logo" alt="Zara">
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-light">BR-004</span>
                                </td>
                                <td>
                                    <h6 class="mb-0">Zara</h6>
                                    <small class="text-muted">Fast Fashion</small>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://flagcdn.com/w40/es.png" class="country-flag mr-2" alt="ES">
                                        <span>Spain</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="small">
                                        <div><i class="las la-envelope text-primary mr-1"></i> service@zara.com</div>
                                        <div><i class="las la-phone text-success mr-1"></i> +34-91-5551234</div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-count product-count-pill">189</span>
                                </td>
                                <td>
                                    <span class="badge badge-warning">Inactive</span>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('brands.show', 4) }}" class="btn btn-sm btn-info mr-2" title="View">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="{{ route('brands.edit', 4) }}" class="btn btn-sm btn-primary mr-2" title="Edit">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown">
                                                <i class="las la-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#"><i class="las la-toggle-on mr-2"></i>Activate</a>
                                                <a class="dropdown-item" href="#"><i class="las la-copy mr-2"></i>Duplicate</a>
                                                <a class="dropdown-item" href="#"><i class="las la-chart-line mr-2"></i>View Report</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item text-danger" href="#" onclick="deleteBrand(4)"><i class="las la-trash mr-2"></i>Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <!-- H&M -->
                            <tr>
                                <td>
                                    <input type="checkbox" class="form-check-input brand-checkbox" data-id="5">
                                </td>
                                <td>
                                    <div class="brand-logo-container">
                                        <img src="https://via.placeholder.com/50/da291c/ffffff?text=HM" 
                                             class="brand-logo" alt="H&M">
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-light">BR-005</span>
                                </td>
                                <td>
                                    <h6 class="mb-0">H&M</h6>
                                    <small class="text-muted">Clothing Retailer</small>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://flagcdn.com/w40/se.png" class="country-flag mr-2" alt="SE">
                                        <span>Sweden</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="small">
                                        <div><i class="las la-envelope text-primary mr-1"></i> customer@hm.com</div>
                                        <div><i class="las la-phone text-success mr-1"></i> +46-8-123456</div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-count product-count-pill">156</span>
                                </td>
                                <td>
                                    <span class="badge badge-success">Active</span>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('brands.show', 5) }}" class="btn btn-sm btn-info mr-2" title="View">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="{{ route('brands.edit', 5) }}" class="btn btn-sm btn-primary mr-2" title="Edit">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown">
                                                <i class="las la-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#"><i class="las la-copy mr-2"></i>Duplicate</a>
                                                <a class="dropdown-item" href="#"><i class="las la-chart-line mr-2"></i>View Report</a>
                                                <a class="dropdown-item" href="#"><i class="las la-toggle-on mr-2"></i>Toggle Status</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item text-danger" href="#" onclick="deleteBrand(5)"><i class="las la-trash mr-2"></i>Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Grid View (Hidden by default) -->
                <div id="gridView" style="display: none;">
                    <div class="row">
                        <!-- Brand Card 1 -->
                        <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                            <div class="card brand-card">
                                <div class="card-body text-center">
                                    <div class="brand-logo-container mx-auto mb-3" style="width: 80px; height: 80px;">
                                        <img src="https://via.placeholder.com/80/1e40af/ffffff?text=LS" 
                                             class="brand-logo" alt="Levi's">
                                    </div>
                                    <h5 class="mb-1">Levi's</h5>
                                    <div class="mb-2">
                                        <span class="badge badge-light">BR-001</span>
                                        <span class="badge badge-success ml-1">Active</span>
                                    </div>
                                    <div class="mb-3">
                                        <img src="https://flagcdn.com/w20/us.png" class="country-flag mr-1" alt="US">
                                        <small class="text-muted">United States</small>
                                    </div>
                                    <div class="d-flex justify-content-between mb-3">
                                        <div>
                                            <div class="h5 mb-0">248</div>
                                            <small class="text-muted">Products</small>
                                        </div>
                                        <div>
                                            <div class="h5 mb-0">$124K</div>
                                            <small class="text-muted">Sales</small>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('brands.show', 1) }}" class="btn btn-sm btn-info mr-1" title="View">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="{{ route('brands.edit', 1) }}" class="btn btn-sm btn-primary mr-1" title="Edit">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <button class="btn btn-sm btn-outline-danger" title="Delete" onclick="deleteBrand(1)">
                                            <i class="las la-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Brand Card 2 -->
                        <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                            <div class="card brand-card">
                                <div class="card-body text-center">
                                    <div class="brand-logo-container mx-auto mb-3" style="width: 80px; height: 80px;">
                                        <img src="https://via.placeholder.com/80/000000/ffffff?text=NK" 
                                             class="brand-logo" alt="Nike">
                                    </div>
                                    <h5 class="mb-1">Nike</h5>
                                    <div class="mb-2">
                                        <span class="badge badge-light">BR-002</span>
                                        <span class="badge badge-success ml-1">Active</span>
                                    </div>
                                    <div class="mb-3">
                                        <img src="https://flagcdn.com/w20/us.png" class="country-flag mr-1" alt="US">
                                        <small class="text-muted">United States</small>
                                    </div>
                                    <div class="d-flex justify-content-between mb-3">
                                        <div>
                                            <div class="h5 mb-0">312</div>
                                            <small class="text-muted">Products</small>
                                        </div>
                                        <div>
                                            <div class="h5 mb-0">$89K</div>
                                            <small class="text-muted">Sales</small>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('brands.show', 2) }}" class="btn btn-sm btn-info mr-1" title="View">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="{{ route('brands.edit', 2) }}" class="btn btn-sm btn-primary mr-1" title="Edit">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <button class="btn btn-sm btn-outline-danger" title="Delete" onclick="deleteBrand(2)">
                                            <i class="las la-trash"></i>
                                        </button>
                                    </div>
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
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
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
            // Initialize tooltips
            $('[title]').tooltip();
            
            // Update selected count
            $('.brand-checkbox').change(function() {
                updateSelectedCount();
            });
        });
        
        function toggleView() {
            const isChecked = $('#toggleGridView').is(':checked');
            if(isChecked) {
                $('#tableView').hide();
                $('#gridView').show();
            } else {
                $('#tableView').show();
                $('#gridView').hide();
            }
        }
        
        function toggleBulkActions() {
            const panel = $('#bulkActionsPanel');
            if(panel.is(':visible')) {
                panel.slideUp();
                $('.brand-checkbox').prop('checked', false);
                updateSelectedCount();
            } else {
                panel.slideDown();
            }
        }
        
        function toggleSelectAll() {
            const isChecked = $('#selectAll').is(':checked');
            $('.brand-checkbox').prop('checked', isChecked);
            updateSelectedCount();
        }
        
        function updateSelectedCount() {
            const count = $('.brand-checkbox:checked').length;
            $('#selectedCount').text(count);
            if(count > 0 && !$('#bulkActionsPanel').is(':visible')) {
                $('#bulkActionsPanel').show();
            }
        }
        
        function applyBulkAction() {
            const selected = $('.brand-checkbox:checked').map(function() {
                return $(this).data('id');
            }).get();
            
            if(selected.length === 0) {
                alert('Please select at least one brand.');
                return;
            }
            
            const action = $('#bulkActionsPanel select').val();
            if(!action) {
                alert('Please select an action to perform.');
                return;
            }
            
            if(confirm(`Are you sure you want to ${action} ${selected.length} brand(s)?`)) {
                console.log(`Performing ${action} on brands:`, selected);
                alert(`${selected.length} brand(s) processed successfully.`);
                toggleBulkActions();
            }
        }
        
        function applyFilters() {
            const search = $('#searchBrand').val().toLowerCase();
            const status = $('#filterStatus').val();
            const country = $('#filterCountry').val();
            const sortBy = $('#sortBy').val();
            
            // Filter logic
            $('tbody tr').each(function() {
                const name = $(this).find('h6').text().toLowerCase();
                const code = $(this).find('.badge-light').text().toLowerCase();
                const contact = $(this).find('.small').text().toLowerCase();
                const brandStatus = $(this).find('.badge').text().toLowerCase();
                const brandCountry = $(this).find('td:nth-child(5) span').text().toLowerCase();
                
                let show = true;
                
                if(search && !name.includes(search) && !code.includes(search) && !contact.includes(search)) {
                    show = false;
                }
                if(status && !brandStatus.includes(status.toLowerCase())) {
                    show = false;
                }
                if(country && !brandCountry.includes(country.toLowerCase())) {
                    show = false;
                }
                
                $(this).toggle(show);
            });
        }
        
        function resetFilters() {
            $('#searchBrand').val('');
            $('#filterStatus').val('');
            $('#filterCountry').val('');
            $('#sortBy').val('name_asc');
            $('tbody tr').show();
        }
        
        function exportBrands() {
            alert('Export functionality would be implemented here');
        }
        
        function deleteBrand(id) {
            if(confirm('Are you sure you want to delete this brand? This action cannot be undone.')) {
                console.log('Deleting brand:', id);
                alert('Brand deleted successfully (static demo)');
            }
        }
    </script>
    @endpush
</x-app-layout>