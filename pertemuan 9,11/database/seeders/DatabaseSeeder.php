<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // Password kedua user: "password" (dari UserFactory)
        $Adha = User::factory()->create([
            'name' => 'Adha Muddin',
            'email' => 'test@example.com',
        ]);

        $sari = User::factory()->create([
            'name' => 'Abdul Mukmin',
            'email' => 'abdul@example.com',
        ]);
        $nazril = User::factory()->create([
            'name' => 'Nazril',
            'email' => 'nazril@example.com',
        ]);

        Item::create([
            'user_id' => $Adha->id,
            'nama' => 'Sepeda Gunung',
            'deskripsi' => 'Sepeda bekas, kondisi baik, ukuran 26 inci.',
            'barang_dicari' => 'Laptop bekas',
        ]);

        Item::create([
            'user_id' => $Adha->id,
            'nama' => 'Buku Pemrograman Web',
            'deskripsi' => 'Kumpulan 5 buku PHP dan Laravel.',
            'barang_dicari' => 'Headset',
        ]);

        Item::create([
            'user_id' => $Abdul->id,
            'nama' => 'Kamera Mirrorless',
            'deskripsi' => 'Kamera bekas lengkap dengan lensa kit.',
            'barang_dicari' => 'Smartphone',
        ]);
    }
}