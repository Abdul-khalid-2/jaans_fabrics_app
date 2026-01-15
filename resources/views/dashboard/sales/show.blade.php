<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/remixicon/fonts/remixicon.css') }}">
    <style>
        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background: white;
        }
        .invoice-header {
            border-bottom: 2px solid #007bff;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .invoice-title {
            font-size: 28px;
            font-weight: bold;
            color: #007bff;
        }
        .invoice-status {
            font-size: 14px;
            padding: 5px 15px;
            border-radius: 20px;
        }
        .company-logo {
            max-height: 80px;
        }
        .invoice-table th {
            border-top: none;
            border-bottom: 2px solid #dee2e6;
        }
        .totals-table td {
            border: none;
            padding: 5px 0;
        }
        .totals-table tr:last-child td {
            border-top: 2px solid #007bff;
            font-weight: bold;
            font-size: 18px;
        }
        @media print {
            .no-print {
                display: none !important;
            }
            .invoice-container {
                max-width: 100%;
                padding: 0;
            }
            body {
                background: white !important;
            }
            .card {
                border: none !important;
                box-shadow: none !important;
            }
        }
    </style>
    @endpush

    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex flex-wrap align-items-center justify-content-between mb-4 no-print">
            <div>
                <h4 class="mb-3">Invoice Details</h4>
                <p class="mb-0">View and print invoice details</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('sales.index') }}">Sales</a></li>
                        <li class="breadcrumb-item active">Invoice</li>
                    </ol>
                </nav>
            </div>
            <div class="d-flex">
                <a href="{{ route('sales.index') }}" class="btn btn-outline-secondary mr-2">
                    <i class="las la-arrow-left mr-2"></i>Back
                </a>
                <button class="btn btn-primary mr-2" onclick="window.print()">
                    <i class="las la-print mr-2"></i>Print Invoice
                </button>
                <button class="btn btn-success" onclick="downloadPDF()">
                    <i class="las la-download mr-2"></i>Download PDF
                </button>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <!-- Invoice -->
                <div class="invoice-container">
                    <!-- Header -->
                    <div class="invoice-header">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="https://via.placeholder.com/150x50/007bff/ffffff?text=CLOTH+SHOP" 
                                         alt="Company Logo" class="company-logo mr-3">
                                    <div>
                                        <h2 class="invoice-title mb-0">CLOTH SHOP</h2>
                                        <p class="mb-0">Your Fashion Destination</p>
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <strong>Address:</strong> 123 Fashion Street, City Center, Mumbai - 400001
                                </div>
                                <div class="mb-2">
                                    <strong>Phone:</strong> +91 22 1234 5678
                                </div>
                                <div>
                                    <strong>Email:</strong> info@clothshop.com
                                </div>
                            </div>
                            <div class="col-md-6 text-right">
                                <h1 class="invoice-title mb-2">INVOICE</h1>
                                <div class="mb-3">
                                    <span class="invoice-status badge-success">PAID</span>
                                    <span class="invoice-status badge-primary ml-2">COMPLETED</span>
                                </div>
                                <div class="mb-2">
                                    <strong>Invoice No:</strong> INV-2024-00123
                                </div>
                                <div class="mb-2">
                                    <strong>Date:</strong> 15 November 2024
                                </div>
                                <div class="mb-2">
                                    <strong>Time:</strong> 10:30 AM
                                </div>
                                <div>
                                    <strong>Sales Person:</strong> John Doe
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Customer & Store Info -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="card-title text-primary">BILL TO</h6>
                                    <h5 class="mb-2">John Smith</h5>
                                    <p class="mb-1">Regular Customer</p>
                                    <p class="mb-1">john.smith@example.com</p>
                                    <p class="mb-1">+91 98765 43210</p>
                                    <p class="mb-0">123 Customer Street, Mumbai</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="card-title text-primary">STORE INFO</h6>
                                    <h5 class="mb-2">Main Store</h5>
                                    <p class="mb-1">Branch Code: MCS001</p>
                                    <p class="mb-1">GSTIN: 27AABCU9603R1ZX</p>
                                    <p class="mb-1">Phone: +91 22 1234 5678</p>
                                    <p class="mb-0">123 Fashion Street, Mumbai</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Items Table -->
                    <div class="table-responsive mb-4">
                        <table class="table table-bordered invoice-table">
                            <thead>
                                <tr class="bg-light">
                                    <th width="5%">#</th>
                                    <th width="45%">Description</th>
                                    <th width="10%" class="text-center">Qty</th>
                                    <th width="15%" class="text-right">Unit Price</th>
                                    <th width="15%" class="text-right">Discount</th>
                                    <th width="15%" class="text-right">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>
                                        <strong>Men's Cotton T-Shirt</strong>
                                        <br>
                                        <small class="text-muted">SKU: TS-MEN-001 | Size: M | Color: Blue</small>
                                    </td>
                                    <td class="text-center">2</td>
                                    <td class="text-right">₹1,299.00</td>
                                    <td class="text-right">₹0.00</td>
                                    <td class="text-right">₹2,598.00</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>
                                        <strong>Leather Belt</strong>
                                        <br>
                                        <small class="text-muted">SKU: BL-ACC-006 | Color: Black</small>
                                    </td>
                                    <td class="text-center">1</td>
                                    <td class="text-right">₹899.00</td>
                                    <td class="text-right">₹0.00</td>
                                    <td class="text-right">₹899.00</td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-right"><strong>Subtotal</strong></td>
                                    <td colspan="2" class="text-right"><strong>₹3,497.00</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Totals -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title text-primary">PAYMENT DETAILS</h6>
                                    <table class="totals-table w-100">
                                        <tr>
                                            <td>Payment Method:</td>
                                            <td class="text-right">Cash</td>
                                        </tr>
                                        <tr>
                                            <td>Amount Received:</td>
                                            <td class="text-right">₹3,500.00</td>
                                        </tr>
                                        <tr>
                                            <td>Change Given:</td>
                                            <td class="text-right text-success">₹3.00</td>
                                        </tr>
                                        <tr>
                                            <td>Transaction ID:</td>
                                            <td class="text-right">TXN-00123</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="mt-3">
                                <h6>Terms & Conditions</h6>
                                <small class="text-muted">
                                    1. Goods once sold will not be taken back.<br>
                                    2. All disputes subject to Mumbai jurisdiction.<br>
                                    3. 7 Days return policy with original bill.<br>
                                    4. Exchange within 3 days with tags intact.
                                </small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title text-primary">TAX SUMMARY</h6>
                                    <table class="totals-table w-100">
                                        <tr>
                                            <td>Subtotal:</td>
                                            <td class="text-right">₹3,497.00</td>
                                        </tr>
                                        <tr>
                                            <td>Discount (0%):</td>
                                            <td class="text-right">₹0.00</td>
                                        </tr>
                                        <tr>
                                            <td>Taxable Amount:</td>
                                            <td class="text-right">₹3,497.00</td>
                                        </tr>
                                        <tr>
                                            <td>CGST (9%):</td>
                                            <td class="text-right">₹314.73</td>
                                        </tr>
                                        <tr>
                                            <td>SGST (9%):</td>
                                            <td class="text-right">₹314.73</td>
                                        </tr>
                                        <tr>
                                            <td>Total Tax (18%):</td>
                                            <td class="text-right">₹629.46</td>
                                        </tr>
                                        <tr>
                                            <td>Round Off:</td>
                                            <td class="text-right">₹0.54</td>
                                        </tr>
                                        <tr class="bg-light">
                                            <td><strong>Grand Total:</strong></td>
                                            <td class="text-right"><strong class="text-primary">₹4,127.00</strong></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="row mt-4">
                        <div class="col-md-4 text-center">
                            <div class="border-top pt-3">
                                <p class="mb-1"><strong>Customer Signature</strong></p>
                                <div class="signature-placeholder" style="height: 50px; border-bottom: 1px dashed #666;"></div>
                            </div>
                        </div>
                        <div class="col-md-4 text-center">
                            <div class="border-top pt-3">
                                <p class="mb-1"><strong>Sales Person</strong></p>
                                <p class="mb-0">John Doe</p>
                            </div>
                        </div>
                        <div class="col-md-4 text-center">
                            <div class="border-top pt-3">
                                <p class="mb-1"><strong>Authorized Signature</strong></p>
                                <div class="signature-placeholder" style="height: 50px; border-bottom: 1px dashed #666;"></div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <p class="text-muted mb-0">Thank you for your business!</p>
                        <p class="text-muted">For any queries, contact: +91 22 1234 5678 | info@clothshop.com</p>
                    </div>
                </div>

                <!-- Additional Information (Non-Print) -->
                <div class="row mt-4 no-print">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="mb-0"><i class="las la-info-circle mr-2"></i>Additional Information</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <small class="text-muted d-block">Payment Status</small>
                                        <span class="badge badge-success">Paid</span>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted d-block">Sale Status</small>
                                        <span class="badge badge-success">Completed</span>
                                    </div>
                                    <div class="col-6 mt-3">
                                        <small class="text-muted d-block">Delivery Type</small>
                                        <span>Pickup</span>
                                    </div>
                                    <div class="col-6 mt-3">
                                        <small class="text-muted d-block">Invoice Created</small>
                                        <span>15 Nov 2024, 10:30 AM</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="mb-0"><i class="las la-cog mr-2"></i>Quick Actions</h6>
                            </div>
                            <div class="card-body">
                                <div class="d-grid gap-2">
                                    <button class="btn btn-outline-primary" data-toggle="modal" data-target="#emailModal">
                                        <i class="las la-envelope mr-2"></i>Email Invoice
                                    </button>
                                    <button class="btn btn-outline-success" data-toggle="modal" data-target="#smsModal">
                                        <i class="las la-sms mr-2"></i>Send SMS
                                    </button>
                                    <button class="btn btn-outline-warning" data-toggle="modal" data-target="#returnModal">
                                        <i class="las la-exchange-alt mr-2"></i>Create Return
                                    </button>
                                    <a href="{{ route('sales.edit', 1) }}" class="btn btn-outline-info">
                                        <i class="las la-edit mr-2"></i>Edit Sale
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Email Modal -->
    <div class="modal fade" id="emailModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Email Invoice</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label>Customer Email</label>
                            <input type="email" class="form-control" value="john.smith@example.com">
                        </div>
                        <div class="form-group">
                            <label>Subject</label>
                            <input type="text" class="form-control" value="Invoice INV-2024-00123 from Cloth Shop">
                        </div>
                        <div class="form-group">
                            <label>Message</label>
                            <textarea class="form-control" rows="4">Dear John Smith,

