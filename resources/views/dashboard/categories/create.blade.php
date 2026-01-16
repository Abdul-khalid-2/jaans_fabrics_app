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
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
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
            background: rgba(0,0,0,0.5);
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
        .category-preview {
            width: 100%;
            height: 120px;
            border: 2px dashed #dee2e6;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background: #f8f9fa;
        }
        .category-preview img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }
    </style>
    @endpush

    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
            <div>
                <h4 class="mb-3">Create New Category</h4>
                <p class="mb-0">Add a new product category to organize your products</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categories</a></li>
                        <li class="breadcrumb-item active">Create Category</li>
                    </ol>
                </nav>
            </div>
            <div>
                <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">
                    <i class="las la-times mr-2"></i>Cancel
                </a>
                <button type="submit" form="categoryCreateForm" class="btn btn-primary ml-2">
                    <i class="las la-save mr-2"></i>Save Category
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form id="categoryCreateForm" action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="form-section">
                                <h6 class="form-section-title">Basic Information</h6>
                                <div class="row">
                                    <div class="col-md-3">
                                        <!-- Category Image -->
                                        <div class="form-group text-center">
                                            <div class="avatar-upload mb-3">
                                                <img id="categoryImagePreview" 
                                                     src="https://via.placeholder.com/150x150/007bff/ffffff?text=Category" 
                                                     class="category-avatar" alt="Category Image">
                                                <div class="avatar-upload-overlay" onclick="document.getElementById('categoryImageInput').click()">
                                                    <div class="text-center">
                                                        <i class="las la-camera fa-2x"></i>
                                                        <p class="mb-0">Upload Image</p>
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
                                                    <input type="text" class="form-control" name="category_name" placeholder="Enter category name" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Category Code</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" name="category_code" value="CAT-{{ date('YmdHis') }}" readonly>
                                                        <div class="input-group-append">
                                                            <button type="button" class="btn btn-outline-secondary" onclick="generateCategoryCode()">
                                                                <i class="las la-sync"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Parent Category</label>
                                                    <select class="form-control" name="parent_id" id="parentCategory">
                                                        <option value="">Select Parent Category</option>
                                                        <option value="">-- Main Category --</option>
                                                        <option value="1">Men's Wear</option>
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
                                                    <input type="number" class="form-control" name="display_order" value="0" min="0">
                                                    <small class="form-text text-muted">Lower number shows first</small>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="form-label">Description</label>
                                            <textarea class="form-control" name="description" rows="3" placeholder="Enter category description"></textarea>
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
                                            <input type="text" class="form-control" name="meta_title" placeholder="SEO meta title">
                                            <small class="form-text text-muted">Recommended: 50-60 characters</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Meta Keywords</label>
                                            <input type="text" class="form-control" name="meta_keywords" placeholder="keyword1, keyword2, keyword3">
                                            <small class="form-text text-muted">Separate with commas</small>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label">Meta Description</label>
                                    <textarea class="form-control" name="meta_description" rows="2" placeholder="SEO meta description"></textarea>
                                    <small class="form-text text-muted">Recommended: 150-160 characters</small>
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label">Slug URL</label>
                                    <input type="text" class="form-control" name="slug" placeholder="category-url-slug">
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
                                                <option value="0" selected>No</option>
                                                <option value="1">Yes</option>
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
                            
                            <div class="form-section">
                                <h6 class="form-section-title">Category Preview</h6>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="category-preview mb-3">
                                            <div id="previewPlaceholder" class="text-center">
                                                <i class="las la-folder-open fa-3x text-muted"></i>
                                                <p class="mt-2 mb-0">Category preview will appear here</p>
                                            </div>
                                            <img id="categoryPreviewImage" src="" alt="Category Preview" style="display: none;">
                                        </div>
                                        <button type="button" class="btn btn-outline-primary" onclick="updatePreview()">
                                            <i class="las la-eye mr-2"></i>Update Preview
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-between mt-4">
                                <button type="button" class="btn btn-outline-secondary" onclick="resetForm()">
                                    <i class="las la-redo mr-2"></i>Reset Form
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="las la-save mr-2"></i>Save Category
                                </button>
                            </div>
                        </form>
                    </div>
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
                if(file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#categoryImagePreview').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(file);
                }
            });
            
            // Generate slug from category name
            $('input[name="category_name"]').on('blur', function() {
                const name = $(this).val();
                if(name && !$('input[name="slug"]').val()) {
                    const slug = name.toLowerCase()
                        .replace(/[^\w\s-]/g, '')
                        .replace(/\s+/g, '-')
                        .replace(/--+/g, '-')
                        .trim();
                    $('input[name="slug"]').val(slug);
                }
            });
            
            // Form submission
            $('#categoryCreateForm').submit(function(e) {
                e.preventDefault();
                
                // Basic validation
                const categoryName = $('input[name="category_name"]').val().trim();
                if(!categoryName) {
                    alert('Please enter category name');
                    $('input[name="category_name"]').focus();
                    return false;
                }
                
                // Show loading
                $('button[type="submit"]').prop('disabled', true).html('<i class="las la-spinner la-spin mr-2"></i>Saving...');
                
                // Collect form data
                const formData = new FormData(this);
                
                // Simulate API call
                setTimeout(() => {
                    console.log('Form data:', Object.fromEntries(formData));
                    alert('Category created successfully!');
                    window.location.href = "{{ route('categories.index') }}";
                }, 1500);
                
                return false;
            });
        });
        
        // Generate category code
        window.generateCategoryCode = function() {
            const timestamp = Date.now().toString();
            const code = 'CAT-' + timestamp.slice(-8);
            $('input[name="category_code"]').val(code);
        };
        
        // Update preview
        window.updatePreview = function() {
            const name = $('input[name="category_name"]').val();
            const description = $('textarea[name="description"]').val();
            const imageSrc = $('#categoryImagePreview').attr('src');
            
            if(name) {
                $('#previewPlaceholder').hide();
                $('#categoryPreviewImage').attr('src', imageSrc).show();
                
                // In real app, you would update preview with actual data
                console.log('Preview updated:', { name, description });
                alert('Preview updated!');
            } else {
                alert('Please enter category name first');
            }
        };
        
        // Reset form
        window.resetForm = function() {
            if(confirm('Are you sure you want to reset the form? All data will be lost.')) {
                $('#categoryCreateForm')[0].reset();
                $('#categoryImagePreview').attr('src', 'https://via.placeholder.com/150x150/007bff/ffffff?text=Category');
                $('#categoryPreviewImage').hide();
                $('#previewPlaceholder').show();
                $('input[name="category_code"]').val('CAT-' + Date.now().toString().slice(-8));
            }
        };
    </script>
    @endpush
</x-app-layout>