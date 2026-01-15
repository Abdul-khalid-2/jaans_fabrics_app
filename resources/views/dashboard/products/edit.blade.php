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
                <h4 class="mb-3">Edit Product</h4>
                <p class="mb-0">Update product information and details</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
                        <li class="breadcrumb-item active">Edit Product</li>
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
                        <!-- Product Header -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-lg mr-3">
                                    <img src="https://images.unsplash.com/photo-1529374255404-311a2a4f1fd9?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=100&q=80" 
                                         class="rounded" alt="Product" style="width: 60px; height: 60px; object-fit: cover;">
                                </div>
                                <div>
                                    <h5 class="mb-0">Men's Cotton T-Shirt</h5>
                                    <p class="mb-0 text-muted">SKU: TS-MEN-001 | Code: PROD-001</p>
                                </div>
                            </div>
                            <div>
                                <span class="badge badge-success">Active</span>
                                <span class="badge badge-info ml-2">Featured</span>
                            </div>
                        </div>

                        <form>
                            <!-- Basic Information -->
                            <h6 class="mb-4 text-primary"><i class="las la-info-circle mr-2"></i>Basic Information</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Product Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" value="Men's Cotton T-Shirt" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Product Code <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" value="PROD-001" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">SKU <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" value="TS-MEN-001" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Barcode</label>
                                        <input type="text" class="form-control" value="8901234567890">
                                    </div>
                                </div>
                            </div>

                            <!-- Category & Brand -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Category <span class="text-danger">*</span></label>
                                        <select class="form-control" required>
                                            <option value="men" selected>Men's Wear</option>
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
                                            <option value="nike" selected>Nike</option>
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
                                <textarea class="form-control" rows="3">Premium cotton t-shirt for men, comfortable and stylish.</textarea>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Detailed Description</label>
                                <textarea class="form-control" rows="5">Made from 100% premium cotton, this t-shirt offers exceptional comfort and durability. Perfect for casual wear, sports, and daily activities. Features a classic crew neck design with ribbed collar for better fit. Machine washable, retains shape and color after multiple washes.</textarea>
                            </div>

                            <!-- Pricing -->
                            <h6 class="mb-4 text-primary mt-4"><i class="las la-tag mr-2"></i>Pricing Information</h6>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Cost Price <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">₹</span>
                                            </div>
                                            <input type="number" class="form-control" value="800" step="0.01" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">MRP <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">₹</span>
                                            </div>
                                            <input type="number" class="form-control" value="1599" step="0.01" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Sale Price</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">₹</span>
                                            </div>
                                            <input type="number" class="form-control" value="1299" step="0.01">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Inventory -->
                            <h6 class="mb-4 text-primary mt-4"><i class="las la-boxes mr-2"></i>Inventory Information</h6>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Current Stock</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" value="142" readonly>
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#stockModal">
                                                    Update Stock
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Reorder Level</label>
                                        <input type="number" class="form-control" value="10">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Reorder Quantity</label>
                                        <input type="number" class="form-control" value="50">
                                    </div>
                                </div>
                            </div>

                            <!-- Product Images -->
                            <h6 class="mb-4 text-primary mt-4"><i class="las la-images mr-2"></i>Product Images</h6>
                            <div class="row mb-3">
                                <div class="col-md-3 col-6 mb-3">
                                    <div class="image-preview">
                                        <img src="https://images.unsplash.com/photo-1529374255404-311a2a4f1fd9?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80" 
                                             class="img-fluid rounded border" alt="Product Image">
                                        <div class="image-actions">
                                            <button type="button" class="btn btn-sm btn-primary">
                                                <i class="las la-star"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger">
                                                <i class="las la-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6 mb-3">
                                    <div class="image-preview">
                                        <img src="https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80" 
                                             class="img-fluid rounded border" alt="Product Image">
                                        <div class="image-actions">
                                            <button type="button" class="btn btn-sm btn-outline-primary">
                                                <i class="las la-star"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger">
                                                <i class="las la-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Add Image Button -->
                                <div class="col-md-3 col-6 mb-3">
                                    <div class="add-image-placeholder border rounded d-flex align-items-center justify-content-center" 
                                         style="height: 150px; cursor: pointer;" 
                                         onclick="document.getElementById('addImage').click()">
                                        <div class="text-center">
                                            <i class="las la-plus-circle fa-2x text-muted"></i>
                                            <p class="mt-2 mb-0 text-muted">Add Image</p>
                                        </div>
                                    </div>
                                    <input type="file" id="addImage" style="display: none;" accept="image/*">
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="form-group mt-5">
                                <div class="d-flex justify-content-between">
                                    <button type="button" class="btn btn-outline-danger" id="deleteProduct">
                                        <i class="las la-trash mr-2"></i>Delete Product
                                    </button>
                                    <div>
                                        <button type="button" class="btn btn-outline-secondary mr-3">Cancel</button>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="las la-save mr-2"></i>Update Product
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Sidebar - Product Stats -->
            <div class="col-lg-4">
                <!-- Product Statistics -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="las la-chart-bar mr-2"></i>Product Statistics</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <small class="text-muted">Total Sold</small>
                            <h4 class="mb-0">458 units</h4>
                        </div>
                        <div class="mb-3">
                            <small class="text-muted">This Month</small>
                            <h4 class="mb-0">68 units</h4>
                        </div>
                        <div class="mb-3">
                            <small class="text-muted">Revenue Generated</small>
                            <h4 class="mb-0 text-success">₹5,94,542</h4>
                        </div>
                        <div class="mb-3">
                            <small class="text-muted">Profit Margin</small>
                            <h4 class="mb-0 text-primary">38.2%</h4>
                        </div>
                        <div>
                            <small class="text-muted">Last Restocked</small>
                            <h6 class="mb-0">15 Nov 2024</h6>
                        </div>
                    </div>
                </div>

                <!-- Variants -->
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="mb-0"><i class="las la-layer-group mr-2"></i>Product Variants</h6>
                        <button type="button" class="btn btn-sm btn-outline-primary">
                            <i class="las la-plus"></i>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Variant</th>
                                        <th>Stock</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>S (Red)</td>
                                        <td><span class="badge badge-success">42</span></td>
                                        <td>₹1,299</td>
                                    </tr>
                                    <tr>
                                        <td>M (Blue)</td>
                                        <td><span class="badge badge-success">35</span></td>
                                        <td>₹1,299</td>
                                    </tr>
                                    <tr>
                                        <td>L (Black)</td>
                                        <td><span class="badge badge-warning">8</span></td>
                                        <td>₹1,299</td>
                                    </tr>
                                    <tr>
                                        <td>XL (White)</td>
                                        <td><span class="badge badge-danger">2</span></td>
                                        <td>₹1,299</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Additional Information -->
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="las la-clipboard-list mr-2"></i>Additional Info</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <small class="text-muted">Gender</small>
                            <h6 class="mb-0">Male</h6>
                        </div>
                        <div class="mb-3">
                            <small class="text-muted">Season</small>
                            <h6 class="mb-0">All Season</h6>
                        </div>
                        <div class="mb-3">
                            <small class="text-muted">Fabric</small>
                            <h6 class="mb-0">100% Cotton</h6>
                        </div>
                        <div class="mb-3">
                            <small class="text-muted">Weight</small>
                            <h6 class="mb-0">0.25 kg</h6>
                        </div>
                        <div>
                            <small class="text-muted">Created</small>
                            <h6 class="mb-0">12 Jan 2024</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stock Update Modal -->
    <div class="modal fade" id="stockModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Stock</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label>Current Stock: 142 units</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">New Stock</span>
                                </div>
                                <input type="number" class="form-control" value="142">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Adjustment Type</label>
                            <select class="form-control">
                                <option value="add">Add Stock</option>
                                <option value="subtract">Subtract Stock</option>
                                <option value="set">Set Stock</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Reason</label>
                            <textarea class="form-control" rows="3" placeholder="Enter reason for stock adjustment"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Update Stock</button>
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
            // Form submission
            $('form').submit(function(e) {
                e.preventDefault();
                alert('Product updated successfully!');
            });
            
            // Delete product confirmation
            $('#deleteProduct').click(function() {
                if(confirm('Are you sure you want to delete this product? This action cannot be undone.')) {
                    alert('Product deleted successfully!');
                    window.location.href = "{{ route('products.index') }}";
                }
            });
            
            // Add image preview
            $('#addImage').change(function() {
                if(this.files && this.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        var newImage = `
                            <div class="col-md-3 col-6 mb-3">
                                <div class="image-preview">
                                    <img src="${e.target.result}" 
                                         class="img-fluid rounded border" alt="New Image">
                                    <div class="image-actions">
                                        <button type="button" class="btn btn-sm btn-outline-primary">
                                            <i class="las la-star"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-danger">
                                            <i class="las la-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        `;
                        $('.add-image-placeholder').closest('.col-md-3').before(newImage);
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });
            
            // Set primary image
            $(document).on('click', '.image-actions .btn-outline-primary', function() {
                $('.image-actions .btn-primary').removeClass('btn-primary').addClass('btn-outline-primary');
                $('.image-actions .btn-outline-primary i').removeClass('las la-star').addClass('las la-star');
                $(this).removeClass('btn-outline-primary').addClass('btn-primary');
                $(this).find('i').removeClass('las la-star').addClass('las la-star');
                alert('Set as primary image');
            });
            
            // Remove image
            $(document).on('click', '.image-actions .btn-danger', function() {
                if(confirm('Remove this image?')) {
                    $(this).closest('.col-md-3').remove();
                }
            });
        });
    </script>
    
    <style>
        .image-preview {
            position: relative;
            border-radius: 8px;
            overflow: hidden;
        }
        .image-preview img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }
        .image-actions {
            position: absolute;
            top: 5px;
            right: 5px;
            opacity: 0;
            transition: opacity 0.3s;
        }
        .image-preview:hover .image-actions {
            opacity: 1;
        }
        .add-image-placeholder:hover {
            background-color: #f8f9fa;
        }
    </style>
    @endpush
</x-app-layout>