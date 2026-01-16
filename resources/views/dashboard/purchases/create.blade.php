<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/remixicon/fonts/remixicon.css') }}">
    <style>
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
        .supplier-card {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            cursor: pointer;
            transition: all 0.3s;
        }
        .supplier-card:hover {
            border-color: #007bff;
            background: #f8f9fa;
        }
        .supplier-card.selected {
            border-color: #007bff;
            background: #e8f4ff;
        }
        .product-item {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            background: white;
        }
        .product-item-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }
        .product-image {
            width: 60px;
            height: 60px;
            border-radius: 4px;
            object-fit: cover;
            margin-right: 15px;
        }
        .quantity-controls {
            display: flex;
            align-items: center;
        }
        .quantity-input {
            width: 80px;
            text-align: center;
        }
        .summary-card {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: sticky;
            top: 20px;
        }
        .summary-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px dashed #dee2e6;
        }
        .summary-item.total {
            border-bottom: 2px solid #007bff;
            font-weight: 600;
            font-size: 18px;
        }
        .step-indicator {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
        }
        .step {
            display: flex;
            align-items: center;
            flex: 1;
        }
        .step-number {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: #e9ecef;
            color: #6c757d;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            margin-right: 10px;
        }
        .step.active .step-number {
            background: #007bff;
            color: white;
        }
        .step.completed .step-number {
            background: #28a745;
            color: white;
        }
        .step-line {
            flex: 1;
            height: 2px;
            background: #e9ecef;
            margin: 0 10px;
        }
        .step:last-child .step-line {
            display: none;
        }
    </style>
    @endpush

    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
            <div>
                <h4 class="mb-3">Create Purchase Order</h4>
                <p class="mb-0">Create a new purchase order from supplier</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('purchases.index') }}">Purchases</a></li>
                        <li class="breadcrumb-item active">Create Purchase</li>
                    </ol>
                </nav>
            </div>
            <div>
                <a href="{{ route('purchases.index') }}" class="btn btn-outline-secondary">
                    <i class="las la-times mr-2"></i>Cancel
                </a>
                <button type="button" class="btn btn-primary ml-2" onclick="submitPurchaseForm()">
                    <i class="las la-save mr-2"></i>Create Purchase Order
                </button>
            </div>
        </div>

        <!-- Step Indicator -->
        <div class="step-indicator">
            <div class="step active" data-step="1">
                <div class="step-number">1</div>
                <div class="step-title">Supplier</div>
                <div class="step-line"></div>
            </div>
            <div class="step" data-step="2">
                <div class="step-number">2</div>
                <div class="step-title">Products</div>
                <div class="step-line"></div>
            </div>
            <div class="step" data-step="3">
                <div class="step-number">3</div>
                <div class="step-title">Shipping</div>
                <div class="step-line"></div>
            </div>
            <div class="step" data-step="4">
                <div class="step-number">4</div>
                <div class="step-title">Review</div>
            </div>
        </div>

        <div class="row">
            <!-- Left Column: Form -->
            <div class="col-lg-8">
                <form id="purchaseCreateForm" action="{{ route('purchases.store') }}" method="POST">
                    @csrf
                    
                    <!-- Step 1: Supplier Selection -->
                    <div class="form-section" id="step1">
                        <h6 class="form-section-title">Select Supplier</h6>
                        
                        <!-- Search Supplier -->
                        <div class="form-group">
                            <label>Search Supplier</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search by name, phone, or email" id="searchSupplier">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button">
                                        <i class="las la-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Quick Supplier Selection -->
                        <div class="mb-3">
                            <label class="form-label">Quick Select</label>
                            <div class="row">
                                <!-- Supplier 1 -->
                                <div class="col-md-6">
                                    <div class="supplier-card" data-supplier-id="1">
                                        <div class="d-flex align-items-center">
                                            <img src="https://via.placeholder.com/50x50/007bff/ffffff?text=TF" 
                                                 class="supplier-avatar mr-3" alt="Textile Factory">
                                            <div>
                                                <h6 class="mb-0">Textile Factory Ltd.</h6>
                                                <small class="text-muted">John Doe | 9876543210</small>
                                                <div class="small text-success">Credit: ₹500,000</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Supplier 2 -->
                                <div class="col-md-6">
                                    <div class="supplier-card" data-supplier-id="2">
                                        <div class="d-flex align-items-center">
                                            <img src="https://via.placeholder.com/50x50/28a745/ffffff?text=FW" 
                                                 class="supplier-avatar mr-3" alt="Fashion Wear">
                                            <div>
                                                <h6 class="mb-0">Fashion Wear Imports</h6>
                                                <small class="text-muted">Sarah Smith | 9876543211</small>
                                                <div class="small text-success">Credit: ₹300,000</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- New Supplier Button -->
                        <div class="text-center mb-4">
                            <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#newSupplierModal">
                                <i class="las la-plus mr-2"></i>Add New Supplier
                            </button>
                        </div>
                        
                        <!-- Hidden Supplier Field -->
                        <input type="hidden" name="supplier_id" id="selectedSupplierId">
                        
                        <!-- Selected Supplier Display -->
                        <div class="selected-supplier-info d-none" id="selectedSupplierInfo">
                            <div class="alert alert-info">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">Selected Supplier</h6>
                                        <div id="supplierDetails"></div>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="changeSupplier()">
                                        Change
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Next Button -->
                        <div class="text-right">
                            <button type="button" class="btn btn-primary" onclick="nextStep(2)">
                                Next <i class="las la-arrow-right ml-2"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Step 2: Product Selection -->
                    <div class="form-section d-none" id="step2">
                        <h6 class="form-section-title">Add Products</h6>
                        
                        <!-- Product Search -->
                        <div class="form-group">
                            <label>Search Products</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search products by name, code, or brand" id="searchProduct">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button">
                                        <i class="las la-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Product Categories -->
                        <div class="mb-3">
                            <label class="form-label">Browse by Category</label>
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-outline-secondary active">
                                    <input type="radio" name="category" value="all" checked> All
                                </label>
                                <label class="btn btn-outline-secondary">
                                    <input type="radio" name="category" value="shirts"> Shirts
                                </label>
                                <label class="btn btn-outline-secondary">
                                    <input type="radio" name="category" value="pants"> Pants
                                </label>
                                <label class="btn btn-outline-secondary">
                                    <input type="radio" name="category" value="accessories"> Accessories
                                </label>
                            </div>
                        </div>
                        
                        <!-- Product List -->
                        <div id="productList">
                            <!-- Product 1 -->
                            <div class="product-item" data-product-id="1">
                                <div class="product-item-header">
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/60x60/007bff/ffffff?text=S" 
                                             class="product-image" alt="Product">
                                        <div>
                                            <h6 class="mb-0">Cotton Formal Shirt</h6>
                                            <small class="text-muted">SKU: CTN-SHT-001 | Size: M, L, XL</small>
                                            <div class="small">
                                                <span class="text-danger">Cost: ₹800</span> | 
                                                <span class="text-success">MRP: ₹1,200</span>
                                            </div>
                                            <div class="small text-warning">
                                                <i class="las la-star"></i> 4.5 | Stock: 45
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-outline-primary add-to-cart" data-product='{"id":1,"name":"Cotton Formal Shirt","sku":"CTN-SHT-001","cost":800,"mrp":1200}'>
                                        <i class="las la-cart-plus mr-1"></i> Add
                                    </button>
                                </div>
                            </div>
                            
                            <!-- Product 2 -->
                            <div class="product-item" data-product-id="2">
                                <div class="product-item-header">
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/60x60/28a745/ffffff?text=J" 
                                             class="product-image" alt="Product">
                                        <div>
                                            <h6 class="mb-0">Denim Jeans</h6>
                                            <small class="text-muted">SKU: DNM-JNS-002 | Size: 30, 32, 34</small>
                                            <div class="small">
                                                <span class="text-danger">Cost: ₹1,200</span> | 
                                                <span class="text-success">MRP: ₹1,800</span>
                                            </div>
                                            <div class="small text-warning">
                                                <i class="las la-star"></i> 4.2 | Stock: 28
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-outline-primary add-to-cart" data-product='{"id":2,"name":"Denim Jeans","sku":"DNM-JNS-002","cost":1200,"mrp":1800}'>
                                        <i class="las la-cart-plus mr-1"></i> Add
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Cart Items -->
                        <div class="mt-4" id="cartSection">
                            <h6 class="form-section-title">Selected Products</h6>
                            <div class="table-responsive">
                                <table class="table" id="cartTable">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>SKU</th>
                                            <th>Cost Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="cartItems">
                                        <!-- Cart items will be added here -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <!-- Navigation Buttons -->
                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-outline-secondary" onclick="prevStep(1)">
                                <i class="las la-arrow-left mr-2"></i> Back
                            </button>
                            <button type="button" class="btn btn-primary" onclick="nextStep(3)">
                                Next <i class="las la-arrow-right ml-2"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Step 3: Shipping & Payment -->
                    <div class="form-section d-none" id="step3">
                        <h6 class="form-section-title">Shipping & Payment Details</h6>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Order Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="order_date" value="{{ date('Y-m-d') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Expected Delivery Date</label>
                                    <input type="date" class="form-control" name="expected_delivery_date" value="{{ date('Y-m-d', strtotime('+7 days')) }}">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Branch <span class="text-danger">*</span></label>
                                    <select class="form-control" name="branch_id" required>
                                        <option value="">Select Branch</option>
                                        <option value="1" selected>Main Store</option>
                                        <option value="2">South Branch</option>
                                        <option value="3">Warehouse</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Shipping Method</label>
                                    <select class="form-control" name="shipping_method">
                                        <option value="">Select Method</option>
                                        <option value="pickup">Pickup</option>
                                        <option value="delivery" selected>Delivery</option>
                                        <option value="express">Express</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Shipping Address</label>
                            <textarea class="form-control" name="shipping_address" rows="2" placeholder="Enter shipping address"></textarea>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Tracking Number</label>
                                    <input type="text" class="form-control" name="tracking_number" placeholder="Enter tracking number">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Carrier Name</label>
                                    <input type="text" class="form-control" name="carrier_name" placeholder="Enter carrier name">
                                </div>
                            </div>
                        </div>
                        
                        <h6 class="form-section-title mt-4">Payment Details</h6>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Payment Status</label>
                                    <select class="form-control" name="payment_status">
                                        <option value="pending" selected>Pending</option>
                                        <option value="partial">Partial</option>
                                        <option value="paid">Paid</option>
                                        <option value="overdue">Overdue</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Initial Payment (₹)</label>
                                    <input type="number" class="form-control" name="amount_paid" placeholder="0.00" min="0" step="0.01">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Payment Terms</label>
                            <input type="text" class="form-control" name="payment_terms" placeholder="e.g., Net 30" value="Net 30">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Notes / Special Instructions</label>
                            <textarea class="form-control" name="notes" rows="3" placeholder="Enter any notes or special instructions"></textarea>
                        </div>
                        
                        <!-- Navigation Buttons -->
                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-outline-secondary" onclick="prevStep(2)">
                                <i class="las la-arrow-left mr-2"></i> Back
                            </button>
                            <button type="button" class="btn btn-primary" onclick="nextStep(4)">
                                Next <i class="las la-arrow-right ml-2"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Step 4: Review & Submit -->
                    <div class="form-section d-none" id="step4">
                        <h6 class="form-section-title">Review Purchase Order</h6>
                        
                        <!-- Order Summary -->
                        <div class="alert alert-info">
                            <h6><i class="las la-clipboard-check mr-2"></i>Order Summary</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <div><strong>Purchase Number:</strong> <span id="reviewPurchaseNumber">PO-{{ date('YmdHis') }}</span></div>
                                    <div><strong>Supplier:</strong> <span id="reviewSupplier">Textile Factory Ltd.</span></div>
                                    <div><strong>Order Date:</strong> <span id="reviewOrderDate">{{ date('d M Y') }}</span></div>
                                </div>
                                <div class="col-md-6">
                                    <div><strong>Expected Delivery:</strong> <span id="reviewDeliveryDate">{{ date('d M Y', strtotime('+7 days')) }}</span></div>
                                    <div><strong>Branch:</strong> <span id="reviewBranch">Main Store</span></div>
                                    <div><strong>Shipping Method:</strong> <span id="reviewShipping">Delivery</span></div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Products Review -->
                        <h6 class="mt-4">Products Ordered</h6>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>SKU</th>
                                        <th>Cost Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody id="reviewProducts">
                                    <!-- Products will be populated here -->
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Financial Summary -->
                        <div class="row mt-4">
                            <div class="col-md-6 offset-md-6">
                                <div class="summary-card">
                                    <h6>Financial Summary</h6>
                                    <div class="summary-item">
                                        <span>Subtotal:</span>
                                        <span id="reviewSubtotal">₹0.00</span>
                                    </div>
                                    <div class="summary-item">
                                        <span>Tax (18%):</span>
                                        <span id="reviewTax">₹0.00</span>
                                    </div>
                                    <div class="summary-item">
                                        <span>Shipping Charge:</span>
                                        <span id="reviewShippingCharge">₹0.00</span>
                                    </div>
                                    <div class="summary-item">
                                        <span>Other Charges:</span>
                                        <span id="reviewOtherCharges">₹0.00</span>
                                    </div>
                                    <div class="summary-item">
                                        <span>Discount:</span>
                                        <span id="reviewDiscount">₹0.00</span>
                                    </div>
                                    <div class="summary-item total">
                                        <span>Grand Total:</span>
                                        <span id="reviewGrandTotal">₹0.00</span>
                                    </div>
                                    <div class="summary-item">
                                        <span>Initial Payment:</span>
                                        <span id="reviewInitialPayment">₹0.00</span>
                                    </div>
                                    <div class="summary-item">
                                        <span>Balance Due:</span>
                                        <span id="reviewBalanceDue">₹0.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Terms & Conditions -->
                        <div class="form-group mt-4">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="termsAccepted" required>
                                <label class="custom-control-label" for="termsAccepted">
                                    I agree to the terms and conditions of this purchase order
                                </label>
                            </div>
                        </div>
                        
                        <!-- Navigation Buttons -->
                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-outline-secondary" onclick="prevStep(3)">
                                <i class="las la-arrow-left mr-2"></i> Back
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="las la-check-circle mr-2"></i> Create Purchase Order
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            
            <!-- Right Column: Summary -->
            <div class="col-lg-4">
                <div class="summary-card">
                    <h6>Purchase Summary</h6>
                    
                    <div class="summary-item">
                        <span>Purchase Number:</span>
                        <span>PO-{{ date('YmdHis') }}</span>
                    </div>
                    
                    <div class="summary-item">
                        <span>Supplier:</span>
                        <span id="summarySupplier">Not selected</span>
                    </div>
                    
                    <div class="summary-item">
                        <span>Items:</span>
                        <span id="summaryItems">0</span>
                    </div>
                    
                    <div class="summary-item">
                        <span>Subtotal:</span>
                        <span id="summarySubtotal">₹0.00</span>
                    </div>
                    
                    <div class="summary-item">
                        <span>Tax (18%):</span>
                        <span id="summaryTax">₹0.00</span>
                    </div>
                    
                    <div class="summary-item">
                        <span>Shipping:</span>
                        <span id="summaryShipping">₹0.00</span>
                    </div>
                    
                    <div class="summary-item total">
                        <span>Grand Total:</span>
                        <span id="summaryGrandTotal">₹0.00</span>
                    </div>
                    
                    <hr>
                    
                    <!-- Additional Charges -->
                    <div class="form-group">
                        <label class="form-label">Shipping Charge (₹)</label>
                        <input type="number" class="form-control" id="shippingCharge" value="0" min="0" step="0.01" onchange="updateSummary()">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Other Charges (₹)</label>
                        <input type="number" class="form-control" id="otherCharges" value="0" min="0" step="0.01" onchange="updateSummary()">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Discount (₹)</label>
                        <input type="number" class="form-control" id="discount" value="0" min="0" step="0.01" onchange="updateSummary()">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Tax Rate (%)</label>
                        <input type="number" class="form-control" id="taxRate" value="18" min="0" max="100" step="0.01" onchange="updateSummary()">
                    </div>
                    
                    <!-- Save as Draft -->
                    <div class="form-group mt-4">
                        <button type="button" class="btn btn-outline-secondary btn-block">
                            <i class="las la-save mr-2"></i> Save as Draft
                        </button>
                    </div>
                    
                    <!-- Quick Actions -->
                    <div class="mt-3">
                        <h6 class="mb-3">Quick Actions</h6>
                        <div class="btn-group btn-group-block" role="group">
                            <button type="button" class="btn btn-outline-info" onclick="addSampleProducts()">
                                <i class="las la-magic"></i> Sample
                            </button>
                            <button type="button" class="btn btn-outline-warning" onclick="clearCart()">
                                <i class="las la-trash"></i> Clear
                            </button>
                            <button type="button" class="btn btn-outline-success" onclick="calculateTotals()">
                                <i class="las la-calculator"></i> Calculate
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- New Supplier Modal -->
    <div class="modal fade" id="newSupplierModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Supplier</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Supplier form would go here -->
                    <p>Quick supplier form would be here...</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Add Supplier</button>
                </div>
            </div>
        </div>
    </div>

    @push('js')
    <script src="{{ asset('backend/assets/js/backend-bundle.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    <script>
        let currentStep = 1;
        let cart = [];
        let selectedSupplier = null;
        
        $(document).ready(function() {
            // Initialize step indicator
            updateStepIndicator();
            
            // Supplier selection
            $('.supplier-card').click(function() {
                $('.supplier-card').removeClass('selected');
                $(this).addClass('selected');
                
                const supplierId = $(this).data('supplier-id');
                const supplierName = $(this).find('h6').text();
                const supplierContact = $(this).find('small').text();
                
                selectedSupplier = {
                    id: supplierId,
                    name: supplierName,
                    contact: supplierContact
                };
                
                $('#selectedSupplierId').val(supplierId);
                $('#summarySupplier').text(supplierName);
                
                // Show selected supplier info
                $('#supplierDetails').html(`
                    <div>${supplierName}</div>
                    <small class="text-muted">${supplierContact}</small>
                `);
                $('#selectedSupplierInfo').removeClass('d-none');
            });
            
            // Add product to cart
            $(document).on('click', '.add-to-cart', function() {
                const product = JSON.parse($(this).data('product'));
                product.quantity = 1;
                product.total = product.cost * product.quantity;
                
                // Check if product already in cart
                const existingIndex = cart.findIndex(item => item.id === product.id);
                if(existingIndex > -1) {
                    cart[existingIndex].quantity++;
                    cart[existingIndex].total = cart[existingIndex].cost * cart[existingIndex].quantity;
                } else {
                    cart.push(product);
                }
                
                updateCartDisplay();
                updateSummary();
            });
            
            // Remove item from cart
            $(document).on('click', '.remove-item', function() {
                const productId = $(this).data('product-id');
                cart = cart.filter(item => item.id !== productId);
                updateCartDisplay();
                updateSummary();
            });
            
            // Update quantity
            $(document).on('change', '.quantity-input', function() {
                const productId = $(this).data('product-id');
                const quantity = parseInt($(this).val()) || 0;
                
                const item = cart.find(item => item.id === productId);
                if(item) {
                    item.quantity = quantity > 0 ? quantity : 1;
                    item.total = item.cost * item.quantity;
                    updateCartDisplay();
                    updateSummary();
                }
            });
            
            // Form submission
            $('#purchaseCreateForm').submit(function(e) {
                e.preventDefault();
                
                // Validate form
                if(!selectedSupplier) {
                    alert('Please select a supplier');
                    showStep(1);
                    return false;
                }
                
                if(cart.length === 0) {
                    alert('Please add at least one product');
                    showStep(2);
                    return false;
                }
                
                if(!$('#termsAccepted').is(':checked')) {
                    alert('Please accept terms and conditions');
                    return false;
                }
                
                // Show loading
                $('button[type="submit"]').prop('disabled', true).html('<i class="las la-spinner la-spin mr-2"></i>Creating...');
                
                // Prepare form data
                const formData = {
                    supplier_id: selectedSupplier.id,
                    products: cart,
                    order_date: $('input[name="order_date"]').val(),
                    expected_delivery_date: $('input[name="expected_delivery_date"]').val(),
                    branch_id: $('select[name="branch_id"]').val(),
                    shipping_method: $('select[name="shipping_method"]').val(),
                    payment_status: $('select[name="payment_status"]').val(),
                    amount_paid: $('input[name="amount_paid"]').val() || 0,
                    notes: $('textarea[name="notes"]').val(),
                    subtotal: calculateSubtotal(),
                    tax: calculateTax(),
                    shipping_charge: $('#shippingCharge').val(),
                    other_charges: $('#otherCharges').val(),
                    discount: $('#discount').val(),
                    grand_total: calculateGrandTotal()
                };
                
                // Simulate API call
                setTimeout(() => {
                    console.log('Form data:', formData);
                    alert('Purchase order created successfully!');
                    window.location.href = "{{ route('purchases.index') }}";
                }, 1500);
                
                return false;
            });
        });
        
        // Step navigation
        window.nextStep = function(next) {
            // Validate current step
            if(currentStep === 1 && !selectedSupplier) {
                alert('Please select a supplier');
                return;
            }
            
            if(currentStep === 2 && cart.length === 0) {
                alert('Please add at least one product');
                return;
            }
            
            // Update steps
            $(`#step${currentStep}`).addClass('d-none');
            $(`#step${next}`).removeClass('d-none');
            
            // Update step indicator
            $(`.step[data-step="${currentStep}"]`).removeClass('active').addClass('completed');
            $(`.step[data-step="${next}"]`).addClass('active');
            
            currentStep = next;
            
            // If moving to step 4, update review
            if(next === 4) {
                updateReview();
            }
        };
        
        window.prevStep = function(prev) {
            $(`#step${currentStep}`).addClass('d-none');
            $(`#step${prev}`).removeClass('d-none');
            
            $(`.step[data-step="${currentStep}"]`).removeClass('active');
            $(`.step[data-step="${prev}"]`).addClass('active').removeClass('completed');
            
            currentStep = prev;
        };
        
        window.showStep = function(step) {
            $('.form-section').addClass('d-none');
            $(`#step${step}`).removeClass('d-none');
            
            $('.step').removeClass('active completed');
            for(let i = 1; i < step; i++) {
                $(`.step[data-step="${i}"]`).addClass('completed');
            }
            $(`.step[data-step="${step}"]`).addClass('active');
            
            currentStep = step;
        };
        
        // Update step indicator
        function updateStepIndicator() {
            $('.step').each(function() {
                const step = $(this).data('step');
                if(step < currentStep) {
                    $(this).removeClass('active').addClass('completed');
                } else if(step === currentStep) {
                    $(this).addClass('active').removeClass('completed');
                } else {
                    $(this).removeClass('active completed');
                }
            });
        }
        
        // Update cart display
        function updateCartDisplay() {
            const cartItems = $('#cartItems');
            cartItems.empty();
            
            if(cart.length === 0) {
                cartItems.html('<tr><td colspan="6" class="text-center text-muted">No products added</td></tr>');
                $('#cartSection').hide();
            } else {
                $('#cartSection').show();
                cart.forEach(item => {
                    cartItems.append(`
                        <tr>
                            <td>${item.name}</td>
                            <td>${item.sku}</td>
                            <td>₹${item.cost.toFixed(2)}</td>
                            <td>
                                <div class="quantity-controls">
                                    <input type="number" class="form-control quantity-input" 
                                           data-product-id="${item.id}" value="${item.quantity}" min="1">
                                </div>
                            </td>
                            <td>₹${item.total.toFixed(2)}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-outline-danger remove-item" data-product-id="${item.id}">
                                    <i class="las la-trash"></i>
                                </button>
                            </td>
                        </tr>
                    `);
                });
            }
            
            $('#summaryItems').text(cart.length);
        }
        
        // Calculate totals
        function calculateSubtotal() {
            return cart.reduce((sum, item) => sum + item.total, 0);
        }
        
        function calculateTax() {
            const subtotal = calculateSubtotal();
            const taxRate = parseFloat($('#taxRate').val()) || 0;
            return (subtotal * taxRate) / 100;
        }
        
        function calculateGrandTotal() {
            const subtotal = calculateSubtotal();
            const tax = calculateTax();
            const shipping = parseFloat($('#shippingCharge').val()) || 0;
            const other = parseFloat($('#otherCharges').val()) || 0;
            const discount = parseFloat($('#discount').val()) || 0;
            
            return subtotal + tax + shipping + other - discount;
        }
        
        // Update summary
        function updateSummary() {
            const subtotal = calculateSubtotal();
            const tax = calculateTax();
            const grandTotal = calculateGrandTotal();
            
            $('#summarySubtotal').text('₹' + subtotal.toFixed(2));
            $('#summaryTax').text('₹' + tax.toFixed(2));
            $('#summaryShipping').text('₹' + ($('#shippingCharge').val() || '0.00'));
            $('#summaryGrandTotal').text('₹' + grandTotal.toFixed(2));
        }
        
        // Update review
        function updateReview() {
            // Update supplier info
            if(selectedSupplier) {
                $('#reviewSupplier').text(selectedSupplier.name);
            }
            
            // Update dates
            $('#reviewOrderDate').text($('input[name="order_date"]').val());
            $('#reviewDeliveryDate').text($('input[name="expected_delivery_date"]').val() || 'Not set');
            $('#reviewBranch').text($('select[name="branch_id"] option:selected').text());
            $('#reviewShipping').text($('select[name="shipping_method"] option:selected').text() || 'Not set');
            
            // Update products
            const reviewProducts = $('#reviewProducts');
            reviewProducts.empty();
            
            cart.forEach(item => {
                reviewProducts.append(`
                    <tr>
                        <td>${item.name}</td>
                        <td>${item.sku}</td>
                        <td>₹${item.cost.toFixed(2)}</td>
                        <td>${item.quantity}</td>
                        <td>₹${item.total.toFixed(2)}</td>
                    </tr>
                `);
            });
            
            // Update financial summary
            const subtotal = calculateSubtotal();
            const tax = calculateTax();
            const shipping = parseFloat($('#shippingCharge').val()) || 0;
            const other = parseFloat($('#otherCharges').val()) || 0;
            const discount = parseFloat($('#discount').val()) || 0;
            const grandTotal = calculateGrandTotal();
            const initialPayment = parseFloat($('input[name="amount_paid"]').val()) || 0;
            const balanceDue = grandTotal - initialPayment;
            
            $('#reviewSubtotal').text('₹' + subtotal.toFixed(2));
            $('#reviewTax').text('₹' + tax.toFixed(2));
            $('#reviewShippingCharge').text('₹' + shipping.toFixed(2));
            $('#reviewOtherCharges').text('₹' + other.toFixed(2));
            $('#reviewDiscount').text('₹' + discount.toFixed(2));
            $('#reviewGrandTotal').text('₹' + grandTotal.toFixed(2));
            $('#reviewInitialPayment').text('₹' + initialPayment.toFixed(2));
            $('#reviewBalanceDue').text('₹' + balanceDue.toFixed(2));
        }
        
        // Helper functions
        window.changeSupplier = function() {
            $('#selectedSupplierInfo').addClass('d-none');
            $('.supplier-card').removeClass('selected');
            selectedSupplier = null;
            $('#selectedSupplierId').val('');
            $('#summarySupplier').text('Not selected');
        };
        
        window.addSampleProducts = function() {
            // Add sample products to cart
            const sampleProducts = [
                {id: 1, name: "Cotton Formal Shirt", sku: "CTN-SHT-001", cost: 800, mrp: 1200},
                {id: 2, name: "Denim Jeans", sku: "DNM-JNS-002", cost: 1200, mrp: 1800},
                {id: 3, name: "Cotton T-Shirt", sku: "CTN-TSH-003", cost: 350, mrp: 500}
            ];
            
            sampleProducts.forEach(product => {
                product.quantity = Math.floor(Math.random() * 5) + 1;
                product.total = product.cost * product.quantity;
                
                // Check if already in cart
                const existingIndex = cart.findIndex(item => item.id === product.id);
                if(existingIndex === -1) {
                    cart.push(product);
                }
            });
            
            updateCartDisplay();
            updateSummary();
            alert('Sample products added to cart!');
        };
        
        window.clearCart = function() {
            if(cart.length > 0 && confirm('Clear all products from cart?')) {
                cart = [];
                updateCartDisplay();
                updateSummary();
            }
        };
        
        window.calculateTotals = function() {
            updateSummary();
            alert('Totals calculated!');
        };
        
        window.submitPurchaseForm = function() {
            $('#purchaseCreateForm').submit();
        };
    </script>
    @endpush
</x-app-layout>