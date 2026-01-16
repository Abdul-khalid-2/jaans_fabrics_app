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
                <h4 class="mb-3">Add New Product</h4>
                <p class="mb-0">Add new clothing product to your inventory</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
                        <li class="breadcrumb-item active">Add Product</li>
                    </ol>
                </nav>
            </div>
            <div>
                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                    <i class="las la-arrow-left mr-2"></i>Back to Products
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <form>
                            <!-- Basic Information -->
                            <h6 class="mb-4 text-primary"><i class="las la-info-circle mr-2"></i>Basic Information</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Product Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter product name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Product Code <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="PROD-001" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">SKU <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="SKU-001" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Barcode</label>
                                        <input type="text" class="form-control" placeholder="Enter barcode">
                                    </div>
                                </div>
                            </div>

                            <!-- Category & Brand -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Category <span class="text-danger">*</span></label>
                                        <select class="form-control" required>
                                            <option value="">Select Category</option>
                                            <option value="men">Men's Wear</option>
                                            <option value="women">Women's Wear</option>
                                            <option value="kids">Kids</option>
                                            <option value="footwear">Footwear</option>
                                            <option value="accessories">Accessories</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Brand</label>
                                        <select class="form-control">
                                            <option value="">Select Brand</option>
                                            <option value="nike">Nike</option>
                                            <option value="adidas">Adidas</option>
                                            <option value="puma">Puma</option>
                                            <option value="levis">Levi's</option>
                                            <option value="zara">Zara</option>
                                            <option value="h&m">H&M</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="form-group">
                                <label class="form-label">Short Description</label>
                                <textarea class="form-control" rows="3" placeholder="Brief description about the product"></textarea>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Detailed Description</label>
                                <textarea class="form-control" rows="5" placeholder="Detailed product description including features, materials, care instructions, etc."></textarea>
                            </div>

                            <!-- Pricing -->
                            <h6 class="mb-4 text-primary mt-4"><i class="las la-tag mr-2"></i>Pricing Information</h6>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Cost Price <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rs</span>
                                            </div>
                                            <input type="number" class="form-control" placeholder="0.00" step="0.01" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">MRP <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rs</span>
                                            </div>
                                            <input type="number" class="form-control" placeholder="0.00" step="0.01" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Sale Price</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rs</span>
                                            </div>
                                            <input type="number" class="form-control" placeholder="0.00" step="0.01">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Inventory -->
                            <h6 class="mb-4 text-primary mt-4"><i class="las la-boxes mr-2"></i>Inventory Information</h6>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Initial Stock <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" placeholder="0" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Reorder Level</label>
                                        <input type="number" class="form-control" placeholder="10">
                                        <small class="form-text text-muted">Alert when stock reaches this level</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Reorder Quantity</label>
                                        <input type="number" class="form-control" placeholder="50">
                                        <small class="form-text text-muted">Quantity to reorder</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Tax & Measurement -->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Tax Rate (%)</label>
                                        <input type="number" class="form-control" placeholder="18" step="0.01">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Weight (kg)</label>
                                        <input type="number" class="form-control" placeholder="0.5" step="0.001">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">HSN Code</label>
                                        <input type="text" class="form-control" placeholder="HSN Code">
                                    </div>
                                </div>
                            </div>

                            <!-- Product Images -->
                            <h6 class="mb-4 text-primary mt-4"><i class="las la-images mr-2"></i>Product Images</h6>
                            <div class="form-group">
                                <label class="form-label">Upload Product Images</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="productImages" multiple accept="image/*">
                                    <label class="custom-file-label" for="productImages">Choose images...</label>
                                </div>
                                <small class="form-text text-muted">Upload multiple images (Max 5 images, 2MB each)</small>
                            </div>

                            <!-- Image Preview -->
                            <div class="row mb-4" id="imagePreview">
                                <div class="col-md-3 col-6 mb-3">
                                    <div class="image-upload-preview">
                                        <img src="https://via.placeholder.com/300x300/DDDDDD/555555?text=Image+Preview"
                                            class="img-fluid rounded border" alt="Preview">
                                        <button type="button" class="btn btn-sm btn-danger btn-remove-image">
                                            <i class="las la-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Status & Flags -->
                            <h6 class="mb-4 text-primary mt-4"><i class="las la-flag mr-2"></i>Status & Flags</h6>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="isActive" checked>
                                        <label class="custom-control-label" for="isActive">Active Product</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="isFeatured">
                                        <label class="custom-control-label" for="isFeatured">Featured Product</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="isNewArrival" checked>
                                        <label class="custom-control-label" for="isNewArrival">New Arrival</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="isBestseller">
                                        <label class="custom-control-label" for="isBestseller">Best Seller</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="form-group mt-5">
                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-outline-secondary mr-3">Cancel</button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="las la-save mr-2"></i>Save Product
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Sidebar - Product Variants -->
            <div class="col-lg-4">
                <!-- Variants -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="las la-layer-group mr-2"></i>Product Variants</h6>
                    </div>
                    <div class="card-body">
                        <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" class="custom-control-input" id="hasVariants">
                            <label class="custom-control-label" for="hasVariants">This product has variants (Size, Color, etc.)</label>
                        </div>

                        <div id="variantsSection" style="display: none;">
                            <!-- Size Variants -->
                            <div class="form-group">
                                <label class="form-label">Sizes</label>
                                <select class="form-control select2-multiple" multiple data-placeholder="Select sizes">
                                    <option value="xs">XS</option>
                                    <option value="s">S</option>
                                    <option value="m">M</option>
                                    <option value="l">L</option>
                                    <option value="xl">XL</option>
                                    <option value="xxl">XXL</option>
                                </select>
                            </div>

                            <!-- Color Variants -->
                            <div class="form-group">
                                <label class="form-label">Colors</label>
                                <select class="form-control select2-multiple" multiple data-placeholder="Select colors">
                                    <option value="red">Red</option>
                                    <option value="blue">Blue</option>
                                    <option value="green">Green</option>
                                    <option value="black">Black</option>
                                    <option value="white">White</option>
                                    <option value="gray">Gray</option>
                                </select>
                            </div>

                            <button type="button" class="btn btn-outline-primary btn-block">
                                <i class="las la-plus mr-2"></i>Add Variant
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Additional Information -->
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="las la-clipboard-list mr-2"></i>Additional Info</h6>
                    </div>
                    <div class="card-body">
                        <!-- Gender -->
                        <div class="form-group">
                            <label class="form-label">Gender</label>
                            <select class="form-control">
                                <option value="unisex">Unisex</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="kids">Kids</option>
                            </select>
                        </div>

                        <!-- Season -->
                        <div class="form-group">
                            <label class="form-label">Season</label>
                            <select class="form-control">
                                <option value="all_season">All Season</option>
                                <option value="summer">Summer</option>
                                <option value="winter">Winter</option>
                                <option value="spring">Spring</option>
                                <option value="autumn">Autumn</option>
                            </select>
                        </div>

                        <!-- Fabric -->
                        <div class="form-group">
                            <label class="form-label">Fabric Composition</label>
                            <input type="text" class="form-control" placeholder="e.g., 100% Cotton">
                        </div>

                        <!-- Care Instructions -->
                        <div class="form-group">
                            <label class="form-label">Care Instructions</label>
                            <textarea class="form-control" rows="3" placeholder="Washing and care instructions"></textarea>
                        </div>
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

    <!-- Select2 -->
    <script src="{{ asset('backend/assets/vendor/select2/dist/js/select2.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('.select2-multiple').select2();

            // Toggle variants section
            $('#hasVariants').change(function() {
                if ($(this).is(':checked')) {
                    $('#variantsSection').slideDown();
                } else {
                    $('#variantsSection').slideUp();
                }
            });

            // Image upload preview
            $('#productImages').on('change', function() {
                var files = $(this)[0].files;
                var preview = $('#imagePreview');
                preview.empty();

                for (var i = 0; i < files.length; i++) {
                    var file = files[i];
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        var imageHtml = `
                            <div class="col-md-3 col-6 mb-3">
                                <div class="image-upload-preview">
                                    <img src="${e.target.result}" 
                                         class="img-fluid rounded border" alt="Preview">
                                    <button type="button" class="btn btn-sm btn-danger btn-remove-image">
                                        <i class="las la-times"></i>
                                    </button>
                                </div>
                            </div>
                        `;
                        preview.append(imageHtml);
                    }

                    reader.readAsDataURL(file);
                }
            });

            // Remove image
            $(document).on('click', '.btn-remove-image', function() {
                $(this).closest('.col-md-3').remove();
            });

            // Form submission
            $('form').submit(function(e) {
                e.preventDefault();
                alert('Product added successfully!');
                window.location.href = "{{ route('products.index') }}";
            });
        });
    </script>

    <style>
        .image-upload-preview {
            position: relative;
            border-radius: 8px;
            overflow: hidden;
        }

        .image-upload-preview img {
            width: 100%;
            height: 120px;
            object-fit: cover;
        }

        .btn-remove-image {
            position: absolute;
            top: 5px;
            right: 5px;
            padding: 2px 6px;
            border-radius: 50%;
            font-size: 12px;
        }

        .select2-container--default .select2-selection--multiple {
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
        }
    </style>
    @endpush
</x-app-layout>