<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        if (env('APP_ENV') === 'local') {
            $this->call([
                AdminUserSeeder::class,
                UserSeeder::class,
                CelebritySeeder::class,
                //TicketSeeder::class,
                //SpaceSeeder::class,
                //TurnSeeder::class,
                //ScheduleSeeder::class,
                //EventSeeder::class,
            ]);
        } else {
            if (! User::where('email', 'admin@example.com')->exists()) {
                $this->call(AdminUserSeeder::class);
            }
        }
    }
}
