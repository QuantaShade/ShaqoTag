<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('job_applications')
            ->whereNull('user_id')
            ->orderBy('id')
            ->chunkById(100, function ($applications): void {
                foreach ($applications as $application) {
                    $userId = DB::table('users')
                        ->where('email', $application->applicant_email)
                        ->value('id');

                    if ($userId) {
                        DB::table('job_applications')
                            ->where('id', $application->id)
                            ->update(['user_id' => $userId]);
                    }
                }
            });
    }

    public function down(): void
    {
    }
};
