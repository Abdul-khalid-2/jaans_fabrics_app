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
        Schema::create('sale_returns', function (Blueprint $table) {
            $table->id();
            $table->string('return_number', 50)->unique();
            $table->foreignId('sale_id')->constrained();
            $table->date('return_date');
            $table->integer('total_items');
            $table->decimal('refund_amount', 10, 2);
            $table->text('return_reason')->nullable();
            $table->enum('return_type', ['defective', 'wrong_size', 'color_issue', 'fit_issue', 'not_satisfied', 'quality_issue', 'delayed_delivery', 'other'])->default('other');
            $table->enum('return_status', ['pending', 'approved', 'rejected', 'processed', 'refunded'])->default('pending');
            $table->foreignId('handled_by')->nullable()->constrained('users');
            $table->foreignId('approved_by')->nullable()->constrained('users');
            $table->enum('refund_method', ['cash', 'card_refund', 'upi_refund', 'store_credit'])->default('store_credit');
            $table->string('refund_transaction_id', 100)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->index(['return_date']);
            $table->index(['sale_id']);
        });

        Schema::create('sale_return_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('return_id')->constrained('sale_returns')->cascadeOnDelete();
            $table->foreignId('sale_item_id')->constrained();
            $table->integer('quantity');
            $table->decimal('refund_price', 10, 2);
            $table->boolean('restocked')->default(false);
            $table->foreignId('restocked_branch_id')->nullable()->constrained('branches');
            $table->date('restocked_date')->nullable();
            $table->foreignId('restocked_by')->nullable()->constrained('users');
            $table->enum('damage_level', ['none', 'minor', 'major', 'severe'])->default('none');
            $table->timestamps();
            $table->index(['return_id', 'sale_item_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_returns_tables');
    }
};
