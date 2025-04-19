<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\HallSchema;

class HallSchemaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //IMAX (10x15)
        for ($y = 1; $y <= 15; $y++) {
            for ($x = 1; $x <= 10; $x++) {
                HallSchema::create([
                    'hall_id' => 1,
                    'index_x' => $x,
                    'index_y' => $y,
                    'status' => $y <= 2 ? 'vip' : 'regular',
                ]);
            }
        }

        //Kinoteka (12x18)
        for ($y = 1; $y <= 18; $y++) {
            for ($x = 1; $x <= 12; $x++) {
                HallSchema::create([
                    'hall_id' => 2,
                    'index_x' => $x,
                    'index_y' => $y,
                    'status' => $y <= 4 ? 'vip' : 'regular',
                ]);
            }
        }
    }
}

