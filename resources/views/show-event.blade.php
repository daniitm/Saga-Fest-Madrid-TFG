<x-app-layout>
    <!-- Sección Detalle Evento -->
    <section class="bg-white py-14 sm:py-20 lg:py-22" style="background-color: #111215;">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-5xl">
            <div class="bg-gray-50 rounded-2xl p-10 sm:p-14 shadow-2xl" style="background-color: #363636;">
                <h1 class="text-4xl sm:text-5xl font-bold text-white mb-10 text-center">
                    {{ $event->company_name }}
                </h1>
                <div class="flex flex-col md:flex-row gap-10 items-start">
                    <!-- Descripción a la izquierda -->
                    <div class="flex-1 flex flex-col justify-stretch text-white order-2 md:order-1">
                        @php
                            $words = str_word_count($event->description, 1);
                            $firstPart = implode(' ', array_slice($words, 0, 150));
                            $rest = implode(' ', array_slice($words, 150));
                        @endphp
                        <p class="text-gray-200 text-lg leading-relaxed h-full">
                            {{ $firstPart }}
                        </p>
                    </div>
                    <!-- Imagen a la derecha -->
                    <div class="flex flex-col items-center justify-start order-1 md:order-2 mx-auto md:mx-0" style="width:288px; min-width:288px; max-width:288px;">
                        <img src="{{ asset('storage/' . ($event->image ?? 'img/events/imagen_perfil.png')) }}"
                        alt="Imagen de {{ $event->company_name }}"
                        style="width: 288px; height: 288px; object-fit: cover; object-position: center;"
                        class="rounded-lg mb-4 shadow-lg">
                        <span class="inline-block bg-primary text-white px-4 py-1 rounded-full text-sm font-semibold mt-2">
                            {{ $event->stand_category ?? $event->category }}
                        </span>
                    </div>
                </div>
                <!-- Descripción extendida en ancho completo si hay más texto -->
                @if($rest)
                <div class="mt-6 text-gray-200 text-lg leading-relaxed">
                    <p>{!! nl2br(e($rest)) !!}</p>
                </div>
                @endif
                <!-- Info extra debajo de todo -->
                <div class="mt-10 flex flex-col items-start md:ml-0 ml-0 gap-2">
                    @if($event->website)
                        <div>
                            <span class="block text-lg font-semibold text-white mb-1">Web / Redes:</span>
                            <a href="{{ $event->website }}"
                               class="text-[#7692FF] underline hover:text-[#1B2CC1] transition text-lg break-all"
                               target="_blank">
                                {{ $event->website }}
                            </a>
                        </div>
                    @endif
                    <div>
                        <span class="block text-lg font-semibold text-white mb-1">Fecha: {{ optional($event->schedule->turn)->date ? \Carbon\Carbon::parse($event->schedule->turn->date)->format('d/m/Y') : 'Próximamente' }}</span>
                    </div>
                    <div>
                        <span class="block text-lg font-semibold text-white mb-1">Hora de inicio: {{ $event->event_start_time ?? '-' }}</span>
                    </div>
                    <div>
                        <span class="block text-lg font-semibold text-white mb-1">Hora de fin: {{ $event->event_end_time ?? '-' }}</span>
                    </div>
                    @if(isset($event->celebrities) && count($event->celebrities))
                    <div>
                        <span class="block text-lg font-semibold text-white mb-1">Celebridades invitadas:</span>
                        <ul class="list-disc list-inside text-white mt-2">
                            @foreach($event->celebrities as $celeb)
                                <li>{{ $celeb->name }} {{ $celeb->surnames ?? '' }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <x-footer />
</x-app-layout>
