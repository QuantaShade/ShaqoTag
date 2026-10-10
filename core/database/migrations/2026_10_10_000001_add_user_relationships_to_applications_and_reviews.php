<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('job_applications', function (Blueprint $table) {
            $table->foreignId('user_id')
                ->nullable()
                ->after('job_id')
                ->constrained()
                ->nullOnDelete();
        });

        Schema::table('reviews', function (Blueprint $table) {
            $table->foreignId('application_id')
                ->nullable()
                ->after('job_id')
                ->unique()
                ->constrained('job_applications')
                ->cascadeOnDelete();
            $table->foreignId('reviewer_id')
                ->nullable()
                ->after('application_id')
                ->constrained('users')
                ->nullOnDelete();
            $table->foreignId('user_id')
                ->nullable()
                ->after('reviewer_id')
                ->constrained('users')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropForeign(['application_id']);
            $table->dropUnique(['application_id']);
            $table->dropForeign(['reviewer_id']);
            $table->dropForeign(['user_id']);
            $table->dropColumn(['application_id', 'reviewer_id', 'user_id']);
        });

        Schema::table('job_applications', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
