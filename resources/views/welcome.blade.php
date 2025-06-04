<x-app-layout>

    <!-- Hero Section-->
    <section class="relative w-full sm:h-[83svh] h-[50svh] min-h-[500px] max-h-[900px] overflow-hidden">
        <div class="absolute inset-0">
            <picture>
                <source media="(min-width: 768px)" srcset="/images/img5.webp" type="image/webp">
                <source srcset="/images/img5-mobile.webp" type="image/webp">
                <img src="/images/img5-mobile.jpg" alt="Profesional realizando examen de la vista"
                    class="w-full h-full object-cover object-center md:object-[center_30%]" loading="eager"
                    decoding="async" fetchpriority="high">
            </picture>
        </div>

        <div
            class="absolute inset-0 bg-gradient-to-b from-transparent via-black/40 to-black/90 flex flex-col justify-center items-center px-6 sm:px-8 text-center">
            <div class="max-w-4xl mx-auto space-y-6">
                <h1
                    class="text-4xl sm:text-5xl md:text-6xl font-bold text-white leading-tight drop-shadow-xl animate-fade-in">
                    Tu visión, nuestra prioridad.
                </h1>
                <p
                    class="text-xl sm:text-2xl text-white/90 leading-relaxed max-w-2xl mx-auto drop-shadow-md animate-fade-in [animation-delay:100ms]">
                    Expertos en el cuidado integral de tus ojos. Pide tu cita hoy mismo.
                </p>
                <div class="animate-fade-in [animation-delay:200ms]">
                    
                </div>
            </div>
        </div>
    </section>

    <!-- Primera sección de ubicación - Rediseñada para mejor flujo -->
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
                                <button
                                    class="flex items-center gap-2 bg-primary hover:bg-primary/80 text-white font-semibold px-8 py-3 rounded-full shadow transition-all duration-300">
                                    <span class="relative flex items-center ml-2">
                                        <span class="block w-6 h-0.5 bg-white mr-[-12px]"></span>
                                        <svg class="w-5 h-5" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </span>
                                </button>
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
                                <button
                                    class="flex items-center gap-2 bg-primary hover:bg-primary/80 text-white font-semibold px-8 py-3 rounded-full shadow transition-all duration-300">
                                    <span class="relative flex items-center ml-2">
                                        <span class="block w-6 h-0.5 bg-white mr-[-12px]"></span>
                                        <svg class="w-5 h-5" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </span>
                                </button>
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
                                <button
                                    class="flex items-center gap-2 bg-primary hover:bg-primary/80 text-white font-semibold px-8 py-3 rounded-full shadow transition-all duration-300">
                                    <span class="relative flex items-center ml-2">
                                        <span class="block w-6 h-0.5 bg-white mr-[-12px]"></span>
                                        <svg class="w-5 h-5" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </span>
                                </button>
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
                                    <img src="/images/img5-mobile.webp" alt="Imagen sección" class="rounded-lg w-full h-80 object-cover object-center mb-4" />
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
                                    <img src="/images/img5-mobile.webp" alt="Imagen sección" class="rounded-lg w-full h-80 object-cover object-center mb-4" />
                                </div>
                                <div>
                                    <h3 class="text-2xl font-semibold text-white mb-3">Cosplayers</h3>
                                    <p class="text-gray-400 leading-relaxed">
                                        Quienes dan vida a sus personajes favoritos con habilidad, pasión y arte, haciéndote sentir en una verdadera película.
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
                                    <img src="/images/img5-mobile.webp" alt="Imagen sección" class="rounded-lg w-full h-80 object-cover object-center mb-4" />
                                </div>
                                <div>
                                    <h3 class="text-2xl font-semibold text-white mb-3">Estrellas</h3>
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
                                    <img src="/images/img5-mobile.webp" alt="Imagen sección" class="rounded-lg w-full h-80 object-cover object-center mb-4" />
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
                                    <img src="/images/img5-mobile.webp" alt="Imagen sección" class="rounded-lg w-full h-80 object-cover object-center mb-4" />
                                </div>
                                <div>
                                    <h3 class="text-2xl font-semibold text-white mb-3">Familias</h3>
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

    <!-- Sección Celebridades (Sesión) -->
    <section class="bg-white py-14 sm:py-20 lg:py-22" style="background-color: #111215;">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
            <div class="text-center mb-12 sm:mb-16">
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-white mb-4">Algunos de nuestros Invitados</h2>
                <div class="w-20 h-1 bg-primary mx-auto"></div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10 lg:gap-12">
                @foreach($celebrities as $celebrity)
                    <a href="{{ route('celebrity.show', $celebrity->id) }}" class="block transition-transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-primary rounded-2xl">
                        <div class="bg-gray-50 rounded-2xl p-8 sm:p-10 shadow-2xl" style="background-color: #363636;">
                            <div class="space-y-6">
                                <div class="w-full flex justify-center">
                                    <img src="{{ asset('storage/img/celebrities/' . ($celebrity->photo ?? 'imagen_perfil.png')) }}"
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
        </div>
    </section>

    <!-- Sección Eventos -->
    <section class="bg-white py-14 sm:py-20 lg:py-22" style="background-color: #111215;">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
            <div class="text-center mb-12 sm:mb-16">
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-white mb-4">Eventos Destacados</h2>
                <div class="w-20 h-1 bg-primary mx-auto"></div>
            </div>

            <div x-data="{ showAll: false }">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 lg:gap-12">
                    <!-- Tarjeta 1 -->
                    <template x-if="showAll || true">
                        <div class="bg-gray-50 rounded-2xl p-8 sm:p-10 shadow-2xl transform transition-all duration-300 hover:scale-[1.01]" style="background-color: #363636;">
                            <div class="space-y-6">
                                <div class="w-full flex justify-center">
                                    <img src="/images/img5-mobile.webp" alt="Imagen sección" class="rounded-lg w-full h-80 object-cover object-center mb-4" />
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
                                    <img src="/images/img5-mobile.webp" alt="Imagen sección" class="rounded-lg w-full h-80 object-cover object-center mb-4" />
                                </div>
                                <div>
                                    <h3 class="text-2xl font-semibold text-white mb-3">Cosplayers</h3>
                                    <p class="text-gray-400 leading-relaxed">
                                        Quienes dan vida a sus personajes favoritos con habilidad, pasión y arte, haciéndote sentir en una verdadera película.
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
                                    <img src="/images/img5-mobile.webp" alt="Imagen sección" class="rounded-lg w-full h-80 object-cover object-center mb-4" />
                                </div>
                                <div>
                                    <h3 class="text-2xl font-semibold text-white mb-3">Estrellas</h3>
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
                                    <img src="/images/img5-mobile.webp" alt="Imagen sección" class="rounded-lg w-full h-80 object-cover object-center mb-4" />
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
                                    <img src="/images/img5-mobile.webp" alt="Imagen sección" class="rounded-lg w-full h-80 object-cover object-center mb-4" />
                                </div>
                                <div>
                                    <h3 class="text-2xl font-semibold text-white mb-3">Familias</h3>
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

    <!-- Sección de ubicación - Rediseñada para mejor flujo -->
    <section class="bg-white py-14 sm:py-20 lg:py-22" style="background-color: #111215;">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
            <div class="text-center mb-12 sm:mb-16">
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-white mb-4">¿Dónde encontrarnos?</h2>
                <div class="w-20 h-1 bg-primary mx-auto"></div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-12">
                <!-- Información de contacto mejorada -->
                <div
                    class="bg-gray-50 rounded-xl p-8 sm:p-10 shadow-sm transform transition-all duration-300 hover:shadow-2xl"
                    style="background-color: #363636;">
                    <div class="space-y-6">
                        <div>
                            <div class="flex items-center mb-3">
                                <svg class="w-6 h-6 mr-3 text-primary" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <h3 class="text-2xl font-semibold text-white">Nuestra Dirección:</h3>
                            </div>
                            <p class="text-gray-400 leading-relaxed mx-6">
                                Hospital San Rafael, C/ San Juan de Dios, 19, Centro, 18001 Granada.
                            </p>
                        </div>

                        <div>
                            <div class="flex items-center mb-3">
                                <svg class="w-6 h-6 mr-3 text-primary" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <h3 class="text-2xl font-semibold text-white">Nuestros Horarios:</h3>
                            </div>
                            <ul class="space-y-2 text-gray-400 leading-relaxed mx-6">
                                <li class="flex items-start">
                                    <span class="inline-block w-1.5 h-1.5 rounded-full bg-primary mt-2 mr-2"></span>
                                    Viernes 25 de Julio - 09:00 a 14:00 / 16:00 a 21:00
                                </li>
                                <li class="flex items-start">
                                    <span class="inline-block w-1.5 h-1.5 rounded-full bg-primary mt-2 mr-2"></span>
                                    Sábado 26 de Julio - 09:00 a 14:00 / 16:00 a 21:00
                                </li>
                                <li class="flex items-start">
                                    <span class="inline-block w-1.5 h-1.5 rounded-full bg-primary mt-2 mr-2"></span>
                                    Domingo 27 de Julio - 09:00 a 14:00 / 16:00 a 19:00
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Mapa de ubicación -->
                <div
                    class="relative rounded-xl overflow-hidden shadow-xl h-[400px] lg:h-[500px] transform transition-all duration-300 hover:shadow-2xl">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3178.805430064723!2d-3.6053723886933993!3d37.18109467202474!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd71fcea8c8d04d7%3A0xbcd461fa8bdad6b6!2sHospital%20San%20Rafael!5e0!3m2!1ses!2ses!4v1712148575847!5m2!1ses!2ses"
                        class="absolute inset-0 w-full h-full border-none" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade" title="Ubicación en mapa"></iframe>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección de contacto  -->
    <section class="bg-gradient-to-r bg-gray-100 py-14 sm:py-20 lg:py-22" style="background-color: #202328;">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-4xl text-center">
            <div
                class="rounded-2xl p-8 sm:p-10 shadow-2xl transform transition-all duration-300 hover:scale-[1.01]" style="background-color: #7692FF;">
                <h2 class="text-3xl sm:text-4xl font-bold text-white mb-6">¿Necesitas contactarnos?</h2>
                <p class="text-lg sm:text-xl text-white mb-8 leading-relaxed">
                    Estamos aquí para resolver tus dudas y atender tus consultas. No dudes en ponerte en contacto con
                    nuestro equipo de especialistas.
                </p>
                
            </div>
        </div>
    </section>

    <x-footer />
</x-app-layout>