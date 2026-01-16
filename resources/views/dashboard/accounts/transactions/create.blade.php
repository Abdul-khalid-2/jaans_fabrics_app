<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/remixicon/fonts/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/flatpickr/dist/flatpickr.min.css') }}">
    <style>
        .transaction-type-btn {
            min-width: 100px;
        }
        .amount-input-group {
            position: relative;
        }
        .amount-input-group .form-control {
            padding-left: 40px;
            font-size: 1.5rem;
            font-weight: 600;
        }
        .amount-input-group::before {
            content: "₹";
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1.5rem;
            font-weight: 600;
            z-index: 5;
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
        .account-balance {
            font-size: 0.9rem;
            color: #6c757d;
            margin-top: 5px;
        }
        .account-balance.positive {
            color: #28a745;
        }
        .account-balance.negative {
            color: #dc3545;
        }
        .reference-badge {
            font-size: 0.8rem;
            padding: 5px 10px;
            border-radius: 20px;
            background: #e9ecef;
            cursor: pointer;
        }
        .reference-badge:hover {
            background: #dee2e6;
        }
        .transaction-preview {
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
                <h4 class="mb-3">Create Transaction</h4>
                <p class="mb-0">Record a new financial transaction</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('accounts.index') }}">Accounts</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('accounts.transactions.index') }}">Transactions</a></li>
                        <li class="breadcrumb-item active">Create Transaction</li>
                    </ol>
                </nav>
            </div>
            <div>
                <a href="{{ route('accounts.transactions.index') }}" class="btn btn-outline-secondary">
                    <i class="las la-times mr-2"></i>Cancel
                </a>
                <button type="submit" form="transactionCreateForm" class="btn btn-primary ml-2">
                    <i class="las la-save mr-2"></i>Save Transaction
                </button>
            </div>
        </div>

        <!-- Transaction Preview -->
        <div class="transaction-preview">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1" id="previewDescription">New Transaction</h5>
                    <p class="mb-0" id="previewDetails">Enter transaction details</p>
                </div>
                <div class="text-right">
                    <h3 class="mb-0" id="previewAmount">₹0.00</h3>
                    <small id="previewType">Debit Transaction</small>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form id="transactionCreateForm" action="{{ route('accounts.transactions.store') }}" method="POST">
                            @csrf
                            
                            <!-- Transaction Type Selection -->
                            <div class="form-section">
                                <h6 class="form-section-title">Transaction Type</h6>
                                
                                <div class="btn-group btn-group-toggle w-100 mb-4" data-toggle="buttons">
                                    <label class="btn btn-outline-success transaction-type-btn active">
                                        <input type="radio" name="transaction_type" value="debit" checked> 
                                        <i class="las la-arrow-down mr-2"></i> Debit
                                    </label>
                                    <label class="btn btn-outline-danger transaction-type-btn">
                                        <input type="radio" name="transaction_type" value="credit"> 
                                        <i class="las la-arrow-up mr-2"></i> Credit
                                    </label>
                                    <label class="btn btn-outline-info transaction-type-btn">
                                        <input type="radio" name="transaction_type" value="journal"> 
                                        <i class="las la-exchange-alt mr-2"></i> Journal
                                    </label>
                                </div>
                                
                                <div class="alert alert-info" id="typeExplanation">
                                    <i class="las la-info-circle mr-2"></i>
                                    <strong>Debit:</strong> Increases asset/expense accounts, decreases liability/equity/revenue accounts
                                </div>
                            </div>
                            
                            <!-- Basic Information -->
                            <div class="form-section">
                                <h6 class="form-section-title">Transaction Details</h6>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Transaction Date <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control datepicker" 
                                                   name="transaction_date" value="{{ date('Y-m-d') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Transaction Time</label>
                                            <input type="time" class="form-control" 
                                                   name="transaction_time" value="{{ date('H:i') }}">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label">Description <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="description" 
                                           placeholder="Enter transaction description" required
                                           oninput="updatePreview('description', this.value)">
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Amount <span class="text-danger">*</span></label>
                                            <div class="amount-input-group">
                                                <input type="number" class="form-control" name="amount" 
                                                       placeholder="0.00" step="0.01" min="0" required
                                                       oninput="updatePreview('amount', this.value)">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Transaction Number</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="transaction_number" 
                                                       value="TRX-{{ date('YmdHis') }}" readonly>
                                                <div class="input-group-append">
                                                    <button type="button" class="btn btn-outline-secondary" onclick="generateTransactionNumber()">
                                                        <i class="las la-sync"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Account Selection -->
                            <div class="form-section">
                                <h6 class="form-section-title">Account Details</h6>
                                
                                <div class="form-group">
                                    <label class="form-label">Account <span class="text-danger">*</span></label>
                                    <select class="form-control" name="account_id" id="accountSelect" required
                                            onchange="updateAccountBalance(this.value)">
                                        <option value="">Select Account</option>
                                        <optgroup label="Cash & Bank">
                                            <option value="1">Cash in Hand (1001)</option>
                                            <option value="2">Bank Account - HDFC (1002)</option>
                                            <option value="3">Bank Account - ICICI (1003)</option>
                                        </optgroup>
                                        <optgroup label="Receivables">
                                            <option value="4">Accounts Receivable (1101)</option>
                                            <option value="5">Customer Advances (1102)</option>
                                        </optgroup>
                                        <optgroup label="Payables">
                                            <option value="6">Accounts Payable (2001)</option>
                                            <option value="7">Supplier Advances (2002)</option>
                                        </optgroup>
                                        <optgroup label="Expenses">
                                            <option value="8">Salaries Expense (5001)</option>
                                            <option value="9">Rent Expense (5002)</option>
                                            <option value="10">Utilities Expense (5003)</option>
                                        </optgroup>
                                    </select>
                                    <div class="account-balance" id="accountBalanceInfo">
                                        Select an account to view balance
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label">Branch</label>
                                    <select class="form-control" name="branch_id">
                                        <option value="">All Branches</option>
                                        <option value="1" selected>Main Branch</option>
                                        <option value="2">Downtown Branch</option>
                                    </select>
                                </div>
                            </div>
                            
                            <!-- Reference Information -->
                            <div class="form-section">
                                <h6 class="form-section-title">Reference Information</h6>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Reference Type</label>
                                            <select class="form-control" name="reference_type" id="referenceType">
                                                <option value="">No Reference</option>
                                                <option value="sale">Sale</option>
                                                <option value="purchase">Purchase</option>
                                                <option value="expense">Expense</option>
                                                <option value="salary">Salary</option>
                                                <option value="payment">Payment</option>
                                                <option value="receipt">Receipt</option>
                                                <option value="transfer">Transfer</option>
                                                <option value="adjustment">Adjustment</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Reference ID</label>
                                            <input type="text" class="form-control" name="reference_id" 
                                                   placeholder="Enter reference ID" id="referenceId">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <small class="text-muted">Quick References:</small>
                                    <div class="mt-2">
                                        <span class="reference-badge mr-2" onclick="setReference('sale', 'INV-20240320-045')">
                                            Sale: INV-20240320-045
                                        </span>
                                        <span class="reference-badge mr-2" onclick="setReference('purchase', 'PUR-20240315-012')">
                                            Purchase: PUR-20240315-012
                                        </span>
                                        <span class="reference-badge" onclick="setReference('expense', 'EXP-20240318-003')">
                                            Expense: EXP-20240318-003
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label">Reference Details</label>
                                    <textarea class="form-control" name="reference_details" rows="2" 
                                              placeholder="Additional reference information"></textarea>
                                </div>
                            </div>
                            
                            <!-- Additional Information -->
                            <div class="form-section">
                                <h6 class="form-section-title">Additional Information</h6>
                                
                                <div class="form-group">
                                    <label class="form-label">Attachments</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="attachments" name="attachments[]" multiple>
                                        <label class="custom-file-label" for="attachments">Choose files</label>
                                    </div>
                                    <small class="form-text text-muted">Upload supporting documents (max 5 files, 2MB each)</small>
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label">Internal Notes</label>
                                    <textarea class="form-control" name="notes" rows="3" 
                                              placeholder="Internal notes and comments"></textarea>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Status</label>
                                            <select class="form-control" name="status">
                                                <option value="approved" selected>Approved</option>
                                                <option value="pending">Pending Approval</option>
                                                <option value="draft">Draft</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Approved By</label>
                                            <select class="form-control" name="approved_by">
                                                <option value="">Select Approver</option>
                                                <option value="1">Admin User</option>
                                                <option value="2">Accountant</option>
                                                <option value="3">Manager</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Recurring Transaction (Optional) -->
                            <div class="form-section">
                                <h6 class="form-section-title">Recurring Transaction</h6>
                                
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" 
                                               name="is_recurring" id="isRecurring" value="1">
                                        <label class="custom-control-label" for="isRecurring">
                                            This is a recurring transaction
                                        </label>
                                    </div>
                                </div>
                                
                                <div id="recurringOptions" style="display: none;">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Frequency</label>
                                                <select class="form-control" name="recurring_frequency">
                                                    <option value="daily">Daily</option>
                                                    <option value="weekly">Weekly</option>
                                                    <option value="monthly" selected>Monthly</option>
                                                    <option value="quarterly">Quarterly</option>
                                                    <option value="yearly">Yearly</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">End Date</label>
                                                <input type="text" class="form-control datepicker" 
                                                       name="recurring_end_date" placeholder="Select end date">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="form-label">Number of Occurrences</label>
                                        <input type="number" class="form-control" name="recurring_occurrences" 
                                               min="1" max="120" value="12">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-between mt-4">
                                <button type="button" class="btn btn-outline-secondary" onclick="resetForm()">
                                    <i class="las la-redo mr-2"></i>Reset Form
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="las la-save mr-2"></i>Save Transaction
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
    
    <!-- Flatpickr -->
    <script src="{{ asset('backend/assets/vendor/flatpickr/dist/flatpickr.min.js') }}"></script>
    
    <!-- app JavaScript -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    
    <script>
        $(document).ready(function() {
            // Initialize datepicker
            flatpickr(".datepicker", {
                dateFormat: "Y-m-d",
                defaultDate: "today"
            });
            
            // Transaction type change
            $('input[name="transaction_type"]').change(function() {
                updateTransactionTypeExplanation(this.value);
                updatePreview('type', this.value);
            });
            
            // Recurring transaction toggle
            $('#isRecurring').change(function() {
                if(this.checked) {
                    $('#recurringOptions').slideDown();
                } else {
                    $('#recurringOptions').slideUp();
                }
            });
            
            // File input label
            $('.custom-file-input').on('change', function() {
                let fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').addClass("selected").html(fileName);
            });
            
            // Form submission
            $('#transactionCreateForm').submit(function(e) {
                e.preventDefault();
                
                // Validation
                const description = $('input[name="description"]').val().trim();
                const amount = $('input[name="amount"]').val();
                const accountId = $('#accountSelect').val();
                const transactionType = $('input[name="transaction_type"]:checked').val();
                
                if(!description) {
                    alert('Please enter transaction description');
                    $('input[name="description"]').focus();
                    return false;
                }
                
                if(!amount || parseFloat(amount) <= 0) {
                    alert('Please enter a valid amount');
                    $('input[name="amount"]').focus();
                    return false;
                }
                
                if(!accountId) {
                    alert('Please select an account');
                    $('#accountSelect').focus();
                    return false;
                }
                
                // Confirm large transactions
                if(parseFloat(amount) > 100000) {
                    if(!confirm(`This is a large transaction (₹${parseFloat(amount).toLocaleString()}). Continue?`)) {
                        return false;
                    }
                }
                
                // Show loading
                $('button[type="submit"]').prop('disabled', true).html('<i class="las la-spinner la-spin mr-2"></i>Saving...');
                
                // Collect form data
                const formData = new FormData(this);
                
                // Simulate API call
                setTimeout(() => {
                    console.log('Form data:', Object.fromEntries(formData));
                    alert('Transaction created successfully!');
                    window.location.href = "{{ route('accounts.transactions.index') }}";
                }, 1500);
                
                return false;
            });
        });
        
        // Update transaction type explanation
        window.updateTransactionTypeExplanation = function(type) {
            const explanations = {
                'debit': '<strong>Debit:</strong> Increases asset/expense accounts, decreases liability/equity/revenue accounts',
                'credit': '<strong>Credit:</strong> Decreases asset/expense accounts, increases liability/equity/revenue accounts',
                'journal': '<strong>Journal Entry:</strong> Records both debit and credit sides of a transaction'
            };
            $('#typeExplanation').html(`<i class="las la-info-circle mr-2"></i>${explanations[type] || ''}`);
        };
        
        // Update account balance information
        window.updateAccountBalance = function(accountId) {
            const accountBalances = {
                '1': { balance: 125000, type: 'debit' },
                '2': { balance: 850000, type: 'debit' },
                '3': { balance: 250000, type: 'debit' },
                '4': { balance: 150000, type: 'debit' },
                '5': { balance: 50000, type: 'credit' },
                '6': { balance: 200000, type: 'credit' },
                '7': { balance: 75000, type: 'credit' },
                '8': { balance: 0, type: 'debit' },
                '9': { balance: 0, type: 'debit' },
                '10': { balance: 0, type: 'debit' }
            };
            
            const info = $('#accountBalanceInfo');
            if(accountId && accountBalances[accountId]) {
                const acc = accountBalances[accountId];
                const balanceText = `Balance: ₹${acc.balance.toLocaleString()} (${acc.type} balance)`;
                info.text(balanceText);
                info.removeClass('positive negative');
                if(acc.balance > 0) {
                    info.addClass('positive');
                } else if(acc.balance < 0) {
                    info.addClass('negative');
                }
            } else {
                info.text('Select an account to view balance');
                info.removeClass('positive negative');
            }
        };
        
        // Set reference from quick badges
        window.setReference = function(type, id) {
            $('#referenceType').val(type);
            $('#referenceId').val(id);
            
            // Update preview
            updatePreview('reference', `${type}: ${id}`);
        };
        
        // Generate transaction number
        window.generateTransactionNumber = function() {
            const timestamp = Date.now().toString();
            const number = 'TRX-' + timestamp.slice(-14);
            $('input[name="transaction_number"]').val(number);
        };
        
        // Update preview
        window.updatePreview = function(type, value) {
            switch(type) {
                case 'description':
                    $('#previewDescription').text(value || 'New Transaction');
                    break;
                case 'amount':
                    $('#previewAmount').text('₹' + (parseFloat(value || 0).toFixed(2)));
                    break;
                case 'type':
                    const typeNames = {
                        'debit': 'Debit Transaction',
                        'credit': 'Credit Transaction',
                        'journal': 'Journal Entry'
                    };
                    $('#previewType').text(typeNames[value] || 'Transaction');
                    break;
                case 'reference':
                    $('#previewDetails').text(value || 'Enter transaction details');
                    break;
            }
        };
        
        // Reset form
        window.resetForm = function() {
            if(confirm('Are you sure you want to reset the form? All data will be lost.')) {
                $('#transactionCreateForm')[0].reset();
                updateTransactionTypeExplanation('debit');
                updatePreview('description', '');
                updatePreview('amount', '0.00');
                updatePreview('type', 'debit');
                updatePreview('reference', '');
                $('#recurringOptions').hide();
                $('.custom-file-label').text('Choose files');
                generateTransactionNumber();
            }
        };
    </script>
    @endpush
</x-app-layout>