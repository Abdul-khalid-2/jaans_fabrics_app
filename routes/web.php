<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SaleReturnController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerGroupController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\JournalEntryController;
use App\Http\Controllers\LedgerController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ExpenseCategoryController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\StockTransferController;
use App\Http\Controllers\ShopSettingsController;
use App\Http\Controllers\TaxSettingsController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\BackupController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard/analytics', [DashboardController::class, 'analytics'])->name('dashboard.analytics');

Route::resource('products', ProductController::class);
Route::resource('sales', SaleController::class);
Route::resource('customers', CustomerController::class);

// Categories Routes
Route::resource('categories', CategoryController::class);

// Brands Routes
Route::resource('brands', BrandController::class);

// Collections Routes
Route::resource('collections', CollectionController::class);

// Inventory Routes
Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');
Route::get('/inventory/{product}/edit', [InventoryController::class, 'edit'])->name('inventory.edit');
Route::put('/inventory/{product}', [InventoryController::class, 'update'])->name('inventory.update');
Route::get('/inventory/low-stock', [InventoryController::class, 'lowStock'])->name('inventory.low-stock');
Route::get('/inventory/stock-movements', [InventoryController::class, 'stockMovements'])->name('inventory.stock-movements');



// Sale Returns Routes
Route::resource('sale-returns', SaleReturnController::class);

// POS Routes
Route::get('/pos', [PosController::class, 'index'])->name('pos.index');
Route::post('/pos/process-sale', [PosController::class, 'processSale'])->name('pos.process-sale');
Route::get('/pos/get-products', [PosController::class, 'getProducts'])->name('pos.get-products');
Route::get('/pos/get-customers', [PosController::class, 'getCustomers'])->name('pos.get-customers');

// Purchases Routes
Route::prefix('purchases')->group(function () {
    Route::get('/', [PurchaseController::class, 'index'])->name('purchases.index');
    Route::get('/create', [PurchaseController::class, 'create'])->name('purchases.create');
    Route::post('/', [PurchaseController::class, 'store'])->name('purchases.store');
    Route::get('/{purchase}', [PurchaseController::class, 'show'])->name('purchases.show');
    Route::get('/{purchase}/edit', [PurchaseController::class, 'edit'])->name('purchases.edit');
    Route::put('/{purchase}', [PurchaseController::class, 'update'])->name('purchases.update');
    Route::delete('/{purchase}', [PurchaseController::class, 'destroy'])->name('purchases.destroy');
    Route::post('/{purchase}/receive', [PurchaseController::class, 'receive'])->name('purchases.receive');
});

// Suppliers Routes
Route::resource('suppliers', SupplierController::class);

// Customer Groups Routes
Route::resource('customer-groups', CustomerGroupController::class);

// Staff Routes
Route::resource('staff', StaffController::class);

// Attendance Routes
Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
Route::get('/attendance/create', [AttendanceController::class, 'create'])->name('attendance.create');
Route::post('/attendance', [AttendanceController::class, 'store'])->name('attendance.store');
Route::get('/attendance/{attendance}/edit', [AttendanceController::class, 'edit'])->name('attendance.edit');
Route::put('/attendance/{attendance}', [AttendanceController::class, 'update'])->name('attendance.update');
Route::delete('/attendance/{attendance}', [AttendanceController::class, 'destroy'])->name('attendance.destroy');
Route::post('/attendance/mark', [AttendanceController::class, 'markAttendance'])->name('attendance.mark');

// Payroll Routes
Route::get('/payroll', [PayrollController::class, 'index'])->name('payroll.index');
Route::get('/payroll/create', [PayrollController::class, 'create'])->name('payroll.create');
Route::post('/payroll', [PayrollController::class, 'store'])->name('payroll.store');
Route::get('/payroll/{salary_payment}', [PayrollController::class, 'show'])->name('payroll.show');
Route::get('/payroll/{salary_payment}/edit', [PayrollController::class, 'edit'])->name('payroll.edit');
Route::put('/payroll/{salary_payment}', [PayrollController::class, 'update'])->name('payroll.update');
Route::delete('/payroll/{salary_payment}', [PayrollController::class, 'destroy'])->name('payroll.destroy');

