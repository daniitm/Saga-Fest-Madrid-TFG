<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Exposition\ExpositionRepositoryInterface;
use App\Repositories\Schedule\ScheduleRepositoryInterface;
use App\Repositories\Turn\TurnRepositoryInterface;
use App\Repositories\Space\SpaceRepositoryInterface;
use App\Repositories\Event\EventRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ExpositionController extends Controller
{
    private ExpositionRepositoryInterface $expositions;
    private ScheduleRepositoryInterface $schedules;
    private TurnRepositoryInterface $turns;
    private SpaceRepositoryInterface $spaces;
    private EventRepositoryInterface $events;

    public function __construct(
        ExpositionRepositoryInterface $expositions,
        ScheduleRepositoryInterface $schedules,
        TurnRepositoryInterface $turns,
        SpaceRepositoryInterface $spaces,
        EventRepositoryInterface $events
    ) {
        $this->expositions = $expositions;
        $this->schedules = $schedules;
        $this->turns = $turns;
        $this->spaces = $spaces;
        $this->events = $events;
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $expositions = $this->expositions->paginateWithSearch($search, 15);
        return view('admin.expositions.index', compact('expositions', 'search'));
    }

    public function create(Request $request)
    {
        $turns = $this->turns->all()->groupBy('date')->map(function($group) {
            return $group->keyBy('name')->map(function($turn) {
                return [
                    'start' => $turn->start_time,
                    'end' => $turn->end_time,
                ];
            });
        });
        $allowedDates = $turns->keys()->values();
        return view('admin.expositions.create', compact('turns', 'allowedDates'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'company_name' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:expositions,email',
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
            'short_description' => 'required|string|min:100|max:255',
            'special_requirements' => 'nullable|string|min:100|max:255',
            'additional_information' => 'nullable|string|min:100|max:255',
        ],
        [
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
            'short_description.required' => 'La descripción corta es obligatoria.',
            'short_description.min' => 'La descripción corta debe tener al menos 100 caracteres.',
            'short_description.max' => 'La descripción corta no puede superar los 255 caracteres.',
            'additional_information.min' => 'La información adicional debe tener al menos 100 caracteres.',
            'additional_information.max' => 'La información adicional no puede superar los 255 caracteres.',
            'special_requirements.min' => 'Los requisitos especiales deben tener al menos 100 caracteres.',
            'special_requirements.max' => 'Los requisitos especiales no pueden superar los 255 caracteres.',
            'website.url' => 'El sitio web debe ser una URL válida.',
        ]);

        // Lógica de solapamiento: comprobar eventos y exposiciones
        $date = $data['date'];
        $turnName = $data['turno'];
        $startTime = $data['start_time'];
        $endTime = $data['end_time'];
        $standSize = $data['stand_size'];
        $turnModel = $this->turns->all()->where('date', $date)->where('name', $turnName)->first();
        if (!$turnModel) {
            session()->flash('toast', [
                'type' => 'warning',
                'message' => 'Turno no válido para la fecha seleccionada.'
            ]);
            return back()->withErrors(['turno' => 'Turno no válido para la fecha seleccionada.'])->withInput();
        }
        $schedule = $this->schedules->all()->where('turn_id', $turnModel->id)->first();
        if (!$schedule) {
            session()->flash('toast', [
                'type' => 'warning',
                'message' => 'No existe horario para el turno seleccionado.'
            ]);
            return back()->withErrors(['turno' => 'No existe horario para el turno seleccionado.'])->withInput();
        }
        $breakMinutes = $schedule->break ?? 0;
        $start = Carbon::createFromFormat('H:i', $startTime);
        $end = Carbon::createFromFormat('H:i', $endTime);
        // Validación de duración mínima y máxima
        $duration = $start->diffInMinutes($end);
        if ($duration < 30 || $duration > 150) {
            return back()->withErrors(['end_time' => 'La duración de la exposición debe ser entre 30 minutos y 2 horas y media (150 minutos).'])->withInput();
        }
        // Buscar espacios ocupados por eventos o exposiciones en ese horario (respetando descanso)
        $busySpaces = array_merge(
            $this->events->all()->where('schedule_id', $schedule->id)->filter(function($event) use ($startTime, $endTime, $breakMinutes) {
                $eventStart = Carbon::createFromFormat('H:i', $event->event_start_time);
                $eventEnd = Carbon::createFromFormat('H:i', $event->event_end_time);
                $blockedStart = $eventStart->copy()->subMinutes($breakMinutes);
                $blockedEnd = $eventEnd->copy()->addMinutes($breakMinutes);
                $newStart = Carbon::createFromFormat('H:i', $startTime);
                $newEnd = Carbon::createFromFormat('H:i', $endTime);
                return $newStart < $blockedEnd && $newEnd > $blockedStart;
            })->pluck('space_id')->toArray(),
            $this->expositions->all()->where('schedule_id', $schedule->id)->filter(function($expo) use ($startTime, $endTime, $breakMinutes) {
                $expoStart = Carbon::createFromFormat('H:i', $expo->event_start_time);
                $expoEnd = Carbon::createFromFormat('H:i', $expo->event_end_time);
                $blockedStart = $expoStart->copy()->subMinutes($breakMinutes);
                $blockedEnd = $expoEnd->copy()->addMinutes($breakMinutes);
                $newStart = Carbon::createFromFormat('H:i', $startTime);
                $newEnd = Carbon::createFromFormat('H:i', $endTime);
                return $newStart < $blockedEnd && $newEnd > $blockedStart;
            })->pluck('space_id')->toArray()
        );
        $freeSpace = $this->spaces->all()->where('space_size', $standSize)->whereNotIn('id', $busySpaces)->first();
        if (!$freeSpace) {
            session()->flash('toast', [
                'type' => 'warning',
                'message' => 'No hay espacios disponibles del tamaño solicitado en ese turno, fecha y horario.'
            ]);
            return back()->withErrors(['stand_size' => 'No hay espacios disponibles del tamaño solicitado en ese turno, fecha y horario.'])->withInput();
        }
        $data['space_id'] = $freeSpace->id;
        $data['schedule_id'] = $schedule->id;
        $data['event_start_time'] = $startTime;
        $data['event_end_time'] = $endTime;
        $exposition = $this->expositions->create($data);
        \App\Models\Expositor::create([
            'name' => $data['contact_person'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'exposition_id' => $exposition->id,
        ]);
        Mail::to($data['email'])->send(new \App\Mail\ExpositionConfirmation(
            $data['company_name'],
            $data['contact_person'],
            $data['date'],
            $data['turno'], // Cambiado de 'turn' a 'turno'
            $data['start_time'],
            $data['end_time']
        ));
        return redirect()->route('admin.expositions.index')->with('toast', [
            'type' => 'success',
            'message' => '¡Exposición creada correctamente!'
        ]);
    }

    public function show($id)
    {
        $exposition = $this->expositions->find($id);
        if (!$exposition) abort(404);
        return view('admin.expositions.show', compact('exposition'));
    }

    public function edit($id, Request $request)
    {
        $exposition = $this->expositions->find($id);
        if (!$exposition) abort(404);
        $date = $request->input('date', optional(optional($exposition->schedule)->turn)->date);
        $turnName = $request->input('turn_name', optional(optional($exposition->schedule)->turn)->name);
        $startTime = $request->input('start_time', $exposition->event_start_time);
        $endTime = $request->input('end_time', $exposition->event_end_time);
        $turns = $this->turns->all()->groupBy('date')->map(function($group) {
            return $group->keyBy('name')->map(function($turn) {
                return [
                    'start' => $turn->start_time,
                    'end' => $turn->end_time,
                ];
            });
        });
        $allowedDates = $turns->keys()->values();
        return view('admin.expositions.edit', compact('exposition', 'turns', 'allowedDates'));
    }

    public function update($id, Request $request)
    {
        $exposition = $this->expositions->find($id);
        if (!$exposition) abort(404);
        $data = $request->validate([
            'company_name' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:expositions,email,' . $exposition->id,
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
            'short_description' => 'required|string|min:100|max:255',
            'special_requirements' => 'nullable|string|min:100|max:255',
            'additional_information' => 'nullable|string|min:100|max:255',
        ],
        [
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
            'short_description.required' => 'La descripción corta es obligatoria.',
            'short_description.min' => 'La descripción corta debe tener al menos 100 caracteres.',
            'short_description.max' => 'La descripción corta no puede superar los 255 caracteres.',
            'additional_information.min' => 'La información adicional debe tener al menos 100 caracteres.',
            'additional_information.max' => 'La información adicional no puede superar los 255 caracteres.',
            'special_requirements.min' => 'Los requisitos especiales deben tener al menos 100 caracteres.',
            'special_requirements.max' => 'Los requisitos especiales no pueden superar los 255 caracteres.',
            'website.url' => 'El sitio web debe ser una URL válida.',
        ]);

        $date = $data['date'];
        $turnName = $data['turno'];
        $startTime = $data['start_time'];
        $endTime = $data['end_time'];
        $standSize = $data['stand_size'];
        $turnModel = $this->turns->all()->where('date', $date)->where('name', $turnName)->first();
        if (!$turnModel) {
            return back()->withErrors(['turno' => 'Turno no válido para la fecha seleccionada.'])->withInput();
        }
        $schedule = $this->schedules->all()->where('turn_id', $turnModel->id)->first();
        if (!$schedule) {
            return back()->withErrors(['turno' => 'No existe horario para el turno seleccionado.'])->withInput();
        }
        $breakMinutes = $schedule->break ?? 0;
        $start = Carbon::createFromFormat('H:i', $startTime);
        $end = Carbon::createFromFormat('H:i', $endTime);
        // Validación de duración mínima y máxima
        $duration = $start->diffInMinutes($end);
        if ($duration < 30 || $duration > 150) {
            return back()->withErrors(['end_time' => 'La duración de la exposición debe ser entre 30 minutos y 2 horas y media (150 minutos).'])->withInput();
        }
        // Buscar espacios ocupados por eventos o exposiciones en ese horario (respetando descanso), excluyendo la actual
        $busySpaces = array_merge(
            $this->events->all()->where('schedule_id', $schedule->id)->filter(function($event) use ($startTime, $endTime, $breakMinutes) {
                $eventStart = Carbon::createFromFormat('H:i', $event->event_start_time);
                $eventEnd = Carbon::createFromFormat('H:i', $event->event_end_time);
                $blockedStart = $eventStart->copy()->subMinutes($breakMinutes);
                $blockedEnd = $eventEnd->copy()->addMinutes($breakMinutes);
                $newStart = Carbon::createFromFormat('H:i', $startTime);
                $newEnd = Carbon::createFromFormat('H:i', $endTime);
                return $newStart < $blockedEnd && $newEnd > $blockedStart;
            })->pluck('space_id')->toArray(),
            $this->expositions->all()->where('schedule_id', $schedule->id)->where('id', '!=', $exposition->id)->filter(function($expo) use ($startTime, $endTime, $breakMinutes) {
                $expoStart = Carbon::createFromFormat('H:i', $expo->event_start_time);
                $expoEnd = Carbon::createFromFormat('H:i', $expo->event_end_time);
                $blockedStart = $expoStart->copy()->subMinutes($breakMinutes);
                $blockedEnd = $expoEnd->copy()->addMinutes($breakMinutes);
                $newStart = Carbon::createFromFormat('H:i', $startTime);
                $newEnd = Carbon::createFromFormat('H:i', $endTime);
                return $newStart < $blockedEnd && $newEnd > $blockedStart;
            })->pluck('space_id')->toArray()
        );
        $freeSpace = $this->spaces->all()->where('space_size', $standSize)->whereNotIn('id', $busySpaces)->first();
        if (!$freeSpace) {
            return back()->withErrors(['stand_size' => 'No hay espacios disponibles del tamaño solicitado en ese turno, fecha y horario.'])->withInput();
        }
        $data['space_id'] = $freeSpace->id;
        $data['schedule_id'] = $schedule->id;
        $data['event_start_time'] = $startTime;
        $data['event_end_time'] = $endTime;
        $this->expositions->update($exposition, $data);
        // Actualizar expositor correspondiente
        if ($exposition->expositor) {
            $exposition->expositor->update([
                'name' => $data['contact_person'],
                'email' => $data['email'],
                'phone' => $data['phone'],
            ]);
        }
        return redirect()->route('admin.expositions.index')->with('toast', [
            'type' => 'success',
            'message' => '¡Exposición actualizada correctamente!'
        ]);
    }

    public function destroy($id)
    {
        $exposition = $this->expositions->find($id);
        if (!$exposition) abort(404);
        // Eliminar expositor correspondiente
        if ($exposition->expositor) {
            $exposition->expositor->delete();
        }
        $this->expositions->delete($exposition);
        return redirect()->route('admin.expositions.index')->with('toast', [
            'type' => 'success',
            'message' => '¡Exposición eliminada correctamente!'
        ]);
    }
}
