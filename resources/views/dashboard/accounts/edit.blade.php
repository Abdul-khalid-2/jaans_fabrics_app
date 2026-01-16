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
        .account-status-badge {
            font-size: 0.8rem;
            padding: 5px 10px;
            border-radius: 20px;
        }
        .readonly-field {
            background-color: #f8f9fa;
            cursor: not-allowed;
        }
    </style>
    @endpush

    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
            <div>
                <h4 class="mb-3">Edit Account</h4>
                <p class="mb-0">Update account information and settings</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('accounts.index') }}">Accounts</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('accounts.show', 1) }}">Cash in Hand</a></li>
                        <li class="breadcrumb-item active">Edit Account</li>
                    </ol>
                </nav>
            </div>
            <div>
                <a href="{{ route('accounts.show', 1) }}" class="btn btn-outline-secondary">
                    <i class="las la-times mr-2"></i>Cancel
                </a>
                <button type="submit" form="accountEditForm" class="btn btn-primary ml-2">
                    <i class="las la-save mr-2"></i>Update Account
                </button>
            </div>
        </div>

        <!-- Account Status Alert -->
        <div class="alert alert-info">
            <div class="d-flex align-items-center">
                <i class="las la-info-circle fa-2x mr-3"></i>
                <div>
                    <h6 class="mb-1">Editing Account: <strong>Cash in Hand (1001)</strong></h6>
                    <p class="mb-0">Current Balance: <strong>₹125,000</strong> | Status: <span class="badge badge-success">Active</span></p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form id="accountEditForm" action="{{ route('accounts.update', 1) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <!-- Basic Information -->
                            <div class="form-section">
                                <h6 class="form-section-title">Account Details</h6>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Account Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="account_name" 
                                                   value="Cash in Hand" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Account Code</label>
                                            <input type="text" class="form-control readonly-field" 
                                                   value="1001" readonly>
                                            <small class="form-text text-muted">Account code cannot be changed</small>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Parent Account</label>
                                            <select class="form-control" name="parent_account_id">
                                                <option value="">Select Parent Account</option>
                                                <option value="" selected>-- No Parent (Main Account) --</option>
                                                <optgroup label="Assets">
                                                    <option value="1">Current Assets</option>
                                                    <option value="2">Fixed Assets</option>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Account Type</label>
                                            <select class="form-control" name="account_type_id" required>
                                                <option value="">Select Account Type</option>
                                                <option value="1" selected>Cash</option>
                                                <option value="2">Bank Accounts</option>
                                                <option value="3">Accounts Receivable</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" name="description" rows="3">Main cash register for daily transactions</textarea>
                                </div>
                            </div>
                            
                            <!-- Account Category -->
                            <div class="form-section">
                                <h6 class="form-section-title">Account Category</h6>
                                <p class="text-muted mb-3">Current category: <span class="badge bg-gradient-green">Asset</span></p>
                                
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="account-type-option selected" data-type="asset">
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
                                    
                                    <div class="col-md-3">
                                        <div class="account-type-option" data-type="liability">
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
                                    
                                    <div class="col-md-3">
                                        <div class="account-type-option" data-type="equity">
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
                                    
                                    <div class="col-md-3">
                                        <div class="account-type-option" data-type="revenue">
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
                                </div>
                            </div>
                            
                            <!-- Bank Details -->
                            <div class="form-section">
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
                                <h6 class="form-section-title">Account Settings</h6>
                                
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
                                                       name="is_cash_account" id="isCashAccount" value="1" checked>
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
                                                       name="is_bank_account" id="isBankAccount" value="1">
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
                            
                            <!-- Danger Zone -->
                            <div class="form-section border border-danger">
                                <h6 class="form-section-title text-danger">Danger Zone</h6>
                                
                                <div class="alert alert-warning">
                                    <div class="d-flex align-items-center">
                                        <i class="las la-exclamation-triangle fa-2x mr-3"></i>
                                        <div>
                                            <h6 class="mb-1">Warning: Account Deletion</h6>
                                            <p class="mb-0">Deleting an account will permanently remove it from the system. This action cannot be undone. Make sure there are no transactions associated with this account before deleting.</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">Delete this Account</h6>
                                        <p class="mb-0 text-muted">Once deleted, it cannot be recovered</p>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-danger" onclick="confirmDelete()">
                                            <i class="las la-trash mr-2"></i>Delete Account
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-between mt-4">
                                <button type="button" class="btn btn-outline-secondary" onclick="resetForm()">
                                    <i class="las la-redo mr-2"></i>Reset Changes
                                </button>
                                <div>
                                    <a href="{{ route('accounts.show', 1) }}" class="btn btn-outline-secondary mr-2">
                                        <i class="las la-times mr-2"></i>Cancel
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="las la-save mr-2"></i>Update Account
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Delete Account</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span class="text-white">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-4">
                        <i class="las la-exclamation-triangle fa-4x text-danger"></i>
                    </div>
                    <h5 class="text-center mb-3">Are you sure you want to delete this account?</h5>
                    <div class="alert alert-info">
                        <strong>Account Details:</strong><br>
                        Name: <strong>Cash in Hand</strong><br>
                        Code: <strong>1001</strong><br>
                        Balance: <strong>₹125,000</strong>
                    </div>
                    <p class="text-danger text-center">
                        <strong>Warning:</strong> This action cannot be undone. All account data will be permanently deleted.
                    </p>
                    <div class="form-group">
                        <label>Please type "DELETE" to confirm:</label>
                        <input type="text" class="form-control" id="deleteConfirmation" placeholder="Type DELETE here">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn" disabled>
                        Delete Account
                    </button>
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
            $('#accountEditForm').submit(function(e) {
                e.preventDefault();
                
                // Validation
                const accountName = $('input[name="account_name"]').val().trim();
                if(!accountName) {
                    alert('Please enter account name');
                    $('input[name="account_name"]').focus();
                    return false;
                }
                
                // Show loading
                $('button[type="submit"]').prop('disabled', true).html('<i class="las la-spinner la-spin mr-2"></i>Saving...');
                
                // Collect form data
                const formData = new FormData(this);
                
                // Simulate API call
                setTimeout(() => {
                    console.log('Form data:', Object.fromEntries(formData));
                    alert('Account updated successfully!');
                    window.location.href = "{{ route('accounts.show', 1) }}";
                }, 1500);
                
                return false;
            });
            
            // Delete confirmation input
            $('#deleteConfirmation').on('input', function() {
                const confirmBtn = $('#confirmDeleteBtn');
                if($(this).val().toUpperCase() === 'DELETE') {
                    confirmBtn.prop('disabled', false);
                } else {
                    confirmBtn.prop('disabled', true);
                }
            });
            
            // Confirm delete
            $('#confirmDeleteBtn').click(function() {
                if($('#deleteConfirmation').val().toUpperCase() === 'DELETE') {
                    // Show loading
                    $(this).prop('disabled', true).html('<i class="las la-spinner la-spin mr-2"></i>Deleting...');
                    
                    // Simulate delete API call
                    setTimeout(() => {
                        alert('Account deleted successfully!');
                        window.location.href = "{{ route('accounts.index') }}";
                    }, 1500);
                }
            });
        });
        
        // Show delete confirmation modal
        window.confirmDelete = function() {
            $('#deleteModal').modal('show');
        };
        
        // Reset form to original values
        window.resetForm = function() {
            if(confirm('Are you sure you want to reset all changes?')) {
                // In real app, this would reset form to original values
                // For demo, we'll just reload the form
                $('#accountEditForm')[0].reset();
                alert('Form reset to original values');
            }
        };
        
        // Account type selection
        window.selectAccountType = function(type) {
            // Remove selection from all options
            $('.account-type-option').removeClass('selected');
            
            // Add selection to clicked option
            $(`.account-type-option[data-type="${type}"]`).addClass('selected');
            
            // Update account type dropdown based on selected category
            updateAccountTypes(type);
        };
        
        // Update account types dropdown based on category
        window.updateAccountTypes = function(category) {
            const accountTypes = {
                'asset': [
                    {id: 1, name: 'Cash', code: 'CASH'},
                    {id: 2, name: 'Bank Accounts', code: 'BANK'},
                    {id: 3, name: 'Accounts Receivable', code: 'AR'}
                ],
                'liability': [
                    {id: 4, name: 'Accounts Payable', code: 'AP'},
                    {id: 5, name: 'Loans Payable', code: 'LOANS'}
                ],
                'equity': [
                    {id: 6, name: 'Owner\'s Equity', code: 'EQUITY'},
                    {id: 7, name: 'Retained Earnings', code: 'RETAINED'}
                ],
                'revenue': [
                    {id: 8, name: 'Sales Revenue', code: 'SALES'},
                    {id: 9, name: 'Service Revenue', code: 'SERVICE'}
                ]
            };
            
            const $select = $('select[name="account_type_id"]');
            const currentValue = $select.val();
            $select.empty();
            $select.append('<option value="">Select Account Type</option>');
            
            if(accountTypes[category]) {
                accountTypes[category].forEach(type => {
                    $select.append(new Option(`${type.name} (${type.code})`, type.id));
                });
                
                // Try to restore previous selection
                if(currentValue) {
                    $select.val(currentValue);
                }
            }
        };
    </script>
    @endpush
</x-app-layout>