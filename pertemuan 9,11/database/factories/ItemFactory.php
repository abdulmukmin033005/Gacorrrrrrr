<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'nama' => fake()->words(2, true),
            'deskripsi' => fake()->sentence(),
            'barang_dicari' => fake()->words(2, true),
            'status' => 'open',
        ];
    }
}