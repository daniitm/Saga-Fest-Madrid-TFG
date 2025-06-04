<?php

namespace App\Providers;

use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\User\EloquentUserRepository;
use App\Repositories\Celebrity\CelebrityRepositoryInterface;
use App\Repositories\Celebrity\EloquentCelebrityRepository;
use App\Repositories\Ticket\TicketRepositoryInterface;
use App\Repositories\Ticket\EloquentTicketRepository;
use App\Repositories\Event\EventRepositoryInterface;
use App\Repositories\Event\EloquentEventRepository;
use App\Repositories\Space\SpaceRepositoryInterface;
use App\Repositories\Space\EloquentSpaceRepository;
use App\Repositories\Schedule\ScheduleRepositoryInterface;
use App\Repositories\Schedule\EloquentScheduleRepository;
use App\Repositories\Turn\TurnRepositoryInterface;
use App\Repositories\Turn\EloquentTurnRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, EloquentUserRepository::class);
        $this->app->bind(CelebrityRepositoryInterface::class, EloquentCelebrityRepository::class);
        $this->app->bind(TicketRepositoryInterface::class, EloquentTicketRepository::class);
        $this->app->bind(EventRepositoryInterface::class, EloquentEventRepository::class);
        $this->app->bind(SpaceRepositoryInterface::class, EloquentSpaceRepository::class);
        $this->app->bind(ScheduleRepositoryInterface::class, EloquentScheduleRepository::class);
        $this->app->bind(TurnRepositoryInterface::class, EloquentTurnRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
