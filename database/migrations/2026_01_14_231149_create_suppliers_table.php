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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('supplier_code', 20)->unique();
            $table->string('company_name', 200);
            $table->string('contact_person', 100)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('phone', 20);
            $table->string('alternate_phone', 20)->nullable();
            // Address
            $table->text('address')->nullable();
            $table->string('city', 100)->nullable();
            $table->string('state', 100)->nullable();
            $table->string('pincode', 10)->nullable();
            $table->string('country_code', 2)->default('IN');
            // Business Info
            $table->string('tax_id', 50)->nullable();
            $table->string('business_id', 50)->nullable();
            $table->string('website')->nullable();
            // Bank Details
            $table->string('account_number', 30)->nullable();
            $table->string('account_holder', 100)->nullable();
            $table->string('bank_name', 100)->nullable();
            $table->string('branch_name', 100)->nullable();
            $table->string('ifsc_code', 20)->nullable();
            // Financial
            $table->decimal('credit_limit', 12, 2)->default(0.00);
            $table->decimal('current_balance', 12, 2)->default(0.00);
            $table->decimal('total_purchases', 12, 2)->default(0.00);
            $table->decimal('outstanding_amount', 12, 2)->default(0.00);
            $table->string('payment_terms', 100)->nullable();
            $table->integer('payment_days')->default(30);
            // Classification
            $table->enum('supplier_type', ['manufacturer', 'wholesaler', 'distributor', 'importer', 'local_vendor'])->default('wholesaler');
            $table->decimal('rating', 3, 2)->default(0.00);
            // Status
            $table->boolean('is_active')->default(true);
            $table->boolean('is_blacklisted')->default(false);
            $table->text('blacklist_reason')->nullable();
            $table->text('notes')->nullable();
            $table->date('last_purchase_date')->nullable();
            $table->timestamps();
            $table->foreign('country_code')->references('country_code')->on('countries');
            $table->index(['company_name']);
            $table->index(['supplier_code']);
            $table->index(['is_active', 'supplier_type']);
        });

        Schema::create('supplier_branches', function (Blueprint $table) {
            $table->foreignId('supplier_id')->constrained()->cascadeOnDelete();
            $table->foreignId('branch_id')->constrained()->cascadeOnDelete();
            $table->boolean('is_primary')->default(false);
            $table->integer('delivery_days')->default(7);
            $table->decimal('minimum_order_value', 10, 2)->default(0.00);
            $table->timestamp('assigned_at')->useCurrent();
            $table->primary(['supplier_id', 'branch_id']);
            $table->index(['branch_id', 'supplier_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
