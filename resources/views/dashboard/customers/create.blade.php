<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/remixicon/fonts/remixicon.css') }}">
    <style>
        .customer-avatar {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 5px solid #fff;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            object-fit: cover;
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
            border-radius: 50%;
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
        .tab-content {
            padding: 20px;
            border: 1px solid #dee2e6;
            border-top: none;
            border-radius: 0 0 8px 8px;
        }
        .nav-tabs .nav-link {
            border: 1px solid #dee2e6;
            border-bottom: none;
            margin-right: 5px;
            border-radius: 8px 8px 0 0;
        }
        .nav-tabs .nav-link.active {
            background-color: #007bff;
            color: white;
            border-color: #007bff;
        }
        .address-card {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            cursor: pointer;
            transition: all 0.3s;
        }
        .address-card:hover {
            border-color: #007bff;
            background-color: rgba(0,123,255,0.05);
        }
        .address-card.selected {
            border-color: #007bff;
            background-color: rgba(0,123,255,0.1);
            box-shadow: 0 0 10px rgba(0,123,255,0.1);
        }
        .color-option {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-right: 5px;
            border: 2px solid #dee2e6;
            cursor: pointer;
            display: inline-block;
        }
        .color-option.selected {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0,123,255,0.5);
        }
        .badge-tier {
            padding: 5px 12px;
            border-radius: 20px;
            font-weight: 600;
        }
        .badge-tier.bronze {
            background-color: #CD7F32;
            color: white;
        }
        .badge-tier.silver {
            background-color: #C0C0C0;
            color: black;
        }
        .badge-tier.gold {
            background-color: #FFD700;
            color: black;
        }
        .badge-tier.platinum {
            background-color: #E5E4E2;
            color: black;
        }
        .progress-loyalty {
            height: 20px;
            border-radius: 10px;
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
    </style>
    @endpush

    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
            <div>
                <h4 class="mb-3">Create New Customer</h4>
                <p class="mb-0">Add a new customer to your system</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('customers.index') }}">Customers</a></li>
                        <li class="breadcrumb-item active">Create Customer</li>
                    </ol>
                </nav>
            </div>
            <div>
                <a href="{{ route('customers.index') }}" class="btn btn-outline-secondary">
                    <i class="las la-times mr-2"></i>Cancel
                </a>
                <button type="submit" form="customerCreateForm" class="btn btn-primary ml-2">
                    <i class="las la-save mr-2"></i>Save Customer
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Customer Tabs -->
                        <ul class="nav nav-tabs" id="customerCreateTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="basic-create-tab" data-toggle="tab" href="#basic-create">
                                    <i class="las la-user mr-2"></i>Basic Info
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="address-create-tab" data-toggle="tab" href="#address-create">
                                    <i class="las la-map-marker mr-2"></i>Address
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="preferences-create-tab" data-toggle="tab" href="#preferences-create">
                                    <i class="las la-heart mr-2"></i>Preferences
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="loyalty-create-tab" data-toggle="tab" href="#loyalty-create">
                                    <i class="las la-crown mr-2"></i>Loyalty
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="financial-create-tab" data-toggle="tab" href="#financial-create">
                                    <i class="las la-wallet mr-2"></i>Financial
                                </a>
                            </li>
                        </ul>

                        <!-- Customer Form -->
                        <form id="customerCreateForm" action="{{ route('customers.store') }}" method="POST">
                            @csrf
                            <div class="tab-content" id="customerCreateTabContent">
                                <!-- Basic Info Tab -->
                                <div class="tab-pane fade show active" id="basic-create" role="tabpanel">
                                    <div class="form-section">
                                        <h6 class="form-section-title">Personal Information</h6>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <!-- Profile Picture -->
                                                <div class="form-group text-center">
                                                    <div class="avatar-upload mb-3">
                                                        <img id="avatarPreview" 
                                                             src="https://ui-avatars.com/api/?name=New+Customer&background=007bff&color=fff&size=150" 
                                                             class="customer-avatar" alt="Customer Avatar">
                                                        <div class="avatar-upload-overlay" onclick="document.getElementById('avatarInput').click()">
                                                            <div class="text-center">
                                                                <i class="las la-camera fa-2x"></i>
                                                                <p class="mb-0">Upload Photo</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="file" id="avatarInput" name="avatar" accept="image/*" style="display: none;">
                                                    <small class="text-muted">Click to upload customer photo</small>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-9">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="full_name" placeholder="Enter full name" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Customer Code</label>
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" name="customer_code" value="CUST-{{ date('YmdHis') }}" readonly>
                                                                <div class="input-group-append">
                                                                    <button type="button" class="btn btn-outline-secondary" onclick="generateCustomerCode()">
                                                                        <i class="las la-sync"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Email Address</label>
                                                            <input type="email" class="form-control" name="email" placeholder="customer@example.com">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Phone Number <span class="text-danger">*</span></label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">+91</span>
                                                                </div>
                                                                <input type="tel" class="form-control" name="phone" placeholder="98765 43210" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Alternate Phone</label>
                                                            <input type="tel" class="form-control" name="alternate_phone" placeholder="Alternate phone number">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Date of Birth</label>
                                                            <input type="date" class="form-control" name="date_of_birth">
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Gender</label>
                                                            <select class="form-control" name="gender">
                                                                <option value="">Select Gender</option>
                                                                <option value="male">Male</option>
                                                                <option value="female">Female</option>
                                                                <option value="other">Other</option>
                                                                <option value="prefer_not_to_say">Prefer not to say</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Customer Type</label>
                                                            <select class="form-control" name="customer_type">
                                                                <option value="walk_in" selected>Walk-in Customer</option>
                                                                <option value="regular">Regular Customer</option>
                                                                <option value="wholesale">Wholesale Customer</option>
                                                                <option value="corporate">Corporate Customer</option>
                                                                <option value="vip">VIP Customer</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Anniversary Date</label>
                                                            <input type="date" class="form-control" name="anniversary_date">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Age Group</label>
                                                            <select class="form-control" name="age_group">
                                                                <option value="">Select Age Group</option>
                                                                <option value="teen">Teen (13-19)</option>
                                                                <option value="young_adult">Young Adult (20-29)</option>
                                                                <option value="adult">Adult (30-45)</option>
                                                                <option value="senior">Senior (46+)</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-section">
                                        <h6 class="form-section-title">Address Information</h6>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Address Line 1</label>
                                                    <input type="text" class="form-control" name="address_line1" placeholder="Street address, P.O. Box">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Address Line 2</label>
                                                    <input type="text" class="form-control" name="address_line2" placeholder="Apartment, suite, unit, building, floor">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">City</label>
                                                    <input type="text" class="form-control" name="city" placeholder="City">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">State</label>
                                                    <input type="text" class="form-control" name="state" placeholder="State">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Pincode</label>
                                                    <input type="text" class="form-control" name="pincode" placeholder="Pincode">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Country</label>
                                                    <select class="form-control" name="country_code">
                                                        <option value="IN" selected>India</option>
                                                        <option value="US">United States</option>
                                                        <option value="UK">United Kingdom</option>
                                                        <option value="AU">Australia</option>
                                                        <option value="CA">Canada</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Tax ID (GSTIN)</label>
                                                    <input type="text" class="form-control" name="tax_id" placeholder="GSTIN Number">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-section">
                                        <h6 class="form-section-title">Business Information</h6>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Company Name</label>
                                                    <input type="text" class="form-control" name="company_name" placeholder="Company name (for corporate customers)">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Designation</label>
                                                    <input type="text" class="form-control" name="designation" placeholder="Designation/Role">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Reference Source</label>
                                                    <select class="form-control" name="reference_source">
                                                        <option value="">How did they find us?</option>
                                                        <option value="walk_in" selected>Walk-in</option>
                                                        <option value="referral">Referral</option>
                                                        <option value="social_media">Social Media</option>
                                                        <option value="advertisement">Advertisement</option>
                                                        <option value="online_search">Online Search</option>
                                                        <option value="other">Other</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Additional Notes</label>
                                                    <textarea class="form-control" name="notes" rows="3" placeholder="Any additional information about the customer"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Address Tab -->
                                <div class="tab-pane fade" id="address-create" role="tabpanel">
                                    <div class="alert alert-info mb-4">
                                        <i class="las la-info-circle mr-2"></i>
                                        <strong>Note:</strong> You can add multiple addresses for the customer. One address will be set as default.
                                    </div>
                                    
                                    <div class="form-section">
                                        <h6 class="form-section-title">Add New Address</h6>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Address Type</label>
                                                    <select class="form-control" name="addresses[0][type]" id="addressType">
                                                        <option value="home" selected>Home</option>
                                                        <option value="work">Work</option>
                                                        <option value="billing">Billing</option>
                                                        <option value="shipping">Shipping</option>
                                                        <option value="other">Other</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox mt-4">
                                                        <input type="checkbox" class="custom-control-input" name="addresses[0][is_default]" id="setDefault" checked>
                                                        <label class="custom-control-label" for="setDefault">Set as default address</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="form-label">Address Line 1 <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="addresses[0][address_line1]" id="addressLine1" placeholder="Street address, P.O. Box" required>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="form-label">Address Line 2</label>
                                            <input type="text" class="form-control" name="addresses[0][address_line2]" id="addressLine2" placeholder="Apartment, suite, unit, building, floor">
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">City <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="addresses[0][city]" id="city" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">State <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="addresses[0][state]" id="state" required>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Pincode <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="addresses[0][pincode]" id="pincode" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Country</label>
                                                    <select class="form-control" name="addresses[0][country_code]" id="country">
                                                        <option value="IN" selected>India</option>
                                                        <option value="US">United States</option>
                                                        <option value="UK">United Kingdom</option>
                                                        <option value="AU">Australia</option>
                                                        <option value="CA">Canada</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="form-label">Landmark</label>
                                            <input type="text" class="form-control" name="addresses[0][landmark]" id="landmark" placeholder="Nearby landmark">
                                        </div>
                                        
                                        <div class="d-flex justify-content-end">
                                            <button type="button" class="btn btn-outline-secondary mr-2" onclick="clearAddressForm()">
                                                Clear Form
                                            </button>
                                            <button type="button" class="btn btn-primary" onclick="addAddress()">
                                                <i class="las la-plus mr-2"></i>Add Another Address
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <div class="form-section" id="addressListSection" style="display: none;">
                                        <h6 class="form-section-title">Added Addresses</h6>
                                        <div id="addressList">
                                            <!-- Addresses will be added here dynamically -->
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Preferences Tab -->
                                <div class="tab-pane fade" id="preferences-create" role="tabpanel">
                                    <div class="form-section">
                                        <h6 class="form-section-title">Shopping Preferences</h6>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Preferred Size</label>
                                                    <select class="form-control" name="preferred_size" id="preferredSize">
                                                        <option value="">Select Size</option>
                                                        <option value="xs">XS</option>
                                                        <option value="s">S</option>
                                                        <option value="m">M</option>
                                                        <option value="l">L</option>
                                                        <option value="xl">XL</option>
                                                        <option value="xxl">XXL</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Preferred Color</label>
                                                    <div class="mb-2">
                                                        <div class="color-option" style="background-color: #0000FF;" title="Blue" onclick="selectColor(this)"></div>
                                                        <div class="color-option" style="background-color: #000000;" title="Black" onclick="selectColor(this)"></div>
                                                        <div class="color-option" style="background-color: #808080;" title="Gray" onclick="selectColor(this)"></div>
                                                        <div class="color-option" style="background-color: #FFFFFF; border: 1px solid #dee2e6;" title="White" onclick="selectColor(this)"></div>
                                                        <div class="color-option" style="background-color: #800000;" title="Maroon" onclick="selectColor(this)"></div>
                                                        <div class="color-option" style="background-color: #FF0000;" title="Red" onclick="selectColor(this)"></div>
                                                        <div class="color-option" style="background-color: #008000;" title="Green" onclick="selectColor(this)"></div>
                                                        <div class="color-option" style="background-color: #FFFF00;" title="Yellow" onclick="selectColor(this)"></div>
                                                    </div>
                                                    <input type="text" class="form-control" name="preferred_color" id="preferredColor" placeholder="e.g., Blue, Black, White">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Preferred Brand</label>
                                                    <input type="text" class="form-control" name="preferred_brand" id="preferredBrand" placeholder="e.g., Nike, Levi's, Zara">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Preferred Category</label>
                                                    <input type="text" class="form-control" name="preferred_category" id="preferredCategory" placeholder="e.g., Formal, Casual, Sports">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="form-label">Shopping Preferences</label>
                                            <textarea class="form-control" name="shopping_preferences" rows="3" placeholder="Any specific shopping preferences, style preferences, etc."></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="form-section">
                                        <h6 class="form-section-title">Communication Preferences</h6>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="custom-control custom-checkbox mb-3">
                                                    <input type="checkbox" class="custom-control-input" name="receive_email_offers" id="emailOffers" value="1" checked>
                                                    <label class="custom-control-label" for="emailOffers">Email Offers & Updates</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="custom-control custom-checkbox mb-3">
                                                    <input type="checkbox" class="custom-control-input" name="receive_sms_offers" id="smsOffers" value="1" checked>
                                                    <label class="custom-control-label" for="smsOffers">SMS Offers</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="custom-control custom-checkbox mb-3">
                                                    <input type="checkbox" class="custom-control-input" name="receive_whatsapp_updates" id="whatsappUpdates" value="1" checked>
                                                    <label class="custom-control-label" for="whatsappUpdates">WhatsApp Updates</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-section">
                                        <h6 class="form-section-title">Special Requirements</h6>
                                        <div class="form-group">
                                            <textarea class="form-control" name="special_requirements" rows="3" placeholder="Any special requirements, allergies, or notes"></textarea>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Loyalty Tab -->
                                <div class="tab-pane fade" id="loyalty-create" role="tabpanel">
                                    <div class="form-section">
                                        <h6 class="form-section-title">Loyalty Program Settings</h6>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Loyalty Tier</label>
                                                    <select class="form-control" name="loyalty_tier" id="loyaltyTier">
                                                        <option value="bronze" selected>Bronze</option>
                                                        <option value="silver">Silver</option>
                                                        <option value="gold">Gold</option>
                                                        <option value="platinum">Platinum</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Initial Points</label>
                                                    <input type="number" class="form-control" name="loyalty_points" value="100" min="0">
                                                    <small class="form-text text-muted">Points to award on registration</small>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Total Points Earned</label>
                                                    <input type="number" class="form-control" name="total_points_earned" value="100" min="0" readonly>
                                                    <small class="form-text text-muted">Automatically calculated</small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Total Points Redeemed</label>
                                                    <input type="number" class="form-control" name="total_points_redeemed" value="0" min="0" readonly>
                                                    <small class="form-text text-muted">Automatically calculated</small>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="alert alert-info mt-3">
                                            <i class="las la-info-circle mr-2"></i>
                                            <strong>Loyalty Benefits by Tier:</strong>
                                            <ul class="mb-0 mt-2">
                                                <li><strong>Bronze:</strong> 1 point per ₹100 spent</li>
                                                <li><strong>Silver:</strong> 1.5 points per ₹100 spent</li>
                                                <li><strong>Gold:</strong> 2 points per ₹100 spent + Birthday Gift</li>
                                                <li><strong>Platinum:</strong> 3 points per ₹100 spent + Exclusive Offers + Personal Shopper</li>
                                            </ul>
                                        </div>
                                    </div>
                                    
                                    <div class="form-section">
                                        <h6 class="form-section-title">Tier Progress</h6>
                                        <div class="text-center mb-4">
                                            <div class="badge-tier bronze mb-3" style="font-size: 1.2rem;">BRONZE TIER</div>
                                            <div class="progress progress-loyalty mb-3">
                                                <div class="progress-bar" role="progressbar" style="width: 10%" 
                                                     aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <small class="text-muted">100 / 1,000 points to Silver Tier</small>
                                        </div>
                                        
                                        <div class="row text-center">
                                            <div class="col-md-4">
                                                <h6 class="text-primary mb-1">Bronze</h6>
                                                <small class="text-muted">0-999 pts</small>
                                            </div>
                                            <div class="col-md-4">
                                                <h6 class="text-muted mb-1">Silver</h6>
                                                <small class="text-muted">1,000-2,999 pts</small>
                                            </div>
                                            <div class="col-md-4">
                                                <h6 class="text-muted mb-1">Gold</h6>
                                                <small class="text-muted">3,000-5,999 pts</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Financial Tab -->
                                <div class="tab-pane fade" id="financial-create" role="tabpanel">
                                    <div class="form-section">
                                        <h6 class="form-section-title">Credit Settings</h6>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Credit Limit (₹)</label>
                                                    <input type="number" class="form-control" name="credit_limit" value="0" step="1000">
                                                    <small class="form-text text-muted">Maximum credit allowed (0 for no credit)</small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Payment Terms</label>
                                                    <input type="text" class="form-control" name="payment_terms" value="Net 30" placeholder="e.g., Net 30, COD, Advance">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Current Credit Used (₹)</label>
                                                    <input type="number" class="form-control" name="current_credit" value="0" step="0.01" readonly>
                                                    <small class="form-text text-muted">Automatically calculated</small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Outstanding Balance (₹)</label>
                                                    <input type="number" class="form-control" name="outstanding_balance" value="0" step="0.01" readonly>
                                                    <small class="form-text text-muted">Automatically calculated</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-section">
                                        <h6 class="form-section-title">Initial Statistics</h6>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Total Purchases (₹)</label>
                                                    <input type="number" class="form-control" name="total_purchases" value="0" step="0.01" readonly>
                                                    <small class="form-text text-muted">Will update with purchases</small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Total Visits</label>
                                                    <input type="number" class="form-control" name="total_visits" value="0" readonly>
                                                    <small class="form-text text-muted">Will update with store visits</small>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Average Transaction Value (₹)</label>
                                                    <input type="number" class="form-control" name="average_transaction_value" value="0" step="0.01" readonly>
                                                    <small class="form-text text-muted">Will calculate after first purchase</small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Last Purchase Date</label>
                                                    <input type="date" class="form-control" name="last_purchase_date" readonly>
                                                    <small class="form-text text-muted">Will update after first purchase</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-section">
                                        <h6 class="form-section-title">Account Status</h6>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Account Status</label>
                                                    <select class="form-control" name="is_active">
                                                        <option value="1" selected>Active</option>
                                                        <option value="0">Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Blacklist Status</label>
                                                    <select class="form-control" name="is_blacklisted">
                                                        <option value="0" selected>Not Blacklisted</option>
                                                        <option value="1">Blacklisted</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="form-label">Blacklist Reason (if applicable)</label>
                                            <textarea class="form-control" name="blacklist_reason" rows="2" placeholder="Reason for blacklisting"></textarea>
                                        </div>
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
        let addressCount = 0;
        const selectedColors = [];
        
        $(document).ready(function() {
            // Tab functionality
            $('#customerCreateTab a').on('click', function (e) {
                e.preventDefault();
                $(this).tab('show');
            });
            
            // Avatar upload
            $('#avatarInput').change(function(e) {
                const file = e.target.files[0];
                if(file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#avatarPreview').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(file);
                }
            });
            
            // Loyalty tier change
            $('#loyaltyTier').change(function() {
                const tier = $(this).val();
                const badgeClass = getTierBadgeClass(tier);
                $('.badge-tier').removeClass('bronze silver gold platinum').addClass(badgeClass).text(tier.toUpperCase() + ' TIER');
            });
            
            // Color selection
            $('.color-option').click(function() {
                $(this).toggleClass('selected');
                updateSelectedColors();
            });
            
            // Customer form submission
            $('#customerCreateForm').submit(function(e) {
                e.preventDefault();
                
                // Basic validation
                const requiredFields = ['full_name', 'phone'];
                let isValid = true;
                
                requiredFields.forEach(field => {
                    const value = $(`[name="${field}"]`).val().trim();
                    if(!value) {
                        isValid = false;
                        $(`[name="${field}"]`).addClass('is-invalid');
                    } else {
                        $(`[name="${field}"]`).removeClass('is-invalid');
                    }
                });
                
                if(!isValid) {
                    alert('Please fill in all required fields marked with *');
                    return false;
                }
                
                // Collect form data
                const formData = new FormData(this);
                
                // Add selected colors
                formData.append('selected_colors', JSON.stringify(selectedColors));
                
                // Show loading
                $('button[type="submit"]').prop('disabled', true).html('<i class="las la-spinner la-spin mr-2"></i>Saving...');
                
                // Simulate API call
                setTimeout(() => {
                    console.log('Form data:', Object.fromEntries(formData));
                    alert('Customer created successfully!');
                    window.location.href = "{{ route('customers.index') }}";
                }, 1500);
                
                // In real app, you would use AJAX or let the form submit normally
                // return true; // Uncomment to allow normal form submission
            });
        });
        
        // Generate customer code
        window.generateCustomerCode = function() {
            const timestamp = Date.now().toString();
            const code = 'CUST-' + timestamp.slice(-8);
            $('input[name="customer_code"]').val(code);
        };
        
        // Color selection functions
        window.selectColor = function(element) {
            $(element).toggleClass('selected');
            updateSelectedColors();
        };
        
        function updateSelectedColors() {
            selectedColors.length = 0;
            $('.color-option.selected').each(function() {
                const color = $(this).css('background-color');
                const title = $(this).attr('title');
                selectedColors.push({ color, title });
            });
            
            const colorNames = selectedColors.map(c => c.title).join(', ');
            $('#preferredColor').val(colorNames);
        }
        
        // Address management
        window.addAddress = function() {
            const type = $('#addressType').val();
            const line1 = $('#addressLine1').val();
            const line2 = $('#addressLine2').val();
            const city = $('#city').val();
            const state = $('#state').val();
            const pincode = $('#pincode').val();
            const country = $('#country option:selected').text();
            const landmark = $('#landmark').val();
            const isDefault = $('#setDefault').is(':checked');
            
            // Validation
            if(!line1 || !city || !state || !pincode) {
                alert('Please fill in all required address fields');
                return;
            }
            
            addressCount++;
            const addressId = `address-${addressCount}`;
            const badgeClass = getAddressTypeBadgeClass(type);
            
            const addressCard = `
                <div class="address-card" id="${addressId}">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <h6 class="mb-1">${type.charAt(0).toUpperCase() + type.slice(1)} Address</h6>
                            ${isDefault ? '<span class="badge badge-success mr-2">Default</span>' : ''}
                            <span class="badge ${badgeClass}">${type.charAt(0).toUpperCase() + type.slice(1)}</span>
                        </div>
                        <div>
                            <button type="button" class="btn btn-sm btn-outline-primary mr-2" onclick="editAddress('${addressId}')">
                                <i class="las la-edit"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeAddress('${addressId}')">
                                <i class="las la-trash"></i>
                            </button>
                        </div>
                    </div>
                    <p class="mb-1">${line1}</p>
                    ${line2 ? `<p class="mb-1">${line2}</p>` : ''}
                    <p class="mb-1">${city} - ${pincode}</p>
                    <p class="mb-1">${state}, ${country}</p>
                    ${landmark ? `<p class="mb-1"><i class="las la-map-marker"></i> Near ${landmark}</p>` : ''}
                    <input type="hidden" name="addresses[${addressCount}][type]" value="${type}">
                    <input type="hidden" name="addresses[${addressCount}][address_line1]" value="${line1}">
                    <input type="hidden" name="addresses[${addressCount}][address_line2]" value="${line2}">
                    <input type="hidden" name="addresses[${addressCount}][city]" value="${city}">
                    <input type="hidden" name="addresses[${addressCount}][state]" value="${state}">
                    <input type="hidden" name="addresses[${addressCount}][pincode]" value="${pincode}">
                    <input type="hidden" name="addresses[${addressCount}][country_code]" value="${$('#country').val()}">
                    <input type="hidden" name="addresses[${addressCount}][landmark]" value="${landmark}">
                    <input type="hidden" name="addresses[${addressCount}][is_default]" value="${isDefault ? '1' : '0'}">
                </div>
            `;
            
            $('#addressList').append(addressCard);
            $('#addressListSection').show();
            
            // Clear form
            clearAddressForm();
            
            // Reset default checkbox
            $('#setDefault').prop('checked', false);
        };
        
        window.clearAddressForm = function() {
            $('#addressLine1').val('');
            $('#addressLine2').val('');
            $('#city').val('');
            $('#state').val('');
            $('#pincode').val('');
            $('#landmark').val('');
        };
        
        window.editAddress = function(addressId) {
            const card = $('#' + addressId);
            const type = card.find('input[name$="[type]"]').val();
            const line1 = card.find('input[name$="[address_line1]"]').val();
            const line2 = card.find('input[name$="[address_line2]"]').val();
            const city = card.find('input[name$="[city]"]').val();
            const state = card.find('input[name$="[state]"]').val();
            const pincode = card.find('input[name$="[pincode]"]').val();
            const country = card.find('input[name$="[country_code]"]').val();
            const landmark = card.find('input[name$="[landmark]"]').val();
            const isDefault = card.find('input[name$="[is_default]"]').val() === '1';
            
            // Fill form
            $('#addressType').val(type);
            $('#addressLine1').val(line1);
            $('#addressLine2').val(line2);
            $('#city').val(city);
            $('#state').val(state);
            $('#pincode').val(pincode);
            $('#country').val(country);
            $('#landmark').val(landmark);
            $('#setDefault').prop('checked', isDefault);
            
            // Remove old address
            removeAddress(addressId);
            
            // Switch to address tab
            $('#address-create-tab').tab('show');
        };
        
        window.removeAddress = function(addressId) {
            if(confirm('Are you sure you want to remove this address?')) {
                $('#' + addressId).remove();
                
                // Hide address list section if empty
                if($('#addressList').children().length === 0) {
                    $('#addressListSection').hide();
                }
            }
        };
        
        // Helper functions
        function getTierBadgeClass(tier) {
            switch(tier) {
                case 'bronze': return 'bronze';
                case 'silver': return 'silver';
                case 'gold': return 'gold';
                case 'platinum': return 'platinum';
                default: return 'secondary';
            }
        }
        
        function getAddressTypeBadgeClass(type) {
            switch(type) {
                case 'home': return 'badge-success';
                case 'work': return 'badge-info';
                case 'billing': return 'badge-warning';
                case 'shipping': return 'badge-primary';
                default: return 'badge-secondary';
            }
        }
        
        // Form reset
        function resetForm() {
            if(confirm('Are you sure you want to reset the form? All data will be lost.')) {
                $('#customerCreateForm')[0].reset();
                $('#avatarPreview').attr('src', 'https://ui-avatars.com/api/?name=New+Customer&background=007bff&color=fff&size=150');
                $('#addressList').empty();
                $('#addressListSection').hide();
                $('.color-option').removeClass('selected');
                selectedColors.length = 0;
                addressCount = 0;
                $('#preferredColor').val('');
            }
        }
        
        // Attach reset function to window for button access
        window.resetForm = resetForm;
    </script>
    @endpush
</x-app-layout>