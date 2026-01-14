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

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_logs_tables');
    }
};
