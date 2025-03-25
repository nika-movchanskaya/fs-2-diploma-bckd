<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Seat;

class SeatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // IMAX (10x15)
        for ($y = 1; $y <= 15; $y++) {
            for ($x = 1; $x <= 10; $x++) {
                Seat::create([
                    'hall_id' => 1,
                    'film_session_id' => 1,
                    'index_x' => $x,
                    'index_y' => $y,
                    'is_vip' => ($y <= 3), // First 3 rows VIP
                    'status' => 'available',
                ]);
            }
        }
        //IMAX (10x15)
        for ($y = 1; $y <= 15; $y++) {
            for ($x = 1; $x <= 10; $x++) {
                Seat::create([
                    'hall_id' => 1,
                    'film_session_id' => 2,
                    'index_x' => $x,
                    'index_y' => $y,
                    'is_vip' => ($y <= 2),
                    'status' => 'available',
                ]);
            }
        }

        //Kinoteka (12x18)
        for ($y = 1; $y <= 18; $y++) {
            for ($x = 1; $x <= 12; $x++) {
                Seat::create([
                    'hall_id' => 1,
                    'film_session_id' => 4,
                    'index_x' => $x,
                    'index_y' => $y,
                    'is_vip' => ($y <= 4),
                    'status' => 'available',
                ]);
            }
        }
    }
}
