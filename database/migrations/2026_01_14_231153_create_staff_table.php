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
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();
            $table->string('employee_code', 20)->unique();
            $table->string('designation', 100);
            $table->enum('department', ['sales', 'inventory', 'accounts', 'management', 'purchasing', 'hr', 'marketing', 'other'])->default('sales');
            // Personal Info
            $table->date('date_of_joining');
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->enum('marital_status', ['single', 'married', 'divorced', 'widowed'])->default('single');
            // Emergency Contact
            $table->string('emergency_contact', 20)->nullable();
            $table->string('emergency_contact_name', 100)->nullable();
            $table->string('emergency_contact_relation', 50)->nullable();
            // Bank Details
            $table->string('bank_account_number', 30)->nullable();
            $table->string('bank_name', 100)->nullable();
            $table->string('branch_name', 100)->nullable();
            $table->string('ifsc_code', 20)->nullable();
            // Government IDs
            $table->string('aadhar_number', 20)->nullable();
            $table->string('pan_number', 20)->nullable();
            $table->string('passport_number', 20)->nullable();
            // Salary
            $table->decimal('basic_salary', 10, 2);
            $table->decimal('allowances', 10, 2)->default(0.00);
            $table->decimal('deductions', 10, 2)->default(0.00);
            $table->decimal('net_salary', 10, 2);
            // Employment
            $table->enum('employment_type', ['permanent', 'contract', 'temporary', 'intern', 'probation'])->default('permanent');
            $table->enum('employment_status', ['active', 'inactive', 'terminated', 'resigned'])->default('active');
            $table->date('termination_date')->nullable();
            $table->text('termination_reason')->nullable();
            // Performance
            $table->decimal('sales_target', 12, 2)->default(0.00);
            $table->decimal('current_month_sales', 12, 2)->default(0.00);
            $table->decimal('total_sales', 12, 2)->default(0.00);
            $table->decimal('commission_rate', 5, 2)->default(0.00);
            $table->boolean('is_active')->default(true);
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->index(['employee_code']);
            $table->index(['department']);
            $table->index(['employment_status']);
            $table->index(['is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
