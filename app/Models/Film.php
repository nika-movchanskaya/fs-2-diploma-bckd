<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'origin', 'duration', 'image'];

    public function film_sessions()
    {
        return $this->hasMany(FilmSession::class);
    }
}
