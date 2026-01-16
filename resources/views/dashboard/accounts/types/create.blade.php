<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/remixicon/fonts/remixicon.css') }}">
    <style>
        .category-option {
            border: 2px solid transparent;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            margin-bottom: 15px;
            height: 100%;
        }
        .category-option:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .category-option.selected {
            border-color: #007bff;
            background: #e7f3ff;
        }
        .category-icon {
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin: 0 auto 15px;
            font-size: 1.8rem;
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
        .type-preview {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .help-box {
            background: #e9ecef;
            border-radius: 8px;
            padding: 15px;
            margin-top: 20px;
        }
    </style>
    @endpush

    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
            <div>
                <h4 class="mb-3">Create Account Type</h4>
                <p class="mb-0">Define a new account type for categorization</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('accounts.index') }}">Accounts</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('accounts.types.index') }}">Account Types</a></li>
                        <li class="breadcrumb-item active">Create Type</li>
                    </ol>
                </nav>
            </div>
            <div>
                <a href="{{ route('accounts.types.index') }}" class="btn btn-outline-secondary">
                    <i class="las la-times mr-2"></i>Cancel
                </a>
                <button type="submit" form="typeCreateForm" class="btn btn-primary ml-2">
                    <i class="las la-save mr-2"></i>Save Type
                </button>
            </div>
        </div>

        <!-- Type Preview -->
        <div class="type-preview">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1" id="previewTypeName">New Account Type</h5>
                    <p class="mb-0" id="previewTypeCode">TYPE-{{ date('YmdHis') }}</p>
                </div>
                <div class="text-right">
                    <span class="badge bg-gradient-green" id="previewCategory">Asset</span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form id="typeCreateForm" action="{{ route('accounts.types.store') }}" method="POST">
                            @csrf
                            
                            <!-- Category Selection -->
                            <div class="form-section">
                                <h6 class="form-section-title">Account Category</h6>
                                <p class="text-muted mb-3">Select the main category for this account type</p>
                                
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="category-option" onclick="selectCategory('asset')">
                                            <div class="category-icon bg-gradient-green text-white">
                                                <i class="las la-wallet"></i>
                                            </div>
                                            <h6>Asset</h6>
                                            <small class="text-muted">Resources owned by the business</small>
                                            <div class="mt-2">
                                                <span class="badge badge-light">Cash, Inventory, Equipment</span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="category-option" onclick="selectCategory('liability')">
                                            <div class="category-icon bg-gradient-orange text-white">
                                                <i class="las la-hand-holding-usd"></i>
                                            </div>
                                            <h6>Liability</h6>
                                            <small class="text-muted">Amounts owed by the business</small>
                                            <div class="mt-2">
                                                <span class="badge badge-light">Loans, Accounts Payable</span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="category-option" onclick="selectCategory('equity')">
                                            <div class="category-icon bg-gradient-info text-white">
                                                <i class="las la-chart-line"></i>
                                            </div>
                                            <h6>Equity</h6>
                                            <small class="text-muted">Owner's investment in the business</small>
                                            <div class="mt-2">
                                                <span class="badge badge-light">Capital, Retained Earnings</span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="category-option" onclick="selectCategory('revenue')">
                                            <div class="category-icon bg-gradient-success text-white">
                                                <i class="las la-money-bill-wave"></i>
                                            </div>
                                            <h6>Revenue</h6>
                                            <small class="text-muted">Income earned from operations</small>
                                            <div class="mt-2">
                                                <span class="badge badge-light">Sales, Service Income</span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="category-option" onclick="selectCategory('expense')">
                                            <div class="category-icon bg-gradient-danger text-white">
                                                <i class="las la-receipt"></i>
                                            </div>
                                            <h6>Expense</h6>
                                            <small class="text-muted">Costs incurred in operations</small>
                                            <div class="mt-2">
                                                <span class="badge badge-light">Salaries, Rent, Utilities</span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="category-option" onclick="selectCategory('cost_of_sales')">
                                            <div class="category-icon bg-gradient-purple text-white">
                                                <i class="las la-shopping-cart"></i>
                                            </div>
                                            <h6>Cost of Sales</h6>
                                            <small class="text-muted">Direct costs of goods sold</small>
                                            <div class="mt-2">
                                                <span class="badge badge-light">COGS, Purchase Returns</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <input type="hidden" name="category" id="selectedCategory" value="asset">
                            </div>
                            
                            <!-- Type Details -->
                            <div class="form-section">
                                <h6 class="form-section-title">Type Details</h6>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Type Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="type_name" 
                                                   placeholder="e.g., Cash, Bank Accounts, Sales Revenue"
                                                   oninput="updatePreview('name', this.value)" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Type Code</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="type_code" 
                                                       id="typeCode" value="TYPE-{{ date('YmdHis') }}">
                                                <div class="input-group-append">
                                                    <button type="button" class="btn btn-outline-secondary" onclick="generateTypeCode()">
                                                        <i class="las la-sync"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <small class="form-text text-muted">Unique identifier (uppercase, no spaces)</small>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" name="description" rows="3" 
                                              placeholder="Describe this account type and its typical use"></textarea>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Default Balance Type</label>
                                            <select class="form-control" name="default_balance_type" id="defaultBalanceType">
                                                <option value="debit">Debit Balance</option>
                                                <option value="credit">Credit Balance</option>
                                                <option value="both">Both (Varies)</option>
                                            </select>
                                            <small class="form-text text-muted">Typical balance for accounts of this type</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Display Order</label>
                                            <input type="number" class="form-control" name="display_order" value="0">
                                            <small class="form-text text-muted">Lower numbers appear first in lists</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Settings -->
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
                                            <label class="form-label">Parent Type (Optional)</label>
                                            <select class="form-control" name="parent_type_id">
                                                <option value="">No Parent</option>
                                                <option value="1">Current Assets</option>
                                                <option value="2">Fixed Assets</option>
                                                <option value="3">Current Liabilities</option>
                                                <option value="4">Long-term Liabilities</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" 
                                               name="is_system_type" id="isSystemType" value="1">
                                        <label class="custom-control-label" for="isSystemType">
                                            System Type
                                        </label>
                                    </div>
                                    <small class="form-text text-muted">Reserved for system operations (cannot be deleted)</small>
                                </div>
                                
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" 
                                               name="requires_reconciliation" id="requiresReconciliation" value="1">
                                        <label class="custom-control-label" for="requiresReconciliation">
                                            Requires Reconciliation
                                        </label>
                                    </div>
                                    <small class="form-text text-muted">Accounts of this type should be regularly reconciled</small>
                                </div>
                            </div>
                            
                            <!-- Help Information -->
                            <div class="help-box">
                                <h6><i class="las la-question-circle mr-2"></i>About Account Types</h6>
                                <p class="small mb-2">
                                    <strong>Asset:</strong> Debit increases, Credit decreases. Normally has debit balance.<br>
                                    <strong>Liability:</strong> Credit increases, Debit decreases. Normally has credit balance.<br>
                                    <strong>Equity:</strong> Credit increases, Debit decreases. Normally has credit balance.<br>
                                    <strong>Revenue:</strong> Credit increases, Debit decreases. Normally has credit balance.<br>
                                    <strong>Expense:</strong> Debit increases, Credit decreases. Normally has debit balance.<br>
                                    <strong>Cost of Sales:</strong> Debit increases, Credit decreases. Normally has debit balance.
                                </p>
                                <p class="small mb-0">
                                    <strong>Tip:</strong> Create consistent naming conventions (e.g., all revenue types end with "Revenue")
                                </p>
                            </div>
                            
                            <div class="d-flex justify-content-between mt-4">
                                <button type="button" class="btn btn-outline-secondary" onclick="resetForm()">
                                    <i class="las la-redo mr-2"></i>Reset Form
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="las la-save mr-2"></i>Save Account Type
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
            // Initialize default selection
            selectCategory('asset');
            
            // Update preview on balance type change
            $('#defaultBalanceType').change(function() {
                updatePreview('balanceType', $(this).find('option:selected').text());
            });
            
            // Form submission
            $('#typeCreateForm').submit(function(e) {
                e.preventDefault();
                
                // Validation
                const typeName = $('input[name="type_name"]').val().trim();
                const typeCode = $('input[name="type_code"]').val().trim();
                const category = $('#selectedCategory').val();
                
                if(!typeName) {
                    alert('Please enter type name');
                    $('input[name="type_name"]').focus();
                    return false;
                }
                
                if(!typeCode) {
                    alert('Please enter type code');
                    $('input[name="type_code"]').focus();
                    return false;
                }
                
                if(!category) {
                    alert('Please select a category');
                    return false;
                }
                
                // Validate type code format
                if(!/^[A-Z0-9_-]+$/.test(typeCode)) {
                    alert('Type code must contain only uppercase letters, numbers, hyphens, and underscores');
                    $('input[name="type_code"]').focus();
                    return false;
                }
                
                // Show loading
                $('button[type="submit"]').prop('disabled', true).html('<i class="las la-spinner la-spin mr-2"></i>Saving...');
                
                // Collect form data
                const formData = new FormData(this);
                
                // Simulate API call
                setTimeout(() => {
                    console.log('Form data:', Object.fromEntries(formData));
                    alert('Account type created successfully!');
                    window.location.href = "{{ route('accounts.types.index') }}";
                }, 1500);
                
                return false;
            });
        });
        
        // Category selection
        window.selectCategory = function(category) {
            // Remove selection from all options
            $('.category-option').removeClass('selected');
            
            // Add selection to clicked option
            $(`.category-option:contains(${category.charAt(0).toUpperCase() + category.slice(1)})`).closest('.category-option').addClass('selected');
            
            // Update hidden field
            $('#selectedCategory').val(category);
            
            // Update preview
            updatePreview('category', category);
            
            // Update default balance type based on category
            updateDefaultBalanceType(category);
        };
        
        // Update default balance type based on category
        window.updateDefaultBalanceType = function(category) {
            const balanceTypes = {
                'asset': 'debit',
                'expense': 'debit',
                'cost_of_sales': 'debit',
                'liability': 'credit',
                'equity': 'credit',
                'revenue': 'credit'
            };
            
            if(balanceTypes[category]) {
                $('#defaultBalanceType').val(balanceTypes[category]);
                updatePreview('balanceType', balanceTypes[category].charAt(0).toUpperCase() + balanceTypes[category].slice(1) + ' Balance');
            }
        };
        
        // Generate type code
        window.generateTypeCode = function() {
            const name = $('input[name="type_name"]').val().trim();
            let code;
            
            if(name) {
                // Convert name to code format (uppercase, no spaces)
                code = name.toUpperCase()
                    .replace(/[^A-Z0-9]/g, '_')
                    .replace(/_+/g, '_')
                    .replace(/^_+|_+$/g, '');
                
                // Add timestamp if code is too short
                if(code.length < 3) {
                    code = 'TYPE_' + Date.now().toString().slice(-6);
                }
            } else {
                code = 'TYPE_' + Date.now().toString().slice(-8);
            }
            
            $('#typeCode').val(code);
            updatePreview('code', code);
        };
        
        // Update preview
        window.updatePreview = function(type, value) {
            switch(type) {
                case 'name':
                    $('#previewTypeName').text(value || 'New Account Type');
                    break;
                case 'code':
                    $('#previewTypeCode').text(value);
                    break;
                case 'category':
                    const categoryNames = {
                        'asset': 'Asset',
                        'liability': 'Liability',
                        'equity': 'Equity',
                        'revenue': 'Revenue',
                        'expense': 'Expense',
                        'cost_of_sales': 'Cost of Sales'
                    };
                    $('#previewCategory').text(categoryNames[value] || '');
                    break;
                case 'balanceType':
                    $('#previewBalanceType').text(value);
                    break;
            }
        };
        
        // Reset form
        window.resetForm = function() {
            if(confirm('Are you sure you want to reset the form? All data will be lost.')) {
                $('#typeCreateForm')[0].reset();
                selectCategory('asset');
                generateTypeCode();
                updatePreview('name', '');
                updatePreview('category', 'asset');
            }
        };
    </script>
    @endpush
</x-app-layout>