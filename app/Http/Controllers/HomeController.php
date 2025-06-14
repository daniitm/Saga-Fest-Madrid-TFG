<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Celebrity\CelebrityRepositoryInterface;
use App\Repositories\Event\EventRepositoryInterface;
use App\Repositories\Schedule\ScheduleRepositoryInterface;

class HomeController extends Controller
{
    private $celebrities;
    private $events;
    private $schedules;

    public function __construct(CelebrityRepositoryInterface $celebrities, EventRepositoryInterface $events, ScheduleRepositoryInterface $schedules)
    {
        $this->celebrities = $celebrities;
        $this->events = $events;
        $this->schedules = $schedules;
    }

    public function index()
    {
        $celebrities = $this->celebrities->getRandom(6);
        $events = $this->events->all()->random(min(5, $this->events->all()->count()));
        $schedules = $this->schedules->all();
        // Agrupar por fecha y ordenar turnos (mañana/tarde)
        $schedulesGrouped = $schedules->groupBy(function($item) {
            return \Carbon\Carbon::parse($item->turn->date)->format('Y-m-d');
        })->sortKeys()->map(function($turnos) {
            return $turnos->sortBy(function($item) {
                return $item->turn->name === 'Mañana' ? 0 : 1;
            });
        });
        $break = $schedules->first()->break ?? 0;
        return view('welcome', compact('celebrities', 'events', 'schedulesGrouped', 'break'));
    }

    public function showCelebrities()
    {
        $celebrities = $this->celebrities->all();
        return view('show-celebrities', compact('celebrities'));
    }

    public function showCelebrity($id)
    {
        $celebrity = $this->celebrities->findById($id);
        if (!$celebrity) {
            abort(404);
        }
        return view('show-celebrity', compact('celebrity'));
    }

    public function showEvent($id)
    {
        $event = $this->events->find($id);
        if (!$event) {
            abort(404);
        }
        return view('show-event', compact('event'));
    }
}
