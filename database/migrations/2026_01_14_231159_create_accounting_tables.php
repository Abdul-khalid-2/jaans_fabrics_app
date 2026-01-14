<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('account_types', function (Blueprint $table) {
            $table->id();
            $table->string('type_code', 20)->unique();
            $table->string('type_name', 50);
            $table->enum('category', ['asset', 'liability', 'equity', 'revenue', 'expense', 'cost_of_sales']);
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->unique(['type_name']);
        });

        // Insert default account types
        DB::table('account_types')->insert([
            ['type_code' => 'CASH', 'type_name' => 'Cash', 'category' => 'asset', 'description' => 'Physical cash on hand'],
            ['type_code' => 'BANK', 'type_name' => 'Bank Accounts', 'category' => 'asset', 'description' => 'Bank account balances'],
            ['type_code' => 'AR', 'type_name' => 'Accounts Receivable', 'category' => 'asset', 'description' => 'Money owed by customers'],
            ['type_code' => 'INVENTORY', 'type_name' => 'Inventory', 'category' => 'asset', 'description' => 'Value of goods in stock'],
            ['type_code' => 'AP', 'type_name' => 'Accounts Payable', 'category' => 'liability', 'description' => 'Money owed to suppliers'],
            ['type_code' => 'LOANS', 'type_name' => 'Loans Payable', 'category' => 'liability', 'description' => 'Outstanding loans'],
            ['type_code' => 'EQUITY', 'type_name' => 'Owner\'s Equity', 'category' => 'equity', 'description' => 'Owner\'s investment'],
            ['type_code' => 'RETAINED', 'type_name' => 'Retained Earnings', 'category' => 'equity', 'description' => 'Accumulated profits'],
            ['type_code' => 'SALES', 'type_name' => 'Sales Revenue', 'category' => 'revenue', 'description' => 'Revenue from sales'],
            ['type_code' => 'PURCHASES', 'type_name' => 'Cost of Goods Sold', 'category' => 'cost_of_sales', 'description' => 'Cost of inventory sold'],
            ['type_code' => 'SALARY', 'type_name' => 'Salaries Expense', 'category' => 'expense', 'description' => 'Employee salaries'],
            ['type_code' => 'RENT', 'type_name' => 'Rent Expense', 'category' => 'expense', 'description' => 'Shop rent'],
            ['type_code' => 'UTILITIES', 'type_name' => 'Utilities Expense', 'category' => 'expense', 'description' => 'Electricity, water, etc.'],
        ]);

        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('account_code', 20)->unique();
            $table->string('account_name', 100);
            $table->foreignId('account_type_id')->constrained();
            $table->foreignId('parent_account_id')->nullable()->constrained('accounts')->nullOnDelete();
            // Balances
            $table->decimal('opening_balance', 12, 2)->default(0.00);
            $table->enum('opening_balance_type', ['debit', 'credit'])->default('debit');
            $table->decimal('current_balance', 12, 2)->default(0.00);
            // Settings
            $table->foreignId('branch_id')->nullable()->constrained()->nullOnDelete();
            $table->boolean('is_cash_account')->default(false);
            $table->boolean('is_bank_account')->default(false);
            $table->boolean('is_system_account')->default(false);
            $table->boolean('is_active')->default(true);
            // Bank Details (if applicable)
            $table->string('bank_name', 100)->nullable();
            $table->string('account_number', 30)->nullable();
            $table->string('ifsc_code', 20)->nullable();
            $table->string('branch_name', 100)->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->index(['account_type_id']);
            $table->index(['branch_id', 'is_active']);
            $table->index(['parent_account_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounting_tables');
    }
};
