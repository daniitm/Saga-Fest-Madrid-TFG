<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Celebrity;

class CelebritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i < 20; $i++) {
            Celebrity::factory()->create([
                'email' => 'patient'.$i.'@example.com',
                'biography' => fake()->realText(1100, 3), // Biografía extensa (mínimo 1000 caracteres)
            ]);
        }
    }
}
