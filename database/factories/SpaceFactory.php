<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Space;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Space>
 */
class SpaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Space::class;

    public function definition(): array
    {
        $area = $this->faker->randomElement(['P0', 'C1', 'C2']);
        $size = $this->faker->randomElement(['Pequeño', 'Medio', 'Grande']);
        $number = $this->faker->unique()->numberBetween(1, 50);

        return [
            'location_code' => "{$area}-{$number}",
            'location_area' => $area,
            'space_size' => $size,
        ];
    }
}
