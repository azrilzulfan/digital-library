<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'buku';

    protected $fillable = [
        'judul',
        'foto',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'status_buku',
    ];

    public function kategoriBukuRelasi()
    {
        return $this->hasMany(KategoriBuku::class, 'buku_id');
    }

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'buku_id');
    }

    public function ulasan()
    {
        return $this->hasMany(Ulasan::class, 'buku_id');
    }
}
