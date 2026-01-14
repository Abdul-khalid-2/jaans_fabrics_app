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
        Schema::create('stock_adjustments', function (Blueprint $table) {
            $table->id();
            $table->string('adjustment_number', 50)->unique();
            $table->foreignId('branch_id')->constrained();
            $table->date('adjustment_date');
            $table->enum('adjustment_type', ['count', 'damage', 'expired', 'theft', 'sample', 'other']);
            $table->integer('total_items');
            $table->decimal('total_value', 12, 2);
            $table->text('reason')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users');
            $table->foreignId('recorded_by')->constrained('users');
            $table->timestamps();
            $table->index(['adjustment_date']);
            $table->index(['branch_id', 'adjustment_type']);
        });

        Schema::create('stock_adjustment_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('adjustment_id')->constrained('stock_adjustments')->cascadeOnDelete();
            $table->foreignId('product_id')->constrained();
            $table->foreignId('variant_id')->nullable()->constrained('product_variants');
            $table->integer('quantity_before');
            $table->integer('quantity_after');
            $table->integer('quantity_adjusted');
            $table->decimal('cost_price', 10, 2);
            $table->decimal('total_value', 10, 2);
            $table->text('reason')->nullable();
            $table->timestamps();
            $table->index(['adjustment_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_adjustments_tables');
    }
};