Please find attached your invoice INV-2024-00123 for your recent purchase.

Thank you for shopping with us!

Best regards,
Cloth Shop Team</textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Send Email</button>
                </div>
            </div>
        </div>
    </div>

    <!-- SMS Modal -->
    <div class="modal fade" id="smsModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Send SMS</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label>Customer Phone</label>
                            <input type="text" class="form-control" value="+91 98765 43210">
                        </div>
                        <div class="form-group">
                            <label>Message</label>
                            <textarea class="form-control" rows="4" maxlength="160">Dear John Smith, thank you for your purchase of ₹4,127.00. Invoice: INV-2024-00123. Visit again! - Cloth Shop</textarea>
                            <small class="form-text text-muted">160 characters remaining</small>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Send SMS</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Return Modal -->
    <div class="modal fade" id="returnModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Return</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Sold Qty</th>
                                        <th>Return Qty</th>
                                        <th>Reason</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <strong>Men's Cotton T-Shirt</strong>
                                            <br>
                                            <small>SKU: TS-MEN-001</small>
                                        </td>
                                        <td>2</td>
                                        <td>
                                            <input type="number" class="form-control form-control-sm" value="0" min="0" max="2">
                                        </td>
                                        <td>
                                            <select class="form-control form-control-sm">
                                                <option value="">Select Reason</option>
                                                <option value="defective">Defective</option>
                                                <option value="wrong_size">Wrong Size</option>
                                                <option value="color_issue">Color Issue</option>
                                                <option value="not_satisfied">Not Satisfied</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Leather Belt</strong>
                                            <br>
                                            <small>SKU: BL-ACC-006</small>
                                        </td>
                                        <td>1</td>
                                        <td>
                                            <input type="number" class="form-control form-control-sm" value="0" min="0" max="1">
                                        </td>
                                        <td>
                                            <select class="form-control form-control-sm">
                                                <option value="">Select Reason</option>
                                                <option value="defective">Defective</option>
                                                <option value="wrong_size">Wrong Size</option>
                                                <option value="color_issue">Color Issue</option>
                                                <option value="not_satisfied">Not Satisfied</option>
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group">
                            <label>Refund Method</label>
                            <select class="form-control">
                                <option value="cash">Cash Refund</option>
                                <option value="card">Card Refund</option>
                                <option value="store_credit">Store Credit</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Notes</label>
                            <textarea class="form-control" rows="3" placeholder="Additional notes for return"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Process Return</button>
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
        function downloadPDF() {
            alert('PDF download functionality would be implemented here');
            // In real app, this would generate and download PDF
        }
        
        // Character counter for SMS
        $('#smsModal textarea').on('input', function() {
            const length = $(this).val().length;
            const remaining = 160 - length;
            $(this).next('small').text(remaining + ' characters remaining');
        });
    </script>
    @endpush
</x-app-layout>