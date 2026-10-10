<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Job;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class JobOwnershipTest extends TestCase
{
    use RefreshDatabase;

    public function test_companies_index_loads_with_the_companies_table(): void
    {
        $client = User::factory()->create(['role' => 'client']);

        $this->actingAs($client)
            ->get(route('companies.index'))
            ->assertOk();
    }

    public function test_job_owner_can_edit_update_and_delete_their_job(): void
    {
        $owner = User::factory()->create(['role' => 'client']);
        $job = $this->createJob($owner);

        $this->actingAs($owner)
            ->get(route('jobs.edit', $job))
            ->assertOk();

        $this->actingAs($owner)
            ->get(route('jobs.show', $job))
            ->assertSee('Edit Job')
            ->assertSee('Delete Job');

        $this->actingAs($owner)
            ->get(route('jobs.index'))
            ->assertSee('Edit</a>', false)
            ->assertSee('Delete</button>', false)
            ->assertDontSee('onsubmit="return confirm', false);

        $this->actingAs($owner)
            ->put(route('jobs.update', $job), $this->validJobData())
            ->assertRedirect(route('jobs.show', $job));

        $this->actingAs($owner)
            ->delete(route('jobs.destroy', $job))
            ->assertRedirect(route('jobs.index'));

        $this->assertDatabaseMissing('job_posts', ['id' => $job->id]);
    }

    public function test_another_client_cannot_edit_update_or_delete_someone_elses_job(): void
    {
        $owner = User::factory()->create(['role' => 'client']);
        $otherClient = User::factory()->create(['role' => 'client']);
        $job = $this->createJob($owner);

        $this->actingAs($otherClient)
            ->get(route('jobs.edit', $job))
            ->assertForbidden();

        $this->actingAs($otherClient)
            ->put(route('jobs.update', $job), $this->validJobData())
            ->assertForbidden();

        $this->actingAs($otherClient)
            ->delete(route('jobs.destroy', $job))
            ->assertForbidden();

        $this->assertDatabaseHas('job_posts', ['id' => $job->id]);
    }

    public function test_freelancer_cannot_edit_update_or_delete_a_job(): void
    {
        $owner = User::factory()->create(['role' => 'client']);
        $freelancer = User::factory()->create(['role' => 'freelancer']);
        $job = $this->createJob($owner);

        $this->actingAs($freelancer)
            ->get(route('jobs.edit', $job))
            ->assertForbidden();

        $this->actingAs($freelancer)
            ->get(route('jobs.show', $job))
            ->assertDontSee('Edit Job')
            ->assertDontSee('Delete Job');

        $this->actingAs($freelancer)
            ->get(route('jobs.index'))
            ->assertDontSee('Edit</a>', false)
            ->assertDontSee('Delete</button>', false);

        $this->actingAs($freelancer)
            ->put(route('jobs.update', $job), $this->validJobData())
            ->assertForbidden();

        $this->actingAs($freelancer)
            ->delete(route('jobs.destroy', $job))
            ->assertForbidden();

        $this->assertDatabaseHas('job_posts', ['id' => $job->id]);
    }

    private function createJob(User $owner): Job
    {
        $category = Category::create([
            'name' => 'Design',
            'slug' => 'design',
        ]);

        return Job::create([
            'user_id' => $owner->id,
            'category_id' => $category->id,
            'title' => 'Design a landing page',
            'description' => 'Create a responsive landing page.',
            'budget' => 500,
            'type' => 'fixed',
            'status' => 'open',
            'skills' => ['Design'],
            'workplace_type' => 'remote',
        ]);
    }

    private function validJobData(): array
    {
        return [
            'title' => 'Updated landing page',
            'category_id' => Category::query()->value('id'),
            'description' => 'Updated responsive landing page details.',
            'budget' => 600,
            'type' => 'fixed',
            'status' => 'open',
            'skills' => 'Design, CSS',
            'workplace_type' => 'remote',
        ];
    }
}
