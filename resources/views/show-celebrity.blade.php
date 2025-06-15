<x-app-layout>
    <!-- Sección Detalle Celebridad -->
    <section class="bg-white py-14 sm:py-20 lg:py-22" style="background-color: #111215;">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-5xl">
            <div class="bg-gray-50 rounded-2xl p-10 sm:p-14 shadow-2xl" style="background-color: #363636;">
                <h1 class="text-4xl sm:text-5xl font-bold text-white mb-10 text-center">
                    {{ $celebrity->name }} {{ $celebrity->surnames }}
                </h1>
                <div class="flex flex-col md:flex-row gap-10 items-start">
                    <!-- Biografía a la izquierda, con L -->
                    <div class="flex-1 flex flex-col justify-stretch text-white order-2 md:order-1">
                        @php
                            $words = preg_split('/\s+/u', $celebrity->biography, -1, PREG_SPLIT_NO_EMPTY);
                            $firstPart = implode(' ', array_slice($words, 0, 150));
                            $rest = implode(' ', array_slice($words, 150));
                        @endphp
                        <p class="text-gray-200 text-lg leading-relaxed h-full">
                            {{ $firstPart }}
                        </p>
                    </div>
                    <!-- Foto a la derecha, columna igual al ancho de la imagen, centrada en móvil -->
                    <div class="flex flex-col items-center justify-start order-1 md:order-2 mx-auto md:mx-0" style="width:288px; min-width:288px; max-width:288px;">
                        <img src="{{ $celebrity->photo ? asset('storage/img/celebrities/' . $celebrity->photo) : asset('img/celebrities/imagen_perfil.png') }}"
                        alt="Foto de {{ $celebrity->name }}"
                        style="width: 288px; height: 288px; object-fit: cover; object-position: center;"
                        class="rounded-lg mb-4 shadow-lg">
                        <span class="inline-block bg-primary text-white px-4 py-1 rounded-full text-sm font-semibold mt-2">
                            {{ $celebrity->category }}
                        </span>
                    </div>
                </div>
                <!-- Biografía extendida en ancho completo si hay más texto -->
                @if($rest)
                <div class="mt-6 text-gray-200 text-lg leading-relaxed">
                    <p>{!! nl2br(e($rest)) !!}</p>
                </div>
                @endif
                <!-- Web / Redes debajo de todo, alineada a la izquierda -->
                @if($celebrity->website)
                    <div class="mt-10 flex flex-col items-start md:ml-0 ml-0">
                        <span class="block text-lg font-semibold text-white mb-1">Web / Redes:</span>
                        <a href="{{ $celebrity->website }}"
                           class="text-[#7692FF] underline hover:text-[#1B2CC1] transition text-lg break-all"
                           target="_blank">
                            {{ $celebrity->website }}
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </section>
    <x-footer />
</x-app-layout>