<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/remixicon/fonts/remixicon.css') }}">
    <style>
        .adjustment-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 15px;
            padding: 25px;
            color: white;
            margin-bottom: 25px;
        }
        .product-search-result {
            border: 1px solid #e3e6f0;
            border-radius: 8px;
            padding: 10px;
            margin-bottom: 10px;
            cursor: pointer;
            transition: all 0.3s;
        }
        .product-search-result:hover {
            background: #f8f9fa;
            transform: translateX(5px);
        }
        .adjustment-item {
            border: 1px solid #e3e6f0;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            background: white;
        }
        .adjustment-summary {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
            border: 2px dashed #dee2e6;
        }
        .quantity-input {
            width: 100px;
            text-align: center;
        }
        .cost-display {
            background: #f3f4f6;
            border-radius: 8px;
            padding: 10px;
            font-weight: 600;
            color: #374151;
        }
        .type-badge {
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }
    </style>
    @endpush

    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
            <div>
                <h4 class="mb-3">Create Stock Adjustment</h4>
                <p class="mb-0">Adjust stock levels for one or multiple products</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('inventory.index') }}">Inventory</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('inventory.adjustments.index') }}">Adjustments</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </nav>
            </div>
            <div class="d-flex">
                <a href="{{ route('inventory.adjustments.index') }}" class="btn btn-secondary">
                    <i class="las la-arrow-left mr-2"></i>Back to List
                </a>
            </div>
        </div>

        <!-- Adjustment Header -->
        <div class="adjustment-header">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h3 class="mb-2">New Stock Adjustment</h3>
                    <p class="mb-0">Adjustment #: <strong>ADJ-{{ date('YmdHis') }}</strong></p>
                </div>
                <div class="col-md-4 text-right">
                    <div class="h4 mb-2">{{ date('F d, Y') }}</div>
                    <div class="small">Created by: System User</div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Left Column - Form -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <form id="adjustmentForm">
                            <!-- Basic Information -->
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Adjustment Type <span class="text-danger">*</span></label>
                                        <select class="form-control" id="adjustmentType" required onchange="updateType()">
                                            <option value="">Select Type</option>
                                            <option value="count">Count Adjustment</option>
                                            <option value="damage">Damage</option>
                                            <option value="expired">Expired</option>
                                            <option value="theft">Theft</option>
                                            <option value="sample">Sample/Display</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Branch <span class="text-danger">*</span></label>
                                        <select class="form-control" required>
                                            <option value="">Select Branch</option>
                                            <option value="1">Main Store - Downtown</option>
                                            <option value="2">Westside Mall Branch</option>
                                            <option value="3">Warehouse - North</option>
                                            <option value="4">East City Outlet</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Product Search -->
                            <div class="mb-4">
                                <div class="form-group">
                                    <label>Add Products <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="productSearch" 
                                               placeholder="Search product by name, code or SKU">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button" onclick="searchProducts()">
                                                <i class="las la-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <small class="form-text text-muted">
                                        Start typing to search for products. Select from results to add.
                                    </small>
                                </div>
                                
                                <!-- Search Results -->
                                <div id="searchResults" style="display: none;">
                                    <div class="product-search-result" onclick="addProduct(1)">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="mb-1">Levi's 501 Original Jeans</h6>
                                                <small class="text-muted">SKU: LS-501-BL | Current Stock: 45</small>
                                            </div>
                                            <div class="text-right">
                                                <div class="h6 mb-1">$89.99</div>
                                                <small class="text-success">Cost: $45.00</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-search-result" onclick="addProduct(2)">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="mb-1">Nike Air Max Shoes</h6>
                                                <small class="text-muted">SKU: NK-AM-001 | Current Stock: 32</small>
                                            </div>
                                            <div class="text-right">
                                                <div class="h6 mb-1">$129.99</div>
                                                <small class="text-success">Cost: $65.00</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Added Products -->
                            <div id="addedProducts">
                                <h6 class="mb-3">Products to Adjust</h6>
                                <div class="alert alert-info" id="noProductsAlert">
                                    <i class="las la-info-circle"></i> No products added yet. Search and add products above.
                                </div>
                                
                                <!-- Product 1 (Sample - hidden by default) -->
                                <div class="adjustment-item" id="productItem1" style="display: none;">
                                    <div class="row align-items-center">
                                        <div class="col-md-4">
                                            <h6 class="mb-1">Levi's 501 Original Jeans</h6>
                                            <small class="text-muted">SKU: LS-501-BL | Current: <span class="text-primary">45</span></small>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group mb-0">
                                                <label>Adjustment</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <select class="form-control form-control-sm" style="width: 80px;">
                                                            <option value="add">Add</option>
                                                            <option value="remove" selected>Remove</option>
                                                        </select>
                                                    </div>
                                                    <input type="number" class="form-control quantity-input" value="5" min="1">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">units</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group mb-0">
                                                <label>Cost Price</label>
                                                <div class="cost-display">$45.00</div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 text-right">
                                            <button class="btn btn-sm btn-danger" onclick="removeProduct(1)">
                                                <i class="las la-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Adjustment Details -->
                            <div class="form-group">
                                <label>Reason for Adjustment <span class="text-danger">*</span></label>
                                <textarea class="form-control" rows="4" 
                                          placeholder="Explain why this adjustment is necessary..." required></textarea>
                            </div>

                            <!-- Reference Information -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Reference Number (Optional)</label>
                                        <input type="text" class="form-control" placeholder="e.g., Invoice #, PO #, etc.">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Attachment (Optional)</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="attachment">
                                            <label class="custom-file-label" for="attachment">Choose file...</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Right Column - Summary -->
            <div class="col-lg-4">
                <!-- Adjustment Summary -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="las la-calculator mr-2"></i>Adjustment Summary</h6>
                    </div>
                    <div class="card-body">
                        <div class="adjustment-summary">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Type:</span>
                                <span class="type-badge bg-warning text-white" id="typeDisplay">Not Selected</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Total Items:</span>
                                <strong id="totalItems">0</strong>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Items Added:</span>
                                <span class="text-success" id="itemsAdded">0</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Items Removed:</span>
                                <span class="text-danger" id="itemsRemoved">0</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between mb-3">
                                <span>Total Value:</span>
                                <div class="h4 text-primary" id="totalValue">$0.00</div>
                            </div>
                            <div class="small text-muted text-center">
                                This adjustment will be recorded in inventory history
                            </div>
                        </div>
                        
                        <!-- Status and Approval -->
                        <div class="form-group mt-4">
                            <label>Status</label>
                            <select class="form-control">
                                <option value="pending" selected>Pending Approval</option>
                                <option value="approved">Approved</option>
                                <option value="rejected">Rejected</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label>Approved By (Optional)</label>
                            <select class="form-control">
                                <option value="">Select Approver</option>
                                <option value="1">John Doe (Manager)</option>
                                <option value="2">Jane Smith (Supervisor)</option>
                                <option value="3">Robert Brown (Owner)</option>
                            </select>
                        </div>
                        
                        <hr>
                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary" form="adjustmentForm">
                                <i class="las la-save mr-2"></i>Save Adjustment
                            </button>
                            <button type="button" class="btn btn-outline-success" onclick="saveAndNew()">
                                <i class="las la-save mr-2"></i>Save & New
                            </button>
                            <button type="reset" class="btn btn-outline-secondary" form="adjustmentForm">
                                <i class="las la-redo mr-2"></i>Reset Form
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Quick Help -->
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="las la-question-circle mr-2"></i>Quick Help</h6>
                    </div>
                    <div class="card-body">
                        <div class="small">
                            <p><strong>Adjustment Types:</strong></p>
                            <ul class="pl-3 mb-3">
                                <li><strong>Count:</strong> Physical count differences</li>
                                <li><strong>Damage:</strong> Damaged/defective items</li>
                                <li><strong>Expired:</strong> Expired products</li>
                                <li><strong>Theft:</strong> Missing/unaccounted items</li>
                                <li><strong>Sample:</strong> For display/demo</li>
                            </ul>
                            <p><strong>Note:</strong> All adjustments are logged and require approval for significant values.</p>
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
            // File upload label
            $('.custom-file-input').on('change', function() {
                const fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').text(fileName || 'Choose file...');
            });
            
            // Form submission
            $('#adjustmentForm').submit(function(e) {
                e.preventDefault();
                if(validateForm()) {
                    saveAdjustment();
                }
            });
            
            // Update summary when quantity changes
            $(document).on('input', '.quantity-input, select', function() {
                updateSummary();
            });
        });
        
        function searchProducts() {
            const query = $('#productSearch').val().trim();
            if(query.length < 2) {
                alert('Please enter at least 2 characters to search.');
                return;
            }
            
            $('#searchResults').slideDown();
            // In a real app, this would make an AJAX call
            console.log('Searching products for:', query);
        }
        
        function addProduct(productId) {
            // Hide no products alert
            $('#noProductsAlert').hide();
            
            // Show the product item
            $(`#productItem${productId}`).slideDown();
            
            // Clear search
            $('#productSearch').val('');
            $('#searchResults').slideUp();
            
            // Update summary
            updateSummary();
        }
        
        function removeProduct(productId) {
            $(`#productItem${productId}`).slideUp(function() {
                // Check if any products are visible
                if($('.adjustment-item:visible').length === 0) {
                    $('#noProductsAlert').slideDown();
                }
                updateSummary();
            });
        }
        
        function updateType() {
            const type = $('#adjustmentType').val();
            const typeText = $('#adjustmentType option:selected').text();
            
            if(type) {
                $('#typeDisplay').text(typeText).removeClass('bg-warning').addClass(getTypeColor(type));
            } else {
                $('#typeDisplay').text('Not Selected').addClass('bg-warning').removeClass('bg-success bg-danger bg-info');
            }
        }
        
        function getTypeColor(type) {
            switch(type) {
                case 'count': return 'bg-primary';
                case 'damage': return 'bg-danger';
                case 'expired': return 'bg-warning';
                case 'theft': return 'bg-dark';
                case 'sample': return 'bg-info';
                default: return 'bg-secondary';
            }
        }
        
        function updateSummary() {
            let totalItems = 0;
            let itemsAdded = 0;
            let itemsRemoved = 0;
            let totalValue = 0;
            
            $('.adjustment-item:visible').each(function() {
                const quantity = parseInt($(this).find('.quantity-input').val()) || 0;
                const action = $(this).find('select').val();
                const cost = 45.00; // This would come from data attributes in real app
                
                totalItems += quantity;
                totalValue += quantity * cost;
                
                if(action === 'add') {
                    itemsAdded += quantity;
                } else {
                    itemsRemoved += quantity;
                    totalValue = -totalValue; // Negative value for removals
                }
            });
            
            $('#totalItems').text(totalItems);
            $('#itemsAdded').text(itemsAdded);
            $('#itemsRemoved').text(itemsRemoved);
            $('#totalValue').text('$' + Math.abs(totalValue).toFixed(2));
            
            // Color code total value
            const valueElement = $('#totalValue');
            valueElement.removeClass('text-success text-danger');
            if(totalValue > 0) {
                valueElement.addClass('text-success');
            } else if(totalValue < 0) {
                valueElement.addClass('text-danger');
            }
        }
        
        function validateForm() {
            const type = $('#adjustmentType').val();
            if(!type) {
                alert('Please select an adjustment type.');
                $('#adjustmentType').focus();
                return false;
            }
            
            if($('.adjustment-item:visible').length === 0) {
                alert('Please add at least one product to adjust.');
                $('#productSearch').focus();
                return false;
            }
            
            const reason = $('textarea').val().trim();
            if(!reason) {
                alert('Please provide a reason for the adjustment.');
                $('textarea').focus();
                return false;
            }
            
            return true;
        }
        
        function saveAdjustment() {
            const adjustmentData = {
                type: $('#adjustmentType').val(),
                branch: $('select[name="branch"]').val(),
                reason: $('textarea').val().trim(),
                items: [],
                totalValue: parseFloat($('#totalValue').text().replace('$', '')),
                status: $('select[name="status"]').val(),
                approvedBy: $('select[name="approvedBy"]').val()
            };
            
            // Collect product data
            $('.adjustment-item:visible').each(function() {
                const product = {
                    id: $(this).attr('id').replace('productItem', ''),
                    action: $(this).find('select').val(),
                    quantity: parseInt($(this).find('.quantity-input').val()),
                    cost: 45.00
                };
                adjustmentData.items.push(product);
            });
            
            console.log('Saving adjustment:', adjustmentData);
            alert('Adjustment saved successfully!');
            
            // Redirect to adjustments list
            setTimeout(() => {
                window.location.href = "{{ route('inventory.adjustments.index') }}";
            }, 1500);
        }
        
        function saveAndNew() {
            if(validateForm()) {
                saveAdjustment();
                // Reset form for new entry
                setTimeout(() => {
                    $('#adjustmentForm')[0].reset();
                    $('.adjustment-item').hide();
                    $('#noProductsAlert').show();
                    updateSummary();
                    updateType();
                    $('#adjustmentType').focus();
                }, 1000);
            }
        }
    </script>
    @endpush
</x-app-layout>