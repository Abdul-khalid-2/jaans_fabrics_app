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
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->string('branch_code', 20)->unique();
            $table->string('branch_name', 200);
            $table->enum('branch_type', ['main', 'sub', 'warehouse', 'outlet', 'franchise'])->default('outlet');
            $table->text('address');
            $table->string('city', 100);
            $table->string('state', 100);
            $table->string('pincode', 10);
            $table->string('country_code', 2)->default('IN');
            $table->string('phone', 20);
            $table->string('email', 100)->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->date('opening_date');
            $table->date('closing_date')->nullable();
            $table->boolean('is_active')->default(true);
            $table->string('tax_id', 50)->nullable();
            $table->string('business_id', 50)->nullable();
            $table->string('bank_account', 30)->nullable();
            $table->string('bank_name', 100)->nullable();
            $table->string('ifsc_code', 20)->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->string('timezone')->default('Asia/Kolkata');
            $table->time('opening_time')->default('09:00:00');
            $table->time('closing_time')->default('21:00:00');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('country_code')->references('country_code')->on('countries');
            $table->index(['branch_code']);
            $table->index(['city', 'state']);
            $table->index(['is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
