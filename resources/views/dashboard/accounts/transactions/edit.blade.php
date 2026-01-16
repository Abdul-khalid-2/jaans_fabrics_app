<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/remixicon/fonts/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/flatpickr/dist/flatpickr.min.css') }}">
    <style>
        .transaction-info-box {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
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
            content: "Rs";
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

        .readonly-field {
            background-color: #f8f9fa;
            cursor: not-allowed;
        }

        .audit-trail {
            background: #e9ecef;
            border-radius: 8px;
            padding: 15px;
            margin-top: 20px;
        }

        .reversal-section {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }
    </style>
    @endpush

    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
            <div>
                <h4 class="mb-3">Edit Transaction</h4>
                <p class="mb-0">Update transaction information and details</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('accounts.index') }}">Accounts</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('accounts.transactions.index') }}">Transactions</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('accounts.transactions.show', 1) }}">TRX-20240320-001</a></li>
                        <li class="breadcrumb-item active">Edit Transaction</li>
                    </ol>
                </nav>
            </div>
            <div>
                <a href="{{ route('accounts.transactions.show', 1) }}" class="btn btn-outline-secondary">
                    <i class="las la-times mr-2"></i>Cancel
                </a>
                <button type="submit" form="transactionEditForm" class="btn btn-primary ml-2">
                    <i class="las la-save mr-2"></i>Update Transaction
                </button>
            </div>
        </div>

        <!-- Transaction Information -->
        <div class="transaction-info-box">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="mb-1">Cash Sale</h4>
                    <div class="d-flex align-items-center">
                        <span class="badge badge-light mr-3">TRX-20240320-001</span>
                        <span class="badge badge-success mr-3">Approved</span>
                        <span class="badge bg-gradient-green">Debit Transaction</span>
                    </div>
                    <p class="mb-0 mt-2">Cash sale for clothing items - Invoice #INV-20240320-045</p>
                </div>
                <div class="text-right">
                    <h2 class="mb-0">Rs5,000</h2>
                    <small>March 20, 2024 10:30 AM</small>
                </div>
            </div>
        </div>

        <!-- Reversal Warning (if applicable) -->
        <div class="reversal-section" id="reversalWarning" style="display: none;">
            <div class="d-flex align-items-center">
                <i class="las la-exclamation-triangle fa-2x text-warning mr-3"></i>
                <div>
                    <h6 class="mb-1 text-warning">This transaction has been reversed</h6>
                    <p class="mb-0">Editing a reversed transaction may affect financial reports. Consider creating a new transaction instead.</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form id="transactionEditForm" action="{{ route('accounts.transactions.update', 1) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Basic Information -->
                            <div class="form-section">
                                <h6 class="form-section-title">Transaction Details</h6>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Transaction Date <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control datepicker"
                                                name="transaction_date" value="2024-03-20" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Transaction Time</label>
                                            <input type="time" class="form-control"
                                                name="transaction_time" value="10:30">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Description <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="description"
                                        value="Cash sale - Invoice #INV-20240320-045" required>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Amount <span class="text-danger">*</span></label>
                                            <div class="amount-input-group">
                                                <input type="number" class="form-control" name="amount"
                                                    value="5000" step="0.01" min="0" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Transaction Number</label>
                                            <input type="text" class="form-control readonly-field"
                                                value="TRX-20240320-001" readonly>
                                            <small class="form-text text-muted">Transaction number cannot be changed</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Transaction Type</label>
                                    <select class="form-control" name="transaction_type" id="transactionType">
                                        <option value="debit" selected>Debit</option>
                                        <option value="credit">Credit</option>
                                        <option value="journal">Journal</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Account Information -->
                            <div class="form-section">
                                <h6 class="form-section-title">Account Details</h6>

                                <div class="form-group">
                                    <label class="form-label">Account <span class="text-danger">*</span></label>
                                    <select class="form-control" name="account_id" required>
                                        <option value="">Select Account</option>
                                        <option value="1" selected>Cash in Hand (1001)</option>
                                        <option value="2">Bank Account - HDFC (1002)</option>
                                        <option value="3">Bank Account - ICICI (1003)</option>
                                        <option value="4">Accounts Receivable (1101)</option>
                                    </select>
                                    <div class="account-balance">
                                        Current Balance: Rs125,000 (debit)
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
                                            <select class="form-control" name="reference_type">
                                                <option value="">No Reference</option>
                                                <option value="sale" selected>Sale</option>
                                                <option value="purchase">Purchase</option>
                                                <option value="expense">Expense</option>
                                                <option value="salary">Salary</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Reference ID</label>
                                            <input type="text" class="form-control" name="reference_id"
                                                value="INV-20240320-045">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Reference Details</label>
                                    <textarea class="form-control" name="reference_details" rows="2">Cash sale for clothing items</textarea>
                                </div>
                            </div>

                            <!-- Additional Information -->
                            <div class="form-section">
                                <h6 class="form-section-title">Additional Information</h6>

                                <div class="form-group">
                                    <label class="form-label">Attachments</label>
                                    <div class="mb-2">
                                        <span class="badge badge-light mr-2">
                                            <i class="las la-file-invoice mr-1"></i>invoice_20240320_045.pdf
                                        </span>
                                        <span class="badge badge-light">
                                            <i class="las la-receipt mr-1"></i>receipt_001.jpg
                                        </span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="newAttachments" name="new_attachments[]" multiple>
                                        <label class="custom-file-label" for="newAttachments">Add more files</label>
                                    </div>
                                    <small class="form-text text-muted">Upload additional supporting documents</small>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Internal Notes</label>
                                    <textarea class="form-control" name="notes" rows="3">Cash sale processed during morning shift</textarea>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Status</label>
                                            <select class="form-control" name="status">
                                                <option value="approved" selected>Approved</option>
                                                <option value="pending">Pending Approval</option>
                                                <option value="rejected">Rejected</option>
                                                <option value="reversed">Reversed</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Approved By</label>
                                            <select class="form-control" name="approved_by">
                                                <option value="">Select Approver</option>
                                                <option value="1" selected>Admin User</option>
                                                <option value="2">Accountant</option>
                                                <option value="3">Manager</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Audit Trail -->
                            <div class="audit-trail">
                                <h6 class="mb-3">Audit Trail</h6>
                                <div class="small">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Created by: <strong>Admin User</strong></span>
                                        <span>2024-03-20 10:30 AM</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Last modified by: <strong>Accountant</strong></span>
                                        <span>2024-03-21 09:15 AM</span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span>Approved by: <strong>Admin User</strong></span>
                                        <span>2024-03-20 10:35 AM</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Danger Zone -->
                            <div class="form-section border border-danger mt-4">
                                <h6 class="form-section-title text-danger">Danger Zone</h6>

                                <div class="alert alert-warning">
                                    <div class="d-flex align-items-center">
                                        <i class="las la-exclamation-triangle fa-2x mr-3"></i>
                                        <div>
                                            <h6 class="mb-1">Warning: Transaction Operations</h6>
                                            <p class="mb-0">These operations can affect financial reports and should be performed with caution.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <button type="button" class="btn btn-outline-warning btn-block" onclick="reverseTransaction()">
                                            <i class="las la-exchange-alt mr-2"></i>Reverse
                                        </button>
                                        <small class="form-text text-muted">Create reversing entry</small>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="button" class="btn btn-outline-info btn-block" onclick="duplicateTransaction()">
                                            <i class="las la-copy mr-2"></i>Duplicate
                                        </button>
                                        <small class="form-text text-muted">Create copy</small>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="button" class="btn btn-danger btn-block" onclick="deleteTransaction()">
                                            <i class="las la-trash mr-2"></i>Delete
                                        </button>
                                        <small class="form-text text-muted">Permanent deletion</small>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <button type="button" class="btn btn-outline-secondary" onclick="resetForm()">
                                    <i class="las la-redo mr-2"></i>Reset Changes
                                </button>
                                <div>
                                    <a href="{{ route('accounts.transactions.show', 1) }}" class="btn btn-outline-secondary mr-2">
                                        <i class="las la-times mr-2"></i>Cancel
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="las la-save mr-2"></i>Update Transaction
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reverse Transaction Modal -->
    <div class="modal fade" id="reverseModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title">Reverse Transaction</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-4">
                        <i class="las la-exchange-alt fa-4x text-warning"></i>
                    </div>
                    <h5 class="text-center mb-3">Create Reversing Entry</h5>

                    <div class="alert alert-info">
                        <strong>Transaction Details:</strong><br>
                        Amount: <strong>Rs5,000</strong><br>
                        Account: <strong>Cash in Hand (1001)</strong><br>
                        Type: <strong>Debit</strong>
                    </div>

                    <div class="form-group">
                        <label>Reversal Date</label>
                        <input type="text" class="form-control datepicker" id="reversalDate" value="{{ date('Y-m-d') }}">
                    </div>

                    <div class="form-group">
                        <label>Reversal Reason</label>
                        <select class="form-control" id="reversalReason">
                            <option value="">Select Reason</option>
                            <option value="error">Data Entry Error</option>
                            <option value="duplicate">Duplicate Transaction</option>
                            <option value="cancelled">Cancelled Sale</option>
                            <option value="adjustment">Period Adjustment</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Additional Notes</label>
                        <textarea class="form-control" id="reversalNotes" rows="3" placeholder="Explain why this transaction is being reversed"></textarea>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="createReversalEntry" checked>
                        <label class="custom-control-label" for="createReversalEntry">
                            Create separate reversal transaction
                        </label>
                    </div>
                    <small class="form-text text-muted">Uncheck to only mark as reversed without creating new transaction</small>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-warning" onclick="confirmReversal()">
                        Create Reversal
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Transaction Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Delete Transaction</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span class="text-white">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-4">
                        <i class="las la-trash fa-4x text-danger"></i>
                    </div>
                    <h5 class="text-center mb-3">Are you sure you want to delete this transaction?</h5>

                    <div class="alert alert-danger">
                        <strong>Warning:</strong> This action cannot be undone. The transaction will be permanently deleted from the system.
                    </div>

                    <div class="form-group">
                        <label>Please type "DELETE" to confirm:</label>
                        <input type="text" class="form-control" id="deleteConfirmation" placeholder="Type DELETE here">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn" disabled>
                        Delete Transaction
                    </button>
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

            // Initialize reversal datepicker
            flatpickr("#reversalDate", {
                dateFormat: "Y-m-d",
                defaultDate: "today"
            });

            // File input label
            $('.custom-file-input').on('change', function() {
                let fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').addClass("selected").html(fileName);
            });

            // Form submission
            $('#transactionEditForm').submit(function(e) {
                e.preventDefault();

                // Validation
                const description = $('input[name="description"]').val().trim();
                const amount = $('input[name="amount"]').val();
                const accountId = $('select[name="account_id"]').val();

                if (!description) {
                    alert('Please enter transaction description');
                    $('input[name="description"]').focus();
                    return false;
                }

                if (!amount || parseFloat(amount) <= 0) {
                    alert('Please enter a valid amount');
                    $('input[name="amount"]').focus();
                    return false;
                }

                if (!accountId) {
                    alert('Please select an account');
                    $('select[name="account_id"]').focus();
                    return false;
                }

                // Show loading
                $('button[type="submit"]').prop('disabled', true).html('<i class="las la-spinner la-spin mr-2"></i>Saving...');

                // Collect form data
                const formData = new FormData(this);

                // Simulate API call
                setTimeout(() => {
                    console.log('Form data:', Object.fromEntries(formData));
                    alert('Transaction updated successfully!');
                    window.location.href = "{{ route('accounts.transactions.show', 1) }}";
                }, 1500);

                return false;
            });

            // Delete confirmation input
            $('#deleteConfirmation').on('input', function() {
                const confirmBtn = $('#confirmDeleteBtn');
                if ($(this).val().toUpperCase() === 'DELETE') {
                    confirmBtn.prop('disabled', false);
                } else {
                    confirmBtn.prop('disabled', true);
                }
            });

            // Confirm delete
            $('#confirmDeleteBtn').click(function() {
                if ($('#deleteConfirmation').val().toUpperCase() === 'DELETE') {
                    // Show loading
                    $(this).prop('disabled', true).html('<i class="las la-spinner la-spin mr-2"></i>Deleting...');

                    // Simulate delete API call
                    setTimeout(() => {
                        alert('Transaction deleted successfully!');
                        window.location.href = "{{ route('accounts.transactions.index') }}";
                    }, 1500);
                }
            });
        });

        // Reverse transaction
        window.reverseTransaction = function() {
            $('#reverseModal').modal('show');
        };

        // Confirm reversal
        window.confirmReversal = function() {
            const reversalDate = $('#reversalDate').val();
            const reversalReason = $('#reversalReason').val();
            const reversalNotes = $('#reversalNotes').val();
            const createEntry = $('#createReversalEntry').prop('checked');

            if (!reversalReason) {
                alert('Please select a reversal reason');
                return;
            }

            if (confirm(`Create ${createEntry ? 'reversal transaction' : 'reversal entry'} for this transaction?`)) {
                // Show loading
                $('#reverseModal').modal('hide');

                // Simulate reversal API call
                setTimeout(() => {
                    alert('Transaction reversal created successfully!');
                    $('#reversalWarning').show();
                    $('select[name="status"]').val('reversed');
                }, 1500);
            }
        };

        // Duplicate transaction
        window.duplicateTransaction = function() {
            if (confirm('Create a duplicate of this transaction?')) {
                // In real app: API call to duplicate
                window.location.href = "{{ route('accounts.transactions.create') }}?duplicate=1";
            }
        };

        // Delete transaction
        window.deleteTransaction = function() {
            $('#deleteModal').modal('show');
        };

        // Reset form to original values
        window.resetForm = function() {
            if (confirm('Are you sure you want to reset all changes?')) {
                // In real app, this would reset form to original values
                $('#transactionEditForm')[0].reset();
                $('select[name="account_id"]').val('1');
                $('select[name="status"]').val('approved');
                $('select[name="reference_type"]').val('sale');
                alert('Form reset to original values');
            }
        };

        // Update account balance
        window.updateAccountBalance = function(accountId) {
            const accountBalances = {
                '1': {
                    balance: 125000,
                    type: 'debit'
                },
                '2': {
                    balance: 850000,
                    type: 'debit'
                },
                '3': {
                    balance: 250000,
                    type: 'debit'
                },
                '4': {
                    balance: 150000,
                    type: 'debit'
                }
            };

            const info = $('.account-balance');
            if (accountId && accountBalances[accountId]) {
                const acc = accountBalances[accountId];
                info.text(`Current Balance: Rs${acc.balance.toLocaleString()} (${acc.type} balance)`);
            } else {
                info.text('Select an account to view balance');
            }
        };
    </script>
    @endpush
</x-app-layout>