<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Item extends Model
{
    use HasFactory;

    // Barang yang ditawarkan untuk barter
    protected $fillable = [
        'user_id',
        'nama',
        'deskripsi',
        'barang_dicari',
        'status',
    ];

    // Pemilik barang
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}