<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hall extends Model
{
    use HasFactory;
    
    protected $fillable = ['name', 'x', 'y'];

    public function film_sessions()
    {
        return $this->hasMany(FilmSession::class);
    }

    public function seats()
    {
        return $this->hasMany(Seat::class);
    }

    public function price()
    {
        return $this->hasOne(Price::class);
    }
}
