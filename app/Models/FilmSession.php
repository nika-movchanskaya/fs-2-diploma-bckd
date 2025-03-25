<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilmSession extends Model
{
    use HasFactory;

    protected $fillable = ['film_id', 'hall_id', 'date', 'start_time', 'status'];

    public function film()
    {
        return $this->belongsTo(Film::class);
    }

    public function hall()
    {
        return $this->belongsTo(Hall::class);
    }

    public function seats()
    {
        return $this->hasMany(Seat::class);
    }
}
