<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;

    protected $fillable = ['hall_id', 'film_session_id', 'index_x', 'index_y', 'is_vip', 'status'];

    public function hall()
    {
        return $this->belongsTo(Hall::class);
    }

    public function filmSession()
    {
        return $this->belongsTo(FilmSession::class);
    }
}