// Reports Routes
Route::prefix('reports')->group(function () {
    Route::get('/sales', [ReportController::class, 'sales'])->name('reports.sales');
    Route::get('/inventory', [ReportController::class, 'inventory'])->name('reports.inventory');
    Route::get('/customers', [ReportController::class, 'customers'])->name('reports.customers');
    Route::get('/staff', [ReportController::class, 'staff'])->name('reports.staff');
    Route::get('/profit-loss', [ReportController::class, 'profitLoss'])->name('reports.profit-loss');
    Route::get('/financial', [ReportController::class, 'financial'])->name('reports.financial');
    Route::get('/export/{type}', [ReportController::class, 'export'])->name('reports.export');
});

// Accounts Routes
Route::resource('accounts', AccountController::class);

// Transactions Routes
Route::resource('transactions', TransactionController::class);

// Journal Entries Routes
Route::resource('journal-entries', JournalEntryController::class);

// Ledger Routes
Route::get('/ledger', [LedgerController::class, 'index'])->name('ledger.index');
Route::get('/ledger/{account}', [LedgerController::class, 'show'])->name('ledger.show');
Route::get('/ledger/export/{account}', [LedgerController::class, 'export'])->name('ledger.export');

// Expenses Routes
Route::resource('expenses', ExpenseController::class);

// Expense Categories Routes
Route::resource('expense-categories', ExpenseCategoryController::class);

// Branches Routes
Route::resource('branches', BranchController::class);

// Stock Transfers Routes
Route::resource('stock-transfers', StockTransferController::class);

// Settings Routes
Route::prefix('settings')->group(function () {
    // Shop Settings
    Route::get('/shop', [ShopSettingsController::class, 'index'])->name('shop-settings.index');
    Route::put('/shop', [ShopSettingsController::class, 'update'])->name('shop-settings.update');

    // Tax Settings
    Route::get('/tax', [TaxSettingsController::class, 'index'])->name('tax-settings.index');
    Route::post('/tax', [TaxSettingsController::class, 'store'])->name('tax-settings.store');
    Route::put('/tax/{tax_setting}', [TaxSettingsController::class, 'update'])->name('tax-settings.update');
    Route::delete('/tax/{tax_setting}', [TaxSettingsController::class, 'destroy'])->name('tax-settings.destroy');

    // User Management
    Route::get('/users', [UserManagementController::class, 'index'])->name('user-management.index');
    Route::get('/users/create', [UserManagementController::class, 'create'])->name('user-management.create');
    Route::post('/users', [UserManagementController::class, 'store'])->name('user-management.store');
    Route::get('/users/{user}/edit', [UserManagementController::class, 'edit'])->name('user-management.edit');
    Route::put('/users/{user}', [UserManagementController::class, 'update'])->name('user-management.update');
    Route::delete('/users/{user}', [UserManagementController::class, 'destroy'])->name('user-management.destroy');
    Route::post('/users/{user}/assign-roles', [UserManagementController::class, 'assignRoles'])->name('user-management.assign-roles');

    // Backup
    Route::get('/backup', [BackupController::class, 'index'])->name('backup.index');
    Route::post('/backup/create', [BackupController::class, 'createBackup'])->name('backup.create');
    Route::post('/backup/restore', [BackupController::class, 'restore'])->name('backup.restore');
    Route::delete('/backup/{backup}', [BackupController::class, 'destroy'])->name('backup.destroy');
    Route::get('/backup/download/{backup}', [BackupController::class, 'download'])->name('backup.download');
});

// Authentication Routes (if not using Laravel Breeze/Jetstream)
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

// Profile Routes
Route::get('/profile', 'ProfileController@index')->name('profile.index');
Route::put('/profile', 'ProfileController@update')->name('profile.update');
Route::get('/profile/change-password', 'ProfileController@changePassword')->name('profile.change-password');
Route::post('/profile/update-password', 'ProfileController@updatePassword')->name('profile.update-password');

// Dashboard Charts Data (AJAX)
Route::get('/dashboard/sales-data', [DashboardController::class, 'salesData'])->name('dashboard.sales-data');
Route::get('/dashboard/top-products', [DashboardController::class, 'topProducts'])->name('dashboard.top-products');
Route::get('/dashboard/low-stock', [DashboardController::class, 'lowStock'])->name('dashboard.low-stock');
Route::get('/dashboard/recent-activities', [DashboardController::class, 'recentActivities'])->name('dashboard.recent-activities');
Route::get('/dashboard', function () {
    return view('dashboard.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
