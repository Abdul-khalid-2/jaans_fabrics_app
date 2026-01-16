<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/remixicon/fonts/remixicon.css') }}">
    <style>
        .adjustment-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 15px;
            padding: 25px;
            color: white;
            margin-bottom: 25px;
        }
        .adjustment-item {
            border: 1px solid #e3e6f0;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            background: white;
        }
        .status-badge {
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
        }
        .type-badge {
            padding: 5px 15px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: 600;
        }
        .quantity-change {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 16px;
        }
        .timeline {
            position: relative;
            padding-left: 30px;
        }
        .timeline:before {
            content: '';
            position: absolute;
            left: 15px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: #e9ecef;
        }
        .timeline-item {
            position: relative;
            margin-bottom: 20px;
            padding-left: 20px;
        }
        .timeline-item:before {
            content: '';
            position: absolute;
            left: -8px;
            top: 5px;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: #4e73df;
            border: 3px solid white;
            box-shadow: 0 0 0 3px #e9ecef;
        }
        .document-card {
            border: 2px dashed #dee2e6;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
        }
        .document-card:hover {
            border-color: #4e73df;
            background: #f8f9fa;
        }
    </style>
    @endpush

    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
            <div>
                <h4 class="mb-3">Adjustment Details</h4>
                <p class="mb-0">View complete details of stock adjustment</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('inventory.index') }}">Inventory</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('inventory.adjustments.index') }}">Adjustments</a></li>
                        <li class="breadcrumb-item active">ADJ-2024-00125</li>
                    </ol>
                </nav>
            </div>
            <div class="d-flex">
                <a href="{{ route('inventory.adjustments.edit', 1) }}" class="btn btn-warning mr-2">
                    <i class="las la-edit mr-2"></i>Edit
                </a>
                <button class="btn btn-outline-primary mr-2" onclick="printAdjustment()">
                    <i class="las la-print mr-2"></i>Print
                </button>
                <a href="{{ route('inventory.adjustments.index') }}" class="btn btn-secondary">
                    <i class="las la-arrow-left mr-2"></i>Back to List
                </a>
            </div>
        </div>

        <!-- Adjustment Header -->
        <div class="adjustment-header">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h3 class="mb-2">Stock Adjustment: ADJ-2024-00125</h3>
                    <div class="d-flex align-items-center flex-wrap">
                        <span class="status-badge bg-warning mr-3">Pending Approval</span>
                        <span class="type-badge bg-white text-dark mr-3">Damage</span>
                        <span class="text-white-80">
                            <i class="las la-store mr-1"></i> Main Store - Downtown
                        </span>
                    </div>
                </div>
                <div class="col-md-4 text-right">
                    <div class="h4 mb-2">January 25, 2024</div>
                    <div class="small">Created by: John Doe</div>
                    <div class="small">Created at: 14:30 PM</div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Left Column -->
            <div class="col-lg-8">
                <!-- Adjustment Summary -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="las la-info-circle mr-2"></i>Adjustment Summary</h6>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-3 text-center">
                                <div class="h2 text-primary mb-1">5</div>
                                <div class="text-muted">Total Items</div>
                            </div>
                            <div class="col-md-3 text-center">
                                <div class="h2 text-danger mb-1">-$245.00</div>
                                <div class="text-muted">Total Value</div>
                            </div>
                            <div class="col-md-3 text-center">
                                <div class="h2 text-warning mb-1">-5</div>
                                <div class="text-muted">Net Quantity</div>
                            </div>
                            <div class="col-md-3 text-center">
                                <div class="h2 text-success mb-1">1</div>
                                <div class="text-muted">Affected Products</div>
                            </div>
                        </div>

                        <!-- Reason -->
                        <div class="form-group">
                            <label><strong>Reason for Adjustment:</strong></label>
                            <div class="alert alert-light">
                                <p class="mb-0">Damaged during handling. Products have tears and stains. Not suitable for sale.</p>
                            </div>
                        </div>

                        <!-- Reference -->
                        <div class="form-group">
                            <label><strong>Reference:</strong></label>
                            <div>Damage Report #DR-2024-012</div>
                        </div>
                    </div>
                </div>

                <!-- Adjusted Products -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="las la-boxes mr-2"></i>Adjusted Products</h6>
                    </div>
                    <div class="card-body">
                        <!-- Product 1 -->
                        <div class="adjustment-item">
                            <div class="row align-items-center">
                                <div class="col-md-2 text-center">
                                    <img src="https://via.placeholder.com/60" class="rounded" alt="Product">
                                </div>
                                <div class="col-md-4">
                                    <h6 class="mb-1">Levi's 501 Original Jeans</h6>
                                    <small class="text-muted">SKU: LS-501-BL | Size: 32 | Color: Dark Blue</small>
                                </div>
                                <div class="col-md-2 text-center">
                                    <div class="quantity-change bg-danger text-white">-5</div>
                                </div>
                                <div class="col-md-2">
                                    <div class="small text-muted">From: 45 units</div>
                                    <div class="small text-muted">To: 40 units</div>
                                </div>
                                <div class="col-md-2 text-right">
                                    <div class="h6 mb-1">$245.00</div>
                                    <small class="text-muted">Cost: $49.00 × 5</small>
                                </div>
                            </div>
                            <div class="mt-3">
                                <small><strong>Notes:</strong> Damaged during unpacking. Two jeans have tears, three have permanent stains.</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Approval History -->
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="las la-history mr-2"></i>Approval History</h6>
                    </div>
                    <div class="card-body">
                        <div class="timeline">
                            <div class="timeline-item">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="mb-1">Adjustment Created</h6>
                                        <div class="small text-muted">
                                            <i class="las la-user"></i> John Doe (Store Manager)
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div class="small text-muted">Jan 25, 2024 14:30</div>
                                        <span class="badge badge-info">Submitted</span>
                                    </div>
                                </div>
                                <p class="mb-0 mt-2 small">Created adjustment for damaged inventory.</p>
                            </div>
                            <!-- Pending approval step -->
                            <div class="timeline-item">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="mb-1">Pending Approval</h6>
                                        <div class="small text-muted">
                                            <i class="las la-user-clock"></i> Awaiting review
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div class="small text-muted">Current</div>
                                        <span class="badge badge-warning">Pending</span>
                                    </div>
                                </div>
                                <p class="mb-0 mt-2 small">Requires supervisor approval for value over $200.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-lg-4">
                <!-- Actions Card -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="las la-cog mr-2"></i>Actions</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <button class="btn btn-success" onclick="approveAdjustment()">
                                <i class="las la-check-circle mr-2"></i>Approve Adjustment
                            </button>
                            <button class="btn btn-danger" onclick="rejectAdjustment()">
                                <i class="las la-times-circle mr-2"></i>Reject Adjustment
                            </button>
                            <button class="btn btn-warning" onclick="requestRevision()">
                                <i class="las la-redo mr-2"></i>Request Revision
                            </button>
                            <a href="{{ route('inventory.adjustments.edit', 1) }}" class="btn btn-outline-primary">
                                <i class="las la-edit mr-2"></i>Edit Adjustment
                            </a>
                            <button class="btn btn-outline-secondary" onclick="printAdjustment()">
                                <i class="las la-print mr-2"></i>Print Report
                            </button>
                            <button class="btn btn-outline-danger" data-toggle="modal" data-target="#deleteModal">
                                <i class="las la-trash mr-2"></i>Delete Adjustment
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Details Card -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="las la-list-alt mr-2"></i>Adjustment Details</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm">
                            <tr>
                                <th>Adjustment #:</th>
                                <td>ADJ-2024-00125</td>
                            </tr>
                            <tr>
                                <th>Type:</th>
                                <td>
                                    <span class="type-badge bg-warning text-white">Damage</span>
                                </td>
                            </tr>
                            <tr>
                                <th>Branch:</th>
                                <td>Main Store - Downtown</td>
                            </tr>
                            <tr>
                                <th>Created By:</th>
                                <td>John Doe (Store Manager)</td>
                            </tr>
                            <tr>
                                <th>Created Date:</th>
                                <td>Jan 25, 2024 14:30</td>
                            </tr>
                            <tr>
                                <th>Last Updated:</th>
                                <td>Jan 25, 2024 14:30</td>
                            </tr>
                            <tr>
                                <th>Status:</th>
                                <td>
                                    <span class="status-badge bg-warning text-white">Pending</span>
                                </td>
                            </tr>
                            <tr>
                                <th>Approver:</th>
                                <td><em>Awaiting assignment</em></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- Attachments -->
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="las la-paperclip mr-2"></i>Attachments</h6>
                    </div>
                    <div class="card-body">
                        <div class="document-card mb-3" onclick="viewAttachment('damage_report')">
                            <i class="las la-file-pdf fa-3x text-danger mb-2"></i>
                            <div class="small">Damage Report.pdf</div>
                            <div class="text-muted">245 KB</div>
                        </div>
                        <div class="document-card mb-3" onclick="viewAttachment('photos')">
                            <i class="las la-images fa-3x text-primary mb-2"></i>
                            <div class="small">Damage Photos.zip</div>
                            <div class="text-muted">2.4 MB</div>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-sm btn-outline-primary">
                                <i class="las la-plus mr-1"></i> Add Attachment
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger">
                        <i class="las la-exclamation-triangle mr-2"></i>Delete Adjustment
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete adjustment <strong>ADJ-2024-00125</strong>?</p>
                    <div class="alert alert-danger">
                        <i class="las la-exclamation-circle mr-2"></i>
                        <strong>Warning:</strong> This action cannot be undone. Stock levels will be reverted.
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="confirmDelete">
                        <label class="custom-control-label" for="confirmDelete">
                            I understand this will revert stock levels
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn" disabled onclick="deleteAdjustment()">
                        <i class="las la-trash mr-2"></i>Delete Adjustment
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Approval Modal -->
    <div class="modal fade" id="approvalModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-success">
                        <i class="las la-check-circle mr-2"></i>Approve Adjustment
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="approvalForm">
                        <div class="form-group">
                            <label>Approval Notes (Optional)</label>
                            <textarea class="form-control" rows="3" placeholder="Add any notes or comments..."></textarea>
                        </div>
                        <div class="form-group">
                            <label>Next Action</label>
                            <select class="form-control">
                                <option value="">Select action</option>
                                <option value="dispose">Dispose Damaged Goods</option>
                                <option value="return">Return to Supplier</option>
                                <option value="repair">Send for Repair</option>
                                <option value="store">Store as Samples</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success" form="approvalForm">Approve & Process</button>
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
            // Delete confirmation
            $('#confirmDelete').change(function() {
                $('#confirmDeleteBtn').prop('disabled', !$(this).prop('checked'));
            });
            
            // Form submission
            $('#approvalForm').submit(function(e) {
                e.preventDefault();
                approveAdjustmentConfirmed();
            });
        });
        
        function approveAdjustment() {
            $('#approvalModal').modal('show');
        }
        
        function approveAdjustmentConfirmed() {
            console.log('Approving adjustment...');
            alert('Adjustment approved successfully! Stock levels updated.');
            $('#approvalModal').modal('hide');
            
            // Update UI
            $('.status-badge')
                .removeClass('bg-warning')
                .addClass('bg-success')
                .text('Approved');
        }
        
        function rejectAdjustment() {
            if(confirm('Reject this adjustment? Stock levels will not be changed.')) {
                const reason = prompt('Enter reason for rejection:', '');
                if(reason !== null) {
                    console.log('Rejecting adjustment:', reason);
                    alert('Adjustment rejected!');
                    
                    // Update UI
                    $('.status-badge')
                        .removeClass('bg-warning')
                        .addClass('bg-danger')
                        .text('Rejected');
                }
            }
        }
        
        function requestRevision() {
            const notes = prompt('Enter revision request notes:', '');
            if(notes !== null) {
                console.log('Requesting revision:', notes);
                alert('Revision requested sent to creator.');
            }
        }
        
        function deleteAdjustment() {
            console.log('Deleting adjustment...');
            alert('Adjustment deleted successfully!');
            $('#deleteModal').modal('hide');
            
            // Redirect to list
            setTimeout(() => {
                window.location.href = "{{ route('inventory.adjustments.index') }}";
            }, 1500);
        }
        
        function printAdjustment() {
            window.print();
        }
        
        function viewAttachment(type) {
            alert(`Opening ${type} attachment...`);
            // Implement attachment viewing
        }
    </script>
    @endpush
</x-app-layout>