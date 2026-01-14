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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->string('purchase_number', 50)->unique();
            $table->foreignId('supplier_id')->constrained();
            $table->foreignId('branch_id')->constrained();
            // Dates
            $table->date('order_date');
            $table->date('expected_delivery_date')->nullable();
            $table->date('actual_delivery_date')->nullable();
            // Totals
            $table->integer('total_items');
            $table->decimal('subtotal', 12, 2);
            $table->decimal('tax_amount', 10, 2)->default(0.00);
            $table->decimal('shipping_charge', 10, 2)->default(0.00);
            $table->decimal('other_charges', 10, 2)->default(0.00);
            $table->decimal('round_off', 5, 2)->default(0.00);
            $table->decimal('grand_total', 12, 2);
            // Payment
            $table->decimal('amount_paid', 12, 2)->default(0.00);
            $table->decimal('balance_due', 12, 2)->default(0.00);
            $table->enum('payment_status', ['paid', 'partial', 'pending', 'overdue'])->default('pending');
            $table->enum('purchase_status', ['ordered', 'received', 'partially_received', 'cancelled', 'returned'])->default('ordered');
            // Personnel
            $table->foreignId('ordered_by')->constrained('users');
            $table->foreignId('received_by')->nullable()->constrained('users');
            $table->foreignId('approved_by')->nullable()->constrained('users');
            // Shipping
            $table->string('shipping_method', 50)->nullable();
            $table->string('tracking_number', 100)->nullable();
            $table->string('carrier_name', 100)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->index(['order_date']);
            $table->index(['supplier_id', 'order_date']);
            $table->index(['purchase_status', 'payment_status']);
            $table->index(['branch_id', 'supplier_id']);
        });

        Schema::create('purchase_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained();
            $table->foreignId('variant_id')->nullable()->constrained('product_variants');
            // Quantities
            $table->integer('quantity_ordered');
            $table->integer('quantity_received')->default(0);
            $table->integer('quantity_rejected')->default(0);
            // Pricing
            $table->decimal('unit_cost', 10, 2);
            $table->decimal('total_cost', 10, 2);
            $table->decimal('discount_percentage', 5, 2)->default(0.00);
            $table->decimal('discount_amount', 10, 2)->default(0.00);
            $table->decimal('tax_percentage', 5, 2)->default(0.00);
            $table->decimal('tax_amount', 10, 2)->default(0.00);
            // Product Info
            $table->date('expiry_date')->nullable();
            $table->string('batch_number', 50)->nullable();
            $table->date('manufacturing_date')->nullable();
            // Status
            $table->enum('received_condition', ['good', 'damaged', 'expired'])->default('good');
            $table->text('rejection_reason')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->index(['purchase_id', 'product_id']);
            $table->index(['batch_number', 'expiry_date']);
        });

        Schema::create('supplier_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->constrained();
            $table->foreignId('purchase_id')->nullable()->constrained()->nullOnDelete();
            $table->date('payment_date');
            $table->enum('payment_method', ['cash', 'cheque', 'bank_transfer', 'upi', 'credit_card', 'dd']);
            $table->decimal('amount', 12, 2);
            $table->string('reference_number', 100)->nullable();
            $table->string('transaction_id', 100)->nullable();
            $table->text('payment_for')->nullable();
            $table->enum('payment_status', ['completed', 'pending', 'failed', 'cancelled'])->default('completed');
            $table->text('notes')->nullable();
            $table->foreignId('paid_by')->constrained('users');
            $table->foreignId('approved_by')->nullable()->constrained('users');
            $table->timestamps();
            $table->index(['supplier_id', 'payment_date']);
            $table->index(['payment_date']);
            $table->index(['reference_number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases_tables');
    }
};
