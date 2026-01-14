
php artisan make:migration create_countries_table
php artisan make:migration create_cache_table
php artisan make:migration create_jobs_tables
php artisan make:migration create_users_table
php artisan make:migration create_permission_tables
php artisan make:migration create_branches_table
php artisan make:migration create_categories_table
php artisan make:migration create_brands_table
php artisan make:migration create_collections_table
php artisan make:migration create_products_table
php artisan make:migration create_product_images_table
php artisan make:migration create_product_attributes_tables
php artisan make:migration create_product_variants_table
php artisan make:migration create_price_history_table
php artisan make:migration create_inventory_tables
php artisan make:migration create_stock_adjustments_tables
php artisan make:migration create_customers_table
php artisan make:migration create_customer_addresses_table
php artisan make:migration create_customer_communications_table
php artisan make:migration create_suppliers_table
php artisan make:migration create_purchases_tables
php artisan make:migration create_staff_table
php artisan make:migration create_staff_branches_table
php artisan make:migration create_attendance_table
php artisan make:migration create_salary_tables
php artisan make:migration create_accounting_tables
php artisan make:migration create_transactions_tables
php artisan make:migration create_expenses_tables
php artisan make:migration create_sales_tables
php artisan make:migration create_sale_returns_tables
php artisan make:migration create_promotions_tables
php artisan make:migration create_stock_transfers_tables
php artisan make:migration create_reports_tables
php artisan make:migration create_settings_tables
php artisan make:migration create_notifications_table
php artisan make:migration create_audit_logs_tables
php artisan make:migration create_user_branches_table













Migration Sequence and Order
1. 0001_create_countries_table.php (Foundation table)
php
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
DB::table('countries')->insert([...]);
2. 0002_create_cache_tables.php (Laravel cache tables)
php
Schema::create('cache', function (Blueprint $table) {
    $table->string('key')->primary();
    $table->mediumText('value');
    $table->integer('expiration');
});

Schema::create('cache_locks', function (Blueprint $table) {
    $table->string('key')->primary();
    $table->string('owner');
    $table->integer('expiration');
});
3. 0003_create_jobs_tables.php (Laravel queue tables)
php
Schema::create('jobs', function (Blueprint $table) {
    $table->id();
    $table->string('queue')->index();
    $table->longText('payload');
    $table->unsignedTinyInteger('attempts');
    $table->unsignedInteger('reserved_at')->nullable();
    $table->unsignedInteger('available_at');
    $table->unsignedInteger('created_at');
});

Schema::create('job_batches', function (Blueprint $table) {
    $table->string('id')->primary();
    $table->string('name');
    $table->integer('total_jobs');
    $table->integer('pending_jobs');
    $table->integer('failed_jobs');
    $table->longText('failed_job_ids');
    $table->mediumText('options')->nullable();
    $table->integer('cancelled_at')->nullable();
    $table->integer('created_at');
    $table->integer('finished_at')->nullable();
});

Schema::create('failed_jobs', function (Blueprint $table) {
    $table->id();
    $table->string('uuid')->unique();
    $table->text('connection');
    $table->text('queue');
    $table->longText('payload');
    $table->longText('exception');
    $table->timestamp('failed_at')->useCurrent();
});
4. 0004_create_users_table.php (Users and authentication)
php
Schema::create('users', function (Blueprint $table) {
    $table->id();
    $table->string('username', 50)->unique();
    $table->string('email', 100)->unique();
    $table->timestamp('email_verified_at')->nullable();
    $table->string('password');
    $table->string('full_name', 100);
    $table->string('phone', 20)->unique()->nullable();
    $table->string('profile_image')->nullable();
    $table->boolean('is_active')->default(true);
    $table->timestamp('last_login')->nullable();
    $table->integer('login_count')->default(0);
    $table->integer('failed_login_attempts')->default(0);
    $table->timestamp('last_password_change')->nullable();
    $table->boolean('must_change_password')->default(false);
    $table->boolean('two_factor_enabled')->default(false);
    $table->string('two_factor_secret')->nullable();
    $table->rememberToken();
    $table->timestamps();
    $table->softDeletes();
    $table->index(['is_active']);
    $table->index(['email']);
    $table->index(['phone']);
});

Schema::create('password_reset_tokens', function (Blueprint $table) {
    $table->string('email')->primary();
    $table->string('token');
    $table->timestamp('created_at')->nullable();
});

Schema::create('sessions', function (Blueprint $table) {
    $table->string('id')->primary();
    $table->foreignId('user_id')->nullable()->index();
    $table->string('ip_address', 45)->nullable();
    $table->text('user_agent')->nullable();
    $table->longText('payload');
    $table->integer('last_activity')->index();
});
5. 0005_create_permission_tables.php (Spatie permissions)
php
// Full Spatie permission tables as provided
6. 0006_create_branches_table.php (Branches with country reference)
php
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
7. 0007_create_categories_table.php (Product categories)
php
Schema::create('categories', function (Blueprint $table) {
    $table->id();
    $table->string('category_code', 20)->unique();
    $table->string('category_name', 100);
    $table->foreignId('parent_id')->nullable()->constrained('categories')->nullOnDelete();
    $table->text('description')->nullable();
    $table->string('image_url')->nullable();
    $table->integer('display_order')->default(0);
    $table->boolean('is_active')->default(true);
    $table->foreignId('created_by')->nullable()->constrained('users');
    $table->timestamps();
    $table->index(['parent_id', 'is_active']);
});
8. 0008_create_brands_table.php (Brands with country reference)
php
Schema::create('brands', function (Blueprint $table) {
    $table->id();
    $table->string('brand_code', 20)->unique();
    $table->string('brand_name', 100);
    $table->text('description')->nullable();
    $table->string('logo_url')->nullable();
    $table->string('website')->nullable();
    $table->string('contact_email', 100)->nullable();
    $table->string('contact_phone', 20)->nullable();
    $table->string('country_of_origin', 2)->nullable();
    $table->boolean('is_active')->default(true);
    $table->timestamps();
    $table->foreign('country_of_origin')->references('country_code')->on('countries');
    $table->unique(['brand_name']);
});
9. 0009_create_collections_table.php (Product collections)
php
Schema::create('collections', function (Blueprint $table) {
    $table->id();
    $table->string('collection_code', 20)->unique();
    $table->string('collection_name', 100);
    $table->enum('season', ['spring', 'summer', 'autumn', 'winter', 'all_season'])->default('all_season');
    $table->year('year');
    $table->text('description')->nullable();
    $table->date('launch_date')->nullable();
    $table->date('end_date')->nullable();
    $table->boolean('is_active')->default(true);
    $table->timestamps();
    $table->index(['season', 'year']);
});
10. 0010_create_products_table.php (Products and variants)
php
Schema::create('products', function (Blueprint $table) {
    $table->id();
    $table->string('product_code', 50)->unique();
    $table->string('sku', 50)->unique();
    $table->string('product_name', 200);
    $table->text('short_description')->nullable();
    $table->longText('long_description')->nullable();
    $table->foreignId('category_id')->constrained();
    $table->foreignId('brand_id')->nullable()->constrained()->nullOnDelete();
    $table->foreignId('collection_id')->nullable()->constrained()->nullOnDelete();
    $table->enum('gender', ['male', 'female', 'unisex', 'kids', 'infants'])->default('unisex');
    $table->enum('age_group', ['infant', 'kids', 'teens', 'adults', 'all'])->default('adults');
    $table->enum('seasonality', ['winter', 'summer', 'all_season', 'festive'])->default('all_season');
    // Pricing
    $table->decimal('cost_price', 10, 2);
    $table->decimal('mrp_price', 10, 2);
    $table->decimal('sale_price', 10, 2)->nullable();
    $table->decimal('wholesale_price', 10, 2)->nullable();
    // Dimensions and Weight
    $table->decimal('weight_kg', 6, 3)->nullable();
    $table->decimal('length_cm', 6, 2)->nullable();
    $table->decimal('width_cm', 6, 2)->nullable();
    $table->decimal('height_cm', 6, 2)->nullable();
    // Care Instructions
    $table->text('care_instructions')->nullable();
    $table->string('fabric_composition', 255)->nullable();
    $table->string('origin_country', 2)->nullable();
    // Inventory
    $table->boolean('has_variants')->default(false);
    $table->integer('reorder_level')->default(10);
    $table->integer('reorder_quantity')->default(50);
    // Tax
    $table->decimal('tax_rate', 5, 2)->default(0.00);
    $table->string('hsn_code', 10)->nullable();
    // Status
    $table->boolean('is_featured')->default(false);
    $table->boolean('is_new_arrival')->default(true);
    $table->boolean('is_bestseller')->default(false);
    $table->boolean('is_active')->default(true);
    // Metadata
    $table->string('barcode', 100)->unique()->nullable();
    $table->text('search_keywords')->nullable();
    $table->decimal('rating', 3, 2)->default(0.00);
    $table->integer('total_ratings')->default(0);
    $table->timestamps();
    $table->softDeletes();
    $table->foreign('origin_country')->references('country_code')->on('countries');
    $table->index(['category_id', 'brand_id']);
    $table->index(['gender', 'seasonality']);
    $table->index(['mrp_price', 'sale_price']);
    $table->index(['is_active', 'is_featured', 'is_new_arrival']);
});
11. 0011_create_product_images_table.php (Product images)
php
Schema::create('product_images', function (Blueprint $table) {
    $table->id();
    $table->foreignId('product_id')->constrained()->cascadeOnDelete();
    $table->string('image_url');
    $table->string('thumbnail_url')->nullable();
    $table->string('alt_text', 255)->nullable();
    $table->integer('display_order')->default(0);
    $table->boolean('is_primary')->default(false);
    $table->timestamps();
    $table->index(['product_id', 'display_order']);
});
12. 0012_create_product_attributes_tables.php (Attributes system)
php
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
    $table->unique(['product_id', 'attribute_id', 'attribute_value_id']);
});
13. 0013_create_product_variants_table.php (Product variants)
php
Schema::create('product_variants', function (Blueprint $table) {
    $table->id();
    $table->string('variant_code', 100)->unique();
    $table->string('variant_sku', 100)->unique();
    $table->foreignId('product_id')->constrained()->cascadeOnDelete();
    $table->string('size', 20)->nullable();
    $table->string('color', 50)->nullable();
    $table->string('material', 50)->nullable();
    $table->string('fit', 30)->nullable();
    $table->decimal('additional_price', 10, 2)->default(0.00);
    $table->decimal('weight_variance', 5, 3)->default(0.000);
    $table->string('image_url')->nullable();
    $table->string('barcode', 100)->unique()->nullable();
    $table->boolean('is_default')->default(false);
    $table->boolean('is_active')->default(true);
    $table->timestamps();
    $table->index(['product_id', 'variant_code']);
    $table->index(['size', 'color']);
    $table->index(['variant_sku']);
});

