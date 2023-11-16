<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Role;
use Illuminate\Http\Response;
use Tests\TestCase;

class RoleTest extends TestCase
{
    use RefreshDatabase;

    public function testGetAllRole(): void
    {
        Role::factory(2)->create();

        $response = $this->get('api/roles');
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonCount(2);
    }

    public function testCreateRole(): void
    {
        $requestData = Role::factory()->make()->toArray();

        $response = $this->post('api/roles', $requestData);
        $response->assertStatus(Response::HTTP_CREATED);
        $this->assertDatabaseCount('roles', 1);
    }

    public function testShowRole(): void
    {
        $role = Role::factory()->create();

        $response = $this->get('api/roles/' . $role->id);
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonCount(1);
    }

    public function testUpdateRole(): void
    {
        $role = Role::factory()->create();
        $requestData = ['name' => 'Padre'];

        $response = $this->put('api/roles/' . $role->id, $requestData);
        $response->assertStatus(Response::HTTP_OK);
        $this->assertDatabaseCount('roles', 1);
        $this->assertDatabaseHas('roles', $requestData);
    }

    public function testDestroyRole(): void
    {
        $role = Role::factory()->create();

        $response = $this->delete('api/roles/' . $role->id);
        $response->assertStatus(Response::HTTP_OK);
        $this->assertDatabaseEmpty('roles');
    }
}
