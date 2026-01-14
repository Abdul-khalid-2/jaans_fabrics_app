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
        Schema::create('shop_settings', function (Blueprint $table) {
            $table->id();
            $table->string('shop_name', 200);
            $table->string('shop_code', 50)->unique();
            $table->text('address');
            $table->string('phone', 20);
            $table->string('email', 100)->nullable();
            $table->string('website')->nullable();
            $table->string('country_code', 2)->default('IN');
            // Tax
            $table->string('tax_label', 50)->default('GST');
            $table->string('tax_id_label', 50)->default('GSTIN');
            $table->string('tax_number', 50)->nullable();
            $table->decimal('tax_rate', 5, 2)->default(18.00);
            // Invoice
            $table->string('invoice_prefix', 10)->default('INV');
            $table->integer('invoice_start_number')->default(1000);
            $table->text('invoice_footer')->nullable();
            // Receipt
            $table->string('receipt_prefix', 10)->default('RCP');
            $table->integer('receipt_start_number')->default(1000);
            $table->text('receipt_footer')->nullable();
            // Currency
            $table->string('currency_code', 3)->default('INR');
            $table->string('currency_symbol', 10)->default('₹');
            $table->enum('currency_position', ['before', 'after'])->default('before');
            // Inventory
            $table->integer('low_stock_threshold')->default(10);
            $table->boolean('negative_stock_allowed')->default(false);
            // Loyalty
            $table->boolean('loyalty_points_enabled')->default(true);
            $table->decimal('loyalty_points_ratio', 5, 2)->default(1.00);
            $table->integer('loyalty_points_expiry_months')->default(12);
            // Business Hours
            $table->json('business_hours')->nullable();
            $table->string('timezone')->default('Asia/Kolkata');
            // Appearance
            $table->string('logo_url')->nullable();
            $table->string('favicon_url')->nullable();
            $table->string('theme_color', 7)->default('#3B82F6');
            $table->timestamps();
            $table->foreign('country_code')->references('country_code')->on('countries');
            $table->index(['shop_code']);
        });

        // Insert default shop settings
        DB::table('shop_settings')->insert([
            [
                'shop_name' => 'My Clothing Store',
                'shop_code' => 'MCS001',
                'address' => '123 Fashion Street, City Center',
                'phone' => '+91-9876543210',
                'email' => 'info@myclothingstore.com',
            ]
        ]);

        Schema::create('branch_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained()->cascadeOnDelete();
            $table->string('setting_key', 100);
            $table->text('setting_value')->nullable();
            $table->enum('setting_type', ['string', 'number', 'boolean', 'json', 'array'])->default('string');
            $table->text('description')->nullable();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->unique(['branch_id', 'setting_key']);
            $table->index(['branch_id', 'setting_key']);
        });

        Schema::create('system_settings', function (Blueprint $table) {
            $table->id();
            $table->string('setting_key', 100)->unique();
            $table->text('setting_value')->nullable();
            $table->enum('setting_type', ['string', 'number', 'boolean', 'json', 'array'])->default('string');
            $table->string('category', 50)->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_public')->default(false);
            $table->boolean('is_encrypted')->default(false);
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->index(['category']);
            $table->index(['setting_key']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings_tables');
    }
};
