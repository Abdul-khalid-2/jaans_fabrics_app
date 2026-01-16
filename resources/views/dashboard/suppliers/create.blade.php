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
        .bank-details {
            background: #e8f4ff;
            border-left: 4px solid #007bff;
            padding: 15px;
            border-radius: 4px;
        }
        .contact-info {
            background: #e8f8f0;
            border-left: 4px solid #28a745;
            padding: 15px;
            border-radius: 4px;
        }
    </style>
    @endpush

    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
            <div>
                <h4 class="mb-3">Create New Supplier</h4>
                <p class="mb-0">Add a new supplier/vendor to your system</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('suppliers.index') }}">Suppliers</a></li>
                        <li class="breadcrumb-item active">Create Supplier</li>
                    </ol>
                </nav>
            </div>
            <div>
                <a href="{{ route('suppliers.index') }}" class="btn btn-outline-secondary">
                    <i class="las la-times mr-2"></i>Cancel
                </a>
                <button type="submit" form="supplierCreateForm" class="btn btn-primary ml-2">
                    <i class="las la-save mr-2"></i>Save Supplier
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form id="supplierCreateForm" action="{{ route('suppliers.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="form-section">
                                <h6 class="form-section-title">Basic Information</h6>
                                <div class="row">
                                    <div class="col-md-3">
                                        <!-- Supplier Logo -->
                                        <div class="form-group text-center">
                                            <div class="avatar-upload mb-3">
                                                <img id="supplierLogoPreview" 
                                                     src="https://via.placeholder.com/150x150/007bff/ffffff?text=LOGO" 
                                                     class="supplier-avatar" alt="Supplier Logo">
                                                <div class="avatar-upload-overlay" onclick="document.getElementById('supplierLogoInput').click()">
                                                    <div class="text-center">
                                                        <i class="las la-camera fa-2x"></i>
                                                        <p class="mb-0">Upload Logo</p>
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
                                                    <input type="text" class="form-control" name="company_name" placeholder="Enter company name" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Supplier Code</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" name="supplier_code" value="SUP-{{ date('YmdHis') }}" readonly>
                                                        <div class="input-group-append">
                                                            <button type="button" class="btn btn-outline-secondary" onclick="generateSupplierCode()">
                                                                <i class="las la-sync"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Contact Person</label>
                                                    <input type="text" class="form-control" name="contact_person" placeholder="Enter contact person name">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Supplier Type</label>
                                                    <select class="form-control" name="supplier_type" required>
                                                        <option value="">Select Type</option>
                                                        <option value="manufacturer">Manufacturer</option>
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
                                                        <i class="lar la-star" data-rating="1"></i>
                                                        <i class="lar la-star" data-rating="2"></i>
                                                        <i class="lar la-star" data-rating="3"></i>
                                                        <i class="lar la-star" data-rating="4"></i>
                                                        <i class="lar la-star" data-rating="5"></i>
                                                        <input type="hidden" name="rating" value="0">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Tax ID (GSTIN)</label>
                                                    <input type="text" class="form-control" name="tax_id" placeholder="Enter GSTIN/Tax ID">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Business ID</label>
                                                    <input type="text" class="form-control" name="business_id" placeholder="Enter Business ID">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-section">
                                <h6 class="form-section-title">Contact Information</h6>
                                <div class="contact-info">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Email Address</label>
                                                <input type="email" class="form-control" name="email" placeholder="Enter email address">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Phone Number <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="phone" placeholder="Enter phone number" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Alternate Phone</label>
                                                <input type="text" class="form-control" name="alternate_phone" placeholder="Enter alternate phone">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Website</label>
                                                <input type="url" class="form-control" name="website" placeholder="https://example.com">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Country</label>
                                                <select class="form-control" name="country_code">
                                                    <option value="IN">India</option>
                                                    <option value="US">United States</option>
                                                    <option value="UK">United Kingdom</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="form-label">Address</label>
                                        <textarea class="form-control" name="address" rows="2" placeholder="Enter full address"></textarea>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">City</label>
                                                <input type="text" class="form-control" name="city" placeholder="Enter city">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">State</label>
                                                <input type="text" class="form-control" name="state" placeholder="Enter state">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Pincode</label>
                                                <input type="text" class="form-control" name="pincode" placeholder="Enter pincode">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-section">
                                <h6 class="form-section-title">Bank Details</h6>
                                <div class="bank-details">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Bank Name</label>
                                                <input type="text" class="form-control" name="bank_name" placeholder="Enter bank name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Account Number</label>
                                                <input type="text" class="form-control" name="account_number" placeholder="Enter account number">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Account Holder Name</label>
                                                <input type="text" class="form-control" name="account_holder" placeholder="Enter account holder name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Branch Name</label>
                                                <input type="text" class="form-control" name="branch_name" placeholder="Enter branch name">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">IFSC Code</label>
                                                <input type="text" class="form-control" name="ifsc_code" placeholder="Enter IFSC code">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Account Type</label>
                                                <select class="form-control" name="account_type">
                                                    <option value="">Select Type</option>
                                                    <option value="savings">Savings</option>
                                                    <option value="current">Current</option>
                                                    <option value="cc">Cash Credit</option>
                                                </select>
                                            </div>
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
                                            <input type="number" class="form-control" name="credit_limit" placeholder="0.00" min="0" step="0.01">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Payment Terms</label>
                                            <input type="text" class="form-control" name="payment_terms" placeholder="e.g., Net 30">
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
                                            <label class="form-label">Minimum Order Value (₹)</label>
                                            <input type="number" class="form-control" name="minimum_order_value" placeholder="0.00" min="0" step="0.01">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Delivery Days</label>
                                            <input type="number" class="form-control" name="delivery_days" value="7" min="1">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-section">
                                <h6 class="form-section-title">Additional Information</h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Status</label>
                                            <select class="form-control" name="is_active">
                                                <option value="1" selected>Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Blacklisted</label>
                                            <select class="form-control" name="is_blacklisted">
                                                <option value="0" selected>No</option>
                                                <option value="1">Yes</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label">Blacklist Reason</label>
                                    <textarea class="form-control" name="blacklist_reason" rows="2" placeholder="If blacklisted, specify reason"></textarea>
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label">Notes / Remarks</label>
                                    <textarea class="form-control" name="notes" rows="3" placeholder="Enter any additional notes"></textarea>
                                </div>
                            </div>
                            
                            <div class="form-section">
                                <h6 class="form-section-title">Branch Assignment</h6>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Assign to Branches</label>
                                            <div class="row">
                                                <div class="col-md-4 mb-3">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" name="branches[]" value="1" id="branch1" checked>
                                                        <label class="custom-control-label" for="branch1">
                                                            <strong>Main Store</strong><br>
                                                            <small>Mumbai Central</small>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" name="branches[]" value="2" id="branch2">
                                                        <label class="custom-control-label" for="branch2">
                                                            <strong>South Branch</strong><br>
                                                            <small>Andheri West</small>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" name="branches[]" value="3" id="branch3">
                                                        <label class="custom-control-label" for="branch3">
                                                            <strong>Warehouse</strong><br>
                                                            <small>Bhiwandi</small>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Primary Branch</label>
                                            <select class="form-control" name="primary_branch">
                                                <option value="1">Main Store</option>
                                                <option value="2">South Branch</option>
                                                <option value="3">Warehouse</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-between mt-4">
                                <button type="button" class="btn btn-outline-secondary" onclick="resetForm()">
                                    <i class="las la-redo mr-2"></i>Reset Form
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="las la-save mr-2"></i>Save Supplier
                                </button>
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
                        $(this).removeClass('lar la-star').addClass('las la-star');
                    } else {
                        $(this).removeClass('las la-star').addClass('lar la-star');
                    }
                });
            });
            
            // Auto-generate company code from name
            $('input[name="company_name"]').on('blur', function() {
                const companyName = $(this).val();
                if(companyName && !$('input[name="supplier_code"]').val().includes('SUP-')) {
                    const initials = companyName.match(/\b(\w)/g).join('').toUpperCase();
                    const code = initials + '-' + Date.now().toString().slice(-6);
                    $('input[name="supplier_code"]').val(code);
                }
            });
            
            // Form submission
            $('#supplierCreateForm').submit(function(e) {
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
                
                // Validate phone number format
                const phoneRegex = /^[0-9]{10}$/;
                if(!phoneRegex.test(phone.replace(/\D/g, ''))) {
                    alert('Please enter a valid 10-digit phone number');
                    $('input[name="phone"]').focus();
                    return false;
                }
                
                // Show loading
                $('button[type="submit"]').prop('disabled', true).html('<i class="las la-spinner la-spin mr-2"></i>Saving...');
                
                // Collect form data
                const formData = new FormData(this);
                
                // Simulate API call
                setTimeout(() => {
                    console.log('Form data:', Object.fromEntries(formData));
                    alert('Supplier created successfully!');
                    window.location.href = "{{ route('suppliers.index') }}";
                }, 1500);
                
                return false;
            });
        });
        
        // Generate supplier code
        window.generateSupplierCode = function() {
            const timestamp = Date.now().toString();
            const code = 'SUP-' + timestamp.slice(-10);
            $('input[name="supplier_code"]').val(code);
        };
        
        // Reset form
        window.resetForm = function() {
            if(confirm('Are you sure you want to reset the form? All data will be lost.')) {
                $('#supplierCreateForm')[0].reset();
                $('#supplierLogoPreview').attr('src', 'https://via.placeholder.com/150x150/007bff/ffffff?text=LOGO');
                $('input[name="supplier_code"]').val('SUP-' + Date.now().toString().slice(-10));
                $('input[name="rating"]').val('0');
                $('.rating-stars i').removeClass('las la-star').addClass('lar la-star');
            }
        };
    </script>
    @endpush
</x-app-layout>