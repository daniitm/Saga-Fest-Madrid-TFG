<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\Space;
use App\Models\Schedule;
use App\Models\Turn;
use App\Models\Celebrity;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
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
        $celebrityIds = Celebrity::pluck('id')->toArray();
        $maxTries = 30; // Avoid infinite loops
        $eventCount = 0;
        $maxEvents = 30;
        while ($eventCount < $maxEvents) {
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
            $minDuration = 30 * 60; // 30 min
            $maxDuration = 120 * 60; // 2h
            $tries = 0;
            $created = false;
            while ($tries < $maxTries && !$created) {
                $start = $faker->numberBetween($turnStart, $turnEnd - $minDuration);
                $duration = $faker->numberBetween($minDuration, min($maxDuration, $turnEnd - $start));
                $eventStart = date('H:i', $start);
                $eventEnd = date('H:i', $start + $duration);
                // Find busy spaces for this slot
                $busySpaces = Event::whereHas('schedule.turn', function($q) use ($date, $turn) {
                        $q->where('date', $date)->where('name', $turn['name']);
                    })
                    ->where(function($q) use ($eventStart, $eventEnd) {
                        $q->whereBetween('event_start_time', [$eventStart, $eventEnd])
                          ->orWhereBetween('event_end_time', [$eventStart, $eventEnd])
                          ->orWhere(function($q2) use ($eventStart, $eventEnd) {
                              $q2->where('event_start_time', '<=', $eventStart)
                                 ->where('event_end_time', '>=', $eventEnd);
                          });
                    })
                    ->pluck('space_id')->toArray();
                $freeSpace = Space::where('space_size', $standSize)
                    ->whereNotIn('id', $busySpaces)
                    ->inRandomOrder()
                    ->first();
                if (!$freeSpace) {
                    $tries++;
                    continue;
                }
                // Pick celebrities and check for overlap
                $celebCount = $faker->numberBetween(1, min(5, count($celebrityIds)));
                $selectedCelebs = $faker->randomElements($celebrityIds, $celebCount);
                $celebOverlap = false;
                foreach ($selectedCelebs as $celebId) {
                    $overlap = Event::whereHas('celebrities', function($q) use ($celebId) {
                            $q->where('celebrities.id', $celebId);
                        })
                        ->whereHas('schedule.turn', function($q) use ($date, $turn) {
                            $q->where('date', $date)->where('name', $turn['name']);
                        })
                        ->where(function($q) use ($eventStart, $eventEnd) {
                            $q->whereBetween('event_start_time', [$eventStart, $eventEnd])
                              ->orWhereBetween('event_end_time', [$eventStart, $eventEnd])
                              ->orWhere(function($q2) use ($eventStart, $eventEnd) {
                                  $q2->where('event_start_time', '<=', $eventStart)
                                     ->where('event_end_time', '>=', $eventEnd);
                              });
                        })
                        ->exists();
                    if ($overlap) {
                        $celebOverlap = true;
                        break;
                    }
                }
                if ($celebOverlap) {
                    $tries++;
                    continue;
                }
                // All checks passed, create event
                $event = Event::create([
                    'company_name' => $faker->company,
                    'contact_person' => $faker->name,
                    'email' => 'event'.$eventCount.'@example.com',
                    'phone' => $faker->phoneNumber,
                    'website' => $faker->url,
                    'stand_category' => $standCategory,
                    'stand_size' => $standSize,
                    'wired_internet' => $faker->boolean,
                    'audio_sound_configuration' => $faker->boolean,
                    'event_start_time' => $eventStart,
                    'event_end_time' => $eventEnd,
                    'space_id' => $freeSpace->id,
                    'schedule_id' => $schedule->id,
                ]);
                $event->celebrities()->sync($selectedCelebs);
                $eventCount++;
                $created = true;
            }
            // If not created after maxTries, skip to next event
        }
    }
}
