<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_number', 50)->unique();
            $table->date('transaction_date');
            $table->time('transaction_time');
            $table->dateTime('transaction_datetime')->storedAs('TIMESTAMP(transaction_date, transaction_time)');
            $table->foreignId('account_id')->constrained();
            $table->enum('transaction_type', ['debit', 'credit', 'journal']);
            $table->decimal('amount', 12, 2);
            $table->text('description')->nullable();
            // Reference
            $table->enum('reference_type', ['sale', 'purchase', 'expense', 'salary', 'payment', 'receipt', 'transfer', 'adjustment', 'opening_balance', 'refund', 'commission', 'advance']);
            $table->unsignedBigInteger('reference_id')->nullable();
            // Branch and User
            $table->foreignId('branch_id')->constrained();
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('approved_by')->nullable()->constrained('users');
            // Status
            $table->enum('status', ['pending', 'approved', 'rejected', 'reversed'])->default('approved');
            $table->foreignId('reversal_id')->nullable()->constrained('transactions')->nullOnDelete();
            $table->timestamps();
            $table->index(['transaction_date']);
            $table->index(['account_id', 'transaction_date']);
            $table->index(['reference_type', 'reference_id']);
            $table->index(['branch_id', 'transaction_date']);
            $table->index(['transaction_datetime']);
        });

        Schema::create('journal_entries', function (Blueprint $table) {
            $table->id();
            $table->string('journal_number', 50)->unique();
            $table->date('transaction_date');
            $table->text('description')->nullable();
            $table->decimal('total_debit', 12, 2);
            $table->decimal('total_credit', 12, 2);
            $table->foreignId('branch_id')->constrained();
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('approved_by')->nullable()->constrained('users');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->index(['transaction_date']);
            $table->index(['branch_id', 'transaction_date']);
        });

        Schema::create('journal_entry_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('journal_id')->constrained('journal_entries')->cascadeOnDelete(); // FIXED
            $table->foreignId('account_id')->constrained();
            $table->decimal('debit_amount', 12, 2)->default(0.00);
            $table->decimal('credit_amount', 12, 2)->default(0.00);
            $table->text('description')->nullable();
            $table->timestamps();
            $table->index(['journal_id', 'account_id']);
        });

        Schema::create('ledgers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('account_id')->constrained();
            $table->foreignId('transaction_id')->constrained();
            $table->foreignId('journal_id')->nullable()->constrained('journal_entries')->nullOnDelete(); // FIXED
            $table->decimal('debit_amount', 12, 2)->default(0.00);
            $table->decimal('credit_amount', 12, 2)->default(0.00);
            $table->decimal('balance', 12, 2);
            $table->date('transaction_date');
            $table->text('description')->nullable();
            $table->timestamps();
            $table->index(['account_id', 'transaction_date']);
            $table->index(['transaction_id']);
            $table->index(['transaction_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ledgers');
        Schema::dropIfExists('journal_entry_items');
        Schema::dropIfExists('journal_entries');
        Schema::dropIfExists('transactions');
    }
};
