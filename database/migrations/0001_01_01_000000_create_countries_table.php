<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('country_code', 2)->unique();
            $table->string('country_name', 100);
            $table->string('currency_code', 3);
            $table->string('currency_symbol', 10);
            $table->string('tax_label', 50);
            $table->string('tax_id_label', 50);
            $table->string('phone_code', 5)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Insert default countries
        DB::table('countries')->insert([
            [
                'country_code' => 'IN',
                'country_name' => 'India',
                'currency_code' => 'INR',
                'currency_symbol' => '₹',
                'tax_label' => 'GST',
                'tax_id_label' => 'GSTIN',
                'phone_code' => '+91'
            ],
            [
                'country_code' => 'US',
                'country_name' => 'United States',
                'currency_code' => 'USD',
                'currency_symbol' => '$',
                'tax_label' => 'Sales Tax',
                'tax_id_label' => 'EIN',
                'phone_code' => '+1'
            ],
            [
                'country_code' => 'UK',
                'country_name' => 'United Kingdom',
                'currency_code' => 'GBP',
                'currency_symbol' => '£',
                'tax_label' => 'VAT',
                'tax_id_label' => 'VAT Number',
                'phone_code' => '+44'
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
