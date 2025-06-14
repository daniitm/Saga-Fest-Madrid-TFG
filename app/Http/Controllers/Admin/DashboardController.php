<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Event\EventRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;

class DashboardController extends Controller
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly EventRepositoryInterface $eventRepository
    ) {}

    public function index()
    {
        // Obtener los próximos 3 eventos ordenados por fecha y turno
        $events = $this->eventRepository->all()
            ->load(['schedule.turn'])
            ->sort(function($a, $b) {
                $dateA = optional(optional($a->schedule)->turn)->date;
                $dateB = optional(optional($b->schedule)->turn)->date;
                if ($dateA === $dateB) {
                    // Mañana antes que Tarde
                    $turnA = optional(optional($a->schedule)->turn)->name;
                    $turnB = optional(optional($b->schedule)->turn)->name;
                    return ($turnA === 'Mañana' ? 0 : 1) <=> ($turnB === 'Mañana' ? 0 : 1);
                }
                return strcmp($dateA, $dateB);
            })
            ->values()
            ->take(3);
        return view('admin.dashboard', compact('events'));
    }
}
