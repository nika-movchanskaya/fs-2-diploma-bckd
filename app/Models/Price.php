<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

    class Price extends Model
    {
        use HasFactory;

        protected $fillable = ['hall_id', 'regular', 'vip'];
    
        public function hall()
        {
            return $this->belongsTo(Hall::class);
        }
    }
