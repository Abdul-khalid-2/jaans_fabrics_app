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
            border: 2px solid #dee2e6;
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
        .audit-info {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }
    </style>
    @endpush

    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
            <div>
                <h4 class="mb-3">Edit Brand: Levi's</h4>
                <p class="mb-0">Update brand information and settings</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('brands.index') }}">Brands</a></li>
                        <li class="breadcrumb-item active">Edit Brand</li>
                    </ol>
                </nav>
            </div>
            <div class="d-flex">
                <a href="{{ route('brands.show', 1) }}" class="btn btn-info mr-2">
                    <i class="las la-eye mr-2"></i>View
                </a>
                <a href="{{ route('brands.index') }}" class="btn btn-secondary">
                    <i class="las la-arrow-left mr-2"></i>Back to Brands
                </a>
            </div>
        </div>

        <div class="row">
            <!-- Left Column - Form -->
            <div class="col-lg-8">
                <!-- Audit Information -->
                <div class="audit-info">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-2">
                                <strong>Created:</strong>
                                <span class="text-muted">2024-01-15 10:30 AM by Admin</span>
                            </div>
                            <div>
                                <strong>Last Updated:</strong>
                                <span class="text-muted">2024-01-20 03:45 PM by Manager</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <strong>Total Products:</strong>
                                <span class="badge badge-info">248</span>
                            </div>
                            <div>
                                <strong>Total Sales:</strong>
                                <span class="badge badge-success">$124,567.89</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <form id="editBrandForm">
                            <!-- Basic Information Section -->
                            <div class="form-section">
                                <h6 class="mb-3"><i class="las la-info-circle mr-2"></i>Basic Information</h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="edit_brand_code">Brand Code</label>
                                            <input type="text" class="form-control" id="edit_brand_code" 
                                                   value="BR-001" readonly>
                                            <small class="form-text text-muted">Brand code cannot be changed</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="edit_brand_name">Brand Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="edit_brand_name" 
                                                   value="Levi's" required>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="edit_description">Description</label>
                                    <textarea class="form-control" id="edit_description" rows="3">
