<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Database\Seeder;

class JobApplicationSeeder extends Seeder
{
    public function run(): void
    {
        $jobs = Job::all();

        if ($jobs->isEmpty()) {
            return;
        }

        foreach ($jobs->take(5) as $job) {
            JobApplication::create([
                'job_id' => $job->id,
                'applicant_name' => 'John Doe',
                'applicant_email' => 'john@example.com',
                'cover_letter' => 'I am very interested in this job position and have 5 years of experience in this domain.',
                'expected_salary' => $job->budget,
                'status' => 'pending',
            ]);

            JobApplication::create([
                'job_id' => $job->id,
                'applicant_name' => 'Sarah Connor',
                'applicant_email' => 'sarah@example.com',
                'cover_letter' => 'I have extensively worked on similar projects. Here is my portfolio.',
                'expected_salary' => $job->budget * 0.9,
                'status' => 'reviewed',
            ]);
        }
    }
}
