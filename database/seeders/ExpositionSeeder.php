<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Exposition;
use App\Models\Event;
use App\Models\Space;
use App\Models\Schedule;
use App\Models\Turn;

class ExpositionSeeder extends Seeder
{
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        $standSizes = ['Pequeño','Medio','Grande'];
        $standCategories = ['Editoriales','Productoras / Plataformas','Videojuegos','Merchandising','Artistas / Creadores','Cosplay','Educación','Asociaciones'];
        $dates = ['2025-07-25', '2025-07-26', '2025-07-27'];
        $turnos = [
            'manana' => ['start' => '09:00', 'end' => '13:00', 'name' => 'Mañana'],
            'tarde' => ['start' => '16:00', 'end' => '20:00', 'name' => 'Tarde'],
        ];
        $maxTries = 30;
        $expoCount = 0;
        $maxExpos = 30;
        while ($expoCount < $maxExpos) {
            $standSize = $faker->randomElement($standSizes);
            $standCategory = $faker->randomElement($standCategories);
            $date = $faker->randomElement($dates);
            $turnKey = $faker->randomElement(['manana', 'tarde']);
            $turn = $turnos[$turnKey];
            $turnModel = Turn::where('date', $date)->where('name', $turn['name'])->first();
            if (!$turnModel) continue;
            $schedule = Schedule::where('turn_id', $turnModel->id)->first();
            if (!$schedule) continue;
            $turnStart = strtotime($turn['start']);
            $turnEnd = strtotime($turn['end']);
            $minDuration = 30 * 60;
            $maxDuration = 120 * 60;
            $tries = 0;
            $created = false;
            while ($tries < $maxTries && !$created) {
                $start = $faker->numberBetween($turnStart, $turnEnd - $minDuration);
                $duration = $faker->numberBetween($minDuration, min($maxDuration, $turnEnd - $start));
                $expoStart = date('H:i', $start);
                $expoEnd = date('H:i', $start + $duration);
                // Find busy spaces for this slot (events + expositions)
                $busySpaces = array_merge(
                    Event::whereHas('schedule.turn', function($q) use ($date, $turn) {
                        $q->where('date', $date)->where('name', $turn['name']);
                    })
                    ->where(function($q) use ($expoStart, $expoEnd) {
                        $q->whereBetween('event_start_time', [$expoStart, $expoEnd])
                          ->orWhereBetween('event_end_time', [$expoStart, $expoEnd])
                          ->orWhere(function($q2) use ($expoStart, $expoEnd) {
                              $q2->where('event_start_time', '<=', $expoStart)
                                 ->where('event_end_time', '>=', $expoEnd);
                          });
                    })
                    ->pluck('space_id')->toArray(),
                    Exposition::whereHas('schedule.turn', function($q) use ($date, $turn) {
                        $q->where('date', $date)->where('name', $turn['name']);
                    })
                    ->where(function($q) use ($expoStart, $expoEnd) {
                        $q->whereBetween('event_start_time', [$expoStart, $expoEnd])
                          ->orWhereBetween('event_end_time', [$expoStart, $expoEnd])
                          ->orWhere(function($q2) use ($expoStart, $expoEnd) {
                              $q2->where('event_start_time', '<=', $expoStart)
                                 ->where('event_end_time', '>=', $expoEnd);
                          });
                    })
                    ->pluck('space_id')->toArray()
                );
                $freeSpace = Space::where('space_size', $standSize)
                    ->whereNotIn('id', $busySpaces)
                    ->inRandomOrder()
                    ->first();
                if (!$freeSpace) {
                    $tries++;
                    continue;
                }
                $expo = Exposition::create([
                    'company_name' => $faker->company,
                    'contact_person' => $faker->name,
                    'email' => 'expo'.$expoCount.'@example.com',
                    'phone' => $faker->phoneNumber,
                    'website' => $faker->url,
                    'stand_category' => $standCategory,
                    'stand_size' => $standSize,
                    'wired_internet' => $faker->boolean,
                    'audio_sound_configuration' => $faker->boolean,
                    'event_start_time' => $expoStart,
                    'event_end_time' => $expoEnd,
                    'space_id' => $freeSpace->id,
                    'schedule_id' => $schedule->id,
                    'short_description' => $faker->realTextBetween(100, 255),
                    'special_requirements' => $faker->optional()->sentence(),
                    'additional_information' => $faker->optional()->sentence(),
                ]);
                $expoCount++;
                $created = true;
            }
        }
    }
}
