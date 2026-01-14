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
        Schema::create('expense_categories', function (Blueprint $table) {
            $table->id();
            $table->string('category_code', 20)->unique();
            $table->string('category_name', 100);
            $table->foreignId('parent_id')->nullable()->constrained('expense_categories')->nullOnDelete();
            $table->text('description')->nullable();
            $table->foreignId('account_id')->nullable()->constrained('accounts')->nullOnDelete();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->index(['parent_id']);
            $table->unique(['category_name']);
        });

        // Insert default expense categories
        DB::table('expense_categories')->insert([
            ['category_code' => 'RENT', 'category_name' => 'Rent', 'description' => 'Shop/Office rent'],
            ['category_code' => 'SALARY', 'category_name' => 'Salaries', 'description' => 'Staff salaries'],
            ['category_code' => 'ELECTRICITY', 'category_name' => 'Electricity', 'description' => 'Electricity bills'],
            ['category_code' => 'WATER', 'category_name' => 'Water', 'description' => 'Water bills'],
            ['category_code' => 'INTERNET', 'category_name' => 'Internet', 'description' => 'Internet and phone bills'],
            ['category_code' => 'MAINTENANCE', 'category_name' => 'Maintenance', 'description' => 'Shop maintenance'],
            ['category_code' => 'MARKETING', 'category_name' => 'Marketing', 'description' => 'Advertising and promotions'],
            ['category_code' => 'TRANSPORT', 'category_name' => 'Transport', 'description' => 'Delivery and transportation'],
            ['category_code' => 'STATIONERY', 'category_name' => 'Stationery', 'description' => 'Office supplies'],
            ['category_code' => 'OTHER', 'category_name' => 'Other Expenses', 'description' => 'Miscellaneous expenses'],
        ]);

        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->string('expense_number', 50)->unique();
            $table->date('expense_date');
            $table->foreignId('category_id')->constrained();
            $table->foreignId('branch_id')->constrained();
            // Amount
            $table->decimal('amount', 10, 2);
            $table->decimal('tax_amount', 10, 2)->default(0.00);
            $table->decimal('total_amount', 10, 2);
            // Payment
            $table->enum('payment_method', ['cash', 'card', 'bank_transfer', 'upi', 'cheque'])->default('cash');
            $table->string('payment_reference', 100)->nullable();
            $table->string('paid_to', 200)->nullable();
            // Description
            $table->text('description')->nullable();
            $table->string('receipt_image')->nullable();
            $table->json('supporting_documents')->nullable();
            // Approval
            $table->foreignId('approved_by')->nullable()->constrained('users');
            $table->foreignId('recorded_by')->constrained('users');
            // Recurring
            $table->boolean('is_recurring')->default(false);
            $table->enum('recurring_frequency', ['daily', 'weekly', 'monthly', 'quarterly', 'yearly'])->nullable();
            $table->date('recurring_end_date')->nullable();
            $table->timestamps();
            $table->index(['expense_date']);
            $table->index(['category_id', 'expense_date']);
            $table->index(['branch_id', 'expense_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses_tables');
    }
};
