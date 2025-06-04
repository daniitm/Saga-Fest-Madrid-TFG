<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Turn;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Turn>
 */
class TurnFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Turn::class;

    public function definition(): array
    {
        // Fechas posibles (ajusta a tus necesidades)
        $date = $this->faker->dateTimeBetween('2025-07-25', '2025-07-27')->format('Y-m-d');
        $name = $this->faker->randomElement(['Mañana', 'Tarde']);

        // Horarios según el nombre del turno y la fecha
        if ($name === 'Mañana') {
            $start = '09:00:00';
            $end = '14:00:00';
        } else {
            // El 27 por la tarde es especial
            $start = '16:00:00';
            $end = ($date === '2025-07-27') ? '19:00:00' : '21:00:00';
        }

        return [
            'date' => $date,
            'name' => $name,
            'start_time' => $start,
            'end_time' => $end,
        ];
    }
}
