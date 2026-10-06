<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\Review;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $jobs = Job::all();

        if ($jobs->isEmpty()) {
            return;
        }

        foreach ($jobs->take(5) as $job) {
            Review::create([
                'job_id' => $job->id,
                'reviewer_name' => 'Alice Johnson',
                'rating' => 5,
                'comment' => 'Great experience working on this project! Clear guidelines and prompt communication.',
            ]);

            Review::create([
                'job_id' => $job->id,
                'reviewer_name' => 'Michael Smith',
                'rating' => 4,
                'comment' => 'Good project scope and realistic budget. Would work together again.',
            ]);
        }
    }
}
