<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = ['qr_code', 'film_session_id', 'seat_ids'];

    public function session()
    {
        return $this->belongsTo(FilmSession::class);
    }

    public function seat()
    {
        return $this->belongsTo(Seat::class);
    }
}
