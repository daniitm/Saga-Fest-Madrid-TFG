<x-app-layout>
    <div class="min-h-screen py-6 sm:py-12 flex items-start justify-center"
         style="background: linear-gradient(to bottom, #f3f4f6 0%, #e5e7eb 100%); min-height: 100dvh;">
        <div class="w-full max-w-7xl px-4 sm:px-6 lg:px-8">

            <!-- Encabezado -->
            <div class="mb-6">
                <div class="flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#7692FF]" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                    <div>
                        <h1 class="text-xl sm:text-2xl font-bold text-[#111215]">Panel de Administración</h1>
                        <div class="w-200 h-1 bg-[#7692FF] mt-1"></div>
                    </div>
                </div>
            </div>

            <!-- Tarjetas de Acceso Rápido -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Usuarios -->
                <a href="{{ route('admin.users.index') }}"
                   class="block p-6 rounded-2xl shadow-2xl border-2 border-[#7692FF] bg-white hover:shadow-xl hover:border-[#1B2CC1] transition-all duration-200">
                    <div class="flex items-start gap-4">
                        <div class="rounded-full p-3 flex-shrink-0 bg-[#F3F4F6]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#7692FF]" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-semibold text-[#111215] mb-1">Usuarios</h2>
                            <p class="text-sm text-gray-600">Visualiza y gestiona a los usuarios registrados</p>
                        </div>
                    </div>
                </a>
                <!-- Celebridades -->
                <a href="{{ route('admin.celebrities.index') }}"
                    class="block p-6 rounded-2xl shadow-2xl border-2 border-[#7692FF] bg-white hover:shadow-xl hover:border-[#1B2CC1] transition-all duration-200">
                    <div class="flex items-start gap-4">
                        <div class="rounded-full p-3 flex-shrink-0 bg-[#F3F4F6]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#7692FF]" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-semibold text-[#111215] mb-1">Celebridades</h2>
                            <p class="text-sm text-gray-600">Administra los perfiles de las celebridades</p>
                        </div>
                    </div>
                </a>
                <!-- Eventos -->
                <a href="{{ route('admin.events.index') }}"
                    class="block p-6 rounded-2xl shadow-2xl border-2 border-[#7692FF] bg-white hover:shadow-xl hover:border-[#1B2CC1] transition-all duration-200">
                    <div class="flex items-start gap-4">
                        <div class="rounded-full p-3 flex-shrink-0 bg-[#F3F4F6]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#7692FF]" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-semibold text-[#111215] mb-1">Eventos</h2>
                            <p class="text-sm text-gray-600">Crea, organiza y administra todos los eventos</p>
                        </div>
                    </div>
                </a>
                <!-- Entradas -->
                <a href="{{ route('admin.tickets.index') }}"
                    class="block p-6 rounded-2xl shadow-2xl border-2 border-[#7692FF] bg-white hover:shadow-xl hover:border-[#1B2CC1] transition-all duration-200">
                    <div class="flex items-start gap-4">
                        <div class="rounded-full p-3 flex-shrink-0 bg-[#F3F4F6]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#7692FF]" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                    d="M17 16H8a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h9m0 11h3a1 1 0 0 0 1-1V6a1 1 0 0 0-1-1h-3m0 11v-1m0-10v1" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                    d="M13 20H4a1 1 0 0 1-1-1v-9a1 1 0 0 1 1-1h3m6 11h3a1 1 0 0 0 1-1v-2.5M13 20v-1m4-9.999V9m0 3.001V12" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-semibold text-[#111215] mb-1">Entradas</h2>
                            <p class="text-sm text-gray-600">Consulta y controla las entradas</p>
                        </div>
                    </div>
                </a>
                <!-- Expositores -->
                <a href="#"
                    class="block p-6 rounded-2xl shadow-2xl border-2 border-[#7692FF] bg-white hover:shadow-xl hover:border-[#1B2CC1] transition-all duration-200">
                    <div class="flex items-start gap-4">
                        <div class="rounded-full p-3 flex-shrink-0 bg-[#F3F4F6]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#7692FF]" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-semibold text-[#111215] mb-1">Expositores</h2>
                            <p class="text-sm text-gray-600">Administra perfiles y detalles de los expositores</p>
                        </div>
                    </div>
                </a>
                <!-- Exposiciones -->
                <a href="#"
                    class="block p-6 rounded-2xl shadow-2xl border-2 border-[#7692FF] bg-white hover:shadow-xl hover:border-[#1B2CC1] transition-all duration-200">
                    <div class="flex items-start gap-4">
                        <div class="rounded-full p-3 flex-shrink-0 bg-[#F3F4F6]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#7692FF]" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-semibold text-[#111215] mb-1">Exposiciones</h2>
                            <p class="text-sm text-gray-600">Visualiza y gestiona las exposiciones</p>
                        </div>
                    </div>
                </a>
                <!-- Horarios -->
                <a href="{{ route('admin.schedules.index') }}"
                    class="block p-6 rounded-2xl shadow-2xl border-2 border-[#7692FF] bg-white hover:shadow-xl hover:border-[#1B2CC1] transition-all duration-200">
                    <div class="flex items-start gap-4">
                        <div class="rounded-full p-3 flex-shrink-0 bg-[#F3F4F6]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#7692FF]" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-semibold text-[#111215] mb-1">Horarios</h2>
                            <p class="text-sm text-gray-600">Crea y organiza horarios para los eventos</p>
                        </div>
                    </div>
                </a>
                <!-- Espacios -->
                <a href="{{ route('admin.spaces.index') }}"
                    class="block p-6 rounded-2xl shadow-2xl border-2 border-[#7692FF] bg-white hover:shadow-xl hover:border-[#1B2CC1] transition-all duration-200">
                    <div class="flex items-start gap-4">
                        <div class="rounded-full p-3 flex-shrink-0 bg-[#F3F4F6]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#7692FF]" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 21C15.5 17.4 19 14.1764 19 10.2C19 6.22355 15.866 3 12 3C8.13401 3 5 6.22355 5 10.2C5 14.1764 8.5 17.4 12 21Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 13C13.6569 13 15 11.6569 15 10C15 8.34315 13.6569 7 12 7C10.3431 7 9 8.34315 9 10C9 11.6569 10.3431 13 12 13Z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-semibold text-[#111215] mb-1">Espacios</h2>
                            <p class="text-sm text-gray-600">Gestiona los espacios físicos asignados</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Sección de próximos eventos -->
            <div class="bg-white rounded-2xl shadow-2xl border-2 border-[#7692FF] p-8">
                <h3 class="font-semibold text-lg text-[#111215] mb-4">Próximos Eventos</h3>
                <div class="text-gray-700">
                    No hay eventos disponibles.
                </div>
            </div>
        </div>
    </div>
</x-app-layout>