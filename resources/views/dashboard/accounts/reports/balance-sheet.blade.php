<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/remixicon/fonts/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <style>
        .balance-sheet-section {
            margin-bottom: 30px;
        }

        .section-header {
            background: #f8f9fa;
            padding: 10px 15px;
            border-left: 4px solid #007bff;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .account-row {
            padding: 8px 15px;
            border-bottom: 1px solid #e9ecef;
        }

        .account-row:hover {
            background-color: #f8f9fa;
        }

        .account-name {
            padding-left: 20px;
        }

        .sub-account {
            padding-left: 40px;
        }

        .total-row {
            background: #e9ecef;
            font-weight: 600;
            padding: 10px 15px;
        }

        .grand-total {
            background: #007bff;
            color: white;
            padding: 15px;
            font-size: 1.2rem;
            border-radius: 5px;
        }

        .amount-positive {
            color: #28a745;
        }

        .amount-negative {
            color: #dc3545;
        }

        .balance-check {
            font-size: 0.9rem;
            padding: 5px 10px;
            border-radius: 3px;
        }

        .balance-check.good {
            background: #d4edda;
            color: #155724;
        }

        .balance-check.bad {
            background: #f8d7da;
            color: #721c24;
        }
    </style>
    @endpush

    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
            <div>
                <h4 class="mb-3">Balance Sheet Report</h4>
                <p class="mb-0">Financial position as of {{ date('F d, Y') }}</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#">Reports</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('reports.financial.index') }}">Financial Reports</a></li>
                        <li class="breadcrumb-item active">Balance Sheet</li>
                    </ol>
                </nav>
            </div>
            <div>
                <button type="button" class="btn btn-outline-secondary" onclick="printReport()">
                    <i class="las la-print mr-2"></i>Print
                </button>
                <button type="button" class="btn btn-outline-primary ml-2" onclick="exportReport()">
                    <i class="las la-download mr-2"></i>Export
                </button>
                <button type="button" class="btn btn-primary ml-2" data-toggle="modal" data-target="#filterModal">
                    <i class="las la-filter mr-2"></i>Filter
                </button>
            </div>
        </div>

        <!-- Report Header -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <h2 class="mb-1">Balance Sheet</h2>
                        <p class="mb-0">As of: <strong>{{ date('F d, Y') }}</strong></p>
                        <p class="mb-0">Business: <strong>My Clothing Store</strong></p>
                    </div>
                    <div class="col-md-4 text-right">
                        <div class="alert alert-success">
                            <h4 class="mb-0">Assets = Liabilities + Equity</h4>
                            <p class="mb-0">Balance Check: <span class="balance-check good">✓ BALANCED</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Assets Column -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header bg-gradient-green text-white">
                        <h5 class="mb-0">ASSETS</h5>
                    </div>
                    <div class="card-body">
                        <!-- Current Assets -->
                        <div class="balance-sheet-section">
                            <div class="section-header">Current Assets</div>

                            <div class="account-row">
                                <div class="row">
                                    <div class="col-8 account-name">
                                        <i class="las la-wallet text-primary mr-2"></i>Cash and Cash Equivalents
                                    </div>
                                    <div class="col-4 text-right">
                                        <strong class="amount-positive">Rs125,000</strong>
                                    </div>
                                </div>
                            </div>

                            <div class="account-row sub-account">
                                <div class="row">
                                    <div class="col-8">Cash in Hand</div>
                                    <div class="col-4 text-right">Rs25,000</div>
                                </div>
                            </div>

                            <div class="account-row sub-account">
                                <div class="row">
                                    <div class="col-8">Bank Accounts</div>
                                    <div class="col-4 text-right">Rs100,000</div>
                                </div>
                            </div>

                            <div class="account-row">
                                <div class="row">
                                    <div class="col-8 account-name">
                                        <i class="las la-file-invoice-dollar text-info mr-2"></i>Accounts Receivable
                                    </div>
                                    <div class="col-4 text-right">
                                        <strong class="amount-positive">Rs75,000</strong>
                                    </div>
                                </div>
                            </div>

                            <div class="account-row">
                                <div class="row">
                                    <div class="col-8 account-name">
                                        <i class="las la-boxes text-warning mr-2"></i>Inventory
                                    </div>
                                    <div class="col-4 text-right">
                                        <strong class="amount-positive">Rs850,000</strong>
                                    </div>
                                </div>
                            </div>

                            <div class="account-row total-row">
                                <div class="row">
                                    <div class="col-8">
                                        <strong>Total Current Assets</strong>
                                    </div>
                                    <div class="col-4 text-right">
                                        <strong class="amount-positive">Rs1,050,000</strong>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Fixed Assets -->
                        <div class="balance-sheet-section">
                            <div class="section-header">Fixed Assets</div>

                            <div class="account-row">
                                <div class="row">
                                    <div class="col-8 account-name">
                                        <i class="las la-building text-secondary mr-2"></i>Property, Plant & Equipment
                                    </div>
                                    <div class="col-4 text-right">
                                        <strong class="amount-positive">Rs200,000</strong>
                                    </div>
                                </div>
                            </div>

                            <div class="account-row sub-account">
                                <div class="row">
                                    <div class="col-8">Furniture & Fixtures</div>
                                    <div class="col-4 text-right">Rs80,000</div>
                                </div>
                            </div>

                            <div class="account-row sub-account">
                                <div class="row">
                                    <div class="col-8">Less: Accumulated Depreciation</div>
                                    <div class="col-4 text-right">(Rs20,000)</div>
                                </div>
                            </div>

                            <div class="account-row total-row">
                                <div class="row">
                                    <div class="col-8">
                                        <strong>Total Fixed Assets</strong>
                                    </div>
                                    <div class="col-4 text-right">
                                        <strong class="amount-positive">Rs180,000</strong>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Assets -->
                        <div class="grand-total mt-4">
                            <div class="row">
                                <div class="col-8">
                                    <h4 class="mb-0">TOTAL ASSETS</h4>
                                </div>
                                <div class="col-4 text-right">
                                    <h3 class="mb-0">Rs1,230,000</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Liabilities & Equity Column -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header bg-gradient-orange text-white">
                        <h5 class="mb-0">LIABILITIES & EQUITY</h5>
                    </div>
                    <div class="card-body">
                        <!-- Current Liabilities -->
                        <div class="balance-sheet-section">
                            <div class="section-header">Current Liabilities</div>

                            <div class="account-row">
                                <div class="row">
                                    <div class="col-8 account-name">
                                        <i class="las la-file-invoice-dollar text-danger mr-2"></i>Accounts Payable
                                    </div>
                                    <div class="col-4 text-right">
                                        <strong class="amount-negative">Rs150,000</strong>
                                    </div>
                                </div>
                            </div>

                            <div class="account-row">
                                <div class="row">
                                    <div class="col-8 account-name">
                                        <i class="las la-credit-card text-warning mr-2"></i>Short-term Loans
                                    </div>
                                    <div class="col-4 text-right">
                                        <strong class="amount-negative">Rs50,000</strong>
                                    </div>
                                </div>
                            </div>

                            <div class="account-row">
                                <div class="row">
                                    <div class="col-8 account-name">
                                        <i class="las la-percentage text-info mr-2"></i>Tax Payable
                                    </div>
                                    <div class="col-4 text-right">
                                        <strong class="amount-negative">Rs30,000</strong>
                                    </div>
                                </div>
                            </div>

                            <div class="account-row total-row">
                                <div class="row">
                                    <div class="col-8">
                                        <strong>Total Current Liabilities</strong>
                                    </div>
                                    <div class="col-4 text-right">
                                        <strong class="amount-negative">Rs230,000</strong>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Long-term Liabilities -->
                        <div class="balance-sheet-section">
                            <div class="section-header">Long-term Liabilities</div>

                            <div class="account-row">
                                <div class="row">
                                    <div class="col-8 account-name">
                                        <i class="las la-hand-holding-usd text-secondary mr-2"></i>Long-term Loans
                                    </div>
                                    <div class="col-4 text-right">
                                        <strong class="amount-negative">Rs400,000</strong>
                                    </div>
                                </div>
                            </div>

                            <div class="account-row total-row">
                                <div class="row">
                                    <div class="col-8">
                                        <strong>Total Long-term Liabilities</strong>
                                    </div>
                                    <div class="col-4 text-right">
                                        <strong class="amount-negative">Rs400,000</strong>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Equity -->
                        <div class="balance-sheet-section">
                            <div class="section-header">Owner's Equity</div>

                            <div class="account-row">
                                <div class="row">
                                    <div class="col-8 account-name">
                                        <i class="las la-user-tie text-success mr-2"></i>Owner's Capital
                                    </div>
                                    <div class="col-4 text-right">
                                        <strong class="amount-positive">Rs500,000</strong>
                                    </div>
                                </div>
                            </div>

                            <div class="account-row">
                                <div class="row">
                                    <div class="col-8 account-name">
                                        <i class="las la-chart-line text-info mr-2"></i>Retained Earnings
                                    </div>
                                    <div class="col-4 text-right">
                                        <strong class="amount-positive">Rs100,000</strong>
                                    </div>
                                </div>
                            </div>

                            <div class="account-row total-row">
                                <div class="row">
                                    <div class="col-8">
                                        <strong>Total Equity</strong>
                                    </div>
                                    <div class="col-4 text-right">
                                        <strong class="amount-positive">Rs600,000</strong>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Liabilities & Equity -->
                        <div class="grand-total mt-4">
                            <div class="row">
                                <div class="col-8">
                                    <h4 class="mb-0">TOTAL LIABILITIES & EQUITY</h4>
                                </div>
                                <div class="col-4 text-right">
                                    <h3 class="mb-0">Rs1,230,000</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Financial Ratios -->
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Financial Ratios Analysis</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="text-center p-3 border rounded">
                                    <h3 class="mb-1 text-success">1.85</h3>
                                    <p class="mb-0 small">Current Ratio</p>
                                    <span class="badge badge-success">Good</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="text-center p-3 border rounded">
                                    <h3 class="mb-1 text-warning">0.85</h3>
                                    <p class="mb-0 small">Quick Ratio</p>
                                    <span class="badge badge-warning">Average</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="text-center p-3 border rounded">
                                    <h3 class="mb-1 text-success">0.51</h3>
                                    <p class="mb-0 small">Debt to Equity</p>
                                    <span class="badge badge-success">Good</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="text-center p-3 border rounded">
                                    <h3 class="mb-1 text-danger">2.05</h3>
                                    <p class="mb-0 small">Debt Ratio</p>
                                    <span class="badge badge-danger">High</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notes -->
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Notes</h5>
                    </div>
                    <div class="card-body">
                        <ul class="mb-0">
                            <li>All amounts are in Indian Rupees (Rs)</li>
                            <li>Report generated on: {{ date('F d, Y h:i A') }}</li>
                            <li>Values are rounded to the nearest rupee</li>
                            <li>This is an unaudited financial statement</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Modal -->
    <div class="modal fade" id="filterModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Balance Sheet Filters</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="filterForm">
                        <div class="form-group">
                            <label>As of Date</label>
                            <input type="date" class="form-control" name="as_of_date" value="{{ date('Y-m-d') }}">
                        </div>
                        <div class="form-group">
                            <label>Branch</label>
                            <select class="form-control" name="branch_id">
                                <option value="all">All Branches</option>
                                <option value="1">Main Branch</option>
                                <option value="2">Downtown Branch</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Level of Detail</label>
                            <select class="form-control" name="detail_level">
                                <option value="summary">Summary Only</option>
                                <option value="detailed" selected>Detailed View</option>
                                <option value="consolidated">Consolidated</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="showZeroBalance" checked>
                                <label class="custom-control-label" for="showZeroBalance">Show zero balance accounts</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="includeRatios" checked>
                                <label class="custom-control-label" for="includeRatios">Include financial ratios</label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="applyFilters()">Generate Report</button>
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
            // Print button
            window.printReport = function() {
                window.print();
            };

            // Export button
            window.exportReport = function() {
                const format = prompt('Select export format (PDF, Excel, CSV):', 'PDF');
                if (format) {
                    alert(`Exporting balance sheet in ${format} format...`);
                    // In real app: window.location.href = `/accounts/reports/balance-sheet/export?format=${format}`;
                }
            };

            // Apply filters
            window.applyFilters = function() {
                const formData = new FormData(document.getElementById('filterForm'));
                const filters = Object.fromEntries(formData);
                console.log('Applying filters:', filters);

                alert('Generating report with selected filters...');
                $('#filterModal').modal('hide');
                // In real app: reload page with filters or make API call
            };
        });
    </script>
    @endpush
</x-app-layout>