<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $table = 'likefoto';
    protected $fillable = [
        'user_id',
        'foto_id'
    ];

    const UPDATED_AT = null;
}