Schema::create('variant_attributes', function (Blueprint $table) {
    $table->id();
    $table->foreignId('variant_id')->constrained('product_variants')->cascadeOnDelete();
    $table->foreignId('attribute_id')->constrained('product_attributes');
    $table->foreignId('attribute_value_id')->constrained('attribute_values');
    $table->timestamps();
    $table->unique(['variant_id', 'attribute_id']);
});
14. 0014_create_price_history_table.php (Price tracking)
php
Schema::create('price_history', function (Blueprint $table) {
    $table->id();
    $table->foreignId('product_id')->constrained()->cascadeOnDelete();
    $table->foreignId('variant_id')->nullable()->constrained('product_variants')->cascadeOnDelete();
    $table->decimal('cost_price', 10, 2);
    $table->decimal('selling_price', 10, 2);
    $table->decimal('mrp_price', 10, 2);
    $table->date('effective_date');
    $table->foreignId('changed_by')->nullable()->constrained('users');
    $table->string('reason', 255)->nullable();
    $table->timestamps();
    $table->index(['product_id', 'effective_date']);
});
15. 0015_create_inventory_tables.php (Inventory management)
php
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
16. 0016_create_stock_adjustments_tables.php (Stock adjustments)
php
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
17. 0017_create_customers_table.php (Customers)
php
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
18. 0018_create_customer_addresses_table.php (Customer addresses)
php
Schema::create('customer_addresses', function (Blueprint $table) {
    $table->id();
    $table->foreignId('customer_id')->constrained()->cascadeOnDelete();
    $table->enum('address_type', ['home', 'work', 'billing', 'shipping', 'other'])->default('home');
    $table->text('address_line1');
    $table->text('address_line2')->nullable();
    $table->string('city', 100);
    $table->string('state', 100);
    $table->string('pincode', 10);
    $table->string('country_code', 2)->default('IN');
    $table->boolean('is_default')->default(false);
    $table->timestamps();
    $table->foreign('country_code')->references('country_code')->on('countries');
    $table->index(['customer_id', 'address_type']);
});
19. 0019_create_customer_communications_table.php (Customer communications)
php
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
20. 0020_create_suppliers_table.php (Suppliers)
php
Schema::create('suppliers', function (Blueprint $table) {
    $table->id();
    $table->string('supplier_code', 20)->unique();
    $table->string('company_name', 200);
    $table->string('contact_person', 100)->nullable();
    $table->string('email', 100)->nullable();
    $table->string('phone', 20);
    $table->string('alternate_phone', 20)->nullable();
    // Address
    $table->text('address')->nullable();
    $table->string('city', 100)->nullable();
    $table->string('state', 100)->nullable();
    $table->string('pincode', 10)->nullable();
    $table->string('country_code', 2)->default('IN');
    // Business Info
    $table->string('tax_id', 50)->nullable();
    $table->string('business_id', 50)->nullable();
    $table->string('website')->nullable();
    // Bank Details
    $table->string('account_number', 30)->nullable();
    $table->string('account_holder', 100)->nullable();
    $table->string('bank_name', 100)->nullable();
    $table->string('branch_name', 100)->nullable();
    $table->string('ifsc_code', 20)->nullable();
    // Financial
    $table->decimal('credit_limit', 12, 2)->default(0.00);
    $table->decimal('current_balance', 12, 2)->default(0.00);
    $table->decimal('total_purchases', 12, 2)->default(0.00);
    $table->decimal('outstanding_amount', 12, 2)->default(0.00);
    $table->string('payment_terms', 100)->nullable();
    $table->integer('payment_days')->default(30);
    // Classification
    $table->enum('supplier_type', ['manufacturer', 'wholesaler', 'distributor', 'importer', 'local_vendor'])->default('wholesaler');
    $table->decimal('rating', 3, 2)->default(0.00);
    // Status
    $table->boolean('is_active')->default(true);
    $table->boolean('is_blacklisted')->default(false);
    $table->text('blacklist_reason')->nullable();
    $table->text('notes')->nullable();
    $table->date('last_purchase_date')->nullable();
    $table->timestamps();
    $table->foreign('country_code')->references('country_code')->on('countries');
    $table->index(['company_name']);
    $table->index(['supplier_code']);
    $table->index(['is_active', 'supplier_type']);
});

Schema::create('supplier_branches', function (Blueprint $table) {
    $table->foreignId('supplier_id')->constrained()->cascadeOnDelete();
    $table->foreignId('branch_id')->constrained()->cascadeOnDelete();
    $table->boolean('is_primary')->default(false);
    $table->integer('delivery_days')->default(7);
    $table->decimal('minimum_order_value', 10, 2)->default(0.00);
    $table->timestamp('assigned_at')->useCurrent();
    $table->primary(['supplier_id', 'branch_id']);
    $table->index(['branch_id', 'supplier_id']);
});
21. 0021_create_purchases_tables.php (Purchase orders)
php
Schema::create('purchases', function (Blueprint $table) {
    $table->id();
    $table->string('purchase_number', 50)->unique();
    $table->foreignId('supplier_id')->constrained();
    $table->foreignId('branch_id')->constrained();
    // Dates
    $table->date('order_date');
    $table->date('expected_delivery_date')->nullable();
    $table->date('actual_delivery_date')->nullable();
    // Totals
    $table->integer('total_items');
    $table->decimal('subtotal', 12, 2);
    $table->decimal('tax_amount', 10, 2)->default(0.00);
    $table->decimal('shipping_charge', 10, 2)->default(0.00);
    $table->decimal('other_charges', 10, 2)->default(0.00);
    $table->decimal('round_off', 5, 2)->default(0.00);
    $table->decimal('grand_total', 12, 2);
    // Payment
    $table->decimal('amount_paid', 12, 2)->default(0.00);
    $table->decimal('balance_due', 12, 2)->default(0.00);
    $table->enum('payment_status', ['paid', 'partial', 'pending', 'overdue'])->default('pending');
    $table->enum('purchase_status', ['ordered', 'received', 'partially_received', 'cancelled', 'returned'])->default('ordered');
    // Personnel
    $table->foreignId('ordered_by')->constrained('users');
    $table->foreignId('received_by')->nullable()->constrained('users');
    $table->foreignId('approved_by')->nullable()->constrained('users');
    // Shipping
    $table->string('shipping_method', 50)->nullable();
    $table->string('tracking_number', 100)->nullable();
    $table->string('carrier_name', 100)->nullable();
    $table->text('notes')->nullable();
    $table->timestamps();
    $table->index(['order_date']);
    $table->index(['supplier_id', 'order_date']);
    $table->index(['purchase_status', 'payment_status']);
    $table->index(['branch_id', 'supplier_id']);
});

Schema::create('purchase_items', function (Blueprint $table) {
    $table->id();
    $table->foreignId('purchase_id')->constrained()->cascadeOnDelete();
    $table->foreignId('product_id')->constrained();
    $table->foreignId('variant_id')->nullable()->constrained('product_variants');
    // Quantities
    $table->integer('quantity_ordered');
    $table->integer('quantity_received')->default(0);
    $table->integer('quantity_rejected')->default(0);
    // Pricing
    $table->decimal('unit_cost', 10, 2);
    $table->decimal('total_cost', 10, 2);
    $table->decimal('discount_percentage', 5, 2)->default(0.00);
    $table->decimal('discount_amount', 10, 2)->default(0.00);
    $table->decimal('tax_percentage', 5, 2)->default(0.00);
    $table->decimal('tax_amount', 10, 2)->default(0.00);
    // Product Info
    $table->date('expiry_date')->nullable();
    $table->string('batch_number', 50)->nullable();
    $table->date('manufacturing_date')->nullable();
    // Status
    $table->enum('received_condition', ['good', 'damaged', 'expired'])->default('good');
    $table->text('rejection_reason')->nullable();
    $table->text('notes')->nullable();
    $table->timestamps();
    $table->index(['purchase_id', 'product_id']);
    $table->index(['batch_number', 'expiry_date']);
});

Schema::create('supplier_payments', function (Blueprint $table) {
    $table->id();
    $table->foreignId('supplier_id')->constrained();
    $table->foreignId('purchase_id')->nullable()->constrained()->nullOnDelete();
    $table->date('payment_date');
    $table->enum('payment_method', ['cash', 'cheque', 'bank_transfer', 'upi', 'credit_card', 'dd']);
    $table->decimal('amount', 12, 2);
    $table->string('reference_number', 100)->nullable();
    $table->string('transaction_id', 100)->nullable();
    $table->text('payment_for')->nullable();
    $table->enum('payment_status', ['completed', 'pending', 'failed', 'cancelled'])->default('completed');
    $table->text('notes')->nullable();
    $table->foreignId('paid_by')->constrained('users');
    $table->foreignId('approved_by')->nullable()->constrained('users');
    $table->timestamps();
    $table->index(['supplier_id', 'payment_date']);
    $table->index(['payment_date']);
    $table->index(['reference_number']);
});
22. 0022_create_staff_table.php (Staff management)
php
Schema::create('staff', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();
    $table->string('employee_code', 20)->unique();
    $table->string('designation', 100);
    $table->enum('department', ['sales', 'inventory', 'accounts', 'management', 'purchasing', 'hr', 'marketing', 'other'])->default('sales');
    // Personal Info
    $table->date('date_of_joining');
    $table->date('date_of_birth')->nullable();
    $table->enum('gender', ['male', 'female', 'other'])->nullable();
    $table->enum('marital_status', ['single', 'married', 'divorced', 'widowed'])->default('single');
    // Emergency Contact
    $table->string('emergency_contact', 20)->nullable();
    $table->string('emergency_contact_name', 100)->nullable();
    $table->string('emergency_contact_relation', 50)->nullable();
    // Bank Details
    $table->string('bank_account_number', 30)->nullable();
    $table->string('bank_name', 100)->nullable();
    $table->string('branch_name', 100)->nullable();
    $table->string('ifsc_code', 20)->nullable();
    // Government IDs
    $table->string('aadhar_number', 20)->nullable();
    $table->string('pan_number', 20)->nullable();
    $table->string('passport_number', 20)->nullable();
    // Salary
    $table->decimal('basic_salary', 10, 2);
    $table->decimal('allowances', 10, 2)->default(0.00);
    $table->decimal('deductions', 10, 2)->default(0.00);
    $table->decimal('net_salary', 10, 2);
    // Employment
    $table->enum('employment_type', ['permanent', 'contract', 'temporary', 'intern', 'probation'])->default('permanent');
    $table->enum('employment_status', ['active', 'inactive', 'terminated', 'resigned'])->default('active');
    $table->date('termination_date')->nullable();
    $table->text('termination_reason')->nullable();
    // Performance
    $table->decimal('sales_target', 12, 2)->default(0.00);
    $table->decimal('current_month_sales', 12, 2)->default(0.00);
    $table->decimal('total_sales', 12, 2)->default(0.00);
    $table->decimal('commission_rate', 5, 2)->default(0.00);
    $table->boolean('is_active')->default(true);
    $table->text('notes')->nullable();
    $table->timestamps();
    $table->index(['employee_code']);
    $table->index(['department']);
    $table->index(['employment_status']);
    $table->index(['is_active']);
});
23. 0023_create_staff_branches_table.php (Staff branch assignments)
php
Schema::create('staff_branches', function (Blueprint $table) {
    $table->id();
    $table->foreignId('staff_id')->constrained()->cascadeOnDelete();
    $table->foreignId('branch_id')->constrained()->cascadeOnDelete();
    $table->boolean('is_primary')->default(false);
    $table->json('working_hours')->nullable();
    $table->string('weekly_off', 50)->nullable();
    $table->timestamp('assigned_at')->useCurrent();
    $table->foreignId('assigned_by')->nullable()->constrained('users')->nullOnDelete();
    $table->unique(['staff_id', 'branch_id']);
    $table->index(['branch_id', 'staff_id']);
});
24. 0024_create_attendance_table.php (Staff attendance)
php
Schema::create('attendance', function (Blueprint $table) {
    $table->id();
    $table->foreignId('staff_id')->constrained()->cascadeOnDelete();
    $table->foreignId('branch_id')->constrained();
    $table->date('attendance_date');
    $table->time('shift_start')->nullable();
    $table->time('shift_end')->nullable();
    $table->time('check_in_time')->nullable();
    $table->time('check_out_time')->nullable();
    $table->decimal('total_hours', 5, 2)->nullable();
    $table->decimal('overtime_hours', 5, 2)->default(0.00);
    $table->enum('status', ['present', 'absent', 'half_day', 'leave', 'holiday', 'week_off'])->default('absent');
    $table->enum('leave_type', ['sick', 'casual', 'paid', 'unpaid', 'maternity', 'paternity', 'emergency'])->nullable();
    $table->text('notes')->nullable();
    $table->foreignId('recorded_by')->nullable()->constrained('users');
    $table->foreignId('approved_by')->nullable()->constrained('users');
    $table->timestamps();
    $table->unique(['staff_id', 'attendance_date']);
    $table->index(['attendance_date']);
    $table->index(['staff_id', 'attendance_date']);
    $table->index(['branch_id', 'attendance_date']);
});

