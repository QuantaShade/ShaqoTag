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
        Schema::create('job_posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // Job category
            $table->foreignId('category_id')
                ->constrained('categories')
                ->restrictOnDelete();

            // Basic information
            $table->string('title');
            $table->longText('description');

            // Budget and payment type
            $table->decimal('budget', 10, 2);
            $table->enum('type', ['fixed', 'hourly'])
                ->default('fixed');

            // Job status
            $table->enum('status', [
                'draft',
                'open',
                'in_progress',
                'completed',
                'cancelled',
                'closed',
            ])->default('open');

            // Required skills stored as JSON
            $table->json('skills')->nullable();

            // Optional job details
            $table->string('location')->nullable();
            $table->enum('workplace_type', [
                'remote',
                'onsite',
                'hybrid',
            ])->default('remote');

            $table->date('deadline')->nullable();

            // Indexes for common filters
            $table->index(['status', 'created_at']);
            $table->index(['category_id', 'status']);
            $table->index(['user_id', 'status']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_posts');
    }
};
