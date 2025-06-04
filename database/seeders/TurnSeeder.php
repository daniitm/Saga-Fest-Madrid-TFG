<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Turn;

class TurnSeeder extends Seeder
{
    public function run(): void
    {
        $days = ['2025-07-25', '2025-07-26', '2025-07-27'];
        $turns = [
            ['name' => 'Mañana', 'start_time' => '09:00', 'end_time' => '13:00'],
            ['name' => 'Tarde', 'start_time' => '16:00', 'end_time' => '20:00'],
        ];

        foreach ($days as $date) {
            foreach ($turns as $turn) {
                Turn::create([
                    'date' => $date,
                    'name' => $turn['name'],
                    'start_time' => $turn['start_time'],
                    'end_time' => $turn['end_time'],
                ]);
            }
        }
    }
}