Schema::create('leave_requests', function (Blueprint $table) {
    $table->id();
    $table->foreignId('staff_id')->constrained()->cascadeOnDelete();
    $table->enum('leave_type', ['sick', 'casual', 'paid', 'unpaid', 'maternity', 'paternity', 'emergency']);
    $table->date('start_date');
    $table->date('end_date');
    $table->integer('total_days');
    $table->text('reason')->nullable();
    $table->enum('status', ['pending', 'approved', 'rejected', 'cancelled'])->default('pending');
    $table->foreignId('approved_by')->nullable()->constrained('users');
    $table->timestamp('approved_at')->nullable();
    $table->text('notes')->nullable();
    $table->timestamps();
    $table->index(['staff_id', 'start_date']);
    $table->index(['status', 'start_date']);
});
25. 0025_create_salary_tables.php (Salary management)
php
Schema::create('salary_payments', function (Blueprint $table) {
    $table->id();
    $table->foreignId('staff_id')->constrained();
    $table->date('payment_date');
    $table->date('salary_month');
    // Earnings
    $table->decimal('basic_salary', 10, 2);
    $table->decimal('allowances', 10, 2)->default(0.00);
    $table->decimal('overtime_amount', 10, 2)->default(0.00);
    $table->decimal('commission_amount', 10, 2)->default(0.00);
    $table->decimal('bonus', 10, 2)->default(0.00);
    $table->decimal('incentives', 10, 2)->default(0.00);
    $table->decimal('total_earnings', 10, 2);
    // Deductions
    $table->decimal('deductions', 10, 2)->default(0.00);
    $table->decimal('advance_deduction', 10, 2)->default(0.00);
    $table->decimal('tax_deduction', 10, 2)->default(0.00);
    $table->decimal('other_deductions', 10, 2)->default(0.00);
    $table->decimal('total_deductions', 10, 2);
    // Net
    $table->decimal('net_amount', 10, 2);
    // Payment Details
    $table->enum('payment_method', ['cash', 'bank_transfer', 'cheque', 'upi'])->default('bank_transfer');
    $table->string('payment_reference', 100)->nullable();
    $table->string('transaction_id', 100)->nullable();
    $table->string('bank_name', 100)->nullable();
    $table->string('account_number', 30)->nullable();
    $table->text('notes')->nullable();
    $table->foreignId('paid_by')->nullable()->constrained('users');
    $table->foreignId('approved_by')->nullable()->constrained('users');
    $table->timestamps();
    $table->index(['salary_month']);
    $table->index(['staff_id', 'salary_month']);
    $table->unique(['staff_id', 'salary_month']);
});

Schema::create('salary_advances', function (Blueprint $table) {
    $table->id();
    $table->foreignId('staff_id')->constrained();
    $table->decimal('advance_amount', 10, 2);
    $table->date('request_date');
    $table->text('reason')->nullable();
    $table->enum('status', ['pending', 'approved', 'rejected', 'paid'])->default('pending');
    $table->foreignId('approved_by')->nullable()->constrained('users');
    $table->date('approved_date')->nullable();
    $table->integer('repayment_months')->default(3);
    $table->decimal('monthly_deduction', 10, 2)->nullable();
    $table->decimal('total_deducted', 10, 2)->default(0.00);
    $table->decimal('balance_amount', 10, 2);
    $table->timestamps();
    $table->index(['staff_id', 'status']);
    $table->index(['status', 'request_date']);
});

Schema::create('commissions', function (Blueprint $table) {
    $table->id();
    $table->foreignId('staff_id')->constrained();
    $table->foreignId('sale_id')->constrained();
    $table->date('commission_date');
    $table->decimal('sale_amount', 12, 2);
    $table->decimal('commission_rate', 5, 2);
    $table->decimal('commission_amount', 10, 2);
    $table->boolean('paid')->default(false);
    $table->date('payment_date')->nullable();
    $table->foreignId('payment_id')->nullable()->constrained('salary_payments')->nullOnDelete();
    $table->text('notes')->nullable();
    $table->timestamps();
    $table->index(['staff_id', 'commission_date']);
    $table->index(['paid', 'commission_date']);
});
26. 0026_create_accounting_tables.php (Accounting system)
php
Schema::create('account_types', function (Blueprint $table) {
    $table->id();
    $table->string('type_code', 20)->unique();
    $table->string('type_name', 50);
    $table->enum('category', ['asset', 'liability', 'equity', 'revenue', 'expense', 'cost_of_sales']);
    $table->text('description')->nullable();
    $table->boolean('is_active')->default(true);
    $table->timestamps();
    $table->unique(['type_name']);
});

// Insert default account types
DB::table('account_types')->insert([
            ['type_code' => 'CASH', 'type_name' => 'Cash', 'category' => 'asset', 'description' => 'Physical cash on hand'],
            ['type_code' => 'BANK', 'type_name' => 'Bank Accounts', 'category' => 'asset', 'description' => 'Bank account balances'],
            ['type_code' => 'AR', 'type_name' => 'Accounts Receivable', 'category' => 'asset', 'description' => 'Money owed by customers'],
            ['type_code' => 'INVENTORY', 'type_name' => 'Inventory', 'category' => 'asset', 'description' => 'Value of goods in stock'],
            ['type_code' => 'AP', 'type_name' => 'Accounts Payable', 'category' => 'liability', 'description' => 'Money owed to suppliers'],
            ['type_code' => 'LOANS', 'type_name' => 'Loans Payable', 'category' => 'liability', 'description' => 'Outstanding loans'],
            ['type_code' => 'EQUITY', 'type_name' => 'Owner\'s Equity', 'category' => 'equity', 'description' => 'Owner\'s investment'],
            ['type_code' => 'RETAINED', 'type_name' => 'Retained Earnings', 'category' => 'equity', 'description' => 'Accumulated profits'],
            ['type_code' => 'SALES', 'type_name' => 'Sales Revenue', 'category' => 'revenue', 'description' => 'Revenue from sales'],
            ['type_code' => 'PURCHASES', 'type_name' => 'Cost of Goods Sold', 'category' => 'cost_of_sales', 'description' => 'Cost of inventory sold'],
            ['type_code' => 'SALARY', 'type_name' => 'Salaries Expense', 'category' => 'expense', 'description' => 'Employee salaries'],
            ['type_code' => 'RENT', 'type_name' => 'Rent Expense', 'category' => 'expense', 'description' => 'Shop rent'],
            ['type_code' => 'UTILITIES', 'type_name' => 'Utilities Expense', 'category' => 'expense', 'description' => 'Electricity, water, etc.'],
        ]);

Schema::create('accounts', function (Blueprint $table) {
    $table->id();
    $table->string('account_code', 20)->unique();
    $table->string('account_name', 100);
    $table->foreignId('account_type_id')->constrained();
    $table->foreignId('parent_account_id')->nullable()->constrained('accounts')->nullOnDelete();
    // Balances
    $table->decimal('opening_balance', 12, 2)->default(0.00);
    $table->enum('opening_balance_type', ['debit', 'credit'])->default('debit');
    $table->decimal('current_balance', 12, 2)->default(0.00);
    // Settings
    $table->foreignId('branch_id')->nullable()->constrained()->nullOnDelete();
    $table->boolean('is_cash_account')->default(false);
    $table->boolean('is_bank_account')->default(false);
    $table->boolean('is_system_account')->default(false);
    $table->boolean('is_active')->default(true);
    // Bank Details (if applicable)
    $table->string('bank_name', 100)->nullable();
    $table->string('account_number', 30)->nullable();
    $table->string('ifsc_code', 20)->nullable();
    $table->string('branch_name', 100)->nullable();
    $table->text('description')->nullable();
    $table->timestamps();
    $table->index(['account_type_id']);
    $table->index(['branch_id', 'is_active']);
    $table->index(['parent_account_id']);
});
27. 0027_create_transactions_tables.php (Transactions and journals)
php

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


28. 0028_create_expenses_tables.php (Expense management)
php
Schema::create('expense_categories', function (Blueprint $table) {
    $table->id();
    $table->string('category_code', 20)->unique();
    $table->string('category_name', 100);
    $table->foreignId('parent_id')->nullable()->constrained('expense_categories')->nullOnDelete();
    $table->text('description')->nullable();
    $table->foreignId('account_id')->nullable()->constrained('accounts')->nullOnDelete();
    $table->boolean('is_active')->default(true);
    $table->timestamps();
    $table->index(['parent_id']);
    $table->unique(['category_name']);
});

// Insert default expense categories
DB::table('expense_categories')->insert([
            ['category_code' => 'RENT', 'category_name' => 'Rent', 'description' => 'Shop/Office rent'],
            ['category_code' => 'SALARY', 'category_name' => 'Salaries', 'description' => 'Staff salaries'],
            ['category_code' => 'ELECTRICITY', 'category_name' => 'Electricity', 'description' => 'Electricity bills'],
            ['category_code' => 'WATER', 'category_name' => 'Water', 'description' => 'Water bills'],
            ['category_code' => 'INTERNET', 'category_name' => 'Internet', 'description' => 'Internet and phone bills'],
            ['category_code' => 'MAINTENANCE', 'category_name' => 'Maintenance', 'description' => 'Shop maintenance'],
            ['category_code' => 'MARKETING', 'category_name' => 'Marketing', 'description' => 'Advertising and promotions'],
            ['category_code' => 'TRANSPORT', 'category_name' => 'Transport', 'description' => 'Delivery and transportation'],
            ['category_code' => 'STATIONERY', 'category_name' => 'Stationery', 'description' => 'Office supplies'],
            ['category_code' => 'OTHER', 'category_name' => 'Other Expenses', 'description' => 'Miscellaneous expenses'],
        ]);

Schema::create('expenses', function (Blueprint $table) {
    $table->id();
    $table->string('expense_number', 50)->unique();
    $table->date('expense_date');
    $table->foreignId('category_id')->constrained();
    $table->foreignId('branch_id')->constrained();
    // Amount
    $table->decimal('amount', 10, 2);
    $table->decimal('tax_amount', 10, 2)->default(0.00);
    $table->decimal('total_amount', 10, 2);
    // Payment
    $table->enum('payment_method', ['cash', 'card', 'bank_transfer', 'upi', 'cheque'])->default('cash');
    $table->string('payment_reference', 100)->nullable();
    $table->string('paid_to', 200)->nullable();
    // Description
    $table->text('description')->nullable();
    $table->string('receipt_image')->nullable();
    $table->json('supporting_documents')->nullable();
    // Approval
    $table->foreignId('approved_by')->nullable()->constrained('users');
    $table->foreignId('recorded_by')->constrained('users');
    // Recurring
    $table->boolean('is_recurring')->default(false);
    $table->enum('recurring_frequency', ['daily', 'weekly', 'monthly', 'quarterly', 'yearly'])->nullable();
    $table->date('recurring_end_date')->nullable();
    $table->timestamps();
    $table->index(['expense_date']);
    $table->index(['category_id', 'expense_date']);
    $table->index(['branch_id', 'expense_date']);
});
29. 0029_create_sales_tables.php (Sales system)
php
Schema::create('sales', function (Blueprint $table) {
    $table->id();
    $table->string('invoice_number', 50)->unique();
    $table->foreignId('branch_id')->constrained();
    // Dates and Times
    $table->date('sale_date');
    $table->time('sale_time');
    $table->dateTime('sale_datetime')->storedAs('TIMESTAMP(sale_date, sale_time)');
    // Customer Info
    $table->foreignId('customer_id')->nullable()->constrained()->nullOnDelete();
    $table->string('customer_name', 100)->nullable();
    $table->string('customer_phone', 20)->nullable();
    $table->string('customer_email', 100)->nullable();
    $table->text('customer_address')->nullable();
    // Totals
    $table->integer('total_items');
    $table->decimal('subtotal', 12, 2);
    $table->decimal('discount_amount', 10, 2)->default(0.00);
    $table->decimal('discount_percentage', 5, 2)->default(0.00);
    $table->decimal('tax_amount', 10, 2)->default(0.00);
    $table->decimal('shipping_charge', 10, 2)->default(0.00);
    $table->decimal('handling_charge', 10, 2)->default(0.00);
    $table->decimal('rounding_adjustment', 5, 2)->default(0.00);
    $table->decimal('grand_total', 12, 2);
    // Payment
    $table->decimal('amount_paid', 12, 2);
    $table->decimal('balance_due', 10, 2)->default(0.00);
    $table->enum('payment_status', ['paid', 'partial', 'pending', 'refunded', 'cancelled'])->default('pending');
    $table->enum('sale_status', ['completed', 'pending', 'cancelled', 'returned', 'on_hold'])->default('pending');
    // Promotions
    $table->string('coupon_code', 50)->nullable();
    $table->decimal('coupon_discount', 10, 2)->default(0.00);
    $table->integer('loyalty_points_used')->default(0);
    $table->integer('loyalty_points_earned')->default(0);
    // Staff
    $table->foreignId('sales_person_id')->nullable()->constrained('users')->nullOnDelete();
    $table->foreignId('cashier_id')->nullable()->constrained('users')->nullOnDelete();
    // Delivery
    $table->enum('delivery_type', ['pickup', 'home_delivery', 'express'])->default('pickup');
    $table->text('delivery_address')->nullable();
    $table->date('delivery_date')->nullable();
    $table->time('delivery_time')->nullable();
    $table->text('notes')->nullable();
    $table->timestamps();
    $table->index(['sale_date']);
    $table->index(['branch_id', 'sale_date']);
    $table->index(['customer_id']);
    $table->index(['invoice_number']);
    $table->index(['payment_status', 'sale_status']);
    $table->index(['sale_datetime']);
});

