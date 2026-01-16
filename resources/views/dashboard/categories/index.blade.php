<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/remixicon/fonts/remixicon.css') }}">
    <style>
        .category-tree {
            list-style: none;
            padding-left: 0;
        }
        .category-tree ul {
            padding-left: 30px;
            list-style: none;
        }
        .category-item {
            border: 1px solid #e3e6f0;
            border-radius: 8px;
            margin-bottom: 10px;
            padding: 15px;
            transition: all 0.3s;
            background: white;
        }
        .category-item:hover {
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transform: translateY(-2px);
        }
        .category-item-child {
            margin-left: 40px;
            border-left: 3px solid #dee2e6;
            padding-left: 20px;
        }
        .category-avatar {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            object-fit: cover;
            border: 2px solid #fff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .badge-count {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            color: #6c757d;
            font-weight: 600;
        }
        .drag-handle {
            cursor: move;
            color: #6c757d;
        }
        .tree-toggle {
            cursor: pointer;
            width: 20px;
            height: 20px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: #f8f9fa;
            margin-right: 10px;
        }
        .tree-toggle:hover {
            background: #e9ecef;
        }
    </style>
    @endpush

    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
            <div>
                <h4 class="mb-3">Product Categories</h4>
                <p class="mb-0">Manage and organize your product categories</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Categories</li>
                    </ol>
                </nav>
            </div>
            <div class="d-flex">
                <a href="{{ route('categories.create') }}" class="btn btn-primary add-list">
                    <i class="las la-plus mr-2"></i>Add Category
                </a>
                <button class="btn btn-outline-primary ml-2" onclick="exportCategories()">
                    <i class="las la-download mr-2"></i>Export
                </button>
                <button class="btn btn-outline-success ml-2" onclick="saveCategoryOrder()" id="saveOrderBtn" style="display: none;">
                    <i class="las la-save mr-2"></i>Save Order
                </button>
            </div>
        </div>

        <!-- Category Statistics -->
        <div class="row mb-4">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-white mb-0">Total Categories</h6>
                                <h2 class="mb-0 text-white">48</h2>
                                <small class="text-white-50">Active: 45</small>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-folder fa-2x text-primary"></i>
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
                                <h6 class="text-white mb-0">Main Categories</h6>
                                <h2 class="mb-0 text-white">12</h2>
                                <small class="text-white-50">No parent category</small>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-folder-open fa-2x text-success"></i>
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
                                <h6 class="text-white mb-0">Sub Categories</h6>
                                <h2 class="mb-0 text-white">36</h2>
                                <small class="text-white-50">Nested categories</small>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-sitemap fa-2x text-warning"></i>
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
                                <small class="text-white-50">Across all categories</small>
                            </div>
                            <div class="bg-white rounded p-3">
                                <i class="las la-boxes fa-2x text-info"></i>
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
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Search Category</label>
                            <input type="text" class="form-control" id="searchCategory" placeholder="Category name or code">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" id="filterStatus">
                                <option value="">All Status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Parent Category</label>
                            <select class="form-control" id="filterParent">
                                <option value="">All Categories</option>
                                <option value="0">Main Categories Only</option>
                                <option value="1">Men's Wear</option>
                                <option value="2">Women's Wear</option>
                                <option value="3">Kid's Wear</option>
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

        <!-- Categories Tree View -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0">Category Hierarchy</h6>
                <div>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="toggleTreeView" onchange="toggleTreeView()">
                        <label class="custom-control-label" for="toggleTreeView">Tree View</label>
                    </div>
                    <button class="btn btn-sm btn-outline-secondary ml-2" onclick="toggleAllCategories()">
                        <i class="las la-expand"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive" id="tableView">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th width="10%">Code</th>
                                <th width="25%">Category</th>
                                <th width="15%">Parent</th>
                                <th width="10%">Products</th>
                                <th width="10%">Status</th>
                                <th width="10%">Display Order</th>
                                <th width="15%">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="categoryTableBody">
                            <!-- Men's Wear -->
                            <tr>
                                <td>1</td>
                                <td><span class="badge badge-light">CAT-001</span></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/40" class="category-avatar mr-3" alt="Men's Wear">
                                        <div>
                                            <h6 class="mb-0">Men's Wear</h6>
                                            <small class="text-muted">Main category</small>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="text-muted">-</span></td>
                                <td>
                                    <span class="badge badge-count">248</span>
                                </td>
                                <td>
                                    <span class="badge badge-success">Active</span>
                                </td>
                                <td>
                                    <input type="number" class="form-control form-control-sm" value="1" style="width: 70px;">
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('categories.show', 1) }}" class="btn btn-sm btn-info mr-2">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="{{ route('categories.edit', 1) }}" class="btn btn-sm btn-primary mr-2">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-success mr-2" data-toggle="modal" data-target="#addSubCategoryModal" data-parent="1">
                                            <i class="las la-plus"></i>
                                        </a>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown">
                                                <i class="las la-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#"><i class="las la-copy mr-2"></i>Duplicate</a>
                                                <a class="dropdown-item" href="#"><i class="las la-arrow-right mr-2"></i>Move Products</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item text-danger" href="#"><i class="las la-trash mr-2"></i>Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <!-- Sub-category: Shirts -->
                            <tr class="table-light">
                                <td>2</td>
                                <td><span class="badge badge-light">CAT-002</span></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="ml-4 mr-3">
                                            <i class="las la-level-up-alt fa-rotate-90 text-muted"></i>
                                        </div>
                                        <img src="https://via.placeholder.com/40" class="category-avatar mr-3" alt="Shirts">
                                        <div>
                                            <h6 class="mb-0">Shirts</h6>
                                            <small class="text-muted">Sub-category of Men's Wear</small>
                                        </div>
                                    </div>
                                </td>
                                <td>Men's Wear</td>
                                <td>
                                    <span class="badge badge-count">85</span>
                                </td>
                                <td>
                                    <span class="badge badge-success">Active</span>
                                </td>
                                <td>
                                    <input type="number" class="form-control form-control-sm" value="1" style="width: 70px;">
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('categories.show', 2) }}" class="btn btn-sm btn-info mr-2">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="{{ route('categories.edit', 2) }}" class="btn btn-sm btn-primary mr-2">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-success mr-2">
                                            <i class="las la-plus"></i>
                                        </a>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown">
                                                <i class="las la-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#"><i class="las la-copy mr-2"></i>Duplicate</a>
                                                <a class="dropdown-item" href="#"><i class="las la-arrow-right mr-2"></i>Move Products</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item text-danger" href="#"><i class="las la-trash mr-2"></i>Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <!-- Sub-category: T-Shirts -->
                            <tr class="table-light">
                                <td>3</td>
                                <td><span class="badge badge-light">CAT-003</span></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="ml-4 mr-3">
                                            <i class="las la-level-up-alt fa-rotate-90 text-muted"></i>
                                        </div>
                                        <img src="https://via.placeholder.com/40" class="category-avatar mr-3" alt="T-Shirts">
                                        <div>
                                            <h6 class="mb-0">T-Shirts</h6>
                                            <small class="text-muted">Sub-category of Men's Wear</small>
                                        </div>
                                    </div>
                                </td>
                                <td>Men's Wear</td>
                                <td>
                                    <span class="badge badge-count">92</span>
                                </td>
                                <td>
                                    <span class="badge badge-success">Active</span>
                                </td>
                                <td>
                                    <input type="number" class="form-control form-control-sm" value="2" style="width: 70px;">
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('categories.show', 3) }}" class="btn btn-sm btn-info mr-2">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="{{ route('categories.edit', 3) }}" class="btn btn-sm btn-primary mr-2">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-success mr-2">
                                            <i class="las la-plus"></i>
                                        </a>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown">
                                                <i class="las la-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#"><i class="las la-copy mr-2"></i>Duplicate</a>
                                                <a class="dropdown-item" href="#"><i class="las la-arrow-right mr-2"></i>Move Products</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item text-danger" href="#"><i class="las la-trash mr-2"></i>Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <!-- Women's Wear -->
                            <tr>
                                <td>4</td>
                                <td><span class="badge badge-light">CAT-004</span></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/40" class="category-avatar mr-3" alt="Women's Wear">
                                        <div>
                                            <h6 class="mb-0">Women's Wear</h6>
                                            <small class="text-muted">Main category</small>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="text-muted">-</span></td>
                                <td>
                                    <span class="badge badge-count">356</span>
                                </td>
                                <td>
                                    <span class="badge badge-success">Active</span>
                                </td>
                                <td>
                                    <input type="number" class="form-control form-control-sm" value="2" style="width: 70px;">
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('categories.show', 4) }}" class="btn btn-sm btn-info mr-2">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="{{ route('categories.edit', 4) }}" class="btn btn-sm btn-primary mr-2">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-success mr-2" data-toggle="modal" data-target="#addSubCategoryModal" data-parent="4">
                                            <i class="las la-plus"></i>
                                        </a>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown">
                                                <i class="las la-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#"><i class="las la-copy mr-2"></i>Duplicate</a>
                                                <a class="dropdown-item" href="#"><i class="las la-arrow-right mr-2"></i>Move Products</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item text-danger" href="#"><i class="las la-trash mr-2"></i>Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <!-- Kid's Wear -->
                            <tr>
                                <td>5</td>
                                <td><span class="badge badge-light">CAT-005</span></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/40" class="category-avatar mr-3" alt="Kid's Wear">
                                        <div>
                                            <h6 class="mb-0">Kid's Wear</h6>
                                            <small class="text-muted">Main category</small>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="text-muted">-</span></td>
                                <td>
                                    <span class="badge badge-count">187</span>
                                </td>
                                <td>
                                    <span class="badge badge-success">Active</span>
                                </td>
                                <td>
                                    <input type="number" class="form-control form-control-sm" value="3" style="width: 70px;">
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('categories.show', 5) }}" class="btn btn-sm btn-info mr-2">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="{{ route('categories.edit', 5) }}" class="btn btn-sm btn-primary mr-2">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-success mr-2" data-toggle="modal" data-target="#addSubCategoryModal" data-parent="5">
                                            <i class="las la-plus"></i>
                                        </a>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown">
                                                <i class="las la-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#"><i class="las la-copy mr-2"></i>Duplicate</a>
                                                <a class="dropdown-item" href="#"><i class="las la-arrow-right mr-2"></i>Move Products</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item text-danger" href="#"><i class="las la-trash mr-2"></i>Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <!-- Accessories -->
                            <tr>
                                <td>6</td>
                                <td><span class="badge badge-light">CAT-006</span></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/40" class="category-avatar mr-3" alt="Accessories">
                                        <div>
                                            <h6 class="mb-0">Accessories</h6>
                                            <small class="text-muted">Main category</small>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="text-muted">-</span></td>
                                <td>
                                    <span class="badge badge-count">112</span>
                                </td>
                                <td>
                                    <span class="badge badge-warning">Inactive</span>
                                </td>
                                <td>
                                    <input type="number" class="form-control form-control-sm" value="4" style="width: 70px;">
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('categories.show', 6) }}" class="btn btn-sm btn-info mr-2">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="{{ route('categories.edit', 6) }}" class="btn btn-sm btn-primary mr-2">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-success mr-2">
                                            <i class="las la-plus"></i>
                                        </a>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown">
                                                <i class="las la-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#"><i class="las la-toggle-on mr-2"></i>Activate</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item text-danger" href="#"><i class="las la-trash mr-2"></i>Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Tree View (Hidden by default) -->
                <div id="treeView" style="display: none;">
                    <div class="category-tree">
                        <!-- Men's Wear Tree Item -->
                        <div class="category-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <span class="tree-toggle" onclick="toggleCategory(1)">
                                        <i class="las la-minus"></i>
                                    </span>
                                    <img src="https://via.placeholder.com/50" class="category-avatar mr-3" alt="Men's Wear">
                                    <div>
                                        <h6 class="mb-0">Men's Wear</h6>
                                        <small class="text-muted">CAT-001 | 248 products</small>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="badge badge-success mr-3">Active</span>
                                    <div class="btn-group">
                                        <a href="{{ route('categories.show', 1) }}" class="btn btn-sm btn-info">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="{{ route('categories.edit', 1) }}" class="btn btn-sm btn-primary">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#addSubCategoryModal" data-parent="1">
                                            <i class="las la-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="category-children mt-3" id="category-1">
                                <!-- Shirts -->
                                <div class="category-item category-item-child">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <span class="tree-toggle" onclick="toggleCategory(2)">
                                                <i class="las la-plus"></i>
                                            </span>
                                            <img src="https://via.placeholder.com/40" class="category-avatar mr-3" alt="Shirts">
                                            <div>
                                                <h6 class="mb-0">Shirts</h6>
                                                <small class="text-muted">CAT-002 | 85 products</small>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span class="badge badge-success mr-3">Active</span>
                                            <div class="btn-group">
                                                <a href="{{ route('categories.show', 2) }}" class="btn btn-sm btn-info">
                                                    <i class="las la-eye"></i>
                                                </a>
                                                <a href="{{ route('categories.edit', 2) }}" class="btn btn-sm btn-primary">
                                                    <i class="las la-edit"></i>
                                                </a>
                                                <a href="#" class="btn btn-sm btn-success">
                                                    <i class="las la-plus"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="category-children mt-3" id="category-2" style="display: none;">
                                        <!-- Empty sub-categories -->
                                    </div>
                                </div>
                                <!-- T-Shirts -->
                                <div class="category-item category-item-child">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <span class="tree-toggle" onclick="toggleCategory(3)">
                                                <i class="las la-plus"></i>
                                            </span>
                                            <img src="https://via.placeholder.com/40" class="category-avatar mr-3" alt="T-Shirts">
                                            <div>
                                                <h6 class="mb-0">T-Shirts</h6>
                                                <small class="text-muted">CAT-003 | 92 products</small>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span class="badge badge-success mr-3">Active</span>
                                            <div class="btn-group">
                                                <a href="{{ route('categories.show', 3) }}" class="btn btn-sm btn-info">
                                                    <i class="las la-eye"></i>
                                                </a>
                                                <a href="{{ route('categories.edit', 3) }}" class="btn btn-sm btn-primary">
                                                    <i class="las la-edit"></i>
                                                </a>
                                                <a href="#" class="btn btn-sm btn-success">
                                                    <i class="las la-plus"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Women's Wear Tree Item -->
                        <div class="category-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <span class="tree-toggle" onclick="toggleCategory(4)">
                                        <i class="las la-plus"></i>
                                    </span>
                                    <img src="https://via.placeholder.com/50" class="category-avatar mr-3" alt="Women's Wear">
                                    <div>
                                        <h6 class="mb-0">Women's Wear</h6>
                                        <small class="text-muted">CAT-004 | 356 products</small>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="badge badge-success mr-3">Active</span>
                                    <div class="btn-group">
                                        <a href="{{ route('categories.show', 4) }}" class="btn btn-sm btn-info">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="{{ route('categories.edit', 4) }}" class="btn btn-sm btn-primary">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-success">
                                            <i class="las la-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Kid's Wear Tree Item -->
                        <div class="category-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <span class="tree-toggle" onclick="toggleCategory(5)">
                                        <i class="las la-plus"></i>
                                    </span>
                                    <img src="https://via.placeholder.com/50" class="category-avatar mr-3" alt="Kid's Wear">
                                    <div>
                                        <h6 class="mb-0">Kid's Wear</h6>
                                        <small class="text-muted">CAT-005 | 187 products</small>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="badge badge-success mr-3">Active</span>
                                    <div class="btn-group">
                                        <a href="{{ route('categories.show', 5) }}" class="btn btn-sm btn-info">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="{{ route('categories.edit', 5) }}" class="btn btn-sm btn-primary">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-success">
                                            <i class="las la-plus"></i>
                                        </a>
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

    <!-- Add Sub-Category Modal -->
    <div class="modal fade" id="addSubCategoryModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Sub-Category</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="subCategoryForm">
                        <input type="hidden" id="parentCategoryId">
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
                            <label>Category Image</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="categoryImage">
                                <label class="custom-file-label" for="categoryImage">Choose image...</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Display Order</label>
                            <input type="number" class="form-control" value="0">
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
                    <button type="button" class="btn btn-primary">Save Sub-Category</button>
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
            
            // File upload label
            $('.custom-file-input').on('change', function() {
                const fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').text(fileName || 'Choose file...');
            });
            
            // Add sub-category modal
            $('#addSubCategoryModal').on('show.bs.modal', function(e) {
                const button = $(e.relatedTarget);
                const parentId = button.data('parent');
                const parentName = button.closest('tr').find('h6').text();
                $('#parentCategoryId').val(parentId);
                $(this).find('.modal-title').text(`Add Sub-Category to ${parentName}`);
            });
            
            // Display order change
            $('input[type="number"]').on('change', function() {
                $('#saveOrderBtn').show();
            });
        });
        
        function toggleTreeView() {
            const isChecked = $('#toggleTreeView').is(':checked');
            if(isChecked) {
                $('#tableView').hide();
                $('#treeView').show();
            } else {
                $('#tableView').show();
                $('#treeView').hide();
            }
        }
        
        function toggleCategory(categoryId) {
            const children = $(`#category-${categoryId}`);
            const toggle = $(`.tree-toggle[onclick="toggleCategory(${categoryId})"] i`);
            
            if(children.is(':visible')) {
                children.slideUp();
                toggle.removeClass('la-minus').addClass('la-plus');
            } else {
                children.slideDown();
                toggle.removeClass('la-plus').addClass('la-minus');
            }
        }
        
        function toggleAllCategories() {
            const isExpanded = $('.category-children:visible').length > 0;
            if(isExpanded) {
                $('.category-children').slideUp();
                $('.tree-toggle i').removeClass('la-minus').addClass('la-plus');
            } else {
                $('.category-children').slideDown();
                $('.tree-toggle i').removeClass('la-plus').addClass('la-minus');
            }
        }
        
        function applyFilters() {
            const search = $('#searchCategory').val().toLowerCase();
            const status = $('#filterStatus').val();
            const parent = $('#filterParent').val();
            
            $('tbody tr').each(function() {
                const name = $(this).find('h6').text().toLowerCase();
                const categoryStatus = $(this).find('.badge').text().toLowerCase();
                const parentCategory = $(this).find('td:nth-child(4)').text().toLowerCase();
                
                let show = true;
                
                if(search && !name.includes(search)) {
                    show = false;
                }
                if(status && !categoryStatus.includes(status.toLowerCase())) {
                    show = false;
                }
                if(parent && parentCategory !== (parent === '0' ? '-' : parent.toLowerCase())) {
                    show = false;
                }
                
                if(show) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }
        
        function resetFilters() {
            $('#searchCategory').val('');
            $('#filterStatus').val('');
            $('#filterParent').val('');
            $('tbody tr').show();
        }
        
        function exportCategories() {
            alert('Export functionality would be implemented here');
        }
        
        function saveCategoryOrder() {
            const orders = [];
            $('input[type="number"]').each(function(index) {
                orders.push({
                    id: index + 1,
                    order: $(this).val()
                });
            });
            
            console.log('Saving order:', orders);
            alert('Category order saved successfully!');
            $('#saveOrderBtn').hide();
        }
    </script>
    @endpush
</x-app-layout>