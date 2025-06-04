<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Space;

class SpaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ejemplo: crear 80 espacios
        $spaces = [];

        // Ejemplo: 40 en P0, 20 en C1, 20 en C2
        foreach (['P0' => 40, 'C1' => 20, 'C2' => 20] as $area => $count) {
            for ($i = 1; $i <= $count; $i++) {
                $spaces[] = [
                    'location_code' => "{$area}-{$i}",
                    'location_area' => $area,
                    'space_size' => fake()->randomElement(['Pequeño', 'Medio', 'Grande']),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        Space::insert($spaces);
    }
}
