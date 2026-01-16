<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/remixicon/fonts/remixicon.css') }}">
    <style>
        .account-type-icon {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            margin-right: 15px;
            font-size: 1.5rem;
        }
        .account-type-option {
            cursor: pointer;
            border: 2px solid transparent;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 10px;
            transition: all 0.3s;
        }
        .account-type-option:hover {
            background: #f8f9fa;
            transform: translateY(-2px);
        }
        .account-type-option.selected {
            border-color: #007bff;
            background: #e7f3ff;
        }
        .balance-type-btn {
            min-width: 100px;
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
        .account-preview {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }
    </style>
    @endpush

    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
            <div>
                <h4 class="mb-3">Create New Account</h4>
                <p class="mb-0">Add a new account to your chart of accounts</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('accounts.index') }}">Accounts</a></li>
                        <li class="breadcrumb-item active">Create Account</li>
                    </ol>
                </nav>
            </div>
            <div>
                <a href="{{ route('accounts.index') }}" class="btn btn-outline-secondary">
                    <i class="las la-times mr-2"></i>Cancel
                </a>
                <button type="submit" form="accountCreateForm" class="btn btn-primary ml-2">
                    <i class="las la-save mr-2"></i>Save Account
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form id="accountCreateForm" action="{{ route('accounts.store') }}" method="POST">
                            @csrf
                            
                            <!-- Account Preview -->
                            <div class="account-preview">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="mb-1" id="previewAccountName">New Account</h5>
                                        <p class="mb-0" id="previewAccountCode">ACCT-{{ date('YmdHis') }}</p>
                                    </div>
                                    <div class="text-right">
                                        <h3 class="mb-0" id="previewBalance">₹0.00</h3>
                                        <small id="previewBalanceType">Debit Balance</small>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Account Type Selection -->
                            <div class="form-section">
                                <h6 class="form-section-title">Account Type</h6>
                                <p class="text-muted mb-3">Select the type of account you want to create</p>
                                
                                <div class="row">
                                    <!-- Asset -->
                                    <div class="col-md-4">
                                        <div class="account-type-option" data-type="asset" onclick="selectAccountType('asset')">
                                            <div class="d-flex align-items-center">
                                                <div class="account-type-icon bg-gradient-green text-white">
                                                    <i class="las la-wallet"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-1">Asset</h6>
                                                    <small class="text-muted">Resources owned</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Liability -->
                                    <div class="col-md-4">
                                        <div class="account-type-option" data-type="liability" onclick="selectAccountType('liability')">
                                            <div class="d-flex align-items-center">
                                                <div class="account-type-icon bg-gradient-orange text-white">
                                                    <i class="las la-hand-holding-usd"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-1">Liability</h6>
                                                    <small class="text-muted">Amounts owed</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Equity -->
                                    <div class="col-md-4">
                                        <div class="account-type-option" data-type="equity" onclick="selectAccountType('equity')">
                                            <div class="d-flex align-items-center">
                                                <div class="account-type-icon bg-gradient-info text-white">
                                                    <i class="las la-chart-line"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-1">Equity</h6>
                                                    <small class="text-muted">Owner's investment</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Revenue -->
                                    <div class="col-md-4">
                                        <div class="account-type-option" data-type="revenue" onclick="selectAccountType('revenue')">
                                            <div class="d-flex align-items-center">
                                                <div class="account-type-icon bg-gradient-success text-white">
                                                    <i class="las la-money-bill-wave"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-1">Revenue</h6>
                                                    <small class="text-muted">Income earned</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Expense -->
                                    <div class="col-md-4">
                                        <div class="account-type-option" data-type="expense" onclick="selectAccountType('expense')">
                                            <div class="d-flex align-items-center">
                                                <div class="account-type-icon bg-gradient-danger text-white">
                                                    <i class="las la-receipt"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-1">Expense</h6>
                                                    <small class="text-muted">Costs incurred</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Cost of Sales -->
                                    <div class="col-md-4">
                                        <div class="account-type-option" data-type="cost_of_sales" onclick="selectAccountType('cost_of_sales')">
                                            <div class="d-flex align-items-center">
                                                <div class="account-type-icon bg-gradient-purple text-white">
                                                    <i class="las la-shopping-cart"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-1">Cost of Sales</h6>
                                                    <small class="text-muted">Cost of goods sold</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <input type="hidden" name="account_type" id="selectedAccountType">
                            </div>
                            
                            <!-- Basic Information -->
                            <div class="form-section">
                                <h6 class="form-section-title">Account Details</h6>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Account Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="account_name" 
                                                   placeholder="e.g., Cash in Hand, Bank Account" 
                                                   oninput="updatePreview('name', this.value)" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Account Code</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="account_code" 
                                                       id="accountCode" value="ACCT-{{ date('YmdHis') }}">
                                                <div class="input-group-append">
                                                    <button type="button" class="btn btn-outline-secondary" onclick="generateAccountCode()">
                                                        <i class="las la-sync"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <small class="form-text text-muted">Unique identifier for the account</small>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Parent Account</label>
                                            <select class="form-control" name="parent_account_id" id="parentAccount">
                                                <option value="">Select Parent Account</option>
                                                <option value="">-- No Parent (Main Account) --</option>
                                                <optgroup label="Assets">
                                                    <option value="1">Current Assets</option>
                                                    <option value="2">Fixed Assets</option>
                                                </optgroup>
                                                <optgroup label="Liabilities">
                                                    <option value="3">Current Liabilities</option>
                                                    <option value="4">Long-term Liabilities</option>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Account Type</label>
                                            <select class="form-control" name="account_type_id" id="accountTypeSelect" required>
                                                <option value="">Select Account Type</option>
                                                <!-- Will be populated based on selected account type -->
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" name="description" rows="3" 
                                              placeholder="Enter account description"></textarea>
                                </div>
                            </div>
                            
                            <!-- Opening Balance -->
                            <div class="form-section">
                                <h6 class="form-section-title">Opening Balance</h6>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Opening Balance Amount</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">₹</span>
                                                </div>
                                                <input type="number" class="form-control" name="opening_balance" 
                                                       value="0.00" step="0.01" min="0"
                                                       oninput="updatePreview('balance', this.value)">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Balance Type</label>
                                            <div class="btn-group btn-group-toggle w-100" data-toggle="buttons">
                                                <label class="btn btn-outline-primary balance-type-btn">
                                                    <input type="radio" name="opening_balance_type" value="debit" checked> Debit
                                                </label>
                                                <label class="btn btn-outline-primary balance-type-btn">
                                                    <input type="radio" name="opening_balance_type" value="credit"> Credit
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Bank Details (if applicable) -->
                            <div class="form-section" id="bankDetailsSection" style="display: none;">
                                <h6 class="form-section-title">Bank Details</h6>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Bank Name</label>
                                            <input type="text" class="form-control" name="bank_name" 
                                                   placeholder="e.g., HDFC Bank, ICICI Bank">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Account Number</label>
                                            <input type="text" class="form-control" name="account_number" 
                                                   placeholder="Enter bank account number">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">IFSC Code</label>
                                            <input type="text" class="form-control" name="ifsc_code" 
                                                   placeholder="Enter IFSC code">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Branch Name</label>
                                            <input type="text" class="form-control" name="branch_name" 
                                                   placeholder="Enter bank branch name">
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
                                            <label class="form-label">Branch</label>
                                            <select class="form-control" name="branch_id">
                                                <option value="">All Branches</option>
                                                <option value="1" selected>Main Branch</option>
                                                <option value="2">Downtown Branch</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Status</label>
                                            <select class="form-control" name="is_active">
                                                <option value="1" selected>Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" 
                                                       name="is_cash_account" id="isCashAccount" value="1">
                                                <label class="custom-control-label" for="isCashAccount">
                                                    Cash Account
                                                </label>
                                            </div>
                                            <small class="form-text text-muted">Use for physical cash transactions</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" 
                                                       name="is_bank_account" id="isBankAccount" value="1" 
                                                       onchange="toggleBankDetails(this.checked)">
                                                <label class="custom-control-label" for="isBankAccount">
                                                    Bank Account
                                                </label>
                                            </div>
                                            <small class="form-text text-muted">Use for bank transactions</small>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" 
                                               name="is_system_account" id="isSystemAccount" value="1">
                                        <label class="custom-control-label" for="isSystemAccount">
                                            System Account
                                        </label>
                                    </div>
                                    <small class="form-text text-muted">Reserved for system operations</small>
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-between mt-4">
                                <button type="button" class="btn btn-outline-secondary" onclick="resetForm()">
                                    <i class="las la-redo mr-2"></i>Reset Form
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="las la-save mr-2"></i>Save Account
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
            // Initialize default account type
            selectAccountType('asset');
            
            // Form submission
            $('#accountCreateForm').submit(function(e) {
                e.preventDefault();
                
                // Validation
                const accountName = $('input[name="account_name"]').val().trim();
                const accountType = $('#selectedAccountType').val();
                
                if(!accountName) {
                    alert('Please enter account name');
                    $('input[name="account_name"]').focus();
                    return false;
                }
                
                if(!accountType) {
                    alert('Please select an account type');
                    return false;
                }
                
                // Show loading
                $('button[type="submit"]').prop('disabled', true).html('<i class="las la-spinner la-spin mr-2"></i>Saving...');
                
                // Collect form data
                const formData = new FormData(this);
                
                // Simulate API call
                setTimeout(() => {
                    console.log('Form data:', Object.fromEntries(formData));
                    alert('Account created successfully!');
                    window.location.href = "{{ route('accounts.index') }}";
                }, 1500);
                
                return false;
            });
            
            // Update preview on balance type change
            $('input[name="opening_balance_type"]').change(function() {
                updatePreview('balanceType', this.value);
            });
            
            // Update preview on account type change
            $('#accountTypeSelect').change(function() {
                updatePreview('accountType', $(this).find('option:selected').text());
            });
        });
        
        // Account type selection
        window.selectAccountType = function(type) {
            // Remove selection from all options
            $('.account-type-option').removeClass('selected');
            
            // Add selection to clicked option
            $(`.account-type-option[data-type="${type}"]`).addClass('selected');
            
            // Update hidden field
            $('#selectedAccountType').val(type);
            
            // Update account type dropdown
            updateAccountTypes(type);
            
            // Update preview
            updatePreview('type', type);
        };
        
        // Update account types dropdown
        window.updateAccountTypes = function(category) {
            const accountTypes = {
                'asset': [
                    {id: 1, name: 'Cash', code: 'CASH'},
                    {id: 2, name: 'Bank Accounts', code: 'BANK'},
                    {id: 3, name: 'Accounts Receivable', code: 'AR'},
                    {id: 4, name: 'Inventory', code: 'INVENTORY'},
                    {id: 5, name: 'Fixed Assets', code: 'FIXED_ASSETS'}
                ],
                'liability': [
                    {id: 6, name: 'Accounts Payable', code: 'AP'},
                    {id: 7, name: 'Loans Payable', code: 'LOANS'},
                    {id: 8, name: 'Tax Payable', code: 'TAX_PAYABLE'}
                ],
                'equity': [
                    {id: 9, name: 'Owner\'s Equity', code: 'EQUITY'},
                    {id: 10, name: 'Retained Earnings', code: 'RETAINED'}
                ],
                'revenue': [
                    {id: 11, name: 'Sales Revenue', code: 'SALES'},
                    {id: 12, name: 'Service Revenue', code: 'SERVICE'},
                    {id: 13, name: 'Interest Income', code: 'INTEREST'}
                ],
                'expense': [
                    {id: 14, name: 'Salaries Expense', code: 'SALARY'},
                    {id: 15, name: 'Rent Expense', code: 'RENT'},
                    {id: 16, name: 'Utilities Expense', code: 'UTILITIES'}
                ],
                'cost_of_sales': [
                    {id: 17, name: 'Cost of Goods Sold', code: 'COGS'},
                    {id: 18, name: 'Purchase Returns', code: 'PURCHASE_RETURNS'}
                ]
            };
            
            const $select = $('#accountTypeSelect');
            $select.empty();
            $select.append('<option value="">Select Account Type</option>');
            
            if(accountTypes[category]) {
                accountTypes[category].forEach(type => {
                    $select.append(new Option(`${type.name} (${type.code})`, type.id));
                });
            }
        };
        
        // Generate account code
        window.generateAccountCode = function() {
            const timestamp = Date.now().toString();
            const code = 'ACCT-' + timestamp.slice(-12);
            $('#accountCode').val(code);
            updatePreview('code', code);
        };
        
        // Toggle bank details section
        window.toggleBankDetails = function(show) {
            if(show) {
                $('#bankDetailsSection').slideDown();
            } else {
                $('#bankDetailsSection').slideUp();
            }
        };
        
        // Update preview
        window.updatePreview = function(type, value) {
            switch(type) {
                case 'name':
                    $('#previewAccountName').text(value || 'New Account');
                    break;
                case 'code':
                    $('#previewAccountCode').text(value);
                    break;
                case 'balance':
                    $('#previewBalance').text('₹' + parseFloat(value || 0).toFixed(2));
                    break;
                case 'balanceType':
                    $('#previewBalanceType').text(value === 'credit' ? 'Credit Balance' : 'Debit Balance');
                    break;
                case 'type':
                    const typeNames = {
                        'asset': 'Asset Account',
                        'liability': 'Liability Account',
                        'equity': 'Equity Account',
                        'revenue': 'Revenue Account',
                        'expense': 'Expense Account',
                        'cost_of_sales': 'Cost of Sales Account'
                    };
                    $('#previewAccountType').text(typeNames[value] || '');
                    break;
                case 'accountType':
                    $('#previewAccountTypeDetail').text(value);
                    break;
            }
        };
        
        // Reset form
        window.resetForm = function() {
            if(confirm('Are you sure you want to reset the form? All data will be lost.')) {
                $('#accountCreateForm')[0].reset();
                selectAccountType('asset');
                toggleBankDetails(false);
                generateAccountCode();
                updatePreview('name', '');
                updatePreview('balance', '0.00');
                updatePreview('balanceType', 'debit');
            }
        };
    </script>
    @endpush
</x-app-layout>