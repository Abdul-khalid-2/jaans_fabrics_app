<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/remixicon/fonts/remixicon.css') }}">
    <style>
        .brand-header-logo {
            width: 120px;
            height: 120px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            border: 3px solid #e3e6f0;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            margin: 0 auto;
            overflow: hidden;
        }
        .brand-header-logo img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }
        .stat-card {
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            background: white;
            border: 1px solid #e3e6f0;
            transition: transform 0.3s;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-right: 15px;
        }
        .activity-timeline {
            position: relative;
            padding-left: 30px;
        }
        .activity-timeline:before {
            content: '';
            position: absolute;
            left: 15px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: #e9ecef;
        }
        .activity-item {
            position: relative;
            margin-bottom: 20px;
        }
        .activity-icon {
            position: absolute;
            left: -30px;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 14px;
        }
        .activity-content {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 10px 15px;
            border-left: 3px solid #4e73df;
        }
        .country-flag-large {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .product-avatar {
            width: 50px;
            height: 50px;
            border-radius: 8px;
            object-fit: cover;
            border: 2px solid #fff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
    </style>
    @endpush

    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
            <div>
                <h4 class="mb-3">Brand Details</h4>
                <p class="mb-0">View complete brand information and statistics</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('brands.index') }}">Brands</a></li>
                        <li class="breadcrumb-item active">Levi's</li>
                    </ol>
                </nav>
            </div>
            <div class="d-flex">
                <a href="{{ route('brands.edit', 1) }}" class="btn btn-warning mr-2">
                    <i class="las la-edit mr-2"></i>Edit
                </a>
                <a href="{{ route('brands.create') }}" class="btn btn-success mr-2">
                    <i class="las la-plus mr-2"></i>Add Product
                </a>
                <a href="{{ route('brands.index') }}" class="btn btn-secondary">
                    <i class="las la-arrow-left mr-2"></i>Back to Brands
                </a>
            </div>
        </div>

        <!-- Brand Header -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-3 text-center">
                        <div class="brand-header-logo mb-3">
                            <img src="https://via.placeholder.com/100/1e40af/ffffff?text=LS" 
                                 alt="Levi's Logo">
                        </div>
                        <div class="mt-3">
                            <span class="badge badge-primary mb-1">BR-001</span>
                            <span class="badge badge-success mb-1">Active</span>
                            <span class="badge badge-info mb-1">Featured</span>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h2 class="h3 mb-2">Levi's</h2>
                                <div class="d-flex align-items-center mb-3">
                                    <img src="https://flagcdn.com/w40/us.png" class="country-flag-large mr-2" alt="USA">
                                    <div>
                                        <div class="h6 mb-0">United States</div>
                                        <small class="text-muted">Country of Origin</small>
                                    </div>
                                </div>
                                <p class="text-muted mb-0">
                                    Denim & Casual Wear brand established in 1853. Known for quality jeans and denim products worldwide.
                                </p>
                            </div>
                            <div class="text-end">
                                <div class="h2 text-primary mb-1">248</div>
                                <div class="text-muted">Products</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Left Column -->
            <div class="col-lg-8">
                <!-- Brand Information Card -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="las la-info-circle mr-2"></i>Brand Information</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-sm">
                                    <tr>
                                        <th width="40%">Brand Code:</th>
                                        <td><span class="badge badge-light">BR-001</span></td>
                                    </tr>
                                    <tr>
                                        <th>Brand Name:</th>
                                        <td><strong>Levi's</strong></td>
                                    </tr>
                                    <tr>
                                        <th>Country:</th>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="https://flagcdn.com/w20/us.png" class="country-flag-large mr-2" style="width: 20px; height: 20px;">
                                                United States (US)
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Website:</th>
                                        <td>
                                            <a href="https://www.levi.com" target="_blank" class="text-decoration-none">
                                                <i class="las la-external-link-alt mr-1"></i> https://www.levi.com
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-sm">
                                    <tr>
                                        <th width="40%">Contact Email:</th>
                                        <td>
                                            <a href="mailto:contact@levi.com" class="text-decoration-none">
                                                <i class="las la-envelope mr-1"></i> contact@levi.com
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Contact Phone:</th>
                                        <td>
                                            <a href="tel:+15551234" class="text-decoration-none">
                                                <i class="las la-phone mr-1"></i> +1-555-1234
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Status:</th>
                                        <td>
                                            <span class="badge badge-success">
                                                <i class="las la-check-circle mr-1"></i> Active
                                            </span>
                                            <span class="badge badge-info ml-1">
                                                <i class="las la-star mr-1"></i> Featured
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Created:</th>
                                        <td>2024-01-15 10:30 AM</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <h6 class="font-weight-bold">Description:</h6>
                            <p class="text-muted">
                                Levi's is an American clothing company known worldwide for its Levi's brand of denim jeans. 
                                It was founded in May 1853 when German immigrant Levi Strauss came from Buttenheim, Bavaria, 
                                to San Francisco, California to open a west coast branch of his brothers' New York dry goods business.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Recent Products Card -->
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="mb-0"><i class="las la-tshirt mr-2"></i>Recent Products (248 Total)</h6>
                        <a href="#" class="btn btn-sm btn-primary">View All Products</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>SKU</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                        <th>Stock</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="https://via.placeholder.com/40" class="product-avatar mr-3" alt="Product">
                                                <div>
                                                    <h6 class="mb-0">Levi's 501 Original Jeans</h6>
                                                    <small class="text-muted">Men's Wear > Jeans</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="badge badge-light">LS-501-BL</span></td>
                                        <td>Jeans</td>
                                        <td>$89.99</td>
                                        <td><span class="badge badge-success">45 in stock</span></td>
                                        <td><span class="badge badge-success">Active</span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="https://via.placeholder.com/40" class="product-avatar mr-3" alt="Product">
                                                <div>
                                                    <h6 class="mb-0">Levi's Trucker Jacket</h6>
                                                    <small class="text-muted">Men's Wear > Jackets</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="badge badge-light">LS-TJ-BL</span></td>
                                        <td>Jackets</td>
                                        <td>$129.99</td>
                                        <td><span class="badge badge-warning">Low stock</span></td>
                                        <td><span class="badge badge-success">Active</span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="https://via.placeholder.com/40" class="product-avatar mr-3" alt="Product">
                                                <div>
                                                    <h6 class="mb-0">Levi's Graphic T-Shirt</h6>
                                                    <small class="text-muted">Men's Wear > T-Shirts</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="badge badge-light">LS-GT-WH</span></td>
                                        <td>T-Shirts</td>
                                        <td>$29.99</td>
                                        <td><span class="badge badge-success">120 in stock</span></td>
                                        <td><span class="badge badge-success">Active</span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="https://via.placeholder.com/40" class="product-avatar mr-3" alt="Product">
                                                <div>
                                                    <h6 class="mb-0">Levi's Denim Shorts</h6>
                                                    <small class="text-muted">Men's Wear > Shorts</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="badge badge-light">LS-DS-BL</span></td>
                                        <td>Shorts</td>
                                        <td>$49.99</td>
                                        <td><span class="badge badge-danger">Out of stock</span></td>
                                        <td><span class="badge badge-warning">Inactive</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-lg-4">
                <!-- Statistics Cards -->
                <div class="row">
                    <div class="col-12 mb-4">
                        <div class="stat-card">
                            <div class="d-flex align-items-center">
                                <div class="stat-icon bg-primary text-white">
                                    <i class="las la-boxes"></i>
                                </div>
                                <div>
                                    <div class="h4 mb-0 text-primary">248</div>
                                    <div class="text-muted">Total Products</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mb-4">
                        <div class="stat-card">
                            <div class="d-flex align-items-center">
                                <div class="stat-icon bg-success text-white">
                                    <i class="las la-shopping-cart"></i>
                                </div>
                                <div>
                                    <div class="h4 mb-0 text-success">$124,567</div>
                                    <div class="text-muted">Total Sales</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mb-4">
                        <div class="stat-card">
                            <div class="d-flex align-items-center">
                                <div class="stat-icon bg-info text-white">
                                    <i class="las la-sitemap"></i>
                                </div>
                                <div>
                                    <div class="h4 mb-0 text-info">12</div>
                                    <div class="text-muted">Categories</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mb-4">
                        <div class="stat-card">
                            <div class="d-flex align-items-center">
                                <div class="stat-icon bg-warning text-white">
                                    <i class="las la-chart-line"></i>
                                </div>
                                <div>
                                    <div class="h4 mb-0 text-warning">89%</div>
                                    <div class="text-muted">Sell-through Rate</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions Card -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="las la-bolt mr-2"></i>Quick Actions</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="#" class="btn btn-outline-primary">
                                <i class="las la-plus mr-2"></i>Add New Product
                            </a>
                            <a href="#" class="btn btn-outline-success">
                                <i class="las la-chart-line mr-2"></i>Sales Report
                            </a>
                            <a href="#" class="btn btn-outline-info">
                                <i class="las la-file-export mr-2"></i>Export Products
                            </a>
                            <a href="{{ route('brands.edit', 1) }}" class="btn btn-outline-warning">
                                <i class="las la-edit mr-2"></i>Edit Brand
                            </a>
                            <button class="btn btn-outline-danger" data-toggle="modal" data-target="#deleteModal">
                                <i class="las la-trash mr-2"></i>Delete Brand
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity Card -->
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="las la-history mr-2"></i>Recent Activity</h6>
                    </div>
                    <div class="card-body">
                        <div class="activity-timeline">
                            <div class="activity-item">
                                <div class="activity-icon bg-success">
                                    <i class="las la-edit"></i>
                                </div>
                                <div class="activity-content">
                                    <div class="activity-title">Brand Updated</div>
                                    <div class="activity-time">Today, 10:30 AM</div>
                                    <div class="activity-desc">Changed contact information</div>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-icon bg-info">
                                    <i class="las la-tshirt"></i>
                                </div>
                                <div class="activity-content">
                                    <div class="activity-title">Product Added</div>
                                    <div class="activity-time">Yesterday, 03:45 PM</div>
                                    <div class="activity-desc">Added "Levi's Denim Jacket"</div>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-icon bg-warning">
                                    <i class="las la-exchange-alt"></i>
                                </div>
                                <div class="activity-content">
                                    <div class="activity-title">Stock Updated</div>
                                    <div class="activity-time">Jan 22, 2024</div>
                                    <div class="activity-desc">Updated inventory for 5 products</div>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-icon bg-primary">
                                    <i class="las la-tags"></i>
                                </div>
                                <div class="activity-content">
                                    <div class="activity-title">Price Updated</div>
                                    <div class="activity-time">Jan 20, 2024</div>
                                    <div class="activity-desc">Adjusted prices for 3 products</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger">
                        <i class="las la-exclamation-triangle mr-2"></i>Confirm Deletion
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete the brand <strong>"Levi's"</strong>?</p>
                    <div class="alert alert-danger">
                        <i class="las la-exclamation-circle mr-2"></i>
                        <strong>Warning:</strong> This action cannot be undone. All 248 products under this brand will be affected.
                    </div>
                    <div class="form-group">
                        <label>Select action for existing products:</label>
                        <select class="form-control">
                            <option value="">Delete all products</option>
                            <option value="move">Move to another brand</option>
                            <option value="deactivate">Deactivate products</option>
                        </select>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="confirmDeleteShow">
                        <label class="custom-control-label" for="confirmDeleteShow">
                            I understand this action cannot be undone
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtnShow" disabled>
                        <i class="las la-trash mr-2"></i>Delete Brand
                    </button>
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
            // Initialize tooltips
            $('[title]').tooltip();
            
            // Delete confirmation
            $('#confirmDeleteShow').change(function() {
                $('#confirmDeleteBtnShow').prop('disabled', !$(this).prop('checked'));
            });
            
            $('#confirmDeleteBtnShow').click(function() {
                console.log('Deleting brand:', 1);
                alert('Brand deleted successfully! (static demo)');
                
                // Redirect to brands list
                setTimeout(() => {
                    window.location.href = "{{ route('brands.index') }}";
                }, 1500);
            });
        });
    </script>
    @endpush
</x-app-layout>