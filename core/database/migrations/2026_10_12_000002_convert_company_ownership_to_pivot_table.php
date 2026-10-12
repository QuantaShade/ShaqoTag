<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('company_user', function (Blueprint $table) {
            $table->foreignId('company_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->primary(['company_id', 'user_id']);
            $table->timestamps();
        });

        $now = now();

        DB::table('companies')
            ->whereNotNull('user_id')
            ->orderBy('id')
            ->get(['id', 'user_id'])
            ->each(function ($company) use ($now) {
                DB::table('company_user')->insert([
                    'company_id' => $company->id,
                    'user_id' => $company->user_id,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            });

        Schema::table('companies', function (Blueprint $table) {
            $table->dropConstrainedForeignId('user_id');
        });
    }

    public function down(): void
    {
        $sharedCompanies = DB::table('company_user')
            ->select('company_id')
            ->groupBy('company_id')
            ->havingRaw('COUNT(*) > 1')
            ->exists();

        if ($sharedCompanies) {
            throw new RuntimeException(
                'Cannot roll back company_user while a company is associated with multiple clients.'
            );
        }

        Schema::table('companies', function (Blueprint $table) {
            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();
        });

        DB::table('company_user')->get(['company_id', 'user_id'])->each(function ($association) {
            DB::table('companies')
                ->where('id', $association->company_id)
                ->update(['user_id' => $association->user_id]);
        });

        Schema::drop('company_user');
    }
};
