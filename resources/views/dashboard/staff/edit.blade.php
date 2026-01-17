<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/remixicon/fonts/remixicon.css') }}">
    @endpush

    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
            <div>
                <h4 class="mb-3">Edit Staff Profile</h4>
                <p class="mb-0">Update staff member information and details</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('staff.index') }}">Staff</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('staff.show', 1) }}">Profile</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </nav>
            </div>
            <div class="d-flex">
                <a href="{{ route('staff.show', 1) }}" class="btn btn-secondary mr-2">
                    <i class="las la-times mr-2"></i>Cancel
                </a>
                <button type="submit" form="editStaffForm" class="btn btn-primary">
                    <i class="las la-save mr-2"></i>Save Changes
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Edit Staff Information</h5>
                        <p class="mb-0 text-muted">Update the details below and save changes</p>
                    </div>
                    <div class="card-body">
                        <form id="editStaffForm">
                            <!-- Profile Header -->
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-xxl mr-4">
                                            <img src="https://ui-avatars.com/api/?name=Rajesh+Kumar&background=007bff&color=fff&size=300"
                                                class="rounded-circle" alt="Rajesh Kumar" id="profileImagePreview">
                                        </div>
                                        <div class="flex-grow-1">
                                            <h4 class="mb-1">Rajesh Kumar</h4>
                                            <p class="text-muted mb-2">EMP-S001 | Sales Manager</p>
                                            <div class="custom-file" style="width: 300px;">
                                                <input type="file" class="custom-file-input" id="profileImage" accept="image/*">
                                                <label class="custom-file-label" for="profileImage">Change Profile Picture</label>
                                            </div>
                                            <small class="form-text text-muted">JPG, PNG, max 2MB. Recommended: 300x300px</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Personal Information -->
                            <h6 class="mb-3 border-bottom pb-2">Personal Information</h6>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Full Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" value="Rajesh Kumar" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Username <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" value="rajesh_kumar" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" value="rajesh@clothshop.com" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Phone Number <span class="text-danger">*</span></label>
                                        <input type="tel" class="form-control" value="+91 98765 43210" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Alternate Phone</label>
                                        <input type="tel" class="form-control" value="+91 98765 43211">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Date of Birth</label>
                                        <input type="date" class="form-control" value="1990-03-15">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <select class="form-control">
                                            <option value="male" selected>Male</option>
                                            <option value="female">Female</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Marital Status</label>
                                        <select class="form-control">
                                            <option value="single">Single</option>
                                            <option value="married" selected>Married</option>
                                            <option value="divorced">Divorced</option>
                                            <option value="widowed">Widowed</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nationality</label>
                                        <input type="text" class="form-control" value="Indian">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <textarea class="form-control" rows="3">123, ABC Apartment, Mumbai - 400001</textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Employment Details -->
                            <h6 class="mb-3 mt-4 border-bottom pb-2">Employment Details</h6>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Employee Code</label>
                                        <input type="text" class="form-control" value="EMP-S001" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Designation <span class="text-danger">*</span></label>
                                        <select class="form-control" required>
                                            <option value="manager" selected>Manager</option>
                                            <option value="sales_executive">Sales Executive</option>
                                            <option value="cashier">Cashier</option>
                                            <option value="store_keeper">Store Keeper</option>
                                            <option value="accountant">Accountant</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Department <span class="text-danger">*</span></label>
                                        <select class="form-control" required>
                                            <option value="sales" selected>Sales</option>
                                            <option value="inventory">Inventory</option>
                                            <option value="accounts">Accounts</option>
                                            <option value="management">Management</option>
                                            <option value="purchasing">Purchasing</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Date of Joining</label>
                                        <input type="date" class="form-control" value="2022-01-15">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Employment Type</label>
                                        <select class="form-control">
                                            <option value="permanent" selected>Permanent</option>
                                            <option value="contract">Contract</option>
                                            <option value="temporary">Temporary</option>
                                            <option value="intern">Intern</option>
                                            <option value="probation">Probation</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Employment Status</label>
                                        <select class="form-control">
                                            <option value="active" selected>Active</option>
                                            <option value="inactive">Inactive</option>
                                            <option value="terminated">Terminated</option>
                                            <option value="resigned">Resigned</option>
                                            <option value="suspended">Suspended</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Basic Salary (Rs)</label>
                                        <input type="number" class="form-control" value="35000">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Commission Rate (%)</label>
                                        <input type="number" class="form-control" value="2.5" step="0.1">
                                    </div>
                                </div>
                            </div>

                            <!-- Branch Assignment -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Assigned Branches</label>
                                        <div class="d-flex flex-wrap">
                                            <div class="custom-control custom-checkbox mr-3 mb-2">
                                                <input type="checkbox" class="custom-control-input" id="branch1" checked>
                                                <label class="custom-control-label" for="branch1">Main Branch</label>
                                            </div>
                                            <div class="custom-control custom-checkbox mr-3 mb-2">
                                                <input type="checkbox" class="custom-control-input" id="branch2" checked>
                                                <label class="custom-control-label" for="branch2">Mall Branch</label>
                                            </div>
                                            <div class="custom-control custom-checkbox mr-3 mb-2">
                                                <input type="checkbox" class="custom-control-input" id="branch3" checked>
                                                <label class="custom-control-label" for="branch3">Warehouse</label>
                                            </div>
                                            <div class="custom-control custom-checkbox mb-2">
                                                <input type="checkbox" class="custom-control-input" id="branch4">
                                                <label class="custom-control-label" for="branch4">Sub Branch</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Primary Branch</label>
                                        <select class="form-control">
                                            <option value="1" selected>Main Branch</option>
                                            <option value="2">Mall Branch</option>
                                            <option value="3">Warehouse</option>
                                            <option value="4">Sub Branch</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Working Hours</label>
                                        <div class="row">
                                            <div class="col-6">
                                                <input type="time" class="form-control" value="09:00">
                                            </div>
                                            <div class="col-6">
                                                <input type="time" class="form-control" value="18:00">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Bank Details -->
                            <h6 class="mb-3 mt-4 border-bottom pb-2">Bank Details</h6>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Bank Name</label>
                                        <input type="text" class="form-control" value="HDFC Bank">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Account Number</label>
                                        <input type="text" class="form-control" value="123456789012">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Account Holder Name</label>
                                        <input type="text" class="form-control" value="Rajesh Kumar">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>IFSC Code</label>
                                        <input type="text" class="form-control" value="HDFC0000123">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Branch Name</label>
                                        <input type="text" class="form-control" value="Mumbai Main Branch">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Account Type</label>
                                        <select class="form-control">
                                            <option value="savings" selected>Savings Account</option>
                                            <option value="current">Current Account</option>
                                            <option value="salary">Salary Account</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Government IDs -->
                            <h6 class="mb-3 mt-4 border-bottom pb-2">Government IDs</h6>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Aadhar Number</label>
                                        <input type="text" class="form-control" value="1234 5678 9012">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>PAN Number</label>
                                        <input type="text" class="form-control" value="ABCDE1234F">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Passport Number</label>
                                        <input type="text" class="form-control" value="A1234567">
                                    </div>
                                </div>
                            </div>

                            <!-- Emergency Contact -->
                            <h6 class="mb-3 mt-4 border-bottom pb-2">Emergency Contact</h6>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Contact Person</label>
                                        <input type="text" class="form-control" value="Mrs. Sunita Kumar">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Contact Number</label>
                                        <input type="tel" class="form-control" value="+91 98765 43210">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Relationship</label>
                                        <input type="text" class="form-control" value="Mother">
                                    </div>
                                </div>
                            </div>

                            <!-- Sales Target -->
                            <h6 class="mb-3 mt-4 border-bottom pb-2">Sales Target</h6>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Monthly Target (Rs)</label>
                                        <input type="number" class="form-control" value="500000">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Quarterly Target (Rs)</label>
                                        <input type="number" class="form-control" value="1500000">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Annual Target (Rs)</label>
                                        <input type="number" class="form-control" value="6000000">
                                    </div>
                                </div>
                            </div>

                            <!-- Login & Security -->
                            <h6 class="mb-3 mt-4 border-bottom pb-2">Login & Security</h6>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>User Role</label>
                                        <select class="form-control">
                                            <option value="staff">Staff</option>
                                            <option value="manager" selected>Manager</option>
                                            <option value="admin">Administrator</option>
                                            <option value="super_admin">Super Admin</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Reset Password</label>
                                        <input type="password" class="form-control" placeholder="Leave blank to keep current">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Confirm Password</label>
                                        <input type="password" class="form-control" placeholder="Confirm new password">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="isActive" checked>
                                            <label class="custom-control-label" for="isActive">Active Staff Member</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="sendNotification">
                                            <label class="custom-control-label" for="sendNotification">Send notification about changes</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="mustChangePassword">
                                            <label class="custom-control-label" for="mustChangePassword">User must change password on next login</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Additional Notes -->
                            <h6 class="mb-3 mt-4 border-bottom pb-2">Additional Information</h6>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Notes</label>
                                        <textarea class="form-control" rows="4">Rajesh is a dedicated sales manager with excellent leadership skills. He has consistently exceeded sales targets for the past 6 quarters. Good team player and reliable performer.</textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Form Actions -->
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-end">
                                        <a href="{{ route('staff.show', 1) }}" class="btn btn-secondary mr-3">Cancel</a>
                                        <button type="button" class="btn btn-warning mr-3" onclick="resetForm()">Reset Changes</button>
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </div>
                            </div>
                        </form>
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

    <script>
        $(document).ready(function() {
            // Profile image preview
            $('#profileImage').on('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#profileImagePreview').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(file);
                    
                    // Update file label
                    $(this).next('.custom-file-label').text(file.name);
                }
            });

            // Form submission
            $('#editStaffForm').submit(function(e) {
                e.preventDefault();
                
                // Basic validation
                let valid = true;
                $('input[required]').each(function() {
                    if (!$(this).val()) {
                        valid = false;
                        $(this).addClass('is-invalid');
                    } else {
                        $(this).removeClass('is-invalid');
                    }
                });

                // Password validation
                const password = $('input[type="password"]').eq(0).val();
                const confirmPassword = $('input[type="password"]').eq(1).val();
                
                if (password && password !== confirmPassword) {
                    valid = false;
                    alert('Passwords do not match!');
                }

                if (valid) {
                    // Show success message
                    alert('Staff profile updated successfully!');
                    // In real app, you would submit via AJAX or redirect
                    window.location.href = "{{ route('staff.show', 1) }}";
                }
            });

            // Reset form
            window.resetForm = function() {
                if (confirm('Are you sure you want to reset all changes?')) {
                    $('#editStaffForm')[0].reset();
                    $('#profileImagePreview').attr('src', 'https://ui-avatars.com/api/?name=Rajesh+Kumar&background=007bff&color=fff&size=300');
                    $('.custom-file-label').text('Change Profile Picture');
                }
            };

            // Real-time salary calculation based on designation
            $('select').on('change', function() {
                if ($(this).attr('name') === 'designation') {
                    const designation = $(this).val();
                    let basicSalary = 0;
                    
                    switch(designation) {
                        case 'manager':
                            basicSalary = 35000;
                            break;
                        case 'sales_executive':
                            basicSalary = 20000;
                            break;
                        case 'cashier':
                            basicSalary = 18000;
                            break;
                        case 'store_keeper':
                            basicSalary = 18000;
                            break;
                        case 'accountant':
                            basicSalary = 25000;
                            break;
                    }
                    
                    $('input[value="35000"]').val(basicSalary);
                }
            });
        });
    </script>
    @endpush
</x-app-layout>