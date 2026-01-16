<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/remixicon/fonts/remixicon.css') }}">
    <style>
        .supplier-logo {
            width: 50px;
            height: 50px;
            border-radius: 4px;
            object-fit: cover;
            border: 1px solid #dee2e6;
        }

        .status-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        .status-active {
            background: #d4edda;
            color: #155724;
        }

        .status-inactive {
            background: #f8d7da;
            color: #721c24;
        }

        .rating-stars {
            color: #ffc107;
            font-size: 14px;
        }

        .action-btn {
            width: 35px;
            height: 35px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
    </style>
    @endpush

    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
            <div>
                <h4 class="mb-3">Suppliers Management</h4>
                <p class="mb-0">Manage your suppliers and vendors</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Suppliers</li>
                    </ol>
                </nav>
            </div>
            <div>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-outline-secondary">
                        <i class="las la-file-export mr-2"></i>Export
                    </button>
                    <button type="button" class="btn btn-outline-secondary">
                        <i class="las la-print mr-2"></i>Print
                    </button>
                    <a href="{{ route('suppliers.create') }}" class="btn btn-primary ml-2">
                        <i class="las la-plus mr-2"></i>Add Supplier
                    </a>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Search</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search suppliers...">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button">
                                        <i class="las la-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control">
                                <option value="">All Status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="blacklisted">Blacklisted</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Supplier Type</label>
                            <select class="form-control">
                                <option value="">All Types</option>
                                <option value="manufacturer">Manufacturer</option>
                                <option value="wholesaler">Wholesaler</option>
                                <option value="distributor">Distributor</option>
                                <option value="importer">Importer</option>
                                <option value="local_vendor">Local Vendor</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Rating</label>
                            <select class="form-control">
                                <option value="">All Ratings</option>
                                <option value="5">5 Stars</option>
                                <option value="4">4 Stars & Above</option>
                                <option value="3">3 Stars & Above</option>
                                <option value="2">2 Stars & Above</option>
                                <option value="1">1 Star & Above</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Date Range</label>
                            <input type="text" class="form-control" placeholder="Select date range">
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <button type="button" class="btn btn-secondary mr-2">
                        <i class="las la-filter mr-2"></i>Apply Filters
                    </button>
                    <button type="button" class="btn btn-outline-secondary">
                        <i class="las la-redo mr-2"></i>Reset
                    </button>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-white">Total Suppliers</h6>
                                <h3 class="mb-0 text-white">48</h3>
                                <small class="text-white">Active: 42</small>
                            </div>
                            <i class="las la-users fa-3x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-white">Total Purchases</h6>
                                <h3 class="mb-0 text-white">Rs2.85M</h3>
                                <small class="text-white">Last 30 days: Rs425K</small>
                            </div>
                            <i class="las la-shopping-cart fa-3x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-dark">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6>Outstanding Amount</h6>
                                <h3 class="mb-0">Rs185K</h3>
                                <small>Due in 30 days</small>
                            </div>
                            <i class="las la-money-bill-wave fa-3x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-white">Avg. Rating</h6>
                                <h3 class="mb-0 text-white">4.2 <i class="las la-star text-warning"></i></h3>
                                <small class="text-white">Based on 156 reviews</small>
                            </div>
                            <i class="las la-star fa-3x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Suppliers Table -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="selectAll">
                                        <label class="custom-control-label" for="selectAll"></label>
                                    </div>
                                </th>
                                <th>Supplier</th>
                                <th>Contact Info</th>
                                <th>Type</th>
                                <th>Rating</th>
                                <th>Total Purchases</th>
                                <th>Outstanding</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Sample Data Row 1 -->
                            <tr>
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="supplier1">
                                        <label class="custom-control-label" for="supplier1"></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="mr-3">
                                            <img src="https://via.placeholder.com/50x50/007bff/ffffff?text=TF"
                                                class="supplier-logo" alt="Textile Factory">
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Textile Factory Ltd.</h6>
                                            <small class="text-muted">SUP-20240001</small>
                                            <div class="small">Mumbai, India</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div>John Doe</div>
                                    <small class="text-muted">john@textilefactory.com</small>
                                    <div class="small">+91 9876543210</div>
                                </td>
                                <td>
                                    <span class="badge badge-info">Manufacturer</span>
                                </td>
                                <td>
                                    <div class="rating-stars">
                                        <i class="las la-star"></i>
                                        <i class="las la-star"></i>
                                        <i class="las la-star"></i>
                                        <i class="las la-star"></i>
                                        <i class="las la-star-half-alt"></i>
                                        <span class="ml-1">4.5</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="font-weight-bold">Rs1,250,000</div>
                                    <small class="text-muted">Last: 2 days ago</small>
                                </td>
                                <td>
                                    <div class="font-weight-bold text-warning">Rs75,000</div>
                                    <small class="text-danger">Due: 15 days</small>
                                </td>
                                <td>
                                    <span class="status-badge status-active">Active</span>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('suppliers.show', 1) }}" class="btn btn-sm btn-outline-primary action-btn" title="View">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="{{ route('suppliers.edit', 1) }}" class="btn btn-sm btn-outline-warning action-btn" title="Edit">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger action-btn" title="Delete">
                                            <i class="las la-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Sample Data Row 2 -->
                            <tr>
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="supplier2">
                                        <label class="custom-control-label" for="supplier2"></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="mr-3">
                                            <img src="https://via.placeholder.com/50x50/28a745/ffffff?text=FW"
                                                class="supplier-logo" alt="Fashion Wear">
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Fashion Wear Imports</h6>
                                            <small class="text-muted">SUP-20240002</small>
                                            <div class="small">Delhi, India</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div>Sarah Smith</div>
                                    <small class="text-muted">sarah@fashionwear.com</small>
                                    <div class="small">+91 9876543211</div>
                                </td>
                                <td>
                                    <span class="badge badge-primary">Importer</span>
                                </td>
                                <td>
                                    <div class="rating-stars">
                                        <i class="las la-star"></i>
                                        <i class="las la-star"></i>
                                        <i class="las la-star"></i>
                                        <i class="las la-star"></i>
                                        <i class="lar la-star"></i>
                                        <span class="ml-1">4.0</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="font-weight-bold">Rs850,000</div>
                                    <small class="text-muted">Last: 1 week ago</small>
                                </td>
                                <td>
                                    <div class="font-weight-bold text-success">Rs0</div>
                                    <small class="text-muted">No dues</small>
                                </td>
                                <td>
                                    <span class="status-badge status-active">Active</span>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('suppliers.show', 2) }}" class="btn btn-sm btn-outline-primary action-btn">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="{{ route('suppliers.edit', 2) }}" class="btn btn-sm btn-outline-warning action-btn">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger action-btn">
                                            <i class="las la-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Sample Data Row 3 -->
                            <tr>
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="supplier3">
                                        <label class="custom-control-label" for="supplier3"></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="mr-3">
                                            <img src="https://via.placeholder.com/50x50/ffc107/000000?text=LD"
                                                class="supplier-logo" alt="Local Distributor">
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Local Distributors Co.</h6>
                                            <small class="text-muted">SUP-20240003</small>
                                            <div class="small">Bangalore, India</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div>Mike Johnson</div>
                                    <small class="text-muted">mike@localdist.com</small>
                                    <div class="small">+91 9876543212</div>
                                </td>
                                <td>
                                    <span class="badge badge-secondary">Distributor</span>
                                </td>
                                <td>
                                    <div class="rating-stars">
                                        <i class="las la-star"></i>
                                        <i class="las la-star"></i>
                                        <i class="las la-star"></i>
                                        <i class="lar la-star"></i>
                                        <i class="lar la-star"></i>
                                        <span class="ml-1">3.0</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="font-weight-bold">Rs650,000</div>
                                    <small class="text-muted">Last: 3 weeks ago</small>
                                </td>
                                <td>
                                    <div class="font-weight-bold text-danger">Rs45,000</div>
                                    <small class="text-danger">Overdue: 10 days</small>
                                </td>
                                <td>
                                    <span class="status-badge status-active">Active</span>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('suppliers.show', 3) }}" class="btn btn-sm btn-outline-primary action-btn">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="{{ route('suppliers.edit', 3) }}" class="btn btn-sm btn-outline-warning action-btn">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger action-btn">
                                            <i class="las la-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Sample Data Row 4 -->
                            <tr>
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="supplier4">
                                        <label class="custom-control-label" for="supplier4"></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="mr-3">
                                            <img src="https://via.placeholder.com/50x50/dc3545/ffffff?text=WV"
                                                class="supplier-logo" alt="Wholesale Vendor">
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Wholesale Vendors Inc.</h6>
                                            <small class="text-muted">SUP-20240004</small>
                                            <div class="small">Chennai, India</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div>Robert Brown</div>
                                    <small class="text-muted">robert@wholesale.com</small>
                                    <div class="small">+91 9876543213</div>
                                </td>
                                <td>
                                    <span class="badge badge-success">Wholesaler</span>
                                </td>
                                <td>
                                    <div class="rating-stars">
                                        <i class="las la-star"></i>
                                        <i class="las la-star"></i>
                                        <i class="las la-star"></i>
                                        <i class="las la-star"></i>
                                        <i class="las la-star"></i>
                                        <span class="ml-1">5.0</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="font-weight-bold">Rs1,800,000</div>
                                    <small class="text-muted">Last: Yesterday</small>
                                </td>
                                <td>
                                    <div class="font-weight-bold text-warning">Rs65,000</div>
                                    <small class="text-muted">Due: 25 days</small>
                                </td>
                                <td>
                                    <span class="status-badge status-inactive">Blacklisted</span>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('suppliers.show', 4) }}" class="btn btn-sm btn-outline-primary action-btn">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-secondary action-btn" title="Reinstate">
                                            <i class="las la-user-check"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <div>
                        <p class="mb-0">Showing 1 to 4 of 48 entries</p>
                    </div>
                    <nav>
                        <ul class="pagination mb-0">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                                    <i class="las la-angle-left"></i>
                                </a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">4</a></li>
                            <li class="page-item"><a class="page-link" href="#">5</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">
                                    <i class="las la-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    @push('js')
    <script src="{{ asset('backend/assets/js/backend-bundle.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Select all checkbox
            $('#selectAll').change(function() {
                $('table input[type="checkbox"]').prop('checked', this.checked);
            });

            // Individual checkbox logic
            $('table input[type="checkbox"]').change(function() {
                if (!this.checked) {
                    $('#selectAll').prop('checked', false);
                } else {
                    const total = $('table input[type="checkbox"]:not(#selectAll)').length;
                    const checked = $('table input[type="checkbox"]:not(#selectAll):checked').length;
                    $('#selectAll').prop('checked', total === checked);
                }
            });

            // Bulk actions
            $('.bulk-action').click(function(e) {
                e.preventDefault();
                const action = $(this).data('action');
                const checkedIds = [];

                $('table input[type="checkbox"]:not(#selectAll):checked').each(function() {
                    checkedIds.push($(this).attr('id'));
                });

                if (checkedIds.length === 0) {
                    alert('Please select at least one supplier');
                    return;
                }

                if (action === 'delete') {
                    if (confirm(`Are you sure you want to delete ${checkedIds.length} supplier(s)?`)) {
                        // Perform delete action
                        console.log('Deleting:', checkedIds);
                        alert('Selected suppliers deleted successfully!');
                    }
                } else if (action === 'export') {
                    // Perform export action
                    console.log('Exporting:', checkedIds);
                    alert('Exporting selected suppliers...');
                } else if (action === 'status') {
                    const status = prompt('Enter new status (active/inactive/blacklisted):');
                    if (status) {
                        console.log('Updating status:', checkedIds, 'to', status);
                        alert(`Status updated to ${status} for selected suppliers`);
                    }
                }
            });

            // Search functionality
            $('input[placeholder="Search suppliers..."]').on('keyup', function() {
                const searchText = $(this).val().toLowerCase();
                $('table tbody tr').each(function() {
                    const rowText = $(this).text().toLowerCase();
                    $(this).toggle(rowText.includes(searchText));
                });
            });

            // Date range picker
            $('input[placeholder="Select date range"]').daterangepicker({
                opens: 'left',
                locale: {
                    format: 'YYYY-MM-DD'
                }
            });
        });
    </script>
    @endpush
</x-app-layout>