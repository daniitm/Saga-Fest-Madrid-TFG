<x-app-layout>
    <div class="min-h-screen py-6 sm:py-12 flex items-start justify-center" style="background: linear-gradient(to bottom, #f3f4f6 0%, #e5e7eb 100%); min-height: 100dvh;">
        <div class="w-full max-w-2xl px-2 sm:px-4 lg:px-6">
            <div class="bg-white rounded-2xl shadow-2xl border-2 border-[#7692FF] p-0">
                <div class="p-6 sm:p-10">
                    <h1 class="text-2xl font-bold text-[#111215] mb-6 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-[#7692FF]" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Detalles del Evento
                    </h1>
                    <div class="flex flex-col gap-4">
                        <div>
                            <span class="text-gray-700 font-bold text-lg">Empresa:</span>
                            <span class="text-gray-900">{{ $event->company_name }}</span>
                        </div>
                        <div>
                            <span class="text-gray-700 font-bold text-lg">Persona de contacto:</span>
                            <span class="text-gray-900">{{ $event->contact_person }}</span>
                        </div>
                        <div>
                            <span class="text-gray-700 font-bold text-lg">Email:</span>
                            <span class="text-gray-900">{{ $event->email }}</span>
                        </div>
                        <div>
                            <span class="text-gray-700 font-bold text-lg">Teléfono:</span>
                            <span class="text-gray-900">{{ $event->phone }}</span>
                        </div>
                        <div>
                            <span class="text-gray-700 font-bold text-lg">Web:</span>
                            @if($event->website)
                                <a href="{{ $event->website }}" class="text-[#7692FF] underline hover:text-[#1B2CC1] transition" target="_blank">Enlace</a>
                            @else
                                <span class="text-gray-900">-</span>
                            @endif
                        </div>
                        <div>
                            <span class="text-gray-700 font-bold text-lg">Categoría Stand:</span>
                            <span class="text-gray-900">{{ $event->stand_category }}</span>
                        </div>
                        <div>
                            <span class="text-gray-700 font-bold text-lg">Tamaño Stand:</span>
                            <span class="text-gray-900">{{ $event->stand_size }}</span>
                        </div>
                        <div>
                            <span class="text-gray-700 font-bold text-lg">Internet cableado:</span>
                            <span class="text-gray-900">{{ $event->wired_internet ? 'Sí' : 'No' }}</span>
                        </div>
                        <div>
                            <span class="text-gray-700 font-bold text-lg">Configuración de sonido:</span>
                            <span class="text-gray-900">{{ $event->audio_sound_configuration ? 'Sí' : 'No' }}</span>
                        </div>
                        <div>
                            <span class="text-gray-700 font-bold text-lg">Espacio:</span>
                            <span class="text-gray-900">{{ $event->space ? $event->space->location_code : '-' }}</span>
                        </div>
                        <div>
                            <span class="text-gray-700 font-bold text-lg">Fecha:</span>
                            <span class="text-gray-900">{{ optional($event->schedule->turn)->date ?? '-' }}</span>
                        </div>
                        <div>
                            <span class="text-gray-700 font-bold text-lg">Turno:</span>
                            <span class="text-gray-900">{{ optional($event->schedule->turn)->name ?? '-' }}</span>
                        </div>
                        <div>
                            <span class="text-gray-700 font-bold text-lg">Duración:</span>
                            <span class="text-gray-900">
                                @php
                                    if ($event->event_start_time && $event->event_end_time) {
                                        $start = \Carbon\Carbon::createFromFormat('H:i', $event->event_start_time);
                                        $end = \Carbon\Carbon::createFromFormat('H:i', $event->event_end_time);
                                        $duration = $start->diffInMinutes($end);
                                        echo $duration . ' minutos';
                                    } else {
                                        echo '-';
                                    }
                                @endphp
                            </span>
                        </div>
                        <!-- Celebridades asignadas al evento -->
                        <div>
                            <span class="text-gray-700 font-bold text-lg block mb-1">Celebridades invitadas:</span>
                            @if($event->celebrities->isEmpty())
                                <p class="text-gray-600">No hay celebridades asignadas a este evento.</p>
                            @else
                                <ul class="list-disc pl-6">
                                    @foreach($event->celebrities as $celebrity)
                                        <li>
                                            <span class="font-semibold text-gray-900">{{ $celebrity->name }} {{ $celebrity->surnames }}</span>
                                            <span class="text-gray-500">({{ $celebrity->category }})</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                    <div class="pt-5 flex gap-3">
                        <a href="{{ route('admin.events.index') }}"
                           class="inline-flex items-center px-5 py-2 bg-[#7692FF] hover:bg-[#1B2CC1] text-white text-sm font-semibold rounded transition duration-200">
                            Volver atrás
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>