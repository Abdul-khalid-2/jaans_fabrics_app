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
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->string('variant_code', 100)->unique();
            $table->string('variant_sku', 100)->unique();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->string('size', 20)->nullable();
            $table->string('color', 50)->nullable();
            $table->string('material', 50)->nullable();
            $table->string('fit', 30)->nullable();
            $table->decimal('additional_price', 10, 2)->default(0.00);
            $table->decimal('weight_variance', 5, 3)->default(0.000);
            $table->string('image_url')->nullable();
            $table->string('barcode', 100)->unique()->nullable();
            $table->boolean('is_default')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->index(['product_id', 'variant_code']);
            $table->index(['size', 'color']);
            $table->index(['variant_sku']);
        });

        Schema::create('variant_attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('variant_id')->constrained('product_variants')->cascadeOnDelete();
            $table->foreignId('attribute_id')->constrained('product_attributes');
            $table->foreignId('attribute_value_id')->constrained('attribute_values');
            $table->timestamps();
            $table->unique(['variant_id', 'attribute_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
