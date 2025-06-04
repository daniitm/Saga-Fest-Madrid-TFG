<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Schedule;
use App\Models\Turn;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Schedule>
 */
class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Schedule::class;
    
    public function definition(): array
    {
        return [
            'turn_id' => Turn::factory(), // Relación con turno
            'break' => $this->faker->numberBetween(5, 20),
        ];
    }
}
