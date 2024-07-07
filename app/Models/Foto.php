<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    use HasFactory;

    protected $table = 'foto';
    protected $fillable = [
        'album_id',
        'user_id',
        'judul_foto',
        'deskripsi_foto',
        'lokasi_file',
    ];

    public function album()
    {
        return $this->belongsTo(Album::class, 'album_id', 'id');
    }

    public function like()
    {
        return $this->hasMany(Like::class, 'foto_id');
    }

    public function komentar()
    {
        return $this->hasMany(Komentar::class, 'foto_id');
    }
}