Schema::create('sale_items', function (Blueprint $table) {
    $table->id();
    $table->foreignId('sale_id')->constrained()->cascadeOnDelete();
    $table->foreignId('product_id')->constrained();
    $table->foreignId('variant_id')->nullable()->constrained('product_variants');
    // Product Info
    $table->string('product_code', 50);
    $table->string('product_name', 200);
    $table->string('size', 20)->nullable();
    $table->string('color', 50)->nullable();
    $table->string('material', 50)->nullable();
    // Pricing
    $table->integer('quantity');
    $table->decimal('unit_price', 10, 2);
    $table->decimal('cost_price', 10, 2);
    $table->decimal('discount_percentage', 5, 2)->default(0.00);
    $table->decimal('discount_amount', 10, 2)->default(0.00);
    $table->decimal('tax_percentage', 5, 2)->default(0.00);
    $table->decimal('tax_amount', 10, 2)->default(0.00);
    $table->decimal('total_price', 10, 2);
    // Returns
    $table->integer('returned_quantity')->default(0);
    $table->string('return_reason', 100)->nullable();
    $table->text('notes')->nullable();
    $table->timestamps();
    $table->index(['sale_id', 'product_id']);
    $table->index(['product_id', 'sale_id']);
});

Schema::create('sale_payments', function (Blueprint $table) {
    $table->id();
    $table->foreignId('sale_id')->constrained()->cascadeOnDelete();
    $table->enum('payment_method', ['cash', 'card', 'upi', 'bank_transfer', 'credit', 'wallet', 'cheque', 'emi']);
    $table->string('payment_method_detail', 100)->nullable();
    $table->decimal('amount', 10, 2);
    $table->string('reference_number', 100)->nullable();
    $table->string('transaction_id', 100)->nullable();
    $table->date('payment_date');
    $table->time('payment_time');
    $table->enum('payment_status', ['success', 'failed', 'pending', 'refunded'])->default('success');
    $table->string('card_type', 20)->nullable();
    $table->string('card_last_four', 4)->nullable();
    $table->string('upi_id', 50)->nullable();
    $table->string('bank_name', 100)->nullable();
    $table->foreignId('collected_by')->constrained('users');
    $table->foreignId('verified_by')->nullable()->constrained('users');
    $table->text('notes')->nullable();
    $table->timestamps();
    $table->index(['sale_id', 'payment_method']);
    $table->index(['payment_date']);
    $table->index(['reference_number']);
});
30. 0030_create_sale_returns_tables.php (Sale returns)
php
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
31. 0031_create_promotions_tables.php (Promotions and coupons)
php
Schema::create('promotions', function (Blueprint $table) {
    $table->id();
    $table->string('promotion_code', 50)->unique();
    $table->string('promotion_name', 100);
    $table->enum('promotion_type', ['percentage', 'fixed', 'bogo', 'shipping', 'loyalty']);
    $table->decimal('discount_value', 10, 2);
    $table->decimal('minimum_purchase', 10, 2)->default(0.00);
    $table->decimal('maximum_discount', 10, 2)->nullable();
    $table->json('applicable_categories')->nullable();
    $table->json('excluded_categories')->nullable();
    $table->json('applicable_brands')->nullable();
    $table->json('excluded_brands')->nullable();
    $table->json('applicable_products')->nullable();
    $table->json('excluded_products')->nullable();
    $table->enum('customer_type', ['all', 'new', 'existing', 'vip'])->default('all');
    $table->date('start_date');
    $table->date('end_date');
    $table->integer('usage_limit')->nullable();
    $table->integer('per_customer_limit')->default(1);
    $table->boolean('is_active')->default(true);
    $table->timestamps();
    $table->index(['start_date', 'end_date', 'is_active']);
    $table->index(['promotion_code']);
});

Schema::create('promotion_usage', function (Blueprint $table) {
    $table->id();
    $table->foreignId('promotion_id')->constrained();
    $table->foreignId('customer_id')->nullable()->constrained();
    $table->foreignId('sale_id')->constrained();
    $table->timestamp('used_at')->useCurrent();
    $table->decimal('discount_applied', 10, 2);
    $table->timestamps();
    $table->index(['promotion_id', 'customer_id']);
    $table->index(['sale_id']);
});
32. 0032_create_stock_transfers_tables.php (Stock transfers)
php
Schema::create('stock_transfers', function (Blueprint $table) {
    $table->id();
    $table->string('transfer_number', 50)->unique();
    $table->foreignId('from_branch_id')->constrained('branches');
    $table->foreignId('to_branch_id')->constrained('branches');
    $table->date('transfer_date');
    $table->date('expected_delivery_date')->nullable();
    $table->date('actual_delivery_date')->nullable();
    $table->integer('total_items');
    $table->decimal('total_value', 12, 2);
    $table->enum('status', ['pending', 'approved', 'packed', 'in_transit', 'received', 'cancelled', 'partial'])->default('pending');
    $table->enum('transfer_reason', ['stock_balancing', 'sale_demand', 'excess_stock', 'new_branch', 'return_to_warehouse', 'other'])->default('stock_balancing');
    $table->foreignId('initiated_by')->constrained('users');
    $table->foreignId('approved_by')->nullable()->constrained('users');
    $table->foreignId('packed_by')->nullable()->constrained('users');
    $table->foreignId('received_by')->nullable()->constrained('users');
    $table->text('notes')->nullable();
    $table->timestamps();
    $table->index(['transfer_date']);
    $table->index(['status']);
    $table->index(['from_branch_id', 'to_branch_id']);
    $table->index(['initiated_by', 'transfer_date']);
});

Schema::create('stock_transfer_items', function (Blueprint $table) {
    $table->id();
    $table->foreignId('transfer_id')->constrained('stock_transfers')->cascadeOnDelete();
    $table->foreignId('product_id')->constrained();
    $table->foreignId('variant_id')->nullable()->constrained('product_variants');
    $table->integer('quantity');
    $table->integer('quantity_sent')->default(0);
    $table->integer('quantity_received')->default(0);
    $table->decimal('unit_cost', 10, 2);
    $table->decimal('total_cost', 10, 2);
    $table->text('notes')->nullable();
    $table->timestamps();
    $table->index(['transfer_id', 'product_id']);
});
33. 0033_create_reports_tables.php (Reports and analytics)
php
Schema::create('report_templates', function (Blueprint $table) {
    $table->id();
    $table->string('template_name', 100);
    $table->enum('report_type', ['sales', 'inventory', 'customer', 'staff', 'financial', 'purchase', 'expense', 'profit_loss', 'balance_sheet', 'custom']);
    $table->json('filters')->nullable();
    $table->json('columns')->nullable();
    $table->string('sort_by', 50)->nullable();
    $table->enum('sort_order', ['asc', 'desc'])->default('desc');
    $table->string('group_by', 50)->nullable();
    $table->string('time_range', 50)->nullable();
    $table->boolean('is_default')->default(false);
    $table->boolean('is_public')->default(false);
    $table->foreignId('created_by')->constrained('users');
    $table->timestamps();
    $table->unique(['template_name', 'created_by']);
});

Schema::create('saved_reports', function (Blueprint $table) {
    $table->id();
    $table->string('report_name', 100);
    $table->string('report_type', 50);
    $table->json('data')->nullable();
    $table->date('generated_date');
    $table->time('generated_time');
    $table->foreignId('generated_by')->constrained('users');
    $table->json('parameters')->nullable();
    $table->string('file_path')->nullable();
    $table->enum('file_format', ['pdf', 'excel', 'csv', 'html'])->default('pdf');
    $table->integer('download_count')->default(0);
    $table->timestamps();
    $table->index(['report_type', 'generated_date']);
    $table->index(['generated_by', 'generated_date']);
});

Schema::create('kpis', function (Blueprint $table) {
    $table->id();
    $table->string('kpi_name', 100);
    $table->string('kpi_code', 50)->unique();
    $table->text('description')->nullable();
    $table->text('calculation_formula')->nullable();
    $table->decimal('target_value', 12, 2)->nullable();
    $table->string('unit', 20)->nullable();
    $table->enum('frequency', ['daily', 'weekly', 'monthly', 'quarterly', 'yearly'])->default('daily');
    $table->string('department', 50)->nullable();
    $table->boolean('is_active')->default(true);
    $table->timestamps();
    $table->index(['kpi_code']);
});

Schema::create('kpi_values', function (Blueprint $table) {
    $table->id();
    $table->foreignId('kpi_id')->constrained();
    $table->foreignId('branch_id')->nullable()->constrained();
    $table->date('period_date');
    $table->decimal('actual_value', 12, 2);
    $table->decimal('target_value', 12, 2)->nullable();
    $table->decimal('variance', 12, 2)->nullable();
    $table->decimal('variance_percentage', 5, 2)->nullable();
    $table->text('notes')->nullable();
    $table->timestamp('recorded_at')->useCurrent();
    $table->timestamps();
    $table->unique(['kpi_id', 'branch_id', 'period_date']);
    $table->index(['kpi_id', 'period_date']);
    $table->index(['branch_id', 'kpi_id', 'period_date']);
});
34. 0034_create_settings_tables.php (Application settings)
php
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
35. 0035_create_notifications_table.php (Notifications)
php
Schema::create('notifications', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->cascadeOnDelete();
    $table->string('notification_type', 50);
    $table->string('title', 200);
    $table->text('message');
    $table->json('data')->nullable();
    $table->boolean('is_read')->default(false);
    $table->timestamp('read_at')->nullable();
    $table->timestamps();
    $table->index(['user_id', 'is_read', 'created_at']);
    $table->index(['notification_type', 'created_at']);
});
36. 0036_create_audit_logs_tables.php (Audit and system logs)
php
Schema::create('login_attempts', function (Blueprint $table) {
    $table->id();
    $table->string('ip_address', 45);
    $table->string('username', 100);
    $table->boolean('success')->default(false);
    $table->timestamp('attempted_at')->useCurrent();
    $table->text('user_agent')->nullable();
    $table->timestamps();
    $table->index(['ip_address']);
    $table->index(['username']);
    $table->index(['attempted_at']);
});

