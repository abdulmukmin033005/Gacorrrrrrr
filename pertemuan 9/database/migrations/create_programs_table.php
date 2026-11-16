<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Membuat tabel programs
    public function up(): void
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('deskripsi');
            $table->timestamps();
        });
    }

    // Menghapus tabel programs jika migration dibatalkan
    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};