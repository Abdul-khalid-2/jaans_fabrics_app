<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard/analytics', [DashboardController::class, 'analytics'])->name('dashboard.analytics');

// Products Management
Route::prefix('dashboard/products')->name('products.')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::get('/create', [ProductController::class, 'create'])->name('create');
    Route::post('/', [ProductController::class, 'store'])->name('store');
    Route::get('/{product}', [ProductController::class, 'show'])->name('show');
    Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('edit');
    Route::put('/{product}', [ProductController::class, 'update'])->name('update');
    Route::delete('/{product}', [ProductController::class, 'destroy'])->name('destroy');
    Route::get('/{product}/variants', [ProductController::class, 'variants'])->name('variants');
    Route::post('/{product}/variants', [ProductController::class, 'storeVariant'])->name('variants.store');
});

// Categories
Route::prefix('dashboard/categories')->name('categories.')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('index');
    Route::get('/create', [CategoryController::class, 'create'])->name('create');
    Route::post('/', [CategoryController::class, 'store'])->name('store');
    Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('edit');
    Route::put('/{category}', [CategoryController::class, 'update'])->name('update');
    Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('destroy');
});

// Brands
Route::prefix('dashboard/brands')->name('brands.')->group(function () {
    Route::get('/', [BrandController::class, 'index'])->name('index');
    Route::get('/create', [BrandController::class, 'create'])->name('create');
    Route::post('/', [BrandController::class, 'store'])->name('store');
    Route::get('/{brand}/edit', [BrandController::class, 'edit'])->name('edit');
    Route::put('/{brand}', [BrandController::class, 'update'])->name('update');
    Route::delete('/{brand}', [BrandController::class, 'destroy'])->name('destroy');
});

// Sales Management
Route::prefix('dashboard/sales')->name('sales.')->group(function () {
    Route::get('/', [SaleController::class, 'index'])->name('index');
    Route::get('/create', [SaleController::class, 'create'])->name('create');
    Route::post('/', [SaleController::class, 'store'])->name('store');
    Route::get('/{sale}', [SaleController::class, 'show'])->name('show');
    Route::get('/{sale}/edit', [SaleController::class, 'edit'])->name('edit');
    Route::put('/{sale}', [SaleController::class, 'update'])->name('update');
    Route::delete('/{sale}', [SaleController::class, 'destroy'])->name('destroy');
    Route::get('/{sale}/invoice', [SaleController::class, 'invoice'])->name('invoice');
    Route::post('/{sale}/return', [SaleController::class, 'return'])->name('return');
});

