<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Dijalankan saat migrate: membuat tabel
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();                                   // kolom id (primary key)
            $table->foreignId('user_id')->constrained()     // relasi ke tabel users
                  ->cascadeOnDelete();
            $table->string('nama');                         // teks pendek
            $table->text('deskripsi');                      // teks panjang
            $table->string('barang_dicari');
            $table->string('status')->default('open');      // nilai bawaan
            $table->timestamps();                           // created_at dan updated_at
        });
    }

    // Dijalankan saat rollback: menghapus tabel
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};