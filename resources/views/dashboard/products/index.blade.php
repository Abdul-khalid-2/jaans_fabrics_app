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
                <h4 class="mb-3">Products Management</h4>
                <p class="mb-0">Manage your clothing products, inventory and pricing</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Products</li>
                    </ol>
                </nav>
            </div>
            <div class="d-flex">
                <a href="{{ route('products.create') }}" class="btn btn-primary add-list">
                    <i class="las la-plus mr-2"></i>Add New Product
                </a>
                <a href="{{ route('inventory.index') }}" class="btn btn-outline-primary ml-2">
                    <i class="las la-boxes mr-2"></i>Inventory
                </a>
            </div>
        </div>

        <!-- Product Statistics -->
        <div class="row mb-4">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-white mb-0">Total Products</h6>
                                <h2 class="mb-0 text-white">156</h2>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-tshirt fa-2x text-primary"></i>
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
                                <h6 class="text-white mb-0">In Stock</h6>
                                <h2 class="mb-0 text-white">2,450</h2>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-box-open fa-2x text-success"></i>
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
                                <h6 class="text-white mb-0">Low Stock</h6>
                                <h2 class="mb-0 text-white">24</h2>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-exclamation-triangle fa-2x text-warning"></i>
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
                                <h6 class="text-white mb-0">Featured</h6>
                                <h2 class="mb-0 text-white">18</h2>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-star fa-2x text-info"></i>
                            </div>
                        </div>
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
                            <label>Search Product</label>
                            <input type="text" class="form-control" placeholder="Product name, code or SKU">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Category</label>
                            <select class="form-control">
                                <option value="">All Categories</option>
                                <option value="men">Men's Wear</option>
                                <option value="women">Women's Wear</option>
                                <option value="kids">Kids</option>
                                <option value="accessories">Accessories</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Brand</label>
                            <select class="form-control">
                                <option value="">All Brands</option>
                                <option value="nike">Nike</option>
                                <option value="adidas">Adidas</option>
                                <option value="puma">Puma</option>
                                <option value="levis">Levi's</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control">
                                <option value="">All Status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="out_of_stock">Out of Stock</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <div class="form-group w-100 d-flex">
                            <button class="btn btn-primary mr-2 flex-grow-1">Filter</button>
                            <button class="btn btn-outline-secondary">Reset</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Products Table -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product</th>
                                <th>Category</th>
                                <th>Brand</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Product 1 -->
                            <tr>
                                <td>1</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-md mr-3">
                                            <img src="https://images.unsplash.com/photo-1529374255404-311a2a4f1fd9?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=100&q=80" 
                                                 class="rounded" alt="Men's T-Shirt" style="width: 50px; height: 50px; object-fit: cover;">
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Men's Cotton T-Shirt</h6>
                                            <small class="text-muted">SKU: TS-MEN-001</small>
                                        </div>
                                    </div>
                                </td>
                                <td>Men's Wear</td>
                                <td>Nike</td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <strong class="text-primary">₹1,299</strong>
                                        <small class="text-muted"><s>₹1,599</s></small>
                                    </div>
                                </td>
                                <td>
                                    <div class="progress" style="height: 6px;">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 85%"></div>
                                    </div>
                                    <small>142 units</small>
                                </td>
                                <td>
                                    <span class="badge badge-success">Active</span>
                                    <br>
                                    <span class="badge badge-info mt-1">Featured</span>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('products.show', 1) }}" class="btn btn-sm btn-info mr-2" title="View">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="{{ route('products.edit', 1) }}" class="btn btn-sm btn-primary mr-2" title="Edit">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-warning mr-2" title="Update Stock">
                                            <i class="las la-boxes"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-danger" title="Delete">
                                            <i class="las la-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            <!-- Product 2 -->
                            <tr>
                                <td>2</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-md mr-3">
                                            <img src="https://images.unsplash.com/photo-1490481651871-ab68de25d43d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=100&q=80" 
                                                 class="rounded" alt="Women's Dress" style="width: 50px; height: 50px; object-fit: cover;">
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Women's Summer Dress</h6>
                                            <small class="text-muted">SKU: DR-WOM-002</small>
                                        </div>
                                    </div>
                                </td>
                                <td>Women's Wear</td>
                                <td>Zara</td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <strong class="text-primary">₹2,499</strong>
                                        <small class="text-muted"><s>₹3,199</s></small>
                                    </div>
                                </td>
                                <td>
                                    <div class="progress" style="height: 6px;">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 25%"></div>
                                    </div>
                                    <small>12 units</small>
                                </td>
                                <td>
                                    <span class="badge badge-warning">Low Stock</span>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('products.show', 2) }}" class="btn btn-sm btn-info mr-2" title="View">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="{{ route('products.edit', 2) }}" class="btn btn-sm btn-primary mr-2" title="Edit">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-warning mr-2" title="Update Stock">
                                            <i class="las la-boxes"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-danger" title="Delete">
                                            <i class="las la-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            <!-- Product 3 -->
                            <tr>
                                <td>3</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-md mr-3">
                                            <img src="https://images.unsplash.com/photo-1523381210434-271e8be1f52b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=100&q=80" 
                                                 class="rounded" alt="Kids Jacket" style="width: 50px; height: 50px; object-fit: cover;">
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Kids Winter Jacket</h6>
                                            <small class="text-muted">SKU: JK-KID-003</small>
                                        </div>
                                    </div>
                                </td>
                                <td>Kids</td>
                                <td>H&M</td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <strong class="text-primary">₹1,899</strong>
                                        <small class="text-muted">MRP</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="progress" style="height: 6px;">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 65%"></div>
                                    </div>
                                    <small>89 units</small>
                                </td>
                                <td>
                                    <span class="badge badge-success">Active</span>
                                    <br>
                                    <span class="badge badge-primary mt-1">New Arrival</span>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('products.show', 3) }}" class="btn btn-sm btn-info mr-2" title="View">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="{{ route('products.edit', 3) }}" class="btn btn-sm btn-primary mr-2" title="Edit">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-warning mr-2" title="Update Stock">
                                            <i class="las la-boxes"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-danger" title="Delete">
                                            <i class="las la-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            <!-- Product 4 -->
                            <tr>
                                <td>4</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-md mr-3">
                                            <img src="https://images.unsplash.com/photo-1553062407-98eeb64c6a62?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=100&q=80" 
                                                 class="rounded" alt="Jeans" style="width: 50px; height: 50px; object-fit: cover;">
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Men's Slim Fit Jeans</h6>
                                            <small class="text-muted">SKU: JN-MEN-004</small>
                                        </div>
                                    </div>
                                </td>
                                <td>Men's Wear</td>
                                <td>Levi's</td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <strong class="text-primary">₹2,999</strong>
                                        <small class="text-muted">MRP</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="progress" style="height: 6px;">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 5%"></div>
                                    </div>
                                    <small>3 units</small>
                                </td>
                                <td>
                                    <span class="badge badge-danger">Out of Stock</span>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('products.show', 4) }}" class="btn btn-sm btn-info mr-2" title="View">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="{{ route('products.edit', 4) }}" class="btn btn-sm btn-primary mr-2" title="Edit">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-success mr-2" title="Restock">
                                            <i class="las la-sync"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-danger" title="Delete">
                                            <i class="las la-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            <!-- Product 5 -->
                            <tr>
                                <td>5</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-md mr-3">
                                            <img src="https://images.unsplash.com/photo-1549298916-b41d501d3772?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=100&q=80" 
                                                 class="rounded" alt="Shoes" style="width: 50px; height: 50px; object-fit: cover;">
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Running Shoes</h6>
                                            <small class="text-muted">SKU: SH-MEN-005</small>
                                        </div>
                                    </div>
                                </td>
                                <td>Footwear</td>
                                <td>Adidas</td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <strong class="text-primary">₹4,599</strong>
                                        <small class="text-muted"><s>₹5,999</s></small>
                                    </div>
                                </td>
                                <td>
                                    <div class="progress" style="height: 6px;">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 75%"></div>
                                    </div>
                                    <small>56 units</small>
                                </td>
                                <td>
                                    <span class="badge badge-success">Active</span>
                                    <br>
                                    <span class="badge badge-warning mt-1">Best Seller</span>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('products.show', 5) }}" class="btn btn-sm btn-info mr-2" title="View">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="{{ route('products.edit', 5) }}" class="btn btn-sm btn-primary mr-2" title="Edit">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-warning mr-2" title="Update Stock">
                                            <i class="las la-boxes"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-danger" title="Delete">
                                            <i class="las la-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
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
    
    <!-- Tooltip Initialization -->
    <script>
        $(function () {
            $('[title]').tooltip();
        });
    </script>
    @endpush
</x-app-layout>