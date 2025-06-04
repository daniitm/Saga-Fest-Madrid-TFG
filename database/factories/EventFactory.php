<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Event;
use App\Models\Space;
use App\Models\Schedule;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Event::class;

    public function definition(): array
    {
        $start = $this->faker->time('H:i:s', '20:00:00');
        $end = \Carbon\Carbon::parse($start)->addMinutes($this->faker->numberBetween(30, 120))->format('H:i:s');

        return [
            'company_name' => $this->faker->company(),
            'contact_person' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'website' => $this->faker->optional()->url(),
            'stand_category' => $this->faker->randomElement([
                'Editoriales',
                'Productoras / Plataformas',
                'Videojuegos',
                'Merchandising',
                'Artistas / Creadores',
                'Cosplay',
                'Educación',
                'Asociaciones'
            ]),
            'stand_size' => $this->faker->randomElement(['Pequeño', 'Medio', 'Grande']),
            'wired_internet' => $this->faker->boolean(),
            'audio_sound_configuration' => $this->faker->boolean(),
            'event_start_time' => $start,
            'event_end_time' => $end,
            'space_id' => Space::factory(),
            'schedule_id' => Schedule::factory(),
        ];
    }
}
