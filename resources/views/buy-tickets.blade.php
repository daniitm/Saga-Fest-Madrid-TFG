<x-app-layout>

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
            </div>
        </div>
    </section>

    <x-footer />
</x-app-layout>