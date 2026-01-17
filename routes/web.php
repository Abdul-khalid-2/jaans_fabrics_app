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
use App\Http\Controllers\AccountingReportController;
use App\Http\Controllers\AccountTypeController;
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
use App\Http\Controllers\CustomerReportController;
use App\Http\Controllers\FinancialReportController;
use App\Http\Controllers\InventoryReportController;
use App\Http\Controllers\PurchaseReceiveController;
use App\Http\Controllers\SalesReportController;
use App\Http\Controllers\StaffReportController;
use App\Http\Controllers\StockAdjustmentController;
use App\Http\Controllers\StockMovementController;
use App\Http\Controllers\StaffAttendanceController;
use App\Http\Controllers\StaffPayrollController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard/analytics', [DashboardController::class, 'analytics'])->name('dashboard.analytics');

Route::middleware(['auth'])->group(function () {

    Route::resource('products', ProductController::class);
    Route::resource('sales', SaleController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('brands', BrandController::class);

    // Inventory Routes
    Route::prefix('inventory')->name('inventory.')->group(function () {
        // Dashboard
        Route::get('/', [InventoryController::class, 'index'])->name('index');
        // Route::get('/{product}', [InventoryController::class, 'show'])->name('show');

        // Stock Adjustments
        Route::get('/adjustments', [StockAdjustmentController::class, 'index'])->name('adjustments.index');
        Route::get('/adjustments/create', [StockAdjustmentController::class, 'create'])->name('adjustments.create');
        Route::get('/adjustments/{adjustment}', [StockAdjustmentController::class, 'show'])->name('adjustments.show');
        Route::get('/adjustments/{adjustment}/edit', [StockAdjustmentController::class, 'edit'])->name('adjustments.edit');


        Route::get('/{product}', [InventoryController::class, 'show'])->name('show');
        // Stock Movements
        Route::prefix('movements')->name('movements.')->group(function () {
            Route::get('/', [StockMovementController::class, 'index'])->name('index');
        });
    });


    Route::resource('suppliers', SupplierController::class);

    // Purchase Routes
    Route::prefix('purchases')->name('purchases.')->group(function () {
        Route::resource('/', PurchaseController::class);

        // Purchase Receiving Routes
        Route::prefix('{purchase}/receive')->name('receive.')->group(function () {
            Route::get('/create', [PurchaseReceiveController::class, 'create'])->name('create');
            Route::post('/', [PurchaseReceiveController::class, 'store'])->name('store');
            Route::get('/{receive}', [PurchaseReceiveController::class, 'show'])->name('show');
        });
    });




    // Dashboard Routes
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/charts/sales', [DashboardController::class, 'salesChart'])->name('dashboard.charts.sales');
    Route::get('/dashboard/widgets/sales-summary', [DashboardController::class, 'salesSummaryWidget'])->name('dashboard.widgets.sales-summary');
    Route::get('/dashboard/widgets/low-stock', [DashboardController::class, 'lowStockWidget'])->name('dashboard.widgets.low-stock');
    Route::get('/dashboard/widgets/top-products', [DashboardController::class, 'topProductsWidget'])->name('dashboard.widgets.top-products');
    Route::get('/dashboard/charts/inventory', [DashboardController::class, 'inventoryChart'])->name('dashboard.charts.inventory');

    // Reports Routes
    Route::prefix('reports')->name('reports.')->group(function () {
        // Reports Dashboard
        Route::get('/', [ReportController::class, 'index'])->name('index');

        // Sales Reports
        Route::prefix('sales')->name('sales.')->group(function () {
            Route::get('/', [SalesReportController::class, 'index'])->name('index');
            Route::get('/daily', [SalesReportController::class, 'daily'])->name('daily');
            Route::get('/product', [SalesReportController::class, 'product'])->name('product');
        });

        // Inventory Reports
        Route::prefix('inventory')->name('inventory.')->group(function () {
            Route::get('/', [InventoryReportController::class, 'index'])->name('index');
            Route::get('/stock-levels', [InventoryReportController::class, 'stockLevels'])->name('stock-levels');
            Route::get('/movements', [InventoryReportController::class, 'movements'])->name('movements');
        });

        // Customer Reports
        Route::prefix('customers')->name('customers.')->group(function () {
            Route::get('/', [CustomerReportController::class, 'index'])->name('index');
            Route::get('/sales', [CustomerReportController::class, 'sales'])->name('sales');
            Route::get('/loyalty', [CustomerReportController::class, 'loyalty'])->name('loyalty');
        });

        // Staff Reports
        Route::prefix('staff')->name('staff.')->group(function () {
            Route::get('/', [StaffReportController::class, 'index'])->name('index');
        });

        // Financial Reports
        Route::prefix('financial')->name('financial.')->group(function () {
            Route::get('/', [FinancialReportController::class, 'index'])->name('index');
            Route::get('/profit-loss', [FinancialReportController::class, 'profitLoss'])->name('profit-loss');
        });
    });


    // Accounts Routes
    Route::prefix('accounts')->name('accounts.')->group(function () {
        // Chart of Accounts
        Route::resource('accounts', AccountController::class)->parameters([
            'accounts' => 'account'
        ])->except(['show']); // Remove 'show' if you don't need it

        // Account Types
        Route::prefix('types')->name('types.')->group(function () {
            Route::resource('/', AccountTypeController::class);
        });

        // Transactions
        Route::name('transactions.')->group(function () {
            Route::resource('transactions/', TransactionController::class);
        });

        // Journal Entries
        Route::prefix('journal')->name('journal.')->group(function () {
            Route::resource('entries', JournalEntryController::class);
        });

        // Ledger
        Route::prefix('ledger')->name('ledger.')->group(function () {
            Route::get('/', [LedgerController::class, 'index'])->name('index');
            Route::get('/account/{account}', [LedgerController::class, 'accountLedger'])->name('account');
            Route::get('/trial-balance', [LedgerController::class, 'trialBalance'])->name('trial-balance');
        });

        // Reports
        Route::prefix('reports')->name('reports.')->group(function () {
            Route::get('/balance-sheet', [AccountingReportController::class, 'balanceSheet'])->name('balance-sheet');
            Route::get('/income-statement', [AccountingReportController::class, 'incomeStatement'])->name('income-statement');
            Route::get('/cash-flow', [AccountingReportController::class, 'cashFlow'])->name('cash-flow');
            Route::prefix('aging')->name('aging.')->group(function () {
                Route::get('/receivables', [AccountingReportController::class, 'receivablesAging'])->name('receivables');
                Route::get('/payables', [AccountingReportController::class, 'payablesAging'])->name('payables');
            });
        });
    });



    // Staff Routes
    Route::prefix('staff')->name('staff.')->group(function () {
        // Staff Attendance
        Route::prefix('attendance')->name('attendance.')->group(function () {
            Route::get('/', [StaffAttendanceController::class, 'index'])->name('index');
            Route::get('/create', [StaffAttendanceController::class, 'create'])->name('create');
            Route::post('/', [StaffAttendanceController::class, 'store'])->name('store');
            Route::get('/{id}', [StaffAttendanceController::class, 'show'])->name('show');
            Route::get('/{id}/edit', [StaffAttendanceController::class, 'edit'])->name('edit');
            Route::put('/{id}', [StaffAttendanceController::class, 'update'])->name('update');
        });

        // Staff Payroll
        Route::prefix('payroll')->name('payroll.')->group(function () {
            Route::get('/', [StaffPayrollController::class, 'index'])->name('index');
            Route::get('/create', [StaffPayrollController::class, 'create'])->name('create');
            Route::post('/', [StaffPayrollController::class, 'store'])->name('store');
            Route::get('/{id}', [StaffPayrollController::class, 'show'])->name('show');
            Route::get('/{id}/edit', [StaffPayrollController::class, 'edit'])->name('edit');
            Route::put('/{id}', [StaffPayrollController::class, 'update'])->name('update');
        });

        // Staff Management
        Route::get('/', [StaffController::class, 'index'])->name('index');
        Route::get('/create', [StaffController::class, 'create'])->name('create');
        Route::post('/', [StaffController::class, 'store'])->name('store');
        Route::get('/{id}', [StaffController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [StaffController::class, 'edit'])->name('edit');
        Route::put('/{id}', [StaffController::class, 'update'])->name('update');
        Route::delete('/{id}', [StaffController::class, 'destroy'])->name('destroy');





        // Bulk Actions
        Route::post('/bulk-import', [StaffController::class, 'bulkImport'])->name('bulk.import');
        Route::post('/bulk-attendance', [StaffAttendanceController::class, 'bulkAttendance'])->name('bulk.attendance');
        Route::post('/process-salary', [StaffPayrollController::class, 'processSalary'])->name('process.salary');
    });
});

// Collections Routes
Route::resource('collections', CollectionController::class);



// Sale Returns Routes
Route::resource('sale-returns', SaleReturnController::class);

// POS Routes
Route::get('/pos', [PosController::class, 'index'])->name('pos.index');
Route::post('/pos/process-sale', [PosController::class, 'processSale'])->name('pos.process-sale');
Route::get('/pos/get-products', [PosController::class, 'getProducts'])->name('pos.get-products');
Route::get('/pos/get-customers', [PosController::class, 'getCustomers'])->name('pos.get-customers');



// Customer Groups Routes
Route::resource('customer-groups', CustomerGroupController::class);

// Staff Routes


// Attendance Routes

// Payroll Routes
Route::get('/payroll', [PayrollController::class, 'index'])->name('payroll.index');
Route::get('/payroll/create', [PayrollController::class, 'create'])->name('payroll.create');
Route::post('/payroll', [PayrollController::class, 'store'])->name('payroll.store');
Route::get('/payroll/{salary_payment}', [PayrollController::class, 'show'])->name('payroll.show');
Route::get('/payroll/{salary_payment}/edit', [PayrollController::class, 'edit'])->name('payroll.edit');
Route::put('/payroll/{salary_payment}', [PayrollController::class, 'update'])->name('payroll.update');
Route::delete('/payroll/{salary_payment}', [PayrollController::class, 'destroy'])->name('payroll.destroy');



// Accounts Routes
Route::resource('accounts', AccountController::class);

// Transactions Routes
Route::resource('transactions', TransactionController::class);

// Journal Entries Routes
// Route::resource('journal-entries', JournalEntryController::class);

// Ledger Routes
// Route::get('/ledger', [LedgerController::class, 'index'])->name('ledger.index');
// Route::get('/ledger/{account}', [LedgerController::class, 'show'])->name('ledger.show');
// Route::get('/ledger/export/{account}', [LedgerController::class, 'export'])->name('ledger.export');

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
