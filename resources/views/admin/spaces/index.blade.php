<x-app-layout>
    <div class="min-h-screen py-6 sm:py-12 flex items-start justify-center" style="background: linear-gradient(to bottom, #f3f4f6 0%, #e5e7eb 100%); min-height: 100dvh;">
        <div class="w-full max-w-7xl px-4 sm:px-6 lg:px-8">
            <!-- Ventana flotante blanca con borde azul: Listado de tickets -->
            <div class="bg-white rounded-2xl shadow-2xl border-2 border-[#7692FF] p-0 mb-12">
                <div class="p-6 sm:p-10">
                    <div class="flex items-center gap-3 mb-6">
                        <h2 class="text-xl sm:text-2xl font-bold text-[#111215] flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-[#7692FF]" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 21C15.5 17.4 19 14.1764 19 10.2C19 6.22355 15.866 3 12 3C8.13401 3 5 6.22355 5 10.2C5 14.1764 8.5 17.4 12 21Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 13C13.6569 13 15 11.6569 15 10C15 8.34315 13.6569 7 12 7C10.3431 7 9 8.34315 9 10C9 11.6569 10.3431 13 12 13Z" />
                            </svg>
                            Listado de Espacios
                        </h2>
                    </div>
                    <div class="flex flex-wrap gap-3 w-full sm:w-auto">
                        <x-add-button :action="route('admin.tickets.create')" :text="'Nada'" />
                    </div>
                </div>
            </div>

            <!-- Ventana flotante blanca con borde azul -->
            <div class="bg-white rounded-2xl shadow-2xl border-2 border-[#7692FF] p-0">
                <div class="p-6 sm:p-10">
                    <!-- Subtítulo -->
                    <div class="flex items-center gap-3 mb-6">
                        <h2 class="text-xl sm:text-2xl font-bold text-[#111215] flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-[#7692FF]" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 21C15.5 17.4 19 14.1764 19 10.2C19 6.22355 15.866 3 12 3C8.13401 3 5 6.22355 5 10.2C5 14.1764 8.5 17.4 12 21Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 13C13.6569 13 15 11.6569 15 10C15 8.34315 13.6569 7 12 7C10.3431 7 9 8.34315 9 10C9 11.6569 10.3431 13 12 13Z" />
                            </svg>
                            Listado de Espacios
                        </h2>
                    </div>
                    <!-- Botones y resumen -->
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 mb-6">
                        <div class="text-lg text-[#111215] font-semibold">
                            Espacios totales: <span class="text-[#7692FF]">{{ array_sum($counts) }}</span>
                        </div>
                        <div class="flex gap-2 w-full sm:w-auto">
                            <a href="{{ route('admin.spaces.create') }}"
                               class="bg-primary hover:bg-primary/80 text-white font-semibold px-4 py-2 rounded-md transition-all duration-200 flex items-center gap-2 w-full sm:w-auto justify-center">
                                <span class="text-2xl leading-none">+</span> Agregar espacios
                            </a>
                            <a href="{{ route('admin.spaces.delete') }}"
                               class="bg-red-500 hover:bg-red-600 text-white font-semibold px-4 py-2 rounded-md transition-all duration-200 flex items-center gap-2 w-full sm:w-auto justify-center">
                                <span class="text-2xl leading-none">−</span> Eliminar espacios
                            </a>
                        </div>
                    </div>
                    <!-- Áreas -->
                    <div class="mt-8">
                        <h3 class="text-lg font-semibold mb-4 text-[#111215]">Espacios por área:</h3>
                        <!-- Tarjetas para móvil -->
                        <div class="flex flex-col gap-4 sm:hidden">
                            @php $areas = ['P0', 'C1', 'C2']; @endphp
                            @foreach($areas as $area)
                                @php
                                    $total = $counts[$area] ?? 0;
                                    $grande = \App\Models\Space::where('location_area', $area)->where('space_size', 'Grande')->count();
                                    $medio = \App\Models\Space::where('location_area', $area)->where('space_size', 'Medio')->count();
                                    $pequeno = \App\Models\Space::where('location_area', $area)->where('space_size', 'Pequeño')->count();
                                @endphp
                                <div class="bg-gray-100 rounded-xl p-5 shadow border border-gray-200 flex flex-col gap-2">
                                    <div class="font-bold text-[#7692FF] text-lg mb-1">Área {{ $area }}</div>
                                    <div class="flex flex-col gap-1 text-sm">
                                        <div><span class="font-semibold text-[#111215]">Grandes:</span> {{ $grande }} Espacios</div>
                                        <div><span class="font-semibold text-[#111215]">Medios:</span> {{ $medio }} Espacios</div>
                                        <div><span class="font-semibold text-[#111215]">Pequeños:</span> {{ $pequeno }} Espacios</div>
                                        <div><span class="font-semibold text-[#111215]">Total:</span> {{ $total }} Espacios</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!-- Tabla para escritorio -->
                        <div class="hidden sm:block overflow-x-auto rounded-xl border border-gray-300 bg-white">
                            <table class="min-w-full w-full table-fixed divide-y divide-gray-200 text-xs sm:text-sm">
                                <thead>
                                    <tr class="bg-[#7692FF]">
                                        <th class="px-2 sm:px-6 py-4 text-left font-semibold text-white uppercase tracking-wider">Áreas</th>
                                        <th class="px-2 sm:px-6 py-4 text-left font-semibold text-white uppercase tracking-wider">Espacios grandes</th>
                                        <th class="px-2 sm:px-6 py-4 text-left font-semibold text-white uppercase tracking-wider">Espacios medios</th>
                                        <th class="px-2 sm:px-6 py-4 text-left font-semibold text-white uppercase tracking-wider">Espacios pequeños</th>
                                        <th class="px-2 sm:px-6 py-4 text-left font-semibold text-white uppercase tracking-wider">Total de espacios</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach($areas as $area)
                                        @php
                                            $total = $counts[$area] ?? 0;
                                            $grande = \App\Models\Space::where('location_area', $area)->where('space_size', 'Grande')->count();
                                            $medio = \App\Models\Space::where('location_area', $area)->where('space_size', 'Medio')->count();
                                            $pequeno = \App\Models\Space::where('location_area', $area)->where('space_size', 'Pequeño')->count();
                                        @endphp
                                        <tr class="hover:bg-[#7692FF]/10 transition-colors duration-200 h-12 sm:h-16">
                                            <td class="px-2 sm:px-6 py-4 text-gray-900">{{ $area }}</td>
                                            <td class="px-2 sm:px-6 py-4 text-gray-900">{{ $grande }} Espacios</td>
                                            <td class="px-2 sm:px-6 py-4 text-gray-900">{{ $medio }} Espacios</td>
                                            <td class="px-2 sm:px-6 py-4 text-gray-900">{{ $pequeno }} Espacios</td>
                                            <td class="px-2 sm:px-6 py-4 text-gray-900">{{ $total }} Espacios</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>