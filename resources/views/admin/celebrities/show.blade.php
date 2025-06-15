<x-app-layout>
    <div class="min-h-screen py-6 sm:py-12 flex items-start justify-center" style="background: linear-gradient(to bottom, #f3f4f6 0%, #e5e7eb 100%); min-height: 100dvh;">
        <div class="w-full max-w-2xl px-2 sm:px-4 lg:px-6">

            <!-- Ventana flotante blanca con borde azul -->
            <div class="bg-white rounded-2xl shadow-2xl border-2 border-[#7692FF] p-0">
                <div class="p-6 sm:p-10">
                    <h1 class="text-2xl font-bold text-[#111215] mb-6 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-[#7692FF]" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Detalles de la Celebridad
                    </h1>
                    <!-- Dos columnas: imagen más estrecha -->
                    <div class="flex flex-col sm:flex-row">
                        <!-- Columna Izquierda: ancho fijo, alineado a la izquierda con menos padding -->
                        <div class="w-full sm:w-48 flex flex-col items-center justify-center sm:items-start sm:justify-start pl-0 sm:pl-1 mb-2 sm:mb-0">
                            <img src="{{
                                $celebrity->photo && !Str::contains($celebrity->photo, 'imagen_perfil.png')
                                    ? asset('storage/img/celebrities/' . $celebrity->photo)
                                    : asset('assets/img/celebrities/imagen_perfil.png')
                            }}"
                                alt="Foto de {{ $celebrity->name }}"
                                class="w-40 h-40 object-cover rounded-lg shadow-lg mb-2 mx-auto sm:mx-0">
                        </div>
                        <!-- Columna Derecha: ocupa el resto del espacio -->
                        <div class="flex-1 flex flex-col justify-center space-y-2">
                            <div>
                                <span class="text-gray-700 font-bold text-lg">Nombre:</span>
                                <span class="text-gray-900">{{ $celebrity->name }}</span>
                            </div>
                            <div>
                                <span class="text-gray-700 font-bold text-lg">Apellidos:</span>
                                <span class="text-gray-900">{{ $celebrity->surnames }}</span>
                            </div>
                            <div>
                                <span class="text-gray-700 font-bold text-lg">Email:</span>
                                <span class="text-gray-900">{{ $celebrity->email }}</span>
                            </div>
                            <div>
                                <span class="text-gray-700 font-bold text-lg">Categoría:</span>
                                <span class="text-gray-900">{{ $celebrity->category }}</span>
                            </div>
                        </div>
                    </div>
                    <!-- Biografía (fuera de las columnas, ocupa todo el ancho) -->
                    <div class="mt-2">
                        <span class="text-gray-700 font-bold text-lg block mb-1">Biografía:</span>
                        <p class="text-gray-900">{{ $celebrity->biography }}</p>
                    </div>
                    <!-- Web (debajo de la biografía) -->
                    @if($celebrity->website)
                        <div class="mt-2">
                            <span class="text-gray-700 font-bold text-lg">Web / Redes:</span>
                            <a href="{{ $celebrity->website }}"
                               class="text-[#7692FF] underline hover:text-[#1B2CC1] transition"
                               target="_blank">Enlace</a>
                        </div>
                    @endif

                    <!-- Botón volver -->
                    <div class="pt-5 flex gap-3">
                        <a href="{{ route('admin.celebrities.index') }}"
                           class="inline-flex items-center px-5 py-2 bg-[#7692FF] hover:bg-[#1B2CC1] text-white text-sm font-semibold rounded transition duration-200">
                            Volver atrás
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>