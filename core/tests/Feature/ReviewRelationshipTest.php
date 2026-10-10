<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\Review;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReviewRelationshipTest extends TestCase
{
    use RefreshDatabase;

    public function test_client_can_review_a_freelancer_who_applied_to_their_job(): void
    {
        [$client, $freelancer, $job, $application] = $this->buildApplicationFixture();

        $this->actingAs($client)
            ->get(route('reviews.create', ['job_id' => $job->id]))
            ->assertOk()
            ->assertSee($freelancer->name)
            ->assertSee($job->title);

        $response = $this->actingAs($client)
            ->post(route('reviews.store'), [
                'application_id' => $application->id,
                'rating' => 5,
                'comment' => 'Excellent work.',
            ]);

        $review = Review::query()->firstOrFail();

        $response->assertRedirect(route('reviews.show', $review));
        $this->assertSame($client->id, $review->reviewer->id);
        $this->assertSame($freelancer->id, $review->user->id);
        $this->assertTrue($application->refresh()->review->is($review));
        $this->assertSame($job->id, $review->job_id);
    }

    public function test_client_cannot_review_an_applicant_to_another_clients_job(): void
    {
        [$client, , , $application] = $this->buildApplicationFixture();
        $otherClient = User::factory()->create(['role' => 'client']);

        $this->actingAs($otherClient)
            ->post(route('reviews.store'), [
                'application_id' => $application->id,
                'rating' => 5,
                'comment' => 'Not authorized.',
            ])
            ->assertForbidden();

        $this->assertDatabaseCount('reviews', 0);
        $this->assertCount(0, $client->reviewsGiven);
    }

    public function test_freelancer_cannot_create_reviews(): void
    {
        [, $freelancer, , $application] = $this->buildApplicationFixture();

        $this->actingAs($freelancer)
            ->get(route('reviews.create'))
            ->assertForbidden();

        $this->actingAs($freelancer)
            ->post(route('reviews.store'), [
                'application_id' => $application->id,
                'rating' => 4,
                'comment' => 'Review.',
            ])
            ->assertForbidden();

        $this->assertDatabaseCount('reviews', 0);
    }

    public function test_client_cannot_review_the_same_application_twice(): void
    {
        [$client, $freelancer, $job, $application] = $this->buildApplicationFixture();

        Review::create([
            'application_id' => $application->id,
            'job_id' => $job->id,
            'reviewer_id' => $client->id,
            'user_id' => $freelancer->id,
            'reviewer_name' => $client->name,
            'rating' => 4,
            'comment' => 'Good work.',
        ]);

        $this->actingAs($client)
            ->post(route('reviews.store'), [
                'application_id' => $application->id,
                'rating' => 5,
                'comment' => 'Another review.',
            ])
            ->assertSessionHasErrors('application_id');

        $this->assertDatabaseCount('reviews', 1);
    }

    private function buildApplicationFixture(): array
    {
        $client = User::factory()->create(['role' => 'client']);
        $freelancer = User::factory()->create(['role' => 'freelancer']);
        $category = Category::create([
            'name' => 'Design',
            'slug' => 'design',
        ]);
        $job = Job::create([
            'user_id' => $client->id,
            'category_id' => $category->id,
            'title' => 'Design a landing page',
            'description' => 'Create a responsive landing page.',
            'budget' => 500,
            'type' => 'fixed',
            'status' => 'open',
            'workplace_type' => 'remote',
        ]);
        $application = JobApplication::create([
            'job_id' => $job->id,
            'user_id' => $freelancer->id,
            'applicant_name' => $freelancer->name,
            'applicant_email' => $freelancer->email,
            'cover_letter' => 'I have relevant experience.',
            'status' => 'pending',
        ]);

        return [$client, $freelancer, $job, $application];
    }
}
