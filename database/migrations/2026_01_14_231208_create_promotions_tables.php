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
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string('promotion_code', 50)->unique();
            $table->string('promotion_name', 100);
            $table->enum('promotion_type', ['percentage', 'fixed', 'bogo', 'shipping', 'loyalty']);
            $table->decimal('discount_value', 10, 2);
            $table->decimal('minimum_purchase', 10, 2)->default(0.00);
            $table->decimal('maximum_discount', 10, 2)->nullable();
            $table->json('applicable_categories')->nullable();
            $table->json('excluded_categories')->nullable();
            $table->json('applicable_brands')->nullable();
            $table->json('excluded_brands')->nullable();
            $table->json('applicable_products')->nullable();
            $table->json('excluded_products')->nullable();
            $table->enum('customer_type', ['all', 'new', 'existing', 'vip'])->default('all');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('usage_limit')->nullable();
            $table->integer('per_customer_limit')->default(1);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->index(['start_date', 'end_date', 'is_active']);
            $table->index(['promotion_code']);
        });

        Schema::create('promotion_usage', function (Blueprint $table) {
            $table->id();
            $table->foreignId('promotion_id')->constrained();
            $table->foreignId('customer_id')->nullable()->constrained();
            $table->foreignId('sale_id')->constrained();
            $table->timestamp('used_at')->useCurrent();
            $table->decimal('discount_applied', 10, 2);
            $table->timestamps();
            $table->index(['promotion_id', 'customer_id']);
            $table->index(['sale_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotions_tables');
    }
};
