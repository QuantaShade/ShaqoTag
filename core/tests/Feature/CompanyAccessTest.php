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
        $company = $client->companies()->create(['name' => 'Example Company']);
        $anotherClient = User::factory()->create(['role' => 'client']);
        $anotherClient->companies()->create(['name' => 'Another Client Company']);

        $this->actingAs($client)
            ->get(route('companies.index'))
            ->assertOk()
            ->assertSee('Companies')
            ->assertSee($company->name)
            ->assertDontSee('Another Client Company')
            ->assertDontSee('onsubmit="return confirm', false);

        $this->actingAs($client)
            ->get(route('jobs.index'))
            ->assertSee(route('companies.index'));
    }

    public function test_client_can_create_a_company_associated_with_their_account(): void
    {
        $client = User::factory()->create(['role' => 'client']);

        $this->actingAs($client)
            ->post(route('companies.store'), [
                'name' => 'My Company',
                'email' => 'contact@example.com',
            ])
            ->assertRedirect();

        $company = Company::query()->where('name', 'My Company')->firstOrFail();

        $this->assertSame($client->id, $company->user_id);
        $this->assertTrue($company->client->is($client));
        $this->assertTrue($client->companies->contains($company));
    }

    public function test_client_cannot_manage_another_clients_company(): void
    {
        $owner = User::factory()->create(['role' => 'client']);
        $otherClient = User::factory()->create(['role' => 'client']);
        $company = $owner->companies()->create(['name' => 'Private Company']);

        $this->actingAs($otherClient)
            ->get(route('companies.show', $company))
            ->assertForbidden();

        $this->get(route('companies.edit', $company))
            ->assertForbidden();

        $this->put(route('companies.update', $company), ['name' => 'Changed Company'])
            ->assertForbidden();

        $this->delete(route('companies.destroy', $company))
            ->assertForbidden();

        $this->assertDatabaseHas('companies', [
            'id' => $company->id,
            'name' => 'Private Company',
            'user_id' => $owner->id,
        ]);
    }

    public function test_freelancer_cannot_access_company_routes_or_see_company_navigation(): void
    {
        $freelancer = User::factory()->create(['role' => 'freelancer']);
        $client = User::factory()->create(['role' => 'client']);
        $company = $client->companies()->create(['name' => 'Example Company']);

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
