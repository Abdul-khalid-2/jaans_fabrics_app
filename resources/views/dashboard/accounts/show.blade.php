<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/remixicon/fonts/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <style>
        .account-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 10px;
            padding: 30px;
            margin-bottom: 30px;
        }
        .account-icon {
            width: 80px;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            font-size: 2.5rem;
            margin-bottom: 20px;
        }
        .stat-card {
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            transition: all 0.3s;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .transaction-timeline {
            position: relative;
            padding-left: 30px;
        }
        .transaction-timeline::before {
            content: "";
            position: absolute;
            left: 15px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: #dee2e6;
        }
        .timeline-item {
            position: relative;
            margin-bottom: 25px;
        }
        .timeline-item::before {
            content: "";
            position: absolute;
            left: -26px;
            top: 5px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #007bff;
            border: 2px solid white;
        }
        .balance-change {
            font-size: 0.9rem;
            padding: 2px 8px;
            border-radius: 4px;
        }
        .balance-increase {
            background: #d4edda;
            color: #155724;
        }
        .balance-decrease {
            background: #f8d7da;
            color: #721c24;
        }
    </style>
    @endpush

    <div class="container-fluid">
        <!-- Account Header -->
        <div class="account-header">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="d-flex align-items-center">
                        <div class="account-icon mr-4">
                            <i class="las la-wallet"></i>
                        </div>
                        <div>
                            <h2 class="mb-1">Cash in Hand</h2>
                            <div class="d-flex align-items-center">
                                <span class="badge badge-light mr-3">Code: 1001</span>
                                <span class="badge badge-success mr-3">Active</span>
                                <span class="badge bg-gradient-green">Asset Account</span>
                            </div>
                            <p class="mb-0 mt-2">Main cash register for daily transactions</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-right">
                    <h1 class="mb-0">₹125,000</h1>
                    <p class="mb-0">Current Balance</p>
                    <div class="mt-3">
                        <span class="badge badge-light">Debit Balance</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body py-3">
                        <div class="d-flex justify-content-between">
                            <div>
                                <a href="{{ route('accounts.ledger.account', 1) }}" class="btn btn-outline-primary mr-2">
                                    <i class="las la-file-invoice mr-2"></i>View Ledger
                                </a>
                                <a href="{{ route('accounts.transactions.create') }}?account_id=1" class="btn btn-outline-success mr-2">
                                    <i class="las la-plus-circle mr-2"></i>Add Transaction
                                </a>
                                <a href="#" class="btn btn-outline-info mr-2">
                                    <i class="las la-download mr-2"></i>Export
                                </a>
                            </div>
                            <div>
                                <a href="{{ route('accounts.edit', 1) }}" class="btn btn-primary mr-2">
                                    <i class="las la-edit mr-2"></i>Edit Account
                                </a>
                                <a href="{{ route('accounts.index') }}" class="btn btn-outline-secondary">
                                    <i class="las la-arrow-left mr-2"></i>Back to Accounts
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6">
                <div class="card stat-card bg-gradient-primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase mb-0">Opening Balance</h6>
                                <h2 class="mb-0">₹100,000</h2>
                            </div>
                            <div>
                                <i class="las la-sign-in-alt fa-2x opacity-5"></i>
                            </div>
                        </div>
                        <p class="mb-0 mt-2">
                            <span class="text-white">Debit Balance</span>
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-md-6">
                <div class="card stat-card bg-gradient-success text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase mb-0">Total Credits</h6>
                                <h2 class="mb-0">₹850,000</h2>
                            </div>
                            <div>
                                <i class="las la-arrow-up fa-2x opacity-5"></i>
                            </div>
                        </div>
                        <p class="mb-0 mt-2">
                            <span class="text-white">This Month: ₹125,000</span>
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-md-6">
                <div class="card stat-card bg-gradient-danger text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase mb-0">Total Debits</h2>
                                <h2 class="mb-0">₹825,000</h2>
                            </div>
                            <div>
                                <i class="las la-arrow-down fa-2x opacity-5"></i>
                            </div>
                        </div>
                        <p class="mb-0 mt-2">
                            <span class="text-white">This Month: ₹100,000</span>
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-md-6">
                <div class="card stat-card bg-gradient-info text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase mb-0">Transactions</h6>
                                <h2 class="mb-0">1,248</h2>
                            </div>
                            <div>
                                <i class="las la-exchange-alt fa-2x opacity-5"></i>
                            </div>
                        </div>
                        <p class="mb-0 mt-2">
                            <span class="text-white">This Month: 48</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Account Details -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Account Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            <div class="list-group-item d-flex justify-content-between px-0">
                                <span>Account Code:</span>
                                <strong>1001</strong>
                            </div>
                            <div class="list-group-item d-flex justify-content-between px-0">
                                <span>Account Type:</span>
                                <strong>Cash Account</strong>
                            </div>
                            <div class="list-group-item d-flex justify-content-between px-0">
                                <span>Category:</span>
                                <strong>Asset</strong>
                            </div>
                            <div class="list-group-item d-flex justify-content-between px-0">
                                <span>Parent Account:</span>
                                <strong>Current Assets</strong>
                            </div>
                            <div class="list-group-item d-flex justify-content-between px-0">
                                <span>Branch:</span>
                                <strong>Main Branch</strong>
                            </div>
                            <div class="list-group-item d-flex justify-content-between px-0">
                                <span>Status:</span>
                                <span class="badge badge-success">Active</span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between px-0">
                                <span>Created On:</span>
                                <strong>2024-01-15</strong>
                            </div>
                            <div class="list-group-item d-flex justify-content-between px-0">
                                <span>Last Transaction:</span>
                                <strong>2024-03-20</strong>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <h6>Description</h6>
                            <p class="text-muted">Main cash register used for daily transactions, petty cash, and immediate payments. Reconciled daily.</p>
                        </div>
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div class="card mt-4">
                    <div class="card-header">
                        <h5 class="mb-0">Quick Actions</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="{{ route('accounts.transactions.create') }}?account_id=1&type=debit" class="btn btn-success">
                                <i class="las la-plus-circle mr-2"></i>Add Debit
                            </a>
                            <a href="{{ route('accounts.transactions.create') }}?account_id=1&type=credit" class="btn btn-danger">
                                <i class="las la-minus-circle mr-2"></i>Add Credit
                            </a>
                            <a href="{{ route('accounts.ledger.account', 1) }}" class="btn btn-primary">
                                <i class="las la-file-invoice mr-2"></i>View Ledger
                            </a>
                            <a href="#" class="btn btn-info" onclick="printAccountStatement()">
                                <i class="las la-print mr-2"></i>Print Statement
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Recent Transactions -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h5 class="mb-0">Recent Transactions</h5>
                        <div>
                            <select class="form-control form-control-sm" style="width: auto;" onchange="filterTransactions(this.value)">
                                <option value="7">Last 7 days</option>
                                <option value="30" selected>Last 30 days</option>
                                <option value="90">Last 90 days</option>
                                <option value="all">All Time</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover" id="transactionsTable">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Transaction #</th>
                                        <th>Description</th>
                                        <th>Debit</th>
                                        <th>Credit</th>
                                        <th>Balance</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>2024-03-20</td>
                                        <td><span class="badge badge-light">TRX-20240320-001</span></td>
                                        <td>Cash sale - Invoice #INV-20240320-045</td>
                                        <td class="text-success">₹5,000</td>
                                        <td></td>
                                        <td>₹125,000</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-outline-primary">
                                                <i class="las la-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2024-03-19</td>
                                        <td><span class="badge badge-light">TRX-20240319-002</span></td>
                                        <td>Petty cash expense - Office supplies</td>
                                        <td></td>
                                        <td class="text-danger">₹2,500</td>
                                        <td>₹120,000</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-outline-primary">
                                                <i class="las la-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <!-- More rows... -->
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="text-center mt-3">
                            <a href="{{ route('accounts.transactions.index') }}?account_id=1" class="btn btn-outline-primary">
                                <i class="las la-list mr-2"></i>View All Transactions
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Transaction Timeline -->
                <div class="card mt-4">
                    <div class="card-header">
                        <h5 class="mb-0">Transaction Timeline</h5>
                    </div>
                    <div class="card-body">
                        <div class="transaction-timeline">
                            <div class="timeline-item">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h6 class="mb-1">Cash Sale</h6>
                                        <p class="mb-0 text-muted">Invoice #INV-20240320-045</p>
                                        <small class="text-muted">Today, 10:30 AM</small>
                                    </div>
                                    <div class="text-right">
                                        <h5 class="mb-1 text-success">₹5,000</h5>
                                        <span class="balance-change balance-increase">+₹5,000</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="timeline-item">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h6 class="mb-1">Petty Cash Expense</h6>
                                        <p class="mb-0 text-muted">Office supplies purchase</p>
                                        <small class="text-muted">Yesterday, 3:45 PM</small>
                                    </div>
                                    <div class="text-right">
                                        <h5 class="mb-1 text-danger">₹2,500</h5>
                                        <span class="balance-change balance-decrease">-₹2,500</span>
                                    </div>
                                </div>
                            </div>
                            <!-- More timeline items... -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
    <!-- Backend Bundle JavaScript -->
    <script src="{{ asset('backend/assets/js/backend-bundle.min.js') }}"></script>
    
    <!-- DataTable -->
    <script src="{{ asset('backend/assets/vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    
    <!-- Chart.js -->
    <script src="{{ asset('backend/assets/vendor/chart.js/dist/Chart.min.js') }}"></script>
    
    <!-- app JavaScript -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    
    <script>
        $(document).ready(function() {
            // Initialize DataTable
            $('#transactionsTable').DataTable({
                pageLength: 10,
                order: [[0, 'desc']],
                responsive: true
            });
            
            // Initialize chart
            const ctx = document.getElementById('balanceChart').getContext('2d');
            const balanceChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: 'Account Balance',
                        data: [100000, 110000, 115000, 120000, 122000, 125000],
                        borderColor: '#007bff',
                        backgroundColor: 'rgba(0, 123, 255, 0.1)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: false,
                            ticks: {
                                callback: function(value) {
                                    return '₹' + value.toLocaleString();
                                }
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return 'Balance: ₹' + context.parsed.y.toLocaleString();
                                }
                            }
                        }
                    }
                }
            });
        });
        
        // Filter transactions
        window.filterTransactions = function(days) {
            console.log('Filtering transactions for last', days, 'days');
            // In real app: reload table with filtered data
            alert('Filter applied! Showing last ' + days + ' days');
        };
        
        // Print account statement
        window.printAccountStatement = function() {
            const printWindow = window.open('', '_blank');
            printWindow.document.write(`
                <html>
                    <head>
                        <title>Account Statement - Cash in Hand</title>
                        <style>
                            body { font-family: Arial, sans-serif; margin: 20px; }
                            .header { text-align: center; margin-bottom: 30px; }
                            .account-info { margin-bottom: 20px; }
                            table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
                            th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                            th { background-color: #f2f2f2; }
                            .total-row { font-weight: bold; }
                            .footer { text-align: center; margin-top: 30px; font-size: 12px; color: #666; }
                        </style>
                    </head>
                    <body>
                        <div class="header">
                            <h2>Account Statement</h2>
                            <h3>Cash in Hand (1001)</h3>
                            <p>Statement Period: ${new Date().toLocaleDateString()}</p>
                        </div>
                        <div class="account-info">
                            <p><strong>Current Balance:</strong> ₹125,000</p>
                            <p><strong>Account Type:</strong> Asset - Cash Account</p>
                            <p><strong>Branch:</strong> Main Branch</p>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Description</th>
                                    <th>Debit</th>
                                    <th>Credit</th>
                                    <th>Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>2024-03-20</td>
                                    <td>Cash sale - Invoice #INV-20240320-045</td>
                                    <td>₹5,000</td>
                                    <td></td>
                                    <td>₹125,000</td>
                                </tr>
                                <tr>
                                    <td>2024-03-19</td>
                                    <td>Petty cash expense - Office supplies</td>
                                    <td></td>
                                    <td>₹2,500</td>
                                    <td>₹120,000</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="footer">
                            <p>Generated on: ${new Date().toLocaleString()}</p>
                            <p>This is a computer-generated statement.</p>
                        </div>
                    </body>
                </html>
            `);
            printWindow.document.close();
            printWindow.print();
        };
        
        // Export account data
        window.exportAccountData = function(format) {
            alert(`Exporting account data in ${format} format...`);
            // In real app: window.location.href = `/accounts/1/export?format=${format}`;
        };
    </script>
    @endpush
</x-app-layout>