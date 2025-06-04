<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Event\EventRepositoryInterface;
use App\Repositories\Celebrity\CelebrityRepositoryInterface;
use App\Repositories\Schedule\ScheduleRepositoryInterface;
use App\Repositories\Turn\TurnRepositoryInterface;
use App\Repositories\Space\SpaceRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EventController extends Controller
{
    private EventRepositoryInterface $events;
    private CelebrityRepositoryInterface $celebrities;
    private ScheduleRepositoryInterface $schedules;
    private TurnRepositoryInterface $turns;
    private SpaceRepositoryInterface $spaces;

    public function __construct(
        EventRepositoryInterface $events,
        CelebrityRepositoryInterface $celebrities,
        ScheduleRepositoryInterface $schedules,
        TurnRepositoryInterface $turns,
        SpaceRepositoryInterface $spaces
    ) {
        $this->events = $events;
        $this->celebrities = $celebrities;
        $this->schedules = $schedules;
        $this->turns = $turns;
        $this->spaces = $spaces;
    }

    public function index()
    {
        $events = $this->events->paginate(15);
        return view('admin.events.index', compact('events'));
    }

    public function create(Request $request)
    {
        $celebrities = $this->celebrities->all();
        // Obtener turnos reales agrupados por fecha y nombre
        $turns = $this->turns->all()->groupBy('date')->map(function($group) {
            return $group->keyBy('name')->map(function($turn) {
                return [
                    'start' => $turn->start_time,
                    'end' => $turn->end_time,
                ];
            });
        });
        $allowedDates = $turns->keys()->values();
        return view('admin.events.create', compact('celebrities', 'turns', 'allowedDates'));
    }

    public function edit($id, Request $request)
    {
        $event = $this->events->find($id);
        if (!$event) abort(404);
        $celebrities = $this->celebrities->all();
        $date = $request->input('date', optional(optional($event->schedule)->turn)->date);
        $turnName = $request->input('turn_name', optional(optional($event->schedule)->turn)->name);
        $startTime = $request->input('start_time', $event->event_start_time);
        $endTime = $request->input('end_time', $event->event_end_time);
        if ($date && $turnName && $startTime && $endTime) {
            $celebrities = $this->celebrities->getAvailableForEvent($date, $turnName, $startTime, $endTime, $event->id);
        }
        $turns = $this->turns->all()->groupBy('date')->map(function($group) {
            return $group->keyBy('name')->map(function($turn) {
                return [
                    'start' => $turn->start_time,
                    'end' => $turn->end_time,
                ];
            });
        });
        $allowedDates = $turns->keys()->values();
        return view('admin.events.edit', compact('event', 'celebrities', 'turns', 'allowedDates'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'company_name' => 'required|string|max:255|regex:/^[A-Za-zÁÉÍÓÚÜÑáéíóúüñ\s]+$/u',
            'contact_person' => 'required|string|max:255|regex:/^[A-Za-zÁÉÍÓÚÜÑáéíóúüñ\s]+$/u',
            'email' => 'required|email|max:255|unique:events,email',
            'phone' => 'required|string|digits:9|regex:/^[6-9]\d{8}$/',
            'website' => 'nullable|url|max:255',
            'stand_category' => 'required|string',
            'stand_size' => 'required|in:Pequeño,Medio,Grande',
            'wired_internet' => 'required|boolean',
            'audio_sound_configuration' => 'required|boolean',
            'date' => 'required|date',
            'turno' => 'required|string',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'celebrities' => 'required|array|min:1|max:5',
            'celebrities.*' => 'exists:celebrities,id',
        ],  [
            'company_name.required' => 'El nombre de la empresa es obligatorio.',
            'company_name.regex' => 'El nombre de la empresa solo puede contener letras y espacios.',
            'company_name.max' => 'El nombre de la empresa no puede exceder los 255 caracteres.',
            'contact_person.required' => 'El nombre del contacto es obligatorio.',
            'contact_person.regex' => 'El nombre del contacto solo puede contener letras y espacios.',
            'contact_person.max' => 'El nombre del contacto no puede exceder los 255 caracteres.',
            'email.required' => 'El email es obligatorio.',
            'email.email' => 'El email debe ser una dirección de correo electrónico válida.',
            'email.unique' => 'El email ya está en uso.',
            'phone.required' => 'El teléfono es obligatorio.',
            'phone.digits' => 'El teléfono debe tener 9 dígitos.',
            'phone.regex' => 'El teléfono solo puede contener números, espacios y guiones.',
            'stand_category.required' => 'La categoría del stand es obligatoria.',
            'stand_size.required' => 'El tamaño del stand es obligatorio.',
            'wired_internet.required' => 'Debes indicar si necesitas internet por cable.',
            'audio_sound_configuration.required' => 'Debes indicar si necesitas configuración de audio.',
            'date.required' => 'La fecha es obligatoria.',
            'turno.required' => 'El turno es obligatorio.',
            'turno.in' => 'El turno debe ser de mañana o de tarde.',
            'start_time.required' => 'La hora de inicio es obligatoria.',
            'start_time.date_format' => 'La hora de inicio debe tener el formato HH:MM.',
            'start_time.after_or_equal' => 'La hora de inicio debe ser como mínimo :date.',
            'end_time.required' => 'La hora de fin es obligatoria.',
            'end_time.date_format' => 'La hora de fin debe tener el formato HH:MM.',
            'end_time.after' => 'La hora de fin debe ser posterior a la de inicio.',
            'end_time.before_or_equal' => 'La hora de fin debe ser como máximo :date.',
            'celebrities.required' => 'Debes seleccionar al menos una celebridad.',
            'celebrities.min' => 'Debes seleccionar al menos una celebridad.',
            'celebrities.max' => 'No puedes seleccionar más de 5 celebridades.',
        ]);

        // Buscar el turno real según fecha y nombre
        $turnModel = $this->turns->all()->where('date', $data['date'])->where('name', $data['turno'])->first();
        if (!$turnModel) {
            return back()->withErrors(['turno' => 'No existe el turno seleccionado para la fecha.'])->withInput();
        }
        $schedule = $this->schedules->all()->where('turn_id', $turnModel->id)->first();
        if (!$schedule) {
            return back()->withErrors(['turno' => 'No existe un horario para el turno seleccionado.'])->withInput();
        }
        $breakMinutes = $schedule->break ?? 0;

        // Validar que las horas estén dentro del turno real
        if ($data['start_time'] < $turnModel->start_time || $data['end_time'] > $turnModel->end_time) {
            return back()->withErrors(['start_time' => 'La hora debe estar dentro del turno seleccionado (' . $turnModel->start_time . ' - ' . $turnModel->end_time . ').'])->withInput();
        }
        $start = Carbon::createFromFormat('H:i', $data['start_time']);
        $end = Carbon::createFromFormat('H:i', $data['end_time']);
        $duration = $start->diffInMinutes($end);
        if ($duration < 30 || $duration > 120) {
            return back()->withErrors(['end_time' => 'La duración debe ser entre 30 minutos y 2 horas.'])->withInput();
        }

        // Buscar espacios ocupados
        $busySpaces = $this->events->all()
            ->filter(function($event) use ($data, $turnModel, $breakMinutes) {
                if ($event->schedule && $event->schedule->turn && $event->schedule->turn->date === $data['date'] && $event->schedule->turn->name === $turnModel->name) {
                    $eventStartWithBreak = Carbon::createFromFormat('H:i', $event->event_start_time)->subMinutes($breakMinutes)->format('H:i');
                    $eventEndWithBreak = Carbon::createFromFormat('H:i', $event->event_end_time)->addMinutes($breakMinutes)->format('H:i');
                    // El espacio está ocupado si el nuevo evento empieza antes de que termine el descanso posterior del evento existente
                    // o termina después de que empieza el descanso previo del evento existente
                    return $data['start_time'] < $eventEndWithBreak && $data['end_time'] > $eventStartWithBreak;
                }
                return false;
            })
            ->pluck('space_id')
            ->toArray();
        $freeSpace = $this->spaces->all()
            ->where('space_size', $data['stand_size'])
            ->whereNotIn('id', $busySpaces)
            ->first();
        if (!$freeSpace) {
            return back()->withErrors(['stand_size' => 'No hay espacios libres del tamaño solicitado en ese turno, fecha y horario.'])->withInput();
        }
        $data['space_id'] = $freeSpace->id;

        // Validar solapamiento de celebridades
        foreach ($data['celebrities'] as $celebrityId) {
            $overlap = $this->events->all()->filter(function($event) use ($celebrityId, $data, $turnModel) {
                return $event->celebrities->contains('id', $celebrityId)
                    && $event->schedule && $event->schedule->turn
                    && $event->schedule->turn->date === $data['date']
                    && $event->schedule->turn->name === $turnModel->name
                    && (
                        ($event->event_start_time < $data['end_time'] && $event->event_end_time > $data['start_time'])
                    );
            })->isNotEmpty();
            if ($overlap) {
                return back()->withErrors(['celebrities' => 'Una de las celebridades ya está ocupada en ese horario.'])->withInput();
            }
        }

        $data['event_start_time'] = $data['start_time'];
        $data['event_end_time'] = $data['end_time'];
        $data['schedule_id'] = $schedule->id;
        unset($data['start_time'], $data['end_time'], $data['date'], $data['turno']);

        $event = $this->events->create($data);
        $event->celebrities()->sync($request->input('celebrities'));

        return redirect()->route('admin.events.index')->with('success', 'Evento creado correctamente');
    }

    public function update(Request $request, $id)
    {
        $event = $this->events->find($id);
        if (!$event) abort(404);
        $data = $request->validate([
            'company_name' => 'required|string|max:255|regex:/^[A-Za-zÁÉÍÓÚÜÑáéíóúüñ\s]+$/u',
            'contact_person' => 'required|string|max:255|regex:/^[A-Za-zÁÉÍÓÚÜÑáéíóúüñ\s]+$/u',
            'email' => 'required|email|max:255|unique:events,email,' . $event->id,
            'phone' => 'required|string|digits:9|regex:/^[6-9]\d{8}$/',
            'website' => 'nullable|url|max:255',
            'stand_category' => 'required|string',
            'stand_size' => 'required|in:Pequeño,Medio,Grande',
            'wired_internet' => 'required|boolean',
            'audio_sound_configuration' => 'required|boolean',
            'date' => 'required|date',
            'turno' => 'required|string',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'celebrities' => 'required|array|min:1|max:5',
            'celebrities.*' => 'exists:celebrities,id',
        ],  [
            'company_name.required' => 'El nombre de la empresa es obligatorio.',
            'company_name.regex' => 'El nombre de la empresa solo puede contener letras y espacios.',
            'company_name.max' => 'El nombre de la empresa no puede exceder los 255 caracteres.',
            'contact_person.required' => 'El nombre del contacto es obligatorio.',
            'contact_person.regex' => 'El nombre del contacto solo puede contener letras y espacios.',
            'contact_person.max' => 'El nombre del contacto no puede exceder los 255 caracteres.',
            'email.required' => 'El email es obligatorio.',
            'email.email' => 'El email debe ser una dirección de correo electrónico válida.',
            'email.unique' => 'El email ya está en uso.',
            'phone.required' => 'El teléfono es obligatorio.',
            'phone.digits' => 'El teléfono debe tener 9 dígitos.',
            'phone.regex' => 'El teléfono solo puede contener números, espacios y guiones.',
            'stand_category.required' => 'La categoría del stand es obligatoria.',
            'stand_size.required' => 'El tamaño del stand es obligatorio.',
            'wired_internet.required' => 'Debes indicar si necesitas internet por cable.',
            'audio_sound_configuration.required' => 'Debes indicar si necesitas configuración de audio.',
            'date.required' => 'La fecha es obligatoria.',
            'turno.required' => 'El turno es obligatorio.',
            'turno.in' => 'El turno debe ser de mañana o de tarde.',
            'start_time.required' => 'La hora de inicio es obligatoria.',
            'start_time.date_format' => 'La hora de inicio debe tener el formato HH:MM.',
            'start_time.after_or_equal' => 'La hora de inicio debe ser como mínimo :date.',
            'end_time.required' => 'La hora de fin es obligatoria.',
            'end_time.date_format' => 'La hora de fin debe tener el formato HH:MM.',
            'end_time.after' => 'La hora de fin debe ser posterior a la de inicio.',
            'end_time.before_or_equal' => 'La hora de fin debe ser como máximo :date.',
            'celebrities.required' => 'Debes seleccionar al menos una celebridad.',
            'celebrities.min' => 'Debes seleccionar al menos una celebridad.',
            'celebrities.max' => 'No puedes seleccionar más de 5 celebridades.',
        ]);

        $turnModel = $this->turns->all()->where('date', $data['date'])->where('name', $data['turno'])->first();
        if (!$turnModel) {
            return back()->withErrors(['turno' => 'No existe el turno seleccionado para la fecha.'])->withInput();
        }
        $schedule = $this->schedules->all()->where('turn_id', $turnModel->id)->first();
        if (!$schedule) {
            return back()->withErrors(['turno' => 'No existe un horario para el turno seleccionado.'])->withInput();
        }
        $breakMinutes = $schedule->break ?? 0;

        if ($data['start_time'] < $turnModel->start_time || $data['end_time'] > $turnModel->end_time) {
            return back()->withErrors(['start_time' => 'La hora debe estar dentro del turno seleccionado (' . $turnModel->start_time . ' - ' . $turnModel->end_time . ').'])->withInput();
        }
        $start = Carbon::createFromFormat('H:i', $data['start_time']);
        $end = Carbon::createFromFormat('H:i', $data['end_time']);
        $duration = $start->diffInMinutes($end);
        if ($duration < 30 || $duration > 120) {
            return back()->withErrors(['end_time' => 'La duración debe ser entre 30 minutos y 2 horas.'])->withInput();
        }

        $busySpaces = $this->events->all()
            ->filter(function($ev) use ($event, $data, $turnModel, $breakMinutes) {
                if ($ev->id == $event->id) return false;
                if ($ev->schedule && $ev->schedule->turn && $ev->schedule->turn->date === $data['date'] && $ev->schedule->turn->name === $turnModel->name) {
                    $eventEndWithBreak = Carbon::createFromFormat('H:i', $ev->event_end_time)->addMinutes($breakMinutes)->format('H:i');
                    return (
                        ($ev->event_start_time < $data['end_time'] && $eventEndWithBreak > $data['start_time'])
                    );
                }
                return false;
            })
            ->pluck('space_id')
            ->toArray();
        $freeSpace = $this->spaces->all()
            ->where('space_size', $data['stand_size'])
            ->whereNotIn('id', $busySpaces)
            ->push($event->space) // permitir el espacio actual si sigue libre
            ->unique('id')
            ->first();
        if (!$freeSpace) {
            return back()->withErrors(['stand_size' => 'No hay espacios libres del tamaño solicitado en ese turno, fecha y horario.'])->withInput();
        }
        $data['space_id'] = $freeSpace->id;

        foreach ($data['celebrities'] as $celebrityId) {
            $overlap = $this->events->all()->filter(function($ev) use ($event, $celebrityId, $data, $turnModel) {
                if ($ev->id == $event->id) return false;
                return $ev->celebrities->contains('id', $celebrityId)
                    && $ev->schedule && $ev->schedule->turn
                    && $ev->schedule->turn->date === $data['date']
                    && $ev->schedule->turn->name === $turnModel->name
                    && (
                        ($ev->event_start_time >= $data['start_time'] && $ev->event_start_time < $data['end_time']) ||
                        ($ev->event_end_time > $data['start_time'] && $ev->event_end_time <= $data['end_time']) ||
                        ($ev->event_start_time <= $data['start_time'] && $ev->event_end_time >= $data['end_time'])
                    );
            })->isNotEmpty();
            if ($overlap) {
                return back()->withErrors(['celebrities' => 'Una de las celebridades ya está ocupada en ese horario.'])->withInput();
            }
        }

        $data['event_start_time'] = $data['start_time'];
        $data['event_end_time'] = $data['end_time'];
        $data['schedule_id'] = $schedule->id;
        unset($data['start_time'], $data['end_time'], $data['date'], $data['turno']);

        $this->events->update($event, $data);
        $event->celebrities()->sync($request->input('celebrities'));

        return redirect()->route('admin.events.index')->with('success', 'Evento actualizado correctamente');
    }

    public function show($id)
    {
        $event = $this->events->find($id);
        if (!$event) abort(404);
        $event->load(['celebrities', 'space', 'schedule.turn']);
        return view('admin.events.show', compact('event'));
    }

    public function availableCelebrities(Request $request)
    {
        $date = $request->query('date');
        $turnName = $request->query('turn_name');
        $startTime = $request->query('start_time');
        $endTime = $request->query('end_time');
        // Validar formato de fecha y hora
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
            return response()->json(['error' => 'Formato de fecha inválido'], 400);
        }
        if (!preg_match('/^\d{2}:\d{2}$/', $startTime) || !preg_match('/^\d{2}:\d{2}$/', $endTime)) {
            return response()->json(['error' => 'Formato de hora inválido'], 400);
        }
        if (!$turnName) {
            return response()->json(['error' => 'Parámetro turn_name requerido'], 400);
        }
        $celebrities = $this->celebrities->getAvailableForEvent($date, $turnName, $startTime, $endTime);
        return response()->json($celebrities->map(function($celeb) {
            return [
                'id' => $celeb->id,
                'name' => $celeb->name,
                'surnames' => $celeb->surnames,
                'category' => $celeb->category,
            ];
        })->values());
    }

    public function destroy($id)
    {
        $event = $this->events->find($id);
        if (!$event) {
            return redirect()->route('admin.events.index')->with('warning', 'Evento no encontrado.');
        }
        $this->events->deleteById($id);
        return redirect()->route('admin.events.index')->with('success', 'Evento eliminado correctamente.');
    }
}
