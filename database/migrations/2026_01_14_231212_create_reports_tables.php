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

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports_tables');
    }
};
