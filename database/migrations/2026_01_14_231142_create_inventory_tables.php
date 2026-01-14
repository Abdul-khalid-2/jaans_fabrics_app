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
        Schema::create('inventory', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->foreignId('variant_id')->nullable()->constrained('product_variants')->cascadeOnDelete();
            $table->foreignId('branch_id')->constrained()->cascadeOnDelete();
            $table->integer('current_stock')->default(0);
            $table->integer('available_stock')->default(0);
            $table->integer('reserved_stock')->default(0);
            $table->integer('sold_stock')->default(0);
            $table->integer('returned_stock')->default(0);
            $table->integer('damaged_stock')->default(0);
            $table->integer('minimum_stock')->default(5);
            $table->integer('maximum_stock')->default(100);
            $table->integer('reorder_point')->default(10);
            $table->string('aisle_number', 20)->nullable();
            $table->string('rack_number', 20)->nullable();
            $table->string('shelf_number', 20)->nullable();
            $table->string('bin_location', 50)->nullable();
            $table->date('last_restocked')->nullable();
            $table->date('last_sold_date')->nullable();
            $table->date('last_counted_date')->nullable();
            $table->timestamps();
            $table->unique(['product_id', 'variant_id', 'branch_id']);
            $table->index(['branch_id', 'current_stock']);
            $table->index(['branch_id', 'current_stock', 'minimum_stock']);
        });

        Schema::create('stock_movements', function (Blueprint $table) {
            $table->id();
            $table->enum('movement_type', ['purchase', 'sale', 'return', 'transfer_in', 'transfer_out', 'adjustment', 'damage', 'expired', 'sample']);
            $table->foreignId('product_id')->constrained();
            $table->foreignId('variant_id')->nullable()->constrained('product_variants');
            $table->foreignId('branch_id')->constrained();
            $table->integer('quantity');
            $table->integer('previous_stock');
            $table->integer('new_stock');
            $table->enum('reference_type', ['sale', 'purchase', 'transfer', 'adjustment'])->nullable();
            $table->unsignedBigInteger('reference_id')->nullable();
            $table->dateTime('movement_date');
            $table->text('reason')->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('recorded_by')->constrained('users');
            $table->timestamps();
            $table->index(['movement_date']);
            $table->index(['product_id', 'movement_date']);
            $table->index(['branch_id', 'movement_type', 'movement_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_tables');
    }
};
