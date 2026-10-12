<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class JobApplicationSubmissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_freelancer_can_submit_an_application_without_supplying_status(): void
    {
        $freelancer = User::factory()->create(['role' => 'freelancer']);
        $job = $this->createJob();

        $this->actingAs($freelancer)
            ->get(route('applications.create', ['job_id' => $job->id]))
            ->assertOk()
            ->assertSee('Submit Application');

        $response = $this->actingAs($freelancer)
            ->post(route('applications.store'), [
                'job_id' => $job->id,
                'applicant_name' => $freelancer->name,
                'applicant_email' => $freelancer->email,
                'cover_letter' => 'I have the experience needed for this project.',
            ]);

        $application = JobApplication::query()->firstOrFail();

        $response->assertRedirect(route('applications.show', $application));
        $this->assertSame('pending', $application->status);
        $this->assertDatabaseHas('job_applications', [
            'id' => $application->id,
            'job_id' => $job->id,
            'user_id' => $freelancer->id,
            'applicant_email' => $freelancer->email,
            'status' => 'pending',
        ]);
        $this->assertTrue($application->user->is($freelancer));
    }

    public function test_client_cannot_open_the_application_form_and_is_not_shown_apply_links(): void
    {
        $client = User::factory()->create(['role' => 'client']);
        $job = $this->createJob();

        $this->actingAs($client)
            ->get(route('jobs.show', $job))
            ->assertOk()
            ->assertDontSee('Apply Now')
            ->assertDontSee('Apply for Job');

        $this->get(route('applications.create', ['job_id' => $job->id]))
            ->assertForbidden();
    }

    private function createJob(): Job
    {
        $client = User::factory()->create(['role' => 'client']);
        $category = Category::create([
            'name' => 'Design',
            'slug' => 'design',
        ]);

        return Job::create([
            'user_id' => $client->id,
            'category_id' => $category->id,
            'title' => 'Design a landing page',
            'description' => 'Create a responsive landing page.',
            'budget' => 500,
            'type' => 'fixed',
            'status' => 'open',
            'workplace_type' => 'remote',
        ]);
    }
}
