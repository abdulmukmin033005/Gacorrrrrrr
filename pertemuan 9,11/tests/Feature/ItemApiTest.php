<?php

namespace Tests\Feature;

use App\Models\Item;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ItemApiTest extends TestCase
{
    use RefreshDatabase;

    private function tokenFor(User $user): string
    {
        return auth('api')->login($user);
    }

    public function test_tanpa_token_ditolak(): void
    {
        $this->getJson('/api/items')->assertStatus(401);
    }

    public function test_token_invalid_ditolak(): void
    {
        $this->withHeader('Authorization', 'Bearer token-asal-asalan')
            ->getJson('/api/items')
            ->assertStatus(401);
    }

    public function test_token_valid_dapat_melihat_items(): void
    {
        $user = User::factory()->create();
        Item::factory()->create(['user_id' => $user->id, 'nama' => 'Sepeda']);

        $this->withHeader('Authorization', 'Bearer '.$this->tokenFor($user))
            ->getJson('/api/items')
            ->assertOk()
            ->assertJsonFragment(['nama' => 'Sepeda']);
    }

    public function test_user_dapat_menawarkan_barang(): void
    {
        $user = User::factory()->create();

        $this->withHeader('Authorization', 'Bearer '.$this->tokenFor($user))
            ->postJson('/api/items', [
                'nama' => 'Kamera',
                'deskripsi' => 'Kamera bekas',
                'barang_dicari' => 'Smartphone',
            ])->assertCreated();

        $this->assertDatabaseHas('items', ['nama' => 'Kamera', 'user_id' => $user->id]);
    }

    public function test_bukan_pemilik_tidak_boleh_menghapus(): void
    {
        $pemilik = User::factory()->create();
        $lain = User::factory()->create();
        $item = Item::factory()->create(['user_id' => $pemilik->id]);

        $this->withHeader('Authorization', 'Bearer '.$this->tokenFor($lain))
            ->deleteJson('/api/items/'.$item->id)
            ->assertStatus(403);
    }
}