Denim & Casual Wear brand established in 1853. Known for quality jeans and denim products worldwide.
                                    </textarea>
                                </div>
                            </div>

                            <!-- Brand Logo Section -->
                            <div class="form-section">
                                <h6 class="mb-3"><i class="las la-image mr-2"></i>Brand Logo</h6>
                                <div class="text-center mb-3">
                                    <div class="logo-preview" id="editLogoPreview">
                                        <img src="https://via.placeholder.com/150/1e40af/ffffff?text=LS" 
                                             alt="Logo Preview" id="editPreviewImage">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="edit_logo_upload" 
                                               accept="image/*" onchange="previewEditLogo(event)">
                                        <label class="custom-file-label" for="edit_logo_upload">Choose new logo...</label>
                                    </div>
                                    <small class="form-text text-muted">
                                        Recommended: 500x500px, PNG or JPG, Max 2MB
                                    </small>
                                </div>
                                <div class="text-center">
                                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="removeEditLogo()">
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
                                            <label for="edit_contact_email">Email Address</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="las la-envelope"></i>
                                                    </span>
                                                </div>
                                                <input type="email" class="form-control" id="edit_contact_email" 
                                                       value="contact@levi.com">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="edit_contact_phone">Phone Number</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="las la-phone"></i>
                                                    </span>
                                                </div>
                                                <input type="tel" class="form-control" id="edit_contact_phone" 
                                                       value="+1-555-1234">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="edit_website">Website</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="las la-globe"></i>
                                            </span>
                                        </div>
                                        <input type="url" class="form-control" id="edit_website" 
                                               value="https://www.levi.com">
                                    </div>
                                </div>
                            </div>

                            <!-- Location Information Section -->
                            <div class="form-section">
                                <h6 class="mb-3"><i class="las la-map-marker mr-2"></i>Location Information</h6>
                                <div class="form-group">
                                    <label for="edit_country_of_origin">Country of Origin</label>
                                    <select class="form-control select2" id="edit_country_of_origin">
                                        <option value="IN">India</option>
                                        <option value="US" selected>United States</option>
                                        <option value="DE">Germany</option>
                                        <option value="FR">France</option>
                                        <option value="IT">Italy</option>
                                        <option value="ES">Spain</option>
                                        <option value="UK">United Kingdom</option>
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
                            <input type="checkbox" class="custom-control-input" id="edit_is_active" checked>
                            <label class="custom-control-label" for="edit_is_active">
                                <strong>Active Brand</strong>
                            </label>
                            <small class="form-text text-muted d-block">
                                Active brands will appear in product selections.
                            </small>
                        </div>
                        
                        <div class="custom-control custom-switch mb-3">
                            <input type="checkbox" class="custom-control-input" id="edit_is_featured" checked>
                            <label class="custom-control-label" for="edit_is_featured">
                                <strong>Featured Brand</strong>
                            </label>
                            <small class="form-text text-muted d-block">
                                Featured brands will be highlighted.
                            </small>
                        </div>
                        
                        <hr>
                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary" form="editBrandForm">
                                <i class="las la-save mr-2"></i>Update Brand
                            </button>
                            <button type="button" class="btn btn-success" onclick="duplicateBrand()">
                                <i class="las la-copy mr-2"></i>Duplicate Brand
                            </button>
                            <button type="button" class="btn btn-outline-danger" onclick="deleteBrand()">
                                <i class="las la-trash mr-2"></i>Delete Brand
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Statistics Card -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="las la-chart-bar mr-2"></i>Brand Statistics</h6>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <div class="display-4 text-primary mb-1">248</div>
                            <div class="text-muted">Products</div>
                        </div>
                        
                        <div class="row text-center">
                            <div class="col-6 mb-3">
                                <div class="h5 mb-1 text-success">$124K</div>
                                <div class="text-muted small">Total Sales</div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="h5 mb-1 text-info">45</div>
                                <div class="text-muted small">Categories</div>
                            </div>
                        </div>
                        
                        <hr>
                        
                        <div class="small">
                            <div class="d-flex justify-content-between mb-1">
                                <span>Active Products:</span>
                                <span class="text-success">230</span>
                            </div>
                            <div class="d-flex justify-content-between mb-1">
                                <span>Inactive Products:</span>
                                <span class="text-danger">18</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span>Avg. Product Price:</span>
                                <span class="text-primary">$79.99</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions Card -->
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="las la-bolt mr-2"></i>Quick Actions</h6>
                    </div>
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            <a href="#" class="list-group-item list-group-item-action">
                                <i class="las la-tshirt text-primary mr-2"></i>
                                View Products (248)
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <i class="las la-chart-line text-success mr-2"></i>
                                View Sales Report
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <i class="las la-file-export text-info mr-2"></i>
                                Export Products List
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <i class="las la-history text-warning mr-2"></i>
                                View Activity Log
                            </a>
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
                        <i class="las la-exclamation-triangle mr-2"></i>Confirm Deletion
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete the brand <strong>"Levi's"</strong>?</p>
                    <div class="alert alert-danger">
                        <i class="las la-exclamation-circle mr-2"></i>
                        <strong>Warning:</strong> This action cannot be undone. All products under this brand will be affected.
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="confirmDelete">
                        <label class="custom-control-label" for="confirmDelete">
                            I understand the consequences and want to proceed
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn" disabled>
                        <i class="las la-trash mr-2"></i>Delete Brand
                    </button>
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
            
            // Delete confirmation
            $('#confirmDelete').change(function() {
                $('#confirmDeleteBtn').prop('disabled', !$(this).prop('checked'));
            });
            
            // Form submission
            $('#editBrandForm').submit(function(e) {
                e.preventDefault();
                if(validateEditForm()) {
                    updateBrand();
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
        
        function previewEditLogo(event) {
            const input = event.target;
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#editPreviewImage').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        
        function removeEditLogo() {
            if(confirm('Are you sure you want to remove the brand logo?')) {
                $('#editPreviewImage').attr('src', 'https://via.placeholder.com/150/e2e8f0/4a5568?text=Brand+Logo');
                $('#edit_logo_upload').val('');
                $('.custom-file-label').text('Choose new logo...');
            }
        }
        
        function validateEditForm() {
            const brandName = $('#edit_brand_name').val().trim();
            if (!brandName) {
                alert('Please enter a brand name.');
                $('#edit_brand_name').focus();
                return false;
            }
            
            const email = $('#edit_contact_email').val().trim();
            if (email && !isValidEmail(email)) {
                alert('Please enter a valid email address.');
                $('#edit_contact_email').focus();
                return false;
            }
            
            const website = $('#edit_website').val().trim();
            if (website && !isValidUrl(website)) {
                alert('Please enter a valid website URL.');
                $('#edit_website').focus();
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
        
        function updateBrand() {
            const formData = {
                id: 1,
                brand_code: $('#edit_brand_code').val(),
                brand_name: $('#edit_brand_name').val(),
                description: $('#edit_description').val(),
                contact_email: $('#edit_contact_email').val(),
                contact_phone: $('#edit_contact_phone').val(),
                website: $('#edit_website').val(),
                country_of_origin: $('#edit_country_of_origin').val(),
                is_active: $('#edit_is_active').is(':checked'),
                is_featured: $('#edit_is_featured').is(':checked')
            };
            
            console.log('Updating brand:', formData);
            alert('Brand updated successfully! (static demo)');
        }
        
        function duplicateBrand() {
            if(confirm('Create a duplicate of this brand?')) {
                const formData = {
                    brand_name: $('#edit_brand_name').val() + ' (Copy)',
                    description: $('#edit_description').val(),
                    contact_email: $('#edit_contact_email').val(),
                    contact_phone: $('#edit_contact_phone').val(),
                    website: $('#edit_website').val(),
                    country_of_origin: $('#edit_country_of_origin').val(),
                    is_active: $('#edit_is_active').is(':checked'),
                    is_featured: $('#edit_is_featured').is(':checked')
                };
                
                console.log('Duplicating brand:', formData);
                alert('Brand duplicated successfully! Redirecting to new brand...');
                
                // Simulate redirect to new brand edit page
                setTimeout(() => {
                    window.location.href = "{{ route('brands.create') }}";
                }, 1500);
            }
        }
        
        function deleteBrand() {
            $('#deleteModal').modal('show');
        }
        
        $('#confirmDeleteBtn').click(function() {
            console.log('Deleting brand:', 1);
            alert('Brand deleted successfully! (static demo)');
            
            // Redirect to brands list
            setTimeout(() => {
                window.location.href = "{{ route('brands.index') }}";
            }, 1500);
        });
    </script>
    @endpush
</x-app-layout>