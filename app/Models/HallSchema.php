<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HallSchema extends Model
{
    use HasFactory;

    protected $fillable = ['hall_id', 'index_x', 'index_y', 'status'];

    public function hall()
    {
        return $this->belongsTo(Hall::class);
    }
}
