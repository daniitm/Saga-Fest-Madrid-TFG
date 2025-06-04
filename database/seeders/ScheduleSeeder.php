<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Schedule;
use App\Models\Turn;

class ScheduleSeeder extends Seeder
{
    public function run(): void
    {
        $break = 15; // Valor único para todos los horarios
        $turns = Turn::all();
        foreach ($turns as $turn) {
            Schedule::create([
                'turn_id' => $turn->id,
                'break' => $break,
            ]);
        }
    }
}