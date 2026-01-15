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
    </style>
    @endpush

    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
            <div>
                <h4 class="mb-3">Edit Customer</h4>
                <p class="mb-0">Update customer information</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('customers.index') }}">Customers</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('customers.show', 1) }}">John Smith</a></li>
                        <li class="breadcrumb-item active">Edit Customer</li>
                    </ol>
                </nav>
            </div>
            <div>
                <a href="{{ route('customers.show', 1) }}" class="btn btn-outline-secondary">
                    <i class="las la-times mr-2"></i>Cancel
                </a>
                <button type="submit" form="customerEditForm" class="btn btn-primary ml-2">
                    <i class="las la-save mr-2"></i>Save Changes
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Customer Tabs -->
                        <ul class="nav nav-tabs" id="customerEditTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="basic-edit-tab" data-toggle="tab" href="#basic-edit">
                                    <i class="las la-user mr-2"></i>Basic Info
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="address-edit-tab" data-toggle="tab" href="#address-edit">
                                    <i class="las la-map-marker mr-2"></i>Address
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="preferences-edit-tab" data-toggle="tab" href="#preferences-edit">
                                    <i class="las la-heart mr-2"></i>Preferences
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="loyalty-edit-tab" data-toggle="tab" href="#loyalty-edit">
                                    <i class="las la-crown mr-2"></i>Loyalty
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="financial-edit-tab" data-toggle="tab" href="#financial-edit">
                                    <i class="las la-wallet mr-2"></i>Financial
                                </a>
                            </li>
                        </ul>

                        <!-- Customer Form -->
                        <form id="customerEditForm">
                            <div class="tab-content" id="customerEditTabContent">
                                <!-- Basic Info Tab -->
                                <div class="tab-pane fade show active" id="basic-edit" role="tabpanel">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <!-- Profile Picture -->
                                            <div class="form-group text-center">
                                                <div class="avatar-upload mb-3">
                                                    <img id="avatarPreview" 
                                                         src="https://ui-avatars.com/api/?name=John+Smith&background=007bff&color=fff&size=150" 
                                                         class="customer-avatar" alt="Customer Avatar">
                                                    <div class="avatar-upload-overlay" onclick="document.getElementById('avatarInput').click()">
                                                        <div class="text-center">
                                                            <i class="las la-camera fa-2x"></i>
                                                            <p class="mb-0">Change Photo</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="file" id="avatarInput" accept="image/*" style="display: none;">
                                                <small class="text-muted">Click to upload new photo</small>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-9">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" value="John Smith" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Customer Code</label>
                                                        <input type="text" class="form-control" value="CUST-001" readonly>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Email Address</label>
                                                        <input type="email" class="form-control" value="john.smith@example.com">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Phone Number <span class="text-danger">*</span></label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">+91</span>
                                                            </div>
                                                            <input type="tel" class="form-control" value="9876543210" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Alternate Phone</label>
                                                        <input type="tel" class="form-control" value="9876512345">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Date of Birth</label>
                                                        <input type="date" class="form-control" value="1989-06-15">
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Gender</label>
                                                        <select class="form-control">
                                                            <option value="male" selected>Male</option>
                                                            <option value="female">Female</option>
                                                            <option value="other">Other</option>
                                                            <option value="prefer_not_to_say">Prefer not to say</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Customer Type</label>
                                                        <select class="form-control">
                                                            <option value="walk_in">Walk-in Customer</option>
                                                            <option value="regular" selected>Regular Customer</option>
                                                            <option value="wholesale">Wholesale Customer</option>
                                                            <option value="corporate">Corporate Customer</option>
                                                            <option value="vip">VIP Customer</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Anniversary Date</label>
                                                        <input type="date" class="form-control" value="2015-04-10">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Age Group</label>
                                                        <select class="form-control">
                                                            <option value="teen">Teen (13-19)</option>
                                                            <option value="young_adult">Young Adult (20-29)</option>
                                                            <option value="adult" selected>Adult (30-45)</option>
                                                            <option value="senior">Senior (46+)</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row mt-3">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Company Name</label>
                                                <input type="text" class="form-control" placeholder="Company name (for corporate customers)">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Designation</label>
                                                <input type="text" class="form-control" placeholder="Designation/Role">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Tax ID (GSTIN)</label>
                                                <input type="text" class="form-control" placeholder="GSTIN Number">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Reference Source</label>
                                                <select class="form-control">
                                                    <option value="walk_in" selected>Walk-in</option>
                                                    <option value="referral">Referral</option>
                                                    <option value="social_media">Social Media</option>
                                                    <option value="advertisement">Advertisement</option>
                                                    <option value="online_search">Online Search</option>
                                                    <option value="other">Other</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="form-label">Additional Notes</label>
                                        <textarea class="form-control" rows="3" placeholder="Any additional information about the customer">Regular customer since 2023. Prefers formal wear for office and casual for weekends. Good payment history.</textarea>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Account Status</label>
                                                <select class="form-control">
                                                    <option value="active" selected>Active</option>
                                                    <option value="inactive">Inactive</option>
                                                    <option value="blacklisted">Blacklisted</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Blacklist Reason (if applicable)</label>
                                                <textarea class="form-control" rows="2" placeholder="Reason for blacklisting"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Address Tab -->
                                <div class="tab-pane fade" id="address-edit" role="tabpanel">
                                    <h6 class="mb-4">Customer Addresses</h6>
                                    
                                    <div class="row" id="addressList">
                                        <!-- Default Address Card -->
                                        <div class="col-md-6">
                                            <div class="address-card selected">
                                                <div class="d-flex justify-content-between align-items-start mb-2">
                                                    <div>
                                                        <h6 class="mb-1">Home Address</h6>
                                                        <span class="badge badge-success">Default</span>
                                                    </div>
                                                    <div>
                                                        <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#editAddressModal">
                                                            <i class="las la-edit"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-outline-danger">
                                                            <i class="las la-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <p class="mb-1">123, Main Street</p>
                                                <p class="mb-1">Near City Mall</p>
                                                <p class="mb-1">Mumbai - 400001</p>
                                                <p class="mb-1">Maharashtra, India</p>
                                                <p class="mb-0"><i class="las la-phone"></i> +91 98765 43210</p>
                                            </div>
                                        </div>
                                        
                                        <!-- Office Address Card -->
                                        <div class="col-md-6">
                                            <div class="address-card">
                                                <div class="d-flex justify-content-between align-items-start mb-2">
                                                    <div>
                                                        <h6 class="mb-1">Office Address</h6>
                                                        <span class="badge badge-secondary">Work</span>
                                                    </div>
                                                    <div>
                                                        <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#editAddressModal">
                                                            <i class="las la-edit"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-outline-danger">
                                                            <i class="las la-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <p class="mb-1">456, Business Tower</p>
                                                <p class="mb-1">Bandra Kurla Complex</p>
                                                <p class="mb-1">Mumbai - 400051</p>
                                                <p class="mb-1">Maharashtra, India</p>
                                                <p class="mb-0"><i class="las la-phone"></i> +91 98765 12345</p>
                                            </div>
                                        </div>
                                        
                                        <!-- Shipping Address Card -->
                                        <div class="col-md-6">
                                            <div class="address-card">
                                                <div class="d-flex justify-content-between align-items-start mb-2">
                                                    <div>
                                                        <h6 class="mb-1">Shipping Address</h6>
                                                        <span class="badge badge-warning">Shipping</span>
                                                    </div>
                                                    <div>
                                                        <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#editAddressModal">
                                                            <i class="las la-edit"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-outline-danger">
                                                            <i class="las la-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <p class="mb-1">789, Riverside Apartments</p>
                                                <p class="mb-1">Worli Sea Face</p>
                                                <p class="mb-1">Mumbai - 400018</p>
                                                <p class="mb-1">Maharashtra, India</p>
                                                <p class="mb-0"><i class="las la-phone"></i> +91 98765 67890</p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Add New Address Button -->
                                    <div class="text-center mt-4">
                                        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#addAddressModal">
                                            <i class="las la-plus mr-2"></i>Add New Address
                                        </button>
                                    </div>
                                </div>
                                
                                <!-- Preferences Tab -->
                                <div class="tab-pane fade" id="preferences-edit" role="tabpanel">
                                    <h6 class="mb-4">Customer Preferences</h6>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Preferred Size</label>
                                                <select class="form-control">
                                                    <option value="">Select Size</option>
                                                    <option value="xs">XS</option>
                                                    <option value="s">S</option>
                                                    <option value="m">M</option>
                                                    <option value="l" selected>L</option>
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
                                                    <div class="color-option selected" style="background-color: #000000;" title="Black" onclick="selectColor(this)"></div>
                                                    <div class="color-option" style="background-color: #808080;" title="Gray" onclick="selectColor(this)"></div>
                                                    <div class="color-option" style="background-color: #FFFFFF; border: 1px solid #dee2e6;" title="White" onclick="selectColor(this)"></div>
                                                    <div class="color-option" style="background-color: #800000;" title="Maroon" onclick="selectColor(this)"></div>
                                                </div>
                                                <input type="text" class="form-control" value="Black, Blue, Gray">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Preferred Brand</label>
                                                <input type="text" class="form-control" value="Nike, Levi's">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Preferred Category</label>
                                                <input type="text" class="form-control" value="Casual, Formal">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="form-label">Shopping Preferences</label>
                                        <textarea class="form-control" rows="3">Prefers formal wear for office and casual for weekends. Usually shops during weekends. Likes to try before buying.</textarea>
                                    </div>
                                    
                                    <h6 class="mt-4 mb-3">Communication Preferences</h6>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox" class="custom-control-input" id="emailOffersEdit" checked>
                                                <label class="custom-control-label" for="emailOffersEdit">Email Offers & Updates</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox" class="custom-control-input" id="smsOffersEdit" checked>
                                                <label class="custom-control-label" for="smsOffersEdit">SMS Offers</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox" class="custom-control-input" id="whatsappUpdatesEdit" checked>
                                                <label class="custom-control-label" for="whatsappUpdatesEdit">WhatsApp Updates</label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <h6 class="mt-4 mb-3">Special Requirements</h6>
                                    <div class="form-group">
                                        <textarea class="form-control" rows="3" placeholder="Any special requirements, allergies, or notes">No special requirements.</textarea>
                                    </div>
                                </div>
                                
                                <!-- Loyalty Tab -->
                                <div class="tab-pane fade" id="loyalty-edit" role="tabpanel">
                                    <h6 class="mb-4">Loyalty Program Settings</h6>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Loyalty Tier</label>
                                                <select class="form-control">
                                                    <option value="bronze">Bronze</option>
                                                    <option value="silver">Silver</option>
                                                    <option value="gold">Gold</option>
                                                    <option value="platinum" selected>Platinum</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Current Points</label>
                                                <input type="number" class="form-control" value="5240" min="0">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Total Points Earned</label>
                                                <input type="number" class="form-control" value="6850" min="0" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Total Points Redeemed</label>
                                                <input type="number" class="form-control" value="1610" min="0" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Points Adjustment</label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control" placeholder="Points to add/subtract">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-outline-success" type="button">Add</button>
                                                        <button class="btn btn-outline-danger" type="button">Subtract</button>
                                                    </div>
                                                </div>
                                                <small class="form-text text-muted">Enter positive number to add, negative to subtract</small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Adjustment Reason</label>
                                                <input type="text" class="form-control" placeholder="Reason for points adjustment">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <h6 class="mt-4 mb-3">Tier Progress</h6>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="progress" style="height: 25px;">
                                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 85%" 
                                                         aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">
                                                        <strong>5,240 / 6,000 points</strong>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-between mt-2">
                                                    <small>Platinum Tier</small>
                                                    <small>Next: Diamond Tier (6,000 points)</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="alert alert-info mt-4">
                                        <i class="las la-info-circle mr-2"></i>
                                        <strong>Platinum Tier Benefits:</strong>
                                        <ul class="mb-0 mt-2">
                                            <li>3 points per ₹100 spent</li>
                                            <li>Birthday Gift (500 points)</li>
                                            <li>Exclusive Offers</li>
                                            <li>Personal Shopper</li>
                                            <li>Early Access to Sales</li>
                                            <li>Free Shipping</li>
                                        </ul>
                                    </div>
                                </div>
                                
                                <!-- Financial Tab -->
                                <div class="tab-pane fade" id="financial-edit" role="tabpanel">
                                    <h6 class="mb-4">Financial Information</h6>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Total Purchases (₹)</label>
                                                <input type="number" class="form-control" value="124850" step="0.01" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Total Orders</label>
                                                <input type="number" class="form-control" value="42" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Average Transaction Value (₹)</label>
                                                <input type="number" class="form-control" value="2950" step="0.01" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Last Purchase Date</label>
                                                <input type="date" class="form-control" value="2024-11-15" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Credit Limit (₹)</label>
                                                <input type="number" class="form-control" value="50000" step="1000">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Current Credit Used (₹)</label>
                                                <input type="number" class="form-control" value="0" step="0.01" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Outstanding Balance (₹)</label>
                                                <input type="number" class="form-control" value="0" step="0.01" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Payment Terms</label>
                                                <input type="text" class="form-control" value="Net 30">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <h6 class="mt-4 mb-3">Sales Statistics</h6>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="card bg-light border">
                                                <div class="card-body text-center">
                                                    <h5 class="text-primary mb-1">₹24,850</h5>
                                                    <small class="text-muted">Last 30 Days</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card bg-light border">
                                                <div class="card-body text-center">
                                                    <h5 class="text-success mb-1">8</h5>
                                                    <small class="text-muted">Orders This Month</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card bg-light border">
                                                <div class="card-body text-center">
                                                    <h5 class="text-warning mb-1">₹12,450</h5>
                                                    <small class="text-muted">Largest Purchase</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="alert alert-warning mt-4">
                                        <i class="las la-exclamation-triangle mr-2"></i>
                                        <strong>Note:</strong> Financial statistics are calculated automatically based on purchase history and cannot be edited directly.
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Address Modal -->
    <div class="modal fade" id="addAddressModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Address</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addAddressForm">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Address Type</label>
                                    <select class="form-control" required>
                                        <option value="home">Home</option>
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
                                        <input type="checkbox" class="custom-control-input" id="setDefaultNew">
                                        <label class="custom-control-label" for="setDefaultNew">Set as default address</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Address Line 1 <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Street address, P.O. Box" required>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Address Line 2</label>
                            <input type="text" class="form-control" placeholder="Apartment, suite, unit, building, floor">
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">City <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">State <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Pincode <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Country</label>
                                    <select class="form-control">
                                        <option value="IN" selected>India</option>
                                        <option value="US">United States</option>
                                        <option value="UK">United Kingdom</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Landmark</label>
                            <input type="text" class="form-control" placeholder="Nearby landmark">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Save Address</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Address Modal -->
    <div class="modal fade" id="editAddressModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Address</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editAddressForm">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Address Type</label>
                                    <select class="form-control" required>
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
                                        <input type="checkbox" class="custom-control-input" id="setDefaultEdit" checked>
                                        <label class="custom-control-label" for="setDefaultEdit">Set as default address</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Address Line 1 <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="123, Main Street" required>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Address Line 2</label>
                            <input type="text" class="form-control" value="Near City Mall">
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">City <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" value="Mumbai" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">State <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" value="Maharashtra" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Pincode <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" value="400001" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Country</label>
                                    <select class="form-control">
                                        <option value="IN" selected>India</option>
                                        <option value="US">United States</option>
                                        <option value="UK">United Kingdom</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Landmark</label>
                            <input type="text" class="form-control" value="Near City Mall">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Update Address</button>
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
            // Tab functionality
            $('#customerEditTab a').on('click', function (e) {
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
            
            // Customer form submission
            $('#customerEditForm').submit(function(e) {
                e.preventDefault();
                
                // Collect form data
                const customerData = {
                    basic: {
                        name: $('#customerEditForm input[value="John Smith"]').val(),
                        email: $('#customerEditForm input[type="email"]').val(),
                        phone: $('#customerEditForm input[value="9876543210"]').val(),
                        type: $('#customerEditForm select').eq(0).val(),
                        gender: $('#customerEditForm select').eq(1).val()
                    },
                    preferences: {
                        size: $('#customerEditForm select').eq(2).val(),
                        color: $('#customerEditForm input[value="Black, Blue, Gray"]').val(),
                        brand: $('#customerEditForm input[value="Nike, Levi\'s"]').val(),
                        category: $('#customerEditForm input[value="Casual, Formal"]').val()
                    },
                    loyalty: {
                        tier: $('#customerEditForm select').eq(3).val(),
                        points: $('#customerEditForm input[value="5240"]').val(),
                        creditLimit: $('#customerEditForm input[value="50000"]').val()
                    }
                };
                
                console.log('Customer Update Data:', customerData);
                
                // Show success message
                alert('Customer updated successfully!');
                
                // Redirect to customer details
                setTimeout(() => {
                    window.location.href = "{{ route('customers.show', 1) }}";
                }, 1000);
            });
            
            // Color selection
            window.selectColor = function(element) {
                $('.color-option').removeClass('selected');
                $(element).addClass('selected');
            };
            
            // Add points button
            $('button:contains("Add")').filter(function() {
                return $(this).text().trim() === 'Add';
            }).click(function() {
                const points = $(this).closest('.input-group').find('input').val();
                if(points && points > 0) {
                    const currentPoints = parseInt($('#customerEditForm input[value="5240"]').val());
                    const newPoints = currentPoints + parseInt(points);
                    $('#customerEditForm input[value="5240"]').val(newPoints);
                    alert(`Added ${points} points. New total: ${newPoints}`);
                }
            });
            
            // Subtract points button
            $('button:contains("Subtract")').click(function() {
                const points = $(this).closest('.input-group').find('input').val();
                if(points && points > 0) {
                    const currentPoints = parseInt($('#customerEditForm input[value="5240"]').val());
                    const newPoints = Math.max(0, currentPoints - parseInt(points));
                    $('#customerEditForm input[value="5240"]').val(newPoints);
                    alert(`Subtracted ${points} points. New total: ${newPoints}`);
                }
            });
            
            // Delete address button
            $('.btn-outline-danger').click(function(e) {
                e.stopPropagation();
                if(confirm('Are you sure you want to delete this address?')) {
                    $(this).closest('.address-card').fadeOut();
                }
            });
            
            // Address card selection
            $('.address-card').click(function() {
                if(!$(this).hasClass('selected')) {
                    $('.address-card').removeClass('selected');
                    $(this).addClass('selected');
                }
            });
            
            // Modal form submissions
            $('button:contains("Save Address")').click(function() {
                alert('Address saved successfully!');
                $('#addAddressModal').modal('hide');
            });
            
            $('button:contains("Update Address")').click(function() {
                alert('Address updated successfully!');
                $('#editAddressModal').modal('hide');
            });
        });
    </script>
    @endpush
</x-app-layout>