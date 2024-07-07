<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    use HasFactory;

    protected $table = 'komentar';
    protected $fillable = [
        "foto_id",
        "user_id",
        "isi_komentar"
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function foto()
    {
        return $this->belongsTo(Foto::class, 'foto_id', 'id');
    }
}
