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
        Schema::create('salary_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('staff_id')->constrained();
            $table->date('payment_date');
            $table->date('salary_month');
            // Earnings
            $table->decimal('basic_salary', 10, 2);
            $table->decimal('allowances', 10, 2)->default(0.00);
            $table->decimal('overtime_amount', 10, 2)->default(0.00);
            $table->decimal('commission_amount', 10, 2)->default(0.00);
            $table->decimal('bonus', 10, 2)->default(0.00);
            $table->decimal('incentives', 10, 2)->default(0.00);
            $table->decimal('total_earnings', 10, 2);
            // Deductions
            $table->decimal('deductions', 10, 2)->default(0.00);
            $table->decimal('advance_deduction', 10, 2)->default(0.00);
            $table->decimal('tax_deduction', 10, 2)->default(0.00);
            $table->decimal('other_deductions', 10, 2)->default(0.00);
            $table->decimal('total_deductions', 10, 2);
            // Net
            $table->decimal('net_amount', 10, 2);
            // Payment Details
            $table->enum('payment_method', ['cash', 'bank_transfer', 'cheque', 'upi'])->default('bank_transfer');
            $table->string('payment_reference', 100)->nullable();
            $table->string('transaction_id', 100)->nullable();
            $table->string('bank_name', 100)->nullable();
            $table->string('account_number', 30)->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('paid_by')->nullable()->constrained('users');
            $table->foreignId('approved_by')->nullable()->constrained('users');
            $table->timestamps();
            $table->index(['salary_month']);
            $table->index(['staff_id', 'salary_month']);
            $table->unique(['staff_id', 'salary_month']);
        });

        Schema::create('salary_advances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('staff_id')->constrained();
            $table->decimal('advance_amount', 10, 2);
            $table->date('request_date');
            $table->text('reason')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected', 'paid'])->default('pending');
            $table->foreignId('approved_by')->nullable()->constrained('users');
            $table->date('approved_date')->nullable();
            $table->integer('repayment_months')->default(3);
            $table->decimal('monthly_deduction', 10, 2)->nullable();
            $table->decimal('total_deducted', 10, 2)->default(0.00);
            $table->decimal('balance_amount', 10, 2);
            $table->timestamps();
            $table->index(['staff_id', 'status']);
            $table->index(['status', 'request_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salary_tables');
    }
};
