<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/remixicon/fonts/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/flatpickr/dist/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/select2/dist/css/select2.min.css') }}">
    <style>
        .journal-entry-box {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .entry-item {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            background: #f8f9fa;
            transition: all 0.3s;
        }

        .entry-item.debit {
            border-left: 4px solid #28a745;
        }

        .entry-item.credit {
            border-left: 4px solid #dc3545;
        }

        .amount-input-group {
            position: relative;
        }

        .amount-input-group .form-control {
            padding-left: 40px;
            font-weight: 600;
        }

        .amount-input-group::before {
            content: "Rs";
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            font-weight: 600;
            z-index: 5;
        }
        .balance-check {
            background: #e9ecef;
            border-radius: 8px;
            padding: 15px;
            margin-top: 20px;
            text-align: center;
            font-weight: 600;
        }

        .balance-check.balanced {
            background: #d4edda;
            color: #155724;
            border: 2px solid #28a745;
        }

        .balance-check.unbalanced {
            background: #f8d7da;
            color: #721c24;
            border: 2px solid #dc3545;
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
            padding: 3px 8px;
            background: #e9ecef;
            border-radius: 4px;
            display: inline-block;
        }

        .journal-preview {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
            background: white;
        }

        .preview-table th {
            background: #f8f9fa;
            font-weight: 600;
        }

        .debit-amount {
            color: #28a745;
            font-weight: 600;
        }

        .credit-amount {
            color: #dc3545;
            font-weight: 600;
        }

        .entry-controls {
            position: sticky;
            top: 20px;
            z-index: 100;
        }

        .select2-container .select2-selection--single {
            height: calc(1.5em + 0.75rem + 2px);
            padding: 0.375rem 0.75rem;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 1.5;
        }
    </style>
    @endpush

    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
            <div>
                <h4 class="mb-3">Create Journal Entry</h4>
                <p class="mb-0">Record double-entry transactions (Debits = Credits)</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('accounts.index') }}">Accounts</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('accounts.journal.index') }}">Journal Entries</a></li>
                        <li class="breadcrumb-item active">Create Entry</li>
                    </ol>
                </nav>
            </div>
            <div>
                <a href="{{ route('accounts.journal.index') }}" class="btn btn-outline-secondary">
                    <i class="las la-times mr-2"></i>Cancel
                </a>
                <button type="submit" form="journalCreateForm" class="btn btn-primary ml-2" id="saveButton">
                    <i class="las la-save mr-2"></i>Save Entry
                </button>
            </div>
        </div>

        <!-- Journal Entry Summary -->
        <div class="journal-entry-box">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1" id="previewDescription">New Journal Entry</h5>
                    <p class="mb-0" id="previewJournalNumber">JE-{{ date('YmdHis') }}</p>
                    <small id="previewDate">{{ date('Y-m-d') }}</small>
                </div>
                <div class="text-right">
                    <h4 class="mb-0" id="previewTotal">Rs0.00</h4>
                    <small id="balanceStatus">Enter transaction details</small>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Left Column: Entry Form -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <form id="journalCreateForm" action="{{ route('accounts.journal.entries.store') }}" method="POST">
                            @csrf

                            <!-- Entry Header -->
                            <div class="form-section">
                                <h6 class="form-section-title">Entry Information</h6>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Transaction Date <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control datepicker"
                                                name="transaction_date" id="transactionDate"
                                                value="{{ date('Y-m-d') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Journal Number</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="journal_number"
                                                    id="journalNumber" value="JE-{{ date('YmdHis') }}">
                                                <div class="input-group-append">
                                                    <button type="button" class="btn btn-outline-secondary" onclick="generateJournalNumber()">
                                                        <i class="las la-sync"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Description <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="description" id="entryDescription"
                                        placeholder="e.g., Adjusting entry for depreciation"
                                        oninput="updatePreview('description', this.value)" required>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Branch</label>
                                            <select class="form-control" name="branch_id">
                                                <option value="">All Branches</option>
                                                <option value="1" selected>Main Branch</option>
                                                <option value="2">Downtown Branch</option>
                                                <option value="3">Warehouse</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Status</label>
                                            <select class="form-control" name="status">
                                                <option value="pending" selected>Pending Approval</option>
                                                <option value="approved">Approved</option>
                                                <option value="draft">Draft</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Internal Notes</label>
                                    <textarea class="form-control" name="notes" rows="2"
                                        placeholder="Additional notes about this journal entry"></textarea>
                                </div>
                            </div>

                            <!-- Journal Entry Items -->
                            <div class="form-section">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h6 class="form-section-title mb-0">Journal Entries</h6>
                                    <div>
                                        <button type="button" class="btn btn-sm btn-outline-success mr-2" onclick="addEntry('debit')">
                                            <i class="las la-plus mr-1"></i>Add Debit
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="addEntry('credit')">
                                            <i class="las la-plus mr-1"></i>Add Credit
                                        </button>
                                    </div>
                                </div>

                                <p class="text-muted mb-3">Add at least two entries - total debits must equal total credits</p>

                                <div id="journalItems">
                                    <!-- Entry items will be added here dynamically -->
                                </div>

                                <!-- Totals Display -->
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <div class="card bg-light">
                                            <div class="card-body text-center">
                                                <h6 class="mb-1">Total Debits</h6>
                                                <h3 class="mb-0 text-success" id="totalDebits">Rs0.00</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card bg-light">
                                            <div class="card-body text-center">
                                                <h6 class="mb-1">Total Credits</h6>
                                                <h3 class="mb-0 text-danger" id="totalCredits">Rs0.00</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Balance Check -->
                                <div class="balance-check" id="balanceCheck">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <i class="las la-balance-scale fa-2x"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-1" id="balanceDifference">Difference: Rs0.00</h5>
                                            <p class="mb-0" id="balanceMessage">Add journal entries</p>
                                        </div>
                                        <div>
                                            <button type="button" class="btn btn-outline-primary" onclick="autoBalance()">
                                                <i class="las la-magic mr-1"></i>Auto Balance
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Quick Entry Templates -->
                            <div class="form-section">
                                <h6 class="form-section-title">Quick Templates</h6>
                                <p class="text-muted mb-3">Select a common journal entry template</p>

                                <div class="row">
                                    <div class="col-md-4 mb-2">
                                        <button type="button" class="btn btn-outline-secondary btn-block" onclick="loadTemplate('depreciation')">
                                            <i class="las la-calculator mr-1"></i> Depreciation
                                        </button>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <button type="button" class="btn btn-outline-secondary btn-block" onclick="loadTemplate('salary')">
                                            <i class="las la-users mr-1"></i> Salary Payment
                                        </button>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <button type="button" class="btn btn-outline-secondary btn-block" onclick="loadTemplate('revenue')">
                                            <i class="las la-money-bill-wave mr-1"></i> Revenue Accrual
                                        </button>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <button type="button" class="btn btn-outline-secondary btn-block" onclick="loadTemplate('inventory')">
                                            <i class="las la-boxes mr-1"></i> Inventory Write-off
                                        </button>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <button type="button" class="btn btn-outline-secondary btn-block" onclick="loadTemplate('prepaid')">
                                            <i class="las la-calendar mr-1"></i> Prepaid Expense
                                        </button>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <button type="button" class="btn btn-outline-secondary btn-block" onclick="loadTemplate('interest')">
                                            <i class="las la-percentage mr-1"></i> Interest Accrual
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <button type="button" class="btn btn-outline-secondary" onclick="resetForm()">
                                    <i class="las la-redo mr-2"></i>Reset Form
                                </button>
                                <div>
                                    <button type="button" class="btn btn-outline-success mr-2" onclick="saveDraft()">
                                        <i class="las la-file-download mr-2"></i>Save Draft
                                    </button>
                                    <button type="submit" class="btn btn-primary" id="submitButton">
                                        <i class="las la-save mr-2"></i>Save & Post Entry
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Right Column: Preview & Help -->
            <div class="col-lg-4">
                <div class="entry-controls">
                    <!-- Preview Card -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Entry Preview</h5>
                        </div>
                        <div class="card-body">
                            <div class="journal-preview">
                                <div class="table-responsive">
                                    <table class="table table-sm preview-table">
                                        <thead>
                                            <tr>
                                                <th>Account</th>
                                                <th>Type</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody id="previewTableBody">
                                            <!-- Preview rows will be added here -->
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="2" class="text-right"><strong>Total Debits:</strong></td>
                                                <td class="debit-amount" id="previewDebitTotal">Rs0.00</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="text-right"><strong>Total Credits:</strong></td>
                                                <td class="credit-amount" id="previewCreditTotal">Rs0.00</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Help Card -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Accounting Guide</h5>
                        </div>
                        <div class="card-body">
                            <h6>Double-Entry Rules:</h6>
                            <ul class="small pl-3 mb-3">
                                <li>Every transaction must have at least 2 entries</li>
                                <li>Total Debits must equal Total Credits</li>
                                <li>Assets/Expenses increase with Debits</li>
                                <li>Liabilities/Equity/Revenue increase with Credits</li>
                            </ul>

                            <h6>Common Accounts:</h6>
                            <div class="row small">
                                <div class="col-6">
                                    <strong>Debit Accounts:</strong>
                                    <ul class="pl-3 mb-0">
                                        <li>Assets ↑</li>
                                        <li>Expenses ↑</li>
                                        <li>Drawings ↑</li>
                                    </ul>
                                </div>
                                <div class="col-6">
                                    <strong>Credit Accounts:</strong>
                                    <ul class="pl-3 mb-0">
                                        <li>Liabilities ↑</li>
                                        <li>Equity ↑</li>
                                        <li>Revenue ↑</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="mt-3">
                                <button type="button" class="btn btn-sm btn-outline-info btn-block" data-toggle="modal" data-target="#helpModal">
                                    <i class="las la-question-circle mr-1"></i> More Help
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Help Modal -->
    <div class="modal fade" id="helpModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Journal Entry Help</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Help content -->
                </div>
            </div>
        </div>
    </div>

    @push('js')
    <!-- Backend Bundle JavaScript -->
    <script src="{{ asset('backend/assets/js/backend-bundle.min.js') }}"></script>

    <!-- Select2 -->
    <script src="{{ asset('backend/assets/vendor/select2/dist/js/select2.min.js') }}"></script>

    <!-- Flatpickr -->
    <script src="{{ asset('backend/assets/vendor/flatpickr/dist/flatpickr.min.js') }}"></script>

    <!-- app JavaScript -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Initialize datepicker
            flatpickr('.datepicker', {
                dateFormat: 'Y-m-d',
                defaultDate: 'today'
            });

            // Initialize Select2 for account selection
            $(document).on('select2:open', () => {
                document.querySelector('.select2-search__field').focus();
            });

            // Initialize first two entries
            addEntry('debit');
            addEntry('credit');

            // Update totals when page loads
            updateTotals();

            // Form submission
            $('#journalCreateForm').submit(function(e) {
                e.preventDefault();

                // Validation
                if (!validateJournalEntry()) {
                    return false;
                }

                // Show loading
                $('#submitButton').prop('disabled', true).html('<i class="las la-spinner la-spin mr-2"></i>Saving...');

                // Collect form data
                const formData = new FormData(this);
                const entries = [];

                // Collect entry items
                $('.entry-item').each(function(index) {
                    const entry = {
                        account_id: $(this).find('.account-select').val(),
                        type: $(this).find('.entry-type').val(),
                        amount: $(this).find('.amount-input').val(),
                        description: $(this).find('input[name$="[description]"]').val()
                    };
                    entries.push(entry);
                });

                // Add entries to form data
                formData.append('entries', JSON.stringify(entries));

                // Simulate API call
                setTimeout(() => {
                    console.log('Journal entry data:', Object.fromEntries(formData));
                    alert('Journal entry created successfully!');
                    window.location.href = "{{ route('accounts.journal.index') }}";
                }, 1500);

                return false;
            });

            // Update preview when date changes
            $('#transactionDate').on('change', function() {
                updatePreview('date', $(this).val());
            });
        });

        let entryCounter = 0;

        // Add new journal entry
        window.addEntry = function(type) {
            const index = entryCounter++;
            const isDebit = type === 'debit';

            const entryHtml = `
                <div class="entry-item ${type}" data-index="${index}">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="form-label">Account <span class="text-danger">*</span></label>
                                <select class="form-control account-select" name="items[${index}][account_id]" required>
                                    <option value="">Select Account</option>
                                    <optgroup label="Assets">
                                        <option value="1">Cash in Hand (1001)</option>
                                        <option value="2">Bank Account - HDFC (1002)</option>
                                        <option value="3">Accounts Receivable (1101)</option>
                                        <option value="4">Inventory (1201)</option>
                                    </optgroup>
                                    <optgroup label="Liabilities">
                                        <option value="5">Accounts Payable (2001)</option>
                                        <option value="6">Loans Payable (2002)</option>
                                        <option value="7">Tax Payable (2003)</option>
                                    </optgroup>
                                    <optgroup label="Equity">
                                        <option value="8">Owner's Equity (3001)</option>
                                        <option value="9">Retained Earnings (3002)</option>
                                    </optgroup>
                                    <optgroup label="Revenue">
                                        <option value="10">Sales Revenue (4001)</option>
                                        <option value="11">Service Revenue (4002)</option>
                                    </optgroup>
                                    <optgroup label="Expenses">
                                        <option value="12">Salaries Expense (5001)</option>
                                        <option value="13">Rent Expense (5002)</option>
                                        <option value="14">Utilities Expense (5003)</option>
                                        <option value="15">Depreciation Expense (5004)</option>
                                    </optgroup>
                                </select>
                                <div class="account-balance" id="balance_${index}">
                                    Select an account to view balance
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Type <span class="text-danger">*</span></label>
                                <select class="form-control entry-type" name="items[${index}][type]" required>
                                    <option value="debit" ${isDebit ? 'selected' : ''}>Debit</option>
                                    <option value="credit" ${!isDebit ? 'selected' : ''}>Credit</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Amount <span class="text-danger">*</span></label>
                                <div class="amount-input-group">
                                    <input type="number" class="form-control amount-input" 
                                           name="items[${index}][amount]" value="${isDebit ? '10000' : '10000'}" 
                                           step="0.01" min="0" required
                                           oninput="updateTotals()">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label class="form-label">&nbsp;</label>
                                <button type="button" class="btn btn-outline-danger btn-block" onclick="removeEntry(${index})">
                                    <i class="las la-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Description</label>
                        <input type="text" class="form-control" name="items[${index}][description]" 
                               placeholder="Entry description" oninput="updatePreview()">
                    </div>
                </div>
            `;

            $('#journalItems').append(entryHtml);

            // Initialize Select2 for new select
            $(`[name="items[${index}][account_id]"]`).select2({
                placeholder: 'Select Account',
                allowClear: true,
                width: '100%'
            }).on('change', function() {
                updateAccountBalance(index, $(this).val());
                updatePreview();
            });

            // Initialize event listeners
            $(`[name="items[${index}][type]"]`).on('change', function() {
                $(`.entry-item[data-index="${index}"]`).removeClass('debit credit')
                    .addClass($(this).val());
                updateTotals();
                updatePreview();
            });

            updateTotals();
            updatePreview();
        };

        // Remove journal entry
        window.removeEntry = function(index) {
            if ($('.entry-item').length <= 2) {
                alert('Journal entry must have at least two entries');
                return;
            }

            $(`.entry-item[data-index="${index}"]`).remove();
            updateTotals();
            updatePreview();
        };

        // Update account balance display
        window.updateAccountBalance = function(index, accountId) {
            // Mock account balances
            const balances = {
                '1': 'Rs125,000 (Debit)',
                '2': 'Rs850,000 (Debit)',
                '3': 'Rs250,000 (Debit)',
                '4': 'Rs500,000 (Debit)',
                '5': 'Rs150,000 (Credit)',
                '6': 'Rs300,000 (Credit)',
                '7': 'Rs50,000 (Credit)',
                '8': 'Rs400,000 (Credit)',
                '9': 'Rs200,000 (Credit)',
                '10': 'Rs1,200,000 (Credit)',
                '11': 'Rs300,000 (Credit)',
                '12': 'Rs250,000 (Debit)',
                '13': 'Rs120,000 (Debit)',
                '14': 'Rs60,000 (Debit)',
                '15': 'Rs40,000 (Debit)'
            };

            const balanceElement = $(`#balance_${index}`);
            if (accountId && balances[accountId]) {
                balanceElement.text(`Balance: ${balances[accountId]}`).addClass('text-primary');
            } else {
                balanceElement.text('Select an account to view balance').removeClass('text-primary');
            }
        };

        // Update totals and balance check
        window.updateTotals = function() {
            let totalDebits = 0;
            let totalCredits = 0;

            $('.entry-item').each(function() {
                const amount = parseFloat($(this).find('.amount-input').val()) || 0;
                const type = $(this).find('.entry-type').val();

                if (type === 'debit') {
                    totalDebits += amount;
                } else {
                    totalCredits += amount;
                }
            });

            // Update display
            $('#totalDebits').text('Rs' + totalDebits.toFixed(2));
            $('#totalCredits').text('Rs' + totalCredits.toFixed(2));
            $('#previewDebitTotal').text('Rs' + totalDebits.toFixed(2));
            $('#previewCreditTotal').text('Rs' + totalCredits.toFixed(2));

            // Update preview total
            const total = Math.max(totalDebits, totalCredits);
            $('#previewTotal').text('Rs' + total.toFixed(2));

            // Check balance
            const difference = Math.abs(totalDebits - totalCredits);
            const balanceCheck = $('#balanceCheck');
            const balanceMessage = $('#balanceMessage');
            const balanceDifference = $('#balanceDifference');
            const saveButton = $('#saveButton');

            if (difference === 0 && totalDebits > 0 && totalCredits > 0) {
                balanceCheck.removeClass('unbalanced').addClass('balanced');
                balanceMessage.text('✓ Journal entry is balanced').addClass('text-success');
                balanceDifference.text('Difference: Rs0.00').addClass('text-success');
                saveButton.prop('disabled', false);
            } else if (totalDebits === 0 && totalCredits === 0) {
                balanceCheck.removeClass('balanced unbalanced');
                balanceMessage.text('Add journal entries').removeClass('text-success text-danger');
                balanceDifference.text('Difference: Rs0.00');
                saveButton.prop('disabled', true);
            } else {
                balanceCheck.removeClass('balanced').addClass('unbalanced');
                balanceMessage.text('✗ Debits and Credits do not match').addClass('text-danger');
                balanceDifference.text(`Difference: Rs${difference.toFixed(2)}`).addClass('text-danger');
                saveButton.prop('disabled', true);
            }

            updatePreview();
        };

        // Auto-balance the journal entry
        window.autoBalance = function() {
            let totalDebits = 0;
            let totalCredits = 0;

            $('.entry-item').each(function() {
                const amount = parseFloat($(this).find('.amount-input').val()) || 0;
                const type = $(this).find('.entry-type').val();

                if (type === 'debit') {
                    totalDebits += amount;
                } else {
                    totalCredits += amount;
                }
            });

            const difference = totalDebits - totalCredits;

            if (difference !== 0) {
                // Find the last entry and adjust it
                const lastEntry = $('.entry-item').last();
                const currentAmount = parseFloat(lastEntry.find('.amount-input').val()) || 0;
                const newAmount = Math.abs(currentAmount + difference);

                lastEntry.find('.amount-input').val(newAmount.toFixed(2));
                updateTotals();

                alert(`Adjusted last entry to balance the journal. New amount: Rs${newAmount.toFixed(2)}`);
            }
        };

        // Update preview
        window.updatePreview = function(type, value) {
            if (type === 'description') {
                $('#previewDescription').text(value || 'New Journal Entry');
            } else if (type === 'date') {
                $('#previewDate').text(value);
            }

            // Update preview table
            const previewBody = $('#previewTableBody');
            previewBody.empty();

            $('.entry-item').each(function() {
                const accountSelect = $(this).find('.account-select');
                const accountText = accountSelect.find('option:selected').text() || 'Select Account';
                const type = $(this).find('.entry-type').val();
                const amount = parseFloat($(this).find('.amount-input').val()) || 0;
                const description = $(this).find('input[name$="[description]"]').val() || '';

                const rowHtml = `
                    <tr>
                        <td>
                            <div class="small">${accountText.split('(')[0].trim()}</div>
                            ${description ? `<small class="text-muted">${description}</small>` : ''}
                        </td>
                        <td>
                            <span class="badge ${type === 'debit' ? 'badge-success' : 'badge-danger'}">
                                ${type === 'debit' ? 'Debit' : 'Credit'}
                            </span>
                        </td>
                        <td class="${type === 'debit' ? 'debit-amount' : 'credit-amount'}">
                            Rs${amount.toFixed(2)}
                        </td>
                    </tr>
                `;

                previewBody.append(rowHtml);
            });
        };

        // Generate journal number
        window.generateJournalNumber = function() {
            const timestamp = Date.now().toString();
            const code = 'JE-' + timestamp.slice(-12);
            $('#journalNumber').val(code);
            $('#previewJournalNumber').text(code);
        };

        // Load template
        window.loadTemplate = function(template) {
            if (confirm('Load template? This will replace current entries.')) {
                // Clear existing entries
                $('.entry-item').remove();
                entryCounter = 0;

                switch (template) {
                    case 'depreciation':
                        // Depreciation entry
                        addEntry('debit');
                        $('.entry-item:last .account-select').val('15').trigger('change');
                        $('.entry-item:last .amount-input').val('10000');
                        $('.entry-item:last input[name$="[description]"]').val('Monthly depreciation');

                        addEntry('credit');
                        $('.entry-item:last .account-select').val('4').trigger('change');
                        $('.entry-item:last .amount-input').val('10000');
                        $('.entry-item:last input[name$="[description]"]').val('Accumulated depreciation');

                        $('#entryDescription').val('Monthly depreciation on equipment');
                        break;

                    case 'salary':
                        // Salary payment
                        addEntry('debit');
                        $('.entry-item:last .account-select').val('12').trigger('change');
                        $('.entry-item:last .amount-input').val('250000');
                        $('.entry-item:last input[name$="[description]"]').val('March salary expense');

                        addEntry('credit');
                        $('.entry-item:last .account-select').val('2').trigger('change');
                        $('.entry-item:last .amount-input').val('250000');
                        $('.entry-item:last input[name$="[description]"]').val('Bank payment');

                        $('#entryDescription').val('Salary payment for March');
                        break;

                        // Add more templates...
                }

                updateTotals();
                updatePreview();
            }
        };

        // Save as draft
        window.saveDraft = function() {
            if (confirm('Save as draft?')) {
                // In real app: Save to database with draft status
                alert('Journal entry saved as draft');
            }
        };

        // Reset form
        window.resetForm = function() {
            if (confirm('Reset all entries? This cannot be undone.')) {
                // Clear all entries
                $('.entry-item').remove();
                entryCounter = 0;

                // Reset form fields
                $('#journalCreateForm')[0].reset();
                generateJournalNumber();
                $('#transactionDate').val('{{ date("Y-m-d") }}');

                // Add default entries
                addEntry('debit');
                addEntry('credit');

                updateTotals();
                updatePreview();
            }
        };

        // Validate journal entry
        window.validateJournalEntry = function() {
            const entries = $('.entry-item');

            if (entries.length < 2) {
                alert('Journal entry must have at least two entries');
                return false;
            }

            let hasErrors = false;
            entries.each(function() {
                const account = $(this).find('.account-select').val();
                const amount = $(this).find('.amount-input').val();

                if (!account) {
                    alert('Please select an account for all entries');
                    hasErrors = true;
                    return false;
                }

                if (!amount || parseFloat(amount) <= 0) {
                    alert('Please enter a valid amount for all entries');
                    hasErrors = true;
                    return false;
                }
            });

            if (hasErrors) return false;

            // Check if balanced
            const totalDebits = parseFloat($('#totalDebits').text().replace('Rs', '')) || 0;
            const totalCredits = parseFloat($('#totalCredits').text().replace('Rs', '')) || 0;

            if (Math.abs(totalDebits - totalCredits) > 0.01) {
                alert('Journal entry is not balanced. Total debits must equal total credits.');
                return false;
            }

            return true;
        };
    </script>
    @endpush
</x-app-layout>