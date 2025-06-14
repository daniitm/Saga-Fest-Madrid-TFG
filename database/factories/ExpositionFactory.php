<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Exposition;
use App\Models\Space;
use App\Models\Schedule;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Exposition>
 */
class ExpositionFactory extends Factory
{
    protected $model = Exposition::class;

    public function definition(): array
    {
        $standCategories = ['Editoriales', 'Productoras / Plataformas', 'Videojuegos', 'Merchandising', 'Artistas / Creadores', 'Cosplay', 'Educación', 'Asociaciones'];
        $standSizes = ['Pequeño', 'Medio', 'Grande'];
        return [
            'company_name' => $this->faker->company,
            'contact_person' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'website' => $this->faker->url,
            'stand_category' => $this->faker->randomElement($standCategories),
            'stand_size' => $this->faker->randomElement($standSizes),
            'wired_internet' => $this->faker->boolean,
            'audio_sound_configuration' => $this->faker->boolean,
            'event_start_time' => $this->faker->time('H:i'),
            'event_end_time' => $this->faker->time('H:i'),
            'space_id' => null,
            'schedule_id' => null,
            'short_description' => $this->faker->realText(60),
            'special_requirements' => $this->faker->optional()->sentence(),
            'additional_information' => $this->faker->optional()->sentence(),
        ];
    }
}