Schema::create('audit_logs', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
    $table->string('action', 100);
    $table->string('entity_type', 50);
    $table->unsignedBigInteger('entity_id')->nullable();
    $table->json('old_values')->nullable();
    $table->json('new_values')->nullable();
    $table->string('ip_address', 45)->nullable();
    $table->text('user_agent')->nullable();
    $table->foreignId('branch_id')->nullable()->constrained()->nullOnDelete();
    $table->timestamps();
    $table->index(['user_id', 'action']);
    $table->index(['entity_type', 'entity_id', 'created_at']);
    $table->index(['created_at']);
    $table->index(['branch_id', 'created_at']);
});

Schema::create('backups', function (Blueprint $table) {
    $table->id();
    $table->string('backup_name', 100);
    $table->string('file_path');
    $table->bigInteger('file_size')->nullable();
    $table->enum('backup_type', ['full', 'partial', 'incremental'])->default('full');
    $table->enum('status', ['pending', 'in_progress', 'completed', 'failed'])->default('pending');
    $table->foreignId('created_by')->nullable()->constrained('users');
    $table->timestamps();
    $table->timestamp('completed_at')->nullable();
    $table->index(['created_at']);
    $table->index(['status', 'created_at']);
});

Schema::create('maintenance_logs', function (Blueprint $table) {
    $table->id();
    $table->string('task_name', 100);
    $table->enum('task_type', ['cleanup', 'optimization', 'backup', 'update', 'other'])->default('other');
    $table->enum('status', ['pending', 'running', 'completed', 'failed'])->default('pending');
    $table->timestamp('started_at')->nullable();
    $table->timestamp('completed_at')->nullable();
    $table->integer('duration_seconds')->nullable();
    $table->text('details')->nullable();
    $table->foreignId('created_by')->nullable()->constrained('users');
    $table->timestamps();
    $table->index(['created_at']);
    $table->index(['task_type', 'status', 'created_at']);
});
37. 0037_create_user_branches_table.php (User branch assignments - pivot table)
php
Schema::create('user_branches', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->cascadeOnDelete();
    $table->foreignId('branch_id')->constrained()->cascadeOnDelete();
    $table->boolean('is_default')->default(false);
    $table->timestamp('assigned_at')->useCurrent();
    $table->foreignId('assigned_by')->nullable()->constrained('users')->nullOnDelete();

    $table->unique(['user_id', 'branch_id']);
    $table->index(['user_id']);
    $table->index(['branch_id']);
});







