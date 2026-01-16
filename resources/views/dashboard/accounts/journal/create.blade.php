<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/remixicon/fonts/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/flatpickr/dist/flatpickr.min.css') }}">
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
            content: "₹";
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
        }
        .balance-check.balanced {
            background: #d4edda;
            color: #155724;
        }
        .balance-check.unbalanced {
            background: #f8d7da;
            color: #721c24;
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
        .journal-preview {
            border: 1px solid #dee2e6;
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
                <button type="submit" form="journalCreateForm" class="btn btn-primary ml-2">
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
                </div>
                <div class="text-right">
                    <h4 class="mb-0" id="previewTotal">₹0.00</h4>
                    <small id="balanceStatus">Enter transaction details</small>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
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
                                                   name="transaction_date" value="{{ date('Y-m-d') }}" required>
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
                                    <input type="text" class="form-control" name="description" 
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
                                <h6 class="form-section-title">Journal Entries (Debits & Credits)</h6>
                                <p class="text-muted mb-3">Add at least two entries - total debits must equal total credits</p>
                                
                                <div id="journalItems">
                                    <!-- Entry Item 1 (Debit) -->
                                    <div class="entry-item debit" data-index="0">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label class="form-label">Account <span class="text-danger">*</span></label>
                                                    <select class="form-control account-select" name="items[0][account_id]" required>
                                                        <option value="">Select Account</option>
                                                        <optgroup label="Expenses">
                                                            <option value="8">Salaries Expense (5001)</option>
                                                            <option value="9">Rent Expense (5002)</option>
                                                            <option value="10">Utilities Expense (5003)</option>
                                                            <option value="11" selected>Depreciation Expense (5004)</option>
                                                        </optgroup>
                                                        <optgroup label="Assets">
                                                            <option value="1">Cash in Hand (1001)</option>
                                                            <option value="2">Bank Account - HDFC (1002)</option>
                                                        </optgroup>
                                                    </select>
                                                    <div class="account-balance" id="balance_0">
                                                        Select an account to view balance
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label">Type <span class="text-danger">*</span></label>
                                                    <select class="form-control entry-type" name="items[0][type]" required>
                                                        <option value="debit" selected>Debit</option>
                                                        <option value="credit">Credit</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label">Amount <span class="text-danger">*</span></label>
                                                    <div class="amount-input-group">
                                                        <input type="number" class="form-control amount-input" 
                                                               name="items[0][amount]" value="10000" step="0.01" min="0" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label class="form-label">&nbsp;</label>
                                                    <button type="button" class="btn btn-outline-danger btn-block" onclick="removeEntry(0)">
                                                        <i class="las la-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Description</label>
                                            <input type="text" class="form-control" name="items[0][description]" 
                                                   placeholder="Entry description" value="