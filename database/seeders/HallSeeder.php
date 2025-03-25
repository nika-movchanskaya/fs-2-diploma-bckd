<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Hall;

class HallSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Hall::insert([
            ['name' => 'IMAX', 'x' => 10, 'y' => 15, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Kinoteka', 'x' => 12, 'y' => 18, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
