<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Price;

class PriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Price::insert([
            ['hall_id' => 1, 'regular' => 10.00, 'vip' => 20.00, 'created_at' => now(), 'updated_at' => now()],
            ['hall_id' => 2, 'regular' => 12.00, 'vip' => 25.00, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
