<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_index_page_loads(): void
    {
        User::factory()->create([
            'name' => 'Alice',
            'email' => 'alice@example.com',
        ]);

        $response = $this->get('/users');

        $response->assertOk();
        $response->assertSee('Alice');
    }

    public function test_user_can_be_created(): void
    {
        $response = $this->post('/users', [
            'name' => 'Budi',
            'email' => 'budi@example.com',
            'password' => 'secret123',
        ]);

        $response->assertRedirect('/users');
        $this->assertDatabaseHas('users', [
            'email' => 'budi@example.com',
        ]);
    }
}
