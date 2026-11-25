<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_dengan_kredensial_benar_mengembalikan_jwt(): void
    {
        User::factory()->create(['email' => 'budi@example.com']);

        $this->postJson('/api/login', [
            'email' => 'budi@example.com',
            'password' => 'password',
        ])->assertOk()
          ->assertJsonStructure(['access_token', 'token_type', 'user']);
    }

    public function test_login_dengan_password_salah_ditolak(): void
    {
        User::factory()->create(['email' => 'budi@example.com']);

        $this->postJson('/api/login', [
            'email' => 'budi@example.com',
            'password' => 'salah',
        ])->assertStatus(401);
    }

    public function test_login_dengan_user_tidak_ditemukan_ditolak(): void
    {
        $this->postJson('/api/login', [
            'email' => 'tidakada@example.com',
            'password' => 'password',
        ])->assertStatus(401);
    }
}