{{-- public function up(): void
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



    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username', 50)->unique();
            $table->string('email', 100)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('full_name', 100);
            $table->string('phone', 20)->unique()->nullable();
            $table->string('profile_image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamp('last_login')->nullable();
            $table->integer('login_count')->default(0);
            $table->integer('failed_login_attempts')->default(0);
            $table->timestamp('last_password_change')->nullable();
            $table->boolean('must_change_password')->default(false);
            $table->boolean('two_factor_enabled')->default(false);
            $table->string('two_factor_secret')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
            $table->index(['is_active']);
            $table->index(['email']);
            $table->index(['phone']);
        });
       
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    
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
    
    public function up(): void
    {
        Schema::create('cache', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->mediumText('value');
            $table->integer('expiration');
        });
        Schema::create('cache_locks', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->string('owner');
            $table->integer('expiration');
        });
    }


    public function up(): void
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('queue')->index();
            $table->longText('payload');
            $table->unsignedTinyInteger('attempts');
            $table->unsignedInteger('reserved_at')->nullable();
            $table->unsignedInteger('available_at');
            $table->unsignedInteger('created_at');
        });
        Schema::create('job_batches', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->integer('total_jobs');
            $table->integer('pending_jobs');
            $table->integer('failed_jobs');
            $table->longText('failed_job_ids');
            $table->mediumText('options')->nullable();
            $table->integer('cancelled_at')->nullable();
            $table->integer('created_at');
            $table->integer('finished_at')->nullable();
        });
        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->text('connection');
            $table->text('queue');
            $table->longText('payload');
            $table->longText('exception');
            $table->timestamp('failed_at')->useCurrent();
        });
    }


    public function up(): void
    {
        $teams = config('permission.teams');
        $tableNames = config('permission.table_names');
        $columnNames = config('permission.column_names');
        $pivotRole = $columnNames['role_pivot_key'] ?? 'role_id';
        $pivotPermission = $columnNames['permission_pivot_key'] ?? 'permission_id';
        throw_if(empty($tableNames), Exception::class, 'Error: config/permission.php not loaded. Run [php artisan config:clear] and try again.');
        throw_if($teams && empty($columnNames['team_foreign_key'] ?? null), Exception::class, 'Error: team_foreign_key on config/permission.php not loaded. Run [php artisan config:clear] and try again.');
        Schema::create($tableNames['permissions'], static function (Blueprint $table) {
            // $table->engine('InnoDB');
            $table->bigIncrements('id'); // permission id
            $table->string('name');       // For MyISAM use string('name', 225); // (or 166 for InnoDB with Redundant/Compact row format)
            $table->string('guard_name'); // For MyISAM use string('guard_name', 25);
            $table->timestamps();
            $table->unique(['name', 'guard_name']);
        });
        Schema::create($tableNames['roles'], static function (Blueprint $table) use ($teams, $columnNames) {
            // $table->engine('InnoDB');
            $table->bigIncrements('id'); // role id
            if ($teams || config('permission.testing')) { // permission.testing is a fix for sqlite testing
                $table->unsignedBigInteger($columnNames['team_foreign_key'])->nullable();
                $table->index($columnNames['team_foreign_key'], 'roles_team_foreign_key_index');
            }
            $table->string('name');       // For MyISAM use string('name', 225); // (or 166 for InnoDB with Redundant/Compact row format)
            $table->string('guard_name'); // For MyISAM use string('guard_name', 25);
            $table->timestamps();
            if ($teams || config('permission.testing')) {
                $table->unique([$columnNames['team_foreign_key'], 'name', 'guard_name']);
            } else {
                $table->unique(['name', 'guard_name']);
            }
        });
        Schema::create($tableNames['model_has_permissions'], static function (Blueprint $table) use ($tableNames, $columnNames, $pivotPermission, $teams) {
            $table->unsignedBigInteger($pivotPermission);
            $table->string('model_type');
            $table->unsignedBigInteger($columnNames['model_morph_key']);
            $table->index([$columnNames['model_morph_key'], 'model_type'], 'model_has_permissions_model_id_model_type_index');
            $table->foreign($pivotPermission)
                ->references('id') // permission id
                ->on($tableNames['permissions'])
                ->onDelete('cascade');
            if ($teams) {
                $table->unsignedBigInteger($columnNames['team_foreign_key']);
                $table->index($columnNames['team_foreign_key'], 'model_has_permissions_team_foreign_key_index');
                $table->primary(
                    [$columnNames['team_foreign_key'], $pivotPermission, $columnNames['model_morph_key'], 'model_type'],
                    'model_has_permissions_permission_model_type_primary'
                );
            } else {
                $table->primary(
                    [$pivotPermission, $columnNames['model_morph_key'], 'model_type'],
                    'model_has_permissions_permission_model_type_primary'
                );
            }
        });
        Schema::create($tableNames['model_has_roles'], static function (Blueprint $table) use ($tableNames, $columnNames, $pivotRole, $teams) {
            $table->unsignedBigInteger($pivotRole);
            $table->string('model_type');
            $table->unsignedBigInteger($columnNames['model_morph_key']);
            $table->index([$columnNames['model_morph_key'], 'model_type'], 'model_has_roles_model_id_model_type_index');
            $table->foreign($pivotRole)
                ->references('id') // role id
                ->on($tableNames['roles'])
                ->onDelete('cascade');
            if ($teams) {
                $table->unsignedBigInteger($columnNames['team_foreign_key']);
                $table->index($columnNames['team_foreign_key'], 'model_has_roles_team_foreign_key_index');
                $table->primary(
                    [$columnNames['team_foreign_key'], $pivotRole, $columnNames['model_morph_key'], 'model_type'],
                    'model_has_roles_role_model_type_primary'
                );
            } else {
                $table->primary(
                    [$pivotRole, $columnNames['model_morph_key'], 'model_type'],
                    'model_has_roles_role_model_type_primary'
                );
            }
        });
        Schema::create($tableNames['role_has_permissions'], static function (Blueprint $table) use ($tableNames, $pivotRole, $pivotPermission) {
            $table->unsignedBigInteger($pivotPermission);
            $table->unsignedBigInteger($pivotRole);
            $table->foreign($pivotPermission)
                ->references('id') // permission id
                ->on($tableNames['permissions'])
                ->onDelete('cascade');
                $table->foreign($pivotRole)
                ->references('id') // role id
                ->on($tableNames['roles'])
                ->onDelete('cascade');
                $table->primary([$pivotPermission, $pivotRole], 'role_has_permissions_permission_id_role_id_primary');
        });
        app('cache')
            ->store(config('permission.cache.store') != 'default' ? config('permission.cache.store') : null)
            ->forget(config('permission.cache.key'));
    }


    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('category_code', 20)->unique();
            $table->string('category_name', 100);
            $table->foreignId('parent_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->text('description')->nullable();
            $table->string('image_url')->nullable();
            $table->integer('display_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->timestamps();
            $table->index(['parent_id', 'is_active']);
        });
    }

    public function up(): void
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('brand_code', 20)->unique();
            $table->string('brand_name', 100);
            $table->text('description')->nullable();
            $table->string('logo_url')->nullable();
            $table->string('website')->nullable();
            $table->string('contact_email', 100)->nullable();
            $table->string('contact_phone', 20)->nullable();
            $table->string('country_of_origin', 2)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->foreign('country_of_origin')->references('country_code')->on('countries');
            $table->unique(['brand_name']);
        });
    }


    public function up(): void
    {
        Schema::create('collections', function (Blueprint $table) {
            $table->id();
            $table->string('collection_code', 20)->unique();
            $table->string('collection_name', 100);
            $table->enum('season', ['spring', 'summer', 'autumn', 'winter', 'all_season'])->default('all_season');
            $table->year('year');
            $table->text('description')->nullable();
            $table->date('launch_date')->nullable();
            $table->date('end_date')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->index(['season', 'year']);
        });
    }



    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_code', 50)->unique();
            $table->string('sku', 50)->unique();
            $table->string('product_name', 200);
            $table->text('short_description')->nullable();
            $table->longText('long_description')->nullable();
            $table->foreignId('category_id')->constrained();
            $table->foreignId('brand_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('collection_id')->nullable()->constrained()->nullOnDelete();
            $table->enum('gender', ['male', 'female', 'unisex', 'kids', 'infants'])->default('unisex');
            $table->enum('age_group', ['infant', 'kids', 'teens', 'adults', 'all'])->default('adults');
            $table->enum('seasonality', ['winter', 'summer', 'all_season', 'festive'])->default('all_season');
            // Pricing
            $table->decimal('cost_price', 10, 2);
            $table->decimal('mrp_price', 10, 2);
            $table->decimal('sale_price', 10, 2)->nullable();
            $table->decimal('wholesale_price', 10, 2)->nullable();
            // Dimensions and Weight
            $table->decimal('weight_kg', 6, 3)->nullable();
            $table->decimal('length_cm', 6, 2)->nullable();
            $table->decimal('width_cm', 6, 2)->nullable();
            $table->decimal('height_cm', 6, 2)->nullable();
            // Care Instructions
            $table->text('care_instructions')->nullable();
            $table->string('fabric_composition', 255)->nullable();
            $table->string('origin_country', 2)->nullable();
            // Inventory
            $table->boolean('has_variants')->default(false);
            $table->integer('reorder_level')->default(10);
            $table->integer('reorder_quantity')->default(50);
            // Tax
            $table->decimal('tax_rate', 5, 2)->default(0.00);
            $table->string('hsn_code', 10)->nullable();
            // Status
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_new_arrival')->default(true);
            $table->boolean('is_bestseller')->default(false);
            $table->boolean('is_active')->default(true);
            // Metadata
            $table->string('barcode', 100)->unique()->nullable();
            $table->text('search_keywords')->nullable();
            $table->decimal('rating', 3, 2)->default(0.00);
            $table->integer('total_ratings')->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('origin_country')->references('country_code')->on('countries');
            $table->index(['category_id', 'brand_id']);
            $table->index(['gender', 'seasonality']);
            $table->index(['mrp_price', 'sale_price']);
            $table->index(['is_active', 'is_featured', 'is_new_arrival']);
        });
        // Product Images
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->string('image_url');
            $table->string('thumbnail_url')->nullable();
            $table->string('alt_text', 255)->nullable();
            $table->integer('display_order')->default(0);
            $table->boolean('is_primary')->default(false);
            $table->timestamps();
            $table->index(['product_id', 'display_order']);
        });

        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->string('variant_code', 100)->unique();
            $table->string('variant_sku', 100)->unique();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->string('size', 20)->nullable();
            $table->string('color', 50)->nullable();
            $table->string('material', 50)->nullable();
            $table->string('fit', 30)->nullable();
            $table->decimal('additional_price', 10, 2)->default(0.00);
            $table->decimal('weight_variance', 5, 3)->default(0.000);
            $table->string('image_url')->nullable();
            $table->string('barcode', 100)->unique()->nullable();
            $table->boolean('is_default')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->index(['product_id', 'variant_code']);
            $table->index(['size', 'color']);
            $table->index(['variant_sku']);
        });
        Schema::create('variant_attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('variant_id')->constrained('product_variants')->cascadeOnDelete();
            $table->foreignId('attribute_id')->constrained('product_attributes');
            $table->foreignId('attribute_value_id')->constrained('attribute_values');
            $table->timestamps();
            $table->unique(['variant_id', 'attribute_id']);
        });

        // Price History
        Schema::create('price_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->foreignId('variant_id')->nullable()->constrained('product_variants')->cascadeOnDelete();
            $table->decimal('cost_price', 10, 2);
            $table->decimal('selling_price', 10, 2);
            $table->decimal('mrp_price', 10, 2);
            $table->date('effective_date');
            $table->foreignId('changed_by')->nullable()->constrained('users');
            $table->string('reason', 255)->nullable();
            $table->timestamps();
            $table->index(['product_id', 'effective_date']);
        });
    }


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
            $table->unique(['product_id', 'attribute_id', 'attribute_value_id']);
        });
    }



    




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

    }

   
    

    public function up(): void
    {
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


    public function up(): void
    {
        Schema::create('customer_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->cascadeOnDelete();
            $table->enum('address_type', ['home', 'work', 'billing', 'shipping', 'other'])->default('home');
            $table->text('address_line1');
            $table->text('address_line2')->nullable();
            $table->string('city', 100);
            $table->string('state', 100);
            $table->string('pincode', 10);
            $table->string('country_code', 2)->default('IN');
            $table->boolean('is_default')->default(false);
            $table->timestamps();
            $table->foreign('country_code')->references('country_code')->on('countries');
            $table->index(['customer_id', 'address_type']);
        });

    }
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

 public function up(): void
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number', 50)->unique();
            $table->foreignId('branch_id')->constrained();
            // Dates and Times
            $table->date('sale_date');
            $table->time('sale_time');
            $table->dateTime('sale_datetime')->storedAs('TIMESTAMP(sale_date, sale_time)');
            // Customer Info
            $table->foreignId('customer_id')->nullable()->constrained()->nullOnDelete();
            $table->string('customer_name', 100)->nullable();
            $table->string('customer_phone', 20)->nullable();
            $table->string('customer_email', 100)->nullable();
            $table->text('customer_address')->nullable();
            // Totals
            $table->integer('total_items');
            $table->decimal('subtotal', 12, 2);
            $table->decimal('discount_amount', 10, 2)->default(0.00);
            $table->decimal('discount_percentage', 5, 2)->default(0.00);
            $table->decimal('tax_amount', 10, 2)->default(0.00);
            $table->decimal('shipping_charge', 10, 2)->default(0.00);
            $table->decimal('handling_charge', 10, 2)->default(0.00);
            $table->decimal('rounding_adjustment', 5, 2)->default(0.00);
            $table->decimal('grand_total', 12, 2);
            // Payment
            $table->decimal('amount_paid', 12, 2);
            $table->decimal('balance_due', 10, 2)->default(0.00);
            $table->enum('payment_status', ['paid', 'partial', 'pending', 'refunded', 'cancelled'])->default('pending');
            $table->enum('sale_status', ['completed', 'pending', 'cancelled', 'returned', 'on_hold'])->default('pending');
            // Promotions
            $table->string('coupon_code', 50)->nullable();
            $table->decimal('coupon_discount', 10, 2)->default(0.00);
            $table->integer('loyalty_points_used')->default(0);
            $table->integer('loyalty_points_earned')->default(0);
            // Staff
            $table->foreignId('sales_person_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('cashier_id')->nullable()->constrained('users')->nullOnDelete();
            // Delivery
            $table->enum('delivery_type', ['pickup', 'home_delivery', 'express'])->default('pickup');
            $table->text('delivery_address')->nullable();
            $table->date('delivery_date')->nullable();
            $table->time('delivery_time')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->index(['sale_date']);
            $table->index(['branch_id', 'sale_date']);
            $table->index(['customer_id']);
            $table->index(['invoice_number']);
            $table->index(['payment_status', 'sale_status']);
            $table->index(['sale_datetime']);
        });
        Schema::create('sale_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained();
            $table->foreignId('variant_id')->nullable()->constrained('product_variants');
            // Product Info
            $table->string('product_code', 50);
            $table->string('product_name', 200);
            $table->string('size', 20)->nullable();
            $table->string('color', 50)->nullable();
            $table->string('material', 50)->nullable();
            // Pricing
            $table->integer('quantity');
            $table->decimal('unit_price', 10, 2);
            $table->decimal('cost_price', 10, 2);
            $table->decimal('discount_percentage', 5, 2)->default(0.00);
            $table->decimal('discount_amount', 10, 2)->default(0.00);
            $table->decimal('tax_percentage', 5, 2)->default(0.00);
            $table->decimal('tax_amount', 10, 2)->default(0.00);
            $table->decimal('total_price', 10, 2);
            // Returns
            $table->integer('returned_quantity')->default(0);
            $table->string('return_reason', 100)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->index(['sale_id', 'product_id']);
            $table->index(['product_id', 'sale_id']);
        });
        Schema::create('sale_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_id')->constrained()->cascadeOnDelete();
            $table->enum('payment_method', ['cash', 'card', 'upi', 'bank_transfer', 'credit', 'wallet', 'cheque', 'emi']);
            $table->string('payment_method_detail', 100)->nullable();
            $table->decimal('amount', 10, 2);
            $table->string('reference_number', 100)->nullable();
            $table->string('transaction_id', 100)->nullable();
            $table->date('payment_date');
            $table->time('payment_time');
            $table->enum('payment_status', ['success', 'failed', 'pending', 'refunded'])->default('success');
            $table->string('card_type', 20)->nullable();
            $table->string('card_last_four', 4)->nullable();
            $table->string('upi_id', 50)->nullable();
            $table->string('bank_name', 100)->nullable();
            $table->foreignId('collected_by')->constrained('users');
            $table->foreignId('verified_by')->nullable()->constrained('users');
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->index(['sale_id', 'payment_method']);
            $table->index(['payment_date']);
            $table->index(['reference_number']);
        });
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

    public function up(): void
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string('promotion_code', 50)->unique();
            $table->string('promotion_name', 100);
            $table->enum('promotion_type', ['percentage', 'fixed', 'bogo', 'shipping', 'loyalty']);
            $table->decimal('discount_value', 10, 2);
            $table->decimal('minimum_purchase', 10, 2)->default(0.00);
            $table->decimal('maximum_discount', 10, 2)->nullable();
            $table->json('applicable_categories')->nullable();
            $table->json('excluded_categories')->nullable();
            $table->json('applicable_brands')->nullable();
            $table->json('excluded_brands')->nullable();
            $table->json('applicable_products')->nullable();
            $table->json('excluded_products')->nullable();
            $table->enum('customer_type', ['all', 'new', 'existing', 'vip'])->default('all');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('usage_limit')->nullable();
            $table->integer('per_customer_limit')->default(1);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->index(['start_date', 'end_date', 'is_active']);
            $table->index(['promotion_code']);
        });
        Schema::create('promotion_usage', function (Blueprint $table) {
            $table->id();
            $table->foreignId('promotion_id')->constrained();
            $table->foreignId('customer_id')->nullable()->constrained();
            $table->foreignId('sale_id')->constrained();
            $table->timestamp('used_at')->useCurrent();
            $table->decimal('discount_applied', 10, 2);
            $table->timestamps();
            $table->index(['promotion_id', 'customer_id']);
            $table->index(['sale_id']);
        });
    }
    public function up(): void
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('supplier_code', 20)->unique();
            $table->string('company_name', 200);
            $table->string('contact_person', 100)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('phone', 20);
            $table->string('alternate_phone', 20)->nullable();
            // Address
            $table->text('address')->nullable();
            $table->string('city', 100)->nullable();
            $table->string('state', 100)->nullable();
            $table->string('pincode', 10)->nullable();
            $table->string('country_code', 2)->default('IN');
            // Business Info
            $table->string('tax_id', 50)->nullable();
            $table->string('business_id', 50)->nullable();
            $table->string('website')->nullable();
            // Bank Details
            $table->string('account_number', 30)->nullable();
            $table->string('account_holder', 100)->nullable();
            $table->string('bank_name', 100)->nullable();
            $table->string('branch_name', 100)->nullable();
            $table->string('ifsc_code', 20)->nullable();
            // Financial
            $table->decimal('credit_limit', 12, 2)->default(0.00);
            $table->decimal('current_balance', 12, 2)->default(0.00);
            $table->decimal('total_purchases', 12, 2)->default(0.00);
            $table->decimal('outstanding_amount', 12, 2)->default(0.00);
            $table->string('payment_terms', 100)->nullable();
            $table->integer('payment_days')->default(30);
            // Classification
            $table->enum('supplier_type', ['manufacturer', 'wholesaler', 'distributor', 'importer', 'local_vendor'])->default('wholesaler');
            $table->decimal('rating', 3, 2)->default(0.00);
            // Status
            $table->boolean('is_active')->default(true);
            $table->boolean('is_blacklisted')->default(false);
            $table->text('blacklist_reason')->nullable();
            $table->text('notes')->nullable();
            $table->date('last_purchase_date')->nullable();
            $table->timestamps();
            $table->foreign('country_code')->references('country_code')->on('countries');
            $table->index(['company_name']);
            $table->index(['supplier_code']);
            $table->index(['is_active', 'supplier_type']);
        });
        Schema::create('supplier_branches', function (Blueprint $table) {
            $table->foreignId('supplier_id')->constrained()->cascadeOnDelete();
            $table->foreignId('branch_id')->constrained()->cascadeOnDelete();
            $table->boolean('is_primary')->default(false);
            $table->integer('delivery_days')->default(7);
            $table->decimal('minimum_order_value', 10, 2)->default(0.00);
            $table->timestamp('assigned_at')->useCurrent();
            $table->primary(['supplier_id', 'branch_id']);
            $table->index(['branch_id', 'supplier_id']);
        });
    }

    public function up(): void
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->string('purchase_number', 50)->unique();
            $table->foreignId('supplier_id')->constrained();
            $table->foreignId('branch_id')->constrained();
            // Dates
            $table->date('order_date');
            $table->date('expected_delivery_date')->nullable();
            $table->date('actual_delivery_date')->nullable();
            // Totals
            $table->integer('total_items');
            $table->decimal('subtotal', 12, 2);
            $table->decimal('tax_amount', 10, 2)->default(0.00);
            $table->decimal('shipping_charge', 10, 2)->default(0.00);
            $table->decimal('other_charges', 10, 2)->default(0.00);
            $table->decimal('round_off', 5, 2)->default(0.00);
            $table->decimal('grand_total', 12, 2);
            // Payment
            $table->decimal('amount_paid', 12, 2)->default(0.00);
            $table->decimal('balance_due', 12, 2)->default(0.00);
            $table->enum('payment_status', ['paid', 'partial', 'pending', 'overdue'])->default('pending');
            $table->enum('purchase_status', ['ordered', 'received', 'partially_received', 'cancelled', 'returned'])->default('ordered');
            // Personnel
            $table->foreignId('ordered_by')->constrained('users');
            $table->foreignId('received_by')->nullable()->constrained('users');
            $table->foreignId('approved_by')->nullable()->constrained('users');
            // Shipping
            $table->string('shipping_method', 50)->nullable();
            $table->string('tracking_number', 100)->nullable();
            $table->string('carrier_name', 100)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->index(['order_date']);
            $table->index(['supplier_id', 'order_date']);
            $table->index(['purchase_status', 'payment_status']);
            $table->index(['branch_id', 'supplier_id']);
        });
        Schema::create('purchase_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained();
            $table->foreignId('variant_id')->nullable()->constrained('product_variants');
            // Quantities
            $table->integer('quantity_ordered');
            $table->integer('quantity_received')->default(0);
            $table->integer('quantity_rejected')->default(0);
            // Pricing
            $table->decimal('unit_cost', 10, 2);
            $table->decimal('total_cost', 10, 2);
            $table->decimal('discount_percentage', 5, 2)->default(0.00);
            $table->decimal('discount_amount', 10, 2)->default(0.00);
            $table->decimal('tax_percentage', 5, 2)->default(0.00);
            $table->decimal('tax_amount', 10, 2)->default(0.00);
            // Product Info
            $table->date('expiry_date')->nullable();
            $table->string('batch_number', 50)->nullable();
            $table->date('manufacturing_date')->nullable();
            // Status
            $table->enum('received_condition', ['good', 'damaged', 'expired'])->default('good');
            $table->text('rejection_reason')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->index(['purchase_id', 'product_id']);
            $table->index(['batch_number', 'expiry_date']);
        });
        Schema::create('supplier_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->constrained();
            $table->foreignId('purchase_id')->nullable()->constrained()->nullOnDelete();
            $table->date('payment_date');
            $table->enum('payment_method', ['cash', 'cheque', 'bank_transfer', 'upi', 'credit_card', 'dd']);
            $table->decimal('amount', 12, 2);
            $table->string('reference_number', 100)->nullable();
            $table->string('transaction_id', 100)->nullable();
            $table->text('payment_for')->nullable();
            $table->enum('payment_status', ['completed', 'pending', 'failed', 'cancelled'])->default('completed');
            $table->text('notes')->nullable();
            $table->foreignId('paid_by')->constrained('users');
            $table->foreignId('approved_by')->nullable()->constrained('users');
            $table->timestamps();
            $table->index(['supplier_id', 'payment_date']);
            $table->index(['payment_date']);
            $table->index(['reference_number']);
        });
    }

    public function up(): void
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();
            $table->string('employee_code', 20)->unique();
            $table->string('designation', 100);
            $table->enum('department', ['sales', 'inventory', 'accounts', 'management', 'purchasing', 'hr', 'marketing', 'other'])->default('sales');
            // Personal Info
            $table->date('date_of_joining');
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->enum('marital_status', ['single', 'married', 'divorced', 'widowed'])->default('single');
            // Emergency Contact
            $table->string('emergency_contact', 20)->nullable();
            $table->string('emergency_contact_name', 100)->nullable();
            $table->string('emergency_contact_relation', 50)->nullable();
            // Bank Details
            $table->string('bank_account_number', 30)->nullable();
            $table->string('bank_name', 100)->nullable();
            $table->string('branch_name', 100)->nullable();
            $table->string('ifsc_code', 20)->nullable();
            // Government IDs
            $table->string('aadhar_number', 20)->nullable();
            $table->string('pan_number', 20)->nullable();
            $table->string('passport_number', 20)->nullable();
            // Salary
            $table->decimal('basic_salary', 10, 2);
            $table->decimal('allowances', 10, 2)->default(0.00);
            $table->decimal('deductions', 10, 2)->default(0.00);
            $table->decimal('net_salary', 10, 2);
            // Employment
            $table->enum('employment_type', ['permanent', 'contract', 'temporary', 'intern', 'probation'])->default('permanent');
            $table->enum('employment_status', ['active', 'inactive', 'terminated', 'resigned'])->default('active');
            $table->date('termination_date')->nullable();
            $table->text('termination_reason')->nullable();
            // Performance
            $table->decimal('sales_target', 12, 2)->default(0.00);
            $table->decimal('current_month_sales', 12, 2)->default(0.00);
            $table->decimal('total_sales', 12, 2)->default(0.00);
            $table->decimal('commission_rate', 5, 2)->default(0.00);
            $table->boolean('is_active')->default(true);
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->index(['employee_code']);
            $table->index(['department']);
            $table->index(['employment_status']);
            $table->index(['is_active']);
        });
        Schema::create('staff_branches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('staff_id')->constrained()->cascadeOnDelete();
            $table->foreignId('branch_id')->constrained()->cascadeOnDelete();
            $table->boolean('is_primary')->default(false);
            $table->json('working_hours')->nullable();
            $table->string('weekly_off', 50)->nullable();
            $table->timestamp('assigned_at')->useCurrent();
            $table->foreignId('assigned_by')->nullable()->constrained('users')->nullOnDelete();
            $table->unique(['staff_id', 'branch_id']);
            $table->index(['branch_id', 'staff_id']);
        });
        Schema::create('attendance', function (Blueprint $table) {
            $table->id();
            $table->foreignId('staff_id')->constrained()->cascadeOnDelete();
            $table->foreignId('branch_id')->constrained();
            $table->date('attendance_date');
            $table->time('shift_start')->nullable();
            $table->time('shift_end')->nullable();
            $table->time('check_in_time')->nullable();
            $table->time('check_out_time')->nullable();
            $table->decimal('total_hours', 5, 2)->nullable();
            $table->decimal('overtime_hours', 5, 2)->default(0.00);
            $table->enum('status', ['present', 'absent', 'half_day', 'leave', 'holiday', 'week_off'])->default('absent');
            $table->enum('leave_type', ['sick', 'casual', 'paid', 'unpaid', 'maternity', 'paternity', 'emergency'])->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('recorded_by')->nullable()->constrained('users');
            $table->foreignId('approved_by')->nullable()->constrained('users');
            $table->timestamps();
            $table->unique(['staff_id', 'attendance_date']);
            $table->index(['attendance_date']);
            $table->index(['staff_id', 'attendance_date']);
            $table->index(['branch_id', 'attendance_date']);
        });
        Schema::create('leave_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('staff_id')->constrained()->cascadeOnDelete();
            $table->enum('leave_type', ['sick', 'casual', 'paid', 'unpaid', 'maternity', 'paternity', 'emergency']);
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('total_days');
            $table->text('reason')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected', 'cancelled'])->default('pending');
            $table->foreignId('approved_by')->nullable()->constrained('users');
            $table->timestamp('approved_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->index(['staff_id', 'start_date']);
            $table->index(['status', 'start_date']);
        });
        Schema::create('salary_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('staff_id')->constrained();
            $table->date('payment_date');
            $table->date('salary_month');
            // Earnings
            $table->decimal('basic_salary', 10, 2);
            $table->decimal('allowances', 10, 2)->default(0.00);
            $table->decimal('overtime_amount', 10, 2)->default(0.00);
            $table->decimal('commission_amount', 10, 2)->default(0.00);
            $table->decimal('bonus', 10, 2)->default(0.00);
            $table->decimal('incentives', 10, 2)->default(0.00);
            $table->decimal('total_earnings', 10, 2);
            // Deductions
            $table->decimal('deductions', 10, 2)->default(0.00);
            $table->decimal('advance_deduction', 10, 2)->default(0.00);
            $table->decimal('tax_deduction', 10, 2)->default(0.00);
            $table->decimal('other_deductions', 10, 2)->default(0.00);
            $table->decimal('total_deductions', 10, 2);
            // Net
            $table->decimal('net_amount', 10, 2);
            // Payment Details
            $table->enum('payment_method', ['cash', 'bank_transfer', 'cheque', 'upi'])->default('bank_transfer');
            $table->string('payment_reference', 100)->nullable();
            $table->string('transaction_id', 100)->nullable();
            $table->string('bank_name', 100)->nullable();
            $table->string('account_number', 30)->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('paid_by')->nullable()->constrained('users');
            $table->foreignId('approved_by')->nullable()->constrained('users');
            $table->timestamps();
            $table->index(['salary_month']);
            $table->index(['staff_id', 'salary_month']);
            $table->unique(['staff_id', 'salary_month']);
        });
        Schema::create('salary_advances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('staff_id')->constrained();
            $table->decimal('advance_amount', 10, 2);
            $table->date('request_date');
            $table->text('reason')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected', 'paid'])->default('pending');
            $table->foreignId('approved_by')->nullable()->constrained('users');
            $table->date('approved_date')->nullable();
            $table->integer('repayment_months')->default(3);
            $table->decimal('monthly_deduction', 10, 2)->nullable();
            $table->decimal('total_deducted', 10, 2)->default(0.00);
            $table->decimal('balance_amount', 10, 2);
            $table->timestamps();
            $table->index(['staff_id', 'status']);
            $table->index(['status', 'request_date']);
        });
        Schema::create('commissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('staff_id')->constrained();
            $table->foreignId('sale_id')->constrained();
            $table->date('commission_date');
            $table->decimal('sale_amount', 12, 2);
            $table->decimal('commission_rate', 5, 2);
            $table->decimal('commission_amount', 10, 2);
            $table->boolean('paid')->default(false);
            $table->date('payment_date')->nullable();
            $table->foreignId('payment_id')->nullable()->constrained('salary_payments')->nullOnDelete();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->index(['staff_id', 'commission_date']);
            $table->index(['paid', 'commission_date']);
        });
    }

     public function up(): void
    {
        Schema::create('account_types', function (Blueprint $table) {
            $table->id();
            $table->string('type_code', 20)->unique();
            $table->string('type_name', 50);
            $table->enum('category', ['asset', 'liability', 'equity', 'revenue', 'expense', 'cost_of_sales']);
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->unique(['type_name']);
        });
        // Insert default account types
        DB::table('account_types')->insert([
            ['type_code' => 'CASH', 'type_name' => 'Cash', 'category' => 'asset', 'description' => 'Physical cash on hand'],
            ['type_code' => 'BANK', 'type_name' => 'Bank Accounts', 'category' => 'asset', 'description' => 'Bank account balances'],
            ['type_code' => 'AR', 'type_name' => 'Accounts Receivable', 'category' => 'asset', 'description' => 'Money owed by customers'],
            ['type_code' => 'INVENTORY', 'type_name' => 'Inventory', 'category' => 'asset', 'description' => 'Value of goods in stock'],
            ['type_code' => 'AP', 'type_name' => 'Accounts Payable', 'category' => 'liability', 'description' => 'Money owed to suppliers'],
            ['type_code' => 'LOANS', 'type_name' => 'Loans Payable', 'category' => 'liability', 'description' => 'Outstanding loans'],
            ['type_code' => 'EQUITY', 'type_name' => 'Owner\'s Equity', 'category' => 'equity', 'description' => 'Owner\'s investment'],
            ['type_code' => 'RETAINED', 'type_name' => 'Retained Earnings', 'category' => 'equity', 'description' => 'Accumulated profits'],
            ['type_code' => 'SALES', 'type_name' => 'Sales Revenue', 'category' => 'revenue', 'description' => 'Revenue from sales'],
            ['type_code' => 'PURCHASES', 'type_name' => 'Cost of Goods Sold', 'category' => 'cost_of_sales', 'description' => 'Cost of inventory sold'],
            ['type_code' => 'SALARY', 'type_name' => 'Salaries Expense', 'category' => 'expense', 'description' => 'Employee salaries'],
            ['type_code' => 'RENT', 'type_name' => 'Rent Expense', 'category' => 'expense', 'description' => 'Shop rent'],
            ['type_code' => 'UTILITIES', 'type_name' => 'Utilities Expense', 'category' => 'expense', 'description' => 'Electricity, water, etc.'],
        ]);
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('account_code', 20)->unique();
            $table->string('account_name', 100);
            $table->foreignId('account_type_id')->constrained();
            $table->foreignId('parent_account_id')->nullable()->constrained('accounts')->nullOnDelete();
            // Balances
            $table->decimal('opening_balance', 12, 2)->default(0.00);
            $table->enum('opening_balance_type', ['debit', 'credit'])->default('debit');
            $table->decimal('current_balance', 12, 2)->default(0.00);
            // Settings
            $table->foreignId('branch_id')->nullable()->constrained()->nullOnDelete();
            $table->boolean('is_cash_account')->default(false);
            $table->boolean('is_bank_account')->default(false);
            $table->boolean('is_system_account')->default(false);
            $table->boolean('is_active')->default(true);
            // Bank Details (if applicable)
            $table->string('bank_name', 100)->nullable();
            $table->string('account_number', 30)->nullable();
            $table->string('ifsc_code', 20)->nullable();
            $table->string('branch_name', 100)->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->index(['account_type_id']);
            $table->index(['branch_id', 'is_active']);
            $table->index(['parent_account_id']);
        });
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
            $table->foreignId('journal_id')->constrained()->cascadeOnDelete();
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
            $table->foreignId('journal_id')->nullable()->constrained('journal_entries')->nullOnDelete();
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


    public function up(): void
    {
        Schema::create('expense_categories', function (Blueprint $table) {
            $table->id();
            $table->string('category_code', 20)->unique();
            $table->string('category_name', 100);
            $table->foreignId('parent_id')->nullable()->constrained('expense_categories')->nullOnDelete();
            $table->text('description')->nullable();
            $table->foreignId('account_id')->nullable()->constrained('accounts')->nullOnDelete();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->index(['parent_id']);
            $table->unique(['category_name']);
        });
        // Insert default expense categories
        DB::table('expense_categories')->insert([
            ['category_code' => 'RENT', 'category_name' => 'Rent', 'description' => 'Shop/Office rent'],
            ['category_code' => 'SALARY', 'category_name' => 'Salaries', 'description' => 'Staff salaries'],
            ['category_code' => 'ELECTRICITY', 'category_name' => 'Electricity', 'description' => 'Electricity bills'],
            ['category_code' => 'WATER', 'category_name' => 'Water', 'description' => 'Water bills'],
            ['category_code' => 'INTERNET', 'category_name' => 'Internet', 'description' => 'Internet and phone bills'],
            ['category_code' => 'MAINTENANCE', 'category_name' => 'Maintenance', 'description' => 'Shop maintenance'],
            ['category_code' => 'MARKETING', 'category_name' => 'Marketing', 'description' => 'Advertising and promotions'],
            ['category_code' => 'TRANSPORT', 'category_name' => 'Transport', 'description' => 'Delivery and transportation'],
            ['category_code' => 'STATIONERY', 'category_name' => 'Stationery', 'description' => 'Office supplies'],
            ['category_code' => 'OTHER', 'category_name' => 'Other Expenses', 'description' => 'Miscellaneous expenses'],
        ]);
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->string('expense_number', 50)->unique();
            $table->date('expense_date');
            $table->foreignId('category_id')->constrained();
            $table->foreignId('branch_id')->constrained();
            // Amount
            $table->decimal('amount', 10, 2);
            $table->decimal('tax_amount', 10, 2)->default(0.00);
            $table->decimal('total_amount', 10, 2);
            // Payment
            $table->enum('payment_method', ['cash', 'card', 'bank_transfer', 'upi', 'cheque'])->default('cash');
            $table->string('payment_reference', 100)->nullable();
            $table->string('paid_to', 200)->nullable();
            // Description
            $table->text('description')->nullable();
            $table->string('receipt_image')->nullable();
            $table->json('supporting_documents')->nullable();
            // Approval
            $table->foreignId('approved_by')->nullable()->constrained('users');
            $table->foreignId('recorded_by')->constrained('users');
            // Recurring
            $table->boolean('is_recurring')->default(false);
            $table->enum('recurring_frequency', ['daily', 'weekly', 'monthly', 'quarterly', 'yearly'])->nullable();
            $table->date('recurring_end_date')->nullable();
            $table->timestamps();
            $table->index(['expense_date']);
            $table->index(['category_id', 'expense_date']);
            $table->index(['branch_id', 'expense_date']);
        });
    }

    public function up(): void
    {
        Schema::create('stock_transfers', function (Blueprint $table) {
            $table->id();
            $table->string('transfer_number', 50)->unique();
            $table->foreignId('from_branch_id')->constrained('branches');
            $table->foreignId('to_branch_id')->constrained('branches');
            $table->date('transfer_date');
            $table->date('expected_delivery_date')->nullable();
            $table->date('actual_delivery_date')->nullable();
            $table->integer('total_items');
            $table->decimal('total_value', 12, 2);
            $table->enum('status', ['pending', 'approved', 'packed', 'in_transit', 'received', 'cancelled', 'partial'])->default('pending');
            $table->enum('transfer_reason', ['stock_balancing', 'sale_demand', 'excess_stock', 'new_branch', 'return_to_warehouse', 'other'])->default('stock_balancing');
            $table->foreignId('initiated_by')->constrained('users');
            $table->foreignId('approved_by')->nullable()->constrained('users');
            $table->foreignId('packed_by')->nullable()->constrained('users');
            $table->foreignId('received_by')->nullable()->constrained('users');
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->index(['transfer_date']);
            $table->index(['status']);
            $table->index(['from_branch_id', 'to_branch_id']);
            $table->index(['initiated_by', 'transfer_date']);
        });
        Schema::create('stock_transfer_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transfer_id')->constrained('stock_transfers')->cascadeOnDelete();
            $table->foreignId('product_id')->constrained();
            $table->foreignId('variant_id')->nullable()->constrained('product_variants');
            $table->integer('quantity');
            $table->integer('quantity_sent')->default(0);
            $table->integer('quantity_received')->default(0);
            $table->decimal('unit_cost', 10, 2);
            $table->decimal('total_cost', 10, 2);
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->index(['transfer_id', 'product_id']);
        });
    }

    public function up(): void
    {
        Schema::create('report_templates', function (Blueprint $table) {
            $table->id();
            $table->string('template_name', 100);
            $table->enum('report_type', ['sales', 'inventory', 'customer', 'staff', 'financial', 'purchase', 'expense', 'profit_loss', 'balance_sheet', 'custom']);
            $table->json('filters')->nullable();
            $table->json('columns')->nullable();
            $table->string('sort_by', 50)->nullable();
            $table->enum('sort_order', ['asc', 'desc'])->default('desc');
            $table->string('group_by', 50)->nullable();
            $table->string('time_range', 50)->nullable();
            $table->boolean('is_default')->default(false);
            $table->boolean('is_public')->default(false);
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
            $table->unique(['template_name', 'created_by']);
        });
        Schema::create('saved_reports', function (Blueprint $table) {
            $table->id();
            $table->string('report_name', 100);
            $table->string('report_type', 50);
            $table->json('data')->nullable();
            $table->date('generated_date');
            $table->time('generated_time');
            $table->foreignId('generated_by')->constrained('users');
            $table->json('parameters')->nullable();
            $table->string('file_path')->nullable();
            $table->enum('file_format', ['pdf', 'excel', 'csv', 'html'])->default('pdf');
            $table->integer('download_count')->default(0);
            $table->timestamps();
            $table->index(['report_type', 'generated_date']);
            $table->index(['generated_by', 'generated_date']);
        });
        Schema::create('kpis', function (Blueprint $table) {
            $table->id();
            $table->string('kpi_name', 100);
            $table->string('kpi_code', 50)->unique();
            $table->text('description')->nullable();
            $table->text('calculation_formula')->nullable();
            $table->decimal('target_value', 12, 2)->nullable();
            $table->string('unit', 20)->nullable();
            $table->enum('frequency', ['daily', 'weekly', 'monthly', 'quarterly', 'yearly'])->default('daily');
            $table->string('department', 50)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->index(['kpi_code']);
        });
        Schema::create('kpi_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kpi_id')->constrained();
            $table->foreignId('branch_id')->nullable()->constrained();
            $table->date('period_date');
            $table->decimal('actual_value', 12, 2);
            $table->decimal('target_value', 12, 2)->nullable();
            $table->decimal('variance', 12, 2)->nullable();
            $table->decimal('variance_percentage', 5, 2)->nullable();
            $table->text('notes')->nullable();
            $table->timestamp('recorded_at')->useCurrent();
            $table->timestamps();
            $table->unique(['kpi_id', 'branch_id', 'period_date']);
            $table->index(['kpi_id', 'period_date']);
            $table->index(['branch_id', 'kpi_id', 'period_date']);
        });
    }

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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('notification_type', 50);
            $table->string('title', 200);
            $table->text('message');
            $table->json('data')->nullable();
            $table->boolean('is_read')->default(false);
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
            $table->index(['user_id', 'is_read', 'created_at']);
            $table->index(['notification_type', 'created_at']);
        });
    }

    public function up(): void
    {
        Schema::create('login_attempts', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address', 45);
            $table->string('username', 100);
            $table->boolean('success')->default(false);
            $table->timestamp('attempted_at')->useCurrent();
            $table->text('user_agent')->nullable();
            $table->timestamps();
            $table->index(['ip_address']);
            $table->index(['username']);
            $table->index(['attempted_at']);
        });
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('action', 100);
            $table->string('entity_type', 50);
            $table->unsignedBigInteger('entity_id')->nullable();
            $table->json('old_values')->nullable();
            $table->json('new_values')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->foreignId('branch_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
            $table->index(['user_id', 'action']);
            $table->index(['entity_type', 'entity_id', 'created_at']);
            $table->index(['created_at']);
            $table->index(['branch_id', 'created_at']);
        });
        Schema::create('backups', function (Blueprint $table) {
            $table->id();
            $table->string('backup_name', 100);
            $table->string('file_path');
            $table->bigInteger('file_size')->nullable();
            $table->enum('backup_type', ['full', 'partial', 'incremental'])->default('full');
            $table->enum('status', ['pending', 'in_progress', 'completed', 'failed'])->default('pending');
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->timestamps();
            $table->timestamp('completed_at')->nullable();
            $table->index(['created_at']);
            $table->index(['status', 'created_at']);
        });
        Schema::create('maintenance_logs', function (Blueprint $table) {
            $table->id();
            $table->string('task_name', 100);
            $table->enum('task_type', ['cleanup', 'optimization', 'backup', 'update', 'other'])->default('other');
            $table->enum('status', ['pending', 'running', 'completed', 'failed'])->default('pending');
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->integer('duration_seconds')->nullable();
            $table->text('details')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->timestamps();
            $table->index(['created_at']);
            $table->index(['task_type', 'status', 'created_at']);
        });
    }

   

// Create user_branches pivot table
        Schema::create('user_branches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('branch_id')->constrained()->cascadeOnDelete();
            $table->boolean('is_default')->default(false);
            $table->timestamp('assigned_at')->useCurrent();
            $table->foreignId('assigned_by')->nullable()->constrained('users')->nullOnDelete();

            $table->unique(['user_id', 'branch_id']);
            $table->index(['user_id']);
            $table->index(['branch_id']);
        }); --}}







