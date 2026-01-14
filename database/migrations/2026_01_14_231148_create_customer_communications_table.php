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
        Schema::create('customer_communications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->cascadeOnDelete();
            $table->enum('communication_type', ['email', 'sms', 'whatsapp', 'call', 'in_person']);
            $table->string('subject', 255)->nullable();
            $table->text('message')->nullable();
            $table->foreignId('sent_by')->nullable()->constrained('users');
            $table->timestamp('sent_at')->useCurrent();
            $table->enum('status', ['sent', 'delivered', 'read', 'failed'])->default('sent');
            $table->text('response')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->index(['customer_id', 'sent_at']);
            $table->index(['communication_type', 'sent_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_communications');
    }
};
