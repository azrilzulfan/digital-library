<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    use HasFactory;

    protected $table = 'ulasan_buku';

    protected $fillable = [
        'buku_id',
        'users_id',
        'ulasan',
        'rating',
    ];

    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
