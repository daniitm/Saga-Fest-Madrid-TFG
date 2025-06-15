<x-app-layout>

    <!-- Sección Hero -->
    <section class="relative w-full sm:h-[83svh] h-[50svh] min-h-[500px] max-h-[900px] overflow-hidden">
        <div class="absolute inset-0">
            <picture>
                <source media="(min-width: 768px)" srcset="/assets/images/sagafestmadridhero.png">
                <source srcset="/assets/images/sagafestmadridhero.png">
                <img src="/assets/images/sagafestmadridhero.png" alt="Hero Saga-Fest Madrid"
                    class="w-full h-full object-cover object-center md:object-[center_30%]" loading="eager"
                    decoding="async" fetchpriority="high">
            </picture>
        </div>

        <div
            class="absolute inset-0 bg-gradient-to-b from-transparent via-black/40 to-black/90 flex flex-col justify-center items-center px-6 sm:px-8 text-center">
            <div class="max-w-4xl mx-auto space-y-6">
                <h1
                    class="text-4xl sm:text-5xl md:text-6xl font-bold text-white leading-tight drop-shadow-xl animate-fade-in">
                    Bienvenido a Saga-Fest Madrid
                </h1>
                <p
                    class="text-xl sm:text-2xl text-white/90 leading-relaxed max-w-2xl mx-auto drop-shadow-md animate-fade-in [animation-delay:100ms]">
                    Te esperamos este Julio en el Festival Internacional más grande de Cine, Cómic y Juegos de Madrid
                </p>
            </div>
        </div>
    </section>

    <!-- Secciones de Interés -->
    <section class="bg-white py-14 sm:py-20 lg:py-22" style="background-color: #111215;">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 lg:gap-12">

                <!-- Quiero participar -->
                <div
                    class="bg-gray-50 rounded-2xl p-8 sm:p-10 shadow-2xl transform transition-all duration-300 hover:scale-[1.01]" style="background-color: #363636;">
                    <div class="space-y-6">
                        <div>
                            <h3 class="text-2xl font-semibold text-white mb-3">Quiero exponer</h3>
                            <p class="text-gray-400 leading-relaxed">
                                Forma parte de Saga-Fest Madrid. Déjanos tus datos y nos pondremos en contacto contigo con las opciones que tienes como expositor.
                            </p>
                            <div class="flex justify-end mt-10">
                                <a href="{{ route('want-expose') }}" class="flex items-center gap-2 bg-primary hover:bg-primary/80 text-white font-semibold px-8 py-3 rounded-full shadow transition-all duration-300">
                                    <span class="relative flex items-center ml-2">
                                        <span class="block w-6 h-0.5 bg-white mr-[-12px]"></span>
                                        <svg class="w-5 h-5" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quiero asistir -->
                <div
                    class="bg-y-50 rounded-2xl p-8 sm:p-10 shadow-2xl transform transition-all duration-300 hover:scale-[1.01]" style="background-color: #363636;">
                    <div class="space-y-6">
                        <div>
                            <h3 class="text-2xl font-semibold text-white mb-3">Quiero asistir</h3>
                            <p class="text-gray-400 leading-relaxed">
                                Tu aventura en Saga-Fest Madrid empieza aquí. Regístrate y sé el primero en enterarte cuando las entradas salgan a la venta.
                            </p>
                            <div class="flex justify-end mt-10">
                                <a href="{{ route('buy-ticket') }}" class="flex items-center gap-2 bg-primary hover:bg-primary/80 text-white font-semibold px-8 py-3 rounded-full shadow transition-all duration-300">
                                    <span class="relative flex items-center ml-2">
                                        <span class="block w-6 h-0.5 bg-white mr-[-12px]"></span>
                                        <svg class="w-5 h-5" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quién organiza -->
                <div
                    class="bg-gray-50 rounded-2xl p-8 sm:p-10 shadow-2xl transform transition-all duration-300 hover:scale-[1.01]" style="background-color: #363636;">
                    <div class="space-y-6">
                        <div>
                            <h3 class="text-2xl font-semibold text-white mb-3">Quién organiza</h3>
                            <p class="text-gray-400 leading-relaxed">
                                Saga-Fest Madrid es un evento anual que celebra la riqueza del noveno arte y reúne a librerías, editoriales, aficionados y creadores.
                            </p>
                            <div class="flex justify-end mt-10">
                                <a href="{{ route('who-organises') }}" class="flex items-center gap-2 bg-primary hover:bg-primary/80 text-white font-semibold px-8 py-3 rounded-full shadow transition-all duration-300">
                                    <span class="relative flex items-center ml-2">
                                        <span class="block w-6 h-0.5 bg-white mr-[-12px]"></span>
                                        <svg class="w-5 h-5" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección ¿Quiénes participan? -->
    <section class="bg-white py-14 sm:py-20 lg:py-22" style="background-color: #111215;">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
            <div class="text-center mb-12 sm:mb-16">
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-white mb-4">¿Quiénes participan?</h2>
                <div class="w-20 h-1 bg-primary mx-auto"></div>
            </div>

            <div x-data="{ showAll: false }">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 lg:gap-12">
                    <!-- Tarjeta 1 -->
                    <template x-if="showAll || true">
                        <div class="bg-gray-50 rounded-2xl p-8 sm:p-10 shadow-2xl transform transition-all duration-300 hover:scale-[1.01]" style="background-color: #363636;">
                            <div class="space-y-6">
                                <div class="w-full flex justify-center">
                                    <img src="/assets/images/seccionfans.png" alt="Imagen sección" class="rounded-lg w-full h-80 object-cover object-center mb-4" />
                                </div>
                                <div>
                                    <h3 class="text-2xl font-semibold text-white mb-3">Fans</h3>
                                    <p class="text-gray-400 leading-relaxed">
                                        Los que hacen de su pasión un universo propio donde . Aquí, sus sueños cobran vida.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </template>
                    <!-- Tarjeta 2 -->
                    <template x-if="showAll || true">
                        <div class="bg-gray-50 rounded-2xl p-8 sm:p-10 shadow-2xl transform transition-all duration-300 hover:scale-[1.01]" style="background-color: #363636;">
                            <div class="space-y-6">
                                <div class="w-full flex justify-center">
                                    <img src="assets/images/seccioncosplayers.png" alt="Imagen sección" class="rounded-lg w-full h-80 object-cover object-center mb-4" />
                                </div>
                                <div>
                                    <h3 class="text-2xl font-semibold text-white mb-3">Cosplayers</h3>
                                    <p class="text-gray-400 leading-relaxed">
                                        Quienes dan vida a sus personajes favoritos with habilidad, pasión y arte, haciéndote sentir en una verdadera película.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </template>
                    <!-- Tarjeta 3 -->
                    <template x-if="showAll || true">
                        <div class="bg-gray-50 rounded-2xl p-8 sm:p-10 shadow-2xl transform transition-all duration-300 hover:scale-[1.01]" style="background-color: #363636;">
                            <div class="space-y-6">
                                <div class="w-full flex justify-center">
                                    <img src="/assets/images/seccioncelebridades.png" alt="Imagen sección" class="rounded-lg w-full h-80 object-cover object-center mb-4" />
                                </div>
                                <div>
                                    <h3 class="text-2xl font-semibold text-white mb-3">Celebridades</h3>
                                    <p class="text-gray-400 leading-relaxed">
                                        Los íconos de la cultura pop que han marcado generaciones, compartiendo su legado con los fans que lo han hecho posible.    
                                    </p>
                                </div>
                            </div>
                        </div>
                    </template>
                    <!-- Tarjeta 4 -->
                    <template x-if="showAll">
                        <div class="bg-gray-50 rounded-2xl p-8 sm:p-10 shadow-2xl transform transition-all duration-300 hover:scale-[1.01]" style="background-color: #363636;">
                            <div class="space-y-6">
                                <div class="w-full flex justify-center">
                                    <img src="/assets/images/seccionexpositores.png" alt="Imagen sección" class="rounded-lg w-full h-80 object-cover object-center mb-4" />
                                </div>
                                <div>
                                    <h3 class="text-2xl font-semibold text-white mb-3">Expositores</h3>
                                    <p class="text-gray-400 leading-relaxed">
                                        Espacio para expositores, artistas y creadores que comparten su trabajo con la comunidad.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </template>
                    <!-- Tarjeta 5 -->
                    <template x-if="showAll">
                        <div class="bg-gray-50 rounded-2xl p-8 sm:p-10 shadow-2xl transform transition-all duration-300 hover:scale-[1.01]" style="background-color: #363636;">
                            <div class="space-y-6">
                                <div class="w-full flex justify-center">
                                    <img src="/assets/images/seccionfamiliasamigos.png" alt="Imagen sección" class="rounded-lg w-full h-80 object-cover object-center mb-4" />
                                </div>
                                <div>
                                    <h3 class="text-2xl font-semibold text-white mb-3">Familias y amigos</h3>
                                    <p class="text-gray-400 leading-relaxed">
                                        Quienes quieren vivir la pasión por la aventura, la fantasía y la ficción con sus seres queridos sin que falte la diversión.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
                <!-- Botones -->
                <div class="flex justify-center mt-10">
                    <button
                        x-show="!showAll"
                        @click="showAll = true"
                        class="bg-primary hover:bg-primary/80 text-white font-semibold px-8 py-3 rounded-full shadow transition-all duration-300">
                        Ver más
                    </button>
                    <button
                        x-show="showAll"
                        @click="showAll = false"
                        class="bg-primary hover:bg-primary/80 text-white font-semibold px-8 py-3 rounded-full shadow transition-all duration-300">
                        Ver menos
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección Celebridades -->
    @auth
    <section class="bg-white py-14 sm:py-20 lg:py-22" style="background-color: #111215;">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
            <div class="text-center mb-12 sm:mb-16">
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-white mb-4">Celebridades invitadas</h2>
                <div class="w-20 h-1 bg-primary mx-auto"></div>
            </div>
            @if($celebrities->isEmpty())
                <div class="text-center text-white text-lg mb-10">
                    <p>No hay celebridades disponibles en este momento.</p>
                    <p>Si cree que esto se puede tratar de un error <a href="{{ route('contact') }}" class="underline" style="color: #7692FF;">contacte con nosotros</a>.</p>
                </div>
            @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10 lg:gap-12">
                @foreach($celebrities as $celebrity)
                    <a href="{{ route('celebrity.show', $celebrity->id) }}" class="block transition-transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-primary rounded-2xl">
                        <div class="bg-gray-50 rounded-2xl p-8 sm:p-10 shadow-2xl" style="background-color: #363636;">
                            <div class="space-y-6">
                                <div class="w-full flex justify-center">
                                    <img src="{{ $celebrity->photo ? asset('storage/img/celebrities/' . $celebrity->photo) : asset('img/celebrities/imagen_perfil.png') }}"
                                        alt="{{ $celebrity->name }} {{ $celebrity->surnames }}"
                                        class="rounded-lg w-full h-80 object-cover object-center mb-4" />
                                </div>
                                <div class="text-center">
                                    <h3 class="text-2xl font-semibold text-white mb-1">{{ $celebrity->name }} {{ $celebrity->surnames }}</h3>
                                    <span class="inline-block bg-primary text-white px-4 py-1 rounded-full text-sm font-semibold mb-2">
                                        {{ $celebrity->category }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="flex justify-center mt-10">
                <a href="{{ route('celebrities.all') }}" class="bg-primary hover:bg-primary/80 text-white font-semibold px-8 py-3 rounded-full shadow transition-all duration-300">
                    Ver todas
                </a>
            </div>
            @endif
        </div>
    </section>
    @endauth

    <!-- Sección Eventos -->
    @auth
    <section class="bg-white py-4 sm:py-20 lg:py-22" style="background-color: #111215;">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
            <div class="text-center mb-12 sm:mb-16">
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-white mb-4">Eventos destacados</h2>
                <div class="w-20 h-1 bg-primary mx-auto"></div>
            </div>
            @if($events->isEmpty())
                <div class="text-center text-white text-lg mb-10">
                    <p>No hay eventos disponibles en este momento.</p>
                    <p>Si cree que esto se puede tratar de un error <a href="{{ route('contact') }}" class="underline" style="color: #7692FF;">contacte con nosotros</a>.</p>
                </div>
            @else
            <div class="flex flex-col gap-8">
                @foreach($events as $event)
                    <a href="{{ route('event.show', $event->id) }}" class="group block rounded-2xl overflow-hidden shadow-2xl bg-gray-50 hover:scale-[1.01] transition-transform duration-300 focus:outline-none focus:ring-2 focus:ring-primary" style="background-color: #363636;">
                        <div class="flex flex-col sm:flex-row items-stretch">
                            <div class="sm:w-1/3 w-full flex-shrink-0 flex items-center justify-center bg-black/10">
                                <img src="{{ asset('storage/' . ($event->image ?? 'img/events/imagen_perfil.png')) }}"
                                     alt="{{ $event->company_name ?? $event->title }}"
                                     class="object-cover object-center w-full h-48 sm:h-44 md:h-56 lg:h-60" />
                            </div>
                            <div class="sm:w-2/3 w-full flex flex-col justify-center px-6 py-6 sm:py-0">
                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                                    <div>
                                        <h3 class="text-2xl font-bold text-white mb-1">
                                            {{ $event->company_name ?? $event->title }}
                                        </h3>
                                        <span class="block text-gray-300 text-sm mb-1">{{ $event->title }}</span>
                                    </div>
                                    <span class="inline-block bg-primary text-white px-4 py-1 rounded-full text-sm font-semibold">
                                        {{ $event->stand_category ?? $event->category ?? 'Sin categoría' }}
                                    </span>
                                </div>
                                <div class="flex flex-col sm:flex-row sm:items-center sm:gap-6 mt-2 mb-2">
                                    @if($event->location)
                                        <span class="inline-block bg-gray-800 text-white px-3 py-1 rounded-full text-xs mt-1 sm:mt-0">
                                            {{ $event->location }}
                                        </span>
                                    @endif
                                </div>
                                <p class="text-gray-300 leading-relaxed mt-2">{{ $event->short_description }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            @endif
        </div>
    </section>
    @endauth

    <!-- Sección Localización -->
    <section class="bg-white py-14 sm:py-20 lg:py-22" style="background-color: #111215;">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
            <div class="text-center mb-12 sm:mb-16">
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-white mb-4">¿Dónde se desarrolla?</h2>
                <div class="w-20 h-1 bg-primary mx-auto"></div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-12">
                <!-- Información de contacto -->
                <div
                    class="bg-gray-50 rounded-xl p-8 sm:p-10 shadow-sm transform transition-all duration-300 hover:shadow-2xl"
                    style="background-color: #363636;">
                    <div class="space-y-6">
                        <div>
                            <div class="flex items-center mb-3">
                                <svg class="w-6 h-6 mr-3" style="color: #7692FF;" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <h3 class="text-2xl font-semibold text-white">Dirección:</h3>
                            </div>
                            <p class="text-gray-400 leading-relaxed mx-6">
                                IFEMA MADRID, Av. del Partenón, 5, Barajas, 28042 Madrid. Pabellones 5 (C1) y 6 (C2) junto con la plaza (P0).
                            </p>
                        </div>

                        <div>
                            <div class="flex items-center mb-3">
                                <svg class="w-6 h-6 mr-3" style="color: #7692FF;" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <h3 class="text-2xl font-semibold text-white">Horarios:</h3>
                            </div>
                            <ul class="space-y-2 text-gray-400 leading-relaxed mx-6">
                                @forelse($schedulesGrouped as $fechaKey => $turnos)
                                    <li class="flex flex-col sm:flex-row sm:items-center gap-2 mb-2">
                                        <span class="inline-block w-1.5 h-1.5 rounded-full mt-2 mr-2" style="background-color: #7692FF;"></span>
                                        <span class="font-semibold text-white">{{ \Carbon\Carbon::parse($fechaKey)->translatedFormat('d-m-Y') }}:</span>
                                        <div class="flex flex-col sm:flex-row sm:items-center gap-2 ml-6">
                                            @foreach($turnos as $schedule)
                                                <span class="text-gray-300">
                                                    <span class="text-gray-400 font-medium">
                                                        {{ \Carbon\Carbon::parse($schedule->turn->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($schedule->turn->end_time)->format('H:i') }}
                                                    </span>
                                                </span>
                                            @endforeach
                                        </div>
                                    </li>
                                @empty
                                    <li>No hay horarios disponibles.</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Mapa de ubicación -->
                <div id="map" style="width: 100%; height: 400px; border-radius: 16px; overflow: hidden;"></div>
                <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
                <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        var lat = 40.4663707;
                        var lng = -3.61721398309825;
                        var map = L.map('map').setView([lat, lng], 16);
                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                        }).addTo(map);
                        L.marker([lat, lng]).addTo(map)
                            .openPopup();
                    });
                </script>
            </div>
        </div>
    </section>

    <!-- Sección Contacto  -->
    <section class="bg-gradient-to-r bg-gray-100 py-14 sm:py-20 lg:py-22" style="background-color: #202328;">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-4xl text-center">
            <div
                class="rounded-2xl p-8 sm:p-10 shadow-2xl transform transition-all duration-300 hover:scale-[1.01]" style="background-color: #7692FF;">
                <h2 class="text-3xl sm:text-4xl font-bold text-white mb-6">¿Necesitas contactarnos?</h2>
                <p class="text-lg sm:text-xl text-white mb-8 leading-relaxed">
                    Si tiene alguna pregunta o algún problema, no dudes en ponerte en contacto con nosotros. Estamos aquí para ayudarte.
                </p>
                <a href="{{ route('contact') }}"
                    class="inline-flex items-center justify-center bg-primary hover:bg-primary-darker text-white font-medium rounded-full px-8 py-4 text-lg transition-all duration-300 hover:shadow-lg hover:scale-105 active:scale-95">
                    Contáctenos
                </a>
            </div>
        </div>
    </section>

    <x-footer />
</x-app-layout>