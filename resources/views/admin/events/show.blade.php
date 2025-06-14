<x-app-layout>
    <div class="min-h-screen py-6 sm:py-12 flex items-start justify-center" style="background: linear-gradient(to bottom, #f3f4f6 0%, #e5e7eb 100%); min-height: 100dvh;">
        <div class="w-full max-w-4xl px-2 sm:px-4 lg:px-6">
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

                    <!-- Información del solicitante -->
                    <div class="mb-8">
                        <h3 class="text-lg font-bold text-[#7692FF] mb-4">Información del solicitante:</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <span class="text-gray-700 font-bold">Empresa:</span>
                                <span class="text-gray-900">{{ $event->company_name }}</span>
                            </div>
                            <div>
                                <span class="text-gray-700 font-bold">Persona de contacto:</span>
                                <span class="text-gray-900">{{ $event->contact_person }}</span>
                            </div>
                            <div>
                                <span class="text-gray-700 font-bold">Email:</span>
                                <span class="text-gray-900">{{ $event->email }}</span>
                            </div>
                            <div>
                                <span class="text-gray-700 font-bold">Teléfono:</span>
                                <span class="text-gray-900">{{ $event->phone }}</span>
                            </div>
                            <div>
                                <span class="text-gray-700 font-bold">Web:</span>
                                @if($event->website)
                                    <a href="{{ $event->website }}" class="text-[#7692FF] underline hover:text-[#1B2CC1] transition" target="_blank">Enlace</a>
                                @else
                                    <span class="text-gray-900">-</span>
                                @endif
                            </div>
                            <div>
                                <span class="text-gray-700 font-bold">Categoría Stand:</span>
                                <span class="text-gray-900">{{ $event->stand_category }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Preferencias del Stand -->
                    <div class="mb-8">
                        <h3 class="text-lg font-bold text-[#7692FF] mb-4">Preferencias del Stand:</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <span class="text-gray-700 font-bold">Tamaño Stand:</span>
                                <span class="text-gray-900">{{ $event->stand_size }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Necesidades Técnicas y Logísticas -->
                    <div class="mb-8">
                        <h3 class="text-lg font-bold text-[#7692FF] mb-4">Necesidades Técnicas y Logísticas:</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <span class="text-gray-700 font-bold">Internet cableado:</span>
                                <span class="text-gray-900">{{ $event->wired_internet ? 'Sí' : 'No' }}</span>
                            </div>
                            <div>
                                <span class="text-gray-700 font-bold">Configuración de sonido:</span>
                                <span class="text-gray-900">{{ $event->audio_sound_configuration ? 'Sí' : 'No' }}</span>
                            </div>
                            <div>
                                <span class="text-gray-700 font-bold">Espacio:</span>
                                <span class="text-gray-900">{{ $event->space ? $event->space->location_code : '-' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Horario -->
                    <div class="mb-8">
                        <h3 class="text-lg font-bold text-[#7692FF] mb-4">Horario:</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <span class="text-gray-700 font-bold">Fecha:</span>
                                <span class="text-gray-900">{{ optional($event->schedule->turn)->date ? \Carbon\Carbon::parse(optional($event->schedule->turn)->date)->format('d/m/Y') : '-' }}</span>
                            </div>
                            <div>
                                <span class="text-gray-700 font-bold">Turno:</span>
                                <span class="text-gray-900">{{ optional($event->schedule->turn)->name ?? '-' }}</span>
                            </div>
                            <div>
                                <span class="text-gray-700 font-bold">Hora inicio:</span>
                                <span class="text-gray-900">{{ $event->event_start_time ?? '-' }}</span>
                            </div>
                            <div>
                                <span class="text-gray-700 font-bold">Hora fin:</span>
                                <span class="text-gray-900">{{ $event->event_end_time ?? '-' }}</span>
                            </div>
                            <div>
                                <span class="text-gray-700 font-bold">Duración:</span>
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
                        </div>
                    </div>

                    <!-- Celebridades del Evento -->
                    <div class="mb-8">
                        <h3 class="text-lg font-bold text-[#7692FF] mb-4">Celebridades invitadas:</h3>
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

                    <!-- Imagen del Evento -->
                    <div class="mb-8">
                        <h3 class="text-lg font-bold text-[#7692FF] mb-4">Imagen del Evento:</h3>
                        <img src="{{ asset('storage/' . ($event->image ?? 'img/events/imagen_perfil.png')) }}" alt="Imagen del evento" class="h-32 rounded shadow mt-2">
                    </div>

                    <!-- Descripción corta -->
                    <div class="mb-8">
                        <h3 class="text-lg font-bold text-[#7692FF] mb-4">Descripción corta:</h3>
                        <span class="text-gray-900">{{ $event->short_description }}</span>
                    </div>

                    <!-- Descripción del Evento -->
                    <div class="mb-8">
                        <h3 class="text-lg font-bold text-[#7692FF] mb-4">Descripción del Evento:</h3>
                        <span class="text-gray-900">{{ $event->description }}</span>
                    </div>

                    <!-- Tipo de Evento -->
                    <div class="mb-8">
                        <h3 class="text-lg font-bold text-[#7692FF] mb-4">Tipo de Evento:</h3>
                        <span class="text-gray-900">{{ $event->type }}</span>
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