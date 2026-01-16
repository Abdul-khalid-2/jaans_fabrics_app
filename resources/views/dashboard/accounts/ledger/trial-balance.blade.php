<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/remixicon/fonts/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/flatpickr/dist/flatpickr.min.css') }}">
    <style>
        .trial-balance-card {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 30px;
        }
        .tb-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
        }
        .tb-section {
            padding: 20px;
            border-bottom: 1px solid #dee2e6;
        }
        .tb-section:last-child {
            border-bottom: none;
        }
        .tb-row {
            display: flex;
            border-bottom: 1px solid #f8f9fa;
            transition: background-color 0.2s;
        }
        .tb-row:hover {
            background-color: #f8f9fa;
        }
        .tb-row.header {
            background: #f8f9fa;
            font-weight: 600;
            border-bottom: 2px solid #dee2e6;
        }
        .tb-cell {
            padding: 10px 15px;
        }
        .tb-cell.account {
            flex: 2;
        }
        .tb-cell.debit, .tb-cell.credit {
            flex: 1;
            text-align: right;
        }
        .tb-total {
            background: #e9ecef;
            font-weight: 600;
            padding: 15px;
            border-top: 2px solid #dee2e6;
        }
        .balanced-badge {
            background: #28a745;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
        }
        .unbalanced-badge {
            background: #dc3545;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
        }
        .filter-card {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .summary-card {
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
            padding: 20px;
        }
        .summary-card h3 {
            margin-bottom: 5px;
        }
    </style>
    @endpush

    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
            <div>
                <h4 class="mb-3">Trial Balance</h4>
                <p class="mb-0">Verify that total debits equal total credits for all accounts</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('accounts.index') }}">Accounts</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('accounts.ledger.index') }}">Ledger</a></li>
                        <li class="breadcrumb-item active">Trial Balance</li>
                    </ol>
                </nav>
            </div>
            <div>
                <button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#settingsModal">
                    <i class="las la-cog mr-2"></i>Settings
                </button>
                <button type="button" class="btn btn-primary ml-2" onclick="generateTrialBalance()">
                    <i class="las la-sync mr-2"></i>Generate Report
                </button>
            </div>
        </div>

        <!-- Report Period Selector -->
        <div class="filter-card">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>As of Date</label>
                        <input type="text" class="form-control datepicker" id="asOfDate" 
                               value="{{ date('Y-m-d') }}">
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Branch</label>
                        <select class="form-control" id="branchSelect">
                            <option value="">All Branches</option>
                            <option value="1">Main Branch</option>
                            <option value="2">Downtown Branch</option>
                        </select>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Include Accounts With</label>
                        <select class="form-control" id="includeAccounts">
                            <option value="all">All Accounts</option>
                            <option value="active">Active Accounts Only</option>
                            <option value="nonzero">Non-zero Balance Only</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-3">
                <button type="button" class="btn btn-outline-primary mr-2" onclick="quickPeriod('today')">
                    Today
                </button>
                <button type="button" class="btn btn-outline-primary mr-2" onclick="quickPeriod('month_end')">
                    Month End
                </button>
                <button type="button" class="btn btn-outline-primary mr-2" onclick="quickPeriod('quarter_end')">
                    Quarter End
                </button>
                <button type="button" class="btn btn-outline-primary" onclick="quickPeriod('year_end')">
                    Year End
                </button>
            </div>
        </div>

        <!-- Summary Stats -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card summary-card bg-gradient-primary text-white">
                    <div class="card-body">
                        <h6 class="text-uppercase mb-2">Total Debits</h6>
                        <h3 class="mb-0">₹1,250,000</h3>
                        <small>Across all accounts</small>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card summary-card bg-gradient-success text-white">
                    <div class="card-body">
                        <h6 class="text-uppercase mb-2">Total Credits</h6>
                        <h3 class="mb-0">₹1,250,000</h3>
                        <small>Across all accounts</small>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card summary-card bg-gradient-info text-white">
                    <div class="card-body">
                        <h6 class="text-uppercase mb-2">Balance Status</h6>
                        <h3 class="mb-0">
                            <span class="balanced-badge">BALANCED</span>
                        </h3>
                        <small>Debits = Credits</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Trial Balance Report -->
        <div class="trial-balance-card">
            <div class="tb-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-1">Trial Balance Report</h4>
                        <p class="mb-0">As of March 31, 2024 | My Clothing Store</p>
                    </div>
                    <div>
                        <button type="button" class="btn btn-light btn-sm mr-2" onclick="printTrialBalance()">
                            <i class="las la-print mr-1"></i> Print
                        </button>
                        <button type="button" class="btn btn-light btn-sm" onclick="exportTrialBalance()">
                            <i class="las la-download mr-1"></i> Export
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Assets Section -->
            <div class="tb-section">
                <h5 class="mb-3">
                    <span class="badge bg-gradient-green mr-2">Assets</span>
                    What the business owns
                </h5>
                
                <div class="tb-row header">
                    <div class="tb-cell account">Account</div>
                    <div class="tb-cell debit">Debit Balance</div>
                    <div class="tb-cell credit">Credit Balance</div>
                </div>
                
                <div class="tb-row">
                    <div class="tb-cell account">
                        <span class="badge badge-light mr-2">1001</span> Cash in Hand
                    </div>
                    <div class="tb-cell debit">₹125,000</div>
                    <div class="tb-cell credit"></div>
                </div>
                
                <div class="tb-row">
                    <div class="tb-cell account">
                        <span class="badge badge-light mr-2">1002</span> Bank Account - HDFC
                    </div>
                    <div class="tb-cell debit">₹850,000</div>
                    <div class="tb-cell credit"></div>
                </div>
                
                <div class="tb-row">
                    <div class="tb-cell account">
                        <span class="badge badge-light mr-2">1003</span> Bank Account - ICICI
                    </div>
                    <div class="tb-cell debit">₹250,000</div>
                    <div class="tb-cell credit"></div>
                </div>
                
                <div class="tb-row">
                    <div class="tb-cell account">
                        <span class="badge badge-light mr-2">1101</span> Accounts Receivable
                    </div>
                    <div class="tb-cell debit">₹150,000</div>
                    <div class="tb-cell credit"></div>
                </div>
                
                <div class="tb-row">
                    <div class="tb-cell account">
                        <span class="badge badge-light mr-2">1201</span> Inventory
                    </div>
                    <div class="tb-cell debit">₹500,000</div>
                    <div class="tb-cell credit"></div>
                </div>
                
                <div class="tb-row">
                    <div class="tb-cell account">
                        <span class="badge badge-light mr-2">1301</span> Equipment
                    </div>
                    <div class="tb-cell debit">₹750,000</div>
                    <div class="tb-cell credit"></div>
                </div>
                
                <div class="tb-row">
                    <div class="tb-cell account">
                        <span class="badge badge-light mr-2">1008</span> Accumulated Depreciation
                    </div>
                    <div class="tb-cell debit"></div>
                    <div class="tb-cell credit">₹150,000</div>
                </div>
                
                <div class="tb-total">
                    <div class="row">
                        <div class="col-md-6">
                            <strong>Total Assets:</strong>
                        </div>
                        <div class="col-md-3 text-right">
                            <strong>₹2,625,000</strong>
                        </div>
                        <div class="col-md-3 text-right">
                            <strong>₹150,000</strong>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Liabilities Section -->
            <div class="tb-section">
                <h5 class="mb-3">
                    <span class="badge bg-gradient-orange mr-2">Liabilities</span>
                    What the business owes
                </h5>
                
                <div class="tb-row header">
                    <div class="tb-cell account">Account</div>
                    <div class="tb-cell debit">Debit Balance</div>
                    <div class="tb-cell credit">Credit Balance</div>
                </div>
                
                <div class="tb-row">
                    <div class="tb-cell account">
                        <span class="badge badge-light mr-2">2001</span> Accounts Payable
                    </div>
                    <div class="tb-cell debit"></div>
                    <div class="tb-cell credit">₹200,000</div>
                </div>
                
                <div class="tb-row">
                    <div class="tb-cell account">
                        <span class="badge badge-light mr-2">2002</span> Loans Payable
                    </div>
                    <div class="tb-cell debit"></div>
                    <div class="tb-cell credit">₹500,000</div>
                </div>
                
                <div class="tb-row">
                    <div class="tb-cell account">
                        <span class="badge badge-light mr-2">2003</span> Tax Payable
                    </div>
                    <div class="tb-cell debit"></div>
                    <div class="tb-cell credit">₹150,000</div>
                </div>
                
                <div class="tb-total">
                    <div class="row">
                        <div class="col-md-6">
                            <strong>Total Liabilities:</strong>
                        </div>
                        <div class="col-md-3 text-right">
                            <strong></strong>
                        </div>
                        <div class="col-md-3 text-right">
                            <strong>₹850,000</strong>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Equity Section -->
            <div class="tb-section">
                <h5 class="mb-3">
                    <span class="badge bg-gradient-info mr-2">Equity</span>
                    Owner's investment
                </h5>
                
                <div class="tb-row header">
                    <div class="tb-cell account">Account</div>
                    <div class="tb-cell debit">Debit Balance</div>
                    <div class="tb-cell credit">Credit Balance</div>
                </div>
                
                <div class="tb-row">
                    <div class="tb-cell account">
                        <span class="badge badge-light mr-2">3001</span> Owner's Capital
                    </div>
                    <div class="tb-cell debit"></div>
                    <div class="tb-cell credit">₹1,000,000</div>
                </div>
                
                <div class="tb-row">
                    <div class="tb-cell account">
                        <span class="badge badge-light mr-2">3002</span> Retained Earnings
                    </div>
                    <div class="tb-cell debit"></div>
                    <div class="tb-cell credit">₹750,000</div>
                </div>
                
                <div class="tb-row">
                    <div class="tb-cell account">
                        <span class="badge badge-light mr-2">3003</span> Current Year Earnings
                    </div>
                    <div class="tb-cell debit"></div>
                    <div class="tb-cell credit">₹25,000</div>
                </div>
                
                <div class="tb-total">
                    <div class="row">
                        <div class="col-md-6">
                            <strong>Total Equity:</strong>
                        </div>
                        <div class="col-md-3 text-right">
                            <strong></strong>
                        </div>
                        <div class="col-md-3 text-right">
                            <strong>₹1,775,000</strong>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Revenue Section -->
            <div class="tb-section">
                <h5 class="mb-3">
                    <span class="badge bg-gradient-success mr-2">Revenue</span>
                    Income earned
                </h5>
                
                <div class="tb-row header">
                    <div class="tb-cell account">Account</div>
                    <div class="tb-cell debit">Debit Balance</div>
                    <div class="tb-cell credit">Credit Balance</div>
                </div>
                
                <div class="tb-row">
                    <div class="tb-cell account">
                        <span class="badge badge-light mr-2">4001</span> Sales Revenue
                    </div>
                    <div class="tb-cell debit"></div>
                    <div class="tb-cell credit">₹2,500,000</div>
                </div>
                
                <div class="tb-row">
                    <div class="tb-cell account">
                        <span class="badge badge-light mr-2">4002</span> Service Revenue
                    </div>
                    <div class="tb-cell debit"></div>
                    <div class="tb-cell credit">₹250,000</div>
                </div>
                
                <div class="tb-row">
                    <div class="tb-cell account">
                        <span class="badge badge-light mr-2">4003</span> Interest Income
                    </div>
                    <div class="tb-cell debit"></div>
                    <div class="tb-cell credit">₹25,000</div>
                </div>
                
                <div class="tb-total">
                    <div class="row">
                        <div class="col-md-6">
                            <strong>Total Revenue:</strong>
                        </div>
                        <div class="col-md-3 text-right">
                            <strong></strong>
                        </div>
                        <div class="col-md-3 text-right">
                            <strong>₹2,775,000</strong>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Expenses Section -->
            <div class="tb-section">
                <h5 class="mb-3">
                    <span class="badge bg-gradient-danger mr-2">Expenses</span>
                    Costs incurred
                </h5>
                
                <div class="tb-row header">
                    <div class="tb-cell account">Account</div>
                    <div class="tb-cell debit">Debit Balance</div>
                    <div class="tb-cell credit">Credit Balance</div>
                </div>
                
                <div class="tb-row">
                    <div class="tb-cell account">
                        <span class="badge badge-light mr-2">5001</span> Salaries Expense
                    </div>
                    <div class="tb-cell debit">₹600,000</div>
                    <div class="tb-cell credit"></div>
                </div>
                
                <div class="tb-row">
                    <div class="tb-cell account">
                        <span class="badge badge-light mr-2">5002</span> Rent Expense
                    </div>
                    <div class="tb-cell debit">₹240,000</div>
                    <div class="tb-cell credit"></div>
                </div>
                
                <div class="tb-row">
                    <div class="tb-cell account">
                        <span class="badge badge-light mr-2">5003</span> Utilities Expense
                    </div>
                    <div class="tb-cell debit">₹120,000</div>
                    <div class="tb-cell credit"></div>
                </div>
                
                <div class="tb-row">
                    <div class="tb-cell account">
                        <span class="badge badge-light mr-2">5004</span> Depreciation Expense
                    </div>
                    <div class="tb-cell debit">₹150,000</div>
                    <div class="tb-cell credit"></div>
                </div>
                
                <div class="tb-row">
                    <div class="tb-cell account">
                        <span class="badge badge-light mr-2">5005</span> Marketing Expense
                    </div>
                    <div class="tb-cell debit">₹100,000</div>
                    <div class="tb-cell credit"></div>
                </div>
                
                <div class="tb-row">
                    <div class="tb-cell account">
                        <span class="badge badge-light mr-2">5006</span> Supplies Expense
                    </div>
                    <div class="tb-cell debit">₹75,000</div>
                    <div class="tb-cell credit"></div>
                </div>
                
                <div class="tb-row">
                    <div class="tb-cell account">
                        <span class="badge badge-light mr-2">5007</span> Insurance Expense
                    </div>
                    <div class="tb-cell debit">₹60,000</div>
                    <div class="tb-cell credit"></div>
                </div>
                
                <div class="tb-total">
                    <div class="row">
                        <div class="col-md-6">
                            <strong>Total Expenses:</strong>
                        </div>
                        <div class="col-md-3 text-right">
                            <strong>₹1,345,000</strong>
                        </div>
                        <div class="col-md-3 text-right">
                            <strong></strong>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Grand Total -->
            <div class="tb-section" style="background: #f8f9fa;">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Grand Totals</h5>
                    </div>
                    <div class="col-md-3 text-right">
                        <h5>₹3,970,000</h5>
                        <small>Total Debits</small>
                    </div>
                    <div class="col-md-3 text-right">
                        <h5>₹3,970,000</h5>
                        <small>Total Credits</small>
                    </div>
                </div>
                
                <div class="text-center mt-4">
                    <span class="balanced-badge">
                        <i class="las la-check-circle mr-2"></i>
                        TRIAL BALANCE IS BALANCED
                    </span>
                    <p class="mt-2 mb-0 text-muted">
                        Total Debits (₹3,970,000) = Total Credits (₹3,970,000)
                    </p>
                </div>
            </div>
        </div>

        <!-- Analysis Section -->
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Trial Balance Analysis</h5>
                    </div>
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            <div class="list-group-item d-flex justify-content-between px-0">
                                <span>Number of Accounts</span>
                                <span class="badge badge-light">48</span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between px-0">
                                <span>Accounts with Debit Balance</span>
                                <span class="badge badge-light">24</span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between px-0">
                                <span>Accounts with Credit Balance</span>
                                <span class="badge badge-light">24</span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between px-0">
                                <span>Zero Balance Accounts</span>
                                <span class="badge badge-light">12</span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between px-0">
                                <span>Inactive Accounts</span>
                                <span class="badge badge-light">3</span>
                            </div>
                        </div>
                        
                        <div class="alert alert-info mt-3">
                            <i class="las la-info-circle mr-2"></i>
                            <strong>Note:</strong> A balanced trial balance doesn't guarantee error-free accounting, 
                            but it's a good starting point for financial statement preparation.
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Next Steps</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="{{ route('accounts.reports.income-statement') }}" class="btn btn-outline-primary">
                                <i class="las la-chart-line mr-2"></i>Generate Income Statement
                            </a>
                            <a href="{{ route('accounts.reports.balance-sheet') }}" class="btn btn-outline-success">
                                <i class="las la-balance-scale-left mr-2"></i>Generate Balance Sheet
                            </a>
                            <button type="button" class="btn btn-outline-info" onclick="runAuditChecks()">
                                <i class="las la-search mr-2"></i>Run Audit Checks
                            </button>
                            <button type="button" class="btn btn-outline-warning" onclick="findDiscrepancies()">
                                <i class="las la-exclamation-triangle mr-2"></i>Find Discrepancies
                            </button>
                        </div>
                        
                        <div class="mt-3">
                            <h6>Common Issues to Check:</h6>
                            <ul class="small text-muted">
                                <li>Accounts with unusually large balances</li>
                                <li>Accounts that should never have debit/credit balance</li>
                                <li>Rounding errors in calculations</li>
                                <li>Missing adjusting entries</li>
                                <li>Duplicate transactions</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Settings Modal -->
    <div class="modal fade" id="settingsModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Trial Balance Settings</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="settingsForm">
                        <div class="form-group">
                            <label>Report Format</label>
                            <select class="form-control" name="report_format">
                                <option value="detailed">Detailed (with all accounts)</option>
                                <option value="summary">Summary (with totals only)</option>
                                <option value="consolidated">Consolidated (multiple branches)</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label>Currency Format</label>
                            <select class="form-control" name="currency_format">
                                <option value="INR">Indian Rupees (₹)</option>
                                <option value="USD">US Dollars ($)</option>
                                <option value="EUR">Euros (€)</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label>Rounding</label>
                            <select class="form-control" name="rounding">
                                <option value="0">No Rounding</option>
                                <option value="1" selected>Round to Nearest Rupee</option>
                                <option value="10">Round to Nearest 10 Rupees</option>
                                <option value="100">Round to Nearest 100 Rupees</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" 
                                       name="show_account_codes" id="showAccountCodes" checked>
                                <label class="custom-control-label" for="showAccountCodes">
                                    Show Account Codes
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" 
                                       name="show_zero_balances" id="showZeroBalances">
                                <label class="custom-control-label" for="showZeroBalances">
                                    Show Zero Balance Accounts
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" 
                                       name="group_by_category" id="groupByCategory" checked>
                                <label class="custom-control-label" for="groupByCategory">
                                    Group by Account Category
                                </label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="saveSettings()">
                        Save Settings
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
            flatpickr("#asOfDate", {
                dateFormat: "Y-m-d",
                defaultDate: "today"
            });
            
            // Load saved settings
            loadSettings();
        });
        
        // Generate trial balance
        window.generateTrialBalance = function() {
            const asOfDate = $('#asOfDate').val();
            const branch = $('#branchSelect').val();
            const include = $('#includeAccounts').val();
            
            alert(`Generating trial balance as of ${asOfDate}...`);
            // In real app: reload page with new trial balance data
        };
        
        // Quick period selection
        window.quickPeriod = function(period) {
            const now = new Date();
            let date;
            
            switch(period) {
                case 'today':
                    date = now.toISOString().split('T')[0];
                    break;
                case 'month_end':
                    date = new Date(now.getFullYear(), now.getMonth() + 1, 0).toISOString().split('T')[0];
                    break;
                case 'quarter_end':
                    const quarter = Math.floor(now.getMonth() / 3);
                    date = new Date(now.getFullYear(), quarter * 3 + 3, 0).toISOString().split('T')[0];
                    break;
                case 'year_end':
                    date = new Date(now.getFullYear(), 11, 31).toISOString().split('T')[0];
                    break;
            }
            
            $('#asOfDate').val(date);
            generateTrialBalance();
        };
        
        // Print trial balance
        window.printTrialBalance = function() {
            const printWindow = window.open('', '_blank');
            printWindow.document.write(`
                <html>
                    <head>
                        <title>Trial Balance Report</title>
                        <style>
                            body { font-family: Arial, sans-serif; margin: 20px; }
                            .header { text-align: center; margin-bottom: 30px; }
                            .company-info { margin-bottom: 20px; }
                            .as-of { text-align: center; margin-bottom: 20px; }
                            table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
                            th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                            th { background-color: #f2f2f2; }
                            .section-header { background-color: #e9ecef; font-weight: bold; }
                            .total-row { background-color: #f8f9fa; font-weight: bold; }
                            .grand-total { background-color: #e9ecef; font-weight: bold; text-align: center; }
                            .balanced { color: green; font-weight: bold; }
                            .footer { text-align: center; margin-top: 30px; font-size: 12px; color: #666; }
                        </style>
                    </head>
                    <body>
                        <div class="header">
                            <h2>Trial Balance Report</h2>
                            <h3>My Clothing Store</h3>
                        </div>
                        <div class="as-of">
                            <p><strong>As of:</strong> March 31, 2024</p>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>Account</th>
                                    <th>Debit Balance</th>
                                    <th>Credit Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="section-header">
                                    <td colspan="3">Assets</td>
                                </tr>
                                <tr>
                                    <td>Cash in Hand (1001)</td>
                                    <td>₹125,000</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Bank Account - HDFC (1002)</td>
                                    <td>₹850,000</td>
                                    <td></td>
                                </tr>
                                <tr class="total-row">
                                    <td><strong>Total Assets</strong></td>
                                    <td><strong>₹2,625,000</strong></td>
                                    <td><strong>₹150,000</strong></td>
                                </tr>
                                
                                <tr class="section-header">
                                    <td colspan="3">Liabilities</td>
                                </tr>
                                <tr>
                                    <td>Accounts Payable (2001)</td>
                                    <td></td>
                                    <td>₹200,000</td>
                                </tr>
                                <tr class="total-row">
                                    <td><strong>Total Liabilities</strong></td>
                                    <td></td>
                                    <td><strong>₹850,000</strong></td>
                                </tr>
                                
                                <tr class="section-header">
                                    <td colspan="3">Equity</td>
                                </tr>
                                <tr>
                                    <td>Owner's Capital (3001)</td>
                                    <td></td>
                                    <td>₹1,000,000</td>
                                </tr>
                                <tr class="total-row">
                                    <td><strong>Total Equity</strong></td>
                                    <td></td>
                                    <td><strong>₹1,775,000</strong></td>
                                </tr>
                                
                                <tr class="section-header">
                                    <td colspan="3">Revenue</td>
                                </tr>
                                <tr>
                                    <td>Sales Revenue (4001)</td>
                                    <td></td>
                                    <td>₹2,500,000</td>
                                </tr>
                                <tr class="total-row">
                                    <td><strong>Total Revenue</strong></td>
                                    <td></td>
                                    <td><strong>₹2,775,000</strong></td>
                                </tr>
                                
                                <tr class="section-header">
                                    <td colspan="3">Expenses</td>
                                </tr>
                                <tr>
                                    <td>Salaries Expense (5001)</td>
                                    <td>₹600,000</td>
                                    <td></td>
                                </tr>
                                <tr class="total-row">
                                    <td><strong>Total Expenses</strong></td>
                                    <td><strong>₹1,345,000</strong></td>
                                    <td></td>
                                </tr>
                                
                                <tr class="grand-total">
                                    <td colspan="3" class="balanced">
                                        <strong>GRAND TOTALS: ₹3,970,000 = ₹3,970,000</strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="footer">
                            <p>Generated on: ${new Date().toLocaleString()}</p>
                            <p>This is a computer-generated trial balance report.</p>
                        </div>
                    </body>
                </html>
            `);
            printWindow.document.close();
            printWindow.print();
        };
        
        // Export trial balance
        window.exportTrialBalance = function() {
            const format = prompt('Export format (csv, excel, pdf):', 'pdf');
            if(format) {
                alert(`Exporting trial balance in ${format} format...`);
                // In real app: window.location.href = `/accounts/ledger/trial-balance/export?format=${format}`;
            }
        };
        
        // Load settings
        window.loadSettings = function() {
            // In real app: load from localStorage or API
            const settings = {
                report_format: 'detailed',
                currency_format: 'INR',
                rounding: 1,
                show_account_codes: true,
                show_zero_balances: false,
                group_by_category: true
            };
            
            $('#settingsForm select[name="report_format"]').val(settings.report_format);
            $('#settingsForm select[name="currency_format"]').val(settings.currency_format);
            $('#settingsForm select[name="rounding"]').val(settings.rounding);
            $('#showAccountCodes').prop('checked', settings.show_account_codes);
            $('#showZeroBalances').prop('checked', settings.show_zero_balances);
            $('#groupByCategory').prop('checked', settings.group_by_category);
        };
        
        // Save settings
        window.saveSettings = function() {
            const settings = {
                report_format: $('select[name="report_format"]').val(),
                currency_format: $('select[name="currency_format"]').val(),
                rounding: $('select[name="rounding"]').val(),
                show_account_codes: $('#showAccountCodes').prop('checked'),
                show_zero_balances: $('#showZeroBalances').prop('checked'),
                group_by_category: $('#groupByCategory').prop('checked')
            };
            
            // In real app: save to localStorage or API
            console.log('Saving settings:', settings);
            alert('Settings saved successfully!');
            $('#settingsModal').modal('hide');
            
            // Regenerate report with new settings
            generateTrialBalance();
        };
        
        // Run audit checks
        window.runAuditChecks = function() {
            alert('Running audit checks...\n\nChecking for:\n1. Unusual balances\n2. Missing accounts\n3. Rounding errors\n4. Date consistency\n\nResults will be displayed shortly.');
            // In real app: run audit checks via API
        };
        
        // Find discrepancies
        window.findDiscrepancies = function() {
            alert('Finding discrepancies...\n\nThis feature will identify:\n1. Accounts with wrong balance type\n2. Missing transactions\n3. Data entry errors\n4. Unmatched debits/credits');
            // In real app: run discrepancy check via API
        };
    </script>
    @endpush
</x-app-layout>