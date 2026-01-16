<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/remixicon/fonts/remixicon.css') }}">
    <style>
        .transaction-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 10px;
            padding: 30px;
            margin-bottom: 30px;
        }

        .transaction-icon {
            width: 80px;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        .detail-card {
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid #dee2e6;
        }

        .detail-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 5px;
        }

        .detail-value {
            font-size: 1.1rem;
        }

        .timeline {
            position: relative;
            padding-left: 30px;
        }

        .timeline::before {
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
            margin-bottom: 20px;
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

        .attachment-thumb {
            width: 100px;
            height: 100px;
            border-radius: 8px;
            object-fit: cover;
            cursor: pointer;
            transition: transform 0.3s;
        }

        .attachment-thumb:hover {
            transform: scale(1.05);
        }

        .amount-badge {
            font-size: 1.5rem;
            padding: 10px 20px;
            border-radius: 50px;
        }

        .debit-badge {
            background: #28a745;
            color: white;
        }

        .credit-badge {
            background: #dc3545;
            color: white;
        }
    </style>
    @endpush

    <div class="container-fluid">
        <!-- Transaction Header -->
        <div class="transaction-header">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="d-flex align-items-center">
                        <div class="transaction-icon mr-4">
                            <i class="las la-money-bill-wave"></i>
                        </div>
                        <div>
                            <h2 class="mb-1">Cash Sale</h2>
                            <div class="d-flex align-items-center">
                                <span class="badge badge-light mr-3">TRX-20240320-001</span>
                                <span class="badge badge-success mr-3">Approved</span>
                                <span class="badge bg-gradient-green mr-3">Debit Transaction</span>
                                <span class="badge badge-info">Main Branch</span>
                            </div>
                            <p class="mb-0 mt-2">Cash sale for clothing items - Invoice #INV-20240320-045</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-right">
                    <div class="amount-badge debit-badge">
                        Rs5,000
                    </div>
                    <p class="mb-0 mt-2">March 20, 2024 10:30 AM</p>
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
                                <a href="{{ route('accounts.transactions.edit', 1) }}" class="btn btn-primary mr-2">
                                    <i class="las la-edit mr-2"></i>Edit Transaction
                                </a>
                                <button type="button" class="btn btn-outline-warning mr-2" onclick="reverseTransaction()">
                                    <i class="las la-exchange-alt mr-2"></i>Reverse
                                </button>
                                <button type="button" class="btn btn-outline-info mr-2" onclick="duplicateTransaction()">
                                    <i class="las la-copy mr-2"></i>Duplicate
                                </button>
                                <button type="button" class="btn btn-outline-success" onclick="printTransaction()">
                                    <i class="las la-print mr-2"></i>Print
                                </button>
                            </div>
                            <div>
                                <a href="{{ route('accounts.transactions.index') }}" class="btn btn-outline-secondary">
                                    <i class="las la-arrow-left mr-2"></i>Back to Transactions
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Transaction Details -->
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-md-6">
                        <div class="detail-card">
                            <h5 class="mb-3">Transaction Information</h5>
                            <div class="mb-3">
                                <div class="detail-label">Transaction Type</div>
                                <div class="detail-value">
                                    <span class="badge bg-gradient-green">Debit Transaction</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="detail-label">Account</div>
                                <div class="detail-value">
                                    <i class="las la-wallet mr-2 text-primary"></i>
                                    Cash in Hand (1001)
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="detail-label">Amount</div>
                                <div class="detail-value text-success">
                                    <h4 class="mb-0">Rs5,000</h4>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="detail-label">Date & Time</div>
                                <div class="detail-value">
                                    <i class="las la-calendar mr-2"></i> 2024-03-20
                                    <i class="las la-clock ml-3 mr-2"></i> 10:30 AM
                                </div>
                            </div>
                            <div>
                                <div class="detail-label">Status</div>
                                <div class="detail-value">
                                    <span class="badge badge-success">Approved</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="detail-card">
                            <h5 class="mb-3">Reference Information</h5>
                            <div class="mb-3">
                                <div class="detail-label">Reference Type</div>
                                <div class="detail-value">
                                    <span class="badge badge-info">Sale</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="detail-label">Reference ID</div>
                                <div class="detail-value">
                                    <span class="badge badge-light">INV-20240320-045</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="detail-label">Branch</div>
                                <div class="detail-value">
                                    <i class="las la-map-marker mr-2"></i> Main Branch
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="detail-label">Created By</div>
                                <div class="detail-value">
                                    <i class="las la-user mr-2"></i> Admin User
                                </div>
                            </div>
                            <div>
                                <div class="detail-label">Approved By</div>
                                <div class="detail-value">
                                    <i class="las la-user-check mr-2"></i> Admin User
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Description Card -->
                <div class="detail-card">
                    <h5 class="mb-3">Description & Notes</h5>
                    <div class="mb-3">
                        <div class="detail-label">Description</div>
                        <div class="detail-value">
                            Cash sale for clothing items - Invoice #INV-20240320-045
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="detail-label">Reference Details</div>
                        <div class="detail-value">
                            Cash sale processed during morning shift. Customer paid in full with cash.
                        </div>
                    </div>
                    <div>
                        <div class="detail-label">Internal Notes</div>
                        <div class="detail-value text-muted">
                            Cash sale processed during morning shift. No discounts applied.
                        </div>
                    </div>
                </div>

                <!-- Attachments -->
                <div class="detail-card">
                    <h5 class="mb-3">Attachments</h5>
                    <div class="row">
                        <div class="col-md-3 text-center mb-3">
                            <img src="https://via.placeholder.com/100x100/007bff/ffffff?text=PDF"
                                class="attachment-thumb" alt="Invoice PDF"
                                onclick="viewAttachment('invoice_20240320_045.pdf')">
                            <div class="mt-2">
                                <small class="text-muted">invoice_20240320_045.pdf</small>
                            </div>
                        </div>
                        <div class="col-md-3 text-center mb-3">
                            <img src="https://via.placeholder.com/100x100/28a745/ffffff?text=JPG"
                                class="attachment-thumb" alt="Receipt"
                                onclick="viewAttachment('receipt_001.jpg')">
                            <div class="mt-2">
                                <small class="text-muted">receipt_001.jpg</small>
                            </div>
                        </div>
                        <div class="col-md-3 text-center mb-3">
                            <div class="attachment-thumb bg-light d-flex align-items-center justify-content-center">
                                <i class="las la-file-alt fa-2x text-muted"></i>
                            </div>
                            <div class="mt-2">
                                <small class="text-muted">supporting_docs.zip</small>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button type="button" class="btn btn-sm btn-outline-primary" onclick="uploadMoreAttachments()">
                            <i class="las la-plus mr-1"></i> Add More Attachments
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Account Impact -->
                <div class="detail-card">
                    <h5 class="mb-3">Account Impact</h5>
                    <div class="mb-3">
                        <div class="detail-label">Account Balance Before</div>
                        <div class="detail-value">
                            Rs120,000
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="detail-label">Transaction Amount</div>
                        <div class="detail-value text-success">
                            +Rs5,000 (Debit)
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="detail-label">Account Balance After</div>
                        <div class="detail-value">
                            <strong>Rs125,000</strong>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('accounts.ledger.account', 1) }}" class="btn btn-outline-primary btn-block">
                            <i class="las la-file-invoice mr-2"></i>View Account Ledger
                        </a>
                    </div>
                </div>

                <!-- Audit Trail -->
                <div class="detail-card">
                    <h5 class="mb-3">Audit Trail</h5>
                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="detail-label">Created</div>
                            <div class="detail-value small">
                                By: Admin User<br>
                                At: 2024-03-20 10:30 AM
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="detail-label">Approved</div>
                            <div class="detail-value small">
                                By: Admin User<br>
                                At: 2024-03-20 10:35 AM
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="detail-label">Last Modified</div>
                            <div class="detail-value small">
                                By: Accountant<br>
                                At: 2024-03-21 09:15 AM<br>
                                <span class="text-muted">Updated description</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Related Transactions -->
                <div class="detail-card">
                    <h5 class="mb-3">Related Transactions</h5>
                    <div class="list-group list-group-flush">
                        <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <div>
                                <small class="text-muted">Invoice Payment</small>
                                <div>TRX-20240320-002</div>
                            </div>
                            <span class="badge badge-success">Rs2,500</span>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <div>
                                <small class="text-muted">Refund</small>
                                <div>TRX-20240319-005</div>
                            </div>
                            <span class="badge badge-danger">Rs1,000</span>
                        </a>
                    </div>
                    <div class="mt-3">
                        <button type="button" class="btn btn-sm btn-outline-secondary btn-block" onclick="findRelatedTransactions()">
                            <i class="las la-search mr-1"></i> Find More
                        </button>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="detail-card">
                    <h5 class="mb-3">Quick Actions</h5>
                    <div class="d-grid gap-2">
                        <button type="button" class="btn btn-outline-success" onclick="exportTransaction()">
                            <i class="las la-download mr-2"></i> Export as PDF
                        </button>
                        <button type="button" class="btn btn-outline-info" onclick="shareTransaction()">
                            <i class="las la-share-alt mr-2"></i> Share
                        </button>
                        <button type="button" class="btn btn-outline-warning" onclick="verifyTransaction()">
                            <i class="las la-check-double mr-2"></i> Verify
                        </button>
                        <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#deleteModal">
                            <i class="las la-trash mr-2"></i> Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Transaction Timeline -->
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Transaction Timeline</h5>
                    </div>
                    <div class="card-body">
                        <div class="timeline">
                            <div class="timeline-item">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="mb-1">Transaction Created</h6>
                                        <p class="mb-0 text-muted">Cash sale recorded in system</p>
                                        <small class="text-muted">
                                            <i class="las la-user mr-1"></i> Admin User
                                        </small>
                                    </div>
                                    <div class="text-right">
                                        <small class="text-muted">10:30 AM</small>
                                        <div class="mt-2">
                                            <span class="badge badge-light">System Entry</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="timeline-item">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="mb-1">Transaction Approved</h6>
                                        <p class="mb-0 text-muted">Reviewed and approved by supervisor</p>
                                        <small class="text-muted">
                                            <i class="las la-user-check mr-1"></i> Admin User
                                        </small>
                                    </div>
                                    <div class="text-right">
                                        <small class="text-muted">10:35 AM</small>
                                        <div class="mt-2">
                                            <span class="badge badge-success">Approved</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="timeline-item">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="mb-1">Description Updated</h6>
                                        <p class="mb-0 text-muted">Added invoice reference details</p>
                                        <small class="text-muted">
                                            <i class="las la-user-edit mr-1"></i> Accountant
                                        </small>
                                    </div>
                                    <div class="text-right">
                                        <small class="text-muted">Next day, 09:15 AM</small>
                                        <div class="mt-2">
                                            <span class="badge badge-info">Modified</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="timeline-item">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="mb-1">Attachments Added</h6>
                                        <p class="mb-0 text-muted">Invoice and receipt scanned and attached</p>
                                        <small class="text-muted">
                                            <i class="las la-paperclip mr-1"></i> System
                                        </small>
                                    </div>
                                    <div class="text-right">
                                        <small class="text-muted">Next day, 11:30 AM</small>
                                        <div class="mt-2">
                                            <span class="badge badge-secondary">Files Added</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
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
                        <i class="las la-exclamation-triangle fa-4x text-danger"></i>
                    </div>
                    <h5 class="text-center mb-3">Delete this transaction?</h5>

                    <div class="alert alert-danger">
                        <strong>Transaction Details:</strong><br>
                        Number: <strong>TRX-20240320-001</strong><br>
                        Amount: <strong>Rs5,000</strong><br>
                        Account: <strong>Cash in Hand (1001)</strong><br>
                        Date: <strong>March 20, 2024</strong>
                    </div>

                    <p class="text-danger text-center">
                        <strong>Warning:</strong> This action cannot be undone. The transaction will be permanently removed from all reports.
                    </p>

                    <div class="form-group">
                        <label>Deletion Reason</label>
                        <select class="form-control" id="deletionReason">
                            <option value="">Select Reason</option>
                            <option value="error">Data Entry Error</option>
                            <option value="duplicate">Duplicate Transaction</option>
                            <option value="test">Test Transaction</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Additional Notes</label>
                        <textarea class="form-control" id="deletionNotes" rows="2" placeholder="Explain why this transaction is being deleted"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" onclick="confirmDeletion()">
                        Delete Transaction
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Attachment Viewer Modal -->
    <div class="modal fade" id="attachmentModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="attachmentTitle">Attachment</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <img src="" id="attachmentImage" class="img-fluid" alt="Attachment" style="max-height: 500px; display: none;">
                    <div id="attachmentPlaceholder">
                        <i class="las la-file-pdf fa-4x text-danger mb-3"></i>
                        <h5>PDF Document</h5>
                        <p class="text-muted">This file cannot be previewed in browser.</p>
                        <a href="#" id="attachmentDownload" class="btn btn-primary">
                            <i class="las la-download mr-2"></i> Download File
                        </a>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a href="#" id="attachmentDownloadBtn" class="btn btn-primary">
                        <i class="las la-download mr-2"></i> Download
                    </a>
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
            // Initialize tooltips
            $('[data-toggle="tooltip"]').tooltip();
        });

        // View attachment
        window.viewAttachment = function(filename) {
            const ext = filename.split('.').pop().toLowerCase();
            const imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp'];

            $('#attachmentTitle').text(filename);

            if (imageExtensions.includes(ext)) {
                $('#attachmentImage').attr('src', `https://via.placeholder.com/800x600/007bff/ffffff?text=${filename}`).show();
                $('#attachmentPlaceholder').hide();
            } else {
                $('#attachmentImage').hide();
                $('#attachmentPlaceholder').show();
                $('#attachmentDownload').attr('href', '#').text(`Download ${filename}`);
                $('#attachmentDownloadBtn').attr('href', '#').text(`Download ${filename}`);
            }

            $('#attachmentModal').modal('show');
        };

        // Reverse transaction
        window.reverseTransaction = function() {
            if (confirm('Create a reversing entry for this transaction?')) {
                // In real app: redirect to reversal page or API call
                alert('Redirecting to reversal creation...');
                window.location.href = "{{ route('accounts.transactions.create') }}?reverse=1";
            }
        };

        // Duplicate transaction
        window.duplicateTransaction = function() {
            if (confirm('Create a duplicate of this transaction?')) {
                // In real app: API call to duplicate
                window.location.href = "{{ route('accounts.transactions.create') }}?duplicate=1";
            }
        };

        // Print transaction
        window.printTransaction = function() {
            const printWindow = window.open('', '_blank');
            printWindow.document.write(`
                <html>
                    <head>
                        <title>Transaction Receipt - TRX-20240320-001</title>
                        <style>
                            body { font-family: Arial, sans-serif; margin: 20px; }
                            .header { text-align: center; margin-bottom: 30px; }
                            .transaction-info { margin-bottom: 20px; }
                            .details { margin-bottom: 20px; }
                            .footer { text-align: center; margin-top: 30px; font-size: 12px; color: #666; }
                            table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
                            th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                            th { background-color: #f2f2f2; }
                        </style>
                    </head>
                    <body>
                        <div class="header">
                            <h2>Transaction Receipt</h2>
                            <h3>TRX-20240320-001</h3>
                        </div>
                        <div class="transaction-info">
                            <p><strong>Date:</strong> March 20, 2024 10:30 AM</p>
                            <p><strong>Type:</strong> Debit Transaction</p>
                            <p><strong>Status:</strong> Approved</p>
                            <p><strong>Amount:</strong> <span style="font-size: 1.5rem; font-weight: bold;">Rs5,000</span></p>
                        </div>
                        <div class="details">
                            <h4>Transaction Details</h4>
                            <table>
                                <tr>
                                    <th>Account</th>
                                    <td>Cash in Hand (1001)</td>
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <td>Cash sale for clothing items - Invoice #INV-20240320-045</td>
                                </tr>
                                <tr>
                                    <th>Reference</th>
                                    <td>Sale: INV-20240320-045</td>
                                </tr>
                                <tr>
                                    <th>Branch</th>
                                    <td>Main Branch</td>
                                </tr>
                                <tr>
                                    <th>Created By</th>
                                    <td>Admin User</td>
                                </tr>
                                <tr>
                                    <th>Approved By</th>
                                    <td>Admin User</td>
                                </tr>
                            </table>
                        </div>
                        <div class="footer">
                            <p>Generated on: ${new Date().toLocaleString()}</p>
                            <p>This is a computer-generated transaction receipt.</p>
                        </div>
                    </body>
                </html>
            `);
            printWindow.document.close();
            printWindow.print();
        };

        // Export transaction
        window.exportTransaction = function() {
            const format = prompt('Export format (pdf, excel, csv):', 'pdf');
            if (format) {
                alert(`Exporting transaction in ${format} format...`);
                // In real app: window.location.href = `/accounts/transactions/1/export?format=${format}`;
            }
        };

        // Share transaction
        window.shareTransaction = function() {
            const email = prompt('Enter email address to share with:');
            if (email) {
                alert(`Sharing transaction with ${email}...`);
                // In real app: API call to share via email
            }
        };

        // Verify transaction
        window.verifyTransaction = function() {
            if (confirm('Mark this transaction as verified?')) {
                // In real app: API call to verify
                alert('Transaction marked as verified!');
            }
        };

        // Confirm deletion
        window.confirmDeletion = function() {
            const reason = $('#deletionReason').val();
            const notes = $('#deletionNotes').val();

            if (!reason) {
                alert('Please select a deletion reason');
                return;
            }

            if (confirm('Permanently delete this transaction?')) {
                // Show loading
                $('#deleteModal').modal('hide');

                // Simulate delete API call
                setTimeout(() => {
                    alert('Transaction deleted successfully!');
                    window.location.href = "{{ route('accounts.transactions.index') }}";
                }, 1500);
            }
        };

        // Upload more attachments
        window.uploadMoreAttachments = function() {
            const input = document.createElement('input');
            input.type = 'file';
            input.multiple = true;
            input.accept = '.pdf,.jpg,.jpeg,.png,.doc,.docx,.xls,.xlsx';

            input.onchange = function(e) {
                const files = e.target.files;
                if (files.length > 0) {
                    alert(`Uploading ${files.length} file(s)...`);
                    // In real app: upload files via API
                }
            };

            input.click();
        };

        // Find related transactions
        window.findRelatedTransactions = function() {
            alert('Searching for related transactions...');
            // In real app: search for transactions with same reference or account
        };
    </script>
    @endpush
</x-app-layout>