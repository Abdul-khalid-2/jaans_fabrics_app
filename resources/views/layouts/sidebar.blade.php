<div class="iq-sidebar sidebar-default">
    <div class="iq-sidebar-logo d-flex align-items-center justify-content-between">
        <a href="#" class="header-logo">
            <h5 class="logo-title light-logo ml-3">CLOTH SHOP</h5>
        </a>
        <div class="iq-menu-bt-sidebar ml-0">
            <i class="las la-bars wrapper-menu"></i>
        </div>
    </div>
    <div class="data-scrollbar" data-scroll="1">
        <nav class="iq-sidebar-menu">
            <ul id="iq-sidebar-toggle" class="iq-menu">
                <!-- Dashboard -->
                <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" class="svg-icon">
                        <svg class="svg-icon" id="p-dash1" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                            <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                            <line x1="12" y1="22.08" x2="12" y2="12"></line>
                        </svg>
                        <span class="ml-4">Dashboard</span>
                    </a>
                </li>

                <!-- Products -->
                <li class="{{ request()->is('products*') ? 'active' : '' }}">
                    <a href="#products" class="collapsed" data-toggle="collapse" aria-expanded="{{ request()->is('products*') ? 'true' : 'false' }}">
                        <svg class="svg-icon" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
                            <line x1="7" y1="7" x2="7" y2="7"></line>
                        </svg>
                        <span class="ml-4">Products</span>
                        <svg class="svg-icon iq-arrow-right {{ request()->is('products*') ? 'arrow-active' : '' }}" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="10 15 15 20 20 15"></polyline>
                            <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                        </svg>
                    </a>
                    <ul id="products" class="iq-submenu collapse {{ request()->is('products*') ? 'show' : '' }}" data-parent="#iq-sidebar-toggle">
                        <li class="{{ request()->routeIs('products.index') ? 'active' : '' }}">
                            <a href="{{ route('products.index') }}">
                                <i class="las la-minus"></i>
                                <span>All Products</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('products.create') ? 'active' : '' }}">
                            <a href="{{ route('products.create') }}">
                                <i class="las la-minus"></i>
                                <span>Add Product</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('categories.index') ? 'active' : '' }}">
                            <a href="{{ route('categories.index') }}">
                                <i class="las la-minus"></i>
                                <span>Categories</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('brands.index') ? 'active' : '' }}">
                            <a href="{{ route('brands.index') }}">
                                <i class="las la-minus"></i>
                                <span>Brands</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('collections.index') ? 'active' : '' }}">
                            <a href="{{ route('collections.index') }}">
                                <i class="las la-minus"></i>
                                <span>Collections</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('inventory.index') ? 'active' : '' }}">
                            <a href="{{ route('inventory.index') }}">
                                <i class="las la-minus"></i>
                                <span>Inventory</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Sales -->
                <li class="{{ request()->is('sales*') ? 'active' : '' }}">
                    <a href="#sales" class="collapsed" data-toggle="collapse" aria-expanded="{{ request()->is('sales*') ? 'true' : 'false' }}">
                        <svg class="svg-icon" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                            <line x1="1" y1="10" x2="23" y2="10"></line>
                        </svg>
                        <span class="ml-4">Sales</span>
                        <svg class="svg-icon iq-arrow-right {{ request()->is('sales*') ? 'arrow-active' : '' }}" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="10 15 15 20 20 15"></polyline>
                            <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                        </svg>
                    </a>
                    <ul id="sales" class="iq-submenu collapse {{ request()->is('sales*') ? 'show' : '' }}" data-parent="#iq-sidebar-toggle">
                        <li class="{{ request()->routeIs('sales.create') ? 'active' : '' }}">
                            <a href="{{ route('sales.create') }}">
                                <i class="las la-minus"></i>
                                <span>New Sale</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('sales.index') ? 'active' : '' }}">
                            <a href="{{ route('sales.index') }}">
                                <i class="las la-minus"></i>
                                <span>Sales History</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('sale-returns.index') ? 'active' : '' }}">
                            <a href="{{ route('sale-returns.index') }}">
                                <i class="las la-minus"></i>
                                <span>Returns</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('pos.index') ? 'active' : '' }}">
                            <a href="{{ route('pos.index') }}">
                                <i class="las la-minus"></i>
                                <span>POS</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Purchases -->
                <li class="{{ request()->is('purchases*') ? 'active' : '' }}">
                    <a href="#purchases" class="collapsed" data-toggle="collapse" aria-expanded="{{ request()->is('purchases*') ? 'true' : 'false' }}">
                        <svg class="svg-icon" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="9" cy="21" r="1"></circle>
                            <circle cx="20" cy="21" r="1"></circle>
                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                        </svg>
                        <span class="ml-4">Purchases</span>
                        <svg class="svg-icon iq-arrow-right {{ request()->is('purchases*') ? 'arrow-active' : '' }}" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="10 15 15 20 20 15"></polyline>
                            <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                        </svg>
                    </a>
                    <ul id="purchases" class="iq-submenu collapse {{ request()->is('purchases*') ? 'show' : '' }}" data-parent="#iq-sidebar-toggle">
                        <li class="{{ request()->routeIs('purchases.create') ? 'active' : '' }}">
                            <a href="{{ route('purchases.create') }}">
                                <i class="las la-minus"></i>
                                <span>New Purchase</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('purchases.index') ? 'active' : '' }}">
                            <a href="{{ route('purchases.index') }}">
                                <i class="las la-minus"></i>
                                <span>Purchase Orders</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('suppliers.index') ? 'active' : '' }}">
                            <a href="{{ route('suppliers.index') }}">
                                <i class="las la-minus"></i>
                                <span>Suppliers</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Customers -->
                <li class="{{ request()->is('customers*') ? 'active' : '' }}">
                    <a href="#customers" class="collapsed" data-toggle="collapse" aria-expanded="{{ request()->is('customers*') ? 'true' : 'false' }}">
                        <svg class="svg-icon" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                        <span class="ml-4">Customers</span>
                        <svg class="svg-icon iq-arrow-right {{ request()->is('customers*') ? 'arrow-active' : '' }}" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="10 15 15 20 20 15"></polyline>
                            <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                        </svg>
                    </a>
                    <ul id="customers" class="iq-submenu collapse {{ request()->is('customers*') ? 'show' : '' }}" data-parent="#iq-sidebar-toggle">
                        <li class="{{ request()->routeIs('customers.index') ? 'active' : '' }}">
                            <a href="{{ route('customers.index') }}">
                                <i class="las la-minus"></i>
                                <span>All Customers</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('customers.create') ? 'active' : '' }}">
                            <a href="{{ route('customers.create') }}">
                                <i class="las la-minus"></i>
                                <span>Add Customer</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('customer-groups.index') ? 'active' : '' }}">
                            <a href="{{ route('customer-groups.index') }}">
                                <i class="las la-minus"></i>
                                <span>Customer Groups</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Staff -->
                <li class="{{ request()->is('staff*') ? 'active' : '' }}">
                    <a href="#staff" class="collapsed" data-toggle="collapse" aria-expanded="{{ request()->is('staff*') ? 'true' : 'false' }}">
                        <svg class="svg-icon" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="8.5" cy="7" r="4"></circle>
                            <polyline points="17 11 19 13 23 9"></polyline>
                        </svg>
                        <span class="ml-4">Staff</span>
                        <svg class="svg-icon iq-arrow-right {{ request()->is('staff*') ? 'arrow-active' : '' }}" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="10 15 15 20 20 15"></polyline>
                            <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                        </svg>
                    </a>
                    <ul id="staff" class="iq-submenu collapse {{ request()->is('staff*') ? 'show' : '' }}" data-parent="#iq-sidebar-toggle">
                        <li class="{{ request()->routeIs('staff.index') ? 'active' : '' }}">
                            <a href="{{ route('staff.index') }}">
                                <i class="las la-minus"></i>
                                <span>All Staff</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('staff.create') ? 'active' : '' }}">
                            <a href="{{ route('staff.create') }}">
                                <i class="las la-minus"></i>
                                <span>Add Staff</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('attendance.index') ? 'active' : '' }}">
                            <a href="{{ route('attendance.index') }}">
                                <i class="las la-minus"></i>
                                <span>Attendance</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('payroll.index') ? 'active' : '' }}">
                            <a href="{{ route('payroll.index') }}">
                                <i class="las la-minus"></i>
                                <span>Payroll</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Reports -->
                <li class="{{ request()->is('reports*') ? 'active' : '' }}">
                    <a href="#reports" class="collapsed" data-toggle="collapse" aria-expanded="{{ request()->is('reports*') ? 'true' : 'false' }}">
                        <svg class="svg-icon" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21.21 15.89A10 10 0 1 1 8 2.83"></path>
                            <path d="M22 12A10 10 0 0 0 12 2v10z"></path>
                        </svg>
                        <span class="ml-4">Reports</span>
                        <svg class="svg-icon iq-arrow-right {{ request()->is('reports*') ? 'arrow-active' : '' }}" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="10 15 15 20 20 15"></polyline>
                            <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                        </svg>
                    </a>
                    <ul id="reports" class="iq-submenu collapse {{ request()->is('reports*') ? 'show' : '' }}" data-parent="#iq-sidebar-toggle">
                        <li class="{{ request()->routeIs('reports.index') ? 'active' : '' }}">
                            <a href="{{ route('reports.index') }}">
                                <i class="las la-home"></i>
                                <span>Reports Dashboard</span>
                            </a>
                        </li>

                        <!-- Sales Reports -->
                        <li class="{{ request()->routeIs('reports.sales.*') ? 'active' : '' }}">
                            <a href="#sales-reports" class="collapsed" data-toggle="collapse" aria-expanded="{{ request()->routeIs('reports.sales.*') ? 'true' : 'false' }}">
                                <i class="las la-shopping-cart"></i>
                                <span>Sales Reports</span>
                                <svg class="svg-icon iq-arrow-right" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="10 15 15 20 20 15"></polyline>
                                    <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                                </svg>
                            </a>
                            <ul id="sales-reports" class="iq-submenu collapse {{ request()->routeIs('reports.sales.*') ? 'show' : '' }}" data-parent="#reports">
                                <li class="{{ request()->routeIs('reports.sales.index') ? 'active' : '' }}">
                                    <a href="{{ route('reports.sales.index') }}">
                                        <i class="las la-minus"></i>
                                        <span>Sales Overview</span>
                                    </a>
                                </li>
                                <li class="{{ request()->routeIs('reports.sales.daily') ? 'active' : '' }}">
                                    <a href="{{ route('reports.sales.daily') }}">
                                        <i class="las la-minus"></i>
                                        <span>Daily Sales</span>
                                    </a>
                                </li>
                                <li class="{{ request()->routeIs('reports.sales.product') ? 'active' : '' }}">
                                    <a href="{{ route('reports.sales.product') }}">
                                        <i class="las la-minus"></i>
                                        <span>Product-wise Sales</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Inventory Reports -->
                        <li class="{{ request()->routeIs('reports.inventory.*') ? 'active' : '' }}">
                            <a href="#inventory-reports" class="collapsed" data-toggle="collapse" aria-expanded="{{ request()->routeIs('reports.inventory.*') ? 'true' : 'false' }}">
                                <i class="las la-warehouse"></i>
                                <span>Inventory Reports</span>
                                <svg class="svg-icon iq-arrow-right" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="10 15 15 20 20 15"></polyline>
                                    <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                                </svg>
                            </a>
                            <ul id="inventory-reports" class="iq-submenu collapse {{ request()->routeIs('reports.inventory.*') ? 'show' : '' }}" data-parent="#reports">
                                <li class="{{ request()->routeIs('reports.inventory.index') ? 'active' : '' }}">
                                    <a href="{{ route('reports.inventory.index') }}">
                                        <i class="las la-minus"></i>
                                        <span>Inventory Overview</span>
                                    </a>
                                </li>
                                <li class="{{ request()->routeIs('reports.inventory.stock-levels') ? 'active' : '' }}">
                                    <a href="{{ route('reports.inventory.stock-levels') }}">
                                        <i class="las la-minus"></i>
                                        <span>Stock Levels</span>
                                    </a>
                                </li>
                                <li class="{{ request()->routeIs('reports.inventory.movements') ? 'active' : '' }}">
                                    <a href="{{ route('reports.inventory.movements') }}">
                                        <i class="las la-minus"></i>
                                        <span>Inventory Movements</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Customer Reports -->
                        <li class="{{ request()->routeIs('reports.customers.*') ? 'active' : '' }}">
                            <a href="#customer-reports" class="collapsed" data-toggle="collapse" aria-expanded="{{ request()->routeIs('reports.customers.*') ? 'true' : 'false' }}">
                                <i class="las la-users"></i>
                                <span>Customer Reports</span>
                                <svg class="svg-icon iq-arrow-right" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="10 15 15 20 20 15"></polyline>
                                    <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                                </svg>
                            </a>
                            <ul id="customer-reports" class="iq-submenu collapse {{ request()->routeIs('reports.customers.*') ? 'show' : '' }}" data-parent="#reports">
                                <li class="{{ request()->routeIs('reports.customers.index') ? 'active' : '' }}">
                                    <a href="{{ route('reports.customers.index') }}">
                                        <i class="las la-minus"></i>
                                        <span>Customer Overview</span>
                                    </a>
                                </li>
                                <li class="{{ request()->routeIs('reports.customers.sales') ? 'active' : '' }}">
                                    <a href="{{ route('reports.customers.sales') }}">
                                        <i class="las la-minus"></i>
                                        <span>Purchase History</span>
                                    </a>
                                </li>
                                <li class="{{ request()->routeIs('reports.customers.loyalty') ? 'active' : '' }}">
                                    <a href="{{ route('reports.customers.loyalty') }}">
                                        <i class="las la-minus"></i>
                                        <span>Loyalty Tracking</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Staff Reports -->
                        <li class="{{ request()->routeIs('reports.staff.*') ? 'active' : '' }}">
                            <a href="{{ route('reports.staff.index') }}">
                                <i class="las la-user-friends"></i>
                                <span>Staff Performance</span>
                            </a>
                        </li>

                        <!-- Financial Reports -->
                        <li class="{{ request()->routeIs('reports.financial.*') ? 'active' : '' }}">
                            <a href="#financial-reports" class="collapsed" data-toggle="collapse" aria-expanded="{{ request()->routeIs('reports.financial.*') ? 'true' : 'false' }}">
                                <i class="las la-chart-line"></i>
                                <span>Financial Reports</span>
                                <svg class="svg-icon iq-arrow-right" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="10 15 15 20 20 15"></polyline>
                                    <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                                </svg>
                            </a>
                            <ul id="financial-reports" class="iq-submenu collapse {{ request()->routeIs('reports.financial.*') ? 'show' : '' }}" data-parent="#reports">
                                <li class="{{ request()->routeIs('reports.financial.index') ? 'active' : '' }}">
                                    <a href="{{ route('reports.financial.index') }}">
                                        <i class="las la-minus"></i>
                                        <span>Financial Overview</span>
                                    </a>
                                </li>
                                <li class="{{ request()->routeIs('reports.financial.profit-loss') ? 'active' : '' }}">
                                    <a href="{{ route('reports.financial.profit-loss') }}">
                                        <i class="las la-minus"></i>
                                        <span>Profit & Loss</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <!-- Accounts -->
                <li class="{{ request()->is('accounts*') ? 'active' : '' }}">
                    <a href="#accounts" class="collapsed" data-toggle="collapse" aria-expanded="{{ request()->is('accounts*') ? 'true' : 'false' }}">
                        <svg class="svg-icon" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="3" y1="9" x2="21" y2="9"></line>
                            <line x1="9" y1="21" x2="9" y2="9"></line>
                        </svg>
                        <span class="ml-4">Accounts</span>
                        <svg class="svg-icon iq-arrow-right {{ request()->is('accounts*') ? 'arrow-active' : '' }}" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="10 15 15 20 20 15"></polyline>
                            <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                        </svg>
                    </a>
                    <ul id="accounts" class="iq-submenu collapse {{ request()->is('accounts*') ? 'show' : '' }}" data-parent="#iq-sidebar-toggle">
                        <li class="{{ request()->routeIs('accounts.accounts.index') ? 'active' : '' }}">
                            <a href="{{ route('accounts.accounts.index') }}">
                                <i class="las la-minus"></i>
                                <span>Chart of Accounts</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('accounts.types.index') ? 'active' : '' }}">
                            <a href="{{ route('accounts.types.index') }}">
                                <i class="las la-minus"></i>
                                <span>Account Types</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('accounts.transactions.index') ? 'active' : '' }}">
                            <a href="{{ route('accounts.transactions.index') }}">
                                <i class="las la-minus"></i>
                                <span>Transactions</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('accounts.journal.entries.index') ? 'active' : '' }}">
                            <a href="{{ route('accounts.journal.entries.index') }}">
                                <i class="las la-minus"></i>
                                <span>Journal Entries</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('accounts.ledger.index') ? 'active' : '' }}">
                            <a href="{{ route('accounts.ledger.index') }}">
                                <i class="las la-minus"></i>
                                <span>General Ledger</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('accounts.reports.balance-sheet') || request()->routeIs('accounts.reports.income-statement') || request()->routeIs('accounts.reports.cash-flow') ? 'active' : '' }}">
                            <a href="{{ route('accounts.reports.balance-sheet') }}">
                                <i class="las la-minus"></i>
                                <span>Financial Reports</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Expenses -->
                <li class="{{ request()->is('expenses*') ? 'active' : '' }}">
                    <a href="#expenses" class="collapsed" data-toggle="collapse" aria-expanded="{{ request()->is('expenses*') ? 'true' : 'false' }}">
                        <svg class="svg-icon" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="12" y1="1" x2="12" y2="23"></line>
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                        </svg>
                        <span class="ml-4">Expenses</span>
                        <svg class="svg-icon iq-arrow-right {{ request()->is('expenses*') ? 'arrow-active' : '' }}" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="10 15 15 20 20 15"></polyline>
                            <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                        </svg>
                    </a>
                    <ul id="expenses" class="iq-submenu collapse {{ request()->is('expenses*') ? 'show' : '' }}" data-parent="#iq-sidebar-toggle">
                        <li class="{{ request()->routeIs('expenses.index') ? 'active' : '' }}">
                            <a href="{{ route('expenses.index') }}">
                                <i class="las la-minus"></i>
                                <span>All Expenses</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('expenses.create') ? 'active' : '' }}">
                            <a href="{{ route('expenses.create') }}">
                                <i class="las la-minus"></i>
                                <span>Add Expense</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('expense-categories.index') ? 'active' : '' }}">
                            <a href="{{ route('expense-categories.index') }}">
                                <i class="las la-minus"></i>
                                <span>Expense Categories</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Branches -->
                <li class="{{ request()->is('branches*') ? 'active' : '' }}">
                    <a href="#branches" class="collapsed" data-toggle="collapse" aria-expanded="{{ request()->is('branches*') ? 'true' : 'false' }}">
                        <svg class="svg-icon" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="16 18 22 12 16 6"></polyline>
                            <polyline points="8 6 2 12 8 18"></polyline>
                        </svg>
                        <span class="ml-4">Branches</span>
                        <svg class="svg-icon iq-arrow-right {{ request()->is('branches*') ? 'arrow-active' : '' }}" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="10 15 15 20 20 15"></polyline>
                            <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                        </svg>
                    </a>
                    <ul id="branches" class="iq-submenu collapse {{ request()->is('branches*') ? 'show' : '' }}" data-parent="#iq-sidebar-toggle">
                        <li class="{{ request()->routeIs('branches.index') ? 'active' : '' }}">
                            <a href="{{ route('branches.index') }}">
                                <i class="las la-minus"></i>
                                <span>All Branches</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('branches.create') ? 'active' : '' }}">
                            <a href="{{ route('branches.create') }}">
                                <i class="las la-minus"></i>
                                <span>Add Branch</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('stock-transfers.index') ? 'active' : '' }}">
                            <a href="{{ route('stock-transfers.index') }}">
                                <i class="las la-minus"></i>
                                <span>Stock Transfers</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Settings -->
                <li class="{{ request()->is('settings*') ? 'active' : '' }}">
                    <a href="#settings" class="collapsed" data-toggle="collapse" aria-expanded="{{ request()->is('settings*') ? 'true' : 'false' }}">
                        <svg class="svg-icon" id="p-settings" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="3"></circle>
                            <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                        </svg>
                        <span class="ml-4">Settings</span>
                        <svg class="svg-icon iq-arrow-right {{ request()->is('settings*') ? 'arrow-active' : '' }}" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="10 15 15 20 20 15"></polyline>
                            <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                        </svg>
                    </a>
                    <ul id="settings" class="iq-submenu collapse {{ request()->is('settings*') ? 'show' : '' }}" data-parent="#iq-sidebar-toggle">
                        <li class="{{ request()->routeIs('shop-settings.index') ? 'active' : '' }}">
                            <a href="{{ route('shop-settings.index') }}">
                                <i class="las la-minus"></i>
                                <span>Shop Settings</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('tax-settings.index') ? 'active' : '' }}">
                            <a href="{{ route('tax-settings.index') }}">
                                <i class="las la-minus"></i>
                                <span>Tax Settings</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('user-management.index') ? 'active' : '' }}">
                            <a href="{{ route('user-management.index') }}">
                                <i class="las la-minus"></i>
                                <span>User Management</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('backup.index') ? 'active' : '' }}">
                            <a href="{{ route('backup.index') }}">
                                <i class="las la-minus"></i>
                                <span>Backup & Restore</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>

<style>
    .iq-sidebar .iq-menu li a i {
        width: 20px;
        text-align: center;
        margin-right: 10px;
    }

    .iq-sidebar .iq-submenu li a i.las.la-minus {
        font-size: 10px;
    }

    /* Active menu styling */
    .iq-sidebar .iq-menu>li.active>a {
        background: rgba(59, 130, 246, 0.1);
        color: #3B82F6;
        border-left: 3px solid #3B82F6;
    }

    .iq-sidebar .iq-submenu li.active a {
        color: #3B82F6;
        font-weight: 500;
    }

    .iq-sidebar .iq-submenu {
        padding-left: 20px;
    }

    .iq-sidebar .iq-submenu li {
        margin: 5px 0;
    }
</style>