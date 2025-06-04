<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Celebrity>
 */
class CelebrityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->firstName(),
            'surnames' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'biography' => $this->faker->paragraph(3),
            'category' => $this->faker->randomElement([
                'Actores / Actrices',
                'Dibujantes / Ilustradores',
                'Guionistas / Creadores',
                'Desarrolladores / Diseñadores',
                'Productores / Directores / Compositores',
                'Influencers / YouTubers / Streamers',
            ]),
            'website' => $this->faker->optional()->url(),
        ];
    }
}
