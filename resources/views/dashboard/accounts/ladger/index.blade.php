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
        .ledger-card {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            margin-bottom: 30px;
            overflow: hidden;
        }
        .ledger-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
        }
        .ledger-body {
            padding: 0;
        }
        .ledger-row {
            display: flex;
            border-bottom: 1px solid #dee2e6;
            transition: background-color 0.2s;
        }
        .ledger-row:hover {
            background-color: #f8f9fa;
        }
        .ledger-row.header {
            background: #f8f9fa;
            font-weight: 600;
            border-bottom: 2px solid #dee2e6;
        }
        .ledger-cell {
            padding: 12px 15px;
            flex: 1;
        }
        .ledger-cell.date {
            flex: 0.8;
        }
        .ledger-cell.description {
            flex: 2;
        }
        .ledger-cell.debit, .ledger-cell.credit {
            flex: 1;
            text-align: right;
        }
        .ledger-cell.balance {
            flex: 1.2;
            text-align: right;
            font-weight: 600;
        }
        .amount-debit {
            color: #28a745;
        }
        .amount-credit {
            color: #dc3545;
        }
        .balance-positive {
            color: #28a745;
        }
        .balance-negative {
            color: #dc3545;
        }
        .account-selector {
            background: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .period-summary {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }
        .filter-section {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .ledger-total {
            background: #e9ecef;
            font-weight: 600;
            padding: 15px;
            border-top: 2px solid #dee2e6;
        }
    </style>
    @endpush

    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
            <div>
                <h4 class="mb-3">General Ledger</h4>
                <p class="mb-0">View complete transaction history for all accounts</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('accounts.index') }}">Accounts</a></li>
                        <li class="breadcrumb-item active">General Ledger</li>
                    </ol>
                </nav>
            </div>
            <div>
                <button type="button" class="btn btn-outline-secondary" data-toggle="collapse" data-target="#filterSection">
                    <i class="las la-filter mr-2"></i>Filters
                </button>
                <a href="{{ route('accounts.ledger.trial-balance') }}" class="btn btn-primary ml-2">
                    <i class="las la-balance-scale mr-2"></i>Trial Balance
                </a>
            </div>
        </div>

        <!-- Account Selector -->
        <div class="account-selector">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Select Account</label>
                        <select class="form-control" id="accountSelect" onchange="loadAccountLedger(this.value)">
                            <option value="">All Accounts (General Ledger)</option>
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
                            <optgroup label="Revenue">
                                <option value="8">Sales Revenue (3001)</option>
                                <option value="9">Service Revenue (3002)</option>
                            </optgroup>
                            <optgroup label="Expenses">
                                <option value="10">Salaries Expense (5001)</option>
                                <option value="11">Rent Expense (5002)</option>
                                <option value="12">Utilities Expense (5003)</option>
                            </optgroup>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Period</label>
                        <div class="input-group">
                            <input type="text" class="form-control datepicker" id="periodRange" 
                                   value="2024-03-01 to 2024-03-20">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="las la-calendar"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-3">
                <button type="button" class="btn btn-outline-primary mr-2" onclick="loadAccountLedger('all')">
                    <i class="las la-book mr-2"></i>View General Ledger
                </button>
                <button type="button" class="btn btn-outline-success" onclick="printLedger()">
                    <i class="las la-print mr-2"></i>Print Ledger
                </button>
            </div>
        </div>

        <!-- Period Summary -->
        <div class="period-summary">
            <div class="row">
                <div class="col-md-3">
                    <div class="text-center">
                        <h6 class="text-muted mb-1">Opening Balance</h6>
                        <h4 class="mb-0">₹1,250,000</h4>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="text-center">
                        <h6 class="text-muted mb-1">Total Debits</h6>
                        <h4 class="mb-0 text-success">₹850,000</h4>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="text-center">
                        <h6 class="text-muted mb-1">Total Credits</h6>
                        <h4 class="mb-0 text-danger">₹825,000</h4>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="text-center">
                        <h6 class="text-muted mb-1">Closing Balance</h6>
                        <h4 class="mb-0">₹1,275,000</h4>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="collapse" id="filterSection">
            <div class="filter-section">
                <form id="filterForm">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Transaction Type</label>
                                <select class="form-control" name="transaction_type">
                                    <option value="">All Types</option>
                                    <option value="debit">Debit</option>
                                    <option value="credit">Credit</option>
                                    <option value="journal">Journal</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Reference Type</label>
                                <select class="form-control" name="reference_type">
                                    <option value="">All References</option>
                                    <option value="sale">Sale</option>
                                    <option value="purchase">Purchase</option>
                                    <option value="expense">Expense</option>
                                    <option value="salary">Salary</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Branch</label>
                                <select class="form-control" name="branch_id">
                                    <option value="">All Branches</option>
                                    <option value="1">Main Branch</option>
                                    <option value="2">Downtown Branch</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Minimum Amount</label>
                                <input type="number" class="form-control" name="amount_min" placeholder="Min amount">
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Maximum Amount</label>
                                <input type="number" class="form-control" name="amount_max" placeholder="Max amount">
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-outline-secondary" onclick="resetFilters()">
                            <i class="las la-redo mr-2"></i>Reset Filters
                        </button>
                        <button type="button" class="btn btn-primary" onclick="applyFilters()">
                            <i class="las la-filter mr-2"></i>Apply Filters
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- General Ledger View -->
        <div class="ledger-card">
            <div class="ledger-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-1">General Ledger</h4>
                        <p class="mb-0">Period: March 1, 2024 - March 20, 2024 | All Accounts</p>
                    </div>
                    <div>
                        <button type="button" class="btn btn-light btn-sm" onclick="exportLedger()">
                            <i class="las la-download mr-1"></i> Export
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="ledger-body">
                <!-- Header Row -->
                <div class="ledger-row header">
                    <div class="ledger-cell date">Date</div>
                    <div class="ledger-cell">Account</div>
                    <div class="ledger-cell description">Description</div>
                    <div class="ledger-cell debit">Debit</div>
                    <div class="ledger-cell credit">Credit</div>
                    <div class="ledger-cell balance">Balance</div>
                </div>
                
                <!-- Opening Balance Row -->
                <div class="ledger-row">
                    <div class="ledger-cell date">2024-03-01</div>
                    <div class="ledger-cell">
                        <span class="badge badge-light">Opening Balance</span>
                    </div>
                    <div class="ledger-cell description">Opening balance for period</div>
                    <div class="ledger-cell debit"></div>
                    <div class="ledger-cell credit"></div>
                    <div class="ledger-cell balance balance-positive">₹1,250,000</div>
                </div>
                
                <!-- Transaction Rows -->
                <div class="ledger-row">
                    <div class="ledger-cell date">2024-03-20</div>
                    <div class="ledger-cell">
                        <span class="badge badge-light">1001</span> Cash in Hand
                    </div>
                    <div class="ledger-cell description">
                        Cash sale - Invoice #INV-20240320-045
                        <br>
                        <small class="text-muted">Ref: TRX-20240320-001</small>
                    </div>
                    <div class="ledger-cell debit amount-debit">₹5,000</div>
                    <div class="ledger-cell credit"></div>
                    <div class="ledger-cell balance balance-positive">₹1,255,000</div>
                </div>
                
                <div class="ledger-row">
                    <div class="ledger-cell date">2024-03-19</div>
                    <div class="ledger-cell">
                        <span class="badge badge-light">1002</span> Bank Account - HDFC
                    </div>
                    <div class="ledger-cell description">
                        Supplier payment - Purchase #PUR-20240315-012
                        <br>
                        <small class="text-muted">Ref: TRX-20240319-002</small>
                    </div>
                    <div class="ledger-cell debit"></div>
                    <div class="ledger-cell credit amount-credit">₹2,500</div>
                    <div class="ledger-cell balance balance-positive">₹1,252,500</div>
                </div>
                
                <div class="ledger-row">
                    <div class="ledger-cell date">2024-03-18</div>
                    <div class="ledger-cell">
                        <span class="badge badge-light">5001</span> Salaries Expense
                    </div>
                    <div class="ledger-cell description">
                        Salary payment for March 2024
                        <br>
                        <small class="text-muted">Ref: TRX-20240318-003</small>
                    </div>
                    <div class="ledger-cell debit amount-debit">₹50,000</div>
                    <div class="ledger-cell credit"></div>
                    <div class="ledger-cell balance balance-positive">₹1,202,500</div>
                </div>
                
                <div class="ledger-row">
                    <div class="ledger-cell date">2024-03-17</div>
                    <div class="ledger-cell">
                        <span class="badge badge-light">3001</span> Sales Revenue
                    </div>
                    <div class="ledger-cell description">
                        Credit card sales for day
                        <br>
                        <small class="text-muted">Ref: TRX-20240317-004</small>
                    </div>
                    <div class="ledger-cell debit"></div>
                    <div class="ledger-cell credit amount-credit">₹75,000</div>
                    <div class="ledger-cell balance balance-positive">₹1,277,500</div>
                </div>
                
                <!-- More transaction rows... -->
                
                <!-- Closing Balance Row -->
                <div class="ledger-row" style="background: #f8f9fa;">
                    <div class="ledger-cell date">2024-03-20</div>
                    <div class="ledger-cell">
                        <span class="badge badge-light">Closing Balance</span>
                    </div>
                    <div class="ledger-cell description">Closing balance for period</div>
                    <div class="ledger-cell debit"></div>
                    <div class="ledger-cell credit"></div>
                    <div class="ledger-cell balance balance-positive">₹1,275,000</div>
                </div>
            </div>
            
            <!-- Totals Footer -->
            <div class="ledger-total">
                <div class="row">
                    <div class="col-md-4">
                        <strong>Total Debits:</strong> ₹850,000
                    </div>
                    <div class="col-md-4">
                        <strong>Total Credits:</strong> ₹825,000
                    </div>
                    <div class="col-md-4 text-right">
                        <strong>Net Change:</strong> <span class="balance-positive">+₹25,000</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Account Summary Cards -->
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Top Accounts by Volume</h6>
                        <div class="list-group list-group-flush">
                            <div class="list-group-item d-flex justify-content-between px-0">
                                <span>Cash in Hand</span>
                                <span class="text-success">48 transactions</span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between px-0">
                                <span>Bank Account - HDFC</span>
                                <span class="text-success">32 transactions</span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between px-0">
                                <span>Sales Revenue</span>
                                <span class="text-success">28 transactions</span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between px-0">
                                <span>Accounts Payable</span>
                                <span class="text-success">24 transactions</span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between px-0">
                                <span>Salaries Expense</span>
                                <span class="text-success">12 transactions</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Largest Transactions</h6>
                        <div class="list-group list-group-flush">
                            <div class="list-group-item d-flex justify-content-between px-0">
                                <span>Equipment Purchase</span>
                                <span class="text-danger">₹250,000</span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between px-0">
                                <span>Monthly Sales</span>
                                <span class="text-success">₹150,000</span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between px-0">
                                <span>Inventory Purchase</span>
                                <span class="text-danger">₹75,000</span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between px-0">
                                <span>Loan Payment</span>
                                <span class="text-danger">₹50,000</span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between px-0">
                                <span>Customer Payment</span>
                                <span class="text-success">₹45,000</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Ledger Statistics</h6>
                        <div class="list-group list-group-flush">
                            <div class="list-group-item d-flex justify-content-between px-0">
                                <span>Total Transactions</span>
                                <span>1,248</span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between px-0">
                                <span>Average per Day</span>
                                <span>62.4</span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between px-0">
                                <span>Debit Transactions</span>
                                <span>624</span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between px-0">
                                <span>Credit Transactions</span>
                                <span>624</span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between px-0">
                                <span>Journal Entries</span>
                                <span>48</span>
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
    
    <!-- Flatpickr -->
    <script src="{{ asset('backend/assets/vendor/flatpickr/dist/flatpickr.min.js') }}"></script>
    
    <!-- app JavaScript -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    
    <script>
        $(document).ready(function() {
            // Initialize datepicker
            flatpickr("#periodRange", {
                mode: "range",
                dateFormat: "Y-m-d",
                defaultDate: ["2024-03-01", "2024-03-20"]
            });
            
            // Initialize tooltips
            $('[data-toggle="tooltip"]').tooltip();
        });
        
        // Load account ledger
        window.loadAccountLedger = function(accountId) {
            const period = $('#periodRange').val();
            
            if(accountId === 'all') {
                alert('Loading general ledger for all accounts...');
                // In real app: reload page with general ledger
            } else if(accountId) {
                alert(`Loading ledger for account ${accountId}...`);
                // In real app: redirect to account ledger page
                window.location.href = `/accounts/ledger/account/${accountId}?period=${period}`;
            } else {
                alert('Please select an account or choose "All Accounts"');
            }
        };
        
        // Apply filters
        window.applyFilters = function() {
            const formData = new FormData(document.getElementById('filterForm'));
            const filters = Object.fromEntries(formData);
            console.log('Applying filters:', filters);
            
            // In real app, this would reload the ledger with filters
            alert('Filters applied! Loading filtered ledger...');
            $('#filterSection').collapse('hide');
        };
        
        // Reset filters
        window.resetFilters = function() {
            if(confirm('Reset all filters to default?')) {
                $('#filterForm')[0].reset();
                alert('Filters reset successfully');
            }
        };
        
        // Export ledger
        window.exportLedger = function() {
            const format = prompt('Export format (csv, excel, pdf):', 'pdf');
            if(format) {
                alert(`Exporting ledger in ${format} format...`);
                // In real app: window.location.href = `/accounts/ledger/export?format=${format}`;
            }
        };
        
        // Print ledger
        window.printLedger = function() {
            const printWindow = window.open('', '_blank');
            printWindow.document.write(`
                <html>
                    <head>
                        <title>General Ledger Report</title>
                        <style>
                            body { font-family: Arial, sans-serif; margin: 20px; }
                            .header { text-align: center; margin-bottom: 30px; }
                            .period { text-align: center; margin-bottom: 20px; }
                            table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
                            th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                            th { background-color: #f2f2f2; }
                            .debit { color: green; }
                            .credit { color: red; }
                            .balance { font-weight: bold; }
                            .total-row { background-color: #f8f9fa; font-weight: bold; }
                            .footer { text-align: center; margin-top: 30px; font-size: 12px; color: #666; }
                        </style>
                    </head>
                    <body>
                        <div class="header">
                            <h2>General Ledger Report</h2>
                            <h3>My Clothing Store</h3>
                        </div>
                        <div class="period">
                            <p><strong>Period:</strong> March 1, 2024 - March 20, 2024</p>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Account</th>
                                    <th>Description</th>
                                    <th>Debit</th>
                                    <th>Credit</th>
                                    <th>Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>2024-03-01</td>
                                    <td>Opening Balance</td>
                                    <td>Opening balance for period</td>
                                    <td></td>
                                    <td></td>
                                    <td class="balance">₹1,250,000</td>
                                </tr>
                                <tr>
                                    <td>2024-03-20</td>
                                    <td>Cash in Hand (1001)</td>
                                    <td>Cash sale - Invoice #INV-20240320-045</td>
                                    <td class="debit">₹5,000</td>
                                    <td></td>
                                    <td class="balance">₹1,255,000</td>
                                </tr>
                                <tr>
                                    <td>2024-03-19</td>
                                    <td>Bank Account - HDFC (1002)</td>
                                    <td>Supplier payment</td>
                                    <td></td>
                                    <td class="credit">₹2,500</td>
                                    <td class="balance">₹1,252,500</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr class="total-row">
                                    <td colspan="3">Totals</td>
                                    <td class="debit">₹850,000</td>
                                    <td class="credit">₹825,000</td>
                                    <td class="balance">₹1,275,000</td>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="footer">
                            <p>Generated on: ${new Date().toLocaleString()}</p>
                            <p>This is a computer-generated ledger report.</p>
                        </div>
                    </body>
                </html>
            `);
            printWindow.document.close();
            printWindow.print();
        };
        
        // Quick period selection
        window.setPeriod = function(period) {
            const now = new Date();
            let startDate, endDate;
            
            switch(period) {
                case 'today':
                    startDate = endDate = now.toISOString().split('T')[0];
                    break;
                case 'week':
                    startDate = new Date(now.setDate(now.getDate() - 7)).toISOString().split('T')[0];
                    endDate = new Date().toISOString().split('T')[0];
                    break;
                case 'month':
                    startDate = new Date(now.getFullYear(), now.getMonth(), 1).toISOString().split('T')[0];
                    endDate = new Date(now.getFullYear(), now.getMonth() + 1, 0).toISOString().split('T')[0];
                    break;
                case 'quarter':
                    const quarter = Math.floor(now.getMonth() / 3);
                    startDate = new Date(now.getFullYear(), quarter * 3, 1).toISOString().split('T')[0];
                    endDate = new Date(now.getFullYear(), quarter * 3 + 3, 0).toISOString().split('T')[0];
                    break;
                case 'year':
                    startDate = new Date(now.getFullYear(), 0, 1).toISOString().split('T')[0];
                    endDate = new Date(now.getFullYear(), 11, 31).toISOString().split('T')[0];
                    break;
            }
            
            $('#periodRange').val(`${startDate} to ${endDate}`);
            loadAccountLedger($('#accountSelect').val() || 'all');
        };
    </script>
    @endpush
</x-app-layout>