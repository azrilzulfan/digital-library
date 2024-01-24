<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Koleksi extends Model
{
    use HasFactory;

    protected $table = 'koleksi_pribadi';

    protected $fillable = [
        'users_id',
        'peminjaman_id',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'peminjaman_id');
    }
}
