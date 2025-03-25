<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FilmSession;

class SessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FilmSession::insert([
            ['film_id' => 1, 'hall_id' => 1, 'date' => date('Y-m-d'), 'start_time' => '14:00', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
            ['film_id' => 1, 'hall_id' => 1, 'date' => date('Y-m-d'), 'start_time' => '16:00', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
            ['film_id' => 2, 'hall_id' => 1, 'date' => date('Y-m-d'), 'start_time' => '20:00', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
            ['film_id' => 3, 'hall_id' => 2, 'date' => date('Y-m-d'), 'start_time' => '12:00', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
            ['film_id' => 3, 'hall_id' => 2, 'date' => date('Y-m-d'), 'start_time' => '15:00', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
            ['film_id' => 3, 'hall_id' => 1, 'date' => date('Y-m-d'), 'start_time' => '12:00', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
            ['film_id' => 1, 'hall_id' => 2, 'date' => now()->addDay()->toDateString(), 'start_time' => '12:00', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
            ['film_id' => 2, 'hall_id' => 2, 'date' => now()->addDay()->toDateString(), 'start_time' => '16:00', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
            ['film_id' => 3, 'hall_id' => 1, 'date' => now()->addDays(2)->toDateString(), 'start_time' => '18:00', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
            ['film_id' => 4, 'hall_id' => 2, 'date' => now()->addDays(2)->toDateString(), 'start_time' => '20:00', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
            ['film_id' => 5, 'hall_id' => 1, 'date' => now()->addDays(2)->toDateString(), 'start_time' => '22:00', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
