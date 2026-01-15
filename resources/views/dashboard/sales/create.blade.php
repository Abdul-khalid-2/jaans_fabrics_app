<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/remixicon/fonts/remixicon.css') }}">
    <style>
        .product-card {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            transition: all 0.3s;
            cursor: pointer;
        }
        .product-card:hover {
            border-color: #007bff;
            box-shadow: 0 0 10px rgba(0,123,255,0.1);
        }
        .product-card.selected {
            border-color: #007bff;
            background-color: rgba(0,123,255,0.05);
        }
        .cart-item {
            border-bottom: 1px solid #dee2e6;
            padding: 10px 0;
        }
        .cart-item:last-child {
            border-bottom: none;
        }
        .quantity-input {
            width: 70px;
            text-align: center;
        }
        .product-search-results {
            max-height: 400px;
            overflow-y: auto;
        }
    </style>
    @endpush

    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
            <div>
                <h4 class="mb-3">New Sale</h4>
                <p class="mb-0">Create a new sales transaction</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('sales.index') }}">Sales</a></li>
                        <li class="breadcrumb-item active">New Sale</li>
                    </ol>
                </nav>
            </div>
            <div>
                <a href="{{ route('sales.index') }}" class="btn btn-outline-secondary">
                    <i class="las la-arrow-left mr-2"></i>Cancel
                </a>
            </div>
        </div>

        <div class="row">
            <!-- Left Column - Products & Cart -->
            <div class="col-lg-8">
                <!-- Product Search -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="las la-search mr-2"></i>Search Products</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="productSearch" 
                                           placeholder="Search by product name, SKU, barcode or category">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-primary btn-block" id="scanBarcode">
                                    <i class="las la-barcode mr-2"></i>Scan Barcode
                                </button>
                            </div>
                        </div>

                        <!-- Categories Filter -->
                        <div class="mb-3">
                            <div class="d-flex flex-wrap">
                                <button class="btn btn-sm btn-outline-secondary m-1 active" data-category="all">All</button>
                                <button class="btn btn-sm btn-outline-secondary m-1" data-category="men">Men's Wear</button>
                                <button class="btn btn-sm btn-outline-secondary m-1" data-category="women">Women's Wear</button>
                                <button class="btn btn-sm btn-outline-secondary m-1" data-category="kids">Kids</button>
                                <button class="btn btn-sm btn-outline-secondary m-1" data-category="footwear">Footwear</button>
                                <button class="btn btn-sm btn-outline-secondary m-1" data-category="accessories">Accessories</button>
                            </div>
                        </div>

                        <!-- Product Grid -->
                        <div class="product-search-results" id="productGrid">
                            <div class="row">
                                <!-- Product 1 -->
                                <div class="col-md-4 col-sm-6 mb-3" data-category="men">
                                    <div class="product-card" data-product='{"id":1,"name":"Men\'s Cotton T-Shirt","sku":"TS-MEN-001","price":1299,"stock":142,"image":"https://images.unsplash.com/photo-1529374255404-311a2a4f1fd9?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"}'>
                                        <div class="text-center mb-2">
                                            <img src="https://images.unsplash.com/photo-1529374255404-311a2a4f1fd9?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80" 
                                                 class="img-fluid rounded" alt="Product" style="height: 100px; object-fit: cover;">
                                        </div>
                                        <h6 class="mb-1">Men's Cotton T-Shirt</h6>
                                        <p class="mb-1 text-muted small">SKU: TS-MEN-001</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <strong class="text-primary">₹1,299</strong>
                                            <span class="badge badge-success">142 in stock</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Product 2 -->
                                <div class="col-md-4 col-sm-6 mb-3" data-category="women">
                                    <div class="product-card" data-product='{"id":2,"name":"Women\'s Summer Dress","sku":"DR-WOM-002","price":2499,"stock":12,"image":"https://images.unsplash.com/photo-1490481651871-ab68de25d43d?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"}'>
                                        <div class="text-center mb-2">
                                            <img src="https://images.unsplash.com/photo-1490481651871-ab68de25d43d?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80" 
                                                 class="img-fluid rounded" alt="Product" style="height: 100px; object-fit: cover;">
                                        </div>
                                        <h6 class="mb-1">Women's Summer Dress</h6>
                                        <p class="mb-1 text-muted small">SKU: DR-WOM-002</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <strong class="text-primary">₹2,499</strong>
                                            <span class="badge badge-warning">12 in stock</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Product 3 -->
                                <div class="col-md-4 col-sm-6 mb-3" data-category="kids">
                                    <div class="product-card" data-product='{"id":3,"name":"Kids Winter Jacket","sku":"JK-KID-003","price":1899,"stock":89,"image":"https://images.unsplash.com/photo-1523381210434-271e8be1f52b?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"}'>
                                        <div class="text-center mb-2">
                                            <img src="https://images.unsplash.com/photo-1523381210434-271e8be1f52b?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80" 
                                                 class="img-fluid rounded" alt="Product" style="height: 100px; object-fit: cover;">
                                        </div>
                                        <h6 class="mb-1">Kids Winter Jacket</h6>
                                        <p class="mb-1 text-muted small">SKU: JK-KID-003</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <strong class="text-primary">₹1,899</strong>
                                            <span class="badge badge-success">89 in stock</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Product 4 -->
                                <div class="col-md-4 col-sm-6 mb-3" data-category="men">
                                    <div class="product-card" data-product='{"id":4,"name":"Men\'s Slim Fit Jeans","sku":"JN-MEN-004","price":2999,"stock":3,"image":"https://images.unsplash.com/photo-1553062407-98eeb64c6a62?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"}'>
                                        <div class="text-center mb-2">
                                            <img src="https://images.unsplash.com/photo-1553062407-98eeb64c6a62?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80" 
                                                 class="img-fluid rounded" alt="Product" style="height: 100px; object-fit: cover;">
                                        </div>
                                        <h6 class="mb-1">Men's Slim Fit Jeans</h6>
                                        <p class="mb-1 text-muted small">SKU: JN-MEN-004</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <strong class="text-primary">₹2,999</strong>
                                            <span class="badge badge-danger">3 in stock</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Product 5 -->
                                <div class="col-md-4 col-sm-6 mb-3" data-category="footwear">
                                    <div class="product-card" data-product='{"id":5,"name":"Running Shoes","sku":"SH-MEN-005","price":4599,"stock":56,"image":"https://images.unsplash.com/photo-1549298916-b41d501d3772?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"}'>
                                        <div class="text-center mb-2">
                                            <img src="https://images.unsplash.com/photo-1549298916-b41d501d3772?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80" 
                                                 class="img-fluid rounded" alt="Product" style="height: 100px; object-fit: cover;">
                                        </div>
                                        <h6 class="mb-1">Running Shoes</h6>
                                        <p class="mb-1 text-muted small">SKU: SH-MEN-005</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <strong class="text-primary">₹4,599</strong>
                                            <span class="badge badge-success">56 in stock</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Product 6 -->
                                <div class="col-md-4 col-sm-6 mb-3" data-category="accessories">
                                    <div class="product-card" data-product='{"id":6,"name":"Leather Belt","sku":"BL-ACC-006","price":899,"stock":45,"image":"https://images.unsplash.com/photo-1553062407-98eeb64c6a62?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"}'>
                                        <div class="text-center mb-2">
                                            <img src="https://images.unsplash.com/photo-1584917865442-de89df76afd3?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80" 
                                                 class="img-fluid rounded" alt="Product" style="height: 100px; object-fit: cover;">
                                        </div>
                                        <h6 class="mb-1">Leather Belt</h6>
                                        <p class="mb-1 text-muted small">SKU: BL-ACC-006</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <strong class="text-primary">₹899</strong>
                                            <span class="badge badge-success">45 in stock</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Shopping Cart -->
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="mb-0"><i class="las la-shopping-cart mr-2"></i>Shopping Cart</h6>
                        <span class="badge badge-primary" id="cartCount">0 items</span>
                    </div>
                    <div class="card-body">
                        <div id="cartItems">
                            <!-- Cart items will be added here dynamically -->
                            <div class="text-center py-5 text-muted" id="emptyCart">
                                <i class="las la-shopping-cart fa-3x mb-3"></i>
                                <p class="mb-0">Your cart is empty</p>
                                <small>Add products from the list above</small>
                            </div>
                        </div>

                        <!-- Cart Summary -->
                        <div class="border-top pt-3 mt-3" id="cartSummary" style="display: none;">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Notes</label>
                                        <textarea class="form-control" rows="2" placeholder="Add any special instructions or notes"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <table class="table table-sm">
                                        <tr>
                                            <th>Subtotal:</th>
                                            <td class="text-right" id="subtotal">₹0.00</td>
                                        </tr>
                                        <tr>
                                            <th>Discount:</th>
                                            <td class="text-right">
                                                <div class="input-group input-group-sm">
                                                    <input type="number" class="form-control" id="discount" value="0" min="0" style="width: 80px;">
                                                    <div class="input-group-append">
                                                        <select class="form-control form-control-sm" id="discountType" style="width: 70px;">
                                                            <option value="amount">₹</option>
                                                            <option value="percent">%</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Tax (18%):</th>
                                            <td class="text-right" id="taxAmount">₹0.00</td>
                                        </tr>
                                        <tr class="table-success">
                                            <th>Total:</th>
                                            <td class="text-right"><strong id="grandTotal">₹0.00</strong></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Customer & Payment -->
            <div class="col-lg-4">
                <!-- Customer Information -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="las la-user mr-2"></i>Customer Information</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Select Customer</label>
                            <select class="form-control" id="customerSelect">
                                <option value="">Walk-in Customer</option>
                                <option value="1">John Smith (Regular)</option>
                                <option value="2">Sarah Johnson (VIP)</option>
                                <option value="3">Michael Brown (Credit)</option>
                                <option value="4">Emma Wilson (Regular)</option>
                                <option value="5">David Miller (New)</option>
                            </select>
                        </div>
                        
                        <div id="customerDetails" style="display: none;">
                            <div class="border rounded p-3 mb-3">
                                <div class="d-flex justify-content-between mb-2">
                                    <strong>Phone:</strong>
                                    <span id="customerPhone">+91 9876543210</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <strong>Email:</strong>
                                    <span id="customerEmail">customer@example.com</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <strong>Credit Limit:</strong>
                                    <span id="customerCredit" class="text-success">₹50,000</span>
                                </div>
                            </div>
                            <button type="button" class="btn btn-outline-primary btn-sm btn-block">
                                <i class="las la-plus mr-1"></i>Add New Customer
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Payment Information -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="las la-credit-card mr-2"></i>Payment Information</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Payment Method</label>
                            <select class="form-control" id="paymentMethod">
                                <option value="cash">Cash</option>
                                <option value="card">Credit/Debit Card</option>
                                <option value="upi">UPI</option>
                                <option value="bank_transfer">Bank Transfer</option>
                                <option value="credit">Store Credit</option>
                                <option value="wallet">Wallet</option>
                            </select>
                        </div>

                        <div id="paymentDetails">
                            <!-- Cash Payment -->
                            <div class="payment-detail" id="cashDetail">
                                <div class="form-group">
                                    <label>Amount Received</label>
                                    <input type="number" class="form-control" id="amountReceived" placeholder="0.00" step="0.01">
                                </div>
                                <div class="form-group">
                                    <label>Change</label>
                                    <input type="text" class="form-control" id="changeAmount" value="₹0.00" readonly>
                                </div>
                            </div>

                            <!-- Card Payment (hidden by default) -->
                            <div class="payment-detail" id="cardDetail" style="display: none;">
                                <div class="form-group">
                                    <label>Card Type</label>
                                    <select class="form-control">
                                        <option value="visa">Visa</option>
                                        <option value="mastercard">MasterCard</option>
                                        <option value="rupay">RuPay</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Card Last 4 Digits</label>
                                    <input type="text" class="form-control" placeholder="1234" maxlength="4">
                                </div>
                            </div>

                            <!-- UPI Payment (hidden by default) -->
                            <div class="payment-detail" id="upiDetail" style="display: none;">
                                <div class="form-group">
                                    <label>UPI ID</label>
                                    <input type="text" class="form-control" placeholder="customer@upi">
                                </div>
                                <div class="form-group">
                                    <label>Transaction ID</label>
                                    <input type="text" class="form-control" placeholder="UPI transaction ID">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Payment Status</label>
                            <select class="form-control" id="paymentStatus">
                                <option value="paid">Paid</option>
                                <option value="partial">Partial Payment</option>
                                <option value="pending">Pending</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Sale Actions -->
                <div class="card">
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary btn-lg" id="processSale" disabled>
                                <i class="las la-check-circle mr-2"></i>Process Sale
                            </button>
                            <button class="btn btn-success" id="saveDraft">
                                <i class="las la-save mr-2"></i>Save as Draft
                            </button>
                            <button class="btn btn-outline-danger" id="clearCart">
                                <i class="las la-trash mr-2"></i>Clear Cart
                            </button>
                        </div>
                        
                        <div class="mt-4">
                            <h6>Quick Actions</h6>
                            <div class="d-flex flex-wrap">
                                <button class="btn btn-sm btn-outline-secondary m-1" data-quantity="1">
                                    Add 1 Item
                                </button>
                                <button class="btn btn-sm btn-outline-secondary m-1" data-quantity="5">
                                    Add 5 Items
                                </button>
                                <button class="btn btn-sm btn-outline-secondary m-1" onclick="applyDiscount(10)">
                                    10% Discount
                                </button>
                                <button class="btn btn-sm btn-outline-secondary m-1" onclick="applyDiscount(500)">
                                    ₹500 OFF
                                </button>
                            </div>
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
    
    <script>
        $(document).ready(function() {
            let cart = [];
            let subtotal = 0;
            let discount = 0;
            let taxRate = 18; // 18% GST
            
            // Initialize cart from localStorage if exists
            if(localStorage.getItem('saleCart')) {
                cart = JSON.parse(localStorage.getItem('saleCart'));
                updateCartDisplay();
            }
            
            // Product card click
            $('.product-card').click(function() {
                const product = JSON.parse($(this).data('product'));
                addToCart(product);
            });
            
            // Category filter
            $('[data-category]').click(function() {
                const category = $(this).data('category');
                $('[data-category]').removeClass('active');
                $(this).addClass('active');
                
                if(category === 'all') {
                    $('[data-category]').parent().show();
                } else {
                    $('[data-category]').parent().hide();
                    $(`[data-category="${category}"]`).parent().show();
                }
            });
            
            // Product search
            $('#productSearch').on('input', function() {
                const searchTerm = $(this).val().toLowerCase();
                $('.product-card').each(function() {
                    const productName = $(this).find('h6').text().toLowerCase();
                    const productSku = $(this).find('.text-muted').text().toLowerCase();
                    
                    if(productName.includes(searchTerm) || productSku.includes(searchTerm)) {
                        $(this).parent().show();
                    } else {
                        $(this).parent().hide();
                    }
                });
            });
            
            // Customer select
            $('#customerSelect').change(function() {
                if($(this).val()) {
                    $('#customerDetails').show();
                    // In real app, fetch customer details via AJAX
                } else {
                    $('#customerDetails').hide();
                }
            });
            
            // Payment method change
            $('#paymentMethod').change(function() {
                $('.payment-detail').hide();
                $(`#${$(this).val()}Detail`).show();
            });
            
            // Amount received calculation
            $('#amountReceived').on('input', function() {
                const received = parseFloat($(this).val()) || 0;
                const grandTotal = parseFloat($('#grandTotal').text().replace('₹', '').replace(/,/g, '')) || 0;
                const change = received - grandTotal;
                
                $('#changeAmount').val(change >= 0 ? '₹' + change.toFixed(2) : '₹0.00');
            });
            
            // Discount change
            $('#discount').on('input', function() {
                updateTotals();
            });
            
            $('#discountType').change(function() {
                updateTotals();
            });
            
            // Process sale
            $('#processSale').click(function() {
                if(cart.length === 0) {
                    alert('Please add products to cart');
                    return;
                }
                
                // Prepare sale data
                const saleData = {
                    customer_id: $('#customerSelect').val(),
                    customer_name: $('#customerSelect option:selected').text(),
                    payment_method: $('#paymentMethod').val(),
                    payment_status: $('#paymentStatus').val(),
                    amount_received: $('#amountReceived').val() || 0,
                    notes: $('textarea').val(),
                    items: cart,
                    subtotal: subtotal,
                    discount: discount,
                    tax: calculateTax(),
                    grand_total: calculateGrandTotal(),
                    timestamp: new Date().toISOString()
                };
                
                // In real app, send to server via AJAX
                console.log('Sale Data:', saleData);
                
                alert('Sale processed successfully! Invoice: INV-' + Date.now());
                
                // Clear cart and reset
                clearCart();
                localStorage.removeItem('saleCart');
                
                // Redirect to invoice page (in real app)
                // window.location.href = "{{ route('sales.show', '1') }}/" + invoiceId;
            });
            
            // Save draft
            $('#saveDraft').click(function() {
                if(cart.length > 0) {
                    localStorage.setItem('saleCart', JSON.stringify(cart));
                    alert('Draft saved successfully!');
                } else {
                    alert('Cart is empty');
                }
            });
            
            // Clear cart
            $('#clearCart').click(function() {
                if(confirm('Clear all items from cart?')) {
                    clearCart();
                    localStorage.removeItem('saleCart');
                }
            });
            
            // Quick actions
            $('[data-quantity]').click(function() {
                const quantity = parseInt($(this).data('quantity'));
                // Add sample product for quick testing
                const sampleProduct = {
                    id: 999,
                    name: 'Sample Product',
                    sku: 'SAMPLE-001',
                    price: 100,
                    stock: 100,
                    image: 'https://via.placeholder.com/150'
                };
                
                for(let i = 0; i < quantity; i++) {
                    addToCart(sampleProduct);
                }
            });
            
            // Helper functions
            function addToCart(product) {
                // Check if product already in cart
                const existingItem = cart.find(item => item.id === product.id);
                
                if(existingItem) {
                    if(existingItem.quantity < product.stock) {
                        existingItem.quantity++;
                    } else {
                        alert(`Only ${product.stock} units available in stock`);
                        return;
                    }
                } else {
                    if(product.stock > 0) {
                        cart.push({
                            ...product,
                            quantity: 1,
                            total: product.price
                        });
                    } else {
                        alert('Product out of stock');
                        return;
                    }
                }
                
                updateCartDisplay();
            }
            
            function updateCartDisplay() {
                const cartContainer = $('#cartItems');
                const emptyCart = $('#emptyCart');
                const cartSummary = $('#cartSummary');
                const cartCount = $('#cartCount');
                const processBtn = $('#processSale');
                
                if(cart.length === 0) {
                    cartContainer.html(`
                        <div class="text-center py-5 text-muted" id="emptyCart">
                            <i class="las la-shopping-cart fa-3x mb-3"></i>
                            <p class="mb-0">Your cart is empty</p>
                            <small>Add products from the list above</small>
                        </div>
                    `);
                    cartSummary.hide();
                    cartCount.text('0 items');
                    processBtn.prop('disabled', true);
                    return;
                }
                
                // Update cart count
                const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
                cartCount.text(`${totalItems} item${totalItems > 1 ? 's' : ''}`);
                
                // Build cart items HTML
                let cartHTML = '';
                cart.forEach((item, index) => {
                    const itemTotal = item.price * item.quantity;
                    cartHTML += `
                        <div class="cart-item">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">${item.name}</h6>
                                    <p class="mb-1 text-muted small">SKU: ${item.sku}</p>
                                    <div class="d-flex align-items-center">
                                        <div class="input-group input-group-sm" style="width: 130px;">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-outline-secondary" type="button" onclick="updateQuantity(${index}, -1)">-</button>
                                            </div>
                                            <input type="number" class="form-control quantity-input" 
                                                   value="${item.quantity}" min="1" max="${item.stock}"
                                                   onchange="updateQuantity(${index}, 0, this.value)">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary" type="button" onclick="updateQuantity(${index}, 1)">+</button>
                                            </div>
                                        </div>
                                        <button class="btn btn-sm btn-link text-danger ml-3" onclick="removeFromCart(${index})">
                                            <i class="las la-trash"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <h6 class="mb-1 text-primary">₹${item.price.toLocaleString('en-IN')}</h6>
                                    <strong>₹${itemTotal.toLocaleString('en-IN')}</strong>
                                </div>
                            </div>
                        </div>
                    `;
                });
                
                cartContainer.html(cartHTML);
                cartSummary.show();
                processBtn.prop('disabled', false);
                
                updateTotals();
            }
            
            function updateTotals() {
                // Calculate subtotal
                subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
                
                // Calculate discount
                const discountValue = parseFloat($('#discount').val()) || 0;
                const discountType = $('#discountType').val();
                
                if(discountType === 'percent') {
                    discount = subtotal * (discountValue / 100);
                } else {
                    discount = discountValue;
                }
                
                // Update display
                $('#subtotal').text('₹' + subtotal.toLocaleString('en-IN', {minimumFractionDigits: 2}));
                
                const tax = calculateTax();
                const grandTotal = calculateGrandTotal();
                
                $('#taxAmount').text('₹' + tax.toLocaleString('en-IN', {minimumFractionDigits: 2}));
                $('#grandTotal').text('₹' + grandTotal.toLocaleString('en-IN', {minimumFractionDigits: 2}));
                
                // Update amount received field
                $('#amountReceived').trigger('input');
            }
            
            function calculateTax() {
                const taxableAmount = subtotal - discount;
                return taxableAmount * (taxRate / 100);
            }
            
            function calculateGrandTotal() {
                const taxableAmount = subtotal - discount;
                const tax = taxableAmount * (taxRate / 100);
                return taxableAmount + tax;
            }
            
            function clearCart() {
                cart = [];
                subtotal = 0;
                discount = 0;
                updateCartDisplay();
            }
            
            // Make functions available globally
            window.updateQuantity = function(index, change, newValue = null) {
                if(newValue !== null) {
                    cart[index].quantity = parseInt(newValue);
                } else {
                    cart[index].quantity += change;
                }
                
                // Validate quantity
                if(cart[index].quantity < 1) cart[index].quantity = 1;
                if(cart[index].quantity > cart[index].stock) {
                    cart[index].quantity = cart[index].stock;
                    alert(`Only ${cart[index].stock} units available in stock`);
                }
                
                updateCartDisplay();
            };
            
            window.removeFromCart = function(index) {
                cart.splice(index, 1);
                updateCartDisplay();
            };
            
            window.applyDiscount = function(value) {
                if(typeof value === 'number') {
                    if(value <= 100) { // Assume percentage if <= 100
                        $('#discountType').val('percent');
                        $('#discount').val(value);
                    } else { // Assume amount if > 100
                        $('#discountType').val('amount');
                        $('#discount').val(value);
                    }
                    updateTotals();
                }
            };
        });
    </script>
    @endpush
</x-app-layout>