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
        Schema::create('product_attributes', function (Blueprint $table) {
            $table->id();
            $table->string('attribute_code', 50)->unique();
            $table->string('attribute_name', 100);
            $table->enum('attribute_type', ['size', 'color', 'material', 'fit', 'style', 'pattern', 'sleeve_length', 'neck_type']);
            $table->integer('display_order')->default(0);
            $table->boolean('is_filterable')->default(true);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('attribute_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attribute_id')->constrained('product_attributes')->cascadeOnDelete();
            $table->string('value', 100);
            $table->string('display_value', 100)->nullable();
            $table->integer('display_order')->default(0);
            $table->string('hex_code', 7)->nullable();
            $table->string('image_url')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->unique(['attribute_id', 'value']);
            $table->index(['attribute_id', 'display_order']);
        });

        Schema::create('product_attribute_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->foreignId('attribute_id')->constrained('product_attributes');
            $table->foreignId('attribute_value_id')->constrained('attribute_values');
            $table->timestamps();
            // $table->unique(['product_id', 'attribute_id', 'attribute_value_id']);
            $table->unique(['product_id', 'attribute_id', 'attribute_value_id'], 'prod_attr_val_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_attributes_tables');
    }
};
