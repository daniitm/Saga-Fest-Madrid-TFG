<?php

namespace App\Providers;

use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\User\EloquentUserRepository;
use Illuminate\Support\ServiceProvider;
use App\Models\Turn;
use App\Models\Schedule;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, EloquentUserRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Default dates and turns
        $defaultDates = [
            '2025-07-25',
            '2025-07-26',
            '2025-07-27',
        ];
        $turnsData = [
            [
                'name' => 'Mañana',
                'start_time' => '09:00',
                'end_time' => '13:00',
            ],
            [
                'name' => 'Tarde',
                'start_time' => '16:00',
                'end_time' => '20:00',
            ],
        ];
        $defaultBreak = 15;

        foreach ($defaultDates as $date) {
            foreach ($turnsData as $turnData) {
                $turn = Turn::firstOrCreate([
                    'date' => $date,
                    'name' => $turnData['name'],
                ], [
                    'start_time' => $turnData['start_time'],
                    'end_time' => $turnData['end_time'],
                ]);
                Schedule::firstOrCreate([
                    'turn_id' => $turn->id,
                ], [
                    'break' => $defaultBreak,
                ]);
            }
        }
    }
}
