<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/remixicon/fonts/remixicon.css') }}">
    <style>
        .logo-preview {
            width: 150px;
            height: 150px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
            border: 2px dashed #dee2e6;
            margin: 0 auto;
            overflow: hidden;
        }
        .logo-preview img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }
        .country-option {
            display: flex;
            align-items: center;
            padding: 5px 10px;
        }
        .country-flag-small {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            margin-right: 10px;
            object-fit: cover;
        }
        .form-section {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            border-left: 4px solid #4e73df;
        }
        .form-section h6 {
            color: #4e73df;
        }
    </style>
    @endpush

    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
            <div>
                <h4 class="mb-3">Add New Brand</h4>
                <p class="mb-0">Add a new brand to your product catalog</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('brands.index') }}">Brands</a></li>
                        <li class="breadcrumb-item active">Add Brand</li>
                    </ol>
                </nav>
            </div>
            <div class="d-flex">
                <a href="{{ route('brands.index') }}" class="btn btn-secondary">
                    <i class="las la-arrow-left mr-2"></i>Back to Brands
                </a>
            </div>
        </div>

        <div class="row">
            <!-- Left Column - Form -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <form id="brandForm">
                            <!-- Basic Information Section -->
                            <div class="form-section">
                                <h6 class="mb-3"><i class="las la-info-circle mr-2"></i>Basic Information</h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="brand_code">Brand Code <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="brand_code" 
                                                   value="BR-{{ date('YmdHis') }}" readonly>
                                            <small class="form-text text-muted">Auto-generated unique code</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="brand_name">Brand Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="brand_name" 
                                                   placeholder="Enter brand name" required>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" id="description" rows="3" 
                                              placeholder="Brief description about the brand..."></textarea>
                                </div>
                            </div>

                            <!-- Brand Logo Section -->
                            <div class="form-section">
                                <h6 class="mb-3"><i class="las la-image mr-2"></i>Brand Logo</h6>
                                <div class="text-center mb-3">
                                    <div class="logo-preview" id="logoPreview">
                                        <img src="https://via.placeholder.com/150/e2e8f0/4a5568?text=Upload+Logo" 
                                             alt="Logo Preview" id="previewImage">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="logo_upload" 
                                               accept="image/*" onchange="previewLogo(event)">
                                        <label class="custom-file-label" for="logo_upload">Choose logo image...</label>
                                    </div>
                                    <small class="form-text text-muted">
                                        Recommended: 500x500px, PNG or JPG, Max 2MB. Logo will be displayed in product listings.
                                    </small>
                                </div>
                                <div class="text-center">
                                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="removeLogo()">
                                        <i class="las la-trash mr-1"></i> Remove Logo
                                    </button>
                                </div>
                            </div>

                            <!-- Contact Information Section -->
                            <div class="form-section">
                                <h6 class="mb-3"><i class="las la-address-book mr-2"></i>Contact Information</h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="contact_email">Email Address</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="las la-envelope"></i>
                                                    </span>
                                                </div>
                                                <input type="email" class="form-control" id="contact_email" 
                                                       placeholder="contact@brand.com">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="contact_phone">Phone Number</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="las la-phone"></i>
                                                    </span>
                                                </div>
                                                <input type="tel" class="form-control" id="contact_phone" 
                                                       placeholder="+1-555-1234">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="website">Website</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="las la-globe"></i>
                                            </span>
                                        </div>
                                        <input type="url" class="form-control" id="website" 
                                               placeholder="https://www.brand.com">
                                    </div>
                                </div>
                            </div>

                            <!-- Location Information Section -->
                            <div class="form-section">
                                <h6 class="mb-3"><i class="las la-map-marker mr-2"></i>Location Information</h6>
                                <div class="form-group">
                                    <label for="country_of_origin">Country of Origin</label>
                                    <select class="form-control select2" id="country_of_origin">
                                        <option value="">Select Country</option>
                                        <option value="US">
                                            <div class="country-option">
                                                <img src="https://flagcdn.com/w20/us.png" class="country-flag-small"> United States
                                            </div>
                                        </option>
                                        <option value="IN">
                                            <div class="country-option">
                                                <img src="https://flagcdn.com/w20/in.png" class="country-flag-small"> India
                                            </div>
                                        </option>
                                        <option value="DE">
                                            <div class="country-option">
                                                <img src="https://flagcdn.com/w20/de.png" class="country-flag-small"> Germany
                                            </div>
                                        </option>
                                        <option value="FR">
                                            <div class="country-option">
                                                <img src="https://flagcdn.com/w20/fr.png" class="country-flag-small"> France
                                            </div>
                                        </option>
                                        <option value="IT">
                                            <div class="country-option">
                                                <img src="https://flagcdn.com/w20/it.png" class="country-flag-small"> Italy
                                            </div>
                                        </option>
                                        <option value="ES">
                                            <div class="country-option">
                                                <img src="https://flagcdn.com/w20/es.png" class="country-flag-small"> Spain
                                            </div>
                                        </option>
                                        <option value="UK">
                                            <div class="country-option">
                                                <img src="https://flagcdn.com/w20/gb.png" class="country-flag-small"> United Kingdom
                                            </div>
                                        </option>
                                        <option value="CN">
                                            <div class="country-option">
                                                <img src="https://flagcdn.com/w20/cn.png" class="country-flag-small"> China
                                            </div>
                                        </option>
                                        <option value="JP">
                                            <div class="country-option">
                                                <img src="https://flagcdn.com/w20/jp.png" class="country-flag-small"> Japan
                                            </div>
                                        </option>
                                        <option value="KR">
                                            <div class="country-option">
                                                <img src="https://flagcdn.com/w20/kr.png" class="country-flag-small"> South Korea
                                            </div>
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Right Column - Sidebar -->
            <div class="col-lg-4">
                <!-- Status Card -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="las la-toggle-on mr-2"></i>Brand Status</h6>
                    </div>
                    <div class="card-body">
                        <div class="custom-control custom-switch mb-3">
                            <input type="checkbox" class="custom-control-input" id="is_active" checked>
                            <label class="custom-control-label" for="is_active">
                                <strong>Active Brand</strong>
                            </label>
                            <small class="form-text text-muted d-block">
                                Active brands will appear in product selections and website.
                            </small>
                        </div>
                        
                        <div class="custom-control custom-switch mb-3">
                            <input type="checkbox" class="custom-control-input" id="is_featured">
                            <label class="custom-control-label" for="is_featured">
                                <strong>Featured Brand</strong>
                            </label>
                            <small class="form-text text-muted d-block">
                                Featured brands will be highlighted on homepage.
                            </small>
                        </div>
                        
                        <hr>
                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary" form="brandForm">
                                <i class="las la-save mr-2"></i>Save Brand
                            </button>
                            <button type="button" class="btn btn-outline-success" onclick="saveAndNew()">
                                <i class="las la-save mr-2"></i>Save & Add Another
                            </button>
                            <button type="reset" class="btn btn-outline-secondary" form="brandForm">
                                <i class="las la-redo mr-2"></i>Reset Form
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Quick Stats Card -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="las la-chart-bar mr-2"></i>Brand Statistics</h6>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <div class="display-4 text-primary mb-1">0</div>
                            <div class="text-muted">Products</div>
                        </div>
                        
                        <div class="row text-center">
                            <div class="col-6 mb-3">
                                <div class="h5 mb-1">$0</div>
                                <div class="text-muted small">Total Sales</div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="h5 mb-1">0</div>
                                <div class="text-muted small">Categories</div>
                            </div>
                        </div>
                        
                        <hr>
                        
                        <div class="small text-muted">
                            <i class="las la-info-circle"></i> Statistics will update after brand creation
                        </div>
                    </div>
                </div>

                <!-- Validation Rules Card -->
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="las la-check-circle mr-2"></i>Validation Rules</h6>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled small">
                            <li class="mb-2">
                                <i class="las la-check text-success mr-2"></i>
                                Brand name is required
                            </li>
                            <li class="mb-2">
                                <i class="las la-check text-success mr-2"></i>
                                Brand code is auto-generated
                            </li>
                            <li class="mb-2">
                                <i class="las la-check text-success mr-2"></i>
                                Email format validation
                            </li>
                            <li class="mb-2">
                                <i class="las la-check text-success mr-2"></i>
                                Website URL format validation
                            </li>
                            <li>
                                <i class="las la-check text-success mr-2"></i>
                                Logo image size validation
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
    <!-- Backend Bundle JavaScript -->
    <script src="{{ asset('backend/assets/js/backend-bundle.min.js') }}"></script>
    
    <!-- app JavaScript -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    
    <!-- Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('.select2').select2({
                templateResult: formatCountry,
                templateSelection: formatCountry
            });
            
            // File upload label
            $('.custom-file-input').on('change', function() {
                const fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').text(fileName || 'Choose file...');
            });
            
            // Form submission
            $('#brandForm').submit(function(e) {
                e.preventDefault();
                if(validateForm()) {
                    saveBrand();
                }
            });
        });
        
        function formatCountry(country) {
            if (!country.id) { return country.text; }
            const $country = $(
                '<span>' + country.text + '</span>'
            );
            return $country;
        }
        
        function previewLogo(event) {
            const input = event.target;
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#previewImage').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        
        function removeLogo() {
            $('#previewImage').attr('src', 'https://via.placeholder.com/150/e2e8f0/4a5568?text=Upload+Logo');
            $('#logo_upload').val('');
            $('.custom-file-label').text('Choose logo image...');
        }
        
        function validateForm() {
            const brandName = $('#brand_name').val().trim();
            if (!brandName) {
                alert('Please enter a brand name.');
                $('#brand_name').focus();
                return false;
            }
            
            const email = $('#contact_email').val().trim();
            if (email && !isValidEmail(email)) {
                alert('Please enter a valid email address.');
                $('#contact_email').focus();
                return false;
            }
            
            const website = $('#website').val().trim();
            if (website && !isValidUrl(website)) {
                alert('Please enter a valid website URL (include http:// or https://).');
                $('#website').focus();
                return false;
            }
            
            return true;
        }
        
        function isValidEmail(email) {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }
        
        function isValidUrl(string) {
            try {
                new URL(string);
                return true;
            } catch (_) {
                return false;
            }
        }
        
        function saveBrand() {
            // Collect form data
            const formData = {
                brand_code: $('#brand_code').val(),
                brand_name: $('#brand_name').val(),
                description: $('#description').val(),
                contact_email: $('#contact_email').val(),
                contact_phone: $('#contact_phone').val(),
                website: $('#website').val(),
                country_of_origin: $('#country_of_origin').val(),
                is_active: $('#is_active').is(':checked'),
                is_featured: $('#is_featured').is(':checked')
            };
            
            console.log('Saving brand:', formData);
            alert('Brand saved successfully! (static demo)');
            
            // Redirect to brands list
            setTimeout(() => {
                window.location.href = "{{ route('brands.index') }}";
            }, 1500);
        }
        
        function saveAndNew() {
            if(validateForm()) {
                saveBrand();
                // Reset form for new entry
                setTimeout(() => {
                    $('#brandForm')[0].reset();
                    $('#brand_code').val('BR-' + new Date().getTime());
                    removeLogo();
                    $('#brand_name').focus();
                }, 1000);
            }
        }
    </script>
    @endpush
</x-app-layout>