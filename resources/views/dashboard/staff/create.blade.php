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
                <h4 class="mb-3">Add New Staff</h4>
                <p class="mb-0">Create new staff profile and employment details</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('staff.index') }}">Staff</a></li>
                        <li class="breadcrumb-item active">Add Staff</li>
                    </ol>
                </nav>
            </div>
            <div class="d-flex">
                <a href="{{ route('staff.index') }}" class="btn btn-secondary">
                    <i class="las la-arrow-left mr-2"></i>Back to Staff List
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Staff Information</h5>
                        <p class="mb-0 text-muted">Fill in the staff details below</p>
                    </div>
                    <div class="card-body">
                        <form>
                            <!-- Personal Information -->
                            <h6 class="mb-3 border-bottom pb-2">Personal Information</h6>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Full Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter full name" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Username <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter username" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" placeholder="Enter email address" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Phone Number <span class="text-danger">*</span></label>
                                        <input type="tel" class="form-control" placeholder="+91 98765 43210" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Date of Birth</label>
                                        <input type="date" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <select class="form-control">
                                            <option value="">Select Gender</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Profile Image</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="profileImage">
                                            <label class="custom-file-label" for="profileImage">Choose file</label>
                                        </div>
                                        <small class="form-text text-muted">JPG, PNG, max 2MB</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Marital Status</label>
                                        <select class="form-control">
                                            <option value="single">Single</option>
                                            <option value="married">Married</option>
                                            <option value="divorced">Divorced</option>
                                            <option value="widowed">Widowed</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Emergency Contact</label>
                                        <input type="tel" class="form-control" placeholder="Emergency contact number">
                                    </div>
                                </div>
                            </div>

                            <!-- Employment Details -->
                            <h6 class="mb-3 mt-4 border-bottom pb-2">Employment Details</h6>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Employee Code <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="EMP-001" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Designation <span class="text-danger">*</span></label>
                                        <select class="form-control" required>
                                            <option value="">Select Designation</option>
                                            <option value="manager">Manager</option>
                                            <option value="sales_executive">Sales Executive</option>
                                            <option value="cashier">Cashier</option>
                                            <option value="store_keeper">Store Keeper</option>
                                            <option value="accountant">Accountant</option>
                                            <option value="hr_manager">HR Manager</option>
                                            <option value="purchase_manager">Purchase Manager</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Department <span class="text-danger">*</span></label>
                                        <select class="form-control" required>
                                            <option value="">Select Department</option>
                                            <option value="sales">Sales</option>
                                            <option value="inventory">Inventory</option>
                                            <option value="accounts">Accounts</option>
                                            <option value="management">Management</option>
                                            <option value="purchasing">Purchasing</option>
                                            <option value="hr">HR</option>
                                            <option value="marketing">Marketing</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Date of Joining <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Employment Type</label>
                                        <select class="form-control">
                                            <option value="permanent">Permanent</option>
                                            <option value="contract">Contract</option>
                                            <option value="temporary">Temporary</option>
                                            <option value="intern">Intern</option>
                                            <option value="probation">Probation</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Basic Salary <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" placeholder="25000" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Allowances</label>
                                        <input type="number" class="form-control" placeholder="2000">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Commission Rate (%)</label>
                                        <input type="number" class="form-control" placeholder="2.5" step="0.1">
                                    </div>
                                </div>
                            </div>

                            <!-- Branch Assignment -->
                            <h6 class="mb-3 mt-4 border-bottom pb-2">Branch Assignment</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Assigned Branches</label>
                                        <select class="form-control select2" multiple>
                                            <option value="1" selected>Main Branch - Mumbai</option>
                                            <option value="2">Mall Branch - Andheri</option>
                                            <option value="3">Warehouse Branch - Thane</option>
                                            <option value="4">Sub Branch - Bandra</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Primary Branch</label>
                                        <select class="form-control">
                                            <option value="1">Main Branch - Mumbai</option>
                                            <option value="2">Mall Branch - Andheri</option>
                                            <option value="3">Warehouse Branch - Thane</option>
                                            <option value="4">Sub Branch - Bandra</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Working Hours</label>
                                        <div class="row">
                                            <div class="col-6">
                                                <input type="time" class="form-control" value="09:00" placeholder="Start Time">
                                            </div>
                                            <div class="col-6">
                                                <input type="time" class="form-control" value="18:00" placeholder="End Time">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Weekly Off Day</label>
                                        <select class="form-control">
                                            <option value="sunday">Sunday</option>
                                            <option value="monday">Monday</option>
                                            <option value="tuesday">Tuesday</option>
                                            <option value="wednesday">Wednesday</option>
                                            <option value="thursday">Thursday</option>
                                            <option value="friday">Friday</option>
                                            <option value="saturday">Saturday</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Bank Details -->
                            <h6 class="mb-3 mt-4 border-bottom pb-2">Bank Details</h6>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Bank Name</label>
                                        <input type="text" class="form-control" placeholder="HDFC Bank">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Account Number</label>
                                        <input type="text" class="form-control" placeholder="123456789012">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Account Holder Name</label>
                                        <input type="text" class="form-control" placeholder="Account holder name">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>IFSC Code</label>
                                        <input type="text" class="form-control" placeholder="HDFC0000123">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Branch Name</label>
                                        <input type="text" class="form-control" placeholder="Mumbai Main Branch">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Bank Account Type</label>
                                        <select class="form-control">
                                            <option value="savings">Savings Account</option>
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
                                        <input type="text" class="form-control" placeholder="1234 5678 9012">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>PAN Number</label>
                                        <input type="text" class="form-control" placeholder="ABCDE1234F">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Passport Number</label>
                                        <input type="text" class="form-control" placeholder="A1234567">
                                    </div>
                                </div>
                            </div>

                            <!-- Emergency Contact Details -->
                            <h6 class="mb-3 mt-4 border-bottom pb-2">Emergency Contact Details</h6>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Emergency Contact Person</label>
                                        <input type="text" class="form-control" placeholder="Contact person name">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Emergency Contact Number</label>
                                        <input type="tel" class="form-control" placeholder="+91 98765 43210">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Relationship</label>
                                        <input type="text" class="form-control" placeholder="Father/Mother/Spouse">
                                    </div>
                                </div>
                            </div>

                            <!-- Sales Target (if applicable) -->
                            <h6 class="mb-3 mt-4 border-bottom pb-2">Sales Target</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Monthly Sales Target (Rs)</label>
                                        <input type="number" class="form-control" placeholder="200000">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Quarterly Sales Target (Rs)</label>
                                        <input type="number" class="form-control" placeholder="600000">
                                    </div>
                                </div>
                            </div>

                            <!-- Login Credentials -->
                            <h6 class="mb-3 mt-4 border-bottom pb-2">Login Credentials</h6>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Password <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" placeholder="Enter password" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Confirm Password <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" placeholder="Confirm password" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>User Role</label>
                                        <select class="form-control">
                                            <option value="staff">Staff</option>
                                            <option value="manager">Manager</option>
                                            <option value="admin">Administrator</option>
                                            <option value="super_admin">Super Admin</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="sendCredentials" checked>
                                            <label class="custom-control-label" for="sendCredentials">Send login credentials via email</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="mustChangePassword" checked>
                                            <label class="custom-control-label" for="mustChangePassword">User must change password on first login</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="isActive" checked>
                                            <label class="custom-control-label" for="isActive">Active Staff Member</label>
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
                                        <textarea class="form-control" rows="4" placeholder="Any additional notes about the staff member..."></textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Form Actions -->
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-end">
                                        <button type="reset" class="btn btn-secondary mr-3">Reset Form</button>
                                        <button type="submit" class="btn btn-primary">Create Staff Profile</button>
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

    <!-- Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('.select2').select2({
                placeholder: "Select branches",
                allowClear: true
            });

            // File input label
            $('#profileImage').on('change', function() {
                const fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').text(fileName || 'Choose file');
            });

            // Form validation
            $('form').submit(function(e) {
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

                if (valid) {
                    // Show success message
                    alert('Staff profile created successfully!');
                    // In real app, you would submit via AJAX or redirect
                    window.location.href = "{{ route('staff.index') }}";
                } else {
                    alert('Please fill in all required fields.');
                }
            });

            // Real-time employee code suggestion
            $('input[placeholder="EMP-001"]').on('blur', function() {
                if (!$(this).val()) {
                    // Auto-generate employee code based on department
                    const dept = $('#department').val();
                    let prefix = 'EMP';
                    
                    if (dept === 'sales') prefix = 'SALE';
                    else if (dept === 'inventory') prefix = 'INV';
                    else if (dept === 'accounts') prefix = 'ACC';
                    else if (dept === 'management') prefix = 'MGT';
                    
                    // Generate random number
                    const randomNum = Math.floor(100 + Math.random() * 900);
                    $(this).val(`${prefix}-${randomNum}`);
                }
            });
        });
    </script>
    @endpush
</x-app-layout>