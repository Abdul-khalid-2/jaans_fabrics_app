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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number', 50)->unique();
            $table->foreignId('branch_id')->constrained();
            // Dates and Times
            $table->date('sale_date');
            $table->time('sale_time');
            $table->dateTime('sale_datetime')->storedAs('TIMESTAMP(sale_date, sale_time)');
            // Customer Info
            $table->foreignId('customer_id')->nullable()->constrained()->nullOnDelete();
            $table->string('customer_name', 100)->nullable();
            $table->string('customer_phone', 20)->nullable();
            $table->string('customer_email', 100)->nullable();
            $table->text('customer_address')->nullable();
            // Totals
            $table->integer('total_items');
            $table->decimal('subtotal', 12, 2);
            $table->decimal('discount_amount', 10, 2)->default(0.00);
            $table->decimal('discount_percentage', 5, 2)->default(0.00);
            $table->decimal('tax_amount', 10, 2)->default(0.00);
            $table->decimal('shipping_charge', 10, 2)->default(0.00);
            $table->decimal('handling_charge', 10, 2)->default(0.00);
            $table->decimal('rounding_adjustment', 5, 2)->default(0.00);
            $table->decimal('grand_total', 12, 2);
            // Payment
            $table->decimal('amount_paid', 12, 2);
            $table->decimal('balance_due', 10, 2)->default(0.00);
            $table->enum('payment_status', ['paid', 'partial', 'pending', 'refunded', 'cancelled'])->default('pending');
            $table->enum('sale_status', ['completed', 'pending', 'cancelled', 'returned', 'on_hold'])->default('pending');
            // Promotions
            $table->string('coupon_code', 50)->nullable();
            $table->decimal('coupon_discount', 10, 2)->default(0.00);
            $table->integer('loyalty_points_used')->default(0);
            $table->integer('loyalty_points_earned')->default(0);
            // Staff
            $table->foreignId('sales_person_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('cashier_id')->nullable()->constrained('users')->nullOnDelete();
            // Delivery
            $table->enum('delivery_type', ['pickup', 'home_delivery', 'express'])->default('pickup');
            $table->text('delivery_address')->nullable();
            $table->date('delivery_date')->nullable();
            $table->time('delivery_time')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->index(['sale_date']);
            $table->index(['branch_id', 'sale_date']);
            $table->index(['customer_id']);
            $table->index(['invoice_number']);
            $table->index(['payment_status', 'sale_status']);
            $table->index(['sale_datetime']);
        });

        Schema::create('sale_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained();
            $table->foreignId('variant_id')->nullable()->constrained('product_variants');
            // Product Info
            $table->string('product_code', 50);
            $table->string('product_name', 200);
            $table->string('size', 20)->nullable();
            $table->string('color', 50)->nullable();
            $table->string('material', 50)->nullable();
            // Pricing
            $table->integer('quantity');
            $table->decimal('unit_price', 10, 2);
            $table->decimal('cost_price', 10, 2);
            $table->decimal('discount_percentage', 5, 2)->default(0.00);
            $table->decimal('discount_amount', 10, 2)->default(0.00);
            $table->decimal('tax_percentage', 5, 2)->default(0.00);
            $table->decimal('tax_amount', 10, 2)->default(0.00);
            $table->decimal('total_price', 10, 2);
            // Returns
            $table->integer('returned_quantity')->default(0);
            $table->string('return_reason', 100)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->index(['sale_id', 'product_id']);
            $table->index(['product_id', 'sale_id']);
        });

        Schema::create('sale_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_id')->constrained()->cascadeOnDelete();
            $table->enum('payment_method', ['cash', 'card', 'upi', 'bank_transfer', 'credit', 'wallet', 'cheque', 'emi']);
            $table->string('payment_method_detail', 100)->nullable();
            $table->decimal('amount', 10, 2);
            $table->string('reference_number', 100)->nullable();
            $table->string('transaction_id', 100)->nullable();
            $table->date('payment_date');
            $table->time('payment_time');
            $table->enum('payment_status', ['success', 'failed', 'pending', 'refunded'])->default('success');
            $table->string('card_type', 20)->nullable();
            $table->string('card_last_four', 4)->nullable();
            $table->string('upi_id', 50)->nullable();
            $table->string('bank_name', 100)->nullable();
            $table->foreignId('collected_by')->constrained('users');
            $table->foreignId('verified_by')->nullable()->constrained('users');
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->index(['sale_id', 'payment_method']);
            $table->index(['payment_date']);
            $table->index(['reference_number']);
        });

        Schema::create('commissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('staff_id')->constrained();
            $table->foreignId('sale_id')->constrained();
            $table->date('commission_date');
            $table->decimal('sale_amount', 12, 2);
            $table->decimal('commission_rate', 5, 2);
            $table->decimal('commission_amount', 10, 2);
            $table->boolean('paid')->default(false);
            $table->date('payment_date')->nullable();
            $table->foreignId('payment_id')->nullable()->constrained('salary_payments')->nullOnDelete();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->index(['staff_id', 'commission_date']);
            $table->index(['paid', 'commission_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_tables');
    }
};
