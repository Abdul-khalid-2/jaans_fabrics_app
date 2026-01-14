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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_code', 50)->unique();
            $table->string('sku', 50)->unique();
            $table->string('product_name', 200);
            $table->text('short_description')->nullable();
            $table->longText('long_description')->nullable();
            $table->foreignId('category_id')->constrained();
            $table->foreignId('brand_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('collection_id')->nullable()->constrained()->nullOnDelete();
            $table->enum('gender', ['male', 'female', 'unisex', 'kids', 'infants'])->default('unisex');
            $table->enum('age_group', ['infant', 'kids', 'teens', 'adults', 'all'])->default('adults');
            $table->enum('seasonality', ['winter', 'summer', 'all_season', 'festive'])->default('all_season');
            // Pricing
            $table->decimal('cost_price', 10, 2);
            $table->decimal('mrp_price', 10, 2);
            $table->decimal('sale_price', 10, 2)->nullable();
            $table->decimal('wholesale_price', 10, 2)->nullable();
            // Dimensions and Weight
            $table->decimal('weight_kg', 6, 3)->nullable();
            $table->decimal('length_cm', 6, 2)->nullable();
            $table->decimal('width_cm', 6, 2)->nullable();
            $table->decimal('height_cm', 6, 2)->nullable();
            // Care Instructions
            $table->text('care_instructions')->nullable();
            $table->string('fabric_composition', 255)->nullable();
            $table->string('origin_country', 2)->nullable();
            // Inventory
            $table->boolean('has_variants')->default(false);
            $table->integer('reorder_level')->default(10);
            $table->integer('reorder_quantity')->default(50);
            // Tax
            $table->decimal('tax_rate', 5, 2)->default(0.00);
            $table->string('hsn_code', 10)->nullable();
            // Status
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_new_arrival')->default(true);
            $table->boolean('is_bestseller')->default(false);
            $table->boolean('is_active')->default(true);
            // Metadata
            $table->string('barcode', 100)->unique()->nullable();
            $table->text('search_keywords')->nullable();
            $table->decimal('rating', 3, 2)->default(0.00);
            $table->integer('total_ratings')->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('origin_country')->references('country_code')->on('countries');
            $table->index(['category_id', 'brand_id']);
            $table->index(['gender', 'seasonality']);
            $table->index(['mrp_price', 'sale_price']);
            $table->index(['is_active', 'is_featured', 'is_new_arrival']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
