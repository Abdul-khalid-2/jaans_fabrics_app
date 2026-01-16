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
                <h4 class="mb-3">Product Details</h4>
                <p class="mb-0">View complete product information and statistics</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
                        <li class="breadcrumb-item active">Product Details</li>
                    </ol>
                </nav>
            </div>
            <div class="d-flex">
                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary mr-2">
                    <i class="las la-arrow-left mr-2"></i>Back
                </a>
                <a href="{{ route('products.edit', 1) }}" class="btn btn-primary mr-2">
                    <i class="las la-edit mr-2"></i>Edit
                </a>
                <button class="btn btn-danger" id="printProduct">
                    <i class="las la-print mr-2"></i>Print
                </button>
            </div>
        </div>

        <div class="row">
            <!-- Left Column - Product Details -->
            <div class="col-lg-8">
                <!-- Product Header -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <!-- Main Product Image -->
                                <div class="product-main-image mb-3">
                                    <img src="https://images.unsplash.com/photo-1529374255404-311a2a4f1fd9?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80"
                                        class="img-fluid rounded" alt="Product Image" id="mainProductImage">
                                </div>

                                <!-- Thumbnail Images -->
                                <div class="row">
                                    <div class="col-3">
                                        <img src="https://images.unsplash.com/photo-1529374255404-311a2a4f1fd9?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80"
                                            class="img-fluid rounded border cursor-pointer"
                                            onclick="changeMainImage(this.src)"
                                            style="cursor: pointer;">
                                    </div>
                                    <div class="col-3">
                                        <img src="https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80"
                                            class="img-fluid rounded border cursor-pointer"
                                            onclick="changeMainImage(this.src)"
                                            style="cursor: pointer;">
                                    </div>
                                    <div class="col-3">
                                        <img src="https://images.unsplash.com/photo-1586790170083-2f9ceadc732d?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80"
                                            class="img-fluid rounded border cursor-pointer"
                                            onclick="changeMainImage(this.src)"
                                            style="cursor: pointer;">
                                    </div>
                                    <div class="col-3">
                                        <img src="https://images.unsplash.com/photo-1558769132-cb1a40ed0ada?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80"
                                            class="img-fluid rounded border cursor-pointer"
                                            onclick="changeMainImage(this.src)"
                                            style="cursor: pointer;">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <div>
                                        <h3 class="mb-1">Men's Cotton T-Shirt</h3>
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="text-warning mr-2">
                                                <i class="las la-star"></i>
                                                <i class="las la-star"></i>
                                                <i class="las la-star"></i>
                                                <i class="las la-star"></i>
                                                <i class="las la-star-half-alt"></i>
                                            </div>
                                            <span class="text-muted">(4.5/5 from 128 reviews)</span>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <span class="badge badge-success">Active</span>
                                        <span class="badge badge-info ml-1">Featured</span>
                                        <span class="badge badge-primary ml-1">Best Seller</span>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h2 class="text-primary mb-0">Rs1,299</h2>
                                    <div class="d-flex align-items-center">
                                        <del class="text-muted mr-2">Rs1,599</del>
                                        <span class="badge badge-danger">19% OFF</span>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-6">
                                        <small class="text-muted d-block">SKU</small>
                                        <strong>TS-MEN-001</strong>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted d-block">Product Code</small>
                                        <strong>PROD-001</strong>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-6">
                                        <small class="text-muted d-block">Category</small>
                                        <strong>Men's Wear</strong>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted d-block">Brand</small>
                                        <strong>Nike</strong>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <small class="text-muted d-block">Description</small>
                                    <p class="mb-0">Premium cotton t-shirt for men, comfortable and stylish. Perfect for casual wear, sports, and daily activities.</p>
                                </div>

                                <div class="d-flex">
                                    <div class="mr-4">
                                        <small class="text-muted d-block">Current Stock</small>
                                        <h3 class="mb-0 text-success">142 units</h3>
                                    </div>
                                    <div class="mr-4">
                                        <small class="text-muted d-block">Reorder Level</small>
                                        <h5 class="mb-0">10 units</h5>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block">Total Sold</small>
                                        <h3 class="mb-0 text-primary">458 units</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product Tabs -->
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="productTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="details-tab" data-toggle="tab" href="#details">
                                    <i class="las la-info-circle mr-2"></i>Details
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="specs-tab" data-toggle="tab" href="#specs">
                                    <i class="las la-clipboard-list mr-2"></i>Specifications
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="inventory-tab" data-toggle="tab" href="#inventory">
                                    <i class="las la-boxes mr-2"></i>Inventory
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="sales-tab" data-toggle="tab" href="#sales">
                                    <i class="las la-chart-line mr-2"></i>Sales History
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content mt-4" id="productTabContent">
                            <!-- Details Tab -->
                            <div class="tab-pane fade show active" id="details" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table table-sm">
                                            <tr>
                                                <th width="40%">Product Name</th>
                                                <td>Men's Cotton T-Shirt</td>
                                            </tr>
                                            <tr>
                                                <th>SKU</th>
                                                <td>TS-MEN-001</td>
                                            </tr>
                                            <tr>
                                                <th>Product Code</th>
                                                <td>PROD-001</td>
                                            </tr>
                                            <tr>
                                                <th>Barcode</th>
                                                <td>8901234567890</td>
                                            </tr>
                                            <tr>
                                                <th>Category</th>
                                                <td>Men's Wear</td>
                                            </tr>
                                            <tr>
                                                <th>Brand</th>
                                                <td>Nike</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-sm">
                                            <tr>
                                                <th width="40%">Gender</th>
                                                <td>Male</td>
                                            </tr>
                                            <tr>
                                                <th>Season</th>
                                                <td>All Season</td>
                                            </tr>
                                            <tr>
                                                <th>Fabric</th>
                                                <td>100% Cotton</td>
                                            </tr>
                                            <tr>
                                                <th>Weight</th>
                                                <td>0.25 kg</td>
                                            </tr>
                                            <tr>
                                                <th>Tax Rate</th>
                                                <td>18%</td>
                                            </tr>
                                            <tr>
                                                <th>HSN Code</th>
                                                <td>610910</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                                <h6 class="mt-4 mb-3">Full Description</h6>
                                <p>Made from 100% premium cotton, this t-shirt offers exceptional comfort and durability. Perfect for casual wear, sports, and daily activities. Features a classic crew neck design with ribbed collar for better fit. Machine washable, retains shape and color after multiple washes.</p>

                                <h6 class="mt-4 mb-3">Care Instructions</h6>
                                <ul>
                                    <li>Machine wash cold with similar colors</li>
                                    <li>Do not bleach</li>
                                    <li>Tumble dry low</li>
                                    <li>Iron on low heat</li>
                                    <li>Do not dry clean</li>
                                </ul>
                            </div>

                            <!-- Specifications Tab -->
                            <div class="tab-pane fade" id="specs" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6>Product Specifications</h6>
                                        <table class="table table-sm">
                                            <tr>
                                                <th>Material</th>
                                                <td>100% Cotton</td>
                                            </tr>
                                            <tr>
                                                <th>Fit</th>
                                                <td>Regular Fit</td>
                                            </tr>
                                            <tr>
                                                <th>Sleeve</th>
                                                <td>Short Sleeve</td>
                                            </tr>
                                            <tr>
                                                <th>Neck</th>
                                                <td>Crew Neck</td>
                                            </tr>
                                            <tr>
                                                <th>Pattern</th>
                                                <td>Solid</td>
                                            </tr>
                                            <tr>
                                                <th>Color</th>
                                                <td>Red, Blue, Black, White</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <h6>Size Chart</h6>
                                        <table class="table table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Size</th>
                                                    <th>Chest (inches)</th>
                                                    <th>Length (inches)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>S</td>
                                                    <td>36-38</td>
                                                    <td>27</td>
                                                </tr>
                                                <tr>
                                                    <td>M</td>
                                                    <td>38-40</td>
                                                    <td>28</td>
                                                </tr>
                                                <tr>
                                                    <td>L</td>
                                                    <td>40-42</td>
                                                    <td>29</td>
                                                </tr>
                                                <tr>
                                                    <td>XL</td>
                                                    <td>42-44</td>
                                                    <td>30</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- Inventory Tab -->
                            <div class="tab-pane fade" id="inventory" role="tabpanel">
                                <div class="row mb-4">
                                    <div class="col-md-4">
                                        <div class="card bg-light">
                                            <div class="card-body text-center">
                                                <h6 class="text-muted">Total Stock</h6>
                                                <h2 class="text-primary">142</h2>
                                                <small>units</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card bg-light">
                                            <div class="card-body text-center">
                                                <h6 class="text-muted">Available</h6>
                                                <h2 class="text-success">138</h2>
                                                <small>units</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card bg-light">
                                            <div class="card-body text-center">
                                                <h6 class="text-muted">Reserved</h6>
                                                <h2 class="text-warning">4</h2>
                                                <small>units</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <h6>Variant-wise Stock</h6>
                                <div class="table-responsive">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th>Variant</th>
                                                <th>Size</th>
                                                <th>Color</th>
                                                <th>Current Stock</th>
                                                <th>Available</th>
                                                <th>Reserved</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>TS-MEN-001-RED-S</td>
                                                <td>S</td>
                                                <td>Red</td>
                                                <td>42</td>
                                                <td>41</td>
                                                <td>1</td>
                                                <td><span class="badge badge-success">In Stock</span></td>
                                            </tr>
                                            <tr>
                                                <td>TS-MEN-001-BLUE-M</td>
                                                <td>M</td>
                                                <td>Blue</td>
                                                <td>35</td>
                                                <td>34</td>
                                                <td>1</td>
                                                <td><span class="badge badge-success">In Stock</span></td>
                                            </tr>
                                            <tr>
                                                <td>TS-MEN-001-BLACK-L</td>
                                                <td>L</td>
                                                <td>Black</td>
                                                <td>28</td>
                                                <td>26</td>
                                                <td>2</td>
                                                <td><span class="badge badge-success">In Stock</span></td>
                                            </tr>
                                            <tr>
                                                <td>TS-MEN-001-WHITE-XL</td>
                                                <td>XL</td>
                                                <td>White</td>
                                                <td>2</td>
                                                <td>2</td>
                                                <td>0</td>
                                                <td><span class="badge badge-warning">Low Stock</span></td>
                                            </tr>
                                            <tr>
                                                <td>TS-MEN-001-GRAY-XXL</td>
                                                <td>XXL</td>
                                                <td>Gray</td>
                                                <td>0</td>
                                                <td>0</td>
                                                <td>0</td>
                                                <td><span class="badge badge-danger">Out of Stock</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="mt-4">
                                    <button class="btn btn-outline-primary" data-toggle="modal" data-target="#stockHistoryModal">
                                        <i class="las la-history mr-2"></i>View Stock History
                                    </button>
                                    <button class="btn btn-outline-success ml-2" data-toggle="modal" data-target="#updateStockModal">
                                        <i class="las la-edit mr-2"></i>Update Stock
                                    </button>
                                </div>
                            </div>

                            <!-- Sales Tab -->
                            <div class="tab-pane fade" id="sales" role="tabpanel">
                                <div class="row mb-4">
                                    <div class="col-md-3">
                                        <div class="card bg-light">
                                            <div class="card-body text-center">
                                                <h6 class="text-muted">Total Sold</h6>
                                                <h2 class="text-primary">458</h2>
                                                <small>units</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card bg-light">
                                            <div class="card-body text-center">
                                                <h6 class="text-muted">This Month</h6>
                                                <h2 class="text-success">68</h2>
                                                <small>units</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card bg-light">
                                            <div class="card-body text-center">
                                                <h6 class="text-muted">Revenue</h6>
                                                <h2 class="text-info">Rs5,94,542</h2>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card bg-light">
                                            <div class="card-body text-center">
                                                <h6 class="text-muted">Profit</h2>
                                                    <h2 class="text-success">Rs2,27,143</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <h6>Recent Sales</h6>
                                <div class="table-responsive">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Invoice No</th>
                                                <th>Customer</th>
                                                <th>Quantity</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>15 Nov 2024</td>
                                                <td>INV-2024-00123</td>
                                                <td>John Smith</td>
                                                <td>3</td>
                                                <td>Rs3,897</td>
                                                <td><span class="badge badge-success">Completed</span></td>
                                            </tr>
                                            <tr>
                                                <td>14 Nov 2024</td>
                                                <td>INV-2024-00119</td>
                                                <td>Sarah Johnson</td>
                                                <td>2</td>
                                                <td>Rs2,598</td>
                                                <td><span class="badge badge-success">Completed</span></td>
                                            </tr>
                                            <tr>
                                                <td>12 Nov 2024</td>
                                                <td>INV-2024-00107</td>
                                                <td>Mike Brown</td>
                                                <td>1</td>
                                                <td>Rs1,299</td>
                                                <td><span class="badge badge-success">Completed</span></td>
                                            </tr>
                                            <tr>
                                                <td>10 Nov 2024</td>
                                                <td>INV-2024-00098</td>
                                                <td>Emma Wilson</td>
                                                <td>5</td>
                                                <td>Rs6,495</td>
                                                <td><span class="badge badge-success">Completed</span></td>
                                            </tr>
                                            <tr>
                                                <td>08 Nov 2024</td>
                                                <td>INV-2024-00087</td>
                                                <td>David Miller</td>
                                                <td>2</td>
                                                <td>Rs2,598</td>
                                                <td><span class="badge badge-success">Completed</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Stats & Actions -->
            <div class="col-lg-4">
                <!-- Pricing Information -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="las la-money-bill-wave mr-2"></i>Pricing</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm">
                            <tr>
                                <th>Cost Price</th>
                                <td class="text-right">Rs800.00</td>
                            </tr>
                            <tr>
                                <th>MRP</th>
                                <td class="text-right">Rs1,599.00</td>
                            </tr>
                            <tr>
                                <th>Sale Price</th>
                                <td class="text-right text-primary"><strong>Rs1,299.00</strong></td>
                            </tr>
                            <tr class="table-success">
                                <th>Profit</th>
                                <td class="text-right text-success"><strong>Rs499.00</strong></td>
                            </tr>
                            <tr>
                                <th>Margin</th>
                                <td class="text-right text-success"><strong>38.2%</strong></td>
                            </tr>
                            <tr>
                                <th>Tax Rate</th>
                                <td class="text-right">18%</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="las la-bolt mr-2"></i>Quick Actions</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <button class="btn btn-outline-primary" data-toggle="modal" data-target="#quickSaleModal">
                                <i class="las la-cart-plus mr-2"></i>Quick Sale
                            </button>
                            <button class="btn btn-outline-success" data-toggle="modal" data-target="#updatePriceModal">
                                <i class="las la-tag mr-2"></i>Update Price
                            </button>
                            <button class="btn btn-outline-warning" data-toggle="modal" data-target="#updateStockModal">
                                <i class="las la-boxes mr-2"></i>Update Stock
                            </button>
                            <a href="{{ route('products.edit', 1) }}" class="btn btn-outline-info">
                                <i class="las la-edit mr-2"></i>Edit Product
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Product Timeline -->
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="las la-history mr-2"></i>Recent Activity</h6>
                    </div>
                    <div class="card-body">
                        <div class="timeline">
                            <div class="timeline-item">
                                <div class="timeline-marker bg-success"></div>
                                <div class="timeline-content">
                                    <small class="text-muted">Today, 10:30 AM</small>
                                    <p class="mb-1">Stock updated: +50 units added</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-marker bg-primary"></div>
                                <div class="timeline-content">
                                    <small class="text-muted">Yesterday, 3:45 PM</small>
                                    <p class="mb-1">Price updated from Rs1,599 to Rs1,299</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-marker bg-info"></div>
                                <div class="timeline-content">
                                    <small class="text-muted">15 Nov 2024</small>
                                    <p class="mb-1">Marked as Featured Product</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-marker bg-warning"></div>
                                <div class="timeline-content">
                                    <small class="text-muted">10 Nov 2024</small>
                                    <p class="mb-1">Added new product images</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-marker bg-secondary"></div>
                                <div class="timeline-content">
                                    <small class="text-muted">01 Nov 2024</small>
                                    <p class="mb-1">Product created</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Sale Modal -->
    <div class="modal fade" id="quickSaleModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Quick Sale</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label>Product: Men's Cotton T-Shirt</label>
                            <div class="input-group">
                                <input type="number" class="form-control" value="1" min="1" max="142">
                                <div class="input-group-append">
                                    <span class="input-group-text">units</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Unit Price</label>
                            <input type="text" class="form-control" value="Rs1,299.00" readonly>
                        </div>
                        <div class="form-group">
                            <label>Total Amount</label>
                            <input type="text" class="form-control" value="Rs1,299.00" readonly>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Process Sale</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Price Modal -->
    <div class="modal fade" id="updatePriceModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Price</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label>Current Price: Rs1,299.00</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rs</span>
                                </div>
                                <input type="number" class="form-control" value="1299" step="0.01">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Reason for Price Change</label>
                            <textarea class="form-control" rows="3" placeholder="Enter reason"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Update Price</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Stock Modal -->
    <div class="modal fade" id="updateStockModal" tabindex="-1" role="dialog">
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
                                <input type="number" class="form-control" value="142">
                                <div class="input-group-append">
                                    <span class="input-group-text">units</span>
                                </div>
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
                            <textarea class="form-control" rows="3" placeholder="Enter reason"></textarea>
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
        function changeMainImage(src) {
            document.getElementById('mainProductImage').src = src;
        }

        $(document).ready(function() {
            // Print functionality
            $('#printProduct').click(function() {
                window.print();
            });

            // Calculate total amount in quick sale
            $('#quickSaleModal input[type="number"]').on('input', function() {
                var quantity = $(this).val();
                var price = 1299;
                var total = quantity * price;
                $('#quickSaleModal input[readonly]:last').val('Rs' + total.toLocaleString('en-IN'));
            });

            // Tab functionality
            $('#productTab a').on('click', function(e) {
                e.preventDefault();
                $(this).tab('show');
            });
        });
    </script>

    <style>
        .cursor-pointer {
            cursor: pointer;
        }

        .product-main-image {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 10px;
            background: #f8f9fa;
        }

        .product-main-image img {
            width: 100%;
            height: 300px;
            object-fit: contain;
        }

        .timeline {
            position: relative;
            padding-left: 20px;
        }

        .timeline-item {
            position: relative;
            padding-bottom: 15px;
        }

        .timeline-marker {
            position: absolute;
            left: -20px;
            top: 5px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
        }

        .timeline-content {
            padding-left: 10px;
        }

        @media print {
            .d-print-none {
                display: none !important;
            }

            .card {
                border: none !important;
            }
        }
    </style>
    @endpush
</x-app-layout>