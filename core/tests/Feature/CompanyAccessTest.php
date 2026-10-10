<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CompanyAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_client_can_view_companies_and_the_companies_navigation_link(): void
    {
        $client = User::factory()->create(['role' => 'client']);
        $company = Company::create(['name' => 'Example Company']);

        $this->actingAs($client)
            ->get(route('companies.index'))
            ->assertOk()
            ->assertSee('Companies')
            ->assertSee($company->name)
            ->assertDontSee('onsubmit="return confirm', false);

        $this->actingAs($client)
            ->get(route('jobs.index'))
            ->assertSee(route('companies.index'));
    }

    public function test_freelancer_cannot_access_company_routes_or_see_company_navigation(): void
    {
        $freelancer = User::factory()->create(['role' => 'freelancer']);
        $company = Company::create(['name' => 'Example Company']);

        $this->actingAs($freelancer)
            ->get(route('companies.index'))
            ->assertForbidden();

        $this->actingAs($freelancer)
            ->get(route('companies.create'))
            ->assertForbidden();

        $this->actingAs($freelancer)
            ->get(route('companies.show', $company))
            ->assertForbidden();

        $this->actingAs($freelancer)
            ->get(route('companies.edit', $company))
            ->assertForbidden();

        $this->actingAs($freelancer)
            ->post(route('companies.store'), ['name' => 'Unauthorized Company'])
            ->assertForbidden();

        $this->actingAs($freelancer)
            ->put(route('companies.update', $company), ['name' => 'Unauthorized Update'])
            ->assertForbidden();

        $this->actingAs($freelancer)
            ->delete(route('companies.destroy', $company))
            ->assertForbidden();

        $this->actingAs($freelancer)
            ->get(route('jobs.index'))
            ->assertDontSee('href="'.route('companies.index').'"', false);

        $this->actingAs($freelancer)
            ->get(route('dashboard.freelancer'))
            ->assertDontSee('Companies')
            ->assertDontSee(route('companies.index'));

        $this->assertDatabaseHas('companies', ['id' => $company->id, 'name' => 'Example Company']);
        $this->assertDatabaseMissing('companies', ['name' => 'Unauthorized Company']);
    }
}
