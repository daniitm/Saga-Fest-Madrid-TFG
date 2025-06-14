<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Schedule\ScheduleRepositoryInterface;
use App\Repositories\Turn\TurnRepositoryInterface;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    private ScheduleRepositoryInterface $schedules;
    private $turns;

    public function __construct(ScheduleRepositoryInterface $schedules, TurnRepositoryInterface $turns)
    {
        $this->schedules = $schedules;
        $this->turns = $turns;
    }

    public function index()
    {
        $schedules = $this->schedules->paginate(15);
        return view('admin.schedules.index', compact('schedules'));
    }

    public function show($id)
    {
        $schedule = $this->schedules->find($id);
        return view('admin.schedules.show', compact('schedule'));
    }

    public function create()
    {
        $turns = $this->turns->all();
        return view('admin.schedules.create', compact('turns'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'turn_id' => 'required|exists:turns,id',
            'break' => 'required|integer|min:5|max:20',
        ]);

        $this->schedules->create($data);

        return redirect()->route('admin.schedules.index')->with('toast', ['type' => 'success', 'message' => 'Horario creado correctamente.']);
    }

    public function edit($id)
    {
        $schedule = $this->schedules->find($id);
        $turns = $this->turns->all();
        return view('admin.schedules.edit', compact('schedule', 'turns'));
    }

    public function update(Request $request, $id)
    {
        $schedule = $this->schedules->find($id);

        $data = $request->validate([
            'turn_id' => 'required|exists:turns,id',
            'break' => 'required|integer|min:5|max:20',
        ]);

        $this->schedules->update($schedule, $data);

        return redirect()->route('admin.schedules.index')->with('toast', ['type' => 'success', 'message' => 'Horario actualizado correctamente.']);
    }

    public function destroy($id)
    {
        $schedule = $this->schedules->find($id);
        $this->schedules->delete($schedule);

        return redirect()->route('admin.schedules.index')->with('toast', ['type' => 'success', 'message' => 'Horario eliminado correctamente.']);
    }

    // Editar solo las horas del turno
    public function editTurn($id)
    {
        $schedule = $this->schedules->find($id);
        $eventsCount = $schedule->events()->count();
        if ($eventsCount > 0) {
            return redirect()->route('admin.schedules.index')->with('toast', ['type' => 'warning', 'message' => 'No se puede editar el horario porque ya existe al menos un evento creado.']);
        }
        return view('admin.schedules.edit-turn', compact('schedule', 'eventsCount'));
    }

    public function updateTurn(Request $request, $id)
    {
        $schedule = $this->schedules->find($id);
        $turn = $schedule->turn;
        $rules = [
            'start_time' => ['required', 'date_format:H:i'],
            'end_time' => ['required', 'date_format:H:i', 'after:start_time'],
        ];
        // Restricciones según tipo de turno
        if ($turn->name === 'Mañana') {
            $rules['start_time'][] = 'after_or_equal:09:00';
            $rules['end_time'][] = 'before_or_equal:14:00';
        } else {
            $rules['start_time'][] = 'after_or_equal:16:00';
            $rules['end_time'][] = 'before_or_equal:21:00';
        }
        $data = $request->validate($rules, [
            'start_time.required' => 'La hora de inicio es obligatoria.',
            'end_time.required' => 'La hora de fin es obligatoria.',
            'end_time.after' => 'La hora de fin debe ser posterior a la de inicio.',
            'start_time.date_format' => 'La hora de inicio debe tener el formato HH:MM.',
            'end_time.date_format' => 'La hora de fin debe tener el formato HH:MM.',
            'start_time.after_or_equal' => 'La hora de inicio debe ser como mínimo :date.',
            'end_time.before_or_equal' => 'La hora de fin debe ser como máximo :date.',
        ]);
        // Actualizar solo las horas en el turno
        $turn->start_time = $data['start_time'];
        $turn->end_time = $data['end_time'];
        $turn->save();
        return redirect()->route('admin.schedules.index')->with('toast', ['type' => 'success', 'message' => 'Horario del turno actualizado correctamente.']);
    }

    // Editar solo los minutos de descanso
    public function editBreak($id)
    {
        $schedule = $this->schedules->find($id);
        $eventsCount = $schedule->events()->count();
        if ($eventsCount > 0) {
            return redirect()->route('admin.schedules.index')->with('toast', ['type' => 'warning', 'message' => 'No se puede editar el descanso porque ya existe al menos un evento creado.']);
        }
        return view('admin.schedules.edit-break', compact('schedule', 'eventsCount'));
    }

    public function updateBreak(Request $request, $id)
    {
        // No permitir editar el descanso si hay al menos un evento creado
        if (\App\Models\Event::count() > 0) {
            return redirect()->route('admin.schedules.index')->with('toast', [
                'type' => 'warning',
                'message' => 'No se puede editar el tiempo de descanso porque ya existe al menos un evento creado.'
            ]);
        }

        $data = $request->validate([
            'break' => 'required|integer|min:5|max:15',
        ], [
            'break.required' => 'El descanso es obligatorio.',
            'break.integer' => 'El descanso debe ser un número.',
            'break.min' => 'El descanso mínimo es 5 minutos.',
            'break.max' => 'El descanso máximo es 15 minutos.',
        ]);
        // Actualizar el break en todos los schedules
        \App\Models\Schedule::query()->update(['break' => $data['break']]);
        return redirect()->route('admin.schedules.index')->with('toast', ['type' => 'success', 'message' => 'Minutos de descanso actualizados para todos los turnos y días.']);
    }
}