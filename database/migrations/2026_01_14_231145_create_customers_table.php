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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('customer_code', 20)->unique();
            $table->string('full_name', 100);
            $table->string('email', 100)->unique()->nullable();
            $table->string('phone', 20)->unique();
            $table->string('alternate_phone', 20)->nullable();
            // Address
            $table->text('address_line1')->nullable();
            $table->text('address_line2')->nullable();
            $table->string('city', 100)->nullable();
            $table->string('state', 100)->nullable();
            $table->string('pincode', 10)->nullable();
            $table->string('country_code', 2)->default('IN');
            // Demographics
            $table->enum('customer_type', ['walk_in', 'regular', 'wholesale', 'corporate', 'vip'])->default('walk_in');
            $table->enum('gender', ['male', 'female', 'other', 'prefer_not_to_say'])->nullable();
            $table->date('date_of_birth')->nullable();
            $table->date('anniversary_date')->nullable();
            $table->enum('age_group', ['teen', 'young_adult', 'adult', 'senior'])->nullable();
            // Preferences
            $table->string('preferred_size', 20)->nullable();
            $table->string('preferred_color', 50)->nullable();
            $table->string('preferred_brand', 100)->nullable();
            $table->string('preferred_category', 100)->nullable();
            // Loyalty
            $table->integer('loyalty_points')->default(0);
            $table->enum('loyalty_tier', ['bronze', 'silver', 'gold', 'platinum'])->default('bronze');
            $table->integer('total_points_earned')->default(0);
            $table->integer('total_points_redeemed')->default(0);
            // Financial
            $table->decimal('total_purchases', 12, 2)->default(0.00);
            $table->integer('total_visits')->default(0);
            $table->decimal('average_transaction_value', 10, 2)->default(0.00);
            $table->decimal('credit_limit', 10, 2)->default(0.00);
            $table->decimal('current_credit', 10, 2)->default(0.00);
            $table->decimal('outstanding_balance', 10, 2)->default(0.00);
            // Communication Preferences
            $table->boolean('receive_email_offers')->default(true);
            $table->boolean('receive_sms_offers')->default(true);
            $table->boolean('receive_whatsapp_updates')->default(true);
            // Status
            $table->boolean('is_active')->default(true);
            $table->boolean('is_blacklisted')->default(false);
            $table->text('blacklist_reason')->nullable();
            $table->text('notes')->nullable();
            $table->date('last_purchase_date')->nullable();
            $table->timestamps();
            $table->foreign('country_code')->references('country_code')->on('countries');
            $table->index(['phone', 'email']);
            $table->index(['customer_type']);
            $table->index(['loyalty_tier']);
            $table->index(['last_purchase_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
