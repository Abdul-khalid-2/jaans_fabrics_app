<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/remixicon/fonts/remixicon.css') }}">
    <style>
        .supplier-avatar {
            width: 150px;
            height: 150px;
            border-radius: 8px;
            object-fit: cover;
            border: 3px solid #fff;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            cursor: pointer;
        }
        .avatar-upload {
            position: relative;
            display: inline-block;
        }
        .avatar-upload-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.5);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            opacity: 0;
            transition: opacity 0.3s;
            cursor: pointer;
        }
        .avatar-upload:hover .avatar-upload-overlay {
            opacity: 1;
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
        .financial-summary {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }
        .summary-item {
            padding: 10px 0;
            border-bottom: 1px dashed #dee2e6;
        }
        .summary-item:last-child {
            border-bottom: none;
        }
    </style>
    @endpush

    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
            <div>
                <h4 class="mb-3">Edit Supplier</h4>
                <p class="mb-0">Update supplier information</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('suppliers.index') }}">Suppliers</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('suppliers.show', 1) }}">Textile Factory Ltd.</a></li>
                        <li class="breadcrumb-item active">Edit Supplier</li>
                    </ol>
                </nav>
            </div>
            <div>
                <a href="{{ route('suppliers.show', 1) }}" class="btn btn-outline-secondary">
                    <i class="las la-times mr-2"></i>Cancel
                </a>
                <button type="submit" form="supplierEditForm" class="btn btn-primary ml-2">
                    <i class="las la-save mr-2"></i>Update Supplier
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <!-- Financial Summary -->
                <div class="financial-summary">
                    <h6 class="mb-3"><i class="las la-chart-bar mr-2"></i>Financial Summary</h6>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="summary-item">
                                <small class="text-muted d-block">Total Purchases</small>
                                <h5 class="mb-0">₹1,250,000</h5>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="summary-item">
                                <small class="text-muted d-block">Outstanding Amount</small>
                                <h5 class="mb-0 text-warning">₹75,000</h5>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="summary-item">
                                <small class="text-muted d-block">Credit Limit</small>
                                <h5 class="mb-0">₹500,000</h5>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="summary-item">
                                <small class="text-muted d-block">Last Purchase</small>
                                <h5 class="mb-0">2 days ago</h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <form id="supplierEditForm" action="{{ route('suppliers.update', 1) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <div class="form-section">
                                <h6 class="form-section-title">Basic Information</h6>
                                <div class="row">
                                    <div class="col-md-3">
                                        <!-- Supplier Logo -->
                                        <div class="form-group text-center">
                                            <div class="avatar-upload mb-3">
                                                <img id="supplierLogoPreview" 
                                                     src="https://via.placeholder.com/150x150/007bff/ffffff?text=TF" 
                                                     class="supplier-avatar" alt="Supplier Logo">
                                                <div class="avatar-upload-overlay" onclick="document.getElementById('supplierLogoInput').click()">
                                                    <div class="text-center">
                                                        <i class="las la-camera fa-2x"></i>
                                                        <p class="mb-0">Change Logo</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="file" id="supplierLogoInput" name="logo" accept="image/*" style="display: none;">
                                            <small class="text-muted">Recommended: 300x300px, PNG/JPG</small>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Company Name <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="company_name" value="Textile Factory Ltd." required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Supplier Code</label>
                                                    <input type="text" class="form-control" name="supplier_code" value="SUP-20240001" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Contact Person</label>
                                                    <input type="text" class="form-control" name="contact_person" value="John Doe">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Supplier Type</label>
                                                    <select class="form-control" name="supplier_type" required>
                                                        <option value="manufacturer" selected>Manufacturer</option>
                                                        <option value="wholesaler">Wholesaler</option>
                                                        <option value="distributor">Distributor</option>
                                                        <option value="importer">Importer</option>
                                                        <option value="local_vendor">Local Vendor</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Rating</label>
                                                    <div class="rating-stars">
                                                        <i class="las la-star" data-rating="1"></i>
                                                        <i class="las la-star" data-rating="2"></i>
                                                        <i class="las la-star" data-rating="3"></i>
                                                        <i class="las la-star" data-rating="4"></i>
                                                        <i class="las la-star-half-alt" data-rating="5"></i>
                                                        <input type="hidden" name="rating" value="4.5">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Tax ID (GSTIN)</label>
                                                    <input type="text" class="form-control" name="tax_id" value="27AAACT2725Q1Z5">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Business ID</label>
                                                    <input type="text" class="form-control" name="business_id" value="BUS123456">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-section">
                                <h6 class="form-section-title">Contact Information</h6>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Email Address</label>
                                            <input type="email" class="form-control" name="email" value="john@textilefactory.com">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Phone Number <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="phone" value="9876543210" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Alternate Phone</label>
                                            <input type="text" class="form-control" name="alternate_phone" value="9876543211">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Website</label>
                                            <input type="url" class="form-control" name="website" value="https://textilefactory.com">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Country</label>
                                            <select class="form-control" name="country_code">
                                                <option value="IN" selected>India</option>
                                                <option value="US">United States</option>
                                                <option value="UK">United Kingdom</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label">Address</label>
                                    <textarea class="form-control" name="address" rows="2">123 Textile Street, Andheri East</textarea>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">City</label>
                                            <input type="text" class="form-control" name="city" value="Mumbai">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">State</label>
                                            <input type="text" class="form-control" name="state" value="Maharashtra">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Pincode</label>
                                            <input type="text" class="form-control" name="pincode" value="400069">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-section">
                                <h6 class="form-section-title">Financial Information</h6>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Credit Limit (₹)</label>
                                            <input type="number" class="form-control" name="credit_limit" value="500000" min="0" step="0.01">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Payment Terms</label>
                                            <input type="text" class="form-control" name="payment_terms" value="Net 30">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Payment Days</label>
                                            <input type="number" class="form-control" name="payment_days" value="30" min="0">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Current Balance (₹)</label>
                                            <input type="number" class="form-control" name="current_balance" value="75000" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Total Purchases (₹)</label>
                                            <input type="number" class="form-control" name="total_purchases" value="1250000" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-section">
                                <h6 class="form-section-title">Status & Settings</h6>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Status</label>
                                            <select class="form-control" name="is_active">
                                                <option value="1" selected>Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Blacklisted</label>
                                            <select class="form-control" name="is_blacklisted">
                                                <option value="0" selected>No</option>
                                                <option value="1">Yes</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Last Purchase Date</label>
                                            <input type="date" class="form-control" name="last_purchase_date" value="{{ date('Y-m-d', strtotime('-2 days')) }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label">Notes / Remarks</label>
                                    <textarea class="form-control" name="notes" rows="3">Reliable supplier for cotton fabrics. Good quality products.</textarea>
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-between mt-4">
                                <div>
                                    <button type="button" class="btn btn-outline-danger" onclick="deleteSupplier()">
                                        <i class="las la-trash mr-2"></i>Delete Supplier
                                    </button>
                                </div>
                                <div>
                                    <a href="{{ route('suppliers.show', 1) }}" class="btn btn-outline-secondary mr-2">
                                        <i class="las la-times mr-2"></i>Cancel
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="las la-save mr-2"></i>Update Supplier
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
    <script src="{{ asset('backend/assets/js/backend-bundle.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Supplier logo upload
            $('#supplierLogoInput').change(function(e) {
                const file = e.target.files[0];
                if(file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#supplierLogoPreview').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(file);
                }
            });
            
            // Star rating
            $('.rating-stars i').click(function() {
                const rating = $(this).data('rating');
                $('input[name="rating"]').val(rating);
                
                $('.rating-stars i').each(function() {
                    const starRating = $(this).data('rating');
                    if(starRating <= rating) {
                        $(this).removeClass('lar la-star la-star-half-alt').addClass('las la-star');
                    } else {
                        $(this).removeClass('las la-star la-star-half-alt').addClass('lar la-star');
                    }
                });
            });
            
            // Set initial rating
            const initialRating = 4.5;
            $('input[name="rating"]').val(initialRating);
            $('.rating-stars i').each(function() {
                const starRating = $(this).data('rating');
                if(starRating <= Math.floor(initialRating)) {
                    $(this).removeClass('lar la-star').addClass('las la-star');
                } else if(starRating === Math.ceil(initialRating) && initialRating % 1 !== 0) {
                    $(this).removeClass('lar la-star las la-star').addClass('las la-star-half-alt');
                }
            });
            
            // Form submission
            $('#supplierEditForm').submit(function(e) {
                e.preventDefault();
                
                // Basic validation
                const companyName = $('input[name="company_name"]').val().trim();
                const phone = $('input[name="phone"]').val().trim();
                
                if(!companyName) {
                    alert('Please enter company name');
                    $('input[name="company_name"]').focus();
                    return false;
                }
                
                if(!phone) {
                    alert('Please enter phone number');
                    $('input[name="phone"]').focus();
                    return false;
                }
                
                // Show loading
                $('button[type="submit"]').prop('disabled', true).html('<i class="las la-spinner la-spin mr-2"></i>Updating...');
                
                // Simulate API call
                setTimeout(() => {
                    alert('Supplier updated successfully!');
                    window.location.href = "{{ route('suppliers.show', 1) }}";
                }, 1500);
                
                return false;
            });
        });
        
        // Delete supplier
        window.deleteSupplier = function() {
            if(confirm('Are you sure you want to delete this supplier? This action cannot be undone.')) {
                // Show loading
                $('button').prop('disabled', true);
                
                // Simulate delete action
                setTimeout(() => {
                    alert('Supplier deleted successfully!');
                    window.location.href = "{{ route('suppliers.index') }}";
                }, 1500);
            }
        };
    </script>
    @endpush
</x-app-layout>