// POS (Point of Sale)
Route::prefix('dashboard/pos')->name('pos.')->group(function () {
    Route::get('/', [POSController::class, 'index'])->name('index');
    Route::post('/cart/add', [POSController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/update', [POSController::class, 'updateCart'])->name('cart.update');
    Route::post('/cart/remove', [POSController::class, 'removeFromCart'])->name('cart.remove');
    Route::post('/cart/clear', [POSController::class, 'clearCart'])->name('cart.clear');
    Route::post('/checkout', [POSController::class, 'checkout'])->name('checkout');
    Route::get('/receipt/{sale}', [POSController::class, 'receipt'])->name('receipt');
});

// Inventory Management
Route::prefix('dashboard/inventory')->name('inventory.')->group(function () {
    Route::get('/', [InventoryController::class, 'index'])->name('index');
    Route::get('/low-stock', [InventoryController::class, 'lowStock'])->name('low-stock');
    Route::get('/transfers', [InventoryController::class, 'transfers'])->name('transfers');
    Route::get('/transfers/create', [InventoryController::class, 'createTransfer'])->name('transfers.create');
    Route::post('/transfers', [InventoryController::class, 'storeTransfer'])->name('transfers.store');
    Route::get('/adjustments', [InventoryController::class, 'adjustments'])->name('adjustments');
    Route::post('/adjustments', [InventoryController::class, 'storeAdjustment'])->name('adjustments.store');
    Route::get('/{inventory}', [InventoryController::class, 'show'])->name('show');
    Route::put('/{inventory}', [InventoryController::class, 'update'])->name('update');
});

// Customers Management
Route::prefix('dashboard/customers')->name('customers.')->group(function () {
    Route::get('/', [CustomerController::class, 'index'])->name('index');
    Route::get('/create', [CustomerController::class, 'create'])->name('create');
    Route::post('/', [CustomerController::class, 'store'])->name('store');
    Route::get('/{customer}', [CustomerController::class, 'show'])->name('show');
    Route::get('/{customer}/edit', [CustomerController::class, 'edit'])->name('edit');
    Route::put('/{customer}', [CustomerController::class, 'update'])->name('update');
    Route::delete('/{customer}', [CustomerController::class, 'destroy'])->name('destroy');
    Route::get('/{customer}/transactions', [CustomerController::class, 'transactions'])->name('transactions');
    Route::get('/loyalty', [CustomerController::class, 'loyalty'])->name('loyalty');
});

// Purchases Management
Route::prefix('dashboard/purchases')->name('purchases.')->group(function () {
    Route::get('/', [PurchaseController::class, 'index'])->name('index');
    Route::get('/create', [PurchaseController::class, 'create'])->name('create');
    Route::post('/', [PurchaseController::class, 'store'])->name('store');
    Route::get('/{purchase}', [PurchaseController::class, 'show'])->name('show');
    Route::get('/{purchase}/edit', [PurchaseController::class, 'edit'])->name('edit');
    Route::put('/{purchase}', [PurchaseController::class, 'update'])->name('update');
    Route::delete('/{purchase}', [PurchaseController::class, 'destroy'])->name('destroy');
    Route::post('/{purchase}/receive', [PurchaseController::class, 'receive'])->name('receive');
});

// Suppliers Management
Route::prefix('dashboard/suppliers')->name('suppliers.')->group(function () {
    Route::get('/', [SupplierController::class, 'index'])->name('index');
    Route::get('/create', [SupplierController::class, 'create'])->name('create');
    Route::post('/', [SupplierController::class, 'store'])->name('store');
    Route::get('/{supplier}', [SupplierController::class, 'show'])->name('show');
    Route::get('/{supplier}/edit', [SupplierController::class, 'edit'])->name('edit');
    Route::put('/{supplier}', [SupplierController::class, 'update'])->name('update');
    Route::delete('/{supplier}', [SupplierController::class, 'destroy'])->name('destroy');
    Route::get('/{supplier}/purchases', [SupplierController::class, 'purchases'])->name('purchases');
});

// Staff Management
Route::prefix('dashboard/staff')->name('staff.')->group(function () {
    Route::get('/', [StaffController::class, 'index'])->name('index');
    Route::get('/create', [StaffController::class, 'create'])->name('create');
    Route::post('/', [StaffController::class, 'store'])->name('store');
    Route::get('/{staff}', [StaffController::class, 'show'])->name('show');
    Route::get('/{staff}/edit', [StaffController::class, 'edit'])->name('edit');
    Route::put('/{staff}', [StaffController::class, 'update'])->name('update');
    Route::delete('/{staff}', [StaffController::class, 'destroy'])->name('destroy');
    Route::get('/roles', [StaffController::class, 'roles'])->name('roles');
});

// Attendance
Route::prefix('dashboard/attendance')->name('attendance.')->group(function () {
    Route::get('/', [AttendanceController::class, 'index'])->name('index');
    Route::post('/check-in', [AttendanceController::class, 'checkIn'])->name('check-in');
    Route::post('/check-out', [AttendanceController::class, 'checkOut'])->name('check-out');
    Route::post('/mark', [AttendanceController::class, 'mark'])->name('mark');
    Route::get('/reports', [AttendanceController::class, 'reports'])->name('reports');
});

// Payroll
Route::prefix('dashboard/payroll')->name('payroll.')->group(function () {
    Route::get('/', [PayrollController::class, 'index'])->name('index');
    Route::get('/create', [PayrollController::class, 'create'])->name('create');
    Route::post('/', [PayrollController::class, 'store'])->name('store');
    Route::get('/{payroll}', [PayrollController::class, 'show'])->name('show');
    Route::get('/{payroll}/edit', [PayrollController::class, 'edit'])->name('edit');
    Route::put('/{payroll}', [PayrollController::class, 'update'])->name('update');
    Route::delete('/{payroll}', [PayrollController::class, 'destroy'])->name('destroy');
    Route::get('/{staff}/salary', [PayrollController::class, 'salary'])->name('salary');
});

// Expenses Management
Route::prefix('dashboard/expenses')->name('expenses.')->group(function () {
    Route::get('/', [ExpenseController::class, 'index'])->name('index');
    Route::get('/create', [ExpenseController::class, 'create'])->name('create');
    Route::post('/', [ExpenseController::class, 'store'])->name('store');
    Route::get('/{expense}', [ExpenseController::class, 'show'])->name('show');
    Route::get('/{expense}/edit', [ExpenseController::class, 'edit'])->name('edit');
    Route::put('/{expense}', [ExpenseController::class, 'update'])->name('update');
    Route::delete('/{expense}', [ExpenseController::class, 'destroy'])->name('destroy');
    Route::get('/categories', [ExpenseController::class, 'categories'])->name('categories');
});

// Accounts Management
Route::prefix('dashboard/accounts')->name('accounts.')->group(function () {
    Route::get('/', [AccountController::class, 'index'])->name('index');
    Route::get('/ledger', [AccountController::class, 'ledger'])->name('ledger');
    Route::get('/transactions', [AccountController::class, 'transactions'])->name('transactions');
    Route::get('/transactions/create', [AccountController::class, 'createTransaction'])->name('transactions.create');
    Route::post('/transactions', [AccountController::class, 'storeTransaction'])->name('transactions.store');
    Route::get('/profit-loss', [AccountController::class, 'profitLoss'])->name('profit-loss');
    Route::get('/balance-sheet', [AccountController::class, 'balanceSheet'])->name('balance-sheet');
    Route::get('/accounts-list', [AccountController::class, 'accountsList'])->name('accounts-list');
});

// Reports
Route::prefix('dashboard/reports')->name('reports.')->group(function () {
    Route::get('/sales', [ReportController::class, 'sales'])->name('sales');
    Route::get('/inventory', [ReportController::class, 'inventory'])->name('inventory');
    Route::get('/financial', [ReportController::class, 'financial'])->name('financial');
    Route::get('/customers', [ReportController::class, 'customers'])->name('customers');
    Route::get('/staff', [ReportController::class, 'staff'])->name('staff');
    Route::get('/custom', [ReportController::class, 'custom'])->name('custom');
    Route::post('/generate', [ReportController::class, 'generate'])->name('generate');
    Route::get('/export/{type}', [ReportController::class, 'export'])->name('export');
});

// Branches Management
Route::prefix('dashboard/branches')->name('branches.')->group(function () {
    Route::get('/', [BranchController::class, 'index'])->name('index');
    Route::get('/create', [BranchController::class, 'create'])->name('create');
    Route::post('/', [BranchController::class, 'store'])->name('store');
    Route::get('/{branch}', [BranchController::class, 'show'])->name('show');
    Route::get('/{branch}/edit', [BranchController::class, 'edit'])->name('edit');
    Route::put('/{branch}', [BranchController::class, 'update'])->name('update');
    Route::delete('/{branch}', [BranchController::class, 'destroy'])->name('destroy');
    Route::get('/{branch}/performance', [BranchController::class, 'performance'])->name('performance');
});

// Settings
Route::prefix('dashboard/settings')->name('settings.')->group(function () {
    Route::get('/', [SettingsController::class, 'index'])->name('index');
    Route::get('/general', [SettingsController::class, 'general'])->name('general');
    Route::put('/general', [SettingsController::class, 'updateGeneral'])->name('general.update');
    Route::get('/tax', [SettingsController::class, 'tax'])->name('tax');
    Route::put('/tax', [SettingsController::class, 'updateTax'])->name('tax.update');
    Route::get('/payment', [SettingsController::class, 'payment'])->name('payment');
    Route::put('/payment', [SettingsController::class, 'updatePayment'])->name('payment.update');
    Route::get('/email', [SettingsController::class, 'email'])->name('email');
    Route::put('/email', [SettingsController::class, 'updateEmail'])->name('email.update');
    Route::get('/notifications', [SettingsController::class, 'notifications'])->name('notifications');
    Route::put('/notifications', [SettingsController::class, 'updateNotifications'])->name('notifications.update');
    Route::get('/backup', [SettingsController::class, 'backup'])->name('backup');
    Route::post('/backup/create', [SettingsController::class, 'createBackup'])->name('backup.create');
    Route::post('/backup/restore', [SettingsController::class, 'restoreBackup'])->name('backup.restore');
});

// Profile
Route::prefix('dashboard/profile')->name('profile.')->group(function () {
    Route::get('/', [AuthController::class, 'profile'])->name('edit');
    Route::put('/', [AuthController::class, 'updateProfile'])->name('update');
    Route::put('/password', [AuthController::class, 'updatePassword'])->name('password.update');
});

// Notifications
Route::prefix('dashboard/notifications')->name('notifications.')->group(function () {
    Route::get('/', [DashboardController::class, 'notifications'])->name('index');
    Route::post('/{notification}/read', [DashboardController::class, 'markAsRead'])->name('read');
    Route::post('/read-all', [DashboardController::class, 'markAllAsRead'])->name('read.all');
});

// AJAX/API Routes (for dashboard functionality)
Route::prefix('ajax')->name('ajax.')->group(function () {
    Route::get('/dashboard-stats', [DashboardController::class, 'getStats'])->name('dashboard.stats');
    Route::get('/sales-chart', [DashboardController::class, 'salesChart'])->name('sales.chart');
    Route::get('/inventory-chart', [DashboardController::class, 'inventoryChart'])->name('inventory.chart');
    Route::get('/recent-activity', [DashboardController::class, 'recentActivity'])->name('recent.activity');
    Route::get('/top-products', [DashboardController::class, 'topProducts'])->name('top.products');
    Route::get('/low-stock', [DashboardController::class, 'lowStock'])->name('low.stock');
    Route::post('/switch-branch', [DashboardController::class, 'switchBranch'])->name('switch.branch');
});


Route::get('/dashboard', function () {
    return view('dashboard.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
