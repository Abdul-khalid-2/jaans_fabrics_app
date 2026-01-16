<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/remixicon/fonts/remixicon.css') }}">
    <style>
        .category-avatar {
            width: 150px;
            height: 150px;
            border-radius: 8px;
            object-fit: cover;
            border: 3px solid #fff;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            cursor: pointer;
        }

        .avatar-upload {
            position: relative;
            display: inline-block;
        }

        .avatar-upload-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            opacity: 0;
            transition: opacity 0.3s;
            cursor: pointer;
        }

        .avatar-upload:hover .avatar-upload-overlay {
            opacity: 1;
        }

        .form-section {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .form-section-title {
            font-weight: 600;
            color: #495057;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #dee2e6;
        }

        .stats-card {
            background: white;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            border: 1px solid #e3e6f0;
            transition: all 0.3s;
        }

        .stats-card:hover {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }

        .stats-number {
            font-size: 1.5rem;
            font-weight: 700;
            line-height: 1;
        }

        .stats-label {
            font-size: 0.875rem;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
    </style>
    @endpush

    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
            <div>
                <h4 class="mb-3">Edit Category</h4>
                <p class="mb-0">Update category information and settings</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categories</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('categories.show', 1) }}">Men's Wear</a></li>
                        <li class="breadcrumb-item active">Edit Category</li>
                    </ol>
                </nav>
            </div>
            <div>
                <a href="{{ route('categories.show', 1) }}" class="btn btn-outline-secondary">
                    <i class="las la-times mr-2"></i>Cancel
                </a>
                <button type="submit" form="categoryEditForm" class="btn btn-primary ml-2">
                    <i class="las la-save mr-2"></i>Save Changes
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <form id="categoryEditForm" action="{{ route('categories.update', 1) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-section">
                                <h6 class="form-section-title">Basic Information</h6>
                                <div class="row">
                                    <div class="col-md-3">
                                        <!-- Category Image -->
                                        <div class="form-group text-center">
                                            <div class="avatar-upload mb-3">
                                                <img id="categoryImagePreview"
                                                    src="https://via.placeholder.com/150x150/007bff/ffffff?text=Men's+Wear"
                                                    class="category-avatar" alt="Category Image">
                                                <div class="avatar-upload-overlay" onclick="document.getElementById('categoryImageInput').click()">
                                                    <div class="text-center">
                                                        <i class="las la-camera fa-2x"></i>
                                                        <p class="mb-0">Change Image</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="file" id="categoryImageInput" name="image" accept="image/*" style="display: none;">
                                            <small class="text-muted">Recommended: 300x300px, PNG/JPG</small>
                                        </div>
                                    </div>

                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Category Name <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="category_name" value="Men's Wear" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Category Code</label>
                                                    <input type="text" class="form-control" name="category_code" value="CAT-001" readonly>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Parent Category</label>
                                                    <select class="form-control" name="parent_id" id="parentCategory">
                                                        <option value="">-- Main Category --</option>
                                                        <option value="">No Parent</option>
                                                        <option value="4">Women's Wear</option>
                                                        <option value="5">Kid's Wear</option>
                                                        <option value="6">Accessories</option>
                                                    </select>
                                                    <small class="form-text text-muted">Leave empty for main category</small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Display Order</label>
                                                    <input type="number" class="form-control" name="display_order" value="1" min="0">
                                                    <small class="form-text text-muted">Lower number shows first</small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">Description</label>
                                            <textarea class="form-control" name="description" rows="3">All men's clothing including shirts, t-shirts, jeans, and formal wear</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-section">
                                <h6 class="form-section-title">SEO & Metadata</h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Meta Title</label>
                                            <input type="text" class="form-control" name="meta_title" value="Men's Clothing Collection">
                                            <small class="form-text text-muted">Recommended: 50-60 characters</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Meta Keywords</label>
                                            <input type="text" class="form-control" name="meta_keywords" value="men's wear, clothing, shirts, t-shirts, jeans">
                                            <small class="form-text text-muted">Separate with commas</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Meta Description</label>
                                    <textarea class="form-control" name="meta_description" rows="2">Browse our collection of men's clothing including shirts, t-shirts, jeans, and formal wear. Latest fashion trends for men.</textarea>
                                    <small class="form-text text-muted">Recommended: 150-160 characters</small>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Slug URL</label>
                                    <input type="text" class="form-control" name="slug" value="mens-wear">
                                    <small class="form-text text-muted">URL-friendly version of category name</small>
                                </div>
                            </div>

                            <div class="form-section">
                                <h6 class="form-section-title">Settings</h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Status</label>
                                            <select class="form-control" name="is_active">
                                                <option value="1" selected>Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Featured Category</label>
                                            <select class="form-control" name="is_featured">
                                                <option value="0">No</option>
                                                <option value="1" selected>Yes</option>
                                            </select>
                                            <small class="form-text text-muted">Show on homepage or featured sections</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="show_in_menu" id="showInMenu" checked>
                                                <label class="custom-control-label" for="showInMenu">Show in navigation menu</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="show_in_filter" id="showInFilter" checked>
                                                <label class="custom-control-label" for="showInFilter">Show in filter options</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <button type="button" class="btn btn-outline-danger" onclick="deleteCategory()">
                                    <i class="las la-trash mr-2"></i>Delete Category
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="las la-save mr-2"></i>Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <!-- Category Statistics -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="mb-0">Category Statistics</h6>
                    </div>
                    <div class="card-body">
                        <div class="stats-card">
                            <div class="stats-number text-primary">248</div>
                            <div class="stats-label">Total Products</div>
                        </div>
                        <div class="stats-card">
                            <div class="stats-number text-success">3</div>
                            <div class="stats-label">Sub Categories</div>
                        </div>
                        <div class="stats-card">
                            <div class="stats-number text-warning">Rs12,45,800</div>
                            <div class="stats-label">Total Sales Value</div>
                        </div>
                        <div class="stats-card">
                            <div class="stats-number text-info">42</div>
                            <div class="stats-label">Active Products</div>
                        </div>
                    </div>
                </div>

                <!-- Sub Categories -->
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Sub Categories</h6>
                        <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addSubCategoryModal">
                            <i class="las la-plus"></i>
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="list-group">
                            <a href="{{ route('categories.edit', 2) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-0">Shirts</h6>
                                    <small class="text-muted">85 products</small>
                                </div>
                                <span class="badge badge-success">Active</span>
                            </a>
                            <a href="{{ route('categories.edit', 3) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-0">T-Shirts</h6>
                                    <small class="text-muted">92 products</small>
                                </div>
                                <span class="badge badge-success">Active</span>
                            </a>
                            <a href="{{ route('categories.edit', 7) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-0">Jeans</h6>
                                    <small class="text-muted">71 products</small>
                                </div>
                                <span class="badge badge-success">Active</span>
                            </a>
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
                                <a href="#" class="btn btn-outline-primary btn-block">
                                    <i class="las la-copy"></i>
                                    <span class="d-block mt-1">Duplicate</span>
                                </a>
                            </div>
                            <div class="col-6 mb-3">
                                <a href="#" class="btn btn-outline-success btn-block">
                                    <i class="las la-arrow-right"></i>
                                    <span class="d-block mt-1">Move Products</span>
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="#" class="btn btn-outline-info btn-block">
                                    <i class="las la-chart-bar"></i>
                                    <span class="d-block mt-1">View Reports</span>
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="{{ route('products.create') }}" class="btn btn-outline-warning btn-block">
                                    <i class="las la-plus"></i>
                                    <span class="d-block mt-1">Add Product</span>
                                </a>
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
            // Category image upload
            $('#categoryImageInput').change(function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#categoryImagePreview').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(file);
                }
            });

            // Category form submission
            $('#categoryEditForm').submit(function(e) {
                e.preventDefault();

                // Basic validation
                const categoryName = $('input[name="category_name"]').val().trim();
                if (!categoryName) {
                    alert('Please enter category name');
                    return false;
                }

                // Show loading
                $('button[type="submit"]').prop('disabled', true).html('<i class="las la-spinner la-spin mr-2"></i>Saving...');

                // Simulate API call
                setTimeout(() => {
                    const formData = new FormData(this);
                    console.log('Category data:', Object.fromEntries(formData));
                    alert('Category updated successfully!');
                    window.location.href = "{{ route('categories.show', 1) }}";
                }, 1500);
            });

            // Delete category function
            window.deleteCategory = function() {
                if (confirm('Are you sure you want to delete this category?\n\nWarning: This will also delete all sub-categories and products under this category.')) {
                    // Show loading
                    $('body').append('<div class="loading-overlay"><div class="spinner"></div></div>');

                    setTimeout(() => {
                        alert('Category deleted successfully!');
                        window.location.href = "{{ route('categories.index') }}";
                    }, 1000);
                }
            };

            // Add sub-category modal
            $('#addSubCategoryModal').on('show.bs.modal', function() {
                $('#subCategoryForm')[0].reset();
                $('#subCategoryForm input[readonly]').val('CAT-' + Date.now().toString().slice(-8));
            });

            // Auto-generate slug from category name
            $('input[name="category_name"]').on('blur', function() {
                const categoryName = $(this).val().trim();
                if (categoryName && !$('input[name="slug"]').val()) {
                    const slug = categoryName
                        .toLowerCase()
                        .replace(/[^\w\s]/gi, '')
                        .replace(/\s+/g, '-');
                    $('input[name="slug"]').val(slug);
                }
            });

            // Duplicate category
            $('a:contains("Duplicate")').click(function(e) {
                e.preventDefault();
                if (confirm('Duplicate this category with all its settings?')) {
                    alert('Category duplicated. Redirecting to new category...');
                    // In real app, this would create a copy and redirect
                }
            });

            // Move products
            $('a:contains("Move Products")').click(function(e) {
                e.preventDefault();
                alert('Product moving functionality would open here');
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